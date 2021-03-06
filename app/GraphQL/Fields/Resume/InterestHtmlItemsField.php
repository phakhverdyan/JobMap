<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 28.12.2017
 * Time: 03:34
 */

namespace App\GraphQL\Fields\Resume;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;

class InterestHtmlItemsField extends Field
{
    
    protected $attributes = [
        'description' => 'Interest HTML Items'
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
        $view = View('components.resume_builder.graphql.interest_item', [
            'args' => $root
        ])->render();
        
        return $view;
    }
    
}









