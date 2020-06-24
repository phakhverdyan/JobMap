<?php

namespace App\GraphQL\Type\User;

use App\GraphQL\Fields\AttachFileResumeField;
use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\PictureResumeField;

class UserImportType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A user create business'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'pipeline' => [
                'type' => Type::string(),
                'description' => 'pipeline',
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'token',
            ],
        ];
    }
}
