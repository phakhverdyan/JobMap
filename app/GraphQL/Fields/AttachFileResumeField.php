<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 28.12.2017
 * Time: 03:34
 */

namespace App\GraphQL\Fields;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\Storage;

class AttachFileResumeField extends Field
{
    
    protected $attributes = [
        'description' => 'A attach file'
    ];
    
    public function type()
    {
        return Type::string();
    }
    
    public function args()
    {
        return [

        ];
    }
    
    protected function resolve($root, $args)
    {
        return !empty($root['attach_file']) ? Storage::disk('user_resume')->url('/' . $root['id'] . '/') . $root['attach_file'] . '?v=' . rand(11111, 99999) : '';
    }
    
}









