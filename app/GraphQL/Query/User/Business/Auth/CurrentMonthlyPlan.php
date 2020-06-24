<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business\Administrator;
use App\Business\Billing;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\AuthBusiness;
use App\MonthlyPlan;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;

class CurrentMonthlyPlan extends AuthQuery
{
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Current monthly plan'
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
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the business'
            ],
            'id' => [
                'type' => Type::id(),
                'description' => 'Current Plan id'
            ],
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

        $plan = MonthlyPlan::query()->where('id', '=', $args['id'])->first();
        $where = [
            ['business_id', '=', $args['business_id']],
            ['current', '=', 1],
        ];
        $currentPlan = Billing::query()->where($where)->first();
        $data['id'] = $plan->id;
        $data['plan_name'] = $plan->plan_name;
        $data['is_canceled'] = $currentPlan->is_canceled;
        $data['applicants'] = $currentPlan->applicants;
        $data['price'] = $currentPlan->price;
        $data['token'] = $this->token;
        return $data;
    }
}
