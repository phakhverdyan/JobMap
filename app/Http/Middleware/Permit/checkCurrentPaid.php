<?php

namespace App\Http\Middleware\Permit;

use App\Business\BusinessBilling;
use App\Business\BusinessBillingPlan;
use App\Business\Administrator;
use Carbon\Carbon;
use App\GraphQL\Auth;
use Closure;

class checkCurrentPaid
{
    use Auth;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->authorize([],[]);
        $businessId = $request->cookie('business-id');
        $admin = Administrator::where('user_id', $this->auth->id)
        ->where('business_id', $businessId)
        ->first();
        if (!$admin)
        {
            return redirect('/business/candidate/manage');
        }
        else {
            if ($admin->role != 'manager')
            {
                $created = new Carbon($admin->created_at);
                $trial_days = 30 - $created->diff(Carbon::now())->days;
                if ($trial_days <= 0 )
                {
                    $paid = BusinessBilling::where('business_id', $businessId)
                    ->where('user_id',$this->auth->id)
                    ->where('status','active')
                    ->first();

                    if (!$paid && $request->path() !== "business/candidate/manage") {
                        return redirect('/business/candidate/manage');
                    }
                }
                return $next($request);
            }
            else {
                $paid = BusinessBilling::where('business_id', $businessId)
                ->where('user_id',$this->auth->id)
                ->where('status','active')
                ->first();
                if (!$paid) {
                    return redirect('/business/job/manage');
                }
                return $next($request);
            }
        }
    }
}
