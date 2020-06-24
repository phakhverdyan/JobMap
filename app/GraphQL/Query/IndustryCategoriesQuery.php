<?php

namespace App\GraphQL\Query;

use App\Business;
use App\Industry;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\DB;

class IndustryCategoriesQuery extends Query
{
    protected $attributes = [
        'name' => 'Industry Categories'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('IndustryCategories'));
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
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        $query = Industry::query();
        $query->where('parent_id', '=', null);
        
        $data = $query->select(['id', 'name as text'])->get()->all();
        
        return $data;
    }
}
