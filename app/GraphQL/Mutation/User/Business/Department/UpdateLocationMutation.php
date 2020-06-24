<?php

namespace App\GraphQL\Mutation\User\Business\Department;

use App\Business;
use App\Business\Administrator;
use App\Business\Department;
use App\Business\DepartmentLocation;
use App\Business\Location;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
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
        'name' => 'Update Locations for Business Department'
    ];
    
    public function type()
    {
        return GraphQL::type('BusinessDepartment');
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
                'description' => 'Department id'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
            ],
            'type' => [
                'type' => Type::int(),
                'description' => 'type assign/unassign all locations'
            ],
            'department_locations' => [
                'type' => Type::string(),
                'description' => 'Assign locations'
            ],
            'department_locations_detach' => [
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
            Administrator::FRANCHISE_ROLE
        ];
        //set permissions for this object
        $this->permissions = [
            'departments'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();
        
        DB::beginTransaction();
        try {
            //DepartmentLocation::where('department_id', $args['id'])->delete();

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
                        DepartmentLocation::where('department_id', $args['id'])->whereIn('location_id', $locationIds)->delete();
                        $dataInsert = [];
                        foreach ($locationIds as $locationId) {
                            $dataInsert[] = array(
                                'department_id' => $args['id'],
                                'location_id' => $locationId
                            );
                        }
                        $departmentLocation = new DepartmentLocation();
                        $departmentLocation->insert($dataInsert);
                        break;
                    case 2:
                        DepartmentLocation::where('department_id', $args['id'])->delete();
                        break;
                    case 4:
                        $locationIds = Location::where('business_id', $args['business_id'])->select('id')->get()->pluck('id')->toArray();
                        DepartmentLocation::where('department_id', $args['id'])->whereIn('location_id', $locationIds)->delete();
                        break;
                }
            } else {
                if (isset($args['department_locations_detach']) && !empty($args['department_locations_detach'])) {
                    DepartmentLocation::where('department_id', $args['id'])->whereIn('location_id', explode(',', $args['department_locations_detach']))->delete();
                }

                if (isset($args['department_locations']) && !empty($args['department_locations'])) {

                    $locations = explode(',', $args['department_locations']);
                    $locationsExist = DepartmentLocation::whereIn('location_id', $locations)->get()->pluck('location_id')->toArray();
                    $dataInsert = [];
                    foreach ($locations as $location) {
                        if (!in_array($location, $locationsExist)) {
                            $dataInsert[] = array(
                                'department_id' => $args['id'],
                                'location_id' => $location
                            );
                        }
                    }
                    $departmentLocation = new DepartmentLocation();
                    $departmentLocation->insert($dataInsert);
                }
            }


            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return null;
        }

        $data = Department::where([
            'id' => $args['id'],
            'business_id' => $args['business_id']
        ])->first();
        
        
        if (!$data) {
            return null;
        }
        
        $data['token'] = $this->token;
        
        return $data;
    }
}
