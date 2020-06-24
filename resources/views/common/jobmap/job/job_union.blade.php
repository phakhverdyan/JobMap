@extends('layouts.jobmap.common_user')

@push('meta')
    <meta property="og:title" content="{{ $data->localized_title }}">
    <meta property="og:image" content="{{ $data->business->picture }}">
    <meta property="og:description" content="{{ $data->localized_description }}">
@endpush

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

        .regural_text_style {
            color: #4E5C6E;
            /*font-family: sans-regular;*/
            font-size: 15px;
            font-weight: 400;
        }
    </style>
    <div id="location-view" style="margin-top: 15px;">

        {{--<div class="business_background_img"
             style="height: 400px; background-size: cover; background:url('https://i.ytimg.com/vi/M1msXMurNCM/maxresdefault.jpg'); background-size: cover; background-position: center center;"></div>--}}
        <div class="col-md-12" id="map" style="height: 400px;"></div>

        <!-- OBJECT VIEW -->
        <div class="jobmap_object_view bg-white pb-5" style="right: 0px; top: 55px; z-index: 1; width: 800px; overflow-y: auto; height: calc(100vh - 55px); position: fixed; display: none; -webkit-box-shadow: -1px 0px 8px -2px rgba(0,0,0,0.75); -moz-box-shadow: -1px 0px 8px -2px rgba(0,0,0,0.75); box-shadow: -1px 0px 8px -2px rgba(0,0,0,0.75);">
            <div class="w-100 text-left mt-2">
                <button type="button" class="close close_mapObject ml-3" style="float: none; cursor: pointer;">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="jobmap_content_view">
                <p class="text-center pl-3 mb-5 location-address" style="font-size: 19px;">{{--200 Rue Labreche, Montreal, QC, Canada--}}</p>
                <div class="d-flex justify-content-around mb-5">
                    <div class="mb-0 text-center">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 57.502 57.502" style="enable-background:new 0 0 57.502 57.502; fill:#4266ff; vertical-align: middle;" xml:space="preserve" width="30px" height="30px"><g><g>
                                        <path d="M20.832,12.125c-5.204,0-9.438,4.233-9.438,9.438S15.628,31,20.832,31s9.438-4.233,9.438-9.438   S26.036,12.125,20.832,12.125z M20.832,29c-4.101,0-7.438-3.337-7.438-7.438s3.337-7.438,7.438-7.438s7.438,3.337,7.438,7.438   S24.933,29,20.832,29z"></path>
                                        <path d="M52.051,13.078C50.929,4.522,45.61,0,36.67,0c-8.656,0-12.434,3.722-14.084,7.065C22.017,7.024,21.434,7,20.832,7   c-8.94,0-14.259,4.522-15.381,13.078c-0.373,2.84-0.222,5.897,0.451,9.088C9.24,44.989,17.297,54.477,19.686,57.007   c0.297,0.314,0.715,0.495,1.146,0.495c0.431,0,0.849-0.181,1.146-0.495c1.521-1.611,5.339-6.055,8.774-13.149   c2.166,3.27,4.015,5.347,4.771,6.147c0.297,0.316,0.715,0.498,1.146,0.498c0.433,0,0.851-0.182,1.146-0.496   c2.39-2.532,10.446-12.023,13.783-27.841C52.272,18.976,52.424,15.918,52.051,13.078z M20.831,55.301   C18.649,52.899,11,43.641,7.859,28.754c-0.626-2.969-0.77-5.8-0.426-8.416C8.421,12.814,12.928,9,20.832,9   c3.307,0,6.011,0.677,8.12,2.005c3.815,2.513,4.948,7.061,5.278,9.585c0.044,0.328,0.077,0.662,0.105,1.005   c0.002,0.03,0.005,0.06,0.008,0.09c0.024,0.325,0.041,0.661,0.052,1.008c0.042,1.935-0.147,3.96-0.59,6.06   C30.663,43.641,23.015,52.899,20.831,55.301z M30.639,9.709C31.966,7.998,34.205,7,36.813,7c4.101,0,7.438,3.337,7.438,7.438   s-3.337,7.438-7.438,7.438c-0.148,0-0.297-0.006-0.453-0.017c-0.032-0.6-0.072-1.198-0.149-1.78   C35.595,15.371,33.7,11.893,30.639,9.709z M49.643,21.754c-3.139,14.88-10.787,24.142-12.973,26.547   c-0.948-1.042-2.822-3.265-4.926-6.597c1.576-3.598,3.012-7.775,4.016-12.538c0.384-1.821,0.578-3.592,0.622-5.311   c0.144,0.007,0.29,0.02,0.431,0.02c5.204,0,9.438-4.233,9.438-9.438S42.018,5,36.813,5c-3.336,0-6.207,1.366-7.894,3.686   c-1.247-0.62-2.643-1.068-4.184-1.345C26.796,3.809,30.789,2,36.67,2c7.904,0,12.411,3.814,13.398,11.338   C50.412,15.954,50.269,18.785,49.643,21.754z"></path>
                                    </g></g> </svg>
                        </p>
                        <p class="businesses-count"></p>
                    </div>
                    <div class="mb-0 text-center">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512.019 512.019" style="enable-background:new 0 0 512 512; fill:#4266ff; vertical-align: middle;" xml:space="preserve" width="30px" height="30px">
                                <g><g>
                                        <g>
                                            <path d="M480.009,106.676h-448c-17.643,0-32,14.357-32,32v298.667c0,17.643,14.357,32,32,32h448c17.643,0,32-14.357,32-32V138.676    C512.009,121.033,497.652,106.676,480.009,106.676z M490.676,437.343c0,5.888-4.779,10.667-10.667,10.667h-448    c-5.888,0-10.667-4.779-10.667-10.667V138.676c0-5.888,4.779-10.667,10.667-10.667h448c5.888,0,10.667,4.779,10.667,10.667    V437.343z" data-original="#000000" class="active-path" data-old_color="#007bff"></path>
                                        </g>
                                    </g><g>
                                        <g>
                                            <path d="M309.343,42.676H202.676c-17.643,0-32,14.357-32,32v42.667c0,5.888,4.779,10.667,10.667,10.667h149.333    c5.888,0,10.667-4.779,10.667-10.667V74.676C341.343,57.033,326.985,42.676,309.343,42.676z M320.009,106.676h-128v-32    c0-5.888,4.779-10.667,10.667-10.667h106.667c5.888,0,10.667,4.779,10.667,10.667V106.676z" data-original="#000000" class="active-path" data-old_color="#007bff"></path>
                                        </g>
                                    </g><g>
                                        <g>
                                            <path d="M511.668,242.655c-1.493-5.717-7.403-9.088-13.013-7.637l-169.963,44.331c-47.552,12.416-97.835,12.416-145.387,0    L13.364,235.017c-5.611-1.451-11.541,1.92-13.013,7.637c-1.493,5.696,1.92,11.52,7.637,13.013l169.941,44.331    c25.557,6.656,51.819,9.984,78.08,9.984s52.544-3.328,78.08-9.984l169.941-44.331    C509.748,254.175,513.161,248.351,511.668,242.655z" data-original="#000000" class="active-path" data-old_color="#007bff"></path>
                                        </g>
                                    </g><g>
                                        <g>
                                            <path d="M256.009,192.009c-23.531,0-42.667,19.136-42.667,42.667c0,23.531,19.136,42.667,42.667,42.667    s42.667-19.136,42.667-42.667C298.676,211.145,279.54,192.009,256.009,192.009z M256.009,256.009    c-11.755,0-21.333-9.579-21.333-21.333c0-11.755,9.579-21.333,21.333-21.333c11.755,0,21.333,9.579,21.333,21.333    C277.343,246.431,267.764,256.009,256.009,256.009z" data-original="#000000" class="active-path" data-old_color="#007bff"></path>
                                        </g>
                                    </g></g>
                            </svg>
                        </p>
                        <p class="jobs-count"></p>
                    </div>
                </div>
                <hr>
                <!-- ONE OBJECT -->
                <div class="px-3 jobmap_list_view">
                </div>
                <!-- /ONE OBJECT -->
            </div>
        </div>
        <!-- /OBJECT VIEW -->

        <p class="text-center mb-0" style="position: absolute; left: 0; right: 0; margin-top: -25px; z-index: 1;"><a href="{!! url('/map') !!}" role="button" class="btn btn-primary" >{!! trans('main.buttons.back_to_full_map') !!}</a></p>

        <div class="careerpage_businessname"
             style="width: 100%; height: 60px; margin-top: -59px; position: absolute;">
            <div class="container" style="position: relative;">
                <div class="d-flex justify-content-between flex-lg-row flex-column pt-2">
                    <div class="d-flex flex-lg-row flex-column">
                        <div class="pxa-0 mxa-0 text-center text-md-left align-self-center bg-white mr-3 careerpage_businessname"
                             style="margin-top: 10px; position: absolute; border-radius: 10px;">
                            <img class="location-icon careerpage_icon wow animated fadeInDown"
                                 src="{{ $data->business->picture }}" style="width: 175px; border:5px solid #fff; border-radius: 10px;">
                        </div>
                    </div>

                    <div class="align-self-center" style="display: none;">
                        <button class="btn btn-primary border-0 mt-0 mb-3 mb-lg-0" id="map-resize" data-map="1"
                                data-text="{!! trans('main.buttons.smaller_map') !!}" style="background-color: #0747a6;">
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
                        <div class="flex-1 mt-3 mt-lg-0 align-self-center justify-content-lg-start px-0 justify-content-center d-inline-flex">
                            <p class="mb-0 align-self-center mxa-0 text-black business_name_color text-center" id="business-name" style="font-size: 30px; margin-left: 185px;">
                                {{ $data->localized_title }}
                            </p>
                        </div>
                        <div class="d-flex flex-lg-row flex-column justify-content-between py-0">
                            <div class="d-flex flex-sm-row flex-column justify-content-between justify-content-lg-center w-100">
                                <div class="text-center py-3 mxa-0 mr-4">
                                    <div class="mb-3 mb-lg-0">
                                        <a href="javascript:;" class="business_tabs mxa-0" id="tab-opened-jobs">
                                            <span id="job-o-count">{{ $items[0]->jobs_open }} </span><span>{!! trans('main.buttons.opened_jobs') !!}</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="text-center py-3 mxa-0 mr-5">
                                    <div class="mb-3 mb-lg-0">
                                        <a href="javascript:;" id="tab-closed-jobs">
                                            <span id="job-c-count">{{ $items[0]->jobs_close }} </span><span>{!! trans('main.buttons.closed_jobs') !!}</span>
                                        </a>
                                    </div>
                                </div>
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
                            <p>
                                <a href="{!! url('/') . '/business/view/' . $data->business->id . '/' . $data->business->slug !!}"
                                   class="mb-0 text-justify btn btn-outline-new btn-block text-center" role="button">
                                    {!! trans('main.buttons.career_page') !!}
                                </a>
                            </p>
                            <p class="mb-0 py-2 text-justify">
                                <img src="{{ asset('img/icons/phone.svg') }}" width="30px" height="30px">
                                {{ $data->assign_locations[0]->phone_code.$data->assign_locations[0]->phone }}
                            </p>
                            @if($data->business->localized_website && !empty($data->business->localized_website))
                                <p class="mb-0" id="website" class="regural_text_style">
                                    <a target="_blank" href="{!! (is_null(parse_url($data->business->localized_website, PHP_URL_HOST)) ? '//' : '').$data->business->localized_website !!}"
                                       class="regural_text_style">
                                        <img src="{{ asset('img/icons/website.svg') }}" width="30px" height="30px">
                                        Website
                                    </a>
                                </p>
                            @endif

                            <p>{{ $data->category_name }}</p>

                            {{--<div class="text-left py-2 pb-4 title_left_sorting rounded mt-3" style="font-size: 14px;">
                                <p class="mb-0"><i class="glyphicon bfh-flag-{{ $data->assign_locations[0]->country_code }}"></i>
                                    <strong>{{ getLocation($data->assign_locations[0]) }}</strong>
                                </p>
                                <a tel="{{ $data->assign_locations[0]->phone_code.$data->assign_locations[0]->phone }}" class="mb-0 text-justify" style="font-size: 16px; margin-left: 25px;">
                                    {{ $data->assign_locations[0]->phone_code.$data->assign_locations[0]->phone }}
                                </a>
                            </div>--}}
                        </div>
                    </div>
                    <div class="col-lg-9 col-12 mx-auto">
                        <div class="col-12 bg-white mt-4" style="border-radius: 10px;">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="col-12 px-0">

                                        <div class="title_left_sorting text-left d-flex flex-column flex-lg-row py-3">
                                            <div class="d-flex col-12 pl-0 col-lg-4 pxa-0 justify-content-between mb-3 mb-lg-0"
                                                 style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;">
                                                <input type="text" class="form-control w-100 border-0"
                                                       style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;"
                                                       placeholder="{!! trans('fields.placeholder.find') !!}"  id="items-search" value="{{ $keywords }}">
                                                <div class="align-self-center mr-3 mr-lg-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                         id="Capa_1" x="0px" y="0px" viewBox="0 0 250.313 250.313"
                                                         style="enable-background:new 0 0 250.313 250.313; opacity: 0.1;"
                                                         xml:space="preserve" widht="17px" height="17px">
                                                        <g id="Search">
                                                            <path style="fill-rule:evenodd;clip-rule:evenodd;"
                                                                  d="M244.186,214.604l-54.379-54.378c-0.289-0.289-0.628-0.491-0.93-0.76   c10.7-16.231,16.945-35.66,16.945-56.554C205.822,46.075,159.747,0,102.911,0S0,46.075,0,102.911   c0,56.835,46.074,102.911,102.91,102.911c20.895,0,40.323-6.245,56.554-16.945c0.269,0.301,0.47,0.64,0.759,0.929l54.38,54.38   c8.169,8.168,21.413,8.168,29.583,0C252.354,236.017,252.354,222.773,244.186,214.604z M102.911,170.146   c-37.134,0-67.236-30.102-67.236-67.235c0-37.134,30.103-67.236,67.236-67.236c37.132,0,67.235,30.103,67.235,67.236   C170.146,140.044,140.043,170.146,102.911,170.146z"/>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="d-flex ml-auto w-100 justify-content-between justify-content-lg-end flex-md-row flex-column">
                                                <div class="d-flex mr-0 pt-1 mb-3 mb-md-0">
                                                    <span class="pt-2 mr-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                                             version="1.1" id="Capa_1" x="0px" y="0px"
                                                             viewBox="0 0 417.138 417.138"
                                                             style="height:15px; opacity: 0.8; fill:#4266ff;"
                                                             xml:space="preserve">
                                                        <g>
                                                            <g>
                                                                <path d="M153.289,333.271c9.35,0,17-7.65,17-17v-299.2c0-6.517-3.683-12.467-9.35-15.3c-5.667-2.833-12.75-2.267-17.85,1.7    l-111.067,83.3c-7.65,5.667-9.067,16.15-3.4,23.8c5.667,7.65,16.15,9.067,23.8,3.4l83.867-62.9v265.2    C136.289,325.621,143.939,333.271,153.289,333.271z"/>
                                                                <path d="M263.789,86.771c-9.35,0-17,7.65-17,17v296.367c0,6.517,3.683,12.183,9.35,15.3c2.55,1.133,5.1,1.7,7.65,1.7    c3.683,0,7.083-1.133,10.2-3.4l111.067-81.883c7.65-5.667,9.067-16.15,3.683-23.8c-5.667-7.65-16.15-9.067-23.8-3.683    l-84.15,62.05v-262.65C280.789,94.421,273.139,86.771,263.789,86.771z"/>
                                                            </g>
                                                        </g>
                                                        </svg>
                                                    </span>
                                                    <select class="border-0 form-control form-control-sm bg-white"
                                                            id="items-sort" style="box-shadow: none!important; color:#47546b;">
                                                        <option @if($sort == 'title' && $order == 'asc') selected @endif value="title"
                                                                data-order="asc">{!! trans('main.sort.title_az') !!}
                                                        </option>
                                                        <option @if($sort == 'title' && $order == 'desc') selected @endif value="title"
                                                                data-order="desc">{!! trans('main.sort.title_za') !!}
                                                        </option>
                                                        <option @if($sort == 'created_date' && $order == 'asc') selected
                                                                @endif value="created_date"
                                                                data-order="asc">{!! trans('main.sort.c_date_oldest') !!}
                                                        </option>
                                                        <option @if($sort == 'created_date' && $order == 'desc') selected
                                                                @endif value="created_date"
                                                                data-order="desc">{!! trans('main.sort.c_date_newest') !!}
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="pt-1 mb-3 mb-md-0">
                                                    <select class="border-0 form-control form-control-sm bg-white" id="items-limit" style="box-shadow: none!important; color:#47546b;">
                                                        <option @if($limit == 25) selected @endif value="25">{!! trans('main.limit', ['count' => 25]) !!}</option>
                                                        <option @if($limit == 50) selected @endif value="50">{!! trans('main.limit', ['count' => 50]) !!}</option>
                                                        <option @if($limit == 100) selected @endif value="100">{!! trans('main.limit', ['count' => 100]) !!}</option>
                                                        <option @if($limit == 200) selected @endif value="200">{!! trans('main.limit', ['count' => 200]) !!}</option>
                                                    </select>
                                                </div>
                                                <div class="btn-group pxa-0" role="group" aria-label="Basic example">
                                                    <div class="d-inline-flex">
                                                        <button class="btn btn-outline-primary rounded d-flex"
                                                                type="button"
                                                                aria-expanded="false" data-toggle="modal"
                                                                data-target="#jobfiltermodal"
                                                                id="filters-modal"
                                                                style="background-color: #fff; border:1px solid #4266ff; color:#4266ff;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                                 id="Layer_1"
                                                                 x="0px"
                                                                 y="0px" viewBox="0 0 511.999 511.999"
                                                                 xml:space="preserve"
                                                                 height="20px"
                                                                 style="fill:#4266ff!important; vertical-align: middle;">
                                                                    <path d="M510.078,35.509c-3.388-7.304-10.709-11.977-18.761-11.977H20.682c-8.051,0-15.372,4.672-18.761,11.977    s-2.23,15.911,2.969,22.06l183.364,216.828v146.324c0,7.833,4.426,14.995,11.433,18.499l94.127,47.063    c2.919,1.46,6.088,2.183,9.249,2.183c3.782,0,7.552-1.036,10.874-3.089c6.097-3.769,9.809-10.426,9.809-17.594V274.397    L507.11,57.569C512.309,51.42,513.466,42.813,510.078,35.509z M287.27,253.469c-3.157,3.734-4.889,8.466-4.889,13.355V434.32    l-52.763-26.381V266.825c0-4.89-1.733-9.621-4.89-13.355L65.259,64.896h381.482L287.27,253.469z"
                                                                          style="fill:#4266ff!important;"/>
                                                                </svg>
                                                            <span>
                                                                    {!! trans('main.buttons.filters') !!}
                                                                </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row text-left" id="items-list">
                                            <div id="block-opened-jobs" class="col-12 px-0">
                                                @foreach($items as $item)
                                                    @if ($item->status_in_location)
                                                        {!! $item->html !!}
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div id="block-closed-jobs" class="col-12 px-0 hide">
                                                @foreach($items as $item)
                                                    @if (!$item->status_in_location)
                                                        {!! $item->html !!}
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    @include('components.jobmap.modal.share_modal')

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

@endsection
@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyD3mcG8oAZzzlCSGZt5B4u5h5LmBX1SgjE"></script>
    <script src="{{ asset('/js/jobmap/app/CustomGoogleMapMarker.js?v='.time()) }}"></script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="{{ asset('/js/jobmap/app/job-union-view.js?v='.time()) }}"></script>
    <script>
        $(document).ready(function () {
            Loader.init();
            var View = new JobUnionView({{ $data->id }});
            View.init();
            View.setAssignLocations({!! json_encode($data->assign_locations) !!});
            View.renderMap({{ $data->business->latitude }},{{ $data->business->longitude }}, {{ $data->business->id }}, '{{ $data->business->picture_50 }}');
            app.run();
        });
    </script>
@endsection
