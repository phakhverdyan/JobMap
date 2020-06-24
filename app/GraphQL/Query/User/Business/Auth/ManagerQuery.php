<?php

namespace App\GraphQL\Query\User\Business\Auth;

use Exception;
use App\Business\Administrator;
use App\Business\AdministratorPermission;
use App\GraphQL\Extensions\AuthQuery;
use App\User;
use App\GraphQL\AuthBusiness;
use GraphQL;
use App\Business;
use GraphQL\Type\Definition\Type;
use App\Business\ManagerLocation;

class ManagerQuery extends AuthQuery
{
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Locations'
    ];

    public function type()
    {
        return GraphQL::type('BusinessManager');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the administrator'
            ],
            'user_id' => [
                'type' => Type::id(),
                'description' => 'The id of the user'
            ],
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
        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::BRANCH_ROLE
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        /*$userTable = User::getTableName();
        $administratorTable = Administrator::getTableName();
        $permissionTable = AdministratorPermission::getTableName();
        $query = Administrator::join($userTable, $userTable . '.id', '=', $administratorTable . '.user_id')
            ->join($permissionTable, $permissionTable . '.administrator_id', '=', $administratorTable . '.id');
        $query->where($administratorTable . '.id', $args['id']);
        $query->where('business_id', $args['business_id']);

        $data = $query->select([
            $administratorTable . '.id',
            $administratorTable . '.created_at',
            $userTable . '.first_name',
            $userTable . '.last_name',
            $userTable . '.email',
            $administratorTable . '.role',
            $permissionTable . '.jobs',
            $permissionTable . '.locations',
            $permissionTable . '.departments',
            $permissionTable . '.business',
            $permissionTable . '.managers',
            $permissionTable . '.share',
            $permissionTable . '.contact_candidates',
            $permissionTable . '.contact_employees',
            $permissionTable . '.view_candidates',
            $permissionTable . '.candidates',
            $userTable . '.invite_token'
        ])->first();*/

        if ($args['id']) {
            $id = $args['id'];
        } else {
            $user = User::findOrFail($args['user_id']);

            $admin = $user->_managerBusiness($this->businessID)
                          ->first();

            $id = $admin->getKey();
        }

        $data = Administrator::with('user', 'permits')->find($id);

        // All locations for admin
        if ($data->role == Administrator::ADMIN_ROLE) {

            $allLocations = [];

            $query = Business::query()->with('locations');
            $query->where('id', $args['business_id']);
            $query->orWhere('parent_id', $args['business_id']);
            $businesses = $query->get()->all();

            foreach ($businesses as $business) {
                $business->locations->each(function($location) use (&$allLocations) {
                    $allLocations[] = [
                        'location' => $location
                    ];
                });
            }

            $data->assign_locations = $allLocations;
        } else {
            $data->assign_locations = ManagerLocation::with('location')->where('administrator_id', $id)->get(); //->pluck('location');
        }

        if (!$data) {
            $data['id'] = null;
        } else {
            if ($data['invite_token']) {
                $data['invite'] = 1;
            } else {
                $data['invite'] = 0;
            }
        }

        $data['token'] = $this->token;

        return $data;
    }
}
