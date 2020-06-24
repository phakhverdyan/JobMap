<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\BaseCollectionResource;
use App\Business\Job;
use App\Business\Pipeline;
use App\InterviewRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Mail\VerificationUser;
use App\Rules\CheckValidGeo;
use App\User;
use App\User\Resume\Availability;
use App\User\Resume\BasicInfo;
use App\User\Resume\Preference;
use App\Business;
use App\Business\Location;
use App\Business\JobLocation;
use App\Candidate\Candidate;
use App\Candidate\CandidateWave;
use App\User\UserVideo;
use App\User\UserExpoToken;
use App\ChatMessage;
use Mockery\Exception;

class BusinessController extends Controller
{
    public function create(Request $request)
    {
        return;
    }

    public function get(Request $request, $business_id)
    {
        $business = Business::findOrFail($business_id);

        return response()->resource($business);
    }

    public function getCounts(Request $request, $business_id)
    {
        $business = Business::findOrFail($business_id);
        $result = array();
        $result['location_count'] = Location::where('business_id', $business->id)->get()->count();
        $result['applicants_count'] = Candidate::where('business_id', $business->id)->get()->count();
        $result['jobs_count'] = Job::where('business_id', $business->id)->get()->count();
        $result['interviews_count'] = InterviewRequest::where('business_id', $business->id)->get()->count();
        //$unread_messages_count = ChatInterlocutor::where('business_id', $business->id)->where()->get()->count();
        $chat_message_query = ChatMessage::query();
        $chat_message_query->join('chat_members', 'chat_members.chat_id', '=', 'chat_messages.chat_id');

        $chat_message_query->leftJoin('chat_interlocutors', function($join) use ($business_id) {
            $join->on('chat_interlocutors.chat_id', '=', 'chat_messages.chat_id');
            if ($business_id) {
                $join->on('chat_interlocutors.business_id', '=', DB::raw($business_id));
            }
        });

        if ($business_id) {
            $chat_message_query->where('chat_members.business_id', $business_id);
        }
        $chat_message_query->whereRaw('chat_messages.id > IFNULL(chat_interlocutors.last_read_message_id, 0)');
        $result['count_of_unread_messages'] = $chat_message_query->count();
        return response()->resource($result);

    }

    public function locations(Request $request, $business_id)
    {
        $business = Business::findOrFail($business_id);

        validator()->make($request->all(), [
            'count' => 'nullable|integer',
        ])->validate();

        $count = (int) $request->input('count', 100);
        $count = ($count > 0 && $count <= 100 ? $count : 100);

        $location_query = Location::select('*');
        $location_query->where('business_id', $business->id);
        $location_query->orderBy('id', 'asc');
        $locations = $location_query->paginate($count);

        return response()->resource($locations);
    }

    public function applicants(Request $request, $business_id)
    {
    	$business = Business::findOrFail($business_id);

    	if (!auth()->check()) {
    		abort(403);
    	}

    	auth()->user()->can('control_business', [
    		'business_id' => $business_id,
    	], 403);

        validator()->make($request->all(), [
            'pipeline' => 'string|nullable',
        ])->validate();

        $pipeline = null;

        if ($request->input('pipeline')) {
            $pipeline_query = Pipeline::query();
            $pipeline_query->where('business_id', $business->id);

            $pipeline_query->where(function($query) use ($request) {
                $query->orWhere('id', $request->input('pipeline'));
                $query->orWhere('type', $request->input('pipeline'));
                $query->orWhere('type_new', $request->input('pipeline'));
            });

            $pipeline = $pipeline_query->first();
        }

    	$candidate_query = Candidate::query();
        $candidate_query->from('candidates AS C0');

        $candidate_query->with([
            'location',
            'job',
            'user',
            'user_video',
            // 'user.basic',
            // 'user.education',
            // 'user.experience',
            // 'user.skill',
            // 'user.languages',
            // 'user.certification',
            // 'user.hobby',
            // 'user.interest',
            // 'user.preference',
        ]);

    	$candidate_query->where('business_id', $business->id);
        
        $candidate_query->whereRaw('C0.id = (' .
            'SELECT MAX(id) FROM candidates AS C1 ' .
            'WHERE C0.user_id = C1.user_id AND ' .
            'C0.business_id = C1.business_id AND C0.pipeline = C1.pipeline' .
        ')');

        if ($pipeline) {
            $candidate_query->where(function($where) use ($pipeline) {
                $where->orWhere('pipeline', $pipeline->id);
                $where->orWhere('pipeline', $pipeline->type);
                $where->orWhere('pipeline', $pipeline->type_new);
            });
        }

        $candidate_query->orderBy('id', 'desc');
    	$candidates = $candidate_query->paginate(25);

    	return response()->resource($candidates);
    }

    public function interview_requests(Request $request, $business_id)
    {
        $business = Business::findOrFail($business_id);
        
        if (!auth()->check()) {
            abort(403);
        }

        auth()->user()->can('control_business', [
            'business_id' => $business_id,
        ], 403);

        $interview_request_query = InterviewRequest::query();

        $interview_request_query->with([
            'user',
        ]);

        $interview_request_query->where('business_id', $business->id);
        $interview_requests = $interview_request_query->paginate(25);

        return response()->resource($interview_requests);
    }

    public function jobs(Request $request, $business_id)
    {
        $business = Business::findOrFail($business_id);

        $job_query = Job::query();
        $job_query->where('business_id', $business->id);
        $jobs = $job_query->paginate(25);
        
        return response()->resource($jobs);
    }

    public function job_locations(Request $request, $business_id)
    {
        $business = Business::findOrFail($business_id);

        validator()->make($request->all(), [
            'count' => 'nullable|integer',
        ])->validate();

        $count = (int) $request->input('count', 100);
        $count = ($count > 0 && $count <= 100 ? $count : 100);

        $job_location_query = JobLocation::query();
        $job_location_query->select('business_job_locations.*');

        $job_location_query->selectRaw('(' . collect([
            'SELECT COUNT(*) FROM candidates',
            'WHERE candidates.location_id = business_job_locations.location_id',
            'AND candidates.job_id = business_job_locations.job_id',
        ])->implode(' ') . ') AS count_of_applicants');

        $job_location_query->with([
            'location',
            'job',
            'job.type',
        ]);

        $job_location_query->join('business_jobs', 'business_jobs.id', '=', 'business_job_locations.job_id');
        $job_location_query->where('business_jobs.business_id', $business->id);
        $job_locations = $job_location_query->paginate($count);

        return response()->resource($job_locations);
    }

    public function apply(Request $request, $business_id)
    {
    	$business = Business::where('id', $business_id)->firstOrFail();
    	$job = null;
    	$user_video = null;


		if ($request->input('user.video_id')) {
			$user_video = UserVideo::where('id', $request->input('user.video_id'))->first();
		} else if ($request->input('video_id')) { // for old JM app
			$user_video = UserVideo::where('id', $request->input('video_id'))->first();
		}

    	$validation_rules = [];
		$user = auth()->user();
		$user_was_created = false;

		if ($user) {
			$user->load([
				'businesses',
				'preference',
			]);
		} else  {
			$user = User::where('email', $request->input('user.email'))->with([
				'businesses',
				'preference',
			])->first();

	    	if ($user) {
	    		$validation_rules['user.password'] = [
	    			'required',
	    			'string',

					function ($attribute, $value, $fail) use ($user) {
						if (!$user->doesPasswordEqual($value)) {
							$fail('Please enter a valid password.');
						}
					},
	    		];
	    	} else {
	    		$validation_rules['user.first_name'] = 'required|string';
	    		$validation_rules['user.last_name'] = 'required|string';
	    		$validation_rules['user.mobile_phone'] = 'string|nullable';
	    		$validation_rules['user.phone_country_code'] = 'required_with:user.phone_code,user.phone_number|string';
	    		$validation_rules['user.phone_code'] = 'required_with:user.phone_country_code,user.phone_number|string';
	    		$validation_rules['user.phone_number'] = 'required_with:user.phone_country_code,user.phone_code|string';
	    		$validation_rules['user.city'] = 'required|string';
	    		$validation_rules['user.region'] = 'required|string';
	    		$validation_rules['user.country'] = 'required|string';
	    		$validation_rules['user.country_code'] = 'required|string';
	    		$validation_rules['user.language_prefix'] = 'string|nullable';
	    		$validation_rules['user.image'] = 'file';
	    		$validation_rules['user.resume'] = 'file|nullable';
	    		$validation_rules['user.expo_token'] = 'string|nullable';
	    	}

	    	validator()->make($request->all(), $validation_rules)->validate();

			// ------------------------------------------------------------------ //

	    	if (!$user) {
	    		DB::beginTransaction();

	    		try {
		    		$user_autogenerated_password = str_random(8);
		    		$user = new User;
		    		$user->fill($request->input('user'));
		    		$user->password = bcrypt($user_autogenerated_password);
		    		$user->language_prefix = $request->input('user.language_prefix', 'en');
					$user->verification_code = md5(str_random(32));
					$user->verification_date = time();
					$user->show_tooltip = 'on';
					$user->type = 'student';
					$user->username = strtolower($user->first_name . $user->last_name) . rand('1111', '9999');
			    	$user->save();

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
			                        $user->save();
			                    }
			                } catch (\Exception $e) {}
			            }
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
			                        $user->save();
			                    }
			                } catch (\Exception $e) {}
			            }
			        }

		    		$user_preference = new Preference;
			        $user_preference->user_id = $user->id;
			        $user_preference->save();
			        $user->setRelation('preference', $user_preference);

			        $user_availability = new Availability;
			        $user_availability->user_id = $user->id;
			        $user_availability->save();

			        $user_basic_info = new BasicInfo;
			        $user_basic_info->user_id = $user->id;
			        $user_basic_info->headline = '';
			        $user_basic_info->about = '';
			        $user_basic_info->save();

			        $user->setRelation('businesses', collect());
			    } catch (\Exception $exception) {
		            DB::rollback();
		            throw $exception;
		        }

		        DB::commit();
	            $user_was_created = true;

	    		Mail::to($user->email)->queue(new VerificationUser(
	                $user,
                    app()->getLocale(),
	                'INITIAL',
	                ['tmp_password' => $user_autogenerated_password]
	            ));
	    	}

	    	if ($request->input('user.expo_token')) {
		    	if (!$user->expo_tokens()->where('value', $request->input('user.expo_token'))->first()) {
		        	$user_expo_token = new UserExpoToken;
		        	$user_expo_token->user_id = $user->id;
		        	$user_expo_token->value = $request->input('user.expo_token');
		        	$user_expo_token->save();
		    	}
		    }
		}

		$user->preference->transform_yes_no_fields_to_boolean = true;

    	// ---------------------------------------------------------------------- //

    	$candidate_query = Candidate::query();
    	$candidate_query->where('user_id', $user->id);
    	$candidate_query->where('business_id', $business->id);
    	$candidate_query->where('job_id', $job->id);

    	if (!$candidate = $candidate_query->first()) {
    		$candidate = new Candidate;
    		$candidate->user_id = $user->id;
	        $candidate->business_id = $business->id;
	        $candidate->location_id = null;
	        $candidate->job_id = null;
	        $candidate->pipeline = 'new';
	        $candidate->user_video_id = $user_video->id ?? null;
	        $candidate->source = $request->input('source');
	        $candidate->save();
    	}

        if ($business->admin->user->verification_code) { // BUSINESS NOT CONFIRMED
            Mail::to($business->admin->user->email)->queue(new \App\Mail\CandidateCreated(
                $business->admin->user,
                $business,
                $user,
                null,
                null,
                false,
                'INITIAL',
                app()->getLocale()
            ));
        } else { // BUSINESS CONFIRMED
            Mail::to($business->admin->user->email)->queue(new \App\Mail\CandidateCreated(
                $business->admin->user,
                $business,
                $user,
                null,
                null,
                true,
                'INITIAL',
                app()->getLocale()
            ));
        }

    	// ---------------------------------------------------------------------- //

    	return response()->resource([
			'user' => $user->makeVisible([
				'api_token',
				'realtime_token',
			]),

			'user_was_created' => $user_was_created,
    	]);
    }

    public function createBrand(Request $request, $business_id)
    {
        $parent_business = Business::where([
            'id' => $business_id
        ])->get();
        if(count($parent_business) > 0)
        {
            $parent_business = $parent_business[0];
        }
        else{
            return response()->resource(['error'=>'Business not found']);

        }
        $business = new Business;

        $business->slug = $request->input('name');
        $business->name = $request->input('name');
        $business->franchaise = in_array($request->input('franchaise'), ['yes', '1', 'true', 1, true], true) ? true : false;
        $business->small_business = in_array($request->input('small_business'), ['yes', '1', 'true', 1, true], true) ? true : false;
        $business->description = $request->input('name');
        $business->parent_id = $business_id;
        $business->size_id = $parent_business->size_id;
        $business->street = $parent_business->street;
        $business->street_number = $parent_business->street_number;
        $business->suite = $parent_business->suite;
        $business->latitude = $parent_business->latitude;
        $business->longitude = $parent_business->longitude;
        $business->picture = '';

        $business->save();


        if (strlen(Input::file('logo')) && strlen(Input::get('logo_data'))) {
            try {
                ini_set('memory_limit', '-1');
                $image = Input::file('logo');
                // $image = substr($image, strpos($image, ",")+1);
                $fileName = md5('business-picture-' . $business->id);
                $storage = 'business/' . $business->id . '/logo/';
                $originalImage = $fileName . '.png';

                Storage::makeDirectory($storage, 0775, true, true);
                $image = Image::make($image)->orientate()->encode('png');
                $image->save(Storage::path($storage . $originalImage));
                //Image::make(file_get_contents($image))->save($storage . $originalImage);

                //$success = file_put_contents($storage . 'crop_' . $originalImage, $image);
                // $success = file_put_contents($storage . $originalImage, $image);

                $imageCropData = \GuzzleHttp\json_decode(Input::get('logo_data'));
                $storage = 'business/' . $business->id . '/logo/';
                //create image crop by user crop area
                $cropImage = Image::make(Storage::get($storage . $originalImage))->encode('png');
                $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y);
                //$encode = $cropImage->encode();
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

                Business::where([
                    'id' => $business->id
                ])->update([
                    'picture' => $originalImage
                ]);

            } catch (Exception $e) {

            }
        }

        $business =  Business::where([
            'id' => $business->id
        ])->get();

        return response()->resource($business);
    }

    public function updateBrand(Request $request, $business_id)
    {
        $brand_business = Business::where([
            'id' => $business_id
        ])->get();
        if(count($brand_business) > 0)
        {
            $brand_business = $brand_business[0];
        }
        else{
            return response()->resource(['error'=>'Business not found']);

        }
        $business = $brand_business;

        $business->slug = $request->input('name');
        $business->name = $request->input('name');
        $business->franchaise = in_array($request->input('franchaise'), ['yes', '1', 'true', 1, true], true) ? true : false;
        $business->small_business = in_array($request->input('small_business'), ['yes', '1', 'true', 1, true], true) ? true : false;
        $business->description = $request->input('name');
        $business->picture = '';

        $business->save();


        if (strlen(Input::file('logo')) && strlen(Input::get('logo_data'))) {
            try {
                ini_set('memory_limit', '-1');
                $image = Input::file('logo');
                // $image = substr($image, strpos($image, ",")+1);
                $fileName = md5('business-picture-' . $business->id);
                $storage = 'business/' . $business->id . '/logo/';
                $originalImage = $fileName . '.png';

                Storage::makeDirectory($storage, 0775, true, true);
                $image = Image::make($image)->orientate()->encode('png');
                $image->save(Storage::path($storage . $originalImage));
                //Image::make(file_get_contents($image))->save($storage . $originalImage);

                //$success = file_put_contents($storage . 'crop_' . $originalImage, $image);
                // $success = file_put_contents($storage . $originalImage, $image);

                $imageCropData = \GuzzleHttp\json_decode(Input::get('logo_data'));
                $storage = 'business/' . $business->id . '/logo/';
                //create image crop by user crop area
                $cropImage = Image::make(Storage::get($storage . $originalImage))->encode('png');
                $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y);
                //$encode = $cropImage->encode();
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

                Business::where([
                    'id' => $business->id
                ])->update([
                    'picture' => $originalImage
                ]);

            } catch (Exception $e) {

            }
        }

        $business =  Business::where([
            'id' => $business->id
        ])->get();

        return response()->resource($business);
    }

    public function deleteBusiness(Request $request, $business_id)
    {
        Business::where([
            'id' => $business_id
        ])->delete();

        return response()->resource(['success'=>'true']);
    }
}

