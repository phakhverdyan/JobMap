<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\BaseCollectionResource;

class UserPreferenceController extends Controller
{
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

        $user->load('preference');
        $user->preference->transform_yes_no_fields_to_boolean = true;

        $validator = validator()->make($request->all(), [
            'user_preference' => 'required|array',
            'user_preference.looking_job' => 'string|in:yes,no,1,0,true,false',
            'user_preference.new_job' => 'string|in:yes,no,1,0,true,false',
            'user_preference.new_opportunities' => 'string|in:yes,no,1,0,true,false',
            'user_preference.its_urgent' => 'string|in:yes,no,1,0,true,false',
            'user_preference.receive_push_notifications' => 'string|in:yes,no,1,0,true,false',
        ]);
        
        if ($validator->fails()) {
            return response([
                'error' => 'Validation',
                'validation_fields' => $validator->errors(),
            ], 400);
        }

        $user->preference->fill($request->input('user_preference'));
        $user->preference->save();

        return (new BaseResource($user->preference));
    }
}
