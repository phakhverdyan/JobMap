<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Category',
        'description' => 'Get category'
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
            'parent_id' => [
                'type' => Type::id(),
                'description' => 'Parent ID'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Name'
            ],
            'name_fr' => [
                'type' => Type::string(),
                'description' => 'Name FR'
            ],
            'localized_name' => [
                'type' => Type::string(),
                'description' => 'Category name',

                'resolve' => function($root, $args) {
                    if (\App::getLocale() != 'en' && in_array(\App::getLocale(), ['fr'])) {
                        return $root['name_' . \App::getLocale()] ?: $root['name'];
                    }

                    return $root['name'];
                },
            ],
        ];
    }
}
