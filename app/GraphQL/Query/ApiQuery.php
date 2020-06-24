<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class ApiQuery extends Query
{
    
    protected $attributes = [
        'name' => 'API init'
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
        return [
        
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        if(request()->cookie('api-token')){
            return [
                'token' => request()->cookie('api-token')
            ];
        }
        
        return null;
    }
}
