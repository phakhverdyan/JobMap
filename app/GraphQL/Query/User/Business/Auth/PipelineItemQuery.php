<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business\Administrator;
use App\Business\Pipeline;
use App\Candidate;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;

class PipelineItemQuery extends AuthQuery
{
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'Pipeline Item'
    ];
    
    public function type()
    {
        return GraphQL::type('PipelineItem');
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the pipeline'
            ],
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
        
        $data = Pipeline::where([
            'business_id' => $args['business_id'],
            'id' => $args['id'],
        ])->first();
        
        $data['token'] = $this->token;
        
        return $data;
    }
}
