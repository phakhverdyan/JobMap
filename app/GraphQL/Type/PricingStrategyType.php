<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class PricingStrategyType extends GraphQLType
{
    protected $attributes = [
        'name' => 'PricingStrategy',
        'description' => 'Pricing Strategy'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'monthly_price' => [
                'type' => Type::int(),
                'description' => 'monthly price number'
            ],
            'candidates' => [
                'type' => Type::int(),
                'description' => 'candidates number'
            ],
            'free_version_candidates' => [
                'type' => Type::int(),
                'description' => 'free_version_candidates number'
            ]
        ];
    }
}
