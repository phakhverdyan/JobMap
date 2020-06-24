<?php

namespace App\GraphQL\Type\User\Resume;

use App\GraphQL\Fields\Resume\SkillHtmlItemsField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class SendType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Send resume',
        'description' => 'Send resume'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'message' => [
                'type' => Type::string(),
                'description' => 'Message of send status'
            ],
            'status' => [
                'type' => Type::int(),
                'description' => 'Status'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ]
        ];
    }
}
