<?php

namespace App\Http\Controllers;

use App\Bmic;
use App\Business\BillingAddress;
use App\Http\GraphQLClient;
use App\Business\Billing;
use App\Jobs\ProcessBilling;
use App\Flagship;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;


class InvoiceController extends Controller
{
    public function __construct()
    {

    }

    public function viewInvoice($id)
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

        if ($data['billingAddress']) {
            $data['bmic'] = Bmic::query()->where('country_code', '=', $data['billingAddress']->country_code)->first();
        }
        else {
            $data['bmic'] = null;
        }

        $data['flagship'] = Flagship::query()->first();
        $data['payment_info'] = unserialize($data['invoice']->payment_info, ['allowed_classes' => true]);

        return view('business.auth.billing_invoice', $data);
    }

    public function pdfInvoice($id)
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

        if ($data['billingAddress']) {
            $data['bmic'] = Bmic::query()->where('country_code', '=', $data['billingAddress']->country_code)->first();
        }
        else {
            $data['bmic'] = null;
        }

        $data['flagship'] = Flagship::query()->first();
        $data['payment_info'] = unserialize($data['invoice']->payment_info, ['allowed_classes' => true]);


        $pdf = PDF::loadView('business.auth.billing_invoice_pdf', $data);

        return $pdf->download($data['invoice']->invoice_id . '.pdf');
    }


}
