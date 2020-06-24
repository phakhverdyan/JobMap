@extends('layouts.main_business')

@section('content')
    <style type="text/css">
        .ui-slider .ui-slider-handle {
            width: 2.2em;
            height: 2.2em;
        }

        .ui-slider-horizontal .ui-slider-handle {
            top: -.8em;
        }

        .card-table th, .card-table td {
            padding: 10px 5px;
        }

        .invoice-table tr:nth-child(odd) {
            background-color: rgba(6, 70, 166, 0.05);
        }

        .street_number {
            display: inline-block;
            width: 15%;
            margin-right: 15px;
        }

        .street {
            display: inline-block;
            width: 60%;
            margin-right: 15px;
        }

        .suite {
            display: inline-block;
            width: 16%;
        }

        .region, .city {
            display: inline-block;
            width: 33%;
            margin-right: 15px;
        }

        .zip_code {
            display: inline-block;
            width: 25%;
        }

        .c-pointer {
            cursor: pointer;
        }
        .form-control.is-invalid{
            border-width:2px;
            border-style:solid;

        }

        .business__billing__free-plan .business__billing__top-bg {
            background-color: #eeeeee;
            padding: 30px 0;
        }

        .business__billing__premium-plan {
            border: 2px solid #4266ff;
        }

        .business__billing__premium-plan .business__billing__top-bg {
            background-color: #4266ff;
            padding: 30px 0;
            color: #fff;
        }

        .business__billing__premium-plan .business__billing__monthly-yearly label {
            background: #f7f9fb;
            border: 1px solid #eeeeee;
            color: #4E5C6E;
            box-shadow: none!important;
            border-radius: 0;
        }

        .business__billing__premium-plan .business__billing__monthly-yearly label.active {
            background-color: #FFD608!important;
            border: 1px solid #FFD608!important;
            font-weight: bold;
            color: #ffffff;
            box-shadow: none!important;        
        }

        .business__billing__premium-plan button {
            background-color: #FFD608;
            color: #ffffff;
            border: 1px solid #FFD608;
            font-weight: bold;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .business__billing__premium-plan button:focus {
            background-color: #FFD608!important;
            border: 1px solid #FFD608!important;
            box-shadow: none!important; 
        }

        .business__billing__plan-choosen .business__billing__top-bg {
            background-color: #eeeeee;
            padding: 30px 0;
        }

        .business__billing__plan-choosen .business__billing__monthly-yearly label {
            background: #f7f9fb;
            border: 1px solid #eeeeee;
            color: #4E5C6E;
            box-shadow: none!important;
            border-radius: 0;
        }

        .business__billing__plan-choosen .business__billing__monthly-yearly label.active {
            background-color: #FFD608!important;
            border: 1px solid #FFD608!important;
            font-weight: bold;
            color: #ffffff;
            box-shadow: none!important;        
        }

        .business__billing__plan-choosen .business__billing__monthly-yearly button {
            background-color: #FFD608;
            color: #ffffff;
            border: 1px solid #FFD608;
            font-weight: bold;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

    </style>
    <div class="container-fluid">
        <div class="row">
            <div id="slide-out" class="pr-0 pl-0 sidebar_adaptive" style="width: 320px;">
                @include('components.sidebar.sidebar_business')
            </div>
            <div class="col-xl-9 col-11 mt-5 pb-5 mx-auto billing-info-wrapper content-main">
                <div class="col-12 text-center mx-auto rounded bg-white py-3">
                    <div class="row">
                        <div class="col-6">
                            <p>Paid</p>
                            <table id="current-paid-table" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="border: none; padding: 0;"></th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>

                            <div class="col-lg-12 text-left" id="current-total-amount">
                                <div class="row">
                                    <div class="col-lg-6 monthly-total-amount"><strong>Total Licences ( Monthly ) <span class="total-amount">$0</span></strong></div>
                                    <div class="col-lg-6 yearly-total-amount"><strong>Total Licences ( Yearly ) <span class="total-amount">$0</span></strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <p>Credit Cards</p>
                            <table class="table table-responsive display responsive no-wrap" id="credit-cards-table" style="width:100%">
                                <thead>
                                <tr>
                                    <th style="width:25%;" scope="col"></th>
                                    <th style="width:25%;" scope="col"></th>
                                    <th style="width:50%;" scope="col"></th>
                                </tr>
                                </thead>
                            </table>
                            <a class="btn btn-outline-primary ml-2 mb-3" data-target="#create-cart-modal" data-toggle="modal" href="#">Add new Credit Card</a>
                        </div>
                        <div class="col-6">

                        </div>

                        <div class="col-lg-12">
                            <p>Invoices</p>
                            <div class="row">
                                <div class="col-3">
                                    <select class="form-control" name="type_invoices">
                                        <option value="user-and-location">Scanner & Access Licences</option>
                                        <option value="location">Scanner Licences Only</option>
                                        <option value="user">Access Licences Only</option>
                                    </select>
                                </div>
                                <div class="col-3 ">
                                    <div class="d-flex flex-lg-row flex-column justify-content-start">
                                        <div class="d-flex col-12 pl-0 col-lg-12 pxa-0 justify-content-between mb-3 mb-lg-0" style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;">
                                            <input name="find_invoices_by_customer_email"  type="text" class="form-control border-0 ml-2" style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;" placeholder="Find by email">
                                            <div class="align-self-center mr-3 mr-lg-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 250.313 250.313" style="enable-background:new 0 0 250.313 250.313; opacity: 0.1;" xml:space="preserve" widht="17px" height="17px">
                                                <g id="Search">
                                                    <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M244.186,214.604l-54.379-54.378c-0.289-0.289-0.628-0.491-0.93-0.76   c10.7-16.231,16.945-35.66,16.945-56.554C205.822,46.075,159.747,0,102.911,0S0,46.075,0,102.911   c0,56.835,46.074,102.911,102.91,102.911c20.895,0,40.323-6.245,56.554-16.945c0.269,0.301,0.47,0.64,0.759,0.929l54.38,54.38   c8.169,8.168,21.413,8.168,29.583,0C252.354,236.017,252.354,222.773,244.186,214.604z M102.911,170.146   c-37.134,0-67.236-30.102-67.236-67.235c0-37.134,30.103-67.236,67.236-67.236c37.132,0,67.235,30.103,67.235,67.236   C170.146,140.044,140.043,170.146,102.911,170.146z"></path>
                                                </g>
                                            </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="input-group date" id="filter-invoices-from_date" data-target-input="nearest">
                                            <input placeholder="From" type="text" name="date_from_filter_invoices" class="form-control datetimepicker-input" data-target="#filter-invoices-from_date"/>
                                            <div class="input-group-addon" data-target="#filter-invoices-from_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="input-group date" id="filter-invoices-to_date" data-target-input="nearest">
                                            <input placeholder="To" type="text" name="date_to_filter_invoices" class="form-control datetimepicker-input" data-target="#filter-invoices-to_date"/>
                                            <div class="input-group-addon" data-target="#filter-invoices-to_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <table id="table-invoices-data" class="table table-responsive display responsive no-wrap" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="create-cart-modal" tabindex="-1" role="dialog"
        data-secret="
        @php
        \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
        echo $intent = \Stripe\SetupIntent::create()->client_secret;
        @endphp
        "
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new Credit Card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <p class="error-message" style="color: red; font-weight: bold;"></p>
                                <form id="create-card-form" method="post" autocomplete="off">
                                    <div class="row">
                                        <div class=" col-lg-12">
                                            <!-- <input class="form-control card-number my-custom-class" name="card-number"  autocomplete="off">
                                            <input class="form-control name" id="the-card-name-id" name="card-holders-name"
                                                   placeholder="Name on card"  autocomplete="off">
                                            <input class="form-control expiry-month" name="expiry-month"  autocomplete="off">
                                            <input class="form-control expiry-year" name="expiry-year"  autocomplete="off">
                                            <input class="form-control cvc" name="cvc"  autocomplete="off"> -->
                                            <div id="card-element"></div>

                                        </div>
                                        <div class="col-lg-12">
                                            <button class="btn btn-outline-primary ml-3 mt-3 pull-right" type="submit">Add Card</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
{{--                <div class="modal-footer justify-content-center bg-light">--}}
{{--                    <div class="bg-white">--}}
{{--                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal"--}}
{{--                                aria-label="{!! trans('main.buttons.close') !!}">--}}
{{--                            {!! trans('main.buttons.close') !!}--}}
{{--                        </button>--}}
{{--                        <button type="button" class="btn btn-outline-primary"--}}
{{--                                id="business-cancel-payment-confirm">--}}
{{--                            Add Card--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="show-paid-locations-modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Paid Locations</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12" style="padding-bottom: 25px; padding-left: 0;">
                                <a href="{!! url('/business/branch/locations') !!}">Manage Locations</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex flex-lg-row flex-column justify-content-start">
                                <div class="d-flex col-12 pl-0 col-lg-12 pxa-0 justify-content-between mb-3 mb-lg-0" style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;">
                                    <input name="find_paid_location"  type="text" class="form-control border-0 ml-2" style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;" placeholder="Find">
                                    <div class="align-self-center mr-3 mr-lg-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 250.313 250.313" style="enable-background:new 0 0 250.313 250.313; opacity: 0.1;" xml:space="preserve" widht="17px" height="17px">
                                                <g id="Search">
                                                    <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M244.186,214.604l-54.379-54.378c-0.289-0.289-0.628-0.491-0.93-0.76   c10.7-16.231,16.945-35.66,16.945-56.554C205.822,46.075,159.747,0,102.911,0S0,46.075,0,102.911   c0,56.835,46.074,102.911,102.91,102.911c20.895,0,40.323-6.245,56.554-16.945c0.269,0.301,0.47,0.64,0.759,0.929l54.38,54.38   c8.169,8.168,21.413,8.168,29.583,0C252.354,236.017,252.354,222.773,244.186,214.604z M102.911,170.146   c-37.134,0-67.236-30.102-67.236-67.235c0-37.134,30.103-67.236,67.236-67.236c37.132,0,67.235,30.103,67.235,67.236   C170.146,140.044,140.043,170.146,102.911,170.146z"></path>
                                                </g>
                                            </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <table id="table-paid-location-data" class="table table-responsive display responsive no-wrap" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal"
                                aria-label="{!! trans('main.buttons.close') !!}">
                            {!! trans('main.buttons.close') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="show-paid-users-modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Paid Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="d-flex flex-lg-row flex-column justify-content-start">
                                <div class="d-flex col-12 pl-0 col-lg-12 pxa-0 justify-content-between mb-3 mb-lg-0" style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;">
                                    <input name="find_paid_user"  type="text" class="form-control border-0 ml-2" style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;" placeholder="Find">
                                    <div class="align-self-center mr-3 mr-lg-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 250.313 250.313" style="enable-background:new 0 0 250.313 250.313; opacity: 0.1;" xml:space="preserve" widht="17px" height="17px">
                                                <g id="Search">
                                                    <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M244.186,214.604l-54.379-54.378c-0.289-0.289-0.628-0.491-0.93-0.76   c10.7-16.231,16.945-35.66,16.945-56.554C205.822,46.075,159.747,0,102.911,0S0,46.075,0,102.911   c0,56.835,46.074,102.911,102.91,102.911c20.895,0,40.323-6.245,56.554-16.945c0.269,0.301,0.47,0.64,0.759,0.929l54.38,54.38   c8.169,8.168,21.413,8.168,29.583,0C252.354,236.017,252.354,222.773,244.186,214.604z M102.911,170.146   c-37.134,0-67.236-30.102-67.236-67.235c0-37.134,30.103-67.236,67.236-67.236c37.132,0,67.235,30.103,67.235,67.236   C170.146,140.044,140.043,170.146,102.911,170.146z"></path>
                                                </g>
                                            </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <table id="table-paid-user-data" class="table table-responsive display responsive no-wrap" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal"
                                aria-label="{!! trans('main.buttons.close') !!}">
                            {!! trans('main.buttons.close') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('/js/app/business-new-billing.js?v='.time()) }}"></script>

@endsection