<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class WorldLanguageType extends GraphQLType
{
    protected $attributes = [
        'name' => 'World language',
        'description' => 'World language for businesses'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Primary ID'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Language name En'
            ],
            'name_fr' => [
                'type' => Type::string(),
                'description' => 'Language name Fr'
            ],
            'localized_name' => [
                'type' => Type::string(),
                'description' => 'Localized Language name'
            ],
            'key' => [
                'type' => Type::string(),
                'description' => 'Key for language pack'
            ]
        ];
    }
}
