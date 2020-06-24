<?php

namespace App\GraphQL\Mutation\User\Business\Manager;

use App\Business;
use App\Business\Administrator;
use App\Business\AdministratorPermission;
use App\Business\ManagerLocation;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SetAdminMutation extends Mutation
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
                'description' => 'Department id'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
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
        /*$this->roles = [
            Administrator::MANAGER_ROLE
        ];*/
        //set permissions for this object
        /*$this->permissions = [
            'admins'
        ];*/
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        DB::beginTransaction();
        try {

            Administrator::where('business_id', $args['business_id'])->where('role', Administrator::ADMIN_ROLE)->update(['role' => Administrator::MANAGER_ROLE]);

            Administrator::whereId($args['id'])->update(['role' => Administrator::ADMIN_ROLE]);

            $admin = Administrator::findOrFail($args['id']);

            $user_admin = User::find($admin->user_id);
            $business = Business::find($args['business_id']);

            if (isset($args['role']) && $args['role'] == 'manager') {
                // the manager now is a manager
                Mail::to($user_admin->email)->queue(new \App\Mail\ManagerUpgraded($business, 'UPGRADED', $this->auth->language_prefix));
            }
            elseif (isset($args['role']) && $args['role'] == 'branch') {
                // the manager now is a location manager
                Mail::to($this->auth->email)->queue(new \App\Mail\ManagerUpgraded($business, 'RETROGRADED', $this->auth->language_prefix));
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
