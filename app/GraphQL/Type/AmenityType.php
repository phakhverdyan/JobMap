<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class AmenityType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Amenity',
        'description' => 'Get amenity for businesses'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Primary ID'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Amenity name'
            ],
            'key' => [
                'type' => Type::string(),
                'description' => 'Key for language pack'
            ]
        ];
    }
}
