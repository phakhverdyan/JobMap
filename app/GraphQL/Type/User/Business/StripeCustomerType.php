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

class StripeCustomerType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Stripe Customer',
        'description' => 'Stripe Customer'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::string(),
                'description' => 'Stipe customer id'
            ],
            'business_id' => [
                'type' => Type::id(),
                'description' => 'Business id'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],

        ];
    }


}