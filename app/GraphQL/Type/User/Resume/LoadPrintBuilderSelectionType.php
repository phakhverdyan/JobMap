<?php

namespace App\GraphQL\Type\User\Resume;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class LoadPrintBuilderSelectionType extends GraphQLType
{
    protected $attributes = [
        'name' => 'LoadPrintBuilderSelectionType',
        'description' => 'LoadPrintBuilderSelectionType'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'selection' => [
                'type' => \GraphQL::type('UserSelection'),
                'description' => 'Selection',
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ]
        ];
    }
}
