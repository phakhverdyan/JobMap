<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class LanguageType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Language',
        'description' => 'Get languages list'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::string(),
                'description' => 'Language ID'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Language name'
            ],
            'prefix' => [
                'type' => Type::string(),
                'description' => 'Language prefix'
            ]
        ];
    }
}
