@extends('admin::layouts.app')

@section('content')

    <div class="ml-3 mt-2" style="width: 100%;">

        <div class="col-12">
            <div class="d-inline-flex">
                <form action="/nexus/billing" method="GET" id="conditions-form">
                    <div>
                        <p>Billing</p>
                        <div class="d-flex justify-content-around">
                            <input type="hidden" name="ordered-name"
                                   value="{{ app('request')->input('ordered-name') }}">
                            <input type="hidden" name="ordered-direction"
                                   value="{{ app('request')->input('ordered-direction') }}">
                            <div class="mr-3" style="">
                                <input type="text" name="invoice_id" class="form-control form-control-sm"
                                       placeholder="Invoice ID">
                            </div>
                            <div class="mr-3">
                                <input type="text" name="client_s" class="form-control form-control-sm"
                                       placeholder="Client ID/name">
                            </div>
                            <div class="mr-3">
                                <select name="filter_status" class="form-control-sm">
                                    <option value="">Status</option>
                                    <option value="paid" {{ app('request')->input('filter_status') == 'paid' ? 'selected':'' }}>
                                        Paid
                                    </option>
                                    <option value="unpaid" {{ app('request')->input('filter_status') == 'unpaid' ? 'selected':'' }}>
                                        Unpaid
                                    </option>
                                </select>
                            </div>
                            <div class="mr-3">
                                <select name="coupon_id" class="form-control-sm">
                                    <option value="">Coupon</option>
                                    @foreach($coupons as $coupon)
                                        <option value="{{ $coupon->id }}" {{ app('request')->input('coupon_id') == $coupon->id ? 'selected':'' }}>
                                            {{ $coupon->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mr-3">
                                <button type="submit" class="btn btn-primary btn-sm">Find</button>
                            </div>
                            <div class="mr-3">
                                <a href="/nexus/billing" class="btn btn-info btn-sm">Clear</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-12 mt-3">
            <form action="/nexus/billing" class="filter-form" method="GET">
                <input type="hidden" name="filter_status" value="">
                <div class="btn-group">
                    <button id="btn-paid"
                            class="btn btn-outline-primary {{ app('request')->input('filter_status') == 'paid' ? 'active':'' }}">
                        PAID ({{ isset($status['paid']->count)?$status['paid']->count:0 }})
                    </button>
                    <button id="btn-unpaid"
                            class="btn btn-outline-primary  {{ app('request')->input('filter_status') == 'unpaid' ? 'active':'' }}">
                        UNPAID ({{ isset($status['unpaid']->count)?$status['unpaid']->count: 0 }})
                    </button>
                </div>
            </form>
        </div>

        <div class="col-12 mt-3">
            <table class="table table-ordered">
                <thead>
                <tr>
                    <th>
                        Client ID
                        <a href="" class="billing-ordered" data-order-name="client-id" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1" width="16" height="16" viewBox="0 0 16 16"
                                 style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>
                        Client Name
                        <a href="" class="billing-ordered" data-order-name="client-name" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1" width="16" height="16" viewBox="0 0 16 16"
                                 style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>
                        Business name
                        <a href="" class="billing-ordered" data-order-name="business-name" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1" width="16" height="16" viewBox="0 0 16 16"
                                 style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>
                        Invoice
                        <a href="" class="billing-ordered" data-order-name="invoice" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1" width="16" height="16" viewBox="0 0 16 16"
                                 style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>Status</th>
                    <th>
                        Total
                        <a href="" class="billing-ordered" data-order-name="total" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1" width="16" height="16" viewBox="0 0 16 16"
                                 style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>
                        Date
                        <a href="" class="billing-ordered" data-order-name="date" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1" width="16" height="16" viewBox="0 0 16 16"
                                 style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>
                        Coupon
                        <a href="" class="billing-ordered" data-order-name="coupon" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1" width="16" height="16" viewBox="0 0 16 16"
                                 style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th class="ml-auto">Open Tickets</th>
                    <th class="ml-auto">Cancel</th>
                    <th class="ml-auto">Refund</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $billings as $billing )
                    <tr>
                        <td><a href="#">{{ $billing->client_id }}</a></td>
                        <td>{{ $billing->client_name }}</td>
                        <td><a href="#">{{ $billing->business_name }}</a></td>
                        <td><a href="/nexus/invoice/{{ $billing->charge_id }}"
                               target="_blank">{{ $billing->invoice_id }}</a></td>
                        <td>{{ $billing->status }}</td>
                        <td>{{ $billing->total }}</td>
                        <td>{{ \Carbon\Carbon::parse($billing->created_at)->format('Y-m-d') }}</td>
                        <td>{{ $billing->discounts_name }}</td>
                        <td>1(23)</td>
                        <td>
                            @if( $billing->current > 0)
                                <a href="/nexus/invoice/cancel/{{ $billing->id }}" target="_blank">Cancel</a>
                            @endif
                        </td>
                        <td>
                            @if($billing->current > 0)
                                <a href="/nexus/invoice/refund/{{ $billing->id }}" target="_blank">Refund</a>
                            @endif
                        </td>

                    </tr>

                @endforeach
                </tbody>
            </table>
            {{ $billings->appends(request()->query())->links('admin::vendor.bootstrap-4') }}
        </div>
    </div>
    <script>
        $('#btn-paid').on('click', function () {
            $('.filter-form input[name="filter_status"]').val('paid');
            $('.filter-form').submit();
        });
        $('#btn-unpaid').on('click', function () {
            $('.filter-form input[name="filter_status"]').val('unpaid');
            $('.filter-form').submit();
        });

        $('.billing-ordered').on('click', function (e) {

            $('.table-ordered a.billing-ordered').each(function () {

                var globOrderName = $('#conditions-form input[name="ordered-name"]').val();
                var globOrderDirection = $('#conditions-form input[name="ordered-direction"]').val();

                if ($(this).data('order-name') == globOrderName) {
                    if ($(this).data('order-direction') == globOrderDirection && globOrderDirection == 'asc') {
                        $(this).data('order-direction', 'desc');
                    } else if ($(this).data('order-direction') == globOrderDirection && orderDirection == 'desc') {
                        $(this).data('order-direction', 'asc');
                    }
                }
            });

            var orderName = $(this).data('order-name');
            var orderDirection = $(this).data('order-direction');
            e.preventDefault();

            $('#conditions-form input[name="ordered-name"]').val(orderName);
            $('#conditions-form input[name="ordered-direction"]').val(orderDirection);
            $('#conditions-form').submit();
        });
    </script>
@endsection