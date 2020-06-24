<?php

namespace App\GraphQL\Query\User\Business;

use DB;
use App\Business;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\GraphQL\Extensions\AuthQuery;

class BrandsAllQuery extends AuthQuery
{

    protected $attributes = [
        'name' => 'Brands'
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
            'assignment' => [
                'type' => Type::int(),
                'description' => ''
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
                'description' => 'The locale'
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
        $businessId = $args['business_id'];

        // $query = Business::query();
        // $query->where('id', $businessId)->orWhere('parent_id', $businessId);
        // $query->orderBy('name', 'asc');

        $query = Business::query();
        //$query->whereNull('parent_id');
        $query->where('businesses.id', $businessId)->orWhere('businesses.parent_id', $businessId);
        $query->join('business_administrators', 'business_administrators.business_id','=', 'businesses.id');
        $query->where('business_administrators.user_id', '=', $this->auth->id);

        $query->select([
            'businesses.*',
            //DB::raw('(select count(*) from business_locations where business_locations.business_id = businesses.id AND business_locations.type = "headquarter") as headquarters_count'),
            //DB::raw('(select count(*) from business_locations where business_locations.business_id = businesses.id AND business_locations.type = "location") as locations_count'),
            //DB::raw('(select count(*) from business_jobs where business_jobs.business_id = businesses.id) as jobs_count'),
        ]);

        $limit = $args['limit'] ?? 500;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;

        $count = $query->count();
        //$query->take($limit)->skip($skip);

        $data = $query->distinct()->get()->all();

        return array(
            'items' => $data,
            'pages' => ceil($count / $limit),
            'count' => $count,
            'current_page' => $page
        );




    }
}
