@extends('layouts.main_business')

@section('content')
    <style type="text/css">
        .addnewbutton:hover svg polygon {
            fill: #fff;
        }

        .btn-outline-primary:not([disabled]):not(.disabled).active,
        .btn-outline-primary:not([disabled]):not(.disabled):active,
        .show > .btn-outline-primary.dropdown-toggle {
            background: #f7f9fb;
            color: #4E5C6E;
            border: 1px solid #9BA6B2;
            fill: #4E5C6E;
        }

        #keywords .ms-helper {
            font-size: 12px;
            top: 35px;
        }
    </style>
    <div class="container-fluid px-0">
        <div class="d-flex">
            <div id="slide-out" class="pl-0 sidebar_adaptive" style="width: 320px;">
                @include('components.sidebar.sidebar_business')
            </div>

            <div class="flex-1 mx-auto content-main" style="overflow:hidden;flex: 1 0;">
                <div>
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-11 col-md-12 text-center">
                            <form class="mb-3 mb-sm-5 pb-0" id="business-profile-form" style="margin-left: 2px;" autocomplete="off">
                                <div class="border-0">
                                    <div class="text-center d-flex justify-content-between flex-lg-row flex-column pt-4 pb-3 px-3 bg-white">
                                        <p class="h2 text-secondary text-lg-left text-center mt-2" id="business-profile-edit__title">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                 id="Capa_1"
                                                 x="0px" y="0px" viewBox="0 0 512 512"
                                                 style="enable-background:new 0 0 512 512; fill:#4266ff; vertical-align: middle; margin-top: -4px;"
                                                 xml:space="preserve" width="50px" height="50px">
                                                <g>
                                                    <g>
                                                        <path d="M502.154,59.077H9.846C4.408,59.077,0,63.486,0,68.923V128v315.077c0,5.437,4.408,9.846,9.846,9.846h492.308    c5.438,0,9.846-4.409,9.846-9.846V128V68.923C512,63.486,507.592,59.077,502.154,59.077z M492.308,433.231H19.692V137.846h472.615    V433.231z M492.308,88.615h-59.077c-5.438,0-9.846,4.409-9.846,9.846c0,5.437,4.408,9.846,9.846,9.846h59.077v9.846H19.692V78.769    h472.615V88.615z"/>
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path d="M462.769,157.538H49.231c-5.438,0-9.846,4.409-9.846,9.846v98.461c0,5.437,4.408,9.846,9.846,9.846h413.538    c5.438,0,9.846-4.409,9.846-9.846v-98.461C472.615,161.948,468.207,157.538,462.769,157.538z M452.923,256H59.077v-19.692h39.385    c5.438,0,9.846-4.409,9.846-9.846c0-5.437-4.408-9.846-9.846-9.846H59.077v-39.385h393.846V256z"/>
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path d="M413.342,96.541c-0.128-0.629-0.315-1.25-0.561-1.851c-0.246-0.592-0.551-1.162-0.906-1.693    c-0.354-0.543-0.768-1.045-1.221-1.498c-0.453-0.453-0.955-0.866-1.497-1.221c-0.532-0.353-1.103-0.66-1.703-0.906    c-0.591-0.246-1.211-0.443-1.841-0.571c-1.27-0.246-2.57-0.246-3.84,0c-0.63,0.128-1.25,0.325-1.841,0.571    c-0.601,0.246-1.172,0.542-1.703,0.906c-0.542,0.354-1.044,0.768-1.497,1.221c-0.453,0.453-0.866,0.955-1.221,1.498    c-0.354,0.532-0.66,1.102-0.906,1.693c-0.246,0.601-0.443,1.221-0.561,1.851c-0.128,0.63-0.197,1.28-0.197,1.92    c0,0.639,0.069,1.29,0.197,1.92c0.118,0.63,0.315,1.25,0.561,1.84c0.246,0.601,0.551,1.172,0.906,1.703    c0.354,0.542,0.768,1.044,1.221,1.497c0.453,0.454,0.955,0.867,1.497,1.221c0.532,0.364,1.103,0.66,1.703,0.906    c0.591,0.246,1.211,0.443,1.841,0.561c0.63,0.128,1.28,0.197,1.92,0.197s1.29-0.069,1.92-0.197c0.63-0.118,1.25-0.315,1.841-0.561    c0.601-0.246,1.172-0.542,1.703-0.906c0.542-0.353,1.044-0.767,1.497-1.221c0.453-0.453,0.866-0.955,1.221-1.497    c0.354-0.532,0.66-1.103,0.906-1.703c0.246-0.591,0.433-1.21,0.561-1.84c0.128-0.631,0.197-1.281,0.197-1.92    C413.539,97.822,413.47,97.171,413.342,96.541z"/>
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path d="M236.308,295.385H49.231c-5.438,0-9.846,4.409-9.846,9.846v98.462c0,5.437,4.408,9.846,9.846,9.846h187.077    c5.438,0,9.846-4.409,9.846-9.846v-98.462C246.154,299.794,241.746,295.385,236.308,295.385z M226.462,393.846H59.077v-78.769    h167.385V393.846z"/>
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path d="M462.769,295.385H275.692c-5.438,0-9.846,4.409-9.846,9.846v98.462c0,5.437,4.408,9.846,9.846,9.846h187.077    c5.438,0,9.846-4.409,9.846-9.846v-98.462C472.615,299.794,468.207,295.385,462.769,295.385z M452.923,393.846H285.538v-78.769    h167.385V393.846z"/>
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path d="M137.649,224.543c-0.118-0.63-0.315-1.25-0.561-1.841c-0.246-0.601-0.551-1.171-0.906-1.702    c-0.354-0.543-0.768-1.045-1.221-1.498c-0.453-0.453-0.955-0.866-1.497-1.221c-0.532-0.353-1.103-0.66-1.703-0.906    c-0.591-0.246-1.211-0.443-1.841-0.56c-1.27-0.257-2.58-0.257-3.84,0c-0.63,0.117-1.25,0.314-1.851,0.56    c-0.591,0.246-1.162,0.552-1.694,0.906c-0.542,0.354-1.044,0.768-1.497,1.221c-0.453,0.453-0.866,0.955-1.221,1.498    c-0.354,0.532-0.66,1.102-0.906,1.702c-0.246,0.592-0.443,1.211-0.561,1.841c-0.128,0.63-0.197,1.28-0.197,1.92    c0,2.59,1.054,5.13,2.885,6.96c0.453,0.453,0.955,0.866,1.497,1.221c0.532,0.354,1.103,0.66,1.694,0.906    c0.601,0.246,1.221,0.443,1.851,0.561c0.63,0.128,1.28,0.197,1.92,0.197s1.29-0.069,1.92-0.197c0.63-0.118,1.25-0.315,1.841-0.561    c0.601-0.246,1.172-0.551,1.703-0.906c0.542-0.353,1.044-0.767,1.497-1.221c0.453-0.453,0.866-0.955,1.221-1.497    c0.354-0.532,0.66-1.103,0.906-1.703c0.246-0.591,0.443-1.21,0.561-1.84c0.128-0.631,0.197-1.281,0.197-1.92    C137.846,225.822,137.777,225.172,137.649,224.543z"/>
                                                    </g>
                                                </g>
                                            </svg>
                                            {!! trans('pages.title.profile_edit') !!}
                                        </p>
                                        <span class="ml-auto" style="float: right;">
                                            <a class="btn btn-outline-success addnewbutton"
                                               id="business-signup-preview-career"
                                               href="" target="_blank" role="button" style="letter-spacing: 0;">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                     id="Capa_1" x="0px" y="0px" viewBox="0 0 384 384"
                                                     style="enable-background:new 0 0 384 384; float: left; vertical-align: middle; margin-top: 2px;"
                                                     xml:space="preserve" width="20px" height="20px"
                                                     class="mr-2">
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <path d="M341.333,341.333H42.667V42.667H192V0H42.667C19.093,0,0,19.093,0,42.667v298.667C0,364.907,19.093,384,42.667,384     h298.667C364.907,384,384,364.907,384,341.333V192h-42.667V341.333z" />
                                                                <polygon points="234.667,0 234.667,42.667 311.147,42.667 101.44,252.373 131.627,282.56 341.333,72.853 341.333,149.333      384,149.333 384,0    " />
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <span>{!! trans('main.buttons.preview_career') !!}</span>
                                            </a>
                                        </span>
                                    </div>
                                    <!-- BUSINESS BACKGROUND -->
                                    <div class="business_background" style="max-height: 450px; max-width: 1920px; position: relative; margin: 0 auto;">
                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                {{--<div class="carousel-item active" id="myBtn">
                                                    <img class="d-block w-100" src="http://www.calyxgroup.co.in/wp-content/uploads/2017/09/lightbulb-1920x450.jpg" alt="First slide">
                                                </div>
                                                <div class="carousel-item" id="myBtn">
                                                    <img class="d-block w-100" src="https://www.misfl.com/wp-content/uploads/2015/06/1920x450-About1.jpg" alt="Second slide">
                                                </div>
                                                <div class="carousel-item" id="myBtn">
                                                    <img class="d-block w-100" src="http://www.mana-barmill.com/cdn/uploads/photo-career1-1920x450-1.jpg" alt="Third slide">
                                                </div>--}}
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                        {{--<img class=""
                                             style="width: 100%; height: 100%; object-fit: cover;"
                                             src="{{ asset('img/bg-white-cr.png') }}">--}}
                                        <div style="position: absolute; right: 15px; top:15px;">
                                            <p class="mb-0">
                                                <button type="button" id="business-bg-change-btn" class="btn btn-danger" data-toggle="modal" data-target="#business-bg-modal">{!! trans('main.buttons.change_background') !!}</button>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- /BUSINESS BACKGROUND -->
                                    <div class="card-body rounded-0 px-0 pt-3 pb-5 container bg-white">



                                        <div class="row justify-content-center">
                                            <div class="col-10 col-md-10 text-center">
                                                <div class="d-inline-block bg-light px-5 pxa-0 pt-4 pb-3 mb-4 business-pic-view">
                                                    <img class=" img-thumbnail" alt="Your business logo"
                                                         style="width: 100px; height: 100px;"
                                                         src="{{ asset('img/profilepic2.png') }}">
                                                    <div class="mt-3 bg-white">
                                                        <button id="business-pic-change-btn" type="button"
                                                                class="btn btn-outline-primary py-3 px-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 version="1.1" id="Capa_1" x="0px" y="0px"
                                                                 viewBox="0 0 489.711 489.711"
                                                                 style="enable-background:new 0 0 489.711 489.711; vertical-align: middle; margin-top: -3px;"
                                                                 xml:space="preserve" width="20px" height="20px"
                                                                 class="mr-2">
                                                                    <g>
                                                                        <g>
                                                                            <path d="M112.156,97.111c72.3-65.4,180.5-66.4,253.8-6.7l-58.1,2.2c-7.5,0.3-13.3,6.5-13,14c0.3,7.3,6.3,13,13.5,13    c0.2,0,0.3,0,0.5,0l89.2-3.3c7.3-0.3,13-6.2,13-13.5v-1c0-0.2,0-0.3,0-0.5v-0.1l0,0l-3.3-88.2c-0.3-7.5-6.6-13.3-14-13    c-7.5,0.3-13.3,6.5-13,14l2.1,55.3c-36.3-29.7-81-46.9-128.8-49.3c-59.2-3-116.1,17.3-160,57.1c-60.4,54.7-86,137.9-66.8,217.1    c1.5,6.2,7,10.3,13.1,10.3c1.1,0,2.1-0.1,3.2-0.4c7.2-1.8,11.7-9.1,9.9-16.3C36.656,218.211,59.056,145.111,112.156,97.111z"/>
                                                                            <path d="M462.456,195.511c-1.8-7.2-9.1-11.7-16.3-9.9c-7.2,1.8-11.7,9.1-9.9,16.3c16.9,69.6-5.6,142.7-58.7,190.7    c-37.3,33.7-84.1,50.3-130.7,50.3c-44.5,0-88.9-15.1-124.7-44.9l58.8-5.3c7.4-0.7,12.9-7.2,12.2-14.7s-7.2-12.9-14.7-12.2l-88.9,8    c-7.4,0.7-12.9,7.2-12.2,14.7l8,88.9c0.6,7,6.5,12.3,13.4,12.3c0.4,0,0.8,0,1.2-0.1c7.4-0.7,12.9-7.2,12.2-14.7l-4.8-54.1    c36.3,29.4,80.8,46.5,128.3,48.9c3.8,0.2,7.6,0.3,11.3,0.3c55.1,0,107.5-20.2,148.7-57.4    C456.056,357.911,481.656,274.811,462.456,195.511z"/>
                                                                        </g>
                                                                    </g>
                                                                </svg>
                                                            {!! trans('main.buttons.change_logo') !!}
                                                        </button>
                                                    </div>
                                                </div>


                                                <div class="mb-3 text-left">
                                                    <div class="d-inline-flex px-0 text-left">
                                                        <div>
                                                            <label>
                                                                {!! trans('fields.label.language') !!}
                                                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" style="vertical-align: middle; margin-top: -3px; cursor: pointer; opacity: 0.4;" data-toggle="tooltip" title="{!! trans('fields.tooltips.default_languages') !!}">
                                                                    <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                                </svg>
                                                            </label>
                                                            <select class="form-control input_style" name="language_prefix">
                                                                <option value="en">English (Default)</option>
                                                                <option value="fr">French</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-8">
                                                        <label>{!! trans('fields.label.more_hiring_language') !!}</label>
                                                        <div id="languages"></div>
                                                    </div> -->
                                                </div>

                                                <p class="mb-1 text-left">{!! trans('fields.label.choose_business_type') !!}</p>
                                                <div class="btn-group-vertical text-center col-12 px-0"
                                                     data-toggle="buttons">
                                                    <div class="btn-group d-flex flex-lg-row flex-column">
                                                        <label class="btn btn-outline-primary btn-block mb-0 py-3 justify-content-center align-items-center business-job-status col-lg-4 col-12"
                                                               data-status="1">
                                                            <input type="radio" name="type"
                                                                   id="business-type-private"  autocomplete="off"
                                                                   value="private">
                                                            <p class="text-center mb-0">
                                                                @svg('/img/business_type/corporate.svg',[
                                                                    'class' => '',
                                                                    'style' => 'vertical-align: middle; margin-top: -4px; fill:rgba(78,92,110,0.4); width:45px; height:45px;',
                                                                ])
                                                            </p>
                                                            <p class="mb-0"><span style="font-size: 18px;">{!! trans('main.b_type_title.private') !!}</span>
                                                            </p>
                                                            <small>{!! trans('main.b_type_text.private') !!}</small>
                                                        </label>
                                                        <label class="btn btn-outline-primary btn-block my-0 py-3 justify-content-center align-items-center business-job-status col-lg-4 col-12"
                                                               data-status="0">
                                                            <input type="radio" name="type"
                                                                   id="business-type-franchisee"  autocomplete="off"
                                                                   value="franchisee">
                                                            <p class="text-center mb-0">
                                                                @svg('/img/business_type/franchise.svg',[
                                                                    'class' => '',
                                                                    'style' => 'vertical-align: middle; margin-top: -4px; fill:rgba(78,92,110,0.4); width:45px; height:45px;',
                                                                ])
                                                            </p>
                                                            <p class="mb-0"><span style="font-size: 18px;">{!! trans('main.b_type_title.franchisee') !!}</span>
                                                            </p>
                                                            <small>{!! trans('main.b_type_text.franchisee') !!}</small>
                                                        </label>
                                                        <label class="btn btn-outline-primary btn-block my-0 py-3 justify-content-center align-items-center business-job-status col-lg-4 col-12"
                                                               data-status="0">
                                                            <input type="radio" name="type"
                                                                   id="business-type-online"  autocomplete="off"
                                                                   value="online">
                                                            <p class="text-center mb-0">
                                                                @svg('/img/business_type/online.svg',[
                                                                    'class' => '',
                                                                    'style' => 'vertical-align: middle; margin-top: -4px; fill:rgba(78,92,110,0.4); width:45px; height:45px;',
                                                                ])
                                                            </p>
                                                            <p class="mb-0"><span style="font-size: 18px;">{!! trans('main.b_type_title.online') !!}</span>
                                                            </p>
                                                            <small>{!! trans('main.b_type_text.online') !!}</small>
                                                        </label>
                                                    </div>
                                                    <div class="btn-group d-flex flex-lg-row flex-column">
                                                        <label class="btn btn-outline-primary btn-block my-0 py-3 justify-content-center align-items-center business-job-status col-lg-4 col-12"
                                                               data-status="0">
                                                            <input type="radio" name="type"
                                                                   id="business-type-hiring"  autocomplete="off"
                                                                   value="hiring">
                                                            <p class="text-center mb-0">
                                                                @svg('/img/business_type/hiring.svg',[
                                                                    'class' => '',
                                                                    'style' => 'vertical-align: middle; margin-top: -4px; fill:rgba(78,92,110,0.4); width:45px; height:45px;',
                                                                ])
                                                            </p>
                                                            <p class="mb-0"><span style="font-size: 18px;">{!! trans('main.b_type_title.hiring') !!}</span>
                                                            </p>
                                                            <small>{!! trans('main.b_type_text.hiring') !!}</small>
                                                        </label>
                                                        <label class="btn btn-outline-primary btn-block my-0 py-3 justify-content-center align-items-center business-job-status col-lg-4 col-12"
                                                               data-status="0">
                                                            <input type="radio" name="type" id="business-type-ee"
                                                                   autocomplete="off" value="ee">
                                                            <p class="text-center mb-0">
                                                                @svg('/img/business_type/ngo.svg', [
                                                                   'width' => '45px',
                                                                   'height' => '45px',
                                                                   'style' => 'vertical-align: middle; margin-top: -4px; fill:rgba(78,92,110,0.4);',
                                                                ])
                                                            </p>
                                                            <p class="mb-0"><span style="font-size: 18px;">{!! trans('main.b_type_title.ngo') !!}</span>
                                                            </p>
                                                            <small></small>
                                                        </label>
                                                        <label class="btn btn-outline-primary btn-block my-0 py-3 justify-content-center align-items-center business-job-status col-lg-4 col-12"
                                                               data-status="0">
                                                            <input type="radio" name="type" id="business-type-ee"
                                                                   autocomplete="off" value="ee">
                                                            <p class="text-center mb-0">
                                                                @svg('/img/business_type/ee.svg', [
                                                                   'width' => '45px',
                                                                   'height' => '45px',
                                                                   'style' => 'vertical-align: middle; margin-top: -4px; fill:rgba(78,92,110,0.4);',
                                                                ])
                                                            </p>
                                                            <p class="mb-0"><span style="font-size: 18px;">{!! trans('main.b_type_title.ee') !!}</span>
                                                            </p>
                                                            <small>{!! trans('main.b_type_text.ee') !!}</small>
                                                        </label>
                                                    </div>
                                                </div>

{{--                                                <div class="text-left">--}}
{{--                                                    <div class="d-inline-flex mt-3">--}}
{{--                                                        <div>--}}
{{--                                                            <label class="mb-0">--}}
{{--                                                                {!! trans('fields.label.hiring_language') !!}--}}
{{--                                                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" style="vertical-align: middle; margin-top: -3px; cursor: pointer; opacity: 0.4;" data-toggle="tooltip" title="{!! trans('fields.tooltips.hiring_language') !!}">--}}
{{--                                                                    <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>--}}
{{--                                                                </svg>--}}
{{--                                                            </label>--}}
{{--                                                            <select class="form-control form-control-sm mb-1 d-inline-flex" name="current_language_prefix">--}}
{{--                                                                --}}{{--<option>English (Default)</option>--}}
{{--                                                                <option>French</option>--}}
{{--                                                            </select>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

                                                <div class="d-flex flex-lg-row flex-column">
                                                    <div class="col-md-12 pb-0 mx-auto mt-4 px-0">
                                                        <nav>
                                                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist" style="padding: 0; margin: 0;">
                                                                <a class="nav-item nav-link active" id="nav-en-tab" data-language-prefix="en" data-toggle="tab" href="#nav-en" role="tab" aria-controls="nav-en" aria-selected="true">English</a>
                                                                <a class="nav-item nav-link" id="nav-fr-tab" data-language-prefix="fr" data-toggle="tab" href="#nav-fr" role="tab" aria-controls="nav-fr" aria-selected="false">French</a>
                                                            </div>
                                                        </nav>
                                                        <div class="tab-content py-3 px-3 px-sm-0 " id="nav-tabContent">
                                                            <div class="tab-pane fade show active" id="nav-en" role="tabpanel" aria-labelledby="nav-en-tab">
                                                                <div class="d-flex flex-lg-row flex-column">
                                                                    <div class="col-lg-12 col-12 pl-0 pr-0 pxa-0">
                                                                        <label for="name-en" style="text-align: left;">{!! trans('fields.label.employer_name') !!}</label>
                                                                        <input autocomplete="disabled" type="text" class="form-control " name="name_en" id="name-en" placeholder="{!! trans('fields.placeholder.employer_name') !!}">
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-lg-row flex-column pt-3">
                                                                    <div class="col-lg-12 col-12 pl-0 pr-0 pxa-0">
                                                                        <label style="text-align: left;" for="description-en">{!! trans('fields.label.employer_description') !!}</label>
                                                                        <textarea id="description-en" class="form-control input_style " placeholder="{!! trans('fields.placeholder.employer_description') !!}" rows='6' style="resize: none;" name="description_en"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-fr" role="tabpanel" aria-labelledby="nav-fr-tab">
                                                                <div class="d-flex flex-lg-row flex-column">
                                                                    <div class="col-lg-12 col-12 pl-0 pxa-0">
                                                                        <label style="text-align: left;" for="name-fr">{!! trans('fields.label.employer_name') !!}</label>
                                                                        <input autocomplete="disabled" type="text" class="form-control" name="name_fr" id="name-fr" placeholder="{!! trans('fields.placeholder.employer_name') !!}">
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-lg-row flex-column pt-3">
                                                                    <div class="col-lg-12 col-12 pl-0 pr-0 pxa-0">
                                                                        <label style="text-align: left;" for="description-fr">{!! trans('fields.label.employer_description') !!}</label>
                                                                        <textarea id="description-fr" class="form-control input_style" placeholder="{!! trans('fields.placeholder.employer_description') !!}" rows='6' style="resize: none;" name="description_fr"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>



{{--                                                <div class="form-group mb-4 text-left mt-3">--}}
{{--                                                    <label>{!! trans('fields.label.employer_name') !!}</label>--}}
{{--                                                    <input type="text" class="form-control multilanguage multilanguage-en"--}}
{{--                                                           placeholder="{!! trans('fields.placeholder.employer_name') !!}" name="name"--}}
{{--                                                           autocomplete="disabled">--}}
{{--                                                    <input type="text" class="form-control multilanguage multilanguage-fr d-none"--}}
{{--                                                           placeholder="{!! trans('fields.placeholder.employer_name') !!}" name="name_fr"--}}
{{--                                                           autocomplete="disabled">--}}
{{--                                                </div>--}}
{{--                                                <div class="form-group mb-4 text-left">--}}
{{--                                                    <label>{!! trans('fields.label.employer_description') !!}</label>--}}
{{--                                                    <textarea class="form-control input_style multilanguage multilanguage-en" rows="3"--}}
{{--                                                              placeholder="{!! trans('fields.placeholder.employer_description') !!}"--}}
{{--                                                              name="description"></textarea>--}}
{{--                                                    <textarea class="form-control input_style multilanguage multilanguage-fr d-none" rows="3"--}}
{{--                                                              placeholder="{!! trans('fields.placeholder.employer_description') !!}"--}}
{{--                                                              name="description_fr"></textarea>--}}
{{--                                                </div>--}}

                                                {{--<div class="form-group mb-4 text-left">
                                                    <label>{!! trans('fields.label.video') !!}</label>
                                                    <input type="text" class="form-control multilanguage multilanguage-en"
                                                           placeholder="{!! trans('fields.placeholder.video') !!}" name="video"
                                                           autocomplete="disabled">
                                                    <input type="text" class="form-control multilanguage multilanguage-fr d-none"
                                                           placeholder="{!! trans('fields.placeholder.video') !!}" name="video_fr"
                                                           autocomplete="disabled">
                                                </div>--}}

                                                <div class="form-group mb-4">
                                                    <div class="d-flex flex-column flex-lg-row">
                                                        <div class="col-lg-4 col-12 pl-0 text-left pxa-0">
                                                            <div class="pl-0 pxa-0">
                                                                <label>{!! trans('fields.label.employer_size') !!}</label>
                                                                <select class="form-control input_style col-lg-6"
                                                                        name="size"></select>
                                                            </div>
                                                            {{--<div class="col-12 pl-0 pxa-0">
                                                                <label class="mt-2 text-left">{!! trans('fields.label.keywords') !!}</label>
                                                                <div id="keywords" data-language-prefix="en" class="[ multilanguage multilanguage-en ]"></div>
                                                                <div id="keywords-fr" data-language-prefix="fr" class="[ multilanguage multilanguage-fr ] d-none"></div>
                                                            </div>--}}

                                                        </div>
                                                        <div class="col-lg-4 col-12 pr-0 pxa-0">
                                                            <div class="">
                                                                <div class="col-12 pr-0 pxa-0">
                                                                    <label class="text-left">{!! trans('fields.label.industry') !!}</label>
                                                                    <div id="industry_id"></div>
                                                                </div>
                                                                {{--<div class="col-12 pr-0 pxa-0">
                                                                    <label class="mt-2 text-left">{!! trans('fields.label.sub_industry') !!}</label>
                                                                    <div id="sub_industry_id"></div>
                                                                </div>--}}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-12 pr-0 pxa-0">
                                                            <div class="">
                                                                <div class="col-12 pr-0 pxa-0">
                                                                    <label class="text-left">{!! trans('fields.label.industry') !!}</label>
                                                                    <input type="text" class="form-control" name="industry">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="form-group mb-1">
                                                    <div class="d-flex flex-column flex-lg-row">
                                                        <div class="col-lg-3 col-12 pl-0 pxa-0">
                                                            <label class="text-left">{!! trans('fields.label.phone_code') !!}</label>
                                                            <div id="country-phone"
                                                                 class="bfh-selectbox bfh-countries"
                                                                 data-country="CA" data-flags="true">
                                                                <input type="hidden" name="phone_country_code"
                                                                       value="CA"
                                                                       class="country">
                                                                <a
                                                                        class="bfh-selectbox-toggle input_style  form-control"
                                                                        role="button" data-toggle="bfh-selectbox"
                                                                        href="#"
                                                                        style="padding: 8px 20px;">
                                                        <span class="bfh-selectbox-option" id="phone_code">
                                                            <i class="glyphicon bfh-flag-CA"></i>+1 <span>Canada</span></span></a>
                                                                <div class="bfh-selectbox-options">
                                                                    <div class="bfh-selectbox-filter-container">
                                                                        <input
                                                                                type="text"
                                                                                class="bfh-selectbox-filter form-control"
                                                                                placeholder="">
                                                                    </div>
                                                                    @include('components.phone_flag')</div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4 col-12 pr-0 pxa-0">
                                                            <label class="text-left">{!! trans('fields.label.phone_number') !!}</label>
                                                            <input type="tel" class="form-control" id="input-phone"
                                                                   placeholder="{!! trans('fields.placeholder.phone_number') !!}"
                                                                   name="phone"  autocomplete="off">
                                                        </div>

                                                        <div class="col-lg-4 col-12 pr-0 pxa-0">
                                                            <label class="text-left">{!! trans('fields.label.website') !!}</label>
                                                            <input type="text" class="form-control [ multilanguage multilanguage-en ]"
                                                                   placeholder="{!! trans('fields.placeholder.website') !!}"
                                                                   name="website" autocomplete="off">
                                                            <input type="text" class="form-control [ multilanguage multilanguage-fr ] d-none"
                                                                   placeholder="{!! trans('fields.placeholder.website') !!}"
                                                                   name="website_fr" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr class="mb-4">
                                                <p class="text-left mb-0"><label>{!! trans('fields.label.city') !!}</label></p>
                                                <div class="form-group input-group mb-4 text-left">
                                                    <span class="input-group-addon" id="basic-addon1"
                                                          style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                                                        <i class="glyphicon"></i>
                                                    </span>
                                                    <input type="text" name="city" class="form-control" placeholder="{!! trans('fields.placeholder.city') !!}"
                                                           id="user-location" autocomplete="disabled">
                                                    <span class="input-group-btn border-0"
                                                          style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                                        <button class="btn mx-0 border-0" type="button"
                                                                id="user-location-clear"
                                                                style="padding-top: 8px;background-color: #f4f4f4; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 col-12">
                                                        <label class="text-left">{!! trans('fields.label.street_number') !!}</label>
                                                        <input type="text" name="street_number" class="form-control"
                                                               placeholder="{!! trans('fields.placeholder.street_number') !!}"  autocomplete="off">
                                                    </div>
                                                    <div class="col-md-7 col-12">
                                                        <label class="text-left">{!! trans('fields.label.road') !!}</label>
                                                        {{--<input type="text" name="street" class="form-control"
                                                               placeholder="Ex: Main Street (without postal code please)">--}}
                                                        <div id="input-street-check" class="" style="display: none">
                                                            <span style="font-size: 13px;">{!! trans('fields.errors.street_address') !!}</span>
                                                            <button class="btn" type="button"
                                                                    id="input-street-number-keep">{!! trans('main.buttons.street_address_keep') !!}</button>
                                                            <button class="btn" type="button"
                                                                    id="input-street-number-clear">{!! trans('main.buttons.street_address_clear') !!}</button>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control border-right-0"
                                                                   placeholder="{!! trans('fields.placeholder.street_address') !!}"
                                                                   name="street" id="business-location-street"  autocomplete="off">
                                                            <span class="input-group-btn border-0"
                                                                  style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                                                <button class="btn mx-0 border-0" type="button"
                                                                        id="location-street-clear"
                                                                        style="padding-top: 8px;background-color: #f4f4f4; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-12">
                                                        <label class="text-left">{!! trans('fields.label.suite') !!}</label>
                                                        <input type="text" name="suite" class="form-control"
                                                               placeholder="{!! trans('fields.placeholder.suite') !!}"  autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 pl-0 pxa-0">
                                                    <label class="text-left">{!! trans('fields.label.zip_code') !!}</label>
                                                    <input type="text" class="form-control"
                                                           placeholder="{!! trans('fields.placeholder.zip_code') !!}"
                                                           name="zip_code"  autocomplete="off">
                                                </div>
                                                <hr class="mb-4">

                                                <div class="mb-3">
                                                    <label class="text-left">
                                                        <img src="{{ asset('img/icons/facebook.svg') }}" width="30px" height="30px">
                                                        Facebook
                                                    </label>
                                                    <input type="text" name="facebook" placeholder="facebook.com/user123" class="form-control [ multilanguage multilanguage-en ]">
                                                    <input type="text" name="facebook_fr" placeholder="facebook.com/user123" class="form-control [ multilanguage multilanguage-fr ] d-none">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="text-left">
                                                        <img src="{{ asset('img/icons/instagram.svg') }}" width="30px" height="30px">
                                                        Instagram
                                                    </label>
                                                    <input type="text" name="instagram" placeholder="instagram.com/user123" class="form-control [ multilanguage multilanguage-en ]">
                                                    <input type="text" name="instagram_fr" placeholder="instagram.com/user123" class="form-control [ multilanguage multilanguage-fr ] d-none">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="text-left">
                                                        <img src="{{ asset('img/icons/linkedin.svg') }}" width="30px" height="30px">
                                                        LinkedIn
                                                    </label>
                                                    <input type="text" name="linkedin" placeholder="linkedin.com/user123" class="form-control [ multilanguage multilanguage-en ]">
                                                    <input type="text" name="linkedin_fr" placeholder="linkedin.com/user123" class="form-control [ multilanguage multilanguage-fr ] d-none">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="text-left">
                                                        <img src="{{ asset('img/icons/twitter.svg') }}" width="30px" height="30px">
                                                        Twitter
                                                    </label>
                                                    <input type="text" name="twitter" placeholder="twitter.com/user123" class="form-control [ multilanguage multilanguage-en ]">
                                                    <input type="text" name="twitter_fr" placeholder="twitter.com/user123" class="form-control [ multilanguage multilanguage-fr ] d-none">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="text-left">
                                                        <img src="{{ asset('img/icons/youtube.svg') }}" width="30px" height="30px">
                                                        Youtube
                                                    </label>
                                                    <input type="text" name="youtube" placeholder="youtube.com/user123" class="form-control [ multilanguage multilanguage-en ]">
                                                    <input type="text" name="youtube_fr" placeholder="youtube.com/user123" class="form-control [ multilanguage multilanguage-fr ] d-none">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="text-left">
                                                        <img src="{{ asset('img/icons/snapchat.svg') }}" width="30px" height="30px">
                                                        Snapchat
                                                    </label>
                                                    <input type="text" name="snapchat" placeholder="snapchat.com/user123" class="form-control [ multilanguage multilanguage-en ]">
                                                    <input type="text" name="snapchat_fr" placeholder="snapchat.com/user123" class="form-control [ multilanguage multilanguage-fr ] d-none">
                                                </div>

                                                <div class="form-group text-center mr-3">
                                                    <a class="btn btn-primary px-4" id="business-profile-update"
                                                       href="#">{!! trans('main.buttons.update') !!}</a>
                                                </div>

{{--                                                <div class="bg-white mb-3 mt-5">--}}
{{--                                                    <a href="{!! url('/business/branch/add') !!}" role="button"--}}
{{--                                                       class="btn btn-lg btn-outline-primary w-100 p-4">--}}
{{--                                                    <span class="d-block mb-0">--}}
{{--                                                        <svg id="Layer_1" width="45px" height="45px"--}}
{{--                                                             style="enable-background:new 0 0 512 512;"--}}
{{--                                                             version="1.1" viewBox="0 0 512 512"--}}
{{--                                                             xml:space="preserve" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                             xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><g><path--}}
{{--                                                                                d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"/></g></g><g><polygon--}}
{{--                                                                            points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  "/></g></g></svg>--}}
{{--                                                    </span>--}}
{{--                                                        {!! trans('main.buttons.manage_add_location') !!}--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="bg-white mb-3">--}}
{{--                                                    <a href="{!! url('/business/job/add') !!}" role="button"--}}
{{--                                                       class="btn btn-lg btn-outline-primary w-100 p-4">--}}
{{--                                                    <span class="d-block mb-0">--}}
{{--                                                        <svg id="Layer_1" width="45px" height="45px"--}}
{{--                                                             style="enable-background:new 0 0 512 512;"--}}
{{--                                                             version="1.1" viewBox="0 0 512 512"--}}
{{--                                                             xml:space="preserve" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                             xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><g><path--}}
{{--                                                                                d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"/></g></g><g><polygon--}}
{{--                                                                            points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  "/></g></g></svg>--}}
{{--                                                    </span>--}}
{{--                                                        {!! trans('main.buttons.manage_add_job') !!}--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="bg-white mb-3">--}}
{{--                                                    <a href="{!! url('/business/manage/manager/add') !!}"--}}
{{--                                                       role="button"--}}
{{--                                                       class="btn btn-lg btn-outline-primary w-100 p-4">--}}
{{--                                                    <span class="d-block mb-0">--}}
{{--                                                        <svg id="Layer_1" width="45px" height="45px"--}}
{{--                                                             style="enable-background:new 0 0 512 512;"--}}
{{--                                                             version="1.1" viewBox="0 0 512 512"--}}
{{--                                                             xml:space="preserve" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                             xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><g><path--}}
{{--                                                                                d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"/></g></g><g><polygon--}}
{{--                                                                            points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  "/></g></g></svg>--}}
{{--                                                    </span>--}}
{{--                                                        {!! trans('main.buttons.manage_add_user') !!}--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="bg-white">--}}
{{--                                                    <a href="{!! url('/business/manage/department/add') !!}"--}}
{{--                                                       role="button"--}}
{{--                                                       class="btn btn-lg btn-outline-primary w-100 p-4">--}}
{{--                                                    <span class="d-block mb-0">--}}
{{--                                                        <svg id="Layer_1" width="45px" height="45px"--}}
{{--                                                             style="enable-background:new 0 0 512 512;"--}}
{{--                                                             version="1.1" viewBox="0 0 512 512"--}}
{{--                                                             xml:space="preserve" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                             xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><g><path--}}
{{--                                                                                d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"/></g></g><g><polygon--}}
{{--                                                                            points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  "/></g></g></svg>--}}
{{--                                                    </span>--}}
{{--                                                        {!! trans('main.buttons.manage_add_department') !!}--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog"
             tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="avatar-form" action="" enctype="multipart/form-data" method="post" autocomplete="off">
                        <div class="modal-header">
                            <h4 class="modal-title" id="avatar-modal-label">{!! trans('modals.title.change_b_logo') !!}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="avatar-body">

                                <!-- Upload image and data -->
                                <div class="avatar-upload">
                                    <input type="hidden" class="avatar-src" name="avatar_src">
                                    <input type="hidden" class="avatar-data" name="avatar_data">
                                    <div class="bg-white mb-3">
                                        <a href="javascript:void(0)" role="button"
                                           class="btn btn-lg btn-outline-primary w-100 p-4" id="avatar-input-btn">
                                                        <span class="d-block mb-0">
                                                            <svg id="Layer_1" width="45px" height="45px"
                                                                 style="enable-background:new 0 0 512 512;"
                                                                 version="1.1" viewBox="0 0 512 512"
                                                                 xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><g><path
                                                                                    d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"
                                                                                    fill="#4266ff"></path></g></g><g><polygon
                                                                                points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  "
                                                                                fill="#4266ff"></polygon></g></g></svg>
                                                        </span>
                                            {!! trans('main.buttons.upload_file') !!}
                                            <p class="mb-0">{!! trans('modals.text.logo_optimal_size') !!}</p>
                                        </a>
                                    </div>
                                    <input type="file" class="avatar-input" id="avatar-input" name="avatar_file">
                                </div>

                                <!-- Crop and preview -->
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="avatar-wrapper"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row avatar-btns">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-primary btn-block avatar-save">{!! trans('main.buttons.save') !!}
                                                </button>
                                            </div>
                                        </div>
                                        <p>{!! trans('modals.text.size_previews') !!}</p>
                                        <div class="avatar-preview preview-lg">
                                        </div>
                                        <div class="avatar-preview preview-md">
                                        </div>
                                        <div class="avatar-preview preview-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>--}}
        @include('components.modal.business_change_logo')
        @include('components.modal.business_change_background')
    </div>
@endsection

@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key={{ env('GOOGLE_MAPS_API_KEY', 'AIzaSyCLDOlFEBqX8B8bwiURqNObe5V5xrJrftw') }}"></script>
    <script src="{{ asset('/js/cropper.min.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/main-cropper.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/business-bg-cropper.js?v='.time()) }}"></script>
@stop
