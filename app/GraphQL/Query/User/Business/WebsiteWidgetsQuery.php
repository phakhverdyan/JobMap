<?php

namespace App\GraphQL\Query\User\Business;

use App\Business\WebsiteWidget;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\DB;

class WebsiteWidgetsQuery extends Query
{
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Website Button'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('WebsiteWidget'));
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the business'
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
        $query = WebsiteWidget::query()->with('brand');
        $query->where('business_id', $args['business_id']);
        return $query->get()->all();
    }
}
