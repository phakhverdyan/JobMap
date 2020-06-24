@extends('layouts.jobmap.common_user')

@push('meta')
    <meta property="og:title" content="{{ $data->business->name }}">
    <meta property="og:image" content="{{ $data->business->picture_o }}">
    <meta property="og:description" content="{{ $data->business->description }}">
@endpush

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
    <div id="location-view" style="margin-top: 15px;">

        <!-- content block begin-->
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
                <a href="{{ setLocationURL('country', $data) }}" id="link-location-country"
                                   class="text-white" data-toggle="tooltip" data-placement="top"
                                   title="{!! trans('main.explore_country') !!}">{{ $data->country }}</a>
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
                                   title="{!! trans('main.explore_region') !!}">{{ $data->region }}</a>
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
                <a href="{{ setLocationURL('city', $data) }}" id="link-location-city"
                                   class="text-white"
                                   data-toggle="tooltip" data-placement="top" title="{!! trans('main.explore_city') !!}">{{ $data->city }}</a>
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
                           title="{!! trans('main.explore_street') !!}">{{ $data->street }}</a>
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
                           title="{!! trans('main.explore_address') !!}">{{ $data->street.' '. $data->street_number }}</a>
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

        <p class="text-center mb-0" style="position: absolute; left: 0; right: 0; margin-top: -85px; z-index: 1;"><a href="{!! url('/map') !!}" role="button" class="btn btn-primary" >{!! trans('main.buttons.back_to_full_map') !!}</a></p>

        <div class="careerpage_businessname" style="background: rgba(0,0,0,0.3); width: 100%; height: 60px; margin-top: -59px; position: absolute;">
            <div class="container" style="position: relative;">
                <div class="d-flex justify-content-between flex-lg-row flex-column pt-2">
                    <div class="d-flex flex-lg-row flex-column">
                        <div class="pxa-0 mxa-0 text-center text-md-left align-self-center bg-white mr-3 careerpage_businessname" style="margin-top: -34px; position: absolute;">
                            <img class="location-icon rounded careerpage_icon wow animated fadeInDown" src="{{ $data->business->picture_100 }}" style="width: 200px; border:5px solid #fff;">
                        </div>
                        <p class="mb-0 align-self-center mxa-0 text-white business_name_color" id="job_title" style="font-size: 30px; margin-left: 215px;">
                            {{ $data->business->name }}
                        </p>
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
                    <div class="d-flex flex-lg-row flex-column justify-content-end">
                        <div class="col-lg-3 col-12 mr-5"></div>
                        <div class="flex-1 d-flex flex-lg-row flex-column justify-content-between py-2">
                            <div class="align-self-center ml-auto mxa-0">
                                <p class="mb-0 text-center text-button-send-resume"><small>{!! trans('main.buttons_hint.want_to_apply_here') !!}</small></p>
                                <button class="btn btn-success send-resume w-100 mb-3 mb-lg-0" data-id="{{ $data->id }}" data-b-id="{{ $data->business->id }}"
                                        id="animate_hover" data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="{!! trans('main.buttons_hint.apply_to_this_job') !!}" style="white-space: nowrap;">
                                    <span class="mb-0 pb-2" style="">
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
                            <div class="d-flex justify-content-between mb-3">
                                <a href="{!! url('/') . '/business/view/' . $data->business->id . '/' . $data->business->slug !!}" class="mb-0 text-justify btn btn-outline-viewcp btn-sm align-self-center" role="button">
                                    {!! trans('main.buttons.career_page') !!}
                                </a>
                                <div class="align-self-center">
                                  <span class="ml-2" data-toggle="tooltip" title="" data-original-title="Email &amp; share this location">
                                      <a data-toggle="modal" data-target="#ShareModal" data-link="{{ config('app.url') }}/map/view/location/{{ $data->id }}/{{ str_slug($data->name) }}">
                                         <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 481.6 481.6" style="margin-top:5px;" xml:space="preserve" class="sharebutton_svg_class mx-1">
                                                <g>
                                                    <path d="M381.6,309.4c-27.7,0-52.4,13.2-68.2,33.6l-132.3-73.9c3.1-8.9,4.8-18.5,4.8-28.4c0-10-1.7-19.5-4.9-28.5l132.2-73.8   c15.7,20.5,40.5,33.8,68.3,33.8c47.4,0,86.1-38.6,86.1-86.1S429,0,381.5,0s-86.1,38.6-86.1,86.1c0,10,1.7,19.6,4.9,28.5   l-132.1,73.8c-15.7-20.6-40.5-33.8-68.3-33.8c-47.4,0-86.1,38.6-86.1,86.1s38.7,86.1,86.2,86.1c27.8,0,52.6-13.3,68.4-33.9   l132.2,73.9c-3.2,9-5,18.7-5,28.7c0,47.4,38.6,86.1,86.1,86.1s86.1-38.6,86.1-86.1S429.1,309.4,381.6,309.4z M381.6,27.1   c32.6,0,59.1,26.5,59.1,59.1s-26.5,59.1-59.1,59.1s-59.1-26.5-59.1-59.1S349.1,27.1,381.6,27.1z M100,299.8   c-32.6,0-59.1-26.5-59.1-59.1s26.5-59.1,59.1-59.1s59.1,26.5,59.1,59.1S132.5,299.8,100,299.8z M381.6,454.5   c-32.6,0-59.1-26.5-59.1-59.1c0-32.6,26.5-59.1,59.1-59.1s59.1,26.5,59.1,59.1C440.7,428,414.2,454.5,381.6,454.5z"></path>
                                                </g>
                                            </svg>
                                      </a>
                                  </span>
                                </div>
                            </div>

                            @if($data->business->website && !empty($data->business->website))
                                <p class="mb-0 regural_text_style" id="website" >
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; vertical-align: middle; margin-top: -3px; fill:#4E5C6E;" xml:space="preserve" width="20px" height="20px" class="mr-1">
                                        <g>
                                            <g>
                                                <path d="M256,0C114.842,0,0,114.842,0,256s114.842,256,256,256s256-114.842,256-256S397.158,0,256,0z M172.767,49.548    c-15.431,21.032-26.894,45.924-35.095,70.354c-14.907-5.344-28.707-11.736-41.104-19.09    C117.975,78.827,143.872,61.24,172.767,49.548z M74.894,126.702c15.971,9.964,34.036,18.452,53.65,25.317    c-6.467,27.334-10.344,56.811-11.382,87.284H34.016C37.128,197.525,51.824,158.923,74.894,126.702z M74.893,385.297    c-23.069-32.219-37.766-70.822-40.878-112.601h83.145c1.038,30.474,4.915,59.95,11.382,87.284    C108.929,366.845,90.866,375.333,74.893,385.297z M96.569,411.187c12.397-7.354,26.197-13.746,41.104-19.09    c8.2,24.428,19.663,49.32,35.095,70.354C143.872,450.76,117.975,433.173,96.569,411.187z M239.304,475.526    c-34.478-12.654-57.72-57.982-69.619-92.899c21.841-5.198,45.296-8.391,69.619-9.4V475.526z M239.304,339.813    c-27.403,1.061-53.935,4.708-78.711,10.722c-5.624-24.321-9.038-50.587-10.029-77.84h88.74V339.813z M239.304,239.304h-88.74    c0.99-27.253,4.404-53.518,10.029-77.84c24.776,6.014,51.308,9.661,78.711,10.722V239.304z M239.304,138.773    c-24.322-1.008-47.777-4.203-69.619-9.4c11.89-34.894,35.131-80.242,69.619-92.899V138.773z M437.107,126.703    c23.069,32.219,37.766,70.822,40.878,112.601h-83.145c-1.038-30.474-4.915-59.95-11.382-87.284    C403.071,145.155,421.134,136.667,437.107,126.703z M415.431,100.813c-12.397,7.354-26.197,13.746-41.104,19.09    c-8.2-24.428-19.663-49.32-35.095-70.354C368.128,61.24,394.025,78.827,415.431,100.813z M272.696,36.474    c34.478,12.654,57.72,57.982,69.619,92.899c-21.841,5.198-45.296,8.391-69.619,9.4V36.474z M272.696,172.187    c27.403-1.061,53.935-4.708,78.711-10.722c5.624,24.321,9.038,50.587,10.029,77.84h-88.74V172.187z M272.696,272.584h88.74    c-0.99,27.253-4.404,53.63-10.029,77.951c-24.776-6.014-51.308-9.661-78.711-10.722V272.584z M272.696,475.526V373.227    c24.322,1.008,47.777,4.203,69.619,9.4C330.425,417.52,307.183,462.868,272.696,475.526z M339.233,462.452    c15.431-21.032,26.894-45.924,35.095-70.354c14.907,5.344,28.706,11.736,41.104,19.09    C394.025,433.173,368.128,450.76,339.233,462.452z M437.106,385.298c-15.971-9.964-34.036-18.452-53.65-25.317    c6.467-27.334,10.344-56.922,11.382-87.395h83.145C474.872,314.364,460.176,353.077,437.106,385.298z"/>
                                            </g>
                                        </g>
                                    </svg>
                                    <a target="_blank" href="{!! (is_null(parse_url($data->business->website, PHP_URL_HOST)) ? '//' : '').$data->business->website !!}"
                                       class="regural_text_style">{{ $data->business->website }}</a>
                                </p>
                            @endif

                            <p class="mb-0"><i class="glyphicon bfh-flag-{{ $data->country_code }}"></i>
                                <strong>{{ getLocation($data) }}</strong>
                            </p>
                            <a tel="{{ $data->phone_code.$data->phone }}" class="mb-0 text-justify" style="font-size: 16px; margin-left: 25px;">
                                {{ $data->phone_code}} {{ $data->phone }}
                            </a>

                            {{--<div class="d-flex flex-row justify-content-center mt-3 flex-wrap" id="amenities-list">
                                @foreach($data->assign_amenities as $amenity)
                                    <div class="border rounded-circle text-center mr-2"
                                         style="padding-top: 7px;width: 40px;height: 40px; box-shadow: 0 4px 10px 0 rgba(0,0,0,.14), 0 1px 2px 0 rgba(0,0,0,.12), 0 3px 1px -2px rgba(0,0,0,.2);"
                                         data-toggle="tooltip" title="{{ $amenity->name }}">
                                <span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                     version="1.1" id="Layer_1" x="0px" y="0px"
                                     viewBox="0 0 512 512"
                                     style="enable-background:new 0 0 512 512; fill:#007bff; width: 20px;"
                                     xml:space="preserve">
                                <g>
                                <g>
                                <g>
                                <path d="M486.4,460.8c-1.476,0-2.944,0.128-4.386,0.384c-5.888-10.607-17.092-17.451-29.747-17.451     c-12.655,0-23.859,6.844-29.747,17.451c-1.442-0.256-2.91-0.384-4.386-0.384c-14.114,0-25.6,11.486-25.6,25.6     c0,3.004,0.614,5.845,1.579,8.533H358.4v-51.2h42.667c4.71,0,8.533-3.823,8.533-8.533V93.867c0-4.71-3.823-8.533-8.533-8.533     h-256c-4.71,0-8.533,3.823-8.533,8.533v409.6c0,4.71,3.823,8.533,8.533,8.533H486.4c14.114,0,25.6-11.486,25.6-25.6     S500.514,460.8,486.4,460.8z M358.4,102.4h34.133v51.2H358.4V102.4z M358.4,170.667h34.133v51.2H358.4V170.667z M358.4,238.933     h34.133v51.2H358.4V238.933z M358.4,307.2h34.133v51.2H358.4V307.2z M358.4,375.467h34.133v51.2H358.4V375.467z M187.733,494.933     H153.6v-51.2h34.133V494.933z M187.733,426.667H153.6v-51.2h34.133V426.667z M187.733,358.4H153.6v-51.2h34.133V358.4z      M187.733,290.133H153.6v-51.2h34.133V290.133z M187.733,221.867H153.6v-51.2h34.133V221.867z M187.733,153.6H153.6v-51.2h34.133     V153.6z M238.933,494.933H204.8v-51.2h34.133V494.933z M238.933,426.667H204.8v-51.2h34.133V426.667z M238.933,358.4H204.8v-51.2     h34.133V358.4z M238.933,290.133H204.8v-51.2h34.133V290.133z M238.933,221.867H204.8v-51.2h34.133V221.867z M238.933,153.6     H204.8v-51.2h34.133V153.6z M290.133,494.933H256v-51.2h34.133V494.933z M290.133,426.667H256v-51.2h34.133V426.667z      M290.133,358.4H256v-51.2h34.133V358.4z M290.133,290.133H256v-51.2h34.133V290.133z M290.133,221.867H256v-51.2h34.133V221.867     z M290.133,153.6H256v-51.2h34.133V153.6z M341.333,494.933H307.2v-51.2h34.133V494.933z M341.333,426.667H307.2v-51.2h34.133     V426.667z M341.333,358.4H307.2v-51.2h34.133V358.4z M341.333,290.133H307.2v-51.2h34.133V290.133z M341.333,221.867H307.2v-51.2     h34.133V221.867z M341.333,153.6H307.2v-51.2h34.133V153.6z M486.4,494.933h-68.267c-4.702,0-8.533-3.831-8.533-8.533     s3.831-8.533,8.533-8.533c1.638,0,3.191,0.469,4.625,1.391c2.338,1.502,5.257,1.775,7.834,0.734     c2.577-1.041,4.48-3.277,5.103-5.982c1.801-7.774,8.619-13.21,16.572-13.21c7.953,0,14.771,5.436,16.572,13.21     c0.623,2.705,2.526,4.941,5.103,5.982c2.577,1.041,5.495,0.768,7.834-0.734c5.547-3.584,13.167,0.802,13.158,7.142     C494.933,491.102,491.102,494.933,486.4,494.933z"/>
                                <path d="M187.733,59.733v-25.6h59.733c4.71,0,8.533-3.823,8.533-8.533v-8.533h34.133V25.6c0,4.71,3.823,8.533,8.533,8.533H358.4     V51.2H213.333c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h213.333v353.954c0,4.71,3.823,8.533,8.533,8.533     s8.533-3.823,8.533-8.533V59.733c0-4.71-3.823-8.533-8.533-8.533h-59.733V25.6c0-4.71-3.823-8.533-8.533-8.533H307.2V8.533     c0-4.71-3.823-8.533-8.533-8.533h-51.2c-4.71,0-8.533,3.823-8.533,8.533v8.533H179.2c-4.71,0-8.533,3.823-8.533,8.533v25.6     h-59.733c-4.71,0-8.533,3.823-8.533,8.533v435.2H51.2v-34.995c19.447-3.968,34.133-21.197,34.133-41.805     c0-1.109-0.486-110.933-42.667-110.933C0.486,307.2,0,417.024,0,418.133c0,20.608,14.686,37.837,34.133,41.805v34.995h-25.6     c-4.71,0-8.533,3.823-8.533,8.533S3.823,512,8.533,512h102.4c4.71,0,8.533-3.823,8.533-8.533v-435.2H179.2     C183.91,68.267,187.733,64.444,187.733,59.733z M17.067,418.133c0-42.513,11.418-93.867,25.6-93.867     c14.182,0,25.6,51.354,25.6,93.867c0,14.114-11.486,25.6-25.6,25.6S17.067,432.247,17.067,418.133z"/>
                                </g>
                                </g>
                                </g>
                                </svg>
                                </span>
                                    </div>
                                @endforeach
                            </div>--}}


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
    <!-- JOB FILTER MODAL END!!!!!!!!!!!!!!! -->

    @include('components.jobmap.modal.share_location_modal')

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
    <script src="{{ asset('/js/jobmap/app/location-view.js?v='.time()) }}"></script>
    <script>
        $(document).ready(function () {
            Loader.init();
            var ViewLocation = new LocationView({{ $data->id }}, {{ $data->business->id }});
            ViewLocation.init();
            ViewLocation.renderMap({{ $data->latitude }},{{ $data->longitude }}, {{ $data->id }}, '{{ $data->business->picture_50 }}');
            app.run();
        });
    </script>
@endsection
