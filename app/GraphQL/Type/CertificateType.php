<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\App;

class CertificateType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Certificate',
        'description' => 'Certificate for businesses'
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
                'description' => 'Certificate name En',
            ],
            'name_fr' => [
                'type' => Type::string(),
                'description' => 'Certificate name Fr',
            ],
            'localized_name' => [
                'type' => Type::string(),
                'description' => 'Localized certificate name',
            ],
            'key' => [
                'type' => Type::string(),
                'description' => 'Key for language pack'
            ]
        ];
    }
}
