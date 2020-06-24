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

class CreateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'New Business Department'
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
            'name' => ['required_without:name_fr', 'string'],
            'name_fr' => ['required_without:name', 'string'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Department Name'
            ],
            'name_fr' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Department Name Fr'
            ],
            'status' => [
                'type' => Type::int(),
                'description' => 'Department type'
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
            Administrator::FRANCHISE_ROLE,
            //Administrator::BRANCH_ROLE,
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
            $data = new Department();
            foreach ($args as $k => $v) {
                if ($k !== 'department_locations' && $k !== 'department_locations_detach')
                    $data->{$k} = $v;
            }
            $data->user_id = $this->auth->id;
            $data->save();

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
                }
            } else {
                if (isset($args['department_locations']) && !empty($args['department_locations'])) {
                    $locations = explode(',', $args['department_locations']);
                    $dataInsert = [];
                    foreach ($locations as $location) {
                        $dataInsert[] = array(
                            'department_id' => $data['id'],
                            'location_id' => $location
                        );
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
        
        if (!$data) {
            return null;
        }
        
        $data['token'] = $this->token;
        
        return $data;
    }
}
