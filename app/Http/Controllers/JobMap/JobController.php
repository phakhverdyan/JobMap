<?php

namespace App\Http\Controllers\JobMap;

use App\Http\Controllers\Controller;
use App\Http\GraphQLClient;
use App\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

class JobController extends Controller
{
    protected $currentPage = 1;
    protected $limit = 25;
    protected $type = 'locations';
    protected $search;
    protected $sort;
    protected $order;
    protected $keywords;
    protected $filters;
    protected $distance;

    public function __construct()
    {
        $this->currentPage = (int)Input::get('page', 1);
        $this->sort = Input::get('sort', false);
        $this->order = Input::get('order', false);
        $this->limit = (int)Input::get('limit', 25);
        $this->keywords = Input::get('keywords', false);
        $this->filters = Input::get('filters', false);
        $this->distance = (int)Input::get('distance', 1);
    }

    public function index($letter = null)
    {
        $categories = JobCategory::query()
            ->orderBy('name', 'asc')
            ->where('parent_id', '=', null)
            ->get()->all();
        if (App::isLocale('fr')) {
            foreach ($categories as $key=>$item) {
                $categories[$key]->name = $item->name_fr;
            }
        }
        $categories = collect($categories)->sortBy('name')->toArray();

        $newData = array();
        $def = '';
        foreach ($categories as $category) {
            $l = strtoupper(substr($category['name'], 0, 1));
            if ($l != $def) {
                $newData[] = $l;
                $def = $l;
            }
        }

        if ($letter) {
            $subCategoriesByLetter = JobCategory::query()
                ->where('parent_id', '=', null)
                ->where('name', 'like', $letter . '%')
                ->get()->all();
            if (App::isLocale('fr')) {
                foreach ($subCategoriesByLetter as $key=>$item) {
                    $subCategoriesByLetter[$key]->name = $item->name_fr;
                }
            }
            $subCategoriesByLetter = collect($subCategoriesByLetter)->sortBy('name')->toArray();

            return view('common.jobmap.explore_jobs_in_letter', [
                'letters' => $newData,
                'current' => $letter,
                'subCategoriesByLetter' => $subCategoriesByLetter
            ]);
        } else {
            $categoriesAll = JobCategory::query()
                ->where('parent_id', '=', null)
                ->orderBy('created_at', 'desc')
                ->paginate(60);
            if (App::isLocale('fr')) {
                foreach ($categoriesAll as $key=>$item) {
                    $categoriesAll[$key]->name = $item->name_fr;
                }
            }
            //$categoriesAll = collect($categoriesAll)->sortBy('name')->toArray();

            return view('common.jobmap.explore_jobs', [
                'letters' => $newData,
                'all' => $categoriesAll
            ]);
        }
    }

    public function viewSubCategoriesByID($id)
    {
        $category = JobCategory::query()
            ->where('id', $id)->get()->first();
        if (App::isLocale('fr')) {
            foreach ($category as $key=>$item) {
                $category[$key]->name = $item->name_fr;
            }
        }

        $categories = JobCategory::query()
            ->orderBy('name', 'asc')
            ->where('parent_id', '=', $id)
            ->get()->all();
        if (App::isLocale('fr')) {
            foreach ($categories as $key=>$item) {
                $categories[$key]->name = $item->name_fr;
            }
        }
        $categories = collect($categories)->sortBy('name')->toArray();

        return view('common.jobmap.explore_jobs_in_career_x', [
            'categoryData' => $category,
            'categories' => $categories
        ]);
    }

    public function view($id, $typeItems = 'nearby-locations')
    {
        $request_params = [
            'id' => $id,
        ];

        if (\Request::input('locale') && in_array(\Request::input('locale'), config('graphql.available_locales'))) {
            \App::setLocale(\Request::input('locale'));
        }

        $request_params['locale'] = app()->getLocale();
        $client = new GraphQLClient();
        $client->setParams("mapJob");
        $client->addRequest($request_params);
        $client->addResponse([
            'id',

            'business {' .
                'id localized_name slug picture(origin: true) picture_200(width:200, height:200) picture_100(width:100, height: 100) picture_50(width:50, height: 50) localized_website ' .
            '}',

            'localized_title',
            'category_name',
            'localized_description',
            'localized_notes',
            'salary',
            'salary_type',
            'hours',
            'type_key',
            'time_1',
            'time_2',
            'time_3',
            'time_4',
            'status',

            'location {' .
                'id name street street_number city region country latitude longitude phone_code phone country_code' .
            '}',

            'assign_career_levels {' .
                'name' .
            '}',

            'assign_types {' .
                'name' .
            '}',

            'assign_languages {' .
                'name' .
            '}',

            'assign_certificates {' .
                'name' .
            '}',

            'assign_locations{name}',
            'created_date_iso',
        ]);

        $data = $client->request();

        //dd($data);

        if (!$data) {
            abort(404);
        }

        $business = $this->businessRequest((int) $data->business->id);

        $clientItems = new GraphQLClient();
        $assignParams = '';
        $param = '';

        switch ($typeItems) {
            case 'nearby-jobs':
                $clientItems->setParams("nearbyJobs");

                $request_params = [
                    'job_id' => $data->id,
                    'status' => 1,
                    'join' => 1
                ];

                if (\Request::input('locale') && in_array(\Request::input('locale'), config('graphql.available_locales'))) {
                    \App::setLocale(\Request::input('locale'));
                }

                $request_params['locale'] = app()->getLocale();
                $clientItems->addRequest($request_params);
                $param = 'jobs_open jobs_close';
                $assignParams = ' title assign_locations {id job_id business{picture_50(width:50,height:50)} name street street_number city region country created_date job_status} category_name ';
                break;
            case 'nearby-locations':
                $clientItems->setParams("nearbyLocations");

                $request_params = [
                    'location_id' => $data->location->id,
                ];

                if (\Request::input('locale') && in_array(\Request::input('locale'), config('graphql.available_locales'))) {
                    \App::setLocale(\Request::input('locale'));
                }

                $request_params['locale'] = app()->getLocale();
                $clientItems->addRequest($request_params);
                break;
        }
        $clientItems->addResponse([
            'items {' .
                'id html_career ' . $assignParams .
            '}',
            'pages',
            'count',
            'current_page ' . $param
        ]);

        $clientItems->addRequest([
            'latitude' => $data->location->latitude,
            'longitude' => $data->location->longitude,
            'nearby' => $this->distance,
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

        $items = $clientItems->request();

        $json_ld_structure = array(
            '@context' => 'http://schema.org/',
            '@type' => 'JobPosting',
            'title' => $data->localized_title,
            'description' => $data->localized_description,

            'identifier' => array(
                '@type' => 'PropertyValue',
                'name' => $data->business->localized_name,
                'value' => $data->id,
            ),

            'datePosted' => $data->created_date_iso,
            // 'validThrough' => '2017-03-18T00:00',
            'employmentType' => ($data->hours < 40 ? 'PART_TIME' : 'FULL_TIME'),

            'hiringOrganization' => array(
                '@type' => 'Organization',
                'name' => $data->business->localized_name,
                'sameAs' => $data->business->localized_website,
                'logo' => $data->business->picture,
            ),

            'jobLocation' => array(
                '@type' => 'Place',
                'address' => array(
                    '@type' => 'PostalAddress',
                    'streetAddress' => $data->location->street . ' ' . $data->location->street_number,
                    'addressLocality' => $data->location->city,
                    'addressRegion' => $data->location->region,
                    // 'postalCode' => '48201',
                    'addressCountry' => $data->location->country_code,
                ),
            ),
        );

        if ($data->salary) {
            $json_ld_structure['baseSalary'] = array(
                '@type' => 'MonetaryAmount',
                'currency' => 'USD',
                'value' => array(
                    '@type' => 'QuantitativeValue',
                    'value' => $data->salary,
                    'unitText' => 'YEAR',
                ),
            );
        }

        $fullAddress = $this->getFullAddress($data->location);
        $totalLocationsCount = $this->getAllLocationsCount($business->id);

        return view('common.jobmap.job.job', [
            'data' => $data,
            'type_items' => $typeItems,
            'main_link' => '/business/view/' . $business->id . '/' . $business->slug,
            'items' => $items,
            'current_page' => $this->currentPage,
            'keywords' => $this->keywords,
            'unique_locations' => collect($business->locations)->unique('country_code'),
            'sort' => $this->sort,
            'order' => $this->order,
            'distance' => $this->distance,
            'business' => $business,
            'locations_count' => $totalLocationsCount,
            'fullAddress' => $fullAddress,
            'limit' => $this->limit,
            'job_location' => $id,

            'og' => [
                'title' => $data->localized_title,
                'description' => $data->localized_description,
                'image' => $data->business->picture
            ],

            'json_ld_structure' => $json_ld_structure,
        ]);
    }

    public function viewUnion($id)
    {
        $request_params = [
            'id' => $id,
        ];

        if (\Request::input('locale') && in_array(\Request::input('locale'), config('graphql.available_locales'))) {
            \App::setLocale(\Request::input('locale'));
        }

        $request_params['locale'] = app()->getLocale();
        $client = new GraphQLClient();
        $client->setParams("businessJob");
        $client->addRequest($request_params);

        $client->addResponse([
            'id',
            'business {id name localized_name slug picture(width:200, height: 200) picture_50(width:50, height: 50) latitude longitude picture_100(width:100, height: 100) localized_website website}',
            'title',
            'localized_title',
            'category_name',
            'description',
            'localized_description',
            'notes',
            'localized_notes',
            'salary',
            'salary_type',
            'status',
            'assign_types {' .
            'name' .
            '}',
            'location {' .
            'id name street street_number city region country latitude longitude phone_code phone country_code' .
            '}',
            'assign_locations{id name picture_50(width:50, height: 50) street street_number city region country country_code phone_code phone created_date job_status job_id latitude longitude}'
        ]);
        $data = $client->request();

        $clientItems = new GraphQLClient();
        $clientItems->setParams("jobUnion");

        $clientItems->addResponse([
            'id',
            'title',
            'localized_title',
            'salary',
            'salary_type',
            'description',
            'localized_description',
            //'category_name',
            'street',
            'street_number',
            'city',
            'country',
            'country_code',
            'region',
            'suite',
            'date',
            'status',
            'latitude',
            'longitude',
            'status_in_location',
            'jobs_open',
            'jobs_close',
            'html',
            'assign_types{ id name}'
        ]);

        $request_params = [
            'id' => $id,
            'limit' => $this->limit,
            'page' => $this->currentPage
        ];

        if (\Request::input('locale') && in_array(\Request::input('locale'), config('graphql.available_locales'))) {
            \App::setLocale(\Request::input('locale'));
        }

        $request_params['locale'] = app()->getLocale();
        $clientItems->addRequest($request_params);

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
        $items = $clientItems->request();

        return view('common.jobmap.job.job_union', [
            'data' => $data,
            'items' => $items,
            'current_page' => $this->currentPage,
            'keywords' => $this->keywords,
            'sort' => $this->sort,
            'order' => $this->order,
            'distance' => $this->distance,
            'limit' => $this->limit,

            'og' => [
                'title' => $data->localized_title,
                'description' => $data->localized_description,
                'image' => $data->business->picture
            ],
        ]);
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

    private function getFullAddress($jobLocation)
    {
        $fullAddress = [];
        if ($street = $jobLocation->street) {
            if ($street_number = $jobLocation->street_number) {
                $street .= ' ' . $street_number;
            }
            $address[] = $street;
        }
        if ($city = $jobLocation->city) {
            $address[] = $city;
        }
        if ($region = $jobLocation->region) {
            $address[] = $region;
        }
        if ($country = $jobLocation->country) {
            $address[] = $country;
        }
        return implode($address, ', ');
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

