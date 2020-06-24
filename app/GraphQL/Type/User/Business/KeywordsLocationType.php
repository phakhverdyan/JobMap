<?php

namespace App\GraphQL\Type\User\Business;

use App\GraphQL\Fields\Business\Location\CareerHtmlField;
use App\GraphQL\Fields\Business\Location\CareerHtmlListField;
use App\GraphQL\Fields\Business\Location\HtmlField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\Storage;

class KeywordsLocationType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Keywords Location',
        'description' => 'Keywords by location'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'keyword id'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'keyword name'
            ],
        ];
    }
}
