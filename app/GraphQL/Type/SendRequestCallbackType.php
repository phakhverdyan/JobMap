<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class SendRequestCallbackType extends GraphQLType
{
    protected $attributes = [
        'name' => 'RequestCallback',
        'description' => 'RequestCallback'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'response' => [
                'type' => Type::string(),
                'description' => 'response work'
            ],
            'message' => [
                'type' => Type::string(),
                'description' => 'response work'
            ],
        ];
    }
}
