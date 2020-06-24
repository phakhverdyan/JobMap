<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class JobQuestionType extends GraphQLType
{
    protected $attributes = [
        'name' => 'JobQuestion type',
        'description' => 'JobQuestion type'
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
            'question' => [
                'type' => Type::string(),
                'description' => 'question'
            ],
            'question_fr' => [
                'type' => Type::string(),
                'description' => 'question_fr'
            ],
            'localized_question' => [
                'type' => Type::string(),
                'description' => 'localized_question'
            ],
            'type' => [
                'type' => Type::int(),
                'description' => 'type question'
            ],
            'job_id' => [
                'type' => Type::id(),
                'description' => 'job_id'
            ],
            'job' => [
                'type' => \GraphQL::type('BusinessJob'),
                'description' => 'Question Items'
            ],
            'answers' => [
                'type' => Type::listOf(\GraphQL::type('JobQuestionAnswer')),
                'description' => 'answers for questions job'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
