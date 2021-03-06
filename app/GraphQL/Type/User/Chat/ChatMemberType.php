<?php

namespace App\GraphQL\Type\User\Chat;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\Resume\MessagesHtmlField;
use Carbon\Carbon;

class ChatMemberType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ChatMember type',
        'description' => 'ChatMember type'
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

            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
