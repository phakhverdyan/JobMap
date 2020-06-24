<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Modules\Admin\Http\Controllers\Controller;

class MapAssociateController extends Controller
{
    public function index()
    {
        return view('admin::map-associate.index');
    }
}
