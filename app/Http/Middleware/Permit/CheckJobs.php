<?php

namespace App\Http\Middleware\Permit;

use App\Business\Administrator;
use App\Business\Job;
use App\GraphQL\Auth;

class CheckJobs
{
    use Auth;

    public function handle($request, \Closure $next)
    {
        $businessId = $request->cookie('business-id');
        $this->authorize([],[]);

        $jobId = $request->id;
        if ($jobId && $job=Job::find($jobId)) {
            $businessId = $job->business_id;
        }

        if ($businessId) {

            if (!$this->checkBusinessAccess($businessId,[ Administrator::MANAGER_ROLE, Administrator::FRANCHISE_ROLE ], [ 'jobs' ])) {
                return redirect('/business/candidate/manage');
                //return redirect('/');
            }
        }

        return $next($request);
    }
}
