<?php

namespace App\GraphQL\Type\User;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ReferencesType extends GraphQLType
{
    protected $attributes = [
        'name' => 'References type',
        'description' => 'References type'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'incoming' => [
                'type' => Type::listOf(\GraphQL::type('Reference')),
                'description' => 'Children user'
            ],
            'confirmed' => [
                'type' => Type::listOf(\GraphQL::type('Reference')),
                'description' => 'Children user'
            ],
            'requested' => [
                'type' => Type::listOf(\GraphQL::type('Reference')),
                'description' => 'Children user'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
