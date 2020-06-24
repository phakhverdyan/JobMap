<?php

namespace App\Http\Controllers\Api;

use App\Business;
use App\Business\Administrator;
use App\Business\Job;
use App\Candidate\History;
use App\Candidate\ResumeRequest;
use App\Candidate\Viewed;
use App\JobCategory;
use App\Mail\SendCandidateData;
use App\Mail\SendInvitationNewUserCandidate;
use App\Rules\CheckValidGeo;
use App\User\Resume\Availability;
use App\User\Resume\BasicInfo;
use App\User\Resume\Preference;
use Carbon\Carbon;
use App\Business\BusinessBilling;
use App\Business\ManagerLocation;
use App\Business\Permit;
use App\Business\Pipeline;
use App\Candidate\Candidate;
use App\Candidate\Note;
use App\Mail\UserNotifications;
use Exception;
use Folklore\GraphQL\Error\ValidationError;
use GraphQL\Error\UserError;
use GraphQL\Type\Definition\Type;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Validator;

class CandidateController extends Controller
{
    public function get(Request $request, $candidate_id)
    {
        $candidate = Candidate::findOrFail($candidate_id);

        $candidate->load([
            'business',
            'user',
            'location',
            'job',
            'user_video',
        ]);

        return response()->resource($candidate);
    }

    // ---------------------------------------------------------------------- //
    //
    // - Messy Code
    //
    // ---------------------------------------------------------------------- //

    private $roles = [];
    private $permissions = [];
    private $BusinessID = null;

    public function sendCandidateData(Request $request)
    {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $this->BusinessID = (int)$request->input('business_id', 0);
        $candidate_id = (int)$request->input('candidate_id', 0);
        $user_id = (int)$request->input('user_id', 0);

        $validator = validator()->make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response([
                'error' => 'validation',
                'validation_fields' => $validator->errors(),
            ], 400);
        }

        $email = $request->input('email', "");
        $User = User::find($user_id);

        Mail::to($email)->queue(new SendCandidateData($User, auth()->user()->language_prefix));

        return response([ 'data' => ["items" => []]], 200);
    }

    public function getCandidateBrandsJobs(Request $request)
    {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $BusinessID = (int)$request->input('business_id', 0);
        $locale = $request->input('locale', "en");
        $brand_id = (int)$request->input('brand_id', 0);
        if($brand_id == 0){
            $brand_id = $BusinessID;
        }

        $data = Job::where('business_jobs.business_id', $brand_id)
            ->orWhereHas('business', function ($query) use ($brand_id)  {
                $query->where('parent_id', $brand_id);
            })
            ->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id')
            ->join('business_locations', 'business_job_locations.location_id', '=', 'business_locations.id')
            ->join('businesses', 'businesses.id', '=', 'business_locations.business_id')
            //->select('business_jobs.*', 'business_locations.business_id as business_locations__business_id', 'businesses.name as business__name')
            ->select(
                'business_jobs.id',
                'business_jobs.title',
                'business_jobs.title_fr',
                'business_locations.id as business_locations_id',
                'business_locations.name as business_locations_name',
                'business_locations.name_fr as business_locations_name_fr',

                'businesses.name as business__name'
            )
            ->distinct()
            ->get();

        return response([ 'data' => ["items" => $data]], 200);
    }

    public function getLocationAppliedTo(Request $request)
    {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $BusinessID = (int)$request->input('business_id', 0);
        $locale = $request->input('locale', "en");
        $brand_id = (int)$request->input('brand_id', 0);
        if($brand_id == 0){
            $brand_id = $BusinessID;
        }

        $Locations = Business\Location::where("business_locations.business_id", $brand_id);

        // Only by current auth locations
        $user_manager = Administrator::where('user_id', auth()->user()->id)->where("business_id", $BusinessID)->first();
        if(!empty($user_manager) && $user_manager->role != Administrator::ADMIN_ROLE){
            $Locations = $Locations->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_locations.id")
                ->where("business_manager_locations.administrator_id", $user_manager['id']);

        }

        $Locations = $Locations->select(
            'business_locations.id',
            'business_locations.name',
            'business_locations.name_fr'
        )
        ->get();

        $_html_option = '<option value="0" readonly="" selected>Select Location applied to</option>';

        if(!empty($Locations)){
            foreach ($Locations as $location){
                $name = $location->name;
                if($locale != "en" && !empty($location->name_fr)){
                    $name = $location->name_fr;
                }
                $_html_option .= '<option value="'.$location->id.'">'.$name.'</option>';
            }
        }

        return response([ 'data' => ["items" => $Locations, "html" => $_html_option]], 200);
    }

    public function getJobAppliedTo(Request $request)
    {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $BusinessID = (int)$request->input('business_id', 0);
        $locale = $request->input('locale', "en");
        $brand_id = (int)$request->input('brand_id', 0);
        if($brand_id == 0){
            $brand_id = $BusinessID;
        }

        $Jobs = Job::where('business_jobs.business_id', $brand_id)
            ->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id')
            ->join('business_locations', 'business_job_locations.location_id', '=', 'business_locations.id')
            ->join('businesses', 'businesses.id', '=', 'business_locations.business_id');

        // Only by current auth locations
        $user_manager = Administrator::where('user_id', auth()->user()->id)->where("business_id", $BusinessID)->first();
        if(!empty($user_manager) && $user_manager->role != Administrator::ADMIN_ROLE){
            $Jobs = $Jobs->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_locations.id")
                ->where("business_manager_locations.administrator_id", $user_manager['id']);

        }

        $Jobs = $Jobs->select(
            'business_jobs.id',
            'business_jobs.title',
            'business_jobs.title_fr'
        )->distinct()->get();

        $_html_option = '<option value="0" readonly="" selected>Select Job applied to</option>';

        if(!empty($Jobs)){
            foreach ($Jobs as $job){
                $name = $job->title;
                if($locale != "en" && !empty($job->title_fr)){
                    $name = $job->title_fr;
                }
                $_html_option .= '<option value="'.$job->id.'">'.$name.'</option>';
            }
        }

        return response([ 'data' => ["items" => $Jobs, "html" => $_html_option]], 200);
    }

    public function createUserImport(Request $request)
    {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $validator = validator()->make($request->all(), [
            'first_name' => ['string'],
            'last_name' => ['string'],
            'email' => 'required|email',
            'phone_country_code' => 'required|string',
            'phone_code' => 'required|string',
            'phone_number' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response([
                'error' => 'validation',
                'validation_fields' => $validator->errors(),
            ], 400);
        }

        $BusinessID = (int)$request->input('business_id', 0);
        $job_id = (int)$request->input('job_id', 0);
        $email = $request->input('email', "");
        $first_name = $request->input('first_name', "");
        $last_name = $request->input('last_name', "");
        $phone_number = $request->input('phone_number', "");
        $phone_code = $request->input('phone_code', "");
        $phone_country_code = $request->input('phone_country_code', "");
        $language_prefix = $request->input('language_prefix', "");
        $pipeline_id = $request->input('pipeline_id', "ats");
        $location_id = (int)$request->input('location_id', 0);
        $city = $request->input('city', "");
        $region = $request->input('region', "");
        $country = $request->input('country', "");
        $country_code = $request->input('country_code', "");

        $brand_id = (int)$request->input('brand_id', 0);
        if($brand_id == 0){
            $brand_id = $BusinessID;
        }

        $Location = null;
        if($location_id == 0){
            $Location = Business\Location::where("business_id", $brand_id)->first();
        }


        DB::beginTransaction();

        $isExistUser = false;

        if ($user = User::where('email',$email)->first()) {
            $isExistUser = true;
        } else {
            $create = [
                "first_name" => $first_name,
                "last_name" => $last_name,
                "email" => $email,
                "phone_number" => $phone_number,
                "phone_code" => $phone_code,
                "phone_country_code" => $phone_country_code,
                "language_prefix" => $language_prefix,
                "city" => $city,
                "region" => $region,
                "country" => $country,
                "country_code" => $country_code,
            ];

            if (empty($first_name) && empty($last_name)) {
                $username = str_random(12);
            } else {
                $username = strtolower($first_name . $last_name);
            }

            $create['username'] = $username;
            $password = str_random(8);
            $create['password'] = bcrypt($password);
            $create['verification_code'] = md5(str_random(32));
            $create['verification_date'] = time();
            $create['show_tooltip'] = 'on';
            $create['is_import'] = 1;
            $create['invite_business_id'] = $brand_id;

            $user = User::create($create);

            if (!$user) {
                return response(['error' => 'create user error'], 500);
            }

            if (Input::hasFile('attach_file')) {
                if (Input::file('attach_file')->isValid()) {
                    try {
                        ini_set('memory_limit', '-1');
                        $inputImage = Input::file('attach_file');
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
                            $errorMessage = $inputImage->getClientSize() . 'byte';
                        }

                    } catch (Exception $e) {

                    }
                }
            }

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

            } catch (\Exception $e) {
                DB::rollback();
                return null;
            }

            $business = Business::find($user->invite_business_id);
            Mail::to($user->email)->queue(new SendInvitationNewUserCandidate($business, $user, $password, 'INITIAL', auth()->user()->language_prefix));
        }

        $candidates =Candidate::where([
            'user_id' => $user->id,
            'business_id' => $brand_id])
            ->get();
        if ($candidates->count() > 0) {
            foreach ($candidates as $candidate) {
                $candidate->pipeline = $pipeline_id;
                if ($job_id) {
                    $candidate->job_id = $job_id;
                }
                if ($location_id) {
                    $candidate->location_id = $location_id;
                }else{
                    if(!$candidate->location_id){
                        $candidate->location_id = $Location ? $Location->id : null;
                    }
                }
                $candidate->save();
            }
        } else {
            $candidate = new Candidate;
            $candidate->user_id = $user->id;
            $candidate->business_id = $brand_id;
            $candidate->job_id = $job_id ? $job_id : null;
            $candidate->location_id = $location_id ? $location_id : ($Location ? $Location->id : null );
            $candidate->pipeline = $pipeline_id;
            $candidate->save();
        }

        Business\Import::where('email', $user->email)->delete();

        DB::commit();

        return response([ 'data' => ["items" => []]], 200);
    }

    public function updateUserImport(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $validator = validator()->make($request->all(), [
            'first_name' => ['string'],
            'last_name' => ['string'],
            'email' => 'required|email',
            'phone_country_code' => 'required|string',
            'phone_code' => 'required|string',
            'phone_number' => 'required|string',
            //'location' => ['required', 'string', new CheckValidGeo()],
        ]);

        if ($validator->fails()) {
            return response([
                'error' => 'validation',
                'validation_fields' => $validator->errors(),
            ], 400);
        }

        $BusinessID = (int)$request->input('business_id', 0);
        $candidate_id = (int)$request->input('candidate_id', 0);
        $job_id = (int)$request->input('job_id', 0);
        $pipeline_id = $request->input('pipeline_id', "ats");
        $email = $request->input('email', "");
        $first_name = $request->input('first_name', "");
        $last_name = $request->input('last_name', "");
        $phone_number = $request->input('phone_number', "");
        $phone_code = $request->input('phone_code', "");
        $phone_country_code = $request->input('phone_country_code', "");
        $language_prefix = $request->input('language_prefix', "");
        $location_id = (int)$request->input('location_id', 0);
        $city = $request->input('city', "");
        $region = $request->input('region', "");
        $country = $request->input('country', "");
        $country_code = $request->input('country_code', "");


        $candidate = Candidate::find($candidate_id);
        $user = $candidate->user;

        $isSendMail = false;
        if ($user->email != $email) {
            $isSendMail =true;
        }

        DB::beginTransaction();

        try {

            if ($isSendMail) {
                $password = str_random(8);
                $user->password = bcrypt($password);
                $user->verification_code = md5(str_random(32));
                $user->verification_date = time();
                Business\Import::where('email', $email)->delete();
            }

            $candidate->pipeline = $pipeline_id;
            $candidate->job_id = $job_id ? $job_id : null;
            $candidate->location_id = $location_id ? $location_id : null;
            $candidate->save();

            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->email = $email;
            $user->phone_number = $phone_number;
            $user->phone_code = $phone_code;
            $user->phone_country_code = $phone_country_code;
            $user->language_prefix = $language_prefix;
            $user->city = $city;
            $user->region = $region;
            $user->country = $country;
            $user->country_code = $country_code;

            if (empty($first_name) && empty($last_name)) {
                $username = str_random(12);
            } else {
                $username = strtolower($first_name . $last_name);
            }

            $user->username = $username;

            if (Input::has('delete_resume')) {
                $deleteResume = Input::get('delete_resume');
                if ($deleteResume) {
                    $user->attach_file = null;
                }
            }

            if (Input::hasFile('attach_file')) {
                if (Input::file('attach_file')->isValid()) {
                    try {
                        ini_set('memory_limit', '-1');
                        $inputImage = Input::file('attach_file');
                        if ($inputImage->getClientSize() < 10000000) {
                            //$ext = $inputImage->getClientOriginalExtension();
                            //$fileName = md5('user-resume-attach-' . $this->auth->id);
                            $fileName = $inputImage->getClientOriginalName();
                            $storage = 'user/' . $user->id . '/resume/';
                            $originalImage = $fileName;// . '.' . $ext;
                            $inputImage->storeAs($storage, $originalImage);

                            $user->attach_file = $originalImage;
                        } else {
                            $errorMessage = $inputImage->getClientSize() . 'byte';
                        }

                    } catch (Exception $e) {

                    }
                }
            }

            $user->save();

        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }

        if ($isSendMail) {
            $business = Business::find($candidate->business_id);
            Mail::to($user->email)->queue(new SendInvitationNewUserCandidate($business, $user, $password, 'INITIAL', auth()->user()->language_prefix));
        }

        DB::commit();

        return response([ 'data' => ["items" => []]], 200);
    }

    public function getDataUserImport(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $BusinessID = (int)$request->input('business_id', 0);
        $candidate_id = (int)$request->input('candidate_id', 0);
        $user_id = (int)$request->input('user_id', 0);
        $brand_id = (int)$request->input('brand_id', 0);
        if($brand_id == 0){
            $brand_id = $BusinessID;
        }

        $Candidate = Candidate::where("candidates.business_id", $brand_id)->where("candidates.id", $candidate_id)
            ->join('users', 'users.id', '=', 'candidates.user_id')
            ->select(
                "candidates.location_id",
                "candidates.job_id",
                "candidates.pipeline",
                "users.first_name",
                "users.last_name",
                "users.email",
                "users.phone_number",
                "users.phone_code",
                "users.phone_country_code",
                "users.city",
                "users.region",
                "users.country",
                "users.country_code"
            )->first();

        return response([ 'data' => ["candidate" => $Candidate]], 200);
    }

    public function updatePipeline(Request $request)
    {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $this->BusinessID = (int)$request->input('business_id', 0);
        $brand_id = (int)$request->input('brand_id', 0);
        $candidate_id = (int)$request->input('candidate_id', 0);
        $user_id = (int)$request->input('user_id', 0);
        $pipeline = $request->input('pipeline', "");

        if($brand_id == 0){
            $brand_id = $this->BusinessID;
        }

        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::BRANCH_ROLE,
            Administrator::FRANCHISE_ROLE
        ];

        //set permissions for this object
        $this->permissions = [
            'candidates'
        ];

        //check permissions
        $this->check();

        $business = Business::where('id', $brand_id)->first();
        $user = User::where('id', $user_id)->first();

        $candidates = Candidate::where([
            'business_id' => $brand_id,
            'user_id' => $user_id
        ])->get();

        if ($candidates->count() > 0) {
            foreach ($candidates as $candidate) {
                $candidate->pipeline = $pipeline;
                $candidate->timestamps = false;
                $candidate->save();
            }

            $history = new History();
            $history->candidate_user_id = $user_id;
            $history->manager_user_id = auth()->user()->id;
            $history->business_id = $brand_id;
            $history->pipeline = $pipeline;
            $history->save();

            Mail::to($user->email)->queue(new \App\Mail\UserMovedInPipeline($user, $business, 'INITIAL', auth()->user()->language_prefix));
        }

        return response([ 'data' => ["items" => []]], 200);
    }

    public function getPipeline(Request $request)
    {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $business_id = (int)$request->input('business_id', 0);
        $brand_id = (int)$request->input('brand_id', 0);
        $keywords = $request->input('keywords', "");
        $filter_by_location_ids = $request->input('filter_by_location', []);

        if($brand_id == 0){
            $brand_id = $business_id;
        }

        $Pipeline = Pipeline::where('business_id', $business_id)->get();

        $PipelineArray = array();

        foreach ($Pipeline as $key => $value){
            $value['localized_name'] = $this->getLocalizedAttribute($value, 'name');
            $value['candidates'] = $this->getCandidatesCount($business_id, $brand_id, $value['id'], $value['type'], $keywords, $filter_by_location_ids);
            $value['waving_candidates'] = $this->getWavingCandidatesCount($business_id, $brand_id, $value['id'], $value['type']);
            $PipelineArray[$key] = $value;
        }

        return response([ 'data' => ["items" => $PipelineArray]], 200);
    }




    public function getResumeRequest(Request $request)
    {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $this->BusinessID = (int)$request->input('business_id', 0);
        $candidate_id = (int)$request->input('candidate_id', 0);
        $user_id = (int)$request->input('user_id', 0);
        $brand_id = (int)$request->input('brand_id', 0);
        if($brand_id == 0){
            $brand_id = $this->BusinessID;
        }

        $ResumeRequests = ResumeRequest::where([
            'user_id' => $user_id,
            'business_id' => $brand_id
        ])->orderBy('updated_at', 'desc')->get()->all();

        foreach ($ResumeRequests as $key=>$item){
            $your_date = strtotime($item['updated_at']->format('Y-m-d H:i:s'));
            $datediff = time() - $your_date;
            $days = round($datediff / (60 * 60 * 24));
            $d = ($days == 0) ? trans('fields.today') : trans('fields.days_ago', ['count' => $days]);
            $ResumeRequests[$key]['date'] = $d;
        }

        return response([ 'data' => ["items" => $ResumeRequests]], 200);
    }

    public function updateResumeRequest(Request $request)
    {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::BRANCH_ROLE
        ];
        //set permissions for this object
        $this->permissions = [
            'candidates'
        ];

        //check permissions
        $this->check();

        $this->BusinessID = (int)$request->input('business_id', 0);
        $candidate_id = (int)$request->input('candidate_id', 0);
        $user_id = (int)$request->input('user_id', 0);
        $id = (int)$request->input('id', 0);
        $brand_id = (int)$request->input('brand_id', 0);
        if($brand_id == 0){
            $brand_id = $this->BusinessID;
        }

        $ResumeRequest = ResumeRequest::where([
            'id' => $id,
            'user_id' => $user_id,
            'business_id' => $brand_id,
            'request' => 1,
            'response' => 0
        ])->first();

        if(!empty($ResumeRequest)){
            $ResumeRequest->response = 1;
            $ResumeRequest->save();

        }else{

            $user = User::where('id', $user_id)->first();
            if(empty($user)){
                return response(['error' => 'No such User!'], 500);
            }

            $business = Business::where('id', $brand_id)->first();

            $ResumeRequest = new ResumeRequest();
            $ResumeRequest->user_id = $user_id;
            $ResumeRequest->business_id = $brand_id;
            $ResumeRequest->request = 1;
            $ResumeRequest->response = 0;
            $ResumeRequest->save();

            Mail::to($user->email)->queue(new \App\Mail\UserUpdateRequest($user, $business, 'INITIAL', auth()->user()->language_prefix));
        }

        $ResumeRequests = ResumeRequest::where([
            'user_id' => $user_id,
            'business_id' => $this->BusinessID
        ])->orderBy('updated_at', 'desc')->get()->all();

        foreach ($ResumeRequests as $key=>$item){
            $your_date = strtotime($item['updated_at']->format('Y-m-d H:i:s'));
            $datediff = time() - $your_date;
            $days = round($datediff / (60 * 60 * 24));
            $d = ($days == 0) ? trans('fields.today') : trans('fields.days_ago', ['count' => $days]);
            $ResumeRequests[$key]['date'] = $d;
        }

        return response([ 'data' => ["items" => $ResumeRequests]], 200);
    }


    public function getCandidateOverview(Request $request)
    {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $this->BusinessID = (int)$request->input('business_id', 0);
        $candidate_id = (int)$request->input('candidate_id', 0);
        $user_id = (int)$request->input('user_id', 0);
        $locale = $request->input('locale', null);
        $brand_id = (int)$request->input('brand_id', 0);
        if($brand_id == 0){
            $brand_id = $this->BusinessID;
        }

        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::BRANCH_ROLE
        ];

        //set permissions for this object
        $this->permissions = [
            'view_candidates'
        ];

        //check permissions
        $this->check();

        $Candidate = Candidate::where([
            'business_id' => $brand_id,
            'id' => $candidate_id,
            'user_id' => $user_id,
        ])->first();

        if(empty($Candidate)){
            return response(['error' => 'No such Candidate!'], 500);
        }

        $viewed = new Viewed();
        $viewed->candidate_user_id = $Candidate['user_id'];
        $viewed->business_id = $Candidate['business_id'];
        $viewed->manager_user_id = auth()->user()->id;
        $viewed->save();

        $download_resume = '';
        if (!($Candidate['user']['preference']['is_complete'] === 1 && $Candidate['user']['availability']['is_complete'] === 1 && $Candidate['user']['basic']['is_complete'] === 1
            && ($Candidate['user']['preference']['not_education'] || $Candidate['user']['education']->count() > 0) && ($Candidate['user']['preference']['first_job'] !== null || $Candidate['user']['experience']->count() > 0))) {
            $download_resume = !empty($Candidate['user']['attach_file']) ? Storage::disk('user_resume')->url('/' . $Candidate['user']['id'] . '/') . $Candidate['user']['attach_file'] . '?v=' . rand(11111, 99999) : '';
        }
        $candidate_import = 0;
        if ($Candidate['user']['invite_business_id'] && !$Candidate['user']['country_code'] && !$Candidate['user']['country']) {
            $candidate_import = 1;
        }

        $overview = $this->overview($Candidate, $download_resume, $candidate_import);

        if (isset($locale)) {
            App::setLocale($locale);
        }

        return response([ 'data' => ["candidate_id" => $Candidate->id, "overview" => $overview, "download_resume" => $download_resume, "candidate_import" => $candidate_import]], 200);
    }

    public function deleteCandidateWave(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $this->BusinessID = (int)$request->input('business_id', 0);
        $candidate_id = (int)$request->input('candidate_id', 0);
        $brand_id = (int)$request->input('brand_id', 0);
        if($brand_id == 0){
            $brand_id = $this->BusinessID;
        }

        if ($candidate_id == 0) {
            return response(['error' => 'Candidate id error'], 500);
        }

        $candidate = Candidate::where('id', $candidate_id)->first();
        if (!$candidate) {
            return response(['error' => 'Candidate not found'], 500);
        }

        $candidate_wave = $candidate->last_wave()->first();

        if (!$candidate_wave || time() - $candidate_wave->created_at->getTimestamp() >= 30 * 86400) {
            return response(['error' => 'There is no active wave now'], 500);
        }

        $candidate_wave->delete();
        $candidate->last_wave_id = 0;
        $candidate->save();

        realtime([
            ['type' => 'User', 'id' => $candidate->user_id],
            ['type' => 'Business', 'id' => $candidate->business_id],
        ])->emit('candidates.wave_was_deleted', [
            'candidate_id' => $candidate->id,
        ]);

        return response([ 'data' => ["wave_count" => 0]], 200);
    }

    public function getCountOnlyWaves(Request $request)
    {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $this->BusinessID = (int)$request->input('business_id', 0);
        $pipeline = $request->input('pipeline', "");
        $brand_id = (int)$request->input('brand_id', 0);
        if($brand_id == 0){
            $brand_id = $this->BusinessID;
        }

        $Candidates = Candidate::query();
        $Candidates->where("c.business_id", $brand_id);
        $Candidates->where("c.pipeline", $pipeline);


        // Only by current auth locations
        $user_manager = Administrator::where('user_id', auth()->user()->id)->where("business_id", $this->BusinessID)->first();
        if(!empty($user_manager) && $user_manager->role != Administrator::ADMIN_ROLE){
            $Candidates = $Candidates->join("business_manager_locations", "business_manager_locations.location_id", "=", "c.location_id")
                ->where("business_manager_locations.administrator_id", $user_manager['id']);

        }

        $Candidates->select([
            'c.*'
        ])->distinct();

        $Candidates->from(DB::raw('candidates c'));

        $Candidates->join('candidate_waves', 'c.last_wave_id', '=', 'candidate_waves.id');
        $Candidates->whereRaw('UNIX_TIMESTAMP(candidate_waves.created_at) + 86400 * 30 > UNIX_TIMESTAMP()');
        $wave_count = $Candidates->distinct()->count();

        return response([ 'data' => ["wave_count" => $wave_count]], 200);
    }

    public function getCandidateTableData(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 400);
        }

        $language_prefix = $request->input('language_prefix', "en");
        app()->setLocale($language_prefix);
        $this->BusinessID = (int)$request->input('business_id', 0);
        $brand_id = (int)$request->input('brand_id', 0);
        $pipeline = null;

        $created = new Carbon(Administrator::where('user_id',auth()->user()->id)
        ->where('business_id',$brand_id != 0 ? $brand_id : $this->BusinessID)
        ->first()
        ->created_at);
        $trial_days = 30 - $created->diff(Carbon::now())->days;

        if($brand_id == 0){
            $brand_id = $this->BusinessID;
        }

        if ($request->input('pipeline')) {
            $pipeline_query = Pipeline::query();
            $pipeline_query->where('business_id', $this->BusinessID);

            $pipeline_query->where(function($query) use ($request) {
                $query->orWhere('id', $request->input('pipeline'));
                $query->orWhere('type', $request->input('pipeline'));
                $query->orWhere('type_new', $request->input('pipeline'));
            });

            $pipeline = $pipeline_query->first();
        }

        $keywords = $request->input('keywords', "");
        $sort = $request->input('sort', "");
        $only_waves = $request->input('only_waves', 0);
        $start = (int)$request->input('start', 0);

        $filter_by_location_ids = $request->input('filter_by_location', []);

        //Storage::put("test.php", json_encode($start));

        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::FRANCHISE_ROLE,
            Administrator::BRANCH_ROLE
        ];

        //check permissions
        $this->check();

        $Candidates = Candidate::query();
        $Candidates->join('users', 'users.id', '=', 'c.user_id');
        $Candidates->where("c.business_id", $brand_id);

        if(!empty($filter_by_location_ids)){
            $Candidates->whereIn("c.location_id", $filter_by_location_ids);
        }

        // Only by current auth locations
        $user_manager = Administrator::where('user_id', auth()->user()->id)->where("business_id", $this->BusinessID)->first();
        if(!empty($user_manager) && $user_manager->role != Administrator::ADMIN_ROLE){
            $Candidates = $Candidates->join("business_manager_locations", "business_manager_locations.location_id", "=", "c.location_id")
                ->where("business_manager_locations.administrator_id", $user_manager['id']);
        }

        $Candidates->from(DB::raw('candidates c'));

        //$sub_query = '(SELECT max(id) FROM candidates WHERE user_id = c.user_id and business_id = ' . $this->BusinessID . ')';
        $sub_query = '(SELECT max(id) FROM candidates WHERE user_id = c.user_id and business_id=' . $brand_id . ')';

        $Candidates->having(DB::raw('c.id'), '=', DB::raw($sub_query));

        $CandidateAccessIds = array();
        $CandidateAccessTag = "";
        $CandidateLocationAccessIds = array();
        $CandidateLocationAccessTag = array();
        if($trial_days <= 0){

            $BusinessBilling = BusinessBilling::where("business_id", $this->BusinessID)
                ->where("user_id", auth()->user()->id)
                ->where("billing_type", "user")->first();
            if(empty($BusinessBilling) || (!empty($BusinessBilling) && $BusinessBilling['subscription_end'] < Carbon::now()->timestamp )){
                $Candidates_list = (clone $Candidates);
                $CandidateAccessIds = $Candidates_list->whereNull("c.source")->orderBy('users.first_name', 'asc')->select('c.*')->skip(0)->take(1)->get()->pluck("id")->toArray();
                $CandidateAccessTag = "free";
            }elseif(!empty($BusinessBilling) && $BusinessBilling['subscription_end'] > Carbon::now()->timestamp){
                $Candidates_list = (clone $Candidates);
                $CandidateAccessIds = $Candidates_list->whereNull("c.source")->orderBy('users.first_name', 'asc')->select('c.*')->get()->pluck("id")->toArray();
                $CandidateAccessTag = "paid";
            }
            // Log::error($Candidates_list->whereNull("c.source")->orderBy('users.first_name', 'asc')->get());
            // Log::error($Candidates_list->whereNull("c.source")->orderBy('users.first_name', 'asc')->toSql());
            // Log::error($Candidates_list->getBindings());
            $LocationCandidates_list = (clone $Candidates);
            $tempLocationIds = $LocationCandidates_list
                ->where("source", "SCANNER")
                ->get()->pluck("location_id")->toArray();

            if(!empty($tempLocationIds)){
                foreach ($tempLocationIds as $item){
                    $Candidates_list_temp = (clone $Candidates);
                    $BusinessBilling = BusinessBilling::where("business_id", $this->BusinessID)
                        ->where("user_paid_id", auth()->user()->id)
                        ->where("location_id", $item)->where("billing_type", "location")->first();
                    if(empty($BusinessBilling) || (!empty($BusinessBilling) && $BusinessBilling['subscription_end'] < Carbon::now()->timestamp )){
                        $tempIds = $Candidates_list_temp
                            ->where("c.source", "SCANNER")
                            ->where("c.location_id", $item)
                            ->orderBy('users.first_name', 'asc')
                            ->skip(0)->take(1)->get()->pluck("id")->toArray();
                        $CandidateLocationAccessIds = array_merge($CandidateLocationAccessIds, $tempIds);
                        $CandidateLocationAccessTag[$item] = "SCANNER free";
                    }elseif(!empty($BusinessBilling) && $BusinessBilling['subscription_end'] > Carbon::now()->timestamp){
                        $tempIds = $Candidates_list_temp
                            ->where("c.source", "SCANNER")
                            ->where("c.location_id", $item)
                            ->orderBy('users.first_name', 'asc')
                            ->get()->pluck("id")->toArray();
                        $CandidateLocationAccessIds = array_merge($CandidateLocationAccessIds, $tempIds);
                        $CandidateLocationAccessTag[$item] = "SCANNER paid";
                    }
                }
            }
        }

        if ($pipeline) {
            $Candidates->where(function($where) use ($pipeline) {
                $where->orWhere('c.pipeline', $pipeline->id);
                $where->orWhere('c.pipeline', $pipeline->type);
                $where->orWhere('c.pipeline', $pipeline->type_new);
            });
        }

        if ($only_waves == 1) {
            $Candidates->join('candidate_waves', 'c.last_wave_id', '=', 'candidate_waves.id');
            $Candidates->whereRaw('UNIX_TIMESTAMP(candidate_waves.created_at) + 86400 * 30 > UNIX_TIMESTAMP()');
        }

        if (!empty($keywords)) {
            $keywords = explode(" ", $keywords);
            $Candidates->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword){
                    $query->orWhere('users.first_name', 'like', '%' . $keyword . '%');
                    $query->orWhere('users.last_name', 'like', '%' . $keyword . '%');
                }
//                $query->orWhere('users.city', 'like', '%' . $keywords . '%');
//                $query->orWhere('users.region', 'like', '%' . $keywords . '%');
//                $query->orWhere('users.country', 'like', '%' . $keywords . '%');
            });
        }

        switch ($sort){
            case "name_asc":
                $Candidates->orderBy('users.first_name', "asc");
                break;
            case "name_desc":
                $Candidates->orderBy('users.first_name', "desc");
                break;
            case "updated_date_asc":
                $Candidates->orderBy('c.updated_at', "asc");
                break;
            case "updated_date_desc":
                $Candidates->orderBy('c.updated_at', "desc");
                break;
            default:
                $Candidates->orderBy('c.updated_at', 'desc');
                break;
        }

        $Candidates->select([
            'c.*'
        ])->distinct();

        // Log::error($Candidates->get());
        ///SCANNER
        return Datatables()->eloquent($Candidates)
            ->filterColumn('name', function ($query, $keyword) {
            })
            ->addColumn('item', function ($Candidate) use($user_manager, $CandidateAccessIds, $CandidateLocationAccessIds, $CandidateAccessTag, $CandidateLocationAccessTag, $trial_days) {

                $access = false;

                $access_tag = "";
                $access_id = "";

                $_user = $Candidate->user;
                $_business = $Candidate->businesse;
                $_location = $Candidate->location;

                if($trial_days <= 0){
                    if(in_array($Candidate['id'], $CandidateAccessIds)){
                        $access = true;
                        $access_tag = $CandidateAccessTag;
                        if ($access_tag == 'free')
                        {
                            $access_id = "limited";
                        }
                    }elseif(in_array($Candidate['id'], $CandidateLocationAccessIds)){
                        $access = true;
                        $access_tag = $CandidateLocationAccessTag[$_location['id']];
                    }else{
                        if($Candidate->source === "SCANNER"){
                            $access_tag = "SCANNER limited";
                            $access_id = "scanner-limited";
                        }else{
                            $access_tag = "limited";
                            $access_id = "limited";
                        }
                    }
                }else{
                    $access = true;
                }


                if (empty($_user['first_name']) && empty($_user['last_name'])) {
                    $fullName = $_user['email'];
                } else {
                    $fullName = $_user['first_name'] . ' ' . $_user['last_name'];
                }

                if ($_user['user_pic']) {
                    $userPicture = Storage::disk('user_resume')->url('/' . $_user['id'] . '/100.100.') . $_user['user_pic'] . '?v=' . rand(11111, 99999);
                } else {
                    $userPicture = asset('img/profilepic2.png');
                }
                $lastBusiness = Administrator::where([
                    'user_id' => $Candidate['user_id']
                ])->orderBy('created_at', 'desc')->limit(1)->first();

//                $picture = false;
//                if ($lastBusiness) {
//                    if ($lastBusiness['business']['picture']) {
//                        $picture = Storage::disk('business')->url('/' . $lastBusiness['business']['id'] . '/50.50.') . $lastBusiness['business']['picture'] . '?v=' . rand(11111, 99999);
//                    } else {
//                        $picture = asset('img/business-logo-small.png');
//                    }
//                }

                $location = $_business['name'];
                if ($Candidate['location_id']) {
                    $location = $_location['name'];
                }

                // Applied to array
                $appliedTo = [];
                $appliedToCountryCode = "";

                // Brand
               // $appliedTo[] = $_business['name'];
                //Log::info($Candidate['location_id']);
                // Location
                if ($Candidate['location_id']) {
                    $address = [];
                    $appliedToCountryCode = $_location['country_code'];
                    if (isset($_location['street'])) {
                        $street = $_location['street'];
                        if (isset($_location['street_number'])) {
                            $street = $_location['street_number'] . ' ' . $street;
                        }
                        $address[] = $street;
                    }
                    if (isset($_location['city'])) {
                        $address[] = $_location['city'];
                    }
                    if (isset($_location['region'])) {
                        $address[] = $_location['region'];
                    }
                    if (isset($_location['country'])) {
                        $address[] = $_location['country'];
                    }
                    $appliedTo[] = implode($address, ', ');
                }

                // Job
                $job_title = trans('fields.general_application');
                $general_application = true;
                if ($Candidate['job_id']) {

                    $job_title = $Candidate->job['title'];

                    if (App::isLocale('fr') && $Candidate->job['title_fr']) {
                        $job_title = $Candidate->job['title_fr'];
                    }

//                    if ($job) {
//                        $appliedTo[] = $job;
//                    }
                    $general_application = false;
                }

                // Combine new name
                $nameAppliedTo = implode($appliedTo, ', ');

                $your_date = strtotime($Candidate['updated_at']);
                $datediff = time() - $your_date;
                $days = round($datediff / (60 * 60 * 24));
                Carbon::setLocale( App::getLocale());
                $dt = Carbon::now();
                $your_date = strtotime($_user['updated_at']);
                $datediff = time() - $your_date;
                $user_days = round($datediff / (60 * 60 * 24));

                $filters = '';
                if (!empty($_user['user_pic_filter'])) {
                    $f = $_user['user_pic_filter'];
                    $filters = ' data-filter="' . $f . '" class="' . $f . '"';
                }

                $city = $_user['city'] . ", ";
                $region = ($_user['city']) ? $_user['region'] . ", " : "";
                $country = ($_user['city']) ? $_user['country'] : "";

                $locationUser = $city . $region . $country;

                $pipelines = Pipeline::where([
                    'business_id' => $Candidate['business_id']
                ])->orderBy('position')->get();

                $current_pipeline = $pipelines->filter(function($pipeline_item) use ($Candidate) {
                    return (
                        $pipeline_item->id == $Candidate['pipeline']
                        ||
                        $pipeline_item->type == $Candidate['pipeline']
                        ||
                        $pipeline_item->type_new == $Candidate['pipeline_item']
                    );
                })->first();

                $queryData = [
                    'candidate_user_id' => $Candidate['user_id'],
                    'business_id' => $Candidate['business_id'],
                ];

                if ($user_manager === Administrator::FRANCHISE_ROLE) {
                    $queryData['manager_user_id'] = auth()->user()->getKey();
                }
                $notes = Note::where($queryData)->get()->all();

                $notes_rating = [
                    'rating' => 0,
                    'class_color' => '',
                ];
                $count_notes = 0;
                foreach ($notes as $note) {
                    if ($note['rating']) {
                        $notes_rating['rating'] += $note['rating'];
                        $count_notes++;
                    }
                }
                if ($notes_rating['rating']) {
                    $notes_rating['rating'] = round($notes_rating['rating'] / $count_notes);
                    if ($notes_rating['rating'] < 5) {
                        $notes_rating['class_color'] = 'text-danger';
                    } elseif ($notes_rating['rating'] < 8) {
                        $notes_rating['class_color'] = 'text-warning';
                    } else {
                        $notes_rating['class_color'] = 'text-success';
                    }
                }

                $candidate_import = 0;
                if ($_user['is_import']) {
                    $candidate_import = 1;
                }

                $view = View('business.auth.graphql.candidate_item_new', [
                    'args' => $Candidate,
                    //'picture' => $picture,
                    'user' => $_user,
                    'user_picture' => $userPicture,
                    'fullName' => $fullName,
                    'location_user' => $locationUser,
                    'location' => $location,
                    'applied_to' => $nameAppliedTo,
                    'applied_to_country_code' => $appliedToCountryCode,
                    'job_title' => $job_title,
                    'general_application' => $general_application,
                    'candidate_import' => $candidate_import,
                    'days' => ($days == 0) ? trans('fields.today') : $dt->subDays($days)->diffForHumans(),
                    'user_days' => ($user_days == 0) ? trans('fields.today') : $dt->subDays($user_days)->diffForHumans(),
                    'filters' => $filters,
                    'pipelines' => $pipelines,
                    'read_only' => ($current_pipeline && $current_pipeline->type_new == 'archived'),
                    'notes_rating' => $notes_rating,
                    'user_video' => $Candidate['user_video']['file_url'],
                    'thumbnail_url' => $Candidate['user_video']['thumbnail_url'],
                    'access' => $access,
                    'access_tag' => $access_tag,
                    'access_id' => $access_id,
                ])->render();
                return $view;
            })
            ->rawColumns(['item'])
            ->make(true);
    }

    private function getCandidatesCount($business_id, $brand_id, $pipelineID, $pipelineType, $keywords = "", $filter_by_location_ids = array()){

        $candidate_query = Candidate::where('candidates.business_id', $brand_id);
        $candidate_query->join('users', 'users.id', '=', 'candidates.user_id');

        if(!empty($filter_by_location_ids)){
            $candidate_query->whereIn("candidates.location_id", $filter_by_location_ids);
        }

        if (!empty($keywords)) {
            $keywords = explode(" ", $keywords);
            $candidate_query->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword){
                    $query->orWhere('users.first_name', 'like', '%' . $keyword . '%');
                    $query->orWhere('users.last_name', 'like', '%' . $keyword . '%');
                }

//                $query->orWhere('users.city', 'like', '%' . $keywords . '%');
//                $query->orWhere('users.region', 'like', '%' . $keywords . '%');
//                $query->orWhere('users.country', 'like', '%' . $keywords . '%');
            });
        }

        // Only by current auth locations
        $user_manager = Administrator::where('user_id', auth()->user()->id)->where("business_id", $business_id)->first();
        if(!empty($user_manager) && $user_manager->role != Administrator::ADMIN_ROLE){
            $candidate_query = $candidate_query->join("business_manager_locations", "business_manager_locations.location_id", "=", "candidates.location_id")
                ->where("business_manager_locations.administrator_id", $user_manager['id']);
        }

        return $candidate_query->where(
            'candidates.pipeline', (!$pipelineType || $pipelineType == 'custom') ? $pipelineID : $pipelineType)
            ->distinct("candidates.user_id")
            ->count('candidates.user_id');
    }

    private function getWavingCandidatesCount($business_id, $brand_id, $pipelineID, $pipelineType){
        $candidate_query = Candidate::query();

        // Only by current auth locations
        $user_manager = Administrator::where('user_id', auth()->user()->id)->where("business_id", $business_id)->first();
        if(!empty($user_manager) && $user_manager->role != Administrator::ADMIN_ROLE){
            $candidate_query = $candidate_query->join("business_manager_locations", "business_manager_locations.location_id", "=", "candidates.location_id")
                ->where("business_manager_locations.administrator_id", $user_manager['id']);
        }

        $candidate_query->join('candidate_waves', 'candidates.last_wave_id', '=', 'candidate_waves.id');
        $candidate_query->where('candidates.last_wave_id', '>', 0);
        $candidate_query->whereRaw('UNIX_TIMESTAMP(candidate_waves.created_at) + 86400 * 30 > UNIX_TIMESTAMP()');

        return $candidate_query->where([
            'pipeline' => (!$pipelineType || $pipelineType == 'custom') ? $pipelineID : $pipelineType,
            'business_id' => $brand_id,
        ])->distinct('candidates.user_id')->count('candidates.user_id');
    }

    private function getLocalizedAttribute($root, $attribute_name)
    {
        $available_locales = config('graphql.available_locales');
        $current_available_locale_index = array_search(\App::getLocale(), $available_locales);

        if ($current_available_locale_index !== false) {
            unset($available_locales[$current_available_locale_index]);
            array_unshift($available_locales, \App::getLocale());
        }

        return array_reduce($available_locales, function($current_value, $current_locale) use ($root, $attribute_name) {
            return $current_value ?: $root[$attribute_name . ($current_locale == 'en' ? '' : '_' . $current_locale)];
        });
    }

    private function check(){

        if (!$business = Business::where('id', $this->BusinessID)->first()) {
            return response(['error' => 'No such business!'], 500);
        }

        $administrator_query = Administrator::query();
        $administrator_query->where('user_id', auth()->user()->id);

        if ($business->parent_id) { // if it is a brand then check main business as well
            $administrator_query->whereIn('business_id', [$business->id, $business->parent_id]);
        } else {
            $administrator_query->where('business_id', $business->id);
        }

        $administrator_query->where(function($where) {
            $where->orWhere('role', \App\Business\Administrator::ADMIN_ROLE);
            $where->orWhereIn('role', $this->roles);
        });

        if ($administrator_query->first()) {
            return true;
        }

        return response(['error' => 'Permission error!'], 500);
    }

    private function overview($Candidate, $download_resume, $candidate_import){
        $picture = asset('img/profilepic2.png');

        if ($Candidate['user']['user_pic_custom'] == 1) {
            $picture = Storage::disk('user_resume')->url('/' . $Candidate['user']['id'] . '/200.200.') . $Candidate['user']['user_pic'] . '?v=' . rand(11111, 99999);
        }

        $street = ($Candidate['user']['street']) ? $Candidate['user']['street'] . ", " : "";
        $city = $Candidate['user']['city'] . ", ";
        $region = ($Candidate['user']['city']) ? $Candidate['user']['region'] . ", " : "";
        $country = ($Candidate['user']['city']) ? $Candidate['user']['country'] : "";
        $location = $street . $city . $region . $country;
        $phone = ($Candidate['user']['mobile_phone']) ?? null;
        $data = [
            'picture' => $picture,
            'location' => $location,
            'phone' => $phone
        ];

        switch ($Candidate['user']['preference']['current_type']) {
            case 1:
                $current_type_name = trans('resume_builder.print.student');
                break;
            case 2:
                $current_type_name = trans('resume_builder.print.professional');
                break;
            default:
                $current_type_name = '';
        }
        switch ($Candidate['user']['preference']['current_job']) {
            case 1:
                $current_job_name = trans('resume_builder.print.employed');
                break;
            case 2:
                $current_job_name = trans('resume_builder.print.unemployed');
                break;
            default:
                $current_job_name = '';
        }
        $interested_jobs_name = '';
        foreach (explode(',',$Candidate['user']['preference']['interested_jobs']) as $item) {
            if ($interested_jobs_name) {
                $interested_jobs_name .= ', ';
            }
            switch ($item) {
                case 1:
                    $interested_jobs_name .= trans('resume_builder.print.specialized');
                    break;
                case 2:
                    $interested_jobs_name .= trans('resume_builder.print.student');
                    break;
                case 3:
                    $interested_jobs_name .= trans('resume_builder.print.professional');
                    break;
                case 4:
                    $interested_jobs_name .= trans('resume_builder.print.specialized');
                    break;
                case 5:
                    $interested_jobs_name .= trans('resume_builder.print.freelance');
                    break;
            }
        }

        $data = array_merge($data, [
            'current_type_name' => $current_type_name,
            'current_job_name' => $current_job_name,
            'interested_jobs_name' => $interested_jobs_name,

        ]);

        if (App::isLocale('fr')) {

            $Candidate['user']['basic']['headline'] = $Candidate['user']['basic']['headline_fr'] ? $Candidate['user']['basic']['headline_fr'] : $Candidate['user']['basic']['headline'];
            $Candidate['user']['basic']['about'] = $Candidate['user']['basic']['about_fr'] ? $Candidate['user']['basic']['about_fr'] : $Candidate['user']['basic']['about'];

            if ($Candidate['user']['preference']['industry']) {
                $Candidate['user']['preference']['industry']['name'] = $Candidate['user']['preference']['industry']['name_fr'];
            }
            if ($Candidate['user']['preference']['sub_industry']) {
                $Candidate['user']['preference']['sub_industry']['name'] = $Candidate['user']['preference']['sub_industry']['name_fr'];
            }
            if ($Candidate['user']['preference']['category']) {
                $Candidate['user']['preference']['category']['name'] = $Candidate['user']['preference']['category']['name_fr'];
            }
            if ($Candidate['user']['preference']['sub_category']) {
                $Candidate['user']['preference']['sub_category']['name'] = $Candidate['user']['preference']['sub_category']['name_fr'];
            }


            foreach ($Candidate['user']['skill'] as $key => $skill) {
                if ($skill['_skill']) {
                    $Candidate['user']['skill'][$key]['title'] = $skill['_skill']['title_fr'];
                }
            }
            foreach ($Candidate['user']['interest'] as $key => $interest) {
                if ($interest['_interest']) {
                    $Candidate['user']['interest'][$key]['title'] = $interest['_interest']['title_fr'];
                }
            }
            foreach ($Candidate['user']['hobby'] as $key => $hobby) {
                if ($hobby['_hobby']) {
                    $Candidate['user']['hobby'][$key]['title'] = $hobby['_hobby']['title_fr'];
                }
            }

            foreach ($Candidate['user']['education'] as $key => $education) {
                if ($education['_degree']) {
                    $Candidate['user']['education'][$key]['degree'] = $education['_degree']->title_fr;
                }
                if ($education['_study']) {
                    $Candidate['user']['education'][$key]['study'] = $education['_study']->title_fr;
                }
                if ($education['_grade']) {
                    $Candidate['user']['education'][$key]['grade'] = $education['_grade']->title_fr;
                }
            }
            foreach ($Candidate['user']['experience'] as $key => $experience) {
                if ($experience['_title']) {
                    $Candidate['user']['experience'][$key]['title'] = $experience['_title']->name_fr;
                }
                if ($experience['_company']) {
                    $Candidate['user']['experience'][$key]['company'] = $experience['_company']->name_fr;
                }
                if ($Candidate['user']['experience'][$key]['industry']) {
                    $Candidate['user']['experience'][$key]['industry']['name'] = $experience['industry']['name_fr'];
                }
                if ($Candidate['user']['experience'][$key]['sub_industry']) {
                    $Candidate['user']['experience'][$key]['sub_industry']['name'] = $experience['sub_industry']['name_fr'];
                }
            }
            foreach ($Candidate['user']['certification'] as $key => $certificate) {
                $Candidate['user']['certification'][$key]['title'] = $certificate['_title']['name_fr'];
            }
        }

        $view = View('business.auth.graphql.overview', [
            'args' => $Candidate['user'],
            'data' => $data,
            'download_resume' => $download_resume,
            'candidate_import' => $candidate_import,
        ])->render();

        return $view;
    }
}
