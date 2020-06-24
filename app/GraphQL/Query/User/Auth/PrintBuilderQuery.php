<?php

namespace App\GraphQL\Query\User\Auth;

use App\User\Resume\Preference;
use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Extensions\AuthQuery;
use Illuminate\Support\Facades\App;

class PrintBuilderQuery extends AuthQuery
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
        $query = User::where('id', $this->auth->id);
        $data = $query->first();

        if (isset($args['locale'])) {
            App::setLocale($args['locale']);
            $data['locale'] = $args['locale'];
        } else {
            $data['locale'] = 'en';
        }

        /*if (isset($args['overview'])) {
            $preference = Preference::where('user_id',$this->auth->id)->first();
            $preference->last_viewed = time();
            $preference->save();
        }*/
        
        $data['token'] = $this->token;
        
        return $data;
    }
}
