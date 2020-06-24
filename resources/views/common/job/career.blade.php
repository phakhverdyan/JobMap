@extends('layouts.main_business')

@push('meta')
    <meta property="og:title" content="{{ $data->localized_name }}">
    <meta property="og:image" content="{{ $data->picture_o }}">
    <meta property="og:description" content="{{ $data->localized_description }}">
@endpush

@section('content')

    <style type="text/css">
        .business_tabs {
            font-size: 19px;
            color: #4E5C6E;
        }

        .business_tabs.active {
            font-weight: bold;
            color: #4266ff;
            fill:#4266ff!important;
        }

        .business_tabs.active span svg{
            fill:#4266ff!important;
        }

        .business_tabs_numbers {
            font-size: 16px;
            opacity: 0.5;
        }

        .business_tabs.active .business_tabs_numbers {
            opacity: 1;
        }

        .border {
            border: 1px solid #e2e2e0 !important;
        }

        .result_shadow {
            -webkit-box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.2);
            box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.2);
        }
        .carousel{
            z-index: 0;
        }

        .page-item.inactive a{
            color: #000000;
            cursor: default;
        }
        .page-item.inactive a:hover{
            background-color: #ffffff;
        }
        .page-item.active a{
            cursor: default;
        }
        .carousel-item {
            min-height: 300px;
            max-height: 450px;
            height: auto;
        }
        .career-page__benefit-item {
            border:1px solid #4E5C6E;
            padding: 10px;
            width: 55px;
            border-radius: 25px;
            height: 55px;
            text-align: center;
            /*line-height: 75px;*/
            margin:0 15px;
        }
        .career-page__benefit-item:hover {
            border:1px solid #4266ff;
        }
        .career-page__benefit-item:hover svg {
            fill: #4266ff!important;
        }
        .tooltip-inner {
            color: #fff;
            background-color: #4266ff;
            opacity: 1;
        }
        .tooltip.bs-tooltip-auto[x-placement^=top] .arrow::before, .tooltip.bs-tooltip-top .arrow::before {
            margin-left: -3px;
            content: "";
            border-width: 5px 5px 0;
            border-top-color: #000;
            border-bottom-color: #4266ff;
        }

        .career-page__background-container {
            position: relative;
            text-align: center;
            overflow: hidden;
            font-size: 0;
            min-height: 0;
            max-height: 400px;
            height: auto;
            opacity: 1.0;
        }

        .career-page__background__blur {
            position: absolute;
            z-index: 0;
            top: -20px;
            right: -20px;
            bottom: -20px;
            left: -20px;
            background-position: center;
            background-size: cover;
            filter: blur(10px);
            opacity: 1.0;
            transition: opacity 0.2s linear;
        }
    </style>
    <div id="business-view" style="margin-top: -5px; overflow: hidden; background-color: #fff;">
        <!-- content block begin-->
        <div class="text-center py-4 business_top_location" style="background-color: rgba(0,0,0,0.6); position: absolute; width: 100%; z-index: 9">
            <p class="px-4 align-self-center mb-0">
                <a href="{{ url('/map/world') }}" id="link-location-world"
                   class="text-white" data-toggle="tooltip" data-placement="top"
                   title="Explore the World">{!! trans('main.world') !!}</a>
                <span style="opacity: 0.4;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         version="1.1" id="Capa_1" x="0px" y="0px" width="13px" height="13px"
                         viewBox="0 0 292.359 292.359"
                         style="enable-background:new 0 0 292.359 292.359; vertical-align: middle; margin-top: -3px; fill:#fff;"
                         xml:space="preserve">
                        <g>
                            <path d="M222.979,133.331L95.073,5.424C91.456,1.807,87.178,0,82.226,0c-4.952,0-9.233,1.807-12.85,5.424   c-3.617,3.617-5.424,7.898-5.424,12.847v255.813c0,4.948,1.807,9.232,5.424,12.847c3.621,3.617,7.902,5.428,12.85,5.428   c4.949,0,9.23-1.811,12.847-5.428l127.906-127.907c3.614-3.613,5.428-7.897,5.428-12.847   C228.407,141.229,226.594,136.948,222.979,133.331z"/>
                        </g>
                    </svg>
                </span>
                <a href="{{ setLocationURL('country', $data) }}" id="link-location-country"
                   class="text-white" data-toggle="tooltip" data-placement="top"
                   title="Explore Country">{{ $data->country }}</a>
                <span style="opacity: 0.4;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         version="1.1" id="Capa_1" x="0px" y="0px" width="13px" height="13px"
                         viewBox="0 0 292.359 292.359"
                         style="enable-background:new 0 0 292.359 292.359; vertical-align: middle; margin-top: -3px; fill:#fff;"
                         xml:space="preserve">
                        <g>
                            <path d="M222.979,133.331L95.073,5.424C91.456,1.807,87.178,0,82.226,0c-4.952,0-9.233,1.807-12.85,5.424   c-3.617,3.617-5.424,7.898-5.424,12.847v255.813c0,4.948,1.807,9.232,5.424,12.847c3.621,3.617,7.902,5.428,12.85,5.428   c4.949,0,9.23-1.811,12.847-5.428l127.906-127.907c3.614-3.613,5.428-7.897,5.428-12.847   C228.407,141.229,226.594,136.948,222.979,133.331z"/>
                        </g>
                    </svg>
                </span>
                <a href="{{ setLocationURL('region', $data) }}" id="link-location-region"
                   class="text-white" data-toggle="tooltip" data-placement="top"
                   title="Explore Region">{{ $data->region }}</a>
                <span style="opacity: 0.4;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         version="1.1" id="Capa_1" x="0px" y="0px" width="13px" height="13px"
                         viewBox="0 0 292.359 292.359"
                         style="enable-background:new 0 0 292.359 292.359; vertical-align: middle; margin-top: -3px; fill:#fff;"
                         xml:space="preserve">
                        <g>
                            <path d="M222.979,133.331L95.073,5.424C91.456,1.807,87.178,0,82.226,0c-4.952,0-9.233,1.807-12.85,5.424   c-3.617,3.617-5.424,7.898-5.424,12.847v255.813c0,4.948,1.807,9.232,5.424,12.847c3.621,3.617,7.902,5.428,12.85,5.428   c4.949,0,9.23-1.811,12.847-5.428l127.906-127.907c3.614-3.613,5.428-7.897,5.428-12.847   C228.407,141.229,226.594,136.948,222.979,133.331z"/>
                        </g>
                    </svg>
                </span>
                <a href="{{ setLocationURL('city', $data) }}" id="link-location-city" class="text-white"
                   data-toggle="tooltip" data-placement="top" title="Explore City">{{ $data->city }}</a>
                <span style="opacity: 0.4;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         version="1.1" id="Capa_1" x="0px" y="0px" width="13px" height="13px"
                         viewBox="0 0 292.359 292.359"
                         style="enable-background:new 0 0 292.359 292.359; vertical-align: middle; margin-top: -3px; fill:#fff;"
                         xml:space="preserve">
                        <g>
                            <path d="M222.979,133.331L95.073,5.424C91.456,1.807,87.178,0,82.226,0c-4.952,0-9.233,1.807-12.85,5.424   c-3.617,3.617-5.424,7.898-5.424,12.847v255.813c0,4.948,1.807,9.232,5.424,12.847c3.621,3.617,7.902,5.428,12.85,5.428   c4.949,0,9.23-1.811,12.847-5.428l127.906-127.907c3.614-3.613,5.428-7.897,5.428-12.847   C228.407,141.229,226.594,136.948,222.979,133.331z"/>
                        </g>
                    </svg>
                </span>
                <a href="{{ setLocationURL('street', $data) }}" id="link-location-street"
                   class="text-white" data-toggle="tooltip" data-placement="top"
                   title="Explore Street">{{ $data->street }}</a>
                <span style="opacity: 0.4;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         version="1.1" id="Capa_1" x="0px" y="0px" width="13px" height="13px"
                         viewBox="0 0 292.359 292.359"
                         style="enable-background:new 0 0 292.359 292.359; vertical-align: middle; margin-top: -3px; fill:#fff;"
                         xml:space="preserve">
                        <g>
                            <path d="M222.979,133.331L95.073,5.424C91.456,1.807,87.178,0,82.226,0c-4.952,0-9.233,1.807-12.85,5.424   c-3.617,3.617-5.424,7.898-5.424,12.847v255.813c0,4.948,1.807,9.232,5.424,12.847c3.621,3.617,7.902,5.428,12.85,5.428   c4.949,0,9.23-1.811,12.847-5.428l127.906-127.907c3.614-3.613,5.428-7.897,5.428-12.847   C228.407,141.229,226.594,136.948,222.979,133.331z"/>
                        </g>
                    </svg>
                </span>
                <a href="{{ setLocationURL('address', $data) }}" id="link-location-address"
                   class="text-white" data-toggle="tooltip" data-placement="top"
                   title="Explore building/location">{{ $data->street.' '. $data->street_number }}</a>
                <span style="opacity: 0.4;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         version="1.1" id="Capa_1" x="0px" y="0px" width="13px" height="13px"
                         viewBox="0 0 292.359 292.359"
                         style="enable-background:new 0 0 292.359 292.359; vertical-align: middle; margin-top: -3px; fill:#fff;"
                         xml:space="preserve">
                        <g>
                            <path d="M222.979,133.331L95.073,5.424C91.456,1.807,87.178,0,82.226,0c-4.952,0-9.233,1.807-12.85,5.424   c-3.617,3.617-5.424,7.898-5.424,12.847v255.813c0,4.948,1.807,9.232,5.424,12.847c3.621,3.617,7.902,5.428,12.85,5.428   c4.949,0,9.23-1.811,12.847-5.428l127.906-127.907c3.614-3.613,5.428-7.897,5.428-12.847   C228.407,141.229,226.594,136.948,222.979,133.331z"/>
                        </g>
                    </svg>
                </span>
                <span class="text-white"><strong>{!! trans('main.employer_location') !!}</strong></span>
            </p>
        </div>

        @if ($type_items == 'jobs' || $type_items == 'description')

            <div class="career-page__background-container">
                {{--<div class="career-page__background__blur" style="background-image: url('https://dev3.jobmap.co/business/95/widgets/gIlG2eGyib5LMm6h95.jpeg');">
                </div>--}}
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="height: auto; position: relative; max-width: 1920px; margin: 0 auto;">
                    <div class="carousel-inner">
                        @if (count($data->images) > 0)
                            @php($first = true)
                            @foreach($data->images as $image)

                                <div class="carousel-item {{ $first ? 'active' : '' }}" data-toggle="modal" data-target="#modal_bg_business_carousel" data-number="{{ $image->number }}">
                                    <img class="d-block w-100" src="{!! $image->bg_picture !!}" alt="{{ $data->localized_name }}">
                                </div>

                                @php($first = false)
                            @endforeach
                        @else

                            <div class="carousel-item active" id="myBtn">
                                <img class="d-block w-100" src="/img/bg-white-cr.png" alt="{{ $data->localized_name }}">
                            </div>

                        @endif
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
            </div>
        @else

            <div class="col-md-12" id="map" style="height: 400px;"></div>

        @endif

        <div class="careerpage_businessname"
             style=" width: 100%; height: 60px; margin-top: -59px; position: absolute;">
            <div class="container" style="position: relative;">
                <div class="d-flex justify-content-between flex-lg-row flex-column pt-2 career-page_buss-logo_mobile">
                    <div class="d-flex flex-lg-row flex-column">
                        <div class="pxa-0 mxa-0 text-center text-md-left align-self-center mr-3 careerpage_businessname bg-white wow animated fadeInDown"
                             style="margin-top: 10px; position: absolute; border-radius: 10px;">
                            <img class="business-icon careerpage_icon"
                                 src="{{ $data->picture }}" style="width: 175px; border:5px solid #fff; border-radius: 10px;">
                        </div>

                    </div>

                    <div class="align-self-center" style="display: none;">
                        <button class="btn btn-primary border-0 mt-0 mb-3 mb-lg-0" id="map-resize" data-map="1"
                                data-text="{!! trans('main.buttons.smaller_map') !!}"
                                style="background-color: #0747a6;">
                            {!! trans('main.buttons.bigger_map') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100" style="background: rgba(0,0,0,0.05);">
            <div class="container">
                <div class="col-12 px-0">
                    <div class="d-flex flex-lg-row flex-column justify-content-between">
                        <div class="flex-1 mt-3 mt-lg-0 align-self-center justify-content-lg-start px-0 justify-content-center d-inline-flex">
                            <p class="mb-0 align-self-center mxa-0 text-black business_name_color text-center" id="business-name" style="font-size: 30px; margin-left: 185px;">
                                {{ $data->localized_name }}
                            </p>
                        </div>
                        <div class="d-flex flex-lg-row flex-column justify-content-between">
                            <div class="d-flex flex-sm-row flex-column justify-content-between justify-content-lg-center w-100">
                                <div class="text-center py-3 mxa-0 mr-5 align-self-center">
                                    <div class="mb-3 mb-lg-0">
                                        <a href="{{ $main_link }}/" class="business_tabs mxa-0 {{ $type_items == 'description' ? 'active' : ''}}" data-toggle="tooltip" title="{!! trans('main.counters.welcome_page') !!}">
                                            <span>
                                                 @svg('/img/icons/homepage.svg', [
                                                   'width' => '20px',
                                                   'height' => '20px',
                                                   'class' => 'ml-1 ',
                                                   'style' => 'vertical-align: middle; margin-top: -3px;',
                                                  ])
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="text-center py-3 mxa-0 mr-5 align-self-center">
                                    <div class="mb-3 mb-lg-0">
                                        <a href="{{ $main_link }}/brands" class="business_tabs mxa-0 {{ $type_items == 'brands' ? 'active' : ''}}" data-toggle="tooltip" title="{!! trans('main.counters.brands') !!}">
                                            <span id="brand-count">
                                                {!! trans('main.counters.brands_c', ['count' =>  $brand_count ?? '']) !!}
                                                 @svg('/img/icons/brands.svg', [
                                                   'width' => '20px',
                                                   'height' => '20px',
                                                   'class' => 'ml-1 ',
                                                   'style' => 'vertical-align: middle; margin-top: -3px; fill:#4E5C6E;',
                                                  ])
                                            </span>
                                        </a>
                                    </div>
                                </div>

                                <div class="text-center py-3 mxa-0 mr-5 align-self-center">
                                    <div class="mb-3 mb-lg-0">
                                        <a href="{{ $main_link }}/jobs" class="business_tabs mxa-0 {{ $type_items == 'jobs' ? 'active' : ''}}" data-toggle="tooltip" title="{!! trans('main.counters.jobs_text') !!}">
                                            <span id="job-count">
                                                {!! trans('main.counters.jobs_c', ['count' =>  $jobs_count ?? ''/*$items->count*/]) !!}
                                                 @svg('/img/icons/jobs.svg', [
                                                   'width' => '20px',
                                                   'height' => '20px',
                                                   'class' => 'ml-1 ',
                                                   'style' => 'vertical-align: middle; margin-top: -3px; fill:#4E5C6E;',
                                                  ])
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                {{--<div class="text-center py-3 mxa-0 mr-5 align-self-center">
                                    <div class="mb-3 mb-lg-0">
                                        <a href="{{ $main_link }}/headquarters" class="business_tabs mxa-0 mb-3 mb-lg-0 {{ $type_items == 'headquarters' ? 'active' : ''}}" data-toggle="tooltip" title="{!! trans('main.counters.headquarters_text') !!}">
                                            <span id="headquarter-count">
                                                {!! trans('main.counters.headquarters_c', ['count' => $data->headquarters_count]) !!}
                                                @svg('/img/icons/headquarters.svg', [
                                                   'width' => '20px',
                                                   'height' => '20px',
                                                   'class' => 'ml-1 ',
                                                  ])
                                            </span>
                                        </a>
                                    </div>
                                </div>--}}
                                <div class="text-center py-3 mxa-0 align-self-center">
                                    <div class="mb-3 mb-lg-0">
                                        <a href="{{ $main_link }}/locations" class="business_tabs mxa-0 {{ $type_items == 'locations' ? 'active' : ''}}" data-toggle="tooltip" title="{!! trans('main.counters.branches_text') !!}">
                                            <span id="location-count">
                                                {{--{!! trans('main.counters.branches_c', ['count' => $data->locations_count+$data->headquarters_count]) !!}--}}
                                                {!! trans('main.counters.branches_c', ['count' => $locations_count]) !!}
                                                @svg('/img/icons/locations.svg', [
                                                   'width' => '20px',
                                                   'height' => '20px',
                                                   'class' => 'ml-1 ',
                                                  ])
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="align-self-center ml-5 mxa-0">
                                <button class="btn btn-success send-resume w-100 mr-3 mb-3 mb-lg-0"
                                        data-b-id="{{ $data->id }}"
                                        id="animate_hover" data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="{!! trans('main.buttons_hint.want_to_apply_here') !!}">
                                    <span class="mb-0 d-flex justify-content-center" style="font-weight: 400;">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                             x="0px" y="0px" viewBox="0 0 426.667 426.667"
                                             style="enable-background:new 0 0 426.667 426.667;"
                                             xml:space="preserve" class="mr-2 align-self-center" widht="20px" height="20px">
                                            <g>
                                                <g>
                                                    <path d="M384,96h-85.333V53.333c0-23.573-19.093-42.667-42.667-42.667h-85.333C147.093,10.667,128,29.76,128,53.333V96H42.667    c-23.573,0-42.453,19.093-42.453,42.667L0,373.333C0,396.907,19.093,416,42.667,416H384c23.573,0,42.667-19.093,42.667-42.667    V138.667C426.667,115.093,407.573,96,384,96z M256,96h-85.333V53.333H256V96z"/>
                                                </g>
                                            </g>
                                        </svg>
                                        {!! trans('main.buttons.i_m_interested') !!}
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-12 px-0 mb-3">
                <div class="d-flex flex-lg-row flex-column mt-3">
                    <div class="mr-5 col-lg-3 col-12 px-0 mt-3">
                        <div class="mb-3 d-flex justify-content-between">
                            <a href="{{ url('/') }}" role="button" class="btn btn-outline-new btn-block align-self-center" >
                                {!! trans('main.buttons.back_to_full_map') !!}
                            </a>
                            <span class="ml-2 align-self-center" data-toggle="tooltip" title="" data-original-title="{{ trans('fields.tooltips.email_share_this_job') }}">
                                @if ($show_share)
                                    <a data-toggle="modal" data-target="#ShareModal" data-title="{{ $data->localized_name }}" data-description="{{ $data->localized_description }}" data-image="{{ $data->picture }}" data-link="https://jobmap.co/business/view/{{ $data->id }}/{{ $data->slug }}?locale={{ \App::getLocale() }}">
                                        @svg('/img/share.svg',[
                                            'class' => 'sharebutton_svg_class mx-1',
                                            'style' => 'margin-top:5px;',
                                        ])
                                    </a>
                                @endif
                            </span>
                        </div>

                        {{-- @if ($data->video)

                            <iframe height="155" src="{!! $data->video !!}" class="w-100 border-0"></iframe>

                        @endif --}}

                        <div class="text-left py-2 pb-4 title_left_sorting rounded mt-3" style="font-size: 14px;">
                            <div class="mb-4">
                                {{--<p class="mb-0 py-2 text-justify"><strong>{{ $data->type }}</strong></p>--}}
                                @svg('/img/business_type/corporate.svg',[
                                    'class' => '',
                                    'style' => 'margin-top: 5px; float: left; width: 55px; height: 55px; margin-right: 20px; fill: #4E5C6E;',
                                ])
                                <p class="mb-0">{{ trans('fields.label.industry') }}:</p>
                                <p class="mb-1"><strong> {{ $data->_industry }}{{--, {{ $data->_sub_industry }}--}}</strong></p>
                                <div class="d-flex flex-wrap">
                                    @foreach ($unique_locations as $location)
                                        <i class="glyphicon bfh-flag-{{ $location->country_code }}"></i>
                                    @endforeach
                                </div>
                            </div>

                            {{--<p class="mb-0 py-2 text-justify"> {{ $data->_size }} {!! trans('main.employees') !!}</p>--}}

                            <p class="mb-0 py-2 text-justify">
                                <img src="{{ asset('img/icons/phone.svg') }}" width="30px" height="30px">
                                {{ $data->phone_code }}{{ $data->phone }}
                            </p>

                            @if($data->localized_website)
                            <p class="mb-0 py-2 text-justify">
                                <a target="_blank" href="{!! (is_null(parse_url($data->localized_website, PHP_URL_HOST)) ? '//' : '').$data->localized_website !!}" class="regural_text_style" data-toggle="tooltip" title="{{ $data->localized_website }}">
                                    <img src="{{ asset('img/icons/website.svg') }}" width="30px" height="30px">
                                    {{ trans('fields.label.website') }}
                                </a>
                            </p>
                            @endif

                            @if($data->localized_facebook)
                                <p class="mb-0 py-2 text-justify">
                                    <a href="{!! (is_null(parse_url($data->localized_facebook, PHP_URL_HOST)) ? '//' : '').$data->localized_facebook !!}" target="_blank">
                                        <img src="{{ asset('img/icons/facebook.svg') }}" width="30px" height="30px">
                                        Facebook
                                    </a>
                                </p>
                            @endif

                            @if($data->localized_instagram)
                            <p class="mb-0 py-2 text-justify">
                                <a href="{!! (is_null(parse_url($data->localized_instagram, PHP_URL_HOST)) ? '//' : '').$data->localized_instagram !!}" target="_blank">
                                    <img src="{{ asset('img/icons/instagram.svg') }}" width="30px" height="30px">
                                    Instagram
                                </a>
                            </p>
                            @endif

                            @if($data->localized_twitter)
                            <p class="mb-0 py-2 text-justify">
                                <a href="{!! (is_null(parse_url($data->localized_twitter, PHP_URL_HOST)) ? '//' : '').$data->localized_twitter !!}" target="_blank">
                                    <img src="{{ asset('img/icons/twitter.svg') }}" width="30px" height="30px">
                                    Twitter
                                </a>
                            </p>
                            @endif

                            @if($data->localized_linkedin)
                            <p class="mb-0 py-2 text-justify">
                                <a href="{!! (is_null(parse_url($data->localized_linkedin, PHP_URL_HOST)) ? '//' : '').$data->localized_linkedin !!}" target="_blank">
                                    <img src="{{ asset('img/icons/linkedin.svg') }}" width="30px" height="30px">
                                    Linkedin
                                </a>
                            </p>
                            @endif

                            @if (FALSE /* DISABLED 22.09.2018 because of question: is that needed? */)
                                <p class="mb-0 text-justify"><strong>{!! trans('main.label.hiring_languages') !!}</strong> {{ $data->_languages }}</p>
                            @endif

                            {{--<div class="border rounded py-3 mt-3">
                                <p class="px-3" style="font-size: 20px;">{!! trans('main.social_platforms') !!}</p>
                                <hr>
                                <p class="px-3">{!! trans('main.social_platforms_text') !!}</p>

                                <div class="d-flex justify-content-between mb-3 px-3">

                                    <a href="{!! $data->localized_instagram ? (is_null(parse_url($data->localized_instagram, PHP_URL_HOST)) ? '//' : '').$data->localized_instagram : 'javascript:0' !!}" target="_blank">
                                        <img src="{{ asset('img/icons/instagram'. ($data->localized_instagram ? '' : '_grey') . '.svg') }}" width="40px" height="40px">
                                    </a>
                                    <a href="{!! $data->localized_facebook ? (is_null(parse_url($data->localized_facebook, PHP_URL_HOST)) ? '//' : '').$data->localized_facebook : 'javascript:0' !!}" target="_blank">
                                        <img src="{{ asset('img/icons/facebook'. ($data->localized_facebook ? '' : '_grey') . '.svg') }}" width="40px" height="40px">
                                    </a>
                                    <a href="{!! $data->localized_twitter ? (is_null(parse_url($data->localized_twitter, PHP_URL_HOST)) ? '//' : '').$data->localized_twitter : 'javascript:0' !!}" target="_blank">
                                        <img src="{{ asset('img/icons/twitter'. ($data->localized_twitter ? '' : '_grey') . '.svg') }}" width="40px" height="40px">
                                    </a>
                                    <a href="{!! $data->localized_linkedin ? (is_null(parse_url($data->localized_linkedin, PHP_URL_HOST)) ? '//' : '').$data->localized_linkedin : 'javascript:0' !!}" target="_blank">
                                        <img src="{{ asset('img/icons/linkedin'. ($data->localized_linkedin ? '' : '_grey') . '.svg') }}" width="40px" height="40px">
                                    </a>
                                </div>

                                <div class="d-flex justify-content-around mb-3 px-3">
                                    <a target="_blank" href="{!! $data->localized_website ? (is_null(parse_url($data->localized_website, PHP_URL_HOST)) ? '//' : '').$data->localized_website : 'javascript:0' !!}" class="regural_text_style" data-toggle="tooltip" title="{{ $data->localized_website }}">
                                        <img src="{{ asset('img/icons/website'. ($data->localized_website ? '' : '_grey') . '.svg') }}" width="40px" height="40px">
                                    </a>
                                    <a target="_blank" href="{!! $data->youtube ? (is_null(parse_url($data->localized_youtube, PHP_URL_HOST)) ? '//' : '').$data->localized_youtube : 'javascript:0' !!}" class="regural_text_style" data-toggle="tooltip" title="{{ $data->localized_youtube }}">
                                        <img src="{{ asset('img/icons/youtube'. ($data->localized_youtube ? '' : '_grey') . '.svg') }}" width="40px" height="40px">
                                    </a>
                                    <a target="_blank" href="{!! $data->localized_snapchat ? (is_null(parse_url($data->localized_snapchat, PHP_URL_HOST)) ? '//' : '').$data->localized_snapchat : 'javascript:0' !!}" class="regural_text_style" data-toggle="tooltip" title="{{ $data->localized_snapchat }}">
                                        <img src="{{ asset('img/icons/snapchat'. ($data->localized_snapchat ? '' : '_grey') . '.svg') }}" width="40px" height="40px">
                                    </a>
                                </div>

                            </div>--}}

                        </div>
                    </div>
                    <div class="flex-1">
                        @if ($type_items == 'locations')
                            <?php
                                $itemsHeadquarter = clone $headquarters;
                                $itemsHeadquarter->items = collect($itemsHeadquarter->items)->filter(function ($value) {
                                    return $value->type == 'headquarter';
                                })->values()->toArray();
                                $itemsLocation = clone $items;
                                $itemsLocation->items = collect($itemsLocation->items)->filter(function ($value) {
                                    return $value->type == 'location';
                                })->values()->toArray();
                            ?>

                            <div class="flex-1 mb-5">
                                <h3>{!! trans('main.counters.headquarters_text') !!}</h3>
                                @include('common.job.career_items', [ 'items' => $itemsHeadquarter, 'show_searchbar' => false ])
                            </div>
                            <div class="flex-1 mb-5">
                                <h3>{!! trans('main.counters.branches_text') !!}</h3>
                                @include('common.job.career_items', [ 'items' => $itemsLocation, 'show_searchbar' => true, 'without_filters' => true ])
                            </div>
                        @elseif ($type_items == 'brands')
                            <?php
                                $itemsBusiness = clone $items;
                                $itemsBusiness->items = collect($itemsBusiness->items)->filter(function ($value) {
                                    return $value->parent_id == null;
                                })->values()->toArray();
                                $itemsBrand = clone $items;
                                $itemsBrand->items = collect($itemsBrand->items)->filter(function ($value) {
                                    return $value->parent_id;
                                })->values()->toArray();
                            ?>

                            <div class="flex-1 mb-5">
                                <h3>{!! trans('main.corporate_office') !!}</h3>
                                @include('common.job.career_items', [ 'items' => $itemsBusiness, 'show_searchbar' => false ])
                            </div>
                            <div class="flex-1 mb-5">
                                <h3>{!! trans('main.brands') !!}</h3>
                                @include('common.job.career_items', [ 'items' => $itemsBrand, 'show_searchbar' => true, 'without_filters' => true ])
                            </div>
                        @else
                            @include('common.job.career_items', [ 'show_searchbar' => true ])

                            @if ($type_items == 'description')
                                <p class="h4 mt-3 text-center">{!! trans('main.welcome_to') !!} {{ $data->localized_name }}</p>
                                <div class="small_big_description">
                                    <pre id="business-description" class="mt-3 text-justify pre_discription font-14 discription_cut">{{ $data->localized_description }}</pre>
                                    <a class="more_less">more</a>
                                </div>
                                {{-- <div class="adv_benefits">
                                    <p class="h4 mt-3 text-center">Advantages and benefits</p>
                                    <div class="d-flex justify-content-center flex-wrap">
                                        <div class="career-page__benefit-item" data-toggle="tooltip" title="test">
                                            @svg('/img/business_type/corporate.svg',[
                                                'class' => '',
                                                'style' => 'width: 30px; height: 30px; fill: #4E5C6E;',
                                            ])
                                        </div>
                                        <div class="career-page__benefit-item" data-toggle="tooltip" title="test">
                                            @svg('/img/business_type/corporate.svg',[
                                                'class' => '',
                                                'style' => 'width: 30px; height: 30px; fill: #4E5C6E;',
                                            ])
                                        </div>
                                    </div>
                                </div> --}}
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('components.footer.footer_new')

    <!--JOB FILTER MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="jobfiltermodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 750px;">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.job_filter') !!}</h5>
                    <button type="button" class="close align-self-center" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body pb-3 pt-0">
                    <div class="card border-0">
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-6 mt-3">

                                    <div class="col-12 px-0 mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <small class="form-text text-muted mb-2">{!! trans('fields.label.hours') !!}
                                                </small>
                                                <input type="text" class="form-control"
                                                       placeholder="{!! trans('fields.placeholder.hours') !!}" id="filter-hours">
                                            </div>
                                            <div class="col-6">
                                                <small class="form-text text-muted mb-2">{!! trans('fields.label.salary') !!}</small>
                                                <input type="text" class="form-control"
                                                       placeholder="{{ trans('pages.salary_in') }}" id="filter-salary">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <small class="form-text text-muted mb-2">{!! trans('fields.label.department') !!}
                                        </small>
                                        <div id="department"></div>

                                    </div>

                                    {{--<div class="form-group mb-3">--}}
                                    {{--<small class="form-text text-muted mb-2">Job categories--}}
                                    {{--</small>--}}
                                    {{--<div id="job_category"></div>--}}

                                    {{--</div>--}}

                                    <div class="form-group mb-3">
                                        <small class="form-text text-muted mb-2">{!! trans('fields.label.languages') !!}
                                        </small>
                                        <div id="language_level"></div>

                                    </div>


                                </div>
                                <div class="col-6 mt-3">

                                    <div class="form-group mb-3">
                                        <small class="form-text text-muted mb-2">{!! trans('fields.label.job_types') !!}
                                        </small>
                                        <div id="job_type"></div>

                                    </div>

                                    <div class="form-group mb-3">
                                        <small class="form-text text-muted mb-2">{!! trans('fields.label.career_level') !!}
                                        </small>
                                        <div id="career_level"></div>

                                    </div>

                                    <div class="form-group mb-3">
                                        <small class="form-text text-muted mb-2">{!! trans('fields.label.certifications') !!}
                                        </small>
                                        <div id="certification_required"></div>

                                    </div>

                                </div>

                                <div class="col-4 mx-auto mt-3">
                                    <button class="btn btn-outline-warning btn-block" id="clear-filters"
                                            type="button">{!! trans('main.buttons.clear_filters') !!}
                                    </button>
                                </div>
                                <div class="col-4 mx-auto mt-3">
                                    <button class="btn btn-primary btn-block" id="set-filters"
                                            type="button">{!! trans('main.buttons.set_filters') !!}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-job-locations-list" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <div class="text-right mb-2">
                        <button type="button" class="close float-none" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="d-flex align-items-baseline justify-content-between">
                        <h5 class="modal-title" style="flex: 1" id="modal-job-name">{!! trans('modals.title.location_address') !!}</h5>

                        <div class="d-flex align-items-center">
                            <a href="" id="link-job-union">
                                <p class="mb-0 mr-2 h6" id="count-job-locations">
                                    {!! trans('modals.text.available_in') !!}
                                </p>
                            </a>
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 477 477" style="enable-background:new 0 0 477 477;" xml:space="preserve">
                                <path d="M238.4,0C133,0,47.2,85.8,47.2,191.2c0,12,1.1,24.1,3.4,35.9c0.1,0.7,0.5,2.8,1.3,6.4c2.9,12.9,7.2,25.6,12.8,37.7
                                    c20.6,48.5,65.9,123,165.3,202.8c2.5,2,5.5,3,8.5,3s6-1,8.5-3c99.3-79.8,144.7-154.3,165.3-202.8c5.6-12.1,9.9-24.7,12.8-37.7
                                    c0.8-3.6,1.2-5.7,1.3-6.4c2.2-11.8,3.4-23.9,3.4-35.9C429.6,85.8,343.8,0,238.4,0z M399.6,222.4c0,0.2-0.1,0.4-0.1,0.6
                                    c-0.1,0.5-0.4,2-0.9,4.3c0,0.1,0,0.1,0,0.2c-2.5,11.2-6.2,22.1-11.1,32.6c-0.1,0.1-0.1,0.3-0.2,0.4
                                    c-18.7,44.3-59.7,111.9-148.9,185.6c-89.2-73.7-130.2-141.3-148.9-185.6c-0.1-0.1-0.1-0.3-0.2-0.4c-4.8-10.4-8.5-21.4-11.1-32.6
                                    c0-0.1,0-0.1,0-0.2c-0.6-2.3-0.8-3.8-0.9-4.3c0-0.2-0.1-0.4-0.1-0.7c-2-10.3-3-20.7-3-31.2c0-90.5,73.7-164.2,164.2-164.2
                                    s164.2,73.7,164.2,164.2C402.6,201.7,401.6,212.2,399.6,222.4z" fill="#4266ff"/>
                                <path d="M238.4,71.9c-66.9,0-121.4,54.5-121.4,121.4s54.5,121.4,121.4,121.4s121.4-54.5,121.4-121.4S305.3,71.9,238.4,71.9z
                                    M238.4,287.7c-52.1,0-94.4-42.4-94.4-94.4s42.4-94.4,94.4-94.4s94.4,42.4,94.4,94.4S290.5,287.7,238.4,287.7z"
                                      fill="#4266ff"/>
                            </svg>

                        </div>
                    </div>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="notifyModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.send_CR') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11" id="send-resume-message">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-warning"
                                data-dismiss="modal" aria-label="Close">
                            {!! trans('main.buttons.close') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JOB FILTER MODAL END!!!!!!!!!!!!!!! -->

    @include('components.modal.share_career_page_modal')
    @include('components.modal.send_login')
    @include('components.modal.sign_in')
    @include('components.modal.carousel_modal')

@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('/css/animate.css')}}">
    <style type="text/css">

        #map-canvas {
            width: 100%;
            height: 500px;
        }

        .wrapper {
            position: relative;
        }

        .text_over {
            background-color: rgba(255, 255, 255, 0.75);
            padding-top: 7px;
            padding-bottom: 7px;
            padding-left: 20px;
            padding-right: 10px;
            position: absolute;
            bottom: 25px;
            right: 60px;
            z-index: 99;
            display: flex;
            border-radius: 10px;
        }

        .text_over_center {
            background-color: rgba(255, 255, 255, 0.75);
            padding-top: 12px;
            /*padding-bottom: 7px;*/
            padding-left: 20px;
            padding-right: 20px;
            position: absolute;
            bottom: 5px;
            right: 40%;
            z-index: 99;
            display: flex;
            border-radius: 10px;
            animation-delay: 2s;
        }

        .outer {
            padding: 0px;
            height: 100%;
            display: flex;
            z-index: 0;
        }

        .marker {
            border-radius: 5px;
            vertical-align: middle;
            color: #fff;
            box-sizing: border-box;
            z-index: 100;
            border: 0px solid rgba(0, 0, 0, .05);
            text-align: center;
            -webkit-box-shadow: 0px 11px 40px -8px rgba(0, 0, 0, 0.5);
            -moz-box-shadow: 0px 11px 40px -8px rgba(0, 0, 0, 0.5);
            box-shadow: 0px 11px 40px -8px rgba(0, 0, 0, 0.5);
        }

        .spinner {
            /*margin: 100px auto;*/
            width: 50px;
            height: 20px;
            text-align: center;
            font-size: 10px;
        }

        .spinner > div {
            background-color: #333;
            opacity: 0.1;
            height: 100%;
            width: 6px;
            display: inline-block;

            -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
            animation: sk-stretchdelay 1.2s infinite ease-in-out;
        }

        .spinner .rect2 {
            -webkit-animation-delay: -1.1s;
            animation-delay: -1.1s;
        }

        .spinner .rect3 {
            -webkit-animation-delay: -1.0s;
            animation-delay: -1.0s;
        }

        .spinner .rect4 {
            -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s;
        }

        .spinner .rect5 {
            -webkit-animation-delay: -0.8s;
            animation-delay: -0.8s;
        }

        @-webkit-keyframes sk-stretchdelay {
            0%, 40%, 100% {
                -webkit-transform: scaleY(0.4)
            }
            20% {
                -webkit-transform: scaleY(1.0)
            }
        }

        @keyframes sk-stretchdelay {
            0%, 40%, 100% {
                transform: scaleY(0.4);
                -webkit-transform: scaleY(0.4);
            }
            20% {
                transform: scaleY(1.0);
                -webkit-transform: scaleY(1.0);
            }
        }
    </style>
@endsection
@section('script')
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="{{ asset('/js/app/send-resume.js?v='.time()) }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key={{ env('GOOGLE_MAPS_API_KEY', 'AIzaSyCLDOlFEBqX8B8bwiURqNObe5V5xrJrftw') }}"></script>
    <script src="{{ asset('/js/app/CustomGoogleMapMarker.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/business-view.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/business-view.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/business-search.js?v='.time()) }}"></script>
    <!-- <script src="{{ asset('/js/app/share-links.js?v='.time()) }}"></script> -->
    {{-- <script src="{{ asset('/js/app/business-items.js?v='.time()) }}"></script> --}}
    <script src="{{ asset('/js/parallax.min.js') }}"></script>
    <script type="text/javascript">
        $('.business_background_img').parallax({
            //imageSrc: 'https://i.ytimg.com/vi/M1msXMurNCM/maxresdefault.jpg'
        });
    </script>
    <script>
        var ViewBusiness;
        $(document).ready(function () {
            Loader.init();
            var url = document.location.pathname;
            var urlData = explode('/business/view/', url);
            if (urlData[1]) {
                var businessURLData = (explode('/', urlData[1]));
                var id = null;
                if (businessURLData) {
                    id = businessURLData[0];
                    ViewBusiness = new BusinessView(id, '{{ $type_items }}');
                    ViewBusiness.init();
                    ViewBusiness.setAssignLocations({!! json_encode($map_items) !!});
                    ViewBusiness.setBusinessSlugName('{{ $business_slug }}');
                    ViewBusiness.renderMap({{ $data->latitude }},{{ $data->longitude }}, {{ $data->id }}, '{{ $data->picture_50 }}');
                    //app.run();
                }
            }
        });
    </script>
    <script type="text/javascript">
        $('.carousel').carousel('pause');
    </script>
@endsection


