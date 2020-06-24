<?php

namespace App\GraphQL\Query\User\Business;

use App\Business\Job;
use App\Business;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\GraphQL\OptionalAuth;

class AllJobsQuery extends Query
{
    use OptionalAuth;

    protected $attributes = [
        'name' => 'Jobs'
    ];

    public function type()
    {
        return GraphQL::type('BusinessJobs');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            // 'business_id' => [
            //     'type' => Type::nonNull(Type::id()),
            //     'description' => 'The id of the business'
            // ],
            'location_id' => [
                'type' => Type::id(),
                'description' => 'The id of the location'
            ],
            'assignment' => [
                'type' => Type::int(),
                'description' => ''
            ],
            'join' => [
                'type' => Type::int(),
                'description' => ''
            ],
            'status' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'filters' => [
                'type' => Type::string(),
                'description' => 'Search jobs by filters'
            ],
            'keywords' => [
                'type' => Type::string(),
                'description' => 'Search jobs by keywords'
            ],
            'sort' => [
                'type' => Type::string(),
                'description' => 'Set field for order'
            ],
            'type' => [
                'type' => Type::string(),
                'description' => 'Set field for job type'
            ],
            'order' => [
                'type' => Type::string(),
                'description' => 'Set order'
            ],
            'limit' => [
                'type' => Type::int(),
                'description' => 'Set limit items'
            ],
            'page' => [
                'type' => Type::int(),
                'description' => 'Set current page'
            ],
            // 'locale' => [
            //     'type' => Type::string(),
            //     'description' => 'The locale (DEPRECATED)'
            // ],
            'locale' => [
                'type' => Type::string(),
                'description' => 'The output content language prefix'
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array
     */
    public function resolve($root, $args)
    {
        $locate = app()->getLocale();
        $query = Job::with(['business', 'locationsAll.location', 'locations.location', '_locationsAll']);//

        if ( app()->getLocale() === 'fr' ) {
            $fieldTitle = 'title_fr';
            $fieldName = 'name_fr';
        } else {
            $fieldTitle = 'title';
            $fieldName = 'name';
        }

        $query->whereNotNull($fieldTitle);

        $query->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');

        $query->join('business_locations', 'business_locations.id', '=', 'business_job_locations.location_id');

        if (isset($args['keywords'])) {
            //$args['keywords'] = remove_special_chars($args['keywords']);
            $keywords = explode(" ", str_replace( array( '\'', '"', ',' , ';', '<', '>' ), ' ', $args['keywords']));



            //$query->where($fieldTitle, 'like', '%' . $args['keywords'] . '%');
            $query->where(function ($where) use ($keywords, $fieldTitle) {
                foreach ($keywords as $keyword) {
                    $where->where($fieldTitle, 'like', '%' . $keyword . '%');
                }
            });

           // $query->join('businesses', 'business_jobs.business_id', '=', 'businesses.id');
            
            //$query->orWhere('businesses.' . $fieldName, 'like', '%' . $args['keywords'] . '%');
            $businesses = Business::where(function ($where) use ($keywords, $fieldName) {
                foreach ($keywords as $keyword) {
                    $where->where('businesses.' . $fieldName, 'like', '%' . $keyword . '%');
                }
            })->pluck('id')->toArray();
            // Log::error($query->toSql());
            // Log::error($query->distinct('businesses.id')->pluck('businesses.id')->toArray());

            $query->whereIn('business_locations.business_id',$businesses, 'or');

            // by parent business name
            //$query->join('businesses as businesses_parent', 'business_jobs.business_id', '=', 'businesses_parent.parent_id');
            //$query->orWhere('businesses_parent.' . $fieldName, 'like', '%' . $args['keywords'] . '%');

        }

        // Order by newes / oldest
        if (isset($args['sort'])) {

            switch ($args['sort']) {
                case 'newest':
                    $query->orderBy('updated_at', 'desc');
                    break;

                case 'oldest':
                    $query->orderBy('updated_at', 'asc');
                    break;
            }

        } else {
            $query->orderBy('updated_at', 'desc');
        }


        if (isset($args['status'])) {
            if ($args['status'] === 'open') {
                $jobStatus = 1;
            } else {
                $jobStatus = 0;
            }
        } else {
            $jobStatus = null;
        }

        if (isset($args['type'])) {
            $query->where('business_jobs.type_key', $args['type']);
        }
        $limit = $args['limit'] ?? 25;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;

        $query->select([
            'business_jobs.id as id',
            'business_jobs.*',
            'business_locations.street as location_street',
            'business_locations.street_number as location_street_number',
            'business_locations.city as location_city',
            'business_locations.region as location_region',
            'business_locations.country as location_country',
            'business_locations.country_code as location_country_code',
            'business_job_locations.id as job_location_id',
            'business_jobs.status as status',
            'business_job_locations.id AS job_location_id',

            DB::raw('(select count(*) from business_job_locations where business_jobs.id = business_job_locations.job_id AND business_job_locations.status = 1) as locations_count_open')
        ]);//->distinct();
        $count = $query->count();
        $query->take($limit)->skip($skip);
        $data = $query->get();

//        $allJobs = collect();
//
//        $data->each(function($job) use ($allJobs, $jobStatus) {
//
//            $jobLocations = $job->locationsAll();
//
//            if ($jobStatus !== null) {
//                $jobLocations->where('business_job_locations.status', $jobStatus);
//            }
//
//            $jobLocations->get()->each(function($location) use ($allJobs, $job) {
//
//                $job = clone $job;
//                $locationsInfo = $location->getWidgetDataAttribute();
//
//                $job->full_address = $locationsInfo['address'];
//                $job->location = $location;
//                $job->country_code = $locationsInfo['country_code'];
//                $job->business = $location->location->business;
//                $job->status = $location->status;
//                $allJobs->push($job);
//            });
//        });
//
//        $allJobs = $allJobs->take($limit);



        return array(
            'items' => $data,
            'pages' => ceil($count / $limit),
            //'count' => count($allJobs),
            'count' => count($data),
            'current_page' => $page,
            // 'jobs_open' => $countJobsOpen,
            // 'jobs_close' => ($onlyOpen) ? 0 : $countJobsClose
        );
    }
}
