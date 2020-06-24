<?php

namespace App\GraphQL\Type\User\Business;

use App\GraphQL\Fields\Business\HtmlMapField;
use App\GraphQL\Fields\Business\HtmlMapListField;
use App\GraphQL\Fields\Business\PictureField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class MapBusinessType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business',
        'description' => 'business for jobmap'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of the business'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of business'
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The slug of business'
            ],
            'picture' => PictureField::class,
            'picture_50' => PictureField::class,
            'picture_100' => PictureField::class,
            'html_career' => HtmlMapField::class,
            'html_jobmap' => HtmlMapField::class,
//            'html_jobmap_list' => HtmlMapListField::class,
            'jobs_count' => [
                'type' => Type::int(),
                'description' => 'Count job for business'
            ],
            'locations_count' => [
                'type' => Type::int(),
                'description' => 'Count locations for business'
            ],
            'assign_locations' => [
                'type' => Type::listOf(\GraphQL::type('BusinessLocation')),
                'resolve' => function ($root, $args) {
                    $locations = [];
                    $i = 0;
                    foreach ($root['locations'] as $location) {
                        $locations[$i] = $location;
                        $locations[$i]['job_id'] = $location['id'];
                        ++$i;
                    }
                    return $locations;
                }
            ],
        ];
    }
}
