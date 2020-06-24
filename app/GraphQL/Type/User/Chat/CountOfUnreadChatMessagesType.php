<?php

namespace App\GraphQL\Type\User\Chat;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\Resume\MessagesHtmlField;

class CountOfUnreadChatMessagesType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Count of unread chat messages',
        'description' => 'Count of unread chat messages',
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'total_count' => [
                'type' => Type::int(),
                'description' => 'Total count of unread chat messages',
            ],
            
            'count' => [
                'type' => Type::int(),
                'description' => 'Count of unread messages in the chat',
            ],

            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
