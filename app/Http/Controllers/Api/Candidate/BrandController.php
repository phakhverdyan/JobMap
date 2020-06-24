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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Api\Candidate\BaseController;


class BrandController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get(Request $request)
    {
        $this->business_id = (int)$request->input('business_id', 0);

        $this->check();

        $business_ids = Business::where('businesses.id', $this->business_id)->orWhere('businesses.parent_id', $this->business_id)->pluck("id")->toArray();

        $business_query = Business::query();
        $business_query->whereIn('businesses.id', $business_ids);

        $raw_query = '(select count(distinct candidates.user_id) from candidates where candidates.business_id=businesses.id ) as candidate_count';
        $user_manager = Administrator::where('business_id', $this->business_id)->where('user_id', Auth::user()->getKey())->first();
        if(!empty($user_manager) && $user_manager->role == Administrator::FRANCHISE_ROLE){
            $business_query->join("business_locations", "business_locations.business_id", "=", "businesses.id")
                ->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_locations.id")
                ->where("business_manager_locations.administrator_id", $user_manager['id']);

            $raw_query = '(select count(distinct candidates.user_id) from candidates inner join business_manager_locations on business_manager_locations.location_id=candidates.location_id where candidates.business_id=businesses.id and business_manager_locations.administrator_id='.$user_manager['id'].' ) as candidate_count';
        }

        $business_query = $business_query->select([
            'businesses.*',
            DB::raw($raw_query),
        ]);

        $items = $business_query->distinct()->get()->all();

        return response([ 'data' => ["items" => $items]], 200);
    }

    public function create(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }


}
