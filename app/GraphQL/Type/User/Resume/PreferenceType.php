<?php

namespace App\GraphQL\Type\User\Resume;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class PreferenceType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Preferences',
        'description' => 'User preferences'
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
            'looking_job' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Looking job right now'
            ],
            'current_type' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Im a '
            ],
            'current_job' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Im now'
            ],
            'interested_jobs' => [
                'type' => Type::string(),
                'description' => 'What type of jobs you are interested in'
            ],
            'new_job' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'New job opportunities'
            ],
            'new_opportunities' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'New opportunities'
            ],
            'distance' => [
                'type' => Type::int(),
                'description' => 'Maximum distance to job'
            ],
            'distance_type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Distance Type - km|miles'
            ],
            'industries' => [
                'type' => Type::string(),
                'description' => 'User industries of interest'
            ],
            'sub_industries' => [
                'type' => Type::string(),
                'description' => 'User sub-industries of interest by industries'
            ],
//            'categories' => [
//                'type' => Type::string(),
//                'description' => 'User categories of interest'
//            ],
            'sub_categories' => [
                'type' => Type::string(),
                'description' => 'User sub-categories of interest by categories'
            ],
            'salary' => [
                'type' => Type::string(),
                'description' => 'User hourly salary'
            ],
            'hours_from' => [
                'type' => Type::string(),
                'description' => 'User weekly hours from'
            ],
            'hours_to' => [
                'type' => Type::string(),
                'description' => 'User weekly hours to'
            ],
            'is_complete' => [
                'type' => Type::int(),
                'description' => 'Complete Status'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
            'first_job' => [
                'type' => Type::int(),
                'description' => 'first job'
            ],
            'not_education' => [
                'type' => Type::int(),
                'description' => 'not education'
            ],
            'not_certification' => [
                'type' => Type::int(),
                'description' => 'not certification'
            ],
            'not_distinction' => [
                'type' => Type::int(),
                'description' => 'not distinction'
            ],
            'industry' => [
                'type' => \GraphQL::type('Industry'),
                'description' => 'industry'
            ],
            'sub_industry' => [
                'type' => \GraphQL::type('Industry'),
                'description' => 'sub_industry'
            ],
            'category' => [
                'type' => \GraphQL::type('Category'),
                'description' => 'industry'
            ],
            'sub_category' => [
                'type' => \GraphQL::type('Category'),
                'description' => 'sub_industry'
            ],
        ];
    }
}
