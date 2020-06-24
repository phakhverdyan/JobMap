<?php

namespace App\GraphQL\Type\User\Resume;

use App\GraphQL\Fields\Resume\HobbyHtmlItemsField;
use App\User\Resume\Autocomplete\Interest;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\App;

class HobbyType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Hobbies',
        'description' => 'User hobbies'
    ];
    
    /**
     * @return array
     */
    public $countInterestsBasic = 306;
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
                'description' => 'Hobby title',
                'resolve' => function ($root, $args) {
                    if ($root['title_id']) {
                        $item = Interest::find($root['title_id']);
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
                        $item = Interest::find($root['title_id']);
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
                'type' => Type::string(),
                'description' => 'Hobby description'
            ],
            'html' => HobbyHtmlItemsField::class,
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
