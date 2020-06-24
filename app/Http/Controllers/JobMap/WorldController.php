<?php

namespace App\Http\Controllers\JobMap;

use App\Http\Controllers\Controller;
use App\Business\Location;
use App\Http\GraphQLClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class WorldController extends Controller
{
    protected $currentPage = 1;
    protected $limit = 25;
    protected $search;
    protected $sort;
    protected $order;
    protected $keywords;
    protected $filters;
    protected $typeItems;
    
    public function __construct()
    {
        $this->currentPage = (int)Input::get('page', 1);
        $this->sort = Input::get('sort', false);
        $this->order = Input::get('order', false);
        $this->limit = (int)Input::get('limit', 25);
        $this->keywords = Input::get('keywords', false);
        $this->filters = Input::get('filters', false);
        $this->typeItems = Input::get('type', 'employers');
    }
    
    public function index()
    {
        $client = new GraphQLClient();
        $client->setParams('locationInfo');
        $client->addResponse([
            'count_jobs',
            'count_employers',
            'count_locations',
            'count_headquarters',
            'count_keywords'
        ]);
    
        $clientItems = new GraphQLClient();

        switch ($this->typeItems) {
            case 'jobs':
                $query = 'mapJobs';
                $assignParams = ' title category_name business{picture_50(width:50,height:50)} assign_locations {id job_id business{picture_50(width:50,height:50)} name street street_number city region country created_date job_status}';
                $link = '/map/view/job/';
                $clientItems->addRequest([
                    'status' => "1"
                ]);
                break;
            case 'keywords':
                $query = 'mapKeywords';
                $assignParams = ' name';
                $link = '/search/jobs';
                break;
            case 'headquarters':
                $query = 'businessLocations';
                $clientItems->addRequest([
                    'type' => 'headquarter'
                ]);
                $assignParams = ' name business{picture_50(width:50,height:50)}';
                $link = '/map/view/location/';
                break;
            case 'locations':
                $query = 'businessLocations';
                $clientItems->addRequest([
                    'type' => 'location'
                ]);
                $assignParams = ' name business{picture_50(width:50,height:50)}';
                $link = '/map/view/location/';
                break;
            default:
                $query = 'mapBusinesses';
                $assignParams = ' name picture_50(width:50,height:50)';
                $link = '/business/view/';
                break;
        }
        $clientItems->setParams($query);

        $clientItems->addResponse([
            'items {' .
            'id ' . $assignParams .
            '}',
            'pages',
            'count',
            'current_page '
        ]);
        $clientItems->addRequest([
            'limit' => $this->limit,
            'page' => $this->currentPage
        ]);
        if ($this->keywords) {
            $clientItems->addRequest(['keywords' => $this->keywords]);
        }
        if ($this->sort) {
            $clientItems->addRequest(['sort' => $this->sort]);
        }
        if ($this->order) {
            $clientItems->addRequest(['order' => $this->order]);
        }
        if ($this->filters) {
            $clientItems->addRequest(['filters' => $this->filters]);
        }
        
        $locations = Location::query()
            ->groupBy('country')
            ->select([
                'business_locations.country as country',
                'business_locations.id as id',
                'business_locations.name as name',
                'business_locations.country_code as country_code',
            ])
            ->get()->all();
        
        $items = $clientItems->request();
        $startOf = ($this->currentPage == 1) ? $this->currentPage : $this->currentPage * $this->limit;
        $endOf = ($this->currentPage != $items->pages) ? ($this->currentPage * $this->limit) + $this->limit : $items->count;
        
        return view('common.jobmap.job_map_world', [
            'locations' => $locations,
            'data' => $client->request(),
            'items' => $items,
            'type_items' => $this->typeItems,
            'current_page' => $this->currentPage,
            'keywords' => $this->keywords,
            'sort' => $this->sort,
            'order' => $this->order,
            'limit' => $this->limit,
            'link' => $link,
            'start' => ($items->count > 0) ? $startOf : 0,
            'end' => ($items->count > 0) ? $endOf : 0,
        ]);
    }
}
