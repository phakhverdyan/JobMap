<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class WorldLanguagesType extends GraphQLType
{
    protected $attributes = [
        'name' => 'World language',
        'description' => 'World language for businesses'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'items' => [
                'type' => Type::listOf(\GraphQL::type('WorldLanguage')),
                'description' => 'World language Items'
            ],
            'default' => [
                'type' => Type::listOf(\GraphQL::type('WorldLanguage')),
                'description' => 'Get default item by ids'
            ],
        ];
    }
}
