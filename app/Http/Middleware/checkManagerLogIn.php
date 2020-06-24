<?php

namespace App\Http\Middleware;
use App\Business\Administrator;
use App\GraphQL\Auth;
use Closure;

class checkManagerLogIn
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
        
        $businessId = $request->cookie('business_id');

        $manager = Administrator::where('business_administrators.business_id', $businessId)
        ->where('business_administrators.user_id', $this->auth->id)
        ->where('role','manager')
        ->join('business_billings', 'business_billings.user_id', '=','business_administrators.user_id')
        ->first();
        if ($manager)
        {
            if ($manager->status != 'active')
            return redirect('/manager_blocked');
        }
        return redirect($request->url());
    }
}
