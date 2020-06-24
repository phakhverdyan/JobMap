<?php

namespace App\GraphQL\Fields\Business\Pipeline;

use App\Business\Administrator;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\Storage;

class HtmlField extends Field
{
    
    protected $attributes = [
        'description' => 'Pipeline edit item'
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
        $view = View('business.auth.graphql.pipeline_edit_item', [
            'args' => $root,
        ])->render();
        
        return $view;
    }
    
}









