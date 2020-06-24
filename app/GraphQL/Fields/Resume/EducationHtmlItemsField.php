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

class EducationHtmlItemsField extends Field
{
    
    protected $attributes = [
        'description' => 'Education HTML Items'
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
        $location = $root['city'];
        if ($root['region'] != "") {
            $location .= "," . $root['region'];
        }
        if ($root['country'] != "") {
            $location .= "," . $root['country'];
        }
        $view = View('components.resume_builder.graphql.education_item', [
            'args' => $root,
            'location' => $location
        ])->render();
        
        return $view;
    }
    
}









