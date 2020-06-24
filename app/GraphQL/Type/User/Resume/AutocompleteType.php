<?php

namespace App\GraphQL\Type\User\Resume;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class AutocompleteType extends GraphQLType
{
    protected $attributes = [
        'name' => 'AutocompleteResume',
        'description' => 'AutocompleteResume'
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
                'description' => 'title',
                'resolve' => function ($root, $args) {
                    return $root['title'];
                }
            ],
        ];
    }
}
