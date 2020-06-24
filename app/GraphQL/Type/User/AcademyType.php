<?php

namespace App\GraphQL\Type\User;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class AcademyType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Academy type',
        'description' => 'Academy type'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'user' => [
                'type' => \GraphQL::type('UserAcademy'),
                'description' => 'User'
            ],
            'children_active' => [
                'type' => Type::listOf(\GraphQL::type('UserAcademy')),
                'description' => 'Children user'
            ],
            'children_inactive' => [
                'type' => Type::listOf(\GraphQL::type('UserAcademy')),
                'description' => 'Children user'
            ],
        ];
    }
}
