@extends('layouts.jobmap.second_business')

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
    <div id="location-view" style="margin-top: 55px;">

        <div class="text-center py-4" style="background-color: rgba(0,0,0,0.6); position: absolute; width: 100%; z-index: 1;">
             <p class="mb-0 text-center">
                 <a href="/map/world" id="link-location-world" class="text-white"
                    data-toggle="tooltip" data-placement="top" title="{!! trans('main.explore_the_world') !!}">{!! trans('main.world') !!}</a>
                 <span style="opacity: 0.2;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         version="1.1" id="Capa_1" x="0px" y="0px" width="13px" height="13px"
                         viewBox="0 0 292.359 292.359"
                         style="enable-background:new 0 0 292.359 292.359; vertical-align: middle; margin-top: -3px;"
                         xml:space="preserve">
                        <g>
                            <path d="M222.979,133.331L95.073,5.424C91.456,1.807,87.178,0,82.226,0c-4.952,0-9.233,1.807-12.85,5.424   c-3.617,3.617-5.424,7.898-5.424,12.847v255.813c0,4.948,1.807,9.232,5.424,12.847c3.621,3.617,7.902,5.428,12.85,5.428   c4.949,0,9.23-1.811,12.847-5.428l127.906-127.907c3.614-3.613,5.428-7.897,5.428-12.847   C228.407,141.229,226.594,136.948,222.979,133.331z"/>
                        </g>
                    </svg>
                </span>
                 <a href="/map/country/{{ $country }}" id="link-location-country"
                    class="text-white" data-toggle="tooltip" data-placement="top"
                    title="{!! trans('main.explore_country') !!}">{{ $country }}</a>
                 <span style="opacity: 0.2;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         version="1.1" id="Capa_1" x="0px" y="0px" width="13px" height="13px"
                         viewBox="0 0 292.359 292.359"
                         style="enable-background:new 0 0 292.359 292.359; vertical-align: middle; margin-top: -3px;"
                         xml:space="preserve">
                        <g>
                            <path d="M222.979,133.331L95.073,5.424C91.456,1.807,87.178,0,82.226,0c-4.952,0-9.233,1.807-12.85,5.424   c-3.617,3.617-5.424,7.898-5.424,12.847v255.813c0,4.948,1.807,9.232,5.424,12.847c3.621,3.617,7.902,5.428,12.85,5.428   c4.949,0,9.23-1.811,12.847-5.428l127.906-127.907c3.614-3.613,5.428-7.897,5.428-12.847   C228.407,141.229,226.594,136.948,222.979,133.331z"/>
                        </g>
                    </svg>
                </span>
                 <a href="/map/city/{{ $city }}/{{ $country }}" id="link-location-city"
                    class="text-white" data-toggle="tooltip" data-placement="top"
                    title="{!! trans('main.explore_city') !!}">{{ $city }}</a>
                <span style="opacity: 0.2;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         version="1.1" id="Capa_1" x="0px" y="0px" width="13px" height="13px"
                         viewBox="0 0 292.359 292.359"
                         style="enable-background:new 0 0 292.359 292.359; vertical-align: middle; margin-top: -3px;"
                         xml:space="preserve">
                        <g>
                            <path d="M222.979,133.331L95.073,5.424C91.456,1.807,87.178,0,82.226,0c-4.952,0-9.233,1.807-12.85,5.424   c-3.617,3.617-5.424,7.898-5.424,12.847v255.813c0,4.948,1.807,9.232,5.424,12.847c3.621,3.617,7.902,5.428,12.85,5.428   c4.949,0,9.23-1.811,12.847-5.428l127.906-127.907c3.614-3.613,5.428-7.897,5.428-12.847   C228.407,141.229,226.594,136.948,222.979,133.331z"/>
                        </g>
                    </svg>
                </span>
                 <a href="/map/street/{{ $street }}/{{ $city }}/{{ $country }}" id="link-location-street"
                    class="text-white" data-toggle="tooltip" data-placement="top"
                    title="{!! trans('main.explore_street') !!}">{{ $street }}</a>
            </p>
        </div>

        <div class="col-md-12" id="map" style="height: 400px;"></div>

        <div class="careerpage_businessname" style="background: rgba(0,0,0,0.3); width: 100%; height: 60px; margin-top: -59px; position: absolute;">
            <div class="container" style="position: relative;">
                <div class="d-flex justify-content-between flex-lg-row flex-column pt-2">
                    <div class="d-flex flex-lg-row flex-column col-lg-9 col-12 mx-auto">
                        



                        <p class="mb-0 align-self-center mxa-0 text-white business_name_color" id="job_title" style="font-size: 30px;">
                            {{ $street . ', ' . $city . ', ' . $country }}
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

        <div class="w-100 bg-white border-left-0 border-right-0 border">
            <div class="container">
                <div class="col-12 px-0">
                    <div class="d-flex flex-lg-row flex-column justify-content-end">

                        <div class="col-lg-9 col-12 mx-auto d-flex flex-lg-row flex-column justify-content-between py-2">
                            
                             <div class="d-flex flex-sm-row flex-column justify-content-between justify-content-lg-start w-100">
                                 <div class="text-center py-3 mxa-0 mr-5">
                                     <div class="mb-3 mb-lg-0">
                                         <a href="{{ $main_link }}?type=employers" class="business_tabs active mxa-0">
                                             <span id="job-count">{!! trans('main.counters.employers_c', ['count' => $data->count_employers]) !!}</span>
                                         </a>
                                     </div>
                                 </div>
                                 <div class="text-center py-3 mxa-0 mr-5">
                                     <div class="mb-3 mb-lg-0">
                                         <a href="{{ $main_link }}?type=jobs" class="business_tabs mxa-0">
                                             <span id="location-count">{!! trans('main.counters.jobs_c', ['count' => $data->count_jobs]) !!}</span>
                                         </a>
                                     </div>
                                 </div>
                                 <div class="text-center py-3 mxa-0 mr-5">
                                     <div class="mb-3 mb-lg-0">
                                         <a href="{{ $main_link }}?type=headquarters" class="business_tabs mxa-0">
                                             <span id="location-count">{!! trans('main.counters.headquarters_c', ['count' => $data->count_headquarters]) !!}</span>
                                         </a>
                                     </div>
                                 </div>
                                 <div class="text-center py-3 mxa-0">
                                     <div class="mb-3 mb-lg-0">
                                         <a href="{{ $main_link }}?type=locations" class="business_tabs mxa-0">
                                             <span id="location-count">{!! trans('main.counters.branches_c', ['count' => $data->count_locations]) !!}</span>
                                         </a>
                                     </div>
                                 </div>
                            <!-- <div class="align-self-center ml-5 mxa-0">
                                <p class="mb-0 text-center"><small>Want to apply here?</small></p>
                                <button class="btn btn-success border-0 send-resume w-100 mb-3 mb-lg-0"
                                        id="animate_hover" data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="Apply to this job." style="white-space: nowrap;">
                                    <span class="mb-0 pb-2" style="font-weight: 400;">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 426.667 426.667" style="enable-background:new 0 0 426.667 426.667; fill:#fff; vertical-align: middle; margin-top: -3px;" xml:space="preserve" class="mr-2" widht="20px" height="20px">
                                            <g>
                                                <g>
                                                    <path d="M384,96h-85.333V53.333c0-23.573-19.093-42.667-42.667-42.667h-85.333C147.093,10.667,128,29.76,128,53.333V96H42.667    c-23.573,0-42.453,19.093-42.453,42.667L0,373.333C0,396.907,19.093,416,42.667,416H384c23.573,0,42.667-19.093,42.667-42.667    V138.667C426.667,115.093,407.573,96,384,96z M256,96h-85.333V53.333H256V96z"/>
                                                </g>
                                            </g>
                                        </svg>

                                        I'm Interested
                                    </span>
                                </button>
                            </div> -->
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="col-12 px-0 mb-3">
                <div class="d-flex flex-lg-row flex-column mt-3">
                    <!-- <div class="mr-5 col-lg-3 col-12 px-0 mt-3">
                        <div class="text-left py-2 pb-4 title_left_sorting rounded mt-3" style="font-size: 14px;">                          
                        </div>
                    </div> -->
                    <div class="col-lg-9 col-12 mx-auto">
                        @include('common.jobmap.job.by_location_page_items')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyD3mcG8oAZzzlCSGZt5B4u5h5LmBX1SgjE"></script>
    <script src="{{ asset('/js/jobmap/app/job-map-location-view.js?v='.time()) }}"></script>
    <script>
        $(document).ready(function () {
            Loader.init();
            var View = new LocationView('{!! $r !!}', '{{ $type_items }}');
            View.setAssignLocations({!! json_encode($items) !!});
            app.scripts(View.init());
            app.run();
        });
    </script>
@endsection
