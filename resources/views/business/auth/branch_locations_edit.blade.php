@extends('layouts.main_business')

@section('content')
    <style type="text/css">
        .addto:hover {
            background-color: #f7f7f7;
            transition: 0.5s;
            box-shadow: 0 5px 23px rgba(0, 0, 0, 0.3);
        }

        .addto {
            background-color: #fff;
            transition: 0.5s;
        }

        .btn-group svg {
            width: 25px;
        }

        .tooltipicon {
            width: 20px;
        }

        .coll_name {
            text-decoration: none;
            color: #7b7b7b;
            font-size: 17px;
            letter-spacing: -0.5px;
        }

        .coll_title {
            text-decoration: none;
            color: #7b7b7b;
            font-size: 14px;
            font-weight: 400;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div id="slide-out" class="col-3 pl-0 sidebar_adaptive">
                @include('components.sidebar.sidebar_business')
            </div>

            <div class="col-xl-8 col-11 mx-auto pb-5 mt-2 bg-white rounded content-main">
                <div class="row">
                    <div class="col-md-12 text-center mt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Capa_1" x="0px" y="0px" viewBox="0 0 57.502 57.502"
                             style="enable-background:new 0 0 57.502 57.502;" xml:space="preserve" width="70px"
                             height="70px"><g>
                                <g>
                                    <path d="M20.832,12.125c-5.204,0-9.438,4.233-9.438,9.438S15.628,31,20.832,31s9.438-4.233,9.438-9.438   S26.036,12.125,20.832,12.125z M20.832,29c-4.101,0-7.438-3.337-7.438-7.438s3.337-7.438,7.438-7.438s7.438,3.337,7.438,7.438   S24.933,29,20.832,29z"
                                          data-original="#000000" class="active-path" data-old_color="#4266ff"
                                          fill="#4266ff"></path>
                                    <path d="M52.051,13.078C50.929,4.522,45.61,0,36.67,0c-8.656,0-12.434,3.722-14.084,7.065C22.017,7.024,21.434,7,20.832,7   c-8.94,0-14.259,4.522-15.381,13.078c-0.373,2.84-0.222,5.897,0.451,9.088C9.24,44.989,17.297,54.477,19.686,57.007   c0.297,0.314,0.715,0.495,1.146,0.495c0.431,0,0.849-0.181,1.146-0.495c1.521-1.611,5.339-6.055,8.774-13.149   c2.166,3.27,4.015,5.347,4.771,6.147c0.297,0.316,0.715,0.498,1.146,0.498c0.433,0,0.851-0.182,1.146-0.496   c2.39-2.532,10.446-12.023,13.783-27.841C52.272,18.976,52.424,15.918,52.051,13.078z M20.831,55.301   C18.649,52.899,11,43.641,7.859,28.754c-0.626-2.969-0.77-5.8-0.426-8.416C8.421,12.814,12.928,9,20.832,9   c3.307,0,6.011,0.677,8.12,2.005c3.815,2.513,4.948,7.061,5.278,9.585c0.044,0.328,0.077,0.662,0.105,1.005   c0.002,0.03,0.005,0.06,0.008,0.09c0.024,0.325,0.041,0.661,0.052,1.008c0.042,1.935-0.147,3.96-0.59,6.06   C30.663,43.641,23.015,52.899,20.831,55.301z M30.639,9.709C31.966,7.998,34.205,7,36.813,7c4.101,0,7.438,3.337,7.438,7.438   s-3.337,7.438-7.438,7.438c-0.148,0-0.297-0.006-0.453-0.017c-0.032-0.6-0.072-1.198-0.149-1.78   C35.595,15.371,33.7,11.893,30.639,9.709z M49.643,21.754c-3.139,14.88-10.787,24.142-12.973,26.547   c-0.948-1.042-2.822-3.265-4.926-6.597c1.576-3.598,3.012-7.775,4.016-12.538c0.384-1.821,0.578-3.592,0.622-5.311   c0.144,0.007,0.29,0.02,0.431,0.02c5.204,0,9.438-4.233,9.438-9.438S42.018,5,36.813,5c-3.336,0-6.207,1.366-7.894,3.686   c-1.247-0.62-2.643-1.068-4.184-1.345C26.796,3.809,30.789,2,36.67,2c7.904,0,12.411,3.814,13.398,11.338   C50.412,15.954,50.269,18.785,49.643,21.754z"
                                          data-original="#000000" class="active-path" data-old_color="#4266ff"
                                          fill="#4266ff"></path>
                                </g>
                            </g> </svg>
                    </div>
                    <div class="col-md-12 text-center pb-3 card border-top-0 border-left-0 border-right-0 rounded-0">
                        <h2 class="mx-auto mt-2 text-muted"
                            style="font-family: 'Open Sans', sans-serif; letter-spacing: -1px">{!! trans('pages.title.branch.edit') !!}</h2>
                    </div>
                </div>

                <div class="text-center">
                    <div class="d-inline-block bg-light px-5 pt-4 pb-3 mb-4 business-pic-view">
                        <input name="logo" type="text" style="display: none;">
                        <img class=" img-thumbnail" alt="Your business logo"
                             style="width: 100px; height: 100px;"
                             src="{{ asset('img/business-logo.png') }}">
                        <div class="mt-3 bg-white">
                            <button id="business-pic-change-btn" type="button"
                                    class="btn btn-outline-primary">
                                <div class="button__content flex__flex-row">{!! trans('main.buttons.change_logo') !!}</div>
                            </button>
                        </div>
                    </div>
                </div>

{{--                <div class="d-inline-flex mt-3">--}}
{{--                    <div>--}}
{{--                        <label class="mb-0">--}}
{{--                            Language--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" style="vertical-align: middle; margin-top: -3px; cursor: pointer; opacity: 0.4;">--}}
{{--                                <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>--}}
{{--                            </svg>--}}
{{--                        </label>--}}
{{--                        <select name="current_language_prefix" class="form-control form-control-sm mb-1 d-inline-flex">--}}
{{--                            <option value="en">English</option>--}}
{{--                            <option value="fr">French</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="d-inline-flex mt-3 ml-5">--}}
{{--                    <div>--}}
{{--                        <label class="mb-0">--}}
{{--                            Location type--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" style="vertical-align: middle; margin-top: -3px; cursor: pointer; opacity: 0.4;">--}}
{{--                                <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>--}}
{{--                            </svg>--}}
{{--                        </label>--}}
{{--                        <select name="managers_type" class="form-control form-control-sm mb-1 d-inline-flex">--}}
{{--                            <option value="manager">Managers</option>--}}
{{--                            <option value="franchisee">Franchisee</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <form id="business-location-form" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6  pt-3">
                            <label>{!! trans('fields.label.brand_name') !!}</label>
                            <select name="brand_id" class="form-control" id="location-select-brand">
                            </select>
                        </div>
                        {{--<div class="col-md-4  pt-3">
                            <label class="text-center">{!! trans('fields.label.main_location') !!}</label>
                            <input type="checkbox" name="main" class="form-control" value="1" id="location-checkbox-main">
                        </div>--}}
{{--                        <div class="col-md-6  pt-3">--}}
{{--                            <label>{!! trans('fields.label.location_name') !!}</label>--}}
{{--                            <input type="text" name="name" class="form-control [ multilanguage multilanguage-en ]"--}}
{{--                                   placeholder="{!! trans('fields.placeholder.location_name') !!}"  autocomplete="disabled">--}}
{{--                            <input type="text" name="name_fr" class="form-control [ multilanguage multilanguage-fr ] d-none"--}}
{{--                                   placeholder="{!! trans('fields.placeholder.location_name') !!}"  autocomplete="disabled">--}}
{{--                        </div>--}}

                        <div class="col-md-12 pb-0 mx-auto mt-4 px-0 pl-3 pr-3">
                            <nav>
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist" style="padding: 0; margin: 0;">
                                    <a class="nav-item nav-link active" id="nav-en-tab" data-language-prefix="en" data-toggle="tab" href="#nav-en" role="tab" aria-controls="nav-en" aria-selected="true">English</a>
                                    <a class="nav-item nav-link" id="nav-fr-tab" data-language-prefix="fr" data-toggle="tab" href="#nav-fr" role="tab" aria-controls="nav-fr" aria-selected="false">French</a>
                                </div>
                            </nav>
                            <div class="tab-content py-3 px-3 px-sm-0 " id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-en" role="tabpanel" aria-labelledby="nav-en-tab">
                                    <div class="d-flex flex-lg-row flex-column">
                                        <div class="col-lg-12 col-12 pl-0 pr-0 pxa-0">
                                            <label for="name-en" style="text-align: left;">{!! trans('fields.label.location_name') !!}</label>
                                            <input autocomplete="disabled" type="text" class="form-control " name="name" id="name-en" placeholder="{!! trans('fields.placeholder.location_name') !!}">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-fr" role="tabpanel" aria-labelledby="nav-fr-tab">
                                    <div class="d-flex flex-lg-row flex-column">
                                        <div class="col-lg-12 col-12 pl-0 pxa-0">
                                            <label style="text-align: left;" for="name-fr">{!! trans('fields.label.location_name') !!}</label>
                                            <input autocomplete="disabled" type="text" class="form-control" name="name_fr" id="name-fr" placeholder="{!! trans('fields.placeholder.location_name') !!}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-lg-row flex-column w-100">
                            <div class="col-lg-4  pt-3">
                                <label>{!! trans('fields.label.city') !!}</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-addon" id="basic-addon1"
                                          style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                                        <i class="glyphicon"></i>
                                    </span>
                                    <input type="text" class="form-control border-right-0"
                                           placeholder="{!! trans('fields.label.city') !!}" name="city"
                                           id="business-location-auto"  autocomplete="off"  style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;">
                                    <span class="input-group-btn border-0 hide"
                                          style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                        <button class="btn mx-0 border-0" type="button" id="location-clear"
                                                style="background-color: #f4f4f4; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-2 pl-0 pxa-0 px-3 pt-3">
                                <label class="text-left">{!! trans('fields.label.zip_code') !!}</label>
                                <input type="text" class="form-control"  autocomplete="off"
                                       placeholder="{!! trans('fields.placeholder.zip_code') !!}"
                                       name="zip_code">
                            </div>
                            <div class="col-lg-6  pt-3 mb-3">
                                <label>{!! trans('fields.label.phone_number') !!}</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div id="country-phone" class="bfh-selectbox bfh-countries" data-country="CA"
                                             data-flags="true"></div>
                                    </div>

                                    <div class="col-lg-8">
                                        <input type="tel" class="form-control" id="input-phone"
                                               placeholder="{!! trans('fields.placeholder.phone_number') !!}" name="phone"  autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12  pt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{!! trans('fields.label.street_number') !!}</label>
                                    <input type="text" name="street_number" class="form-control"
                                           placeholder="{!! trans('fields.placeholder.street_number') !!}"  autocomplete="off">
                                </div>
                                <div class="col-md-7">
                                    <label>{!! trans('fields.label.street_address') !!}</label>
                                    <div id="input-street-check" class="" style="display: none">
                                        <span style="font-size: 13px;">{!! trans('fields.errors.street_address') !!}</span>
                                        <button class="btn" type="button"
                                                id="input-street-number-keep">{!! trans('main.buttons.street_address_keep') !!}</button>
                                        <button class="btn" type="button"
                                                id="input-street-number-clear">{!! trans('main.buttons.street_address_clear') !!}</button>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control autocomplete-border"
                                               placeholder="{!! trans('fields.placeholder.street_address') !!}"
                                               name="street" id="business-location-street">
                                        <span class="input-group-btn border-0">
                                            <button class="btn mx-0" type="button" id="location-street-clear"
                                                    style="background-color: #e9ecef; border: 1px solid #ced4da; border-left: 0px;">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>{!! trans('fields.label.suite') !!}</label>
                                    <input type="text" name="suite" class="form-control"
                                           placeholder="{!! trans('fields.placeholder.suite') !!}"  autocomplete="off">
                                </div>
                            </div>

                        </div>

{{--                        <div class="btn-group text-center col-md-12 mt-3" data-toggle="buttons">--}}
{{--                            <label class="btn btn-outline-primary btn-block mb-0 py-3 w-100 d-flex flex-column justify-content-center align-items-center business-location-type"--}}
{{--                                   data-type="location">--}}
{{--                                <input type="radio" name="type" id="option1"  autocomplete="off" value="location">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"--}}
{{--                                     version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 489.4 489.4"--}}
{{--                                     style="enable-background:new 0 0 489.4 489.4;" xml:space="preserve"--}}
{{--                                     class="location_svg">--}}
{{--											<g>--}}
{{--                                                <g>--}}
{{--                                                    <path d="M347.7,263.75h-66.5c-18.2,0-33,14.8-33,33v51c0,18.2,14.8,33,33,33h66.5c18.2,0,33-14.8,33-33v-51    C380.7,278.55,365.9,263.75,347.7,263.75z M356.7,347.75c0,5-4.1,9-9,9h-66.5c-5,0-9-4.1-9-9v-51c0-5,4.1-9,9-9h66.5    c5,0,9,4.1,9,9V347.75z"/>--}}
{{--                                                    <path d="M489.4,171.05c0-2.1-0.5-4.1-1.6-5.9l-72.8-128c-2.1-3.7-6.1-6.1-10.4-6.1H84.7c-4.3,0-8.3,2.3-10.4,6.1l-72.7,128    c-1,1.8-1.6,3.8-1.6,5.9c0,28.7,17.3,53.3,42,64.2v211.1c0,6.6,5.4,12,12,12h66.3c0.1,0,0.2,0,0.3,0h93c0.1,0,0.2,0,0.3,0h221.4    c6.6,0,12-5.4,12-12v-209.6c0-0.5,0-0.9-0.1-1.3C472,224.55,489.4,199.85,489.4,171.05z M91.7,55.15h305.9l56.9,100.1H34.9    L91.7,55.15z M348.3,179.15c-3.8,21.6-22.7,38-45.4,38c-22.7,0-41.6-16.4-45.4-38H348.3z M232,179.15c-3.8,21.6-22.7,38-45.4,38    s-41.6-16.4-45.5-38H232z M24.8,179.15h90.9c-3.8,21.6-22.8,38-45.5,38C47.5,217.25,28.6,200.75,24.8,179.15z M201.6,434.35h-69    v-129.5c0-9.4,7.6-17.1,17.1-17.1h34.9c9.4,0,17.1,7.6,17.1,17.1v129.5H201.6z M423.3,434.35H225.6v-129.5    c0-22.6-18.4-41.1-41.1-41.1h-34.9c-22.6,0-41.1,18.4-41.1,41.1v129.6H66v-193.3c1.4,0.1,2.8,0.1,4.2,0.1    c24.2,0,45.6-12.3,58.2-31c12.6,18.7,34,31,58.2,31s45.5-12.3,58.2-31c12.6,18.7,34,31,58.1,31c24.2,0,45.5-12.3,58.1-31    c12.6,18.7,34,31,58.2,31c1.4,0,2.7-0.1,4.1-0.1L423.3,434.35L423.3,434.35z M419.2,217.25c-22.7,0-41.6-16.4-45.4-38h90.9    C460.8,200.75,441.9,217.25,419.2,217.25z"/>--}}
{{--                                                </g>--}}
{{--                                            </g>--}}
{{--											</svg>--}}
{{--                                {!! trans('fields.label.type_location') !!}--}}
{{--                            </label>--}}
{{--                            <label class="btn btn-outline-primary btn-block my-0 py-3 w-100 d-flex flex-column justify-content-center align-items-center business-location-type"--}}
{{--                                   data-type="headquarter">--}}
{{--                                <input type="radio" name="type" id="option2"  autocomplete="off" value="headquarter">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"--}}
{{--                                     version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512"--}}
{{--                                     style="enable-background:new 0 0 512 512;" xml:space="preserve">--}}
{{--											<g>--}}
{{--                                                <g>--}}
{{--                                                    <g>--}}
{{--                                                        <path d="M486.4,460.8c-1.476,0-2.944,0.128-4.386,0.384c-5.888-10.607-17.092-17.451-29.747-17.451     c-12.655,0-23.859,6.844-29.747,17.451c-1.442-0.256-2.91-0.384-4.386-0.384c-14.114,0-25.6,11.486-25.6,25.6     c0,3.004,0.614,5.845,1.579,8.533H358.4v-51.2h42.667c4.71,0,8.533-3.823,8.533-8.533V93.867c0-4.71-3.823-8.533-8.533-8.533     h-256c-4.71,0-8.533,3.823-8.533,8.533v409.6c0,4.71,3.823,8.533,8.533,8.533H486.4c14.114,0,25.6-11.486,25.6-25.6     S500.514,460.8,486.4,460.8z M358.4,102.4h34.133v51.2H358.4V102.4z M358.4,170.667h34.133v51.2H358.4V170.667z M358.4,238.933     h34.133v51.2H358.4V238.933z M358.4,307.2h34.133v51.2H358.4V307.2z M358.4,375.467h34.133v51.2H358.4V375.467z M187.733,494.933     H153.6v-51.2h34.133V494.933z M187.733,426.667H153.6v-51.2h34.133V426.667z M187.733,358.4H153.6v-51.2h34.133V358.4z      M187.733,290.133H153.6v-51.2h34.133V290.133z M187.733,221.867H153.6v-51.2h34.133V221.867z M187.733,153.6H153.6v-51.2h34.133     V153.6z M238.933,494.933H204.8v-51.2h34.133V494.933z M238.933,426.667H204.8v-51.2h34.133V426.667z M238.933,358.4H204.8v-51.2     h34.133V358.4z M238.933,290.133H204.8v-51.2h34.133V290.133z M238.933,221.867H204.8v-51.2h34.133V221.867z M238.933,153.6     H204.8v-51.2h34.133V153.6z M290.133,494.933H256v-51.2h34.133V494.933z M290.133,426.667H256v-51.2h34.133V426.667z      M290.133,358.4H256v-51.2h34.133V358.4z M290.133,290.133H256v-51.2h34.133V290.133z M290.133,221.867H256v-51.2h34.133V221.867     z M290.133,153.6H256v-51.2h34.133V153.6z M341.333,494.933H307.2v-51.2h34.133V494.933z M341.333,426.667H307.2v-51.2h34.133     V426.667z M341.333,358.4H307.2v-51.2h34.133V358.4z M341.333,290.133H307.2v-51.2h34.133V290.133z M341.333,221.867H307.2v-51.2     h34.133V221.867z M341.333,153.6H307.2v-51.2h34.133V153.6z M486.4,494.933h-68.267c-4.702,0-8.533-3.831-8.533-8.533     s3.831-8.533,8.533-8.533c1.638,0,3.191,0.469,4.625,1.391c2.338,1.502,5.257,1.775,7.834,0.734     c2.577-1.041,4.48-3.277,5.103-5.982c1.801-7.774,8.619-13.21,16.572-13.21c7.953,0,14.771,5.436,16.572,13.21     c0.623,2.705,2.526,4.941,5.103,5.982c2.577,1.041,5.495,0.768,7.834-0.734c5.547-3.584,13.167,0.802,13.158,7.142     C494.933,491.102,491.102,494.933,486.4,494.933z"/>--}}
{{--                                                        <path d="M187.733,59.733v-25.6h59.733c4.71,0,8.533-3.823,8.533-8.533v-8.533h34.133V25.6c0,4.71,3.823,8.533,8.533,8.533H358.4     V51.2H213.333c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h213.333v353.954c0,4.71,3.823,8.533,8.533,8.533     s8.533-3.823,8.533-8.533V59.733c0-4.71-3.823-8.533-8.533-8.533h-59.733V25.6c0-4.71-3.823-8.533-8.533-8.533H307.2V8.533     c0-4.71-3.823-8.533-8.533-8.533h-51.2c-4.71,0-8.533,3.823-8.533,8.533v8.533H179.2c-4.71,0-8.533,3.823-8.533,8.533v25.6     h-59.733c-4.71,0-8.533,3.823-8.533,8.533v435.2H51.2v-34.995c19.447-3.968,34.133-21.197,34.133-41.805     c0-1.109-0.486-110.933-42.667-110.933C0.486,307.2,0,417.024,0,418.133c0,20.608,14.686,37.837,34.133,41.805v34.995h-25.6     c-4.71,0-8.533,3.823-8.533,8.533S3.823,512,8.533,512h102.4c4.71,0,8.533-3.823,8.533-8.533v-435.2H179.2     C183.91,68.267,187.733,64.444,187.733,59.733z M17.067,418.133c0-42.513,11.418-93.867,25.6-93.867     c14.182,0,25.6,51.354,25.6,93.867c0,14.114-11.486,25.6-25.6,25.6S17.067,432.247,17.067,418.133z"/>--}}
{{--                                                    </g>--}}
{{--                                                </g>--}}
{{--                                            </g>--}}
{{--											</svg>--}}
{{--                                {!! trans('fields.label.type_headquarter') !!}--}}
{{--                            </label>--}}
{{--                        </div>--}}

{{--                        <div class="col-md-12 pt-5 text-center">--}}
{{--                            <div class="row">--}}
{{--                                @foreach(config('lists.amenities_icons') as $amenities_icon)--}}
{{--                                    <script type="text/template" id="amenities-icon-{{ $amenities_icon }}">--}}
{{--                                        @svg('/img/amenities/' . $amenities_icon . '.svg', [--}}
{{--                                            'width' => '20px',--}}
{{--                                            'height' => '20px',--}}
{{--                                            'style' => 'fill: #007bff;',--}}
{{--                                        ])--}}
{{--                                    </script>--}}
{{--                                @endforeach--}}
{{--                                <div class="btn-group col-md-12 amenities-list" data-toggle="buttons">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-10 pb-0 card mx-auto mt-5 px-0">--}}
{{--                            <div class="panel-group" id="accordion">--}}

{{--                                <div class="panel panel-default assign-panel"--}}
{{--                                     style="box-shadow: 0 5px 23px rgba(0,0,0,0.2);">--}}
{{--                                    <div class="panel-heading">--}}
{{--                                        <h4 class="panel-title my-0">--}}
{{--                                            <a data-toggle="collapse" href="#collapse1" data-parent="#accordion"--}}
{{--                                               class="h5 modal-title text-center py-3 card border-top-0 border-left-0 border-right-0 rounded-0 addto  main-panel"--}}
{{--                                               style="text-decoration: none; color: #7b7b7b; font-size: 15px;font-weight: 400;"--}}
{{--                                               data-type-panel="jobs">--}}
{{--                                                <p class="text-center mb-0"><img--}}
{{--                                                            src="{{ asset('img/sidebar/jobs.png') }}"--}}
{{--                                                            alt=""/></p>--}}
{{--                                                {!! trans('modals.title.add_job_location') !!}</a>--}}
{{--                                        </h4>--}}
{{--                                    </div>--}}
{{--                                    <div id="collapse1" class="panel-collapse collapse pb-4">--}}
{{--                                        <div class="col-md-12 mx-auto px-0 pb-2">--}}
{{--                                            <input class="form-control" type="text" name=""--}}
{{--                                                   placeholder="{!! trans('fields.placeholder.assign_job_search') !!}"--}}
{{--                                                   style="border: none;border-bottom: 1px solid rgba(0,0,0,.125); border-radius: 0px;"--}}
{{--                                                   id="job-location-search"  autocomplete="off"/>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-10 mx-auto mt-1">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <button type="button" class="btn btn-success btn-block assign-all"--}}
{{--                                                            data-dismiss="modal" role="button"--}}
{{--                                                            data-type="job">{!! trans('main.buttons.assign_all') !!}--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <button type="button" class="btn btn-primary btn-block unassign-all"--}}
{{--                                                            role="button" data-type="job">--}}
{{--                                                        {!! trans('main.buttons.unassign_all') !!}--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-12 mx-auto" style="overflow-y: auto;    height: auto;">--}}
{{--                                            <div class="row">--}}
{{--                                                <!-- Assigned begin -->--}}
{{--                                                <div class="col-md-12 py-3 mx-auto card border-left-0 border-right-0 border-top-0">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-md-11 pt-3 mx-auto pl-0 job-assigned-header">--}}
{{--                                                            <h5 class="pl-4 pb-2"--}}
{{--                                                                style="font-family: 'Open Sans', sans-serif;">--}}
{{--                                                                {!! trans('modals.text.anssigned') !!}</h5>--}}
{{--                                                        </div>--}}
{{--                                                        <!-- one item eof -->--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}
{{--                                                <!-- Assigned EOF -->--}}
{{--                                                <!-- Unsassigned BEGIN  -->--}}
{{--                                                <div class="col-md-12 pt-3 mx-auto">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-md-11 pt-3 pl-0 mx-auto job-unassigned-header">--}}
{{--                                                            <h5 class="pl-4 pb-2"--}}
{{--                                                                style="font-family: 'Open Sans', sans-serif;">--}}
{{--                                                                {!! trans('modals.text.unanssigned') !!}</h5>--}}
{{--                                                        </div>--}}

{{--                                                        <div class="col-md-11 mt-2 mx-auto pl-4 pr-0">--}}
{{--                                                            <div class="mx-auto mt-2">--}}
{{--                                                                <nav aria-label="Page navigation example">--}}
{{--                                                                    <ul class="pagination pagination-job-unassign">--}}

{{--                                                                    </ul>--}}
{{--                                                                </nav>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <!-- Unsassigned EOF -->--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="panel panel-default assign-panel"--}}
{{--                                     style="box-shadow: 0 5px 23px rgba(0,0,0,0.2);">--}}
{{--                                    <div class="panel-heading">--}}
{{--                                        <h4 class="panel-title my-0">--}}
{{--                                            <a data-toggle="collapse" href="#collapse2" data-parent="#accordion"--}}
{{--                                               class="h5 modal-title text-center py-3 card border-top-0 border-left-0 border-right-0 rounded-0 addto  main-panel"--}}
{{--                                               style="text-decoration: none; color: #7b7b7b; font-size: 15px;font-weight: 400;"--}}
{{--                                               data-type-panel="managers">--}}
{{--                                                <p class="text-center mb-0"><img--}}
{{--                                                            src="{{ asset('img/sidebar/account.png') }}" alt=""/></p>--}}
{{--                                                {!! trans('modals.title.add_manager_location') !!}</a>--}}
{{--                                        </h4>--}}
{{--                                    </div>--}}
{{--                                    <div id="collapse2" class="panel-collapse collapse pb-4">--}}
{{--                                        <div class="col-md-12 mx-auto px-0 pb-2">--}}
{{--                                            <input class="form-control" type="text" name=""--}}
{{--                                                   placeholder="{!! trans('fields.placeholder.assign_manager_search') !!}"--}}
{{--                                                   style="border: none;border-bottom: 1px solid rgba(0,0,0,.125); border-radius: 0px;"--}}
{{--                                                   id="manager-location-search"  autocomplete="off"/>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-10 mx-auto mt-1">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <button type="button" class="btn btn-success btn-block assign-all"--}}
{{--                                                            data-dismiss="modal" role="button"--}}
{{--                                                            data-type="manager">{!! trans('main.buttons.assign_all') !!}--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <button type="button" class="btn btn-primary btn-block unassign-all"--}}
{{--                                                            role="button" data-type="manager">--}}
{{--                                                        {!! trans('main.buttons.unassign_all') !!}--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-12 mx-auto" style="overflow-y: auto;    height: auto;">--}}
{{--                                            <div class="row">--}}
{{--                                                <!-- Assigned begin -->--}}
{{--                                                <div class="col-md-12 py-3 mx-auto card border-left-0 border-right-0 border-top-0">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-md-11 pt-3 mx-auto pl-0 manager-assigned-header">--}}
{{--                                                            <h5 class="pl-4 pb-2"--}}
{{--                                                                style="font-family: 'Open Sans', sans-serif;">--}}
{{--                                                                {!! trans('modals.text.anssigned') !!}</h5>--}}
{{--                                                        </div>--}}

{{--                                                    </div>--}}

{{--                                                </div>--}}
{{--                                                <!-- Unsassigned BEGIN  -->--}}
{{--                                                <div class="col-md-12 pt-3 mx-auto">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-md-11 pt-3 pl-0 mx-auto manager-unassigned-header">--}}
{{--                                                            <h5 class="pl-4 pb-2"--}}
{{--                                                                style="font-family: 'Open Sans', sans-serif;">--}}
{{--                                                                {!! trans('modals.text.unanssigned') !!}</h5>--}}
{{--                                                        </div>--}}

{{--                                                        <div class="col-md-11 mt-2 mx-auto pl-4 pr-0">--}}
{{--                                                            <div class="mx-auto mt-2">--}}
{{--                                                                <nav aria-label="Page navigation example">--}}
{{--                                                                    <ul class="pagination pagination-manager-unassign">--}}

{{--                                                                    </ul>--}}
{{--                                                                </nav>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <!-- Unsassigned EOF -->--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="panel panel-default assign-panel"--}}
{{--                                     style="box-shadow: 0 5px 23px rgba(0,0,0,0.2);">--}}
{{--                                    <div class="panel-heading">--}}
{{--                                        <h4 class="panel-title my-0">--}}
{{--                                            <a data-toggle="collapse" href="#collapse3" data-parent="#accordion"--}}
{{--                                               class="h5 modal-title text-center py-3 card border-top-0 border-left-0 border-right-0 rounded-0 addto main-panel"--}}
{{--                                               style="text-decoration: none; color: #7b7b7b; font-size: 15px;font-weight: 400;"--}}
{{--                                               data-type-panel="departments">--}}
{{--                                                <p class="text-center mb-0">--}}
{{--                                                    <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                         xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"--}}
{{--                                                         id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512"--}}
{{--                                                         style="enable-background:new 0 0 512 512; fill:#7b7b7b; "--}}
{{--                                                         xml:space="preserve" width="17px" height="19px">--}}
{{--									<g>--}}
{{--                                        <g>--}}
{{--                                            <path d="M256,303.216c-53.744,0-97.468,43.724-97.468,97.468c0,30.532,14.115,57.825,36.159,75.71    c0.417,0.398,0.869,0.761,1.354,1.084c16.547,12.947,37.365,20.674,59.955,20.674c22.59,0,43.408-7.727,59.955-20.674    c0.486-0.323,0.937-0.686,1.354-1.084c22.043-17.885,36.159-45.178,36.159-75.71C353.468,346.939,309.744,303.216,256,303.216z     M256,478.152c-15.809,0-30.522-4.77-42.791-12.933c6.576-16.892,23.632-28.603,42.791-28.603s36.215,11.711,42.791,28.603    C286.521,473.382,271.809,478.152,256,478.152z M238.384,400.683c0-8.786,7.147-15.933,15.932-15.933    c8.785,0,15.933,7.147,15.933,15.933s-7.148,15.933-15.933,15.933C245.531,416.616,238.384,409.469,238.384,400.683z     M314.445,451.445c-6.835-12.9-18.034-23.157-31.474-29.111c4.564-6.026,7.277-13.526,7.277-21.65    c0-19.813-16.119-35.933-35.933-35.933c-19.813,0-35.932,16.119-35.932,35.933c0,8.65,3.073,16.594,8.183,22.802    c-12.343,6.08-22.599,15.856-29.012,27.96c-11.834-13.607-19.023-31.355-19.023-50.762c0-42.716,34.752-77.468,77.468-77.468    s77.468,34.752,77.468,77.468C333.468,420.09,326.279,437.838,314.445,451.445z"/>--}}
{{--                                        </g>--}}
{{--                                    </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M97.468,13.847C43.724,13.847,0,57.572,0,111.316c0,30.533,14.116,57.826,36.16,75.711    c0.416,0.397,0.867,0.759,1.351,1.082c16.547,12.948,37.366,20.675,59.957,20.675s43.41-7.728,59.957-20.676    c0.484-0.322,0.934-0.684,1.35-1.081c22.044-17.885,36.161-45.179,36.161-75.712C194.936,57.571,151.212,13.847,97.468,13.847z     M97.468,188.785c-15.809-0.001-30.521-4.771-42.791-12.933c6.576-16.892,23.632-28.603,42.791-28.603    s36.215,11.711,42.791,28.603C127.989,184.015,113.278,188.785,97.468,188.785z M79.851,111.317    c0-8.785,7.147-15.933,15.933-15.933s15.933,7.147,15.933,15.933c0,8.786-7.148,15.932-15.933,15.932    C86.999,127.249,79.851,120.102,79.851,111.317z M155.913,162.077c-6.834-12.9-18.034-23.156-31.474-29.111    c4.564-6.025,7.277-13.526,7.277-21.65c0-19.813-16.119-35.933-35.933-35.933c-19.814,0-35.933,16.119-35.933,35.933    c0,8.649,3.073,16.594,8.183,22.802c-12.343,6.08-22.599,15.856-29.011,27.96C27.189,148.471,20,130.723,20,111.316    C20,68.6,54.752,33.848,97.468,33.848s77.468,34.752,77.468,77.468C174.936,130.722,167.747,148.47,155.913,162.077z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M414.532,13.848c-53.744,0-97.468,43.724-97.468,97.468c0,30.534,14.117,57.828,36.162,75.713    c0.415,0.396,0.864,0.757,1.347,1.079c16.547,12.948,37.367,20.676,59.958,20.676s43.41-7.727,59.957-20.675    c0.485-0.323,0.935-0.685,1.352-1.082c22.044-17.884,36.16-45.178,36.16-75.711C512,57.572,468.276,13.848,414.532,13.848z     M414.532,188.785c-15.81-0.001-30.522-4.771-42.791-12.933c6.576-16.892,23.631-28.603,42.791-28.603    s36.215,11.711,42.791,28.603C445.053,184.015,430.341,188.785,414.532,188.785z M396.915,111.317    c0-8.785,7.147-15.933,15.933-15.933s15.932,7.147,15.932,15.933c0,8.786-7.147,15.932-15.932,15.932    C404.063,127.249,396.915,120.102,396.915,111.317z M472.977,162.077c-6.835-12.9-18.034-23.157-31.474-29.111    c4.564-6.025,7.277-13.526,7.277-21.65c0-19.813-16.119-35.933-35.932-35.933s-35.933,16.119-35.933,35.933    c0,8.649,3.073,16.594,8.183,22.801c-12.344,6.08-22.599,15.856-29.012,27.96c-11.833-13.606-19.023-31.354-19.023-50.761    c0-42.716,34.752-77.468,77.468-77.468S492,68.6,492,111.316C492,130.722,484.811,148.47,472.977,162.077z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M140.977,355.435c-0.041-0.035-0.085-0.074-0.121-0.104c-4.216-3.567-10.526-3.041-14.093,1.174    c-3.544,4.188-3.048,10.442,1.091,14.022c0.041,0.035,0.085,0.074,0.121,0.104c1.878,1.589,4.172,2.366,6.455,2.366    c2.84,0,5.661-1.203,7.639-3.541C145.611,365.269,145.116,359.014,140.977,355.435z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M121.466,335.379c-0.02-0.025-0.104-0.125-0.124-0.149c-3.551-4.213-9.825-4.741-14.049-1.204    c-4.225,3.536-4.778,9.841-1.256,14.078l0.016,0.02c1.978,2.392,4.833,3.628,7.712,3.628c2.245,0,4.502-0.752,6.367-2.294    C124.388,345.938,124.986,339.635,121.466,335.379z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M105.253,312.447c-0.021-0.037-0.093-0.158-0.115-0.194c-2.854-4.729-9.013-6.27-13.741-3.416    c-4.729,2.854-6.261,8.98-3.408,13.708l0.01,0.016c1.861,3.176,5.203,4.944,8.636,4.944c1.718,0,3.459-0.443,5.048-1.375    C106.448,323.338,108.046,317.212,105.253,312.447z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M84.514,260.303c-1.164-5.399-6.482-8.834-11.881-7.67c-5.399,1.163-8.833,6.482-7.67,11.881    c0.008,0.037,0.038,0.17,0.046,0.207c1.055,4.641,5.18,7.793,9.747,7.793c0.731-0.001,1.476-0.082,2.221-0.251    C82.362,271.039,85.738,265.688,84.514,260.303z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M92.804,287.183c-0.007-0.017-0.05-0.126-0.057-0.143c-2.065-5.12-7.885-7.593-13.006-5.532    c-5.121,2.061-7.601,7.888-5.543,13.01l0.017,0.042c1.557,3.923,5.319,6.314,9.298,6.314c1.227,0,2.476-0.228,3.686-0.708    C92.331,298.129,94.841,292.316,92.804,287.183z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M385.238,356.506c-3.568-4.217-9.877-4.742-14.094-1.175c-0.035,0.029-0.079,0.067-0.119,0.102    c-4.142,3.579-4.637,9.834-1.093,14.023c1.978,2.338,4.799,3.541,7.639,3.541c2.282,0,4.576-0.777,6.455-2.366    c0.035-0.029,0.079-0.067,0.119-0.102C388.287,366.95,388.782,360.695,385.238,356.506z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M432.267,281.505c-5.125-2.066-10.949,0.412-13.014,5.535c-0.007,0.017-0.05,0.126-0.057,0.143    c-2.033,5.124,0.481,10.88,5.599,12.927c1.208,0.483,2.454,0.711,3.682,0.711c3.976,0,7.75-2.396,9.325-6.302    C439.867,289.397,437.389,283.57,432.267,281.505z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M404.749,334.031c-4.223-3.56-10.531-3.023-14.091,1.199c-0.021,0.024-0.104,0.125-0.125,0.149    c-3.507,4.242-2.896,10.483,1.329,14.011c1.86,1.553,4.125,2.309,6.38,2.309c2.867,0,5.72-1.221,7.706-3.577    C409.508,343.899,408.972,337.59,404.749,334.031z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M439.407,252.668c-5.374-1.186-10.704,2.227-11.913,7.598l-0.005,0.021c-1.224,5.386,2.15,10.744,7.535,11.968    c0.746,0.169,1.491,0.25,2.226,0.25c4.564,0,8.688-3.146,9.742-7.786c0.008-0.037,0.038-0.17,0.046-0.207    C448.197,259.132,444.783,253.852,439.407,252.668z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M420.591,308.857c-4.728-2.852-10.875-1.333-13.729,3.396c-0.022,0.036-0.094,0.158-0.115,0.194    c-2.793,4.765-1.202,10.903,3.563,13.696c1.592,0.934,3.336,1.378,5.056,1.378c3.427,0,6.761-1.763,8.621-4.936    C426.84,317.857,425.319,311.711,420.591,308.857z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M441.974,223.061c-5.524-0.316-10.233,3.922-10.544,9.435c0,0.002-0.001,0.031-0.001,0.034    c-0.307,5.514,3.917,10.207,9.431,10.513c0.188,0.01,0.375,0.016,0.561,0.016c5.27,0,9.684-4.145,9.98-9.472    C451.707,228.074,447.487,223.369,441.974,223.061z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M318.223,31.92l-0.095-0.031c-5.257-1.7-10.893,1.186-12.59,6.441c-1.699,5.255,1.185,10.892,6.441,12.59l0.095,0.031    c1.022,0.33,2.058,0.487,3.076,0.487c4.222,0,8.146-2.695,9.514-6.928C326.362,39.255,323.478,33.618,318.223,31.92z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M287.492,24.702l-0.264-0.041c-5.468-0.803-10.578,2.969-11.382,8.433c-0.802,5.464,2.943,10.539,8.407,11.343    c0.548,0.09,1.094,0.134,1.632,0.134c4.81,0,9.051-3.48,9.855-8.381C296.635,30.74,292.942,25.597,287.492,24.702z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M255.88,22.442l-0.247,0.002c-5.522,0.082-9.957,4.624-9.875,10.146c0.08,5.473,4.518,9.853,9.972,9.853    c0.05,0,0.1,0,0.15-0.001c5.523,0,10-4.477,10-10S261.403,22.442,255.88,22.442z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M206.094,38.637c-1.602-5.286-7.188-8.272-12.47-6.67l-0.137,0.042c-5.279,1.624-8.213,7.211-6.589,12.49    c1.322,4.296,5.295,7.053,9.575,7.053c0.977,0,1.97-0.144,2.951-0.445C204.71,49.505,207.696,43.922,206.094,38.637z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M235.801,33.473c-0.882-5.452-5.997-9.162-11.448-8.278l1.457,9.894l-1.476-9.891c-5.462,0.815-9.229,5.904-8.415,11.367    c0.741,4.962,5.008,8.525,9.878,8.525c0.491,0,0.989-0.036,1.489-0.111c0.041-0.006,0.179-0.028,0.219-0.034    C232.957,44.063,236.683,38.925,235.801,33.473z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--                                                        <g>--}}
{{--                                                            <g>--}}
{{--                                                                <path d="M80.357,230.32c-1.164-5.399-6.482-8.834-11.881-7.67c-5.399,1.163-8.833,6.482-7.67,11.881    c0.008,0.037,0.038,0.17,0.046,0.207c1.055,4.641,5.18,7.793,9.747,7.793c0.731,0,1.476-0.082,2.221-0.251    C78.205,241.056,81.581,235.705,80.357,230.32z"/>--}}
{{--                                                            </g>--}}
{{--                                                        </g>--}}
{{--									</svg>--}}
{{--                                                </p>--}}
{{--                                                {!! trans('modals.title.add_department_location') !!}</a>--}}
{{--                                        </h4>--}}
{{--                                    </div>--}}
{{--                                    <div id="collapse3" class="panel-collapse collapse pb-4">--}}
{{--                                        <div class="col-md-12 mx-auto px-0 pb-2">--}}
{{--                                            <input class="form-control" type="text" name=""--}}
{{--                                                   placeholder="{!! trans('fields.placeholder.assign_department_search') !!}"--}}
{{--                                                   style="border: none;border-bottom: 1px solid rgba(0,0,0,.125); border-radius: 0px;"--}}
{{--                                                   id="department-location-search"  autocomplete="off"/>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-10 mx-auto mt-1">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <button type="button" class="btn btn-success btn-block assign-all"--}}
{{--                                                            data-dismiss="modal" role="button"--}}
{{--                                                            data-type="department">{!! trans('main.buttons.assign_all') !!}--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <button type="button" class="btn btn-primary btn-block unassign-all"--}}
{{--                                                            role="button" data-type="department">--}}
{{--                                                        {!! trans('main.buttons.unassign_all') !!}--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-12 mx-auto" style="overflow-y: auto; height: auto;">--}}
{{--                                            <div class="row">--}}
{{--                                                <!-- Assigned begin -->--}}
{{--                                                <div class="col-md-12 py-3 mx-auto card border-left-0 border-right-0 border-top-0">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-md-11 pt-3 mx-auto pl-0 department-assigned-header">--}}
{{--                                                            <h5 class="pl-4 pb-2"--}}
{{--                                                                style="font-family: 'Open Sans', sans-serif;">--}}
{{--                                                                {!! trans('modals.text.anssigned') !!}</h5>--}}
{{--                                                        </div>--}}

{{--                                                    </div>--}}

{{--                                                </div>--}}
{{--                                                <!-- Unsassigned BEGIN  -->--}}
{{--                                                <div class="col-md-12 pt-3 mx-auto">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-md-11 pt-3 pl-0 mx-auto department-unassigned-header">--}}
{{--                                                            <h5 class="pl-4 pb-2"--}}
{{--                                                                style="font-family: 'Open Sans', sans-serif;">--}}
{{--                                                                {!! trans('modals.text.unanssigned') !!}</h5>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-md-11 mt-2 mx-auto pl-4 pr-0">--}}
{{--                                                            <div class="mx-auto mt-2">--}}
{{--                                                                <nav aria-label="Page navigation example">--}}
{{--                                                                    <ul class="pagination pagination-department-unassign">--}}

{{--                                                                    </ul>--}}
{{--                                                                </nav>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <!-- Unsassigned EOF -->--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}


                        <div class="col-md-3 mx-auto px-0 mt-4">
                            <button class="btn btn-primary btn-block" type="button" role="button"
                                    id="business-location-create">{!! trans('main.buttons.update_location') !!}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('components.modal.business_change_logo', ['title' => trans('modals.title.change_location_logo')])

@endsection
@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key={{ env('GOOGLE_MAPS_API_KEY', 'AIzaSyCLDOlFEBqX8B8bwiURqNObe5V5xrJrftw') }}"></script>
    <script src="{{ asset('/js/cropper.min.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/main-cropper.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/business-location.js?v='.time()) }}"></script>
@endsection
