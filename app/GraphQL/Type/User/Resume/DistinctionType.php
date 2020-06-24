<?php

namespace App\GraphQL\Type\User\Resume;

use App\Distinction;
use App\GraphQL\Fields\Resume\DistinctionHtmlItemsField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class DistinctionType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Distinction',
        'description' => 'User Distinction'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Primary ID'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Distinction ID'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Distinction title',
                'resolve' => function ($root, $args) {
                    if ($root['title_id']) {
                        $item = Distinction::find($root['title_id']);
                        return $item->name;
                    }
                    return $root['title'];
                }
            ],
            'title_id' => [
                'type' => Type::int(),
                'description' => 'Job title_id'
            ],
            'assign_title' => [
                'type' =>\GraphQL::type('AutocompleteResume'),
                'resolve' => function ($root, $args) {
                    if ($root['title_id']) {
                        $item = Distinction::find($root['title_id']);
                        return  [
                            'id' => $root['title_id'],
                            'title' => $item->name,
                        ];
                    }
                    return null;
                }
            ],
            'year' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Distinction year'
            ],
            'html' => DistinctionHtmlItemsField::class,
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
