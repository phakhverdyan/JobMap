<?php

namespace App\GraphQL\Query\User;

use App\User\Academy\Director;
use App\User\Academy\Teacher;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class AcademyQuery extends Query
{
    
    protected $attributes = [
        'name' => 'Academy'
    ];
    
    public function type()
    {
        return GraphQL::type('Academy');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
        ];
    }
    /**
     * @return array
     */
    public function args()
    {
        return [
            'type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Type of user'
            ],
            'token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Token of user'
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
        if ($args['type'] == 'teacher') {
            $user = Teacher::with('students'/*, 'user'*/)
                ->where('token',$args['token'])
                ->first();
            if (!$user) {
                return null;
            }
            $children = $user->students;
        } else {
            $user = Director::with('teachers'/*, 'user'*/)
                ->where('token',$args['token'])
                ->first();
            if (!$user) {
                return null;
            }
            $children = $user->teachers;
        }

        if ($children->count()) {
            $children_active = $children->filter(function ($value, $key){
                return $value->user_id;
            });
            $children_inactive = $children->filter(function ($value, $key){
                return !$value->user_id;
            });
        } else {
            $children_active = [];
            $children_inactive = [];
        }

        //$user->location = $user->city . ($user->region ? ",".$user->region : '') . ($user->country ?  ",".$user->country : '');

        return [
            'user' => $user,
            'children_active' => count($children_active) ? $children_active : null,
            'children_inactive' => count($children_inactive) ? $children_inactive : null
        ];
    }
}
