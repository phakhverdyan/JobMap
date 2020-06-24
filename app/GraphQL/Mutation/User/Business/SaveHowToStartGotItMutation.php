<?php

namespace App\GraphQL\Mutation\User\Business;

use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\HowToStartGotIt;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class SaveHowToStartGotItMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'saveHowToStartGotIt'
    ];
    
    public function type()
    {
        return GraphQL::type('HowToStartGotIt');
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
                'type' => Type::id(),
                'description' => 'The id of the business'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the user'
            ],
            'type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'type'
            ],
            'section' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'section'
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
        $data = HowToStartGotIt::firstOrCreate([
            'business_id' => $args['business_id'] ?? null,
            'user_id' => $args['user_id'],
            'type' => $args['type'],
            'section' => $args['section'],
        ]);
        
        return [
            'result' => 'success',
            'token' => $this->token,
        ];
    }
}
