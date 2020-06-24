<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 07.03.18
 * Time: 15:52
 */

namespace App\GraphQL\Query\User\Business;

use App\Business\WebsiteButton;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\DB;


class WebsiteButtonsQuery extends Query
{
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Website Button'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('WebsiteButton'));
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
        $query = WebsiteButton::query();
        $query->where('business_id', $args['business_id']);
        $query->select([
            '*',
            DB::raw('(select count(*)  from business_website_buttons where business_id = ' .  $args['business_id'] . ') as button_count'),
        ]);

        return $query->get()->all();
    }
}
