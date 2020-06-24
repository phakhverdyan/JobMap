<?php

namespace App\Http\Controllers\Api;

use App\Business;
use App\Business\Administrator;
use App\Business\Department;
use App\Business\JobCertificate;
use App\Business\JobDepartment;
use App\Business\JobLanguage;
use App\Business\JobLocation;
use App\Business\Location;
use App\Certificate;
use App\Business\Job;
use App\JobQueue;
use App\Jobs\JobAutoExpiredContinued;
use App\WorldLanguage;
use Carbon\Carbon;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\BaseResource;
use Auth;

class JobController extends Controller
{

    private $roles = [
        Administrator::MANAGER_ROLE,
        Administrator::FRANCHISE_ROLE
    ];

    private $businessID;

    private $permissions;

    public function get(Request $request, $id){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $this->businessID = (int)$request->input('business_id', 0);

        if(!$this->check()){
            return response(['error' => 'Job permission error'], 500);
        }

        $job = Job::where('id', $id)->firstOrFail();
        if(!empty($job)){
            $data = array();

            $data['job'] = $job->toArray();
            $data['locations'] = $job->locationsAll()->get();
            $world_languages_id = $job->languages()->get()->pluck("world_language_id")->toArray();
            $data['languages'] = WorldLanguage::whereIn("id", $world_languages_id)->get();

            return response(['data' => $data], 200);
        }

        return response([ 'error' => 'Job error'], 500);
    }

    public function create(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $user_auth = Auth::User();
        $this->businessID = (int)$request->input('business_id', 0);
        $locations_id = $request->input('locations_id') ?: '';
        if(!empty($locations_id))
        {
            $locations_id = explode(",", $locations_id);
            $this->businessIDs = Location::whereIn('id', $locations_id)->groupBy('business_id')->pluck('business_id')->toArray();
        }
        if(!$this->check()){
            return response(['error' => 'Job permission error'], 500);
        }
foreach ($this->businessIDs as $business_id) {
    # code...

        $job = new Job;
        $job->business_id = $business_id;
        $job->user_id = $user_auth->id;
        $job->title = $request->input('title_en') ?: '';
        $job->title_fr = $request->input('title_fr') ?: '';
        $job->description = $request->input('description_en') ?: '';
        $job->description_fr = $request->input('description_fr') ?: '';
        $job->salary = $request->input('salary') ?: 0;
        $job->salary_type = $request->input('salary_type') ?: '';
        $job->type_key = $request->input('type_key') ?: '';
        $job->certificate_name = $request->input('certificate_name') ?: '';
        $job->hours = $request->input('hours') ?: 0;
        $job->time_1 = $request->input('time_1') ?: '';
        $job->time_2 = $request->input('time_2') ?: '';
        $job->time_3 = $request->input('time_3') ?: '';
        $job->time_4 = $request->input('time_4') ?: '';
        //$job->status = 0;
        $job->save();

        if($job === null){
            return response(['error' => 'Job create error'], 500);
        }

        $dt = Carbon::create(date('Y'), date('m'), date('j'), date('H'), date('i'), date('s'));
        $jobQueue = (new JobAutoExpiredContinued($job->id))->delay($dt->addDay(Config::get('queue.day_job_expired')));
        $jobQueueId = app(Dispatcher::class)->dispatch($jobQueue);
        $job->job_id = $jobQueueId;
        $job->save();

        $location_array = Location::where('business_id', $business_id)->pluck('id')->toArray();
        if(!empty($locations_id)){
            if(!empty($locations_id) && is_array($locations_id)){
                $dataInsert = [];
                foreach ($locations_id as $location) {
                    if (in_array($location, $location_array))
                    {
                        $dataInsert[] = array(
                            'job_id' => $job->id,
                            'location_id' => $location,
                            'status' => 1,
                            'google_jobs_notified' => 0,
                            'opened_at' => new \DateTime,
                        );
                    }
                }
                $jobLocation = new JobLocation();
                $jobLocation->insert($dataInsert);
            }
        }

        $languages_id = $request->input('languages_id') ?: '';
        if(!empty($languages_id)){
            $languages_id = explode(",", $languages_id);
            if(!empty($languages_id) && is_array($languages_id)){
                $dataInsert = [];
                foreach ($languages_id as $language) {
                    $dataInsert[] = array(
                        'job_id' => $job->id,
                        'world_language_id' => $language
                    );
                }
                $jobLanguages = new JobLanguage();
                $jobLanguages->insert($dataInsert);
            }
        }

        $JobLocationCount = JobLocation::where('job_id', $job->id)->where('status', 1)->count();
        if($JobLocationCount > 0){
            $job->status = 1;
        }else{
            $job->status = 0;
        }
        $job->save();

}

        return response(['data' => ["status" => 200]], 200);
    }

    public function update(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $user_auth = Auth::User();
        $this->businessID = (int)$request->input('business_id', 0);
        $id = (int)$request->input('id', 0);

        if(!$this->check()){
            return response(['error' => 'Job permission error'], 500);
        }

        // $job = Job::select('*')->where(['business_jobs.id' => $id, 'business_jobs.business_id' => $this->businessID])
        //             ->join('businesses as b','business_jobs.business_id','=','b.id')
        //             ->join('business_administrators as ba','b.id','=','ba.business_id')
        //             ->where([ 'ba.user_id' => $user_auth->id])->first();
        $job = Job::with(['business.admins' => function($query) use($id, $user_auth){
                              $query
                              ->where('business_administrators.user_id',$user_auth->id);
                          }])->select('business_jobs.*')
                          ->where(['id' => $id, 'business_id' => $this->businessID])
                          ->first();


        if($job === null){
            return response(['error' => 'Job update error'], 500);
        }
        if ($job->status == 0) {
            $currentDT = Carbon::now()->timezone(0);
            if ($currentDT->diffInSeconds($job->created_at) > (Config::get('queue.day_job_expired')*24*60*60)) {
                $update['created_at'] = $currentDT;
                $dt = Carbon::create(date('Y'), date('m'), date('j'), date('H'), date('i'), date('s'));
                $jobQueue = (new JobAutoExpiredContinued($job->id))->delay($dt->addDay(Config::get('queue.day_job_expired')));
                $jobQueueId = app(Dispatcher::class)->dispatch($jobQueue);
                $job->job_id = $jobQueueId;
            }
        }

        $job->business_id = $this->businessID;
        $job->user_id = $user_auth->id;
        $job->title = $request->input('title_en') ?: '';
        $job->title_fr = $request->input('title_fr') ?: '';
        $job->description = $request->input('description_en') ?: '';
        $job->description_fr = $request->input('description_fr') ?: '';
        $job->salary = $request->input('salary') ?: 0;
        $job->salary_type = $request->input('salary_type') ?: '';
        $job->type_key = $request->input('type_key') ?: '';
        $job->certificate_name = $request->input('certificate_name') ?: '';
        $job->hours = $request->input('hours') ?: 0;
        $job->time_1 = $request->input('time_1') ?: '';
        $job->time_2 = $request->input('time_2') ?: '';
        $job->time_3 = $request->input('time_3') ?: '';
        $job->time_4 = $request->input('time_4') ?: '';
        //$job->status = 0;
        //$job->save();

        $locations_id = $request->input('locations_id') ?: '';
        if(!empty($locations_id)){
            $locations = explode(",", $locations_id);
            if(empty($locations)){
                JobLocation::where('job_id', $job->id)->delete();
            }
            if(!empty($locations) && is_array($locations)){
                $JobLocations = JobLocation::where('job_id', $job->id)->get()->all();
                $dataInsert = [];
                foreach ($JobLocations as $item){
                    if(!in_array($item->location_id, $locations)){
                        $item->delete();
                    }
                }
                $JobLocations = JobLocation::where('job_id', $job->id)->get()->pluck("location_id")->toArray();
                foreach ($locations as $location) {
                    if(!in_array($location, $JobLocations)){
                        $dataInsert[] = array(
                            'job_id' => $job->id,
                            'location_id' => $location,
                            'status' => 1,
                            'google_jobs_notified' => 0,
                            'opened_at' => new \DateTime,
                        );
                    }
                }
                $jobLocation = new JobLocation();
                $jobLocation->insert($dataInsert);
            }
        }

        $languages_id = $request->input('languages_id') ?: '';
        if(!empty($languages_id)){
            $languages_id = explode(",", $languages_id);
            if(!empty($languages_id) && is_array($languages_id)){
                JobLanguage::where('job_id', $job->id)->delete();
                $dataInsert = [];
                foreach ($languages_id as $language) {
                    $dataInsert[] = array(
                        'job_id' => $job->id,
                        'world_language_id' => $language
                    );
                }
                $jobLanguages = new JobLanguage();
                $jobLanguages->insert($dataInsert);
            }
        }

        $JobLocationCount = JobLocation::where('job_id', $id)->where('status', 1)->count();
        if($JobLocationCount > 0){
            $job->status = 1;
        }else{
            $job->status = 0;
        }
        $job->save();

        return response(['data' => ["status" => 200]], 200);
    }

    public function delete(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $this->businessID = (int)$request->input('business_id', 0);
        $jobID = (int)$request->input('job_id', 0);

        //set permissions for this object
        $this->permissions = [
            'jobs'
        ];

        //check permissions
        if(!$this->check()){
            return response(['error' => 'Job permission error'], 500);
        }

        $job = Job::where([
            'id' => $jobID,
            'business_id' => $this->businessID
        ])->first();

        if ($job){
            $jobQueue = JobQueue::find($job->job_id);

            if (!$job->delete()) {
                return response(['error' => 'failed delete job'], 500);
            }

            if ($jobQueue) {
                $jobQueue->delete();
            }
        }

        return response(['data' => ["status" => 200]], 200);
    }

    public function setLocations(Request $request, $id){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $this->businessID = (int)$request->input('business_id', 0);

        if(!$this->check()){
            return response(['error' => 'Job permission error'], 500);
        }

        $job = Job::where(['id' => $id, 'business_id' => $this->businessID])->first();

        if($job === null){
            return response(['error' => 'Job error'], 500);
        }

        $locations = $request->input('locations', []);
        if(empty($locations)){
            JobLocation::where('job_id', $job->id)->delete();
        }
        if(!empty($locations)){
            $JobLocations = JobLocation::where('job_id', $job->id)->get()->all();
            $dataInsert = [];
            foreach ($JobLocations as $item){
                if(!in_array($item->location_id, $locations)){
                    $item->delete();
                }
            }
            $JobLocations = JobLocation::where('job_id', $job->id)->get()->pluck("location_id")->toArray();
            foreach ($locations as $location) {
                if(!in_array($location, $JobLocations)){
                    $dataInsert[] = array(
                        'job_id' => $job->id,
                        'location_id' => $location,
                        'status' => 1,
                        'google_jobs_notified' => 0,
                        'opened_at' => new \DateTime,
                    );
                }
            }
            $jobLocation = new JobLocation();
            $jobLocation->insert($dataInsert);
        }

        $JobLocationCount = JobLocation::where('job_id', $id)->where('status', 1)->count();
        if($JobLocationCount > 0){
            $job->status = 1;
        }else{
            $job->status = 0;
        }
        $job->save();

        return response(['data' => ["status" => 200]], 200);
    }

    public function eventOpenedClosedLocation(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $this->businessID = (int)$request->input('business_id', 0);
        $jobID = (int)$request->input('job_id', 0);
        $location_job_id = (int)$request->input('location_job_id', 0);
        $event = (string)$request->input('event', "");
        $is_checked = (int)$request->input('is_checked', 0);

        $Job = Job::where("id", $jobID)->first();
        if(empty($Job)){
            return response(['error' => 'job not found'], 500);
        }


        if($event == "open:all"){
            $JobLocations = JobLocation::where('job_id', $jobID);
            if(!$this->checkIsAdmin($this->businessID)){
                $myLocations = get_my_locations($this->businessID);
                $JobLocations->whereIn("location_id", $myLocations);
            }
            foreach ($JobLocations->get()->all() as $item){
                $item->status = 1;
                $item->google_jobs_notified = 0;
                $item->save();
            }
        }elseif ($event == "close:all"){
            $JobLocations = JobLocation::where('job_id', $jobID);
            if(!$this->checkIsAdmin($this->businessID)){
                $myLocations = get_my_locations($this->businessID);
                $JobLocations->whereIn("location_id", $myLocations);
            }
            foreach ($JobLocations->get()->all() as $item){
                $item->status = 0;
                $item->google_jobs_notified = 0;
                $item->save();
            }
        }elseif ($event == "open:item" || $event == "close:item"){
            $JobLocation = JobLocation::where('job_id', $jobID)->where("id", $location_job_id)->first();
            if($is_checked == 1){
                $JobLocation->status = 1;
            }else{
                $JobLocation->status = 0;
            }
            $JobLocation->google_jobs_notified = 0;
            $JobLocation->save();
        }

        $JobLocationCount = JobLocation::where('job_id', $jobID)->where('status', 1)->count();
        if($JobLocationCount > 0){
            $Job->status = 1;
        }else{
            $Job->status = 0;
        }
        $Job->save();

        return response( ['data' => [] ], 200 );
    }

    public function getOpenedClosedLocation(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        app()->setLocale(auth()->user()->language_prefix);

        $this->businessID = (int)$request->input('business_id', 0);
        $jobID = (int)$request->input('job_id', 0);

        $Job = Job::where("id", $jobID)->first();
        $status = JobLocation::where('job_id',$jobID)
        ->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_job_locations.location_id")
        ->join("business_administrators","business_manager_locations.administrator_id", "=","business_administrators.id")
        ->where("business_administrators.user_id", auth()->user()->id)
        ->max("business_job_locations.status");

        $locationsAll = $Job->locationsAll();

        $opened_html = "";
        $opened_count = 0;
        $closed_html = "";
        $closed_count = 0;

        if(!$this->checkIsAdmin($this->businessID)){
            $myLocations = get_my_locations($this->businessID);
            $locationsAll->whereIn("location_id", $myLocations);
        }



        foreach ($locationsAll->get()->all() as $job_location){
            $location = Business\Location::find($job_location->location_id);
            $location_address = $location->street." ".$location->street_number.", ".$location->city;

            if ($location->region !== null) {
                $location_address .= ", " . $location->region;
            }
            if ($location->country !== null) {
                $location_address .= ", " . $location->country;
            }

            $current_locale = \App::getLocale();
            $location_name = $location['name' . ($current_locale == 'en' ? '' : '_' . $current_locale)];
            if(empty($location_name)){
                $location_name = trans("main.empty_name_job_location");
            }

            if($job_location->status == 1){
                $opened_html .= '<div class="col-md-12 mt-2 open-item">
                               <div class="row">
                                   <div class="col-md-8 ml-3" data-location-id="'.$location->id.'">
                                       <p class="my-0 px-3 coll_name"><strong>'.$location_name. '</strong></p>
                                       <p class="my-0 px-3 coll_title">'.$location_address.'</p>
                                   </div>
                               <div class="col-sm-5 col-md-2 offset-md-1">
                                  <label class="switch mt-3">
                                      <input type="checkbox" class="item-checkbox" checked="checked" value="'.$job_location->id.'">
                                     <span class="slider round"></span>
                                  </label>
                           </div>
                               </div>
                        </div>';

                $opened_count++;
            }else{
                $closed_html .= '<div class="col-md-12 mt-2 close-item">
                               <div class="row">
                                   <div class="col-md-8 ml-3" data-location-id="'.$location->id.'">
                                       <p class="my-0 px-3 coll_name"><strong>'.$location->name. '</strong></p>
                                       <p class="my-0 px-3 coll_title">'.$location_address.'</p>
                                   </div>
                               <div class="col-sm-5 col-md-2 offset-md-1">
                                  <label class="switch mt-3">
                                      <input type="checkbox" class="item-checkbox" value="'.$job_location->id.'">
                                     <span class="slider round"></span>
                                  </label>
                           </div>
                               </div>
                        </div>';
                $closed_count++;
            }


        }

        return response(
            [
                'data' => [
                    "job_status" => $status,
                    "opened_html" => $opened_html,
                    "opened_count" => $opened_count,
                    "closed_html" => $closed_html,
                    "closed_count" => $closed_count,

                ],
            ], 200);
    }

    public function getDataTableJobs(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $this->businessID = (int)$request->input('business_id', 0);
        $language_prefix = $request->input('language_prefix', "en");
        $sort_name = $request->input('sort_name', "title");
        $sort = $request->input('sort', "asc");
        $filter_by_location_ids = $request->input('filter_by_location', []);
        $keyword = $request->input('keywords', "");

        app()->setLocale($language_prefix);

        $Jobs = Job::query();

        $businessIDs = Business::where('id',  $this->businessID)->orWhere('parent_id',  $this->businessID)->pluck('id')->toArray();

        $Jobs = $Jobs->whereIn("business_jobs.business_id", $businessIDs)
            ->join('job_types', 'job_types.key', '=', 'business_jobs.type_key')
            ->select(["business_jobs.*", "job_types.name", "job_types.name_fr"]);

        $Jobs = $Jobs->leftJoin('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');

        $UserManager = Administrator::where('user_id', auth()->user()->id)->where("business_id", $this->businessID)->first();
        if(!empty($UserManager) && $UserManager->role != Administrator::ADMIN_ROLE){
            $Jobs = $Jobs->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_job_locations.location_id")
                ->where("business_manager_locations.administrator_id", $UserManager['id']);
        }

        if(!empty($filter_by_location_ids)){
            $Jobs = $Jobs->whereIn("business_job_locations.location_id", $filter_by_location_ids);
        }

        if (!empty($keyword)) {
            $keywords = explode(' ', $keyword);
            $Jobs = $Jobs->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword){
                    $query->orWhere('business_jobs.title', 'like', '%' . $keyword . '%');
                    $query->orWhere('business_jobs.title_fr', 'like', '%' . $keyword . '%');
                    $query->orWhere('job_types.name', 'like', '%' . $keyword . '%');
                    $query->orWhere('job_types.name_fr', 'like', '%' . $keyword . '%');
                }
            });
        }

        if($sort_name == "title"){
            $Jobs = $Jobs->orderBy('business_jobs.title', $sort);
        }else if($sort_name == "created_date"){
            $Jobs = $Jobs->orderBy('business_jobs.created_at', $sort);
        }

        return Datatables()->eloquent($Jobs->distinct())
            ->filterColumn('name', function ($query, $keyword) {})
            ->editColumn('name', function ($job) use ($UserManager) {
                if(!empty($UserManager) && $UserManager->role != Administrator::ADMIN_ROLE){
                    $job['status'] = JobLocation::where('job_id',$job['id'])->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_job_locations.location_id")
                    ->where("business_manager_locations.administrator_id", $UserManager['id']) 
                    ->max('business_job_locations.status');
                }

                return View('business.auth.graphql.job_item', [
                    'args' => $job,
                    'type_name' => $job->type->getLocalizedNameAttribute(),
                    'isEdit' => $this->checkBusinessAccess($job['business_id'], [
                        Administrator::MANAGER_ROLE,
                        Administrator::FRANCHISE_ROLE,
                    ], ['jobs']),
                ]);//->render();
            })
            ->rawColumns(['name'])
            ->make(true);
    }



    private function check(){
        $user = Auth::User();

        if (!$business = Business::where('id', $this->businessID)->first()) {
            return false;
        }

        $administrator_query = Administrator::query();
        $administrator_query->where('user_id', $user->id);

        if ($business->parent_id) { // if it is a brand then check main business as well
            $administrator_query->whereIn('business_id', [$business->id, $business->parent_id]);
        } else {
            $administrator_query->where('business_id', $business->id);
        }

        $roles = $this->roles;
        $administrator_query->where(function($where)use($roles) {
            $where->orWhere('role', \App\Business\Administrator::ADMIN_ROLE);
            $where->orWhereIn('role', $roles);
        });

        if ($administrator_query->first()) {
            return true;
        }

        return false;
    }


    private function checkBusinessAccess($businessID, $roles = [], $permissions = [])
    {
        if (!$businessID) {
            return false;
        }

        if ($this->checkIsAdmin($businessID)) {
            return true;
        }

        if ( $this->skipPermits($permissions) ) {
            return true;
        }

        $business_administrator_query = Administrator::where([
            'user_id' => auth()->user()->id,
            'business_id' => $businessID,
        ])->where(function($query) use ($roles) {
            $query->orWhere('role', Administrator::ADMIN_ROLE);

            foreach ($roles as $role) {
                $query->orWhere('role', $role);
            }
        });

        $admin = $business_administrator_query->first();

        if ($admin && $permit = $admin->permits()->whereIn('slug', $permissions)->first()) {
            if ($permit->pivot->value == 1) {
                return true;
            }
            if ($permit->pivot_value == 1) {
                return true;
            }
        }
        return false;
    }

    /**
     * Skip some permissions
     *
     * @param mix $permits
     * @return booblean
     */
    private function skipPermits($permits)
    {
        $permitsForSkip = [
            'buttons',
            'chats',
            'franchisees',
            'interviews_managers',
            'notes_managers',
            // 'candidates',
            // 'business'
        ];

        if (is_array($permits)) {
            return empty(array_diff($permits, $permitsForSkip));
        }

        if (is_string($permits)) {
            return in_array($permits, $permitsForSkip);
        }

        return false;
    }

    /**
     * Check admin permissions
     *
     * @param integer $businessId
     * @return booblean
     */
    private function checkIsAdmin(int $businessId)
    {
        if (!auth()->user()) {
            return false;
        }

        $admin = auth()->user()
            ->_administratorBusiness($businessId)
            ->first();

        if (! $admin) {
            return false;
        }

        if (optional($admin->business)->getKey() === $businessId) {
            return true;
        }

        return false;
    }
}


//Storage::put("test.php", json_encode($request->all()));
