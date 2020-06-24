<?php

namespace App\Http\Controllers\Api;

use App\Business;
use App\Business\Administrator;
use App\Business\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Business\DepartmentLocation;
use App\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller
{
    private $roles = [
        Administrator::MANAGER_ROLE,
        Administrator::FRANCHISE_ROLE
    ];

    public function get(Request $request, $id){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $businessID = (int)$request->input('business_id', 0);

        if(!$this->check($businessID, $this->roles)){
            return response(['error' => 'Department permission error'], 500);
        }

        $department = Department::where("id", $id)->firstOrFail();
        if(!empty($department)){
            $data['department'] = $department;
            $data['locations'] = DepartmentLocation::where(['department_id' => $id])->get();
            return response(['data' => $data], 200);
        }
        return response([ 'error' => 'Department error'], 500);
    }

    public function create(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required_without:name_fr',
            'name_fr' => 'required_without:name',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => "validation", 'validator' => $validator->errors()]);
        }

        $businessID = (int)$request->input('business_id', 0);

        if(!$this->check($businessID, $this->roles)){
            return response(['error' => 'Department permission error'], 500);
        }

        $user_auth = Auth::User();

        $department = new Department();
        $department->business_id = $businessID;
        $department->user_id = $user_auth->id;
        $department->name = $request->input('name', "");
        $department->name_fr = $request->input('name_fr', "");
        $department->status = $request->input('status', "");
        $department->save();

        $locations = $request->input('locations', []);
        if(!empty($locations)){
            $dataInsert = [];
            foreach ($locations as $location) {
                $dataInsert[] = array(
                    'department_id' => $department->id,
                    'location_id' => $location
                );
            }
            $departmentLocation = new DepartmentLocation();
            $departmentLocation->insert($dataInsert);
        }

        return response(['data' => ["status" => 200]], 200);
    }

    public function update(Request $request, $id){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required_without:name_fr',
            'name_fr' => 'required_without:name',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => "validation", 'validator' => $validator->errors()]);
        }

        $businessID = (int)$request->input('business_id', 0);

        if(!$this->check($businessID, $this->roles)){
            return response(['error' => 'Department permission error'], 500);
        }

        $department = Department::where(['id' => $id, 'business_id' => $businessID])->first();

        if($department === null){
            return response(['error' => 'Department error'], 500);
        }

        $department->name = $request->input('name', "");
        $department->name_fr = $request->input('name_fr', "");
        $department->status = $request->input('status', "");
        $department->save();

        $locations = $request->input('locations', []);
        if(!empty($locations)){
            DepartmentLocation::where(['department_id' => $id])->delete();
            $dataInsert = [];
            foreach ($locations as $location) {
                $dataInsert[] = array(
                    'department_id' => $id,
                    'location_id' => $location
                );
            }
            $departmentLocation = new DepartmentLocation();
            $departmentLocation->insert($dataInsert);
        }

        return response(['data' => ["status" => 200]], 200);
    }

    public function setLocations(Request $request, $id){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $businessID = (int)$request->input('business_id', 0);

        if(!$this->check($businessID, $this->roles)){
            return response(['error' => 'Department permission error'], 500);
        }

        $department = Department::where(['id' => $id, 'business_id' => $businessID])->firstOrFail();

        if($department === null){
            return response(['error' => 'Department error'], 500);
        }

        $locations = $request->input('locations', []);
        if(!empty($locations)){
            DepartmentLocation::where(['department_id' => $id])->delete();
            $dataInsert = [];
            foreach ($locations as $location) {
                $dataInsert[] = array(
                    'department_id' => $id,
                    'location_id' => $location
                );
            }
            $departmentLocation = new DepartmentLocation();
            $departmentLocation->insert($dataInsert);
        }

        return response(['data' => ["status" => 200]], 200);
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
