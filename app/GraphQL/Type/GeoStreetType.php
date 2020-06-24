<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class GeoStreetType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Geo Street',
        'description' => 'Get street by keywords'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'description' => [
                'type' => Type::string(),
                'description' => 'description item'
            ],
            'id' => [
                'type' => Type::string(),
                'description' => 'id street'
            ],
            'street' => [
                'type' => Type::string(),
                'description' => 'street'
            ],
            'url' => [
                'type' => Type::string(),
                'description' => 'url'
            ]
        ];
    }
}
