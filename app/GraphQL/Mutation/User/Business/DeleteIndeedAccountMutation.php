<?php

namespace App\GraphQL\Mutation\User\Business;

use App\Business\Administrator;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\Business;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class DeleteIndeedAccountMutation extends Mutation
{
    use Auth;
    use AuthBusiness;

    protected $attributes = [
        'name' => 'New Indeed Account of Business'
    ];
    
    public function type()
    {
        return GraphQL::type('IndeedAccount');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'business_id' => ['required'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::id(),
                'description' => 'Business ID',
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
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::BRANCH_ROLE
        ];

        $this->businessID = $args['business_id'];
        $this->check();

        \App\IndeedAccount::where('business_id', $this->businessID)->delete();
        return null;
    }
}
