<?php

namespace App\GraphQL\Type\User;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\PictureResumeField;

class SendVerificationCodeType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Send VerificationCode',
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
            'response' => [
                'type' => Type::string(),
                'description' => 'Response'
            ]
        ];
    }
}
