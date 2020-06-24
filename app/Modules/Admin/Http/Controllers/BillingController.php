<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Bmic;
use App\Business;
use App\Business\Billing;
use App\Business\BillingAddress;
use App\Flagship;
use App\Jobs\CancelBilling;
use App\MonthlyPlan;
use App\User;
use Carbon\Carbon;
use Cartalyst\Stripe\Stripe;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;

use App\Modules\Admin\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{


    public function index()
    {

        $filter = request()->all();
        $coupons = DB::table('discounts')->get();

        $status['paid'] = DB::table('billings')
            ->select(DB::raw('count(*) as count, status'))
            ->where('status', '=', 'paid')
            ->groupBy('status')
            ->first();


        $status['unpaid'] = DB::table('billings')
            ->select(DB::raw('count(*) as count, status'))
            ->where('status', '=', 'unpaid')
            ->groupBy('status')
            ->first();

        $query = DB::table('billings')
            ->select('billings.status',
                'billings.total',
                'billings.id',
                'billings.client_id',
                'billings.charge_id',
                'billings.created_at',
                'billings.coupon_id',
                'billings.invoice_id',
                'billings.current',
                DB::raw('users.first_name as client_name'),
                DB::raw('businesses.name as business_name'),
                DB::raw('discounts.name as discounts_name')
            );

        if (count($filter)) {
            $query = $this->composeConditions($query, $filter);
        }
        $conditions = $query->leftJoin('users', 'users.id', '=', 'billings.client_id')
            ->leftJoin('businesses', 'businesses.id', '=', 'billings.business_id')
            ->leftJoin('discounts', 'discounts.id', '=', 'billings.coupon_id');

        if (isset($filter['ordered-name'])) {
            $conditions = $this->composeOrdered($query, $filter['ordered-name'], $filter['ordered-direction']);
        }

        $billings = $conditions->paginate(15)
            ->appends(request()->query());

        return view('admin::billing.index', compact('billings', 'status', 'coupons'));
    }

    public function composeConditions($query, $filter)
    {
        if (isset($filter['filter_status'])) {
            $query->where('billings.status', '=', $filter['filter_status']);
        }

        if (isset($filter['invoice_id'])) {
            $query->where('billings.invoice_id', '=', $filter['invoice_id']);
        }

        if (isset($filter['client_s'])) {
            $query->where('users.id', '=', $filter['client_s'])->orWhere('users.first_name', 'like', '%' . $filter['client_s'] . '%')->orWhere('businesses.name', 'like', '%' . $filter['client_s'] . '%');
        }

        if (isset($filter['coupon_id'])) {
            $query->where('discounts.id', '=', $filter['coupon_id']);
        }
        return $query;
    }

    public function composeOrdered($query, $ordered, $direction)
    {
        if ($ordered == 'client-id') {
            $query->orderBy('billings.client_id', $direction);
        }
        if ($ordered == 'client-name') {
            $query->orderBy('client_name', $direction);
        }
        if ($ordered == 'business-name') {
            $query->orderBy('business_name', $direction);
        }
        if ($ordered == 'charge_id') {
            $query->orderBy('billings.invoice_id', $direction);
        }
        if ($ordered == 'total') {
            $query->orderBy('billings.total', $direction);
        }
        if ($ordered == 'date') {
            $query->orderBy('billings.created_at', $direction);
        }
        if ($ordered == 'coupon') {
            $query->orderBy('discounts_name', $direction);
        }
        return $query;
    }

    public function invoice($id)
    {
        $data['invoice'] = DB::table('billings')
            ->select(
                'billings.id',
                'billings.invoice_id',
                'billings.business_id',
                'billings.charge_id',
                'billings.balance_transaction',
                'billings.plan_id',
                'billings.package_id',
                'billings.status',
                'billings.total',
                'billings.coupon_id',
                'billings.company_name',
                'billings.city',
                'billings.region',
                'billings.country',
                'billings.zip_code',
                'businesses.country_code',
                'billings.street',
                'billings.street_number',
                'billings.suite',
                'billings.owner_name',
                'billings.price',
                'billings.applicants',
                'billings.payment_info',
                'businesses.phone_code',
                'businesses.phone',
                'businesses.picture',
                DB::raw("DATE_FORMAT(billings.created_at, '%Y-%m-%d') as created_at")
            )
            ->leftJoin('businesses', 'businesses.id', '=', 'billings.business_id')
            ->where('billings.charge_id', '=', $id)
            ->first();

        $data['tax'] = DB::table('nexus_initial_tax_config')->first();
        if ($data['invoice']->country === 'Canada') {
            $data['taxes'] = DB::table('taxes')->where('province_en', '=', $data['invoice']->region)->first();
        }
        $data['billingAddress'] = BillingAddress::query()->where('business_id', '=', $data['invoice']->business_id)->first();
        $data['bmic'] = Bmic::query()->where('country_code', '=', $data['billingAddress']->country_code)->first();

        $data['flagship'] = Flagship::query()->first();
        $data['payment_info'] = unserialize($data['invoice']->payment_info, ['allowed_classes' => true]);


        return view('admin::billing.invoice', $data);
    }

    public function cancel($id)
    {
        $invoice = Billing::query()->where('id', '=', $id)->first();
        $invoice->is_canceled = 1;
        $invoice->save();

        $business = Business::query()->where('id', '=', $invoice->business_id)->first();
        $jobs = DB::table('jobs')->where('id', '=', $business->job_id)->first();

        $queue = [
            'business_id' => $invoice->business_id,
        ];

        $time = $jobs->available_at - time();
        $job = (new CancelBilling($queue))->delay($time);
        $jobId = app(Dispatcher::class)->dispatch($job);
        $business->job_id = $jobId;

        $business->save();
        DB::table('jobs')->where('id', '=', $business->job_id)->delete();
    }

    public function refund($id)
    {
        $invoice = Billing::query()->where('id', '=', $id)->first();
        $business = Business::query()->where('id', '=', $invoice->business_id)->first();
        if ($business->job_id > 0) {
            DB::table('jobs')->where('id', '=', $business->job_id)->delete();
            $monthlyPlan = MonthlyPlan::query()->where('id', '=', $business->plan_id)->first();
            $monthlyPlanFree = MonthlyPlan::query()->where('price', '=', '0')->first();
            $business->plan_id = 0;
            $business->job_id = 0;
            $business->applicants = (int)$business->applicants - (int)$monthlyPlan->applicants + (int)$monthlyPlanFree->applicants;
            $business->save();
            $invoice->current = 0;
            $invoice->save();

            $user = User::query()
                ->join('business_administrators', 'business_administrators.user_id', '=', 'users.id')
                ->where('business_administrators.business_id', '=', $invoice->business_id)
                ->where('business_administrators.role', '=', 'admin')
                ->first();

            $stripe = new Stripe(config('services.stripe.secret'));
            $refund = $stripe->refunds()->create($invoice->charge_id);

            $data = new Billing();
            $data->business_id = $invoice->business_id;
            $data->client_id = $user->user_id;
            $data->charge_id = $refund['id'];
            $data->balance_transaction = '';
            $data->plan_id = $invoice->plan_id;
            $data->package_id = 0;
            $data->status = 'refund';
            $data->total = $invoice->total;
            $data->coupon_id = $invoice->coupon_id;
            $data->company_name = $invoice->company_name;
            $data->owner_name = $invoice->owner_name;
            $data->street_number = $invoice->street_number;
            $data->street = $invoice->street;
            $data->suite = $invoice->suite;
            $data->region = $invoice->region;
            $data->city = $invoice->city;
            $data->zip_code = $invoice->zip_code;
            $data->country = $invoice->country;
            $data->card_id = $invoice->card_id;
            $data->current = 0;
            $data->invoice_id = 'RE-' . str_pad($invoice->id, 8, "0", STR_PAD_LEFT);
            $data->save();


        }

    }


}
