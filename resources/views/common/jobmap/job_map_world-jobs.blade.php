@extends('layouts.jobmap.common_user')

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
            border-bottom: 2px solid #007bff;
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

        .btn-outline-primary:not([disabled]):not(.disabled).active, .btn-outline-primary:not([disabled]):not(.disabled):active, .show > .btn-outline-primary.dropdown-toggle {
            background-color: #eceef0 !important;
            border: 1px solid #9BA6B2 !important;
            color: #4E5C6E !important;
        }
        .page-link{
            color: #0747a6!important;
        }
    </style>
    <div id="location-view">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-12 col-lg-11 col-xl-10 text-center my-5 pb-5">

                    <p class="title_left_sorting d-flex animated fadeInDown" style="font-size: 24px;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512"
                             style="enable-background:new 0 0 512 512; width: 30px; height: 30px; vertical-align: middle; margin-top: 2px; fill:#4E5C6E;"
                             xml:space="preserve" class="mr-2">
                        <g>
                            <g>
                                <path d="M437.019,74.981C388.668,26.629,324.38,0,256,0S123.333,26.629,74.981,74.981C26.629,123.333,0,187.62,0,256    s26.629,132.667,74.981,181.019C123.333,485.371,187.62,512,256,512s132.668-26.629,181.019-74.981    C485.371,388.667,512,324.38,512,256S485.371,123.333,437.019,74.981z M375.98,110.031l11.254-46.752    c44.813,30.612,78.449,76.426,93.423,129.958l-5.895,1.134c-8.803,1.693-15.888,8.409-18.046,17.112l-2.287,9.218    c-0.025,0.104-0.042,0.172-0.209,0.231c-0.165,0.059-0.222,0.017-0.308-0.047l-13.659-10.243c-7.08-5.31-16.72-6.089-24.558-1.984    l-17.046,8.924c-8.175,4.28-12.901,12.661-12.333,21.873c0.568,9.211,6.287,16.948,14.93,20.193l0.808,0.303    c0.093,0.035,0.162,0.06,0.204,0.228c0.042,0.166-0.005,0.221-0.072,0.297l-10.618,12.211c-0.107,0.122-0.291,0.15-0.429,0.06    l-28.62-18.466c-6.563-4.235-14.744-4.873-21.882-1.702c-7.138,3.17-12.154,9.663-13.414,17.37l-2.208,13.493    c-1.248,7.616,1.372,15.312,7.009,20.586l14.926,13.967c0.118,0.11,0.139,0.288,0.05,0.422l-24.326,36.875    c-2.314,3.509-3.628,7.586-3.797,11.789l-2.111,52.793c-0.003,0.083-0.038,0.162-0.099,0.221l-32.395,31.753    c-0.107,0.105-0.272,0.125-0.399,0.05l-21.006-12.305c-0.08-0.047-0.137-0.125-0.156-0.214c0,0-10.191-46.244-10.572-47.269    l-9.265-24.868c-3.096-8.308-10.802-14.172-19.632-14.939l-42.402-3.688c-0.107-0.009-0.203-0.069-0.257-0.164l-24.122-41.591    c-0.038-0.065-0.051-0.142-0.041-0.215l6.067-40.337c0.013-0.086,0.058-0.163,0.127-0.215l37.037-27.945    c0.094-0.071,0.218-0.085,0.327-0.041l35.888,14.972c2.043,0.851,4.194,1.404,6.391,1.643l49.706,5.403    c5.666,0.616,11.319-0.873,15.944-4.188l32.932-23.605c8.872-6.359,12.081-18.209,7.63-28.177l-3.055-6.838    c-3.545-7.936-11.139-13.161-19.816-13.635l-92.487-5.064c-0.05-0.003-0.1-0.018-0.144-0.043    c-0.094-0.053-0.144-0.096-0.149-0.096v0.001c-0.045-0.104-0.011-0.367,0.042-0.44c0.014-0.009,0.072-0.039,0.185-0.071    l27.766-7.484c3.673-0.99,7.075-2.892,9.838-5.5l33.956-32.043c0.051-0.049,0.119-0.08,0.191-0.088l51.104-5.263    C365.623,126.591,373.692,119.535,375.98,110.031z M202.878,91.244l19.104-35.958c2.823-5.315,3.713-11.489,2.503-17.384    l-2.594-12.645c11.137-1.64,22.523-2.501,34.108-2.501c11.684,0,23.167,0.875,34.395,2.541c0,0-2.737,2.992-3.21,3.181    l-27.057,10.853c-3.866,1.552-7.342,4.045-10.052,7.211l-42.157,49.274c-0.573,0.67-1.407,1.075-2.289,1.113    c-1.339,0.059-2.166-0.68-2.553-1.11C201.577,94.151,202.732,91.522,202.878,91.244z M103.424,79.718v34.139    c0,9.535-4.779,18.318-12.777,23.506L66.15,153.259c-5.677,3.686-10.49,8.385-14.302,13.972l-22.234,32.58    C41.375,152.438,67.641,110.732,103.424,79.718z M118.295,415.585l-3.223,26.139C78.6,413.982,50.51,375.766,35.337,331.594    h14.486c1.775,0,3.413,0.899,4.369,2.389l29.275,45.614c1.32,2.048,2.89,3.914,4.688,5.552l28.479,25.975    C117.874,412.251,118.5,413.924,118.295,415.585z M256,489.244c-43.759,0-84.736-12.123-119.767-33.172l4.647-37.7    c1.104-8.977-2.23-17.977-8.909-24.064c0,0-29.104-26.624-29.355-27l-29.275-45.613c-5.166-8.055-13.961-12.857-23.518-12.857    h-21.03c-3.948-16.984-6.038-34.672-6.038-52.838c0-1.962,0.026-3.916,0.074-5.866l47.815-70.069    c2.105-3.095,4.756-5.689,7.896-7.725l24.485-15.883c14.495-9.398,23.154-25.327,23.154-42.598V62.316    c22.089-14.854,46.848-26.023,73.389-32.643l2.626,12.801c0.148,0.725,0.039,1.484-0.308,2.136l-19.102,35.957    c-1.194,2.245-2.741,8.149-2.741,8.149c-1.551,7.852,0.547,15.84,5.757,21.916c4.968,5.795,12.086,9.057,19.67,9.057    c0.369,0,11.37,0.537,19.738-9.078l42.156-49.271c0.333-0.39,0.762-0.697,1.236-0.887l27.055-10.852    c3.848-1.543,7.309-4.02,10.011-7.162l10.213-11.875c17.977,4.78,35.113,11.644,51.117,20.34    c-0.264,0.604-13.142,53.804-13.142,53.804c-0.032,0.135-0.148,0.236-0.287,0.25l-51.107,5.263    c-5.022,0.518-9.809,2.71-13.478,6.174l-33.956,32.043c-0.039,0.036-0.086,0.064-0.14,0.077l-27.767,7.484    c-9.059,2.441-15.688,10.032-16.888,19.337c-1.2,9.305,3.286,18.328,11.43,22.99c3.105,1.776,6.634,2.818,10.204,3.014    l92.487,5.064c0.123,0.007,0.232,0.082,0.282,0.195l3.054,6.836c0.064,0.142,0.018,0.312-0.11,0.403l-32.932,23.605    c-0.066,0.048-0.143,0.069-0.226,0.06l-49.796-5.425l-35.884-14.97c-7.539-3.147-16.271-2.043-22.793,2.876l-37.038,27.946    c-4.85,3.66-8.019,8.985-8.922,14.994l-6.068,40.338c-0.776,5.164,0.24,10.496,2.859,15.013l24.123,41.594    c3.768,6.498,10.486,10.766,17.97,11.418l42.403,3.688c0.125,0.011,0.236,0.094,0.28,0.214l9.277,24.913l9.652,44.141    c1.373,6.276,5.34,11.738,10.883,14.987l21.007,12.306c3.62,2.121,7.645,3.154,11.645,3.154c5.905,0,11.759-2.253,16.183-6.588    l32.395-31.753c4.22-4.136,6.673-9.663,6.909-15.565l2.111-52.789c0.002-0.061,0.02-0.121,0.055-0.169l24.327-36.875    c6.213-9.422,4.741-21.857-3.5-29.567l-14.927-13.967c-0.08-0.075-0.117-0.185-0.1-0.294l2.21-13.494    c0.018-0.109,0.027-0.175,0.191-0.248c0.159-0.073,0.217-0.036,0.312,0.024l28.618,18.466c9.582,6.183,22.451,4.359,29.936-4.248    l10.618-12.211c4.962-5.704,6.816-13.485,4.961-20.813c-1.856-7.328-7.187-13.29-14.268-15.948l-0.808-0.303    c-0.104-0.039-0.156-0.073-0.158-0.073c-0.063-0.086-0.077-0.344-0.034-0.428c0.01-0.01,0.058-0.05,0.155-0.101l17.046-8.925    c0.113-0.059,0.249-0.048,0.35,0.028l13.659,10.243c6.21,4.658,14.283,5.883,21.595,3.279c7.311-2.603,12.792-8.655,14.661-16.189    l2.287-9.217c0.03-0.124,0.131-0.221,0.258-0.245l6.647-1.278c2.323,13.177,3.541,26.729,3.541,40.561    C489.244,384.612,384.611,489.244,256,489.244z"/>
                            </g>
                        </g>
                        </svg>
                        <strong>Explore World</strong>
                    </p>

                    <div class="card mb-4 mb-sm-5">
                        <div class="card-body px-0">

                            <div class="row justify-content-center">
                                <div class="col-11">
                                    
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12">
                        <p class="text-left flex-column flex-lg-row d-flex">
                            <a href="#" class="cardinal_links">0 Employers</a>
                            <a href="#" class="cardinal_links ml-2 mxa-0">0 Jobs</a>
                            <a href="#" class="cardinal_links ml-2 mxa-0">0 Headquarters</a>
                            <a href="#" class="cardinal_links ml-2 mxa-0">0 Locations</a>
                            <a href="#" class="cardinal_links ml-2 mxa-0">0 Keywords</a>
                        </p>
                    </div>

                    <div class="col-12 bg-white rounded border">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="col-12 pt-3 pb-2 px-0">
                                    <div class="title_left_sorting text-left d-flex flex-column flex-lg-row">
                                        <div class="btn-group col-12 col-lg-6 pxa-0" role="group" aria-label="Basic example">
                                            <div class="d-flex w-100">
                                                <input type="text" class="form-control rounded-0 bg-light"
                                                       placeholder="Find jobs" id="jobs-search">
                                            </div>
                                        </div>
                                        <div class="d-flex ml-auto mxa-0">
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
                                                <select class="border-0 form-control form-control-sm"
                                                        id="headquarters-sort">
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
                                                </select>
                                            </div>
                                            <div class="pt-1 mr-2" id="page-limit-headquarters">
                                                <select class="border-0 form-control form-control-sm"
                                                        id="headquarters-sort">
                                                    <option>3 Per page</option>
                                                    <option>6 Per page</option>
                                                    <option>9 Per page</option>
                                                    <option>12 Per page</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 px-0 text-left mb-3">
                                        <p class="title_left_sorting text-center text-lg-left pt-2"><strong>Displaying Jobs 1-50 of 100,000</strong></p>
                                    </div>
                                    <div class="row text-left">
                                        <!-- ONE JOB START -->
                                        <div class="col-12 px-0">
                                            <div class="d-flex p-3 pxa-0 flex-column flex-lg-row text-center text-lg-left" style="border-bottom:1px solid #e9ecef;">
                                                <div class="">
                                                    <img src="{{ asset('img/dhl.png') }}" class="rounded" style="width: 60px; height: 60px;">
                                                </div>
                                                <div class="ml-4 mxa-0 col-12">
                                                    <div class="d-flex justify-content-between flex-column flex-lg-row text-center text-lg-left">
                                                        <div class="mb-2 width-100" style="width: 80%;">
                                                            <a href="#" class="cardinal_links" style="font-size: 18px;">Certified Aircraft Mechanic Technician (Ramp) 2 positions</a> 
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
                                                            <span class="ml-2" data-toggle="tooltip" title="Email & share this job">
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
                                                            <span class="ml-2">2 hours ago</span>
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">
                                                        <span style="font-weight: 800; font-size: 16px; opacity: 0.8;">Full time</span>  
                                                        <span class="ml-3 rounded px-2" style="background: #F4F5F7; opacity: 0.4;"><strong>25$</strong></span>
                                                        <span class="ml-3">
                                                            DHL Systems <span class="ml-3">Montreal, Quebec</span>
                                                        </span>
                                                    </p>
                                                    <p class="mb-0" style="opacity: 0.7;">Loram inpsum Loram inpsum Loram inpsum Loram inpsum Loram inpsum...</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ONE JOB EOF -->
                                    </div>
                                </div>
                            </div>
                        </div>
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
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyD3mcG8oAZzzlCSGZt5B4u5h5LmBX1SgjE"></script>
    <!-- <script src="{{ asset('/js/jobmap/app/job-map-location-view.js?v='.time()) }}"></script> -->
@endsection
