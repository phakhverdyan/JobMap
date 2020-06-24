<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business\Administrator;
use App\Business\Discount;
use App\Coupon;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;

class DiscountQuery extends AuthQuery
{
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Discount'
    ];

    public function type()
    {
        return GraphQL::type('Discount');
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
            ],
            'code' => [
                'type' => Type::string(),
                'description' => 'Coupon code'
            ]
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array
     */
    public function resolve($root, $args)
    {
        //set authorized roles

        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::BRANCH_ROLE
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        $query = Coupon::query();
        $query->join('billings', 'billings.coupon_id', '=', 'discounts.id');
        
        $whereDiscount = [
            ['discounts.code', '=', $args['code']],
            ['discounts.status', '=', 1]
        ];
        
        $query->where($whereDiscount);
        $query->where('billings.business_id', '=', $args['business_id']);
        $data = [];

        if (!$query->first()) {
            $query = Coupon::query();
            $query->where('code', $args['code'])->where('status', 1);
            $data = $query->first();
        }

        $data['token'] = $this->token;
        return $data;
    }
}
