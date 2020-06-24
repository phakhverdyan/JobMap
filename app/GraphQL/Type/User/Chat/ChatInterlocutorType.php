<?php

namespace App\GraphQL\Type\User\Chat;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\Resume\MessagesHtmlField;
use Carbon\Carbon;

class ChatInterlocutorType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ChatInterlocutor type',
        'description' => 'ChatInterlocutor type'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'Primary ID',
            ],

            'chat_id' => [
                'type' => Type::id(),
                'description' => 'Chat ID',
            ],

            'chat' => [
                'type' => \GraphQL::type('User'),

                'resolve' => function ($root, $args) {
                    return ($root['chat']) ?? null;
                },
            ],

            'business_id' => [
                'type' => Type::id(),
                'description' => 'Business ID',
            ],

            'business' => [
                'type' => \GraphQL::type('Business'),

                'resolve' => function ($root, $args) {
                    return ($root['business']) ?? null;
                },
            ],

            'user_id' => [
                'type' => Type::id(),
                'description' => 'User ID',
            ],

            'user' => [
                'type' => \GraphQL::type('User'),

                'resolve' => function ($root, $args) {
                    return ($root['user']) ?? null;
                }
            ],

            'last_read_message_id' => [
                'type' => Type::id(),
                'description' => 'Last read chat message ID',
            ],

            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],

            'count_of_unread_messages' => [
                'type' => Type::int(),
                'description' => 'Count of unread messages in this chat',
            ],

            'total_count_of_unread_messages' => [
                'type' => Type::int(),
                'description' => 'Total count of unread messages',
            ],
        ];
    }
}
