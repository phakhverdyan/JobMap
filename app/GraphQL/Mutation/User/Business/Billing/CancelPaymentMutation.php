<?php

namespace App\GraphQL\Mutation\User\Business\Billing;

use App\AddonPackage;
use App\Bmic;
use App\Business\Administrator;
use App\Business\AdministratorPermission;
use App\Business\Discount;
use App\Coupon;
use App\Flagship;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\Business;
use App\Business\Card;
use App\Business\Billing;
use App\Jobs\CancelBilling;
use App\MonthlyPlan;
use App\Tax;
use App\User;
use Carbon\Carbon;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Cartalyst\Stripe\Stripe;
use Illuminate\Contracts\Bus\Dispatcher;

class CancelPaymentMutation extends Mutation
{
    use Auth;
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Cancel new payment'
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
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {

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

        DB::beginTransaction();

//        try {

        $business = Business::query()->where('id', '=', $args['business_id'])->first();
        $queue_job = DB::table('jobs')->where('id', '=', $business->job_id)->first();

        $where = [
            ['business_id', '=', $args['business_id']],
            ['current', '=', 1]
        ];

        $invoice = Billing::query()->where($where)->first();
        $invoice->is_canceled = 1;
        $invoice->current = 0;
        $invoice->save();

        $data = new Billing();
        $data->business_id = $args['business_id'];
        $data->client_id = $invoice->client_id;
        $data->charge_id = $invoice->charge_id;
        $data->balance_transaction = $invoice->balance_transaction;
        $data->plan_id = $invoice->plan_id;
        $data->package_id = $invoice->package_id;
        $data->status = $invoice->status;
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
        $data->current = 1;
        $data->applicants = $invoice->applicants;
        $data->price = $invoice->price;
        $data->payment_info = $invoice->payment_info;
        $data->is_canceled = 1;
        $data->save();

        $monthlyPlanFree = MonthlyPlan::query()->where('price', '=', '0')->first();

        $queue = [
            'business_id' => $args['business_id'],
        ];

        DB::table('jobs')->where('id', '=', $business->job_id)->delete();
        $time = $queue_job->available_at - time();
        $job = (new CancelBilling($queue))->delay($time);
        $jobId = app(Dispatcher::class)->dispatch($job);
        $business->job_id = $jobId;
        $business->next_plan_id = $monthlyPlanFree->id;
        $business->billing_warning = 0;
        $business->save();

        DB::commit();
//        } catch (\Exception $e) {
//            DB::rollback();
//            return null;
//        }

        $args['token'] = $this->token;
        return $args;
    }
}