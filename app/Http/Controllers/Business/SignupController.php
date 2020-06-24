<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SignupController extends Controller
{
    /**
     * Create business
     *
     * @return view
     */
    public function create()
    {
        return view('business.signup', [
            'default_language' => app()->getLocale()
        ]);
    }
}
