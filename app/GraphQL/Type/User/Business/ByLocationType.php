<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ByLocationType extends GraphQLType
{
    protected $attributes = [
        'name' => 'By Location',
        'description' => 'Data by location'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'count_employers' => [
                'type' => Type::string(),
                'description' => 'Employers count',
            ],
            'count_jobs' => [
                'type' => Type::string(),
                'description' => 'Jobs count',
            ],
            'count_locations' => [
                'type' => Type::string(),
                'description' => 'Locations count',
            ],
            'count_headquarters' => [
                'type' => Type::string(),
                'description' => 'Headquarters count',
            ],
            'count_keywords' => [
                'type' => Type::string(),
                'description' => 'Keywords count',
            ]
        ];
    }
}
