<?php

namespace App\Http\Middleware\Permit;

use App\Business\Administrator;
use App\Business\Department;
use App\GraphQL\Auth;

class CheckDepartments
{
    use Auth;

    public function handle($request, \Closure $next)
    {
        $businessId = $request->cookie('business-id');
        $this->authorize([],[]);

        $departmentId = $request->id;
        if ($departmentId && $department=Department::find($departmentId)) {
            $businessId = $department->business_id;
        }

        if ($businessId) {

            if (!$this->checkBusinessAccess($businessId,[ Administrator::MANAGER_ROLE, Administrator::FRANCHISE_ROLE ], [ 'departments' ])) {
                return redirect('/business/candidate/manage');
                //return redirect('/');
            }
        }


        return $next($request);
    }
}
