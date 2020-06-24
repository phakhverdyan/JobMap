<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\Storage;

class InviteInfoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Invite Info',
        'description' => 'Details for invitation token'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'first_name' => [
                'type' => Type::string(),
                'description' => 'User first name'
            ],
            'last_name' => [
                'type' => Type::string(),
                'description' => 'User last name'
            ],
            'username' => [
                'type' => Type::string(),
                'description' => 'Username'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'User email'
            ],
            'picture' => [
                'type' => Type::string(),
                'description' => '',
                'resolve' => function ($root, $args) {
                    if ($root['business_picture']) {
                        return Storage::disk('business')->url('/' . $root['invite_business_id'] . '/200.200.') . $root['business_picture'] . '?v=' . rand(11111, 99999);
                    } else {
                        return asset('img/profilepic2.png');
                    }
                }
            ],
            'business_name' => [
                'type' => Type::string(),
                'description' => 'Business name'
            ],

            'invite_business_id' => [
                'type' => Type::int(),
                'description' => 'invite_business_id'
            ],
        ];
    }
}
