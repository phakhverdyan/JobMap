<?php

namespace App\Http\Controllers\JobMap;

use App\Business;
use App\Candidate\Candidate;
use App\Http\Controllers\Controller;
use App\Amenity;
use App\BusinessSize;
use App\CareerLevel;
use App\Industry;
use App\JobCategory;
use App\JobType;
use App\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class LatestController extends Controller
{
    public function index(Request $request, $type = "applications"){


        if (isset($_COOKIE['language']) && $_COOKIE['language']) {
            app()->setLocale($_COOKIE['language']);
        }

        $objects = null;

        switch ($type){
            case "applications":
                    $objects = $this->getApplications($request);
                break;
            case "jobs":
                    $objects = $this->getJobs($request);
                break;
            case "locations":
                    $objects = $this->getLocations($request);
                break;
            case "businesses":
                    $objects = $this->getBusinesses($request);
                break;
            default:
                break;
        }
        // dd($objects);
        return view('common.jobmap.latest', [
            "objects" => $objects,
            "type" => $type,
        ]);
    }

    private function getApplications(Request $request){

        $prefix = "_".app()->getLocale();
        if($prefix == "_en")$prefix = "";

        $BusinessQuery = Business::query();
        $BusinessQuery = $BusinessQuery->join("candidates", "candidates.business_id", "=", "businesses.id");
        $BusinessQuery = $BusinessQuery->join("business_locations", "candidates.location_id", "=", "business_locations.id");

        $BusinessQuery = $BusinessQuery->select([
            "businesses.id as business_id",
            "businesses.picture as business_picture",
            "businesses.name".$prefix." as business_name",
            "business_locations.street as street",
            "business_locations.street_number as street_number",
            "business_locations.city as city",
            "business_locations.region as region",
            "business_locations.country as country",
            "business_locations.id as business_locations_id",
            "candidates.created_at as created_at",
        ])->groupby('business_locations.id')->distinct();
        $BusinessQuery = $BusinessQuery->whereNotNull("candidates.created_at");
        $BusinessQuery->where("businesses.name".$prefix, "!=", "");
        $BusinessQuery->whereNotNull("businesses.name".$prefix);
        $BusinessQuery = $BusinessQuery->orderBy("candidates.created_at", "desc");
        $BusinessQuery = $BusinessQuery->paginate(25);
        return $BusinessQuery;
    }

    private function getJobs(Request $request){
        $prefix = "_".app()->getLocale();
        if($prefix == "_en")$prefix = "";

        $BusinessQuery = Business::query()->select([
            "businesses.id as business_id",
            "businesses.picture as business_picture",
            "businesses.name".$prefix." as business_name",
            "business_locations.street as street",
            "business_locations.street_number as street_number",
            "business_locations.city as city",
            "business_locations.region as region",
            "business_locations.country as country",
            'business_job_locations.id as job_id',
            "business_jobs.title".$prefix." as job_name",
            "business_jobs.created_at as created_at",
            "business_locations.id as business_locations_id",
        ]);

        $BusinessQuery = $BusinessQuery->join("business_jobs", "business_jobs.business_id", "=", "businesses.id");
        $BusinessQuery = $BusinessQuery->join("business_job_locations", "business_job_locations.job_id", "=", "business_jobs.id");
        $BusinessQuery = $BusinessQuery->join("business_locations", "business_locations.id", "=", "business_job_locations.location_id");
        $BusinessQuery = $BusinessQuery->whereNotNull("business_jobs.created_at");
        $BusinessQuery->where("business_jobs.title".$prefix, "!=", "");
        $BusinessQuery->whereNotNull("business_jobs.title".$prefix);
        $BusinessQuery->where("businesses.name".$prefix, "!=", "");
        $BusinessQuery->whereNotNull("businesses.name".$prefix);
        $BusinessQuery = $BusinessQuery->orderBy("business_jobs.created_at", "desc");

        $BusinessQuery = $BusinessQuery->paginate(25);

        return $BusinessQuery;
    }

    ///
    private function getLocations(Request $request){
        $prefix = "_".app()->getLocale();
        if($prefix == "_en")$prefix = "";

        $BusinessQuery = Business\Location::query()->select([
            "businesses.id as business_id",
            "business_locations.picture as business_picture",
            "business_locations.name".$prefix." as business_name",
            "business_locations.*",
        ]);
        $BusinessQuery = $BusinessQuery->join("businesses", "business_locations.business_id", "=", "businesses.id");
        $BusinessQuery = $BusinessQuery->whereNotNull("business_locations.created_at");
        $BusinessQuery->where("business_locations.name".$prefix, "!=", "");
        $BusinessQuery->whereNotNull("business_locations.name".$prefix);
        $BusinessQuery = $BusinessQuery->orderBy("business_locations.created_at", "desc");
        $BusinessQuery = $BusinessQuery->paginate(25);

        return $BusinessQuery;
    }

    private function getBusinesses(Request $request){
        $prefix = "_".app()->getLocale();
        if($prefix == "_en")$prefix = "";

        $BusinessQuery = Business::query()->select([
            "businesses.id as business_id",
            "businesses.picture as business_picture",
            "businesses.name".$prefix." as business_name",
            "businesses.*",
        ]);
        $BusinessQuery = $BusinessQuery->whereNotNull("businesses.created_at");
        $BusinessQuery->where("businesses.name".$prefix, "!=", "");
        $BusinessQuery->whereNotNull("businesses.name".$prefix);
        $BusinessQuery = $BusinessQuery->orderBy("businesses.created_at", "desc");
        $BusinessQuery = $BusinessQuery->paginate(25);

        return $BusinessQuery;
    }
}
