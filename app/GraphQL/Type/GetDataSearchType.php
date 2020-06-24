<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class GetDataSearchType extends GraphQLType
{
    protected $attributes = [
        'name' => 'GeoDataSearch',
        'description' => 'GetDataSearch'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::string(),
                'description' => 'id street'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'street'
            ]
        ];
    }
}
