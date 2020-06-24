<?php

namespace App\GraphQL\Query\User\Auth;

use GraphQL;
use App\User;
use App\GraphQL\Extensions\AuthQuery;

class ReferencesQuery extends AuthQuery
{
    protected $attributes = [
        'name' => 'Reference'
    ];
    
    public function type()
    {
        return GraphQL::type('References');
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
        $query = User::with('reference')->where('id', $this->auth->id);
        $data = $query->first();
        
        $data['token'] = $this->token;
        $data['incoming'] = $data['reference']->where('status','incoming');
        $data['confirmed'] = $data['reference']->where('status','confirmed');
        $data['requested'] = $data['reference']->where('status','requested');

        return $data;
    }
}
