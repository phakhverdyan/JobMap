<?php

namespace App\GraphQL\Mutation\User\Business;

use App\GraphQL\Auth;
use App\Business;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DoneStepIntegrationGuideMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'doneStepIntegrationGuide'
    ];
    
    public function type()
    {
        return GraphQL::type('DoneStepIntegrationGuide');
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
            'number' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'number'
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
        if (!$business->lets_get_started) {
            $business->lets_get_started = implode(',', [ '1', '1', '1', '1', '1', '1', '1', '1', '1', '1' ]);
        }
        $data = [];
        if ($business->integration_guide_steps) {
            $data = explode(',',$business->integration_guide_steps);
        } else {
            for($i=0;$i<9;$i++) {
                $data[$i] = 0;
            }
        }
        $data[$args['number']] = 1;
        $data = implode(',', $data);

        $business->integration_guide_steps = $data;
        $business->save();
        
        return [
            'data' => $data,
            'token' => $this->token,
        ];
    }
}
