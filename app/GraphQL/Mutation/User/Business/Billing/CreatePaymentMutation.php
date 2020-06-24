<?php

namespace App\GraphQL\Mutation\User\Business\Billing;

use App\AddonPackage;
use App\Bmic;
use App\Business\Administrator;
use App\Business\AdministratorPermission;
use App\Business\BillingAddress;
use App\Business\Discount;
use App\Coupon;
use App\Flagship;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\Business;
use App\Business\Card;
use App\Business\Billing;
use App\Jobs\ProcessBilling;
use App\MonthlyPlan;
use App\Tax;
use App\User;
use Carbon\Carbon;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Cartalyst\Stripe\Stripe;
use Illuminate\Contracts\Bus\Dispatcher;


class CreatePaymentMutation extends Mutation
{
    use Auth;
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Create new payment'
    ];

    public function type()
    {
        return GraphQL::type('Invoice');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'business_id' => ['required', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
            ],
            'client_id' => [
                'type' => Type::id(),
                'description' => 'Client ID ?'
            ],
            'plan_id' => [
                'type' => Type::id(),
                'description' => 'Monthly plan ID'
            ],
            'package_id' => [
                'type' => Type::id(),
                'description' => 'Addon package ID'
            ],
            'coupon_id' => [
                'type' => Type::id(),
                'description' => 'Discount coupon ID'
            ],
            'last4' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Last 4 number credit card'
            ],
            'company_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The business name'
            ],
            'owner_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The business owner name'
            ],
            'street_number' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The street number'
            ],
            'street' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The street name'
            ],
            'suite' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The suite'
            ],
            'region' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The region name'
            ],
            'city' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The city name'
            ],
            'zip_code' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Zip code / PO Box'
            ],
            'country' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The country name'
            ],
            'cancel_plan_phone' => [
                'type' => Type::string(),
                'description' => 'Cancel plan phone',
            ],
            'plan_type' => [
                'type' => Type::string(),
                'description' => 'Plan type',
            ],
            'next_plan_type' => [
                'type' => Type::string(),
                'description' => 'Next plan type',
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        $deffered = false;
        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::BRANCH_ROLE
        ];
        //set permissions for this object
        $this->permissions = [
            'buttons'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

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

        $business = Business::query()->where('id', '=', $args['business_id'])->first();
        
        $next_payment_date = $get_next_payment_date(
            $business->plan_id ? $business->last_plan_payment_was_at : new \DateTime,
            $business->plan_id ? $business->first_plan_payment_was_at : new \DateTime,
            $args['plan_type']
        );

        DB::beginTransaction();

//        try {
        $payment_info = [];
        $current_day = (int) date('j');
        $current_payment_date = new \DateTime;
        $billingAddress = BillingAddress::query()->where('business_id', '=', $args['business_id'])->first();

        if ($billingAddress) {
            $bmic = Bmic::query()->where('country_code', '=', $billingAddress->country_code)->first();
        }
        else {
            $bmic = null;
        }

        $flagship = Flagship::query()->first();

        $user = User::query()
            ->join('business_administrators', 'business_administrators.user_id', '=', 'users.id')
            ->where('business_administrators.business_id', '=', $args['business_id'])
            ->where('business_administrators.role', '=', 'admin')
            ->first();

        $card = Card::query()
            ->where('card_last_four', '=', $args['last4'])
            ->where('business_id', '=', $args['business_id'])
            ->first();

        if ((int) $card->is_default !== 1) {
            Card::query()->where('business_id', '=', $args['business_id'])->update(['is_default' => '0']);
            $card->is_default = 1;
            $card->save();
        }

        // if (isset($args['plan_id']) && $args['plan_id']) {
        //     // $plan = MonthlyPlan::query()->where('id', '=', $args['plan_id'])->first();
        //     if ($business->plan_id > 0) {
        //         // $currentPlan = MonthlyPlan::query()->where('id', '=', $business->plan_id)->first();
        //         // if (!empty($currentPlan)) {
        //             if ($business->plan_id > $args['plan_id']) {
        //                 $deffered = true;
        //                 $subscription['paid'] = true; // no $subscription variable
        //                 $business->next_plan_id = $args['plan_id'];
        //                 $business->save();
        //             }
        //         // }
        //     }
        // }

        $payment_info['plan_name'] = ($args['plan_id'] * 1000) . ' applicants'; // $plan->plan_name;

        if (isset($args['package_id'])) {
            $addon_package = AddonPackage::query()->where('id', '=', $args['package_id'])->first();
            $payment_info['plan_name'] = $addon_package->package_name;
        }

        if ($bmic && $flagship) {
            $coefficient = $bmic->coefficient / $flagship->coefficient;
        }
        else {
            $coefficient = 1.0;
        }

        if ($business->plan_id > 0 && $business->last_plan_payment_was_at) {
            if (isset($args['plan_id']) && $args['plan_id']) {
                if ($args['plan_id'] > $business->plan_id) {
                    $count_of_left_days_for_pay_before_next_payment = (
                        ($next_payment_date->getTimestamp() - $current_payment_date->getTimestamp())
                        /
                        86400
                    );

                    if ($business->plan_type == 'year') { // year plan upgrade
                        $amount = (
                            ($args['plan_id'] - $business->plan_id)
                            *
                            $CANDIDATES_COUNT_PER_STEP
                            *
                            $PRICE_PER_CANDIDATE
                            *
                            12
                            *
                            0.9
                            /
                            (int) (date('z', mktime(0, 0, 0, 12, 31, $business->last_plan_payment_was_at->format('y'))) + 1)
                            *
                            $count_of_left_days_for_pay_before_next_payment
                        );
                    }
                    else { // month plan upgrade
                        $amount = (
                            ($args['plan_id'] - $business->plan_id)
                            *
                            $CANDIDATES_COUNT_PER_STEP
                            *
                            $PRICE_PER_CANDIDATE
                            /
                            cal_days_in_month(CAL_GREGORIAN, $business->last_plan_payment_was_at->format('m'), $business->last_plan_payment_was_at->format('y'))
                            *
                            $count_of_left_days_for_pay_before_next_payment
                        );
                    }
                }
                elseif ($args['plan_id'] < $business->plan_id) {
                    $amount = 0.0;
                }
                else {
                    $amount = 0.0;
                }
            }
            else {
                $amount = 0.0;
            }
        }
        else {
            $amount = ($args['plan_id'] * $CANDIDATES_COUNT_PER_STEP * $PRICE_PER_CANDIDATE);

            if ($args['plan_type'] == 'year') {
                $amount *= 12;
                $amount *= 0.9; // 10% discount if business pays up for 1 year
            }

            $amount *= $coefficient;
        }

        $payment_info['coefficient'] = $coefficient;
        $payment_info['bmic'] = $bmic ? $bmic->coefficient : 1.0;
        $payment_info['flagship'] = $flagship ? $flagship->coefficient : 1.0;

        if ($args['plan_type'] == 'year') {
            $payment_info['plan_price'] = ($args['plan_id'] * $CANDIDATES_COUNT_PER_STEP * $PRICE_PER_CANDIDATE * 12 * 0.9);
        }
        else {
            $payment_info['plan_price'] = ($args['plan_id'] * $CANDIDATES_COUNT_PER_STEP * $PRICE_PER_CANDIDATE);
        }

        $payment_info['plan_applicants'] = $args['plan_id'] * 1000;
        $payment_info['plan_id'] = $args['plan_id'];
        $payment_info['price_w_bmic'] = $amount;

        if ($business->plan_id > 0 && $business->last_plan_payment_was_at) {
            $payment_info['type'] = 'renewal';
        }
        else {
            $payment_info['type'] = (isset($args['plan_type']) && $args['plan_type'] == 'year' ? 'year' : 'month');
        }

        if (strtolower($args['country']) === 'canada') {
            $tax = Tax::query()->where('province_en', '=', $args['region'])->first();
            $amount += $amount * ($tax->rate_1 + $tax->rate_2) / 100;

            $payment_info['tax'] = [
                'type_1' => $tax->type_1,
                'rate_1' => $tax->rate_1,
                'type_2' => $tax->type_2,
                'rate_2' => $tax->rate_2,
                'amount_w_tax' => $amount
            ];
        }

        if ((int) $args['coupon_id'] > 0) {
            $query = Discount::query();
            $query->where('coupon_id', '=', $args['coupon_id']);
            $query->where('business_id', '=', $args['business_id']);

            if (!$query->first()) {
                $couponWhere = [
                    ['id', '=', $args['coupon_id']],
                    ['status', '=', 1],
                ];

                $coupon = Coupon::query()->where($couponWhere)->first();

                if ($coupon) {
                    $discount = new Discount();
                    $discount->business_id = $args['business_id'];
                    $discount->coupon_id = $coupon->id;
                    $discount->save();

                    if ($coupon->off_an_plans_type === '$') {
                        $amount -= $coupon->off_an_plans_value;
                        $amount = $amount < 0 ? 0 : $amount;
                    }
                    else {
                        $amount -= $amount * ($coupon->off_an_plans_value / 100);
                    }

                    $payment_info['discount'] = [
                        'coupon_id' => $coupon->id,
                        'code' => $coupon->code,
                        'off_an_plans_type' => $coupon->off_an_plans_type,
                        'off_an_plans_value' => $coupon->off_an_plans_value,
                        'amount_w_discount' => $amount,
                    ];
                }
                else {
                    $args['coupon_id'] = 0;
                }
            }
            else {
                $args['coupon_id'] = 0;
            }
            // so it the best if you work these
        }

        $business_plan_changes_allowed = false;

        if (isset($args['plan_id']) && $args['plan_id'] && $args['plan_id'] > $business->plan_id) {
            $amount = number_format((float) $amount, 2, '.', '');
            $payment_info['total_amount'] = $amount;
            $stripe = new Stripe(config('services.stripe.secret'));

            $subscription = $stripe->charges()->create([
                'customer' => $business->stripe_id,
                'currency' => 'USD',
                'amount' => $amount,
                'source' => $card->card_id,
            ]);

            Log::info(print_r($subscription, true));

            Billing::where('business_id', '=', $args['business_id'])->update(['current' => 0]);
            $data = new Billing();
            $data->business_id = $args['business_id'];
            $data->client_id = $user->user_id;
            $data->charge_id = $subscription['id'];
            $data->balance_transaction = $subscription['balance_transaction'];
            $data->plan_id = $args['plan_id'] ?? 0;
            $data->package_id = $args['package_id'] ?? 0;
            $data->status = $subscription['paid'] === true ? 'paid' : 'unpaid';
            $data->total = $amount;
            $data->coupon_id = $args['coupon_id'] ?? 0;
            $data->company_name = $args['company_name'];
            $data->owner_name = $args['owner_name'];
            $data->street_number = $args['street_number'];
            $data->street = $args['street'];
            $data->suite = $args['suite'];
            $data->region = $args['region'];
            $data->city = $args['city'];
            $data->zip_code = $args['zip_code'];
            $data->country = $args['country'];
            $data->card_id = $card->id;
            $data->current = 1;
            $data->applicants = $args['plan_id'] * 1000;

            if (isset($args['plan_type']) && $args['plan_type'] == 'year') {
                $data->price = ($args['plan_id'] * $CANDIDATES_COUNT_PER_STEP * $PRICE_PER_CANDIDATE * 12 * 0.9);
            }
            else {
                $data->price = ($args['plan_id'] * $CANDIDATES_COUNT_PER_STEP * $PRICE_PER_CANDIDATE);
            }

            $data->payment_info = serialize($payment_info);
            $data->save();
            $data->invoice_id = 'A-' . str_pad($data->id, 8, "0", STR_PAD_LEFT);
            $data->save();

            $business_plan_changes_allowed = $subscription['paid'];
        }
        elseif (isset($args['plan_id']) && $args['plan_id'] < $business->plan_id) {
            $business_plan_changes_allowed = true;
        }

        if ($business_plan_changes_allowed && isset($args['plan_id'])) {
            if ($business->plan_id > 0) { // has plan already
                if ($args['plan_id'] > $business->plan_id) { // try to upgrade plan
                    $business->plan_id = $args['plan_id'];
                    $business->plan_type = (isset($args['plan_type']) && $args['plan_type'] == 'year' ? 'year' : 'month');
                    $business->applicants = $args['plan_id'] * 1000;
                    $business->next_plan_id = 0;
                    $business->next_plan_type = (isset($args['next_plan_type']) && $args['next_plan_type'] == 'year' ? 'year' : 'month');
                    $business->save();
                }
                elseif ($args['plan_id'] < $business->plan_id) { // try to downgrade plan
                    if ($args['plan_id'] == 0) {
                        $business->next_plan_id = -1;
                        $business->next_plan_type = null;
                        $business->cancel_plan_phone = $args['cancel_plan_phone'];
                    }
                    else {
                        $business->next_plan_id = $args['plan_id'];
                        $business->next_plan_type = (isset($args['next_plan_type']) && $args['next_plan_type'] == 'year' ? 'year' : 'month');
                    }

                    $business->save();
                }
                else {
                    // nothing changed
                }
            }
            else { // first plan payment
                if ($business->job_id) {
                    DB::table('jobs')->where('id', '=', $business->job_id)->delete();
                }

                $queue = [
                    'business_id' => $args['business_id'],
                    'plan_id' => $args['plan_id'] ?? 0,
                    'package_id' => $args['package_id'] ?? 0,
                    'coupon_id' => $args['coupon_id'] ?? 0,
                    'company_name' => $args['company_name'],
                    'owner_name' => $args['owner_name'],
                    'street_number' => $args['street_number'],
                    'street' => $args['street'],
                    'suite' => $args['suite'],
                    'region' => $args['region'],
                    'city' => $args['city'],
                    'zip_code' => $args['zip_code'],
                    'country' => $args['country'],
                    'client_id' => $user->user_id,
                    'applicants' => $args['plan_id'] * 1000,
                    'price' => $args['plan_id'] * $CANDIDATES_COUNT_PER_STEP * $PRICE_PER_CANDIDATE,
                    'plan_name' => $payment_info['plan_name'],
                    'attempts' => 0
                ];

                $business->plan_id = $args['plan_id'];
                $business->plan_type = (isset($args['plan_type']) && $args['plan_type'] == 'year' ? 'year' : 'month');
                $business->applicants = $args['plan_id'] * 1000;
                $business->next_plan_id = 0;
                $business->next_plan_type = (isset($args['next_plan_type']) && $args['next_plan_type'] == 'year' ? 'year' : 'month');
                $business->save();

                $job_queue = (new ProcessBilling($queue, 0))->delay($next_payment_date);
                $job_id = app(Dispatcher::class)->dispatch($job_queue);
                $business->job_id = $job_id;
                $business->payment_day = $current_day;
                $business->first_plan_payment_was_at = new \DateTime;
                $business->last_plan_payment_was_at = new \DateTime;
                $business->billing_warning = 0;
                $business->save();
            }
        }

        DB::commit();

//        } catch (\Exception $e) {
//            DB::rollback();
//            return null;
//        } 

        $args['status'] = $business_plan_changes_allowed ? 'paid' : 'unpaid';
        $args['token'] = $this->token;
        return $args;
    }
}