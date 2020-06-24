<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\Business\Card\HtmlField;

class CardType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Card',
        'description' => 'Business Card'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Job id'
            ],
            'business' => [
                'type' => \GraphQL::type('Business'),
                'resolve' => function ($root, $args) {
                    return ($root['business']) ?? null;
                }
            ],
            'owner' => [
                'type' => Type::string(),
                'description' => 'Card Owner name'
            ],
            'expire_month' => [
                'type' => Type::int(),
                'description' => 'Expire month'
            ],
            'expire_year' => [
                'type' => Type::int(),
                'description' => 'Expire year'
            ],
            'card_brand' => [
                'type' => Type::string(),
                'description' => 'Card brand'
            ],
            'card_last_four' => [
                'type' => Type::int(),
                'description' => 'Last 4 numbers'
            ],
            'is_default' => [
                'type' => Type::int(),
                'description' => 'Is default'
            ],
            'card_id' => [
                'type' => Type::string(),
                'description' => 'Stripe card id'
            ],
            'fingerprint' => [
                'type' => Type::string(),
                'description' => 'Stripe card fingerprint'
            ],
            'created_date' => [
                'type' => Type::string(),
                'description' => 'Card created date',
                'resolve' => function ($root, $args) {
                    if (isset($root['created_at'])) {
                        return $root['created_at']->format('M d, Y');
                    } else {
                        return null;
                    }
                }
            ],
            'html' => HtmlField::class,
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
