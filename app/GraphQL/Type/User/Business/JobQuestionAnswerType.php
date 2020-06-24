<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class JobQuestionAnswerType extends GraphQLType
{
    protected $attributes = [
        'name' => 'JobQuestionAnswer type',
        'description' => 'JobQuestionAnswer type'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'id question'
            ],
            'answer' => [
                'type' => Type::string(),
                'description' => 'answer'
            ],
            'question_id' => [
                'type' => Type::id(),
                'description' => 'question_id'
            ],
            'user_id' => [
                'type' => Type::id(),
                'description' => 'user_id'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
