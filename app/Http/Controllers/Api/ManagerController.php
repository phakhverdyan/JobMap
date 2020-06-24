<?php

namespace App\Http\Controllers\Api;

use App\Business;
use App\Business\Administrator;
use App\Business\BusinessBilling;
use App\Business\ManagerLocation;
use App\Business\Permit;
use App\Mail\UserNotifications;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Support\Facades\Mail;
use Validator;

class ManagerController extends Controller
{

    private $roles = [
        Administrator::MANAGER_ROLE,
        Administrator::FRANCHISE_ROLE
    ];

    public function get(Request $request, $id)
    {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $businessID = (int)$request->input('business_id', 0);

        if(!$this->check($businessID, $this->roles)){
            return response(['error' => 'Manager permission error'], 500);
        }

        $administrator = Administrator::where(["id" => $id])->with('user', 'permits')->firstOrFail();

        if(!empty($administrator)){
            $data['manager'] = $administrator;
            $data['locations'] = ManagerLocation::where(["administrator_id" => $id])->get();
            return response(['data' => $data], 200);
        }

        return response([ 'error' => 'Manager error'], 500);
    }

    public function create(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $validator = Validator::make($request->all(), [
            // 'first_name'     => 'required|string|max:255',
            // 'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => "validation", 'validator' => $validator->errors()]);
        }

        $businessID = (int)$request->input('business_id', 0);
        $sub_parameters = $request->input('paid_plan', null);
        if ($sub_parameters)
        {
            $sub_parameters = json_decode($sub_parameters, true);
        } 

        if(!$this->check($businessID, $this->roles)){
            return response(['error' => 'Manager permission error'], 500);
        }

        $user_auth = Auth::User();

        $email = $request->input('email', "");

        $user = User::where(['email' => $email])->first();

        if(!empty($user)){
            //send notification to user
            Mail::to($email)->queue(new UserNotifications($user, 'ADD_TO_BUSINESS', [
                'business_id' => $businessID,
            ], $user_auth->language_prefix));
        }else{
            $first_name = $request->input('first_name', "No");
            $last_name = $request->input('last_name', "name");
            $user = new User();
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->email = $email;
            // $user->username = strtolower($first_name . $last_name) . rand('1111', '9999');
            $user->invite_token = md5($businessID . $first_name . $last_name . $email);
            $user->invite_business_id = $businessID;
            $user->invite_user_id = $user_auth->id;
            $user->password = '';
            $user->run_first = 1;
            $user->save();

            $business = Business::where(['id' => $businessID])->first();
            if(empty($business) || empty($user)){
                return response([ 'error' => 'Manager error'], 500);
            }

            Mail::to($user->email)->queue(new \App\Mail\ManagerInvitation($user, $user_auth, $business, 'INVITE', auth()->user()->language_prefix));
        }

        $role = $request->input('role', null);
        $administrator = new Administrator();
        $administrator->user_id = $user['id'];
        $administrator->business_id = $businessID;
        $administrator->role = $role;
        $administrator->save();
        
        if ($role == 'manager'){
            if ($sub_parameters)
            {
                $billingSlot = BusinessBilling::whereNull('user_id')
                ->where('business_id', $businessID)
                ->where('plan_id', $sub_parameters['plan_id'])
                ->where('pack_id', $sub_parameters['pack_id'])
                ->where('status','active')->first();

                $billingSlot->user_id = $administrator->user_id;
                $billingSlot->save();
            }
            // else
            // {
            //     $billingSlot = BusinessBilling::whereNull('user_id')
            //     ->where('business_id', $businessID)
            //     ->where('status','active')->first();
            // }
    

        }


        $permits = Permit::where(['type' => $role])->get()->pluck('id');
        $permits_on = $request->input('permits', []);
        $permits_attach = [];
        foreach ($permits as $permit) {
            $on_off = 0;
            if (in_array($permit,$permits_on)) {
                $on_off = 1;
            }
            $permits_attach[$permit] = [ 'value' => $on_off ];
        }
        $administrator->permits()->attach($permits_attach);

        $locations = $request->input('locations', []);
        if(!empty($locations)){
            ManagerLocation::where(["administrator_id" => $administrator['id']])->delete();
            $dataInsert = [];
            foreach ($locations as $location) {
                $dataInsert[] = array(
                    'administrator_id' => $administrator['id'],
                    'location_id' => $location
                );
            }
            $managerLocation = new ManagerLocation();
            $managerLocation->insert($dataInsert);
        }

        if(!$role) $role = 'unassigned';
        return response([
            "role"     => $role, 
            "admin_id" => $administrator->id,
            "email"    => $user->email,
            "name"     => $user->first_name.$user->last_name
        ], 200);
    }

    public function update(Request $request, $id){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $validator = Validator::make($request->all(), [
            'first_name'     => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => "validation", 'validator' => $validator->errors()]);
        }

        $businessID = (int)$request->input('business_id', 0);

        if(!$this->check($businessID, $this->roles)){
            return response(['error' => 'Manager permission error'], 500);
        }

        $user_auth = Auth::User();

        $administrator = Administrator::where(['id' => $id])->first();
        if(empty($administrator)){
            return response([ 'error' => 'Manager error'], 500);
        }

        $email = $request->input('email', "");
        $user = User::where(['id' => $administrator['user_id'], 'email' => $email])->first();
        if(empty($user)){
            return response([ 'error' => 'Manager error'], 500);
        }

        $first_name = $request->input('first_name', "");
        $last_name = $request->input('last_name', "");
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->username = strtolower($first_name . $last_name) . rand('1111', '9999');
        $user->invite_token = md5($businessID . $first_name . $last_name . $email);
        $user->save();
        $role = $request->input('role', "");
        $administrator->role = $role;
        $administrator->save();
        $permits = Permit::where(['type' => $role])->get()->pluck('id');
        $permits_on = $request->input('permits', []);
        $permits_attach = [];
        foreach ($permits as $permit) {
            $on_off = 0;
            if (in_array($permit,$permits_on)) {
                $on_off = 1;
            }
            $permits_attach[$permit] = [ 'value' => $on_off ];
        }
        $administrator->permits()->sync($permits_attach);

        $locations = $request->input('locations', []);
        if(!empty($locations)){
            ManagerLocation::where(["administrator_id" => $administrator['id']])->delete();
            $dataInsert = [];
            foreach ($locations as $location) {
                $dataInsert[] = array(
                    'administrator_id' => $administrator['id'],
                    'location_id' => $location
                );
            }
            $managerLocation = new ManagerLocation();
            $managerLocation->insert($dataInsert);
        }

        return response(['data' => ["status" => 200]], 200);
    }

    public function remove(Request $request, $id) {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $businessID = (int)$request->input('business_id', 0);
        // dd($id, $businessID);
        if(!$this->check($businessID, $this->roles)){
            return response(['error' => 'Manager permission error'], 500);
        }

        $administrator = Administrator::where(["id" => $id])->firstOrFail();
        $slot = BusinessBilling::where('business_id', $businessID)
                                ->where('user_id', $administrator->user_id)->first();
        if($slot)
        {
            $slot->user_id = null;
            $slot->save();
        }
        $administrator->delete();
        return response(['removed' => $administrator->id]);
    }

    public function setLocations(Request $request, $id){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $businessID = (int)$request->input('business_id', 0);

        if(!$this->check($businessID, $this->roles)){
            return response(['error' => 'Manager permission error'], 500);
        }

        $administrator = Administrator::where(["id" => $id])->firstOrFail();

        if($administrator === null){
            return response(['error' => 'Manager error'], 500);
        }

        $locations = $request->input('locations', []);
        ManagerLocation::where(["administrator_id" => $id])->delete();
        if(!empty($locations)){
            $dataInsert = [];
            foreach ($locations as $location) {
                $dataInsert[] = array(
                    'administrator_id' => $id,
                    'location_id' => $location
                );
            }
            $managerLocation = new ManagerLocation();
            $managerLocation->insert($dataInsert);
        }

        return response(['data' => ["status" => 200]], 200);
    }

    public function resendInvite(Request $request) {
        $admin = Administrator::findOrFail($request->input('admin_id'));
        $user = $admin->user()->first();
        $business = $admin->business()->first();
        $user_auth = Auth::User();
        Mail::to($request->input('email'))->queue(new \App\Mail\ManagerInvitation($user, $user_auth, $business, 'INVITE', auth()->user()->language_prefix));
        return response(['status' => 'ok']);
    }

    private function check($businessID, $roles){
        $user = Auth::User();

        if (!$business = Business::where('id', $businessID)->first()) {
            return false;
        }

        $administrator_query = Administrator::query();
        $administrator_query->where('user_id', $user->id);

        if ($business->parent_id) { // if it is a brand then check main business as well
            $administrator_query->whereIn('business_id', [$business->id, $business->parent_id]);
        } else {
            $administrator_query->where('business_id', $business->id);
        }

        $administrator_query->where(function($where)use($roles) {
            $where->orWhere('role', \App\Business\Administrator::ADMIN_ROLE);
            $where->orWhereIn('role', $roles);
        });

        if ($administrator_query->first()) {
            return true;
        }

        return false;
    }
}
