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


                    <p class="[ js-plan-changes-block ] h2 text-right d-none">
                        <button class="[ js-cancel-plan ] btn btn-primary d-none">{!! trans('main.buttons.cancel') !!}</button>
                        <button class="[ js-upgrade-plan ] btn btn-primary d-none">{!! trans('main.buttons.upgrade') !!}</button>
                        <button class="[ js-downgrade-plan ] btn btn-primary d-none">{!! trans('main.buttons.downgrade') !!}</button>
                        
                        <a class="[ js-add-creadit-card ] btn btn-primary d-none" href="{!! url('/business/billing/modify') !!}">
                            {!! trans('main.buttons.add_credit_card') !!}
                        </a>

                        <!-- <button class="btn btn-primary js-add-card">{!! trans('main.buttons.add_card') !!}</button> -->
                        <!-- <button class="[ js-cancel-plan ] btn btn-primary d-none">{!! trans('main.buttons.cancel') !!}</button> -->
                    </p>
                    <!-- ------------------------------------------ -->
                    <div class="pricing_section">
                        <p class="h2 text-center mb-5">Pricing</p>
                        <div class="d-flex justify-content-end mb-3">
                            <div class="d-inline-block">
                                <p class="text-right h6">
                                    <i><strong>"It did wonder for us when we needed to organize ourselves without breaking the bank"</strong></i>
                                </p>
                                <p class="text-left">Clavela Ortiz - Modul Xtra</p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start mb-3">
                            <div class="d-inline-block">
                                <p class="text-left h6">
                                    <i><strong>"With JobMap you only pay for results, so that's why I recommend to keep the Regular plan until you need it" </strong></i>
                                </p>
                                <p class="text-left">Étienne Claessens - President of Soluflex</p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center flex-lg-row flex-column">
                            <div class="col-lg-4 px-0 border rounded [ business__billing__free-plan ] align-self-start">
                                <div class="[ business__billing__top-bg ]">
                                    <p class="mb-0 text-center"><strong>Regular Plan</strong></p>
                                </div>
                                <hr class="mt-0">
                                <div class="border-top border-bottom">
                                    <p class="mb-0 text-center">Free</p>
                                </div>
                                <hr>
                                <div class="px-3">
                                    <ul class="pl-0 text-left" style="list-style: none;">
                                          <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.1') !!}
                                          </li>
                                          <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.2') !!}
                                          </li>
                                          <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.3') !!}
                                          </li>
                                          <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.4') !!}
                                          </li>
                                          <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.5') !!}
                                          </li>
                                          <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.6') !!}
                                          </li>
                                          <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.7') !!}
                                          </li>
                                          <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.8') !!}
                                          </li>
                                          <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.9') !!}
                                          </li>
                                          <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.10') !!}
                                          </li>
                                          <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.11') !!}
                                          </li>
                                          <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.12') !!}
                                          </li>
                                        </ul>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-4 px-0 rounded [ business__billing__premium-plan ]">
                                <div class="[ business__billing__top-bg ]">
                                    <p class="mb-0 text-center"><strong>Premium Plan</strong></p>
                                </div>
                                <hr class="mt-0">
                                <div class="border-top border-bottom">
                                    <div class="d-flex justify-content-center mb-0 text-center">
                                        <p class="mb-0 align-self-center">{!! trans('landing.pricing.benefit_list.second_section.plans.monthly_price') !!} </p>
                                        <span class="align-self-start ml-2"><small>{!! trans('landing.pricing.benefit_list.second_section.month_free') !!}</small></span>
                                    </div>
                                </div>
                                
                                <div class="btn-group my-3 btn-group-toggle w-100 [ business__billing__monthly-yearly ]" data-toggle="buttons">
                                    <label class="btn col-6 py-4 btn-primary active">
                                        <input type="radio" name="options" id="option1" autocomplete="off" checked> Monthly
                                    </label>
                                    <label class="btn col-6 py-4 btn-primary">
                                        <input type="radio" name="options" id="option2" autocomplete="off"> Yearly 10% off
                                    </label>
                                </div>
                                
                                <p class="mb-0">Recommended for businesses with Website</p>
                                <hr>
                                <div class="px-3 mb-3">
                                    <ul class="pl-0 text-left" style="list-style: none;">
                                            <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.1') !!}
                                            </li>
                                            <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.2') !!}
                                            </li>
                                            <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.3') !!}
                                            </li>
                                            <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.4') !!}
                                            </li>
                                            <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.5') !!}
                                            </li>
                                            <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.6') !!}
                                            </li>
                                            <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.7') !!}
                                            </li>
                                            <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.8') !!}
                                            </li>
                                            <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.9') !!}
                                            </li>
                                            <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.10') !!}
                                            </li>
                                            <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.11') !!}
                                            </li>
                                            <li class="py-2">
                                            @svg('img/checked_pricing.svg', [
                                              'width' => '20px',
                                              'height' => '20px',
                                              'class' => 'mr-2',
                                              'style' => 'vertical-align:middle; margin-top:-3px;'
                                            ])
                                            {!! trans('landing.pricing.benefit_list.first_section.12') !!}
                                            </li>
                                            <li class="py-2">
                                              @svg('img/checked_pricing.svg', [
                                                'width' => '20px',
                                                'height' => '20px',
                                                'class' => 'mr-2',
                                                'style' => 'vertical-align:middle; margin-top:-3px;'
                                              ])
                                              {!! trans('landing.pricing.benefit_list.second_section.list.1') !!}
                                            </li>
                                            <li class="py-2">
                                              @svg('img/checked_pricing.svg', [
                                                'width' => '20px',
                                                'height' => '20px',
                                                'class' => 'mr-2',
                                                'style' => 'vertical-align:middle; margin-top:-3px;'
                                              ])
                                              {!! trans('landing.pricing.benefit_list.second_section.list.2') !!}
                                            </li>
                                            <li class="py-2">
                                              @svg('img/checked_pricing.svg', [
                                                'width' => '20px',
                                                'height' => '20px',
                                                'class' => 'mr-2',
                                                'style' => 'vertical-align:middle; margin-top:-3px;'
                                              ])
                                              {!! trans('landing.pricing.benefit_list.second_section.list.3') !!}
                                            </li>
                                            <li class="py-2">
                                              @svg('img/checked_pricing.svg', [
                                                'width' => '20px',
                                                'height' => '20px',
                                                'class' => 'mr-2',
                                                'style' => 'vertical-align:middle; margin-top:-3px;'
                                              ])
                                              {!! trans('landing.pricing.benefit_list.second_section.list.4') !!}
                                            </li>
                                            <li class="py-2">
                                              @svg('img/checked_pricing.svg', [
                                                'width' => '20px',
                                                'height' => '20px',
                                                'class' => 'mr-2',
                                                'style' => 'vertical-align:middle; margin-top:-3px;'
                                              ])
                                              {!! trans('landing.pricing.benefit_list.second_section.list.5') !!}
                                            </li>
                                            <li class="py-2">
                                              @svg('img/checked_pricing.svg', [
                                                'width' => '20px',
                                                'height' => '20px',
                                                'class' => 'mr-2',
                                                'style' => 'vertical-align:middle; margin-top:-3px;'
                                              ])
                                              {!! trans('landing.pricing.benefit_list.second_section.list.6') !!}
                                            </li>
                                            <li class="py-2">
                                              @svg('img/checked_pricing.svg', [
                                                'width' => '20px',
                                                'height' => '20px',
                                                'class' => 'mr-2',
                                                'style' => 'vertical-align:middle; margin-top:-3px;'
                                              ])
                                              {!! trans('landing.pricing.benefit_list.second_section.list.7') !!}
                                            </li>
                                    </ul>
                                </div>
                                <div class="text-center mb-3">
                                    <button type="button">Upgrade Plan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ------------------------------------------ -->
                    <div class="pricing_now mt-5">
                      <div class="[ business__billing__plan-choosen ] border rounded">
                        <div class="[ business__billing__top-bg ]">
                          <p class="mb-0">Actual Plan</p>
                        </div>
                        <div class="py-4 border-bottom">
                          <strong>24/25 active licences</strong>
                        </div>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-center flex-lg-row flex-column">
                          <div class="col-lg-1"></div>
                          <div class="col-lg-4 text-left">
                            <p><strong>Pricing listing</strong></p>
                            <div>
                              <p>-0-99 licences = 25$ /mois/licences</p>
                              <p>-100-299 licences = 21$ /mois/licence</p>
                              <p>-300-999 licences = 18$ /mois/licence</p>
                              <p>-1000 licences et plus = 15$ /mois/licence</p>
                              <p><small>*Get 10% discount by selecting yearly deal</small></p>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <p class="mb-1 text-center">At the moment you are on a </p>
                            <p class="text-center h3">Monthly Plan</p>
                            <div class="btn-group w-100">
                              <button class="btn btn-outline-primary col-lg-4" style="font-size: 23px;">-</button>
                              <div class="text-center col-lg-4 h3" style="line-height: 44px;">25</div>
                              <button class="btn btn-outline-primary col-lg-4" style="font-size: 23px;">+</button>
                            </div>
                            <div class="btn-group mb-3 btn-group-toggle w-100 [ business__billing__monthly-yearly ]" data-toggle="buttons">
                                <label class="btn col-6 py-4 btn-primary active">
                                    <input type="radio" name="options" id="option1" autocomplete="off" checked>$625 / Monthly
                                </label>
                                <label class="btn col-6 py-4 btn-primary">
                                    <input type="radio" name="options" id="option2" autocomplete="off"> $1625 / Year
                                </label>
                            </div>
                            <div class="d-flex justify-content-between mb-3 flex-lg-row flex-column">
                              <button class="btn btn-outline-primary">Cancel</button>
                              <button class="btn btn-primary">Confirm new plan</button>
                            </div>
                            <p class="text-right"><small>*adjusted price will be available on next invoice with the Prorata</small> </p>
                          </div>
                          <div class="col-lg-1"></div>
                        </div>
                      </div>
                    </div>
                </div>
                <!-- billing-info block -->
                <div class="billing-info mt-3">
                    <div class="row">
                        <div class="col-12 clear-xs-padding">
                            <div class="card border-0 rounded clear-padding">
                                <!-- header -->
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="col-lg-6 col-12 pull-left">
                                            <!-- <img alt="education" src="{{ asset('/ui/app/img/credit-card.png') }}" /> -->
                                                <span class="header-title">{!! trans('pages.text.billing.table_title') !!}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- content -->
                                <div class="card-content">
                                    <div class="billing-info table-responsive">
                                        <table class="table table-condensed card-table">
                                            <thead>
                                            <tr>
                                                <th class="text-center">{!! trans('pages.text.billing.table.type') !!}</th>
                                                <th class="text-center">{!! trans('pages.text.billing.table.name') !!}</th>
                                                <th class="text-center">{!! trans('pages.text.billing.table.number') !!}</th>
                                                <th class="text-center">{!! trans('pages.text.billing.table.valid') !!}</th>
                                                <th style="width: 50px;"></th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody class="billing-credit-cards"></tbody>
                                        </table>
                                        <div class="12 text-center">
                                            <a class="btn btn-outline-primary ml-2 mb-3"
                                               href="{!! url('/business/billing/modify')  !!}">{!! trans('main.buttons.add_new_cc') !!}</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- end content -->
                            </div>
                            <!-- end card -->
                        </div>
                    </div>

                    <br>

                    <div class="row js-invoices-list d-none">
                        <div class="col-12">
                            <!-- card -->
                            <div class="card">
                                <!-- header -->
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="col-lg-6 col-12 pull-left">
                                            <!-- <img alt="education" src="{{ asset('/ui/app/img/invoice.png') }}" /> -->
                                                <span class="header-title">{!! trans('pages.text.billing.table_2_title') !!}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- content -->
                                <div class="card-content">
                                    <div class="billing-info table-responsive">
                                        <table class="table table-condensed invoice-table">
                                            <thead>
                                            <tr>
                                                <th class="text-center">{!! trans('pages.text.billing.table_2.id') !!}</th>
                                                <th class="text-center">{!! trans('pages.text.billing.table_2.date') !!}</th>
                                                <th class="text-center">{!! trans('pages.text.billing.table_2.type') !!}</th>
                                                <th class="text-center">{!! trans('pages.text.billing.table_2.state') !!}</th>
                                                <th class="text-center">{!! trans('pages.text.billing.table_2.total') !!}</th>
                                                <th class="text-center">{!! trans('pages.text.billing.table_2.export') !!}</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mx-auto mt-2">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination pagination-content">
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <!-- end card content -->
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                </div>
                <!-- end billing-info -->
            </div>
        </div>
    </div>

    <!-- Upgrade Billing MODAL -->
    <div class="modal fade" id="upgradeBilling" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 700px;">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title">{!! trans('modals.title.billing_confirm') !!}</h5>
                    <button type="button" class="close text-right mt-0" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-3">
                    <div class="col-12">
                        <div>
                            <p>
                                <img src="{{ asset('img/sidebar/active.png') }}" style="margin-top:-3px;"/>
                                {!! trans('modals.text.billing.payment_method') !!}
                                <img src="" style="height: 20px; margin-top: -3px;" class="mx-2 js-cardType">
                                <select name="card" class="js-last-four"></select>
                                {{--<button class="btn btn-outline-primary-boot btn-sm ml-2">Change</button>--}}
                                <span style="float: right;">
                                    <button class="btn btn-primary js-pay-stripe">{!! trans('main.buttons.continue') !!}</button>
                                </span>
                            </p>
                        </div>

                    </div>
                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <p>
                                    <strong>{!! trans('modals.text.billing.billing_contact') !!}
                                        <span class="ml-2">
                                            <button class="btn btn-outline-primary-boot btn-sm js-billingContact">{!! trans('main.buttons.change') !!}</button>
                                        </span>
                                    </strong>
                                </p>
                                <div class="js-billing-address">
                                    <p class="my-0"></p>
                                    <p class="my-0"></p>
                                    <p class="my-0"></p>
                                    <p class="my-0"></p>
                                    <p class="mt-0"></p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div id="upgradeBilling__payment-type">
                                    Plan type:
                                    <select name="payment_type" id="upgradeBilling__payment-type-select">
                                        <option value="month" selected>Month</option>
                                        <option value="year">Year</option>
                                    </select>
                                </div>
                                <br><br>
                                <div id="upgradeBilling__next-payment-type">
                                    Next plan type:
                                    <select name="next_payment_type" id="upgradeBilling__next-payment-type-select">
                                        <option value="month" selected>Month</option>
                                        <option value="year">Year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="mb-5 d-flex">
                                    <span class="mr-2 pt-2">
                                        <strong>{!! trans('modals.text.billing.code') !!}</strong></span>
                                    <div class="btn-group">
                                        <input type="text" name="coupon" class="form-control form-control-sm js-coupon">
                                        {{--<button class="btn btn-outline-primary btn-sm js-checkCoupon">Verify</button>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between flex-column flex-lg-row col-12">
                        <p class="mb-0 mt-2">
                            <span class="h4">{!! trans('modals.text.billing.plan') !!}</span>
                            <span class="ml-2">
                                <button class="btn btn-outline-primary-boot btn-sm js-change-plan"
                                        style="margin-top: -5px;">{!! trans('main.buttons.change') !!}</button>
                            </span>
                        </p>
                        <p class="h4 text-lg-right text-center mb-0">
                            <span class="js-total-price-per-month">{!! trans('modals.text.billing.total_per_month') !!}</span>
                            <span class="js-total-price-per-year">{!! trans('modals.text.billing.total_per_year') !!}</span>
                            <span class="js-price-to-upgrade d-none">{!! trans('modals.text.billing.price_to_upgrade') !!}</span>
                            <span class="js-ca-tax">{!! trans('modals.text.billing.tax') !!}</span>
                            <span class="h2"><strong class="js-price-permonth"></strong></span>
                        </p>
                    </div>


                    <table style="width: 100%; margin-top:30px; border-collapse: collapse;">
                        <thead>
                        <tr class="text-center">
                            <th class="p-2" style="width: 25%; background: #eee; font-weight: bold;">{!! trans('modals.text.billing.table_1.item') !!}</th>
                            <th class="p-2" style="width: 25%; background: #eee; font-weight: bold;">{!! trans('modals.text.billing.table_1.quantity') !!}</th>
                            <th class="p-2" style="width: 25%; background: #eee; font-weight: bold;">{!! trans('modals.text.billing.table_1.price') !!}</th>
                            <th class="p-2" style="width: 25%; background: #eee; font-weight: bold;">{!! trans('modals.text.billing.table_1.total') !!}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center js-price-description">
                            <td class="border p-2">{!! trans('modals.text.billing.table_1.applicants') !!}</td>
                            <td class="border p-2">1</td>
                            <td class="border p-2"></td>
                            <td class="border p-2"></td>
                        </tr>


                        <tr class="text-center">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="padding: 10px 0;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                    <tr>
                                        <th class="p-2 js-subtotal-text" style="background: #eee; font-weight: bold;">
                                            {!! trans('modals.text.billing.table_1.sub_total') !!}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="text-center">
                                        <td class="border p-2 js-subtotal"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    <table style="width: 100%; border-collapse: collapse; float: right;" class="js-tax-table">
                        <thead>
                        <tr class="text-center">
                            <th style="width: 25%;"></th>
                            <th style="width: 25%; padding:10px; background: #eee; font-weight: bold;">{!! trans('modals.text.billing.table_2.tax_type') !!}</th>
                            <th style="width: 25%; padding:10px; background: #eee; font-weight: bold;">{!! trans('modals.text.billing.table_2.tax_rate') !!}</th>
                            <th style="width: 25%; padding:10px; background: #eee; font-weight: bold;">{!! trans('modals.text.billing.table_2.applied_taxes') !!}
                            </th>
                        </tr>
                        </thead>
                        <tbody class="js-tax">

                        <tr class="text-center">
                            <td></td>
                            <td></td>
                            <td></td>

                            <td style="padding: 10px 0;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                    <tr>
                                        <th class="p-2" style="background: #eee; font-weight: bold;">{!! trans('modals.text.billing.table_2.total_w_tax') !!}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="text-center">
                                        <td class="border p-2 js-total-price"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>

                        </tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
    <!-- Upgrade Billing MODAL  -->

    <!-- Payment problem MODAL -->
    <div class="modal fade" id="paymentProblem" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title">{!! trans('modals.title.billing_payment_problem') !!}</h5>
                    <button type="button" class="close text-right mt-0" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center h6"><img src="{{ asset('img/sidebar/not-active.png') }}"
                                                   style="margin-top: -3px;" class="mr-2"/> {!! trans('modals.text.billing.error_transaction') !!}</p>
                    <p class="text-center mb-0 mt-3">
                        <button class="btn btn-primary">{!! trans('main.buttons.change_pay_method') !!}</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Payment problem MODAL  -->

    <!-- Billing information change MODAL -->
    <div class="modal fade" id="billingContact" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title">{!! trans('modals.title.billing_information') !!}</h5>
                    <button type="button" class="close text-right mt-0 js-close-modal-update" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        <input type="text" name="company_name" placeholder="{!! trans('fields.placeholder.business_name') !!}"
                               class="form-control js-billing-company_name">
                    </p>
                    <p class="text-center">
                        <input type="text" name="owner_name" placeholder="{!! trans('fields.placeholder.owner_name') !!}"
                               class="form-control js-billing-owner_name">
                    </p>
                    <p class="text-center">
                        <input type="text" name="street_number" value="" placeholder="{!! trans('fields.placeholder.street_number') !!}"
                               class="form-control street_number js-billing-street_number">
                        <input type="text" name="street" value="" placeholder="{!! trans('fields.placeholder.street_address') !!}"
                               class="form-control street js-billing-street">
                        <input type="text" name="suite" value="" placeholder="{!! trans('fields.placeholder.suite') !!}"
                               class="form-control suite js-billing-suite">
                    </p>
                    <div class="form-group input-group mb-2">
                        <span class="input-group-addon bg-white" id="basic-addon1">
                            <i class="glyphicon"></i>
                        </span>
                        <input type="text" id="user-location" name="city" class="form-control bg-white"
                               placeholder="{!! trans('fields.placeholder.city') !!}">
                        <span class="input-group-btn border-0">
                            <button class="btn mx-0" type="button" id="user-location-clear"
                                    style="background-color: #e9ecef; border: 1px solid #ced4da; border-left: 0px;">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </button>
                        </span>
                    </div>
                    <p>
                        <input type="text" name="zip_code" placeholder="{!! trans('fields.placeholder.zip_code') !!}"
                               class="form-control zip_code js-billing-zip_code">
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-primary-boot btn-sm js-open-upgrade">{!! trans('main.buttons.save') !!}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Billing information change MODAL  -->

    <!-- Payment Choose card MODAL -->
    <div class="modal fade" id="chooseCard" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title">{!! trans('modals.title.billing_choose_card') !!}</h5>

                    <button type="button" class="close text-right mt-0 " data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label>{!! trans('fields.label.card_last_4') !!}</label>
                        <input type="text" name="last_four_numbers" class="form-control"
                               placeholder="{!! trans('fields.placeholder.card_last_4') !!}">
                    </div>
                    <p class="text-center mb-0 mt-3">
                        <button class="btn btn-primary js-check-four">{!! trans('main.buttons.change_pay_method') !!}</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Payment problem MODAL  -->
    <!--Confirm modal for delete-->
    <div class="modal fade bd-example-modal-lg" id="delete-button-modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.cancel_payment') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                {!! trans('modals.text.billing.payment_cancel') !!}
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
                        <button type="button" class="btn btn-outline-primary"
                                id="business-cancel-payment-confirm">
                            {!! trans('main.buttons.cancel_payment') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.modal.downgrade')
    @include('components.modal.billing_cancel')
    @include('components.modal.billing_from_trial')
    @include('components.modal.billing_from_X')
@endsection

@section('script')
    <script>
        @php
            $active_pricing_strategy = \DB::table('pricing_strategy')->select(
                'monthly_price',
                'candidates',
                'free_version_candidates'
            )->where('active', 1)->first();
        @endphp
        window.active_pricing_strategy = {!! $active_pricing_strategy ? json_encode($active_pricing_strategy) : 'null' !!};
    </script>
    <script src="{{ asset('/js/app/business-billing.js?v='.time()) }}"></script>
@endsection