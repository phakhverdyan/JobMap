<?php

namespace App\GraphQL\Type\User\Business;

use App\GraphQL\Fields\Business\Location\CareerHtmlField;
use App\GraphQL\Fields\Business\Location\HtmlField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\Storage;

class BusinessesType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Businesses',
        'description' => 'businesses'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'items' => [
                'type' => Type::listOf(\GraphQL::type('MapBusiness')),
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
            ]
        ];
    }
}
