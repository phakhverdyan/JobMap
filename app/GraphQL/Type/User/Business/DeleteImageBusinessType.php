<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class DeleteImageBusinessType extends GraphQLType
{
    protected $attributes = [
        'name' => 'DeleteImageBusiness',
        'description' => 'businesses'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'response' => [
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
