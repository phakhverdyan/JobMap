<?php

namespace App\GraphQL\Type\User;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\PictureResumeField;

class SendReferenceType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Send Reference',
        'description' => ''
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
            'redirect' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Redirect url for login'
            ]
        ];
    }
}
