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

class HtmlAssignField extends Field
{
    
    protected $attributes = [
        'description' => 'Business Location HTML Item from assign'
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
                $picture = Storage::disk('business')->url('/' . $root['business_id'] . '/50.50.') . $root['business']['picture'] . '?v=' . rand(11111, 99999);
            }
            $location = $root['city'];
            if ($root['region'] != "") {
                $location .= "," . $root['region'];
            }
            if ($root['country'] != "") {
                $location .= "," . $root['country'];
            }
            $view = View('business.auth.graphql.location_item_assign', [
                'args' => $root,
                'picture' => $picture,
                'location' => $location
            ])->render();
    
            return $view;
        }
        
        return '';
    }
    
}









