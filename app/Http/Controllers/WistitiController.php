<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\Business\JobLocation;
use App\Candidate\Candidate;

class WistitiController extends Controller
{
    public function businesses(Request $request)
    {
    	if ($request->input('password') != 'nonono') {
    		abort(404);
    	}

    	$business_query = Business::query();
    	$business_query->with('admin');
    	$business_query->orderBy('id', 'desc');
    	$businesses = $business_query->paginate(20)->appends(request()->input());

    	return view('wistiti.businesses', [
    		'businesses' => $businesses,
    	]);
    }

    public function applicants(Request $request)
    {
        if ($request->input('password') != 'nonono') {
            abort(404);
        }

        $total_count_of_jobs = JobLocation::count();
        $count_of_jobs_on_google = JobLocation::where('google_jobs_notified', 1)->count();
        $candidate_query = Candidate::query();

        $candidate_query->with([
            'user',
            'business',
            'location',
            'user_video',
        ]);

        $candidate_query->orderBy('id', 'desc');
        $candidates = $candidate_query->paginate(20)->appends(request()->input());

        return view('wistiti.candidates', [
            'total_count_of_jobs' => $total_count_of_jobs,
            'count_of_jobs_on_google' => $count_of_jobs_on_google,
            'candidates' => $candidates,
        ]);
    }
}
