<?php

namespace App\GraphQL\Type\User\Chat;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\Resume\MessagesHtmlField;

class ChatMessagesType extends GraphQLType
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
            'count_of_chat_messages_before' => [
                'type' => Type::int(),
                'description' => 'Count of chat messages before the current list',
            ],

            'chat_messages' => [
                'type' => Type::listOf(\GraphQL::type('ChatMessage')),
                'description' => 'List of chat messages',
            ],

            'count_of_chat_messages_after' => [
                'type' => Type::int(),
                'description' => 'Count of chat messages after the current list',
            ],

            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
