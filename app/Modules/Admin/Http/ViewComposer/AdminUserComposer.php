<?php


namespace App\Modules\Admin\Http\ViewComposer;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminUserComposer
{

    protected $adminUser;

    public function __construct()
    {
//        dd(Auth::guard('adminUser')->user());
        $this->adminUser = Auth::guard('adminUser')->user();

    }

    public function compose(View $view)
    {
        $view->with('adminUser', $this->adminUser);
    }
}