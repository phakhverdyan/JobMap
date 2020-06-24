<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class CodeBitLyJobType extends GraphQLType
{
    protected $attributes = [
        'name' => 'CodeBitLyJob',
        'description' => 'CodeBitLyJob'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'code_bitly' => [
                'type' => Type::string(),
                'description' => 'code_bitly job'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
