<?php

namespace App\GraphQL\Query;

use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class InviteInfoQuery extends Query
{

    protected $attributes = [
        'name' => 'Invitation info'
    ];

    public function type()
    {
        return GraphQL::type('InviteInfo');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'invite_token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Invite token'
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        $user = User::where('invite_token', $args['invite_token'])
            ->join('businesses', 'businesses.id', '=', 'invite_business_id')
            ->select([
                'users.*',
                'users.id as id',
                'businesses.picture as business_picture',
                'businesses.name as business_name'
            ])
            ->first();

        return $user;
    }
}
