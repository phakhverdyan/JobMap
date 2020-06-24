<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class InterviewRequestType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Interview request',
        'description' => 'Interview request'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Primary ID'
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

            'type' => [
                'type' => Type::string(),
                'description' => 'Type of interview',
            ],

            'phone_number' => [
                'type' => Type::string(),
                'description' => 'Phone number',
            ],

            'address' => [
                'type' => Type::string(),
                'description' => 'Address',
            ],

            'messenger_identifier' => [
                'type' => Type::string(),
                'description' => 'Messenger identifier',
            ],

            'interviewer_name' => [
                'type' => Type::string(),
                'description' => 'Interviewer name',
            ],

            'date' => [
                'type' => Type::string(),
                'description' => 'Interview date',
            ],

            'state' => [
                'type' => Type::string(),
                'description' => 'State of the interview request',
            ],

            'sender_type' => [
                'type' => Type::string(),
                'description' => 'Type of interview request sender',
            ],
        ];
    }
}
