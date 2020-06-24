<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Cartalyst\Stripe\Stripe;

class MonthlyPlanController extends Controller
{
    public function index()
    {
        $monthly_plans = DB::table('monthly_plans')->orderBy('order', 'asc')->get();
        $addon_packages = DB::table('addon_packages')->orderBy('order', 'asc')->get();
        return view('admin::monthly-plan.index', compact('monthly_plans', 'addon_packages'));
    }



    public function update()
    {
        if (request()->input('monthly_price')) {
            $this->updateOrCreateMonthlyPlan(request());
        }
        if (request()->input('package_price')) {
            $this->updateOrCreateAddonPackage(request());
        }
        return redirect()->back();
    }

    public function updateOrCreateMonthlyPlan(Request $request)
    {
        $this->validate(request(), [
            "monthly_price" => 'required|array',
            "monthly_price.*" => 'required|numeric',
            "monthly_plan_name" => 'required|array',
            "monthly_plan_name.*" => 'required',
        ]);
        $monthly_id = request('monthly_id');
        $monthly_order = request('monthly_order');
        $monthly_applicants = request('monthly_applicants');
        $monthly_price = request('monthly_price');
        $monthly_plan_name = request('monthly_plan_name');

//        $monthly_plan_id = request('monthly_plan_id');

        $plans_count = count($monthly_price);

        for ($i = 0; $i < $plans_count; $i++) {

            $query = DB::table('monthly_plans');

            if (isset($monthly_id[$i])) {
                $monthly_status = request('monthly_status');
                $query->where('id', $monthly_id[$i])
                    ->update([
                        'order' => $monthly_order[$i],
                        'applicants' => $monthly_applicants[$i],
                        'price' => $monthly_price[$i],
                        'plan_name' => $monthly_plan_name[$i],
                        'status' => $monthly_status[$i],
                    ]);
            } else {
                $query->insert([
                    'applicants' => $monthly_applicants[$i],
                    'price' => $monthly_price[$i],
                    'plan_name' => $monthly_plan_name[$i],
                ]);
            }
        }
    }

    public function updateOrCreateAddonPackage(Request $request)
    {
        $this->validate(request(), [
            "package_price" => 'required|array',
            "package_price.*" => 'required|numeric',
            "package_plan_name" => 'required|array',
            "package_plan_name.*" => 'required',
        ]);
        $package_id = request('package_id');
        $package_order = request('package_order');
        $package_applicants = request('package_applicants');
        $package_price = request('package_price');
        $package_plan_name = request('package_plan_name');

        $plans_count = count($package_price);
        for ($i = 0; $i < $plans_count; $i++) {
            $query = DB::table('addon_packages');
            if (isset($package_id[$i])) {
                $package_status = request('package_status');
                $query->update([
                    'order' => $package_order[$i],
                    'applicants' => $package_applicants[$i],
                    'price' => $package_price[$i],
                    'plan_name' => $package_plan_name[$i],
                    'status' => $package_status[$i],
                ]);
            } else {
                $query->insert([
                    'applicants' => $package_applicants[$i],
                    'price' => $package_price[$i],
                    'plan_name' => $package_plan_name[$i],
                ]);
            }

        }
    }

    public function deleteMothlyPlan($id)
    {

//        $plan = DB::table('monthly_plans')->where('id', $id)->first();
//        $stripe = new Stripe(config('services.stripe.secret'));
//        $stripe->plans()->delete($plan->plan_id);
        DB::table('monthly_plans')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function deleteAddonPackage($id)
    {
        DB::table('addon_packages')->where('id', $id)->delete();

        return redirect()->back();
    }

    public function sortedMothlyPlan()
    {
        $sorts = request('order');
        $i = 0;
        foreach ($sorts as $value) {
            DB::table('monthly_plans')
                ->where('id', $value)
                ->update([
                    'order' => $i,
                ]);
            $i++;
        }
        return response()->json('ok');
    }

    public function sortedAddonPackage()
    {
        $sorts = request('order');
        $i = 0;
        foreach ($sorts as $value) {
            DB::table('addon_packages')
                ->where('id', $value)
                ->update([
                    'order' => $i,
                ]);
            $i++;
        }
        return response()->json('ok');
    }

}
