<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class KeywordType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Keyword',
        'description' => 'Users keyword'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Primary ID',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Keyword name',
            ],
        ];
    }
}
