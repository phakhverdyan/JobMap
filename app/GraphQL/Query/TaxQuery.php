<?php

namespace App\GraphQL\Query;

use App\Tax;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class TaxQuery extends Query
{

    protected $attributes = [
        'name' => 'Tax query'
    ];

    public function type()
    {
        return GraphQL::type('Tax');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'province_en' => [
                'type' => Type::string(),
                'description' => 'Search by province name English'
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
        $query = Tax::query();

        if (isset($args['province_en'])) {
            $query->where('province_en', '=', $args['province_en']);
        }

        return $query->first();
    }
}
