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

class PictureResumeField extends Field
{
    
    protected $attributes = [
        'description' => 'A picture'
    ];
    
    public function type()
    {
        return Type::string();
    }
    
    public function args()
    {
        return [
            'width' => [
                'type' => Type::int(),
                'description' => 'The width of the picture'
            ],
            'height' => [
                'type' => Type::int(),
                'description' => 'The height of the picture'
            ],
            'crop' => [
                'type' => Type::boolean(),
                'description' => 'The crop picture'
            ],
            'origin' => [
                'type' => Type::boolean(),
                'description' => 'The origin picture'
            ]
        ];
    }
    
    protected function resolve($root, $args)
    {
        if (isset($args['crop'])) {
            if ($args['crop']) {
                $prefix = 'crop_';
            }
        } else if (isset($args['origin'])) {
            if ($args['origin']) {
                $prefix = '';
            }
        } else {
            $width = $args['width'] ?? 100;
            $height = $args['height'] ?? 100;
            $prefix = $width . '.' . $height . '.';
        }
        if (isset($root['user_pic_custom']) && $root['user_pic_custom'] == 1) {
            return Storage::disk('user_resume')->url('/' . $root['id'] . '/' . $prefix) . $root['user_pic'] . '?v=' . rand(11111, 99999);
        } else {
            return (isset($root['user_pic']) && $root['user_pic']) ? $root['user_pic'] : '/img/profilepic2.png';
        }
        
    }
    
}









