<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\App;

class CareerLevelType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Career level',
        'description' => 'Career level for businesses'
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
            'name' => [
                'type' => Type::string(),
                'description' => 'Level name En',
            ],
            'name_fr' => [
                'type' => Type::string(),
                'description' => 'Level name Fr',
            ],
            'localized_name' => [
                'type' => Type::string(),
                'description' => 'Level name Localized',
            ],
            'key' => [
                'type' => Type::string(),
                'description' => 'Key for language pack'
            ]
        ];
    }
}
