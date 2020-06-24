<?php

namespace App\GraphQL\Type\User\Resume;

use App\GraphQL\Fields\Resume\LanguageHtmlItemsField;
use App\WorldLanguage;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class LanguageType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Languages',
        'description' => 'User languages'
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
                'description' => 'User ID'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Language title',
                'resolve' => function ($root, $args) {
                    if ($root['title_id']) {
                        $item = WorldLanguage::find($root['title_id']);
                        $name = $item->name;
                        return $name;
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
                        $item = WorldLanguage::find($root['title_id']);
                        $title = $item->name;
                        return  [
                            'id' => $root['title_id'],
                            'title' => $title,
                        ];
                    }
                    return null;
                }
            ],
            'level' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Language level'
            ],
            'html' => LanguageHtmlItemsField::class,
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
