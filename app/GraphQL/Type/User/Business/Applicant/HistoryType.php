<?php

namespace App\GraphQL\Type\User\Business\Applicant;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class HistoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Candidate history',
        'description' => 'Candidate history'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'candidate' => [
                'type' => \GraphQL::type('Candidate'),
            ],
            'pipeline' => [
                'type' => \GraphQL::type('HistoryMoved'),
            ],
            'date' => [
                'type' => Type::string(),
                'description' => 'Date'
            ]
        ];
    }
}
