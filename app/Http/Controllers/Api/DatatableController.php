<?php

namespace App\Http\Controllers\Api;

use App\Business\BusinessBilling;
use App\Http\Controllers\Controller;
use App\Business\Department;
use App\Certificate;
use App\JobCategory;
use App\WorldLanguage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Business;
use App\Business\Administrator;
use App\Business\Location;
use App\User;
use Auth;
use Yajra\Datatables\Datatables;

class DatatableController extends Controller
{

    public function getAllBusinessList(Request $request) {
        if (!auth()->user()) {
            return response(['error' => 'auth user error'], 500);
        }

        $language_prefix = $request->input('language_prefix', "en");
        app()->setLocale($language_prefix);
        $dir = $request->input('order.0.dir', "asc");
        $keyword = $request->input('search.value', "");

            $Business_ids = Administrator::where('user_id', auth()->user()->id)->get()->pluck("business_id")->toArray();
            $businesses = Business::select('businesses.*');
            $businesses = $businesses->whereIn('businesses.id', $Business_ids);
    
            $businesses = $businesses->select('businesses.id', 'businesses.name', 'businesses.picture')->distinct()->orderBy('businesses.id', $dir);
            return Datatables()->eloquent($businesses)
                ->filterColumn('name', function ($query, $keyword) {
                })
                ->editColumn('name', function ($business) {
                    $picture = null;
                    if ($business->picture) {
                        $picture = Storage::disk('business')->url('/' . $business->id . '/50.50.') . $business->picture;
                    }
                    if (!$picture) {
                        $picture = asset('img/business-logo-small.png');
                    }
                    return "<p class='details-control pl-3 h5'data-business-json=".json_encode(array("id" => $business->id, "business_id" => $business->id, "image_url" => $business->image_url))."  data-business-id=" . $business->id . "><img src='" . $picture . "'/>" . $business->name ."</p>";
                })
                ->rawColumns(['name'])
                ->make(true);
    }

    public function getBusinessData(Request $request)
    {
        if (!auth()->user()) {
            return response(['error' => 'auth user error'], 500);
        }

        $business_id = $request->input('business_id', 0);
        $language_prefix = $request->input('language_prefix', "en");
        app()->setLocale($language_prefix);
        $dir = $request->input('order.0.dir', "asc");
        $keyword = $request->input('search.value', "");
        $keywords = explode(' ', $keyword);
        $all = $request->input('all', false);
        $Business_ids = Business::where('id', $business_id)->orWhere('parent_id', $business_id)->get()->pluck("id")->toArray();

        $businesses = Business::select('businesses.*');
        $businesses = $businesses->whereIn('businesses.id', $Business_ids);

        $UserManager = Administrator::where('user_id', auth()->user()->id)->where("business_id", $business_id)->first();
        if(!empty($UserManager) && $UserManager->role != Administrator::ADMIN_ROLE){
            $businesses = $businesses
                ->join("business_locations", "business_locations.business_id", "=", "businesses.id")
                ->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_locations.id")
                ->where("business_manager_locations.administrator_id", $UserManager['id']);
        }

        $businesses->where(function ($where) use ($keywords) {
            foreach ($keywords as $keyword) {
                $where->orWhere('businesses.name', 'like', '%' . $keyword . '%');
            }
        });

        

        $businesses = $businesses->select('businesses.id', 'businesses.name', 'businesses.picture')->distinct()->orderBy('businesses.id', $dir);
        return Datatables()->eloquent($businesses)
            ->filterColumn('name', function ($query, $keyword) {
            })
            ->editColumn('name', function ($business) use ($UserManager, $all) {
                $picture = null;
                if ($business->picture) {
                    $picture = Storage::disk('business')->url('/' . $business->id . '/50.50.') . $business->picture;
                }

                $location_count = 0;
                if(!empty($UserManager) && $UserManager->role != Administrator::ADMIN_ROLE){
                    $location_count = Location::where("business_locations.business_id", "=", $business->id)
                        ->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_locations.id")
                        ->where("business_manager_locations.administrator_id", $UserManager['id'])->distinct("business_locations.id")->count("business_locations.id");
                }else{
                    $location_count = $business->locations->count();
                }

                if (!$picture) {
                    $picture = asset('img/business-logo-small.png');
                }
                $all ? $data_json = 'data-business-json='.json_encode(array("business_id" => $business->id, "image_url" => $business->image_url)) : $data_json = ""; 
                return "<p class='details-control pl-3 h5' ".$data_json." data-business-id=" . $business->id . "><img src='" . $picture . "'/>" . $business->name . " (" . $location_count . ")" . "</p>";
            })
            ->rawColumns(['name'])
            ->make(true);
    }

    public function getLocationData(Request $request)
    {
        if (!auth()->user()) {
            return response(['error' => 'auth user error'], 500);
        }

        $business_id = $request->input('business_id', 0);
        $language_prefix = $request->input('language_prefix', "en");
        app()->setLocale($language_prefix);
        $dir = $request->input('order.0.dir', "asc");
        $keyword = $request->input('search.value', "");
        $keywords = explode(' ', $keyword);
        $Business_ids = Business::query();
        $Business_ids = $Business_ids->Where('id', $business_id)->orWhere('parent_id', $business_id)->get()->pluck("id")->toArray();

        $business_query = Business::select('businesses.*');
        $business_query = $business_query->whereIn("id", $Business_ids);

        $business_query->where(function ($where) use ($keywords) {
            foreach ($keywords as $keyword) {
                $where->orWhere('businesses.name', 'like', '%' . $keyword . '%');
            }
        });

        $businesses_id = $business_query->get()->pluck("id")->toArray();
        $business_location_query = Location::select('business_locations.*');

        if (!empty($businesses_id)) {
            $business_location_query->whereIn("business_id", $businesses_id);
        } else {
            $business_location_query->whereIn("business_id", $Business_ids);
        }

        $business_location_query->where(function ($where) use ($keywords) {
            foreach ($keywords as $keyword) {
                $where->orWhere('business_locations.name', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.street', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.city', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.region', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.country', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.street_number', 'like', '%' . $keyword . '%');
            }
        });

        if (!empty($businesses_id) && $business_location_query->count() == 0) {
            $business_location_query = Location::select('business_locations.*');
            $business_location_query = $business_location_query->whereIn("business_id", $businesses_id);
        }

        $Business = Business::where("id", $businesses_id)->first();
        $UserManager = Administrator::where('business_id', ($Business->parent_id?$Business->parent_id:$businesses_id))->where('user_id', auth()->user()->id)->first();
        if(!empty($UserManager) && $UserManager->role != Administrator::ADMIN_ROLE){
            $business_location_query
                ->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_locations.id")
                ->where("business_manager_locations.administrator_id", $UserManager['id']);
        }

        $business_location_query->orderBy('id', $dir);
        return Datatables()->eloquent($business_location_query)
            ->filterColumn('name', function ($query, $keyword) {
            })
            ->editColumn('name', function ($location) {
                $root = $location;
                $picture = null;
                if ($root['business']['picture']) {
                    $picture = Storage::disk('business')->url('/' . $root['business_id'] . '/50.50.') . $root['business']['picture'] . '?v=' . rand(11111, 99999);
                }
                $location = $root['city'];
                if ($root['region'] != "") {
                    $location .= ", " . $root['region'];
                }
                if ($root['country'] != "") {
                    $location .= ", " . $root['country'];
                }

                $is_paid = 0;
                $BusinessBilling = BusinessBilling::where("business_id", $root['business_id'])
                    ->where("user_paid_id", auth()->user()->id)
                    ->where("location_id", $root['id'])
                    ->where("billing_type", "location")
                    ->first();
                if(!empty($BusinessBilling)){
                    $is_paid = $BusinessBilling->is_paid;
                }

                $view = View('business.auth.graphql.location_item', [
                    'args' => $root,
                    'picture' => $picture,
                    'location' => $location,
                    'is_paid' => $is_paid,
                    'isEdit' => $this->checkBusinessAccess($root['business_id'], [Administrator::MANAGER_ROLE, Administrator::FRANCHISE_ROLE], ['locations'])
                ])->render();
                return $view;
            })
            ->rawColumns(['name'])
            ->make(true);
    }

    public function getLocationAssignData(Request $request){
        if (!auth()->user()) {
            return response(['error' => 'auth user error'], 500);
        }

        $business_id = $request->input('business_id', 0);
        $language_prefix = $request->input('language_prefix', "en");
        app()->setLocale($language_prefix);
        $dir = $request->input('order.0.dir', "asc");
        $keyword = $request->input('search.value', "");
        $keywords = explode(' ', $keyword);
        $Business_ids = Business::query();
        $Business_ids = $Business_ids->Where('id', $business_id)->orWhere('parent_id', $business_id)->get()->pluck("id")->toArray();

        $business_query = Business::select('businesses.*');
        $business_query = $business_query->whereIn("id", $Business_ids);

        $business_query->where(function ($where) use ($keywords) {
            foreach ($keywords as $keyword) {
                $where->orWhere('businesses.name', 'like', '%' . $keyword . '%');
            }
        });
        $businesses = $business_query;
        $businesses_id = $businesses->get()->pluck("id")->toArray();
        $business_location_query = Location::select('business_locations.*');

        if (!empty($businesses_id)) {
            $business_location_query->whereIn("business_id", $businesses_id);
        } else {
            $business_location_query->whereIn("business_id", $Business_ids);
        }

        $Business = Business::where("id", $businesses_id)->first();
        $UserManager = Administrator::where('business_id', ($Business->parent_id?$Business->parent_id:$businesses_id))->where('user_id', auth()->user()->id)->first();
        if(!empty($UserManager) && $UserManager->role != Administrator::ADMIN_ROLE){
            $business_location_query
                ->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_locations.id")
                ->where("business_manager_locations.administrator_id", $UserManager['id']);
        }

        $business_location_query->where(function ($where) use ($keywords) {
            foreach ($keywords as $keyword) {
                $where->orWhere('business_locations.name', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.street', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.city', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.region', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.country', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.street_number', 'like', '%' . $keyword . '%');
            }
        });

        if (!empty($businesses_id) && $business_location_query->count() == 0) {
            $business_location_query = Location::select('business_locations.*');
            $business_location_query = $business_location_query->whereIn("business_id", $businesses_id);
        }
        $business_location_query->orderBy('id', $dir);
        return Datatables()->eloquent($business_location_query)
            ->filterColumn('name', function ($query, $keyword) {
            })
            ->editColumn('name', function ($location) {
                $root = $location;
                $picture = null;
                if ($root['business']['picture']) {
                    $picture = Storage::disk('business')->url('/' . $root['business_id'] . '/50.50.') . $root['business']['picture'] . '?v=' . rand(11111, 99999);
                }
                $location = $root['city'];
                if ($root['region'] != "") {
                    $location .= ", " . $root['region'];
                }
                if ($root['country'] != "") {
                    $location .= ", " . $root['country'];
                }
                $view = View('business.auth.graphql.location_item_assign', [
                    'args' => $root,
                    'picture' => $picture,
                    'location' => $location
                ])->render();
                return $view;
            })
            ->rawColumns(['name'])
            ->make(true);
    }

    public function getLocationByBusiness(Request $request, $id_business)
    {
        if (!auth()->user()) {
            return response(['error' => 'auth user error'], 500);
        }
        $language_prefix = $request->input('language_prefix', "en");
        app()->setLocale($language_prefix);
        $keyword = $request->input('search.value', "");
        $dir = $request->input('order.0.dir', "asc");
        $keywords = explode(' ', $keyword);
        $business_location_query = Location::select('business_locations.*');

        $Business = Business::where("id", $id_business)->first();
        $UserManager = Administrator::where('business_id', ($Business->parent_id?$Business->parent_id:$id_business))->where('user_id', auth()->user()->id)->first();
        if(!empty($UserManager) && $UserManager->role != Administrator::ADMIN_ROLE){
            $business_location_query
                ->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_locations.id")
                ->where("business_manager_locations.administrator_id", $UserManager['id']);
        }

        $business_location_query->where(function ($where) use ($keywords) {
            foreach ($keywords as $keyword) {
                $where->orWhere('business_locations.name', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.street', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.city', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.region', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.country', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.street_number', 'like', '%' . $keyword . '%');
            }
        });
        $business_location_query->where('business_id', $id_business)->orderBy('id', $dir);

        return Datatables()->eloquent($business_location_query)
            ->filterColumn('name', function ($query, $keyword) {
            })
            ->editColumn('name', function ($location) {
                $root = $location;
                $picture = null;
                if ($root['business']['picture']) {
                    $picture = Storage::disk('business')->url('/' . $root['business_id'] . '/50.50.') . $root['business']['picture'] . '?v=' . rand(11111, 99999);
                }
                $location = $root['city'];
                if ($root['region'] != "") {
                    $location .= ", " . $root['region'];
                }
                if ($root['country'] != "") {
                    $location .= ", " . $root['country'];
                }

                $is_paid = 0;
                $BusinessBilling = BusinessBilling::where("business_id", $root['business_id'])
                    ->where("user_paid_id", auth()->user()->id)
                    ->where("location_id", $root['id'])
                    ->where("billing_type", "location")
                    ->first();
                if(!empty($BusinessBilling)){
                    $is_paid = (int)$BusinessBilling->is_paid;
                }

                $view = View('business.auth.graphql.location_item', [
                    'args' => $root,
                    'picture' => $picture,
                    'location' => $location,
                    'is_paid' => $is_paid,
                    'isEdit' => $this->checkBusinessAccess($root['business_id'], [Administrator::MANAGER_ROLE, Administrator::FRANCHISE_ROLE], ['locations'])
                ])->render();
                return $view;
            })
            ->rawColumns(['name'])
            ->make(true);
    }

    public function getLocationAssignByBusiness(Request $request, $id_business)
    {
        if (!auth()->user()) {
            return response(['error' => 'auth user error'], 500);
        }
        $language_prefix = $request->input('language_prefix', "en");
        app()->setLocale($language_prefix);
        $keyword = $request->input('search.value', "");
        $dir = $request->input('order.0.dir', "asc");
        $keywords = explode(' ', $keyword);

        $business_location_query = Location::select('business_locations.*');
        $business_location_query->where(function ($where) use ($keywords) {
            foreach ($keywords as $keyword) {
                $where->orWhere('business_locations.name', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.street', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.city', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.region', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.country', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.street_number', 'like', '%' . $keyword . '%');
            }
        });

        $business_location_query->where('business_id', $id_business)->orderBy('id', $dir);

        //$Business = Business::where("id", $id_business)->first();
        //$UserManager = Administrator::where('business_id', ($Business->parent_id?$Business->parent_id:$id_business))->where('user_id', auth()->user()->id)->first();
        $UserManager = Administrator::where('business_id', $id_business)->where('user_id', auth()->user()->id)->first();
        if(!empty($UserManager) && $UserManager->role != Administrator::ADMIN_ROLE){
            $business_location_query
                ->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_locations.id")
                ->where("business_manager_locations.administrator_id", $UserManager['id']);
        }

        return Datatables()->eloquent($business_location_query->distinct("business_locations.id"))
            ->filterColumn('name', function ($query, $keyword) {
            })
            ->editColumn('name', function ($location) {
                $root = $location;
                $picture = null;
                if ($root['business']['picture']) {
                    $picture = Storage::disk('business')->url('/' . $root['business_id'] . '/50.50.') . $root['business']['picture'] . '?v=' . rand(11111, 99999);
                }
                $location = $root['city'];
                if ($root['region'] != "") {
                    $location .= ", " . $root['region'];
                }
                if ($root['country'] != "") {
                    $location .= ", " . $root['country'];
                }
                $view = View('business.auth.graphql.location_item_assign', [
                    'args' => $root,
                    'picture' => $picture,
                    'location' => $location
                ])->render();
                return $view;
            })
            ->rawColumns(['name'])
            ->make(true);
    }

    public function getIdListLocationsAssign(Request $request)
    {
        if (!auth()->user()) {
            return response(['error' => 'auth user error'], 500);
        }

        $business_id = $request->input('business_id', 0);

        $business_location_query = Location::select('business_locations.*');
        $business_location_query = $business_location_query->where("business_locations.business_id", $business_id);

        $Business = Business::where("id", $business_id)->first();
        $UserManager = Administrator::where('business_id', ($Business->parent_id?$Business->parent_id:$business_id))->where('user_id', auth()->user()->id)->first();
        if(!empty($UserManager) && $UserManager->role != Administrator::ADMIN_ROLE){
            $business_location_query
                ->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_locations.id")
                ->where("business_manager_locations.administrator_id", $UserManager['id']);
        }

        $locations = $business_location_query->get()->pluck("id")->toArray();
        if (!empty($locations)) {
            return response(["data" => $locations], 200);
        }

        return response(['error' => 'ERROR getIdListLocationsAssign'], 500);
    }

    public function getSelectedListQuery(Request $request)
    {
        if (!auth()->user()) {
            return response(['error' => 'auth user error'], 500);
        }

        $page = 1;
        $page_current = $request->input('page', 0);

        if ($page_current > $page) {
            $page = $page_current;
        }

        $current_locale = $request->input('current_locale', "en");

        $query = null;
        $query_type = $request->input('query_type', "");
        $businessID = $request->input('business_id', 0);
        if (!empty($query_type)) {
            switch ($query_type) {
                case "Certificate":
                    $query = Certificate::query();
                    break;
                case "Department":
                    $query = Department::query();
                    if ($businessID > 0) {
                        $query->where('business_id', $businessID);
                    }
                    break;
                case "WorldLanguage":
                    $query = WorldLanguage::query();
                    $query->whereIn('id', ['1', '284', '527']);
                    break;
            }
        }

        if ($query !== null) {

            $keywords = $request->input('keywords', "");
            if (!empty($keywords)) {
                if ($current_locale === 'en') {
                    $query->where('name', 'like', '%' . $keywords . '%');
                } else {
                    $query->where('name_' . $current_locale, 'like', '%' . $keywords . '%');
                }
            }

            if ($current_locale === 'en') {
                $query->orderBy('name', 'asc');
            } else {
                $query->orderBy('name_' . $current_locale, 'asc');
            }

            $data['total_count'] = $query->count();
            $data['items'] = $query->skip(20 * ($page - 1))->take(20 * $page)->get()->toArray();

            return response(['data' => $data], 200);
        }

        return response(['error' => 'ERROR getSelectedListQuery'], 500);
    }

    private function checkBusinessAccess($businessID, $roles = [], $permissions = [])
    {
        if (!$businessID) {
            return false;
        }
        if ($this->checkIsAdmin($businessID)) {
            return true;
        }
        if ($this->skipPermits($permissions)) {
            return true;
        }
        if (!$business = Business::where('id', $businessID)->first()) {
            return false;
        }

        $administrator_query = Administrator::query();
        $administrator_query->where('user_id', auth()->user()->id);
        if ($business->parent_id) {
            $administrator_query->whereIn('business_id', [$business->id, $business->parent_id]);
        } else {
            $administrator_query->where('business_id', $business->id);
        }
        $administrator_query->where(function ($query) use ($roles) {
            $query->orWhere('role', Administrator::ADMIN_ROLE);

            foreach ($roles as $role) {
                $query->orWhere('role', $role);
            }
        });
        $administrator = $administrator_query->first();

        $permit = $administrator->permits()->whereIn('slug', $permissions)->first();

        if ($administrator && $permit) {

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
        if (!Auth::User()) {
            return false;
        }
        if (!$business = Business::where('id', $businessId)->first()) {
            return false;
        }
        $administrator_query = Administrator::query();
        if ($business->parent_id) {
            $administrator_query->whereIn('business_id', [$business->id, $business->parent_id]);
        } else {
            $administrator_query->where('business_id', $business->id);
        }
        $administrator_query->where('role', Administrator::ADMIN_ROLE);
        if (!$administrator_query->first()) {
            return false;
        }
        return true;
    }

}