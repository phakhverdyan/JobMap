<?php

namespace App\GraphQL\Type\User\Resume;

use App\GraphQL\Fields\Resume\SkillHtmlItemsField;
use App\User\Resume\Autocomplete\Skill;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\App;

class SkillType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Skills',
        'description' => 'User skills'
    ];
    
    /**
     * @return array
     */
    public $countSkillsBasic = 196;
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
                'description' => 'Skill title',
                'resolve' => function ($root, $args) {
                    if ($root['title_id']) {
                        $item = Skill::find($root['title_id']);
                        $name = $item->title;
                        if (App::isLocale('fr')) {
                            $name = $item->title_fr;
                        }
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
                        $item = Skill::find($root['title_id']);
                        $title = $item->title;
                        if (App::isLocale('fr')) {
                            $title = $item->title_fr;
                        }
                        return  [
                            'id' => $root['title_id'],
                            'title' => $title,
                        ];
                    }
                    return null;
                }
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Skill description'
            ],
            'level' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Skill level'
            ],
            'html' => SkillHtmlItemsField::class,
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
