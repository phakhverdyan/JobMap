<?php

namespace App\GraphQL\Query\User\Business;

use App\Business\Job;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\DB;

class NearbyJobsQuery extends Query
{
    protected $attributes = [
        'name' => 'Nearby Jobs'
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
            'job_id' => [
                'type' => Type::id(),
                'description' => 'The id of current job'
            ],
            'latitude' => [
                'type' => Type::nonNull(Type::float()),
                'description' => 'Search location by latitude'
            ],
            'longitude' => [
                'type' => Type::nonNull(Type::float()),
                'description' => 'Search location by longitude'
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
                'type' => Type::int(),
                'description' => ''
            ],
            'nearby' => [
                'type' => Type::int(),
                'description' => 'Nearby radius'
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
            ]
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
        if (isset($args['assignment'])) {
            $query->whereNotIn('id', function ($q) use ($args) {
                $q->select('job_id')
                    ->from('business_job_locations')
                    ->where('location_id', $args['location_id']);
            });
        }
        
        $selectJobs = DB::table('business_jobs');
        $selectJobsClose = DB::table('business_jobs');
        
        if (isset($args['join'])) {
            $query->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');
            $selectJobs->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');
            $selectJobsClose->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');
            $query->join('business_locations', 'business_locations.id', '=', 'business_job_locations.location_id');
            $selectJobs->join('business_locations', 'business_locations.id', '=', 'business_job_locations.location_id');
            $selectJobsClose->join('business_locations', 'business_locations.id', '=', 'business_job_locations.location_id');
        }
        
        if (isset($args['keywords'])) {
            if (!isset($args['join'])) {
                $query->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');
                $selectJobs->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');
                $selectJobsClose->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');
            }
            
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
            
            $selectJobs->where(function ($query) use ($args) {
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
            
            $selectJobsClose->where(function ($query) use ($args) {
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
        }
        if (isset($args['sort'])) {
            $order = $args['order'] ?? 'asc';
            if ($args['sort'] == 'created_date') {
                $query->orderBy('created_at', $order);
            } else {
                $query->orderBy($args['sort'], $order);
            }
        } else {
            $query->orderBy('title', 'asc');
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
                        $query->where('business_jobs.hours', '=', $filterInfo);
                        $selectJobs->where('business_jobs.hours', '=', $filterInfo);
                        $selectJobsClose->where('business_jobs.hours', '=', $filterInfo);
                        break;
                    case 'salary':
                        $query->where('business_jobs.salary', '=', $filterInfo);
                        $selectJobs->where('business_jobs.salary', '=', $filterInfo);
                        $selectJobsClose->where('business_jobs.salary', '=', $filterInfo);
                        break;
                    case 'jobs_open':
                        $onlyOpen = true;
                        $query->where('business_jobs.status', '=', 1);
                        break;
                    case 'careers':
                        $query->join('business_job_career_levels', 'business_job_career_levels.job_id', '=', 'business_jobs.id');
                        $selectJobs->join('business_job_career_levels', 'business_job_career_levels.job_id', '=', 'business_jobs.id');
                        $selectJobsClose->join('business_job_career_levels', 'business_job_career_levels.job_id', '=', 'business_jobs.id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_career_levels.career_id', $data);
                        $selectJobs->whereIn('business_job_career_levels.career_id', $data);
                        $selectJobsClose->whereIn('business_job_career_levels.career_id', $data);
                        break;
                    case 'types':
                        $query->join('business_job_types', 'business_job_types.job_id', '=', 'business_jobs.id');
                        $selectJobs->join('business_job_types', 'business_job_types.job_id', '=', 'business_jobs.id');
                        $selectJobsClose->join('business_job_types', 'business_job_types.job_id', '=', 'business_jobs.id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_types.type_id', $data);
                        $selectJobs->whereIn('business_job_types.type_id', $data);
                        $selectJobsClose->whereIn('business_job_types.type_id', $data);
                        break;
                    case 'languages':
                        $query->join('business_job_languages', 'business_job_languages.job_id', '=', 'business_jobs.id');
                        $selectJobs->join('business_job_languages', 'business_job_languages.job_id', '=', 'business_jobs.id');
                        $selectJobsClose->join('business_job_languages', 'business_job_languages.job_id', '=', 'business_jobs.id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_languages.world_language_id', $data);
                        $selectJobs->whereIn('business_job_languages.world_language_id', $data);
                        $selectJobsClose->whereIn('business_job_languages.world_language_id', $data);
                        break;
                    case 'certifications':
                        $query->join('business_job_certificates', 'business_job_certificates.job_id', '=', 'business_jobs.id');
                        $selectJobs->join('business_job_certificates', 'business_job_certificates.job_id', '=', 'business_jobs.id');
                        $selectJobsClose->join('business_job_certificates', 'business_job_certificates.job_id', '=', 'business_jobs.id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_certificates.certificate_id', $data);
                        $selectJobs->whereIn('business_job_certificates.certificate_id', $data);
                        $selectJobsClose->whereIn('business_job_certificates.certificate_id', $data);
                        break;
                    case 'departments':
                        $query->join('business_job_departments', 'business_job_departments.job_id', '=', 'business_jobs.id');
                        $selectJobs->join('business_job_departments', 'business_job_departments.job_id', '=', 'business_jobs.id');
                        $selectJobsClose->join('business_job_departments', 'business_job_departments.job_id', '=', 'business_jobs.id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_departments.department_id', $data);
                        $selectJobs->whereIn('business_job_departments.department_id', $data);
                        $selectJobsClose->whereIn('business_job_departments.department_id', $data);
                        break;
                }
            }
        }
        if (isset($args['status']) && !$onlyOpen) {
            $query->where('business_jobs.status', $args['status']);
        }
        $limit = $args['limit'] ?? 25;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;
        if (isset($args['job_id'])) {
            $query->where('business_jobs.id', '<>', $args['job_id']);
            $selectJobs->where('business_jobs.id', '<>', $args['job_id']);
            $selectJobsClose->where('business_jobs.id', '<>', $args['job_id']);
        }
        $query->where(DB::raw('((ACOS(SIN(business_locations.latitude * PI() / 180) * SIN(' . $args['latitude'] . ' * PI() / 180) + COS(business_locations.latitude * PI() / 180) * COS(' . $args['latitude'] . ' * PI() / 180) * COS((business_locations.longitude - ' . $args['longitude'] . ') * PI() / 180)) * 180 / PI()) * 60 * 1.1515 * 1.609344)'), '<=', $args['nearby']);
        $selectJobs->where(DB::raw('((ACOS(SIN(business_locations.latitude * PI() / 180) * SIN(' . $args['latitude'] . ' * PI() / 180) + COS(business_locations.latitude * PI() / 180) * COS(' . $args['latitude'] . ' * PI() / 180) * COS((business_locations.longitude - ' . $args['longitude'] . ') * PI() / 180)) * 180 / PI()) * 60 * 1.1515 * 1.609344)'), '<=', $args['nearby']);
        $selectJobsClose->where(DB::raw('((ACOS(SIN(business_locations.latitude * PI() / 180) * SIN(' . $args['latitude'] . ' * PI() / 180) + COS(business_locations.latitude * PI() / 180) * COS(' . $args['latitude'] . ' * PI() / 180) * COS((business_locations.longitude - ' . $args['longitude'] . ') * PI() / 180)) * 180 / PI()) * 60 * 1.1515 * 1.609344)'), '<=', $args['nearby']);
        $query->select([
            'business_jobs.id as id',
            'business_jobs.*',
            'business_jobs.status as status',
            DB::raw('(select count(*) from business_job_locations where business_jobs.id = business_job_locations.job_id AND business_job_locations.status = 1) as locations_count_open')
        ])->distinct();
        $count = $query->count();
        $query->take($limit)->skip($skip);
        $data = $query->get()->all();
        
        $countJobsOpen = $selectJobs->where('business_jobs.status', '=', 1)->distinct()->count('business_jobs.id');
        $countJobsClose = $selectJobsClose->where('business_jobs.status', '=', 0)->distinct()->count('business_jobs.id');
        
        if (isset($args['status'])) {
            if (isset($data[0])) {
                if ($args['status'] == 1) {
                    $count = $countJobsOpen;
                } else {
                    $count = $countJobsClose;
                }
            }
        }
        
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
