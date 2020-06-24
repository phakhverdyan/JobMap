<?php

namespace App\GraphQL\Query;

use App\Business\Import;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class InviteATSInfoQuery extends Query
{

    protected $attributes = [
        'name' => 'Invitation info'
    ];

    public function type()
    {
        return GraphQL::type('InviteATSInfo');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'affiliate_token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Invite ATS token'
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
        $user = Import::where('affiliate_token', $args['affiliate_token'])
            ->join('businesses', 'businesses.id', '=', 'business_imports.business_id')
            ->select([
                'business_imports.email',
                'businesses.picture as business_picture',
                'businesses.name as business_name'
            ])
            ->first();

        return $user;
    }
}
