<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class GetJobsAutoCompleteType extends GraphQLType
{
    protected $attributes = [
        'name' => 'GetJobsAutoComplete',
        'description' => 'GetJobsAutoComplete'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'title' => [
                'type' => Type::string(),
                'description' => 'title job'
            ],
            'id' => [
                'type' => Type::string(),
                'description' => 'id job'
            ]
        ];
    }
}
