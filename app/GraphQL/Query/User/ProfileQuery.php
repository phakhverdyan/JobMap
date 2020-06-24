<?php

namespace App\GraphQL\Query\User;

use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;

class ProfileQuery extends Query
{
    protected $attributes = [
        'name' => 'Profile'
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
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'id for user'
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

        $user = User::find($args['id']);

        return $user;
    }
}
