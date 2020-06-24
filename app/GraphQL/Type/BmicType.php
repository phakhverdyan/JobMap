<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class BmicType extends GraphQLType
{
    protected $attributes = [
        'name' => 'BMIC',
        'description' => 'Get BMIC for businesses'
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
            'flag' => [
                'type' => Type::string(),
                'description' => 'Country Flag'
            ],
            'country_code' => [
                'type' => Type::string(),
                'description' => 'Country code 2 iso'
            ],
            'country_name' => [
                'type' => Type::string(),
                'description' => 'Country name'
            ],
            'coefficient' => [
                'type' => Type::string(),
                'description' => 'coefficient'
            ],


        ];
    }
}
