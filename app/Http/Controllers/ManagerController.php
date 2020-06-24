<?php

namespace App\Http\Controllers;

use App\Business\Administrator;
use App\Business\BusinessBilling;
use App\Business\BusinessBillingInvoice;
use App\Business\BusinessCustomerBilling;
use App\Business\Department;
use App\Business\DepartmentLocation;
use App\Business\Job;
use App\Business\JobCareerLevel;
use App\Business\JobCertificate;
use App\Business\JobDepartment;
use App\Business\JobLanguage;
use App\Business\JobLocation;
use App\Business\Location;
use App\Business\ManagerLocation;
use App\Business\Permit;
use App\Tax;
use App\CareerLevel;
use App\Certificate;
use App\JobCategory;
use App\Jobs\JobAutoExpiredContinued;
use App\Mail\UserNotifications;
use App\User;
use App\WorldLanguage;
use Carbon\Carbon;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;
use App\Business;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Validator;
use Auth;
use Illuminate\Support\Facades\Storage;

class ManagerController extends Controller
{
    public function index(Request $request)
    {
    	if (!auth()->check()) {
    		return view('manager.landing');
    	}

    	$last_business_id = (int) $request->cookie('last-business-id', '0');
    	$user = auth()->user();
    	$business_query = Business::select('businesses.*');

    	$business_query->join('business_administrators', function($join) {
    		$join->on('business_administrators.business_id', '=', 'businesses.id');
    	});

    	$business_query->where('business_administrators.user_id', $user->id);
    	// $business_query->where('business_administrators.role', 'admin');
    	$business_query->where('businesses.parent_id', null);
    	$businesses = $business_query->get();
    	
    	if (!$business = $businesses->where('id', $last_business_id)->first()) {
    		if (!$business = $businesses->first()) {
    			return 'You do not have any business';
    		}
    	}

    	// dd($user->image_200x200_url);

    	return view('manager.main', [
    		'user' => $user,
    		'business' => $business,
    		'businesses' => $businesses,
    	]);
    }

    public function logoutPage()
    {
    	return view('manager.logout_page');
    }

    public function logout(Request $request)
    {
    	\Cookie::queue(\Cookie::forget('api-token'));

    	return redirect('/manager/logout_page');
    }

    public function switchBusiness(Request $request, $business_id)
    {
    	if (!auth()->check()) {
    		return redirect('/manager');
    	}

    	$user = auth()->user();
    	$business_query = Business::select('businesses.*');

    	$business_query->join('business_administrators', function($join) {
    		$join->on('business_administrators.business_id', '=', 'businesses.id');
    	});

    	$business_query->where('business_administrators.user_id', $user->id);
    	// $business_query->where('business_administrators.role', 'admin');
    	$business_query->where('businesses.parent_id', null);
    	$business_query->where('businesses.id', $business_id);
    	
    	if ($business = $business_query->first()) {
    		\Cookie::queue(\Cookie::forever('last-business-id', $business->id));
    	}

    	return redirect('/manager');
	}
	
	public function billingPage(Request $request) 
    {
        $business_id = $request->cookie('business-id');
        $current_manager = Administrator::where('user_id', auth()->user()->id)->where('business_id', $business_id)->first();
        if ($current_manager->role != 'manager')
        {
			
			$customer = \App\Business\BusinessCustomerBilling::where('user_id', auth()->user()->id)
							->first();
			$subscriptions = \App\Business\BusinessBilling::where('business_id', $business_id)
							->where('user_paid_id', auth()->user()->id)
							->groupBy(DB::raw('subscription_id, plan_id'))
							->pluck('subscription_id')
							->toArray();
			$upcomong = null;
			$invoices = null;
			$cards = null;
			if ($customer) {
				$upcoming = [];
				\Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
				foreach ($subscriptions as $item) {
					try {
					$upcoming[] = \Stripe\Invoice::upcoming([ //'customer' => $customer->customer_id,
						'subscription' => $item]);
					} catch (\Exception $e) {
					}
				}
				$upcoming = collect($upcoming)->sortByDesc('period_start');
				try {
					$invoices = BusinessBillingInvoice::where(['customer_id' => $customer->customer_id])
						->limit(10)
						->orderBy('period_end','DESC')
						->get();
				}
				catch (\Exception $e) {
					$invoices = null;
				}
				try {
					$cards = \App\Business\Card::where('user_id',$customer->user_id)->get();
				}
				catch (\Exception $e) {
					$cards = null;
				}
			}
			$tax = Tax::where('province_en', auth()->user()->region)->first();
			$slots =  BusinessBilling::where('business_id', $business_id)
						->join('business_billing_plans as bp','business_billings.plan_id','=','bp.id')
						->groupBy(DB::raw('business_billings.plan_id'))
						->select(DB::raw('count(business_billings.id) as counter, descriptor, sum(amount), bp.id as plan_id'))
						->where('business_billings.status','active')
						->get();
			$plans = BusinessBilling::where('business_id', $business_id)
						->join('business_billing_plans as bp','business_billings.plan_id','=','bp.id')
						->groupBy('bp.plan_id')
						->select(DB::raw('count(bp.id) DIV bp.quantity as counter, descriptor, bp.status, amount, business_billings.status as subscription_status, bp.id as plan_id'))
						->get();
			$users = Administrator::where('business_administrators.business_id', $business_id)
						->join('users as u', 'u.id','=','business_administrators.user_id')
						->leftJoin('business_billings as bb','business_administrators.user_id','=','bb.user_id')
						->select(DB::raw('*, u.id as _id, bb.id as id_bb,business_administrators.id as administrator_id'))
						->get();
			// $failed_invoices = collect($invoices->data)->where('paid', false);
			$failed_invoices = $invoices->where('paid', false);
		}
		else {
			$locations = ManagerLocation::where('administrator_id', $current_manager->id)->pluck('location_id')->toArray();
			$users = Administrator::where('business_administrators.business_id', $business_id)
			->join('business_manager_locations as bml','business_administrators.id','=','bml.administrator_id')
			->join('users as u', 'u.id','=','business_administrators.user_id')
			->leftJoin('business_billings as bb','business_administrators.user_id','=','bb.user_id')
			->whereIn('bml.location_id', $locations)
			->select(DB::raw('*,  u.id as id, bb.id as id_bb, business_administrators.id as administrator_id'))
			->get();
			$admin = Administrator::where('business_administrators.business_id', $business_id)->where('role', 'admin')->first();
			if ($admin)
			{
				$users = $users->merge($admin);
			}
		}
		$view = 'business.manage.manager';
		if($request->is('*/refresh')) $view = 'business.manage.billing_refresh';

		return view($view, [
			'customer_id' 		=> $customer_id ?? null,
			'plans'       		=> $plans ?? null,
			'tax'				=> $tax ?? null,
			'upcoming'			=> $upcoming  ?? null,
			'invoices'			=> $invoices ?? null,
			'cards'				=> $cards ?? null,
			'users'       		=> $users,
			'slots'				=> $slots ?? null,
			'failed_invoices'	=> $failed_invoices ?? null,
			'slots_count'		=> BusinessBilling::where('business_id', $business_id)->where('status','active')->count(),
			'current_user_role' => $current_manager->role
		]);
        
    }
}
