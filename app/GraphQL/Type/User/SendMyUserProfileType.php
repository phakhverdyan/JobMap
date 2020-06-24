<?php

namespace App\GraphQL\Type\User;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class SendMyUserProfileType extends GraphQLType
{
    protected $attributes = [
        'name' => 'SendMyUserProfile',
        'description' => 'SendMyUserProfile'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'response' => [
                'type' => Type::string(),
                'description' => 'response'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'token'
            ]
        ];
    }
}
