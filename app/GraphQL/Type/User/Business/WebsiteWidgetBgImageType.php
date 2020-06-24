<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\App;

class WebsiteWidgetBgImageType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business widget background image file',
        'description' => 'Business widget background image file'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Business id'
            ],
            'background_image_file' => [
                'type' => Type::string(),
                'description' => 'Background image'
            ]
        ];
    }
}

