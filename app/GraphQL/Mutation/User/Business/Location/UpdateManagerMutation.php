<?php

namespace App\GraphQL\Mutation\User\Business\Location;

use App\Business\Administrator;
use App\Business\JobLocation;
use App\Business\Location;
use App\Business\LocationAmenity;
use App\Business\DepartmentLocation;
use App\Business\ManagerLocation;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;

class UpdateManagerMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Update Manager for Business Location'
    ];

    public function type()
    {
        return GraphQL::type('BusinessLocation');
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
                'description' => 'Location id'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
            ],
            'manager_locations' => [
                'type' => Type::string(),
                'description' => 'Assign managers'
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
            'locations'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        DB::beginTransaction();

        try {
            ManagerLocation::where('location_id', $args['id'])->delete();


            if (isset($args['manager_locations']) && !empty($args['manager_locations'])) {

                $location = Location::findOrFail($args['id']);
                $locationManagerType = $location->managers_type;

                $managerLocation = new ManagerLocation();

                $managers = Administrator::whereIn('id', explode(',', $args['manager_locations']))->get();

                $dataInsert = [];
                foreach ($managers as $manager) {

                    if ($manager->role != $locationManagerType) {
                        continue;
                    }

                    $dataInsert[] = array(
                        'location_id' => $args['id'],
                        'administrator_id' => $manager->getKey()
                    );
                }
                $managerLocation->insert($dataInsert);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return null;
        }


        $data = Location::where([
            'id' => $args['id'],
            'business_id' => $args['business_id']
        ])->first();

        $data['token'] = $this->token;

        return $data;
    }
}
