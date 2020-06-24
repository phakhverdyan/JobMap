@extends('layouts.main_business')

@section('content')
    <style type="text/css">
        /*@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700');*/

        .business_tabs {
            font-size: 20px;
            color: #4E5C6E;
            /*font-family: 'Open Sans', sans-serif;*/
        }

        .open-sans {
            /*font-family: 'Open Sans', sans-serif;*/
        }

        .business_tabs.active {
            font-weight: bold;
            color: #4266ff;
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
    </style>
    <div id="business-view" style="margin-top: -5px; overflow: hidden; background-color: #fff;">
        <!-- left menu begin -->
        <!-- <div class="col-md-3">menu</div> -->
        <!-- left menu eof -->

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
                <a href="#" id="link-location-country"
                   class="text-white" data-toggle="tooltip" data-placement="top"
                   title="Explore Country">country</a>
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
                <a href="#" id="link-location-region"
                   class="text-white" data-toggle="tooltip" data-placement="top"
                   title="Explore Region">region</a>
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
                <a href="#" id="link-location-city" class="text-white"
                   data-toggle="tooltip" data-placement="top" title="Explore City">city</a>
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
                <a href="#" id="link-location-street"
                   class="text-white" data-toggle="tooltip" data-placement="top"
                   title="Explore Street">street</a>
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
                <a href="#" id="link-location-address"
                   class="text-white" data-toggle="tooltip" data-placement="top"
                   title="Explore building/location">street_number</a>
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
        {{--<img src="{{ asset('img/unconfirmed1.jpg') }}" style="height: 400px; width: 100%;">--}}

        <p class="text-center mb-0 back_to_fullmap-button" style="position: absolute; left: 0; right: 0; margin-top: -85px; z-index: 1;"><a href="{{ url('/map') }}" role="button" class="btn btn-primary" >{!! trans('main.buttons.back_to_full_map') !!}</a></p>

        <div class="careerpage_businessname"
             style="background: rgba(0,0,0,0.3); width: 100%; height: 60px; margin-top: -59px; position: absolute;">
            <div class="container" style="position: relative;">
                <div class="d-flex justify-content-between flex-lg-row flex-column pt-2 career-page_buss-logo_mobile">
                    <div class="d-flex flex-lg-row flex-column">
                        <div class="pxa-0 mxa-0 text-center text-md-left align-self-center mr-3 careerpage_businessname bg-white"
                             style="margin-top: -34px; position: absolute; border-radius: 10px;">
                            <img class="business-icon careerpage_icon wow animated fadeInDown"
                                 src="{{ asset($data->picture) }}" style="width: 200px; border:5px solid #fff; border-radius: 10px;">
                        </div>
                        <p class="mb-0 align-self-center mxa-0 text-white business_name_color" id="business-name"
                           style="font-size: 30px; margin-left: 215px;">
                            {{ $data->name }}
                        </p>
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

        <div class="w-100 bg-white border-left-0 border-right-0 border">
            <div class="container">
                <div class="col-12 px-0">
                    <div class="d-flex flex-lg-row flex-column justify-content-end">
                        <div class="col-lg-3 col-12 mr-lg-5 mt-3 mt-lg-0 align-self-center justify-content-lg-end justify-content-center d-inline-flex">
                            <div class="align-self-center justify-content-end">
                              <span class="ml-2" data-toggle="tooltip" title="" data-original-title="Email &amp; share this job">
                                  <a data-toggle="modal" data-target="#ShareModalUBis" data-link="">
                                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512.297 512.297" style="enable-background:new 0 0 512.297 512.297;  vertical-align: middle; margin-top: -3px; opacity: 0.4; fill:#4266ff;" xml:space="preserve" width="20px" height="20px">
                                          <g>
                                              <g>
                                                  <path d="M506.049,230.4l-192-192c-13.439-13.439-36.418-3.921-36.418,15.085v85.431    c-122.191,5.079-229.968,88.278-264.124,206.683C2.101,385.123-0.745,417.65,0.154,452.659c0.113,4.11,0.142,5.296,0.142,6.159    c0,21.677,28.579,29.538,39.666,10.911c23.767-39.933,50.761-70.791,80.333-93.599c53.462-41.233,109.122-53.174,157.335-48.352    v109.707c0,19.006,22.979,28.524,36.418,15.085l192-192C514.38,252.239,514.38,238.731,506.049,230.4z M320.297,385.982v-76.497    c0-9.773-6.641-18.296-16.117-20.686c-2.596-0.655-6.908-1.513-12.758-2.331c-60.43-8.455-130.633,4.548-197.184,55.876    c-16.371,12.626-31.961,27.299-46.688,44.105l0.326-1.708c1.701-8.759,3.879-17.804,6.624-27.315    c30.45-105.558,130.034-178.409,240.312-176.032c1.864,0.033,2.552,0.048,3.415,0.078c12.063,0.416,22.069-9.25,22.069-21.321    v-55.163l140.497,140.497L320.297,385.982z"></path>
                                              </g>
                                          </g>
                                      </svg>
                                  </a>
                              </span>
                            </div>
                        </div>
                        <div class="flex-1 d-flex flex-lg-row flex-column justify-content-between py-2">
                            <div class="d-flex flex-sm-row flex-column justify-content-between justify-content-lg-center w-100">
                                <div class="text-center py-3 mxa-0 mr-5">
                                    <div class="mb-3 mb-lg-0">
                                        <span href="#" class="business_tabs mxa-0 active">
                                            <span id="job-count">{{ $data->locations_count }} Locations</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="align-self-center ml-5 mxa-0">
                                <p class="mb-0 text-center text-button-send-resume">
                                    <small>{!! trans('main.buttons_hint.want_to_apply_here') !!}</small>
                                </p>
                                <button class="btn ubis-send-resume w-100 mr-3 mb-3 mb-lg-0"
                                        data-b-id="{{ $data->id }}"
                                        id="animate_hover" data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="{!! trans('main.buttons_hint.apply_to_this_job') !!}"
                                        style="border: 1px solid #4266ff; background: #fff; color: #4266ff;">
                                    <span class="mb-0 pb-2" style="font-weight: 400;">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                             x="0px" y="0px" viewBox="0 0 426.667 426.667"
                                             style="enable-background:new 0 0 426.667 426.667; fill:#4266ff; vertical-align: middle; margin-top: -3px;"
                                             xml:space="preserve" class="mr-2" widht="20px" height="20px">
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
                        @if($data->website && !empty($data->website))
                            <p class="mb-3" id="website" class="regural_text_style">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512"
                                     style="enable-background:new 0 0 512 512; vertical-align: middle; margin-top: -3px; fill:#4E5C6E;"
                                     xml:space="preserve" width="20px" height="20px" class="mr-1">
                                    <g>
                                        <g>
                                            <path d="M256,0C114.842,0,0,114.842,0,256s114.842,256,256,256s256-114.842,256-256S397.158,0,256,0z M172.767,49.548    c-15.431,21.032-26.894,45.924-35.095,70.354c-14.907-5.344-28.707-11.736-41.104-19.09    C117.975,78.827,143.872,61.24,172.767,49.548z M74.894,126.702c15.971,9.964,34.036,18.452,53.65,25.317    c-6.467,27.334-10.344,56.811-11.382,87.284H34.016C37.128,197.525,51.824,158.923,74.894,126.702z M74.893,385.297    c-23.069-32.219-37.766-70.822-40.878-112.601h83.145c1.038,30.474,4.915,59.95,11.382,87.284    C108.929,366.845,90.866,375.333,74.893,385.297z M96.569,411.187c12.397-7.354,26.197-13.746,41.104-19.09    c8.2,24.428,19.663,49.32,35.095,70.354C143.872,450.76,117.975,433.173,96.569,411.187z M239.304,475.526    c-34.478-12.654-57.72-57.982-69.619-92.899c21.841-5.198,45.296-8.391,69.619-9.4V475.526z M239.304,339.813    c-27.403,1.061-53.935,4.708-78.711,10.722c-5.624-24.321-9.038-50.587-10.029-77.84h88.74V339.813z M239.304,239.304h-88.74    c0.99-27.253,4.404-53.518,10.029-77.84c24.776,6.014,51.308,9.661,78.711,10.722V239.304z M239.304,138.773    c-24.322-1.008-47.777-4.203-69.619-9.4c11.89-34.894,35.131-80.242,69.619-92.899V138.773z M437.107,126.703    c23.069,32.219,37.766,70.822,40.878,112.601h-83.145c-1.038-30.474-4.915-59.95-11.382-87.284    C403.071,145.155,421.134,136.667,437.107,126.703z M415.431,100.813c-12.397,7.354-26.197,13.746-41.104,19.09    c-8.2-24.428-19.663-49.32-35.095-70.354C368.128,61.24,394.025,78.827,415.431,100.813z M272.696,36.474    c34.478,12.654,57.72,57.982,69.619,92.899c-21.841,5.198-45.296,8.391-69.619,9.4V36.474z M272.696,172.187    c27.403-1.061,53.935-4.708,78.711-10.722c5.624,24.321,9.038,50.587,10.029,77.84h-88.74V172.187z M272.696,272.584h88.74    c-0.99,27.253-4.404,53.63-10.029,77.951c-24.776-6.014-51.308-9.661-78.711-10.722V272.584z M272.696,475.526V373.227    c24.322,1.008,47.777,4.203,69.619,9.4C330.425,417.52,307.183,462.868,272.696,475.526z M339.233,462.452    c15.431-21.032,26.894-45.924,35.095-70.354c14.907,5.344,28.706,11.736,41.104,19.09    C394.025,433.173,368.128,450.76,339.233,462.452z M437.106,385.298c-15.971-9.964-34.036-18.452-53.65-25.317    c6.467-27.334,10.344-56.922,11.382-87.395h83.145C474.872,314.364,460.176,353.077,437.106,385.298z"/>
                                        </g>
                                    </g>
                                </svg>
                                <a target="_blank"
                                   href="#"
                                   class="regural_text_style">{{ $data->web_site }}</a>
                            </p>
                        @endif
                        <div class="d-flex justify-content-between mb-3">
                            <a href="{{ $data->instagram ? 'https://'.$data->instagram : 'javascript:0' }}">
                                <img src="{{ asset('img/icons/instagram'. ($data->instagram ? '' : '_grey') . '.svg') }}" width="40px" height="40px">
                            </a>
                            <a href="{{ $data->facebook ? 'https://'.$data->facebook : 'javascript:0' }}">
                                <img src="{{ asset('img/icons/facebook'. ($data->facebook ? '' : '_grey') . '.svg') }}" width="40px" height="40px">
                            </a>
                            <a href="{{ $data->twitter ? 'https://'.$data->twitter : 'javascript:0' }}">
                                <img src="{{ asset('img/icons/twitter'. ($data->twitter ? '' : '_grey') . '.svg') }}" width="40px" height="40px">
                            </a>
                            <a href="{{ $data->linkedin ? 'https://'.$data->linkedin : 'javascript:0' }}">
                                <img src="{{ asset('img/icons/linkedin'. ($data->linkedin ? '' : '_grey') . '.svg') }}" width="40px" height="40px">
                            </a>
                        </div>
                            {{--<div class="d-flex justify-content-between mb-3">
                              <a href="#"><img src="{{ asset('img/icons/instagram_grey.svg') }}" width="40px" height="40px"></a>
                              <a href="#"><img src="{{ asset('img/icons/facebook_grey.svg') }}" width="40px" height="40px"></a>
                              <a href="#"><img src="{{ asset('img/icons/twitter_grey.svg') }}" width="40px" height="40px"></a>
                              <a href="#"><img src="{{ asset('img/icons/linkedin_grey.svg') }}" width="40px" height="40px"></a>
                            </div>--}}


                            <div class="col-md-12 my-3 border" id="map-small" style="height: 160px; border-radius: 15px; "></div>
                            {{--<img src="{{ asset('img/unconfirmed2.jpg') }}" class="col-md-12 my-3 p-0 border" style="height: 160px; border-radius: 15px;"></img>--}}

                            <p><button class="btn btn-primary btn-block ubis-send-resume" data-b-id="{{ $data->id }}">Claim your business</button></p>

                        <div class="text-left py-2 pb-4 title_left_sorting rounded mt-3" style="font-size: 14px;">
                            <p class="mb-0 text-justify">
                              <i class="glyphicon bfh-flag-ca"></i>
                              <strong>{{ $data->keyword->name }}</strong></p>
                            @if ($data->phone_first)
                                <p class="mb-0 text-justify"> <strong>Phone</strong> {{ $data->phone_first }}</p>
                            @endif
                        </div>
                    </div>
                    @if ($data->locations_count)
                        <div class="flex-1">
                            @include('common.job.career_items', ['items' => $data->items])
                        </div>
                    @else
                        <div class="flex-1">
                            <div class="col-12 bg-white mt-4 result_shadow text-center py-3" style="border-radius: 10px;">
                              <div style="color:#D2D3D5; font-weight: bold; font-size: 19px;">
                                <p>Apply to</p>
                                <p style="font-size: 25px;">Business name</p>
                                <p>by clicking on the "I'm Interested" button</p>
                                <p>or</p>
                                <p>by choosing a specific branch on the map or in the branch option.</p>
                              </div>
                            </div>
                        </div>
                    @endif
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
    @include('components.modal.claim_unconfirmed_business')

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
    <script src="{{ asset('/js/app/send-resume.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/u_business.js?v='.time()) }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key={{ env('GOOGLE_MAPS_API_KEY', 'AIzaSyCLDOlFEBqX8B8bwiURqNObe5V5xrJrftw') }}"></script>
    <script src="{{ asset('/js/app/CustomGoogleMapMarker.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/business-view.js?v='.time()) }}"></script>
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
            ViewBusiness = new BusinessView({{ $data->id }}, 'unconfirmed_locations');
            ViewBusiness.init();
            ViewBusiness.setAssignLocations({'items': {!! json_encode($data->locations) !!} });
            ViewBusiness.renderMap({{ $data->latitude }},{{ $data->longitude }}, {{ $data->id }}, '{{ $data->picture }}');
            ViewBusiness.renderMapSmall({{ $data->latitude }},{{ $data->longitude }}, {{ $data->id }}, '{{ $data->picture }}');
            //app.run();
        });
    </script>
    {{--<script>
        function initMapPage (idMap, zoom, typeVisuals, latitude, longitude)
        {
            zoom = zoom || 5;
            typeVisuals = typeVisuals || 1;
            latitude = latitude || 50;
            longitude = longitude || -80;
            var myLatLng = {lat: latitude, lng: longitude};
            var options = {
                zoom: zoom,
                maxZoom: 19,
                center: myLatLng,

                styles: [
                    {
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#f5f5f5"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#616161"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "color": "#f5f5f5"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.land_parcel",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#bdbdbd"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#eeeeee"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#757575"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#e5e5e5"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#757575"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#dadada"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#616161"
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                        ]
                    },
                    {
                        "featureType": "transit.line",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#e5e5e5"
                            }
                        ]
                    },
                    {
                        "featureType": "transit.station",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#eeeeee"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#c9c9c9"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                        ]
                    }
                ]
            };
            if (typeVisuals == 1) {
                var optionsVisuals = {
                    zoomControl: true,
                    zoomControlOptions: {
                        position: google.maps.ControlPosition.RIGHT_CENTER
                    },
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                        position: google.maps.ControlPosition.LEFT_CENTER
                    },
                    streetViewControl: true,
                    streetViewControlOptions: {
                        position: google.maps.ControlPosition.RIGHT_CENTER
                    },
                };
                options  = Object.assign(options, optionsVisuals);
            }
            var map = new google.maps.Map(document.getElementById(idMap), options);

        };

        initMapPage('map');
        initMapPage('map-small', 2, 2);
    </script>--}}

@endsection


