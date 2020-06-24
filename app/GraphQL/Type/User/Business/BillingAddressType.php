<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class BillingAddressType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Billing Address',
        'description' => 'Business Billing Address'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Billing address id'
            ],
            'business_id' => [
                'type' => Type::id(),
                'description' => 'The id of business'
            ],
            'company_name' => [
                'type' => Type::string(),
                'description' => 'Business company name'
            ],
            'owner_name' => [
                'type' => Type::string(),
                'description' => 'Business owner name'
            ],
            'street_number' => [
                'type' => Type::string(),
                'description' => 'Business street nubmer'
            ],
            'street' => [
                'type' => Type::string(),
                'description' => 'Business street'
            ],
            'suite' => [
                'type' => Type::string(),
                'description' => 'Business suite'
            ],
            'city' => [
                'type' => Type::string(),
                'description' => 'Business city'
            ],
            'region' => [
                'type' => Type::string(),
                'description' => 'Business region'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'Business country'
            ],
            'country_code' => [
                'type' => Type::string(),
                'description' => 'Business country code'
            ],
            'zip_code' => [
                'type' => Type::string(),
                'description' => 'Business zip code'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
