<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 28.12.2017
 * Time: 03:34
 */

namespace App\GraphQL\Fields\Business\Job;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\Storage;

class CareerHtmlListField extends Field
{
    
    protected $attributes = [
        'description' => 'Business Job HTML Accordion Item'
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
            if ($root['business']['picture']) {
                $picture = Storage::disk('business')->url('/' . $root['business']['id'] . '/50.50.') . $root['business']['picture'] . '?v=' . rand(11111, 99999);
            } else {
                $picture = asset('img/profilepic2.png');
            }
            $view = View('common.job.graphql.career_page_job_accordion_item', [
                'args' => $root,
                'picture' => $picture
            ])->render();
            
            return $view;
        }
        
        return '';
    }
    
}









