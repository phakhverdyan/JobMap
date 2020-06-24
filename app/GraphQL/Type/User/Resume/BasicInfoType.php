<?php

namespace App\GraphQL\Type\User\Resume;

use App\GraphQL\Fields\TokenField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class BasicInfoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Basic info',
        'description' => 'User Basic Info'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Primary ID'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'User ID'
            ],
            'headline' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Resume Headline'
            ],
            'headline_fr' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Resume Headline FR'
            ],
            'website' => [
                'type' => Type::string(),
                'description' => 'Resume Website'
            ],
            'about' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Resume About User'
            ],
            'about_fr' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Resume About User FR'
            ],
            'is_complete' => [
                'type' => Type::int(),
                'description' => 'Complete Status'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
            'facebook' => [
                'type' => Type::string(),
                'description' => 'facebook'
            ],
            'instagram' => [
                'type' => Type::string(),
                'description' => 'instagram'
            ],
            'linkedin' => [
                'type' => Type::string(),
                'description' => 'linkedin'
            ],
            'twitter' => [
                'type' => Type::string(),
                'description' => 'twitter'
            ],
        ];
    }
}
