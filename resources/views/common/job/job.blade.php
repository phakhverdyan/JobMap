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
    <div id="job-view" class="hide">
        <!-- left menu begin -->
        <!-- <div class="col-md-3">menu</div> -->
        <!-- left menu eof -->

        <!-- content block begin-->
        <div class="col-md-6 mx-auto pb-5 border" style="margin-top: -15px;">
            <div class="row">

                <div class="col-md-12" id="map" style="height: 150px; margin-bottom: -29px;"></div>

                <div class="text-center mx-auto" style="margin-bottom: -10px; z-index: 1;">
                    <button class="btn btn-outline-primary px-5" id="map-resize" data-map="1" data-text="smaller map">
                        bigger map
                    </button>
                </div>

                <div class="col-md-12 mx-auto bg-white rounded-0 pb-2" style="padding-top: 25px;">
                    <div class="row">

                        <div class="col-md-4 mx-auto pt-1">
                            <a class="btn btn-primary btn-block py-1" id="business-location-page">Location</a>
                        </div>

                        <div class="col-md-4 mx-auto pt-1">
                            <a class="btn btn-primary btn-block py-1" id="business-career-page">Career page</a>
                        </div>


                        <div class="col-md-12 pt-3">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="pl-3"><img class="location-icon"
                                                               src="{{ asset('img/profilepic2.png') }}"
                                                               style="width: 135px;"></div>
                                        <div class="col-md-9">
                                            <h4 id="job-title">Job title</h4>
                                            <p class="mb-4"></p>
                                            <p class="mb-1"><img src="{{ asset('img/sidebar/locations.png') }}"/><a
                                                        href="#" style="text-decoration: none;"
                                                        id="job-location-address"> Location address </a>
                                            </p>
                                            <p class="mb-1"><img src="{{ asset('img/call-answer.png') }}"/><a href="#"
                                                                                                              style="text-decoration: none;"
                                                                                                              id="job-location-phone">
                                                    Phone number </a></p>
                                            <p class="mb-1"><img src="{{ asset('img/grid-world.png') }}"/><a href="#"
                                                                                                             style="text-decoration: none;"
                                                                                                             id="job-business-website">
                                                    Website </a></p>
                                        </div>
                                    </div>
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
                                            "#" Followers </a></p>
                                    <p class="mb-1"><img src="{{ asset('img/sidebar/account.png') }}"/><a href="#"
                                                                                                          style="text-decoration: none;">
                                            "#" Employees </a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 text-center py-5">
                            <h6>Job description</h6>
                            <p id="job-description">Lorem lorem lorem lorem lorem loremlorem lorem lorem lorem lorem
                                loremloremlorem</p>
                        </div>

                        <div class="col-md-4 mx-auto text-center">
                            <h5 id="job-types">Job type</h5>
                        </div>

                        <div class="col-md-4 mx-auto text-center">
                            <h5 id="job-hours">Hours/Week</h5>
                        </div>

                        <div class="col-md-12 pt-3">

                            <div class="table">
                                <table class="w-100" style="table-layout: fixed">
                                    <thead>
                                    <tr class="text-center">
                                        <th colspan="2" class="table-heading border-0 text-center"></th>
                                        <th class="table-heading border-0 text-center">
                                            <svg version="1.1" id="Layer_1" width="20px" height="20px"
                                                 xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 91 91"
                                                 enable-background="new 0 0 91 91" xml:space="preserve">
                                                                            <path d="M45.5,32.4c2.2,0,4-1.8,4-4v-8.1c0-2.2-1.8-4-4-4s-4,1.8-4,4v8.1C41.5,30.7,43.3,32.4,45.5,32.4z"
                                                                                  fill="#4266ff"></path>
                                                <path d="M69,42c1,0,2-0.4,2.8-1.2l5.8-5.8c1.6-1.6,1.6-4.1,0-5.7c-1.6-1.6-4.1-1.6-5.7,0l-5.8,5.8c-1.6,1.6-1.6,4.1,0,5.7
                                                                                C67,41.6,68,42,69,42z"
                                                      fill="#4266ff"></path>
                                                <path d="M19.2,40.8C19.9,41.6,21,42,22,42c1,0,2-0.4,2.8-1.2c1.6-1.6,1.6-4.1,0-5.7l-5.8-5.8c-1.6-1.6-4.1-1.6-5.7,0
                                                                                c-1.6,1.6-1.6,4.1,0,5.7L19.2,40.8z"
                                                      fill="#4266ff"></path>
                                                <path d="M86.9,66.7H4.1c-2.2,0-4,1.8-4,4s1.8,4,4,4h82.8c2.2,0,4-1.8,4-4S89.1,66.7,86.9,66.7z"
                                                      fill="#4266ff"></path>
                                                <path d="M27.1,60.8c2.1,0.6,4.3-0.7,4.9-2.9c1.6-6.2,7.2-10.5,13.6-10.5s12,4.3,13.6,10.5c0.5,1.8,2.1,3,3.9,3c0.3,0,0.7,0,1-0.1
                                                                                c2.1-0.6,3.4-2.7,2.9-4.9c-2.5-9.7-11.3-16.5-21.3-16.5c-10,0-18.8,6.8-21.3,16.5C23.6,58.1,24.9,60.3,27.1,60.8z"
                                                      fill="#4266ff"></path>
                                                                        </svg>
                                        </th>
                                        <th class="table-heading border-0 text-center">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                 width="20px"
                                                 height="20px" x="0px" y="0px" viewBox="0 0 91 91"
                                                 enable-background="new 0 0 91 91" xml:space="preserve">
                                                                            <path d="M45.5,23.5c-12.1,0-22,9.9-22,22c0,12.1,9.9,22,22,22c12.1,0,22-9.9,22-22C67.5,33.4,57.6,23.5,45.5,23.5z M45.5,59.5
                                                                                c-7.7,0-14-6.3-14-14c0-7.7,6.3-14,14-14c7.7,0,14,6.3,14,14C59.5,53.2,53.2,59.5,45.5,59.5z"
                                                                                  fill="#4266ff"></path>
                                                <path d="M45.5,16.2c2.2,0,4-1.8,4-4V4.1c0-2.2-1.8-4-4-4c-2.2,0-4,1.8-4,4v8.1C41.5,14.5,43.3,16.2,45.5,16.2z"
                                                      fill="#4266ff"></path>
                                                <path d="M86.9,41.5h-8.1c-2.2,0-4,1.8-4,4c0,2.2,1.8,4,4,4h8.1c2.2,0,4-1.8,4-4C90.9,43.3,89.1,41.5,86.9,41.5z"
                                                      fill="#4266ff"></path>
                                                <path d="M45.5,74.8c-2.2,0-4,1.8-4,4v8.1c0,2.2,1.8,4,4,4c2.2,0,4-1.8,4-4v-8.1C49.5,76.5,47.7,74.8,45.5,74.8z"
                                                      fill="#4266ff"></path>
                                                <path d="M16.2,45.5c0-2.2-1.8-4-4-4H4.1c-2.2,0-4,1.8-4,4c0,2.2,1.8,4,4,4h8.1C14.5,49.5,16.2,47.7,16.2,45.5z"
                                                      fill="#4266ff"></path>
                                                <path d="M69,26c1,0,2-0.4,2.8-1.2l5.8-5.8c1.6-1.6,1.6-4.1,0-5.7c-1.6-1.6-4.1-1.6-5.7,0l-5.8,5.8c-1.6,1.6-1.6,4.1,0,5.7
                                                                                C67,25.6,68,26,69,26z"
                                                      fill="#4266ff"></path>
                                                <path d="M71.8,66.2c-1.6-1.6-4.1-1.6-5.7,0c-1.6,1.6-1.6,4.1,0,5.7l5.8,5.8c0.8,0.8,1.8,1.2,2.8,1.2c1,0,2-0.4,2.8-1.2
                                                                                c1.6-1.6,1.6-4.1,0-5.7L71.8,66.2z"
                                                      fill="#4266ff"></path>
                                                <path d="M19.2,66.2l-5.8,5.8c-1.6,1.6-1.6,4.1,0,5.7c0.8,0.8,1.8,1.2,2.8,1.2c1,0,2-0.4,2.8-1.2l5.8-5.8c1.6-1.6,1.6-4.1,0-5.7
                                                                                C23.3,64.6,20.7,64.6,19.2,66.2z"
                                                      fill="#4266ff"></path>
                                                <path d="M19.2,24.8C19.9,25.6,21,26,22,26c1,0,2-0.4,2.8-1.2c1.6-1.6,1.6-4.1,0-5.7l-5.8-5.8c-1.6-1.6-4.1-1.6-5.7,0
                                                                                c-1.6,1.6-1.6,4.1,0,5.7L19.2,24.8z"
                                                      fill="#4266ff"></path>
                                                                        </svg>
                                        </th>
                                        <th class="table-heading border-0 text-center">
                                            <svg version="1.1" id="Layer_1" width="20px" height="20px"
                                                 xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 91 91"
                                                 enable-background="new 0 0 91 91" xml:space="preserve">
                                                                            <path d="M45.5,26.3c2.2,0,4-1.8,4-4v-8.1c0-2.2-1.8-4-4-4s-4,1.8-4,4v8.1C41.5,24.5,43.3,26.3,45.5,26.3z"
                                                                                  fill="#4266ff"></path>
                                                <path d="M74.8,55.6c0,2.2,1.8,4,4,4h8.1c2.2,0,4-1.8,4-4s-1.8-4-4-4h-8.1C76.5,51.6,74.8,53.4,74.8,55.6z"
                                                      fill="#4266ff"></path>
                                                <path d="M4.1,59.6h8.1c2.2,0,4-1.8,4-4s-1.8-4-4-4H4.1c-2.2,0-4,1.8-4,4S1.9,59.6,4.1,59.6z"
                                                      fill="#4266ff"></path>
                                                <path d="M69,36.1c1,0,2-0.4,2.8-1.2l5.8-5.8c1.6-1.6,1.6-4.1,0-5.7c-1.6-1.6-4.1-1.6-5.7,0l-5.8,5.8c-1.6,1.6-1.6,4.1,0,5.7
                                                                                C67,35.7,68,36.1,69,36.1z"
                                                      fill="#4266ff"></path>
                                                <path d="M19.2,34.9c0.8,0.8,1.8,1.2,2.8,1.2c1,0,2-0.4,2.8-1.2c1.6-1.6,1.6-4.1,0-5.7l-5.8-5.8c-1.6-1.6-4.1-1.6-5.7,0
                                                                                c-1.6,1.6-1.6,4.1,0,5.7L19.2,34.9z"
                                                      fill="#4266ff"></path>
                                                <path d="M25.5,64.7c0.9,2,3.3,2.9,5.3,2c2-0.9,2.9-3.3,2-5.3c-0.8-1.8-1.3-3.8-1.3-5.8c0-7.7,6.3-14,14-14s14,6.3,14,14
                                                                                c0,2-0.4,4-1.3,5.8c-0.9,2,0,4.4,2,5.3c0.5,0.2,1.1,0.4,1.7,0.4c1.5,0,3-0.9,3.6-2.3c1.3-2.9,2-6,2-9.1c0-12.1-9.9-22-22-22
                                                                                c-12.1,0-22,9.9-22,22C23.5,58.8,24.2,61.8,25.5,64.7z"
                                                      fill="#4266ff"></path>
                                                <path d="M86.9,72.8H4.1c-2.2,0-4,1.8-4,4s1.8,4,4,4h82.8c2.2,0,4-1.8,4-4S89.1,72.8,86.9,72.8z"
                                                      fill="#4266ff"></path>
                                                                        </svg>
                                        </th>
                                        <th class="table-heading border-0 text-center">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                 width="20px"
                                                 height="20px" x="0px" y="0px" viewBox="0 0 91 91"
                                                 enable-background="new 0 0 91 91" xml:space="preserve">
                                                                        <path d="M47.2,78.1c-11.6,0-22.5-6.3-28.3-16.3c-9-15.6-3.6-35.6,11.9-44.6c5.3-3.1,11.5-4.6,17.6-4.3c1.5,0.1,2.8,0.9,3.4,2.2
                                                                            c0.7,1.3,0.5,2.9-0.3,4.1c-5,7.2-5.4,16.8-1,24.3c4.1,7,11.6,11.4,19.8,11.4c0.6,0,1.2,0,1.8-0.1c1.5-0.1,2.9,0.6,3.7,1.8
                                                                            c0.8,1.2,0.9,2.8,0.2,4.1c-2.9,5.5-7.2,10-12.6,13.1C58.5,76.6,52.9,78.1,47.2,78.1z M41.4,21.5c-2.3,0.5-4.5,1.4-6.6,2.6
                                                                            C23.1,31,19,46.1,25.8,57.8c4.4,7.6,12.6,12.3,21.4,12.3c4.3,0,8.5-1.1,12.3-3.3c2.1-1.2,4-2.7,5.6-4.4c-8.9-1.6-16.8-7-21.4-14.9
                                                                            C39.1,39.5,38.4,30,41.4,21.5z"
                                                                              fill="#4266ff"></path>
                                                                        </svg>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-left">
                                    <?php
                                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                    ?>
                                    @for($d = 1; $d <= 7; ++$d)
                                        <tr class="text-center">
                                            <td colspan="2" class="text-left">{{ $days[$d - 1] }}</td>
                                            @for($i = 1; $i <= 4; ++$i)
                                                <td class="align-middle">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <label class="custom-control custom-checkbox m-0 pl-3">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   name="time_{{ $i }}" data-parent-time="{{ $i - 1 }}"
                                                                   value="{{ $d }}" onclick="return false;">
                                                            <span class="custom-control-indicator"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            @endfor
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-4 mx-auto text-center">
                            <h5 id="job-salary-type">Salary type</h5>
                        </div>

                        <div class="col-md-4 mx-auto text-center">
                            <h5 id="job-salary">Salary</h5>
                        </div>

                        <div class="col-md-12" id="job-languages">
                            <small>Speaking languages</small>
                            <p></p>
                        </div>

                        <div class="col-md-12" id="job-certifications">
                            <small>Certifications</small>
                            <p></p>
                        </div>

                        <div class="col-md-12" id="job-career">
                            <small>Career levels</small>
                            <p></p>
                        </div>

                        <div class="col-md-12" id="job-notes">
                            <small>Special notes</small>
                            <p></p>
                        </div>

                    </div>

                </div>


                <div class="col-md-12 card rounded-0 mt-3 job-group" data-group="locations" id="locations">
                    <div class="row">
                        <div class="col-md-12 card rounded-0 border-right-0 border-left-0 border-top-0">
                            <div class="row">
                                <div class="col-md-12 py-2" style="border-bottom:2px solid #eee;">
                                    <div class="row">
                                        <div class="col-md-8" id="page-limit-headquarters">
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
														<span class="blockorlist h6 mr-1 ml-3">
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
                                            <span class="blockorlist h6 ml-1">
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
                                            <p class="mb-1 h6">Nearby Locations all companies</p>
                                            <select id="locations-nearby">
                                                <option value="1">1 KM</option>
                                                @for($i = 5; $i <= 80; $i+=5)
                                                    <option value="{{ $i }}">{{ $i }} KM</option>
                                                @endfor
                                            </select>
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
                                                    <select class="form-control form-control-sm" id="locations-sort">
                                                        <option value="name" data-order="asc">Name A-Z</option>
                                                        <option value="name" data-order="desc">Name Z-A</option>
                                                        <option value="street" data-order="asc">Street A-Z</option>
                                                        <option value="street" data-order="desc">Street Z-A</option>
                                                        <option value="city" data-order="asc">City A-Z</option>
                                                        <option value="city" data-order="desc">City Z-A</option>
                                                        <option value="country" data-order="asc">Country A-Z
                                                        </option>
                                                        <option value="country" data-order="desc">Country Z-A
                                                        </option>
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
                            </div>
                        </div>

                        <div class="col-md-12 px-0">
                            <div class="row no-gutters px-0">

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input type="text"
                                           class="form-control rounded-0 border-right-0 border-left-0 bg-light"
                                           placeholder="Search for a location name or address" id="locations-search">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-11 mx-auto my-4" id="locations-list"></div>

                        <div class="mx-auto mt-2">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-locations">

                                </ul>
                            </nav>
                        </div>

                    </div>

                </div>

                <div class="col-md-12 card rounded-0 mt-3 job-group" data-group="jobs" id="jobs">
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
														<span class="blockorlist h6 mr-1 ml-3">
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
                                            <span class="blockorlist h6 ml-1">
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
                                            <p class="mb-1 h6">Nearby Available Jobs</p>
                                            <select id="jobs-nearby">
                                                <option value="1">1 KM</option>
                                                @for($i = 5; $i <= 80; $i+=5)
                                                    <option value="{{ $i }}">{{ $i }} KM</option>
                                                @endfor
                                            </select>
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
                                               placeholder="Find jobs by name or address" id="jobs-search">
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

                        <div class="col-md-11 mx-auto my-4" id="jobs-list"></div>

                        <div class="mx-auto mt-2">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-jobs">

                                </ul>
                            </nav>
                        </div>
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

    <div class="modal fade" id="modal-job-locations-list" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <div class="text-right mb-2">
                        <button type="button" class="close float-none" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="d-flex align-items-baseline justify-content-between">
                        <h5 class="modal-title" style="flex: 1" id="modal-job-name">Location address</h5>

                        <div class="d-flex align-items-center">
                            <p class="mb-0 mr-2 h6" id="count-job-locations">
                                available in <span></span> locations
                            </p>
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" width="20px"
                                 height="20px"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 477 477" style="enable-background:new 0 0 477 477;"
                                 xml:space="preserve">
                                <path d="M238.4,0C133,0,47.2,85.8,47.2,191.2c0,12,1.1,24.1,3.4,35.9c0.1,0.7,0.5,2.8,1.3,6.4c2.9,12.9,7.2,25.6,12.8,37.7
                                    c20.6,48.5,65.9,123,165.3,202.8c2.5,2,5.5,3,8.5,3s6-1,8.5-3c99.3-79.8,144.7-154.3,165.3-202.8c5.6-12.1,9.9-24.7,12.8-37.7
                                    c0.8-3.6,1.2-5.7,1.3-6.4c2.2-11.8,3.4-23.9,3.4-35.9C429.6,85.8,343.8,0,238.4,0z M399.6,222.4c0,0.2-0.1,0.4-0.1,0.6
                                    c-0.1,0.5-0.4,2-0.9,4.3c0,0.1,0,0.1,0,0.2c-2.5,11.2-6.2,22.1-11.1,32.6c-0.1,0.1-0.1,0.3-0.2,0.4
                                    c-18.7,44.3-59.7,111.9-148.9,185.6c-89.2-73.7-130.2-141.3-148.9-185.6c-0.1-0.1-0.1-0.3-0.2-0.4c-4.8-10.4-8.5-21.4-11.1-32.6
                                    c0-0.1,0-0.1,0-0.2c-0.6-2.3-0.8-3.8-0.9-4.3c0-0.2-0.1-0.4-0.1-0.7c-2-10.3-3-20.7-3-31.2c0-90.5,73.7-164.2,164.2-164.2
                                    s164.2,73.7,164.2,164.2C402.6,201.7,401.6,212.2,399.6,222.4z" fill="#4266ff"/>
                                <path d="M238.4,71.9c-66.9,0-121.4,54.5-121.4,121.4s54.5,121.4,121.4,121.4s121.4-54.5,121.4-121.4S305.3,71.9,238.4,71.9z
                                    M238.4,287.7c-52.1,0-94.4-42.4-94.4-94.4s42.4-94.4,94.4-94.4s94.4,42.4,94.4,94.4S290.5,287.7,238.4,287.7z"
                                      fill="#4266ff"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="modal-body">

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

        .wrapper {
            position: relative;
        }

        .text_over {
            background-color: rgba(255, 255, 255, 0.75);
            padding-top: 7px;
            padding-bottom: 7px;
            padding-left: 20px;
            padding-right: 10px;
            position: absolute;
            bottom: 25px;
            right: 60px;
            z-index: 99;
            display: flex;
            border-radius: 10px;
        }

        .text_over_center {
            background-color: rgba(255, 255, 255, 0.75);
            padding-top: 12px;
            /*padding-bottom: 7px;*/
            padding-left: 20px;
            padding-right: 20px;
            position: absolute;
            bottom: 5px;
            right: 40%;
            z-index: 99;
            display: flex;
            border-radius: 10px;
            animation-delay: 2s;
        }

        /*v.0.0.3*/
        .outer {
            padding: 0px;
            height: 100%;
            display: flex;
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
        .marker {
            border-radius: 5px;
            vertical-align: middle;
            color: #fff;
            box-sizing: border-box;
            z-index: 100;
            border: 0px solid rgba(0, 0, 0, .05);
            text-align: center;
            -webkit-box-shadow: 0px 11px 40px -8px rgba(0, 0, 0, 0.5);
            -moz-box-shadow: 0px 11px 40px -8px rgba(0, 0, 0, 0.5);
            box-shadow: 0px 11px 40px -8px rgba(0, 0, 0, 0.5);
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
@endsection
@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key={{ env('GOOGLE_MAPS_API_KEY', 'AIzaSyCLDOlFEBqX8B8bwiURqNObe5V5xrJrftw') }}"></script>
    <script src="{{ asset('/js/app/CustomGoogleMapMarker.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/job-view.js?v='.time()) }}"></script>
@endsection
