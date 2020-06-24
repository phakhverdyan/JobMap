<?php

namespace App\GraphQL\Type\User;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\PictureResumeField;

class SocialUserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User from social',
        'description' => 'A user'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::string(),
                'description' => 'User Social ID'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'first_name' => [
                'type' => Type::string(),
                'description' => 'The first name of user'
            ],
            'last_name' => [
                'type' => Type::string(),
                'description' => 'The last name of user'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'Social network token'
            ],
            'birthday' => [
                'type' => Type::string(),
                'description' => 'User Birth Date'
            ],
            'userpic' => [
                'type' => Type::string(),
                'description' => 'User Picture'
            ],
            'userpic_original' => [
                'type' => Type::string(),
                'description' => 'User Picture'
            ],
            'social' => [
                'type' => Type::string(),
                'description' => 'User Social Media Type'
            ],
            'gender' => [
                'type' => Type::string(),
                'description' => 'User Gender from Social Media'
            ]
        ];
    }
}
