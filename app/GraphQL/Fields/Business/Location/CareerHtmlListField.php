<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 28.12.2017
 * Time: 03:34
 */

namespace App\GraphQL\Fields\Business\Location;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\Storage;

class CareerHtmlListField extends Field
{
    
    protected $attributes = [
        'description' => 'Business Location HTML Accordion Item'
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
            if ($root['business']['picture']) {
                $picture = Storage::disk('business')->url('/' . $root['business']['id'] . '/50.50.') . $root['business']['picture'] . '?v=' . rand(11111, 99999);
            } else {
                $picture = asset('img/profilepic2.png');
            }
            $location = $root['city'];
            if ($root['region'] != "") {
                $location .= "," . $root['region'];
            }
            if ($root['country'] != "") {
                $location .= "," . $root['country'];
            }
            $layout = 'common.job.graphql.career_page_headquarter_accordion_item';
            if($root['type'] === 'location'){
                $layout = 'common.job.graphql.career_page_location_accordion_item';
            }
            $view = View($layout, [
                'args' => $root,
                'picture' => $picture,
                'location' => $location
            ])->render();
    
            return $view;
        }
        
        return '';
    }
    
}









