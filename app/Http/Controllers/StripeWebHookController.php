<?php

namespace App\Http\Controllers;

use App\Business\BusinessBilling;
use App\Business\BusinessCustomerBilling;
use Illuminate\Http\Request;

use App\Business\BusinessBillingInvoice;

use Illuminate\Support\Facades\Storage;

class StripeWebHookController extends Controller
{
    public function WebHookInvoice (Request $request)
    {
        $endpoint_secret = env("STRIPE_ENDPOINT_SECRET", null);
        $payload = @file_get_contents('php://input');
        $signature = $request->server('HTTP_STRIPE_SIGNATURE', null);

        if(!$this->verifySignature($payload, $signature, $endpoint_secret)){
            return response(["message" => "Error Verify Signature"], 400);
        }

        $event_id = $request->input('id', null);
        $event = null;

        try{
            $event = Stripe::events()->find($event_id);
        }catch (\Exception $e){
            return response(["message" => "Error Find Event"], 400);
        }

        if($event != null && (int)$event['data']['object']['amount_due'] > 0){

            //Storage::put("test.php", json_encode($event['data']['object']['subtotal']));

            $data = array(
                'invoice_id' => $event['data']['object']['id'],
                'customer_id' => $event['data']['object']['customer'],
                'subscription_id' => $event['data']['object']['subscription'],
                'paid' => $event['data']['object']['paid'],
                'amount_due' => $event['data']['object']['amount_due'],
                'subtotal' => $event['data']['object']['subtotal'],
            );

            $subscription = null;

            try{
                $subscription = Stripe::subscriptions()->find($data['customer_id'], $data['subscription_id']);
            }catch (\Exception $e){
                return response(["message" => "Error Find Subscription"], 400);
            }

            if(empty($subscription)){
                return response(["message" => "Error Find Subscription"], 400);
            }

            if($subscription['status'] == "canceled"){
                return response(["message" => "Error Subscription Status 'canceled'"], 400);
            }

            $data['period_start'] = $subscription['current_period_start'];
            $data['period_end'] = $subscription['current_period_end'];
            $data['plan_id'] = $subscription['items']['data'][0]['plan']['id'];

            $data['subscription_status'] = $subscription['status'];

            $BusinessCustomerBilling = BusinessCustomerBilling::where("customer_id", $data['customer_id'])->first();

            if(empty($BusinessCustomerBilling)){
                return response(["message" => "Error Find Customer"], 400);
            }

            $BusinessBilling = BusinessBilling::where("user_paid_id", $BusinessCustomerBilling->user_id)
                ->where("subscription_id", $data['subscription_id'])
                ->first();

            if(empty($BusinessBilling)){
                return response(["message" => "Error Find BusinessBilling"], 400);
            }

            $BusinessBilling->subscription_start = $data['period_start'];
            $BusinessBilling->subscription_end = $data['period_end'];
            if($data['subscription_status'] == "active"){
                $BusinessBilling->is_subscription = 1;
            }
            $BusinessBilling->save();

            $BusinessBillingInvoice = new BusinessBillingInvoice();
            $BusinessBillingInvoice->invoice_id = $data['invoice_id'];
            $BusinessBillingInvoice->taxe_id = $BusinessBilling->taxe_id;
            $BusinessBillingInvoice->user_id = $BusinessBilling->user_id;
            $BusinessBillingInvoice->location_id = $BusinessBilling->location_id;
            $BusinessBillingInvoice->user_paid_id = $BusinessBilling->user_paid_id;
            $BusinessBillingInvoice->customer_id = $data['customer_id'];
            $BusinessBillingInvoice->subscription_id = $data['subscription_id'];
            $BusinessBillingInvoice->paid = $data['paid'];
            $BusinessBillingInvoice->amount_due = $data['amount_due'];
            $BusinessBillingInvoice->subtotal = $data['subtotal'];
            $BusinessBillingInvoice->period_start = $data['period_start'];
            $BusinessBillingInvoice->period_end = $data['period_end'];
            $BusinessBillingInvoice->plan_id = $data['plan_id'];
            $BusinessBillingInvoice->save();

        }

        return response(["message" => "OK"], 200);
    }

    private function verifySignature($payload, $header, $secret){

        // Extract timestamp and signatures from header
        $timestamp = $this->getTimestamp($header);
        $signatures = $this->getSignatures($header, "v1");

        if (empty($signatures) || $timestamp == -1) {
            return false;
        }

        // Check if expected signature is found in list of signatures from
        // header
        $signedPayload = "$timestamp.$payload";
        $expectedSignature = $this->computeSignature($signedPayload, $secret);
        $signatureFound = false;
        foreach ($signatures as $signature) {
            if ($this->secureCompare($expectedSignature, $signature)) {
                $signatureFound = true;
                break;
            }
        }

        if (!$signatureFound) {
            return false;
        }

        return true;
    }

    private function getTimestamp($header)
    {
        $items = explode(",", $header);

        foreach ($items as $item) {
            $itemParts = explode("=", $item, 2);
            if ($itemParts[0] == "t") {
                if (!is_numeric($itemParts[1])) {
                    return -1;
                }
                return intval($itemParts[1]);
            }
        }

        return -1;
    }

    private function getSignatures($header, $scheme)
    {
        $signatures = [];
        $items = explode(",", $header);

        foreach ($items as $item) {
            $itemParts = explode("=", $item, 2);
            if ($itemParts[0] == $scheme) {
                array_push($signatures, $itemParts[1]);
            }
        }

        return $signatures;
    }

    private function computeSignature($payload, $secret)
    {
        return hash_hmac("sha256", $payload, $secret);
    }

    private function secureCompare($a, $b)
    {
        $isHashEqualsAvailable = function_exists('hash_equals');

        if ($isHashEqualsAvailable) {
            return hash_equals($a, $b);
        } else {
            if (strlen($a) != strlen($b)) {
                return false;
            }

            $result = 0;
            for ($i = 0; $i < strlen($a); $i++) {
                $result |= ord($a[$i]) ^ ord($b[$i]);
            }
            return ($result == 0);
        }
    }

}
