<?php

namespace App\GraphQL\Type\User\Business;

use App\GraphQL\Fields\Business\Location\CareerHtmlField;
use App\GraphQL\Fields\Business\Location\CareerHtmlFieldUBis;
use App\GraphQL\Fields\Business\Location\CareerHtmlListField;
use App\GraphQL\Fields\Business\Location\HtmlAssignField;
use App\GraphQL\Fields\Business\Location\HtmlField;
use App\GraphQL\Fields\Business\Location\PictureField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\Storage;

class LocationType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Location',
        'description' => 'business location'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Location id'
            ],
            'business_id' => [
                'type' => Type::id(),
                'description' => 'Location id'
            ],
            'job_id' => [
                'type' => Type::id(),
                'description' => 'Job Location id'
            ],
            'business' => [
                'type' => \GraphQL::type('Business'),
                'resolve' => function($root, $args){
                    return ($root['business']) ?? null;
                }
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Location Name'
            ],
            'name_fr' => [
                'type' => Type::string(),
                'description' => 'Location Name FR'
            ],
            'localized_name' => [
                'type' => Type::string(),
                'description' => 'Localized Location Name'
            ],
            'main' => [
                'type' => Type::int(),
                'description' => 'Main Location'
            ],
            'managers_type' => [
                'type' => Type::string(),
                'description' => 'Manager location type by role'
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'Location Slug Name',
                'resolve' => function($root, $args){
                    return str_slug($root['name']);
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
            'phone_country_code' => [
                'type' => Type::string(),
                'description' => 'Business location phone country code'
            ],
            'phone_code' => [
                'type' => Type::string(),
                'description' => 'Business location phone code'
            ],
            'phone' => [
                'type' => Type::string(),
                'description' => 'Business location phone'
            ],
            'zip_code' => [
                'type' => Type::string(),
                'description' => 'Business location zip_code'
            ],
            'type' => [
                'type' => Type::string(),
                'description' => 'Location type'
            ],
            'amenities_string' => [
                'type' => Type::string(),
                'description' => 'Location amenities with comma separator'
            ],
            'assign_amenities' => [
                'type' => Type::listOf(\GraphQL::type('Amenity')),
                'description' => 'Assigned amenities',
                'resolve' => function ($root, $args) {
                    $amenities = [];
                    foreach ($root['amenities'] as $amenity) {
                        $amenities[] = [
                            'id' => $amenity['amenity']['id'],
                            'name' => $amenity['amenity']['name'],
                            'key' => $amenity['amenity']['key'],
                        ];
                    }
                    return $amenities;
                }
            ],
            'job_status' => [
                'type' => Type::int(),
                'description' => ''
            ],
            'jobs_count_open' => [
                'type' => Type::int(),
                'description' => 'Count opened jobs'
            ],
            'jobs_count_close' => [
                'type' => Type::int(),
                'description' => 'Count closed jobs'
            ],
            'jobs_count' => [
                'type' => Type::int(),
                'description' => 'Count jobs',
                'resolve' => function ($root, $args) {
                    return $root['jobs_count'];
                }
            ],
            'assign_departments' => [
                'type' => Type::listOf(\GraphQL::type('BusinessDepartment'))
            ],
            'assign_jobs' => [
                'type' => Type::listOf(\GraphQL::type('BusinessJob')),
                'resolve' => function ($root, $args) {
                    $jobs = [];
                    $i = 0;
                    if (count($root['jobs'])) {
                        foreach ($root['jobs'] as $job) {
                            $jobs[$i] = $job['job'];
                            $jobs[$i]['job_status'] = $job['status'];
                            $jobs[$i]['location_id'] = $root['id'];
                            $jobs[$i]['login_user_id'] = $root['login_user_id'];
                            $jobs[$i]['type_key'] = job_type_by_key($job['job']['type_key']);
                            ++$i;
                        }
                    }
                    return $jobs;
                }
            ],
            'assign_managers' => [
                'type' => Type::listOf(\GraphQL::type('BusinessManagers')),
                'resolve' => function ($root, $args) {
                    $managers = [];
                    foreach ($root['managers'] as $manager) {
                        $managers[] = [
                            'id' => $manager['manager']['id'],
                            'first_name' => $manager['manager']['user']['first_name'],
                            'last_name' => $manager['manager']['user']['last_name'],
                            'role' => $manager['manager']['role'],
                            'created_at' => $manager['manager']['created_at'],
                            'user_pic' => $manager['manager']['user']['user_pic'],
                        ];
                    }
                    return $managers;
                }
            ],
            'html' => HtmlField::class,
            'html_assign' => HtmlAssignField::class,
            'html_career' => CareerHtmlField::class,
            'html_career_list' => CareerHtmlListField::class,
            'html_career_ubis' => CareerHtmlFieldUBis::class,
            'created_date' => [
                'type' => Type::string(),
                'description' => 'Department created date',
                'resolve' => function ($root, $args) {
                    if (isset($root['created_at'])) {
                        return $root['created_at']->format('M d, Y');
                    } else {
                        return null;
                    }

                }
            ],
            'title_button_send' => [
                'type' => Type::string(),
                'description' => 'Current page'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
            'count_linked' => [
                'type' => Type::int(),
                'description' => 'count linked location in this manager',
            ],
            'is_assigned' => [
                'type' => Type::int(),
                'description' => 'is_assigned',
            ],
            'picture' => PictureField::class,
            'picture_50' => PictureField::class,
            'picture_100' => PictureField::class,
            'picture_o' => PictureField::class,
            'picture_filename' => [
                'type' => Type::string(),
                'description' => 'Business picture_filename',
                'resolve' => function ($root, $args) {
                    return $root['picture'] ? $root['picture'] : '';
                }
            ],
        ];
    }
}
