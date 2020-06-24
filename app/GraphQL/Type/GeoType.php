<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class GeoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Geo',
        'description' => 'Get cities, regions and country by keywords'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'fullName' => [
                'type' => Type::string(),
                'description' => 'Full name item'
            ],
            'city' => [
                'type' => Type::string(),
                'description' => 'City by keywords'
            ],
            'region' => [
                'type' => Type::string(),
                'description' => 'Region for city'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'Country for city'
            ],
            'countryCode' => [
                'type' => Type::string(),
                'description' => 'Country code for country'
            ],
        ];
    }
}
