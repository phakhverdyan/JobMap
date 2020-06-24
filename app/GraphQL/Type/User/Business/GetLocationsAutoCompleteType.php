<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class GetLocationsAutoCompleteType extends GraphQLType
{
    protected $attributes = [
        'name' => 'GetLocationsAutoComplete',
        'description' => 'GetLocationsAutoComplete'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'name' => [
                'type' => Type::string(),
                'description' => 'name location'
            ],
            'address' => [
                'type' => Type::string(),
                'description' => 'address location',
                'resolve' => function ($root, $args) {
                    $street = $root['street'] ? $root['street'] . "," : "";
                    $city = $root['city'] . ",";
                    $region = $root['region'] ? $root['region'] . "," : "";
                    $country = $root['country'] ? $root['country'] : "";
                    return $street . $city . $region . $country;
                }
            ],
            'id' => [
                'type' => Type::string(),
                'description' => 'id location'
            ]
        ];
    }
}
