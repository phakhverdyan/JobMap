<?php

namespace App\GraphQL\Type\User\Chat;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\Resume\MessagesHtmlField;
use Carbon\Carbon;

class ChatMessageType extends GraphQLType
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
            'id' => [
                'type' => Type::int(),
                'description' => 'Primary ID',
            ],

            'chat_id' => [
                'type' => Type::id(),
                'description' => 'Chat ID',
            ],

            'interlocutor_id' => [
                'type' => Type::id(),
                'description' => 'Interlocutor ID',
            ],

            'interlocutor' => [
                'type' => \GraphQL::type('ChatInterlocutor'),

                'resolve' => function ($chat, $args) {
                    return $chat['interlocutor'] ?? null;
                },
            ],

            'member_id' => [
                'type' => Type::id(),
                'description' => 'Member ID',
            ],

            'member' => [
                'type' => \GraphQL::type('ChatMember'),

                'resolve' => function ($chat, $args) {
                    return $chat['member'] ?? null;
                },
            ],

            'text' => [
                'type' => Type::string(),
                'description' => 'Message text',
            ],

            'interview_request_id' => [
                'type' => Type::id(),
                'description' => 'ID of the attached interview request',
            ],

            'interview_request' => [
                'type' => \GraphQL::type('InterviewRequest'),

                'resolve' => function ($chat, $args) {
                    return $chat['interview_request'] ?? null;
                },
            ],

            'state' => [
                'type' => Type::string(),
                'description' => 'Message state',
            ],

            'read_interlocutors' => [
                'type' => Type::listOf(\GraphQL::type('ChatInterlocutor')),

                'resolve' => function ($chat, $args) {
                    return $chat['read_interlocutors'] ?? [];
                },
            ],

            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],

            'created_at' => [
                'type' => Type::string(),
                'description' => 'Message created date',

                'resolve' => function($root, $args) {
                    if (isset($root['created_at'])) {
                        if (is_string($root['created_at'])) {
                            return (new \DateTime($root['created_at']))->format(\DateTime::ATOM);
                        }

                        return $root['created_at']->format(\DateTime::ATOM);
                    }

                    return null;
                },
            ],

            'chat' => [
                'type' => \GraphQL::type('Chat'),

                'resolve' => function($root, $args) {
                    return ($root['chat']) ?? null;
                },
            ],
        ];
    }
}
