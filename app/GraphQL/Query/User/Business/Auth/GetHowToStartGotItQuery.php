<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business;
use App\Business\Administrator;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\AuthBusiness;
use App\HowToStartGotIt;
use GraphQL;
use GraphQL\Type\Definition\Type;

class GetHowToStartGotItQuery extends AuthQuery
{
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'GetHowToStartGotIt'
    ];
    
    public function type()
    {
        return GraphQL::type('HowToStartGotIt');
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
                'description' => 'type'
            ],
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return array
     */
    public function resolve($root, $args)
    {
        $result = 'show';
        $query = HowToStartGotIt::query();
        if (isset($args['business_id'])) {
            $query->where('business_id', $args['business_id']);
        } else {
            $query->whereNull('business_id');
        }
        $query->where('user_id', $args['user_id'])
            ->where('type', $args['type'])
            ->where('section', $args['section']);
        if ($data = $query->first()) {
            $result = 'no-show';
        }

        return [
            'result' => $result,
            'token' => $this->token
        ];
    }
}
