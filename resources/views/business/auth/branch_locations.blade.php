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
        .page-item.inactive a{
            color: #000000;
            cursor: default;
        }
        .page-item.inactive a:hover{
            background-color: #ffffff;
        }
        .page-item.active a{
            cursor: default;
        }

        .Bobik:after{
            display: none;
        }
        .BobikHoverEffect:hover {
            background-color: transparent!important;
            transition: 0.8s;
        }
        .BobikHoverEffect > h5 > a{
            cursor: default!important;
        }



    </style>
    <div class="container-fluid">
        <form id="business-location-form" autocomplete="off">
            <div class="row">
                <div id="slide-out" class="col-3- pl-0- sidebar_adaptive">
                    @include('components.sidebar.sidebar_business')
                </div>
                <!-- content block begin-->
                <div class="col-xl-8 col-11 mx-auto pb-5 mt-5 bg-white rounded content-main">
                    <div class="row">
                        <div class="col-md-12 mx-auto px-0">
                            <div class="row px-3">
                                <div class="col-md-12 px-0">

                                    <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                                        @if (is_permit_administrator(['locations']))
                                            <div class="pl-3 py-2">
                                                <a href="{!! url('/business/branch/add') !!}"
                                                   class="btn btn-outline-success addnewbutton"
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
                                                                <polygon points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7 384,247.9 264.1,247.9"></polygon>
                                                            </g>
                                                        </g></svg>
                                                    <!-- </span> -->
                                                    <span class="mb-0" style="line-height: 1.6rem;">
                                                        {!! trans('main.buttons.add_location') !!}
                                                    </span>
                                                </a>
                                                <button type="button"
                                                   class="btn btn-outline-success js-upload-locations-from-file"
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
                                                                <polygon points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7 384,247.9 264.1,247.9"></polygon>
                                                            </g>
                                                        </g></svg>
                                                    <!-- </span> -->
                                                    <span class="mb-0" style="line-height: 1.6rem;">
                                                        {!! trans('main.buttons.upload_locations_from_file') !!}
                                                    </span>
                                                </button>
                                            </div>
                                        @endif

{{--                                        <div class="d-flex ml-auto">--}}
{{--                                            <div class="d-flex mr-0 pt-1">--}}
{{--                                                <span class="pt-2 mr-0">--}}
{{--                                                    <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                         xmlns:xlink="http://www.w3.org/1999/xlink"--}}
{{--                                                         version="1.1" id="Capa_1" x="0px" y="0px"--}}
{{--                                                         viewBox="0 0 417.138 417.138"--}}
{{--                                                         style="height:15px; opacity: 0.8;"--}}
{{--                                                         xml:space="preserve">--}}
{{--                                                    <g>--}}
{{--                                                        <g>--}}
{{--                                                            <path d="M153.289,333.271c9.35,0,17-7.65,17-17v-299.2c0-6.517-3.683-12.467-9.35-15.3c-5.667-2.833-12.75-2.267-17.85,1.7    l-111.067,83.3c-7.65,5.667-9.067,16.15-3.4,23.8c5.667,7.65,16.15,9.067,23.8,3.4l83.867-62.9v265.2    C136.289,325.621,143.939,333.271,153.289,333.271z"/>--}}
{{--                                                            <path d="M263.789,86.771c-9.35,0-17,7.65-17,17v296.367c0,6.517,3.683,12.183,9.35,15.3c2.55,1.133,5.1,1.7,7.65,1.7    c3.683,0,7.083-1.133,10.2-3.4l111.067-81.883c7.65-5.667,9.067-16.15,3.683-23.8c-5.667-7.65-16.15-9.067-23.8-3.683    l-84.15,62.05v-262.65C280.789,94.421,273.139,86.771,263.789,86.771z"/>--}}
{{--                                                        </g>--}}
{{--                                                    </g>--}}
{{--                                                    </svg>--}}
{{--                                                </span>--}}
{{--                                                <select class="border-0 form-control form-control-sm bg-white"--}}
{{--                                                        id="business-location-sort">--}}
{{--                                                    <option value="name"--}}
{{--                                                            data-order="asc">{!! trans('main.sort.name_az') !!}</option>--}}
{{--                                                    <option value="name"--}}
{{--                                                            data-order="desc">{!! trans('main.sort.name_za') !!}</option>--}}
{{--                                                    <option value="created_date"--}}
{{--                                                            data-order="asc">{!! trans('main.sort.c_date_oldest') !!}--}}
{{--                                                    </option>--}}
{{--                                                    <option value="created_date"--}}
{{--                                                            data-order="desc">{!! trans('main.sort.c_date_newest') !!}--}}
{{--                                                    </option>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                            <div class="pt-1 mx-2" id="page-limit-headquarters">--}}
{{--                                                <select class="border-0 form-control form-control-sm bg-white"--}}
{{--                                                        id="business-location-limit">--}}
{{--                                                    <option value="5">{!! trans('main.limit', ['count' => 5]) !!}</option>--}}
{{--                                                    <option value="10">{!! trans('main.limit', ['count' => 10]) !!}</option>--}}
{{--                                                    <option value="15">{!! trans('main.limit', ['count' => 15]) !!}</option>--}}
{{--                                                    <option value="20">{!! trans('main.limit', ['count' => 20]) !!}</option>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>

                                </div>
                            </div>

{{--                            <div class="col-md-12">--}}
{{--                                <div class="d-flex flex-lg-row flex-column justify-content-start" role="group"--}}
{{--                                     aria-label="Basic example">--}}

{{--                                    <div class="d-flex col-12 pl-0 col-lg-4 pxa-0 justify-content-between mb-3 mb-lg-0"--}}
{{--                                         style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;">--}}
{{--                                        <input type="text" class="form-control border-0 ml-2"--}}
{{--                                               style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;"--}}
{{--                                               placeholder="{!! trans('fields.placeholder.cr_locations_search') !!}"--}}
{{--                                               id="business-location-search"  autocomplete="off">--}}
{{--                                        <div class="align-self-center mr-3 mr-lg-0">--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"--}}
{{--                                                 x="0px" y="0px" viewBox="0 0 250.313 250.313"--}}
{{--                                                 style="enable-background:new 0 0 250.313 250.313; opacity: 0.1;"--}}
{{--                                                 xml:space="preserve" widht="17px" height="17px">--}}
{{--                                                <g id="Search">--}}
{{--                                                    <path style="fill-rule:evenodd;clip-rule:evenodd;"--}}
{{--                                                          d="M244.186,214.604l-54.379-54.378c-0.289-0.289-0.628-0.491-0.93-0.76   c10.7-16.231,16.945-35.66,16.945-56.554C205.822,46.075,159.747,0,102.911,0S0,46.075,0,102.911   c0,56.835,46.074,102.911,102.91,102.911c20.895,0,40.323-6.245,56.554-16.945c0.269,0.301,0.47,0.64,0.759,0.929l54.38,54.38   c8.169,8.168,21.413,8.168,29.583,0C252.354,236.017,252.354,222.773,244.186,214.604z M102.911,170.146   c-37.134,0-67.236-30.102-67.236-67.235c0-37.134,30.103-67.236,67.236-67.236c37.132,0,67.235,30.103,67.235,67.236   C170.146,140.044,140.043,170.146,102.911,170.146z"/>--}}
{{--                                                </g>--}}
{{--                                            </svg>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="mr-0 pt-1 pl-3" id="pagination_business_for_locations">--}}

{{--                            </div>--}}

                        </div>
                    </div>

                    <div class="row">

{{--                        <div class="col-md-12 col-sm-12 col-lg-12" style="padding: 25px 0 25px 15px;">--}}
{{--                            <div class="d-flex flex-lg-row flex-column justify-content-start" role="group" aria-label="Basic example">--}}
{{--                                <div class="d-flex col-12 pl-0 col-lg-4 pxa-0 justify-content-between mb-3 mb-lg-0"--}}
{{--                                     style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;">--}}
{{--                                    <input type="text" class="form-control border-0 ml-2"--}}
{{--                                           style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;"--}}
{{--                                           placeholder="{!! trans('fields.placeholder.cr_locations_search') !!}"--}}
{{--                                           id="table-brand-location-search"  autocomplete="off">--}}
{{--                                    <div class="align-self-center mr-3 mr-lg-0">--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                             xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"--}}
{{--                                             x="0px" y="0px" viewBox="0 0 250.313 250.313"--}}
{{--                                             style="enable-background:new 0 0 250.313 250.313; opacity: 0.1;"--}}
{{--                                             xml:space="preserve" widht="17px" height="17px">--}}
{{--                                                <g id="Search">--}}
{{--                                                    <path style="fill-rule:evenodd;clip-rule:evenodd;"--}}
{{--                                                          d="M244.186,214.604l-54.379-54.378c-0.289-0.289-0.628-0.491-0.93-0.76   c10.7-16.231,16.945-35.66,16.945-56.554C205.822,46.075,159.747,0,102.911,0S0,46.075,0,102.911   c0,56.835,46.074,102.911,102.91,102.911c20.895,0,40.323-6.245,56.554-16.945c0.269,0.301,0.47,0.64,0.759,0.929l54.38,54.38   c8.169,8.168,21.413,8.168,29.583,0C252.354,236.017,252.354,222.773,244.186,214.604z M102.911,170.146   c-37.134,0-67.236-30.102-67.236-67.235c0-37.134,30.103-67.236,67.236-67.236c37.132,0,67.235,30.103,67.235,67.236   C170.146,140.044,140.043,170.146,102.911,170.146z"/>--}}
{{--                                                </g>--}}
{{--                                            </svg>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

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
{{--                        <div id="location-table-desktop" class="col-md-7 d-sm-none d-md-none d-lg-block d-xl-block">--}}
{{--                            <table class="table details-table display responsive no-wrap" style="width: 100%;" id="location-table">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col"></th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                            </table>--}}
{{--                        </div>--}}
                    </div>
                    <div class="mx-auto mt-2 ml-3">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-content">

                            </ul>
                        </nav>
                    </div>

                    <div class="modal fade" id="ManaInLocModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header pt-0">
                                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.managers_in_locations') !!}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body pb-5  assign-panel">
                                    <input class="form-control" type="text" name=""
                                           placeholder="{!! trans('fields.placeholder.assign_manager_search') !!}" id="manager-location-search"  autocomplete="off"/>
                                    <div class="row pb-3 pt-1 px-3">
                                        <div class="col-md-6 pl-0">
                                            <button type="button" class="btn btn-outline-primary btn-block assign-all"
                                                    data-type="manager">{!! trans('main.buttons.assign_all') !!}</button>
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <button type="button" class="btn btn-primary btn-block unassign-all"
                                                    data-type="manager">{!! trans('main.buttons.unassign_all') !!}</button>
                                        </div>
                                    </div>

                                    <div class="row py-3 card border rounded-0 border-top-0">
                                        <h5 class="pl-3 pb-2 manager-assigned-header">{!! trans('modals.text.anssigned') !!}</h5>
                                    </div>

                                    <div class="row py-3">
                                        <h5 class="pl-3 pb-2 manager-unassigned-header">{!! trans('modals.text.unanssigned') !!}</h5>

                                        <div class="col-md-11 mt-2 mx-auto pl-4 pr-0">
                                            <div class="mx-auto mt-2 ml-3">
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination pagination-manager-unassign">

                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row pb-2 px-3">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-outline-primary btn-block"
                                                data-dismiss="modal"
                                                role="button">{!! trans('main.buttons.clear') !!}</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary btn-block" role="button"
                                                id="business-location-manager-set">{!! trans('main.buttons.set') !!}</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="OpenClosedModal" tabindex="-1" role="dialog"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header pt-0">
                                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.activate_jobs') !!}</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="{!! trans('main.buttons.close') !!}">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body pb-5">
                                    {{--<input class="form-control" type="text" name=""--}}
                                    {{--placeholder="Type job title"/>--}}
                                    <div class="row pb-3 pt-1 px-3">
                                        <div class="col-md-6 pl-0">
                                            <button type="button" class="btn btn-outline-primary btn-block"
                                                    role="button" id="open-all">{!! trans('main.buttons.open_all') !!}</button>
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <button type="button" class="btn btn-primary btn-block"
                                                    role="button" id="close-all">{!! trans('main.buttons.close_all') !!}</button>
                                        </div>
                                    </div>

                                    <div class="row py-3 card rounded-0 border-top-0">
                                        <h5 class="pl-3 pb-2 open-header">{!! trans('modals.text.open') !!}</h5>

                                    </div>

                                    <div class="row py-3">
                                        <h5 class="pl-3 pb-2 close-header">{!! trans('modals.text.closed') !!}</h5>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- MODAL WINDOWS -->

    <!-- JOBS FILTER MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="JobModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title" id="exampleModalLabel">Filter locations by
                        job</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-5">
                    <input class="form-control" type="text" name=""
                           placeholder="Type a job title"  autocomplete="off"/>

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
                                    <p class="mt-3 coll_name"><strong>Job title</strong></p>
                                </div>
                            </div>
                        </div>
                        <!-- one item eof -->
                    </div>

                </div>

                <div class="row pb-2 px-3">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-outline-primary btn-block"
                                data-dismiss="modal"
                                role="button">Clear
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary btn-block"
                                role="button">Set
                        </button>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- JOBS FILTER MODAL END!!!!!!!!!!!!!!! -->


    <!-- MANAGERS FILTER MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="ManagerModal" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title" id="exampleModalLabel">Filter locations by
                        Manager names</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-5">
                    <input class="form-control" type="text" name=""
                           placeholder="Type a manager name"  autocomplete="off"/>

                    <div class="row py-3">
                        <!-- one item begin -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-1 pt-3 pr-5">
                                    <label class="custom-control custom-checkbox m-0 pl-3">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </div>
                                <div class="d-inline-flex pl-0">
                                    <p class="my-0 px-3 coll_name"><strong>Jack</strong></p>
                                    <p class="my-0 px-3 coll_title">Project Manager</p>
                                </div>
                            </div>
                        </div>
                        <!-- one item eof -->
                    </div>

                </div>

                <div class="row pb-2 px-3">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-outline-primary btn-block"
                                data-dismiss="modal"
                                role="button">Clear
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary btn-block"
                                role="button">Set
                        </button>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- MANAGERS FILTER MODAL END!!!!!!!!!!!!!!! -->



    @include('components.modal.share_location_modal')



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

    <!-- Location QR Code Modal -->
    <div class="modal fade" id="location-qr-code-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body pb-3">
                    <p class="text-center h3">{!! trans('modals.text.location_qr_code') !!}</p>
                    <div class="col-md-12 mt-5 mb-2">
                        <div class="row">
                            <div class="modal__qr-code" style="margin: 5px auto;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Location QR Code Modal -->

    <!--Confirm modal for delete-->
    <div class="modal fade bd-example-modal-lg" id="deleteModal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.location') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                {!! trans('modals.text.remove_location') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-warning"
                                data-dismiss="modal" aria-label="Close">
                            {!! trans('main.buttons.cancel') !!}
                        </button>
                        <button type="button" class="btn btn-outline-primary"
                                id="business-location-confirm-delete">
                            {!! trans('main.buttons.remove') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Confirm modal for delete-->
    <div class="modal fade bd-example-modal-lg" id="noDeleteModal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.location') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                {!! trans('modals.text.not_remove_location') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-warning"
                                data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                            {!! trans('main.buttons.close') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL WINDOWS EOF -->


    <div class="row">
        <div class="divide-line black responsive"></div>
    </div>

    <form class="modal fade" id="upload-locations-from-file-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body pb-3">
                    <p class="text-center">{!! trans('modals.upload_locations_from_a_file') !!}</p>
                    <div class="file-upload">
                        <p>
                            {!! trans('modals.import_any_file') !!}
                        </p>
                        <div class="bg-white mb-3">
                            <a href="javascript:void(0)" role="button" class="btn btn-lg btn-outline-primary w-100 p-4" id="upload-locations-from-file-modal__upload-field">
                                <span class="d-block mb-0">
                                    <svg id="Layer_1" width="45px" height="45px" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><g><path d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z" fill="#4266ff"></path></g></g><g><polygon points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  " fill="#4266ff"></polygon></g></g></svg>
                                </span>
                                {!! trans('modals.upload_file_button') !!}
                            </a>
                        </div>
                        <input type="file" class="file-input" id="upload-locations-from-file-modal__upload-input" name="locations_file" style="display: none;">
                    </div>
                    <button class="btn btn-danger btn-block" id="upload-locations-from-file-modal__cancel">{!! trans('main.buttons.cancel') !!}</button>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="upload-locations-from-file-congrats-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body pb-3">
                    <p class="text-center">{!! trans('modals.thanks_for_uploading_your_file') !!}</p>
                    <button class="btn btn-danger btn-block" id="upload-locations-from-file-congrats-modal__close">{!! trans('main.buttons.close') !!}</button>
                </div>
            </div>
        </div>
    </div>


    @include('components.modal.qr_code_func')

    <div class="modal fade bd-example-modal-lg" id="create-cart-modal" tabindex="-1" role="dialog"
        data-secret="
        @php
        \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
        echo $intent = \Stripe\SetupIntent::create()->client_secret;
        @endphp
        "
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new Credit Card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center" style="padding-bottom: 15px;">
                            <div class="interval-billing-paid-sub-block mr-3">
                                <span class="text-label" style="padding-right: 10px;"><span class="month-price"></span> Monthly</span>
                                <label class="switch">
                                    <input type="checkbox" name="interval-billing-paid" class="primary" value="1">
                                    <span class="slider round"></span>
                                </label>
                                <span class="text-label">Yearly <span class="year-price"></span></span>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <p class="error-message" style="color: red; font-weight: bold;"></p>
                                <form id="create-card-form" method="post" autocomplete="off">
                                    <div class="row">
                                        <div class=" col-lg-12">
                                            <!-- <input class="form-control card-number my-custom-class" name="card-number"  autocomplete="off">
                                            <input class="form-control name" id="the-card-name-id" name="card-holders-name"
                                                   placeholder="Name on card"  autocomplete="off">
                                            <input class="form-control expiry-month" name="expiry-month"  autocomplete="off">
                                            <input class="form-control expiry-year" name="expiry-year"  autocomplete="off">
                                            <input class="form-control cvc" name="cvc"  autocomplete="off"> -->
                                            <div id="card-element"></div>

                                        </div>
                                        <div class="col-lg-12">
                                            <button class="btn btn-outline-primary ml-3 mt-3 pull-right" type="submit">Add Card</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="modal fade bd-example-modal-lg" id="confirmation-subscription-modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center" style="padding-bottom: 15px;">
                            <div class="interval-billing-paid-sub-block mr-3 hide">
                                <span class="text-label" style="padding-right: 10px;"><span class="month-price"></span> Monthly</span>
                                <label class="switch">
                                    <input type="checkbox" name="interval-billing-paid" class="primary" value="1">
                                    <span class="slider round"></span>
                                </label>
                                <span class="text-label">Yearly <span class="year-price"></span></span>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <p>Confirmation Subscription</p>
                        </div>
                        <div class="row justify-content-center">
                            <p class="error-stripe"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" data-action="0" class="btn btn-outline-warning confirmation-subscription-button" data-dismiss="modal" aria-label="close">
                            No
                        </button>
                        <button type="button" data-action="1" class="btn btn-outline-primary confirmation-subscription-button" data-dismiss="modal" aria-label="close">
                            Yes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

@endsection
@section('script')
    <script src="{{ asset('/js/app/business-location.js?v='.time()) }}"></script>

    <script src="{{ asset('/js/app/business-functions.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/business-new-billing.js?v='.time()) }}"></script>

    <script src="{{ asset('/js/jscolor.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/cropper.min.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/qr-code-functions.js?v='.time()) }}"></script>

    <script type="text/javascript">

        jQuery(document).ready(function ($) {
            let $BusinessFunc = new BusinessFunc();
            $BusinessFunc.business_table_id = $(document).find("#business-table");
            // $BusinessFunc.location_table_id = $(document).find("#location-table");
            $BusinessFunc.typeLocationTable = null;
            $BusinessFunc.form = $(document).find("#business-location-form");
            $BusinessFunc.init();

            GlobalQRCodeFunc = new QRCodeFunc(GlobalQRCodeType.location);

        });
    </script>

@endsection
