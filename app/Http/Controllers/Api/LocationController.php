<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\BaseCollectionResource;
use App\Mail\VerificationUser;
use App\Rules\CheckValidGeo;
use App\User;
use App\User\Resume\Availability;
use App\User\Resume\BasicInfo;
use App\User\Resume\Preference;
use App\Business;
use App\Business\Job;
use App\Business\Location;
use App\Business\JobLocation;
use App\Candidate\Candidate;
use App\Candidate\CandidateWave;
use App\User\UserVideo;
use App\User\UserExpoToken;

class LocationController extends Controller
{
	public function list(Request $request)
	{
		validator()->make($request->all(), [
			'latitude' => [
				'numeric',
				'required_with:longitude',
				'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/',
			],

			'longitude' => [
				'numeric',
				'required_with:latitude',
				'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/',
			],

			'radius' => 'numeric|min:0.01',
			'count' => 'nullable|integer|max:1000',
			'after_modification_stamp' => 'numeric|nullable',
			'query' => 'nullable|string',
		])->validate();

		// ---------------------------------------------------------------------- //

		$page = (int) $request->input('page', 1);
		$page = max($page, 1);
		$count = (int) $request->input('count', 0);
		$count = max(10, $count);
		$count = min(1000, $count);
		$after_modification_stamp = (float) $request->input('after_modification_stamp', '0.0');
		$latitude = (float) $request->input('latitude', 0.0);
		$longitude = (float) $request->input('longitude', 0.0);
		$radius = (float) $request->input('radius', 0.0);
		$has_geolocation = $request->has('latitude') && $request->has('longitude');
		$search_query = trim($request->input('query', ''));
		$search_query_parts = preg_split('/[.,\s]+/', $search_query);

		// ---------------------------------------------------------------------- //

		$location_query = Location::select('*');
		$location_jobs_subquery = DB::table('business_job_locations');
		$location_jobs_subquery->selectRaw('COUNT(*)');
		$location_jobs_subquery->whereRaw('location_id = business_locations.id');

		if ($search_query) {
			$location_jobs_subquery->join('business_jobs', 'business_jobs.id', '=', 'business_job_locations.job_id');

			$location_jobs_subquery->where(function ($where) use ($search_query_parts) {
				foreach ($search_query_parts as $search_query_part) {
					$where->where(function ($where) use ($search_query_part) {
						$where->orWhere('business_jobs.title', 'like', '%' . $search_query_part . '%');
						$where->orWhere('business_jobs.title_fr', 'like', '%' . $search_query_part . '%');
						$where->orWhere('business_jobs.description', 'like', '%' . $search_query_part . '%');
						$where->orWhere('business_jobs.description_fr', 'like', '%' . $search_query_part . '%');
					});
				}
			});
		}

		$location_query->selectRaw('(' . $location_jobs_subquery->toSql() . ') AS count_of_jobs');
		$location_query->mergeBindings($location_jobs_subquery);

		if ($search_query) {
			$location_query->having('count_of_jobs', '>', 0);
		}

		if ($has_geolocation) {
			$location_query->selectRaw("(" .
				"6371 * 1000 * acos(" .
					"cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) " .
					"+ " .
					"sin(radians($latitude)) * sin(radians(latitude))" .
				")" .
			") AS distance");

			if ($radius > 0) {
				$location_query->whereRaw("(" .
					"6371 * 1000 * acos(" .
						"cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) " .
						"+ " .
						"sin(radians($latitude)) * sin(radians(latitude))" .
					")" .
				") <= ?", [$radius]);
			}
		}

		$total_count_of_locations_query = DB::table(DB::raw('(' . $location_query->toSql() . ') DT0'));
		$total_count_of_locations_query->mergeBindings($location_query->getQuery());
		$total_count_of_locations = $total_count_of_locations_query->count();

		// ---------------------------------------------------------------------- //

		$job_location_query = JobLocation::query();
		$job_location_query->join('business_locations AS BL', 'BL.id', '=', 'business_job_locations.location_id');

		if ($search_query) {
			$job_location_query->join('business_jobs AS BJ', 'BJ.id', '=', 'business_job_locations.job_id');
			
			$job_location_query->where(function ($where) use ($search_query_parts) {
				foreach ($search_query_parts as $search_query_part) {
					$where->where(function ($where) use ($search_query_part) {
						$where->orWhere('BJ.title', 'like', '%' . $search_query_part . '%');
						$where->orWhere('BJ.title_fr', 'like', '%' . $search_query_part . '%');
						$where->orWhere('BJ.description', 'like', '%' . $search_query_part . '%');
						$where->orWhere('BJ.description_fr', 'like', '%' . $search_query_part . '%');
					});
				}
			});
		}

		if ($has_geolocation && $radius > 0) {
			$job_location_query->whereRaw("(" .
				"6371 * 1000 * acos(" .
					"cos(radians($latitude)) * cos(radians(BL.latitude)) * cos(radians(BL.longitude) - radians($longitude)) " .
					"+ " .
					"sin(radians($latitude)) * sin(radians(BL.latitude))" .
				")" .
			") <= ?", [$radius]);
		}

		$total_count_of_jobs = $job_location_query->count();

		// ---------------------------------------------------------------------- //

		$location_query->with([
    		'business' => function ($query) {
    			$query->select([
    				'id',
    				'name',
    				'name_fr',
    				'slug',
                    'picture',
    			]);
    		},
    	]);

		// ---------------------------------------------------------------------- //

		$pagination = null;

		if ($has_geolocation) {
			$location_query->orderBy('distance', 'asc');
			$locations = $location_query->offset(($page - 1) * $count)->take($count)->get();

			$pagination = [
				'current_page' => $page,
				'last_page' => ceil($total_count_of_locations / $count),
				'per_page' => $count,
				'count' => $locations->count(),
				'total' => $total_count_of_locations,
			];
		} else {
			if ($after_modification_stamp > 0) {
				$location_query->where('modification_stamp', '>', $after_modification_stamp);
			}

			$location_query->orderBy('modification_stamp', 'asc');
			$locations = $location_query->take($count)->get();
		}

		// ---------------------------------------------------------------------- //

		return response()->resource($locations, [
			'meta' => [
				'total_count_of_locations' => $total_count_of_locations,
				'total_count_of_jobs' => $total_count_of_jobs,
			],

			'pagination' => $pagination,
		]);
	}

    public function get($location_id)
    {
    	$user = auth()->user();
    	$location = Location::where('id', $location_id)->firstOrFail();
    	$business = Business::where('id', $location->business_id)->firstOrFail();

    	$candidate = null;
    	$was_applied_by_me = null;
    	$was_waved_by_me = null;
    	$my_last_wave_was_at = null;

    	if ($user) {
	    	$candidate_query = Candidate::query();
	    	$candidate_query->where('user_id', $user->id);
	    	$candidate_query->where('business_id', $business->id);
	    	$candidate_query->where('location_id', $location->id);
	    	$candidate = $candidate_query->with('last_wave')->first();
	    	$was_applied_by_me = $candidate ? true : false;
	    	$was_waved_by_me = $candidate && $candidate->last_wave ? true : false;

	    	if ($candidate && $candidate->last_wave) {
	    		$my_last_wave_was_at = $candidate->last_wave->created_at->format(\DateTime::ATOM);
	    	}
	    }

    	$location->load([
    		'business',
    		'departments',
    		'jobs',
    		'jobs.job',
    	]);

    	$location->was_applied_by_me = $was_applied_by_me;
    	$location->was_waved_by_me = $was_waved_by_me;
    	$location->my_last_wave_was_at = $my_last_wave_was_at;

    	return response()->resource($location);
    }

    public function apply(Request $request, $location_id)
    {
    	$location = Location::where('id', $location_id)->firstOrFail();
    	$business = Business::where('id', $location->business_id)->firstOrFail();
    	$job = null;
    	$user_video = null;

    	if ($request->input('job_id')) {
    		$job = Job::where('id', $request->input('job_id'))->first();
    	}

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
					$user->username = substr(md5($user->email), mt_rand(0, 8), 14);
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
    	$candidate_query->where('location_id', $location->id);
    	$candidate_query->where('job_id', $job->id ?? null);

    	if (!$candidate = $candidate_query->first()) {
    		$candidate = new Candidate;
    		$candidate->user_id = $user->id;
	        $candidate->business_id = $business->id;
	        $candidate->location_id = $location->id;
	        $candidate->job_id = $job->id ?? null;
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
                $location,
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
                $location,
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

    public function wave(Request $request, $location_id)
    {
    	$location = Location::where('id', $location_id)->firstOrFail();
    	$business = Business::where('id', $location->business_id)->firstOrFail();
    	$user = auth()->user();
    	$job = null;

    	if ($request->input('job_id')) {
    		$job = Job::where('id', $request->input('job_id'))->first();
    	}

    	$candidate_query = Candidate::query();
    	$candidate_query->where('user_id', $user->id);
    	$candidate_query->where('business_id', $business->id);
    	$candidate_query->where('location_id', $location->id);
    	$candidate_query->where('job_id', $job->id ?? null);
    	$candidate = $candidate_query->firstOrFail();

    	$candidate_wave = $candidate->last_wave()->first();

        if ($candidate_wave && time() - $candidate_wave->created_at->getTimestamp() < 30 * 86400) {
            return response()->resource($candidate_wave);
        }

        $candidate_wave = new CandidateWave;
        $candidate_wave->candidate_id = $candidate->id;
        $candidate_wave->save();
        $candidate->last_wave_id = $candidate_wave->id;
        $candidate->save();

        realtime([
            ['type' => 'User', 'id' => $candidate->user_id],
            ['type' => 'Business', 'id' => $candidate->business_id],
        ])->emit('candidates.wave_was_created', [
            'candidate_id' => $candidate->id,
            'candidate_wave_id' => $candidate_wave->id,
        ]);

        return response()->resource($candidate_wave);
    }
}
