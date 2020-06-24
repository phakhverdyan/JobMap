<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class AdministratorType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Administrator',
        'description' => 'business Administrator'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'business_id' => [
                'type' => Type::id(),
                'description' => 'Business id'
            ],
            'phone_country_code' => [
                'type' => Type::string(),
                'description' => 'Phone Country Code'
            ],
            'phone_code' => [
                'type' => Type::string(),
                'description' => 'Phone code'
            ],
            'phone' => [
                'type' => Type::string(),
                'description' => 'Phone number'
            ],
            'email_notification' => [
                'type' => Type::string(),
                'description' => 'Email for notifications'
            ],
            'notification_new_candidates' => [
                'type' => Type::int(),
                'description' => 'New candidates notifications'
            ],
            'notification_new_messages' => [
                'type' => Type::int(),
                'description' => 'New messages notifications'
            ],
            'notification_new_follower' => [
                'type' => Type::int(),
                'description' => 'New follower notifications'
            ],
            'role' => [
                'type' => Type::string(),
                'description' => 'Role'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
