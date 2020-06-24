<?php

namespace App\GraphQL\Type\User\Settings;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\PictureResumeField;

class SetShowTooltipType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Set Show Tooltip',
        'description' => ''
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
            'result' => [
                'type' => Type::string(),
                'description' => 'result'
            ]
        ];
    }
}
