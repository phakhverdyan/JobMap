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

class SentResumeHtmlField extends Field
{
    
    protected $attributes = [
        'description' => 'Sent resume'
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
        if ($root['business']['picture']) {
            $picture = Storage::disk('business')->url('/' . $root['business']['id'] . '/50.50.') . $root['business']['picture'] . '?v=' . rand(11111, 99999);
        } else {
            $picture = asset('img/profilepic2.png');
        }

        $pipeline_items = \App\Business\Pipeline::where([
            'business_id' => $root['business']['id'],
        ])->where('internal', false)->orderBy('position')->get();

        $view = View('user.resume.graphql.sent_item', [
            'args' => $root,
            'picture' => $picture,
            'pipeline_items' => $pipeline_items,
        ])->render();
        
        return $view;
    }
    
}









