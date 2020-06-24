<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 28.12.2017
 * Time: 03:34
 */

namespace App\GraphQL\Fields\Business\Location;

use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class CareerHtmlField extends Field
{
    
    protected $attributes = [
        'description' => 'Business Location HTML Item'
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
            //if ($root['business']['picture']) {
            if ($root['picture']) {
                $picture = Storage::disk('business')->url('' . $root['business']['id'] . '/50.50.') . $root['picture'] . '?v=' . rand(11111, 99999);
            } elseif ($root['business']['picture']) {
                $picture = Storage::disk('business')->url('' . $root['business']['id'] . '/50.50.') . $root['business']['picture'] . '?v=' . rand(11111, 99999);
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
            $layout = 'common.job.graphql.location_item';
//            if($root['type'] === 'location'){
//                $layout = 'common.job.graphql.career_page_location';
//            }
            if ($root['updated_at']) {
                $your_date = $root['updated_at']->timestamp;
            } else {
                $your_date = time();
            }
            $datediff = time() - $your_date;
            $days = round($datediff / (60 * 60 * 24));

            Carbon::setLocale( App::getLocale());
            $dt = Carbon::now();
            $d = ($days == 0) ? trans('fields.today') : $dt->subDays($days)->diffForHumans();
            $view = View($layout, [
                'args' => $root,
                'picture' => $picture,
                'location' => $location,
                'd' => $d
            ])->render();
    
            return $view;
        }
        
        return '';
    }
    
}









