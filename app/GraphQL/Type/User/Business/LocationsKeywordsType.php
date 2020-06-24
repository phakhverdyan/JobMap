<?php

namespace App\GraphQL\Type\User\Business;

use App\GraphQL\Fields\Business\Location\CareerHtmlField;
use App\GraphQL\Fields\Business\Location\CareerHtmlListField;
use App\GraphQL\Fields\Business\Location\HtmlField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\Storage;

class LocationsKeywordsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Locations Keywords',
        'description' => 'Locations Keywords'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'name' => [
                'type' => Type::string(),
                'description' => 'location name'
            ],
            'country_code' => [
                'type' => Type::string(),
                'description' => 'location country code'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
