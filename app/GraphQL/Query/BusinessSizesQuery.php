<?php

namespace App\GraphQL\Query;

use App\BusinessSize;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class BusinessSizesQuery extends Query
{
    
    protected $attributes = [
        'name' => 'Business sizes'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('BusinessSize'));
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
     * @return array|null
     */
    public function resolve($root, $args)
    {
        return BusinessSize::query()->get()->all();
    }
}
