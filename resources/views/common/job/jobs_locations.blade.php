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
            padding-bottom: 11px;
            fill: #0275d8;
        }

        .blockorlist:hover .filtersvg {
            opacity: 1;
        }

        .blockorlist:hover {
            border-bottom: 2px solid #4266ff;
            padding-bottom: 9px;
            fill: #0275d8;
        }
    </style>
    <div id="location-view" class="hide">

        <!-- left menu begin -->
        <!-- <div class="col-md-3">menu</div> -->
        <!-- left menu eof -->

        <!-- content block begin-->
        <div class="col-md-10 mx-auto pb-5 card" style="background-color: #eee;margin-top: -15px;">
            <div class="row">

                <div class="col-md-12" id="map" style="height: 150px;margin-bottom: -29px;"></div>

                <div class="col-md-4 mx-auto" style="margin-bottom: -10px; z-index: 1;">
                    <button class="btn btn-primary btn-block" id="map-resize" data-map="1" data-text="smaller map">
                        bigger map
                    </button>
                </div>

                <div class="col-md-12 mx-auto  card rounded-0 pb-2">
                    <div class="row">

                        <div class="col-md-4 mx-auto pt-1">
                            <a class="btn btn-primary btn-block py-1" id="business-career-page" style="margin-top: 15px">Career page</a>
                        </div>

                        <div class="col-md-12 pt-3">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="pl-3"><img class="location-icon"
                                                               src="{{ asset('img/profilepic2.png') }}"
                                                               style="max-width: 100%;"></div>
                                        <div class="col-md-9">
                                            <h4 id="location-name">Location name</h4>
                                            <p class="mb-1"><img src="{{ asset('img/sidebar/locations.png') }}"
                                                                 style="margin-top: -5px;"/><a href="javascript:void(0)"
                                                                                               style="text-decoration: none;"
                                                                                               id="location-address">
                                                    Location address </a></p>
                                            <p class="mb-1"><img src="{{ asset('img/office-briefcase.svg') }}"
                                                                 style="width: 20px; margin-top: -5px;"/><a
                                                        href="#jobs"
                                                        style="text-decoration: none;" id="jobs-count">
                                                    <span></span> Jobs </a></p>
                                            <p class="mb-1"><img src="{{ asset('img/call-answer.png') }}"
                                                                 style="margin-top: -5px;"/><a href="javascript:void(0)"
                                                                                               style="text-decoration: none;"
                                                                                               id="phone">
                                                    Phone number </a></p>
                                        </div>
                                    </div>
                                    <p class="pl-1 pt-2">
                                        <a href="#" id="link-location-country">Canada</a>
                                        >
                                        <a href="#" id="link-location-region">Quebeck</a>
                                        >
                                        <a href="#" id="link-location-city">Monreal</a>
                                        >
                                        <a href="#" id="link-location-street">McGill Street</a>
                                        >
                                        <a href="#" id="link-location-address">McGill Street 43</a>
                                    </p>

                                </div>
                                <div class="col-md-3">
                                    <div class="pt-1">
                                        <button class="btn btn-outline-primary btn-block">Send Cloudresume</button>
                                    </div>
                                    <div class="pt-3">
                                        <button class="btn btn-outline-primary btn-block">Follow</button>
                                    </div>
                                    <p class="mb-1 mt-2"><img src="{{ asset('img/group.png') }}"/><a href="#"
                                                                                                     style="text-decoration: none;">
                                            "#" Followers</a></p>
                                    <p class="mb-1"><img src="{{ asset('img/sidebar/account.png') }}"/><a href="#"
                                                                                                          style="text-decoration: none;">
                                            "#" Employees</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 text-center py-3 mt-0 mb-3">
                            <div class="d-flex flex-row justify-content-center" id="amenities-list">

                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-md-12 card rounded-0 mt-3 items-group" data-group="jobs" id="jobs">
                    <div class="row">
                        <div class="col-md-12 card rounded-0 border-right-0 border-left-0 border-top-0">
                            <div class="row">
                                <div class="col-md-12 py-2" style="border-bottom:2px solid #eee;">
                                    <div class="row">
                                        <div class="col-md-8" id="page-limit-jobs">
                                            <span class="pr-1">Per page:</span>
                                            <span class="perpage h6 px-1 activesortamount"><a href="javascript:void(0)"
                                                                                              style="text-decoration: none;"
                                                                                              data-limit="3">3</a></span>
                                            <span class="perpage h6 px-1"><a href="javascript:void(0)"
                                                                             style="text-decoration: none;"
                                                                             data-limit="6">6</a></span>
                                            <span class="perpage h6 px-1"><a href="javascript:void(0)"
                                                                             style="text-decoration: none;"
                                                                             data-limit="12">12</a></span>
                                            <span class="perpage h6 px-1"><a href="javascript:void(0)"
                                                                             style="text-decoration: none;"
                                                                             data-limit="24">24</a></span>
                                            <span class="perpage h6 px-1"><a href="javascript:void(0)"
                                                                             style="text-decoration: none;"
                                                                             data-limit="48">48</a></span>
                                        </div>
                                        <div class="col-md-4 text-right">
														<span class="blockorlist h6 mr-1 ml-3" data-type="list">
															<svg xmlns="http://www.w3.org/2000/svg"
                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 version="1.1" id="Capa_1" x="0px" y="0px"
                                                                 viewBox="0 0 50 50" xml:space="preserve"
                                                                 class="filtersvg">
															<g>
																<rect y="3" width="50" height="2"/>
																<rect y="17" width="50" height="2"/>
																<rect y="31" width="50" height="2"/>
																<rect y="45" width="50" height="2"/>
															</g>
															</svg>
														</span>
                                            <span class="blockorlist h6 ml-1" data-type="map">
															<svg xmlns="http://www.w3.org/2000/svg"
                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 version="1.1" id="Capa_1" x="0px" y="0px" width="22px"
                                                                 height="18px" viewBox="0 0 965.199 965.199"
                                                                 xml:space="preserve" class="filtersvg">
															<g>
																<path d="M263.85,30c0-16.6-13.4-30-30-30h-202c-16.6,0-30,13.4-30,30v202.1c0,16.6,13.4,30,30,30h202.1c16.6,0,30-13.4,30-30V30   H263.85z"/>
																<path d="M613.55,30c0-16.6-13.4-30-30-30h-202c-16.6,0-30,13.4-30,30v202.1c0,16.6,13.4,30,30,30h202c16.6,0,30-13.4,30-30V30z"/>
																<path d="M963.25,30c0-16.6-13.4-30-30-30h-202c-16.601,0-30,13.4-30,30v202.1c0,16.6,13.399,30,30,30h202.1c16.601,0,30-13.4,30-30   V30H963.25z"/>
																<path d="M263.85,381.6c0-16.6-13.4-30-30-30h-202c-16.6,0-30,13.4-30,30v202c0,16.6,13.4,30,30,30h202.1c16.6,0,30-13.4,30-30v-202   H263.85z"/>
																<path d="M613.55,381.6c0-16.6-13.4-30-30-30h-202c-16.6,0-30,13.4-30,30v202c0,16.6,13.4,30,30,30h202c16.6,0,30-13.4,30-30V381.6z   "/>
																<path d="M963.25,381.6c0-16.6-13.4-30-30-30h-202c-16.601,0-30,13.4-30,30v202c0,16.6,13.399,30,30,30h202.1   c16.601,0,30-13.4,30-30v-202H963.25z"/>
																<path d="M233.85,703.1h-202c-16.6,0-30,13.4-30,30v202.1c0,16.602,13.4,30,30,30h202.1c16.6,0,30-13.398,30-30V733.1   C263.85,716.6,250.45,703.1,233.85,703.1z"/>
																<path d="M583.55,703.1h-202c-16.6,0-30,13.4-30,30v202.1c0,16.602,13.4,30,30,30h202c16.6,0,30-13.398,30-30V733.1   C613.55,716.6,600.149,703.1,583.55,703.1z"/>
																<path d="M933.25,703.1h-202c-16.601,0-30,13.4-30,30v202.1c0,16.602,13.399,30,30,30h202.1c16.601,0,30-13.398,30-30V733.1   C963.25,716.6,949.85,703.1,933.25,703.1z"/>
															</g>
															</svg>
														</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 pb-2">
                                    <div class="row">

                                        <div class="col-md-4 mt-1 pt-2">
                                            <p class="mb-1 h6 group-count"><span>0</span> Jobs</p>
                                        </div>

                                        <div class="col-md-4 offset-md-4">
                                            <div class="row">
                                                <div class="col-md-2 offset-md-3 text-center pt-2 mt-1 pr-0">
														<span>
															<svg xmlns="http://www.w3.org/2000/svg"
                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 version="1.1" id="Capa_1" x="0px" y="0px"
                                                                 viewBox="0 0 417.138 417.138"
                                                                 style="height:21px; opacity: 0.8;"
                                                                 xml:space="preserve">
															<g>
																<g>
																	<path d="M153.289,333.271c9.35,0,17-7.65,17-17v-299.2c0-6.517-3.683-12.467-9.35-15.3c-5.667-2.833-12.75-2.267-17.85,1.7    l-111.067,83.3c-7.65,5.667-9.067,16.15-3.4,23.8c5.667,7.65,16.15,9.067,23.8,3.4l83.867-62.9v265.2    C136.289,325.621,143.939,333.271,153.289,333.271z"/>
																	<path d="M263.789,86.771c-9.35,0-17,7.65-17,17v296.367c0,6.517,3.683,12.183,9.35,15.3c2.55,1.133,5.1,1.7,7.65,1.7    c3.683,0,7.083-1.133,10.2-3.4l111.067-81.883c7.65-5.667,9.067-16.15,3.683-23.8c-5.667-7.65-16.15-9.067-23.8-3.683    l-84.15,62.05v-262.65C280.789,94.421,273.139,86.771,263.789,86.771z"/>
																</g>
															</g>
															</svg>
														</span>
                                                </div>
                                                <div class="col-md-7 pt-2 pl-0">
                                                    <select class="form-control form-control-sm" id="jobs-sort">
                                                        <option value="title" data-order="asc">Title A-Z</option>
                                                        <option value="title" data-order="desc">Title Z-A</option>
                                                        <option value="created_date" data-order="asc">Created date -
                                                            Oldest
                                                        </option>
                                                        <option value="created_date" data-order="desc">Created date -
                                                            Newest
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-0 px-0">
                            <div class="row">
                                <div class="col-md-6 pr-0">
                                    <button class="btn btn-primary btn-block py-2" id="jobs_open">Availible
                                        (<span>0</span>)
                                    </button>
                                </div>
                                <div class="col-md-6 pl-0">
                                    <button class="btn btn-outline-success btn-block py-2" id="jobs_close">Close (<span>0</span>)
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 px-0">
                            <div class="row no-gutters px-0">
                                <div class="btn-group w-100" role="group" aria-label="Basic example">
                                    <div class="d-inline-flex">
                                        <button class="btn btn-outline-primary rounded-0" type="button"
                                                aria-expanded="false" data-toggle="modal" data-target="#jobfiltermodal"
                                                id="filters-modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0px"
                                                 y="0px" viewBox="0 0 511.999 511.999" xml:space="preserve"
                                                 height="20px" style="margin-bottom: -5px;">
                                                        <path d="M510.078,35.509c-3.388-7.304-10.709-11.977-18.761-11.977H20.682c-8.051,0-15.372,4.672-18.761,11.977    s-2.23,15.911,2.969,22.06l183.364,216.828v146.324c0,7.833,4.426,14.995,11.433,18.499l94.127,47.063    c2.919,1.46,6.088,2.183,9.249,2.183c3.782,0,7.552-1.036,10.874-3.089c6.097-3.769,9.809-10.426,9.809-17.594V274.397    L507.11,57.569C512.309,51.42,513.466,42.813,510.078,35.509z M287.27,253.469c-3.157,3.734-4.889,8.466-4.889,13.355V434.32    l-52.763-26.381V266.825c0-4.89-1.733-9.621-4.89-13.355L65.259,64.896h381.482L287.27,253.469z"
                                                              fill="#ffff"/>
                                                    </svg>
                                            <span>
                                                    Filters
                                                </span>
                                        </button>
                                    </div>
                                    <div class="d-flex w-100">
                                        <input type="text" class="form-control rounded-0 border-right-0 bg-light"
                                               placeholder="Find jobs by name" id="jobs-search">
                                    </div>


                                </div>
                                <!-- <div class="col-5 col-sm-4 col-md-3 col-lg-2">
                                    <div class="dropdown">

                                    </div>
                                </div>
                                <div class="col-7 col-sm-8 col-md-9 col-lg-10">

                                </div> -->
                            </div>
                        </div>
                        <div id="accordion2" role="tablist" class="col-md-12">
                            <div id="jobs-accordion-list">

                            </div>
                            <div class="card-body px-0 py-3 hide" id="map-items">
                                <div class="row justify-content-center">
                                    <div class="col-11">
                                        <div class="justify-content-center justify-content-md-start"
                                             id="jobs-list">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pagination-jobs">

                                    </ul>
                                </nav>
                            </div>
                        </div>

                        {{--<div class="col-md-11 mx-auto my-4" id="jobs-list"></div>--}}

                        {{--<div class="mx-auto mt-2">--}}
                        {{--<nav aria-label="Page navigation example">--}}
                        {{--<ul class="pagination pagination-jobs">--}}

                        {{--</ul>--}}
                        {{--</nav>--}}
                        {{--</div>--}}
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!--JOB FILTER MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="jobfiltermodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 750px;">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title" id="exampleModalLabel">Job Filter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body pb-3 pt-0">
                    <div class="card border-0">
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-6 mt-3">

                                    <div class="col-12 px-0 mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <small class="form-text text-muted mb-2">Hours a week
                                                </small>
                                                <input type="text" class="form-control"
                                                       placeholder="Hours/Week" id="filter-hours">
                                            </div>
                                            <div class="col-6">
                                                <small class="form-text text-muted mb-2">Salary</small>
                                                <input type="text" class="form-control"
                                                       placeholder="{{ trans('pages.salary_in') }}" id="filter-salary">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <small class="form-text text-muted mb-2">Department
                                        </small>
                                        <div id="department"></div>

                                    </div>

                                    {{--<div class="form-group mb-3">--}}
                                    {{--<small class="form-text text-muted mb-2">Job categories--}}
                                    {{--</small>--}}
                                    {{--<div id="job_category"></div>--}}

                                    {{--</div>--}}

                                    <div class="form-group mb-3">
                                        <small class="form-text text-muted mb-2">Languages
                                        </small>
                                        <div id="language_level"></div>

                                    </div>


                                </div>
                                <div class="col-6 mt-3">
                                    <div class="col-12 px-0 mb-3">
                                        <small class="form-text text-muted mb-2">Jobs availability</small>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                   class="custom-control-input" id="filter-job-open">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Only open jobs</span>
                                        </label>
                                    </div>


                                    <div class="form-group mb-3" style="margin-top: 25px;">
                                        <small class="form-text text-muted mb-2">Job types
                                        </small>
                                        <div id="job_type"></div>

                                    </div>

                                    <div class="form-group mb-3">
                                        <small class="form-text text-muted mb-2">Career level
                                        </small>
                                        <div id="career_level"></div>

                                    </div>

                                    <div class="form-group mb-3">
                                        <small class="form-text text-muted mb-2">Certifications
                                        </small>
                                        <div id="certification_required"></div>

                                    </div>

                                </div>

                                <div class="col-4 mx-auto mt-3">
                                    <button class="btn btn-outline-warning btn-block" id="clear-filters"
                                            type="button">Clear filters
                                    </button>
                                </div>
                                <div class="col-4 mx-auto mt-3">
                                    <button class="btn btn-primary btn-block" id="set-filters"
                                            type="button">Set filters
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JOB FILTER MODAL END!!!!!!!!!!!!!!! -->

@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('/css/animate.css')}}">
    <style type="text/css">

        #map-canvas {
            width: 100%;
            height: 500px;
        }
        .wrapper { position: relative; }
        .text_over {
            background-color: rgba(255,255,255,0.75);
            padding-top: 7px;
            padding-bottom: 7px;
            padding-left: 20px;
            padding-right: 10px;
            position: absolute;
            bottom: 25px;
            right:60px;
            z-index: 99;
            display: flex;
            border-radius: 10px; }

        .text_over_center {
            background-color: rgba(255,255,255,0.75);
            padding-top: 12px;
            /*padding-bottom: 7px;*/
            padding-left: 20px;
            padding-right: 20px;
            position: absolute;
            bottom: 5px;
            right:40%;
            z-index: 99;
            display: flex;
            border-radius: 10px;
            animation-delay: 2s;
        }

        /*v.0.0.3*/
        .outer{
            padding: 0px;
            height:100%;
            display:flex;
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
        .marker{
            border-radius: 5px;
            vertical-align: middle;
            color:#fff;
            box-sizing: border-box;
            z-index: 100;
            border:0px solid rgba(0, 0, 0, .05);
            text-align: center;
            -webkit-box-shadow: 0px 11px 40px -8px rgba(0,0,0,0.5);
            -moz-box-shadow: 0px 11px 40px -8px rgba(0,0,0,0.5);
            box-shadow: 0px 11px 40px -8px rgba(0,0,0,0.5);
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
            0%, 40%, 100% { -webkit-transform: scaleY(0.4) }
            20% { -webkit-transform: scaleY(1.0) }
        }

        @keyframes sk-stretchdelay {
            0%, 40%, 100% {
                transform: scaleY(0.4);
                -webkit-transform: scaleY(0.4);
            }  20% {
                   transform: scaleY(1.0);
                   -webkit-transform: scaleY(1.0);
               }
        }
    </style>
@endsection
@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyD3mcG8oAZzzlCSGZt5B4u5h5LmBX1SgjE"></script>
    <script src="{{ asset('/js/app/CustomGoogleMapMarker.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/location-view.js?v='.time()) }}"></script>
@endsection
