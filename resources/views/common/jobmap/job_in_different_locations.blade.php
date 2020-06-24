@extends('layouts.jobmap.second_business')

@section('content')
    <style type="text/css">
        /*@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700');*/
        .business_tabs{
            font-size: 20px; 
            color:#4E5C6E;
            /*font-family: 'Open Sans', sans-serif;*/
        }
        .open-sans{
            /*font-family: 'Open Sans', sans-serif;*/
        }
        .business_tabs.active{
            font-weight: bold;
            color: #4266ff;
        }
        .business_tabs_numbers{
            font-size: 16px; 
            opacity: 0.5;
        }
        .business_tabs.active .business_tabs_numbers{
            opacity: 1;
        }
        .border{
            border:1px solid #e2e2e0!important;
        }
        .result_shadow{
            -webkit-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.2);
            -moz-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.2);
            box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.2);
        }
        .regural_text_style{
            color: #4E5C6E;
            /*font-family: sans-regular;*/
            font-size: 15px;
            font-weight: 400;
        }
    </style>
    <div id="location-view" style="margin-top: 55px;">

        <div class="business_background_img" style="height: 400px; background-size: cover; background:url('https://i.ytimg.com/vi/M1msXMurNCM/maxresdefault.jpg'); background-size: cover; background-position: center center;"></div>

        <div class="careerpage_businessname" style="background: rgba(0,0,0,0.3); width: 100%; height: 60px; margin-top: -59px; position: absolute;">
            <div class="container" style="position: relative;">
                <div class="d-flex justify-content-between flex-lg-row flex-column pt-2">
                    <div class="d-flex flex-lg-row flex-column">
                        <div class="pxa-0 mxa-0 text-center text-md-left align-self-center mr-3 careerpage_businessname" style="margin-top: -34px; position: absolute;">
                            <img class="business-icon rounded careerpage_icon wow animated fadeInDown" src="https://i.ytimg.com/vi/M1msXMurNCM/maxresdefault.jpg" style="width: 200px; height: 200px; border:5px solid #fff;">
                        </div>
                        <p class="mb-0 align-self-center mxa-0 text-white business_name_color" id="business-name" style="font-size: 30px; margin-left: 215px;">
                            Job Name
                        </p>
                    </div>

                    <div class="align-self-center" style="display: none;">
                        <button class="btn btn-primary border-0 mt-0 mb-3 mb-lg-0" id="map-resize" data-map="1" data-text="Smaller Map" style="background-color: #0747a6;">
                            Bigger Map
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
                                            <div class="d-flex col-12 pl-0 col-lg-4 pxa-0 justify-content-between mb-3 mb-lg-0" style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;">
                                                <input type="text" class="form-control w-100 border-0" style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;" placeholder="Find " id="items-search">
                                                <div class="align-self-center mr-3 mr-lg-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 250.313 250.313" style="enable-background:new 0 0 250.313 250.313; opacity: 0.1;" xml:space="preserve" widht="17px" height="17px">
                                                        <g id="Search">
                                                            <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M244.186,214.604l-54.379-54.378c-0.289-0.289-0.628-0.491-0.93-0.76   c10.7-16.231,16.945-35.66,16.945-56.554C205.822,46.075,159.747,0,102.911,0S0,46.075,0,102.911   c0,56.835,46.074,102.911,102.91,102.911c20.895,0,40.323-6.245,56.554-16.945c0.269,0.301,0.47,0.64,0.759,0.929l54.38,54.38   c8.169,8.168,21.413,8.168,29.583,0C252.354,236.017,252.354,222.773,244.186,214.604z M102.911,170.146   c-37.134,0-67.236-30.102-67.236-67.235c0-37.134,30.103-67.236,67.236-67.236c37.132,0,67.235,30.103,67.235,67.236   C170.146,140.044,140.043,170.146,102.911,170.146z"/>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="d-flex ml-auto w-100 justify-content-between justify-content-lg-end flex-md-row flex-column">
                                                <div class="d-flex mr-0 pt-1 mb-3 mb-md-0">
                                                    <span class="pt-2 mr-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                                             version="1.1" id="Capa_1" x="0px" y="0px"
                                                             viewBox="0 0 417.138 417.138"
                                                             style="height:15px; opacity: 0.8; fill:#184ba2;"
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
                                                            id="items-sort" style="box-shadow: none!important; color:#47546b;">
                                                            <option value="title" data-order="asc">Title A-Z </option>
                                                            <option value="title" data-order="desc">Title Z-A </option>
                                                            <option value="created_date" data-order="asc">Created date - Oldest </option>
                                                            <option value="created_date" data-order="desc">Created date - Newest </option>
                                                    </select>
                                                </div>
                                                <div class="pt-1 mb-3 mb-md-0">
                                                    <select class="border-0 form-control form-control-sm bg-white" id="items-limit" style="box-shadow: none!important; color:#47546b;">
                                                        <option value="25">25 Per page</option>
                                                        <option value="50">50 Per page</option>
                                                        <option value="100">100 Per page</option>
                                                        <option value="200">200 Per page</option>
                                                    </select>
                                                </div>
                                                <div class="btn-group pxa-0" role="group" aria-label="Basic example">
                                                        <div class="d-inline-flex">
                                                            <button class="btn btn-outline-primary rounded d-flex" type="button"
                                                                    aria-expanded="false" data-toggle="modal"
                                                                    data-target="#jobfiltermodal"
                                                                    id="filters-modal"
                                                                    style="background-color: #fff; border:1px solid #4266ff; color:#4266ff;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1"
                                                                     x="0px"
                                                                     y="0px" viewBox="0 0 511.999 511.999" xml:space="preserve"
                                                                     height="20px" style="fill:#4E5C6E; vertical-align: middle;">
                                                                    <path d="M510.078,35.509c-3.388-7.304-10.709-11.977-18.761-11.977H20.682c-8.051,0-15.372,4.672-18.761,11.977    s-2.23,15.911,2.969,22.06l183.364,216.828v146.324c0,7.833,4.426,14.995,11.433,18.499l94.127,47.063    c2.919,1.46,6.088,2.183,9.249,2.183c3.782,0,7.552-1.036,10.874-3.089c6.097-3.769,9.809-10.426,9.809-17.594V274.397    L507.11,57.569C512.309,51.42,513.466,42.813,510.078,35.509z M287.27,253.469c-3.157,3.734-4.889,8.466-4.889,13.355V434.32    l-52.763-26.381V266.825c0-4.89-1.733-9.621-4.89-13.355L65.259,64.896h381.482L287.27,253.469z" style="fill:#4E5C6E;"/>
                                                                </svg>
                                                                <span>
                                                                    Filters
                                                                </span>
                                                            </button>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row text-left" id="items-list">


                                            <!-- ONE JOB START -->
                                            <div class="col-12 px-0">
                                                <div class="d-flex flex-column flex-lg-row pxa-0 p-3" style="border-bottom:1px solid #e9ecef;">
                                                    <div class="text-center text-lg-left">
                                                        <img src="https://i.ytimg.com/vi/M1msXMurNCM/maxresdefault.jpg" class="rounded"
                                                             style="width: 60px; height: 60px;">
                                                    </div>
                                                    <div class="ml-4 mxa-0 text-center text-lg-left w-100">
                                                        <div class="d-flex justify-content-between flex-column flex-lg-row">
                                                            <div class="mb-2">
                                                                <a href="#"
                                                                   data-id="" class="view-job-link open-sans"
                                                                   style="font-size: 16px; color:#1D1D1D; font-weight: bold;">Job Name</a>
                                                            </div>
                                                            <div class="pt-1" style="opacity: 0.4;">
                                                              <span class="ml-2 mxa-0">3 days ago</span>
                                                          </div>
                                                        </div>
                                                        <p class="mb-1 open-sans">            
                                                            <span>
                                                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 18.999 18.999" style="enable-background:new 0 0 18.999 18.999;fill:#4266ff; vertical-align: middle;" xml:space="preserve" width="20px" height="20px">
                                                                <g>
                                                                  <g>
                                                                    <path d="M9.5,2c1.609,0,3.12,0.614,4.254,1.73C14.879,4.837,15.5,6.309,15.5,7.87s-0.62,3.03-1.745,4.139    L9.5,16.193l-4.254-4.186C4.121,10.9,3.501,9.431,3.501,7.868s0.62-3.032,1.745-4.141C6.38,2.614,7.892,2,9.5,2 M9.5,0    C7.453,0,5.404,0.768,3.843,2.305c-3.124,3.074-3.124,8.057,0,11.131L9.5,18.999l5.657-5.565c3.124-3.072,3.124-8.056,0-11.129    C13.596,0.768,11.548,0,9.5,0z"/>
                                                                  </g>
                                                                  <g>
                                                                    <path d="M9.5,5.499c0.668,0,1.296,0.26,1.768,0.731c0.976,0.976,0.976,2.562,0,3.537    c-0.473,0.472-1.1,0.731-1.768,0.731s-1.295-0.26-1.768-0.731c-0.976-0.976-0.976-2.562,0-3.537    C8.205,5.759,8.833,5.499,9.5,5.499 M9.5,4.499c-0.896,0-1.792,0.342-2.475,1.024c-1.367,1.367-1.367,3.584,0,4.951    c0.684,0.684,1.578,1.024,2.475,1.024s1.792-0.342,2.475-1.024c1.366-1.367,1.366-3.584,0-4.951    C11.292,4.84,10.396,4.499,9.5,4.499z"/>
                                                                  </g>
                                                                </g>
                                                              </svg>
                                                                Location
                                                            </span>
                                                        </p>
                                                        <p class="mb-1 open-sans">
                                                          <span> Job type </span>
                                                          <span class="mx-1">•</span>
                                                          <span class="rounded">Salary</span>
                                                        </p>
                                                        <p class="mb-0" style="opacity: 0.7;">Description</p>
                                                        <div class="d-flex justify-content-between mt-3">
                                                            <div class="align-self-center">
                                                              <span data-toggle="tooltip" title="Coming Soon">
                                                                <a href="#">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                         version="1.1" id="Capa_1" x="0px" y="0px" width="20px"
                                                                         height="20px" viewBox="0 0 488.501 488.5"
                                                                         style="enable-background:new 0 0 488.501 488.5; vertical-align: middle; margin-top: -3px; opacity: 0.4; fill:#4266ff;"
                                                                         xml:space="preserve">
                                                                        <g>
                                                                            <path d="M487.312,159.162C479.501,99.042,432.172,51.138,372.2,42.651c-6.532-0.929-13.158-1.395-19.69-1.395   c-43.417,0-83.353,20.523-108.664,54.18c-25.362-33.038-65.015-53.168-107.866-53.168c-6.626,0-13.358,0.482-19.994,1.437   C58.812,51.915,11.987,97.287,2.111,154.046c-7.496,43.113,5.169,85.801,34.788,117.292c3.901,4.676,9.132,10.621,13.882,15.994   l4.058,4.619c29.976,34.18,93.586,95.86,137.779,135.619c13.798,12.435,32.765,19.674,52.036,19.674h0.546   c19.921-0.467,38.991-7.476,52.339-19.947c37.189-34.693,61.598-59.484,102.257-101.827l1.552-1.625   c45.996-47.485,53.818-57.042,56.387-60.507C481.734,234.053,492.24,197.084,487.312,159.162z M415.922,229.792   c-12.265,15.056-8.984,11.245-53.053,56.738l-1.73,1.781c-39.946,41.584-63.883,65.75-100.17,99.601   c-3.586,3.35-11.607,5.315-16.251,5.315c-6.103,0-12.173-2.061-16.21-5.698c-42.096-37.886-105.078-98.697-133.365-130.964   l-4.162-4.696c-4.613-5.228-10.889-12.692-14.637-16.817c-17.771-19.563-26.055-45.31-21.431-71.821   c5.944-34.19,34.2-61.529,68.695-66.483c4.121-0.586,8.272-0.886,12.372-0.886c32.764,0,62.405,19.407,75.531,49.43   c5.672,12.991,18.421,21.374,32.523,21.374c14.217,0,27.03-8.494,32.649-21.662c14.542-34.165,50.526-54.542,88.01-49.293   c35.616,5.048,64.826,34.625,69.472,70.341C437.184,189.346,430.537,211.85,415.922,229.792z"/>
                                                                        </g>
                                                                    </svg>
                                                                </a>
                                                              </span>
                                                            </div>
                                                            <div class="align-self-center">
                                                              <span class="ml-2" data-toggle="tooltip" title="Email & share this job">
                                                                  <a data-toggle="modal" data-target="#ShareModal">
                                                                      <svg xmlns="http://www.w3.org/2000/svg"
                                                                           xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                           version="1.1" id="Layer_1" x="0px" y="0px"
                                                                           viewBox="0 0 512.297 512.297"
                                                                           style="enable-background:new 0 0 512.297 512.297;  vertical-align: middle; margin-top: -3px; opacity: 0.4; fill:#4266ff;"
                                                                           xml:space="preserve" width="20px" height="20px">
                                                                          <g>
                                                                              <g>
                                                                                  <path d="M506.049,230.4l-192-192c-13.439-13.439-36.418-3.921-36.418,15.085v85.431    c-122.191,5.079-229.968,88.278-264.124,206.683C2.101,385.123-0.745,417.65,0.154,452.659c0.113,4.11,0.142,5.296,0.142,6.159    c0,21.677,28.579,29.538,39.666,10.911c23.767-39.933,50.761-70.791,80.333-93.599c53.462-41.233,109.122-53.174,157.335-48.352    v109.707c0,19.006,22.979,28.524,36.418,15.085l192-192C514.38,252.239,514.38,238.731,506.049,230.4z M320.297,385.982v-76.497    c0-9.773-6.641-18.296-16.117-20.686c-2.596-0.655-6.908-1.513-12.758-2.331c-60.43-8.455-130.633,4.548-197.184,55.876    c-16.371,12.626-31.961,27.299-46.688,44.105l0.326-1.708c1.701-8.759,3.879-17.804,6.624-27.315    c30.45-105.558,130.034-178.409,240.312-176.032c1.864,0.033,2.552,0.048,3.415,0.078c12.063,0.416,22.069-9.25,22.069-21.321    v-55.163l140.497,140.497L320.297,385.982z"/>
                                                                              </g>
                                                                          </g>
                                                                      </svg>
                                                                  </a>
                                                              </span>
                                                            </div>
                                                            <div class="align-self-center">
                                                              <a href="#" data-id="" class="view-job-link btn border-0 px-4 py-1" role="button" style="background-color: #4266ff; color:#fff; border-radius: 20px;">VIEW JOB</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ONE JOB EOF -->
                                           



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
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyD3mcG8oAZzzlCSGZt5B4u5h5LmBX1SgjE"></script>
    <script src="{{ asset('/js/jobmap/app/job-map-location-view.js?v='.time()) }}"></script>

@endsection
