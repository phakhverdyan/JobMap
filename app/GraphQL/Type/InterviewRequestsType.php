<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\Resume\MessagesHtmlField;

class InterviewRequestsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Interview Requests type',
        'description' => 'Interview Requests type'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            // 'count_of_chat_messages_before' => [
            //     'type' => Type::int(),
            //     'description' => 'Count of chat messages before the current list',
            // ],

            'interview_requests' => [
                'type' => Type::listOf(\GraphQL::type('InterviewRequest')),
                'description' => 'List of chat messages',
            ],

            // 'count_of_chat_messages_after' => [
            //     'type' => Type::int(),
            //     'description' => 'Count of chat messages after the current list',
            // ],
            
            'count_of_pending' => [
                'type' => Type::int(),
                'description' => 'Count of pending interview requests',
            ],

            'count_of_upcoming' => [
                'type' => Type::int(),
                'description' => 'Count of upcoming interview requests',
            ],

            'count_of_archived' => [
                'type' => Type::int(),
                'description' => 'Count of archived interview requests',
            ],

            'total_count' => [
                'type' => Type::int(),
                'description' => 'Count of all interview requests',
            ],

            'current_type' => [
                'type' => Type::string(),
                'description' => 'Current type of interview requests',
            ],

            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
