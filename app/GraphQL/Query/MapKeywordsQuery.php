<?php

namespace App\GraphQL\Query;

use App\Keyword;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\DB;

class MapKeywordsQuery extends Query
{
    protected $attributes = [
        'name' => 'Keywords'
    ];
    
    public function type()
    {
        return GraphQL::type('KeywordsPerPage');
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'keywords' => [
                'type' => Type::string(),
                'description' => 'Search by keywords'
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
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        $query = Keyword::query();
        
        if (isset($args['keywords'])) {
            $value = $args['keywords'];
            $query->where(function ($query) use ($value) {
                $query->where('name', 'like', '%' . $value . '%');
            });
        }
//        if (isset($args['findBy'])) {
//            switch ($args['findBy']) {
//                case 'country':
//                    $query->where('country', 'LIKE', str_to_latin($args['country']));
//                    break;
//                case 'city':
//                    $query->where('city', 'LIKE', str_to_latin($args['city']));
//                    $query->where('country', 'LIKE', str_to_latin($args['country']));
//                    break;
//                case 'region':
//                    $query->where('region', 'LIKE', str_to_latin($args['region']));
//                    $query->where('country', 'LIKE', str_to_latin($args['country']));
//                    break;
//                case 'street':
//                    $query->where('street', 'LIKE', str_to_latin($args['street']));
//                    $query->where('city', 'LIKE', str_to_latin($args['city']));
//                    $query->where('country', 'LIKE', str_to_latin($args['country']));
//                    break;
//                case 'address':
//                    $query->where('street_number', '=', trim($args['street_number']));
//                    $query->where('street', 'LIKE', str_to_latin($args['street']));
//                    $query->where('city', 'LIKE', str_to_latin($args['city']));
//                    $query->where('country', 'LIKE', str_to_latin($args['country']));
//                    break;
//                default:
//                    return null;
//                    break;
//            }
//        }
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
        $limit = $args['limit'] ?? 25;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;
//        if(isset($args['business_id'])) {
//            $query->where('business_id', $args['business_id']);
//        }
        $count = $query->count();
        $query->take($limit)->skip($skip);
//        $query->select([
//            'business_locations.id as id',
//            'business_locations.*',
//            DB::raw('(select count(*) from business_job_locations,business_jobs where business_jobs.id = business_job_locations.job_id AND business_job_locations.status = 1 AND business_job_locations.location_id = business_locations.id) as jobs_count_open'),
//            DB::raw('(select count(*) from business_job_locations,business_jobs where business_jobs.id = business_job_locations.job_id AND business_job_locations.status = 0 AND business_job_locations.location_id = business_locations.id) as jobs_count_close')
//        ]);
        $data = $query->get()->all();
        
        return array(
            'items' => $data,
            'pages' => ceil($count / $limit),
            'count' => $count,
            'current_page' => $page
        );
    }
}
