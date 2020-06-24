<?php

namespace App\GraphQL\Type\User\Resume;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class DelPrintBuilderSelectionType extends GraphQLType
{
    protected $attributes = [
        'name' => 'DelPrintBuilderSelectionType',
        'description' => 'DelPrintBuilderSelectionType'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'result' => [
                'type' => Type::string(),
                'description' => 'The result delete',
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ]
        ];
    }
}
