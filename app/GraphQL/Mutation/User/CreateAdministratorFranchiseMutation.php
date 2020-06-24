<?php

namespace App\GraphQL\Mutation\User;

use App\Business\Administrator;
use App\Business\AdministratorPermission;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\GraphQL\Auth;

class CreateAdministratorFranchiseMutation extends Mutation
{
    use Auth;

    protected $attributes = [
        'name' => 'createAdministratorFranchise'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'business_id' => ['required'],
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'name' => 'business_id',
                'type' => Type::id(),
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

        $admin = new Administrator();
        $admin->user_id = $this->auth->id;
        $admin->business_id = $args['business_id'];
        $admin->role = Administrator::FRANCHISE_ROLE;
        $admin->save();

        $permissions = new AdministratorPermission();
        $permissions->administrator_id = $admin->id;
        $permissions->save();

        $admin['token'] = $this->token;

        return $admin;
    }
}
