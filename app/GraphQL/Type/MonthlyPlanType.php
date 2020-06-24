<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class MonthlyPlanType extends GraphQLType
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
            'id' => [
                'type' => Type::int(),
                'description' => 'ID'
            ],
            'business_id' => [
                'type' => Type::int(),
                'description' => 'ID'
            ],
            'order' => [
                'type' => Type::int(),
                'description' => 'Monthly plan order'
            ],
            'applicants' => [
                'type' => Type::int(),
                'description' => 'Applicants count'
            ],
            'price' => [
                'type' => Type::string(),
                'description' => 'Monthly plan price'
            ],
            'plan_name' => [
                'type' => Type::string(),
                'description' => 'Monthly plan name'
            ],
            'country_code' => [
                'type' => Type::string(),
                'description' => 'Country code'
            ],
            'is_canceled' => [
                'type' => Type::int(),
                'description' => 'Is canceled'
            ]
        ];
    }
}
