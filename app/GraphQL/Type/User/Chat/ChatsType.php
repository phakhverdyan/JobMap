<?php

namespace App\GraphQL\Type\User\Chat;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ChatsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Chat type',
        'description' => 'Chat type'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'chats' => [
                'type' => Type::listOf(\GraphQL::type('Chat')),
                'description' => 'List of chats'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
