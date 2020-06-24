<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business\Administrator;
use App\Bmic;
use App\Flagship;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;

class BmicQuery extends AuthQuery
{
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'BMIC'
    ];

    public function type()
    {
        return GraphQL::type('Bmic');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'country_code' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The BMIC for country'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The business id'
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

        $bmic = Bmic::query()->where('country_code', '=', $args['country_code'])->first();
        $flagship = Flagship::query()->first();

        $data['token'] = $this->token;
        $data['coefficient'] = isset($bmic->coefficient) ? $bmic->coefficient / $flagship->coefficient : 1;
        return $data;
    }
}
