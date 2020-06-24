<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class IndeedAccountType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Indeed account',
        'description' => 'Indeed account',
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'id'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'Email'
            ],
            'password' => [
                'type' => Type::string(),
                'description' => 'Password'
            ],
        ];
    }
}
