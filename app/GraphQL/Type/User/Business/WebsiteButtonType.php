<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 07.03.18
 * Time: 16:00
 */

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\Business\Button\HtmlField;

class WebsiteButtonType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Website Button',
        'description' => 'Business Website Button'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Button id'
            ],
            'business_id' => [
                'type' => Type::id(),
                'description' => 'Business id'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Button title',
            ],
            'code' => [
                'type' => Type::string(),
                'description' => 'Button Code',
            ],
            'data' => [
                'type' => Type::string(),
                'description' => 'Button data params',
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
            'user_ip' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
            'button_count' => [
                'type' => Type::int(),
                'description' => 'Count website button'
            ],
            'html' => HtmlField::class,

        ];
    }


}