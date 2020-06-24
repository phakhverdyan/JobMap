<?php

namespace App\Http\Controllers;

use App\Business\Job;
use App\Candidate\Candidate;
use App\Mail\VerificationUser;
use App\User;
use App\User\Resume\Availability;
use App\User\Resume\BasicInfo;
use App\User\Resume\Preference;
use Illuminate\Http\Request;
use App\Business;
use App\Business\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Mockery\Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class ScannerController extends Controller
{
    private $temp_user_picture_name;
    private $temp_user_picture_storage;

    public function __construct()
    {
        $this->temp_user_picture_name = md5('temp-user-picture').".png";
        $this->temp_user_picture_storage = 'user/temp/';
    }

    public function scan(Request $request, $business_id)
    {
    	$location = Location::where(["business_id" => $business_id, 'main' => 1])->firstOrFail();

    	$location->load([
    		'business',
            'jobs'
    	]);
        $business = $location->business()->firstOrFail();
    	return view('scanner.scan', [
    		'location' => $location,
    		'job_count' => $business->jobs()->count(),
            'location_id' => $location->id,
            'business_id' => $business->id,
            'job_id' => 0
    	]);
    }

    public function signUp(Request $request)
    {

        $validator = validator()->make($request->all(), [
            'phone_number'          => ['required', 'string'],
            'email'                 => ['required', 'string', 'unique:users,email'],
            'first_name'            => ['required', 'string'],
            'last_name'             => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response([
                'error' => 'Validation',
                'validation_fields' => $validator->errors(),
            ], 400);
        }



        $generateRandPass = str_random(12);

        DB::beginTransaction();

        $user_args['email'] = $request->input("email");

        $user = User::where('email', $user_args['email'])->first();

        if(!$user){
            $user_args['first_name'] = $request->input("first_name");
            $user_args['last_name'] = $request->input("last_name");
            $user_args['phone_number'] = $request->input("phone_number");
            $user_args['phone_code'] = $request->input("phone_code");
            $user_args['phone_country_code'] = $request->input("phone_country_code");
            $user_args['city'] = $request->input("city");
            $user_args['region'] = $request->input("region");
            $user_args['country'] = $request->input("country");
            $user_args['country_code'] = $request->input("country_code");
            $user_args['language_prefix'] = 'en';
            $user_args['password'] = bcrypt($generateRandPass);
            $user_args['username'] = substr(md5($user_args['email']), mt_rand(0,8), 14);
            $user_args['verification_code'] = md5(str_random(32));
            $user_args['verification_date'] = time();
            $user_args['show_tooltip'] = 'on';
            $user_args['type'] = 'student';
            $user_args['login'] = 1;
            $user_args['inviting_business_id'] = 0;
            $user = User::create($user_args);
        }

        if (!$user) {
            return response([
                'error' => 'User Null'
            ], 400);
        }

        if (Input::hasFile('resume_file')) {
            if (Input::file('resume_file')->isValid()) {
                try{
                    Log::info("test");
                    ini_set('memory_limit', '-1');
                    $inputImage = Input::file('resume_file');
                    if ($inputImage->getClientSize() < 10000000) {
                        //$ext = $inputImage->getClientOriginalExtension();
                        //$fileName = md5('user-resume-attach-' . $this->auth->id);
                        $fileName = $inputImage->getClientOriginalName();
                        $storage = 'user/' . $user->id . '/resume/';
                        $originalImage = $fileName;// . '.' . $ext;
                        $inputImage->storeAs($storage, $originalImage);

                        $user->attach_file = $originalImage;
                        $user->save();
                    } else {
                        $user->attach_file = "";
                        $user->save();
                    }
                }catch (Exception $e){
                    $user->attach_file = "";
                    $user->save();
                }
            }
        }
        $temp_user_picture_name = $request->input("temp_user_picture_name", null);
        if ($temp_user_picture_name) {
            $fileName = md5('user-resume-pic-' . $user->id);
            $storage = 'user/' . $user->id . '/resume/';
            $originalImage = $fileName . '.png';

            Storage::copy($this->temp_user_picture_storage . $temp_user_picture_name, $storage . $originalImage);
            Storage::copy($this->temp_user_picture_storage . 'crop_' . $temp_user_picture_name, $storage . 'crop_' . $originalImage);
            Storage::copy($this->temp_user_picture_storage . '200.200.' . $temp_user_picture_name, $storage . '200.200.' . $originalImage);
            Storage::copy($this->temp_user_picture_storage . '100.100.' . $temp_user_picture_name, $storage . '100.100.' . $originalImage);
            Storage::copy($this->temp_user_picture_storage . '50.50.' . $temp_user_picture_name, $storage . '50.50.' . $originalImage);

            $user->user_pic = $originalImage;
            $user->user_pic_original = $originalImage;
            $user->user_pic_custom = 1;
            $user->user_pic_filter = Input::get('filter', "");
            $user->save();
        }else{
            $user->user_pic = null;
            $user->user_pic_original = null;
            $user->user_pic_custom = 0;
            $user->user_pic_filter = "";
            $user->save();
        }

        // Send email to user
        Mail::to($user->email)->queue(
            new VerificationUser(
                $user,
                $user->language_prefix,
                'INITIAL',
                ['tmp_password' => $generateRandPass]
            )
        );

        try {
            $userPreference = new Preference();
            $userPreference->user_id = $user['id'];
            $userPreference->save();

            $userAvailability = new Availability();
            $userAvailability->user_id = $user['id'];
            $userAvailability->save();

            $userBasicInfo = new BasicInfo();
            $userBasicInfo->user_id = $user['id'];
            $userBasicInfo->headline = "";
            $userBasicInfo->about = "";
            $userBasicInfo->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }

        $applying_business_id = $request->input("applying_business_id", 0);
        if ($applying_business_id > 0) {
            if ($applying_business = Business::where('id', $applying_business_id)->first()) {
                $candidate = new Candidate;
                $candidate->user_id = $user->id;
                $candidate->business_id = $applying_business->id;

                $location_id = $request->input("applying_location_id", null);
                if($location_id != null && $location_id > 0){
                    $candidate->location_id = $location_id;
                }

                $job_id = $request->input("applying_job_id", null);
                if($job_id != null && $job_id > 0){
                    $candidate->job_id = $job_id;
                }

                $candidate->pipeline = 'new';
                $candidate->save();
                $candidate->status = 1;
                $applying_job = \App\Business\Job::where('id', $candidate->job_id)->first();
                $applying_location = \App\Business\Location::where('id', $candidate->location_id)->first();

                if ($applying_business->admin->user->verification_code) { // BUSINESS NOT CONFIRMED
                    Mail::to($applying_business->admin->user->email)->queue(new \App\Mail\CandidateCreated(
                        $applying_business->admin->user,
                        $applying_business,
                        $user,
                        $applying_job,
                        $applying_location,
                        false,
                        'INITIAL',
                        app()->getLocale()
                    ));
                } else { // BUSINESS CONFIRMED
                    Mail::to($applying_business->admin->user->email)->queue(new \App\Mail\CandidateCreated(
                        $applying_business->admin->user,
                        $applying_business,
                        $user,
                        $applying_job,
                        $applying_location,
                        true,
                        'INITIAL',
                        app()->getLocale()
                    ));
                }
            }
        }

        $token = JWTAuth::fromUser($user);

        if ($token) {
            header("Set-Cookie: api-token=" . $token . "; Domain=" . env('SESSION_DOMAIN') . "; EXPIRES 129600;path=/");
            $user->run_first = 1;
            $user->save();
        }

        $user['token'] = $token;

    	return response(["data" => $user], 200);
    }

    public function setCropperPicture(Request $request){
        $data = array();
        $is_attache_file = false;

        $user_picture_data = $request->input("user_picture_data", null);

        $user_id = $request->input("user_id", null);
        $user = User::where('id', $user_id)->first();

        if ($user_picture_data) {
            try {
                ini_set('memory_limit', '-1');
                $imageCropData = \GuzzleHttp\json_decode(Input::get('cropper_data'));

                $originalImage = $this->temp_user_picture_name;
                $storage = $this->temp_user_picture_storage;
                if ($user){
                    $is_attache_file = true;
                    $fileName = md5('user-resume-pic-' . $user->id);
                    $storage = 'user/' . $user->id . '/resume/';
                    $originalImage = $fileName . '.png';
                }

                //create image crop by user crop area
                $cropImage = Image::make($user_picture_data)->orientate();
                Storage::put($storage . $originalImage, $cropImage->encode("png"));

                $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y)->trim('black', array('top', 'bottom', 'left', 'right'));

                $file_data = (string)$cropImage->encode("png")->resize(200, 200)->encode('data-url');

                Storage::put($storage . 'crop_' . $originalImage, $cropImage->encode("png"));

                //create thumbnail 200x200
                $cropImage->resize(200, 200);
                Storage::put($storage . '200.200.' . $originalImage, $cropImage->encode("png"));

                //create thumbnail 100x100
                $cropImage->resize(100, 100);
                Storage::put($storage . '100.100.' . $originalImage, $cropImage->encode("png"));

                //create thumbnail 50x50
                $cropImage->resize(50, 50);
                Storage::put($storage . '50.50.' . $originalImage, $cropImage->encode("png"));

                if ($user){
                    $user->user_pic = $originalImage;
                    $user->user_pic_original = $originalImage;
                    $user->user_pic_custom = 1;
                    $user->user_pic_filter = Input::get('filter', "");
                    $user->save();
                }

                $data = array(
                    'file_path' => $storage . $originalImage,
                    'file_name' => $originalImage,
                    'file_data' => $file_data
                );

            } catch (Exception $e) {
                return response([
                    'error' => $e->getMessage()
                ], 400);
            }
        }else{
            return response([
                'error' => 'User picture'
            ], 400);
        }
        return response([
            'data' => $data,
            'is_attache_file' => $is_attache_file
        ], 200);
    }

    public function getJobs(Request $request){


        $language_prefix = $request->input('language_prefix', "en");
        $sort_name = $request->input('sort_name', "title");
        $sort = $request->input('sort', "asc");
        $keyword = $request->input('keywords', "");
        $location_id = $request->input('location_id', "");

        app()->setLocale($language_prefix);

        $job_query = Job::query();

        $job_query->join('job_types', 'job_types.key', '=', 'business_jobs.type_key');

        $job_query->select(["business_jobs.*", "job_types.name", "job_types.name_fr"]);

        $job_query->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');

        $job_query->where('business_job_locations.location_id', $location_id);

        if (!empty($keyword)) {
            $keywords = explode(' ', $keyword);
            $job_query->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword){
                    $query->orWhere('business_jobs.title', 'like', '%' . $keyword . '%');
                    $query->orWhere('business_jobs.title_fr', 'like', '%' . $keyword . '%');
                    $query->orWhere('job_types.name', 'like', '%' . $keyword . '%');
                    $query->orWhere('job_types.name_fr', 'like', '%' . $keyword . '%');
                }
            });
        }

        if($sort_name == "title"){
            $job_query->orderBy('business_jobs.title', $sort);
        }else if($sort_name == "created_date"){
            $job_query->orderBy('business_jobs.created_at', $sort);
        }

        return Datatables()->eloquent($job_query->distinct())
            ->filterColumn('name', function ($query, $keyword) {})
            ->editColumn('name', function ($job) {
                return View('scanner.job_item', [
                    'args' => $job,
                    'type_name' => $job->type->getLocalizedNameAttribute(),
                ]);//->render();
            })
            ->rawColumns(['name'])
            ->make(true);
    }
}
