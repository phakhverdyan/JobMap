<?php

namespace App\GraphQL\Type\User;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class SavePreferenceFieldsUserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'SavePreferenceFieldsUser',
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
            'result' => [
                'type' => Type::string(),
                'description' => 'result'
            ]
        ];
    }
}
