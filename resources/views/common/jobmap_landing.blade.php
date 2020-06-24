@extends('layouts.common_user')

@section('content')

    <div id="job-map">

    </div>

    <div class="ml-5 mt-5" id="job-map-filters" style="width: 450px;">
        <div class="dropdown">
            <button class="btn btn-primary " type="button" id="dropdownMenuButton" data-toggle="modal"
                    data-target="#modal-filters"
                    aria-haspopup="true" aria-expanded="false">
                Filters
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                {{--<form>--}}

                {{--</form>--}}
            </div>
        </div>
    </div>

    {{--<div class="m-5">--}}
    {{--<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-locations-list">--}}
    {{--Locations button--}}
    {{--</button>--}}
    {{--</div>--}}

    {{--<div class="m-5">--}}
    {{--<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-single-location">--}}
    {{--Single locations button--}}
    {{--</button>--}}
    {{--</div>--}}
    <div class="modal fade" id="modal-filters" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <div class="text-right mb-2">
                        <button type="button" class="close float-none" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="d-flex align-items-baseline justify-content-between">
                        <h5 class="modal-title" style="flex: 1">Filters</h5>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group text-center mb-3">
                                        <h6 class="h6 mb-2">Jobs availability</h6>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="filter-jobs">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Only open jobs</span>
                                        </label>
                                    </div>
                                    <div class="form-group text-center mb-3">
                                        <label for="slider-hours-amount" class="h6 mb-3">Hours a week</label>

                                        <div id="slider-hours" class="mb-3"></div>
                                        <input type="text" id="slider-hours-amount" readonly
                                               class="border-0 text-center">
                                    </div>
                                    {{--<div class="form-group mb-3">--}}
                                    {{--<small class="form-text text-muted mb-2">Industry</small>--}}
                                    {{--<div id="industry"></div>--}}
                                    {{--<select class="form-control mb-2">--}}
                                    {{--<option>Industry</option>--}}
                                    {{--</select>--}}

                                    {{--<div class="pb-1 border border-top-0 border-left-0 border-right-0 d-flex align-items-center">--}}
                                    {{--<a href="#" class="badge badge-light mr-2">Tag1</a>--}}
                                    {{--<a href="#" class="badge badge-light mr-2">Tag2</a>--}}
                                    {{--<a href="#" class="badge badge-light mr-2">Tag3</a>--}}
                                    {{--<a href="#" class="badge badge-light">Tag2</a>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="form-group mb-3">
                                        <small class="form-text text-muted mb-2">Job type</small>
                                        <div id="job_type"></div>
                                        {{--<select class="form-control mb-2">--}}
                                        {{--<option>Job type</option>--}}
                                        {{--</select>--}}

                                        {{--<div class="pb-1 border border-top-0 border-left-0 border-right-0 d-flex align-items-center">--}}
                                        {{--<a href="#" class="badge badge-light mr-2">Tag1</a>--}}
                                        {{--<a href="#" class="badge badge-light mr-2">Tag2</a>--}}
                                        {{--<aи   href="#" class="badge badge-light mr-2">Tag3</a>--}}
                                        {{--<a href="#" class="badge badge-light">Tag2</a>--}}
                                        {{--</div>--}}
                                    </div>
                                    {{--<div class="form-group mb-3">--}}
                                    {{--<small class="form-text text-muted mb-2">Shift type</small>--}}
                                    {{--<select class="form-control mb-2">--}}
                                    {{--<option>Shift type</option>--}}
                                    {{--</select>--}}

                                    {{--<div class="pb-1 border border-top-0 border-left-0 border-right-0 d-flex align-items-center">--}}
                                    {{--<a href="#" class="badge badge-light mr-2">Tag1</a>--}}
                                    {{--<a href="#" class="badge badge-light mr-2">Tag2</a>--}}
                                    {{--<a href="#" class="badge badge-light mr-2">Tag3</a>--}}
                                    {{--<a href="#" class="badge badge-light">Tag2</a>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="form-group mb-3">
                                        <small class="form-text text-muted mb-2">Career level</small>
                                        <div id="career_level"></div>
                                        {{--<select class="form-control mb-2">--}}
                                        {{--<option>Career level</option>--}}
                                        {{--</select>--}}

                                        {{--<div class="pb-1 border border-top-0 border-left-0 border-right-0 d-flex align-items-center">--}}
                                        {{--<a href="#" class="badge badge-light mr-2">Tag1</a>--}}
                                        {{--<a href="#" class="badge badge-light mr-2">Tag2</a>--}}
                                        {{--<a href="#" class="badge badge-light mr-2">Tag3</a>--}}
                                        {{--<a href="#" class="badge badge-light">Tag2</a>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                                {{--<div class="col-5">--}}
                                {{--<h6 class="h6 mb-2">Size of business</h6>--}}

                                {{--<div class="form-group mb-0">--}}
                                {{--<label class="custom-control custom-radio mr-0 mb-0">--}}
                                {{--<input id="radio1" name="business-size-options" type="radio"--}}
                                {{--class="custom-control-input">--}}
                                {{--<span class="custom-control-indicator"></span>--}}
                                {{--<span class="custom-control-description">Small business only</span>--}}
                                {{--</label>--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                {{--<label class="custom-control custom-radio mr-0 mb-0">--}}
                                {{--<input id="radio2" name="business-size-options" type="radio"--}}
                                {{--class="custom-control-input">--}}
                                {{--<span class="custom-control-indicator"></span>--}}
                                {{--<span class="custom-control-description">Medium business only</span>--}}
                                {{--</label>--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                {{--<label class="custom-control custom-radio mr-0 mb-0">--}}
                                {{--<input id="radio3" name="business-size-options" type="radio"--}}
                                {{--class="custom-control-input">--}}
                                {{--<span class="custom-control-indicator"></span>--}}
                                {{--<span class="custom-control-description">Corporate only</span>--}}
                                {{--</label>--}}
                                {{--</div>--}}
                                {{--<div class="form-group mb-3">--}}
                                {{--<small class="form-text text-muted mb-2">Shift type</small>--}}
                                {{--<select class="form-control mb-2">--}}
                                {{--<option>Shift type</option>--}}
                                {{--</select>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-block bg-light">
                    <div class="text-center">
                        <button type="button"
                                class="btn btn-primary" id="map-set-filters">
                            Set filters
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-locations-list" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <div class="text-right mb-2">
                        <button type="button" class="close float-none" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="d-flex align-items-baseline justify-content-between">
                        <h5 class="modal-title" style="flex: 1" id="location-address">Location address</h5>

                        <div class="d-flex align-items-center">
                            <p class="mb-0 mr-2 h6" id="count-locations">
                                <span></span> of locations in address
                            </p>
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 477 477" style="enable-background:new 0 0 477 477;" xml:space="preserve">
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
                <div class="modal-footer d-block bg-light">
                    <div class="bg-white">
                        <button type="button"
                                class="btn btn-outline-primary py-3 w-100" id="locations-more-info" data-id="">
                            More info
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-single-location" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <div class="text-right mb-2">
                        <button type="button" class="close float-none" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="d-inline-flex align-items-start mr-2" style="flex: 1">
                            <div class="rounded p-1 bg-white d-inline-block mr-2"
                                 style="box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);">
                                <img id="location-pic">
                            </div>
                            <div>
                                <h6 class="h6 mb-2" id="location-name">Location Name</h6>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex align-items-center justify-content-end mb-2">
                                <p class="mb-0 mr-2" id="location-open-jobs"><span></span> Available jobs</p>
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Capa_1" x="0px" y="0px"
                                     width="20px" height="20px" viewBox="0 0 366.736 366.736"
                                     style="enable-background:new 0 0 366.736 366.736;" xml:space="preserve">
												            <path d="M338.11,75.789h-77.312V61.955c0-16.314-13.271-29.587-29.586-29.587h-95.688c-16.313,0-29.586,13.272-29.586,29.587   v13.834H28.627C12.842,75.789,0,88.63,0,104.414v201.328c0,15.784,12.842,28.626,28.627,28.626h309.482   c15.785,0,28.627-12.842,28.627-28.626V104.414C366.737,88.631,353.896,75.789,338.11,75.789z M130.939,61.955   c0-2.529,2.058-4.587,4.586-4.587h95.688c2.528,0,4.586,2.058,4.586,4.587v13.834h-104.86V61.955z M28.628,100.789H338.11   c2,0,3.627,1.626,3.627,3.625v65.598c-38.738,14.37-97.169,22.858-158.474,22.858c-61.17,0-119.521-8.459-158.263-22.781v-65.675   C25.001,102.415,26.628,100.789,28.628,100.789z M338.11,309.368H28.628c-2,0-3.627-1.626-3.627-3.626V196.575   c35.458,11.697,82.077,19.008,132.882,20.84c-0.003,0.145-0.021,0.285-0.021,0.432v5.513c0,10.335,8.408,18.743,18.744,18.743   h13.527c10.336,0,18.744-8.408,18.744-18.743v-5.513c0-0.147-0.02-0.291-0.021-0.438c50.837-1.848,97.449-9.18,132.883-20.9   v109.234C341.737,307.742,340.11,309.368,338.11,309.368z"
                                                                  fill="#4266ff"/>
											            </svg>
                            </div>
                            <div class="d-flex align-items-center justify-content-end">
                                <p class="mb-0 mr-2" id="location-jobs"><span></span> Jobs</p>
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Capa_1" x="0px" y="0px"
                                     width="20px" height="20px" viewBox="0 0 366.736 366.736"
                                     style="enable-background:new 0 0 366.736 366.736;" xml:space="preserve">
												            <path d="M338.11,75.789h-77.312V61.955c0-16.314-13.271-29.587-29.586-29.587h-95.688c-16.313,0-29.586,13.272-29.586,29.587   v13.834H28.627C12.842,75.789,0,88.63,0,104.414v201.328c0,15.784,12.842,28.626,28.627,28.626h309.482   c15.785,0,28.627-12.842,28.627-28.626V104.414C366.737,88.631,353.896,75.789,338.11,75.789z M130.939,61.955   c0-2.529,2.058-4.587,4.586-4.587h95.688c2.528,0,4.586,2.058,4.586,4.587v13.834h-104.86V61.955z M28.628,100.789H338.11   c2,0,3.627,1.626,3.627,3.625v65.598c-38.738,14.37-97.169,22.858-158.474,22.858c-61.17,0-119.521-8.459-158.263-22.781v-65.675   C25.001,102.415,26.628,100.789,28.628,100.789z M338.11,309.368H28.628c-2,0-3.627-1.626-3.627-3.626V196.575   c35.458,11.697,82.077,19.008,132.882,20.84c-0.003,0.145-0.021,0.285-0.021,0.432v5.513c0,10.335,8.408,18.743,18.744,18.743   h13.527c10.336,0,18.744-8.408,18.744-18.743v-5.513c0-0.147-0.02-0.291-0.021-0.438c50.837-1.848,97.449-9.18,132.883-20.9   v109.234C341.737,307.742,340.11,309.368,338.11,309.368z"
                                                                  fill="#4266ff"/>
											            </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body p-0">
                    <div class="border border-top-0 border-right-0 border-left-0 py-3">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                <div class="d-flex flex-row justify-content-start text-center" id="amenities-list">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3 pb-5">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                <div class="mb-3">
                                    <div class="row justify-content-between">
                                        <div class="col-5">
                                            <div class="bg-white">
                                                <button class="btn btn-lg btn-outline-primary w-100 py-3" type="button" data-id="">
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
                                                        Share Location
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="bg-white">
                                                <button class="btn btn-lg btn-outline-primary w-100 py-3" type="button" data-id="">
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
                                <div>
                                    <div class="row justify-content-center">
                                        <div class="col-8">
                                            <div class="bg-white">
                                                <button type="button"
                                                        class="btn btn-outline-primary py-4 w-100" data-id="">
                                                    Send CloudResume
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-block bg-light">
                    <div class="bg-white">
                        <button type="button"
                                class="btn btn-outline-primary py-3 w-100" id="location-more-info" data-id="">
                            More info
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>
    <script src="{{ asset('/js/jack.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key={{ env('GOOGLE_MAPS_API_KEY', 'AIzaSyCLDOlFEBqX8B8bwiURqNObe5V5xrJrftw') }}"></script>
    <script src="{{ asset('/js/app/CustomGoogleMapMarker.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/job-map.js?v='.time()) }}"></script>
@endsection