@extends('layouts.main_user')
@section('content')
    <!-- JUST FOR TEST -->
    <style type="text/css">
        .btn-outline-primary:not([disabled]):not(.disabled).active, .btn-outline-primary:not([disabled]):not(.disabled).active svg path, .btn-outline-primary:not([disabled]):not(.disabled):active, .show>.btn-outline-primary.dropdown-toggle{
            background: #f7f9fb;
            color: #4E5C6E;
            border: 1px solid #9BA6B2;
            fill:#4E5C6E!important;
        }
    </style>
    <!-- JUST FOR TEST -->
    <div class="container-fluid" id="loaded-data" style="display: none; margin-top: 55px;">


        <div class="row">

            <div id="slide-out" class="col-3- pl-0- sidebar_adaptive">
                @include('components.sidebar.sidebar_user')
            </div>


            <div class="flex-1 col-xl-8 col-12 mx-auto text-center  content-main">
                <!-- DONE BUTTON ON TOP -->
                <div class="bg-white topbar_save_rb">
                    <div class="text-right w-100 p-3">
                        <button type="button" class="btn btn-primary" id="resume-builder-step-save-too">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 448.8 448.8" style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px; fill:#fff;" xml:space="preserve"><g><g id="check"><polygon points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"></polygon></g></g></svg>
                            {!! trans('main.buttons.save_continue') !!}
                        </button>
                    </div>
                </div>
                <!-- /DONE BUTTON ON TOP -->
                <div class="row">

                    <div class="col-12 bg-white rounded py-3 px-0- mb-4">
                        <div class="row">
                            <div class="col-12 mx-auto text-left">
                                <p class="mb-2">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 414.339 414.339" style="enable-background:new 0 0 414.339 414.339; vertical-align: middle; margin-top: -3px; opacity: 0.2;" xml:space="preserve" width="20px" height="20px" class="mr-2">
                                        <g>
                                            <path d="M408.265,162.615L230.506,58.601c-3.795-2.222-8.485-2.241-12.304-0.057c-3.815,2.187-6.17,6.246-6.174,10.644   l-0.036,46.966c-0.213,0.052-0.38,0.094-0.495,0.126c-4.442,1.239-9.163,2.603-14.854,4.294   c-18.457,5.483-37.417,12.593-59.668,22.374c-19.309,8.487-38.201,19.442-56.15,32.559c-12.826,9.373-24.894,20.182-35.867,32.126   C15.1,240.129-1.259,283.28,0.076,326.023c0.234,7.488,1.076,14.674,1.869,20.716c0.788,6.007,5.84,10.541,11.898,10.677   c0.093,0.002,0.186,0.003,0.277,0.003c5.94,0,11.048-4.263,12.086-10.139c3.304-18.678,8.574-34.022,16.111-46.91   c9.42-16.104,22.223-29.625,37.021-39.102c12.718-8.146,26.153-14.396,41.075-19.113c17.405-5.503,36.597-8.952,58.671-10.545   c8.907-0.644,18.502-0.967,30.2-1.021c0.354,0,1.112,0.007,2.098,0.02l0.032,44.29c0.003,4.372,2.332,8.413,6.113,10.607   c3.782,2.196,8.446,2.214,12.245,0.049l178.37-101.678c3.811-2.172,6.172-6.21,6.196-10.597   C414.366,168.896,412.05,164.831,408.265,162.615z"/>
                                        </g>
                                    </svg>
                                </span>
                                    {!! trans('resume_builder.link_box.title') !!}
                                </p>
                            </div>
                            <div class="col-12 mx-auto d-flex flex-column flex-lg-row justify-content-between">
                                <div class="btn-group col-12 col-lg-7 px-0" role="group" aria-label="Basic example">
                                    <button class="btn btn-outline-success mr-0 d-flex align-items-center" type="button" data-clipboard-action="copy" data-clipboard-target="#link-user-profile" id="clipboard-button">
                                        <svg version="1.1" id="Capa_1" class="mr-2" xmlns="http://www.w3.org/2000/svg" width="15px" height="15px" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 488.3 488.3" style="enable-background:new 0 0 488.3 488.3;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M314.25,85.4h-227c-21.3,0-38.6,17.3-38.6,38.6v325.7c0,21.3,17.3,38.6,38.6,38.6h227c21.3,0,38.6-17.3,38.6-38.6V124
                                                    C352.75,102.7,335.45,85.4,314.25,85.4z M325.75,449.6c0,6.4-5.2,11.6-11.6,11.6h-227c-6.4,0-11.6-5.2-11.6-11.6V124
                                                    c0-6.4,5.2-11.6,11.6-11.6h227c6.4,0,11.6,5.2,11.6,11.6V449.6z" data-original="#000000" class="active-path" data-old_color="#28a745" fill="#"></path>
                                                <path d="M401.05,0h-227c-21.3,0-38.6,17.3-38.6,38.6c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5c0-6.4,5.2-11.6,11.6-11.6h227
                                                    c6.4,0,11.6,5.2,11.6,11.6v325.7c0,6.4-5.2,11.6-11.6,11.6c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5c21.3,0,38.6-17.3,38.6-38.6
                                                    V38.6C439.65,17.3,422.35,0,401.05,0z" data-original="#000000" class="active-path" data-old_color="#28a745" fill="#"></path>
                                            </g>
                                        </g>
                                    </svg>
                                        {!! trans('main.buttons.copy_btn') !!}
                                    </button>
                                    <input type="text" id="link-user-profile" data-url="{!! request()->getSchemeAndHttpHost() !!}/u/" class="form-control rounded-0 bg-light border-left-0 border-right-0" readonly="" placeholder="jobmap.co/u/mark1234" aria-label="Search for...">

                                    <a class="btn btn-outline-primary mr-0 d-flex align-items-center" role="button" data-toggle="modal" data-target="#emailmodal">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512.625 512.625" style="enable-background:new 0 0 478.703 478.703;" xml:space="preserve" width="15px" height="15px" class="mr-2">
                                        <g>
                                            <g>
                                                <path d="M506.354,326.375C481.54,305.273,436.651,267.576,405.333,244V106.979c0-23.531-19.146-42.667-42.667-42.667h-320    C19.146,64.313,0,83.448,0,106.979v213.333c0,23.531,19.146,42.667,42.667,42.667h214.625    c3.565,12.277,14.788,21.333,28.208,21.333h77.167v40.781c0,12.802,10.417,23.219,23.208,23.219c6.625,0,11.583-3.115,14.75-5.458    c31.354-23.177,79.688-63.792,105.688-85.917c2.875-2.427,6.313-7.052,6.313-15.292    C512.625,333.406,509.188,328.781,506.354,326.375z M42.667,85.646h320c0.443,0,0.814,0.225,1.25,0.253L211.688,210.917    c-5.583,3.625-13.417,2.938-17.083,0.688L41.424,85.897C41.858,85.871,42.227,85.646,42.667,85.646z M256,328.469v13.177H42.667    c-11.771,0-21.333-9.573-21.333-21.333V106.979c0-3.021,0.668-5.875,1.805-8.482l158.883,130.294    c6.208,4.052,13.354,6.188,20.646,6.188c7.25,0,14.396-2.125,21.646-6.885L382.194,98.496c1.138,2.608,1.806,5.461,1.806,8.483    v128.38c-11.872,1.007-21.333,10.702-21.333,22.839v40.781H285.5C269.229,298.979,256,312.208,256,328.469z M491.292,341.646    v0.073c-26.104,22.188-73,61.542-103.333,83.99c-1.521,1.115-2.063,1.26-2.083,1.271c-1.042,0-1.875-0.844-1.875-1.885v-51.448    c0-5.896-4.771-10.667-10.667-10.667H285.5c-4.5,0-8.167-3.656-8.167-8.156v-26.354c0-4.5,3.667-8.156,8.167-8.156h87.833    c5.896,0,10.667-4.771,10.667-10.667v-51.448c0-1.042,0.833-1.885,1.813-1.885c0.083,0.01,0.625,0.156,2.146,1.271    c30.333,22.438,77.208,61.771,103.333,83.99C491.292,341.594,491.292,341.625,491.292,341.646z"></path>
                                            </g>
                                        </g>
                                    </svg>
                                        {!! trans('main.buttons.email_btn') !!}
                                    </a>
                                </div>
                                <div class="pt-1">
                                    <a {{--id="user-resume-attach_file-click"--}} class="user-resume-attach_file-click btn btn-primary btn-sm" role="button" href="javascript:;">{!! trans('lets_get_started.user.upload_resume') !!}</a>
                                    <a href="{!! url('/user/print-builder') !!}" role="button" class="btn btn-warning btn-sm mt-1 mb-2 mt-lg-0 mb-lg-0 width-100-lg" data-toggle="tooltip" title="{!! trans('main.coming_soon') !!}">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 24 24" height="20px" id="Layer_1" version="1.1" viewBox="0 0 24 24" width="20px" xml:space="preserve" style="vertical-align: middle; margin-top: -3px; opacity: 0.5;">
                                    <g><path d="M23,3h-4V1c0-0.6-0.4-1-1-1H6C5.4,0,5,0.4,5,1v2H1C0.4,3,0,3.4,0,4v13c0,0.6,0.4,1,1,1h4v5c0,0.6,0.4,1,1,1h12   c0.6,0,1-0.4,1-1v-5h4c0.6,0,1-0.4,1-1V4C24,3.4,23.6,3,23,3z M6,1h12v2H6V1z M18,23H6V12h12V23z M22,16h-3v-4h1v-2H4v2h1v4H2V5h20   V16z"></path><circle cx="4" cy="7" r="1"></circle><circle cx="7" cy="7" r="1"></circle><rect height="1" width="8" x="8" y="14"></rect><rect height="1" width="8" x="8" y="17"></rect><rect height="1" width="8" x="8" y="20"></rect></g>
                                </svg>
                                        <span style="opacity: 0.5;">{!! trans('main.buttons.print_btn') !!}</span>
                                    </a>
                                    <a href="{!! url('/user/resume/view') !!}" role="button" class="btn btn-primary btn-sm mt-1 mt-lg-0 width-100-lg resume-builder_link-preview">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="enable-background:new 0 0 50 50;fill:#fff; vertical-align: middle; margin-top: -3px;" version="1.1" viewBox="0 0 50 50" xml:space="preserve" width="20px" height="20px">
                                    <g id="Layer_1">
                                        <path d="M25,39c13.036,0,23.352-12.833,23.784-13.379L49.275,25l-0.491-0.621C48.352,23.833,38.036,11,25,11   S1.648,23.833,1.216,24.379L0.725,25l0.491,0.621C1.648,26.167,11.964,39,25,39z M25,13c10.494,0,19.47,9.46,21.69,12   C44.473,27.542,35.509,37,25,37C14.506,37,5.53,27.54,3.31,25C5.527,22.458,14.491,13,25,13z"></path>
                                        <path d="M25,34c4.963,0,9-4.038,9-9s-4.037-9-9-9s-9,4.038-9,9S20.037,34,25,34z M25,18c3.859,0,7,3.14,7,7s-3.141,7-7,7   s-7-3.14-7-7S21.141,18,25,18z"></path>
                                    </g>
                                </svg>
                                        {!! trans('main.buttons.preview_btn') !!}
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 px-0- rounded">
                        <form id="resume-builder-form" autocomplete="off">
                            <div class="card border-0">

                                <div class="card-body p-0">
                                    <div class="row no-gutters justify-content-center">
                                        @include('components.resume_builder.tabs')
                                        <div class="col-12 col-lg-9 border border-left-0 border-right-0 border-bottom-0 mt-0">
                                            <div class="row justify-content-center">
                                                @include('components.resume_builder.create_1')
                                                @include('components.resume_builder.create_2')
                                                @include('components.resume_builder.create_3')
                                                @include('components.resume_builder.create_4')
                                                @include('components.resume_builder.create_5')
                                                @include('components.resume_builder.create_6')
                                                @include('components.resume_builder.create_7')
                                                @include('components.resume_builder.create_8')
                                                @include('components.resume_builder.create_9')
                                                @include('components.resume_builder.create_10')
                                            </div>
                                        </div>
                                    </div>
                                    @include('components.resume_builder.footer')
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>
    <script src="{{ asset('/js/jack.js') }}"></script>
    <script src="{{ asset('/js/cropper.min.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/main-cropper.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/resume-builder-info.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/resume-builder.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/jobmap/bob.js?v='.time()) }}"></script>
    <script>
        $(window).bind('beforeunload', function () {
            if (!user.clickSaveStep) {
                //$('#confirmContinueModal').modal('show');
                return "Are you sure that you want to continue if You have not saved your changes?";
            }
        });
    </script>
@stop
