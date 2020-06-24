<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business;
use App\GraphQL\Extensions\AuthQuery;
use GraphQL;
use GraphQL\Type\Definition\Type;
use App\Business\Location;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\GraphQL\OptionalAuth;
use App\GraphQL\AuthBusiness;
use App\Business\Administrator;

class BusinessLocationsBrandsQuery extends AuthQuery
{
    //use OptionalAuth;
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'LocationsBusiness'
    ];

    public function type()
    {
        return GraphQL::type('BusinessBrands');
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
            'keywords' => [
                'type' => Type::string(),
                'description' => 'Search location by keywords'
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
            'limit_location' => [
                'type' => Type::int(),
                'description' => 'Set limit_brand location'
            ],
            'page_location' => [
                'type' => Type::int(),
                'description' => 'Set current page_location'
            ],
            'locale' => [
                'type' => Type::string(),
                'description' => 'The locale'
            ],
            'no_brands' => [
                'type' => Type::int(),
                'description' => 'no_brands'
            ],
            'department_id' => [
                'type' => Type::id(),
                'description' => 'The id of the department'
            ],
            'manager_id' => [
                'type' => Type::id(),
                'description' => 'The id of the manager'
            ],
            'job_id' => [
                'type' => Type::id(),
                'description' => 'The id of the job'
            ],
            'assignment' => [
                'type' => Type::int(),
                'description' => ''
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
        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::BRANCH_ROLE
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        if (isset($args['manager_id'])) {
            $manager = Administrator::findOrFail($args['manager_id']);
        }

        $query = Business::query();
        $query->where('id', $args['business_id']);
        if (!isset($args['no_brands'])) {
            $query->orWhere('parent_id', $args['business_id']);
        }

        if (isset($args['sort'])) {
            $order = $args['order'] ?? 'asc';
            if ($args['sort'] == 'created_date') {
                $query->orderBy('created_at', $order);
            } else {
                $query->orderBy($args['sort'], $order);
            }
        } else {
            $query->orderBy('name', 'asc');
        }

        $limit = $args['limit'] ?? 5;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;

        $count = $query->count();
        $query->take($limit)->skip($skip);
        $businesses = $query->get()->all();

        foreach ($businesses as $business) {
            if (!$business->parent_id) {
                array_unshift($businesses, $business);
            }
        }

        $businesses = array_unique($businesses);

        $limit_location = $args['limit_location'] ?? 10;
        $page_location = $args['page_location'] ?? 1;
        $skip_location = ($page_location - 1) * $limit_location;

        foreach ($businesses as $business) {
            $query = Location::query();
            $query->where('business_id', $business->id);

            if (!$this->checkBusinessAccess($business->id)) {
                $adminId = $this->auth->_administratorBusiness($business->id)->first()->id;
                $query->where(function ($query) use($adminId) {
                    $query->where('user_id', $this->auth->id)
                        ->orWhereHas('managers',function ($q) use($adminId) {
                            $q->where('administrator_id',$adminId);
                        });
                });
            }

            if (isset($args['keywords'])) {
                $value = $args['keywords'];
                $query->where(function ($query) use ($value) {
                    $query->where('name', 'like', '%' . $value . '%');
                    $query->orWhere('street', 'like', '%' . $value . '%');
                    $query->orWhere('city', 'like', '%' . $value . '%');
                    $query->orWhere('region', 'like', '%' . $value . '%');
                    $query->orWhere('country', 'like', '%' . $value . '%');
                    $items = explode(' ', $value);
                    foreach ($items as $item) {
                        $query->orWhere('street_number', 'like', '%' . $item . '%');
                    }
                });
            }

            $business->count_locations = $query->count();
            $business->pages_locations = ceil($business->count_locations / $limit_location);

            if (isset($args['assignment'])) {
                $query->orderBy('is_assigned', 'desc');
                $query->orderBy('name', 'asc');
            } else {
                $query->orderBy('name', 'asc');
            }
            $query->skip($skip_location)->take($limit_location);
            $manager_id = $args['manager_id'] ?? 0;
            $selectRaw = '(select 0) as is_assigned';
            if (isset($args['manager_id'])) {
                $selectRaw = '(select count(*) from business_manager_locations where administrator_id = ' . $args['manager_id'] . ' AND business_manager_locations.location_id = business_locations.id) as is_assigned';
            } elseif (isset($args['job_id'])) {
                $selectRaw = '(select count(*) from business_job_locations where job_id = ' . $args['job_id'] . ' AND business_job_locations.location_id = business_locations.id) as is_assigned';
            }  elseif (isset($args['department_id'])) {
                $selectRaw = '(select count(*) from business_department_locations where department_id = ' . $args['department_id'] . ' AND business_department_locations.location_id = business_locations.id) as is_assigned';
            }
            $query->select([
                'business_locations.id as id',
                'business_locations.*',
                DB::raw($selectRaw),
                DB::raw('(select count(*) from business_manager_locations where administrator_id = ' . $manager_id . ' AND business_manager_locations.location_id = business_locations.id) as count_linked'),
                DB::raw('(select count(*) from business_job_locations,business_jobs where business_jobs.id = business_job_locations.job_id AND business_job_locations.status = 1 AND business_job_locations.location_id = business_locations.id) as jobs_count_open'),
                DB::raw('(select count(*) from business_job_locations,business_jobs where business_jobs.id = business_job_locations.job_id AND business_job_locations.status = 0 AND business_job_locations.location_id = business_locations.id) as jobs_count_close')
            ]);
            $query->withCount('managers');

            if (isset($manager->role)) {
                $query->where('managers_type', $manager->role);
            }

            $business->locations = $query->get();
        }

        return array(
            'items' => $businesses,
            'pages' => ceil($count / $limit),
            'count' => $count,
            'current_page' => $page
        );
    }
}
