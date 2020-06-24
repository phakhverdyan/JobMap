@extends('layouts.main_business')

@section('content')
    <style type="text/css">
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

        .addnewlocationsvg {
            width: 40px;
            height: 40px;
            fill: #0275d8;
            transition: all .2s ease-in-out;
        }

        .perpage:hover .filtersvg {
            opacity: 1;
        }

        .blockorlist:hover .filtersvg {
            opacity: 1;
        }

        .addnewbutton:hover svg polygon {
            fill: #fff;
        }

        #ManaInLocModal .modal-lg{
            max-width: 1024px;
        }

        button.button-assign{
            width: 150px;
            display: inline-block;
            margin-top: 25px!important;
            margin-left: 25px;
            margin-bottom: 15px;
        }
        .button-assign-block{
            text-align: right;
        }
        .table-button-assign{
            width: 40px;
            display: inline-block;
            margin-top: 15px!important;
            margin-bottom: 15px;
            margin-left: 15px;
        }

        .table th, .table td{
            border-top: none!important;
        }

    </style>
    <div class="container-fluid">
        <form id="business-job-form" autocomplete="off">
            <div class="row">
                <!-- left menu begin -->
                <div id="slide-out" class="col-3- pl-0- sidebar_adaptive">
                    @include('components.sidebar.sidebar_business')
                </div>
                <!-- left menu eof -->

                <!-- content block begin-->
                <div class="col-xl-8 col-11 mx-auto pb-5 mt-3 bg-white rounded content-main">
                    <div class="row">
                        <div class="col-md-12 mx-auto px-0">
                            <div class="row px-3">
                                <div class="col-md-12 px-0">

                                    <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                                        @if (is_permit_administrator(['jobs']))
                                            <div class="pl-3 py-2">
                                                <a href="{!! url('/business/job/add') !!}"
                                                   class="btn btn-outline-success w-100 addnewbutton"
                                                   style="cursor:pointer;">
                                                    <!-- <span class="mb-0 mr-2" style="float: left; height: 25px;"> -->
                                                    <svg id="Layer_1" width="25px" height="25px"
                                                         style="enable-background:new 0 0 512 512; float: left; margin-right: 5px;"
                                                         version="1.1" viewBox="0 0 512 512" xml:space="preserve"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink"><g>
                                                            <g>
                                                                <g>
                                                                    <path d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"></path>
                                                                </g>
                                                            </g>
                                                            <g>
                                                                <polygon
                                                                        points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7 384,247.9 264.1,247.9"
                                                                        fill="#27cfc3"></polygon>
                                                            </g>
                                                        </g></svg>
                                                    <!-- </span> -->
                                                    <span class="mb-0" style="line-height: 1.6rem;">
                                                        {!! trans('main.buttons.add_job') !!}
                                                    </span>
                                                </a>
                                            </div>
                                        @endif

                                        <div class="d-flex ml-auto">
                                            <div class="d-flex mr-0 pt-1">
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
                                                <select class="border-0 form-control form-control-sm bg-white"
                                                        id="business-job-sort">
                                                    <option value="title"
                                                            data-order="asc">{!! trans('main.sort.title_az') !!}</option>
                                                    <option value="title"
                                                            data-order="desc">{!! trans('main.sort.title_za') !!}</option>
                                                    <option value="created_date"
                                                            data-order="asc">{!! trans('main.sort.c_date_oldest') !!}
                                                    </option>
                                                    <option value="created_date"
                                                            data-order="desc">{!! trans('main.sort.c_date_newest') !!}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="pt-1 mx-2" id="page-limit-headquarters">
                                                <select class="border-0 form-control form-control-sm bg-white"
                                                        id="business-job-limit">
                                                    <option value="25">{!! trans('main.limit', ['count' => 25]) !!}</option>
                                                    <option value="50">{!! trans('main.limit', ['count' => 50]) !!}</option>
                                                    <option value="100">{!! trans('main.limit', ['count' => 100]) !!}</option>
                                                    <option value="200">{!! trans('main.limit', ['count' => 200]) !!}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="d-flex flex-lg-row flex-column justify-content-start" role="group"
                                     aria-label="Basic example">

                                    <div class="d-flex col-12 pl-0 col-lg-4 pxa-0 justify-content-between mb-3 mb-lg-0"
                                         style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;">
                                        <input type="text" class="form-control border-0 ml-2"
                                               style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;"
                                               placeholder="{!! trans('fields.placeholder.cr_jobs_search') !!}"
                                               id="business-job-search">
                                        <div class="align-self-center mr-3 mr-lg-0">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                                 x="0px" y="0px" viewBox="0 0 250.313 250.313"
                                                 style="enable-background:new 0 0 250.313 250.313; opacity: 0.1;"
                                                 xml:space="preserve" widht="17px" height="17px">
                                                <g id="Search">
                                                    <path style="fill-rule:evenodd;clip-rule:evenodd;"
                                                          d="M244.186,214.604l-54.379-54.378c-0.289-0.289-0.628-0.491-0.93-0.76   c10.7-16.231,16.945-35.66,16.945-56.554C205.822,46.075,159.747,0,102.911,0S0,46.075,0,102.911   c0,56.835,46.074,102.911,102.91,102.911c20.895,0,40.323-6.245,56.554-16.945c0.269,0.301,0.47,0.64,0.759,0.929l54.38,54.38   c8.169,8.168,21.413,8.168,29.583,0C252.354,236.017,252.354,222.773,244.186,214.604z M102.911,170.146   c-37.134,0-67.236-30.102-67.236-67.235c0-37.134,30.103-67.236,67.236-67.236c37.132,0,67.235,30.103,67.235,67.236   C170.146,140.044,140.043,170.146,102.911,170.146z"/>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="d-inline-flex ml-3 mxa-0">
                                        <button class="btn btn-outline-primary rounded d-flex" type="button"
                                                aria-expanded="false" data-toggle="modal" data-target="#jobfiltermodal"
                                                id="filters-modal"
                                                style="background-color: #fff; border:1px solid #4266ff; color:#4266ff;">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1"
                                                 x="0px"
                                                 y="0px" viewBox="0 0 511.999 511.999" xml:space="preserve"
                                                 height="20px" style="fill:#4266ff;" class="mr-2 align-self-center">
                                                <path d="M510.078,35.509c-3.388-7.304-10.709-11.977-18.761-11.977H20.682c-8.051,0-15.372,4.672-18.761,11.977    s-2.23,15.911,2.969,22.06l183.364,216.828v146.324c0,7.833,4.426,14.995,11.433,18.499l94.127,47.063    c2.919,1.46,6.088,2.183,9.249,2.183c3.782,0,7.552-1.036,10.874-3.089c6.097-3.769,9.809-10.426,9.809-17.594V274.397    L507.11,57.569C512.309,51.42,513.466,42.813,510.078,35.509z M287.27,253.469c-3.157,3.734-4.889,8.466-4.889,13.355V434.32    l-52.763-26.381V266.825c0-4.89-1.733-9.621-4.89-13.355L65.259,64.896h381.482L287.27,253.469z"/>
                                            </svg>
                                            {!! trans('main.buttons.filters') !!}
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <table class="table table-responsive display responsive no-wrap" id="datatable-list-jobs" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>

                            <div id="accordion" class="business-job-list" role="tablist">

                            </div>
                        </div>
                        <!-- content block eof -->

                    </div>
                    <div class="mx-auto mt-2">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-content">

                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- MODAL WINDOWS -->
                <!-- LOCATION FILTER MODAL!!!!!!!!!!!!!!! -->
                <div class="modal fade" id="JobModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header pt-0">
                                <h5 class="modal-title" id="exampleModalLabel">Filter jobs by location</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pb-5">
                                <input class="form-control" type="text" name="" placeholder="Type a job title"  autocomplete="off"/>

                                <div class="row py-3">
                                    <!-- one item begin -->
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-1 pt-3">
                                                <label class="custom-control custom-checkbox m-0 pl-3">
                                                    <input type="checkbox" class="custom-control-input">
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-8  pl-0">
                                                <p class="mt-3 coll_name"><strong>Location</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- one item eof -->
                                </div>

                            </div>

                            <div class="row pb-2 px-3">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-outline-primary btn-block" data-dismiss="modal"
                                            role="button">Clear
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary btn-block" role="button">Set</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- LOCATION FILTER MODAL END!!!!!!!!!!!!!!! -->


                <!-- Quick apply job MODAL!!!!!!!!!!!!!!! -->
                <div class="modal fade" id="ManaInLocModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header pt-0">
                                <h5 class="modal-title"
                                    id="exampleModalLabel">{!! trans('modals.title.quick_jobs_to_locations') !!}</h5>
                                <button type="button" class="close mt-0" data-dismiss="modal"
                                        aria-label="{!! trans('main.buttons.close') !!}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pb-5  assign-panel">
                                <div class="row">
{{--                                    <div class="col-md-6 col-sm-6 col-lg-6" style="padding: 25px 0 25px 15px;">--}}
{{--                                        <div class="d-flex flex-lg-row flex-column justify-content-start" role="group" aria-label="Basic example">--}}
{{--                                            <div class="d-flex col-12 pl-0 col-lg-12 pxa-0 justify-content-between mb-3 mb-lg-0"--}}
{{--                                                 style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;">--}}
{{--                                                <input type="text" class="form-control border-0 ml-2"--}}
{{--                                                       style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;"--}}
{{--                                                       placeholder="{!! trans('fields.placeholder.cr_locations_search') !!}"--}}
{{--                                                       id="table-brand-location-search"  autocomplete="off">--}}
{{--                                                <div class="align-self-center mr-3 mr-lg-0">--}}
{{--                                                    <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                         xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"--}}
{{--                                                         x="0px" y="0px" viewBox="0 0 250.313 250.313"--}}
{{--                                                         style="enable-background:new 0 0 250.313 250.313; opacity: 0.1;"--}}
{{--                                                         xml:space="preserve" widht="17px" height="17px">--}}
{{--                                                <g id="Search">--}}
{{--                                                    <path style="fill-rule:evenodd;clip-rule:evenodd;"--}}
{{--                                                          d="M244.186,214.604l-54.379-54.378c-0.289-0.289-0.628-0.491-0.93-0.76   c10.7-16.231,16.945-35.66,16.945-56.554C205.822,46.075,159.747,0,102.911,0S0,46.075,0,102.911   c0,56.835,46.074,102.911,102.91,102.911c20.895,0,40.323-6.245,56.554-16.945c0.269,0.301,0.47,0.64,0.759,0.929l54.38,54.38   c8.169,8.168,21.413,8.168,29.583,0C252.354,236.017,252.354,222.773,244.186,214.604z M102.911,170.146   c-37.134,0-67.236-30.102-67.236-67.235c0-37.134,30.103-67.236,67.236-67.236c37.132,0,67.235,30.103,67.235,67.236   C170.146,140.044,140.043,170.146,102.911,170.146z"/>--}}
{{--                                                </g>--}}
{{--                                            </svg>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-12 col-lg-12 col-sm-12 button-assign-block">--}}
{{--                                        <button type="button" class="btn btn-success btn-block assign-all button-assign assign-current-brand" role="button">--}}
{{--                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>--}}
{{--                                            {!! trans('main.buttons.assign_all') !!}--}}
{{--                                        </button>--}}
{{--                                        <button type="button" class="btn btn-primary btn-block unassign-all button-assign unassign-current-brand" role="button">--}}
{{--                                            <i class="fa fa-square-o" aria-hidden="true"></i>--}}
{{--                                            {!! trans('main.buttons.unassign_all') !!}--}}
{{--                                        </button>--}}
{{--                                    </div>--}}

                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <h4 class="dataTable-header">{!! trans('main.header_step_selected_brand') !!}</h4>
                                        <table class="table table-responsive display responsive no-wrap" id="business-table" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
{{--                                    <div id="location-table-desktop" class="col-md-7 d-sm-none d-md-none d-lg-block d-xl-block">--}}
{{--                                        <table class="table details-table display responsive no-wrap" style="width: 100%;" id="location-table">--}}
{{--                                            <thead>--}}
{{--                                            <tr>--}}
{{--                                                <th scope="col"></th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
                                </div>
                            </div>

                            <div class="row pb-2 px-3">
                                <div class="col-lg-6 col-12">
                                    <button type="button" class="btn btn-outline-primary btn-block" data-dismiss="modal"
                                            role="button">{!! trans('main.buttons.clear') !!}
                                    </button>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <button type="button" class="btn btn-primary btn-block" role="button"
                                            id="business-job-location-set-new">{!! trans('main.buttons.set') !!}
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Quick apply job MODAL END!!!!!!!!!!!!!!! -->

            @include('components.modal.share_modal')

            <!-- OPEN | CLOSED LOCATIONS FILTER MODAL!!!!!!!!!!!!!!! -->
                <div class="modal fade" id="OpenClosedModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header pt-0">
                                <h5 class="modal-title"
                                    id="jobs-open-close-title">{!! trans('modals.title.job_opened_in') !!}</h5>
                                <button type="button" class="close mt-0" data-dismiss="modal"
                                        aria-label="{!! trans('main.buttons.close') !!}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pb-5">
                                <div class="row pb-3 pt-1 px-3">
                                    <div class="col-lg-6 col-12 pxa-0 pl-0">
                                        <button type="button" class="btn btn-primary btn-block"
                                                role="button" id="open-all">{!! trans('main.buttons.open_all') !!}
                                        </button>
                                    </div>
                                    <div class="col-lg-6 col-12 pxa-0 pr-0">
                                        <button type="button" class="btn btn-outline-primary btn-block" role="button"
                                                id="close-all">{!! trans('main.buttons.close_all') !!}
                                        </button>
                                    </div>
                                </div>

                                <div class="row py-3 card border rounded-0 border-top-0">
                                    <h5 class="pl-3 pb-2 open-header">{!! trans('modals.text.open') !!}</h5>

                                </div>

                                <div class="row py-3">
                                    <h5 class="pl-3 pb-2 close-header">{!! trans('modals.text.closed') !!}</h5>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- OPEN | CLOSED JOBS FILTER MODAL END!!!!!!!!!!!!!!! -->

            {{-- job share ##################################--}}

            <!-- OPEN | CLOSED LOCATIONS FILTER MODAL!!!!!!!!!!!!!!! -->
                <div class="modal fade" id="OpenClosedModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header pt-0">
                                <h5 class="modal-title"
                                    id="jobs-open-close-title">{!! trans('modals.title.job_opened_in') !!}</h5>
                                <button type="button" class="close mt-0" data-dismiss="modal"
                                        aria-label="{!! trans('main.buttons.close') !!}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pb-5">
                                {{--<input class="form-control" type="text" name=""--}}
                                {{--placeholder="Type a location by name or address" id="jobs-location-search"/>--}}
                                <div class="row pb-3 pt-1 px-3">
                                    <div class="col-lg-6 col-12 pxa-0 pl-0">
                                        <button type="button" class="btn btn-outline-primary btn-block"
                                                role="button" id="open-all">{!! trans('main.buttons.open_all') !!}
                                        </button>
                                    </div>
                                    <div class="col-lg-6 col-12 pxa-0 pr-0">
                                        <button type="button" class="btn btn-primary btn-block" role="button"
                                                id="close-all">{!! trans('main.buttons.close_all') !!}
                                        </button>
                                    </div>
                                </div>

                                <div class="row py-3 card border rounded-0 border-top-0">
                                    <h5 class="pl-3 pb-2 open-header">{!! trans('modals.text.open') !!}</h5>

                                </div>

                                <div class="row py-3">
                                    <h5 class="pl-3 pb-2 close-header">{!! trans('modals.text.closed') !!}</h5>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- OPEN | CLOSED JOBS FILTER MODAL END!!!!!!!!!!!!!!! -->

                <!--Assign all MODAL!!!!!!!!!!!!!!! -->
                <div class="modal fade" id="assignall" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body pb-3">

                                <p class="text-center">{!! trans('modals.text.assign_all') !!}</p>
                                <div class="col-md-12 mt-5 mb-2">
                                    <div class="row">
                                        <div class="col-md-4 offset-md-2">
                                            <button class="btn btn-danger btn-block">{!! trans('main.buttons.cancel') !!}</button>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-success btn-block">{!! trans('main.buttons.accept') !!}</button>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>

                </div>
                <!-- Assign all MODAL END!!!!!!!!!!!!!!! -->

                <!--Assign all MODAL!!!!!!!!!!!!!!! -->
                <div class="modal fade" id="unassignall" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body pb-3">

                                <p class="text-center">{!! trans('modals.text.unassign_all') !!}</p>
                                <div class="col-md-12 mt-5 mb-2">
                                    <div class="row">
                                        <div class="col-md-4 offset-md-2">
                                            <button class="btn btn-danger btn-block">{!! trans('main.buttons.cancel') !!}</button>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-success btn-block">{!! trans('main.buttons.accept') !!}</button>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>

                </div>
                <!-- Assign all MODAL END!!!!!!!!!!!!!!! -->

                <!--JOB FILTER MODAL!!!!!!!!!!!!!!! -->
                <div class="modal fade" id="jobfiltermodal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="max-width: 750px;">
                        <div class="modal-content">
                            <div class="modal-header pt-0">
                                <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.job_filter') !!}</h5>
                                <button type="button" class="close mt-0" data-dismiss="modal"
                                        aria-label="{!! trans('main.buttons.close') !!}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body pb-3 pt-0">
                                <div class="card border-0">
                                    <div class="card-body pt-0">
                                        <div class="row">


                                            <div class="col-md-12 col-lg-12 col-sm-12">
                                                <h4 class="dataTable-header">{!! trans('main.header_step_selected_brand') !!}</h4>
                                                <table class="table table-responsive display responsive no-wrap" id="filter-location-table" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col"></th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>


                                            <div class="col-lg-4 col-12 mx-auto mt-3">
                                                <button class="btn btn-outline-warning btn-block" id="clear-filters"
                                                        type="button">{!! trans('main.buttons.clear_filters') !!}
                                                </button>
                                            </div>
                                            <div class="col-lg-4 col-12 mx-auto mt-3">
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
                <!--Confirm modal for delete-->
                <div class="modal fade bd-example-modal-lg" id="deleteModal" tabindex="-1" role="dialog"
                     aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.job') !!}</h5>
                                <button type="button" class="close mt-0" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-11">
                                            {!! trans('modals.text.remove_job') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center bg-light">
                                <div class="bg-white">
                                    <button type="button" class="btn btn-outline-warning" data-dismiss="modal"
                                            aria-label="Close">
                                        {!! trans('main.buttons.cancel') !!}
                                    </button>
                                    <button type="button" class="btn btn-outline-primary"
                                            id="business-job-confirm-delete">
                                        {!! trans('main.buttons.remove') !!}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Confirm modal for change status-->
                <div class="modal fade bd-example-modal-lg" id="changeStatusModal" tabindex="-1" role="dialog"
                     aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.job') !!}</h5>
                                <button type="button" class="close mt-0" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-11">
                                            {!! trans('modals.text.remove_job_assign') !!}
                                        </div>
                                    </div>
                                    <p class="mb-0 text-center">{!! trans('modals.text.put_on_off') !!}</p>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center bg-light">
                                <div class="bg-white">
                                    <button type="button" class="btn btn-outline-warning" data-dismiss="modal"
                                            aria-label="Close" id="business-job-cancel-change">
                                        {!! trans('main.buttons.no') !!}
                                    </button>
                                    <button type="button" class="btn btn-outline-primary"
                                            id="business-job-confirm-change">
                                        {!! trans('main.buttons.yes') !!}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- JOB FILTER MODAL END!!!!!!!!!!!!!!! -->

    <!-- MODAL WINDOWS EOF -->

@endsection
@section('script')

    <script src="{{ asset('/js/app/business-job-items.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/business-functions.js?v='.time()) }}"></script>

    <script type="text/javascript">

        jQuery(document).ready(function ($) {

            let $BusinessFunc = new BusinessFunc();
            // $BusinessFunc.location_table_id = $(document).find("#location-table");
            $BusinessFunc.business_table_id = $(document).find("#business-table");
            $BusinessFunc.form_type = "job-list-location-table";
            $BusinessFunc.event_type = "job";
            $BusinessFunc.init();
        });
    </script>

@endsection
