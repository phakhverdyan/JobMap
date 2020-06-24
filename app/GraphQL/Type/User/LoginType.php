<?php

namespace App\GraphQL\Type\User;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class LoginType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Login',
        'description' => ''
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Auth token for user'
            ],
            'last_active_business' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Last Active Business'
            ],
            'redirect' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Redirect url for login'
            ]
        ];
    }
}
