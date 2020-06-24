@extends('layouts.main_business')

@section('content')
<style type="text/css">
    .btn-outline-primary:not([disabled]):not(.disabled).active, .btn-outline-primary:not([disabled]):not(.disabled):active, .show>.btn-outline-primary.dropdown-toggle{
            background: #f7f9fb;
            color: #4E5C6E;
            border: 1px solid #9BA6B2;
            fill:#4E5C6E;
        }
        #keywords .ms-helper{
            font-size: 12px;
            top:35px;
        }
</style>
    <div class="container mt-2 text-center sign-up-business-wizard">
        <div class="row justify-content-center sign-up-step-1 business-steps" style="display: none;">
            <div class="col-12 text-center">
                <form class="my-3 my-sm-5 pb-0" id="sign-up-business-form" autocomplete="off">
                    <div class="card border-0">
                        <div class="card-body px-0 pt-0 pb-5">
                            <div class="business_background" style="height: 400px; max-height: 450px; max-width: 1920px; position: relative;">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="height: auto;">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active" id="myBtn">
                                            <img class="d-block w-100" src="/img/bg-white-cr.png" alt="">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                {{--<img class=""
                                     style="width: 100%; height: 100%; object-fit: cover;"
                                     src="{{ asset('img/bg-white-cr.png') }}">--}}
                                <div style="position: absolute; right: 15px; top:15px;">
                                    <p class="mb-0">
                                        <button type="button" id="business-bg-change-btn" class="btn btn-danger" data-toggle="modal" data-target="#business-bg-modal">{!! trans('main.buttons.change_background') !!}</button>
                                    </p>
                                </div>
                            </div>
                            <!-- /BUSINESS BACKGROUND -->
                            <div class="row justify-content-center mt-3">
                                <div class="col-11 col-lg-11 text-left">
                                    <div class="text-center">
                                        <div class="d-inline-block bg-light px-5 pt-4 pb-3 mb-4 business-pic-view">
                                            <img class=" img-thumbnail" alt="Your business logo" id="business-logo-base64"
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

                                    <div class="d-inline-flex px-0 text-left mb-3">
                                        <div>
                                            <label>
                                                {!! trans('fields.label.language') !!}
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" style="vertical-align: middle; margin-top: -3px; cursor: pointer; opacity: 0.4;" data-toggle="tooltip" title="{!! trans('fields.tooltips.default_languages') !!}">
                                                    <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                </svg>
                                            </label>
                                            <select class="form-control input_style" name="language_prefix" data-default-prefix="{{ $default_language }}">
                                                <option value="en">English (Default)</option>
                                                <option value="fr">French</option>
                                            </select>
                                        </div>
                                    </div>

                                    <p class="mb-1">{!! trans('fields.label.choose_business_type') !!}</p>
                                    <div class="btn-group-vertical text-center col-12 px-0" data-toggle="buttons">
                                        <div class="btn-group flex-column flex-lg-row">
                                            <label class="btn btn-outline-primary btn-block mb-0 py-3 justify-content-center align-items-center business-job-status col-12 col-lg-4" data-status="1">
                                                <input type="radio" name="type" id="business-type-private"  autocomplete="off" value="private">
                                                <p class="text-center mb-0">
                                                    @svg('/img/business_type/corporate.svg',[
                                                        'class' => '',
                                                        'style' => 'vertical-align: middle; margin-top: -4px; fill:rgba(78,92,110,0.4); width:45px; height:45px;',
                                                    ])
                                                </p>
                                                <p class="mb-0"><span style="font-size: 18px;">{!! trans('main.b_type_title.private') !!}</span></p>
                                                <small>{!! trans('main.b_type_text.private') !!}</small>
                                            </label>
                                            <label class="btn btn-outline-primary btn-block my-0 py-3 justify-content-center align-items-center business-job-status col-12 col-lg-4" data-status="2">
                                                <input type="radio" name="type" id="business-type-franchisee"  autocomplete="off" value="franchisee">
                                                <p class="text-center mb-0">
                                                    @svg('/img/business_type/franchise.svg',[
                                                        'class' => '',
                                                        'style' => 'vertical-align: middle; margin-top: -4px; fill:rgba(78,92,110,0.4); width:45px; height:45px;',
                                                    ])
                                                </p>
                                                <p class="mb-0"><span style="font-size: 18px;">{!! trans('main.b_type_title.franchisee') !!}</span></p>
                                                <small>{!! trans('main.b_type_text.franchisee') !!}</small>
                                            </label>
                                            <label class="btn btn-outline-primary btn-block my-0 py-3 justify-content-center align-items-center business-job-status col-12 col-lg-4" data-status="0">
                                                <input type="radio" name="type" id="business-type-online"  autocomplete="off" value="online">
                                                <p class="text-center mb-0">
                                                    @svg('/img/business_type/online.svg',[
                                                        'class' => '',
                                                        'style' => 'vertical-align: middle; margin-top: -4px; fill:rgba(78,92,110,0.4); width:45px; height:45px;',
                                                    ])
                                                </p>
                                                <p class="mb-0"><span style="font-size: 18px;">{!! trans('main.b_type_title.online') !!}</span></p>
                                                <small>{!! trans('main.b_type_text.online') !!}</small>
                                            </label>
                                        </div>
                                        <div class="btn-group flex-column flex-lg-row">
                                            <label class="btn btn-outline-primary btn-block my-0 py-3 justify-content-center align-items-center business-job-status col-12 col-lg-4" data-status="0">
                                                <input type="radio" name="type" id="business-type-hiring"  autocomplete="off" value="hiring">
                                                <p class="text-center mb-0">
                                                    @svg('/img/business_type/hiring.svg',[
                                                        'class' => '',
                                                        'style' => 'vertical-align: middle; margin-top: -4px; fill:rgba(78,92,110,0.4); width:45px; height:45px;',
                                                    ])
                                                </p>
                                                <p class="mb-0"><span style="font-size: 18px;">{!! trans('main.b_type_title.hiring') !!}</span></p>
                                                <small>{!! trans('main.b_type_text.hiring') !!}</small>
                                            </label>
                                            <label class="btn btn-outline-primary btn-block my-0 py-3 justify-content-center align-items-center business-job-status col-lg-4 col-12" data-status="0">
                                                <input type="radio" name="type" id="business-type-ee"
                                                       autocomplete="off" value="ee">
                                                <p class="text-center mb-0">
                                                    @svg('/img/business_type/ngo.svg', [
                                                       'width' => '45px',
                                                       'height' => '45px',
                                                       'style' => 'vertical-align: middle; margin-top: -4px; fill:rgba(78,92,110,0.4);',
                                                    ])
                                                </p>
                                                <p class="mb-0"><span style="font-size: 18px;">{!! trans('main.b_type_title.ngo') !!}</span>
                                                </p>
                                                <small></small>
                                            </label>
                                            <label class="btn btn-outline-primary btn-block my-0 py-3 justify-content-center align-items-center business-job-status col-12 col-lg-4" data-status="0">
                                                <input type="radio" name="type" id="business-type-ee"  autocomplete="off" value="ee">
                                                <p class="text-center mb-0">
                                                    @svg('/img/business_type/ee.svg', [
                                                       'width' => '45px',
                                                       'height' => '45px',
                                                       'style' => 'vertical-align: middle; margin-top: -4px; fill:rgba(78,92,110,0.4);',
                                                    ])
                                                </p>
                                                <p class="mb-0"><span style="font-size: 18px;">{!! trans('main.b_type_title.ee') !!}</span></p>
                                                <small>{!! trans('main.b_type_text.ee') !!}</small>
                                            </label>
                                        </div>
                                    </div>
{{--                                    <div class="text-left">--}}
{{--                                        <div class="d-inline-flex mt-3">--}}
{{--                                            <div>--}}
{{--                                                <label class="mb-0">--}}
{{--                                                    {!! trans('fields.label.hiring_language') !!}--}}
{{--                                                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" style="vertical-align: middle; margin-top: -3px; cursor: pointer; opacity: 0.4;" data-toggle="tooltip" title="{!! trans('fields.tooltips.hiring_language') !!}">--}}
{{--                                                        <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>--}}
{{--                                                    </svg>--}}
{{--                                                </label>--}}
{{--                                                <select class="form-control form-control-sm mb-1 d-inline-flex" name="current_language_prefix">--}}
{{--                                                    --}}{{--<option>English (Default)</option>--}}
{{--                                                    <option>French</option>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="d-flex flex-lg-row flex-column">
                                        <div class="col-md-12 pb-0 mx-auto mt-4 px-0">
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
                                                            <label for="name-en" style="text-align: left;">{!! trans('fields.label.employer_name') !!}</label>
                                                            <input autocomplete="disabled" type="text" class="form-control " name="name" id="name-en" placeholder="{!! trans('fields.placeholder.employer_name') !!}">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-lg-row flex-column pt-3">
                                                        <div class="col-lg-12 col-12 pl-0 pr-0 pxa-0">
                                                            <label style="text-align: left;" for="description-en">{!! trans('fields.label.employer_description') !!}</label>
                                                            <textarea id="description-en" class="form-control input_style " placeholder="{!! trans('fields.placeholder.employer_description') !!}" rows='6' style="resize: none;" name="description"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="nav-fr" role="tabpanel" aria-labelledby="nav-fr-tab">
                                                    <div class="d-flex flex-lg-row flex-column">
                                                        <div class="col-lg-12 col-12 pl-0 pxa-0">
                                                            <label style="text-align: left;" for="name-fr">{!! trans('fields.label.employer_name') !!}</label>
                                                            <input autocomplete="disabled" type="text" class="form-control" name="name_fr" id="name-fr" placeholder="{!! trans('fields.placeholder.employer_name') !!}">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-lg-row flex-column pt-3">
                                                        <div class="col-lg-12 col-12 pl-0 pr-0 pxa-0">
                                                            <label style="text-align: left;" for="description-fr">{!! trans('fields.label.employer_description') !!}</label>
                                                            <textarea id="description-fr" class="form-control input_style" placeholder="{!! trans('fields.placeholder.employer_description') !!}" rows='6' style="resize: none;" name="description_fr"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

{{--                                    <div class="form-group mb-4 mt-3">--}}
{{--                                        <label>{!! trans('fields.label.employer_name') !!}</label>--}}
{{--                                        <input type="text" class="form-control multilanguage multilanguage-en"--}}
{{--                                               placeholder="{!! trans('fields.placeholder.employer_name') !!}" name="name"--}}
{{--                                               autocomplete="disabled">--}}
{{--                                        <input type="text" class="form-control multilanguage multilanguage-fr d-none"--}}
{{--                                               placeholder="{!! trans('fields.placeholder.employer_name') !!}" name="name_fr"--}}
{{--                                               autocomplete="disabled">--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group mb-4">--}}
{{--                                        <label>{!! trans('fields.label.employer_description') !!}</label>--}}
{{--                                        <textarea class="form-control input_style multilanguage multilanguage-en" rows="3"--}}
{{--                                                  placeholder="{!! trans('fields.placeholder.employer_description') !!}"--}}
{{--                                                  name="description"></textarea>--}}
{{--                                        <textarea class="form-control input_style multilanguage multilanguage-fr d-none" rows="3"--}}
{{--                                                  placeholder="{!! trans('fields.placeholder.employer_description') !!}"--}}
{{--                                                  name="description_fr"></textarea>--}}
{{--                                    </div>--}}

                                    {{--<div class="form-group mb-4 text-left">
                                        <label>{!! trans('fields.label.video') !!}</label>
                                        <input type="text" class="form-control multilanguage multilanguage-en"
                                               placeholder="{!! trans('fields.placeholder.video') !!}" name="video"
                                               autocomplete="disabled">
                                        <input type="text" class="form-control multilanguage multilanguage-fr d-none"
                                               placeholder="{!! trans('fields.placeholder.video') !!}" name="video_fr"
                                               autocomplete="disabled">
                                    </div>--}}

                                    <div class="form-group mb-4">
                                        <div class="d-flex flex-column flex-lg-row">
                                            <div class="col-12 col-lg-4 pl-0 text-left pxa-0">
                                                <div class="pl-0 pxa-0">
                                                    <label>{!! trans('fields.label.employer_size') !!}</label>
                                                    <select class="form-control input_style" name="size"></select>
                                                </div>
                                                {{--<div class="col-12 pl-0 pxa-0">
                                                    <label class="mt-2 text-left">{!! trans('fields.label.keywords') !!}</label>
                                                    <div id="keywords" data-language-prefix="en" class="[ multilanguage multilanguage-en ]"></div>
                                                    <div id="keywords-fr" data-language-prefix="fr" class="[ multilanguage multilanguage-fr ] d-none"></div>
                                                </div>--}}
                                            </div>
                                            <div class="col-12 col-lg-4 pr-0 pxa-0">
                                                <div class="">
                                                    <div class="col-md-12 pr-0 pxa-0">
                                                        <label class="text-left">{!! trans('fields.label.industry') !!}</label>
                                                        <div id="industry_id"></div>
                                                    </div>
                                                    {{--<div class="col-md-12 pr-0 pxa-0">
                                                        <label class="mt-2 text-left">{!! trans('fields.label.sub_industry') !!}</label>
                                                        <div id="sub_industry_id"></div>
                                                    </div>--}}
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4 pr-0 pxa-0">
                                                <div class="">
                                                    <div class="col-md-12 pr-0 pxa-0">
                                                        <label class="text-left">{!! trans('fields.label.industry') !!}</label>
                                                        <input type="text" class="form-control" name="industry">
                                                    </div>
                                                    {{--<div class="col-md-12 pr-0 pxa-0">
                                                        <label class="mt-2 text-left">{!! trans('fields.label.sub_industry') !!}</label>
                                                        <div id="sub_industry_id"></div>
                                                    </div>--}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group mb-1">
                                        <div class="d-flex flex-column flex-lg-row">
                                            <div class="col-12 col-lg-3 pl-0 pxa-0">
                                                <label>{!! trans('fields.label.phone_code') !!}</label>
                                                <div id="country-phone" class="bfh-selectbox bfh-countries"
                                                     data-country="CA" data-flags="true">
                                                    <input type="hidden" name="phone_country_code" value="CA"
                                                           class="country"><a
                                                            class="bfh-selectbox-toggle   form-control"
                                                            role="button" data-toggle="bfh-selectbox" href="#"
                                                            style="padding: 8px 20px;">
                                                            <span class="bfh-selectbox-option" id="phone_code">
                                                                <i class="glyphicon bfh-flag-CA"></i>+1 <span>Canada</span></span></a>
                                                    <div class="bfh-selectbox-options">
                                                        <div class="bfh-selectbox-filter-container"><input
                                                                    type="text"
                                                                    class="bfh-selectbox-filter form-control"
                                                                    placeholder="search"  autocomplete="off"></div>
                                                        @include('components.phone_flag')</div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4 pr-0 pxa-0">
                                                <label>{!! trans('fields.label.phone_number') !!}</label>
                                                <input type="tel" class="form-control" id="input-phone"  autocomplete="off"
                                                       placeholder="{!! trans('fields.placeholder.phone_number') !!}" name="phone">
                                            </div>

                                            <div class="col-lg-4 col-12 pr-0 pxa-0">
                                                <label class="text-left">{!! trans('fields.label.website') !!}</label>
                                                <input type="text" class="form-control [ multilanguage multilanguage-en ]"
                                                       placeholder="{!! trans('fields.placeholder.website') !!}"
                                                       name="website" autocomplete="off">
                                                <input type="text" class="form-control [ multilanguage multilanguage-fr ] d-none"
                                                       placeholder="{!! trans('fields.placeholder.website') !!}"
                                                       name="website_fr" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">
                                    <div class="form-group input-group mb-4">
                                        <span class="input-group-addon" id="basic-addon1" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                                            <i class="glyphicon mr-0"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="{!! trans('fields.label.city') !!}" id="user-location-business"
                                               name="city" autocomplete="disabled">
                                        <span class="input-group-btn border-0" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px; top: 7px;">
                                            <button class="btn mx-0 border-0" type="button" id="user-location-clear"
                                                    style="background-color: #f4f4f4; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>{!! trans('fields.label.street_number') !!}</label>
                                            <input type="text" name="street_number" class="form-control"  autocomplete="off"
                                                   placeholder="{!! trans('fields.placeholder.street_number') !!}">
                                        </div>
                                        <div class="col-md-7">
                                            <label>{!! trans('fields.label.road') !!}</label>
                                            {{--<input type="text" name="street" class="form-control"
                                                   placeholder="Ex: Main Street (without postal code please)">--}}
                                            <div id="input-street-check" class="" style="display: none">
                                                <span style="font-size: 13px;">{!! trans('fields.errors.street_address') !!}</span>
                                                <button class="btn" type="button" id="input-street-number-keep">{!! trans('main.buttons.street_address_keep') !!}</button>
                                                <button class="btn" type="button" id="input-street-number-clear">{!! trans('main.buttons.street_address_clear') !!}</button>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control border-right-0 autocomplete-border"  autocomplete="off"
                                                       placeholder="{!! trans('fields.placeholder.street_address') !!}" name="street" id="user-location-street">
                                                <span class="input-group-btn border-0 hide">
                                                    <button class="btn mx-0" type="button" id="user-location-street-clear"
                                                            style="background-color: #e9ecef; border: 1px solid #ced4da; border-left: 0px;">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label>{!! trans('fields.label.suite') !!}</label>
                                            <input type="text" name="suite" class="form-control" placeholder="{!! trans('fields.placeholder.suite') !!}"  autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3 pl-0 pxa-0">
                                        <label class="text-left">{!! trans('fields.label.zip_code') !!}</label>
                                        <input type="text" class="form-control"  autocomplete="off"
                                               placeholder="{!! trans('fields.placeholder.zip_code') !!}"
                                               name="zip_code">
                                    </div>
                                    <hr class="mb-4">
                                    <!-- <p class="mb-3 mt-1" style="opacity: 0.8;">{!! trans('fields.placeholder.hiring_languages') !!}</p> -->

                                    <div class="col-md-12 pt-2 pb-3 text-center">
                                        <div class="row">
                                            @foreach(config('lists.amenities_icons') as $amenities_icon)
                                                <script type="text/template" id="amenities-icon-{{ $amenities_icon }}">
                                        @svg('/img/amenities/' . $amenities_icon . '.svg', [
                                            'width' => '20px',
                                            'height' => '20px',
                                            'style' => 'fill: #007bff;',
                                        ])
                                                </script>
                                            @endforeach
                                            <div class="btn-group col-md-12 amenities-list" data-toggle="buttons">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-left">
                                            <img src="{{ asset('img/icons/facebook.svg') }}" width="30px" height="30px">
                                            Facebook
                                        </label>
                                        <input type="text" name="facebook" placeholder="facebook.com/user123" class="form-control [ multilanguage multilanguage-en ]">
                                        <input type="text" name="facebook_fr" placeholder="facebook.com/user123" class="form-control [ multilanguage multilanguage-fr ] d-none">
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-left">
                                            <img src="{{ asset('img/icons/instagram.svg') }}" width="30px" height="30px">
                                            Instagram
                                        </label>
                                        <input type="text" name="instagram" placeholder="instagram.com/user123" class="form-control [ multilanguage multilanguage-en ]">
                                        <input type="text" name="instagram_fr" placeholder="instagram.com/user123" class="form-control [ multilanguage multilanguage-fr ] d-none">
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-left">
                                            <img src="{{ asset('img/icons/linkedin.svg') }}" width="30px" height="30px">
                                            LinkedIn
                                        </label>
                                        <input type="text" name="linkedin" placeholder="linkedin.com/user123" class="form-control [ multilanguage multilanguage-en ]">
                                        <input type="text" name="linkedin_fr" placeholder="linkedin.com/user123" class="form-control [ multilanguage multilanguage-fr ] d-none">
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-left">
                                            <img src="{{ asset('img/icons/twitter.svg') }}" width="30px" height="30px">
                                            Twitter
                                        </label>
                                        <input type="text" name="twitter" placeholder="twitter.com/user123" class="form-control [ multilanguage multilanguage-en ]">
                                        <input type="text" name="twitter_fr" placeholder="twitter.com/user123" class="form-control [ multilanguage multilanguage-fr ] d-none">
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-left">
                                            <img src="{{ asset('img/icons/youtube.svg') }}" width="30px" height="30px">
                                            Youtube
                                        </label>
                                        <input type="text" name="youtube" placeholder="youtube.com/user123" class="form-control [ multilanguage multilanguage-en ]">
                                        <input type="text" name="youtube_fr" placeholder="youtube.com/user123" class="form-control [ multilanguage multilanguage-fr ] d-none">
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-left">
                                            <img src="{{ asset('img/icons/snapchat.svg') }}" width="30px" height="30px">
                                            Snapchat
                                        </label>
                                        <input type="text" name="snapchat" placeholder="snapchat.com/user123" class="form-control [ multilanguage multilanguage-en ]">
                                        <input type="text" name="snapchat_fr" placeholder="snapchat.com/user123" class="form-control [ multilanguage multilanguage-fr ] d-none">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white py-4">
                            <nav>
                                <ul class="pagination d-flex justify-content-center mb-0">
                                    <li class="page-item bg-white">
                                        <a class="btn btn-primary " href="javascript:void(0)"
                                           id="create-business">{!! trans('main.buttons.create') !!}</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MODALS -->

    {{--<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog"
         tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="avatar-form" action="" enctype="multipart/form-data" method="post" autocomplete="off">
                    <div class="modal-header">
                        <h4 class="modal-title" id="avatar-modal-label">{!! trans('modals.title.change_b_logo') !!}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">

                            <!-- Upload image and data -->
                            <div class="avatar-upload">
                                <input type="hidden" class="avatar-src" name="avatar_src">
                                <input type="hidden" class="avatar-data" name="avatar_data">
                                <div class="bg-white mb-3">
                                    <a href="javascript:void(0)" role="button" class="btn btn-lg btn-outline-primary w-100 p-4" id="avatar-input-btn">
                                        <span class="d-block mb-0">
                                            <svg id="Layer_1" width="45px" height="45px" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><g><path d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z" fill="#4266ff"></path></g></g><g><polygon points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  " fill="#4266ff"></polygon></g></g></svg>
                                        </span>
                                        {!! trans('main.buttons.upload_file') !!}
                                        <p class="mb-0">{!! trans('modals.text.logo_optimal_size') !!}</p>
                                    </a>
                                </div>
                                <input type="file" class="avatar-input" id="avatar-input" name="avatar_file">
                            </div>

                            <!-- Crop and preview -->
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row avatar-btns">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary btn-block avatar-save">{!! trans('main.buttons.save') !!}</button>
                                        </div>
                                    </div>
                                    <p>{!! trans('modals.text.size_previews') !!}</p>
                                    <div class="avatar-preview preview-lg">
                                    </div>
                                    <div class="avatar-preview preview-md">
                                    </div>
                                    <div class="avatar-preview preview-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>--}}
    @include('components.modal.business_change_logo')
    @include('components.modal.business_change_background')
    @include('components.modal.claim_existing_business')
    @include('components.modal.franchise')


@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>
    <script src="{{ asset('/js/jack.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key={{ env('GOOGLE_MAPS_API_KEY', 'AIzaSyCLDOlFEBqX8B8bwiURqNObe5V5xrJrftw') }}"></script>
    <script src="{{ asset('/js/app/signup-business.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/u_business.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/cropper.min.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/main-cropper.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/business-bg-cropper.js?v='.time()) }}"></script>
@stop
