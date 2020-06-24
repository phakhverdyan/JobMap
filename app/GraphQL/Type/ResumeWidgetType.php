<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\App;

class ResumeWidgetType extends GraphQLType
{
    protected $attributes = [
        'name' => 'CV widget resume file',
        'description' => 'CV widget resume file'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'resume_file' => [
                'type' => Type::string(),
                'description' => 'Resume file'
            ]
        ];
    }
}
