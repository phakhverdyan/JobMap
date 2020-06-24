<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Business\Job;
use App\Business\Location;
use App\Business\JobLocation;

class JobLocationController extends Controller
{
	public function get(Request $request, $job_location_id)
	{
		$job_location_query = JobLocation::query();
		$job_location_query->select('business_job_locations.*');

		$job_location_query->selectRaw('(' . collect([
			'SELECT COUNT(*) FROM candidates',
			'WHERE candidates.location_id = business_job_locations.location_id',
			'AND candidates.job_id = business_job_locations.job_id',
		])->implode(' ') . ') AS count_of_applicants');

		$job_location = $job_location_query->findOrFail($job_location_id);

		$job_location->load([
			'location',
			'job',
			'job.business',
			'job.type',
		]);

		return response()->resource($job_location);
	}

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

			'radius' => 'nullable|numeric|min:0.01',
			'count' => 'nullable|integer|max:1000',
			'query' => 'nullable|string',
		])->validate();

		// ---------------------------------------------------------------------- //

		$count = (int) $request->input('count', 0);
		$count = ($count > 0 && $count <= 100 ? $count : 10);
		$latitude = (float) $request->input('latitude', 0.0);
		$longitude = (float) $request->input('longitude', 0.0);
		$radius = (float) $request->input('radius', 0.0);
		$has_geolocation = $request->has('latitude') && $request->has('longitude');
		$search_query = trim($request->input('query', ''));
		$search_query_parts = preg_split('/[.,\s]+/', $search_query);

		// ---------------------------------------------------------------------- //

		$location_query = Location::query();
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

		if ($has_geolocation && $radius > 0) {
			$location_query->whereRaw("(" .
				"6371 * 1000 * acos(" .
					"cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) " .
					"+ " .
					"sin(radians($latitude)) * sin(radians(latitude))" .
				")" .
			") <= ?", [$radius]);
		}

		$total_count_of_locations_query = DB::table(DB::raw('(' . $location_query->toSql() . ') DT0'));
		$total_count_of_locations_query->mergeBindings($location_query->getQuery());
		$total_count_of_locations = $total_count_of_locations_query->count();

		// ---------------------------------------------------------------------- //

		$job_location_query = JobLocation::select('business_job_locations.*');

		if ($has_geolocation) {
			$job_location_query->selectRaw("(" .
				"6371 * 1000 * acos(" .
					"cos(radians($latitude)) * cos(radians(BL.latitude)) * cos(radians(BL.longitude) - radians($longitude)) " .
					"+ " .
					"sin(radians($latitude)) * sin(radians(BL.latitude))" .
				")" .
			") AS distance");

			$job_location_query->join('business_locations AS BL', 'business_job_locations.location_id', '=', 'BL.id');

			if ($radius > 0) {
				$job_location_query->whereRaw("(" .
					"6371 * 1000 * acos(" .
						"cos(radians($latitude)) * cos(radians(BL.latitude)) * cos(radians(BL.longitude) - radians($longitude)) " .
						"+ " .
						"sin(radians($latitude)) * sin(radians(BL.latitude))" .
					")" .
				") <= ?", [$radius]);
			}
		}

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

		$total_count_of_jobs = (clone $job_location_query)->count();

		// ---------------------------------------------------------------------- //

		$job_location_query->with([
			'job',
			'location',
			'job.type',

    		'job.business' => function ($query) {
    			$query->select([
    				'id',
    				'name',
    				'name_fr',
    				'slug',
                    'picture',
    			]);
    		},

    		'location.business' => function ($query) {
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

		if ($has_geolocation) {
			$job_location_query->orderBy('distance', 'asc');
		}

		$job_locations = $job_location_query->paginate($count);

		// [!] temporary fix for job_location business

		foreach ($job_locations as $job_location) {
			$job_location->job->setRelation('business', $job_location->location->business);
		}

		// ---------------------------------------------------------------------- //

		return response()->resource($job_locations, [
			'meta' => [
				'total_count_of_locations' => $total_count_of_locations,
				'total_count_of_jobs' => $total_count_of_jobs,
			],
		]);
	}
}
