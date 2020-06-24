<?php

namespace App\Http\Middleware\Permit;

use App\Business\Administrator;
use App\Business\BusinessBilling;
use App\GraphQL\Auth;

class CheckManagerSlotAvailable
{
    use Auth;

    public function handle($request, \Closure $next)
    {
        $businessId = $request->cookie('business-id');
        $this->authorize([],[]);

        $adminId = $request->id;
        if ($adminId && $admin=Administrator::find($adminId)) {
            $businessId = $admin->business_id;
        }

        if ($businessId) {
            $slotsQuery = BusinessBilling::whereNull('user_id')->where('business_id', $businessId)->where('status','active');    
            $countEmptySlots = $slotsQuery->count();

            if ($countEmptySlots <= 0)
            return redirect('/business/candidate/manage');
        }

        return $next($request);
    }
}