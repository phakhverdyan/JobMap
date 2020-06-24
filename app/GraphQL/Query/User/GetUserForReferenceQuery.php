<?php

namespace App\GraphQL\Query\User;

use App\User;
use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\Type;

class GetUserForReferenceQuery extends Query
{

    protected $attributes = [
        'name' => 'GetUserForReference'
    ];
    
    public function type()
    {
        return GraphQL::type('User');
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the user'
            ],
            'reference_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the referense user'
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return array
     */
    public function resolve($root, $args)
    {
        $user = User::find($args['id']);
        if ($reference = $user->reference->where('id',$args['reference_id'])->first()) {
            $user->reference = $reference;
        } else {
            return null;
        }

        return $user;
    }
}
