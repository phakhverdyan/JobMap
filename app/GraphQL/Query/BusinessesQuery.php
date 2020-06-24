<?php

namespace App\GraphQL\Query;

use App\Business;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class BusinessesQuery extends Query
{
    protected $attributes = [
        'name' => 'Businesses'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Business'));
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

        $businesses = Business::all();

        return $businesses;
    }
}
