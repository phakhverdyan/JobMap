<?php

namespace App\GraphQL\Type;

use App\GraphQL\Fields\Business\Department\HtmlField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class KeywordsPerPageType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Keywords Per Page',
        'description' => 'Keywords Per Page'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'items' => [
                'type' => Type::listOf(\GraphQL::type('Keyword')),
                'description' => 'Keyword Items'
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
