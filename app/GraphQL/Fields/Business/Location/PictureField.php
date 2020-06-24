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

class PictureField extends Field
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
        if ($root['picture']) {
            return Storage::disk('business')->url('' . $root['business_id'] . '/' . $prefix) . $root['picture'] . '?v=' . rand(11111, 99999);
        } elseif ($root['business']['picture'] && isset($args['width']) && $args['width'] == 50) {
            return Storage::disk('business')->url('' . $root['business']['id'] . '/' . $prefix) . $root['business']['picture'] . '?v=' . rand(11111, 99999);
        } else {
            return asset('img/business-logo-small.png');
        }
        
    }
    
}









