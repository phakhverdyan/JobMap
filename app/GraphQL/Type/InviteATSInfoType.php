<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\Storage;

class InviteATSInfoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Invite ATS Info',
        'description' => 'Details for invitation ATS token'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
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
        ];
    }
}
