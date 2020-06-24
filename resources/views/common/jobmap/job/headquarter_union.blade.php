@extends('layouts.jobmap.second_business')

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
    <div id="location-view" style="margin-top: 55px;">

        <div class="business_background_img"
             style="height: 400px; background-size: cover; background:url('https://i.ytimg.com/vi/M1msXMurNCM/maxresdefault.jpg'); background-size: cover; background-position: center center;"></div>

        <div class="careerpage_businessname"
             style="background: rgba(0,0,0,0.3); width: 100%; height: 60px; margin-top: -59px; position: absolute;">
            <div class="container" style="position: relative;">
                <div class="d-flex justify-content-between flex-lg-row flex-column pt-2">
                    <div class="d-flex flex-lg-row flex-column">
                        <div class="pxa-0 mxa-0 text-center text-md-left align-self-center bg-white mr-3 careerpage_businessname"
                             style="margin-top: -34px; position: absolute;">
                            <img class="location-icon rounded careerpage_icon wow animated fadeInDown"
                                 src="" style="width: 200px; border:5px solid #fff;">
                        </div>
                        <p class="mb-0 align-self-center mxa-0 text-white business_name_color" id="job_title"
                           style="font-size: 30px; margin-left: 215px;">
                           data->category_name
                        </p>
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

        <div class="container">
            <div class="col-12 px-0 mb-3">
                <div class="d-flex flex-lg-row flex-column mt-3">
                    <div class="col-lg-9 col-12 mx-auto">


                        <div class="col-12 bg-white mt-5 result_shadow" style="border-radius: 10px;">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="col-12 px-0">

                                        <div class="title_left_sorting text-left d-flex flex-column flex-lg-row py-3">
                                            <div class="d-flex col-12 pl-0 col-lg-4 pxa-0 justify-content-between mb-3 mb-lg-0"
                                                 style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;">
                                                <input type="text" class="form-control w-100 border-0"
                                                       style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;"
                                                       placeholder="{!! trans('fields.placeholder.find') !!}"  id="items-search" value="">
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

                                        </div>

                                        <div class="row text-left" id="items-list">


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


@endsection
@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyD3mcG8oAZzzlCSGZt5B4u5h5LmBX1SgjE"></script>
    <script src="{{ asset('/js/jobmap/app/CustomGoogleMapMarker.js?v='.time()) }}"></script>

@endsection
