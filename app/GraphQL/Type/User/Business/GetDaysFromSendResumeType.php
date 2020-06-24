<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class GetDaysFromSendResumeType extends GraphQLType
{
    protected $attributes = [
        'name' => 'GetDaysFromSendResume',
        'description' => 'GetDaysFromSendResume '
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'days' => [
                'type' => Type::int(),
                'description' => 'days'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
