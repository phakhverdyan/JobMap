<?php

namespace App\GraphQL\Type\User\Resume;

use App\Certificate;
use App\GraphQL\Fields\Resume\CertificationHtmlItemsField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\App;

class CertificationType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Certification',
        'description' => 'User certification'
    ];
    
    /**
     * @return array
     */
    public $countCertificatesBasic = 493;
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Primary ID'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Certification ID'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Certification title',
                'resolve' => function ($root, $args) {
                    if ($root['title_id']) {
                        $item = Certificate::find($root['title_id']);
                        $name = $item->name;
                        if (App::isLocale('fr')) {
                            $name = $item->name_fr;
                        }
                        return $name;
                    }
                    return $root['title'];
                }
            ],
            'title_id' => [
                'type' => Type::int(),
                'description' => 'Job title_id'
            ],
            'assign_title' => [
                'type' =>\GraphQL::type('AutocompleteResume'),
                'resolve' => function ($root, $args) {
                    if ($root['title_id']) {
                        $item = Certificate::find($root['title_id']);
                        $title = $item->name;
                        if (App::isLocale('fr')) {
                            $title = $item->name_fr;
                        }
                        return  [
                            'id' => $root['title_id'],
                            'title' => $title,
                        ];
                    }
                    return null;
                }
            ],
            'type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Certification type'
            ],
            'year' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Certification year'
            ],
            'html' => CertificationHtmlItemsField::class,
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
