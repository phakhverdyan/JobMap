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

class HtmlMapListField extends Field
{
    
    protected $attributes = [
        'description' => 'Business list item'
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
        if ($root['picture']) {
            $picture = Storage::disk('business')->url('/' . $root['id'] . '/50.50.') . $root['picture'] . '?v=' . rand(11111, 99999);
        } else {
            $picture = asset('img/profilepic2.png');
        }
        $view = View('common.job.graphql.business_location_accordion_item', [
            'args' => $root,
            'picture' => $picture
        ])->render();
    
        return $view;
    }
    
}









