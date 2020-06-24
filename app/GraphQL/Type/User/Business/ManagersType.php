<?php

namespace App\GraphQL\Type\User\Business;

use App\GraphQL\Fields\Business\Manager\HtmlField;
use App\GraphQL\Fields\PictureResumeField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ManagersType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Manager',
        'description' => 'Business Manager'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Manager id'
            ],
            'user_id' => [
                'type' => Type::id(),
                'description' => 'Manager user_id'
            ],
            'business_id' => [
                'type' => Type::id(),
                'description' => 'Business id'
            ],
            'first_name' => [
                'type' => Type::string(),
                'description' => 'User First name',
            ],
            'last_name' => [
                'type' => Type::string(),
                'description' => 'User Last name',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'User email',
            ],
            'role' => [
                'type' => Type::string(),
                'description' => 'Role'
            ],
            'manager_type' => [
                'type' => Type::string(),
                'description' => 'Manager type by role',
                'resolve' => function ($root, $args) {
                    $manager = trans('pages.branch_manager');
                    if ($root['role'] === 'manager') {
                        $manager = trans('pages.business_manager');
                    } elseif($root['role'] === 'admin') {
                        $manager = trans('pages.owner');
                    }
                    
                    return $manager;
                }
            ],
            'user_picture_50' => PictureResumeField::class,
            'html' => HtmlField::class,
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
            'assign_locations' => [
                'type' => Type::listOf(\GraphQL::type('BusinessLocation')),
                'resolve' => function ($root, $args) {
                    $locations = [];
                    foreach ($root['assign_locations'] as $location) {
                        $locations[] = $location['location'];
                    }
                    return $locations;
                }
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
