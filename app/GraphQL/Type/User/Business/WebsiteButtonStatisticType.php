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

class WebsiteButtonStatisticType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Website Button Statistic',
        'description' => 'Business Website Button Statistic'
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
            'button_id' => [
                'type' => Type::id(),
                'description' => 'Button id',
            ],
            'user_ip' => [
                'type' => Type::string(),
                'description' => 'user_ip',
            ],
            'site_url' => [
                'type' => Type::string(),
                'description' => 'Site url',
            ],
            'data' => [
                'type' => Type::string(),
                'description' => 'Other data',
            ],
            'action' => [
                'type' => Type::string(),
                'description' => 'hover or click',
            ],

        ];
    }


}