<?php

namespace App\Http\Controllers\JobMap;

use App\Http\Controllers\Controller;
use App\Business;
use App\BusinessSize;
use App\CareerLevel;
use App\Http\GraphQLClient;
use App\Industry;
use App\JobCategory;
use App\JobType;
use App\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

class CardinalController extends Controller
{
    protected $currentPage = 1;
    protected $limit = 25;
    protected $type = 'jobs';
    protected $sort;
    //protected $order;

    public function index()
    {
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

        $industries = Industry::query()->limit(10)->get()->all();
        if (App::isLocale('fr')) {
            foreach ($industries as $key=>$item) {
                $industries[$key]->name = $item->name_fr;
            }
        }
        $industries = collect($industries)->sortBy('name')->toArray();

        $keywords = Keyword::query()->limit(7)->get()->all();
        $getData = Input::get();

        $categories = JobCategory::query()->where('parent_id','=', null)->limit(7)->get()->all();
        if (App::isLocale('fr')) {
            foreach ($categories as $key=>$item) {
                $categories[$key]->name = $item->name_fr;
            }
        }
        $categories = collect($categories)->sortBy('name')->toArray();

        $jobs = Business\Job::query()->limit(15)->where([
            'business_jobs.status' => 1
        ])
            ->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id')
            ->orderBy('updated_at', 'desc')
//            ->distinct()
            ->select([
                'business_jobs.id as id',
                'business_jobs.category_id',
                'business_jobs.title as title',
                'business_job_locations.id as job_id'
            ])
            ->get()->all();

        $locations = Business\Location::query()
            ->limit(15)
            ->groupBy('country')
            ->select([
                'business_locations.country as country',
                'business_locations.id as id',
                'business_locations.name as name',
                'business_locations.country_code as country_code',
            ])
            ->get()->all();

        $businessesAll = Business::query()
            ->orderBy('created_at', 'desc')
            ->limit(10)->get()->all();

        $clientItems = new GraphQLClient();

        $query = 'searchJobs';
        $assignParams = ' title assign_locations {id job_id business{picture_50(width:50,height:50)} name street street_number city region country created_date job_status}';

        $clientItems->setParams($query);
        $clientItems->addResponse([
            'items {' .
            'id html_career ' . $assignParams .
            '}',
            'pages',
            'count',
            'current_page '
        ]);
        $clientItems->addRequest([
            'limit' => $this->limit,
            'page' => $this->currentPage,
            //'locale' => app()->getLocale()
        ]);

        $items = $clientItems->request();

        $startOf = ($this->currentPage == 1) ? $this->currentPage : $this->currentPage * $this->limit;
        $endOf = ($this->currentPage != $items->pages) ? ($this->currentPage * $this->limit) + $this->limit : $items->count;

        return view('common.jobmap.cardinal', [
            'careers' => $careers,
            'categories' => $categories,
            'items' => $items,
            'types' => $types,
            'type_items' => $this->type,
            'start' => ($items->count > 0) ? $startOf : 0,
            'end' => ($items->count > 0) ? $endOf : 0,
            'sort' => $this->sort,
            //'order' => $this->order,
            'limit' => $this->limit,
            'keywords' => $keywords,
            'getData' => $getData,
            'sizes' => $sizes,
            'businessesAll' => $businessesAll,
            'industries' => $industries,
            'jobs' => $jobs,
            'locations' => $locations
        ]);
    }
}
