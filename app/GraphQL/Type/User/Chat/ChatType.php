<?php

namespace App\GraphQL\Type\User\Chat;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\PictureResumeField;

class ChatType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Chat type',
        'description' => 'Chat type'
    ];

    /**
     * @return array
     */
    public function fields() {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'Primary ID',
            ],
            
            'last_message_id' => [
                'type' => Type::int(),
                'description' => 'Last message ID',
            ],
            
            'last_message' => [
                'type' => \GraphQL::type('ChatMessage'),

                'resolve' => function ($chat, $args) {
                    return $chat['last_message'] ?? null;
                },
            ],

            'members' => [
                'type' => Type::listOf(\GraphQL::type('ChatMember')),
                'description' => 'List of chat members',
            ],

            'opposite_member' => [
                'type' => \GraphQL::type('ChatMember'),
                
                'resolve' => function ($chat, $args) {
                    return $chat['opposite_member'] ?? null;
                },
            ],

            'my_interlocutor' => [
                'type' => \GraphQL::type('ChatInterlocutor'),
                
                'resolve' => function ($chat, $args) {
                    return $chat['my_interlocutor'] ?? null;
                },
            ],

            'count_of_unread_messages' => [
                'type' => Type::int(),
                'description' => 'Count of unread messages in this chat',
            ],

            'secret_token' => [
                'type' => Type::string(),
                'description' => 'Secret token',
            ],

            'token' => [
                'type' => Type::string(),
                'description' => 'JWT token',
            ],
        ];
    }
}
