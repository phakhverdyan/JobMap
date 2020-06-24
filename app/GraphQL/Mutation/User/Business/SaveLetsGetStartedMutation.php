<?php

namespace App\GraphQL\Mutation\User\Business;

use App\GraphQL\Auth;
use App\Business;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class SaveLetsGetStartedMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'saveLetsGetStarted'
    ];
    
    public function type()
    {
        return GraphQL::type('LetsGetStarted');
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
            'data' => [
                'type' => Type::nonNull(Type::string()),
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
        if ($business->lets_get_started) {
            $data_old = explode(',',$business->lets_get_started);
            $data_new = explode(',',$args['data']);
            foreach ($data_old as $key => $value) {
                $data_old[$key] = $data_new[$key]!=-1 ? $data_new[$key] : $data_old[$key];
            }
            $data = implode(',', $data_old);
        } else {
            $data = $args['data'];
        }
        $business->lets_get_started = $data;
        $business->save();
        
        return [
            'data' => $data,
            'token' => $this->token,
        ];
    }
}
