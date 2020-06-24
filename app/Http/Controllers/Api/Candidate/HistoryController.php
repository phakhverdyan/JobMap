<?php
namespace App\Http\Controllers\Api\Candidate;

use App\Business;
use App\Business\Administrator;
use App\Business\Pipeline;
use App\Candidate\Candidate;
use App\Candidate\History;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Api\Candidate\BaseController;


class HistoryController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get(Request $request)
    {
        Carbon::setLocale( $this->getLocale());

        $this->business_id = (int)$request->input('business_id', 0);
        //$candidate_id = (int)$request->input('candidate_id', 0);
        $user_id = (int)$request->input('user_id', 0);
        $brand_id = (int)$request->input('brand_id', 0);
        if($brand_id == 0){
            $brand_id = $this->business_id;
        }

        //check permissions
        $this->check();

        $data_query = array(
            'candidate_user_id' => $user_id,
            'business_id' => $brand_id,
        );

        $auth_manager_role = get_manager_role($this->business_id);
        if ($auth_manager_role && $auth_manager_role === Administrator::FRANCHISE_ROLE) {
            $data_query['manager_user_id'] = Auth::user()->getKey();
        }

        $history_query = History::where($data_query)->orderBy('updated_at', "dec")->get()->all();

        $response = [];

        foreach ($history_query as $item){

            $pipeline_query = Pipeline::where('business_id', $this->business_id);
            $pipeline_query = $pipeline_query->where(function ($query) use ($item) {
                    $query->orWhere('type', $item['pipeline']);
                    $query->orWhere('id', $item['pipeline']);
                })->first();

            $days = $this->getDays($item['updated_at']);

            $response[] = [
                'candidate' => null,
                'pipeline' => [
                    'pipeline' => $pipeline_query['name'],
                    'date' => ($days == 0) ? trans('fields.today') : Carbon::now()->subDays($days)->diffForHumans(),
                    'manager' => $item['manager'],
                ],
                'date' => $days
            ];
        }

        $candidate_query = Candidate::where([
            'user_id' => $user_id,
            'business_id' => $brand_id,
        ]);

        // Only by current auth locations
        $user_manager = Administrator::where('user_id', Auth::user()->getKey())->where("business_id", $this->business_id)->first();
        if(!empty($user_manager) && $user_manager->role  === Administrator::FRANCHISE_ROLE){
            $candidate_query = $candidate_query->join("business_manager_locations", "business_manager_locations.location_id", "=", "candidates.location_id")
                ->where("business_manager_locations.administrator_id", $user_manager['id']);
        }

        $candidate_query = $candidate_query->orderBy('updated_at', "desc")->get()->all();

        foreach ($candidate_query as $item){

            $days = $this->getDays($item['updated_at']);

            $response[] = [
                'candidate' => [
                    'business' => $item['business'],
                    'job' => $item['job'],
                    'location' => $item['location'],
                    'user' => $item['user'],
                    'thumbnail_url' => $item['user_video']['thumbnail_url'],
                    'user_video' => $item['user_video']['file_url'],
                    'date' => ($days == 0) ? trans('fields.today') : Carbon::now()->subDays($days)->diffForHumans(),
                ],
                'pipeline' => null,
                'date' => $days
            ];
        }

        return response([ 'data' => ["items" => $response]], 200);
    }

    public function create(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }


}
