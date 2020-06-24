<?php

namespace App\GraphQL\Fields;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;

class ReferenceHtmlItemField extends Field
{
    
    protected $attributes = [
        'description' => 'Reference HTML Item'
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
        $view = View('user.graphql.reference_item', [
            'args' => $root,
        ])->render();
        
        return $view;
    }
    
}









