<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business\Administrator;
use App\Business\Card;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;

class CardsQuery extends AuthQuery
{
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'Card'
    ];
    
    public function type()
    {
        return GraphQL::type('Cards');
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
        
        $data = Card::where([
            'business_id' => $args['business_id']
        ])->get()->all();
        
        return [
            'items' => $data,
            'token' => $this->token
        ];
    }
}
