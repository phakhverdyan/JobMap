<?php

namespace App\Http\Controllers\JobMap;

use App\Http\Controllers\Controller;
use App\Amenity;
use App\BusinessSize;
use App\CareerLevel;
use App\Http\GraphQLClient;
use App\Industry;
use App\JobCategory;
use App\JobType;
use App\Keyword;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $currentPage = 1;
    protected $limit = 25;
    protected $type = 'jobs';
    protected $search;
    protected $sort;
    protected $order;

    public function __construct()
    {
        $this->currentPage = (int)Input::get('page', 1);
        $this->sort = Input::get('sort', false);
        $this->order = Input::get('order', false);
        $this->limit = (int)Input::get('limit', 25);
    }

    public function advanced()
    {
        $refer = url()->previous();
        $url = explode('/', $refer);

        $getData = Input::get();
        $industries = Industry::query()->limit(7)->get()->all();
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

        return view('common.jobmap.advanced_filters', [
            'amenities' => $amenities,
            'industries' => $industries,
            'getData' => $getData,
            'prev' => (isset($url[4]) && (strpos($url[4], 'jobs') !== false || strpos($url[4], 'employers') !== false)) ? $url[4] : 'jobs',
            'parsedUrl' => parse_url(\request()->url())
        ]);
    }

    public function results(Request $request)
    {
        // $clientItems = new GraphQLClient();
        // $clientItems->setParams('searchJobs');
        // $clientItems->addResponse([
        //     'items {' .
        //         'id html_career title assign_locations {id job_id business{picture_50(width:50,height:50)} name street street_number city region country created_date job_status}' .
        //     '}',
        //     'pages',
        //     'count',
        //     'current_page '
        // ]);

        // $clientItems->addRequest([
        //     'title' => $request->get('title'),
        //     'limit' => $this->limit,
        //     'page' => $this->currentPage
        // ]);

        // $items = $clientItems->request();

        // $startOf = ($this->currentPage == 1) ? $this->currentPage : $this->currentPage * $this->limit;
        // $endOf = ($this->currentPage != $items->pages) ? ($this->currentPage * $this->limit) + $this->limit : $items->count;

        return view('common.jobmap.cardinal', [
            'data' => [],
            'title' => $request->get('title'),
            // 'items' => $items,
            'sort' => $this->sort,
            'order' => $this->order,
            'limit' => $this->limit,
            'current_page' => $this->currentPage,
            // 'start' => ($items->count > 0) ? $startOf : 0,
            // 'end' => ($items->count > 0) ? $endOf : 0
        ]);
    }

    // public function results($type = 'jobs')
    // {
    //     $getData = Input::get();
    //     $this->type = $type;
    //     $careers = CareerLevel::query()->get()->all();
    //     if (App::isLocale('fr')) {
    //         foreach ($careers as $key=>$item) {
    //             $careers[$key]->name = $item->name_fr;
    //         }
    //     }
    //     $types = JobType::query()->get()->all();
    //     if (App::isLocale('fr')) {
    //         foreach ($types as $key=>$item) {
    //             $types[$key]->name = $item->name_fr;
    //         }
    //     }
    //     $types = collect($types)->sortBy('name')->toArray();
    //     $sizes = BusinessSize::query()->get()->all();
    //     $keywords = Keyword::query()->limit(7)->get()->all();

    //     $industries = Industry::query()->limit(7)->get()->all();
    //     if (App::isLocale('fr')) {
    //         foreach ($industries as $key=>$item) {
    //             $industries[$key]->name = $item->name_fr;
    //         }
    //     }
    //     $industries = collect($industries)->sortBy('name')->toArray();
    //     $categories = JobCategory::query()
    //         ->where('parent_id', null)
    //         ->limit(7)->get()->all();
    //     if (App::isLocale('fr')) {
    //         foreach ($categories as $key=>$item) {
    //             $categories[$key]->name = $item->name_fr;
    //         }
    //     }
    //     $categories = collect($categories)->sortBy('name')->toArray();
    //     $layout = 'common.jobmap.job_results';

    //     $clientItems = new GraphQLClient();
    //     $clientItems->addRequest($getData);

    //     $assignParams = '';

    //     $filters = $getData;
    //     unset($filters['location']);
    //     unset($filters['title']);

    //     switch ($this->type) {
    //         case 'jobs':
    //             $query = 'searchJobs';
    //             $assignParams = ' title assign_locations {id job_id business{picture_50(width:50,height:50)} name street street_number city region country created_date job_status}';
    //             break;
    //         default:
    //             $query = 'searchEmployers';
    //             break;
    //     }
    //     $clientItems->setParams($query);
    //     $clientItems->addResponse([
    //         'items {' .
    //         'id html_career ' . $assignParams .
    //         '}',
    //         'pages',
    //         'count',
    //         'current_page '
    //     ]);
    //     $clientItems->addRequest([
    //         'limit' => $this->limit,
    //         'page' => $this->currentPage
    //     ]);

    //     $items = $clientItems->request();

    //     $startOf = ($this->currentPage == 1) ? $this->currentPage : $this->currentPage * $this->limit;
    //     $endOf = ($this->currentPage != $items->pages) ? ($this->currentPage * $this->limit) + $this->limit : $items->count;

    //     return view($layout, [
    //         'careers' => $careers,
    //         'current_page' => $this->currentPage,
    //         'data' => [],
    //         'items' => $items,
    //         'type_items' => $this->type,
    //         'types' => $types,
    //         'sizes' => $sizes,
    //         'keywords' => $keywords,
    //         'sort' => $this->sort,
    //         'order' => $this->order,
    //         'limit' => $this->limit,
    //         'getData' => $getData,
    //         'industries' => $industries,
    //         'categories' => $categories,
    //         'start' => ($items->count > 0) ? $startOf : 0,
    //         'end' => ($items->count > 0) ? $endOf : 0,
    //         'filters' => (count($filters) > 0) ? true : false
    //     ]);
    // }
}
