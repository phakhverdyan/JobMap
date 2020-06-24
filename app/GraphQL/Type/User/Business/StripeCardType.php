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

class StripeCardType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Stripe Customer Card',
        'description' => 'Stripe Customer Card'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'number' => [
                'type' => Type::string(),
                'description' => 'Card Number'
            ],
            'expiryYear' => [
                'type' => Type::int(),
                'description' => 'Expiry year'
            ],
            'expiryMonth' => [
                'type' => Type::int(),
                'description' => 'Expiry month'
            ],
            'code' => [
                'type' => Type::int(),
                'description' => 'CVC/CVV CODE'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Card holder name'
            ],
            'stripe_id' => [
                'type' => Type::string(),
                'description' => 'Stripe id'
            ],
            'card_id' => [
                'type' => Type::string(),
                'description' => 'Stripe card id'
            ],
            'fingerprint' => [
                'type' => Type::string(),
                'description' => 'Stripe card fingerprint'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],

        ];
    }


}