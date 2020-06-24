<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class HowToStartGotItType extends GraphQLType
{
    protected $attributes = [
        'name' => 'HowToStartGotIt',
        'description' => 'businesses'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'result' => [
                'type' => Type::string(),
                'description' => 'result action'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ]
        ];
    }
}
