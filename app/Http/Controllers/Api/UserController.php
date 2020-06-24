<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\BaseCollectionResource;
use App\User;
use App\Candidate\Candidate;

class UserController extends Controller
{
    public function exists(Request $request)
    {
        if ($request->input('user.email')) {
            $user_exists = User::where('email', $request->input('user.email'))->exists();

            return response()->resource($user_exists);
        }

        return response()->resource(false);
    }

    public function index(Request $request, $user_id)
    {
        $user = null;

        if ($user_id == 'me') {
            if (!auth()->check()) {
                abort(403);
            }

            $user = auth()->user();
        } else {
            abort(404);
        }

        if ($user_id == 'me') {
            $user->load([
                'businesses',
                'preference',
            ]);

            $user->preference->transform_yes_no_fields_to_boolean = true;

            foreach ($user->businesses as $business) {
                $business->makeVisible('realtime_token');
            }
        }

        return response()->resource($user->makeVisible([
            'api_token',
            'realtime_token',
        ]));
    }

    public function update(Request $request, $user_id)
    {
        $user = null;

        if ($user_id == 'me') {
            if (!auth()->check()) {
                abort(403);
            }

            $user = auth()->user();
        } else {
            abort(404);
        }

        $validator = validator()->make($request->all(), [
            'user' => 'array',
            'user.first_name' => 'string',
            'user.last_name' => 'string',
            'user.city' => 'required_with:user.region,user.country,user.country_code|string',
            'user.region' => 'required_with:user.city,user.country,user.country_code|string',
            'user.country' => 'required_with:user.city,user.region,user.country_code|string',
            'user.country_code' => 'required_with:user.city,user.region,user.country|string',
            'user.mobile_phone' => 'string',
            'user.phone_country_code' => 'string',
            'user.phone_code' => 'string',
            'user.phone_number' => 'string',
            'user.title' => 'string',
            'user.zip' => 'string',
            'user.suite' => 'string'
        ]);

        if ($validator->fails()) {
            return response([
                'error' => 'Validation',
                'validation_fields' => $validator->errors(),
            ], 400);
        }

        $user->fill($request->input('user', []));

        if ($request->hasFile('user.image')) {
            if ($request->file('user.image')->isValid()) {
                try {
                    ini_set('memory_limit', '-1');
                    $inputImage = $request->file('user.image');

                    if ($inputImage->getClientSize() < 24000000) {
                        $ext = $inputImage->getClientOriginalExtension();
                        $fileName = md5('user-resume-pic-' . $user->id);
                        $storage = 'user/' . $user->id . '/resume/';
                        $originalImage = $fileName . '.' . $ext;
                        //save original image
                        $inputImage->storeAs($storage, $originalImage);

                        //create image crop by user crop area
                        $cropImage = Image::make($inputImage->getRealPath())->orientate();
                        // $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y);
                        Storage::put($storage . 'crop_' . $originalImage, $cropImage->encode());
                        //create thumbnail 200x200
                        $cropImage->resize(200, 200);
                        Storage::put($storage . '200.200.' . $originalImage, $cropImage->encode());
                        //create thumbnail 100x100
                        $cropImage->resize(100, 100);
                        Storage::put($storage . '100.100.' . $originalImage, $cropImage->encode());
                        //create thumbnail 50x50
                        $cropImage->resize(50, 50);
                        Storage::put($storage . '50.50.' . $originalImage, $cropImage->encode());

                        $user['user_pic'] = $originalImage;
                        $user['user_pic_original'] = $originalImage;
                        $user['user_pic_custom'] = 1;
                        $user['user_pic_filter'] = Input::get('filter');
                    }
                } catch (\Exception $e) {
                }
            }
        } elseif ($request->has('user.image')) { // if it is not a file
            $user['user_pic'] = null;
            $user['user_pic_original'] = null;
            $user['user_pic_custom'] = 0;
        }

        if ($request->hasFile('user.resume')) {
            if ($request->file('user.resume')->isValid()) {
                $inputImage = $request->file('user.resume');

                try {
                    ini_set('memory_limit', '-1');
                    $inputImage = $request->file('user.resume');

                    if ($inputImage->getClientSize() < 10000000) {
                        //$ext = $inputImage->getClientOriginalExtension();
                        //$fileName = md5('user-resume-attach-' . $this->auth->id);
                        $fileName = $inputImage->getClientOriginalName();
                        $storage = 'user/' . $user->id . '/resume/';
                        $originalImage = $fileName;// . '.' . $ext;
                        $inputImage->storeAs($storage, $originalImage);
                        $user->attach_file = $originalImage;
                    }
                } catch (\Exception $e) {
                }
            }
        } elseif ($request->has('user.resume')) { // if it is not a file
            $user->attach_file = null;
        }

        $user->save();

        return (new BaseResource($user->makeVisible([
            'api_token',
            'realtime_token',
        ])));
    }

    public function change_password(Request $request, $user_id)
    {
        $user = null;

        if ($user_id == 'me') {
            if (!auth()->check()) {
                abort(403);
            }

            $user = auth()->user();
        } else {
            abort(404);
        }

        $validator = validator()->make($request->all(), [
            'user' => 'required|array',
            'user.current_password' => 'required|string',
            'user.new_password' => 'required|string',
        ])->validate();

        $user->password = bcrypt($request->input('user.new_password'));
        $user->save();

        return response()->resource($user->makeVisible([
            'api_token',
            'realtime_token',
        ]));
    }

    public function applications(Request $request, $user_id)
    {
        if ($user_id == 'me') {
            if (!auth()->check()) {
                abort(403);
            }

            $user = auth()->user();
        } else {
            abort(404);
        }

        $candidate_query = Candidate::selectRaw('candidates.*, business_job_locations.status AS job_location_status');
        $candidate_query->where('user_id', $user->id);

        $candidate_query->rightJoin('business_job_locations', function ($join) {
            $join->on('business_job_locations.location_id', '=', 'candidates.location_id');
            $join->on('business_job_locations.job_id', '=', 'candidates.job_id');
        });

        $candidate_query->with([
            'business',
            'location',
            'job',
        ]);

        $candidates = $candidate_query->paginate(25);

        return (new BaseCollectionResource($candidates));
    }

    public function updateOnEmailSend(Request $request)
    {
        if (!auth()->user()) {
            return response(['error' => 'auth user error'], 500);
        }

        $user_id = (int)$request->input('id', 0);
        $action = $request->input('action', "on");

        $user = User::find($user_id);
        if (!$user) {
            return response(['error' => 'find user error'], 500);
        }

        if ($action == "on") {
            $user->on_email_send = 1;
        } elseif ($action == "off") {
            $user->on_email_send = 0;
        }
        $user->save();

        return response(['data' => []], 200);
    }

}
