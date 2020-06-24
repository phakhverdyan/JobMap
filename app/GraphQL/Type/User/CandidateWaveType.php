<?php

namespace App\GraphQL\Type\User;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class CandidateWaveType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Candidate wave type',
        'description' => 'Candidate wave type'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Identifier',
            ],

            // 'created_at' => [
            //     'type' => Type::string(),
            //     'description' => 'Creation time',

            //     'resolve' => function($root, $args) {
            //         return '2'; // $root['created_at']->format(\DateTime::ATOM);
            //     },
            // ],

            'time_left' => [
                'type' => Type::int(),
                'description' => 'Time to expiration',
            ],

            'expired_at' => [
                'type' => Type::string(),
                'description' => 'Expiration time',

                'resolve' => function($root, $args) {
                    return $root['expired_at']->format(\DateTime::ATOM);
                },
            ],

            'token' => [
                'type' => Type::string(),
                'description' => 'Token',
            ],
        ];
    }
}
