@extends('layouts.jobmap.common_user')

@push('meta')
    <meta property="og:title" content="{{ $data->business->localized_name }} | {{ $data->localized_title }} | {{ $data->category_name }}">
    <meta property="og:image" content="{{ $data->business->picture }}">
    <meta property="og:description" content="{{ $data->localized_description }}">
    <script type="application/ld+json">{!! json_encode($json_ld_structure, JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

@php
    $jobType = job_type_by_key($data->type_key);
@endphp

@section('content')
    <style type="text/css">
        /*@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700');*/
        .business_tabs{
            font-size: 20px;
            color:#4E5C6E;
            /*font-family: 'Open Sans', sans-serif;*/
        }
        .open-sans{
            /*font-family: 'Open Sans', sans-serif;*/
        }
        .business_tabs.active{
            font-weight: bold;
            color: #4266ff;
        }
        .business_tabs_numbers{
            font-size: 16px;
            opacity: 0.5;
        }
        .business_tabs.active .business_tabs_numbers{
            opacity: 1;
        }
        .border{
            border:1px solid #e2e2e0!important;
        }
        .result_shadow{
            -webkit-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.2);
            -moz-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.2);
            box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.2);
        }
        .regural_text_style{
            color: #4E5C6E;
            /*font-family: sans-regular;*/
            font-size: 15px;
            font-weight: 400;
        }
    </style>
    <div id="job-view" style="margin-top: 15px;">

        <div class="text-center py-4" style="background-color: rgba(0,0,0,0.6); position: absolute; width: 100%; z-index: 1;">
            <p class="px-4 align-self-center mb-0">
                <a href="{{ config('services.jobmap_url') }}/map/world" id="link-location-world"
                           class="text-white" data-toggle="tooltip" data-placement="top"
                           title="{!! trans('main.explore_the_world') !!}">{!! trans('main.world') !!}</a>
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
                <a href="{{ setLocationURL('country', $data->location) }}" id="link-location-country"
                           class="text-white" data-toggle="tooltip" data-placement="top"
                           title="{!! trans('main.explore_country') !!}">{{ $data->location->country }}</a>
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
                <a href="{{ setLocationURL('region', $data->location) }}" id="link-location-region"
                           class="text-white" data-toggle="tooltip" data-placement="top"
                           title="{!! trans('main.explore_region') !!}">{{ $data->location->region }}</a>
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
                <a href="{{ setLocationURL('city', $data->location) }}" id="link-location-city"
                           class="text-white"
                           data-toggle="tooltip" data-placement="top"
                           title="{!! trans('main.explore_city') !!}">{{ $data->location->city }}</a>
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
                <a href="{{ setLocationURL('street', $data->location) }}" id="link-location-street"
                           class="text-white" data-toggle="tooltip" data-placement="top"
                           title="{!! trans('main.explore_street') !!}">{{ $data->location->street }}</a>
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
                <a href="{{ setLocationURL('address', $data->location) }}" id="link-location-address"
                           class="text-white" data-toggle="tooltip" data-placement="top"
                           title="{!! trans('main.explore_address') !!}">{{ $data->location->street.' '. $data->location->street_number }}</a>
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

        <div class="col-md-12" id="map" style="height: 400px;"></div>

        <!-- <p class="text-center mb-0" style="position: absolute; left: 0; right: 0; margin-top: -25px; z-index: 1;"><a href="{!! url('/map') !!}" role="button" class="btn btn-primary" >{!! trans('main.buttons.back_to_full_map') !!}</a></p> -->

        <div class="careerpage_businessname" style="width: 100%; height: 60px; margin-top: -59px; position: absolute;">
            <div class="container" style="position: relative;">
                <div class="d-flex justify-content-between flex-lg-row flex-column pt-2">
                    <div class="d-flex flex-lg-row flex-column">
                        <div class="pxa-0 mxa-0 text-center text-md-left align-self-center mr-3 careerpage_businessname bg-white" style="margin-top: 10px; position: absolute; border-radius: 10px;">
                            <img class="location-icon careerpage_icon wow animated fadeInDown" src="{{ $data->business->picture_200 }}" style="width: 175px; border:5px solid #fff; border-radius: 10px;">
                        </div>
                    </div>

                    <div class="align-self-center" style="display: none;">
                        <button class="btn btn-primary border-0 mt-0 mb-3 mb-lg-0" id="map-resize" data-map="1" data-text="{!! trans('main.buttons.smaller_map') !!}" style="background-color: #0747a6;">
                            {!! trans('main.buttons.bigger_map') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100" style="background: rgba(0,0,0,0.05);">
            <div class="container">
                <div class="col-12 px-0">
                    <div class="d-flex flex-lg-row flex-column justify-content-between py-0">
                        <div class="flex-1 mt-3 mt-lg-0 align-self-center justify-content-lg-start px-0 justify-content-center d-inline-flex">
                            <p class="mb-0 align-self-center mxa-0 text-black business_name_color text-center" id="business-name" style="font-size: 30px; margin-left: 185px;">
                                {{ $data->business->localized_name }}
                            </p>
                        </div>
                        <div class="flex-1 d-flex flex-lg-row flex-column justify-content-between py-0">
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
                                                {!! trans('main.counters.brands_c', ['count' =>  $business->brands_count ?? '']) !!}
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
                                                {!! trans('main.counters.jobs_c', ['count' =>  $business->all_jobs_count ?? ''/*$items->count*/]) !!}
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
                            <div class="align-self-center ml-auto mxa-0">
                                <button class="btn btn-success send-resume w-100 mb-3 mb-lg-0" data-id="{{ $data->location->id }}" data-j-id="{{ $data->id }}" data-j-l-id="{{ $job_location }}" data-b-id="{{ $data->business->id }}"
                                        id="animate_hover" data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="{!! trans('main.buttons_hint.want_to_apply_here') !!}"
                                        style="white-space: nowrap;">
                                    <span class="mb-0 pb-2" style="font-weight: 400;">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 426.667 426.667" style="enable-background:new 0 0 426.667 426.667; vertical-align: middle; margin-top: -3px;" xml:space="preserve" class="mr-2" widht="20px" height="20px">
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
                        <div class="text-left py-2 pb-4 title_left_sorting rounded mt-3" style="font-size: 14px;">
                            <div class="mb-3 d-flex justify-content-between">
                                <a href="/" class="mb-0 text-justify btn btn-outline-new btn-block text-center" role="button">
                                    {!! trans('main.buttons.back_to_full_map') !!}
                                </a>
                                <div class="align-self-center">
                                    <span class="ml-2" data-toggle="tooltip" title="" data-original-title="Email &amp; share this job">
                                        <a data-toggle="modal" data-title="{{ $data->localized_title }}" data-description="" data-target="#ShareModal" data-link="{{ env('APP_URL') . $main_link }}?locale={{ \App::getLocale() }}">
                                            @svg('/img/share.svg',[
                                                'class' => 'sharebutton_svg_class mx-1',
                                                'style' => 'margin-top:5px;',
                                            ])
                                        </a>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4">
                                @svg('/img/location.svg',[
                                    'class' => '',
                                    'style' => 'margin-top: 5px; float: left; width: 55px; height: 55px; margin-right: 20px; fill: #4E5C6E;',
                                ])
                                <p class="mb-0"><strong>{{ trans('fields.label.location') }}</strong>:</p>
                                <div class="d-flex flex-wrap">
                                    {{ $fullAddress }}
                                </div>
                            </div>

                            <div class="mb-4">
                                @svg('/img/business_type/corporate.svg',[
                                    'class' => '',
                                    'style' => 'margin-top: 5px; float: left; width: 55px; height: 55px; margin-right: 20px; fill: #4E5C6E;',
                                ])
                                <p class="mb-0">{{ trans('fields.label.industry') }}:</p>
                                <p class="mb-1"><strong> {{ $business->_industry }}</strong></p>
                                <div class="d-flex flex-wrap">
                                    @foreach ($unique_locations as $location)
                                        <i class="glyphicon bfh-flag-{{ $location->country_code }}"></i>
                                    @endforeach
                                </div>
                            </div>

                            <p class="mb-0 py-2 text-justify">
                                <img src="{{ asset('img/icons/phone.svg') }}" width="30px" height="30px">
                                {{ $data->location->phone_code }} {{ $data->location->phone }}
                            </p>
                            @if($data->business->localized_website && !empty($data->business->localized_website))
                                <p class="mb-0 regural_text_style" id="website" >
                                    <a target="_blank" href="{!! (is_null(parse_url($data->business->localized_website, PHP_URL_HOST)) ? '//' : '').$data->business->localized_website !!}"
                                       class="regural_text_style">
                                        <img src="{{ asset('img/icons/website.svg') }}" width="30px" height="30px">
                                        {{ trans('fields.label.website') }}
                                   </a>
                                </p>
                            @endif
                            {{--@if (count($data->assign_locations) > 0)
                                <a href="/map/view/job-union/{{ $data->id }}">
                                    <div class="text-left py-2 pb-4 title_left_sorting rounded mt-3" style="font-size: 14px;">
                                        <p class="mb-0"> <strong>{!! trans_choice('main.label.available_in_locations', count($data->assign_locations), ['count' => count($data->assign_locations)]) !!}</strong> </p>
                                    </div>
                                </a>
                            @endif--}}
                            {{--<div class="text-left pb-4 title_left_sorting rounded mt-3" style="font-size: 14px;">
                                <p class="mb-0"><i class="glyphicon bfh-flag-{{ $data->location->country_code }}"></i>
                                    <strong>{{ getLocation($data->location) }}</strong>
                                </p>
                            </div>--}}
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="col-12 bg-white mt-4 p-lg-5 p-3 result_shadow" style="border-radius: 10px;">
                            <p class="mb-0 align-self-center mxa-0 business_name_color" style="font-size: 30px;">
                              {{ $data->localized_title }}
                            </p>
                            <p class="mb-1 align-self-center mxa-0 business_name_color" id="job_title" style="font-size: 25px;">{{ $data->category_name }}</p>

                            {{-- <p class="mt-4 h5">
                                {!! trans('main.label.job_information') !!}
                            </p> --}}
                            @php($col = 0)
                            <div class="d-flex justify-content-between pt-3 flex-lg-row flex-column">
                                <?php
                                    $str = '';
                                    foreach ($data->assign_languages as $item) {
                                        $str .= $item->name . ',';
                                    }
                                    $str = rtrim($str, ',');
                                ?>
                                @if (!empty($str))
                                    <div class="col-lg-4 col-12 p-0 pl-0 pxa-0">
                                        <p class="mb-0"><strong>{!! trans('fields.label.speaking_languages') !!}</strong> {{ $str }}</p>
                                    </div>
                                    <?php $col++; ?>
                                @endif
                                <?php
                                    $str = '';
                                    foreach ($data->assign_types as $item) {
                                        $str .= $item->name . ',';
                                    }
                                    $str = rtrim($str, ',');
                                ?>
                                @if (!empty($str))
                                    <div class="col-lg-4 col-12 pl-0 pxa-0">
                                        <p class="mb-0" id="job-types"><strong>{!! trans('fields.label.job_type') !!}</strong> {{ $str }}</p>
                                    </div>
                                    <?php $col++; ?>
                                @endif

                                @if (!empty($jobType))
                                    <div class="col-lg-4 col-12 pl-0 pxa-0">
                                        <p class="mb-0" id="job-types"><strong>{!! trans('fields.label.job_type') !!}</strong> {{ $jobType }}</p>
                                    </div>
                                @endif

                                @if ($data->hours > 0)
                                    <div class="col-lg-4 col-12 pl-0 pxa-0">
                                        <p class="mb-0" id="job-hours"><strong>{!! trans('fields.label.hours') !!}</strong>
                                            {!! trans_choice('main.label.hours', $data->hours, ['count' => $data->hours]) !!}</p>
                                    </div>
                                    <?php $col++; ?>
                                @endif
                                <?php
                                    $str = '';
                                    foreach ($data->assign_career_levels as $item) {
                                        $str .= $item->name . ',';
                                    }
                                    $str = rtrim($str, ',');
                                ?>
                            @if ($col == 3)
                            </div>
                            <div class="d-flex justify-content-between flex-lg-row flex-column">
                            @endif
                                @if (!empty($data->salary))
                                    <div class="col-lg-4 col-12 pr-0 pxa-0 pl-0">
                                        <p class="mb-0" id="job-salary">
                                            <strong>{!! trans('fields.label.salary') !!}</strong>
                                            {!! trans('main.label.salary_per_hour', ['salary' => $data->salary . $data->salary_type]) !!}
                                        </p>
                                    </div>
                                    <?php $col++; ?>
                                @else
                                    <div class="col-lg-4 col-12 pr-0 pxa-0 pl-0">
                                        <p class="mb-0" id="job-salary"><strong>{!! trans('fields.label.salary') !!}</strong>
                                        {!! trans('main.label.no_salary') !!}
                                        </p>
                                    </div>
                                    <?php $col++; ?>
                                @endif
                            @if ($col == 3)
                            </div>
                            <div class="d-flex justify-content-between flex-lg-row flex-column">
                            @endif
                                @if (!empty($str))
                                    <div class="col-lg-4 col-12 pxa-0">
                                        <p class="mb-0"><strong>{!! trans('fields.label.career_level') !!}</strong> {{ $str }}</p>
                                    </div>
                                    <?php $col++; ?>
                                @endif
                                <?php
                                    $str = '';
                                    foreach ($data->assign_certificates as $item) {
                                        $str .= $item->name . ',';
                                    }
                                    $str = rtrim($str, ',');
                                ?>
                            @if ($col == 3)
                            </div>
                            <div class="d-flex justify-content-between flex-lg-row flex-column">
                            @endif

                            </div>

                            @if (!empty($str))
                                <div class="col-lg-4 col-12 p-0 pr-0 pxa-0 pt-4">
                                    <p class="mb-0"><strong>{!! trans('fields.label.certifications') !!}</strong> {{ $str }}</p>
                                </div>
                                <?php $col++; ?>
                            @endif

                            @if(!empty($data->notes))
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-lg-6" id="job-notes">
                                            <small class="h6">{!! trans('fields.label.special_notes') !!}</small>
                                            <p>{{ $data->notes }}</p>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            <pre id="business-description" class="mt-3 text-justify">{!! $data->localized_description !!}</pre>

                            <div class="col-12 px-0">

                                <p class="mb-0 mt-4 h5">
                                    {!! trans('fields.label.requested_availabilities') !!}
                                </p>

                                <div class="col-md-12 pt-2 px-0">

                                    <div class="table">
                                        <table class="w-100" style="table-layout: fixed">
                                            <thead>
                                            <tr class="text-center">
                                                <th colspan="2" class="table-heading border-0 text-center"></th>
                                                <th class="table-heading border-0 text-center">
                                                    <svg version="1.1" id="Layer_1" width="20px" height="20px"
                                                         xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                         viewBox="0 0 91 91"
                                                         enable-background="new 0 0 91 91" xml:space="preserve"
                                                         data-toggle="tooltip" data-placement="top" title=""
                                                         data-original-title="{!! trans('main.time.morning_shift') !!}">
                                                        <path d="M45.5,32.4c2.2,0,4-1.8,4-4v-8.1c0-2.2-1.8-4-4-4s-4,1.8-4,4v8.1C41.5,30.7,43.3,32.4,45.5,32.4z"
                                                              fill="#007bff"></path>
                                                        <path d="M69,42c1,0,2-0.4,2.8-1.2l5.8-5.8c1.6-1.6,1.6-4.1,0-5.7c-1.6-1.6-4.1-1.6-5.7,0l-5.8,5.8c-1.6,1.6-1.6,4.1,0,5.7
                                                                                        C67,41.6,68,42,69,42z"
                                                              fill="#007bff"></path>
                                                        <path d="M19.2,40.8C19.9,41.6,21,42,22,42c1,0,2-0.4,2.8-1.2c1.6-1.6,1.6-4.1,0-5.7l-5.8-5.8c-1.6-1.6-4.1-1.6-5.7,0
                                                                                        c-1.6,1.6-1.6,4.1,0,5.7L19.2,40.8z"
                                                              fill="#007bff"></path>
                                                        <path d="M86.9,66.7H4.1c-2.2,0-4,1.8-4,4s1.8,4,4,4h82.8c2.2,0,4-1.8,4-4S89.1,66.7,86.9,66.7z"
                                                              fill="#007bff"></path>
                                                        <path d="M27.1,60.8c2.1,0.6,4.3-0.7,4.9-2.9c1.6-6.2,7.2-10.5,13.6-10.5s12,4.3,13.6,10.5c0.5,1.8,2.1,3,3.9,3c0.3,0,0.7,0,1-0.1
                                                                                        c2.1-0.6,3.4-2.7,2.9-4.9c-2.5-9.7-11.3-16.5-21.3-16.5c-10,0-18.8,6.8-21.3,16.5C23.6,58.1,24.9,60.3,27.1,60.8z"
                                                              fill="#007bff"></path>
                                                    </svg>
                                                </th>
                                                <th class="table-heading border-0 text-center">
                                                    <svg version="1.1" id="Layer_1"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         width="20px"
                                                         height="20px" x="0px" y="0px" viewBox="0 0 91 91"
                                                         enable-background="new 0 0 91 91" xml:space="preserve"
                                                         data-toggle="tooltip" data-placement="top" title=""
                                                         data-original-title="{!! trans('main.time.day_shift') !!}">
                                                        <path d="M45.5,23.5c-12.1,0-22,9.9-22,22c0,12.1,9.9,22,22,22c12.1,0,22-9.9,22-22C67.5,33.4,57.6,23.5,45.5,23.5z M45.5,59.5 c-7.7,0-14-6.3-14-14c0-7.7,6.3-14,14-14c7.7,0,14,6.3,14,14C59.5,53.2,53.2,59.5,45.5,59.5z"
                                                              fill="#007bff"></path>
                                                        <path d="M45.5,16.2c2.2,0,4-1.8,4-4V4.1c0-2.2-1.8-4-4-4c-2.2,0-4,1.8-4,4v8.1C41.5,14.5,43.3,16.2,45.5,16.2z"
                                                              fill="#007bff"></path>
                                                        <path d="M86.9,41.5h-8.1c-2.2,0-4,1.8-4,4c0,2.2,1.8,4,4,4h8.1c2.2,0,4-1.8,4-4C90.9,43.3,89.1,41.5,86.9,41.5z"
                                                              fill="#007bff"></path>
                                                        <path d="M45.5,74.8c-2.2,0-4,1.8-4,4v8.1c0,2.2,1.8,4,4,4c2.2,0,4-1.8,4-4v-8.1C49.5,76.5,47.7,74.8,45.5,74.8z"
                                                              fill="#007bff"></path>
                                                        <path d="M16.2,45.5c0-2.2-1.8-4-4-4H4.1c-2.2,0-4,1.8-4,4c0,2.2,1.8,4,4,4h8.1C14.5,49.5,16.2,47.7,16.2,45.5z"
                                                              fill="#007bff"></path>
                                                        <path d="M69,26c1,0,2-0.4,2.8-1.2l5.8-5.8c1.6-1.6,1.6-4.1,0-5.7c-1.6-1.6-4.1-1.6-5.7,0l-5.8,5.8c-1.6,1.6-1.6,4.1,0,5.7
                                                                                        C67,25.6,68,26,69,26z"
                                                              fill="#007bff"></path>
                                                        <path d="M71.8,66.2c-1.6-1.6-4.1-1.6-5.7,0c-1.6,1.6-1.6,4.1,0,5.7l5.8,5.8c0.8,0.8,1.8,1.2,2.8,1.2c1,0,2-0.4,2.8-1.2
                                                                                        c1.6-1.6,1.6-4.1,0-5.7L71.8,66.2z"
                                                              fill="#007bff"></path>
                                                        <path d="M19.2,66.2l-5.8,5.8c-1.6,1.6-1.6,4.1,0,5.7c0.8,0.8,1.8,1.2,2.8,1.2c1,0,2-0.4,2.8-1.2l5.8-5.8c1.6-1.6,1.6-4.1,0-5.7
                                                                                        C23.3,64.6,20.7,64.6,19.2,66.2z"
                                                              fill="#007bff"></path>
                                                        <path d="M19.2,24.8C19.9,25.6,21,26,22,26c1,0,2-0.4,2.8-1.2c1.6-1.6,1.6-4.1,0-5.7l-5.8-5.8c-1.6-1.6-4.1-1.6-5.7,0
                                                                                        c-1.6,1.6-1.6,4.1,0,5.7L19.2,24.8z"
                                                              fill="#007bff"></path>
                                                    </svg>
                                                </th>
                                                <th class="table-heading border-0 text-center">
                                                    <svg version="1.1" id="Layer_1" width="20px" height="20px"
                                                         xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                         viewBox="0 0 91 91"
                                                         enable-background="new 0 0 91 91" xml:space="preserve"
                                                         data-toggle="tooltip" data-placement="top" title=""
                                                         data-original-title="{!! trans('main.time.evening_shift') !!}">
                                                        <path d="M45.5,26.3c2.2,0,4-1.8,4-4v-8.1c0-2.2-1.8-4-4-4s-4,1.8-4,4v8.1C41.5,24.5,43.3,26.3,45.5,26.3z"
                                                              fill="#007bff"></path>
                                                        <path d="M74.8,55.6c0,2.2,1.8,4,4,4h8.1c2.2,0,4-1.8,4-4s-1.8-4-4-4h-8.1C76.5,51.6,74.8,53.4,74.8,55.6z"
                                                              fill="#007bff"></path>
                                                        <path d="M4.1,59.6h8.1c2.2,0,4-1.8,4-4s-1.8-4-4-4H4.1c-2.2,0-4,1.8-4,4S1.9,59.6,4.1,59.6z"
                                                              fill="#007bff"></path>
                                                        <path d="M69,36.1c1,0,2-0.4,2.8-1.2l5.8-5.8c1.6-1.6,1.6-4.1,0-5.7c-1.6-1.6-4.1-1.6-5.7,0l-5.8,5.8c-1.6,1.6-1.6,4.1,0,5.7
                                                                                        C67,35.7,68,36.1,69,36.1z"
                                                              fill="#007bff"></path>
                                                        <path d="M19.2,34.9c0.8,0.8,1.8,1.2,2.8,1.2c1,0,2-0.4,2.8-1.2c1.6-1.6,1.6-4.1,0-5.7l-5.8-5.8c-1.6-1.6-4.1-1.6-5.7,0
                                                                                        c-1.6,1.6-1.6,4.1,0,5.7L19.2,34.9z"
                                                              fill="#007bff"></path>
                                                        <path d="M25.5,64.7c0.9,2,3.3,2.9,5.3,2c2-0.9,2.9-3.3,2-5.3c-0.8-1.8-1.3-3.8-1.3-5.8c0-7.7,6.3-14,14-14s14,6.3,14,14
                                                                                        c0,2-0.4,4-1.3,5.8c-0.9,2,0,4.4,2,5.3c0.5,0.2,1.1,0.4,1.7,0.4c1.5,0,3-0.9,3.6-2.3c1.3-2.9,2-6,2-9.1c0-12.1-9.9-22-22-22
                                                                                        c-12.1,0-22,9.9-22,22C23.5,58.8,24.2,61.8,25.5,64.7z"
                                                              fill="#007bff"></path>
                                                        <path d="M86.9,72.8H4.1c-2.2,0-4,1.8-4,4s1.8,4,4,4h82.8c2.2,0,4-1.8,4-4S89.1,72.8,86.9,72.8z"
                                                              fill="#007bff"></path>
                                                    </svg>
                                                </th>
                                                <th class="table-heading border-0 text-center">
                                                    <svg version="1.1" id="Layer_1"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         width="20px"
                                                         height="20px" x="0px" y="0px" viewBox="0 0 91 91"
                                                         enable-background="new 0 0 91 91" xml:space="preserve"
                                                         data-toggle="tooltip" data-placement="top" title=""
                                                         data-original-title="{!! trans('main.time.night_shift') !!}">
                                                            <path d="M47.2,78.1c-11.6,0-22.5-6.3-28.3-16.3c-9-15.6-3.6-35.6,11.9-44.6c5.3-3.1,11.5-4.6,17.6-4.3c1.5,0.1,2.8,0.9,3.4,2.2
                                                                                    c0.7,1.3,0.5,2.9-0.3,4.1c-5,7.2-5.4,16.8-1,24.3c4.1,7,11.6,11.4,19.8,11.4c0.6,0,1.2,0,1.8-0.1c1.5-0.1,2.9,0.6,3.7,1.8
                                                                                    c0.8,1.2,0.9,2.8,0.2,4.1c-2.9,5.5-7.2,10-12.6,13.1C58.5,76.6,52.9,78.1,47.2,78.1z M41.4,21.5c-2.3,0.5-4.5,1.4-6.6,2.6
                                                                                    C23.1,31,19,46.1,25.8,57.8c4.4,7.6,12.6,12.3,21.4,12.3c4.3,0,8.5-1.1,12.3-3.3c2.1-1.2,4-2.7,5.6-4.4c-8.9-1.6-16.8-7-21.4-14.9
                                                                                    C39.1,39.5,38.4,30,41.4,21.5z"
                                                                  fill="#007bff"></path>
                                                    </svg>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-left">
                                            <?php
                                            $days = [trans('main.days.monday'), trans('main.days.tuesday'), trans('main.days.wednesday'), trans('main.days.thursday'), trans('main.days.friday'), trans('main.days.saturday'), trans('main.days.sunday')];
                                            ?>
                                            @for($d = 1; $d <= 7; ++$d)
                                                <tr class="text-center">
                                                    <td colspan="2" class="text-left">{{ $days[$d - 1] }}</td>
                                                    @for($i = 1; $i <= 4; ++$i)
                                                        <?php
                                                        $checkbox = false;
                                                        ?>
                                                        @isset($data->{'time_'.$i})
                                                            <?php
                                                            $checkbox = strpos($data->{'time_' . $i}, (string)$d);
                                                            ?>
                                                        @endisset
                                                        <td class="align-middle">
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <label class="custom-control custom-checkbox m-0 pl-3">
                                                                    <input type="checkbox"
                                                                           class="custom-control-input"
                                                                           @if($checkbox !== false) checked="checked"
                                                                           @endif onclick="return false;">
                                                                    <span class="custom-control-indicator"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>



    <!--JOB FILTER MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="jobfiltermodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 750px;">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.job_filter') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body pb-3 pt-0">
                    <div class="card border-0">
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-3">

                                    <div class="col-12 px-0 mb-3">
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <small class="form-text text-muted mb-2">{!! trans('fields.label.hours') !!}
                                                </small>
                                                <input type="text" class="form-control"
                                                       placeholder="{!! trans('fields.placeholder.hours') !!}" id="filter-hours">
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <small class="form-text text-muted mb-2">{!! trans('fields.label.salary') !!}</small>
                                                <input type="text" class="form-control"
                                                       placeholder="{!! trans('fields.placeholder.salary') !!}" id="filter-salary">
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
                                <div class="col-12 col-lg-6 mt-3">

                                    <div class="form-group mb-3" style="margin-top: 25px;">
                                        <small class="form-text text-muted mb-2">{!! trans('fields.label.contract_type') !!}
                                        </small>
                                        <div id="job_type"></div>

                                    </div>

                                    <div class="form-group mb-3">
                                        <small class="form-text text-muted mb-2">{!! trans('fields.label.career_level') !!}
                                        </small>
                                        <div id="career_level"></div>

                                    </div>

                                    <div class="form-group mb-3">
                                        <small class="form-text text-muted mb-2">{!! trans('fields.label.certification') !!}
                                        </small>
                                        <div id="certification_required"></div>

                                    </div>

                                </div>

                                <div class="col-12 col-lg-4 mx-auto mt-3">
                                    <button class="btn btn-outline-warning btn-block" id="clear-filters"
                                            type="button">{!! trans('main.buttons.clear_filters') !!}
                                    </button>
                                </div>
                                <div class="col-12 col-lg-4 mx-auto mt-3">
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
                            <p class="mb-0 mr-2 h6" id="count-job-locations">
                                {!! trans('modals.text.available_in_locations') !!}
                            </p>
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 477 477" style="enable-background:new 0 0 477 477;" xml:space="preserve">
                                <path d="M238.4,0C133,0,47.2,85.8,47.2,191.2c0,12,1.1,24.1,3.4,35.9c0.1,0.7,0.5,2.8,1.3,6.4c2.9,12.9,7.2,25.6,12.8,37.7
                                    c20.6,48.5,65.9,123,165.3,202.8c2.5,2,5.5,3,8.5,3s6-1,8.5-3c99.3-79.8,144.7-154.3,165.3-202.8c5.6-12.1,9.9-24.7,12.8-37.7
                                    c0.8-3.6,1.2-5.7,1.3-6.4c2.2-11.8,3.4-23.9,3.4-35.9C429.6,85.8,343.8,0,238.4,0z M399.6,222.4c0,0.2-0.1,0.4-0.1,0.6
                                    c-0.1,0.5-0.4,2-0.9,4.3c0,0.1,0,0.1,0,0.2c-2.5,11.2-6.2,22.1-11.1,32.6c-0.1,0.1-0.1,0.3-0.2,0.4
                                    c-18.7,44.3-59.7,111.9-148.9,185.6c-89.2-73.7-130.2-141.3-148.9-185.6c-0.1-0.1-0.1-0.3-0.2-0.4c-4.8-10.4-8.5-21.4-11.1-32.6
                                    c0-0.1,0-0.1,0-0.2c-0.6-2.3-0.8-3.8-0.9-4.3c0-0.2-0.1-0.4-0.1-0.7c-2-10.3-3-20.7-3-31.2c0-90.5,73.7-164.2,164.2-164.2
                                    s164.2,73.7,164.2,164.2C402.6,201.7,401.6,212.2,399.6,222.4z" fill="#007bff"/>
                                <path d="M238.4,71.9c-66.9,0-121.4,54.5-121.4,121.4s54.5,121.4,121.4,121.4s121.4-54.5,121.4-121.4S305.3,71.9,238.4,71.9z
                                    M238.4,287.7c-52.1,0-94.4-42.4-94.4-94.4s42.4-94.4,94.4-94.4s94.4,42.4,94.4,94.4S290.5,287.7,238.4,287.7z"
                                      fill="#007bff"/>
                        </svg>
                        </div>
                    </div>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <!-- JOB FILTER MODAL END!!!!!!!!!!!!!!! -->

    @include('components.jobmap.modal.share_job_modal')
    @include('components.jobmap.modal.questionnaire')
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/animate.css') }}">
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

        /*v.0.0.3*/
        .outer {
            padding: 0px;
            height: 100%;
            display: flex;
            z-index: 0;
        }

        /*v.0.0.3.1*/
        /*.outer{
            padding: 5px;
            height:100%;
            /*display:flex;
            z-index: 0;
        }*/

        /*v. 0.0.1*/
        /*.iner{
            background: url('pepsi.jpg') no-repeat center center;
            background-size: cover;
            padding: 50px;
            opacity: 0.5;
            z-index: 2;
        }*/
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
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyD3mcG8oAZzzlCSGZt5B4u5h5LmBX1SgjE"></script>
    <script src="{{ asset('/js/jobmap/app/CustomGoogleMapMarker.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/jobmap/app/job-view.js?v='.time()) }}"></script>
    <script>
        $(document).ready(function () {
            Loader.init();
            var View = new JobView({{ $data->id }}, '{{ $type_items }}', {{ $data->business->id }}, {{ $data->location->id }}, {{ $data->location->latitude }}, {{ $data->location->longitude }});
            View.init();
            View.setAssignLocations({!! json_encode($items) !!});
            View.renderMap({{ $data->location->latitude }},{{ $data->location->longitude }}, {{ $data->id }}, '{{ $data->business->picture_50 }}');
            app.run();
        });
    </script>
@endsection
