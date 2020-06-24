<?php

namespace App\GraphQL\Type\User\Business;

use App\GraphQL\Fields\Business\BgPictureField;
use App\GraphQL\Fields\Business\PictureField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class UpdateImageBusinessType extends GraphQLType
{
    protected $attributes = [
        'name' => 'UpdateImageBusiness',
        'description' => 'UpdateImageBusiness'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'picture_o' => PictureField::class,
            'bg_picture' => BgPictureField::class,
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
            'error_message' => [
                'type' => Type::string(),
                'description' => 'error_message',
            ],
            'id' => [
                'type' => Type::id(),
                'description' => 'id'
            ],
            'business_id' => [
                'type' => Type::id(),
                'description' => 'business id'
            ],
        ];
    }
}
