<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\Business\Invoice\HtmlField;

class InvoiceType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Invoice',
        'description' => 'Invoice table'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'id'
            ],
            'client_id' => [
                'type' => Type::id(),
                'description' => 'Client id ?'
            ],
            'business_id' => [
                'type' => Type::id(),
                'description' => 'Business ID'
            ],
            'charge_id' => [
                'type' => Type::string(),
                'description' => 'Charge id from stripe'
            ],
            'balance_transaction' => [
                'type' => Type::id(),
                'description' => 'Balance transaction from stripe'
            ],
            'plan_id' => [
                'type' => Type::id(),
                'description' => 'Monthly plan ID'
            ],
            'package_id' => [
                'type' => Type::id(),
                'description' => 'Addon Packages ID '
            ],
            'status' => [
                'type' => Type::string(),
                'description' => 'Payment status'
            ],
            'total' => [
                'type' => Type::string(),
                'description' => 'Total price with Tax'
            ],
            'card_id' => [
                'type' => Type::string(),
                'description' => 'Stripe card id'
            ],
            'fingerprint' => [
                'type' => Type::string(),
                'description' => 'Stripe card fingerprint'
            ],
            'coupon_id' => [
                'type' => Type::id(),
                'description' => 'Discount coupon ID'
            ],
            'company_name' => [
                'type' => Type::string(),
                'description' => 'The company name'
            ],
            'owner_name' => [
                'type' => Type::string(),
                'description' => 'The owner name'
            ],
            'street_number' => [
                'type' => Type::string(),
                'description' => 'The street number'
            ],
            'street' => [
                'type' => Type::string(),
                'description' => 'The street name'
            ],
            'suite' => [
                'type' => Type::string(),
                'description' => 'The suite'
            ],
            'region' => [
                'type' => Type::string(),
                'description' => 'The region name'
            ],
            'city' => [
                'type' => Type::string(),
                'description' => 'The city name'
            ],
            'zip_code' => [
                'type' => Type::string(),
                'description' => 'Zip code / PO Box'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'The country name'
            ],
            'applicants' => [
                'type' => Type::int(),
                'description' => 'The Applicants numbers'
            ],
            'price' => [
                'type' => Type::string(),
                'description' => 'The plan price'
            ],
            'created_date' => [
                'type' => Type::string(),
                'description' => 'Invoice created date',
                'resolve' => function ($root, $args) {
                    if (isset($root['created_at'])) {
                        return $root['created_at']->format('M d, Y');
                    } else {
                        return null;
                    }
                }
            ],
            'html' => HtmlField::class,
            'html_print' => HtmlField::class,
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],

        ];
    }
}
