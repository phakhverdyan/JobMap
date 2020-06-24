<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class BillingType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Billing',
        'description' => 'Invoices '
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Billing id'
            ],

            'client_id' => [
                'type' => Type::id(),
                'description' => 'client id ?'
            ],
            'business_id' => [
                'type' => Type::id(),
                'description' => 'The id of business'
            ],
            'invoice_id' => [
                'type' => Type::id(),
                'description' => 'The invoice ID'
            ],
            'plan_id' => [
                'type' => Type::id(),
                'description' => 'Plan id'
            ],
            'package_id' => [
                'type' => Type::id(),
                'description' => 'Addon package id'
            ],
            'status' => [
                'type' => Type::string(),
                'description' => 'Status'
            ],
            'total' => [
                'type' => Type::string(),
                'description' => 'Status'
            ],
            'coupon_id' => [
                'type' => Type::id(),
                'description' => 'Status'
            ],
            'is_canceled' => [
                'type' => Type::id(),
                'description' => 'Status'
            ],


            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
