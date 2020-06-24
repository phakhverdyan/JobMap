<?php

namespace App\GraphQL\Query\User\Business;

use App\Business;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Business\Location;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\GraphQL\OptionalAuth;

class LocationsQuery extends Query
{
    use OptionalAuth;

    protected $attributes = [
        'name' => 'Locations'
    ];

    public function type()
    {
        return GraphQL::type('BusinessLocations');
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
            'type' => [
                'type' => Type::string(),
                'description' => 'Location type'
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
            'limit_brand' => [
                'type' => Type::int(),
                'description' => 'Set limit_brand items'
            ],
            'page_brand' => [
                'type' => Type::int(),
                'description' => 'Set current page_brand'
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
            'user_id' => [
                'type' => Type::id(),
                'description' => 'The id of the user'
            ],
            'no_brands' => [
                'type' => Type::id(),
                'description' => 'location no brands'
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
        $data = [];
        $count = 0;
        $limit = $args['limit'] ?? 10;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;

        if (!isset($args['page_brand'])) {
            $custom = false;
            $query = Location::query();
            if (isset($args['department_id']) && isset($args['assignment'])) {
                $query->whereNotIn('id', function ($q) use ($args) {
                    $q->select('location_id')
                        ->from('business_department_locations')
                        ->where('department_id', $args['department_id']);
                });
                $custom = true;
            }

            if (isset($args['manager_id']) && isset($args['assignment'])) {
                $query->whereNotIn('id', function ($q) use ($args) {
                    $q->select('location_id')
                        ->from('business_manager_locations')
                        ->where('administrator_id', $args['manager_id']);
                });
                $custom = true;
            }

            if (isset($args['job_id']) && isset($args['assignment'])) {
                $query->whereNotIn('id', function ($q) use ($args) {
                    $q->select('location_id')
                        ->from('business_job_locations')
                        ->where('job_id', $args['job_id']);
                });
                $custom = true;
            }

            $value = '';
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
            if (isset($args['findBy'])) {
                switch ($args['findBy']) {
                    case 'country':
                        $query->where('country', 'LIKE', str_to_latin($args['country']));
                        break;
                    case 'city':
                        $query->where('city', 'LIKE', str_to_latin($args['city']));
                        $query->where('country', 'LIKE', str_to_latin($args['country']));
                        break;
                    case 'region':
                        $query->where('region', 'LIKE', str_to_latin($args['region']));
                        $query->where('country', 'LIKE', str_to_latin($args['country']));
                        break;
                    case 'street':
                        $query->where('street', 'LIKE', str_to_latin($args['street']));
                        $query->where('city', 'LIKE', str_to_latin($args['city']));
                        $query->where('country', 'LIKE', str_to_latin($args['country']));
                        break;
                    case 'address':
                        $query->where('street_number', '=', trim($args['street_number']));
                        $query->where('street', 'LIKE', str_to_latin($args['street']));
                        $query->where('city', 'LIKE', str_to_latin($args['city']));
                        $query->where('country', 'LIKE', str_to_latin($args['country']));
                        break;
                    default:
                        return null;
                        break;
                }
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
            if (isset($args['type'])) {
                $query->where('type', $args['type']);
            }
            /*$limit = $args['limit'] ?? 10;
            $page = $args['page'] ?? 1;
            $skip = ($page - 1) * $limit;*/
            if(isset($args['business_id'])) {
                $businessIds = [$args['business_id']];
                if (!isset($args['no_brands'])) {
                    $businessIds = Business::where('id', $args['business_id'])->orWhere('parent_id', $args['business_id'])->get()->pluck('id')->toArray();
                }
                $query->whereIn('business_id', $businessIds);
                //$query->where('business_id', $args['business_id']);
            }
            if(isset($args['user_id'])) {
                $query->where('user_id', $args['user_id']);
            }

            $count = $query->count();
            $query->take($limit)->skip($skip);

            $manager_id = $args['manager_id'] ?? 0;

            $query->select([
                'business_locations.id as id',
                'business_locations.*',
                DB::raw('(select count(*) from business_manager_locations where administrator_id = ' . $manager_id . ' AND business_manager_locations.location_id = business_locations.id) as count_linked'),
                DB::raw('(select count(*) from business_job_locations,business_jobs where business_jobs.id = business_job_locations.job_id AND business_job_locations.status = 1 AND business_job_locations.location_id = business_locations.id) as jobs_count_open'),
                DB::raw('(select count(*) from business_job_locations,business_jobs where business_jobs.id = business_job_locations.job_id AND business_job_locations.status = 0 AND business_job_locations.location_id = business_locations.id) as jobs_count_close')
            ]);
            if ($custom) {
            } else {
                $query->withCount('managers');
            }

            $allItems = $query->get()->all();

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

            $data = $query->get()->all();
        }


        $brands = [];
        if(isset($args['business_id'])) {
            $page_brand = $args['page_brand'] ?? 1;
            $minus_limit = $page_brand == 1 ? 1 : 0;
            $limit_brand = $args['limit_brand'] ?? (5 - $minus_limit);
            $skip_brand = ($page_brand - 1) * $limit;
            $brands = Business::where('parent_id', $args['business_id'])->take($limit_brand)->skip($skip_brand)->get();
            foreach ($brands as $brand) {
                $brand->count_locations = Location::where('business_id', $brand->id)
                    ->where(function ($query) use ($value) {
                        if (strlen($value) > 0) {
                            $query->orWhere('name', 'like', '%' . $value . '%');
                            $query->orWhere('street', 'like', '%' . $value . '%');
                            $query->orWhere('city', 'like', '%' . $value . '%');
                            $query->orWhere('region', 'like', '%' . $value . '%');
                            $query->orWhere('country', 'like', '%' . $value . '%');
                            $query->orWhere('street_number', 'like', '%' . $value . '%');
                        }
                    })->select('id')->count();
                $brand->pages_locations = ceil($brand->count_locations / $limit);
                $brand->locations = Location::where('business_id', $brand->id)
                    ->where(function ($query) use ($value) {
                        if (strlen($value) > 0) {
                            $query->orWhere('name', 'like', '%' . $value . '%');
                            $query->orWhere('street', 'like', '%' . $value . '%');
                            $query->orWhere('city', 'like', '%' . $value . '%');
                            $query->orWhere('region', 'like', '%' . $value . '%');
                            $query->orWhere('country', 'like', '%' . $value . '%');
                            $query->orWhere('street_number', 'like', '%' . $value . '%');
                        }
                    })->orderBy('name', 'asc')->skip($skip)->take($limit)->get();
            }
        }

        return array(
            'items' => $data,
            'all_items' => $allItems,
            'brands' => $brands,
            'pages' => ceil($count / $limit),
            'count' => $count,
            'business_id' => $args['business_id'] ?? null,
            'current_page' => $page
        );
    }
}
