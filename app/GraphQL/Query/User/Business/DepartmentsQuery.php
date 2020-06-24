<?php

namespace App\GraphQL\Query\User\Business;

use App\Business\Department;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\GraphQL\OptionalAuth;

class DepartmentsQuery extends Query
{
    use OptionalAuth;

    protected $attributes = [
        'name' => 'Departments'
    ];
    
    public function type()
    {
        return GraphQL::type('BusinessDepartments');
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
            'assignment' => [
                'type' => Type::int(),
                'description' => ''
            ],
            'keywords' => [
                'type' => Type::string(),
                'description' => 'Search department by keywords'
            ],
            'filters' => [
                'type' => Type::string(),
                'description' => 'Search jobs by filters'
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
            'default' => [
                'type' => Type::string(),
                'description' => 'Get default item by ids'
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
        $query = Department::query();

        if (isset($args['assignment'])) {
            $query->whereNotIn('id', function ($q) use ($args) {
                $q->select('department_id')->from('business_department_locations')->where('location_id', $args['location_id']);
            });
        }

        if (isset($args['keywords'])) {
            if (app()->isLocale('fr')) {
                $query->where('name_fr', 'like', '%' . $args['keywords'] . '%');
            }
            else {
                $query->where('name', 'like', '%' . $args['keywords'] . '%');
            }
        }

        if (isset($args['sort'])) {
            $order = $args['order'] ?? 'asc';

            if ($args['sort'] == 'created_date') {
                $query->orderBy('created_at', $order);
            }
            else {
                $query->orderBy($args['sort'], $order);
            }
        }
        else {
            if (app()->isLocale('fr')) {
                $query->orderBy('name_fr', 'asc');
            }

            $query->orderBy('name', 'asc');
        }

        if (isset($args['filters'])) {
            $query->join('business_job_departments', 'business_job_departments.department_id', '=', 'business_departments.id');
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
                        $query->where('status', '=', 1);
                        break;
                    case 'careers':
                        $query->join('business_job_career_levels', 'business_job_career_levels.job_id', '=', 'business_job_departments.job_id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_career_levels.career_id', $data);
                        break;
                    case 'types':
                        $query->join('business_job_types', 'business_job_types.job_id', '=', 'business_job_departments.job_id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_types.type_id', $data);
                        break;
                    case 'languages':
                        $query->join('business_job_languages', 'business_job_languages.job_id', '=', 'business_job_departments.job_id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_languages.world_language_id', $data);
                        break;
                    case 'certifications':
                        $query->join('business_job_certificates', 'business_job_certificates.job_id', '=', 'business_job_departments.job_id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_certificates.certificate_id', $data);
                        break;
                    case 'departments':
//                        $query->join('business_job_departments','business_job_departments.job_id','=','business_jobs.id');
                        $data = explode(',', $filterInfo);
                        $query->whereIn('business_job_departments.department_id', $data);
                        break;
                }
            }
        }

        $limit = $args['limit'] ?? 25;
        $page = $args['page'] ?? 1;

        if (isset($args['business_id'])) {
            $query->where('business_id', $args['business_id']);
        }
        else {
            //get all departments
            $query->groupBy('business_departments.name');
        }

        $count = $query->count();
        $query->distinct();

        if ($limit !== 0) {
            $skip = ($page - 1) * $limit;
            $query->take($limit)->skip($skip);
        }

        $data = $query->select([
            'business_departments.id as id',
            'business_departments.name',
            'business_departments.name_fr',
            'business_departments.business_id',
            'business_departments.status',
            'business_departments.created_at'
        ])->get();
        
        $response = array(
            'items' => $data,
            'pages' => ($limit !== 0) ? round($count / $limit, 0, PHP_ROUND_HALF_UP) : 0,
            'current_page' => $page
        );
        
        if (isset($args['default'])) {
            $ids = explode(',', $args['default']);
            $response['default'] = Department::whereIn('id', $ids)->get();
        }
        
        return $response;
    }
}
