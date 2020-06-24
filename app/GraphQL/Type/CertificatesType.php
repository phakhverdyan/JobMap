<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class CertificatesType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Certificate',
        'description' => 'Certificate for businesses'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'items' => [
                'type' => Type::listOf(\GraphQL::type('Certificate')),
                'description' => 'Certificate Items'
            ],
            'default' => [
                'type' => Type::listOf(\GraphQL::type('Certificate')),
                'description' => 'Get default item by ids'
            ]
        ];
    }
}
