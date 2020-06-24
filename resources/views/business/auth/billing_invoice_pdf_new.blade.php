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
    <div class="container" style="margin:0 auto; padding: 10px 10px;">
        <table style="width: 100%;">
            <tbody>
            <tr>
                <td style="width: 15%; vertical-align: top; text-align: center; padding: 10px">
                    <img src="{{ asset('img/jm_logo.png') }}" class="d-inline-block" alt="" width="130">
                </td>
                <td style="width: 40%;">
                    <p style="font-size: 20px; font-weight: bold;">JobMap, Inc.</p>
                    <p style="margin-bottom: 0;">4190 Laubia, Brossard, QC, Canada J4Y 0H3</p>
                    <p style="margin-bottom: 0;">GST Registration #{{ $tax_config ? $tax_config->gst_number : '0' }}</p>
                    <p style="margin-top:0;">QST Registration #{{ $tax_config ? $tax_config->qst_number : '0' }}</p>
                </td>
                <td style="width: 30%; padding-right: 25px; vertical-align: top; text-align: right;">
                    <p><strong style="font-size: 50px;">Invoice</strong></p>
                    <p><strong>Invoice number</strong> {{$invoice['number']}}</p>
                    <p><strong>Date</strong> {{$period_start}}</p>
                </td>
            </tr>
            </tbody>
        </table>
        <table style="width: 100%;">
            <tbody>
            <tr>
                <td>
                    <p style="font-size: 20px; font-weight: bold;">Bill to</p>
                    <p>{{$user['first_name']}} {{$user['last_name']}}</p>
                    <p>{{$user['city']}} {{$user['country']}}</p>
                    <p>{{$user['country']}}</p>
                    <p>({{$user['phone_code']}}) {{$user['phone_number']}}</p>
                    <p>{{$user['email']}}</p>
                </td>
            </tr>
            </tbody>
        </table>
        <p style="font-weight: bold; font-size: 30px;">{{$currency_symbol}}{{ number_format($amount_due, 2,'.',' ') }} due {{$period_start}} {{$contract_type}}</p>
        <table style="width: 100%; margin-top:30px; border-collapse: collapse;">
            <thead>
            <tr>
                <th style="padding:10px; font-weight: bold;">Period</th>
                <th style="padding:10px; font-weight: bold;">Type</th>
                <th style="padding:10px; font-weight: bold;">Qty</th>
                <th style="padding:10px; font-weight: bold;">Unit Price</th>
                <th style="padding:10px; font-weight: bold; text-align: right;">Amount</th>
            </tr>
            </thead>
            <tbody>
            <tr style="">
                <td style="padding:10px; border-top: 1px solid #ccc;">{{$period_start}} - {{$period_end}}</td>
                <td style="padding:10px; border-top: 1px solid #ccc;">{{$type_html}}</td>
                <td style="padding:10px; border-top: 1px solid #ccc;">1</td>
                <td style="padding:10px; border-top: 1px solid #ccc;">{{$currency_symbol}}{{ number_format($amount, 2,'.',' ') }}</td>
                <td style="padding:10px; border-top: 1px solid #ccc; text-align: right;">{{$currency_symbol}}{{ number_format($amount, 2,'.',' ') }}</td>
            </tr>
            <tr style="">
                <td style="padding:10px; border-top: 1px solid #ccc;"></td>
                <td style="padding:10px; border-top: 1px solid #ccc;"></td>
                <td style="padding:10px; border-top: 1px solid #ccc;"></td>
                <td style="padding:10px; border-top: 1px solid #ccc;">Subtotal</td>
                <td style="padding:10px; border-top: 1px solid #ccc; text-align: right;">{{$currency_symbol}}{{ number_format($amount, 2,'.',' ') }}</td>
            </tr>
            @if(!empty($taxes) && !empty($taxes['type_1']) && !empty($taxes['rate_1']))
                <tr style="">
                    <td style="padding:10px; border-top: 1px solid #ccc;"></td>
                    <td style="padding:10px; border-top: 1px solid #ccc;"></td>
                    <td style="padding:10px; border-top: 1px solid #ccc;"></td>
                    <td style="padding:10px; border-top: 1px solid #ccc;">Tax {{$taxes['type_1']}}</td>
                    <td style="padding:10px; border-top: 1px solid #ccc; text-align: right;">{{$currency_symbol}}{{ number_format($amount * ($taxes['rate_1']/100), 2,'.',' ') }}</td>
                </tr>
            @endif
            @if(!empty($taxes) && !empty($taxes['type_2']) && !empty($taxes['rate_2']))
                <tr style="">
                    <td style="padding:10px; border-top: 1px solid #ccc;"></td>
                    <td style="padding:10px; border-top: 1px solid #ccc;"></td>
                    <td style="padding:10px; border-top: 1px solid #ccc;"></td>
                    <td style="padding:10px; border-top: 1px solid #ccc;">Tax {{$taxes['type_2']}}</td>
                    <td style="padding:10px; border-top: 1px solid #ccc; text-align: right;">{{$currency_symbol}}{{ number_format($amount * ($taxes['rate_2']/100), 2,'.',' ') }}</td>
                </tr>
            @endif
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="padding:10px; border-top: 1px solid #ccc;">Amount due</td>
                <td style="padding:10px; border-top: 1px solid #ccc; text-align: right;">{{$currency_symbol}}{{ number_format($amount_due, 2,'.',' ') }}</td>
            </tr>
            </tbody>
        </table>
        <table style="width: 100%; text-align: center;">
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