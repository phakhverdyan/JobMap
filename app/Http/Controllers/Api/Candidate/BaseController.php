<?php
namespace App\Http\Controllers\Api\Candidate;

use App\Business;
use App\Business\Administrator;
use App\Candidate\Candidate;
use App\Http\Controllers\Controller;
use DateTime;
use DateTimeInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;


class BaseController extends Controller
{

    protected $roles = [];
    protected $permissions = [];
    protected $business_id = 0;



    protected function __construct()
    {
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::FRANCHISE_ROLE,
            Administrator::ADMIN_ROLE
        ];

    }

    protected function getLocale()
    {
        $locale = Auth::user()['language_prefix'];
        App::setLocale($locale);
        return $locale?$locale:"en";
    }

    protected function check()
    {
        if(!Auth::user()){
            return response(['error' => 'auth user error'], 500);
        }

        if($this->business_id === 0){
            return response(['error' => 'Business id === 0'], 500);
        }

        $business_query = Business::query();

        if (!$business_query = $business_query->where('id', $this->business_id)->first()) {
            return response(['error' => 'No such business'], 500);
        }

        $administrator_query = Administrator::query();

        $administrator_query->where('user_id', Auth::user()->getKey());

        if ($business_query->parent_id) { // if it is a brand then check main business as well
            $administrator_query->whereIn('business_id', [$business_query->id, $business_query->parent_id]);
        } else {
            $administrator_query->where('business_id', $business_query->id);
        }

        $administrator_query->where(function($where) {
            $where->orWhereIn('role', $this->roles);
        });

        if ($administrator_query->first()) {
            return true;
        }

        return response(['error' => 'Permission error!'], 500);
    }

    protected function getDays(DateTime $date_time)
    {
        return round((time() - $date_time->getTimestamp()) / (60 * 60 * 24));
    }

    protected function getCandidateCount($brand_id, $pipeline_id, $pipeline_type, $keywords = "", $filter_by_location_ids = array())
    {

        $candidate_query = Candidate::where('candidates.business_id', $brand_id);
        $candidate_query->join('users', 'users.id', '=', 'candidates.user_id');

        if(!empty($filter_by_location_ids)){
            $candidate_query->whereIn("candidates.location_id", $filter_by_location_ids);
        }

        if (!empty($keywords)) {
            $keywords = explode(" ", $keywords);
            $candidate_query->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword){
                    $query->orWhere('users.first_name', 'like', '%' . $keyword . '%');
                    $query->orWhere('users.last_name', 'like', '%' . $keyword . '%');
                }

//                $query->orWhere('users.city', 'like', '%' . $keywords . '%');
//                $query->orWhere('users.region', 'like', '%' . $keywords . '%');
//                $query->orWhere('users.country', 'like', '%' . $keywords . '%');
            });
        }

        // Only by current auth locations
        $user_manager = Administrator::where('user_id', Auth::user()->getKey())->where("business_id", $this->business_id)->first();
        if(!empty($user_manager) && $user_manager->role != Administrator::ADMIN_ROLE){
            $candidate_query = $candidate_query->join("business_manager_locations", "business_manager_locations.location_id", "=", "candidates.location_id")
                ->where("business_manager_locations.administrator_id", $user_manager['id']);
        }

        return $candidate_query->where(
            'candidates.pipeline', (!$pipeline_type || $pipeline_type == 'custom') ? $pipeline_id : $pipeline_type)
            ->distinct("candidates.user_id")
            ->count('candidates.user_id');
    }

    protected function getWavingCandidateCount($brand_id, $pipeline_id, $pipeline_type)
    {

        $candidate_query = Candidate::query();

        // Only by current auth locations
        $user_manager = Administrator::where('user_id', Auth::user()->getKey())->where("business_id", $this->business_id)->first();
        if(!empty($user_manager) && $user_manager->role == Administrator::FRANCHISE_ROLE){
            $candidate_query = $candidate_query->join("business_manager_locations", "business_manager_locations.location_id", "=", "candidates.location_id")
                ->where("business_manager_locations.administrator_id", $user_manager['id']);
        }

        $candidate_query->join('candidate_waves', 'candidates.last_wave_id', '=', 'candidate_waves.id');
        $candidate_query->where('candidates.last_wave_id', '>', 0);
        $candidate_query->whereRaw('UNIX_TIMESTAMP(candidate_waves.created_at) + 86400 * 30 > UNIX_TIMESTAMP()');

        return $candidate_query->where([
            'pipeline' => (!$pipeline_type || $pipeline_type == 'custom') ? $pipeline_id : $pipeline_type,
            'business_id' => $brand_id,
        ])->distinct()->count('candidates.user_id');
    }
}
