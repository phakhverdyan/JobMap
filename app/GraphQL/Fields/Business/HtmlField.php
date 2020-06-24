<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 28.12.2017
 * Time: 03:34
 */

namespace App\GraphQL\Fields\Business;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\Storage;

class HtmlField extends Field
{
    
    protected $attributes = [
        'description' => 'Business Brand HTML Item'
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
        $picture = null;
        if(isset($root['id'])) {
            if ($root['picture']) {
                $picture = Storage::disk('business')->url('/' . $root['id'] . '/50.50.') . $root['picture'] . '?v=' . rand(11111, 99999);
            }
            $location = $root['city'];
            if ($root['region'] != "") {
                $location .= ", " . $root['region'];
            }
            if ($root['country'] != "") {
                $location .= ", " . $root['country'];
            }
            $view = View('business.auth.graphql.brand_item', [
                'args' => $root,
                'picture' => $picture,
                'location' => $location
            ])->render();
    
            return $view;
        }
        
        return '';
    }
    
}









