<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ManagerType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Manager',
        'description' => 'Business Manager'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Manager id'
            ],
            'business_id' => [
                'type' => Type::id(),
                'description' => 'Business id'
            ],
            'user' => [
                'type' => \GraphQL::type('User'),
                'description' => 'User First name',
            ],
            'permits' => [
                'type' => Type::listOf(\GraphQL::type('AdministratorPermit')),
                'description' => 'User First name',
            ]
            ,
            'last_name' => [
                'type' => Type::string(),
                'description' => 'User Last name',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'User Email',
            ],
            'role' => [
                'type' => Type::string(),
                'description' => 'Role'
            ],
            'invite' => [
                'type' => Type::int(),
                'description' => 'Invite status'
            ],
            'assign_locations' => [
                'type' => Type::listOf(\GraphQL::type('BusinessLocation')),
                'resolve' => function ($root, $args) {
                    $locations = [];
                    foreach ($root['assign_locations'] as $location) {
                        $locations[] = $location['location'];
                    }
                    return $locations;
                }
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ]
        ];
    }
}
