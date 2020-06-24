<?php

namespace App\Http\Controllers;

use App\Business\Job;
use App\Business\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Request;
use App\Business;
use App\Business\BusinessUnconfirmed;
use App\Http\GraphQLClient;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

class BusinessController extends Controller
{
    protected $currentPage = 1;
    protected $limit = 25;
    protected $type = 'jobs';
    protected $search;
    protected $sort;
    protected $order;
    protected $keywords;
    protected $filters;
    protected $showShare;

    const PAGE_TYPE_BRANDS = 'brands';
    const PAGE_TYPE_LOCATIONS = 'locations';
    const PAGE_TYPE_JOBS = 'jobs';

    public function __construct()
    {
        $this->currentPage = (int)Input::get('page', 1);
        $this->sort = Input::get('sort', false);
        $this->order = Input::get('order', false);
        $this->limit = (int)Input::get('limit', 25);
        $this->keywords = Input::get('keywords', false);
        $this->filters = Input::get('filters', false);
        $this->showShare = true;
    }

    public function viewCareerPage($id, $slug, $typeItems = 'description')
    {

        if (Request::input('locale') && in_array(\Request::input('locale'), config('graphql.available_locales'))) {
            app()->setLocale(\Request::input('locale'));
        }else{
            if (isset($_COOKIE['language']) && $_COOKIE['language']) {
                app()->setLocale($_COOKIE['language']);
            }
        }

        $client = new GraphQLClient();
        $client->setParams("business");
        $client->addRequest(['id' => (int)$id]);

        // show items share button
        if (in_array($typeItems, [self::PAGE_TYPE_BRANDS, self::PAGE_TYPE_LOCATIONS, self::PAGE_TYPE_JOBS])) {
            $this->showShare = false;
        }

        if (\Request::input('locale') && in_array(\Request::input('locale'), config('graphql.available_locales'))) {
            app()->setLocale(\Request::input('locale'));
            $client->addRequest(['locale' => \Request::input('locale')]);
        }else{
            if (isset($_COOKIE['language']) && $_COOKIE['language']) {
                app()->setLocale($_COOKIE['language']);
                $client->addRequest(['locale' => $_COOKIE['language']]);
            }
        }

        $client->addResponse([
            'id',
            'slug',
            'name',
            'localized_name',
            'description',
            'localized_description',
            //'industry',
            'industries {id, localized_name}',
            'locations {id job_id country_code type html_career localized_name name street street_number city region country created_date job_status}',
            'website',
            'localized_website',
            'street',
            'street_number',
            'latitude',
            'longitude',
            'city',
            'region',
            'country',
            'headquarters_count',
            'locations_count',
            'jobs_count',
            'all_jobs_count',
            'brands_count',
            'picture(width: 200, height: 200)',
            'picture_50(width: 50, height: 50)',
            'picture_o',
            'bg_picture',
            'images{id, business_id, number bg_picture, bg_picture_o(origin: true)}',
            '_industry',
            //'_sub_industry',
            '_size',
            'type',
            'direct_link',
            'country_code',
            'suite',
            'phone_country_code',
            'phone_code',
            'phone',
            'zip_code',
            // '_languages1',
            'facebook',
            'localized_facebook',
            'instagram',
            'localized_instagram',
            'linkedin',
            'localized_linkedin',
            'twitter',
            'localized_twitter',
            'youtube',
            'localized_youtube',
            'snapchat',
            'localized_snapchat',
            // 'video',
            // 'localized_video',
        ]);

        $data = $client->request();

        // if ($data->video && $pos = strpos($data->video, 'tube.com/watch?v=')) {
        //     $data->video = 'https://www.youtube.com/embed/' . substr($data->video, $pos + 17);
        // }

        $clientItems = new GraphQLClient();
        $assignParams = '';
        $param = '';

        if (\Request::input('locale') && in_array(\Request::input('locale'), config('graphql.available_locales'))) {
            app()->setLocale(\Request::input('locale'));
            $clientItems->addRequest(['locale' => \Request::input('locale')]);
        }else{
            if (isset($_COOKIE['language']) && $_COOKIE['language']) {
                app()->setLocale($_COOKIE['language']);
                $clientItems->addRequest(['locale' => $_COOKIE['language']]);
            }
        }

        $requestParams = request()->only(['keywords', 'status', 'type', 'sort']);
        $requestParams['join'] = 1;

        switch ($typeItems) {
            case 'jobs':
            case 'description':
                $clientItems->setParams("businessJobs");
                $clientItems->addRequest($requestParams);

                $param = 'jobs_open jobs_close';
                $assignParams = ' title localized_title assign_locations{id job_id business{picture_50(width:50,height:50)} name localized_name street street_number city region country created_date job_status} category_name job_location_id';
                break;
            case 'headquarters':
            case 'locations':
                $clientItems->setParams("businessLocations");
                /*$clientItems->addRequest([
                    'type' => ($typeItems == 'headquarters') ? 'headquarter' : 'location'
                ]);*/

                $clientItems->addRequest(request()->only(['keywords']));

                $assignParams = ' type name localized_name latitude longitude picture_50(width: 50, height: 50) ';
                break;
            case 'brands':
                $clientItems->setParams("businessBrands");
                $assignParams = ' parent_id type name localized_name latitude longitude picture_50(width: 50, height: 50) ';
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
            'business_id' => (int)$id,
            'limit' => $this->limit,
            'page' => $this->currentPage,
        ]);

        if ($this->keywords){
            $clientItems->addRequest(['keywords' => $this->keywords]);
        }

        if ($this->sort){
            $clientItems->addRequest(['sort' => $this->sort]);
        }

        if ($this->order){
            $clientItems->addRequest(['order' => $this->order]);
        }

        if ($this->filters){
            $clientItems->addRequest(['filters' => $this->filters]);
        }

        $items = null;
        try{
            $items = $clientItems->request();
        }catch (\Exception $e){
            Log::info($e);
        }


        $MapItems = array();
        if($typeItems == "locations" || $typeItems == "brands"){
            $MapItems = $this->getBusinessLocationsForMap($id);
        }


        // Locations counters
        $headquarters = $this->getHeadquarters($id);
        $locations = collect($data->locations);
        $totalLocationsCount = $this->getAllLocationsCount($id);

        // brands count
        $totalBrandsCount = $this->getAllBrandsCount($id);
        
        return view('common.job.career', [
            'data' => $data,
            'unique_locations' => collect($locations)->unique('country_code'),
            'locations_count' => $totalLocationsCount,//$this->getBusinessLocationsCount($id),//
            'brand_count' => $totalBrandsCount,
            'jobs_count' => $this->getBusinessJobsCount($id),
            'type_items' => $typeItems,
            'main_link' => '/business/view/' . $data->id . '/' . $data->slug,
            'items' => $items,
            'map_items' => $MapItems,
            'headquarters' => $headquarters,
            //'itemsLocation' => $itemsLocation,
            'current_page' => $this->currentPage,
            'show_share' => $this->showShare,
            'business_slug' => $data->slug,
            'keywords' => $this->keywords,
            'sort' => $this->sort,
            'order' => $this->order,
            'limit' => $this->limit
        ]);
    }

    public function inviteBusiness($id)
    {
        $client = new GraphQLClient();
        $client->setParams("business");
        $client->addRequest(['id' => (int)$id]);
        $client->addResponse([
            'id',
            'slug',
            'name',
            'picture(width: 200, height: 200)',
            'picture_50(width: 50, height: 50)',
            'bg_picture',
        ]);
        $data = $client->request();

        return view('common.invite_business',[
            'data' => $data ]);
    }

    public function viewUnconfirmedBusiness($id, $slug) {
        $client = new GraphQLClient();
        $client->setParams("businessUnconfirmed");
        $client->addRequest(['id' => (int)$id]);

        $client->addResponse([
            'id',
            'slug',
            'name',
            'website',
            'email',
            'picture',
            'picture_50',
            'keyword{id, name}',
            'city',
            'region',
            'country',
            'country_code',
            'street',
            'street_number',
            'suite',
            'latitude',
            'longitude',
            'facebook',
            'instagram',
            'linkedin',
            'twitter',
            'locations{id, name, street, street_number, latitude, longitude, suite, city, region, country, country_code, phone_code, phone_country_code, phone}',
            'items{',
            'items{id, name, html_career_ubis latitude longitude}',
            'pages, count, current_page',
            '}',
            'locations_count',
            'phones{id, value}',
            'phones_count',
            'phone_first'
        ]);

        $data = $client->request();
        //dd($data);

        return view('common.business_unconfirmed', [
            'data' => $data,
            'type_items' => 'locations',
            'main_link' => '/unconfirmed-business/view/' . $data->id . '/' . $data->slug,
            'items' => $data->locations,
            'current_page' => $this->currentPage,
            'keywords' => $this->keywords,
            'sort' => $this->sort,
            'order' => $this->order,
            'limit' => $this->limit
        ]);
    }

    public function getIndeedFeed($business_id) {
        if (!$business = \App\Business::where('id', $business_id)->first()) {
            abort(404);
        }

        $job_location_query = \App\Business\JobLocation::query();
        $job_location_query->with('job', 'location');
        $job_location_query->join('business_jobs', 'business_jobs.id', '=', 'business_job_locations.job_id');
        $job_location_query->select('business_job_locations.*');
        $job_location_query->where('business_jobs.business_id', $business->id);
        $job_location_query->where('business_job_locations.status', 1);
        $job_locations = $job_location_query->get();

        $xml_string = '<?xml version="1.0" encoding="utf-8"?>' . "\n";
        $xml_string .= '<source>' . "\n";
        $xml_string .= "\t" . '<publisher>CloudResume</publisher>' . "\n";
        $xml_string .= "\t" . '<publisherurl>http://jobmap.co</publisherurl>' . "\n";
        $xml_string .= "\t" . '<lastBuildDate>' . (new \DateTime)->format(\DateTime::RFC2822) . '</lastBuildDate>' . "\n";

        foreach ($job_locations as $job_location) {
            $job = $job_location->job;
            $location = $job_location->location;

            $xml_string .= "\t" . '<job>' . "\n";
            $xml_string .= "\t\t" . '<title><![CDATA[' . $job->title . ']]></title>' . "\n";
            $xml_string .= "\t\t" . '<date><![CDATA[' . $job->created_at->format(\DateTime::RFC2822) . ']]></date>' . "\n";
            $xml_string .= "\t\t" . '<referencenumber><![CDATA[' . $job->id . ']]></referencenumber>' . "\n";
            $xml_string .= "\t\t" . '<url><![CDATA[JOB FULL URL + source from indeed]]></url>' . "\n";
            $xml_string .= "\t\t" . '<company><![CDATA[' . $business->name . ']]></company>' . "\n";
            $xml_string .= "\t\t" . '<sourcename><![CDATA[CloudResume]]></sourcename>' . "\n";
            $xml_string .= "\t\t" . '<city><![CDATA[' . $location->city . ']]></city>' . "\n";
            $xml_string .= "\t\t" . '<state><![CDATA[' . $location->region . ']]></state>' . "\n";
            $xml_string .= "\t\t" . '<country><![CDATA[' . $location->coutry_code . ']]></country>' . "\n";
            // $xml_string .= "\t\t" . '<postalcode><![CDATA[' . $location->zip_code . ']]></postalcode>' . "\n";
            $xml_string .= "\t\t" . '<email><![CDATA[BUSINESS INDEED EMAIL]]></email>' . "\n";
            $xml_string .= "\t\t" . '<description><![CDATA[' . $job->description . ']]></description>' . "\n";
            // $xml_string .= "\t\t" . '<salary><![CDATA[JOB SALARY OPTIONAL]]></salary>' . "\n";
            // $xml_string .= "\t\t" . '<education><![CDATA[JOB DESIRED EDUCATION]]></education>' . "\n";

            // if ($job->hours == 0) {
            //     $xml_string .= "\t\t" . '<jobtype><![CDATA[fulltime, parttime]]></jobtype>' . "\n";
            // }
            // elseif ($job->hours < 40) {
            //     $xml_string .= "\t\t" . '<jobtype><![CDATA[parttime]]></jobtype>' . "\n";
            // }
            // else {
            //     $xml_string .= "\t\t" . '<jobtype><![CDATA[fulltime]]></jobtype>' . "\n";
            // }

            // $xml_string .= "\t\t" . '<category><![CDATA[' . ($job->category ? $job->category->name : '') . ']]></category>' . "\n";
            // $xml_string .= "\t\t" . '<experience><![CDATA[JOB DESIRED EXPERIENCE]]></experience>' . "\n";
            // $xml_string .= "\t\t" . '<tracking_url><![CDATA[]]></tracking_url>' . "\n";
            $xml_string .= "\t\t" . '<metadata><![CDATA[]]></metadata>' . "\n";
            $xml_string .= "\t\t" . '<indeed-apply-data><![CDATA[';
            // $xml_string .= 'indeed-apply-joburl=http%3A%2F%2FJill-Gaba.SFAgentJobs.com%2Fj%2F0b0yx';
            // $xml_string .= '&';
            // $xml_string .= 'indeed-apply-jobid=' . $business_job->id; // NEEDED
            // $xml_string .= '&';
            $xml_string .= 'indeed-apply-jobtitle=' . urlencode($job->title); // REQUIRED
            // $xml_string .= '&';
            // $xml_string .= 'indeed-apply-jobcompanyname=Jill%20Gaba%20%20-%20State%20Farm%20Agent';
            // $xml_string .= '&';
            // $xml_string .= 'indeed-apply-joblocation=Macedonia%2C%20OH%2044056';
            $xml_string .= '&';
            $xml_string .= 'indeed-apply-apitoken=1234ABCD'; // REQUIRED
            $xml_string .= '&';
            $xml_string .= 'indeed-apply-posturl=' . urlencode('https://jobmap.co/indeed/apply_process/callback'); // NEEDED
            // $xml_string .= '&';
            // $xml_string .= 'indeed-apply-phone=required';
            // $xml_string .= '&';
            // $xml_string .= 'indeed-apply-questions=http%3A%2F%2Fapp.careerplug.com%2Fjobs%2F1928%2Fquestions.json';
            $xml_string .= ']]></indeed-apply-data>' . "\n";
            $xml_string .= "\t" . '</job>' . "\n";
        }

        $xml_string .= '</source>';

        return response($xml_string, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }

    private function getBusinessLocationsCount($business_id){
        $query = Location::where("business_id", $business_id);
        return $query->count();
    }

    private function getBusinessJobsCount($business_id){
        $query = Job::where("business_locations.business_id", $business_id);
        $query->join("business_job_locations", "business_job_locations.job_id", "=", "business_jobs.id");
        $query->join("business_locations", "business_locations.id", "=", "business_job_locations.location_id");
        return $query->count();
    }

    /**
     * Get all business headquarters
     */
    private function getHeadquarters($businessID)
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
                'id html_career type name localized_name latitude longitude picture_50(width: 50, height: 50) ' .
            '}',
            'pages',
            'count',
            'current_page '
        ]);
        $headquarters->addRequest([
            'business_id' => (int)$businessID,
            'limit' => 5,//$this->limit,
            'type' => 'headquarter',
            'page' => $this->currentPage,
        ]);
        return $headquarters->request();
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
            'page' => 0//$this->currentPage,
        ]);
        return count($headquarters->request()->items);
    }

    /**
     * Get all business brands count
     */
    private function getAllBrandsCount(int $businessID)
    {
        // get all headquoters
        $brands = new GraphQLClient();
        if (\Request::input('locale') && in_array(\Request::input('locale'), config('graphql.available_locales'))) {
            \App::setLocale(\Request::input('locale'));
            $brands->addRequest(['locale' => \Request::input('locale')]);
        }
        $brands->setParams("businessBrands");
        $brands->addResponse([
            'items {' .
                'id' .
            '}',
            'count',
        ]);
        $brands->addRequest([
            'business_id' => (int) $businessID,
            'limit' => 9999999,
        ]);
        return $brands->request()->count;
    }

    private function getBusinessLocationsForMap($business_id){
        $query = Location::query();//->with(['business']);
        $businessIds = Business::where('id', $business_id)->orWhere('parent_id', $business_id)->get()->pluck('id')->toArray();
        $query->whereIn('business_id', $businessIds);
        $query->select([
//            'businesses.id as businesses_id',
//            'businesses.picture as businesses_picture',
            'business_locations.id as id',
            'business_locations.name as name',
            'business_locations.latitude as latitude',
            'business_locations.longitude as longitude',
            'business_locations.picture as picture',
            DB::raw('(select id from businesses where businesses.id = business_locations.business_id ) as business_id'),
            DB::raw('(select picture from businesses where businesses.id = business_locations.business_id ) as business_picture'),
        ]);//name localized_name latitude longitude picture_50(width: 50, height: 50)

        $items = array();
        $query = $query->get()->all();

        foreach ($query as $item){
            $item['picture_50'] = $this->getPicture($item, $item->picture);
            $items[] = $item;
        }

        return $items;
    }

    private function getPicture($business, $picture = null){
        $width = 50;
        $height = 50;
        $prefix = $width . '.' . $height . '.';
        if ($picture) {
            return Storage::disk('business')->url('' . $business['business_id'] . '/' . $prefix) . $picture . '?v=' . rand(11111, 99999);
        } elseif ($business['business_picture'] && $width == 50) {
            return Storage::disk('business')->url('' . $business['business_id'] . '/' . $prefix) . $business['business_picture'] . '?v=' . rand(11111, 99999);
        } else {
            return asset('img/business-logo-small.png');
        }
    }
}
