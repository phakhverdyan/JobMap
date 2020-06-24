<?php

namespace App\GraphQL\Mutation\User\Business;

use App\GraphQL\Auth;
use App\Business;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class SaveIntegrationToggleMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'saveIntegrationToggle'
    ];
    
    public function type()
    {
        return GraphQL::type('IntegrationToggle');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [];
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
            'integration_toggle' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'data'
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
        $business = Business::find($args['business_id']);
        $business->integration_toggle = $args['integration_toggle'];
        $business->save();
        
        return [
            'response' => 'success',
            'token' => $this->token,
        ];
    }
}
