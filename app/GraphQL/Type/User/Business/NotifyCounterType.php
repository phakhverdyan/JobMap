<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class NotifyCounterType extends GraphQLType
{
    protected $attributes = [
        'name' => 'NotifyCounterBusiness type',
        'description' => 'NotifyCounterBusiness type'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'applicants_total' => [
                'type' => Type::int(),
                'description' => 'applicants total counter'
            ],
            'applicants_new' => [
                'type' => Type::int(),
                'description' => 'applicants new counter'
            ],
            'managers' => [
                'type' => Type::int(),
                'description' => 'managers counter'
            ],
            'locations' => [
                'type' => Type::int(),
                'description' => 'locations counter'
            ],
            'failed_invoices' => [
                'type' => Type::int(),
                'description' => 'failed invoices counter'
            ],
            'departments' => [
                'type' => Type::int(),
                'description' => 'departments counter'
            ],
            'jobs' => [
                'type' => Type::int(),
                'description' => 'jobs counter'
            ],
            'brands' => [
                'type' => Type::int(),
                'description' => 'brands counter'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
