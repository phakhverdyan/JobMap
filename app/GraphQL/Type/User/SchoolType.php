<?php

namespace App\GraphQL\Type\User;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class SchoolType extends GraphQLType
{
    protected $attributes = [
        'name' => 'School type',
        'description' => 'School type'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'name' => [
                'type' => Type::string(),
                'description' => 'User'
            ],
            'address' => [
                'type' => Type::string(),
                'description' => 'User'
            ],
            'directors' => [
                'type' => Type::listOf(\GraphQL::type('UserAcademy')),
                'description' => 'Children user'
            ],
            'teachers' => [
                'type' => Type::listOf(\GraphQL::type('UserAcademy')),
                'description' => 'Children user'
            ],
            'students' => [
                'type' => Type::listOf(\GraphQL::type('UserAcademy')),
                'description' => 'Children user'
            ],
        ];
    }
}
