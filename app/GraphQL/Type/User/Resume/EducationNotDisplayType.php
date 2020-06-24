<?php

namespace App\GraphQL\Type\User\Resume;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class EducationNotDisplayType extends GraphQLType
{
    protected $attributes = [
        'name' => 'EducationNotDisplay',
        'description' => 'User Education Not Display'
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
            'not_education' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'not display'
            ],
        ];
    }
}
