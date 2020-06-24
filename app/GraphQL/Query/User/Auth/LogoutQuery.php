<?php

namespace App\GraphQL\Query\User\Auth;

use App\GraphQL\Extensions\AuthQuery;
use GraphQL;

class LogoutQuery extends AuthQuery
{

    protected $attributes = [
        'name' => 'user logout'
    ];

    public function type()
    {
        return GraphQL::type('Api');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [];
    }

    /**
     * @param $root
     * @param $args
     * @return null
     */
    public function resolve($root, $args)
    {
        header("Set-Cookie: api-token=; EXPIRES 1; Domain=" . env('SESSION_DOMAIN') . "; path=/");

        return null;
    }
}
