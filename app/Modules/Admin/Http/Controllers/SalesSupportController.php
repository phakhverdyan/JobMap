<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Modules\Admin\Http\Controllers\Controller;

class SalesSupportController extends Controller
{
    public function index()
    {
        return view('admin::sales-support.index');
    }
}
