<?php

namespace App\GraphQL\Type\User\Business;

use App\GraphQL\Fields\Business\Department\HtmlField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class DepartmentsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Departments',
        'description' => 'Business Departments'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'items' => [
                'type' => Type::listOf(\GraphQL::type('BusinessDepartment')),
                'description' => 'Department Items'
            ],
            'pages' => [
                'type' => Type::int(),
                'description' => 'Count pages by limit'
            ],
            'current_page' => [
                'type' => Type::int(),
                'description' => 'Current page'
            ],
            'default' => [
                'type' => Type::listOf(\GraphQL::type('BusinessDepartment')),
                'description' => 'Get default item by ids'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ]
        ];
    }
}
