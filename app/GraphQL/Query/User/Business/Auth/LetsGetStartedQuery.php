<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business;
use App\Business\Administrator;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;

class LetsGetStartedQuery extends AuthQuery
{
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'LetsGetStarted'
    ];
    
    public function type()
    {
        return GraphQL::type('LetsGetStarted');
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
        
        $data = Business::find($args['business_id'])->lets_get_started;
        
        return [
            'data' => $data,
            'token' => $this->token
        ];
    }
}
