<?php

namespace App\GraphQL\Type\User\Widget;

use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\PictureResumeField;

class InfoCheckType extends GraphQLType
{
    protected $attributes = [
        'name' => 'InfoCheck',
        'description' => 'A widget info check'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'response' => [
                'type' => Type::string(),
                'description' => 'response'
            ],
        ];
    }
}
