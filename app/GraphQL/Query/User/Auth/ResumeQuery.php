<?php

namespace App\GraphQL\Query\User\Auth;

use App\User\Resume\Preference;
use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Extensions\AuthQuery;
use Illuminate\Support\Facades\App;

class ResumeQuery extends AuthQuery
{
    protected $attributes = [
        'name' => 'Resume'
    ];
    
    public function type()
    {
        return GraphQL::type('Resume');
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'overview' => [
                'type' => Type::int(),
                'description' => 'is run overview'
            ],
            'locale' => [
                'type' => Type::string(),
                'description' => 'locale'
            ],
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        if (isset($args['locale'])) {
            App::setLocale($args['locale']);
        }

        $user = User::where('id', $this->auth->id)->first();
        
        if (isset($args['overview'])) {
            $preference = Preference::where('user_id', $user->id)->first();
            $preference->last_viewed = time();
            $preference->save();
        }
        
        $user->token = $this->token;
        return $user;
    }
}
