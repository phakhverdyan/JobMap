@extends('layouts.common_user')

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
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-11 col-xl-10 text-center my-5">
                    <div class="card mb-4 mb-sm-5">
                        <div class="card-body py-3">
                            <div class="row justify-content-center">
                                <div class="col-11">
                                    <div class="row justify-content-center">
                                        <div class="col-7 col-sm-6">
                                            <div class="bg-white" style="margin-top: -50px">
                                                <a href="/jobmap/landing"
                                                   class="btn btn-lg btn-primary w-100 py-2 py-md-3" type="button">
                                                    Back to Map
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-right mt-2 mt-sm-0 mb-2">
                                                <div class="d-inline-block bg-white">
                                                    <button class="btn btn-lg btn-outline-primary" type="button">
                                                    <span class="d-flex align-items-center justify-content-center">
                                                        <svg version="1.1" id="Capa_1" class="mr-2"
                                                             xmlns="http://www.w3.org/2000/svg" width="20px"
                                                             height="20px" x="0px" y="0px" viewBox="0 0 475.075 475.075"
                                                             style="enable-background:new 0 0 475.075 475.075;"
                                                             xml:space="preserve">
                                                            <path d="M475.075,186.573c0-7.043-5.328-11.42-15.992-13.135L315.766,152.6L251.529,22.694c-3.614-7.804-8.281-11.704-13.99-11.704
                                                                c-5.708,0-10.372,3.9-13.989,11.704L159.31,152.6L15.986,173.438C5.33,175.153,0,179.53,0,186.573c0,3.999,2.38,8.567,7.139,13.706
                                                                l103.924,101.068L86.51,444.096c-0.381,2.666-0.57,4.575-0.57,5.712c0,3.997,0.998,7.374,2.996,10.136
                                                                c1.997,2.766,4.993,4.142,8.992,4.142c3.428,0,7.233-1.137,11.42-3.423l128.188-67.386l128.194,67.379
                                                                c4,2.286,7.806,3.43,11.416,3.43c7.812,0,11.714-4.75,11.714-14.271c0-2.471-0.096-4.374-0.287-5.716l-24.551-142.744
                                                                l103.634-101.069C472.604,195.33,475.075,190.76,475.075,186.573z M324.619,288.5l20.551,120.2l-107.634-56.821L129.614,408.7
                                                                l20.843-120.2l-87.365-84.799l120.484-17.7l53.959-109.064l53.957,109.064l120.494,17.7L324.619,288.5z"
                                                                  fill="#4266ff"/>
                                                        </svg>
                                                        Follow
                                                    </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex align-items-center justify-content-center mb-3">
                                            <!-- <img class="mr-3" src="../img/CA-large.png" alt="large-flag"> -->
                                            <h3 class="h3 mb-0" id="name"></h3>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-right mb-2 px-3">
                                            <div class="d-inline-flex align-items-center">
                                                <svg version="1.1" class="mr-2" id="Capa_1"
                                                     xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                                                     x="0px" y="0px"
                                                     viewBox="0 0 488.6 488.6"
                                                     style="enable-background:new 0 0 488.6 488.6;"
                                                     xml:space="preserve">
														<path d="M480.9,333.2c-27.2-22.3-56.5-37.1-62.4-40c-0.7-0.3-1.1-1-1.1-1.8v-42.3c5.3-3.5,8.8-9.6,8.8-16.5v-43.9
															c0-21.8-17.7-39.5-39.5-39.5H382h-4.7c-21.8,0-39.5,17.7-39.5,39.5v43.9c0,6.9,3.5,12.9,8.8,16.5v42.3c0,0.3-0.1,0.5-0.1,0.7
															c8.3,5.7,17,12.1,25.5,19.1c9.9,8.2,15.6,20.2,15.6,33.2v35.3h101v-30.1C488.6,343.3,485.8,337.2,480.9,333.2z"
                                                              fill="#4266ff"/>
                                                    <path d="M142,291.4v-42.3c5.3-3.5,8.8-9.6,8.8-16.5v-43.9c0-21.8-17.7-39.5-39.5-39.5h-4.7h-4.7c-21.8,0-39.5,17.7-39.5,39.5v43.9
															c0,6.9,3.5,12.9,8.8,16.5v42.3c0,0.7-0.4,1.4-1.1,1.8c-6,2.9-35.3,17.7-62.4,40c-4.9,4-7.7,10.1-7.7,16.4v30.1h101v-35.3
															c0-12.9,5.7-25,15.6-33.2c8.5-7,17.2-13.4,25.5-19.1C142.1,291.9,142,291.7,142,291.4z"
                                                          fill="#4266ff"/>
                                                    <path d="M360.5,325.1c-31.9-26.2-66.3-43.6-73.4-47.1c-0.8-0.4-1.3-1.2-1.3-2.1v-49.7c6.2-4.2,10.4-11.3,10.4-19.3v-51.6
															c0-25.6-20.8-46.4-46.4-46.4h-5.5h-5.5c-25.6,0-46.4,20.8-46.4,46.4v51.5c0,8.1,4.1,15.2,10.4,19.3v49.7c0,0.9-0.5,1.7-1.3,2.1
															c-7,3.4-41.4,20.8-73.4,47.1c-5.8,4.7-9.1,11.8-9.1,19.3v35.3h108.9l10.8-49.3c-21.7-30.3,1.6-31.8,5.7-31.8l0,0l0,0
															c4.1,0,27.4,1.5,5.7,31.8l10.8,49.3h108.9v-35.3C369.6,336.9,366.3,329.8,360.5,325.1z"
                                                          fill="#4266ff"/>
												</svg>
                                                <p class="mb-0">"#" Followers</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-5 items-group" data-group="locations">
                        <div class="card-header p-0 border-0 bg-white border-bottom-0">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 py-2" style="border-bottom:2px solid #eee;">
                                        <div class="row">
                                            <div class="col-md-8 text-left" id="page-limit-location">
                                                <span class="pr-1">Per page:</span>
                                                <span class="perpage h6 px-1 activesortamount"><a
                                                            href="javascript:void(0)"
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
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                         id="Capa_1" x="0px" y="0px" viewBox="0 0 50 50"
                                                         xml:space="preserve" class="filtersvg">
                                                    <g>
                                                        <rect y="3" width="50" height="2"></rect>
                                                        <rect y="17" width="50" height="2"></rect>
                                                        <rect y="31" width="50" height="2"></rect>
                                                        <rect y="45" width="50" height="2"></rect>
                                                    </g>
                                                    </svg>
                                                </span>
                                                <span class="blockorlist h6 ml-1" data-type="map">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                         id="Capa_1" x="0px" y="0px" width="22px" height="18px"
                                                         viewBox="0 0 965.199 965.199" xml:space="preserve"
                                                         class="filtersvg">
                                                    <g>
                                                        <path d="M263.85,30c0-16.6-13.4-30-30-30h-202c-16.6,0-30,13.4-30,30v202.1c0,16.6,13.4,30,30,30h202.1c16.6,0,30-13.4,30-30V30   H263.85z"></path>
                                                        <path d="M613.55,30c0-16.6-13.4-30-30-30h-202c-16.6,0-30,13.4-30,30v202.1c0,16.6,13.4,30,30,30h202c16.6,0,30-13.4,30-30V30z"></path>
                                                        <path d="M963.25,30c0-16.6-13.4-30-30-30h-202c-16.601,0-30,13.4-30,30v202.1c0,16.6,13.399,30,30,30h202.1c16.601,0,30-13.4,30-30   V30H963.25z"></path>
                                                        <path d="M263.85,381.6c0-16.6-13.4-30-30-30h-202c-16.6,0-30,13.4-30,30v202c0,16.6,13.4,30,30,30h202.1c16.6,0,30-13.4,30-30v-202   H263.85z"></path>
                                                        <path d="M613.55,381.6c0-16.6-13.4-30-30-30h-202c-16.6,0-30,13.4-30,30v202c0,16.6,13.4,30,30,30h202c16.6,0,30-13.4,30-30V381.6z   "></path>
                                                        <path d="M963.25,381.6c0-16.6-13.4-30-30-30h-202c-16.601,0-30,13.4-30,30v202c0,16.6,13.399,30,30,30h202.1   c16.601,0,30-13.4,30-30v-202H963.25z"></path>
                                                        <path d="M233.85,703.1h-202c-16.6,0-30,13.4-30,30v202.1c0,16.602,13.4,30,30,30h202.1c16.6,0,30-13.398,30-30V733.1   C263.85,716.6,250.45,703.1,233.85,703.1z"></path>
                                                        <path d="M583.55,703.1h-202c-16.6,0-30,13.4-30,30v202.1c0,16.602,13.4,30,30,30h202c16.6,0,30-13.398,30-30V733.1   C613.55,716.6,600.149,703.1,583.55,703.1z"></path>
                                                        <path d="M933.25,703.1h-202c-16.601,0-30,13.4-30,30v202.1c0,16.602,13.399,30,30,30h202.1c16.601,0,30-13.398,30-30V733.1   C963.25,716.6,949.85,703.1,933.25,703.1z"></path>
                                                    </g>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pb-2">
                                        <div class="d-flex justify-content-end">
                                            <div class="text-center pt-2 mt-1 pr-0 pr-2">
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
                                            <div class="pt-2 pl-0">
                                                <select class="form-control form-control-sm" id="locations-sort">
                                                    <option value="name" data-order="asc">Name A-Z</option>
                                                    <option value="name" data-order="desc">Name Z-A</option>
                                                    <option value="street" data-order="asc">Street A-Z</option>
                                                    <option value="street" data-order="desc">Street Z-A</option>
                                                    <option value="city" data-order="asc">City A-Z</option>
                                                    <option value="city" data-order="desc">City Z-A</option>
                                                    <option value="created_date" data-order="asc">Created date -
                                                        Oldest
                                                    </option>
                                                    <option value="created_date" data-order="desc">Created date
                                                        - Newest
                                                    </option>
                                                </select>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row no-gutters px-0">

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                            <input type="text"
                                                   class="form-control rounded-0 border-right-0 border-left-0 bg-light"
                                                   placeholder="Find locations by name or address or job type"
                                                   id="locations-search">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="accordion" role="tablist">
                                <div id="location-accordion-items">

                                </div>
                                <div class="card-body px-0 py-3 hide" id="map-items">
                                    <div class="row justify-content-center">
                                        <div class="col-11">
                                            <div class="row justify-content-center justify-content-md-start"
                                                 id="location-items">

                                            </div>
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination pagination-location">

                                                </ul>
                                            </nav>
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
@endsection
@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key={{ env('GOOGLE_MAPS_API_KEY', 'AIzaSyCLDOlFEBqX8B8bwiURqNObe5V5xrJrftw') }}"></script>
    <script src="{{ asset('/js/app/job-map-location-view.js?v='.time()) }}"></script>
@endsection