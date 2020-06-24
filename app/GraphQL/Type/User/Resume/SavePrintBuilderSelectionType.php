<?php

namespace App\GraphQL\Type\User\Resume;

use App\GraphQL\Fields\Resume\ItemSelectionHtmlField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class SavePrintBuilderSelectionType extends GraphQLType
{
    protected $attributes = [
        'name' => 'SavePrintBuilderSelectionType',
        'description' => 'RSavePrintBuilderSelectionType'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'item_selection' => ItemSelectionHtmlField::class,
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ]
        ];
    }
}
