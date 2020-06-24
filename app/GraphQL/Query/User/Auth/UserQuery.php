<?php

namespace App\GraphQL\Query\User\Auth;

use App\GraphQL\Extensions\AuthQuery;
use GraphQL;
use App\User;

class UserQuery extends AuthQuery
{
    
    protected $attributes = [
        'name' => 'user'
    ];
    
    public function type()
    {
        return GraphQL::type('User');
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
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        $query = User::where('id', $this->auth->id);
        $data = $query->first();
        $data->realtime_token = hash_hmac('sha256', $data->id, 'Bobik-realtime-User-token');
        $data->token = $this->token;
        return $data;
    }
}
