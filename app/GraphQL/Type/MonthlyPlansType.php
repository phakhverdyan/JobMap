<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class MonthlyPlansType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Monthly Plan',
        'description' => 'Get monthly plan list'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'items' => [
                'type' => Type::listOf(\GraphQL::type('MonthlyPlan')),
                'description' => 'Monthly plan Items'
            ],
            'coefficient' => [
                'type' =>  Type::string(),
                'description' => 'Coefficient bmic'
            ]
        ];
    }
}
