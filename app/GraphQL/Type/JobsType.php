<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class JobsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Job type',
        'description' => 'Job type for businesses'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'items' => [
                'type' => Type::listOf(\GraphQL::type('JobType')),
                'description' => 'Job type Items'
            ],
            'default' => [
                'type' => Type::listOf(\GraphQL::type('JobType')),
                'description' => 'Get default item by ids'
            ],
        ];
    }
}
