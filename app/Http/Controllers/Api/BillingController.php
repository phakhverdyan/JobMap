<?php

namespace App\Http\Controllers\Api;

use App\Business\BusinessBillingInvoice;
use App\Business\Location;
use App\Tax;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\BaseResource;
use App\Business\Administrator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Config;
use App\Business\BusinessCustomerBilling;
use App\Business\BusinessBilling;
use App\Business\BusinessBillingPlan;
use App\Business\Card;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Arr;

class BillingController extends Controller
{

    public function getCurrentPaid(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $businessID = (int)$request->input('business_id', 0);

        if($businessID < 1){
            return response(['error' => 'Business id error'], 500);
        }

        $content_html = "";
        $month_count_location = 0;
        $month_amount_location = 0;
        $year_count_location = 0;
        $year_amount_location = 0;
        $month_amount_ADMIN_ROLE = 0;
        $month_count_ADMIN_ROLE = 0;
        $year_amount_ADMIN_ROLE = 0;
        $year_count_ADMIN_ROLE = 0;
        $month_amount_MANAGER_ROLE = 0;
        $month_count_MANAGER_ROLE = 0;
        $year_amount_MANAGER_ROLE = 0;
        $year_count_MANAGER_ROLE = 0;
        $month_amount_FRANCHISE_ROLE = 0;
        $month_count_FRANCHISE_ROLE = 0;
        $year_amount_FRANCHISE_ROLE = 0;
        $year_count_FRANCHISE_ROLE = 0;


        $_users = Administrator::select("business_administrators.*", "business_billing_invoices.amount_due", "business_billing_plans.interval_name")
            ->where('business_administrators.business_id', $businessID)
            ->join("business_billings", "business_administrators.user_id", "business_billings.user_id")
            ->where("business_billings.is_paid", 1)
            ->where("business_billings.user_paid_id", auth()->user()->id)
            ->where("business_billings.billing_type", "user")
            ->join("business_billing_invoices", "business_billings.subscription_id", "business_billing_invoices.subscription_id")
            ->join("business_billing_plans", "business_billing_invoices.plan_id", "=", "business_billing_plans.plan_id")
            ->where("business_billing_invoices.user_paid_id", auth()->user()->id)->get();

        foreach ($_users as $_user){
            switch ($_user->role){
                case Administrator::ADMIN_ROLE:
                    switch ($_user->interval_name){
                        case "month":
                            $month_count_ADMIN_ROLE++;
                            $month_amount_ADMIN_ROLE += $_user->amount_due;
                            break;
                        case "year":
                            $year_count_ADMIN_ROLE++;
                            $year_amount_ADMIN_ROLE += $_user->amount_due;
                            break;
                        default:
                            break;
                    }
                    break;
                case Administrator::MANAGER_ROLE:
                    switch ($_user->interval_name){
                        case "month":
                            $month_count_MANAGER_ROLE++;
                            $month_amount_MANAGER_ROLE += $_user->amount_due;
                            break;
                        case "year":
                            $year_count_MANAGER_ROLE++;
                            $year_amount_MANAGER_ROLE += $_user->amount_due;
                            break;
                        default:
                            break;
                    }
                    break;
                case Administrator::FRANCHISE_ROLE:
                    switch ($_user->interval_name){
                        case "month":
                            $month_count_FRANCHISE_ROLE++;
                            $month_amount_FRANCHISE_ROLE += $_user->amount_due;
                            break;
                        case "year":
                            $year_count_FRANCHISE_ROLE++;
                            $year_amount_FRANCHISE_ROLE += $_user->amount_due;
                            break;
                        default:
                            break;
                    }
                    break;
                default:
                    break;
            }
        }



        if($month_count_ADMIN_ROLE > 0){
            $content_html .= '<tr><td><div class="col-12 show-details-invoice-users" data-users-role="'.Administrator::ADMIN_ROLE.'" style="cursor: pointer;"><div class="row"><div class="col-8">'.$month_count_ADMIN_ROLE.' '.trans('main.roles.admin').' ( Monthly )</div><div class="col-4 text-right">'.$this->currency_symbol.number_format(($month_amount_ADMIN_ROLE / 100),2,'.',' ').'</div></div></div></td></tr>';
        }
        if($year_count_ADMIN_ROLE > 0){
            $content_html .= '<tr><td><div class="col-12 show-details-invoice-users" data-users-role="'.Administrator::ADMIN_ROLE.'" style="cursor: pointer;"><div class="row"><div class="col-8">'.$year_count_ADMIN_ROLE.' '.trans('main.roles.admin').' ( Yearly )</div><div class="col-4 text-right">'.$this->currency_symbol.number_format(($year_amount_ADMIN_ROLE / 100),2,'.',' ').'</div></div></div></td></tr>';
        }

        if($month_count_MANAGER_ROLE > 0){
            $content_html .= '<tr><td><div class="col-12 show-details-invoice-users" data-users-role="'.Administrator::MANAGER_ROLE.'" style="cursor: pointer;"><div class="row"><div class="col-8">'.$month_count_MANAGER_ROLE.' '.trans('main.roles.manager').' ( Monthly )</div><div class="col-4 text-right">'.$this->currency_symbol.number_format(($month_amount_MANAGER_ROLE / 100),2,'.',' ').'</div></div></div></td></tr>';
        }
        if($year_count_MANAGER_ROLE > 0){
            $content_html .= '<tr><td><div class="col-12 show-details-invoice-users" data-users-role="'.Administrator::MANAGER_ROLE.'" style="cursor: pointer;"><div class="row"><div class="col-8">'.$year_count_MANAGER_ROLE.' '.trans('main.roles.manager').' ( Yearly )</div><div class="col-4 text-right">'.$this->currency_symbol.number_format(($year_amount_MANAGER_ROLE / 100),2,'.',' ').'</div></div></div></td></tr>';
        }

        if($month_count_FRANCHISE_ROLE > 0){
            $content_html .= '<tr><td><div class="col-12 show-details-invoice-users" data-users-role="'.Administrator::FRANCHISE_ROLE.'" style="cursor: pointer;"><div class="row"><div class="col-8">'.$month_count_MANAGER_ROLE.' '.trans('main.roles.franchisee').' ( Monthly )</div><div class="col-4 text-right">'.$this->currency_symbol.number_format(($month_amount_FRANCHISE_ROLE / 100),2,'.',' ').'</div></div></div></td></tr>';
        }
        if($year_count_FRANCHISE_ROLE > 0){
            $content_html .= '<tr><td><div class="col-12 show-details-invoice-users" data-users-role="'.Administrator::FRANCHISE_ROLE.'" style="cursor: pointer;"><div class="row"><div class="col-8">'.$year_count_FRANCHISE_ROLE.' '.trans('main.roles.franchisee').' ( Yearly )</div><div class="col-4 text-right">'.$this->currency_symbol.number_format(($year_amount_FRANCHISE_ROLE / 100),2,'.',' ').'</div></div></div></td></tr>';
        }

        $BusinessBillingLocation = BusinessBilling::select("business_billings.*", "business_billing_invoices.amount_due", "business_billing_plans.interval_name")
            ->where("business_billings.business_id", $businessID)
            ->where("business_billings.user_paid_id", auth()->user()->id)
            ->where("business_billings.billing_type", "location")
            ->join("business_billing_invoices", "business_billings.subscription_id", "business_billing_invoices.subscription_id")
            ->where("business_billing_invoices.user_paid_id", auth()->user()->id)
            ->join("business_billing_plans", "business_billing_invoices.plan_id", "=", "business_billing_plans.plan_id")
            ->whereNotNull("business_billings.location_id")->get();

        foreach ($BusinessBillingLocation as $item){
            switch ($item->interval_name){
                case "month":
                    $month_count_location++;
                    $month_amount_location += $item->amount_due;
                    break;
                case "year":
                    $year_count_location++;
                    $year_amount_location += $item->amount_due;
                    break;
                default:
                    break;
            }
        }

        if($month_count_location > 0){
            $content_html .= '<tr><td><div class="col-12 show-paid-locations" style="cursor: pointer;"><div class="row"><div class="col-6">'.$month_count_location.' Locations ( Monthly )</div><div class="col-6 text-right">'.$this->currency_symbol.number_format(($month_amount_location / 100),2,'.',' ').'</div></div></div></td></tr>';

        }

        if($year_count_location > 0){
            $content_html .= '<tr><td><div class="col-12 show-paid-locations" style="cursor: pointer;"><div class="row"><div class="col-6">'.$year_count_location.' Locations ( Yearly )</div><div class="col-6 text-right">'.$this->currency_symbol.number_format(($year_amount_location / 100),2,'.',' ').'</div></div></div></td></tr>';

        }

        $monthly_total_amount = $month_amount_location + $month_amount_ADMIN_ROLE + $month_amount_MANAGER_ROLE + $month_amount_FRANCHISE_ROLE;
        $yearly_total_amount = $year_amount_location + $year_amount_ADMIN_ROLE + $year_amount_MANAGER_ROLE + $year_amount_FRANCHISE_ROLE;

        return response([ "data" => [
            'html' => $content_html,
            "monthly_total_amount" => $this->currency_symbol.number_format(($monthly_total_amount / 100), 2,'.',' '),
            "yearly_total_amount" => $this->currency_symbol.number_format(($yearly_total_amount / 100), 2,'.',' '),
        ]], 200);
    }

    public function getPaidUserData(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }
        $language_prefix = $request->input('language_prefix', "en");
        app()->setLocale($language_prefix);
        $businessID = (int)$request->input('business_id', 0);
        $find_paid_user = $request->input('find_paid_user', "");
        $user_role = $request->input('user_role', "");
        $keywords = explode(" ", $find_paid_user);

        if($businessID < 1){
            return response(['error' => 'Business id 0 error'], 500);
        }

        $Users = Administrator::select("business_administrators.*", "users.first_name", "users.last_name", "users.email", "business_billing_invoices.period_start", "business_billing_invoices.period_end", "business_billing_invoices.amount_due", "business_billing_plans.interval_name")
            ->where('business_administrators.business_id', $businessID)
            ->where('business_administrators.role', $user_role)
            ->join("business_billings", "business_administrators.user_id", "business_billings.user_id")
            ->where("business_billings.is_paid", 1)
            ->where("business_billings.user_paid_id", auth()->user()->id)
            ->where("business_billings.billing_type", "user")
            ->join("business_billing_invoices", "business_billings.subscription_id", "business_billing_invoices.subscription_id")
            ->where("business_billing_invoices.user_paid_id", auth()->user()->id)
            ->join("business_billing_plans", "business_billing_invoices.plan_id", "=", "business_billing_plans.plan_id")
            ->join("users", "business_administrators.user_id", "=", "users.id");


        $Users->where(function ($where) use ($keywords) {
            foreach ($keywords as $keyword) {
                $where->orWhere('users.email', 'like', '%' . $keyword . '%');
                $where->orWhere('users.first_name', 'like', '%' . $keyword . '%');
                $where->orWhere('users.last_name', 'like', '%' . $keyword . '%');
            }
        });

        return Datatables()->eloquent($Users)
            ->filterColumn('name', function ($query, $keyword) {
            })
            ->addColumn('name', function ($User) {


                $contract_type = "Monthly";
                if($User->interval_name == "year"){
                    $contract_type = "Yearly";
                }

                $view = View('business.auth.graphql.billing_user_item', [
                    'args' => $User,
                    'contract_type' => $contract_type,
                    'amount_due' => $this->currency_symbol.number_format(($User->amount_due / 100),2,'.',' '),
                    'period_start' => Carbon::createFromTimestamp($User->period_start, Config::get('app.timezone'))->format("m/d/Y"),
                    'period_end' => Carbon::createFromTimestamp($User->period_end, Config::get('app.timezone'))->format("m/d/Y"),

                ])->render();
                return $view;
            })
            ->rawColumns(['name'])
            ->make(true);
    }

    public function checkedCard(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $Cards = Card::where("user_id", auth()->user()->id)->where("is_default", 1)->first();

        if(empty($Cards)){
            return response([ "data" => ["error" => "error", "not_found_card" => 1]], 200);
        }

        return response([ "data" => ["not_found_card" => 0]], 200);
    }

    public function createCart(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $customer_id = $this->getCustomerId(auth()->user()->id);

        if(empty($customer_id)){
            return response(['error' => 'Customer ID'], 500);
        }
        \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));

        // $card_create = Stripe::cards()->create($customer_id, [
        //     "card" => [
        //         'number'    => $request->input('number', 0),
        //         'exp_month' => $request->input('expiry_month', 0),
        //         'cvc'       => $request->input('code', 0),
        //         'exp_year'  => $request->input('expiry_year', 0),
        //         'name'      => $request->input('name', 0)
        //     ]
        // ]);

        // if(empty($card_create)){
        //     return response(['error' => 'Create cart'], 500);
        // }
        $pm_id = json_decode($request->input('setup_intent'))->payment_method;

        $payment_method = \Stripe\PaymentMethod::retrieve(
            $pm_id
          );
        $payment_method->attach([
        'customer' => $customer_id,
        ]);
        $card = $payment_method->card;

        $saved_card = Card::where("user_id", auth()->user()->id)->where("fingerprint", $card->fingerprint)->first();
        if(!empty($saved_card)){
            return response(['error' => 'This card already exists.', 'card_exists' => 1 ], 500);
        }

        $Card_count = Card::where("user_id", auth()->user()->id)->count();

        $new_card = new Card();

        if($Card_count < 1){
            $new_card->is_default = 1;
            $customer = \Stripe\Customer::update($customer_id, [
                'invoice_settings' => [
                  'default_payment_method' => $payment_method->id
                ]
            ]);
        }

        $new_card->user_id = auth()->user()->id;
        $new_card->card_id = $payment_method->id;
        $new_card->fingerprint = $card->fingerprint;
        $new_card->last4 = $card->last4;
        $new_card->exp_month = $card->exp_month;
        $new_card->exp_year = $card->exp_year;
        $new_card->brand = $card->brand;
        $new_card->save();

        return response(["customer_id" => $customer_id, "card" => $card], 200);
    }

    public function actionCard(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $action = $request->input('action', "");
        $card_id = $request->input('card_id', "");

        $customer_id = $this->getCustomerId(auth()->user()->id);
        if(empty($customer_id)){
            return response(['error' => 'Customer ID'], 500);
        }
        \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
        if($action == "set-default"){
            $Card = Card::where("user_id", auth()->user()->id)->where("is_default", 1)->first();
            if($Card)
            {
                $Card->is_default = 0;
                $Card->save();
            }

            $Card = Card::where("user_id", auth()->user()->id)->where("id", $card_id)->first();
            $Card->is_default = 1;
            $Card->save();

            $customer = \Stripe\Customer::update($customer_id, [
                'invoice_settings' => [
                    'default_payment_method' => $Card->card_id
                  ]
            ]);
        }

        if($action == "remove"){
            // Stripe::cards()->delete($customer_id, $card_id);
            $card = Card::where("user_id", auth()->user()->id)->where("id", $card_id)->firstOrFail();
            try {
                $payment_method = \Stripe\PaymentMethod::retrieve(
                    $card->card_id
                  );
                $payment_method->detach();
            } catch (\Exception $e) {
                return response(['error' => $e->getMessage()]);
            }
            $card->delete();
            // $customer = Stripe::customers()->find($customer_id);
            $customer = \Stripe\Customer::retrieve($customer_id);
            if(!empty($customer)){
                $default_payment_method = $customer->invoice_settings->default_payment_method;
                $Card = Card::where("user_id", auth()->user()->id)
                ->where("card_id", $default_payment_method)->first();
                if(empty($Card) && $default_payment_method){
                    $card_create = \Stripe\PaymentMethod::retrieve($default_payment_method);
                    if(!empty($card_create)){
                        $Card = new Card();
                        $Card->is_default = 1;
                        $Card->user_id = auth()->user()->id;
                        $Card->card_id = $card_create->id;
                        $Card->fingerprint = $card_create->card->fingerprint;
                        $Card->last4 = $card_create->card->last4;
                        $Card->exp_month = $card_create->card->exp_month;
                        $Card->exp_year = $card_create->card->exp_year;
                        $Card->save();
                    }
                }elseif (!empty($Card) && $default_payment_method){
                    $Card->is_default = 1;
                    $Card->save();
                }
                elseif (empty($Card) && !$default_payment_method)
                {
                    $Card = Card::where("user_id", auth()->user()->id)->first();
                    $Card->is_default = 1;
                    $Card->save();
        
                    $customer = \Stripe\Customer::update($customer_id, [
                        'invoice_settings' => [
                            'default_payment_method' => $Card->card_id
                          ]
                    ]);
                }
            }
        }

        return response(["customer" => $customer], 200);
    }

    public function getCardsData(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }
        $language_prefix = $request->input('language_prefix', "en");
        app()->setLocale($language_prefix);
        $Cards = Card::where("user_id", auth()->user()->id)->orderBy("is_default", "desc");

        return Datatables()->eloquent($Cards)
            ->filterColumn('name', function ($query, $keyword) {
            })
            ->addColumn('primary', function($Card){
                $primary = "";
                if($Card->is_default == 1){
                    $primary = "Primary";
                }
                return "<p class='pl-3'>".$primary."</p>";
            })
            ->editColumn('name', function ($Card) {

                $data = Carbon::createFromDate($Card->exp_year, $Card->exp_month, 0, 0 )->format("M Y");

                return "<p class='card-icon-wrapper'><span class='card-type-icon card-type-".str_replace(" ", "", $Card->brand)."'></span>****".$Card->last4."</p><p class='pl-3'>Exp. ".$data."</p>";
            })
            ->addColumn('action', function($Card){
                $html = "<div class='row'>";
                if($Card->is_default == 0){
                    $html .= "<div class='col-lg-6'><button data-action='make-primary' data-card-id='".$Card->card_id."' type='button' class='btn btn-primary btn-block card-action' role='button'>Make Primary</button></div>";
                    $html .= "<div class='col-lg-6'><button data-action='remove' data-card-id='".$Card->card_id."' type='button' class='btn btn-primary btn-block card-action' role='button'>Remove</button></div>";
                }
                $html .= "</div>";
                return $html;
            })
            ->rawColumns(['primary','name','action'])
            ->make(true);
    }

    public function deleteSubscription(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $businessID = (int)$request->input('business_id', 0);

        if($businessID < 1){
            return response(['error' => 'Business id < 1 error'], 500);
        }

        $user_id = $request->input('user_id', 0);

        $_user = Administrator::where('business_id', $businessID)->where('id', $user_id)->first();

        $BusinessBilling = BusinessBilling::where('business_id', $businessID)
        ->where('user_id', $_user->user_id)
        ->where("billing_type", "user")
        ->first();
        $plan = BusinessBillingPlan::where('id', $BusinessBilling->plan_id)->first();
        if (empty($plan)) return response(['error' => 'plan ID not found'], 500);

        if ($BusinessBilling->is_subscription == 1){
            $customer_id = null;
            if($BusinessBilling->user_paid_id != null && $BusinessBilling->user_paid_id != $BusinessBilling->user_id){
                $customer_id = $this->getCustomerId($BusinessBilling->user_paid_id);
            }else{
                $customer_id = $this->getCustomerId($_user->user_id);
            }

            if(empty($customer_id)){
                return response(['error' => 'Customer ID'], 500);
            }
            if ($plan->quantity == 1)
            {
                \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
                $subscription = \Stripe\Subscription::retrieve($BusinessBilling->subscription_id)->delete();
                $BusinessBilling->delete();
            }
            else 
            {
                $BusinessBilling->user_id = null;
                $BusinessBilling->save();
            }
        }
        
        return response(['data' => []], 200);
    }

    public function createSubscription(Request $request){
        
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $businessID = (int)$request->input('business_id', 0);

        if($businessID < 1){
            return response(['error' => 'Business id < 1 error'], 500);
        }

        $user_id = $request->input('user_id', null);
        $subscription_quantity = $request->input('quantity', 1);
        $plan_id = $request->input('plan', null);
        $customer_id = $this->getCustomerId(auth()->user()->id);
        if(empty($customer_id)) return response(['error' => 'Customer ID'], 500);
        $BusinessBillingPlan = BusinessBillingPlan::find($plan_id);
        if(empty($BusinessBillingPlan)) return response(['error' => 'Billing Plan'], 500);
        if($BusinessBillingPlan->status !== 'active') return response(['error' => 'Legacy Billing Plan'], 500);

        $subscription_exist = BusinessBilling::where('business_id', $businessID)
                    ->where('plan_id', $BusinessBillingPlan->id)
                    ->where('status','!=','canceled')
                    ->get();
        \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
        $tax = Tax::where('province_en', auth()->user()->region)->first();
        if($tax)
        {
            $tax_rates = [];
            $tax_rates[] = $tax->tax_rate_1_id;
            if ($tax->tax_rate_2_id)
            $tax_rates[] = $tax->tax_rate_2_id;
        }
        if(!$subscription_exist->isEmpty())
        {
            try {
                $sub_id = $subscription_exist->first()->subscription_id;
                $subscription = \Stripe\Subscription::retrieve([
                    'id' => $sub_id,
                    'expand' => ['latest_invoice.payment_intent'],
                  ]);
                $subscription->items->data[0]->quantity += $subscription_quantity;
                $subscription->items->data[0]->save();
                $subscription->tax_rates = $tax_rates ?? $subscription->tax_rates;
                $subscription->billing_cycle_anchor = 'now';
                $subscription->save();
                
                if (gettype($subscription->latest_invoice) == 'string')
                {
                    $subscription->latest_invoice = \Stripe\Invoice::retrieve([
                        'id' => $subscription->latest_invoice, 
                        'expand' => ['payment_intent'],
                    ]);
                }
            } catch (\Exception $e) {
                return response(['error' => $e->getMessage()]);
            }
        }
        else {
            $subscription_data = array(
                'plan' => $BusinessBillingPlan->plan_id,
                'quantity' => $subscription_quantity
            );
            $subscription = \Stripe\Subscription::create([
                'customer' => $customer_id, 
                'items' => array($subscription_data),
                'tax_rates' => $tax_rates ?? null,
                'expand' => ['latest_invoice.payment_intent']
            ]);
        }
        
        $pack_id = null;
        if ($BusinessBillingPlan->quantity > 1) $pack_id = $subscription_exist->max('pack_id');

        $user_paid_id = auth()->user()->id;
        $data = [];

        for ($i=0; $i < $subscription_quantity; $i++) { 
            $BusinessBillingPlan->quantity > 1 ? ($pack_id ? $pack_id++ : $pack_id = 1) : $pack_id = null;
            for ($j=0; $j < ($BusinessBillingPlan->quantity); $j++) {
                $data[] = array(
                'business_id' => $businessID,
                'user_id' => $_user->user_id ?? null,
                'is_paid' => $subscription->status == 'active' ? 1 : 0,
                'subscription_start' => $subscription->current_period_start,
                'subscription_end' => $subscription->current_period_end,
                'is_subscription' => 1,
                'subscription_id' => $subscription->id,
                'interval' => $subscription->plan->interval,
                'status' => $subscription->status,
                'user_paid_id' => $user_paid_id,
                'plan_id' => $BusinessBillingPlan->id,
                'pack_id'=> $pack_id,
                'billing_type' => "user",
                'created_at' => Carbon::now()
                );
            }
        }
        BusinessBilling::insert($data);
        if ($subscription->latest_invoice->payment_intent)
        {
            $invoice = $subscription->latest_invoice;
            $my_invoice = new BusinessBillingInvoice();
            $my_invoice->invoice_id = $invoice->id;
            $my_invoice->user_paid_id = BusinessCustomerBilling::where('customer_id', $invoice->customer)->first()->user_id;
            $attributes = Schema::getColumnListing($my_invoice->getTable());
            foreach ($subscription->latest_invoice->jsonSerialize() as $key => $value) {
                if ($key == 'id') continue;
                if(in_array($key, $attributes) && $invoice[$key] !== null)
                $my_invoice->$key = $invoice[$key];
                if(in_array($key.'_id', $attributes) && $invoice[$key] !== null)
                $my_invoice->{$key.'_id'} = $invoice[$key];
            }
            $my_invoice->save();
            if ($subscription->latest_invoice->payment_intent->status != 'succeeded')
            {
                return response(['invoice_id'=>$my_invoice->id,
                'status' => $subscription->latest_invoice->payment_intent->status,
                'client_secret' => $subscription->latest_invoice->payment_intent->client_secret]);
            }
        }
        return response(['data' => []], 200);
    }

    public function getInvoicesData(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $businessID = (int)$request->input('business_id', 0);
        $data_from = $request->input('data_from', "");
        $data_to = $request->input('data_to', "");
        $type_invoices = $request->input('type_invoices', "");
        $find_email = $request->input('find_email', "");

        $customer_id = $this->getCustomerId(auth()->user()->id);
        if(empty($customer_id)){
            return response(['error' => 'Customer ID'], 500);
        }

        $BusinessBillingInvoice = BusinessBillingInvoice::where('business_billing_invoices.customer_id', $customer_id)
            ->where('business_billing_invoices.user_paid_id', auth()->user()->id)
            ->join("business_billing_plans", "business_billing_invoices.plan_id", "=", "business_billing_plans.plan_id")
            ->join("users", "business_billing_invoices.user_id", "=", "users.id")
            ->orderBy("business_billing_invoices.id", "desc")
            ->select("business_billing_invoices.*","business_billing_plans.type", "users.email");

        if(!empty($data_from)){
            $BusinessBillingInvoice->where("business_billing_invoices.period_start", ">=", Carbon::createFromFormat("m/d/Y", $data_from, Config::get('app.timezone'))->subDay()->timestamp);
        }

        if(!empty($data_to)){
            $BusinessBillingInvoice->where("business_billing_invoices.period_end", "<=", Carbon::createFromFormat("m/d/Y", $data_to, Config::get('app.timezone'))->timestamp);
        }

        if(!empty($type_invoices) && ($type_invoices == "user" || $type_invoices == "location")){
            $BusinessBillingInvoice->where("business_billing_plans.type", $type_invoices);
        }

        if(!empty($find_email)){
            $BusinessBillingInvoice->where('users.email', 'like', '%' . $find_email . '%');
        }

        return Datatables()->eloquent($BusinessBillingInvoice)
//            ->filterColumn('name', function ($query, $keyword) {
//            })
            ->addColumn('period', function($Invoice){

                return "<div>".Carbon::createFromTimestamp($Invoice->period_start, Config::get('app.timezone'))->format("m/d/Y").' - '.Carbon::createFromTimestamp($Invoice->period_end, Config::get('app.timezone'))->format("m/d/Y")."</div>";
            })
            ->addColumn('customer_email', function ($Invoice) {
                return $Invoice->email;
            })
            ->addColumn('price', function ($Invoice) {
                return $this->currency_symbol.number_format(($Invoice->amount_due / 100),2,'.',' ');
            })
            ->addColumn('type', function ($Invoice) {
                $html = "Scanner Licences Only";
                if($Invoice->type == "user"){
                    $html = "Access Licences Only";
                }
                return $html;
            })
            ->addColumn('action', function($Invoice){
                $html = "<div class='row'>";
                $html .= "<div class='col-lg-6'><a target='_blank' href='".url("/billing/get-invoices-pdf/".$Invoice->id."/view")."' role='button' class=' invoice-action' role='button'>View</a></div>";
                $html .= "<div class='col-lg-6'><a href='".url("/billing/get-invoices-pdf/".$Invoice->id."/download")."' role='button' class=' invoice-action' role='button'>Download</a></div>";
                $html .= "</div>";
                return $html;
            })
            ->rawColumns(['period','customer_email','price','type','action'])
            ->make(true);
    }

    public function getInvoicesPdf($id, $action){

        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        if(empty($id)){
            return response(['error' => 'Invoice id error'], 500);
        }

        $BusinessBillingInvoice = BusinessBillingInvoice::where('id', $id)->first();

        if(empty($BusinessBillingInvoice)){
            return response(['error' => 'Invoice error'], 500);
        }

        $_User = User::where("id", $BusinessBillingInvoice->user_paid_id)->first();

        if(empty($_User)){
            return response(['error' => 'User error'], 500);
        }

        $BusinessBillingPlan = BusinessBillingPlan::where("plan_id", $BusinessBillingInvoice->plan_id)->first();
        $type_html = "Access Licences Only";
        // $type_html = "Scanner Licences Only";
        // if($BusinessBillingPlan->type == "user"){
            
        // }

        $contract_type = "Monthly";
        // if($BusinessBillingPlan->interval_name == "year"){
        //     $contract_type = "Yearly";
        // }

        $tax_config = DB::table('nexus_initial_tax_config')->first();

        $taxes = Tax::where('id', $BusinessBillingInvoice->taxe_id)->first();

        $data = array(
            "user" => $_User,
            "invoice" => $BusinessBillingInvoice,
            "amount" => ($BusinessBillingInvoice->subtotal / 100),
            "amount_due" => ($BusinessBillingInvoice->amount_due / 100),
            "period_start" => Carbon::createFromTimestamp($BusinessBillingInvoice->period_start, Config::get('app.timezone'))->format("M d, Y"),
            "period_end" => Carbon::createFromTimestamp($BusinessBillingInvoice->period_end, Config::get('app.timezone'))->format("M d, Y"),
            "type_html" => $type_html,
            "tax_config" => $tax_config,
            "taxes" => $taxes,
            "currency_symbol" => "$",
            "contract_type" => $contract_type,
        );

        $pdf = PDF::loadView('business.auth.billing_invoice_pdf_new', $data);

        if($action == "view"){
            return $pdf->stream('Invoice-'.$BusinessBillingInvoice->invoice_id.'.pdf');
        }
        return $pdf->download('Invoice-'.$BusinessBillingInvoice->invoice_id.'.pdf');
    }

    private function getCustomerId($_user_id){
        $BusinessCustomerBilling = BusinessCustomerBilling::where("user_id", $_user_id)->first();
        $customer_id = "";
        if(empty($BusinessCustomerBilling)){
            $_User = User::where("id", $_user_id)->first();
            \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
            $customer = \Stripe\Customer::create([
                'email' => $_User->email,
                'name' => $_User->first_name." ".$_User->last_name,
                "phone" => $_User->mobile_phone,
                "address" => [
                    "line1" => $_User->street." ".$_User->city." ".$_User->country,
                    "city" => $_User->city,
                    "country" => $_User->country,
                    "state" => $_User->country,
                ]
            ]);

            $BusinessCustomerBilling = new BusinessCustomerBilling();
            $BusinessCustomerBilling->user_id = $_User->id;
            $BusinessCustomerBilling->customer_id = $customer->id;
            $BusinessCustomerBilling->save();
            $customer_id = $customer->id;
        }else{
            $customer_id = $BusinessCustomerBilling->customer_id;
        }

        return $customer_id;
    }

    private function getBusinessBillingPlan($type = null, $interval = "month", $name = 'simple-month'){
        if($type == null){
            return null;
        }
        $BusinessBillingPlan = BusinessBillingPlan::where("type", $type)->where("interval_name", $interval)
        ->where('name', $name)
        ->first();
        if(!empty($BusinessBillingPlan)){
            return $BusinessBillingPlan;
        }
        else {
            throw new \Exception("Plan doesn't exist! Create the plan firstly");
        }
    }

    public function getUserSlots(Request $request) {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $businessID = (int)$request->input('business_id', 0);

        $slotsQuery = BusinessBilling::whereNull('user_id')
        ->where('business_id', $businessID)
        ->where('status','active');
        $admin = Administrator::where('business_id', $businessID)->where('user_id', auth()->user()->id)->first();
        $countEmptySlots = $slotsQuery->count();
        $subscriptionId = $slotsQuery->pluck('subscription_id')->toArray();
        if ($admin->role == 'admin')
        return response(['count_slots' => $countEmptySlots, 'is_admin' => true]);
        else return response(['count_slots' => $countEmptySlots]);
    }

    public function getCurrentUserPaidStatus(Request $request) {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $businessID = (int)$request->input('business_id', 0);
        $admin = Administrator::where('business_id', $businessID)->where('user_id', auth()->user()->id)->first();
        if (!$admin)
        {
            return response(['error' => 'not an administrator'], 500);
        }
        $created = new Carbon($admin->created_at);
        $trial_ends = (30 - $created->diff(Carbon::now())->days) <= 0;

        $billing = BusinessBilling::where('business_id', $businessID)
        ->where('user_id', auth()->user()->id)
        ->where('status','active')
        ->first();
        if ($admin->role == 'admin')
        {
            if ($trial_ends)
            {
                if($billing) 
                return response(['paid' => true]);
                else return response(['paid' => false]);
            }
            else  {
                return response(['trial' => true]);
            }
        }
        else {
                if($billing) 
                return response(['manager_paid' => true]);
                else return response(['manager_paid' => false]);
        }

    }

    public function createPlan(Request $request) {
        $id = 'monthly-'.$type;
        $product_name = "Monthly Subscription ".$type;
        $amount = number_format($this->month_price, 2,'.',' ');

        if($interval == "year"){
            $year_price = $this->month_price * 12 - (($this->month_price * 12) * $this->year_discount);
            $id = 'yearly-'.$type;
            $product_name = "Yearly Subscription ".$type;
            $amount = number_format($year_price, 2,'.',' ');
        }

        $data = array(
            'id'                   => $id,
            'amount'               => $amount,
            'currency'             => $this->currency,
            'interval'             => $interval,
            "product" => [
                "name" => $product_name
            ],
        );

        $plan = null;

        try{
            $plan = \Stripe\Plan::create($data);
        }catch (\Exception $e){
            return null;
        }

        if($plan == null){
            return null;
        }

        $BusinessBillingPlan = new BusinessBillingPlan();
        $BusinessBillingPlan->plan_id = $plan['id'];
        $BusinessBillingPlan->product_id = $plan['product'];
        $BusinessBillingPlan->name = $plan['name'];
        $BusinessBillingPlan->amount = $amount;
        $BusinessBillingPlan->currency = $this->currency;
        $BusinessBillingPlan->interval_name = $plan['interval'];
        $BusinessBillingPlan->descriptor = $product_name;
        $BusinessBillingPlan->type = $type;
        $BusinessBillingPlan->save();

        return $BusinessBillingPlan;
    }

    public function getEmptySlotsForManager(Request $request) {

        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $businessID = (int)$request->input('business_id', 0);

        $packages = BusinessBilling::whereNull('user_id')
        ->where('business_id', $businessID)
        ->where('business_billings.status','active')
        ->groupBy('interval', 'subscription_id', 'descriptor', 'pack_id', 'business_billings.plan_id')
        ->select(DB::raw('count(`business_billings`.`id`) as counted, `interval`, `descriptor`, `pack_id`, `business_billings`.`plan_id`'))
        ->having(DB::raw('counted'),'>',1)
        ->join('business_billing_plans', 'business_billings.plan_id', '=', 'business_billing_plans.id')
        ->orderBy('pack_id', 'asc')
        ->get();

        $individual = BusinessBilling::whereNull('user_id')
        ->where('business_id', $businessID)
        ->where('business_billings.status','active')
        ->groupBy('interval', 'business_billings.plan_id')
        ->select(DB::raw('count(`business_billings`.`id`) as counted, `interval`, `business_billing_plans`.`descriptor`, `business_billings`.`plan_id`'))
        ->join('business_billing_plans', 'business_billings.plan_id', '=', 'business_billing_plans.id')
        ->where('business_billing_plans.quantity','=',1)
        ->get();

        return response(['packages' => $packages, 'individual' => $individual]);
    }

    public function activate(Request $request) {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }
        $businessID = (int)$request->input('business_id', 0);
        $plan_id = (int)$request->input('plan_id');
        $pack_id = (int)$request->input('pack_id');
        $manager = Administrator::findOrFail($request->input('admin_id'));
        $filled_slot = BusinessBilling::where('business_id', $businessID)
                        ->where('status','active')
                        ->where('user_id', $manager->user_id)
                        ->first();
        if($pack_id){
            $slot = BusinessBilling::where('business_id', $businessID)
            ->where('plan_id', $plan_id)
            ->where('pack_id', $pack_id)
            ->where('status','active')
            ->whereNull('user_id')
            ->firstOrFail();
        }
        else {
            $slot = BusinessBilling::where('business_id', $businessID)
            ->where('plan_id', $plan_id)
            ->where('status','active')
            ->whereNull('user_id')
            ->firstOrFail();
        }
        $slot->user_id = $manager->user_id;
        $slot->save();
        if ($filled_slot) {
            $filled_slot->user_id = null;
            $filled_slot->save();
        }
        return response(["status" => "ok"]);
    }

    public function deactivate(Request $request, $id) {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $slot = BusinessBilling::where('id', $id)
                        ->where('user_id', $request->input('user_id'))
                        ->firstOrFail();
        $slot->user_id = null;
        $slot->save();
        return response(["status" => "ok"]);
    }

    public function cancelSubscription(Request $request) {

        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $businessID = (int)$request->input('business_id', 0);

        $subscriptions_query = BusinessBilling::where('business_id', $businessID)
                    ->where('user_paid_id', auth()->user()->id)
                    ->where('plan_id', $request->input('plan_id'))
                    ->where('status', '!=', 'canceled');
        $subscriptions_query_clone = clone $subscriptions_query;
        $subscription_id = $subscriptions_query_clone->firstOrFail()->subscription_id;
        try
        {
            \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
            \Stripe\Subscription::update(
                $subscription_id,
                [
                    'cancel_at_period_end' => true,
                ]);
            $subscriptions_query->update(['status' => 'cancel_at_period_end']);
            return response(['status' => 'ok' ]);
        }
        catch (\Exception $e)
        {
            return response(['error' => $e->getMessage()], 500);
        }
    }

    public function modifySubscription(Request $request) {

        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $businessID = (int)$request->input('business_id', 0);

        $subscriptions = BusinessBilling::where('business_id', $businessID)
                    ->where('user_paid_id', auth()->user()->id)
                    ->where('plan_id', $request->input('plan_id'))
                    ->where('status','!=', 'canceled')
                    ->get();
        $plan = BusinessBillingPlan::find((int)$request->input('plan_id'));
        if (!$plan) return response(['error', 'plan not found']);
        if ($plan->status !== 'active') return response(['error', 'legacy plan cannot modified']);
        $tax = Tax::where('province_en', auth()->user()->region)->first();
        if($tax)
        {
            $tax_rates = [];
            $tax_rates[] = $tax->tax_rate_1_id;
            if ($tax->tax_rate_2_id)
            $tax_rates[] = $tax->tax_rate_2_id;
        }
        if(!$subscriptions->isEmpty())
        {
            try {
                \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
                $subscription = \Stripe\Subscription::retrieve($subscriptions->first()->subscription_id);
                if($subscription->items->data[0]->quantity < $request->input('quantity'))
                {
                    $subscription->billing_cycle_anchor = 'now';
                }
                $subscription->items->data[0]->quantity = $request->input('quantity');
                $subscription->items->data[0]->save();
                $subscription->default_tax_rates = $tax_rates ?? $subscription->default_tax_rates;
                if($subscription->cancel_at_period_end) $subscription->cancel_at_period_end = false;
                $subscription->save();
                if (gettype($subscription->latest_invoice) == 'string')
                {
                    $subscription->latest_invoice = \Stripe\Invoice::retrieve([
                        'id' => $subscription->latest_invoice, 
                        'expand' => ['payment_intent'],
                    ]);
                }
                BusinessBilling::whereIn('id', $subscriptions->modelKeys())->update(['status'=>$subscription->status]);
            } catch (Exception $e) {
                return response(['error' => $e->getMessage()]);
            }
            
            if($subscriptions->count() > $plan->quantity*$request->input('quantity'))
            {
                $difference = $subscriptions->count() - $plan->quantity*$request->input('quantity');
                $deleted = $subscriptions->take(-$difference)->map(function ($item) {
                    return $item->id;
                })->all();
                BusinessBilling::whereIn('id', $deleted)->delete();
            }
            else {
                $difference = $request->input('quantity') - ($subscriptions->count() / $plan->quantity);
                $subscriptions->max('pack_id') ? $pack_id = $subscriptions->max('pack_id') : $pack_id = null;
                $added = [];
                for ($i=0; $i < $difference; $i++) { 
                    $pack_id ? $pack_id++ : $pack_id=null;
                    for ($j=0; $j < $plan->quantity; $j++) { 
                        $added[] = array(
                            'business_id' => $businessID,
                            'user_id' => null,
                            'is_paid' => $subscription->status == 'active' ? 1 : 0,
                            'subscription_start' => $subscription->current_period_start,
                            'subscription_end' => $subscription->current_period_end,
                            'is_subscription' => 1,
                            'subscription_id' => $subscription->id,
                            'interval' => $subscription->plan->interval,
                            'status' => $subscription->status,
                            'user_paid_id' => auth()->user()->id,
                            'plan_id' => $plan->id,
                            'pack_id'=> $pack_id ?? null,
                            'billing_type' => "user",
                            'created_at' => Carbon::now()
                            );
                    }
                }
                BusinessBilling::insert($added);
            }
            if ($subscription->latest_invoice->payment_intent)
            {
                $invoice = $subscription->latest_invoice;
                $my_invoice = BusinessBillingInvoice::where('invoice_id', $invoice->id)->first();
                $my_invoice ? $my_invoice : $my_invoice = new BusinessBillingInvoice();
                $my_invoice->invoice_id = $invoice->id;
                // $my_invoice->customer_id = $invoice->customer;
                $my_invoice->user_paid_id = BusinessCustomerBilling::where('customer_id', $invoice->customer)->first()->user_id;
                // $my_invoice->subscription_id = $invoice->subscription;
                // $my_invoice->period_start = $invoice->period_start;
                // $my_invoice->period_end = $invoice->period_end;
                // $my_invoice->paid = $invoice->paid;
                // $my_invoice->amount_due = $invoice->amount_due;
                // $my_invoice->subtotal = $invoice->subtotal;
                $attributes = \Schema::getColumnListing($my_invoice->getTable());
                foreach ($subscription->latest_invoice->jsonSerialize() as $key => $value) {
                    if ($key == 'id') continue;
                    if(in_array($key, $attributes) && $invoice[$key] !== null)
                    $my_invoice->$key = $invoice[$key];
                    if(in_array($key.'_id', $attributes) && $invoice[$key] !== null)
                    $my_invoice->{$key.'_id'} = $invoice[$key];
                }
                $my_invoice->save();
                if ($subscription->latest_invoice->payment_intent->status !="succeeded")
                return response(['invoice_id'=>$my_invoice->id,
                'status' => $subscription->latest_invoice->payment_intent->status,
                'client_secret' => $subscription->latest_invoice->payment_intent->client_secret]);
            }
            return response([
            'status' => 'ok',
            'data' => ($deleted ?? $added)]);
                
        }
        else return response(['error' => 'slots not found'], 500);
    }

    public function updateInvoice(Request $request) {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }
        try {
            $invoice = BusinessBillingInvoice::where('id', $request->input('id'))->firstOrFail();
            \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
            $updated = \Stripe\Invoice::retrieve($invoice->invoice_id);
            $updated = $updated->jsonSerialize();
            $attributes = \Schema::getColumnListing($invoice->getTable());
            foreach ($updated as $key => $value) {
                if ($key == 'id') continue;
                if(in_array($key, $attributes) && $updated[$key] !== null)
                $invoice->$key = $updated[$key];
                if(in_array($key.'_id', $attributes) && $updated[$key] !== null)
                $invoice->{$key.'_id'} = $updated[$key];
            }
            $invoice->save();
            $updated_subscription = \Stripe\Subscription::retrieve($invoice->subscription_id);
            $subscription = BusinessBilling::where('subscription_id', $updated_subscription->id)
                ->update(['status' => $updated_subscription->status]);
            return response(['status' => 'ok']);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()]);
        }

    }

    public function getFailedInvoiceCount(Request $request) {
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $customer = \App\Business\BusinessCustomerBilling::where('user_id', auth()->user()->id)
        // ->where('business_id',$business_id)
        ->first();
        
        \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
        try {
            $invoices = \Stripe\Invoice::all(['customer' => $customer->customer_id]);
        }
        catch (\Exception $e) {
            $invoices = null;
        }
        $failed_invoices = collect($invoices->data)->where('paid', false);
        return response(['failed_invoices' => $failed_invoices->count()]);
    }

    public function payInvoice(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }
        $invoice_id = $request->input('invoice_id');
        \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
        $invoice = \Stripe\Invoice::retrieve([
            'id' => $invoice_id,
            'expand' => ['payment_intent']
        ]);
        // return response($invoice->payment_intent);
        if ($invoice->payment_intent->status) {
            if ($invoice->payment_intent->status === "requires_payment_method")
            {
                if ($request->input('payment_method') == 'default')
                {
                    try
                    {
                        $invoice->payment_intent->payment_method = Card::where('user_id',auth()->user()->id)
                        ->where('is_default', 1)->first()->card_id;
                        $invoice->payment_intent->save();
                    }
                    catch (\Exception $e) {
                        return response(['error' => $e->getMessage()]);
                    }
                }
            }
        }
        return response(['client_secret' => $invoice->payment_intent->client_secret]);
        // return response($invoice);
    }

    public function webhook(Request $request) {
        \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            return response(["error" => "Invalid payload"], 400);
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response(["error" => "Invalid signature"], 400);
        }

        // Handle the event
        switch ($event->type) {
            // case 'invoice.created':
            //     $invoice = $event->data->object; // contains a StripePaymentMethod
            //     if($invoice->subscription)
            //     {
            //         $my_invoice = BusinessBillingInvoice::where('invoice_id', $invoice->id)->first();
            //         $my_invoice ? $my_invoice : $my_invoice = new BusinessBillingInvoice();
            //         $my_invoice->invoice_id = $invoice->id;
            //         $my_invoice->customer_id = $invoice->customer;
            //         $my_invoice->user_paid_id = BusinessCustomerBilling::where('customer_id', $invoice->customer)->first()->user_id;
            //         $my_invoice->subscription_id = $invoice->subscription;
            //         $my_invoice->paid ? $my_invoice->paid : $my_invoice->paid = $invoice->paid;
            //         $my_invoice->amount_due = $invoice->amount_due;
            //         $my_invoice->subtotal = $invoice->subtotal;
            //         $my_invoice->save();
            //         $subscription = \Stripe\Subscription::retrieve($invoice->subscription);
            //         BusinessBilling::where('subscription_id', $invoice->subscription)
            //         ->update(['status' => $subscription->status]);
            //     }
            //     return response(['updated' => true], 200);
            //     break;
            case 'invoice.payment_failed':
            case 'invoice.payment_succeeded':
            case 'invoice.updated':
                $invoice = $event->data->object; // contains a StripePaymentMethod
                // Log::error($event->data);
                if($invoice->subscription)
                {
                    $failed_invoice = BusinessBillingInvoice::where('invoice_id', $invoice->id)
                        ->first();
                    if($failed_invoice && $event->data->previous_attributes) {
                    if (!$failed_invoice->paid)
                    {
                        foreach ($event->data->previous_attributes->jsonSerialize() as $key => $value) {
                            if ($key == 'id') continue;
                            if($failed_invoice->$key !== null && $invoice[$key] !== null)
                            $failed_invoice->$key = $invoice[$key];
                            if($failed_invoice->{$key.'_id'} !== null && $invoice[$key] !== null)
                            $failed_invoice->{$key.'_id'} = $invoice[$key];
                        }
                        $failed_invoice->save();
                    }
                    };
                    $subscription = \Stripe\Subscription::retrieve($invoice->subscription);
                    BusinessBilling::where('subscription_id', $invoice->subscription)
                    ->update(['status' => $subscription->status]);
                }
                return response(['updated' => true], 200);
                break;
            default:
                // Unexpected event type
                return response(["error" => "Unexpected event type"], 400);
                exit();
        }

        return response(["webhook" => "Verified signature"], 200);
    }

}