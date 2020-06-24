<?php

namespace App\Http\Controllers\JobMap;

use App\Business\Job;
use App\Business\Location;
use App\Http\Controllers\Controller;
use App\Http\GraphQLClient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
    protected $currentPage = 1;
    protected $limit = 25;
    protected $search;
    protected $sort;
    protected $order;
    protected $keywords;
    protected $filters;
    protected $typeItems;
    protected $status;
    protected $type;

    public function __construct()
    {
        $this->currentPage = (int)Input::get('page', 1);
        $this->sort = Input::get('sort', false);
        $this->order = Input::get('order', false);
        $this->limit = (int)Input::get('limit', 25);
        $this->keywords = Input::get('keywords', false);
        $this->status = Input::get('status', false);
        $this->type = Input::get('type', false);
        $this->filters = Input::get('filters', false);
        $this->typeItems = Input::get('type', 'employers');
    }

    public function view($id, $slug)
    {
        $client = new GraphQLClient();
        $client->setParams("location");
        $client->addRequest([
            'id' => $id
        ]);

        if (\Request::input('locale') && in_array(\Request::input('locale'), config('graphql.available_locales'))) {
            \App::setLocale(\Request::input('locale'));
            $client->addRequest(['locale' => \Request::input('locale')]);
        }

        $client->addResponse([
            'id',
            'business {id name localized_name slug description localized_description picture_o(origin: true) picture picture_100(width:100, height: 100) picture_50(width:50, height: 50) website localized_website jm_jobs_count all_jobs_count brands_count locations_count count_locations}',
            'name localized_name',
            'picture_50(width: 50, height: 50) ',
            'latitude',
            'longitude',
            'phone',
            'phone_code',
            'assign_amenities {id name key}',
            'jobs_count_open',
            'jobs_count',
            'street',
            'street_number',
            'region',
            'city',
            'country',
            'country_code'
        ]);
        $data = $client->request();

        $business = $this->businessRequest((int)$data->business->id);

        $clientItems = new GraphQLClient();
        $clientItems->setParams("mapJobs");
        $param = '';
        $assignParams = ' title localized_title category_name status status_in_location ';
        $clientItems->addResponse([
            'items {' .
                'id html_career ' . $assignParams .
            '}',
            'pages',
            'count',
            'jobs_open',
            'jobs_close',
            'current_page ' . $param
        ]);
        $clientItems->addRequest([
            'business_id' => (int)$data->business->id,
            'location_id' => (int)$id,
            'limit' => $this->limit,
            'page' => $this->currentPage
        ]);

        if (\Request::input('locale') && in_array(\Request::input('locale'), config('graphql.available_locales'))) {
            \App::setLocale(\Request::input('locale'));
            $clientItems->addRequest(['locale' => \Request::input('locale')]);
        }

        if ($this->keywords) {
            $clientItems->addRequest(['keywords' => $this->keywords]);
        }
        if ($this->sort) {
            $clientItems->addRequest(['sort' => $this->sort]);
        }
        if ($this->type) {
            $clientItems->addRequest(['type' => $this->type]);
        }
        if ($this->status) {
            $clientItems->addRequest(['status' => $this->status]);
        }
        if ($this->order) {
            $clientItems->addRequest(['order' => $this->order]);
        }
        if ($this->filters) {
            $clientItems->addRequest(['filters' => $this->filters]);
        }
        $items = $clientItems->request();

        $location_string = $data->city;

        if ($data->region != "") {
            $location_string .= ", " . $data->region;
        }

        if ($data->country != "") {
            $location_string .= ", " . $data->country;
        }

        $totalLocationsCount = $this->getAllLocationsCount($business->id);

        return view('common.jobmap.job.jobs_locations', [
            'data' => $data,
            'main_link' => '/business/view/' . $business->id . '/' . $business->slug,
            'items' => $items,
            'unique_locations' => collect($business->locations)->unique('country_code'),
            'locations_count' => $totalLocationsCount,
            'current_page' => $this->currentPage,
            'keywords' => $this->keywords,
            'sort' => $this->sort,
            'business' => $business,
            'order' => $this->order,
            'limit' => $this->limit,
            'location_string' => $location_string,

            'og' => [
                'title' => $data->business->localized_name,
                'description' => $data->business->localized_description,
                'image' => $data->business->picture_o
            ],
        ]);
    }

    public function viewUnconfirmed($id, $slug)
    {
        $client = new GraphQLClient();
        $client->setParams("locationUnconfirmed");
        $client->addRequest([
            'id' => $id
        ]);
        $client->addResponse([
            'id',
            'business {id name slug description picture_o(origin: true) picture picture_100(width:100, height: 100) picture_50(width:50, height: 50) website}',
            'name',
            'latitude',
            'longitude',
            'phone',
            'phone_code',
            /*'assign_amenities {id name key}',
            'jobs_count_open',
            'jobs_count',*/
            'street',
            'street_number',
            'region',
            'city',
            'country',
            'country_code'
        ]);
        $data = $client->request();

        return view('common.jobmap.job.jobs_unconfirmed_locations', [
            'data' => $data,
            'main_link' => '/map/view/unconfirmed-location/' . $data->id . '/' . str_slug($data->name),
            //'items' => $items,
            'current_page' => $this->currentPage,
            'keywords' => $this->keywords,
            'sort' => $this->sort,
            'order' => $this->order,
            'limit' => $this->limit,
            'og' => [
                'title' => $data->business->name,
                'description' => $data->business->description,
                'image' => $data->business->picture_o
            ]
        ]);
    }

    /**
     * @param Request $request
     * @param $param
     * @param bool $param2
     * @param bool $param3
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewByLocationPart(Request $request, $param, $param2 = false, $param3 = false)
    {
        $client = new GraphQLClient();
        $client->setParams('locationInfo');
        $client->addResponse([
            'count_jobs',
            'count_employers',
            'count_locations',
            'count_headquarters'
        ]);

        $clientItems = new GraphQLClient();
        $findBy = $request->segment(2);
        switch ($findBy) {
            case 'region':
                $layout = 'common.jobmap.job_map_region';
                $data = [
                    'region' => $param,
                    'country' => $param2,
                    'main_link' => '/map/region/' . $param . '/' . $param2,
                    'type' => 'region'
                ];
                $r = [
                    'findBy' => 'region',
                    'region' => $param,
                    'country' => $param2,
                ];
                break;
            case 'city':
                $layout = 'common.jobmap.job_map_city';
                $data = [
                    'city' => $param,
                    'country' => $param2,
                    'main_link' => '/map/city/' . $param . '/' . $param2,
                    'type' => 'city'
                ];
                $r = [
                    'findBy' => 'city',
                    'city' => $param,
                    'country' => $param2,
                ];
                break;
            case 'street':
                $layout = 'common.jobmap.job_map_street';
                $data = [
                    'street' => $param,
                    'city' => $param2,
                    'country' => $param3,
                    'main_link' => '/map/street/' . $param . '/' . $param2 . '/' . $param3,
                    'type' => 'street'
                ];
                $r = [
                    'findBy' => 'street',
                    'street' => $param,
                    'city' => $param2,
                    'country' => $param3,
                ];
                break;
            case 'address':
                $layout = 'common.jobmap.job_map_address';
                $streetData = explode("+", $param);
                $number = $streetData[0];
                $street = ($streetData[1]) ?? '';
                $data = [
                    'number' => $number,
                    'street' => $street,
                    'city' => $param2,
                    'country' => $param3,
                    'main_link' => '/map/address/' . $param . '/' . $param2 . '/' . $param3,
                    'type' => 'address'
                ];
                $r = [
                    'findBy' => 'address',
                    'street_number' => $number,
                    'street' => $street,
                    'city' => $param2,
                    'country' => $param3,
                ];
                break;
            default:
                $layout = 'common.jobmap.job_map';
                $data = [
                    'country' => $param,
                    'main_link' => '/map/country/' . $param,
                    'type' => 'country'
                ];
                $r = [
                    'findBy' => 'country',
                    'country' => $param,
                ];
                break;
        }

        $client->addRequest($r);
        $clientItems->addRequest($r);

        $assignParams = '';

        switch ($this->typeItems) {
            case 'jobs':
                $query = 'mapJobs';
                $assignParams = ' title assign_locations {id job_id business{picture_50(width:50,height:50)} latitude longitude name street street_number city region country created_date job_status}';
                break;
            case 'headquarters':
                $query = 'businessLocations';
                $clientItems->addRequest([
                    'type' => 'headquarter'
                ]);
                $assignParams = ' job_id business{picture_50(width:50,height:50)} latitude longitude name street street_number city region country created_date job_status';
                break;
            case 'locations':
                $query = 'businessLocations';
                $clientItems->addRequest([
                    'type' => 'location'
                ]);
                $assignParams = ' job_id business{picture_50(width:50,height:50)} latitude longitude name street street_number city region country created_date job_status';
                break;
            default:
                $query = 'mapBusinesses';
                $assignParams = ' assign_locations {id job_id business{picture_50(width:50,height:50)} latitude longitude name street street_number city region country created_date job_status}';
                break;
        }
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

        $items = null;
        if($this->typeItems != "jobs"){
            try{
                $items = $clientItems->request();
            }catch (\Exception $e){
                Log::info($e);
            }
        }
        if($this->typeItems == "jobs"){
            $items = (object)$this->getJobs([
                'limit' => $this->limit,
                'page' => $this->currentPage,
                'country' => $param,
                'sort' => $this->sort,
            ]);
        }


        $data = array_merge($data, [
            'data' => $client->request(),
            'items' => $items,
            'type_items' => $this->typeItems,
            'current_page' => $this->currentPage,
            'keywords' => $this->keywords,
            'sort' => $this->sort,
            'order' => $this->order,
            'limit' => $this->limit,
            'r' => json_encode($r)
        ]);
        return view($layout, $data);
    }

    private function getJobs($args = array()){

        $limit = min($args['limit'] ?? 25, 100);
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;

        $query = Job::query();

        $query = $query->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');
        $query = $query->join('business_locations', 'business_locations.id', '=', 'business_job_locations.location_id');

        if (isset($args['country'])) {
            $query = $query->where('business_locations.country', $args['country']);
        }

        $assignParams = ' title assign_locations {id job_id business{picture_50(width:50,height:50)} latitude longitude name street street_number city region country created_date job_status}';
        $dataS = [
            'business_jobs.id as id',
            'business_jobs.*',
            'business_locations.id as location_id',
            'business_locations.name as location_name',
            'business_locations.street as location_street',
            'business_locations.street_number as location_street_number',
            'business_locations.city as location_city',
            'business_locations.region as location_region',
            'business_locations.country as location_country',
            'business_locations.country_code as location_country_code',
            'business_locations.latitude as latitude',
            'business_locations.longitude as longitude',

            'business_job_locations.id AS job_location_id',
            DB::raw('(select count(*) from business_job_locations where business_jobs.id = business_job_locations.job_id AND business_job_locations.status = 1) as locations_count_open')
        ];

        $query = $query->select($dataS);
        $count = $query->distinct()->count('business_jobs.id');

        Log::info(isset($args['sort']) );
        if (isset($args['sort']) && !empty($args['sort'])) {

            switch ($args['sort']) {
                case 'newest':
                    $query->orderBy('business_jobs.updated_at', 'desc');
                    break;

                case 'oldest':
                    $query->orderBy('business_jobs.updated_at', 'asc');
                    break;
            }

        } else {
            $query = $query->orderBy('business_jobs.updated_at', 'desc');
        }

        $query = $query->skip($skip)->take($limit);
        $data = $query->get();

        $data = $data->transform(function($job) use ($args) {

            $business = $job['business'];
            if ($business['id']) {

                $picture = Storage::disk('business')->url('/' . $business['id'] . '/50.50.') . $business['picture'] . '?v=' . rand(11111, 99999);
                $big_picture = Storage::disk('business')->url('/' . $business['id'] . '/') . $business['picture'] . '?v=' . rand(11111, 99999);
            } else {
                $picture = asset('img/profilepic2.png');
                $big_picture = $picture;
            }
            $your_date = $job['updated_at']->timestamp;
            $datediff = time() - $your_date;
            $days = round($datediff / (60 * 60 * 24));

            Carbon::setLocale( App::getLocale());
            $dt = Carbon::now();
            $d = ($days == 0) ? trans('fields.today') : $dt->subDays($days)->diffForHumans();



            //$location = $locations[0]['location']['city'];
            //$location = $args['location_street'] . ' ' .$args['location_street_number'] . ', ' . $args['location_city'] . ', ' . $args['location_region'] . ', ' . $args['location_country'];
            $data = $job->toArray();
            $data['job_id'] = $job['job_location_id'];
            $assign_locations['business']['picture_50'] = $picture;
            $assign_locations['id'] = $job['location_id'];
            $assign_locations['name'] = $job['location_name'];
            $assign_locations['latitude'] = $job['latitude'];
            $assign_locations['longitude'] = $job['longitude'];
            $data['assign_locations'][] = $assign_locations;

            $data['html_career'] = View('common.job.graphql.job_item', [
                'args' => $job,
                'picture' => $picture,
                'big_picture' => $big_picture,
                'location' => null,
                'd' => $d
            ])->render();

            return (object)$data;
        });

        return array(
            'items' => $data,
            'pages' => ceil($count / $limit),
            'count' => $count,
            'current_page' => $page,
        );
    }

    private function businessRequest(int $businessID)
    {
        $client = new GraphQLClient();
        $client->setParams("business");
        $client->addRequest(['id' => $businessID]);

        if (\Request::input('locale') && in_array(\Request::input('locale'), config('graphql.available_locales'))) {
            \App::setLocale(\Request::input('locale'));
            $client->addRequest(['locale' => \Request::input('locale')]);
        }

        $client->addResponse([
            'id',
            'slug',
            'name',
            'headquarters_count',
            'locations_count',
            'jobs_count',
            'all_jobs_count',
            'brands_count',
            '_industry',
            'locations {country_code}',
        ]);

        return $client->request();
    }

    /**
     * Get all business locations
     */
    private function getAllLocationsCount($businessID)
    {
        // get all headquoters
        $headquarters = new GraphQLClient();
        if (\Request::input('locale') && in_array(\Request::input('locale'), config('graphql.available_locales'))) {
            \App::setLocale(\Request::input('locale'));
            $headquarters->addRequest(['locale' => \Request::input('locale')]);
        }
        $headquarters->setParams("businessLocations");
        $headquarters->addResponse([
            'items {' .
                'id' .
            '}',
        ]);
        $headquarters->addRequest([
            'business_id' => (int) $businessID,
            'limit' => 9999999,
            // 'type' => 'headquarter',
            'page' => $this->currentPage,
        ]);
        return count($headquarters->request()->items);
    }
}

