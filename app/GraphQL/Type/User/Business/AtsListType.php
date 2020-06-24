<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class AtsListType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Ats',
        'description' => 'Ats '
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'ID'
            ],
            'items' => [
                'type' => Type::listOf(\GraphQL::type('Ats')),
                'description' => 'Import user email'
            ],
            'count' => [
                'type' => Type::int(),
                'description' => 'Count of ats'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
