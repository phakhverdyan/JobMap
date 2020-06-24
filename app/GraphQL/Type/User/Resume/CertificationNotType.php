<?php

namespace App\GraphQL\Type\User\Resume;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class CertificationNotType extends GraphQLType
{
    protected $attributes = [
        'name' => 'CertificationNot',
        'description' => 'User Certification Not'
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
            'not_certification' => [
                'type' => Type::int(),
                'description' => 'not certification'
            ],
            'not_distinction' => [
                'type' => Type::int(),
                'description' => 'not distinction'
            ],
        ];
    }
}
