<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class IndustryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Industry',
        'description' => 'Get industries'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Primary ID'
            ],
            'parent_id' => [
                'type' => Type::id(),
                'description' => 'Parent ID'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Industry name En',
            ],
            'name_fr' => [
                'type' => Type::string(),
                'description' => 'Industry name Fr',
            ],
            'localized_name' => [
                'type' => Type::string(),
                'description' => 'Industry name (Localized)',
            ],
        ];
    }
}
