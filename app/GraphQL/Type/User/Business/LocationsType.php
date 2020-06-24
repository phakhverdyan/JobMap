<?php

namespace App\GraphQL\Type\User\Business;

use App\GraphQL\Fields\Business\Department\HtmlField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class LocationsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Locations',
        'description' => 'Business Locations'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'items' => [
                'type' => Type::listOf(\GraphQL::type('BusinessLocation')),
                'description' => 'Location Items'
            ],
            'all_items' => [
                'type' => Type::listOf(\GraphQL::type('BusinessLocation')),
                'description' => 'All Location Items'
            ],
            'items_u' => [
                'type' => Type::listOf(\GraphQL::type('BusinessLocation')),
                'description' => 'Location Items'
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
            ],
            'business_id' => [
                'type' => Type::id(),
                'description' => 'business_id',
            ],
            'brands' => [
                'type' => Type::listOf(\GraphQL::type('Business')),
                'description' => 'Location Items'
            ],
        ];
    }
}
