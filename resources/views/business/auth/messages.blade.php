@extends('layouts.main_business')

@section('content')
    <div class="page animsition " style="animation-duration: 800ms; opacity: 1;">
        <div class="container-fluid">
            <div class="row">
                <div id="slide-out" class="col-3- pl-0 sidebar_adaptive">
                    @include('components.sidebar.sidebar_business')
                </div>
                @include('components.chat.chat-content')
            </div>
            <!-- Message Sidebar -->
            <!-- MODAL WINDOW -->
            <div class="modal fade" id="AddnewDialog" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header pt-0">
                            <h5 class="modal-title" id="exampleModalLabel">Add new dialog</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pb-5">
                            <input class="form-control" type="text" name="" placeholder="Type name"/>
                            <!-- <div class="row pb-3 pt-1 px-3">
                               <div class="col-md-6 pl-0">
                                   <button type="button" class="btn btn-outline-primary btn-block" role="button" data-toggle="modal" data-target="#assignall">Assign all</button>
                               </div>
                               <div class="col-md-6 pr-0">
                                   <button type="button" class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#unassignall">Unassign all</button>
                               </div>
                           </div> -->

                            <div class="row py-3">
                                <!-- one item begin -->
                                <div class="col-md-12 py-2 one-message">
                                    <div class="d-inline-flex">
                                        <div class="border">
                                            <img src="{{ asset('img/profilepic2.png') }}" alt="avatar" width="50px;"/>
                                        </div>
                                        <div>
                                            <p class="my-0 px-3 coll_name"><strong>John</strong></p>
                                            <p class="my-0 px-3 coll_title">Project Manager</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- one item eof -->
                                <!-- one item begin -->
                                <div class="col-md-12 py-2 one-message">
                                    <div class="d-inline-flex">
                                        <div class="border">
                                            <img src="{{ asset('img/profilepic2.png') }}" alt="avatar" width="50px;"/>
                                        </div>
                                        <div>
                                            <p class="my-0 px-3 coll_name"><strong>Jill</strong></p>
                                            <p class="my-0 px-3 coll_title">Project Manager</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- one item eof -->
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- MODAL WINDOW -->
            <!--JOB LOCATION FILTER MODAL!!!!!!!!!!!!!!! -->
            <div class="modal fade" id="job-location-filter-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-block pt-0">
                            <h5 class="modal-title h5 mb-2" id="exampleModalLabel">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0px"
                                     y="0px"
                                     viewBox="0 0 511.999 511.999" xml:space="preserve" height="20px"
                                     style="vertical-align: middle; margin-top: -3px;" fill="#4E5C6E">
                                            <path d="M510.078,35.509c-3.388-7.304-10.709-11.977-18.761-11.977H20.682c-8.051,0-15.372,4.672-18.761,11.977    s-2.23,15.911,2.969,22.06l183.364,216.828v146.324c0,7.833,4.426,14.995,11.433,18.499l94.127,47.063    c2.919,1.46,6.088,2.183,9.249,2.183c3.782,0,7.552-1.036,10.874-3.089c6.097-3.769,9.809-10.426,9.809-17.594V274.397    L507.11,57.569C512.309,51.42,513.466,42.813,510.078,35.509z M287.27,253.469c-3.157,3.734-4.889,8.466-4.889,13.355V434.32    l-52.763-26.381V266.825c0-4.89-1.733-9.621-4.89-13.355L65.259,64.896h381.482L287.27,253.469z"/>
                                        </svg>
                                {!! trans('modals.title.pipeline_filter') !!}
                            </h5>
                            <p class="mb-0">
                                <input id="job-location-filter-modal__filter-city_region-search" type="text" name="" placeholder="{!! trans('modals.filters.type_a_city_or_region') !!}" class="form-control" autocomplete="off">
                            </p>

                            <div class="filters my-2 list-filter-cities-regions">

                            </div>

                            <button type="button" class="close mt-0" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}" style="    position: absolute; right: 25px; top: 5px; padding: 5px;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-around flex-column mb-3">
                                <div class="col-lg-12">
                                    <div class="panel panel-default assign-panel mb-3">
                                        <p class="faq_title"><strong>{!! trans('modals.filters.managers') !!}</strong></p>
                                        <div class="text-justify faq_description" style="display: none;">
                                            <p class="col-md-5 px-0">
                                                <input id="job-location-filter-modal__filter-managers-search" type="text" name="" placeholder="{!! trans('modals.filters.type_manager') !!}">
                                            </p>
                                            <div class="d-flex">
                                                <input type="checkbox" name="" class="align-self-center mr-3" id="job-location-filter-modal__all-managers-checkbox">
                                                <label class="mb-0" for="job-location-filter-modal__all-managers-checkbox">{!! trans('modals.filters.all_managers') !!}</label>
                                            </div>
                                            <hr>
                                            <div id="job-location-filter-modal__managers">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between flex-lg-row flex-column mb-3">
                                <div class="col-lg-6 mb-lg-0 mb-3">
                                    <button type="button" class="btn btn-success btn-block" id="job-location-filter-modal__apply-button">{!! trans('modals.filters.apply') !!}</button>
                                </div>
                                <div class="col-lg-6">
                                    <button type="button" class="btn btn-outline-primary btn-block" id="job-location-filter-modal__clear-button">{!! trans('modals.filters.clear') !!}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- JOB FILTER MODAL END!!!!!!!!!!!!!!! -->
        </div>
        <!-- <style>
            .typingg > div {
                display: block;
                width: 100%;
            }

            .spinner {
                margin: 100px auto 0;
                width: 70px;
                text-align: center;
                display: inline;
            }

            .spinner > div {
                width: 8px;
                height: 8px;
                background-color: #333;

                border-radius: 100%;
                display: inline-block;
                -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
                animation: sk-bouncedelay 1.4s infinite ease-in-out both;
            }

            .spinner .bounce1 {
                -webkit-animation-delay: -0.32s;
                animation-delay: -0.32s;
            }

            .spinner .bounce2 {
                -webkit-animation-delay: -0.16s;
                animation-delay: -0.16s;
            }

            @-webkit-keyframes sk-bouncedelay {
                0%, 80%, 100% {
                    -webkit-transform: scale(0)
                }
                40% {
                    -webkit-transform: scale(1.0)
                }
            }

            @keyframes sk-bouncedelay {
                0%, 80%, 100% {
                    -webkit-transform: scale(0);
                    transform: scale(0);
                }
                40% {
                    -webkit-transform: scale(1.0);
                    transform: scale(1.0);
                }
            }
        </style> -->
    </div>
@endsection