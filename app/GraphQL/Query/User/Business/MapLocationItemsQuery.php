<?php

namespace App\GraphQL\Query\User\Business;

use App\Business;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\DB;

class MapLocationItemsQuery extends Query
{
    protected $attributes = [
        'name' => 'All Locations'
    ];
    
    public function type()
    {
        return GraphQL::type('Businesses');
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'job_status' => [
                'type' => Type::int(),
                'description' => ''
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
            'keywords' => [
                'type' => Type::string(),
                'description' => ''
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
     * @return array|null
     */
    public function resolve($root, $args)
    {
        $query = Business::query();
        
        $query->join('business_locations', 'business_locations.business_id', '=', 'businesses.id');
        if (isset($args['findBy'])) {
            switch ($args['findBy']) {
                case 'country':
                    $query->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
                    break;
                case 'city':
                    $query->where('business_locations.city', 'LIKE', str_to_latin($args['city']));
                    $query->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
                    break;
                case 'region':
                    $query->where('business_locations.region', 'LIKE', str_to_latin($args['region']));
                    $query->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
                    break;
                case 'street':
                    $query->where('business_locations.street', 'LIKE', str_to_latin($args['street']));
                    $query->where('business_locations.city', 'LIKE', str_to_latin($args['city']));
                    $query->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
                    break;
                case 'address':
                    $query->where('business_locations.street_number', '=', trim($args['street_number']));
                    $query->where('business_locations.street', 'LIKE', str_to_latin($args['street']));
                    $query->where('business_locations.city', 'LIKE', str_to_latin($args['city']));
                    $query->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
                    break;
                default:
                    return null;
                    break;
            }
        }
        $query->join('business_job_locations', 'business_job_locations.location_id', '=', 'business_locations.id', 'left');
        
        
        $limit = $args['limit'] ?? 25;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;
        if (isset($args['keywords'])) {
            $value = $args['keywords'];
            $query->where(function ($query) use ($value, $args) {
                $query->orWhere('businesses.name', 'like', '%' . $value . '%');
                $query->orWhere(function ($query) use ($value) {
                    $query->whereIn('business_job_locations.job_id', function ($q) use ($value) {
                        $q->select('job_id')
                            ->from('business_job_types')
                            ->join('job_types', 'job_types.id', '=', 'business_job_types.type_id')
                            ->where('job_types.name', 'like', '%' . $value . '%');
                    });
                });
                if(isset($args['findBy'])) {
                    switch ($args['findBy']) {
                        case 'country':
                            $query->orWhere('business_locations.street', 'LIKE', '%' . $value . '%');
                            $query->orWhere('business_locations.city', 'LIKE', '%' . $value . '%');
                            $query->orWhere('business_locations.region', 'LIKE', '%' . $value . '%');
                            $items = explode(' ', $value);
                            foreach ($items as $item) {
                                $query->orWhere('business_locations.street_number', 'LIKE', '%' . $item . '%');
                            }
                            break;
                        case 'city':
                            $query->orWhere('business_locations.street', 'LIKE', '%' . $value . '%');
                            $items = explode(' ', $value);
                            foreach ($items as $item) {
                                $query->orWhere('business_locations.street_number', 'LIKE', '%' . $item . '%');
                            }
                            break;
                        case 'region':
                            $query->orWhere('business_locations.street', 'LIKE', '%' . $value . '%');
                            $query->orWhere('business_locations.city', 'LIKE', '%' . $value . '%');
                            $items = explode(' ', $value);
                            foreach ($items as $item) {
                                $query->orWhere('business_locations.street_number', 'LIKE', '%' . $item . '%');
                            }
                            break;
                    }
                }
            });
        }
        if (isset($args['sort'])) {
            $order = $args['order'] ?? 'asc';
            if ($args['sort'] == 'created_date') {
                $query->orderBy('businesses.created_at', $order);
            } else {
                $query->orderBy('businesses.'.$args['sort'], $order);
            }
        } else {
            $query->orderBy('businesses.name', 'asc');
        }
        $count = $query->distinct()->count('businesses.id');
        $query->select([
            'businesses.*',
            DB::raw('count(business_job_locations.job_id) as jobs_count'),
            DB::raw('count(distinct business_locations.id) as locations_count'),
        ])->groupBy('businesses.id')->orderBy('businesses.id');
    
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
