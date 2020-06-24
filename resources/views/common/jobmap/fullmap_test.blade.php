@extends('layouts.jobmap.common_user')

@section('content')
    <style type="text/css">
        .plus_icon:after {
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            content: "\f054";
            transform: rotate(-90deg);
            transition: all linear 0.25s;
            float: right;
            margin-top: 3px;
            color: rgba(78, 92, 110, 0.5);
            cursor: pointer;
        }

        .plus_icon.collapsed:after {
            transform: rotate(90deg);
            margin-top: 5px;
        }

        .page-link {
            color: #0747a6 !important;
        }
        .ui-slider-range{
            background: #4266ff!important;
        }

    </style>

    <div class="d-flex" style="margin-right: 0; margin-top: 15px">


        <div class="px-0" style="flex:1; position: relative; ">
            <div class="filter_map_button" style="margin-left: 10px; top: 50px; z-index: 1; ">
                {{--<button type="button" class="btn btn-outline-primary open_jmFilter">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 368.167 368.167" style="enable-background:new 0 0 368.167 368.167; vertical-align: middle; margin-top: -3px;" xml:space="preserve" width="20px" height="20px">
                        <g>
                            <g>
                                <g>
                                    <path d="M248.084,96.684h12c4.4,0,8-3.6,8-8c0-4.4-3.6-8-8-8h-12c-4.4,0-8,3.6-8,8C240.084,93.084,243.684,96.684,248.084,96.684     z"/>
                                    <path d="M366.484,25.484c-2.8-5.6-8.4-8.8-14.4-8.8h-336c-6,0-11.6,3.6-14.4,8.8c-2.8,5.6-2,12,1.6,16.8l141.2,177.6v115.6     c0,6,3.2,11.2,8.4,14c2.4,1.2,4.8,2,7.6,2c3.2,0,6.4-0.8,9.2-2.8l44.4-30.8c6.4-4.8,10-12,10-19.6v-78.8l140.8-177.2     C368.484,37.484,369.284,31.084,366.484,25.484z M209.684,211.884c-0.8,1.2-1.6,2.8-1.6,4.8v81.2c0,2.8-1.2,5.2-3.2,6.8     l-44.4,30.8v-118.8c0-2.8-1.2-5.2-3.2-6.4l-90.4-113.6h145.2c4.4,0,8-3.6,8-8c0-4.4-3.6-8-8-8h-156c-0.4,0-1.2,0-1.6,0l-38.4-48     h336L209.684,211.884z"/>
                                </g>
                            </g>
                        </g>
                    </svg>
                    {!! trans('main.buttons.filter') !!}
                </button>--}}
                <div class=" mt-3">
                    <div class="d-flex bg-white border rounded px-3 py-2">
                        <button class="btn border-0 p-0 align-self-center" style="background: transparent;">
                            @svg('/img/menu-options.svg', [
                                'width' => '20px',
                                'height' => '20px',
                                'style' => 'fill:#B2B2B2; vertical-align: middle;',
                                'class' => 'mr-3',
                            ])
                        </button>
                        <input type="text" name="" class="form-control border-0 p-0" placeholder="Search On JobMap" style="background: transparent;">
                        <button class="btn border-0 p-0" style="background: transparent;">
                            @svg('/img/search.svg', [
                                'width' => '20px',
                                'height' => '20px',
                                'style' => 'fill:#B2B2B2; vertical-align:middle; margin-top:-4px;'
                            ])
                        </button>
                    </div>
                </div>
            </div>
            <div class="py-2" style="border:1px solid #e9ecef;text-align: center; position: absolute; z-index: 1; right: 14px; padding: 5px; background: #fff; top:40px;">
                <span style="cursor: pointer;" id="map-theme-standard"><img src="img/standard.png" width="60px"/></span>
                <span style="cursor: pointer;" id="map-theme-silver"><img src="img/silver.png" width="60px"/></span>
                <span style="cursor: pointer;" id="map-theme-retro"><img src="img/retro.png" width="60px"/></span>
            </div>
            
            <div id="job-map" style="height: calc(100vh - 135px); position: relative;"></div>

        </div>


        <!-- OBJECT VIEW -->
        <div class="jobmap_object_view bg-white pb-5" style="right: 0px; top: 55px; z-index: 1; width: 800px; overflow-y: auto; height: calc(100vh - 55px); position: fixed; display: none;">
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
                    {{--<div class="d-lg-inline-flex d-flex flex-column flex-lg-row">
                        <div class="text-center text-lg-left mb-3">
                            <div data-filter="hudson" class="hudson" style="width: 60px; border-radius: 5px; overflow: hidden; margin:0 auto;">
                                <img class="mr-3 mxa-0 candidate-picture" src="{{ url('/') }}/resume/1/100.100.75f8c9d63c93bb070c092b8dfe6103df.png?v=49494" style="width: 60px; height: 60px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); border-radius: 5px;">
                            </div>
                        </div>
                        <div class="text-center text-lg-left mxa-0" style="margin-left: 20px">
                            <div class="mb-1 d-flex flex-column flex-lg-row">
                                <p class="mb-0" style="font-size: 18px;  font-weight: 500;">Business name</p>
                            </div>
                            <p>Business Location name</p>
                            <p class="mb-2" style="font-size: 14px;">
                                32 Locations, 2 Jobs, Category
                            </p>
                            <span>
                                <button class="btn btn-outline-viewcp btn-sm" style="font-size: 13px;">View Career Page</button>
                            </span>
                        </div>
                    </div>


                    <!-- ONE JOB IN OBJECT -->
                    <div class="mt-5 ml-3">
                        <div class="text-center text-lg-left mxa-0">
                            <div class="mb-1 d-flex flex-column flex-lg-row">
                                <p class="mb-0" style="font-size: 18px;     font-weight: 500;">
                                    Job Title 1
                                    <div class="ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 448.8 448.8" style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px; fill:rgb(40, 167, 69);" xml:space="preserve">
                                          <g>
                                              <g id="check">
                                                  <polygon points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"></polygon>
                                              </g>
                                          </g>
                                        </svg>
                                        <small style="color:rgb(40, 167, 69);">Open</small>
                                    </div>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="mb-2 align-self-center" style="font-size: 14px;">
                                    Job Description 1
                                </p>
                                <div class="col-lg-3 align-self-center">
                                    <small>3 days ago</small>
                                </div>
                            </div>
                            
                            <span>
                                <button class="btn btn-viewcp btn-sm" style="font-size: 13px;">View Job</button>
                                <button class="btn btn-outline-viewcp ml-2 btn-sm" style="font-size: 13px;">I'm Interested</button>
                            </span>
                        </div>
                    </div>
                    <!-- /ONE JOB IN OBJECT -->

                    <!-- ONE JOB IN OBJECT -->
                    <div class="mt-5 ml-3">
                        <div class="text-center text-lg-left mxa-0">
                            <div class="mb-1 d-flex flex-column flex-lg-row">
                                <p class="mb-0" style="font-size: 18px;     font-weight: 500;">
                                    Job Title 2
                                    <div class="ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 448.8 448.8" style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px; fill:rgb(40, 167, 69);" xml:space="preserve">
                                              <g>
                                                  <g id="check">
                                                      <polygon points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"></polygon>
                                                  </g>
                                              </g>
                                        </svg>
                                        <small style="color:rgb(40, 167, 69);">Open</small>
                                    </div>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="mb-2 align-self-center" style="font-size: 14px;">
                                    Job Description 2
                                </p>
                                <div class=" align-self-center">
                                    <small>3 days ago</small>
                                </div>
                            </div>
                            
                            <span>
                                <button class="btn btn-viewcp btn-sm" style="font-size: 13px;">View Job</button>
                                <button class="btn btn-outline-viewcp ml-2 btn-sm" style="font-size: 13px;">I'm Interested</button>
                            </span>
                        </div>
                    </div>--}}
                    <!-- /ONE JOB IN OBJECT -->
                </div>
                <!-- /ONE OBJECT -->
                {{--<hr>--}}
            </div>
        </div>
        <!-- /OBJECT VIEW -->

    </div>


    <div class="modal fade" id="modal-locations-list" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title">{!! trans('modals.title.in_this_building') !!}</h5>
                    <button type="button" class="close text-right" data-dismiss="modal"
                            aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="d-flex align-items-baseline justify-content-between">
                    <span class="pl-3">
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
                    </span>
                    <h5 class="modal-title pl-3" style="flex: 1" id="location-address"></h5>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer d-block bg-light">
                    <div class="bg-white">
                        <button type="button"
                                class="btn btn-outline-primary py-3 w-100" id="locations-more-info" data-id="">
                            {!! trans('main.buttons.see_all_employers_in_location') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-single-location" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header pt-0" style="display: block;">
                    <div class="d-flex">
                        <h5 class="modal-title">{!! trans('modals.title.b_jobs_in_building') !!}</h5>
                        <button type="button" class="close text-right" data-dismiss="modal"
                                aria-label="{!! trans('main.buttons.close') !!}">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <p class="mb-0"><a href="#" id="all-locations">{!! trans('modals.text.see_all_locations') !!}</a>
                    </p>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-start justify-content-between flex-lg-row flex-column">
                        <div class="align-items-start mr-2 mx-auto" style="flex: 1">
                            <div class="d-flex flex-lg-row flex-column">
                                <div class="rounded p-1 bg-white d-inline-block mr-2"
                                     style="box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);">
                                    <a href="" class="view-location-link"><img id="location-pic"
                                                                               style="width: 70px;"></a>
                                </div>
                                <div>
                                    <p class="mb-0 mr-2" id="location-open-jobs"><a href="#" data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title=""><span></span>
                                            {!! trans('main.label.open_jobs') !!}</a></p>
                                    <p class="mb-0 mr-2" id="location-close-jobs"><a href="#" data-toggle="tooltip"
                                                                                     data-placement="top"
                                                                                     title=""><span></span>
                                            {!! trans('main.label.closed_jobs') !!}</a></p>
                                </div>
                            </div>

                        </div>
                        <div class="width-100">

                            <div class="pt-1 text-center">
                                <a href="" class="btn btn-outline-primary view-location-link" id="animate_hover"
                                   data-toggle="tooltip" data-placement="top" title=""
                                   data-original-title="View this location.">
                                    <span class="mb-0 pb-2"
                                          style="font-weight: 400;">{!! trans('main.buttons.view_location') !!}</span>
                                </a>
                            </div>

                        </div>
                    </div>


                    <div class="py-3">
                        <div class="row justify-content-center">
                            <iv class="col-11 px-0">
                                <div class="d-flex flex-row justify-content-start text-center flex-wrap"
                                     id="amenities-list">

                                </div>
                            </iv>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="catInModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title" id="jobs-open-close-title"></h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-5">
                    <div class="row">

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-danger btn-block"
                                            data-dismiss="modal">{!! trans('main.buttons.cancel') !!}
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-success btn-block"
                                            id="modal-items-accept">{!! trans('main.buttons.accept') !!}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.jobmap.modal.questionnaire')

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
        .carousel{
            position: relative;
        }
        .carousel-item{
            height: auto;
            min-height: auto;
        }
    </style>
@endsection
@section('script')
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>
    <script src="{{ asset('/js/jobmap/jack.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyD3mcG8oAZzzlCSGZt5B4u5h5LmBX1SgjE"></script>
    <script src="{{ asset('/js/jobmap/app/CustomGoogleMapMarker.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/jobmap/app/job-map.js?v='.time()) }}"></script>
    {{--<script src="{{ asset('/js/jobmap/app/search.js?v='.time()) }}"></script>--}}
    <script>
        /*$(document).ready(function () {
            Loader.init();
            var S = new Search('basic',undefined);
            app.scripts(S.init());
            app.run();
        });*/
    </script>
    <script type="text/javascript">
        $('.carousel').carousel()
    </script>
@endsection
