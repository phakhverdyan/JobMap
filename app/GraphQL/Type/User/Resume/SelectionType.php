<?php

namespace App\GraphQL\Type\User\Resume;

use App\GraphQL\Fields\Resume\HobbyHtmlItemsField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class SelectionType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Selection',
        'description' => 'User Selection'
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
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Selection title'
            ],
            'selections' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Selection selections'
            ]
        ];
    }
}
