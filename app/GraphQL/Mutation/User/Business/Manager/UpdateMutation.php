<?php

namespace App\GraphQL\Mutation\User\Business\Manager;

use App\Business\Administrator;
use App\Business\AdministratorPermission;
use App\Business\ManagerLocation;
use App\Business\Permit;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UpdateMutation extends Mutation
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
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email']
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
            'role' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'manager role'
            ],
            'first_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Manager first name'
            ],
            'last_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Manager last name'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Manager email'
            ],
            'permits' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'permits for manager'
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
            $args['role'] . 's'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        $business = \App\Business::where('id', $args['business_id'])->first();

        DB::beginTransaction();
        try {
            //ManagerLocation::where('administrator_id', $args['id'])->delete();

            $administrator = Administrator::find($args['id']);

            $rules = [
                'email' => ['unique:users,email,' . $administrator['user_id']]
            ];
            $this->getValidator($args, $rules);

            $user = User::find($administrator['user_id']);
            if ($user) {
                if ($user['invite_token']) {
                    $user->update([
                        'first_name' => $args['first_name'],
                        'last_name' => $args['last_name'],
                        'username' => strtolower($args['first_name'] . $args['last_name']) . rand('1111', '9999'),
                        'invite_token' => md5($args['business_id'] . $args['first_name'] . $args['last_name'] . $args['email']),
                        'email' => $args['email']
                    ]);
                }
            }

            $permits_on = explode(',', $args['permits']);
            $permits = Permit::where('type', $args['role'])->get()->pluck('id');
            $permits_attach = [];
            foreach ($permits as $permit) {
                $on_off = 0;
                if (in_array($permit,$permits_on)) {
                    $on_off = 1;
                }
                $permits_attach[$permit] = [ 'value' => $on_off ];
            }
            if ($admin = Administrator::find($args['id'])) {
                $admin->permits()->sync($permits_attach);
            }

            if (isset($args['manager_locations_detach']) && !empty($args['manager_locations_detach'])) {
                ManagerLocation::where('administrator_id', $args['id'])->whereIn('location_id', explode(',', $args['manager_locations_detach']))->delete();
            }

            if (isset($args['manager_locations']) && !empty($args['manager_locations'])) {
                $locations = explode(',', $args['manager_locations']);
                // $locationsExist = ManagerLocation::whereIn('location_id', $locations)->get()->pluck('location_id')->toArray();
                $dataInsert = [];

                ManagerLocation::where('administrator_id', $args['id'])->delete();
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

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return null;
        }

        $args['token'] = $this->token;

        return $args;
    }
}
