<?php

namespace App\GraphQL\Query\User\Business;

use App\Business\Job;
use App\Business\Location;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\DB;
use App\GraphQL\OptionalAuth;
use Illuminate\Support\Facades\Log;

class MapJobsQuery extends Query
{
    use OptionalAuth;

    protected $attributes = [
        'name' => 'Map Jobs'
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
                'type' => Type::id(),
                'description' => 'The id of the business'
            ],
            'location_id' => [
                'type' => Type::id(),
                'description' => 'The id of the location'
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
                'description' => 'Set job type'
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
            'country' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'city' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'region' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'street' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'street_number' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'findBy' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'locale' => [
                'type' => Type::string(),
                'description' => 'The locale'
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
        $query = Job::query();
        $query->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');
        $query->join('business_locations', 'business_locations.id', '=', 'business_job_locations.location_id');

        if (isset($args['location_id'])) {
            $query->where('business_job_locations.location_id', $args['location_id']);
        }
        $select = "";
        // $locationId = 0;


        // if (isset($args['status'])) {
        //     if ($args['status'] === 'open') {
        //         $jobStatus = 1;
        //     } else {
        //         $jobStatus = 0;
        //     }
        // } else {
        //     $jobStatus = null;
        // }

        // if (isset($args['sort'])) {
        //     $order = $args['order'] ?? 'asc';
        //     if ($args['sort'] == 'created_date') {
        //         $query->orderBy('business_jobs.created_at', $order);
        //     } else {
        //         $query->orderBy($args['sort'], $order);
        //     }
        // } else {
        //     $query->orderBy('business_jobs.title', 'asc');
        // }
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
                        break;
                    case 'salary':
                        $query->where('salary', '=', $filterInfo);
                        break;
                    case 'jobs_open':
                        $onlyOpen = true;
                        $query->where('status', '=', 1);
                        break;
                    case 'careers':
                        $query->join('business_job_career_levels', 'business_job_career_levels.job_id', '=', 'business_jobs.id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_career_levels.career_id', $data);
                        break;
                    case 'types':
                        $query->join('business_job_types', 'business_job_types.job_id', '=', 'business_jobs.id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_types.type_id', $data);
                        break;
                    case 'languages':
                        $query->join('business_job_languages', 'business_job_languages.job_id', '=', 'business_jobs.id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_languages.world_language_id', $data);
                        break;
                    case 'certifications':
                        $query->join('business_job_certificates', 'business_job_certificates.job_id', '=', 'business_jobs.id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_certificates.certificate_id', $data);
                        break;
                    case 'departments':
                        $query->join('business_job_departments', 'business_job_departments.job_id', '=', 'business_jobs.id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_departments.department_id', $data);
                        break;
                }
            }
        }

        if (isset($args['keywords'])) {
            $query->where(function ($query) use ($args) {
                $query->orWhere('title', 'like', '%' . $args['keywords'] . '%');
                $query->orWhere('business_locations.street', 'like', '%' . $args['keywords'] . '%');
                $query->orWhere('business_locations.city', 'like', '%' . $args['keywords'] . '%');
                $query->orWhere('business_locations.region', 'like', '%' . $args['keywords'] . '%');
                $query->orWhere('business_locations.country', 'like', '%' . $args['keywords'] . '%');
            });
        }

        $limit = $args['limit'] ?? 25;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;
        if (isset($args['business_id'])) {
            $query->where('business_locations.business_id', $args['business_id']);
        }


        //$query->distinct();
        $dataS = [
            'business_jobs.id as id',
            'business_jobs.*',
            'business_jobs.status as paid_status',
            'business_job_locations.status AS status',
            'business_locations.street as location_street',
            'business_locations.street_number as location_street_number',
            'business_locations.city as location_city',
            'business_locations.region as location_region',
            'business_locations.country as location_country',
            'business_locations.country_code as location_country_code',
            'business_job_locations.id AS job_location_id',
            DB::raw('(select count(*) from business_job_locations where business_jobs.id = business_job_locations.job_id AND business_job_locations.status = 1) as locations_count_open')
        ];
//        $countC = 0;
//        if (!empty($select)) {
//            $dataS = [
//                $select,
//                'business_jobs.id as id',
//                'business_jobs.*',
//                DB::raw('(select count(*) from business_job_locations where business_jobs.id = business_job_locations.job_id AND business_job_locations.status = 1) as locations_count_open')
//            ];
//        }

        $query->select($dataS);
        $count = $query->distinct()->count('business_jobs.id');

        $queryO = clone $query;
        $countO = $queryO->where('business_job_locations.status',1)->count('business_jobs.id');
        $queryC = clone $query;
        $countC = $queryC->where('business_job_locations.status',0)->count('business_jobs.id');

        // Order by newes / oldest
        if (isset($args['sort'])) {

            switch ($args['sort']) {
                case 'newest':
                    $query->orderBy('business_jobs.updated_at', 'desc');
                    break;

                case 'oldest':
                    $query->orderBy('business_jobs.updated_at', 'asc');
                    break;
            }

        } else {
            $query->orderBy('business_jobs.updated_at', 'desc');
        }

        $query->take($limit)->skip($skip);
        $data = $query->get();


        if (isset($args['status'])) {
            $status = $args['status'] === 'open' ? true : false;

            $data = $data->filter(function($job) use ($status) {
                return $job->status == $status;
            });
        }

        // $data = $data->location = 'asddasas';

        if (isset($args['type'])) {
            $type = $args['type'];
            $data = $data->filter(function($job) use ($type) {
                return $job->type_key == $type;
            });
        }

        if (isset($args['location_id'])) {
            $data = $data->transform(function($job) use ($args) {

                $location = Location::find($args['location_id']);

                if ($location) {
                    $job->location_business = $location->business;
                }

                 return $job;
            });
        }

        return array(
            'items' => $data,
            'pages' => ceil($count / $limit),
            'count' => $count,
            'current_page' => $page,
            'jobs_open' => $countO,
            'jobs_close' => $countC,
            // 'location_id' => $locationId,
        );
    }
}
