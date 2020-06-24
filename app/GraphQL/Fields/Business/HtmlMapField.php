<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 28.12.2017
 * Time: 03:34
 */

namespace App\GraphQL\Fields\Business;

use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class HtmlMapField extends Field
{
    
    protected $attributes = [
        'description' => 'Business item'
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
//        if ($root['picture']) {
        $picture = Storage::disk('business')->url('/' . $root['id'] . '/50.50.') . $root['picture'] . '?v=' . rand(11111, 99999);
//        } else {
//            $picture = asset('img/profilepic2.png');
//        }
//        $location = $root['city'];
//        if ($root['region'] != "") {
//            $location .= "," . $root['region'];
//        }
//        if ($root['country'] != "") {
//            $location .= "," . $root['country'];
//        }
        $your_date = $root['updated_at']->timestamp;
        $datediff = time() - $your_date;
        $days = round($datediff / (60 * 60 * 24));

        Carbon::setLocale( App::getLocale());
        $dt = Carbon::now();
        $d = ($days == 0) ? trans('fields.today') : $dt->subDays($days)->diffForHumans();
        $view = View('common.job.graphql.business_item', [
            'args' => $root,
            'picture' => $picture,
//            'location' => $location,
            'd' => $d
        ])->render();
        
        return $view;
    }
    
}









