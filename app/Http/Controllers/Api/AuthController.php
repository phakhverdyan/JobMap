<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Mail\VerificationUser;
use App\Mail\ResetPassword;
use App\User;
use App\User\Resume\Availability;
use App\User\Resume\BasicInfo;
use App\User\Resume\Preference;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
		validator()->make($request->all(), [
			'user.email' => 'required|string',
			'user.password' => 'required|string',
		])->validate();

		$user_query = User::query();
		$user_query->where('email', $request->input('user.email'));

		if (!$user = $user_query->first()) {
			return response([
				'error' => 'WrongUserCredentials',
			], 400);
		}

		if (!$user->doesPasswordEqual($request->input('user.password'))) {
			return response([
				'error' => 'WrongUserCredentials',
			], 400);
		}

		$user->load([
			'businesses',
			'preference',
		]);

		$user->preference->transform_yes_no_fields_to_boolean = true;

		foreach ($user->businesses as $business) {
			$business->makeVisible('realtime_token');
		}

		return (new BaseResource($user->makeVisible([
			'api_token',
			'realtime_token',
		])));
    }

    public function register(Request $request)
    {
    	validator()->make($request->all(), [
			'user.email' => 'required|string|unique:users,email',
			'user.first_name' => 'required|string',
			'user.last_name' => 'required|string',
			'user.password' => 'required|string|confirmed',
			'user.city' => 'required|string',
			'user.region' => 'required|string',
			'user.country' => 'required|string',
			'user.country_code' => 'required|string',
			'user.phone_country_code' => 'required|string',
			'user.phone_code' => 'required|string',
			'user.phone_number' => 'required|string',
            'user.title'=>'string',
            'user.zip' => 'string',
            'user.suite' => 'string'
		])->validate();

    	DB::beginTransaction();

    	try {
	        $user = new User;
	        $user->fill($request->input('user'));
	        $user->verification_code = md5(str_random(32));
	        $user->verification_date = time();
	        $user->show_tooltip = 'on';
	        $user->username = strtolower($user->first_name . $user->last_name) . rand('1111', '9999');
	        $user->password = Hash::make($user->password);
	        $user->setRelation('businesses', collect());
	        $user->save();

            $userPreference = new Preference;
            $userPreference->user_id = $user->id;
            $userPreference->save();
            $user->setRelation('preference', $userPreference);
            $user->preference->transform_yes_no_fields_to_boolean = true;

            $userAvailability = new Availability;
            $userAvailability->user_id = $user->id;
            $userAvailability->save();

            $userBasicInfo = new BasicInfo;
            $userBasicInfo->user_id = $user->id;
            $userBasicInfo->headline = "";
            $userBasicInfo->about = "";
            $userBasicInfo->save();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            throw $exception;
        }

        Mail::to($user->email)->queue(new VerificationUser($user, app()->getLocale()));

    	return response()->resource($user->makeVisible([
    		'api_token',
    		'realtime_token',
    	]));
    }

    public function reset_password(Request $request)
    {
    	validator()->make($request->all(), [
			'user.email' => 'required|string',
		])->validate();

    	$user = User::where('email', $request->input('user.email'))->first();

        if ($user) {
        	$user->remember_token = md5(str_random(24));
            Mail::to($user->email)->queue(new ResetPassword($user, auth()->user()->language_prefix));
        }

        return [
        	'data' => true,
        ];
    }
}
