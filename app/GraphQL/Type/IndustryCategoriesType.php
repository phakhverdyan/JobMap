<?php

namespace App\GraphQL\Type;

use App\Industry;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class IndustryCategoriesType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Industry Categories',
        'description' => 'Get industry Categories'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Industry parent id'
            ],
            'text' => [
                'type' => Type::string(),
                'description' => 'Industry parent name'
            ],
            'children' => [
                'type' => Type::listOf(\GraphQL::type('Industry')),
                'description' => 'Industry parent name',
                'resolve' => function ($root, $args) {
                    $data = Industry::query()->select(['id', 'parent_id', 'name as text'])->where('parent_id', $root['id'])->get()->all();
                    
                    return $data;
                }
            ]
        ];
    }
}
