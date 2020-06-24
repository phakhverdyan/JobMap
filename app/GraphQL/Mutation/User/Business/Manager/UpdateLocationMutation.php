<?php

namespace App\GraphQL\Mutation\User\Business\Manager;

use App\Business;
use App\Business\Administrator;
use App\Business\AdministratorPermission;
use App\Business\Location;
use App\Business\ManagerLocation;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;

class UpdateLocationMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Update Business Department'
    ];

    public function type()
    {
        return GraphQL::type('BusinessManager');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'administrator id'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
            ],
            'type' => [
                'type' => Type::int(),
                'description' => 'type assign/unassign all locations'
            ],
            'manager_locations' => [
                'type' => Type::string(),
                'description' => 'Assign locations'
            ],
            'manager_locations_detach' => [
                'type' => Type::string(),
                'description' => 'Assign locations'
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
        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::FRANCHISE_ROLE,
        ];
        //set permissions for this object
        $this->permissions = [
            Administrator::find($args['id'])->role . 's'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        DB::beginTransaction();
        try {

            if (isset($args['type'])) {
                switch ($args['type']) {
                    case 1:
                    case 3:
                        if ($args['type'] == 1) {
                            $businessIds = Business::where('parent_id', $args['business_id'])->select('id')->get()->pluck('id')->toArray();
                            $businessIds[] = $args['business_id'];
                            $locationIds = Location::whereIn('business_id', $businessIds)->select('id')->get()->pluck('id')->toArray();
                        } else {
                            $locationIds = Location::where('business_id', $args['business_id'])->select('id')->get()->pluck('id')->toArray();
                        }
                        ManagerLocation::where('administrator_id', $args['id'])->whereIn('location_id', $locationIds)->delete();
                        $dataInsert = [];
                        foreach ($locationIds as $locationId) {
                            $dataInsert[] = array(
                                'administrator_id' => $args['id'],
                                'location_id' => $locationId
                            );
                        }
                        $managerLocation = new ManagerLocation();
                        $managerLocation->insert($dataInsert);
                        break;
                    case 2:
                        ManagerLocation::where('administrator_id', $args['id'])->delete();
                        break;
                    case 4:
                        $locationIds = Location::where('business_id', $args['business_id'])->select('id')->get()->pluck('id')->toArray();
                        ManagerLocation::where('administrator_id', $args['id'])->whereIn('location_id', $locationIds)->delete();
                        break;
                }
            } else {
                if (isset($args['manager_locations_detach']) && !empty($args['manager_locations_detach'])) {
                    ManagerLocation::where('administrator_id', $args['id'])->whereIn('location_id', explode(',', $args['manager_locations_detach']))->delete();
                }

                if (isset($args['manager_locations']) && !empty($args['manager_locations'])) {
                    ManagerLocation::where('administrator_id', $args['id'])->delete();
                    $locations = explode(',', $args['manager_locations']);
                    // $locationsExist = ManagerLocation::whereIn('location_id', $locations)->get()->pluck('location_id')->toArray();
                    $dataInsert = [];
                    foreach ($locations as $location) {
                        // if (!in_array($location, $locationsExist)) {
                            $dataInsert[] = array(
                                'administrator_id' => $args['id'],
                                'location_id' => $location
                            );
                        // }
                    }
                    $managerLocation = new ManagerLocation();
                    $managerLocation->insert($dataInsert);
                }
            }
            /*ManagerLocation::where('administrator_id', $args['id'])->delete();

            if (isset($args['manager_locations']) && !empty($args['manager_locations'])) {
                $managerLocation = new ManagerLocation();
                $locations = explode(',', $args['manager_locations']);
                $dataInsert = [];
                foreach ($locations as $location) {
                    $dataInsert[] = array(
                        'administrator_id' => $args['id'],
                        'location_id' => $location
                    );
                }
                $managerLocation->insert($dataInsert);
            }*/

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return null;
        }

        $userTable = User::getTableName();
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
            $permissionTable . '.business',
            $permissionTable . '.managers',
            $permissionTable . '.share',
            $permissionTable . '.contact_candidates',
            $permissionTable . '.contact_employees',
            $permissionTable . '.view_candidates',
            $permissionTable . '.candidates',
            $userTable . '.invite_token'
        ])->first();

        if (!$data) {
            $data['id'] = null;
        } else {

        }

        if (!empty($data['invite_token'])) {
            $data['invite'] = 1;
        } else {
            $data['invite'] = 0;
        }
        $data['token'] = $this->token;

        return $data;
    }
}
