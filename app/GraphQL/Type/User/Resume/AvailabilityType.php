<?php

namespace App\GraphQL\Type\User\Resume;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class AvailabilityType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Availability',
        'description' => 'User Availability'
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
            'full_time' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Available For Full Time'
            ],
            'part_time' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Available For Part Time'
            ],
            'internship' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Available For Intership'
            ],
            'contractual' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Available For Contractual'
            ],
            'summer_positions' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Available For Summer Positions'
            ],
            'recruitment' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Available For Graduate Year Recruitment Program'
            ],
            'field_placement' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Available For Field placement'
            ],
            'volunteer' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Available For Volunteer'
            ],
            'time_1' => [
                'type' => Type::string(),
                'description' => 'Available For Morning'
            ],
            'time_2' => [
                'type' => Type::string(),
                'description' => 'Available For Daytime'
            ],
            'time_3' => [
                'type' => Type::string(),
                'description' => 'Available For Evening'
            ],
            'time_4' => [
                'type' => Type::string(),
                'description' => 'Available For Night'
            ],
            'is_complete' => [
                'type' => Type::int(),
                'description' => 'Complete Status'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
