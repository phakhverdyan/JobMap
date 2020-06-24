<?php

namespace App\GraphQL\Fields\Business\Button;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\Storage;

class WidgetHtmlField extends Field
{

    protected $attributes = [
        'description' => 'Business Website Widget HTML Item'
    ];

    public function type()
    {
        return Type::string();
    }

    public function args()
    {
        return [];
    }

    protected function resolve($root, $args)
    {
        if(isset($root['id'])) {
            $view = View('business.auth.graphql.widget_item', [
                'args' => $root,
                'brand' => $root->brand ?? null,
            ])->render();

            return $view;
        }

        return '';
    }

}









