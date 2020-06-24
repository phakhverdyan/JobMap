<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 28.12.2017
 * Time: 03:34
 */

namespace App\GraphQL\Fields\Business\Department;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\Storage;

class HtmlField extends Field
{
    
    protected $attributes = [
        'description' => 'Business Department HTML Item'
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
        if (isset($root['id'])) {
            $view = View('business.auth.graphql.department_item', [
                'args' => $root
            ])->render();
            
            return $view;
        }
        
        return '';
    }
    
}









