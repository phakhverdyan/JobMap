<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 28.12.2017
 * Time: 03:34
 */

namespace App\GraphQL\Fields\Business\Job;

use App\Business;
use App\JobCategory;
use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class ForUnionHtmlField extends Field
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
            $business = Business::query()->where(['id' => $root['business_id']])->first();
            if ($business['picture']) {
                $picture = Storage::disk('business')->url('/' . $business['id'] . '/50.50.') . $business['picture'] . '?v=' . rand(11111, 99999);
            } else {
                $picture = asset('img/profilepic2.png');
            }
            $your_date = $root['updated_at'];
            $datediff = time() - strtotime($your_date);
            $days = round($datediff / (60 * 60 * 24));

            Carbon::setLocale(\App::getLocale());
            $dt = Carbon::now();
            $d = ($days == 0) ? trans('fields.today') : $dt->subDays($days)->diffForHumans();
            
            $location = $root['city'];
            if ($root['region']) {
                $location .= ', ' . $root['region'];
            }
            if ($root['country']) {
                $location .= ', ' . $root['country'];
            }
    
            $types = [];
            $jobTypes = \App\Business\JobType::query()->where([
                'job_id' => $root['job_id']
            ])->get()->all();
            foreach ($jobTypes as $type) {
                $types[] = $type['type'];
            }
    
            $categoryLocalizedName = '';

            if ($root['category_id']) {
                $category = JobCategory::query()->where([
                    'id' => $root['category_id']
                ])->first();

                if ($category) {
                    $categoryLocalizedName = $category->localized_name;
                }
            }
            
            $view = View('common.job.graphql.job_union_item', [
                'args' => $root,
                'picture' => $picture,
                'location' => $location,
                'types' => $types,
                'category' => $categoryLocalizedName,
                'd' => $d
            ])->render();
            
            return $view;
        }
        
        return '';
    }
    
}









