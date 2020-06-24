<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business\Administrator;
use App\GraphQL\Extensions\AuthQuery;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ManagersQuery extends AuthQuery
{
    protected $attributes = [
        'name' => 'Locations'
    ];

    public function type()
    {
        return GraphQL::type('LocationManagers');
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
            'managers_type' => [
                'type' => Type::string(),
                'description' => 'Location type by role'
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
        $userTable = User::getTableName();
        $administratorTable = Administrator::getTableName();

        $queryA = Administrator::where([
            'business_id' => $args['business_id'],
            // 'user_id' => $this->auth->id,
            'role' => Administrator::ADMIN_ROLE
        ])->first();

        $query = Administrator::join($userTable, $userTable . '.id', '=', $administratorTable . '.user_id');
        if (isset($args['keywords'])) {
            $value = $args['keywords'];
            $query->where(function ($query) use ($value, $userTable) {
                $query->where($userTable . '.first_name', 'like', '%' . $value . '%');
                $query->orWhere($userTable . '.last_name', 'like', '%' . $value . '%');
            });
        }

        if (isset($args['assignment'])) {
            $query->whereNotIn($administratorTable . '.id', function ($q) use ($args) {
                $q->select('administrator_id')
                    ->from('business_manager_locations')
                    ->where('location_id', $args['location_id']);
            });
        }

        if (isset($args['managers_type'])) {
            $query->where('role', $args['managers_type']);
        }

        if (isset($args['sort'])) {
            $order = $args['order'] ?? 'asc';
            if ($args['sort'] == 'created_date') {
                $query->orderBy($administratorTable . '.created_at', $order);
            } else if ($args['sort'] == 'role') {
                $query->orderBy('role', $order);
            } else {
                $query->orderBy($args['sort'], $order);
            }
        } else {
            $query->orderBy($userTable . '.first_name', 'asc');
        }
        $query->where('business_id', $args['business_id']);
        if(!$queryA) {
            $query->where('role', '<>', 'admin');
        }
        $count = $query->count();
        $limit = $args['limit'] ?? 25;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;
        $query->take($limit)->skip($skip);

        $select = [
            $administratorTable . '.id as id',
            $administratorTable . '.business_id',
            $administratorTable . '.created_at',
            $administratorTable . '.user_id',
            $userTable . '.first_name',
            $userTable . '.last_name',
            $userTable . '.email',
            $userTable . '.user_pic_custom',
            $userTable . '.user_pic',
            $administratorTable . '.role',
            DB::raw('(select count(*) from business_manager_locations where business_administrators.id = business_manager_locations.administrator_id) as locations_count')
        ];
        $data = $query->select($select)->get()->all();

        if (isset($args['locale'])) {
            App::setLocale($args['locale']);
        }

        return array(
            'items' => $data,
            'pages' => round($count / $limit, 0, PHP_ROUND_HALF_UP),
            'current_page' => $page,
            'token' => $this->token
        );
    }
}
