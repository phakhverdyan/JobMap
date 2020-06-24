<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class CareerLevelsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Career level',
        'description' => 'Career level for businesses'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'items' => [
                'type' => Type::listOf(\GraphQL::type('CareerLevel')),
                'description' => 'Career level Items'
            ],
            'default' => [
                'type' => Type::listOf(\GraphQL::type('CareerLevel')),
                'description' => 'Get default item by ids'
            ],
        ];
    }
}
