<?php

namespace App\GraphQL\Type\User\Business;

use App\GraphQL\Fields\Business\BgPictureField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ImageType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Image Business',
        'description' => 'Image by Business'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'id'
            ],
            'number' => [
                'type' => Type::int(),
                'description' => 'number'
            ],
            'business_id' => [
                'type' => Type::id(),
                'description' => 'business id'
            ],
            'bg_picture' => BgPictureField::class,
            'bg_picture_o' => BgPictureField::class,
        ];
    }
}
