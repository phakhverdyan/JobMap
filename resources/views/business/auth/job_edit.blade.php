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
        .select2.select2-container.select2-container--default .selection .select2-selection.select2-selection--multiple,
        .select2.select2-container .selection .select2-selection{
            background-color: #f4f4f4;
            box-shadow: none!important;
            border-radius: 10px!important;
            border: none!important;
            color: #495057;
            font-size: 14px;
        }
        .select2-selection__rendered .select2-selection__clear{
            display: none;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-selection__choice{
            color: #fff;
            background-color: #4266ff;
            border-color: #4266ff;
            font-weight: 400;
            padding: .25rem .5rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: 10px;
            -webkit-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
            margin: 3.5px 5px 1px 0;
        }
        .select2-container .select2-search--inline::before{
            display: table;
            clear: both;
        }
        .select2-container .select2-search--inline{
            float: none;
            display: block;
        }
        .select2-container--default .select2-search--inline .select2-search__field{
            padding: 8px 9px;
            margin-top: 0;
            width: 100%!important;
            display: block!important;
        }
        .select2-dropdown{
            border: 1px solid rgba(0,0,0,.15)!important;
            border-radius: .25rem!important;
        }

    </style>
    <div class="container-fluid pl-0-">
        <div class="row">
            <!-- left menu begin -->
            <div id="slide-out" class="col-3- sidebar_adaptive">
                @include('components.sidebar.sidebar_business')
            </div>
            <!-- left menu eof -->

            <!-- content block begin-->
            <div class="col-8 mx-auto pb-5 mt-5 bg-white rounded content-main">
                <div class="row">
                    <div class="col-md-12 text-center mt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Layer_1" x="0px" y="0px" viewBox="0 0 512.019 512.019"
                             style="enable-background:new 0 0 512.019 512.019;" xml:space="preserve" width="70px"
                             height="70px" class=""><g>
                                <g>
                                    <g>
                                        <path d="M480.009,106.676h-448c-17.643,0-32,14.357-32,32v298.667c0,17.643,14.357,32,32,32h448c17.643,0,32-14.357,32-32V138.676    C512.009,121.033,497.652,106.676,480.009,106.676z M490.676,437.343c0,5.888-4.779,10.667-10.667,10.667h-448    c-5.888,0-10.667-4.779-10.667-10.667V138.676c0-5.888,4.779-10.667,10.667-10.667h448c5.888,0,10.667,4.779,10.667,10.667    V437.343z"
                                              data-original="#000000" class="active-path" data-old_color="#4266ff"
                                              fill="#4266ff"></path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M309.343,42.676H202.676c-17.643,0-32,14.357-32,32v42.667c0,5.888,4.779,10.667,10.667,10.667h149.333    c5.888,0,10.667-4.779,10.667-10.667V74.676C341.343,57.033,326.985,42.676,309.343,42.676z M320.009,106.676h-128v-32    c0-5.888,4.779-10.667,10.667-10.667h106.667c5.888,0,10.667,4.779,10.667,10.667V106.676z"
                                              data-original="#000000" class="active-path" data-old_color="#4266ff"
                                              fill="#4266ff"></path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M511.668,242.655c-1.493-5.717-7.403-9.088-13.013-7.637l-169.963,44.331c-47.552,12.416-97.835,12.416-145.387,0    L13.364,235.017c-5.611-1.451-11.541,1.92-13.013,7.637c-1.493,5.696,1.92,11.52,7.637,13.013l169.941,44.331    c25.557,6.656,51.819,9.984,78.08,9.984s52.544-3.328,78.08-9.984l169.941-44.331    C509.748,254.175,513.161,248.351,511.668,242.655z"
                                              data-original="#000000" class="active-path" data-old_color="#4266ff"
                                              fill="#4266ff"></path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M256.009,192.009c-23.531,0-42.667,19.136-42.667,42.667c0,23.531,19.136,42.667,42.667,42.667    s42.667-19.136,42.667-42.667C298.676,211.145,279.54,192.009,256.009,192.009z M256.009,256.009    c-11.755,0-21.333-9.579-21.333-21.333c0-11.755,9.579-21.333,21.333-21.333c11.755,0,21.333,9.579,21.333,21.333    C277.343,246.431,267.764,256.009,256.009,256.009z"
                                              data-original="#000000" class="active-path" data-old_color="#4266ff"
                                              fill="#4266ff"></path>
                                    </g>
                                </g>
                            </g> </svg>
                    </div>
                    <div class="col-md-12 text-center pb-3 card border-top-0 border-left-0 border-right-0 rounded-0">
                        <h3 class="mx-auto mt-2 text-muted"
                            style="font-family: 'Open Sans', sans-serif; letter-spacing: -1px">{!! trans('pages.title.job.edit') !!}</h3>
                    </div>
                </div>
                <form id="business-job-form" autocomplete="off">
                    <div class="d-flex flex-lg-row flex-column">
                        <div class="col-md-10 pb-0 card mx-auto mt-5 px-0">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default assign-panel"
                                     style="box-shadow: 0 5px 23px rgba(0,0,0,0.2);">
                                    <div class="panel-heading">
                                        <h4 class="panel-title my-0">
                                            <a id="assigned-locations" data-toggle="collapse" href="#data-table-assigned-locations-collapse" data-parent="#accordion"
                                               class="h5 modal-title text-center py-3 card border-top-0 border-left-0 border-right-0 rounded-0 addto main-panel"
                                               style="text-decoration: none; color: #7b7b7b; font-size: 15px;font-weight: 400;"
                                               data-type-panel="location">
                                                <p class="text-center mb-0"><img
                                                            src="{{ asset('img/sidebar/locations.png') }}" alt=""/></p>
                                                <p id="no_location_error_text" class="red text-center hide">
                                                {!! trans('modals.verification.no_location') !!}
                                                </p>
                                                {!! trans('modals.buttons.assign_job_to_locations') !!}</a>
                                        </h4>
                                    </div>
                                    <div id="data-table-assigned-locations-collapse" class="panel-collapse collapse pb-4">
                                        <div class="col-md-12 mx-auto" style="overflow-y: auto; height: auto;">
                                            <div class="row">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12  pt-5">
                        <div class="row">
                            <div class="col-lg-2 pl-0">
                                <label>{!! trans('fields.label.salary') !!}</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="salary" class="form-control" placeholder="{!! trans('fields.placeholder.salary_ex') !!}">
                                    </div>
                                    <div class="col-md-5 pl-1">
                                        <select class="form-control input_style" name="salary_type">
                                            <option value="$" selected>$</option>
                                            <option value="€">€</option>
                                            <option value="£">£</option>
                                            <option value="₽">₽</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 pr-0">
                                <label>{!! trans('fields.label.job_type') !!}</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control" name="type_key">
                                            @foreach ($job_types as $current_job_type)
                                                <option value="{{ $current_job_type->key }}">{{ $current_job_type->localized_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                            <div class="d-flex">
                                                <div class="px-0 pt-3 align-self-end">
                                                    <label for="job-title-en">{!! trans('fields.label.job_title') !!}</label>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control multilanguage" name="title_en" id="job-title-en" placeholder="{!! trans('fields.label.job_title') !!}">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-lg-row flex-column pt-3">
                                        <div class="col-lg-12 col-12 pl-0 pr-0 pxa-0">
                                            <label for="job-description-en">{!! trans('fields.label.job_description') !!}</label>
                                            <textarea id="job-description-en" class="form-control input_style multilanguage" placeholder="{!! trans('fields.placeholder.job_description') !!}" rows='6' style="resize: none;" name="description_en"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-fr" role="tabpanel" aria-labelledby="nav-fr-tab">
                                    <div class="d-flex flex-lg-row flex-column">
                                        <div class="col-lg-12 col-12 pl-0 pxa-0">
                                            <div class="d-flex">
                                                <div class="px-0 pt-3 align-self-end">
                                                    <label for="job-title-fr">{!! trans('fields.label.job_title') !!}</label>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control multilanguage" name="title_fr" id="job-title-fr" placeholder="{!! trans('fields.label.job_title') !!}">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-lg-row flex-column pt-3">
                                        <div class="col-lg-12 col-12 pl-0 pr-0 pxa-0">
                                            <label for="job-description-fr">{!! trans('fields.label.job_description') !!}</label>
                                            <textarea id="job-description-fr" class="form-control input_style multilanguage" placeholder="{!! trans('fields.placeholder.job_description') !!}" rows='6' style="resize: none;" name="description_fr"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 pt-3">
                        <div class="row">

                            <div class="col-md-2 pt-3">
                                <label>{!! trans('fields.label.hours') !!} <a href="#" data-toggle="tooltip" data-original-title="{!! trans('fields.label.hours_numbers') !!}"> <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" style="vertical-align: middle; margin-top: -3px; cursor: pointer; opacity: 0.4;">
                                        <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg></a></label>
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="text" name="hours" class="form-control" placeholder="{!! trans('fields.placeholder.hours_ex') !!}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-12 pt-3">
                                <label for="select-languages">{!! trans('fields.label.languages_select') !!}</label>
{{--                                <div id="language_level"></div>--}}
                                <select id="select-languages" class="form-control" name="languages[]" multiple="multiple">
                                    <option></option>
                                </select>
                            </div>
{{--                            <div class="col-md-12 col-12 pt-3">--}}
{{--                                <p class="mb-0">--}}
{{--                                    <label for="select-departments">{!! trans('fields.label.department') !!}--}}
{{--                                        <small>--}}
{{--                                            <a href="{!! url('/business/manage/department/list') !!}"--}}
{{--                                               class="ml-3 text-muted mb-0">--}}
{{--                                                <span style="vertical-align: middle;">--}}
{{--                                                    <img src="{{ asset('img/edit.png') }}" style="margin-top: -5px;">--}}
{{--                                                </span>--}}
{{--                                                {!! trans('main.buttons.edit_department') !!}--}}
{{--                                            </a>--}}
{{--                                        </small>--}}
{{--                                    </label>--}}
{{--                                </p>--}}
{{--                                <div class="col-md-12 col-12 px-0">--}}
{{--                                    <select id="select-departments" class="form-control" name="departments[]" multiple="multiple" style="width: 100%;">--}}
{{--                                        <option></option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>


                        <div class="col-md-12 px-0 pt-3">
                            <div class="row">
                                <div class="col-4 pt-3">
                                    <label for="certificate_name">{!! trans('fields.label.certifications') !!}</label>
                                </div>
                            </div>
                            <input id="certificate_name" type="text" name="certificate_name" class="form-control">
{{--                            <select id="select-certificates" class="form-control" name="certificates[]" multiple="multiple">--}}
{{--                                <option></option>--}}
{{--                            </select>--}}
                        </div>

                        <div class="col-md-12 px-0 pt-5">
                            <label>{!! trans('fields.label.required_hours_jobs') !!}</label>
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
                                    <tr class="text-center bg-light" id="job-availabilities-all">
                                        <td colspan="2" class="text-left font-weight-bold">{!! trans('main.label.all') !!}</td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <label class="custom-control custom-checkbox m-0 pl-3">
                                                    <input type="checkbox" class="custom-control-input" data-time="0">
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <label class="custom-control custom-checkbox m-0 pl-3">
                                                    <input type="checkbox" class="custom-control-input" data-time="1">
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <label class="custom-control custom-checkbox m-0 pl-3">
                                                    <input type="checkbox" class="custom-control-input" data-time="2">
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <label class="custom-control custom-checkbox m-0 pl-3">
                                                    <input type="checkbox" class="custom-control-input" data-time="3">
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $days = [trans('main.days.monday'), trans('main.days.tuesday'), trans('main.days.wednesday'), trans('main.days.thursday'), trans('main.days.friday'), trans('main.days.saturday'), trans('main.days.sunday')];
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
                                                                   value="{{ $d }}">
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

                        <div class="col-md-3 mx-auto px-0 mt-4">
                            <button class="btn btn-primary btn-block" id="business-job-create" type="button"
                                    role="button">{!! trans('main.buttons.update_job') !!}
                            </button>
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
                                    <button class="btn btn-danger btn-block">{!! trans('main.buttons.cancel') !!}</button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success btn-block">{!! trans('main.buttons.accept') !!}</button>
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
                                    <button class="btn btn-danger btn-block">{!! trans('main.buttons.cancel') !!}</button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success btn-block">{!! trans('main.buttons.accept') !!}</button>
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
    {{--    <script src="{{ asset('/js/app/business-items.js?v='.time()) }}"></script>--}}
    
    <script src="{{ asset('/js/ckeditor/ckeditor.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/business-functions.js?v='.time()) }}"></script>
    
    <script>
        $(function() {
            function initialize_ckeditor(id) {
                var editor = CKEDITOR.replace(id);

                editor.on('change', function(event) {
                    $(".cke").css({"border-color": "#d1d1d1"});
                    $('#' + id).val(event.editor.getData());
                });
            }

            setTimeout(function () {
                initialize_ckeditor('job-description-en');
                initialize_ckeditor('job-description-fr');
            }, 500);

            var $BusinessFunc = new BusinessFunc();
            // $BusinessFunc.location_table_id = $(document).find("#location-table");
            $BusinessFunc.business_table_id = $("#business-table");
            $BusinessFunc.form = $("#business-job-form");
            $BusinessFunc.form_type = "job-edit";
            $BusinessFunc.button_create = $("#business-job-create");
            $BusinessFunc.redirect_url = "{!! url('/business/job/manage') !!}";
            $BusinessFunc.init();
        });
    </script>
@endsection
