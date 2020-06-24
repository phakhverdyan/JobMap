<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class BusinessSizeType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business size',
        'description' => 'Business size'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Size id'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Size name'
            ]
        ];
    }
}
