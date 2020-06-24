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

.title_left_sorting {
    font-size: 14px;
    /*font-family: sans-regular;*/
    color: #4E5C6E;
}
</style>


    <div class="container-fluid px-0 mt-3 user-landing">
        <div>
          <div class="col-md-12 px-0 half-map" id="job-map" style="height: 70vh!important;"></div>
        </div>
        <div class="container">
            {{--<button class="btn btn-viewcp [ map__button-full-map ] "> {!! trans('main.buttons.explore_full_map') !!} </button>--}}
            <div class="col-10 mx-auto pt-5 pb-2 animated fadeInDown px-0" style="position: inherit;">
                <form id="map-search-form" autocomplete="off">
                    {{--<label class="text-left [ content__search-form__label ]" style="color:#555;">{!! trans('fields.label.job_title_or_company') !!}</label>--}}
                    <div class="d-flex flex-column flex-lg-row [ content__search-form ]">
                        <div class="col-12 col-lg-10 px-0 pxa-0" id="title-box">
                            <div class="form-control bg-white rounded-left d-flex border"
                                 style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075); border-top-right-radius: 0!important; border-bottom-right-radius: 0!important;">
                                <i class="btn border-0 p-0 align-self-center" style="background: transparent;">
                                    @svg('/img/location.svg', [
                                        'width' => '25px',
                                        'height' => '25px',
                                        'style' => 'fill:#4266ff; vertical-align: middle;',
                                        'class' => 'mr-2',
                                    ])
                                </i>
                                <input type="text" name="title" placeholder="{!! trans('fields.placeholder.cardinal_search_bar') !!}" value="{{ $title ?? '' }}" autocomplete="off"
                                       style="font-size: 17px; border:none; box-shadow: none; padding: 9px 0;width: 100%; background-color: inherit!important;">
                            </div>
                        </div>
                        <div class="col-12 col-lg-2 px-0 pxa-0" id="button-box">
                            <button type="button" id="jobs-search-button"
                                    class="btn btn-primary w-100 border-top-left-0 border-bottom-left-0 cardinal_button">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Capa_1" x="0px" y="0px" width="30px" height="30px"
                                         viewBox="0 0 485.213 485.213"
                                         style="enable-background:new 0 0 485.213 485.213; vertical-align: middle; margin-top: -4px; opacity: 0.8;"
                                         xml:space="preserve" fill="#fff">
                                        <g>
                                            <g>
                                                <path d="M363.909,181.955C363.909,81.473,282.44,0,181.956,0C81.474,0,0.001,81.473,0.001,181.955s81.473,181.951,181.955,181.951    C282.44,363.906,363.909,282.437,363.909,181.955z M181.956,318.416c-75.252,0-136.465-61.208-136.465-136.46    c0-75.252,61.213-136.465,136.465-136.465c75.25,0,136.468,61.213,136.468,136.465    C318.424,257.208,257.206,318.416,181.956,318.416z"/>
                                                <path d="M471.882,407.567L360.567,296.243c-16.586,25.795-38.536,47.734-64.331,64.321l111.324,111.324    c17.772,17.768,46.587,17.768,64.321,0C489.654,454.149,489.654,425.334,471.882,407.567z"/>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="[ content ] pb-5">

                <div class="d-flex col-10 mx-auto flex-column flex-lg-row clear-filters-box px-0 pt-2">
                    <div class="col-12 col-lg-6 px-0 pxa-0 text-left" style="font-size: 16px;">
                        <a href="{{ url('/landing')}}" class="cardinal_links align-self-center mx-0 d-md-flex d-none"><strong>{!! trans('main.hiring_add') !!}</strong></a>
                    </div>

                    <div class="col-12 col-lg-6 px-0 text-right pxa-0 clear-filters-box">
                        <a href="javascript:void(0)" class="cardinal_links clear-cardinal-content-view font-16" style="font-size: 14px; display: none;">
                            <img src="{{ asset('img/round-delete-button.svg') }}"
                                 style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 4px;">
                            {!! trans('main.buttons.clear_all_filters') !!}
                        </a>
                    </div>
                </div>

                <!-- OBJECT VIEW -->
                <div class="jobmap_object_view col-10 mx-auto bg-white pb-5" style="display: none;">
                    {{-- <div class="w-100 text-left mt-2">
                        <button type="button" class="close close_mapObject ml-3" style="float: none; cursor: pointer;">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div> --}}
                    <div class="jobmap_content_view pt-4">
                        <p class="text-center pl-3 mb-5 location-address" style="font-size: 19px;"></p>
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
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                                         style="enable-background:new 0 0 512 512;width: 25px;height: 20px;vertical-align: middle;margin-top: 10px;fill:#4266ff;"
                                         xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M341.476,338.285c54.483-85.493,47.634-74.827,49.204-77.056C410.516,233.251,421,200.322,421,166    C421,74.98,347.139,0,256,0C165.158,0,91,74.832,91,166c0,34.3,10.704,68.091,31.19,96.446l48.332,75.84    C118.847,346.227,31,369.892,31,422c0,18.995,12.398,46.065,71.462,67.159C143.704,503.888,198.231,512,256,512    c108.025,0,225-30.472,225-90C481,369.883,393.256,346.243,341.476,338.285z M147.249,245.945    c-0.165-0.258-0.337-0.51-0.517-0.758C129.685,221.735,121,193.941,121,166c0-75.018,60.406-136,135-136    c74.439,0,135,61.009,135,136c0,27.986-8.521,54.837-24.646,77.671c-1.445,1.906,6.094-9.806-110.354,172.918L147.249,245.945z     M256,482c-117.994,0-195-34.683-195-60c0-17.016,39.568-44.995,127.248-55.901l55.102,86.463    c2.754,4.322,7.524,6.938,12.649,6.938s9.896-2.617,12.649-6.938l55.101-86.463C411.431,377.005,451,404.984,451,422    C451,447.102,374.687,482,256,482z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M256,91c-41.355,0-75,33.645-75,75s33.645,75,75,75c41.355,0,75-33.645,75-75S297.355,91,256,91z M256,211    c-24.813,0-45-20.187-45-45s20.187-45,45-45s45,20.187,45,45S280.813,211,256,211z"/>
                                            </g>
                                        </g>
                                    </svg>
                                </p>
                                <p class="jobs-count"></p>
                            </div>
                        </div>
                        <hr>
                        <!-- ONE OBJECT -->
                        <div class="px-3 jobmap_list_view">

                        <!-- /ONE JOB IN OBJECT -->
                        </div>
                        <!-- /ONE OBJECT -->
                    </div>
                </div>
                <!-- /OBJECT VIEW -->

                @include('common.job.map_job_search_bar')

                <div id="search-job-preloader" class="text-center d-none">
                    <img src="img/widget_loading.gif" class="text-center">
                </div>

                <div class="col-10 mx-auto pt-4 px-0 bg-white rounded" id="items-list"></div>
        </div>
    </div>










    {{-- <div class="container-fluid px-0 mt-3 user-landing">
        <div class="col-md-12 px-0" id="job-map" style="height: 70vh!important;"></div>

        <!-- OBJECT VIEW -->
        <div class="jobmap_object_view bg-white pb-5" style="right: 0px; top: 55px; z-index: 1; width: 800px; overflow-y: auto; height: calc(100vh - 55px); position: fixed; display: none; -webkit-box-shadow: -1px 0px 8px -2px rgba(0,0,0,0.75); -moz-box-shadow: -1px 0px 8px -2px rgba(0,0,0,0.75); box-shadow: -1px 0px 8px -2px rgba(0,0,0,0.75);">
            <div class="w-100 text-left mt-2">
                <button type="button" class="close close_mapObject ml-3" style="float: none; cursor: pointer;">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="jobmap_content_view">
                <p class="text-center pl-3 mb-5 location-address" style="font-size: 19px;"></p>
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
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                                 style="enable-background:new 0 0 512 512;width: 25px;height: 20px;vertical-align: middle;margin-top: 10px;fill:#4266ff;"
                                 xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M341.476,338.285c54.483-85.493,47.634-74.827,49.204-77.056C410.516,233.251,421,200.322,421,166    C421,74.98,347.139,0,256,0C165.158,0,91,74.832,91,166c0,34.3,10.704,68.091,31.19,96.446l48.332,75.84    C118.847,346.227,31,369.892,31,422c0,18.995,12.398,46.065,71.462,67.159C143.704,503.888,198.231,512,256,512    c108.025,0,225-30.472,225-90C481,369.883,393.256,346.243,341.476,338.285z M147.249,245.945    c-0.165-0.258-0.337-0.51-0.517-0.758C129.685,221.735,121,193.941,121,166c0-75.018,60.406-136,135-136    c74.439,0,135,61.009,135,136c0,27.986-8.521,54.837-24.646,77.671c-1.445,1.906,6.094-9.806-110.354,172.918L147.249,245.945z     M256,482c-117.994,0-195-34.683-195-60c0-17.016,39.568-44.995,127.248-55.901l55.102,86.463    c2.754,4.322,7.524,6.938,12.649,6.938s9.896-2.617,12.649-6.938l55.101-86.463C411.431,377.005,451,404.984,451,422    C451,447.102,374.687,482,256,482z"/>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M256,91c-41.355,0-75,33.645-75,75s33.645,75,75,75c41.355,0,75-33.645,75-75S297.355,91,256,91z M256,211    c-24.813,0-45-20.187-45-45s20.187-45,45-45s45,20.187,45,45S280.813,211,256,211z"/>
                                    </g>
                                </g>
                            </svg>
                        </p>
                        <p class="jobs-count"></p>
                    </div>
                </div>
                <hr>
                <!-- ONE OBJECT -->
                <div class="px-3 jobmap_list_view">

                <!-- /ONE JOB IN OBJECT -->
                </div>
                <!-- /ONE OBJECT -->
            </div>
        </div> --}}
        <!-- /OBJECT VIEW -->

        {{-- <div class="container pb-5">
            <div class="col-12 text-center" style="margin-top: -19px;">
                <a href="/map" class="btn btn-viewcp" role="button">{!! trans('main.buttons.explore_full_map') !!}</a>
            </div>
            <div class="col-12 mx-auto pt-5 pb-2 animated fadeInDown px-0">
                <form action="/search/jobs?" id="search-form" autocomplete="off">
                    <div class="d-flex flex-column flex-lg-row">
                        <div class="col-12 col-lg-5 px-0 pxa-0" id="title-box">
                            <label class="text-left" style="color:#555;">{!! trans('fields.label.job_title_or_company') !!}</label>
                            <div class="form-control bg-white rounded-0 d-flex border"
                                 style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);">
                                <p class="my-0 mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                                         style="enable-background:new 0 0 512 512;width: 25px;height: 20px;vertical-align: middle;margin-top: 10px;fill:#4266ff;"
                                         xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M488.727,279.273c-6.982,0-11.636,4.655-11.636,11.636v151.273c0,6.982-4.655,11.636-11.636,11.636H46.545    c-6.982,0-11.636-4.655-11.636-11.636V290.909c0-6.982-4.655-11.636-11.636-11.636s-11.636,4.655-11.636,11.636v151.273    c0,19.782,15.127,34.909,34.909,34.909h418.909c19.782,0,34.909-15.127,34.909-34.909V290.909    C500.364,283.927,495.709,279.273,488.727,279.273z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M477.091,116.364H34.909C15.127,116.364,0,131.491,0,151.273v74.473C0,242.036,11.636,256,26.764,259.491l182.691,40.727    v37.236c0,6.982,4.655,11.636,11.636,11.636h69.818c6.982,0,11.636-4.655,11.636-11.636v-37.236l182.691-40.727    C500.364,256,512,242.036,512,225.745v-74.473C512,131.491,496.873,116.364,477.091,116.364z M279.273,325.818h-46.545v-46.545    h46.545V325.818z M488.727,225.745c0,5.818-3.491,10.473-9.309,11.636l-176.873,39.564v-9.309c0-6.982-4.655-11.636-11.636-11.636    h-69.818c-6.982,0-11.636,4.655-11.636,11.636v9.309L32.582,237.382c-5.818-1.164-9.309-5.818-9.309-11.636v-74.473    c0-6.982,4.655-11.636,11.636-11.636h442.182c6.982,0,11.636,4.655,11.636,11.636V225.745z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M314.182,34.909H197.818c-19.782,0-34.909,15.127-34.909,34.909v11.636c0,6.982,4.655,11.636,11.636,11.636    s11.636-4.655,11.636-11.636V69.818c0-6.982,4.655-11.636,11.636-11.636h116.364c6.982,0,11.636,4.655,11.636,11.636v11.636    c0,6.982,4.655,11.636,11.636,11.636c6.982,0,11.636-4.655,11.636-11.636V69.818C349.091,50.036,333.964,34.909,314.182,34.909z"/>
                                            </g>
                                        </g>
                                    </svg>
                                </p>
                                <input type="text" name="title" placeholder="{!! trans('fields.placeholder.job_title_or_company') !!}" autocomplete="off"
                                       style="font-size: 17px; border:none; box-shadow: none; padding: 9px 0;width: 100%; background-color: inherit!important;">
                            </div>

                        </div>
                        <div class="col-12 col-lg-5 px-0 pxa-0" id="location-box">
                            <label class="text-left" style="color:#555;">{!! trans('fields.label.location') !!}</label>
                            <div class="form-control bg-white rounded-0 d-flex border"
                                 style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);">
                                <p class="my-0 mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                                         style="enable-background:new 0 0 512 512;width: 25px;height: 20px;vertical-align: middle;margin-top: 10px;fill:#4266ff;"
                                         xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M341.476,338.285c54.483-85.493,47.634-74.827,49.204-77.056C410.516,233.251,421,200.322,421,166    C421,74.98,347.139,0,256,0C165.158,0,91,74.832,91,166c0,34.3,10.704,68.091,31.19,96.446l48.332,75.84    C118.847,346.227,31,369.892,31,422c0,18.995,12.398,46.065,71.462,67.159C143.704,503.888,198.231,512,256,512    c108.025,0,225-30.472,225-90C481,369.883,393.256,346.243,341.476,338.285z M147.249,245.945    c-0.165-0.258-0.337-0.51-0.517-0.758C129.685,221.735,121,193.941,121,166c0-75.018,60.406-136,135-136    c74.439,0,135,61.009,135,136c0,27.986-8.521,54.837-24.646,77.671c-1.445,1.906,6.094-9.806-110.354,172.918L147.249,245.945z     M256,482c-117.994,0-195-34.683-195-60c0-17.016,39.568-44.995,127.248-55.901l55.102,86.463    c2.754,4.322,7.524,6.938,12.649,6.938s9.896-2.617,12.649-6.938l55.101-86.463C411.431,377.005,451,404.984,451,422    C451,447.102,374.687,482,256,482z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M256,91c-41.355,0-75,33.645-75,75s33.645,75,75,75c41.355,0,75-33.645,75-75S297.355,91,256,91z M256,211    c-24.813,0-45-20.187-45-45s20.187-45,45-45s45,20.187,45,45S280.813,211,256,211z"/>
                                            </g>
                                        </g>
                                    </svg>
                                </p>
                                <input type="text" name="location" placeholder="{!! trans('fields.placeholder.location') !!}" autocomplete="off"
                                       style="font-size: 17px; border:none; box-shadow: none; padding: 9px 0;width: 100%; background-color: inherit!important;">
                            </div>

                        </div>
                        <div class="col-12 col-lg-2 px-0 pxa-0" id="button-box">
                            <label class="text-right back_to_cardinal" style="position: absolute; top:0; right: 15px; white-space: nowrap;">
                                <a href="/advanced-search" class="cardinal_links">{!! trans('main.buttons.advanced') !!}</a>
                                <a href="javascript:;" class="cardinal_links" id="show_hide-blocks-search">{!! trans('main.buttons.advanced') !!}</a>
                            </label>
                            <button type="button" id="search-button"
                                    class="btn btn-primary w-100 border-top-left-0 border-bottom-left-0 cardinal_button" style="margin-top: 25px;">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Capa_1" x="0px" y="0px" width="30px" height="30px"
                                         viewBox="0 0 485.213 485.213"
                                         style="enable-background:new 0 0 485.213 485.213; vertical-align: middle; margin-top: -4px; opacity: 0.8;"
                                         xml:space="preserve" fill="#fff">
                                        <g>
                                            <g>
                                                <path d="M363.909,181.955C363.909,81.473,282.44,0,181.956,0C81.474,0,0.001,81.473,0.001,181.955s81.473,181.951,181.955,181.951    C282.44,363.906,363.909,282.437,363.909,181.955z M181.956,318.416c-75.252,0-136.465-61.208-136.465-136.46    c0-75.252,61.213-136.465,136.465-136.465c75.25,0,136.468,61.213,136.468,136.465    C318.424,257.208,257.206,318.416,181.956,318.416z"/>
                                                <path d="M471.882,407.567L360.567,296.243c-16.586,25.795-38.536,47.734-64.331,64.321l111.324,111.324    c17.772,17.768,46.587,17.768,64.321,0C489.654,454.149,489.654,425.334,471.882,407.567z"/>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div> --}}

            {{-- @if (is_business_auth() === false)
                <div class="text-left mt-2 pb-5 wow fadeInLeft d-flex justify-content-between flex-column flex-lg-row col-12 pxa-0 px-0" style="font-size: 16px;">
                    <a href="{!! url('/landing') !!}" class="cardinal_links align-self-center mx-2 d-md-flex d-none">{!! trans('main.hiring_add') !!}</a>
                </div>
            @endif --}}
@if(false)
            <div class="col-12 mx-auto px-0" id="block-advanced-search" style="display: none">
                <div class="d-flex flex-column flex-lg-row">
                    <!-- ADVANCED FILTER BLOCK -->
                    <div class="category_section" style="width: 28%;">
                        <!-- CATEGORY SECTION START -->
                        <div class="bg-white rounded p-0">
                            <!-- ONE CATEGORY START -->
                            <div class="col-12 py-2" style="border-bottom:1px solid #e9ecef;">
                                <a href="#" class="open_close_category cardinal_links">
                                    <span class="title_left_sorting"><strong>Keywords</strong></span>
                                    <span class="float-right plus_icon"></span>
                                </a>
                                <div class="content_category">
                                    <p class="mb-1 mt-3 px-2">
                                    </p><div class="ms-ctn form-control jack ms-no-trigger" style="" id="a_keywords"><span class="ms-helper " style="display: none;"></span><div class="ms-sel-ctn"><input type="text" class="ms-inv" placeholder="Type a keyword name and press enter" style="width: 230.281px;"><div style="display: none;"></div></div></div>
                                    <p class="title_left_sorting mb-1 mt-2 px-2">
                                        <strong>Most popular</strong>
                                    </p>
                                    <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                        <?php
                                        $keyw = (isset($getData['a_keywords'])) ? explode(",", $getData['a_keywords']) : [];
                                        ?>
                                        @foreach($keywords as $keyword)
                                            <li>
                                                <a href="/search/jobs?a_keywords={{ $keyword['id'] }}">{{ $keyword['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- ONE CATEGORY END -->

                            <!-- ONE CATEGORY START -->
                            <div class="col-12 py-2 filter-group" style="border-bottom:1px solid #e9ecef;">
                                @if(isset($getData['posted']))
                                    <a href="javascript:void(0)"
                                       class="cardinal_links remove-all-filter"
                                       data-filter="posted"> <img
                                                src="{{ asset('img/round-delete-button.svg') }}"
                                                style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>
                                @endif
                                <a href="#" class="open_close_category cardinal_links">
                                                    <span class="title_left_sorting"><strong>{!! trans('fields.label.date_posted') !!}</strong>
                                                    </span>
                                    <span class="float-right plus_icon collapsed"></span>
                                </a>
                                <div class="content_category" style="display: none">
                                    <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                        <?php
                                        $posted = ['24 '.trans('fields.label._hours'), '7 '.trans('fields.label._days'), '15 '.trans('fields.label._days'), '30 '.trans('fields.label._days')];
                                        $postedData = (isset($getData['posted'])) ? explode(",", $getData['posted']) : [];
                                        ?>
                                        @foreach($posted as $v)
                                            <li>
                                                <a href="/search/jobs?posted={{ $v }}">{{ $v }}</a>
                                            </li>
                                        @endforeach
                                        <li><a href="javascript:void(0)"
                                               class="cardinal_links remove-all-filter in-filter"
                                               data-filter="posted">{!! trans('fields.label.all') !!}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- ONE CATEGORY END -->

                            <!-- ONE CATEGORY START -->
                            <div class="col-12 py-2 filter-group" style="border-bottom:1px solid #e9ecef;">
                                @if(isset($getData['categories']))
                                    <a href="javascript:void(0)"
                                       class="cardinal_links remove-all-filter"
                                       data-filter="categories"> <img
                                                src="{{ asset('img/round-delete-button.svg') }}"
                                                style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>
                                @endif
                                <a href="#" class="open_close_category cardinal_links">
                                    <span class="title_left_sorting"><strong>{!! trans('fields.label.job_category') !!}</strong></span>
                                    <span class="float-right plus_icon collapsed"></span>
                                </a>
                                <div class="content_category" style="display: none">
                                    <p class="mb-1 mt-3 px-2">
                                    <div id="categories"></div>
                                    </p>
                                    <p class="title_left_sorting mb-1 mt-2 px-2">
                                        <strong>{!! trans('main.most_popular') !!}</strong>
                                    </p>
                                    <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                        <?php
                                        $catData = (isset($getData['categories'])) ? explode(",", $getData['categories']) : [];
                                        ?>
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="/search/jobs?categories={{ $category['id'] }}">{{ $category['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <p class="mb-0 mt-2 px-2">
                                        <a href="javascript:void(0)" data-id="categories"
                                           class="btn btn-outline-primary seeall_btn see-all">{!! trans('main.buttons.see_all') !!}</a>
                                    </p>
                                </div>
                            </div>
                            <!-- ONE CATEGORY END -->

                            <!-- ONE CATEGORY START -->
                            <div class="col-12 py-2 filter-group" style="border-bottom:1px solid #e9ecef;">
                                @if(isset($getData['employers']))
                                    <a href="javascript:void(0)"
                                       class="cardinal_links remove-all-filter"
                                       data-filter="employers"> <img
                                                src="{{ asset('img/round-delete-button.svg') }}"
                                                style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>
                                @endif
                                <a href="#" class="open_close_category cardinal_links">
                                    <span class="title_left_sorting"><strong>{!! trans('fields.label.employer_type') !!}</strong></span>
                                    <span class="float-right plus_icon collapsed"></span>
                                </a>
                                <div class="content_category" style="display: none">
                                    <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                        <?php
                                        $employers = [
                                            'private' => trans('main.b_type_title.private'),
                                            'franchisee' => trans('main.b_type_title.franchisee'),
                                            'online' => trans('main.b_type_title.online'),
                                            'hiring' => trans('main.b_type_title.hiring'),
                                            'ee' => trans('main.b_type_title.ee')
                                        ];
                                        $employersData = (isset($getData['employers'])) ? explode(",", $getData['employers']) : [];
                                        ?>
                                        @foreach($employers as $k => $v)
                                            <li>
                                                    <a href="/search/jobs?employers={{ $k }}">{{ $v }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- ONE CATEGORY END -->

                            <!-- ONE CATEGORY START -->
                            <div class="col-12 py-2 filter-group" style="border-bottom:1px solid #e9ecef;">
                                @if(isset($getData['popular_industries']))
                                    <a href="javascript:void(0)"
                                       class="cardinal_links remove-all-filter"
                                       data-filter="popular_industries"> <img
                                                src="{{ asset('img/round-delete-button.svg') }}"
                                                style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>
                                @endif
                                <a href="#" class="open_close_category cardinal_links">
                                    <span class="title_left_sorting"><strong>{!! trans('fields.label.industries') !!}</strong></span>
                                    <span class="float-right plus_icon collapsed"></span>
                                </a>
                                <div class="content_category" style="display: none">
                                    <p class="mb-1 mt-3 px-2">
                                    <div id="popular_industries"></div>
                                    </p>
                                    <p class="title_left_sorting mb-1 mt-2 px-2">
                                        <strong>{!! trans('main.most_popular') !!}</strong>
                                    </p>
                                    <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                        <?php
                                        $inData = (isset($getData['popular_industries'])) ? explode(",", $getData['popular_industries']) : [];
                                        ?>
                                        @foreach($industries as $industry)
                                            <li>
                                                <a href="/search/jobs?popular_industries={{ $industry['id'] }}">{{ $industry['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <p class="mb-0 mt-2 px-2">
                                        <a href="javascript:void(0)" data-id="popular_industries"
                                           class="btn btn-outline-primary seeall_btn see-all">{!! trans('main.buttons.see_all') !!}</a>
                                    </p>
                                </div>
                            </div>
                            <!-- ONE CATEGORY END -->

                            <!-- ONE CATEGORY START -->
                            <div class="col-12 py-2 filter-group" style="border-bottom:1px solid #e9ecef;">
                                @if(isset($getData['types']))
                                    <a href="javascript:void(0)"
                                       class="cardinal_links remove-all-filter"
                                       data-filter="types"> <img
                                                src="{{ asset('img/round-delete-button.svg') }}"
                                                style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>
                                @endif
                                <a href="#" class="open_close_category cardinal_links">
                                    <span class="title_left_sorting"><strong>{!! trans('fields.label.contract_type') !!}</strong></span>
                                    <span class="float-right plus_icon collapsed"></span>
                                </a>
                                <div class="content_category" style="display: none">
                                    <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                        <?php
                                        $typesData = (isset($getData['types'])) ? explode(",", $getData['types']) : [];
                                        ?>
                                        @foreach($types as $type)
                                            <li>
                                                    <a href="/search/jobs?types={{ $type['id'] }}">{{ $type['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- ONE CATEGORY END -->

                            <!-- ONE CATEGORY START -->
                            <div class="col-12 py-2 filter-group" style="border-bottom:1px solid #e9ecef;">
                                @if(isset($getData['options']))
                                    <a href="javascript:void(0)"
                                       class="cardinal_links remove-all-filter"
                                       data-filter="options"> <img
                                                src="{{ asset('img/round-delete-button.svg') }}"
                                                style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>
                                @endif
                                <a href="#" class="open_close_category cardinal_links">
                                    <span class="title_left_sorting"><strong>{!! trans('fields.label.job_type') !!}</strong></span>
                                    <span class="float-right plus_icon collapsed"></span>
                                </a>
                                <div class="content_category" style="display: none">
                                    <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                        <?php
                                        $opData = (isset($getData['options'])) ? explode(",", $getData['options']) : [];
                                        $options = [trans('fields.label.first_job'), trans('fields.label.student'), trans('fields.label.professional'), trans('fields.label.specialized'), trans('fields.label.freelance')];
                                        ?>
                                        @foreach($options as $k => $option)
                                            <?php
                                            $i = $k + 1;
                                            ?>
                                            <li>
                                                    <a href="/search/jobs?options={{ $i }}">{{ $option }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- ONE CATEGORY END -->

                            <!-- ONE CATEGORY START -->
                            <div class="col-12 py-2 filter-group" style="border-bottom:1px solid #e9ecef;">
                                @if(isset($getData['careers']))
                                    <a href="javascript:void(0)"
                                       class="cardinal_links remove-all-filter"
                                       data-filter="careers"> <img
                                                src="{{ asset('img/round-delete-button.svg') }}"
                                                style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>
                                @endif
                                <a href="#" class="open_close_category cardinal_links">
                                    <span class="title_left_sorting"><strong>{!! trans('fields.label.career_level') !!}</strong></span>
                                    <span class="float-right plus_icon collapsed"></span>
                                </a>
                                <div class="content_category" style="display: none">
                                    <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                        <?php
                                        $careersData = (isset($getData['careers'])) ? explode(",", $getData['careers']) : [];
                                        ?>
                                        @foreach($careers as $career)
                                            <li>
                                                    <a href="/search/jobs?careers={{ $career['id'] }}">{{ $career['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- ONE CATEGORY END -->

                            <!-- ONE CATEGORY START -->
                            <div class="col-12 py-2 filter-group" style="border-bottom:1px solid #e9ecef;">
                                @if(isset($getData['time_1']) || isset($getData['time_2']) || isset($getData['time_3']) || isset($getData['time_4']))
                                    <a href="javascript:void(0)"
                                       class="cardinal_links remove-all-filter"
                                       data-filter="times"> <img
                                                src="{{ asset('img/round-delete-button.svg') }}"
                                                style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>
                                @endif
                                <a href="#" class="open_close_category cardinal_links">
                                    <span class="title_left_sorting"><strong>{!! trans('fields.label.shift_type') !!}</strong></span>
                                    <span class="float-right plus_icon collapsed"></span>
                                </a>
                                <div class="content_category" style="display: none;">
                                    <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                        <?php
                                        $times = [trans('main.time.morning'), trans('main.time.day'), trans('main.time.evening'), trans('main.time.night')];
                                        ?>
                                        @foreach($times as $k=>$time)
                                            <?php
                                            $t = $k + 1;
                                            ?>
                                            <li>
                                                    <a href="/search/jobs?time_{{ $t }}=1,2,3,4,5,6,7">{{ $time }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- ONE CATEGORY END -->

                            <!-- ONE CATEGORY START -->
                            <div class="col-12 py-2 filter-group">
                                @if(isset($getData['sizes']))
                                    <a href="javascript:void(0)"
                                       class="cardinal_links remove-all-filter"
                                       data-filter="sizes"> <img
                                                src="{{ asset('img/round-delete-button.svg') }}"
                                                style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>
                                @endif
                                <a href="#" class="open_close_category cardinal_links">
                                    <span class="title_left_sorting"><strong>{!! trans('fields.label.business_size') !!}</strong></span>
                                    <span class="float-right plus_icon collapsed"></span>
                                </a>
                                <div class="content_category" style="display: none;">
                                    <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                        <?php
                                        $sizesData = (isset($getData['sizes'])) ? explode(",", $getData['sizes']) : [];
                                        ?>
                                        @foreach($sizes as $size)
                                            <li>
                                                    <a href="/search/jobs?sizes={{ $size['id'] }}">{{ $size['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- ONE CATEGORY END -->

                        </div>
                        <!-- CATEGORY SECTION END -->
                    </div>
                    <!-- /ADVANCED FILTER BLOCK -->
                    <!-- RIGHT SECTION START -->
                    <div class="px-0 results_section mxa-0" style="width: 71%; margin-left: 20px;">
                        <div class="col-12 py-2 mb-3 bg-white rounded d-flex flex-column flex-lg-row">
                            <div class="pt-2">{!! trans('main.label.displaying', [
                                'item' => getDisplayingTitle($type_items),
                                'start' => $start,
                                'end' => $end,
                                'count' => ($items->count) ?? 0
                                ]) !!}</div>
                            <div class="ml-auto d-flex flex-column-reverse flex-lg-row mxa-0">
                                <div class="d-flex mr-0 pt-1 ml-4 mxa-0">
                                                    <span class="pt-2 mr-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                                             version="1.1" id="Capa_1" x="0px" y="0px"
                                                             viewBox="0 0 417.138 417.138"
                                                             style="height:15px; opacity: 0.8;"
                                                             xml:space="preserve">
                                                        <g>
                                                            <g>
                                                                <path d="M153.289,333.271c9.35,0,17-7.65,17-17v-299.2c0-6.517-3.683-12.467-9.35-15.3c-5.667-2.833-12.75-2.267-17.85,1.7    l-111.067,83.3c-7.65,5.667-9.067,16.15-3.4,23.8c5.667,7.65,16.15,9.067,23.8,3.4l83.867-62.9v265.2    C136.289,325.621,143.939,333.271,153.289,333.271z"/>
                                                                <path d="M263.789,86.771c-9.35,0-17,7.65-17,17v296.367c0,6.517,3.683,12.183,9.35,15.3c2.55,1.133,5.1,1.7,7.65,1.7    c3.683,0,7.083-1.133,10.2-3.4l111.067-81.883c7.65-5.667,9.067-16.15,3.683-23.8c-5.667-7.65-16.15-9.067-23.8-3.683    l-84.15,62.05v-262.65C280.789,94.421,273.139,86.771,263.789,86.771z"/>
                                                            </g>
                                                        </g>
                                                        </svg>
                                                    </span>
                                    <select class="border-0 bg-white form-control form-control-sm"
                                            id="items-sort">
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
                                <div class="pt-1 mr-2 mxa-0" id="page-limit-headquarters">
                                    <select class="border-0 bg-white form-control form-control-sm"
                                            id="items-limit">
                                        <option @if($limit == 25) selected @endif value="25">{!! trans('main.limit', ['count' => 25]) !!}
                                        </option>
                                        <option @if($limit == 50) selected @endif value="50">{!! trans('main.limit', ['count' => 50]) !!}
                                        </option>
                                        <option @if($limit == 100) selected @endif value="100">{!! trans('main.limit', ['count' => 100]) !!}
                                        </option>
                                        <option @if($limit == 200) selected @endif value="200">{!! trans('main.limit', ['count' => 200]) !!}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 px-0 bg-white rounded" id="items-list">
                            @if(isset($items->items) && count($items->items) == 0)
                                No results!
                            @else
                                @foreach($items->items as $item)
                                    {!! $item->html_career !!}
                                @endforeach
                            @endif
                        </div>

                        @if(isset($items->items) && $items->pages > 1)
                            <div class="col-12 mt-2 px-0">
                                <div class="py-2">
                                    <ul class="pagination justify-content-center mb-0" id="items-pagination">
                                        <li class="page-item">
                                            <a class="page-link" href="@if(isset($current_page) && $current_page !== 1) {!! request()->fullUrlWithQuery(['page' => $current_page - 1]) !!} @endif">{!! trans('main.buttons.previous') !!}</a>
                                        </li>
                                        @for($i = 1; $i <= $items->pages; ++$i)
                                            <li class="page-item @if(isset($current_page) && $current_page == $i) active @endif">
                                                <a
                                                    class="page-link"
                                                    href="{!! request()->fullUrlWithQuery(['page' => $i]) !!}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="@if(isset($current_page) && $current_page !== $items->pages) {!! request()->fullUrlWithQuery(['page' => $current_page + 1]) !!} @endif">{!! trans('main.buttons.next') !!}</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{!! request()->fullUrlWithQuery(['page' => $items->pages]) !!}">{!! trans('main.buttons.last') !!}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif

                    </div>
                    <!-- RIGHT SECTION END -->
                </div>
            </div>


@endif
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


    <div class="modal fade" id="modal-locations-list" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title">{!! trans('modals.title.in_this_building') !!}</h5>
                    <button type="button" class="close text-right" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
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
                        <button type="button" class="close text-right" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <p class="mb-0"><a href="#" id="all-locations">{!! trans('modals.text.see_all_locations') !!}</a></p>
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
                                    <span class="mb-0 pb-2" style="font-weight: 400;">{!! trans('main.buttons.view_location') !!}</span>
                                </a>
                            </div>

                        </div>
                    </div>


                    <div class="py-3">
                        <div class="row justify-content-center">
                            <div class="col-11 px-0">
                                <div class="d-flex flex-row justify-content-start text-center flex-wrap" id="amenities-list">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.jobmap.modal.questionnaire')
    @include('components.modal.share_career_page_modal')

@endsection
@section('script')
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyD3mcG8oAZzzlCSGZt5B4u5h5LmBX1SgjE"></script>
    <script src="{{ asset('/js/jobmap/app/CustomGoogleMapMarker.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/jobmap/app/job-map.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/jobmap/app/job-map-search.js?v='.time()) }}"></script>
    <script>
        $(document).ready(function () {
            Loader.init();
            var S = new JobMapSearch();
            app.scripts(S.init());
            app.run();
        });
    </script>
@endsection
