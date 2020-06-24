<?php

namespace App\Jobs;

use App\AddonPackage;
use App\Bmic;
use App\Business\Billing;
use App\Business;
use App\Business\BillingAddress;
use App\Business\Card;
use App\Business\Discount;
use App\Coupon;
use App\Flagship;
use App\Mail\BillingError;
use App\MonthlyPlan;
use App\Tax;
use App\User;
use Carbon\Carbon;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Mail;

class ProcessBilling implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    public $attempts;
    public $tries = 1;
    public $timeout = 120;

    /**
     * Create a new job instance.
     *
     * @param $data
     * @param $attempts
     */
    public function __construct($data, $attempts)
    {
        $this->attempts = $attempts;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @param Billing $billing
     * @return void
     */
    public function handle()
    {
        $CANDIDATES_COUNT_PER_STEP = 100;
        $PRICE_PER_CANDIDATE = 0.25;

        $get_next_payment_date = function($last_payment_date, $first_payment_date, $plan_type) {
            $some_day_of_next_date_month = (new \DateTime)->setDate(
                $last_payment_date->format('Y'),
                $last_payment_date->format('m'),
                1
            )->modify($plan_type == 'year' ? '+1 year' : '+1 month');

            $next_date = (new \DateTime)->setDate(
                $some_day_of_next_date_month->format('Y'),
                $some_day_of_next_date_month->format('m'),
                $first_payment_date->format('d')
            );

            while ($next_date->format('m') != $some_day_of_next_date_month->format('m')) {
                $next_date = $next_date->modify('-1 day');
            }

            return $next_date;
        };

        $payment_info = [];
        $business = Business::where('id', $this->data['business_id'])->first();

        if ($business->next_plan_id > 0) {
            $business->plan_id = $business->next_plan_id;
            $business->next_plan_id = 0;
        }
        elseif ($business->next_plan_id < 0) {
            $business->plan_id = 0;
            $business->next_plan_id = 0;
        }
        
        $current_payment_date = $get_next_payment_date(
            $business->plan_id ? $business->last_plan_payment_was_at : new \DateTime,
            $business->plan_id ? $business->first_plan_payment_was_at : new \DateTime,
            $business->plan_type
        );

        $next_payment_date = $get_next_payment_date(
            $business->plan_id ? $current_payment_date : new \DateTime,
            $business->plan_id ? $business->first_plan_payment_was_at : new \DateTime,
            $business->next_plan_type
        );

        $business->plan_type = $business->next_plan_type;
        $billingAddress = BillingAddress::where('business_id', $this->data['business_id'])->first();

        if ($billingAddress) {
            $bmic = Bmic::where('country_code', $billingAddress->country_code)->first();
        }
        else {
            $bmic = null;
        }

        $flagship = Flagship::first();

        $user = User::query()
            ->join('business_administrators', 'business_administrators.user_id', '=', 'users.id')
            ->where('business_administrators.business_id', '=', $this->data['business_id'])
            ->where('business_administrators.role', '=', 'admin')
            ->first();

        $card = Card::query()
            ->where('is_default', '=', 1)
            ->where('business_id', '=', $this->data['business_id'])
            ->first();

        if ($bmic && $flagship) {
            $coefficient = isset($bmic->coefficient) ? $bmic->coefficient / $flagship->coefficient : 1;
        }
        else {
            $coefficient = 1.0;
        }

        if ($business->plan_type == 'year') {
            $amount = ($business->plan_id * $CANDIDATES_COUNT_PER_STEP * $PRICE_PER_CANDIDATE * 12 * 0.9) * $coefficient;
        }
        else {            
            $amount = ($business->plan_id * $CANDIDATES_COUNT_PER_STEP * $PRICE_PER_CANDIDATE) * $coefficient;
        }

        $payment_info['coefficient'] = $coefficient;
        $payment_info['bmic'] = $bmic ? $bmic->coefficient : 1.0;
        $payment_info['flagship'] = $flagship ? $flagship->coefficient : 1.0;

        if ($business->plan_type == 'year') {
            $payment_info['plan_price'] = ($business->plan_id * $CANDIDATES_COUNT_PER_STEP * $PRICE_PER_CANDIDATE * 12 * 0.9);
        }
        else {
            $payment_info['plan_price'] = ($business->plan_id * $CANDIDATES_COUNT_PER_STEP * $PRICE_PER_CANDIDATE);
        }

        $payment_info['plan_name'] = ($business->plan_id * $CANDIDATES_COUNT_PER_STEP) . ' applicants';
        $payment_info['plan_applicants'] = $business->plan_id * $CANDIDATES_COUNT_PER_STEP;
        $payment_info['plan_id'] = $business->plan_id;
        $payment_info['price_w_bmic'] = $amount;

        if (strtolower($this->data['country']) === 'canada') {
            $tax = Tax::query()->where('province_en', $this->data['region'])->first();
            $amount += $amount * ($tax->rate_1 + $tax->rate_2) / 100;

            $payment_info['tax'] = [
                'type_1' => $tax->type_1,
                'rate_1' => $tax->rate_1,
                'type_2' => $tax->type_2,
                'rate_2' => $tax->rate_2,
                'amount_w_tax' => $amount
            ];
        }

        if ((int) $this->data['coupon_id'] > 0) {
            $query = Discount::query();
            $query->where('coupon_id', '=', $this->data['coupon_id']);
            $query->where('business_id', '=', $this->data['business_id']);
            $discount = $query->first();
            $coupon = Coupon::where('id', $this->data['coupon_id'])->first();
            $current = Carbon::now();
            $differents = str_replace('-', '', $current->diffInMonths($discount->created_at, false));

            if ($differents < $coupon->duration_value) {
                if ($coupon->off_an_plans_type === '$') {
                    $amount -= $coupon->off_an_plans_value;
                    $amount = $amount < 0 ? 0 : $amount;
                }
                else {
                    $amount -= $amount * ($coupon->off_an_plans_value / 100);
                }

                $payment_info['discount'] = [
                    'coupon_id' => $this->data['coupon_id'],
                    'off_an_plans_type' => $coupon->off_an_plans_type,
                    'off_an_plans_value' => $coupon->off_an_plans_value,
                    'amount_w_discount' => $amount,
                    'code' => $coupon->code,
                ];
            }
            else {
                $this->data['coupon_id'] = 0;
            }
        }

        $this->attempts++;
        $this->data['attempts']++;
        $amount = number_format((float) $amount, 2, '.', '');
        $payment_info['total_amount'] = $amount;

        if ($amount > 1) {
            $stripe = new Stripe(config('services.stripe.secret'));

            $subscription = $stripe->charges()->create([
                'customer' => $business->stripe_id,
                'currency' => 'USD',
                'amount' => $amount,
                'source' => $card->card_id,
            ]);

            Log::info(print_r($subscription, true));
        }
        else {
            $subscription = [];
            $subscription['balance_transaction'] = '';
            $subscription['paid'] = true;
            $subscription['id'] = 'f-' . time();
        }

        if ($business->plan_id > 0) {
            Billing::where('business_id', '=', $this->data['business_id'])->update(['current' => 0]);
            $data = new Billing();
            $data->business_id = $this->data['business_id'];
            $data->client_id = $user->user_id;
            $data->charge_id = $subscription['id'];
            $data->balance_transaction = $subscription['balance_transaction'];
            $data->plan_id = $business->plan_id;
            $data->package_id = $this->data['package_id'] ?? 0;
            $data->status = $subscription['paid'] === true ? 'paid' : 'unpaid';
            $data->total = $amount;
            $data->coupon_id = $this->data['coupon_id'] ?? 0;
            $data->company_name = $this->data['company_name'];
            $data->owner_name = $this->data['owner_name'];
            $data->street_number = $this->data['street_number'];
            $data->street = $this->data['street'];
            $data->suite = $this->data['suite'];
            $data->region = $this->data['region'];
            $data->city = $this->data['city'];
            $data->zip_code = $this->data['zip_code'];
            $data->country = $this->data['country'];
            $data->card_id = $card->id;
            $data->applicants = $business->plan_id * $CANDIDATES_COUNT_PER_STEP;
            $data->price = ($business->plan_id * $CANDIDATES_COUNT_PER_STEP * $PRICE_PER_CANDIDATE);
            $data->current = 1;
            $data->payment_info = serialize($payment_info);
            $data->save();
            $data->invoice_id = 'A-' . str_pad($data->id, 8, '0', STR_PAD_LEFT);
            $data->save();

            $this->queue = [
                'business_id' => $this->data['business_id'],
                'plan_id' => $this->data['plan_id'] ?? 0,
                'package_id' => $this->data['package_id'] ?? 0,
                'coupon_id' => $this->data['coupon_id'] ?? 0,
                'company_name' => $this->data['company_name'],
                'owner_name' => $this->data['owner_name'],
                'street_number' => $this->data['street_number'],
                'street' => $this->data['street'],
                'suite' => $this->data['suite'],
                'region' => $this->data['region'],
                'city' => $this->data['city'],
                'zip_code' => $this->data['zip_code'],
                'country' => $this->data['country'],
                'client_id' => $user->user_id,
                'applicants' => $this->data['applicants'],
                'price' => $this->data['price'],
                'plan_name' => $this->data['plan_name'],
                'attempts' => $this->data['attempts']++
            ];

            $queue_job = (new ProcessBilling($this->queue, $this->attempts))->delay($next_payment_date);
            $job_id = app(Dispatcher::class)->dispatch($queue_job);
            $business->job_id = $job_id;
            $business->billing_warning = 0;
            $business->last_plan_payment_was_at = $current_payment_date;
        }
        
        $business->save();
    }

    public function failed(Exception $exception)
    {
        $user = User::query()
            ->join('business_administrators', 'business_administrators.user_id', '=', 'users.id')
            ->where('business_administrators.business_id', '=', $this->data['business_id'])
            ->where('business_administrators.role', '=', 'admin')
            ->first();

        $business = Business::where('id', $this->data['business_id'])->first();
        $this->attempts++;
        $data = [];
        Mail::to($user->email)->queue(new BillingError($data));
        
        if ($this->attempts < 3) {
            $dt = Carbon::create(date('Y'), date('m'), date('j'), date('H'), date('i'), date('s'));
            $queue_job = (new ProcessBilling($this->data, $this->attempts))->delay($dt->addMinutes(1));
            $job_id = app(Dispatcher::class)->dispatch($queue_job);
            $business->job_id = $job_id;
            $business->billing_warning = 1;
            $business->save();
        }
        else {
            Log::info('end failed tries: ');
        }

    }
}
