<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\Business\Button\WidgetHtmlField;
use App\GraphQL\Fields\Business\PictureField;

class WebsiteWidgetType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Website Widget',
        'description' => 'Business Website Widget'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Widget ID'
            ],
            'business_id' => [
                'type' => Type::id(),
                'description' => 'Business ID'
            ],
            'business' => [
                'type' => \GraphQL::type('Business'),
                'resolve' => function($root, $args) {
                    return ($root['brand']) ?? null;
                }
            ],
            'brand_id' => [
                'type' => Type::id(),
                'description' => 'Widget brand ID',
            ],
            'show_job_posted_date' => [
                'type' => Type::boolean(),
                'description' => 'show job posted date'
            ],
            'code' => [
                'type' => Type::string(),
                'description' => 'Widget Code',
            ],
            'background_color' => [
                'type' => Type::string(),
                'description' => 'Widget background color',
            ],
            'link_one_color' => [
                'type' => Type::string(),
                'description' => 'Widget link one color',
            ],
            'font_color' => [
                'type' => Type::string(),
                'description' => 'Widget font color',
            ],
            'button_background_color' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Widget button background color'
            ],
            'button_text_color' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Widget button text color'
            ],
            'size_widget' => [
                'type' => Type::string(),
                'description' => 'Widget width',
            ],
            'background_image' => [
                'type' => Type::string(),
                'description' => 'Widget background image',
            ],
            'show_background_image' => [
                'type' => Type::boolean(),
                'description' => 'Is visible widget background image',
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
            'html' => WidgetHtmlField::class,

        ];
    }


}
