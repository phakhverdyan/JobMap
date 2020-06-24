<?php

namespace App\GraphQL\Query\User\Business;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Business\Location;
use Illuminate\Support\Facades\DB;
use App\GraphQL\OptionalAuth;

class NearbyLocationsQuery extends Query
{
    use OptionalAuth;

    protected $attributes = [
        'name' => 'Nearby Locations'
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
            'location_id' => [
                'type' => Type::id(),
                'description' => 'The id of the current location'
            ],
            'latitude' => [
                'type' => Type::nonNull(Type::float()),
                'description' => 'Search location by latitude'
            ],
            'longitude' => [
                'type' => Type::nonNull(Type::float()),
                'description' => 'Search location by longitude'
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
            'nearby' => [
                'type' => Type::int(),
                'description' => 'Nearby radius'
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
        $limit = $args['limit'] ?? 25;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;
        if (isset($args['location_id'])) {
            $query->where('business_locations.id', '<>', $args['location_id']);
        }
        $query->where(DB::raw('((ACOS(SIN(business_locations.latitude * PI() / 180) * SIN(' . $args['latitude'] . ' * PI() / 180) + COS(business_locations.latitude * PI() / 180) * COS(' . $args['latitude'] . ' * PI() / 180) * COS((business_locations.longitude - ' . $args['longitude'] . ') * PI() / 180)) * 180 / PI()) * 60 * 1.1515 * 1.609344)'), '<=', $args['nearby']);
        $query->select([
            'business_locations.id as id',
            'business_locations.*',
            DB::raw('(select count(*) from business_job_locations,business_jobs where business_jobs.id = business_job_locations.job_id AND business_job_locations.status = 1 AND business_job_locations.location_id = business_locations.id) as jobs_count_open'),
            DB::raw('(select count(*) from business_job_locations,business_jobs where business_jobs.id = business_job_locations.job_id AND business_job_locations.status = 0 AND business_job_locations.location_id = business_locations.id) as jobs_count_close')
        ]);
        $count = $query->count();
        if ($custom) {
        } else {
            $query->withCount('managers');
        }
        $query->take($limit)->skip($skip);
        $data = $query->get()->all();
        
        return array(
            'items' => $data,
            'pages' => ceil($count / $limit),
            'count' => $count,
            'current_page' => $page
        );
    }
}
