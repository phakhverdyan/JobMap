<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class JobCategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Job category',
        'description' => 'Job category for businesses'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::string(),
                'description' => 'Primary ID'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Job name'
            ],
            'name_fr' => [
                'type' => Type::string(),
                'description' => 'Job name FR'
            ],
        ];
    }
}
