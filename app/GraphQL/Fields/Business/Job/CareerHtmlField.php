<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 28.12.2017
 * Time: 03:34
 */

namespace App\GraphQL\Fields\Business\Job;

use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class CareerHtmlField extends Field
{

    protected $attributes = [
        'description' => 'Business Job HTML Item'
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
            if ($root['location_business'] && $root['location_business']['picture']) {
                $picture = Storage::disk('business')->url('/' . $root['location_business']['id'] . '/50.50.') . $root['location_business']['picture'] . '?v=' . rand(11111, 99999);
                $big_picture = Storage::disk('business')->url('/' . $root['location_business']['id'] . '/') . $root['location_business']['picture'] . '?v=' . rand(11111, 99999);
            } else if ($root['business'] && $root['business']['picture']) {
                $picture = Storage::disk('business')->url('/' . $root['business']['id'] . '/50.50.') . $root['business']['picture'] . '?v=' . rand(11111, 99999);
                $big_picture = Storage::disk('business')->url('/' . $root['business']['id'] . '/') . $root['business']['picture'] . '?v=' . rand(11111, 99999);
            } else {
                $picture = asset('img/profilepic2.png');
                $big_picture = $picture;
            }
            
            $your_date = $root['updated_at']->timestamp;
            $datediff = time() - $your_date;
            $days = round($datediff / (60 * 60 * 24));

            Carbon::setLocale( App::getLocale());
            $dt = Carbon::now();
            $d = ($days == 0) ? trans('fields.today') : $dt->subDays($days)->diffForHumans();

            $locations = $root['locationsAll'];
            $countLocations = count($locations);
            if ($countLocations == 1) {
                $location = $locations[0]['location']['city'];
                if ($locations[0]['location']['region']) {
                    $location .= ', ' . $locations[0]['location']['region'];
                }
                if ($locations[0]['location']['country']) {
                    $location .= ', ' . $locations[0]['location']['country'];
                }
                $root['job_id'] = $locations[0]['id'];
            } else {
                //$location = 'Available in ' . $countLocations . ' locations';
                $location = trans('pages.available_in_count_locations',['count'=> $countLocations]);
                $root['job_id'] = 0;
                if ($countLocations > 1) {
                    $root['job_id'] = $locations[0]['id'];
                }
            }

            $view = View('common.job.graphql.job_item', [
                'args' => $root,
                'picture' => $picture,
                'big_picture' => $big_picture,
                'location' => $location,
                'd' => $d
            ])->render();

            return $view;
        }

        return '';
    }

}









