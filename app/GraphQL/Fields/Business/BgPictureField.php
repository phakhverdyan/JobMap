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

class BgPictureField extends Field
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
            'crop' => [
                'type' => Type::boolean(),
                'description' => 'The crop of the picture'
            ],
            'origin' => [
                'type' => Type::boolean(),
                'description' => 'The origin picture'
            ]
        ];
    }
    
    protected function resolve($root, $args)
    {
        $prefix = 'crop_';
        if (isset($args['crop'])) {
            if ($args['crop']) {
                $prefix = 'crop_';
            }
        } else if (isset($args['origin'])) {
            if ($args['origin']) {
                $prefix = '';
            }
        }
        if ($root['bg_picture']) {
            return Storage::disk('business')->url('' . $root['business_id'] . '/' . $prefix) . $root['bg_picture'] . '?v=' . rand(11111, 99999);
        } else {
            return asset('img/bg-white-cr.png');
        }
        
    }
    
}









