<?php

namespace App\Http\Controllers\JobMap;

use App\Http\Controllers\Controller;
use App\Amenity;
use App\BusinessSize;
use App\CareerLevel;
use App\Industry;
use App\JobCategory;
use App\JobType;
use App\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

class MapController extends Controller
{
    public function index(){
        $industries = Industry::query()
            ->limit(7)->get()->all();
        if (App::isLocale('fr')) {
            foreach ($industries as $key=>$item) {
                $industries[$key]->name = $item->name_fr;
            }
        }
        $industries = collect($industries)->sortBy('name')->toArray();

        $amenities = Amenity::query()->get()->all();
        if (App::isLocale('fr')) {
            foreach ($amenities as $key=>$item) {
                $amenities[$key]->name = $item->name_fr;
            }
        }
        $amenities = collect($amenities)->sortBy('name')->toArray();
    
        $getData = Input::get();
        $careers = CareerLevel::query()->get()->all();
        if (App::isLocale('fr')) {
            foreach ($careers as $key=>$item) {
                $careers[$key]->name = $item->name_fr;
            }
        }
        $types = JobType::query()->get()->all();
        if (App::isLocale('fr')) {
            foreach ($types as $key=>$item) {
                $types[$key]->name = $item->name_fr;
            }
        }
        $types = collect($types)->sortBy('name')->toArray();
        $sizes = BusinessSize::query()->get()->all();
        $keywords = Keyword::query()->limit(7)->get()->all();
    
        $categories = JobCategory::query()
            ->where('parent_id', null)
            ->limit(7)->get()->all();
        if (App::isLocale('fr')) {
            foreach ($categories as $key=>$item) {
                $categories[$key]->name = $item->name_fr;
            }
        }
        $categories = collect($categories)->sortBy('name')->toArray();
    
        $filters = $getData;
        return view('common.jobmap.jobmap_landing', [
            'amenities' => $amenities,
            'industries' => $industries,
            'careers' => $careers,
            'data' => [],
            'types' => $types,
            'sizes' => $sizes,
            'keywords' => $keywords,
            'getData' => $getData,
            'categories' => $categories,
            'filters' => (count($filters) > 0) ? true : false
        ]);
    }
}
