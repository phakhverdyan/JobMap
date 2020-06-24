<?php

namespace App\GraphQL\Type\User\Business\Applicant;

use App\GraphQL\Fields\Business\Department\HtmlField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class PipelineType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Pipeline',
        'description' => 'Business Pipeline'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'items' => [
                'type' => Type::listOf(\GraphQL::type('PipelineItem')),
                'description' => 'Pipeline Items'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ]
        ];
    }
}
