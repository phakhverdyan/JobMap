<?php

namespace App\GraphQL\Query\User\Business;

use App\Business;
use App\Business\Administrator;
use App\GraphQL\OptionalAuth;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\Log;

class BrandsQuery extends Query
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
        if ($bId = Business::find($args['business_id'])->parent_id) {
            $businessId = $bId;
        }

        $query = Business::select(['businesses.*']);
        $query->where('businesses.id', $businessId)->orWhere('businesses.parent_id', $businessId);

        if (isset($args['keywords'])) {
            $value = $args['keywords'];
            $query->where(function ($query) use ($value) {
                $query->where('name', 'like', '%' . $value . '%');
                $query->orWhere('name_fr', 'like', '%' . $value . '%');
                $query->orWhere('street', 'like', '%' . $value . '%');
                $query->orWhere('city', 'like', '%' . $value . '%');
                $query->orWhere('region', 'like', '%' . $value . '%');
                $query->orWhere('country', 'like', '%' . $value . '%');
                $items = explode(' ', $value);
                foreach ($items as $item) {
                    $query->orWhere('name', 'like', '%' . $item . '%');
                    $query->orWhere('name_fr', 'like', '%' . $item . '%');
                    $query->orWhere('street', 'like', '%' . $item . '%');
                    $query->orWhere('city', 'like', '%' . $item . '%');
                    $query->orWhere('region', 'like', '%' . $item . '%');
                    $query->orWhere('country', 'like', '%' . $item . '%');
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
            //$query->where('type', $args['type']);
        }
        $limit = $args['limit'] ?? 25;
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

        return array(
            'items' => $businesses,
            'pages' => ceil($count / $limit),
            'count' => $count,
            'current_page' => $page
        );
    }
}
