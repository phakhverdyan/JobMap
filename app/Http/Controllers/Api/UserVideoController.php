<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\BaseCollectionResource;
use App\User;
use App\User\UserVideo;

class UserVideoController extends Controller
{
    public function list(Request $request, $user_id)
    {
    	$user = ($user_id == 'me') ? auth()->user() : User::where('id', $user_id)->firstOrFail();
    	$user_video_query = UserVideo::query();
    	$user_video_query->where('user_id', $user->id);
    	$user_videos = $user_video_query->paginate(25);

    	return new BaseCollectionResource($user_videos);
    }

    public function exists(Request $request, $user_id)
    {
    	$user = ($user_id == 'me') ? auth()->user() : User::where('id', $user_id)->firstOrFail();

    	$validator = validator()->make($request->input(), [
            'user_video.file_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => 'Validation',
                'validation_fields' => $validator->errors(),
            ], 400);
        }

    	$user_video_query = UserVideo::query();
    	$user_video_query->where('user_id', $user->id);
    	$user_video_query->where('file_name', $request->input('user_video.file_name'));
    	$user_video = $user_video_query->first();

    	return [
    		'data' => ($user_video ? true : false),
    	];
    }

    public function create(Request $request, $user_id)
    {
    	$user = ($user_id == 'me') ? auth()->user() : User::where('id', $user_id)->firstOrFail();

    	$validator = validator()->make($request->all(), [
            'user_video' => 'array',
            'user_video.title' => 'nullable|string',
            
            'user_video.file' => [
            	'required',
            	'file',
            	'mimes:flv,mp4,m3u8,ts,3gp,mov,avi,wmv,ogg,qt',
            ],
        ]);
        
        if ($validator->fails()) {
            return response([
                'error' => 'Validation',
                'validation_fields' => $validator->errors(),
            ], 400);
        }

        $user_video_file_name = $request->file('user_video.file')->getClientOriginalName();

        $user_video_query = UserVideo::query();
        $user_video_query->where('user_id', $user->id);
        $user_video_query->where('file_name', $user_video_file_name);

        if ($user_video = $user_video_query->first()) {
        	return (new BaseResource($user_video))->additional([
        		'meta' => [
        			'this_video_alredy_exists' => true,
        		],
        	]);
        }

        DB::beginTransaction();
        $user_video = new UserVideo;
        $user_video->user_id = $user->id;
        $user_video->fill($request->input('user_video', []));
        $user_video->file_name = $user_video_file_name;
        $user_video->save();

        try {
        	$request->file('user_video.file')->storeAs($user_video->directory_path, $user_video->internal_file_name, [
        		'disk' => 'uploads',
        	]);
        } catch (\Exception $exception) {
        	DB::rollback();
        	throw $exception;
        }

        try {
	        $user_video->makeThumbnail();
	    } catch (\Exception $exception) {
        	DB::rollback();
        	throw $exception;
        }

        DB::commit();
        
    	return (new BaseResource($user_video))->additional([
    		'meta' => [
    			'this_video_alredy_exists' => false,
    		],
    	]);
    }

    public function update(Request $request, $user_id, $video_id)
    {
        $user = ($user_id == 'me') ? auth()->user() : User::where('id', $user_id)->firstOrFail();

        $user_video_query = UserVideo::query();
        $user_video_query->where('user_id', $user->id);
        $user_video_query->where('id', $video_id);
        $user_video = $user_video_query->firstOrFail();

        $validator = validator()->make($request->all(), [
            'user_video' => 'array',
            'user_video.title' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return response([
                'error' => 'Validation',
                'validation_fields' => $validator->errors(),
            ], 400);
        }

        $user_video->fill($request->input('user_video', []));
        $user_video->save();

        return (new BaseResource($user_video));
    }

    public function delete(Request $request, $user_id, $video_id)
    {
    	$user = ($user_id == 'me') ? auth()->user() : User::where('id', $user_id)->firstOrFail();

    	$user_video_query = UserVideo::query();
    	$user_video_query->where('user_id', $user->id);
    	$user_video_query->where('id', $video_id);
    	$user_video = $user_video_query->firstOrFail();
    	$user_video->delete();

    	Storage::disk('uploads')->delete($user_video->directory_path . '/' . $user_video->internal_file_name);
    	Storage::disk('uploads')->delete($user_video->directory_path . '/' . pathinfo($user_video->internal_file_name)['filename'] . '.jpg');

    	return [
    		'data' => true,
    	];
    }
}
