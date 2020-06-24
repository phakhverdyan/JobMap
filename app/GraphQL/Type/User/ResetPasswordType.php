<?php

namespace App\GraphQL\Type\User;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ResetPasswordType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Reset Password',
        'description' => ''
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'response' => [
                'type' => Type::string(),
                'description' => 'Response'
            ]
        ];
    }
}
