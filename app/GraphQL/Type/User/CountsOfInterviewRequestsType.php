<?php

namespace App\GraphQL\Type\User;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\Resume\MessagesHtmlField;

class CountsOfInterviewRequestsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Count of upcoming interview requests',
        'description' => 'Count of upcoming interview requests',
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'upcoming' => [
                'type' => Type::int(),
                'description' => 'Count of upcoming interview requests',
            ],

            'pending' => [
                'type' => Type::int(),
                'description' => 'Count of pending interview requests',
            ],

            'archived' => [
                'type' => Type::int(),
                'description' => 'Count of archived interview requests',
            ],

            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
