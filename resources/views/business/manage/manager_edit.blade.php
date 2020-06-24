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

    </style>
    <div class="container-fluid pl-0-">
        <div class="row">
            <!-- left menu begin -->
            <div id="slide-out" class="col-3- sidebar_adaptive">
                @include('components.sidebar.sidebar_business')
            </div>
            <!-- left menu eof -->

            <!-- content block begin-->
            <div class="col-8 mx-auto pb-5 mt-5 card content-main">
                <div class="row">
                    <div class="col-md-12 text-center mt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Capa_1" x="0px" y="0px"
                             viewBox="0 0 437.955 437.955" style="enable-background:new 0 0 437.955 437.955;"
                             xml:space="preserve" width="70px" height="70px" class=""><g>
                                <g>
                                    <path d="M328.728,64.036h-72.25V10c0-5.522-4.478-10-10-10h-55c-5.522,0-10,4.478-10,10v54.036h-72.25c-27.57,0-50,22.43-50,50   v273.919c0,27.57,22.43,50,50,50h219.5c27.57,0,50-22.43,50-50V114.036C378.728,86.466,356.298,64.036,328.728,64.036z M201.478,20   h35v73.955h-35V20z M358.728,387.955c0,16.542-13.458,30-30,30h-219.5c-16.542,0-30-13.458-30-30V114.036c0-16.542,13.458-30,30-30   h72.25v9.919h-10c-5.522,0-10,4.478-10,10s4.478,10,10,10h95c5.522,0,10-4.478,10-10s-4.478-10-10-10h-10v-9.919h72.25   c16.542,0,30,13.458,30,30V387.955z"
                                          data-original="#000000" class="active-path" data-old_color="#4266ff"
                                          fill="#4266ff"></path>
                                    <path d="M218.978,51c5.79,0,10.5-4.71,10.5-10.5s-4.71-10.5-10.5-10.5s-10.5,4.71-10.5,10.5S213.188,51,218.978,51z"
                                          data-original="#000000" class="active-path" data-old_color="#4266ff"
                                          fill="#4266ff"></path>
                                    <path d="M290.978,357.955h-144c-5.522,0-10,4.478-10,10s4.478,10,10,10h144c5.522,0,10-4.478,10-10S296.5,357.955,290.978,357.955z   "
                                          data-original="#000000" class="active-path" data-old_color="#4266ff"
                                          fill="#4266ff"></path>
                                    <path d="M176.978,267.955c0,5.522,4.478,10,10,10h64c5.522,0,10-4.478,10-10s-4.478-10-10-10h-64   C181.455,257.955,176.978,262.433,176.978,267.955z"
                                          data-original="#000000" class="active-path" data-old_color="#4266ff"
                                          fill="#4266ff"></path>
                                    <path d="M248.978,217.955c0-16.542-13.458-30-30-30s-30,13.458-30,30s13.458,30,30,30S248.978,234.497,248.978,217.955z    M208.978,217.955c0-5.514,4.486-10,10-10s10,4.486,10,10s-4.486,10-10,10S208.978,223.469,208.978,217.955z"
                                          data-original="#000000" class="active-path" data-old_color="#4266ff"
                                          fill="#4266ff"></path>
                                    <path d="M290.978,153.955h-144c-5.522,0-10,4.478-10,10v144c0,5.522,4.478,10,10,10h144c5.522,0,10-4.478,10-10v-31.892   c0-5.522-4.478-10-10-10s-10,4.478-10,10v21.892h-124v-124h124v68.001c0,5.522,4.478,10,10,10s10-4.478,10-10v-78.001   C300.978,158.433,296.5,153.955,290.978,153.955z"
                                          data-original="#000000" class="active-path" data-old_color="#4266ff"
                                          fill="#4266ff"></path>
                                </g>
                            </g> </svg>
                    </div>
                    <div class="col-md-12 text-center pb-3 card border-top-0 border-left-0 border-right-0 rounded-0">
                        <h3 class="mx-auto mt-2 text-muted"
                            style="font-family: 'Open Sans', sans-serif; letter-spacing: -1px">{!! trans('pages.title.manager.edit') !!}</h3>
                    </div>
                </div>
                <form id="business-manager-form" autocomplete="off">
                    <div class="row">
                        <div class="col-md-12  pt-1">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label>{!! trans('fields.label.first_name') !!}</label>
                                    <input type="text" name="first_name" class="form-control" placeholder="{!! trans('fields.placeholder.first_name') !!}"  autocomplete="off">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label>{!! trans('fields.label.last_name') !!}</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="{!! trans('fields.placeholder.last_name') !!}"  autocomplete="off">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12  pt-1 pb-3 card border-right-0 border-left-0 border-top-0 rounded-0">
                            <label>{!! trans('fields.label.email') !!}</label>
                            <input type="email" name="email" class="form-control" placeholder="{!! trans('fields.placeholder.email') !!}"  autocomplete="off">
                        </div>
                        <div class="col-md-12  pt-1 pb-3 hide" id="user-invite-accept">
                            <div class="alert alert-warning text-center" role="alert">
                                {!! trans('pages.text.manager.warning_perm') !!}
                            </div>
                        </div>
                        <div class="col-md-12  pt-1 pb-3 hide" id="user-role-message">
                            <div class="alert alert-warning text-center" role="alert">
                                {!! trans('pages.text.manager.warning_user') !!}
                            </div>
                        </div>

                        <div class="col-md-12 pt-4" id="manager-role-permissions">
                            <div class="row">
                                <div class="col-md-8 mx-auto text-center">

                                <small class="form-text text-muted mb-2">{!! trans('fields.label.choose_permissions') !!}</small>
                                    @foreach(\App\Business\Permit::where('type', \App\Business\Permit::MANAGER_TYPE)->get() as $permit)
                                        @if($permit->slug != "departments")
                                            <!-- one item begin -->
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-8 text-left">{{ $permit->localized_title }}</div>
                                                    <div class="col-md-3 offset-md-1">
                                                        <label class="switch mt-1">
                                                            <input type="checkbox" name="permits[]" value="{{ $permit->id }}" class="manager__permit-item">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @if (is_admin() || is_permit_administrator(['locations']))
                        <div class="col-md-10 pb-0 card mx-auto mt-5 px-0" style="box-shadow: 0 5px 23px rgba(0,0,0,0.2);" id="data-table-assigned-locations">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default assign-panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title my-0">
                                            <a data-toggle="collapse" href="#data-table-assigned-locations-collapse" data-parent="#accordion"
                                               class="h5 modal-title text-center py-3 card border-top-0 border-left-0 border-right-0 rounded-0 addto main-panel"
                                               style="text-decoration: none; color: #7b7b7b; font-size: 15px;font-weight: 400;" data-type-panel="location">
                                                <p class="text-center mb-0"><img
                                                            src="{{ asset('img/sidebar/locations.png') }}" alt=""/></p>
                                                {!! trans('modals.title.add_locations_manager') !!}</a>
                                        </h4>
                                    </div>
                                    <div id="data-table-assigned-locations-collapse" class="panel-collapse collapse pb-4">
                                        <div class="col-md-12 mx-auto" style="overflow-y: auto; height: auto;">
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
                        @endif

                        <div class="col-md-3 mx-auto px-0 mt-4">
                            <button class="btn btn-primary btn-block" type="button" id="business-manager-create" role="button">{!! trans('main.buttons.update_manager') !!}</button>
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
{{--            <script src="{{ asset('/js/app/business-items.js?v='.time()) }}"></script>--}}

            <script src="{{ asset('/js/app/business-functions.js?v='.time()) }}"></script>

            <script type="text/javascript">

                jQuery(document).ready(function ($) {
                    let $BusinessFunc = new BusinessFunc();
                    // $BusinessFunc.location_table_id = $(document).find("#location-table");
                    $BusinessFunc.business_table_id = $(document).find("#business-table");
                    $BusinessFunc.form = $(document).find("#business-manager-form");
                    $BusinessFunc.form_type = "manager-edit";
                    $BusinessFunc.manager_role = "manager";
                    $BusinessFunc.button_create = $(document).find("#business-manager-create");
                    $BusinessFunc.redirect_url = '{!! url('/business/manage/manager') !!}';
                    $BusinessFunc.init();
                });
            </script>
@endsection
