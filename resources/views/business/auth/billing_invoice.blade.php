<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

</head>
<style type="text/css">

</style>
<body style="margin:0;">

<div class="main-wrapper" style="max-width: 100%;">
    <div class="container" style="width: 1024px; margin:0 auto; border:1px solid #000; padding: 10px 10px;">
        <table style="width: 100%;">
            <tbody>
            <tr>
                <td style="width: 20%; vertical-align: top; text-align: center;">
                    <img src="{{ asset('img/landing/cr-logo.png') }}" class="d-inline-block" alt="">
                </td>
                <td style="width: 50%;">
                    <p style="font-size: 20px; font-weight: bold;">JobMap, Inc.</p>
                    <p style="margin-bottom: 0;">252 Rue Brunelle, Beloeil</p>
                    <p style="margin-top:0;">Quebec, Canada, H2K 4J5</p>
                    <p style="margin-bottom: 0;">GST Registration #{{ $tax ? $tax->gst_number : '0' }}</p>
                    <p style="margin-top:0;">QST Registration #{{ $tax ? $tax->qst_number : '0' }}</p>
                </td>
                <td style="width: 30%; padding-right: 25px; vertical-align: top; text-align: right;">
                    <p><strong>Date</strong> {{ $invoice->created_at }}</p>
                    <p><strong>Invoice</strong> {{ $invoice->invoice_id }}</p>
                </td>
            </tr>
            </tbody>
        </table>

        <table style="width: 100%;">
            <tbody>
            <tr>
                <td style="width: 50%;">
                    <p style="font-size: 20px; font-weight: bold;">Billed to</p>
                    <p><strong>{{ $invoice->company_name }}</strong></p>
                    <p style="margin-bottom: 0;">{{ $invoice->street_number }} {{ $invoice->street }}
                        #{{ $invoice->suite }}</p>
                    <p style="margin-top:0;">{{ $invoice->city }}, {{ $invoice->region }}, {{ $invoice->country }}</p>
                    <p style="margin-bottom: 0;">{{ $invoice->zip_code }}</p>
                    <p><strong>Client ID</strong> {{ $invoice->business_id }}</p>
                    <p><strong>Phone</strong> {{ $invoice->phone_code }} {{ $invoice->phone }}</p>
                </td>
                <td style="text-align: center; vertical-align: top; width: 50%;">
                    <p style="margin-top:30px;"><strong>Interested in how our Pricing works?</strong></p>
                    <p>Please see <a href="{{ config('app.url') }}/pricing">{{ config('app.url') }}/pricing</a></p>
                </td>
            </tr>
            </tbody>
        </table>

        <table style="width: 100%;">
            <tbody>
            <tr>
                <td>
                    <p style="font-size: 20px; font-weight: bold;">Terms and conditions</p>
                    <p>
                        All prices are shown in USD. This amount is recurring every 30 days. For full terms, please see
                        jobmap.co/terms
                    </p>
                    <p>Questions regarding this receipt? Contact us at: 1-844-244-1447 or by email at
                        billing@jobmap.co</p>
                </td>
            </tr>
            </tbody>
        </table>
        @if(!empty($payment_info['discount']))
            <table style="width: 100%;">
                <tbody>
                <tr>
                    <td style="float: right;">
                        <span style="padding:10px; background: #eee; font-weight: bold; border: 1px solid #000;">System code</span>
                        <span style="padding:10px; font-weight: bold; border: 1px solid #000; margin-left: -5px;">{{ $payment_info['discount']['code'] }}</span>
                    </td>
                </tr>
                </tbody>
            </table>
        @endif


        <table style="width: 100%; margin-top:30px; border-collapse: collapse;">
            <thead>
            <tr>
                <th style="padding:10px; background: #eee; font-weight: bold; border: 1px solid #000;">Item</th>
                <th style="padding:10px; background: #eee; font-weight: bold; border: 1px solid #000;">Quantity</th>
                <th style="padding:10px; background: #eee; font-weight: bold; border: 1px solid #000;">Price WSC
                </th>
                <th style="padding:10px; background: #eee; font-weight: bold; border: 1px solid #000;">Total</th>
            </tr>
            </thead>
            <tbody>


            <tr style="text-align: center;">
                @php
                    $price = $invoice->price * $payment_info['coefficient'];
                @endphp


                <td style="padding:10px;border: 1px solid #000;">{{ $payment_info['plan_name'] }}</td>
                <td style="padding:10px;border: 1px solid #000;">1</td>
                <td style="padding:10px;border: 1px solid #000;">
                    ${{ number_format($price ,2,'.',' ') }}</td>
                <td style="padding:10px;border: 1px solid #000;">${{ number_format($price ,2,'.',' ') }}</td>
            </tr>
            @if($invoice->coupon_id > 0)
                <tr style="text-align: center;">
                    @if($payment_info['discount']['off_an_plans_type'] === '%')
                        @php
                            $priceDiscount = $price * $payment_info['discount']['off_an_plans_value']/100;
                            $price -= $price * $payment_info['discount']['off_an_plans_value']/100;
                        @endphp
                        <td style="padding:10px;border: 1px solid #000;">Discount code
                            (<strong>{{ $payment_info['discount']['code'] }}</strong>)
                        </td>
                        <td style="padding:10px;border: 1px solid #000;">1</td>
                        <td style="padding:10px;border: 1px solid #000;">
                            -{{ number_format( $payment_info['discount']['off_an_plans_value'] ,2,'.',' ') }}%
                        </td>
                        <td style="padding:10px;border: 1px solid #000;">
                            -${{ number_format($priceDiscount ,2,'.',' ') }}</td>
                    @else
                        @php
                            $price -= $payment_info['discount']['off_an_plans_value'];
                        @endphp
                        <td style="padding:10px;border: 1px solid #000;">Discount code
                            (<strong>{{ $payment_info['discount']['code'] }}</strong>)
                        </td>
                        <td style="padding:10px;border: 1px solid #000;">1</td>
                        <td style="padding:10px;border: 1px solid #000;">
                            -${{ number_format($payment_info['discount']['off_an_plans_value'] ,2,'.',' ') }}</td>
                        <td style="padding:10px;border: 1px solid #000;">
                            -${{ number_format($payment_info['discount']['off_an_plans_value'] ,2,'.',' ') }}</td>
                    @endif
                </tr>
            @endif
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="padding: 10px 0;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                        <tr>
                            <th style="padding:10px; background: #eee; font-weight: bold; border: 1px solid #000;">
                                Sub-Total
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr style="text-align: center;">
                            <td style="padding:10px;border: 1px solid #000;">
                                @php $price = $price <0 ?0 : $price; @endphp
                                ${{ number_format($price ,2,'.',' ')  }}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            </tbody>
        </table>
        @if ($billingAddress && $billingAddress->country_code === 'CA')
            <table style="width: 70%; border-collapse: collapse; float: right;">
                <thead>
                <tr>
                    <th style="padding:10px; background: #eee; font-weight: bold; border: 1px solid #000;">Tax
                        type
                    </th>
                    <th style="padding:10px; background: #eee; font-weight: bold; border: 1px solid #000;">Tax
                        rate
                    </th>
                    <th style="padding:10px; background: #eee; font-weight: bold; border: 1px solid #000;">Applied
                        Taxes
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr style="text-align: center;">
                    <td style="padding:10px;border: 1px solid #000;">{{$payment_info['tax']['type_1']}}</td>
                    <td style="padding:10px;border: 1px solid #000;">{{$payment_info['tax']['rate_1']}}%</td>
                    <td style="padding:10px;border: 1px solid #000;">
                        ${{ $tax_1 = number_format( $price * ($payment_info['tax']['rate_1']/100) ,2,'.',' ') }}</td>
                </tr>
                <tr style="text-align: center;">
                    <td style="padding:10px;border: 1px solid #000;">{{$payment_info['tax']['type_2']}}</td>
                    <td style="padding:10px;border: 1px solid #000;">{{$payment_info['tax']['rate_2']}}%</td>
                    <td style="padding:10px;border: 1px solid #000;">
                        ${{ $tax_2 = number_format( $price * ($payment_info['tax']['rate_2']/100) ,2,'.',' ') }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>

                    <td style="padding: 10px 0;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                            <tr>
                                <th style="padding:10px; background: #eee; font-weight: bold; border: 1px solid #000;">
                                    Total with Tax
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr style="text-align: center;">
                                <td style="padding:10px;border: 1px solid #000;">
                                    @if($invoice->status ==='refund' )-@endif
                                    ${{ $total_tax = number_format( $tax_1 + $tax_2 + $price  ,2,'.',' ')}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>

                </tr>
                </tbody>
            </table>
        @endif

        <table style="width: 100%;">
            <tbody>
            <tr>
                <td><p style="text-align: center;">JobMap, Inc. wishes to thank you for your business.</p></td>
            </tr>
            </tbody>
        </table>

    </div>
</div>
</body>
</html>