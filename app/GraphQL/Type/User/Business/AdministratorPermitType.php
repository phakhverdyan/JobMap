<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class AdministratorPermitType extends GraphQLType
{
    protected $attributes = [
        'name' => 'AdministratorPermit Business Administrator',
        'description' => 'AdministratorPermit business Administrator'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Permit id'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of permit',
            ],
            'title_fr' => [
                'type' => Type::string(),
                'description' => 'The title of permit on Franch',
            ],
            'pivot_value' => [
                'type' => Type::int(),
                'description' => 'The value of permit administrator',
                'resolve' => function($root, $args){
                    return $root['pivot']->value;
                }
            ],
            'pivot_business_id' => [
                'type' => Type::string(),
                'description' => 'The locbusiness_id of permit administrator',
                'resolve' => function($root, $args){
                    return $root['pivot']->business_id;
                }
            ],
            'localized_title' => [
                'type' => Type::string(),
                'description' => 'The localized title of permit',
            ],
        ];
    }
}
