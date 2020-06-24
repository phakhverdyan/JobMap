<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class KeywordsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Keywords',
        'description' => 'Keywords'
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
            'default' => [
                'type' => Type::listOf(\GraphQL::type('Keyword')),
                'description' => 'Get default item by ids'
            ]
        ];
    }
}
