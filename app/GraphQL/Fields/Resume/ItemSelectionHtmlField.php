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
use Illuminate\Support\Facades\Storage;

class ItemSelectionHtmlField extends Field
{
    
    protected $attributes = [
        'description' => 'ItemSelection HTML'
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

        $data = [
            //'user_id' => $this->auth->id
        ];
        
        $view = View('components.resume_builder.graphql.item_selection', [
            'args' => $root,
            'data' => $data
        ])->render();
        
        return $view;
    }
    
}









