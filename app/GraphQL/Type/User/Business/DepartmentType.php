<?php

namespace App\GraphQL\Type\User\Business;

use App\GraphQL\Fields\Business\Department\HtmlField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class DepartmentType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Department',
        'description' => 'Business Department'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Location id'
            ],
            'business_id' => [
                'type' => Type::id(),
                'description' => 'Business id'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Department Name En',
            ],
            'name_fr' => [
                'type' => Type::string(),
                'description' => 'Department Name Fr',
            ],
            'localized_name' => [
                'type' => Type::string(),
                'description' => 'Department Name Localized',
            ],
            'status' => [
                'type' => Type::int(),
                'description' => 'Department Status'
            ],
            'created_date' => [
                'type' => Type::string(),
                'description' => 'Department created date',
                'resolve' => function($root, $args){
                    if(isset($root['created_at'])) {
                        return $root['created_at']->format('M d, Y');
                    } else {
                        return null;
                    }
                }
            ],
            'assign_locations' => [
                'type' => Type::listOf(\GraphQL::type('BusinessLocation')),
                'resolve' => function ($root, $args) {
                    $locations = [];
                    foreach ($root['locations'] as $location) {
                        $locations[] = $location['location'];
                    }
                    return $locations;
                }
            ],
            'html' => HtmlField::class,
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ]
        ];
    }
}
