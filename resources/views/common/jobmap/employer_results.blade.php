@extends('layouts.jobmap.common_user')

@section('content')

<style type="text/css">
    .plus_icon:after {
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
          content: "\f054";
          transform: rotate(-90deg) ;
          transition: all linear 0.25s;
          float: right;
          margin-top: 3px;
          color:rgba(78,92,110,0.5);
          cursor: pointer;
          }   
        .plus_icon.collapsed:after {
          transform: rotate(90deg) ;
          margin-top: 5px;
        }
        .title_left_sorting {
            font-size: 14px;
            font-family: sans-regular;
            color: #4E5C6E;
        }
        .page-link{
            color: #0747a6!important;
        }
</style>

    <div class="container-fluid mt-3 user-landing">
        <div class="row" style="background: rgb(244, 247, 250);">
            <div class="container pb-5">

                <div class="col-12 mx-auto py-5 animated fadeInDown">
                    <div class="row">
                        <div class="col-5 pr-0" style="width: 300px;">
                            <label class="text-left" style="color:#555;">Job title, keywords or company</label>
                            <div class="form-control border d-flex"
                                 style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);">
                                <p class="my-0 mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                                         style="enable-background:new 0 0 512 512;width: 25px;height: 20px;vertical-align: middle;margin-top: 10px;fill:#0646a6;"
                                         xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M488.727,279.273c-6.982,0-11.636,4.655-11.636,11.636v151.273c0,6.982-4.655,11.636-11.636,11.636H46.545    c-6.982,0-11.636-4.655-11.636-11.636V290.909c0-6.982-4.655-11.636-11.636-11.636s-11.636,4.655-11.636,11.636v151.273    c0,19.782,15.127,34.909,34.909,34.909h418.909c19.782,0,34.909-15.127,34.909-34.909V290.909    C500.364,283.927,495.709,279.273,488.727,279.273z"/>
                                    </g>
                                </g>
                                        <g>
                                            <g>
                                                <path d="M477.091,116.364H34.909C15.127,116.364,0,131.491,0,151.273v74.473C0,242.036,11.636,256,26.764,259.491l182.691,40.727    v37.236c0,6.982,4.655,11.636,11.636,11.636h69.818c6.982,0,11.636-4.655,11.636-11.636v-37.236l182.691-40.727    C500.364,256,512,242.036,512,225.745v-74.473C512,131.491,496.873,116.364,477.091,116.364z M279.273,325.818h-46.545v-46.545    h46.545V325.818z M488.727,225.745c0,5.818-3.491,10.473-9.309,11.636l-176.873,39.564v-9.309c0-6.982-4.655-11.636-11.636-11.636    h-69.818c-6.982,0-11.636,4.655-11.636,11.636v9.309L32.582,237.382c-5.818-1.164-9.309-5.818-9.309-11.636v-74.473    c0-6.982,4.655-11.636,11.636-11.636h442.182c6.982,0,11.636,4.655,11.636,11.636V225.745z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M314.182,34.909H197.818c-19.782,0-34.909,15.127-34.909,34.909v11.636c0,6.982,4.655,11.636,11.636,11.636    s11.636-4.655,11.636-11.636V69.818c0-6.982,4.655-11.636,11.636-11.636h116.364c6.982,0,11.636,4.655,11.636,11.636v11.636    c0,6.982,4.655,11.636,11.636,11.636c6.982,0,11.636-4.655,11.636-11.636V69.818C349.091,50.036,333.964,34.909,314.182,34.909z"/>
                                            </g>
                                        </g>
                                </svg>
                                </p>
                                <input type="text" name="" placeholder="Barista, Nurse"
                                       style="font-size: 17px; border:none; box-shadow: none; padding: 9px 0;width: 100%">
                            </div>

                        </div>
                        <div class="col-5 px-0" style="width: 300px;">
                            <label class="text-left" style="color:#555;">Location</label>
                            <div class="form-control border d-flex"
                                 style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);">
                                <p class="my-0 mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                                         style="enable-background:new 0 0 512 512;width: 25px;height: 20px;vertical-align: middle;margin-top: 10px;fill:#0646a6;"
                                         xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M341.476,338.285c54.483-85.493,47.634-74.827,49.204-77.056C410.516,233.251,421,200.322,421,166    C421,74.98,347.139,0,256,0C165.158,0,91,74.832,91,166c0,34.3,10.704,68.091,31.19,96.446l48.332,75.84    C118.847,346.227,31,369.892,31,422c0,18.995,12.398,46.065,71.462,67.159C143.704,503.888,198.231,512,256,512    c108.025,0,225-30.472,225-90C481,369.883,393.256,346.243,341.476,338.285z M147.249,245.945    c-0.165-0.258-0.337-0.51-0.517-0.758C129.685,221.735,121,193.941,121,166c0-75.018,60.406-136,135-136    c74.439,0,135,61.009,135,136c0,27.986-8.521,54.837-24.646,77.671c-1.445,1.906,6.094-9.806-110.354,172.918L147.249,245.945z     M256,482c-117.994,0-195-34.683-195-60c0-17.016,39.568-44.995,127.248-55.901l55.102,86.463    c2.754,4.322,7.524,6.938,12.649,6.938s9.896-2.617,12.649-6.938l55.101-86.463C411.431,377.005,451,404.984,451,422    C451,447.102,374.687,482,256,482z"/>
                                    </g>
                                </g>
                                        <g>
                                            <g>
                                                <path d="M256,91c-41.355,0-75,33.645-75,75s33.645,75,75,75c41.355,0,75-33.645,75-75S297.355,91,256,91z M256,211    c-24.813,0-45-20.187-45-45s20.187-45,45-45s45,20.187,45,45S280.813,211,256,211z"/>
                                            </g>
                                        </g>
                                </svg>
                                </p>
                                <input type="text" name="" placeholder="Montreal, Quebec"
                                       style="font-size: 17px; border:none; box-shadow: none; padding: 9px 0;width: 100%">
                            </div>

                        </div>
                        <div class="col-2 pl-0">
                            <label class="text-right"><a href="{!! url('/advanced_search') !!}" class="cardinal_links">Advanced</a></label>
                            <button class="btn btn-primary w-100 border-top-left-0 border-bottom-left-0 cardinal_button">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     version="1.1" id="Capa_1" x="0px" y="0px" width="30px" height="30px"
                                     viewBox="0 0 485.213 485.213"
                                     style="enable-background:new 0 0 485.213 485.213; vertical-align: middle; margin-top: -4px; opacity: 0.8;"
                                     xml:space="preserve" fill="#fff">
                                    <g>
                                        <g>
                                            <path d="M363.909,181.955C363.909,81.473,282.44,0,181.956,0C81.474,0,0.001,81.473,0.001,181.955s81.473,181.951,181.955,181.951    C282.44,363.906,363.909,282.437,363.909,181.955z M181.956,318.416c-75.252,0-136.465-61.208-136.465-136.46    c0-75.252,61.213-136.465,136.465-136.465c75.25,0,136.468,61.213,136.468,136.465    C318.424,257.208,257.206,318.416,181.956,318.416z"/>
                                            <path d="M471.882,407.567L360.567,296.243c-16.586,25.795-38.536,47.734-64.331,64.321l111.324,111.324    c17.772,17.768,46.587,17.768,64.321,0C489.654,454.149,489.654,425.334,471.882,407.567z"/>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 mx-auto">
                    <div class="d-flex">

                        <!-- LEFT SECTION START -->
                        <div class="" style="width: 28%;">

                            <!-- CATEGORY SECTION START -->
                            <div class="bg-white rounded p-0">

                                <!-- ONE CATEGORY START -->
                                <div class="col-12 py-2" style="border-bottom:1px solid #e9ecef;">
                                    <a href="#" class="open_close_category cardinal_links">
                                        <span class="title_left_sorting"><strong>Date posted</strong></span>
                                        <span class="float-right plus_icon"></span> 
                                    </a>
                                    <div class="content_category">
                                        <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                            <li><a href="#" class="cardinal_links">24 hours</a></li>
                                            <li><a href="#" class="cardinal_links">7 days</a></li>
                                            <li><a href="#" class="cardinal_links">15 days</a></li>
                                            <li><a href="#" class="cardinal_links">30 days</a></li>
                                            <li><a href="#" class="cardinal_links">All</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- ONE CATEGORY END -->

                                <!-- ONE CATEGORY START -->
                                <div class="col-12 py-2" style="border-bottom:1px solid #e9ecef;">
                                    <a href="#" class="open_close_category cardinal_links">
                                        <span class="title_left_sorting"><strong>Job category</strong></span>
                                        <span class="float-right plus_icon"></span> 
                                    </a>
                                    <div class="content_category">
                                        <p class="mb-1 mt-3 px-2"><input type="text" name="" class="form-control" placeholder="Enter job category"></p>
                                        <p class="title_left_sorting mb-1 mt-2 px-2"><strong>Most popular</strong></p>
                                        <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                            <li><a href="#" class="cardinal_links">Accounting</a></li>
                                            <li><a href="#" class="cardinal_links">Administrative</a></li>
                                            <li><a href="#" class="cardinal_links">Animal Services</a></li>
                                        </ul>
                                        <p class="mb-0 mt-2 px-2">
                                            <a href="https://jobmap.co/explore-jobs" class="btn btn-outline-primary seeall_btn">See all</a>
                                        </p>
                                    </div>
                                </div>
                                <!-- ONE CATEGORY END -->

                                <!-- ONE CATEGORY START -->
                                <div class="col-12 py-2" style="border-bottom:1px solid #e9ecef;">
                                    <a href="#" class="open_close_category cardinal_links">
                                        <span class="title_left_sorting"><strong>Popular keywords</strong></span>
                                        <span class="float-right plus_icon"></span> 
                                    </a>
                                    <div class="content_category">
                                        <p class="mb-1 mt-3 px-2"><input type="text" name="" class="form-control" placeholder="Enter keywords"></p>
                                        <p class="title_left_sorting mb-1 mt-2 px-2"><strong>Most popular</strong></p>
                                        <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                            <li><a href="#" class="cardinal_links">Bicycle Store</a></li>
                                            <li><a href="#" class="cardinal_links">Chinese Restaurant</a></li>
                                            <li><a href="#" class="cardinal_links">Meal Takeaway</a></li>
                                            <li><a href="#" class="cardinal_links">Night Club</a></li>
                                            <li><a href="#" class="cardinal_links">Building Materials Supplier</a></li>
                                        </ul>
                                        <p class="mb-0 mt-2 px-2">
                                            <a href="/popular-keywords" class="btn btn-outline-primary seeall_btn">See all</a>
                                        </p>
                                    </div>
                                </div>
                                <!-- ONE CATEGORY END -->

                                <!-- ONE CATEGORY START -->
                                <div class="col-12 py-2" style="border-bottom:1px solid #e9ecef;">
                                    <a href="#" class="open_close_category cardinal_links">
                                        <span class="title_left_sorting"><strong>Employer type</strong></span>
                                        <span class="float-right plus_icon"></span> 
                                    </a>
                                    <div class="content_category">
                                        <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                            <li><a href="#" class="cardinal_links">Private Employer</a></li>
                                            <li><a href="#" class="cardinal_links">Franchisee</a></li>
                                            <li><a href="#" class="cardinal_links">Online Employer</a></li>
                                            <li><a href="#" class="cardinal_links">Hiring Firm</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- ONE CATEGORY END -->

                                <!-- ONE CATEGORY START -->
                                <div class="col-12 py-2" style="border-bottom:1px solid #e9ecef;">
                                    <a href="#" class="open_close_category cardinal_links">
                                        <span class="title_left_sorting"><strong>Industries</strong></span>
                                        <span class="float-right plus_icon"></span> 
                                    </a>
                                    <div class="content_category">
                                        <p class="mb-1 mt-3 px-2"><input type="text" name="" class="form-control" placeholder="Enter industry"></p>
                                        <p class="title_left_sorting mb-1 mt-2 px-2"><strong>Most popular</strong></p>
                                        <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                            <li><a href="#" class="cardinal_links">Accommodation</a></li>
                                            <li><a href="#" class="cardinal_links">Automotive</a></li>
                                            <li><a href="#" class="cardinal_links">Domestic Services</a></li>
                                            <li><a href="#" class="cardinal_links">Education &amp; Learning</a></li>
                                            <li><a href="#" class="cardinal_links">Entertainment</a></li>
                                        </ul>
                                        <p class="mb-0 mt-2 px-2">
                                            <a href="https://jobmap.co/explore-jobs" class="btn btn-outline-primary seeall_btn">See all</a>
                                        </p>
                                    </div>
                                </div>
                                <!-- ONE CATEGORY END -->

                                <!-- ONE CATEGORY START -->
                                <div class="col-12 py-2" style="border-bottom:1px solid #e9ecef;">
                                    <a href="#" class="open_close_category cardinal_links">
                                        <span class="title_left_sorting"><strong>Contract type</strong></span>
                                        <span class="float-right plus_icon"></span> 
                                    </a>
                                    <div class="content_category">
                                        <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                            <li><a href="#" class="cardinal_links">Full Time</a></li>
                                            <li><a href="#" class="cardinal_links">Part Time</a></li>
                                            <li><a href="#" class="cardinal_links">Intership</a></li>
                                            <li><a href="#" class="cardinal_links">Summer Position</a></li>
                                            <li><a href="#" class="cardinal_links">Graduate year Recruitment</a></li>
                                            <li><a href="#" class="cardinal_links">Field Placement</a></li>
                                            <li><a href="#" class="cardinal_links">Volounteer</a></li>
                                            <li><a href="#" class="cardinal_links">Contractual</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- ONE CATEGORY END -->

                                <!-- ONE CATEGORY START -->
                                <div class="col-12 py-2" style="border-bottom:1px solid #e9ecef;">
                                    <a href="#" class="open_close_category cardinal_links">
                                        <span class="title_left_sorting"><strong>Job type</strong></span>
                                        <span class="float-right plus_icon"></span> 
                                    </a>
                                    <div class="content_category">
                                        <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                            <li><a href="#" class="cardinal_links">Students</a></li>
                                            <li><a href="#" class="cardinal_links">Professionals</a></li>
                                            <li><a href="#" class="cardinal_links">First Job</a></li>
                                            <li><a href="#" class="cardinal_links">Specialized</a></li>
                                            <li><a href="#" class="cardinal_links">Freelance/Work from home</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- ONE CATEGORY END -->

                                <!-- ONE CATEGORY START -->
                                <div class="col-12 py-2" style="border-bottom:1px solid #e9ecef;">
                                    <a href="#" class="open_close_category cardinal_links">
                                        <span class="title_left_sorting"><strong>Career Level</strong></span>
                                        <span class="float-right plus_icon"></span> 
                                    </a>
                                    <div class="content_category">
                                        <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                            <li><a href="#" class="cardinal_links">Student</a></li>
                                            <li><a href="#" class="cardinal_links">Entry-Level</a></li>
                                            <li><a href="#" class="cardinal_links">Intermediate</a></li>
                                            <li><a href="#" class="cardinal_links">Middle Management</a></li>
                                            <li><a href="#" class="cardinal_links">Upper Management</a></li>
                                            <li><a href="#" class="cardinal_links">Executive</a></li>
                                            <li><a href="#" class="cardinal_links">Custom</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- ONE CATEGORY END -->

                                <!-- ONE CATEGORY START -->
                                <div class="col-12 py-2" style="border-bottom:1px solid #e9ecef;">
                                    <a href="#" class="open_close_category cardinal_links">
                                        <span class="title_left_sorting"><strong>Shift Type</strong></span>
                                        <span class="float-right plus_icon collapsed"></span> 
                                    </a>
                                    <div class="content_category" style="display: none;">
                                        <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                            <li><a href="#" class="cardinal_links">Morning</a></li>
                                            <li><a href="#" class="cardinal_links">Day</a></li>
                                            <li><a href="#" class="cardinal_links">Evening</a></li>
                                            <li><a href="#" class="cardinal_links">Night</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- ONE CATEGORY END -->

                                <!-- ONE CATEGORY START -->
                                <div class="col-12 py-2">
                                    <a href="#" class="open_close_category cardinal_links">
                                        <span class="title_left_sorting"><strong>Business Size</strong></span>
                                        <span class="float-right plus_icon collapsed"></span> 
                                    </a>
                                    <div class="content_category" style="display: none;">
                                        <ul class="pl-2 mb-2 mt-2" style="list-style: none;">
                                            <li><a href="#" class="cardinal_links">1-5</a></li>
                                            <li><a href="#" class="cardinal_links">5-10</a></li>
                                            <li><a href="#" class="cardinal_links">10-25</a></li>
                                            <li><a href="#" class="cardinal_links">25-100</a></li>
                                            <li><a href="#" class="cardinal_links">100-500</a></li>
                                            <li><a href="#" class="cardinal_links">500-2000</a></li>
                                            <li><a href="#" class="cardinal_links">2000-5000</a></li>
                                            <li><a href="#" class="cardinal_links">5000-10000</a></li>
                                            <li><a href="#" class="cardinal_links">10000+</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- ONE CATEGORY END -->

                            </div>
                            <!-- CATEGORY SECTION END -->

                        </div>
                        <!-- LEFT SECTION END -->

                        <!-- RIGHT SECTION START -->
                        <div class="px-0" style="width: 71%; margin-left: 20px;">
                            <div class="col-12 py-2 mb-3 bg-white rounded d-flex">
                                <div class="pt-2 text-center text-lg-left">Displaying Employers 1-50 of 100,000</div>
                                <div class="ml-auto d-flex">
                                    <a href="https://jobmap.co/job_results" class="cardinal_links pt-2">Jobs</a>
                                    <a href="https://jobmap.co/employer_results" class="cardinal_links ml-3 pt-2">Employer</a>
                                    <div class="d-flex mr-0 pt-1 ml-4">
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
                                        <select class="border-0 form-control form-control-sm" id="jobs-sort">
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
                                    <div class="pt-1 mr-2" id="page-limit-headquarters">
                                        <select class="border-0 form-control form-control-sm" id="jobs-limit">
                                            <option value="3">3 Per page</option>
                                            <option value="6">6 Per page</option>
                                            <option value="9">9 Per page</option>
                                            <option value="12">12 Per page</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 px-0 bg-white rounded">
                                <!-- ONE JOB START -->
                                <div class="col-12 px-0">
                                    <div class="d-flex p-3" style="border-bottom:1px solid #e9ecef;">
                                        <div class="">
                                            <img src="{{ asset('img/dhl.png') }}" class="rounded" style="width: 60px; height: 60px;">
                                        </div>
                                        <div class="ml-4 w-100">
                                            <div class="d-flex justify-content-between">
                                                <div class="mb-2" style="width: 90%;">
                                                    <a href="#" class="cardinal_links" style="font-size: 18px;">DHL Company</a> 
                                                </div>
                                                <div class="pt-1" style="opacity: 0.4;">
                                                    <span data-toggle="tooltip" title="Coming Soon">
                                                        <a href="#">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 488.501 488.5" style="enable-background:new 0 0 488.501 488.5; vertical-align: middle; margin-top: -3px; opacity: 0.4;" xml:space="preserve">
                                                                <g>
                                                                    <path d="M487.312,159.162C479.501,99.042,432.172,51.138,372.2,42.651c-6.532-0.929-13.158-1.395-19.69-1.395   c-43.417,0-83.353,20.523-108.664,54.18c-25.362-33.038-65.015-53.168-107.866-53.168c-6.626,0-13.358,0.482-19.994,1.437   C58.812,51.915,11.987,97.287,2.111,154.046c-7.496,43.113,5.169,85.801,34.788,117.292c3.901,4.676,9.132,10.621,13.882,15.994   l4.058,4.619c29.976,34.18,93.586,95.86,137.779,135.619c13.798,12.435,32.765,19.674,52.036,19.674h0.546   c19.921-0.467,38.991-7.476,52.339-19.947c37.189-34.693,61.598-59.484,102.257-101.827l1.552-1.625   c45.996-47.485,53.818-57.042,56.387-60.507C481.734,234.053,492.24,197.084,487.312,159.162z M415.922,229.792   c-12.265,15.056-8.984,11.245-53.053,56.738l-1.73,1.781c-39.946,41.584-63.883,65.75-100.17,99.601   c-3.586,3.35-11.607,5.315-16.251,5.315c-6.103,0-12.173-2.061-16.21-5.698c-42.096-37.886-105.078-98.697-133.365-130.964   l-4.162-4.696c-4.613-5.228-10.889-12.692-14.637-16.817c-17.771-19.563-26.055-45.31-21.431-71.821   c5.944-34.19,34.2-61.529,68.695-66.483c4.121-0.586,8.272-0.886,12.372-0.886c32.764,0,62.405,19.407,75.531,49.43   c5.672,12.991,18.421,21.374,32.523,21.374c14.217,0,27.03-8.494,32.649-21.662c14.542-34.165,50.526-54.542,88.01-49.293   c35.616,5.048,64.826,34.625,69.472,70.341C437.184,189.346,430.537,211.85,415.922,229.792z"/>
                                                                </g>
                                                            </svg>
                                                        </a>
                                                    </span>
                                                    <span class="ml-2" data-toggle="tooltip" title="Email & share this employer">
                                                        <a data-toggle="modal" data-target="#ShareModal">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512.297 512.297" style="enable-background:new 0 0 512.297 512.297;  vertical-align: middle; margin-top: -3px; opacity: 0.4;" xml:space="preserve" width="20px" height="20px">
                                                                <g>
                                                                    <g>
                                                                        <path d="M506.049,230.4l-192-192c-13.439-13.439-36.418-3.921-36.418,15.085v85.431    c-122.191,5.079-229.968,88.278-264.124,206.683C2.101,385.123-0.745,417.65,0.154,452.659c0.113,4.11,0.142,5.296,0.142,6.159    c0,21.677,28.579,29.538,39.666,10.911c23.767-39.933,50.761-70.791,80.333-93.599c53.462-41.233,109.122-53.174,157.335-48.352    v109.707c0,19.006,22.979,28.524,36.418,15.085l192-192C514.38,252.239,514.38,238.731,506.049,230.4z M320.297,385.982v-76.497    c0-9.773-6.641-18.296-16.117-20.686c-2.596-0.655-6.908-1.513-12.758-2.331c-60.43-8.455-130.633,4.548-197.184,55.876    c-16.371,12.626-31.961,27.299-46.688,44.105l0.326-1.708c1.701-8.759,3.879-17.804,6.624-27.315    c30.45-105.558,130.034-178.409,240.312-176.032c1.864,0.033,2.552,0.048,3.415,0.078c12.063,0.416,22.069-9.25,22.069-21.321    v-55.163l140.497,140.497L320.297,385.982z"/>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                            <p class="mb-1">
                                                <span style="font-weight: 800; font-size: 16px; opacity: 0.8;">16 Jobs</span>  
                                                <span class="ml-3 rounded px-2" style="background: #F4F5F7; opacity: 0.4;"><strong>Industry</strong></span>
                                                <span class="ml-3 rounded px-2" style="background: #F4F5F7; opacity: 0.4;"><strong>Keyword</strong></span>
                                                <span class="ml-3">
                                                    3 HQ's <span class="ml-3"> 14 branch locations</span>
                                                </span>
                                            </p>
                                            <p class="mb-0" style="opacity: 0.7;">Loram inpsum Loram inpsum Loram inpsum Loram inpsum Loram inpsum...</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- ONE JOB EOF -->
                                
                            </div>

                            <div class="col-12 mt-2 px-0">
                                <div class="py-2">
                                    <ul class="pagination justify-content-center mb-0">
                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Last</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!-- RIGHT SECTION END -->
                    </div>
                </div>

            </div>
        </div>
    </div>


<!-- SHARE MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="ShareModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title">Share this employer</h5>
                    <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-2">
                    <p>
                        <strong>Share this employer via link</strong>
                    </p>
                    <p>
                        <div class="btn-group w-100" role="group" aria-label="Basic example">
                            <input class="form-control text-center" type="text" name="sharelink" value="{{ url('/') }}/l/434343" readonly>
                            <button class="btn btn-outline-primary">Copy</button>
                        </div>
                    </p>
                    <p>
                        <strong>Share employer via email</strong>
                    </p>
                    <p>
                        <div class="btn-group w-100" role="group" aria-label="Basic example">
                            <input class="form-control" type="text" name="sharelink" placeholder="Enter an email">
                            <button class="btn btn-primary">Send</button>
                        </div>
                    </p>
                    <p class="mt-3">
                        <strong>Share to social media</strong>
                    </p>
                    <ul style="list-style: none; display: inline-flex;" class="pl-0">
                        <li class="pr-3"><a href="#"><img src="{{ asset('img/social/linkedin.png') }}" alt="" height="50" /></a></li>
                        <li class="pr-3"><a href="#"><img src="{{ asset('img/social/facebook.png') }}" alt="" height="50" /></a></li>
                        <li class="pr-3"><a href="#"><img src="{{ asset('img/social/google.png') }}" alt="" height="50" /></a></li>
                        <li class="pr-3"><a href="#"><img src="{{ asset('img/social/twitter.png') }}" alt="" height="50" /></a></li>
                    </ul>  
                </div>

            </div>
        </div>
    </div>
<!-- SHARE MODAL END!!!!!!!!!!!!!!! -->

@endsection
