<?php

namespace App\GraphQL\Query;

use App\Business\BusinessUnconfirmed;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class BusinessUnconfirmedQuery extends Query
{
    protected $attributes = [
        'name' => 'BusinessUnconfirmed'
    ];

    public function type()
    {
        return GraphQL::type('BusinessUnconfirmed');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the businessUnconfirmed'
            ]
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {

        $business = BusinessUnconfirmed::with(['locations', 'keyword', 'phones'])->whereId($args['id'])->first();

        $business['owner'] = $business->first_name . ' ' . $business->last_name;

        return $business;
    }
}
