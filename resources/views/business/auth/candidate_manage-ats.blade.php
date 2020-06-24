@extends('layouts.main_business')

@section('content')
    <style type="text/css">
        .addto:hover {
            background-color: #f7f7f7;
            transition: 0.5s;
            box-shadow: 0 5px 23px rgba(0, 0, 0, 0.3);
        }

        .addto {
            background-color: #fff;
            transition: 0.5s;
        }

        .filtersvg {
            height: 18px;
            cursor: pointer;
            opacity: 0.2;
        }

        .jobsvg, .managersvg {
            fill: #0275d8;
            width: 25px;
            height: 30px;
            cursor: pointer;
        }

        .leftmodalsorting:hover {
            border-bottom: 2px solid #4266ff;
            padding-bottom: 2px;
        }

        .addnewlocationsvg {
            width: 40px;
            height: 40px;
            fill: #0275d8;
            transition: all .2s ease-in-out;
        }

        .perpage:hover .filtersvg {
            opacity: 1;
        }

        .perpage:hover {
            border-bottom: 2px solid #4266ff;
            padding-bottom: 8px;
            fill: #0275d8;
        }

        .addnewbutton:hover svg polygon {
            fill: #fff;
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
            opacity: 0.3;
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

    <div class="container-fluid">
        <div class="row">
            <!-- left menu begin -->
            <div id="slide-out" class="col-3 pl-0 sidebar_adaptive">
                @include('components.sidebar.sidebar_business')
            </div>
            <!-- left menu eof -->

            <!-- content block begin-->
            <div class="col-xl-8 col-11 mx-auto pb-5 mt-1 card border-0 content-main">
                <div class="row">

                    <div class="col-md-12 py-2 text-center">
                        <div class="row">
                            <div class="d-flex w-100 pr-3 justify-content-between">
                                <div class="pl-3">
                                    <button data-toggle="modal" data-target="#import-ats"
                                            class="btn btn-outline-success w-100 addnewbutton" type="button">
                                        <svg id="Layer_1" width="25px" height="25px"
                                             style="enable-background:new 0 0 512 512; float: left; margin-right: 5px;"
                                             version="1.1" viewBox="0 0 512 512" xml:space="preserve"
                                             xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"><g>
                                                <g>
                                                    <g>
                                                        <path d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"
                                                              fill="#27cfc3"></path>
                                                    </g>
                                                </g>
                                                <g>
                                                    <polygon
                                                            points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7 384,247.9 264.1,247.9"
                                                            fill="#27cfc3"></polygon>
                                                </g>
                                            </g>
                                        </svg>
                                        <!-- </span> -->
                                        <span class="mb-0">
                                            {!! trans('main.buttons.import_ats_list') !!}
                                        </span>
                                    </button>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-md-12 rounded-0 border-bottom-0 border-right-0 border-left-0">
                        <div class="row">
                            <div class="col-md-12 rounded-0">
                                <div class="row">


                                    <div class="col-md-12 pb-2">
                                        <div class="row">


                                            <div class="align-items-center">
                                                <div class="d-flex lead mb-0 pl-3 pb-2 pt-2 mt-1 title_left_sorting">
                                                    <span class="mb-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            version="1.1" id="Capa_1" x="0px" y="0px"
                                                                            viewBox="0 0 954.4 954.4"
                                                                            style="enable-background:new 0 0 512 512; vertical-align: middle;"
                                                                            xml:space="preserve" width="20px"
                                                                            height="20px">
                                                        <g>
                                                            <g>
                                                                <path d="M406.301,70.8h309.3c13.5,0,24.5-11,24.5-24.5v-0.5c0-13.5-11-24.5-24.5-24.5h-309.3c-13.5,0-24.5,11-24.5,24.5v0.5    C381.7,59.8,392.7,70.8,406.301,70.8z"/>
                                                                <path d="M381.7,140.2c0,13.5,11,24.5,24.5,24.5h416c13.5,0,24.5-11,24.5-24.5v-0.5c0-13.5-11-24.5-24.5-24.5h-416    c-13.5,0-24.5,11-24.5,24.5V140.2L381.7,140.2z"/>
                                                                <path d="M381.7,234c0,13.5,11,24.5,24.5,24.5h416c13.5,0,24.5-11,24.5-24.5v-0.5c0-13.5-11-24.5-24.5-24.5h-416    c-13.5,0-24.5,11-24.5,24.5V234L381.7,234z"/>
                                                                <path d="M381.7,375.2c0,13.5,11,24.5,24.5,24.5h309.3c13.5,0,24.5-11,24.5-24.5v-0.5c0-13.5-11-24.5-24.5-24.5H406.301    c-13.5,0-24.5,11-24.5,24.5L381.7,375.2L381.7,375.2z"/>
                                                                <path d="M381.7,469.101c0,13.5,11,24.5,24.5,24.5h223.5c13.5,0,24.5-11,24.5-24.5v-0.5c0-13.5-11-24.5-24.5-24.5H406.301    c-13.5,0-24.5,11-24.5,24.5L381.7,469.101L381.7,469.101z"/>
                                                                <path d="M381.7,562.9c0,13.5,11,24.5,24.5,24.5h416c13.5,0,24.5-11,24.5-24.5v-0.5c0-13.5-11-24.5-24.5-24.5h-416    c-13.5,0-24.5,11-24.5,24.5V562.9L381.7,562.9z"/>
                                                                <path d="M381.7,723.5c0,13.2,10.7,23.8,23.8,23.8h403.9c13.2,0,23.8-10.699,23.8-23.8V723c0-13.2-10.7-23.8-23.8-23.8H405.5    c-13.199,0-23.8,10.7-23.8,23.8V723.5L381.7,723.5z"/>
                                                                <path d="M381.7,814.7c0,13.2,10.7,23.8,23.8,23.8h350.301c13.199,0,23.8-10.7,23.8-23.8v-0.5c0-13.2-10.7-23.8-23.8-23.8H405.5    c-13.199,0-23.8,10.7-23.8,23.8V814.7L381.7,814.7z"/>
                                                                <path d="M381.7,905.8c0,13.2,10.7,23.801,23.8,23.801h159.9c13.2,0,23.8-10.7,23.8-23.801v-0.5c0-13.199-10.7-23.8-23.8-23.8    H405.5c-13.199,0-23.8,10.7-23.8,23.8V905.8L381.7,905.8z"/>
                                                                <path d="M108,154.5v125.4h198.6V154.5c0-10.4-9.101-18.9-20.3-18.9H263.7c-4,0-7.7,1.8-10,4.8l-33.3,43.7l-8.1-15.8l12.9-25.3    c1.8-3.5-0.9-7.5-5.1-7.5h-25.9c-4.1,0-6.8,4-5.1,7.5l12.9,25.3l-8,15.6l-32.2-43.4c-2.3-3.1-6.1-4.9-10.1-4.9H128    C117.101,135.6,108,144,108,154.5z"/>
                                                                <path d="M207.3,121.6c33.5,0,60.8-27.3,60.8-60.8S240.8,0,207.3,0s-60.8,27.2-60.8,60.8C146.5,94.3,173.8,121.6,207.3,121.6z"/>
                                                                <path d="M108,608.8h198.6V483.4c0-10.4-9.101-18.9-20.3-18.9H263.7c-4,0-7.7,1.8-10,4.8L220.4,513l-8.1-15.8l12.9-25.3    c1.8-3.5-0.9-7.5-5.1-7.5h-25.9c-4.1,0-6.8,4-5.1,7.5l12.9,25.3l-8,15.6L161.8,469.4c-2.3-3.101-6.1-4.9-10.1-4.9H128    c-11.2,0-20.3,8.5-20.3,18.9L108,608.8L108,608.8z"/>
                                                                <path d="M146.5,389.7c0,33.5,27.3,60.8,60.8,60.8s60.8-27.3,60.8-60.8s-27.3-60.8-60.8-60.8S146.5,356.1,146.5,389.7z"/>
                                                                <path d="M306.601,829c0-10.399-9.101-18.899-20.3-18.899H263.7c-4,0-7.7,1.8-10,4.8l-33.3,43.7l-8.1-15.801l12.9-25.3    c1.8-3.5-0.9-7.5-5.1-7.5h-25.9c-4.1,0-6.8,4-5.1,7.5l12.9,25.3l-8,15.601L161.8,815c-2.3-3.1-6.1-4.899-10.1-4.899H128    c-11.2,0-20.3,8.5-20.3,18.899v125.4h198.601L306.601,829L306.601,829z"/>
                                                                <path d="M146.5,735.3c0,33.5,27.3,60.801,60.8,60.801s60.8-27.301,60.8-60.801s-27.3-60.8-60.8-60.8S146.5,701.7,146.5,735.3z"/>
                                                            </g>
                                                        </g>
                                                        </svg>
                                                    </span>
                                                    <strong>
                                                        {!! trans('pages.text.import.pending_candidates') !!}
                                                    </strong>
                                                    <span style="font-size: 14px; background: rgba(0, 0, 0, 0.05);" class="js-count rounded px-1 ml-2"></span>
                                                </div>
                                            </div>

                                            <div class="d-flex ml-auto">
                                                <div class="row mr-3 pt-1">
                                                    <div class="text-center pt-2 mt-1 pr-0 pr-2 js-orderDirection" data-val="DESC">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 version="1.1" id="Capa_1" x="0px" y="0px"
                                                                 viewBox="0 0 417.138 417.138"
                                                                 style="height:21px; opacity: 0.8;" xml:space="preserve"
                                                                 fill="#4E5C6E">
                                                            <g>
                                                                <g>
                                                                    <path d="M153.289,333.271c9.35,0,17-7.65,17-17v-299.2c0-6.517-3.683-12.467-9.35-15.3c-5.667-2.833-12.75-2.267-17.85,1.7    l-111.067,83.3c-7.65,5.667-9.067,16.15-3.4,23.8c5.667,7.65,16.15,9.067,23.8,3.4l83.867-62.9v265.2    C136.289,325.621,143.939,333.271,153.289,333.271z"/>
                                                                    <path d="M263.789,86.771c-9.35,0-17,7.65-17,17v296.367c0,6.517,3.683,12.183,9.35,15.3c2.55,1.133,5.1,1.7,7.65,1.7    c3.683,0,7.083-1.133,10.2-3.4l111.067-81.883c7.65-5.667,9.067-16.15,3.683-23.8c-5.667-7.65-16.15-9.067-23.8-3.683    l-84.15,62.05v-262.65C280.789,94.421,273.139,86.771,263.789,86.771z"/>
                                                                </g>
                                                            </g>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="pt-2 pl-0">
                                                        <select name="order" class="form-control form-control-sm border-0 js-orderAts bg-white">
                                                            <option value="name">{{ trans('pages.name') }}</option>
                                                            <option value="date" selected>{{ trans('pages.added_date_asc') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="d-flex col-12 pl-0 col-lg-4 pxa-0 justify-content-between ml-3 mxa-0" style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;">
                                <input type="text" class="form-control border-0 ml-2"
                                       placeholder="{!! trans('fields.placeholder.import_ats_search') !!}" id="business-job-search">
                                <div class="align-self-center mr-3 mr-lg-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 250.313 250.313" style="enable-background:new 0 0 250.313 250.313; opacity: 0.1;" xml:space="preserve" widht="17px" height="17px">
                                        <g id="Search">
                                            <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M244.186,214.604l-54.379-54.378c-0.289-0.289-0.628-0.491-0.93-0.76   c10.7-16.231,16.945-35.66,16.945-56.554C205.822,46.075,159.747,0,102.911,0S0,46.075,0,102.911   c0,56.835,46.074,102.911,102.91,102.911c20.895,0,40.323-6.245,56.554-16.945c0.269,0.301,0.47,0.64,0.759,0.929l54.38,54.38   c8.169,8.168,21.413,8.168,29.583,0C252.354,236.017,252.354,222.773,244.186,214.604z M102.911,170.146   c-37.134,0-67.236-30.102-67.236-67.235c0-37.134,30.103-67.236,67.236-67.236c37.132,0,67.235,30.103,67.235,67.236   C170.146,140.044,140.043,170.146,102.911,170.146z"/>
                                        </g>
                                    </svg>
                                </div>
                            </div>

                            <div class="col-12 px-0 ">
                                <div class="js-atsItems">

                                </div>
                                <div class="card border-0 js-emptyAtsList d-none">
                                    <div class="card-header bg-white border-0 py-3" role="tab" id="heading2">
                                        <p class="text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                                 x="0px" y="0px" viewBox="0 0 496.486 496.486"
                                                 style="enable-background:new 0 0 496.486 496.486; opacity: 0.2;"
                                                 xml:space="preserve" width="40px" height="40px" fill="#4E5C6E">
                                            <g>
                                                <g>
                                                    <path d="M349.12,249.785c-1.029-0.99-2.124-1.91-3.276-2.754c-13.03-8.6-30.296-6.934-41.44,4l-2.08,2.08    c-4.382,4.398-8.101,9.411-11.04,14.88l-11.04,20.48V34.232c0.634-16.247-10.62-30.552-26.56-33.76    c-17.416-3.006-33.971,8.675-36.977,26.09c-0.337,1.951-0.492,3.93-0.463,5.91v256l-16-28.64l-10.08-10.08    c-12.492-12.501-32.753-12.509-45.255-0.017c-0.621,0.621-1.217,1.267-1.785,1.937c-10.731,13.47-9.413,32.903,3.04,44.8    l78.56,78.56c12.49,12.504,32.751,12.515,45.255,0.025c0.008-0.008,0.017-0.017,0.025-0.025l80-80    C362.254,282.293,361.858,262.036,349.12,249.785z"/>
                                                </g>
                                            </g>
                                                        <g>
                                                            <g>
                                                                <path d="M488.244,416.472v-192c0,0,0-1.28,0-1.92c-3.04-48-30.88-75.84-80-77.92h-78.72c-17.673,0-32,14.327-32,32    c0,17.673,14.327,32,32,32h77.28c13.6,0,16,1.92,17.44,17.12v189.28c0,12.16-3.04,16-17.12,17.44H89.364    c-14.88-1.12-16-4.64-17.12-16v-190.56c0-17.44,5.44-17.44,16-17.44h80c17.673,0,32-14.327,32-32s-14.327-32-32-32h-80    c-48,0-77.92,30.08-80,80v193.28c-1.245,42.22,31.972,77.456,74.193,78.701c1.242,0.037,2.485,0.043,3.727,0.019h324.16    c42.945,0.106,77.846-34.622,77.952-77.568C488.278,418.093,488.267,417.282,488.244,416.472z"/>
                                                            </g>
                                                        </g>
                                            </svg>
                                        </p>
                                        <h5 class="mb-0 mt-0 text-center title_left_sorting">
                                            <strong>{!! trans('pages.errors.import') !!}</strong>
                                        </h5>
                                        <p class="text-center">{!! trans('pages.text.import.hint') !!}</p>
                                    </div>
                                </div>
                                <!-- NO ATS -->

                            </div>
                        </div>
                    </div>
                </div>
                <!--pipeline MODAL!!!!!!!!!!!!!!! -->
                <div class="modal fade" id="pipeline" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body pb-3">
                                <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <p class="h6 text-center px-3">{!! trans('modals.title.button_ask_update') !!}</p>

                                <h2 class="text-center text-success">{!! trans('modals.text.button_ask_update') !!}</h2>
                                <div class="col-md-6 mx-auto">
                                    <button class="btn btn-success btn-block" data-dismiss="modal">{!! trans('main.buttons.ok') !!}</button>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- pipeline MODAL END!!!!!!!!!!!!!!! -->

                <!--Import ATS MODAL!!!!!!!!!!!!!!! -->
                <div class="modal fade" id="import-ats" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="max-width: 600px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0 pt-0">{!! trans('modals.title.import_ats_list') !!}</h5>
                                <button type="button" class="close pt-0 mt-0" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pb-3">
                                <p class="text-center">{!! trans('modals.text.import_ats_list') !!}</p>
                                <div class="col-md-8 mx-auto mt-3">
                                    <button type="button" class="btn btn-success btn-block js-uploadFile">{!! trans('main.buttons.select_import_file') !!}</button>
                                </div>
                                <div class="js-statusUpload">

                                </div>


                                <!-- SUCCESSFULY -->
                                <div class="col-md-10 mx-auto mt-3 d-none js-success-import">
                                    <p class="text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1"
                                             x="0px" y="0px" viewBox="0 0 406.834 406.834"
                                             style="enable-background:new 0 0 406.834 406.834;" xml:space="preserve"
                                             width="40px" height="40px" fill="#06d036">
                                             <polygon
                                                     points="385.621,62.507 146.225,301.901 21.213,176.891 0,198.104 146.225,344.327 406.834,83.72 "></polygon>
                                        </svg>
                                    </p>
                                    <p class="text-center h6"><strong><span class="js-countApplicants"></span>
                                            {!! trans('modals.text.import_ats_list_1') !!}</strong></p>
                                    <p class="text-center">{!! trans('modals.text.import_ats_list_2') !!}</p>
                                    <button class="btn btn-success btn-block "
                                            data-dismiss="modal">{!! trans('main.buttons.done') !!}
                                    </button>
                                </div>
                                <!-- SUCCESSFULY -->
                            </div>

                        </div>

                    </div>

                </div>
                <form action="" id="ats_upload" class="js-formSubmit" method="post" enctype="multipart/form-data">
                    <input type="file" id="ats_files" class="js-fileInput" style="opacity: 0; " multiple name="ats[]"
                           accept=".csv, .xls, .xlsx"/>
                </form>
                <!-- Imporst ATS MODAL END!!!!!!!!!!!!!!! -->
            </div>
        </div>
        @include('components.modal.add_candidate')
    </div>
@endsection

@section('script')
    <script src="{{ asset('/js/app/business-ats.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/business-applicants.js?v='.time()) }}"></script>
@endsection