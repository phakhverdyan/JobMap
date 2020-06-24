<?php

namespace App\GraphQL\Mutation\User\Business;

use App\Business;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class SaveNewStartHereBusinessMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'saveNewStartHereBusiness'
    ];
    
    public function type()
    {
        return GraphQL::type('SaveNewStartHereBusiness');
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
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        Business::where('id', $args['business_id'])->update(['new_start_here' => 0]);

        return [
            'result' => 'success',
            'token' => $this->token,
        ];
    }
}
