<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class BusinessUnconfirmedType extends GraphQLType
{
    protected $attributes = [
        'name' => 'BusinessUnconfirmed',
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of the business'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of business'
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The slug of business'
            ],
            'website' => [
                'type' => Type::string(),
                'description' => 'The website of business'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The website of email'
            ],
            'picture' => [
                'type' => Type::string(),
                'description' => 'The website of picture',
                'resolve' => function ($root, $args) {
                    return $root['picture'] ? $root['picture'] : asset('img/business-logo-small.png');
                }
            ],
            'picture_50' => [
                'type' => Type::string(),
                'description' => 'The website of picture',
                'resolve' => function ($root, $args) {
                    return $root['picture'] ? $root['picture'] : asset('img/business-logo-small.png');
                }
            ],
            'keyword' => [
                'type' => \GraphQL::type('Keyword')
            ],
            'city' => [
                'type' => Type::string(),
                'description' => 'city'
            ],
            'region' => [
                'type' => Type::string(),
                'description' => 'region'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'country'
            ],
            'country_code' => [
                'type' => Type::string(),
                'description' => 'country_code'
            ],
            'street' => [
                'type' => Type::string(),
                'description' => 'street'
            ],
            'street_number' => [
                'type' => Type::string(),
                'description' => 'street_number'
            ],
            'suite' => [
                'type' => Type::string(),
                'description' => 'suite'
            ],
            'latitude' => [
                'type' => Type::float(),
                'description' => 'latitude'
            ],
            'longitude' => [
                'type' => Type::float(),
                'description' => 'longitude'
            ],
            'facebook' => [
                'type' => Type::string(),
                'description' => 'facebook'
            ],
            'instagram' => [
                'type' => Type::string(),
                'description' => 'instagram'
            ],
            'linkedin' => [
                'type' => Type::string(),
                'description' => 'linkedin'
            ],
            'twitter' => [
                'type' => Type::string(),
                'description' => 'twitter'
            ],

            'locations' => [
                'type' => Type::listOf(\GraphQL::type('BusinessLocation')),
                'description' => 'BusinessUnconfirmed Locations'
            ],
            'items' => [
                'type' => \GraphQL::type('BusinessLocations'),
                'description' => 'BusinessUnconfirmed Locations',
                'resolve' => function ($root, $args) {
                    return ['items' => $root['locations']];
                }
            ],
            'locations_count' => [
                'type' => Type::int(),
                'description' => 'Count locations with BusinessUnconfirmed',
                'resolve' => function ($root, $args) {
                    return count($root['locations']);
                }
            ],
            'phones' => [
                'type' => Type::listOf(\GraphQL::type('BusinessUnconfirmedPhone')),
                'description' => 'BusinessUnconfirmed Phone'
            ],
            'phones_count' => [
                'type' => Type::int(),
                'description' => 'Count phones with BusinessUnconfirmed',
                'resolve' => function ($root, $args) {
                    return count($root['phones']);
                }
            ],
            'phone_first' => [
                'type' => Type::string(),
                'description' => 'BusinessUnconfirmed Phone first',
                'resolve' => function ($root, $args) {
                    return count($root['phones']) ? $root['phones']->first()->value : null;
                }
            ],
        ];
    }
}
