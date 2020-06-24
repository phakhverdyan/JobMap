<?php

namespace App\GraphQL\Query\User\Business;

use App\Business\Job;
use GraphQL;
use App\Business;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\GraphQL\OptionalAuth;
use Illuminate\Support\Facades\Log;

class JobsQuery extends Query
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
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the business'
            ],
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
        //app()->setLocale($root['locale']);
        $businessIDs = [];
        $query = Job::query();

        if (isset($args['assignment'])) {
            $query->whereNotIn('id', function ($q) use ($args) {
                $q->select('job_id')->from('business_job_locations')->where('location_id', $args['location_id']);
            });
        }

       // $businessID = $args['business_id'];
        //$businessIDs[] = intval($businessID);
//         if(isset($args['business_id'])) {
//             $businessIds = [$args['business_id']];
//             if (!isset($args['no_brands'])) {
//
//             }
//             $businessIds = Business::where('id', $args['business_id'])->orWhere('parent_id', $args['business_id'])->get()->pluck('id')->toArray();
//
//             log_info($businessIds);
//
//             $query->whereIn('business_id', $businessIds);
//         }

//        $business = Business::where('id', $businessID)->firstOrFail();
//        if ($business->parent_id) {
//            $businessIDs[] = intval($business->parent_id);
//        }


         //$query->where('business_jobs.business_id', $args['business_id']);
        //$query->where('business_jobs.business_id', $args['business_id']);


         //$query->where('business_id', $business->parent_id);
         //$query->where('business_id', $businessID);

        //$selectJobs = DB::table('business_jobs')->where('business_jobs.business_id', '=', $args['business_id']);
        //$selectJobsClose = DB::table('business_jobs')->where('business_jobs.business_id', '=', $args['business_id']);

        // if (isset($args['join'])) {
            $query->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');
            //$selectJobs->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');
            //$selectJobsClose->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');
            $query->join('business_locations', 'business_locations.id', '=', 'business_job_locations.location_id')
            ->where('business_locations.business_id', $args['business_id']);
            //$selectJobs->join('business_locations', 'business_job_locations.location_id', '=', 'business_locations.id');
            //$selectJobsClose->join('business_locations', 'business_job_locations.location_id', '=', 'business_locations.id');
        // }

        if (isset($args['keywords'])) {
            // if (!isset($args['join'])) {
            //     $query->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');
            //     $selectJobs->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');
            //     $selectJobsClose->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');
            // }

            // $query->join('business_locations', 'business_locations.id', '=', 'business_job_locations.location_id');
            // $selectJobs->join('business_locations', 'business_locations.id', '=', 'business_job_locations.location_id');
            // $selectJobsClose->join('business_locations', 'business_locations.id', '=', 'business_job_locations.location_id');

            $query->where(function ($query) use ($args) {
                $query->orWhere('title', 'like', '%' . $args['keywords'] . '%');
                $query->orWhere('business_locations.street', 'like', '%' . $args['keywords'] . '%');
                $query->orWhere('business_locations.city', 'like', '%' . $args['keywords'] . '%');
                $query->orWhere('business_locations.region', 'like', '%' . $args['keywords'] . '%');
                $query->orWhere('business_locations.country', 'like', '%' . $args['keywords'] . '%');
                $val = $args['keywords'];
                $items = explode(' ', $val);

                foreach ($items as $item) {
                    $query->orWhere('business_locations.street_number', 'like', '%' . $item . '%');
                }
            });

//            $selectJobs->where(function ($query) use ($args) {
//                $query->orWhere('title', 'like', '%' . $args['keywords'] . '%');
//                $query->orWhere('business_locations.street', 'like', '%' . $args['keywords'] . '%');
//                $query->orWhere('business_locations.city', 'like', '%' . $args['keywords'] . '%');
//                $query->orWhere('business_locations.region', 'like', '%' . $args['keywords'] . '%');
//                $query->orWhere('business_locations.country', 'like', '%' . $args['keywords'] . '%');
//                $val = $args['keywords'];
//                $items = explode(' ', $val);
//
//                foreach ($items as $item) {
//                    $query->orWhere('business_locations.street_number', 'like', '%' . $item . '%');
//                }
//            });
//
//            $selectJobsClose->where(function ($query) use ($args) {
//                $query->orWhere('title', 'like', '%' . $args['keywords'] . '%');
//                $query->orWhere('business_locations.street', 'like', '%' . $args['keywords'] . '%');
//                $query->orWhere('business_locations.city', 'like', '%' . $args['keywords'] . '%');
//                $query->orWhere('business_locations.region', 'like', '%' . $args['keywords'] . '%');
//                $query->orWhere('business_locations.country', 'like', '%' . $args['keywords'] . '%');
//                $val = $args['keywords'];
//                $items = explode(' ', $val);
//
//                foreach ($items as $item) {
//                    $query->orWhere('business_locations.street_number', 'like', '%' . $item . '%');
//                }
//            });
        }

        // if (isset($args['sort'])) {
        //     $order = $args['order'] ?? 'asc';
        //     if ($args['sort'] == 'created_date') {
        //         $query->orderBy('created_at', $order);
        //     } else {
        //         $query->orderBy($args['sort'], $order);
        //     }
        // } else {
        //     $query->orderBy('title', 'asc');
        // }

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
            $query->orderBy('business_jobs.updated_at', 'desc');
        }

        $onlyOpen = false;
        if (isset($args['filters'])) {
            $filters = explode(';', $args['filters']);
            foreach ($filters as $filter) {
                $filterData = explode(':', $filter);

                $filterName = $filterData[0];
                $filterInfo = ($filterData[1]) ?? false;

                switch ($filterName) {
                    case 'hours':
                        $query->where('hours', '=', $filterInfo);
                        //$selectJobs->where('hours', '=', $filterInfo);
                        //$selectJobsClose->where('hours', '=', $filterInfo);
                        break;
                    case 'salary':
                        $query->where('salary', '=', $filterInfo);
                        //$selectJobs->where('salary', '=', $filterInfo);
                        //$selectJobsClose->where('salary', '=', $filterInfo);
                        break;
                    case 'jobs_open':
                        $onlyOpen = true;
                        $query->where('status', '=', 1);
                        break;
                    case 'careers':
                        $query->join('business_job_career_levels', 'business_job_career_levels.job_id', '=', 'business_jobs.id');
                        //$selectJobs->join('business_job_career_levels', 'business_job_career_levels.job_id', '=', 'business_jobs.id');
                        //$selectJobsClose->join('business_job_career_levels', 'business_job_career_levels.job_id', '=', 'business_jobs.id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_career_levels.career_id', $data);
                        //$selectJobs->whereIn('business_job_career_levels.career_id', $data);
                        //$selectJobsClose->whereIn('business_job_career_levels.career_id', $data);
                        break;
                    case 'types':
                        $query->join('business_job_types', 'business_job_types.job_id', '=', 'business_jobs.id');
                        //$selectJobs->join('business_job_types', 'business_job_types.job_id', '=', 'business_jobs.id');
                       // $selectJobsClose->join('business_job_types', 'business_job_types.job_id', '=', 'business_jobs.id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_types.type_id', $data);
                        //$selectJobs->whereIn('business_job_types.type_id', $data);
                        //$selectJobsClose->whereIn('business_job_types.type_id', $data);
                        break;
                    case 'languages':
                        $query->join('business_job_languages', 'business_job_languages.job_id', '=', 'business_jobs.id');
                        //$selectJobs->join('business_job_languages', 'business_job_languages.job_id', '=', 'business_jobs.id');
                        //$selectJobsClose->join('business_job_languages', 'business_job_languages.job_id', '=', 'business_jobs.id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_languages.world_language_id', $data);
                        //$selectJobs->whereIn('business_job_languages.world_language_id', $data);
                        //$selectJobsClose->whereIn('business_job_languages.world_language_id', $data);
                        break;
                    case 'certifications':
                        $query->join('business_job_certificates', 'business_job_certificates.job_id', '=', 'business_jobs.id');
                        //$selectJobs->join('business_job_certificates', 'business_job_certificates.job_id', '=', 'business_jobs.id');
                        //$selectJobsClose->join('business_job_certificates', 'business_job_certificates.job_id', '=', 'business_jobs.id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_certificates.certificate_id', $data);
                        //$selectJobs->whereIn('business_job_certificates.certificate_id', $data);
                        //$selectJobsClose->whereIn('business_job_certificates.certificate_id', $data);
                        break;
                    case 'departments':
                        $query->join('business_job_departments', 'business_job_departments.job_id', '=', 'business_jobs.id');
                        //$selectJobs->join('business_job_departments', 'business_job_departments.job_id', '=', 'business_jobs.id');
                        //$selectJobsClose->join('business_job_departments', 'business_job_departments.job_id', '=', 'business_jobs.id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_departments.department_id', $data);
                        //$selectJobs->whereIn('business_job_departments.department_id', $data);
                        //$selectJobsClose->whereIn('business_job_departments.department_id', $data);
                        break;
                }
            }
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
        $query->where('business_locations.business_id', $args['business_id']);

        $selectJobs = clone $query;
        $selectJobsClose = clone $query;

        //$selectJobs->where('business_locations.business_id', $args['business_id']);
        //$selectJobsClose->where('business_locations.business_id', $args['business_id']);

        $query->select([
            'business_jobs.id as id',
            'business_jobs.*',
            'business_job_locations.id AS job_location_id',
            'business_job_locations.location_id AS location_id',
            'business_job_locations.status as status',

            DB::raw('(select count(*) from business_job_locations where business_jobs.id = business_job_locations.job_id AND business_job_locations.status = 1) as locations_count_open'),
        ]);

        //$query->distinct();

        if ($jobStatus !== null) {
            $query->where('business_job_locations.status', $jobStatus);
        }

        $count = $query->count();
        $query->take($limit)->skip($skip);
        $data = $query->get()->load('location');

        if(!empty($data)){
            foreach ($data as $job) {
                $job->full_address = $job->location->full_address;
                $job->country_code = $job->location['country_code'];
                $job->setRelation('business', $job->location->business);
            }
        }


        // $allJobs = collect();

        // $data->each(function($job) use ($allJobs, $jobStatus, $businessID) {

        //     $jobLocations = $job->locationsAll();

        //     if ($jobStatus !== null) {
        //         $jobLocations->where('business_job_locations.status', $jobStatus);
        //     }

        //     $jobLocations->get()->each(function($location) use ($allJobs, $job, $businessID) {

        //         if ( $location->location->business->getKey() == $businessID ) {
        //             $job = clone $job;
        //             $locationsInfo = $location->getWidgetDataAttribute();
        //             $job->full_address = $locationsInfo['address'];
        //             $job->location = $location->location;
        //             $job->country_code = $locationsInfo['country_code'];
        //             $job->business = $location->location->business;
        //             $job->status = $location->status;
        //             $allJobs->push($job);
        //         }

        //     });
        // });

        $countJobsOpen = $selectJobs->where('business_jobs.status', '=', 1)->distinct()->count('business_jobs.id');
        $countJobsClose = $selectJobsClose->where('business_jobs.status', '=', 0)->distinct()->count('business_jobs.id');

        /*if (isset($args['status'])) {
            if (isset($data[0])) {
                if ($args['status'] == 1) {
                    $count = $countJobsOpen;
                } else {
                    $count = $countJobsClose;
                }
            }
        }*/
        //$count = $countJobsOpen + $countJobsClose;

        return array(
            'items' => $data,
            'pages' => ceil($count / $limit),
            'count' => $count,
            'current_page' => $page,
            'jobs_open' => $countJobsOpen,
            'jobs_close' => ($onlyOpen) ? 0 : $countJobsClose
        );
    }
}
