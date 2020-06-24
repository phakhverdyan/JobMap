<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class TaxType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Tax',
        'description' => 'Tax'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Tax id'
            ],

            'code' => [
                'type' => Type::string(),
                'description' => 'Code'
            ],
            'province_fr' => [
                'type' => Type::string(),
                'description' => 'Province France'
            ],
            'province_en' => [
                'type' => Type::string(),
                'description' => 'Province English'
            ],
            'type_1' => [
                'type' => Type::string(),
                'description' => 'First tax name'
            ],
            'rate_1' => [
                'type' => Type::string(),
                'description' => 'First tax rate'
            ],
            'type_2' => [
                'type' => Type::string(),
                'description' => 'Second tax name'
            ],
            'rate_2' => [
                'type' => Type::string(),
                'description' => 'Second tax rate'
            ],

            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
