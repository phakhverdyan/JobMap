<?php

namespace App\GraphQL\Type\User\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\Business\Import\HtmlField;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class AtsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Ats',
        'description' => 'Ats '
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [

            'id' => [
                'type' => Type::id(),
                'description' => 'ID'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'Import user email'
            ],
            'status' => [
                'type' => Type::string(),
                'description' => 'Import user status'
            ],
            'business_id' => [
                'type' => Type::id(),
                'description' => 'The id of business'
            ],
            'sended_at' => [
                'type' => Type::string(),
                'description' => 'Last sended email'
            ],
            'date_ago' => [
                'type' => Type::string(),
                'description' => 'Last sended email',
                'resolve' => function ($root, $args) {
                    Carbon::setLocale( App::getLocale());
                    if (isset($root['sended_at'])) {
                        return $root['sended_at']->diffForHumans();
                    } else {
                        return null;
                    }
                }
            ],
            'html' => HtmlField::class,
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
