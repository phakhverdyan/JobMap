@extends('layouts.main_user')

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

        .blockorlist:hover .filtersvg {
            opacity: 1;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div id="slide-out" class="col-3- pl-0- sidebar_adaptive">
                @include('components.sidebar.sidebar_user')
            </div>

            <div class="flex-1 col-xl-8 col-12 mx-auto mt-3 content-main">
                <div>
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-12 text-center my-3">
                                <div class="card border-0">
                                    <div class="card-header bg-white px-0 pt-4 border-0">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12 text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                     id="Capa_1" x="0px" y="0px" viewBox="0 0 490.282 490.282"
                                                     style="enable-background:new 0 0 490.282 490.282;"
                                                     xml:space="preserve" width="50px" height="50px" class=""><g>
                                                        <g>
                                                            <path d="M0.043,245.197c0.6,10.1,7.3,18.6,17,21.5l179.6,54.3l6.6,123.8c0.3,4.9,3.6,9.2,8.3,10.8c1.3,0.5,2.7,0.7,4,0.7   c3.5,0,6.8-1.4,9.2-4.1l63.5-70.3l90,62.3c4,2.8,8.7,4.3,13.6,4.3c11.3,0,21.1-8,23.5-19.2l74.7-380.7c0.9-4.4-0.8-9-4.2-11.8   c-3.5-2.9-8.2-3.6-12.4-1.9l-459,186.8C5.143,225.897-0.557,235.097,0.043,245.197z M226.043,414.097l-4.1-78.1l46,31.8   L226.043,414.097z M391.443,423.597l-163.8-113.4l229.7-222.2L391.443,423.597z M432.143,78.197l-227.1,219.7l-179.4-54.2   L432.143,78.197z"
                                                                  data-original="#000000" class="active-path"
                                                                  data-old_color="#4266ff" fill="#4266ff"></path>
                                                        </g>
                                                    </g> </svg>
                                            </div>
                                            <div class="col-md-12 text-center pb-3">
                                                <h2 class="mx-auto mt-2 text-muted"
                                                    style="font-family: 'Open Sans', sans-serif; letter-spacing: -1px">
                                                    {!! trans('main.sent_resumes') !!}
                                                </h2>
                                                <h4 class="mx-auto mt-4 text-muted"
                                                    style="font-family: 'Open Sans', sans-serif; letter-spacing: -1px">
                                                    <p>
                                                        {!! trans('main.counters.sent_resumes.label_1_1') !!}
                                                        <span class="notification countSentResumesL grey" style="display: none;position: relative;right: 0;"></span>
                                                        {!! trans('main.counters.sent_resumes.label_1_2') !!}
                                                        <span class="notification countSentResumesCompanies grey" style="display: none;position: relative;right: 0;"></span>
                                                        {!! trans('main.counters.sent_resumes.label_1_3') !!}
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="notification countSentResumesNotNew grey" style="display: none;position: relative;right: 0;"></span>
                                                        {!! trans('main.counters.sent_resumes.label_2_1') !!}
                                                        <span class="notification countSentResumesAskL grey" style="display: none;position: relative;right: 0;"></span>
                                                        {!! trans('main.counters.sent_resumes.label_2_2') !!}
                                                    </p>
                                                </h4>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <div class="btn-group w-100" role="group" aria-label="Basic example">
                                            <ul class="nav nav-tabs border-0 mb-0 pl-3 w-100 pr-0" role="tablist">
                                                <li class="nav-item m-0 col-6 px-0">
                                                    <a class="btn btn-outline-primary nav-link active py-4 group-count font-response text-center" data-g="location" data-toggle="tab" href="#seen" role="tab" style="text-align: left;">
                                                        <p>
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 297 297" style="enable-background:new 0 0 297 297;" xml:space="preserve" width="50px" height="50px">
                                                                <g>
                                                                    <path d="M294.908,142.226c-0.566-0.756-14.169-18.72-38.883-36.693c-32.842-23.886-70.023-36.511-107.524-36.511   c-37.501,0-74.683,12.625-107.525,36.51C16.261,123.506,2.658,141.47,2.092,142.226c-2.789,3.718-2.789,8.831,0,12.549   c0.566,0.756,14.169,18.72,38.884,36.694c32.843,23.885,70.024,36.51,107.525,36.51c37.502,0,74.683-12.625,107.524-36.511   c24.714-17.974,38.316-35.938,38.883-36.693C297.697,151.057,297.697,145.943,294.908,142.226z M207.065,148.5   c0,32.292-26.271,58.564-58.563,58.564S89.938,180.792,89.938,148.5s26.271-58.563,58.563-58.563S207.065,116.208,207.065,148.5z    M24.152,148.499c8.936-9.863,28.83-29.278,57.591-43.046c-8.034,12.415-12.721,27.19-12.721,43.047   c0,15.914,4.719,30.738,12.807,43.181c-9.538-4.566-18.878-10.143-27.995-16.724C39.936,164.925,29.835,154.779,24.152,148.499z    M243.167,174.957c-9.117,6.581-18.457,12.156-27.993,16.724c8.087-12.442,12.806-27.268,12.806-43.181   s-4.719-30.738-12.806-43.181c9.536,4.567,18.876,10.143,27.993,16.724c13.897,10.032,23.998,20.178,29.68,26.457   C267.161,154.783,257.062,164.927,243.167,174.957z"/>
                                                                    <circle cx="148.501" cy="148.5" r="17.255"/>
                                                                </g>
                                                            </svg>
                                                        </p>
                                                        <p style="font-weight: 400;">
                                                            <span class="notification countSentResumesNotNew grey" style="display: none;position: relative;right: 0;"></span>
                                                            {!! trans('main.tabs.sent_resumes.seen') !!}
                                                        </p>
                                                        <p class="mb-0" style="font-weight: 400;">
                                                            <span class="notification countSentResumesAskNotNew grey" style="display: none;position: relative;right: 0;"></span>
                                                            {!! trans('main.tabs.sent_resumes.seen_request') !!}
                                                        </p>
                                                    </a>
                                                </li>
                                                <li class="nav-item m-0 col-6 px-0">
                                                    <a class="btn btn-outline-primary nav-link py-4 group-count font-response text-center" data-g="headquarter" data-toggle="tab" href="#not-seen" role="tab" style="text-align: left;">
                                                        <p>
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 297 297" style="enable-background:new 0 0 297 297;" xml:space="preserve" width="50px" height="50px">
                                                                <path d="M294.908,142.225c-0.566-0.756-14.168-18.72-38.881-36.693c-10.007-7.277-20.418-13.504-31.116-18.652l47.458-47.458  c4.084-4.084,4.084-10.706,0-14.79c-4.085-4.083-10.705-4.083-14.79,0L203.922,78.29c-18.06-6.122-36.7-9.269-55.42-9.269  c-37.501,0-74.683,12.625-107.526,36.51C16.262,123.506,2.658,141.47,2.092,142.225c-2.789,3.718-2.789,8.831,0,12.549  c0.566,0.756,14.17,18.72,38.884,36.694c10.006,7.277,20.418,13.503,31.115,18.651l-47.458,47.458  c-4.084,4.084-4.084,10.706,0,14.79c2.043,2.042,4.719,3.063,7.394,3.063c2.678,0,5.354-1.021,7.396-3.063l53.658-53.658  c18.062,6.122,36.701,9.268,55.421,9.268c37.502,0,74.684-12.625,107.525-36.511c24.713-17.974,38.315-35.938,38.881-36.693  C297.697,151.057,297.697,145.943,294.908,142.225z M207.065,148.5c0,32.292-26.271,58.564-58.563,58.564  c-12.376,0-23.859-3.87-33.328-10.446l23.981-23.98c2.899,1.123,6.05,1.746,9.347,1.746c14.296,0,25.883-11.587,25.883-25.883  c0-3.298-0.623-6.447-1.746-9.348l23.98-23.98C203.196,124.641,207.065,136.123,207.065,148.5z M89.939,148.5  c0-32.292,26.271-58.563,58.564-58.563c12.376,0,23.859,3.868,33.326,10.446l-23.98,23.98c-2.9-1.123-6.049-1.746-9.346-1.746  c-14.296,0-25.883,11.587-25.883,25.883c0,3.297,0.623,6.446,1.746,9.346l-23.98,23.98C93.808,172.358,89.939,160.876,89.939,148.5z   M24.153,148.5c5.687-6.283,15.785-16.427,29.681-26.457c9.118-6.581,18.458-12.157,27.996-16.725  c-8.088,12.443-12.807,27.268-12.807,43.182s4.719,30.738,12.807,43.182c-9.538-4.567-18.878-10.144-27.996-16.725  C39.937,164.925,29.836,154.779,24.153,148.5z M243.167,174.957c-9.115,6.581-18.456,12.156-27.991,16.724  c8.086-12.442,12.805-27.268,12.805-43.181s-4.719-30.738-12.805-43.181c9.535,4.567,18.876,10.143,27.991,16.724  c13.897,10.032,23.998,20.178,29.681,26.457C267.162,154.783,257.063,164.927,243.167,174.957z"/>
                                                            </svg>
                                                        </p>
                                                        <p style="font-weight: 400;">
                                                            <span class="notification countSentResumesNew grey" style="display: none;position: relative;right: 0;"></span>
                                                            {!! trans('main.tabs.sent_resumes.not_seen') !!}
                                                        </p>
                                                        <p class="mb-0" style="font-weight: 400;">
                                                            <span class="notification countSentResumesAskNew grey" style="display: none;position: relative;right: 0;"></span>
                                                            {!! trans('main.tabs.sent_resumes.seen_request') !!}
                                                        </p>
                                                    </a>
                                                </li>
                                            </ul>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-12 mx-auto bg-white px-0">
                                            <div class="tab-content">
                                                <!-- Latest employers that have seen your resume TAB -->
                                                <div id="seen" class="tab-pane active sent-group" data-group="seen" role="tabpanel">
                                                    <div class="col-md-12 py-2 pl-2">
                                                        <div class="d-flex flex-column flex-lg-row">

                                                                
                                                            <div class="d-flex col-12 col-lg-4 px-0">
                                                                <input type="text" class="form-control resume-search"
                                                                placeholder="{!! trans('fields.placeholder.sent_resume_search') !!}" data-type="1">
                                                            </div>                                       


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
                                                                    <select class="border-0 form-control form-control-sm sort-resume bg-white" data-type="1">
                                                                        <option value="request" data-order="desc">{!! trans('main.sort.request_by_company') !!}</option>
                                                                        <option value="name" data-order="asc">{!! trans('main.sort.business_name_az') !!}</option>
                                                                        <option value="name" data-order="desc">{!! trans('main.sort.business_name_za') !!}</option>
                                                                        <option value="updated_date" data-order="asc">{!! trans('main.sort.date_oldest') !!}
                                                                        </option>
                                                                        <option value="updated_date" data-order="desc">{!! trans('main.sort.date_newest') !!}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="pt-1 mx-2" id="page-limit-headquarters">
                                                                    <select class="border-0 form-control form-control-sm resume-per-page bg-white" data-type="1">
                                                                        <option value="25">{!! trans('main.limit', ['count' => 25]) !!}</option>
                                                                        <option value="50">{!! trans('main.limit', ['count' => 50]) !!}</option>
                                                                        <option value="100">{!! trans('main.limit', ['count' => 100]) !!}</option>
                                                                        <option value="200">{!! trans('main.limit', ['count' => 200]) !!}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="mr-auto pt-2 px-3">
                                                        <p class="mb-1 h6 group-count"><span>0</span> Locations</p>
                                                    </div> -->

                                                    <div id="accordion1" role="tablist" class="col-md-12 px-0">
                                                        <div id="seen-accordion-list">

                                                        </div>
                                                        <div class="card-body px-0 pb-3 pt-0" id="seen-map-items">
                                                            <div class="row justify-content-center">
                                                                <div class="col-12">
                                                                    <div class="justify-content-center justify-content-md-start"
                                                                         id="seen-map-list">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <nav aria-label="Page navigation example">
                                                                <ul class="pagination pagination-content">

                                                                </ul>
                                                            </nav>
                                                        </div>
                                                    </div>
                                                </div>  
                                                <!-- Latest employers that have seen your resume TAB EOF -->
                                                <!-- Employers that have not seen your resume yet TAB -->
                                                <div id="not-seen" class="tab-pane sent-group" data-group="not-seen" role="tabpanel">
                                                    <div class="col-md-12 py-2 pl-2">
                                                        <div class="d-flex flex-column flex-lg-row">

                                                            <div class="d-flex col-12 col-lg-4 px-0">
                                                                <input type="text" class="form-control resume-search"
                                                                       placeholder="{!! trans('fields.placeholder.sent_resume_search') !!}" data-type="0">
                                                            </div> 


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
                                                                    <select class="border-0 form-control form-control-sm sort-resume bg-white" data-type="1">
                                                                        <option value="request" data-order="desc">{!! trans('main.sort.request_by_company') !!}</option>
                                                                        <option value="name" data-order="asc">{!! trans('main.sort.business_name_az') !!}</option>
                                                                        <option value="name" data-order="desc">{!! trans('main.sort.business_name_za') !!}</option>
                                                                        <option value="updated_date" data-order="asc">{!! trans('main.sort.date_oldest') !!}
                                                                        </option>
                                                                        <option value="updated_date" data-order="desc">{!! trans('main.sort.date_newest') !!}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="pt-1 mx-2" id="page-limit-headquarters">
                                                                    <select class="border-0 form-control form-control-sm resume-per-page bg-white" data-type="1">
                                                                        <option value="25">{!! trans('main.limit', ['count' => 25]) !!}</option>
                                                                        <option value="50">{!! trans('main.limit', ['count' => 50]) !!}</option>
                                                                        <option value="100">{!! trans('main.limit', ['count' => 100]) !!}</option>
                                                                        <option value="200">{!! trans('main.limit', ['count' => 200]) !!}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="mr-auto pt-2 px-3">
                                                        <p class="mb-1 h6 group-count"><span>0</span> Headquarters</p>
                                                    </div> -->

                                                    <div id="accordion" role="tablist" class="col-md-12 px-0">
                                                        <div id="not-seen-accordion-list">

                                                        </div>
                                                        <div class="card-body px-0 pt-0 pb-3" id="not-seen-map-items">
                                                            <div class="row justify-content-center">
                                                                <div class="col-12">
                                                                    <div class="justify-content-center justify-content-md-start"
                                                                         id="not-seen-map-list">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <nav aria-label="Page navigation example">
                                                                <ul class="pagination pagination-content">

                                                                </ul>
                                                            </nav>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Employers that have not seen your resume yet TAB EOF -->

                                            </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="update-resume-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header pb-0 border-0">
                        <button type="button" class="ml-auto close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="text-center mb-2">
                            <svg enable-background="new 0 0 48 48" height="50px" width="50px" id="Layer_1" version="1.1"
                                 viewBox="0 0 48 48" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                       <path clip-rule="evenodd" fill="#4266ff"
                             d="M45.037,28.426C45.629,29.123,46,30.015,46,31.001  c0,1.461-0.792,2.727-1.963,3.424C44.629,35.123,45,36.015,45,37.001c0,1.462-0.793,2.726-1.963,3.424  C43.629,41.122,44,42.014,44,43c0,2.209-1.791,4-4,4l-23.404-0.002v-0.024c-1.602-0.069-3.018-0.824-3.975-1.976H6  c-2.762,0-5-5.373-5-12s2.238-12,5-12h8.387L22,10v-5c0.541-3.262,3-3,3-3c2.212,0,3,1,3,1c3,3,3,8,3,8c0,6.608-3,10-3,10h15  c2.209,0,4,1.791,4,4C47,26.462,46.207,27.728,45.037,28.426z M6,22.998c-0.771,0-3,3.438-3,10s2.229,10,3,10h5.578  c-0.056-0.198-0.119-0.393-0.152-0.6C10.834,39.526,10,34.805,10,30.998c0-4.043,2.203-6.897,3-8h0.002l0,0H6z M43,23H23.561  l2.941-3.325C26.527,19.646,29,16.691,29,11.006c0-0.042-0.054-4.232-2.414-6.591l-0.117-0.105  c-0.673-0.423-1.599-0.314-1.599-0.314c-0.533,0-0.77,0.686-0.87,1.185v5.444l-9.379,13.543l-0.109,0.152  C13.696,25.441,12,27.773,12,30.998c0,3.714,0.867,8.484,1.398,11.073c0.268,1.611,1.648,2.833,3.285,2.904L40,45  c1.103,0,2-0.897,2-2c0-0.584-0.266-1.019-0.487-1.281l-1.529-1.801l2.028-1.211C42.631,38.338,43,37.7,43,37.001  c0-0.584-0.266-1.021-0.488-1.283l-1.528-1.803l2.03-1.209C43.631,32.339,44,31.701,44,31.001c0-0.584-0.266-1.019-0.487-1.281  l-1.529-1.801l2.028-1.211C44.631,26.339,45,25.701,45,25.001C45,23.897,44.103,23,43,23z M7.5,40.998c-0.828,0-1.5-0.672-1.5-1.5  s0.672-1.5,1.5-1.5S9,38.67,9,39.498S8.328,40.998,7.5,40.998z"
                             fill-rule="evenodd"/>
                   </svg>
                        </div>
                        <h6 class="h6 mb-0 text-center">Thanks , we will notify EMPLOYER NAME that your resume is up to date!</h6>
                    </div>
                    <div class="modal-footer d-block bg-light">
                        <div class="row">
                            <div class="col-6">
                                <div class="bg-white">
                                    <button class="btn btn-lg btn-outline-success p-2 w-100" id="accept-update" type="button">
                                        Accept
                                    </button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-white">
                                    <button class="btn btn-lg btn-outline-danger p-2 w-100" type="button" data-dismiss="modal">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="history" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0 pt-0">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 448 448"
                             style="vertical-align: middle; margin-bottom: 3px; margin-right: 10px;"
                             data-toggle="tooltip" data-placement="top"
                             title="History" height="18px" fill="#4E5C6E">
                            <g>
                                <g>
                                    <g>
                                        <path d="M255.893,32C149.76,32,64,117.973,64,224H0l83.093,83.093l1.493,3.093L170.667,224h-64     c0-82.453,66.88-149.333,149.333-149.333S405.333,141.547,405.333,224S338.453,373.333,256,373.333     c-41.28,0-78.507-16.853-105.493-43.84L120.32,359.68C154.987,394.453,202.88,416,255.893,416C362.027,416,448,330.027,448,224     S362.027,32,255.893,32z"/>
                                        <polygon
                                                points="234.667,138.667 234.667,245.333 325.973,299.52 341.333,273.6 266.667,229.333 266.667,138.667    "/>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <span class="pt-2"><span id="history-name-modal"></span> history</span>
                    </h5>
                    <button type="button" class="close pt-0 mt-0" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-0 pb-3" id="history-modal-body">
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="col-md-4 mx-auto">
                        <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('/js/app/resume-builder.js?v='.time()) }}"></script>
@endsection