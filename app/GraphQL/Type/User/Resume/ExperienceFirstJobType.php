<?php

namespace App\GraphQL\Type\User\Resume;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ExperienceFirstJobType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ExperienceFirstJob',
        'description' => 'User experience first job'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
            'first_job' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'first job'
            ],
        ];
    }
}
