<?php

namespace App\GraphQL\Type\User;

use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\PictureResumeField;

class UserCheckType extends GraphQLType
{
    protected $attributes = [
        'name' => 'UserCheck',
        'description' => 'A user check'
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
            'redirect_to' => [
                'type' => Type::string(),
                'description' => 'Redirect to'
            ],
        ];
    }
}
