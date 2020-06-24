<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Admin\Models\AdminRole;
use App\Modules\Admin\Models\AdminUser;
use App\Modules\Admin\Models\Department;
use Illuminate\Http\Request;

//use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class AgentController extends Controller
{
    protected $role = 'agent';

    public function index()
    {
        $filter = request()->all();

        $departments = Department::all();

        $query = AdminUser::whereHas('roles', function ($q){
            $q->where('name', $this->role);
        });

        if(!empty($filter['agent'])){
            $query->where('name', 'like',  '%'.$filter['agent'].'%')
                    ->orWhere('last_name', 'like',  '%'.$filter['agent'].'%')
                    ->orWhere('first_name', 'like',  '%'.$filter['agent'].'%');
        }
        $agents = $query->get();

        foreach ( $agents as $agent){
            $agent['departments'] = $agent->departments()->get();
            $agent['closed_count_tickets'] = $agent->tickets()->where('status', 'like', '%Closed%')->groupBy('admin_user_id')->count();
            $agent['open_count_tickets'] = $agent->tickets()->where('status', 'like', '%Open%')->groupBy('admin_user_id')->count();
        }

        if(!empty($filter['department'])){
            $filtered = $agents->filter(function ($agent) use ($filter) {
                foreach ($agent->departments as $department){
                    if ($department->id == $filter['department']){
                        return $agent;
                    }
                };
            });
            $agents = $filtered->all();
        }

        return view('admin::agent.index', compact('agents', 'departments'));
    }

    public function store()
    {
        $data = request()->all();

        $role = AdminRole::where('name', $this->role)->first();

        $data['password'] = bcrypt($data['password']);

        $user = AdminUser::create($data);

        $user->attachRole($role);

        $user->departments()->toggle($data['departments']);

        return redirect()->back();
    }

    public function update(AdminUser $agent){
        $data = request()->all();

        $agent->departments()->detach();

        $agent->update($data);

        $agent->departments()->toggle($data['departments']);

        return response()->json('ok', 200);
    }

    public function show(AdminUser $agent)
    {
        $agent = $agent->load('departments');

        return response()->json($agent);
    }

    public function delete($id)
    {
        $agent = AdminUser::find($id);
        $agent->delete();

        return redirect()->back();
    }
}
