<?php

namespace App\GraphQL\Type\User;

use App\GraphQL\Fields\ReferenceHtmlItemField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ReferenceType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Reference',
        'description' => 'User references'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Primary ID'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'User ID'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Email of referer'
            ],
            'phone' => [
                'type' => Type::string(),
                'description' => 'Phone Number of referer'
            ],
            'full_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Full name of referer'
            ],
            'company' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Company of referer'
            ],
            'status' => [
                'type' => Type::string(),
                'description' => 'Status of reference'
            ],
            'message' => [
                'type' => Type::string(),
                'description' => 'Status of reference'
            ],
            'html' => ReferenceHtmlItemField::class,
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
