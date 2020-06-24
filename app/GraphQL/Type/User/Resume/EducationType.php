<?php

namespace App\GraphQL\Type\User\Resume;

use App\GraphQL\Fields\Resume\EducationHtmlItemsField;
use App\User\Resume\Autocomplete\Degree;
use App\User\Resume\Autocomplete\FieldOfStudy;
use App\User\Resume\Autocomplete\Grade;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\App;

class EducationType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Education',
        'description' => 'User education'
    ];
    
    /**
     * @return array
     */
    public $countDegreesBasic = 752;
    public $countStudiesBasic = 1694;
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
            'school_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'School name'
            ],
            'city' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Education school City'
            ],
            'region' => [
                'type' => Type::string(),
                'description' => 'Education school Region'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'Education school Country'
            ],
            'country_code' => [
                'type' => Type::string(),
                'description' => 'Education school Country Code'
            ],
            'year_from' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Education year from'
            ],
            'year_to' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Education year to'
            ],
            'grade' => [
                'type' => Type::string(),
                'description' => 'Education school Grade',
                'resolve' => function ($root, $args) {
                    if ($root['grade_id']) {
                        $item = Grade::find($root['grade_id']);
                        $name = $item->title;
                        if (App::isLocale('fr')) {
                            $name = $item->title_fr;
                        }
                        return $name;
                    }
                    return $root['grade'];
                }
            ],
            'grade_id' => [
                'type' => Type::int(),
                'description' => 'grade id'
            ],
            'assign_grade' => [
                'type' =>\GraphQL::type('AutocompleteResume'),
                'resolve' => function ($root, $args) {
                    if ($root['grade_id']) {
                        $item = Grade::find($root['grade_id']);
                        $title = $item->title;
                        if (App::isLocale('fr')) {
                            $title = $item->title_fr;
                        }
                        return  [
                            'id' => $root['grade_id'],
                            'title' => $title,
                        ];
                    }
                    return null;
                }
            ],
            'current' => [
                'type' => Type::int(),
                'description' => 'Currently study here'
            ],
            'degree' => [
                'type' => Type::string(),
                'description' => 'Education degree',
                'resolve' => function ($root, $args) {
                    if ($root['degree_id']) {
                        $item = Degree::find($root['degree_id']);
                        $name = $item->title;
                        if (App::isLocale('fr')) {
                            $name = $item->title_fr;
                        }
                        return $name;
                    }
                    return $root['degree'];
                }
            ],
            'degree_id' => [
                'type' => Type::int(),
                'description' => 'degree id'
            ],
            'assign_degree' => [
                'type' =>\GraphQL::type('AutocompleteResume'),
                'resolve' => function ($root, $args) {
                    if ($root['degree_id']) {
                        $item = Degree::find($root['degree_id']);
                        $title = $item->title;
                        if (App::isLocale('fr')) {
                            $title = $item->title_fr;
                        }
                        return  [
                            'id' => $root['degree_id'],
                            'title' => $title,
                        ];
                    }
                    return null;
                }
            ],
            'study' => [
                'type' => Type::string(),
                'description' => 'Education Field of study',
                'resolve' => function ($root, $args) {
                    if ($root['study_id']) {
                        $item = FieldOfStudy::find($root['study_id']);
                        $name = $item->title;
                        if (App::isLocale('fr')) {
                            $name = $item->title_fr;
                        }
                        return $name;
                    }
                    return $root['study'];
                }
            ],
            'study_id' => [
                'type' => Type::int(),
                'description' => 'study id'
            ],
            'assign_study' => [
                'type' =>\GraphQL::type('AutocompleteResume'),
                'resolve' => function ($root, $args) {
                    if ($root['study_id']) {
                        $item = FieldOfStudy::find($root['study_id']);
                        $title = $item->title;
                        if (App::isLocale('fr')) {
                            $title = $item->title_fr;
                        }
                        return  [
                            'id' => $root['study_id'],
                            'title' => $title,
                        ];
                    }
                    return null;
                }
            ],
            'activities' => [
                'type' => Type::string(),
                'description' => 'Education Activities and societies'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Education Description'
            ],
            'achievement_title' => [
                'type' => Type::string(),
                'description' => 'Education Achievement title'
            ],
            'achievement_description' => [
                'type' => Type::string(),
                'description' => 'Education Achievement description'
            ],
            'html' => EducationHtmlItemsField::class,
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
