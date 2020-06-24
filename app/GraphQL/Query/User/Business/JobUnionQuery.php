<?php

namespace App\GraphQL\Query\User\Business;

use App\Business\JobLocation;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\GraphQL\OptionalAuth;

class JobUnionQuery extends Query
{
    use OptionalAuth;

    protected $attributes = [
        'name' => 'Job'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('JobUnion'));
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the job'
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
            ],
            'locale' => [
                'type' => Type::string(),
                'description' => 'The output content language prefix'
            ],
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        $query = JobLocation::query();
        $query->join('business_jobs','business_jobs.id', '=', 'business_job_locations.job_id');
        $query->join('business_locations','business_locations.id', '=', 'business_job_locations.location_id');
        $query->where([
            'business_job_locations.job_id' => $args['id'],
            //'business_job_locations.status' => 1
        ]);
    
        if (isset($args['keywords'])) {
                $query->join('job_categories','job_categories.id', '=', 'business_jobs.category_id', 'left');
            $query->where(function ($query) use ($args) {
                $query->orWhere('job_categories.name', 'like', '%' . $args['keywords'] . '%');
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
    
        if (isset($args['sort'])) {
            $order = $args['order'] ?? 'asc';
            if ($args['sort'] == 'created_date') {
                $query->orderBy('business_jobs.created_at', $order);
            } else {
                $query->orderBy($args['sort'], $order);
            }
        } else {
            $query->orderBy('title', 'asc');
        }
    
        $limit = $args['limit'] ?? 25;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;
        $query->select([
            'business_job_locations.*',
            'business_jobs.*',
            'business_locations.*',
            'business_jobs.updated_at as updated_at',
            'business_jobs.business_id as business_id',
            'business_job_locations.id as id',
            'business_job_locations.status as status_in_location'
        ]);

        $queryO = clone $query;
        $countO = $queryO->where('business_job_locations.status',1)->count('business_jobs.id');
        $queryC = clone $query;
        $countC = $queryC->where('business_job_locations.status',0)->count('business_jobs.id');

        $query->take($limit)->skip($skip);
        $jobs = $query->get();

        $jobs[0]['jobs_open'] = $countO;
        $jobs[0]['jobs_close'] = $countC;
        return $jobs;
    }
}
