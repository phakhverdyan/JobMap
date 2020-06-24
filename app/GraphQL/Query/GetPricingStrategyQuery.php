<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\DB;

class GetPricingStrategyQuery extends Query
{
    
    protected $attributes = [
        'name' => 'geo'
    ];
    
    public function type()
    {
        return GraphQL::type('PricingStrategy');
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
        $pricing_strategy = DB::table('pricing_strategy')->where('active',1)->first();

        if (!$pricing_strategy) {
            $pricing_strategy = [
                'monthly_price' => 25,
                'candidates' => 100,
                'free_version_candidates' => 10,
            ];
        }
        
        return $pricing_strategy;
    }
}
