<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class BrandsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Brands',
        'description' => 'Business Brands'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'items' => [
                'type' => Type::listOf(\GraphQL::type('Business')),
                'description' => 'Business Items'
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
