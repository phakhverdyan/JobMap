<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class BusinessUnconfirmedPhoneType extends GraphQLType
{
    protected $attributes = [
        'name' => 'BusinessUnconfirmed phone',
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Phone id'
            ],
            'value' => [
                'type' => Type::string(),
                'description' => 'Phone value'
            ]
        ];
    }
}
