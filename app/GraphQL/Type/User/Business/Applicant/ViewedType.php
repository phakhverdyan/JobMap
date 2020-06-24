<?php

namespace App\GraphQL\Type\User\Business\Applicant;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ViewedType extends GraphQLType
{
    protected $attributes = [
        'name' => 'History viewed',
        'description' => 'History viewed'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'manager' => [
                'type' => \GraphQL::type('User'),
            ],
            'date' => [
                'type' => Type::string(),
                'description' => 'Date view',
            ],
        ];
    }
}
