<?php

namespace App\GraphQL\Type\User\Business\Applicant;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class DeleteNoteType extends GraphQLType
{
    protected $attributes = [
        'name' => 'DeleteNoteApplicant',
        'description' => 'Applicant'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'response' => [
                'type' => Type::string(),
                'description' => 'result action'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ]
        ];
    }
}
