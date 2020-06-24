<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class DoneStepIntegrationGuideType extends GraphQLType
{
    protected $attributes = [
        'name' => 'LetsGetStarted',
        'description' => 'businesses'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'data' => [
                'type' => Type::string(),
                'description' => 'Business Items'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ]
        ];
    }
}
