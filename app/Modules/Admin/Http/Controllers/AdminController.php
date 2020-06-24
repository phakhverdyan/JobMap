<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Admin\Models\AdminRole;
use App\Modules\Admin\Models\AdminUser;
use Illuminate\Http\Request;
use Auth;
use App\Modules\Admin\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class AdminController extends Controller
{


    public function index()
    {

        $admins = AdminUser::with(['roles'])->get();

        return view('admin::admins.index', compact('admins'));
    }

    public function store()
    {
        $this->validate(request(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = request()->all();

        $data['password'] = bcrypt($data['password']);

        $user = AdminUser::create($data);

        $role = AdminRole::where('name', request()->get('role'))->first();

        $user->attachRole($role);

        return redirect('/nexus/admins');
    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}
