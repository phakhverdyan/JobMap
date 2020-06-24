<?php

namespace App\GraphQL\Query;

use App\Bmic;
use App\Flagship;
use App\MonthlyPlan;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class MonthlyPlansQuery extends Query
{

    protected $attributes = [
        'name' => 'Monthly Plan'
    ];

    public function type()
    {
        return GraphQL::type('MonthlyPlans');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'country_code' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The country code of the business'
            ]
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        $bmic = Bmic::query()->where('country_code', '=', $args['country_code'])->first();
        $flagship = Flagship::query()->first();

        $query = MonthlyPlan::query()->where('status', '=', 1);

        $data['items'] = $query->get()->all();
        $data['coefficient'] = isset($bmic->coefficient) ? $bmic->coefficient / $flagship->coefficient : 1;

        return $data;
    }
}
