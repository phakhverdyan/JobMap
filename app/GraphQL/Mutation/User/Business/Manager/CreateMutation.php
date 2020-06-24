<?php

namespace App\GraphQL\Mutation\User\Business\Manager;

use App\Business;
use App\Business\Administrator;
use App\Business\AdministratorPermission;
use App\Business\Location;
use App\Business\ManagerLocation;
use App\Business\Permit;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\Mail\UserNotifications;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CreateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'New Business Manager'
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
            //Administrator::BRANCH_ROLE
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
            $user = User::where('email', $args['email'])->first();

            if ($user) {
                //send notification to user
                Mail::to($args['email'])->queue(new UserNotifications($user, 'ADD_TO_BUSINESS', [
                    'business_id' => $args['business_id'],
                ], $this->auth->language_prefix));

                // Mail::to($user->email)->queue(new \App\Mail\ManagerInvitation($user, $this->auth, $business, 'INVITE', $this->auth->language_prefix));
            } else {
                $user = new User();
                $user->first_name = $args['first_name'];
                $user->last_name = $args['last_name'];
                $user->email = $args['email'];
                $user->username = strtolower($args['first_name'] . $args['last_name']) . rand('1111', '9999');
                $user->invite_token = md5($args['business_id'] . $args['first_name'] . $args['last_name'] . $args['email']);
                $user->invite_business_id = $args['business_id'];
                $user->invite_user_id = $this->auth->id;
                $user->password = '';
                $user->run_first = 1;
                $user->save();

                Mail::to($user->email)->queue(new \App\Mail\ManagerInvitation($user, $this->auth, $business, 'INVITE', $this->auth->language_prefix));

                // Mail::to($args['email'])->queue(new UserNotifications($user, $this->auth, $business, 'INVITE', [
                //     'business_id' => $args['business_id'],
                // ]));
            }

            $admin = new Administrator();
            $admin->user_id = $user['id'];
            $admin->business_id = $args['business_id'];
            $admin->role = $args['role'];
            $admin->save();

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
            $admin->permits()->attach($permits_attach);

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
                                'administrator_id' => $admin['id'],
                                'location_id' => $locationId
                            );
                        }
                        $managerLocation = new ManagerLocation();
                        $managerLocation->insert($dataInsert);
                        break;
                }
            } else {
                if (isset($args['manager_locations']) && !empty($args['manager_locations'])) {
                    $locations = explode(',', $args['manager_locations']);
                    $dataInsert = [];
                    foreach ($locations as $location) {
                        $dataInsert[] = array(
                            'administrator_id' => $admin['id'],
                            'location_id' => $location
                        );
                    }
                    $managerLocation = new ManagerLocation();
                    $managerLocation->insert($dataInsert);
                }
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            throw $exception;
        }

        // Mail::to(env('TEAM_EMAIL', 'atom-danil@yandex.ru'))->queue(new \App\Mail\ManagerCreated($business, $user, $admin, $this->auth->language_prefix));
        $args['id'] = $admin->id;
        $args['token'] = $this->token;
        return $args;
    }
}
