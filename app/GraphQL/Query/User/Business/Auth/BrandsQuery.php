<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business;
use App\Business\Administrator;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\GraphQL\OptionalAuth;

class BrandsQuery extends Query
{
    use OptionalAuth;

    protected $attributes = [
        'name' => 'BrandsAuth'
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

        $UserManager = Administrator::where('business_id', $businessId)->where('user_id', $this->auth->id)->first();
        //log_info($UserManager);
        if(!empty($UserManager) && $UserManager->role != Administrator::ADMIN_ROLE){
            $query->join("business_locations", "business_locations.business_id", "=", "businesses.id")
                ->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_locations.id")
                ->where("business_manager_locations.administrator_id", $UserManager['id']);
        }

        if (isset($args['keywords'])) {
            $value = $args['keywords'];
            $query->where(function ($query) use ($value) {
                $query->where('businesses.name', 'like', '%' . $value . '%');
                $query->orWhere('businesses.name_fr', 'like', '%' . $value . '%');
                $query->orWhere('businesses.street', 'like', '%' . $value . '%');
                $query->orWhere('businesses.city', 'like', '%' . $value . '%');
                $query->orWhere('businesses.region', 'like', '%' . $value . '%');
                $query->orWhere('businesses.country', 'like', '%' . $value . '%');
                $items = explode(' ', $value);
                foreach ($items as $item) {
                    $query->orWhere('businesses.name', 'like', '%' . $item . '%');
                    $query->orWhere('businesses.name_fr', 'like', '%' . $item . '%');
                    $query->orWhere('businesses.street', 'like', '%' . $item . '%');
                    $query->orWhere('businesses.city', 'like', '%' . $item . '%');
                    $query->orWhere('businesses.region', 'like', '%' . $item . '%');
                    $query->orWhere('businesses.country', 'like', '%' . $item . '%');
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
            $query->orderBy('businesses.name', 'asc');
        }
        if (isset($args['type'])) {
            //$query->where('type', $args['type']);
        }
        $limit = $args['limit'] ?? 25;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;

        $count = $query->count();
        $query->take($limit)->skip($skip);

        // $query->select('*', 'businesses.id as id');
        $data = $query->distinct('*')->get();

        return array(
            'items' => $data,
            'pages' => ceil($count / $limit),
            'count' => $count,
            'current_page' => $page,
            'token' => $this->token,
        );
    }
}
