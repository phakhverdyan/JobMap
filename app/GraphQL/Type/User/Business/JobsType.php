<?php

namespace App\GraphQL\Type\User\Business;

use App\GraphQL\Fields\Business\Department\HtmlField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class JobsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Jobs',
        'description' => 'Business Jobs'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'items' => [
                'type' => Type::listOf(\GraphQL::type('BusinessJob')),
                'description' => 'Job Items',
                'resolve' => function ($root, $args) {
                    if (isset($root['location_id'])) {
                        $i = 0;
                        foreach ($root['items'] as $job) {
                            $root['items'][$i]['location_id'] = $root['location_id'];
                            ++$i;
                        }
                    }
                    /*if (isset($root['locale'])) {
                        $i = 0;
                        foreach ($root['items'] as $job) {
                            $root['items'][$i]['locale'] = $root['locale'];
                            ++$i;
                        }
                    }*/
                    return $root['items'];
                }
            ],
            'pages' => [
                'type' => Type::int(),
                'description' => 'Count pages by limit'
            ],
            'count' => [
                'type' => Type::int(),
                'description' => 'Count items'
            ],
            'jobs_open' => [
                'type' => Type::int(),
                'description' => 'Count of open jobs'
            ],
            'jobs_close' => [
                'type' => Type::int(),
                'description' => 'Count of close jobs'
            ],
            'current_page' => [
                'type' => Type::int(),
                'description' => 'Current page'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ]
        ];
    }
}
