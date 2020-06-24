<?php

namespace App\Http\Controllers\JobMap;

use App\Http\Controllers\Controller;
use App\Business;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index($letter = null)
    {
        $businesses = Business::query()
            ->orderBy('name', 'asc')
            ->get()->all();
        
        $newData = array();
        $def = '';
        foreach ($businesses as $business) {
            $l = strtoupper(substr($business['name'], 0, 1));
            if ($l != $def) {
                $newData[] = $l;
                $def = $l;
            }
        }
        
        if ($letter) {
            $businessByLetter = Business::query()
                ->where('name', 'like', $letter . '%')
                ->get()->all();
            
            return view('common.jobmap.explore_employers_in_letter', [
                'letters' => $newData,
                'current' => $letter,
                'businessByLetter' => $businessByLetter
            ]);
        } else {
            $businessesAll = Business::query()
                ->orderBy('created_at', 'desc')
                ->paginate(60);
            
            return view('common.jobmap.explore_employers', [
                'letters' => $newData,
                'all' => $businessesAll
            ]);
        }
    }
}
