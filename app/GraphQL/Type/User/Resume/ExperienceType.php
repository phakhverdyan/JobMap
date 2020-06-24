<?php

namespace App\GraphQL\Type\User\Resume;

use App\Business;
use App\GraphQL\Fields\Resume\ExperienceHtmlItemsField;
use App\JobCategory;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\App;

class ExperienceType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Experience',
        'description' => 'User experience'
    ];
    
    /**
     * @return array
     */
    public $idJobCategoryCustom = 20800;
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
                'description' => 'Title',
                'resolve' => function ($root, $args) {
                    if ($root['title_id']) {
                        $jobCat = JobCategory::find($root['title_id']);
                        $name = $jobCat->name;
                        if (App::isLocale('fr')) {
                            $name = $jobCat->name_fr;
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
                'type' =>\GraphQL::type('JobCategory'),
                'resolve' => function ($root, $args) {
                    if ($root['title_id']) {
                        $jobCat = JobCategory::find($root['title_id']);
                        $name = $jobCat->name;
                        if (App::isLocale('fr')) {
                            $name = $jobCat->name_fr;
                        }
                        return  [
                            'id' => $root['title_id'],
                            'name' => $name,
                        ];
                    }
                    return null;
                }
            ],
            'company' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Company'
            ],
            'company_id' => [
                'type' => Type::int(),
                'description' => 'company id'
            ],
            'assign_company' => [
                'type' =>\GraphQL::type('AutocompleteResume'),
                'resolve' => function ($root, $args) {
                    if ($root['company_id']) {
                        $item = Business::find($root['company_id']);
                        $title = $item->name;
                        return  [
                            'id' => $root['company_id'],
                            'title' => $title,
                        ];
                    }
                    //return null;
                    return  [
                        'id' => $root['company'],
                        'title' => $root['company'],
                    ];
                }
            ],
            'city' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Experience company City'
            ],
            'region' => [
                'type' => Type::string(),
                'description' => 'Experience company Region'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'Experience company Country'
            ],
            'country_code' => [
                'type' => Type::string(),
                'description' => 'Experience company Country Code'
            ],
            'current' => [
                'type' => Type::int(),
                'description' => 'Currently work here'
            ],
            'date_from' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Experience date from'
            ],
            'date_to' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Experience date to'
            ],
            'year_from' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Experience date from',
                'resolve' => function($root){
                    return date('Y', strtotime($root['date_from']));
                }
            ],
            'year_to' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Experience date to',
                'resolve' => function($root){
                    return date('Y', strtotime($root['date_to']));
                }
            ],
            'month_from' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Experience date from',
                'resolve' => function($root){
                    return date('m', strtotime($root['date_from']));
                }
            ],
            'month_to' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Experience date to',
                'resolve' => function($root){
                    return date('m', strtotime($root['date_to']));
                }
            ],
            'industry_id' => [
                'type' => Type::int(),
                'description' => 'Experience industry'
            ],
            'industry' => [
                'type' => \GraphQL::type('Industry'),
                'description' => 'industry'
            ],
            'sub_industry_id' => [
                'type' => Type::int(),
                'description' => 'Experience industry'
            ],
            'sub_industry' => [
                'type' => \GraphQL::type('Industry'),
                'description' => 'sub_industry'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Experience company description'
            ],
            'additional_info' => [
                'type' => Type::string(),
                'description' => 'Experience additional info'
            ],
            'html' => ExperienceHtmlItemsField::class,
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
            'first_job' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'first job',
                'resolve' => function($root, $args){
                    if (!$root['first_job']) {
                        return 0;
                    }
                    return 1;
                }
            ],
        ];
    }
}
