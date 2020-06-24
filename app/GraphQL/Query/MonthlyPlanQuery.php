<?php

namespace App\GraphQL\Query;

use App\MonthlyPlan;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class MonthlyPlanQuery extends Query
{

    protected $attributes = [
        'name' => 'Monthly Plan'
    ];

    public function type()
    {
        return GraphQL::type('MonthlyPlan');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Current Plan id'
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
        $query = MonthlyPlan::query()->where('id', '=', $args['id']);
        return $query->first();
    }
}
