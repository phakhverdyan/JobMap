@extends('layouts.main_business')

@section('content')
    <style type="text/css">
        .addto:hover {
            background-color: #f7f7f7;
            transition: 0.5s;
            box-shadow: 0 5px 23px rgba(0, 0, 0, 0.3);
        }

        .addto {
            background-color: #fff;
            transition: 0.5s;
        }

        .coll_name {
            text-decoration: none;
            color: #7b7b7b;
            font-size: 17px;
            letter-spacing: -0.5px;
        }

        .coll_title {
            text-decoration: none;
            color: #7b7b7b;
            font-size: 14px;
            font-weight: 400;
        }

        button.button-assign{
            width: 150px;
            display: inline-block;
            margin-top: 25px!important;
            margin-left: 25px;
            margin-bottom: 15px;
        }
        .button-assign-block{
            text-align: right;
        }
        .table-button-assign{
            width: 40px;
            display: inline-block;
            margin-top: 15px!important;
            margin-bottom: 15px;
            margin-left: 15px;
        }

    </style>
    <div class="container-fluid">
        <div class="row">
            <!-- left menu begin -->
            <div id="slide-out" class="col-3 pl-0 sidebar_adaptive">
                @include('components.sidebar.sidebar_business')
            </div>
            <!-- left menu eof -->

            <!-- content block begin-->
            <div class="col-xl-8 col-11 mx-auto pb-5 mt-2  bg-white rounded content-main">
                <div class="row">
                    <div class="col-md-12 text-center mt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512"
                             style="enable-background:new 0 0 512 512; fill:#4266ff; " xml:space="preserve" width="70px"
                             height="70px">
                            <g>
                                <g>
                                    <path d="M256,303.216c-53.744,0-97.468,43.724-97.468,97.468c0,30.532,14.115,57.825,36.159,75.71    c0.417,0.398,0.869,0.761,1.354,1.084c16.547,12.947,37.365,20.674,59.955,20.674c22.59,0,43.408-7.727,59.955-20.674    c0.486-0.323,0.937-0.686,1.354-1.084c22.043-17.885,36.159-45.178,36.159-75.71C353.468,346.939,309.744,303.216,256,303.216z     M256,478.152c-15.809,0-30.522-4.77-42.791-12.933c6.576-16.892,23.632-28.603,42.791-28.603s36.215,11.711,42.791,28.603    C286.521,473.382,271.809,478.152,256,478.152z M238.384,400.683c0-8.786,7.147-15.933,15.932-15.933    c8.785,0,15.933,7.147,15.933,15.933s-7.148,15.933-15.933,15.933C245.531,416.616,238.384,409.469,238.384,400.683z     M314.445,451.445c-6.835-12.9-18.034-23.157-31.474-29.111c4.564-6.026,7.277-13.526,7.277-21.65    c0-19.813-16.119-35.933-35.933-35.933c-19.813,0-35.932,16.119-35.932,35.933c0,8.65,3.073,16.594,8.183,22.802    c-12.343,6.08-22.599,15.856-29.012,27.96c-11.834-13.607-19.023-31.355-19.023-50.762c0-42.716,34.752-77.468,77.468-77.468    s77.468,34.752,77.468,77.468C333.468,420.09,326.279,437.838,314.445,451.445z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M97.468,13.847C43.724,13.847,0,57.572,0,111.316c0,30.533,14.116,57.826,36.16,75.711    c0.416,0.397,0.867,0.759,1.351,1.082c16.547,12.948,37.366,20.675,59.957,20.675s43.41-7.728,59.957-20.676    c0.484-0.322,0.934-0.684,1.35-1.081c22.044-17.885,36.161-45.179,36.161-75.712C194.936,57.571,151.212,13.847,97.468,13.847z     M97.468,188.785c-15.809-0.001-30.521-4.771-42.791-12.933c6.576-16.892,23.632-28.603,42.791-28.603    s36.215,11.711,42.791,28.603C127.989,184.015,113.278,188.785,97.468,188.785z M79.851,111.317    c0-8.785,7.147-15.933,15.933-15.933s15.933,7.147,15.933,15.933c0,8.786-7.148,15.932-15.933,15.932    C86.999,127.249,79.851,120.102,79.851,111.317z M155.913,162.077c-6.834-12.9-18.034-23.156-31.474-29.111    c4.564-6.025,7.277-13.526,7.277-21.65c0-19.813-16.119-35.933-35.933-35.933c-19.814,0-35.933,16.119-35.933,35.933    c0,8.649,3.073,16.594,8.183,22.802c-12.343,6.08-22.599,15.856-29.011,27.96C27.189,148.471,20,130.723,20,111.316    C20,68.6,54.752,33.848,97.468,33.848s77.468,34.752,77.468,77.468C174.936,130.722,167.747,148.47,155.913,162.077z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M414.532,13.848c-53.744,0-97.468,43.724-97.468,97.468c0,30.534,14.117,57.828,36.162,75.713    c0.415,0.396,0.864,0.757,1.347,1.079c16.547,12.948,37.367,20.676,59.958,20.676s43.41-7.727,59.957-20.675    c0.485-0.323,0.935-0.685,1.352-1.082c22.044-17.884,36.16-45.178,36.16-75.711C512,57.572,468.276,13.848,414.532,13.848z     M414.532,188.785c-15.81-0.001-30.522-4.771-42.791-12.933c6.576-16.892,23.631-28.603,42.791-28.603    s36.215,11.711,42.791,28.603C445.053,184.015,430.341,188.785,414.532,188.785z M396.915,111.317    c0-8.785,7.147-15.933,15.933-15.933s15.932,7.147,15.932,15.933c0,8.786-7.147,15.932-15.932,15.932    C404.063,127.249,396.915,120.102,396.915,111.317z M472.977,162.077c-6.835-12.9-18.034-23.157-31.474-29.111    c4.564-6.025,7.277-13.526,7.277-21.65c0-19.813-16.119-35.933-35.932-35.933s-35.933,16.119-35.933,35.933    c0,8.649,3.073,16.594,8.183,22.801c-12.344,6.08-22.599,15.856-29.012,27.96c-11.833-13.606-19.023-31.354-19.023-50.761    c0-42.716,34.752-77.468,77.468-77.468S492,68.6,492,111.316C492,130.722,484.811,148.47,472.977,162.077z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M140.977,355.435c-0.041-0.035-0.085-0.074-0.121-0.104c-4.216-3.567-10.526-3.041-14.093,1.174    c-3.544,4.188-3.048,10.442,1.091,14.022c0.041,0.035,0.085,0.074,0.121,0.104c1.878,1.589,4.172,2.366,6.455,2.366    c2.84,0,5.661-1.203,7.639-3.541C145.611,365.269,145.116,359.014,140.977,355.435z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M121.466,335.379c-0.02-0.025-0.104-0.125-0.124-0.149c-3.551-4.213-9.825-4.741-14.049-1.204    c-4.225,3.536-4.778,9.841-1.256,14.078l0.016,0.02c1.978,2.392,4.833,3.628,7.712,3.628c2.245,0,4.502-0.752,6.367-2.294    C124.388,345.938,124.986,339.635,121.466,335.379z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M105.253,312.447c-0.021-0.037-0.093-0.158-0.115-0.194c-2.854-4.729-9.013-6.27-13.741-3.416    c-4.729,2.854-6.261,8.98-3.408,13.708l0.01,0.016c1.861,3.176,5.203,4.944,8.636,4.944c1.718,0,3.459-0.443,5.048-1.375    C106.448,323.338,108.046,317.212,105.253,312.447z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M84.514,260.303c-1.164-5.399-6.482-8.834-11.881-7.67c-5.399,1.163-8.833,6.482-7.67,11.881    c0.008,0.037,0.038,0.17,0.046,0.207c1.055,4.641,5.18,7.793,9.747,7.793c0.731-0.001,1.476-0.082,2.221-0.251    C82.362,271.039,85.738,265.688,84.514,260.303z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M92.804,287.183c-0.007-0.017-0.05-0.126-0.057-0.143c-2.065-5.12-7.885-7.593-13.006-5.532    c-5.121,2.061-7.601,7.888-5.543,13.01l0.017,0.042c1.557,3.923,5.319,6.314,9.298,6.314c1.227,0,2.476-0.228,3.686-0.708    C92.331,298.129,94.841,292.316,92.804,287.183z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M385.238,356.506c-3.568-4.217-9.877-4.742-14.094-1.175c-0.035,0.029-0.079,0.067-0.119,0.102    c-4.142,3.579-4.637,9.834-1.093,14.023c1.978,2.338,4.799,3.541,7.639,3.541c2.282,0,4.576-0.777,6.455-2.366    c0.035-0.029,0.079-0.067,0.119-0.102C388.287,366.95,388.782,360.695,385.238,356.506z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M432.267,281.505c-5.125-2.066-10.949,0.412-13.014,5.535c-0.007,0.017-0.05,0.126-0.057,0.143    c-2.033,5.124,0.481,10.88,5.599,12.927c1.208,0.483,2.454,0.711,3.682,0.711c3.976,0,7.75-2.396,9.325-6.302    C439.867,289.397,437.389,283.57,432.267,281.505z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M404.749,334.031c-4.223-3.56-10.531-3.023-14.091,1.199c-0.021,0.024-0.104,0.125-0.125,0.149    c-3.507,4.242-2.896,10.483,1.329,14.011c1.86,1.553,4.125,2.309,6.38,2.309c2.867,0,5.72-1.221,7.706-3.577    C409.508,343.899,408.972,337.59,404.749,334.031z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M439.407,252.668c-5.374-1.186-10.704,2.227-11.913,7.598l-0.005,0.021c-1.224,5.386,2.15,10.744,7.535,11.968    c0.746,0.169,1.491,0.25,2.226,0.25c4.564,0,8.688-3.146,9.742-7.786c0.008-0.037,0.038-0.17,0.046-0.207    C448.197,259.132,444.783,253.852,439.407,252.668z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M420.591,308.857c-4.728-2.852-10.875-1.333-13.729,3.396c-0.022,0.036-0.094,0.158-0.115,0.194    c-2.793,4.765-1.202,10.903,3.563,13.696c1.592,0.934,3.336,1.378,5.056,1.378c3.427,0,6.761-1.763,8.621-4.936    C426.84,317.857,425.319,311.711,420.591,308.857z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M441.974,223.061c-5.524-0.316-10.233,3.922-10.544,9.435c0,0.002-0.001,0.031-0.001,0.034    c-0.307,5.514,3.917,10.207,9.431,10.513c0.188,0.01,0.375,0.016,0.561,0.016c5.27,0,9.684-4.145,9.98-9.472    C451.707,228.074,447.487,223.369,441.974,223.061z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M318.223,31.92l-0.095-0.031c-5.257-1.7-10.893,1.186-12.59,6.441c-1.699,5.255,1.185,10.892,6.441,12.59l0.095,0.031    c1.022,0.33,2.058,0.487,3.076,0.487c4.222,0,8.146-2.695,9.514-6.928C326.362,39.255,323.478,33.618,318.223,31.92z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M287.492,24.702l-0.264-0.041c-5.468-0.803-10.578,2.969-11.382,8.433c-0.802,5.464,2.943,10.539,8.407,11.343    c0.548,0.09,1.094,0.134,1.632,0.134c4.81,0,9.051-3.48,9.855-8.381C296.635,30.74,292.942,25.597,287.492,24.702z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M255.88,22.442l-0.247,0.002c-5.522,0.082-9.957,4.624-9.875,10.146c0.08,5.473,4.518,9.853,9.972,9.853    c0.05,0,0.1,0,0.15-0.001c5.523,0,10-4.477,10-10S261.403,22.442,255.88,22.442z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M206.094,38.637c-1.602-5.286-7.188-8.272-12.47-6.67l-0.137,0.042c-5.279,1.624-8.213,7.211-6.589,12.49    c1.322,4.296,5.295,7.053,9.575,7.053c0.977,0,1.97-0.144,2.951-0.445C204.71,49.505,207.696,43.922,206.094,38.637z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M235.801,33.473c-0.882-5.452-5.997-9.162-11.448-8.278l1.457,9.894l-1.476-9.891c-5.462,0.815-9.229,5.904-8.415,11.367    c0.741,4.962,5.008,8.525,9.878,8.525c0.491,0,0.989-0.036,1.489-0.111c0.041-0.006,0.179-0.028,0.219-0.034    C232.957,44.063,236.683,38.925,235.801,33.473z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M80.357,230.32c-1.164-5.399-6.482-8.834-11.881-7.67c-5.399,1.163-8.833,6.482-7.67,11.881    c0.008,0.037,0.038,0.17,0.046,0.207c1.055,4.641,5.18,7.793,9.747,7.793c0.731,0,1.476-0.082,2.221-0.251    C78.205,241.056,81.581,235.705,80.357,230.32z"/>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="col-md-12 text-center pb-3 card border-top-0 border-left-0 border-right-0 rounded-0">
                        <h3 class="mx-auto mt-2 text-muted">{!! trans('pages.title.department.add') !!}</h3>
                    </div>
                </div>
                <form id="business-department-form" autocomplete="off">
                    <div class="row">
                        <div class="col-lg-8 col-12 mx-auto">
                            <div class="btn-group text-center col-md-12 pxa-0 mt-3 d-flex flex-column flex-lg-row" data-toggle="buttons">
                                <label class="btn btn-outline-primary btn-block mb-0 py-3 w-100 d-flex flex-column justify-content-center align-items-center business-department-status active"
                                       data-status="1">
                                    <input type="radio" name="visibility-options" id="option1"  autocomplete="off"
                                           checked="">

                                    {!! trans('main.status.enabled') !!}
                                </label>
                                <label class="btn btn-outline-primary btn-block my-0 py-3 w-100 d-flex flex-column justify-content-center align-items-center business-department-status"
                                       data-status="0">
                                    <input type="radio" name="visibility-options" id="option2"  autocomplete="off">

                                    {!! trans('main.status.disabled') !!}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-inline-flex mt-3">
                        <div>
                            <label class="mb-0">
                                Language 
                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" style="vertical-align: middle; margin-top: -3px; cursor: pointer; opacity: 0.4;">
                                    <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                </svg>
                            </label>
                            <select name="current_language_prefix" class="form-control form-control-sm mb-1 d-inline-flex">
                                <option value="en">English (Default)</option>
                                <option value="fr">French</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">

                        <div class="col-md-12  pt-3">
                            <label>{!! trans('fields.label.department_name') !!}</label>
                            <input type="text" name="name" class="form-control [ multilanguage multilanguage-en ]" placeholder="{!! trans('fields.placeholder.department_name') !!}">
                            <input type="text" name="name_fr" class="form-control [ multilanguage multilanguage-fr ] d-none" placeholder="{!! trans('fields.placeholder.department_name') !!}">
                        </div>

                        <div class="col-md-10 pb-0 card mx-auto mt-5 px-0">
                            <div class="panel-group" id="accordion">

                                <div class="panel panel-default assign-panel" style="box-shadow: 0 5px 23px rgba(0,0,0,0.2);">
                                    <div class="panel-heading">
                                        <h4 class="panel-title my-0">
                                            <a data-toggle="collapse" href="#data-table-assigned-locations-collapse" data-parent="#accordion"
                                               class="h5 modal-title text-center py-3 card border-top-0 border-left-0 border-right-0 rounded-0 addto main-panel"
                                               style="text-decoration: none; color: #7b7b7b; font-size: 15px;font-weight: 400;" data-type-panel="location">
                                                <p class="text-center mb-0"><img
                                                            src="{{ asset('img/sidebar/locations.png') }}" alt=""/></p>
                                                {!! trans('modals.title.add_department_location') !!}</a>
                                        </h4>
                                    </div>
                                    <div id="data-table-assigned-locations-collapse" class="panel-collapse collapse pb-4">
                                        <div class="col-md-12 mx-auto" {{--style="overflow-y: auto;    height: auto;"--}}>
                                            <div class="row">
{{--                                                <div class="col-md-6 col-sm-6 col-lg-6" style="padding: 25px 0 25px 15px;">--}}
{{--                                                    <div class="d-flex flex-lg-row flex-column justify-content-start" role="group" aria-label="Basic example">--}}
{{--                                                        <div class="d-flex col-12 pl-0 col-lg-12 pxa-0 justify-content-between mb-3 mb-lg-0"--}}
{{--                                                             style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;">--}}
{{--                                                            <input type="text" class="form-control border-0 ml-2"--}}
{{--                                                                   style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;"--}}
{{--                                                                   placeholder="{!! trans('fields.placeholder.cr_locations_search') !!}"--}}
{{--                                                                   id="table-brand-location-search"  autocomplete="off">--}}
{{--                                                            <div class="align-self-center mr-3 mr-lg-0">--}}
{{--                                                                <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                                     xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"--}}
{{--                                                                     x="0px" y="0px" viewBox="0 0 250.313 250.313"--}}
{{--                                                                     style="enable-background:new 0 0 250.313 250.313; opacity: 0.1;"--}}
{{--                                                                     xml:space="preserve" widht="17px" height="17px">--}}
{{--                                                <g id="Search">--}}
{{--                                                    <path style="fill-rule:evenodd;clip-rule:evenodd;"--}}
{{--                                                          d="M244.186,214.604l-54.379-54.378c-0.289-0.289-0.628-0.491-0.93-0.76   c10.7-16.231,16.945-35.66,16.945-56.554C205.822,46.075,159.747,0,102.911,0S0,46.075,0,102.911   c0,56.835,46.074,102.911,102.91,102.911c20.895,0,40.323-6.245,56.554-16.945c0.269,0.301,0.47,0.64,0.759,0.929l54.38,54.38   c8.169,8.168,21.413,8.168,29.583,0C252.354,236.017,252.354,222.773,244.186,214.604z M102.911,170.146   c-37.134,0-67.236-30.102-67.236-67.235c0-37.134,30.103-67.236,67.236-67.236c37.132,0,67.235,30.103,67.235,67.236   C170.146,140.044,140.043,170.146,102.911,170.146z"/>--}}
{{--                                                </g>--}}
{{--                                            </svg>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-12 col-lg-12 col-sm-12 button-assign-block">--}}
{{--                                                    <button type="button" class="btn btn-success btn-block assign-all button-assign assign-current-brand" role="button">--}}
{{--                                                        <i class="fa fa-check-square-o" aria-hidden="true"></i>--}}
{{--                                                        {!! trans('main.buttons.assign_all') !!}--}}
{{--                                                    </button>--}}
{{--                                                    <button type="button" class="btn btn-primary btn-block unassign-all button-assign unassign-current-brand" role="button">--}}
{{--                                                        <i class="fa fa-square-o" aria-hidden="true"></i>--}}
{{--                                                        {!! trans('main.buttons.unassign_all') !!}--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}

                                                <div class="col-md-12 col-lg-12 col-sm-12">
                                                    <h4 class="dataTable-header">{!! trans('main.header_step_selected_brand') !!}</h4>
                                                    <table class="table table-responsive display responsive no-wrap" id="business-table" style="width:100%">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col"></th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
{{--                                                <div id="location-table-desktop" class="col-md-7 d-sm-none d-md-none d-lg-block d-xl-block">--}}
{{--                                                    <table class="table details-table display responsive no-wrap" style="width: 100%;" id="location-table">--}}
{{--                                                        <thead>--}}
{{--                                                        <tr>--}}
{{--                                                            <th scope="col"></th>--}}
{{--                                                        </tr>--}}
{{--                                                        </thead>--}}
{{--                                                    </table>--}}
{{--                                                </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-11 mx-auto px-0 mt-4">
                            <button class="btn btn-primary btn-block" type="button" role="button" id="business-department-create">{!! trans('main.buttons.create_department') !!}</button>
                        </div>
                    </div>
                </form>
            </div>


        </div>

        <!--Assign all MODAL!!!!!!!!!!!!!!! -->
        <div class="modal fade" id="assignall" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body pb-3">
                        <p class="text-center">{!! trans('modals.text.assign_all') !!}</p>
                        <div class="col-md-12 mt-5 mb-2">
                            <div class="row">
                                <div class="col-md-4 offset-md-2">
                                    <button class="btn btn-danger btn-block" data-dismiss="modal">{!! trans('main.buttons.cancel') !!}</button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success btn-block" data-dismiss="modal">{!! trans('main.buttons.accept') !!}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Assign all MODAL END!!!!!!!!!!!!!!! -->

        <!--Assign all MODAL!!!!!!!!!!!!!!! -->
        <div class="modal fade" id="unassignall" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body pb-3">
                        <p class="text-center">{!! trans('modals.text.unassign_all') !!}</p>
                        <div class="col-md-12 mt-5 mb-2">
                            <div class="row">
                                <div class="col-md-4 offset-md-2">
                                    <button class="btn btn-danger btn-block" data-dismiss="modal">{!! trans('main.buttons.cancel') !!}</button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success btn-block" data-dismiss="modal">{!! trans('main.buttons.accept') !!}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Assign all MODAL END!!!!!!!!!!!!!!! -->
    </div>
@endsection
        @section('script')
{{--            <script src="{{ asset('/js/app/business-items.js?v='.time()) }}"></script>--}}

<script src="{{ asset('/js/app/business-functions.js?v='.time()) }}"></script>

<script type="text/javascript">

    jQuery(document).ready(function ($) {

        let $BusinessFunc = new BusinessFunc();
        // $BusinessFunc.location_table_id = $(document).find("#location-table");
        $BusinessFunc.business_table_id = $(document).find("#business-table");
        $BusinessFunc.form = $(document).find("#business-department-form");
        $BusinessFunc.form_type = "department-create";
        $BusinessFunc.button_create = $(document).find("#business-department-create");
        $BusinessFunc.redirect_url = '{!! url('/business/manage/department/list') !!}';
        $BusinessFunc.init();
    });
</script>


@endsection