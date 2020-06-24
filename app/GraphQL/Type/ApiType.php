<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ApiType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Api init',
        'description' => ''
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'token' => [
                'type' => Type::string(),
                'description' => 'Auth token for user'
            ]
        ];
    }
}
