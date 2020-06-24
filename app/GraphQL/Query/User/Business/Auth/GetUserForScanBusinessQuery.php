<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business\Administrator;
use App\GraphQL\Extensions\AuthQuery;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;

class GetUserForScanBusinessQuery extends AuthQuery
{

    protected $attributes = [
        'name' => 'getUserForScanBusiness'
    ];
    
    public function type()
    {
        return GraphQL::type('User');
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the user for scan business'
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return array
     */
    public function resolve($root, $args)
    {

        $user = User::find($args['id']);

        $user->token = $this->token;
        return $user;
    }
}
