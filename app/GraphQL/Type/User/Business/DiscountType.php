<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class DiscountType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Discount',
        'description' => 'Discount'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Discount id'
            ],
            'business' => [
                'type' => \GraphQL::type('Business'),
                'resolve' => function ($root, $args) {
                    return ($root['business']) ?? null;
                }
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'System discount name'
            ],
            'code' => [
                'type' => Type::string(),
                'description' => 'Discount code'
            ],
            'off_an_plans_value' => [
                'type' => Type::int(),
                'description' => 'Discount plan value'
            ],
            'off_an_plans_type' => [
                'type' => Type::string(),
                'description' => 'Discount plan type ($,%)'
            ],
            'off_on_month_value' => [
                'type' => Type::int(),
                'description' => 'Discount month value'
            ],
            'off_on_month_type' => [
                'type' => Type::string(),
                'description' => 'Discount month type ($,%)'
            ],
            'duration_value' => [
                'type' => Type::int(),
                'description' => 'Discount duration'
            ],
            'status' => [
                'type' => Type::int(),
                'description' => 'Status'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
