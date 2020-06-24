<?php

namespace App\GraphQL\Type\User\Business;

use App\GraphQL\Fields\Business\Job\ForUnionHtmlField;
use App\JobCategory;
use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class JobUnionType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Job Union',
        'description' => 'Business Job with assigned locations'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Job id'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Job title',
            ],
            'title_fr' => [
                'type' => Type::string(),
                'description' => 'Job title FR',
            ],
            'localized_title' => [
                'type' => Type::string(),
            ],
            /*'category_id' => [
                'type' => Type::int(),
                'description' => 'Job category'
            ],
            'category_name' => [
                'type' => Type::string(),
                'description' => 'Job category name',
                'resolve' => function ($root, $args) {
                    if($root['category_id']) {
                        $category = JobCategory::query()->where([
                            'id' => $root['category_id']
                        ])->first();
                        if ($category) {
                            return $category['name'];
                        }
                    }
    
                    return '';
                }
            ],*/
            'salary' => [
                'type' => Type::string(),
                'description' => 'Job salary'
            ],
            'salary_type' => [
                'type' => Type::string(),
                'description' => 'Job salary type'
            ],
            'hours' => [
                'type' => Type::int(),
                'description' => 'Hours or Week'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Job description'
            ],
            'description_fr' => [
                'type' => Type::string(),
                'description' => 'Job description FR'
            ],
            'localized_description' => [
                'type' => Type::string(),
            ],
            'date' => [
                'type' => Type::string(),
                'description' => 'Department created date',
                'resolve' => function ($root, $args) {
                    if (!empty($root['updated_at'])) {
                        $your_date = $root['updated_at'];
                        $datediff = time() - strtotime($your_date);
                        $days = round($datediff / (60 * 60 * 24));

                        $dt = Carbon::now();
                        $d = ($days == 0) ? 'Today' : $dt->subDays($days)->diffForHumans();

                        return $d;
                    }
                    return '';
                }
            ],
            'street' => [
                'type' => Type::string(),
                'description' => 'Location Street'
            ],
            'street_number' => [
                'type' => Type::string(),
                'description' => 'Location Street Number'
            ],
            'latitude' => [
                'type' => Type::float(),
                'description' => 'Location Latitude'
            ],
            'longitude' => [
                'type' => Type::float(),
                'description' => 'Location Longitude'
            ],
            'suite' => [
                'type' => Type::string(),
                'description' => 'Location Suite'
            ],
            'city' => [
                'type' => Type::string(),
                'description' => 'Business location city'
            ],
            'region' => [
                'type' => Type::string(),
                'description' => 'Business location region'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'Business location country'
            ],
            'country_code' => [
                'type' => Type::string(),
                'description' => 'Business location country code'
            ],
            'assign_types' => [
                'type' => Type::listOf(\GraphQL::type('JobType'))
            ],
            'status_in_location' => [
                'type' => Type::int(),
                'description' => 'Job status',
                /*'resolve' => function ($root, $args) {
                    foreach ($root['locationsAll'] as $location) {
                        if ($location['location_id'] == $root['location_id']) return $location['status'];
                    }
                }*/
            ],
            'status' => [
                'type' => Type::int(),
                'description' => 'Job status'
            ],
            'jobs_open' => [
                'type' => Type::int(),
                'description' => 'Count of open jobs'
            ],
            'jobs_close' => [
                'type' => Type::int(),
                'description' => 'Count of close jobs'
            ],
            'html' => ForUnionHtmlField::class,
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ]
        ];
    }
}
