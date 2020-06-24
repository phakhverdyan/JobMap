<?php

namespace App\GraphQL\Type\User\Resume;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class SentResumesType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Sent Resume',
        'description' => 'Sent Resume'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'items' => [
                'type' => Type::listOf(\GraphQL::type('SentResume')),
                'description' => 'Sent Items'
            ],
            'pages' => [
                'type' => Type::int(),
                'description' => 'Count pages by limit'
            ],
            'count' => [
                'type' => Type::int(),
                'description' => 'Count items'
            ],
            'current_page' => [
                'type' => Type::int(),
                'description' => 'Current page'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ]
        ];
    }
}
