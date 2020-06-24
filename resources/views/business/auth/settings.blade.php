@extends('layouts.main_business')

@section('content')


    <div class="container-fluid">
        <div class="row">
            <div id="slide-out" class="col-3- pl-0- sidebar_adaptive">
                @include('components.sidebar.sidebar_business')
            </div>
            <div class="col-12 col-lg-8 mx-auto mt-5 content-main">

                <div class="col-12 bg-white rounded mt-4 px-0">

                    <div class="text-center pt-4 pb-3 px-3" style="border-bottom: 1px solid rgba(78,92,110,0.2);">
                        <p class="h2 text-secondary text-left mt-2"
                           style="font-family: 'Open Sans', sans-serif; letter-spacing: -1px">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 478.703 478.703"
                                 style="enable-background:new 0 0 512 512; fill:#4266ff; vertical-align: middle; margin-top: -4px;"
                                 xml:space="preserve" width="50px" height="50px"><g>
                                    <g>
                                        <g>
                                            <path d="M454.2,189.101l-33.6-5.7c-3.5-11.3-8-22.2-13.5-32.6l19.8-27.7c8.4-11.8,7.1-27.9-3.2-38.1l-29.8-29.8    c-5.6-5.6-13-8.7-20.9-8.7c-6.2,0-12.1,1.9-17.1,5.5l-27.8,19.8c-10.8-5.7-22.1-10.4-33.8-13.9l-5.6-33.2    c-2.4-14.3-14.7-24.7-29.2-24.7h-42.1c-14.5,0-26.8,10.4-29.2,24.7l-5.8,34c-11.2,3.5-22.1,8.1-32.5,13.7l-27.5-19.8    c-5-3.6-11-5.5-17.2-5.5c-7.9,0-15.4,3.1-20.9,8.7l-29.9,29.8c-10.2,10.2-11.6,26.3-3.2,38.1l20,28.1    c-5.5,10.5-9.9,21.4-13.3,32.7l-33.2,5.6c-14.3,2.4-24.7,14.7-24.7,29.2v42.1c0,14.5,10.4,26.8,24.7,29.2l34,5.8    c3.5,11.2,8.1,22.1,13.7,32.5l-19.7,27.4c-8.4,11.8-7.1,27.9,3.2,38.1l29.8,29.8c5.6,5.6,13,8.7,20.9,8.7c6.2,0,12.1-1.9,17.1-5.5    l28.1-20c10.1,5.3,20.7,9.6,31.6,13l5.6,33.6c2.4,14.3,14.7,24.7,29.2,24.7h42.2c14.5,0,26.8-10.4,29.2-24.7l5.7-33.6    c11.3-3.5,22.2-8,32.6-13.5l27.7,19.8c5,3.6,11,5.5,17.2,5.5l0,0c7.9,0,15.3-3.1,20.9-8.7l29.8-29.8c10.2-10.2,11.6-26.3,3.2-38.1    l-19.8-27.8c5.5-10.5,10.1-21.4,13.5-32.6l33.6-5.6c14.3-2.4,24.7-14.7,24.7-29.2v-42.1    C478.9,203.801,468.5,191.501,454.2,189.101z M451.9,260.401c0,1.3-0.9,2.4-2.2,2.6l-42,7c-5.3,0.9-9.5,4.8-10.8,9.9    c-3.8,14.7-9.6,28.8-17.4,41.9c-2.7,4.6-2.5,10.3,0.6,14.7l24.7,34.8c0.7,1,0.6,2.5-0.3,3.4l-29.8,29.8c-0.7,0.7-1.4,0.8-1.9,0.8    c-0.6,0-1.1-0.2-1.5-0.5l-34.7-24.7c-4.3-3.1-10.1-3.3-14.7-0.6c-13.1,7.8-27.2,13.6-41.9,17.4c-5.2,1.3-9.1,5.6-9.9,10.8l-7.1,42    c-0.2,1.3-1.3,2.2-2.6,2.2h-42.1c-1.3,0-2.4-0.9-2.6-2.2l-7-42c-0.9-5.3-4.8-9.5-9.9-10.8c-14.3-3.7-28.1-9.4-41-16.8    c-2.1-1.2-4.5-1.8-6.8-1.8c-2.7,0-5.5,0.8-7.8,2.5l-35,24.9c-0.5,0.3-1,0.5-1.5,0.5c-0.4,0-1.2-0.1-1.9-0.8l-29.8-29.8    c-0.9-0.9-1-2.3-0.3-3.4l24.6-34.5c3.1-4.4,3.3-10.2,0.6-14.8c-7.8-13-13.8-27.1-17.6-41.8c-1.4-5.1-5.6-9-10.8-9.9l-42.3-7.2    c-1.3-0.2-2.2-1.3-2.2-2.6v-42.1c0-1.3,0.9-2.4,2.2-2.6l41.7-7c5.3-0.9,9.6-4.8,10.9-10c3.7-14.7,9.4-28.9,17.1-42    c2.7-4.6,2.4-10.3-0.7-14.6l-24.9-35c-0.7-1-0.6-2.5,0.3-3.4l29.8-29.8c0.7-0.7,1.4-0.8,1.9-0.8c0.6,0,1.1,0.2,1.5,0.5l34.5,24.6    c4.4,3.1,10.2,3.3,14.8,0.6c13-7.8,27.1-13.8,41.8-17.6c5.1-1.4,9-5.6,9.9-10.8l7.2-42.3c0.2-1.3,1.3-2.2,2.6-2.2h42.1    c1.3,0,2.4,0.9,2.6,2.2l7,41.7c0.9,5.3,4.8,9.6,10,10.9c15.1,3.8,29.5,9.7,42.9,17.6c4.6,2.7,10.3,2.5,14.7-0.6l34.5-24.8    c0.5-0.3,1-0.5,1.5-0.5c0.4,0,1.2,0.1,1.9,0.8l29.8,29.8c0.9,0.9,1,2.3,0.3,3.4l-24.7,34.7c-3.1,4.3-3.3,10.1-0.6,14.7    c7.8,13.1,13.6,27.2,17.4,41.9c1.3,5.2,5.6,9.1,10.8,9.9l42,7.1c1.3,0.2,2.2,1.3,2.2,2.6v42.1H451.9z"></path>
                                            <path d="M239.4,136.001c-57,0-103.3,46.3-103.3,103.3s46.3,103.3,103.3,103.3s103.3-46.3,103.3-103.3S296.4,136.001,239.4,136.001    z M239.4,315.601c-42.1,0-76.3-34.2-76.3-76.3s34.2-76.3,76.3-76.3s76.3,34.2,76.3,76.3S281.5,315.601,239.4,315.601z"></path>
                                        </g>
                                    </g>
                                </g>
                      </svg>
                            {!! trans('main.settings') !!}
                        </p>

                    </div>

                    <div class="row pb-4 mt-3">

                        <div class="col-12 col-xl-6">
                            <div class="col-md-12">
                                <p class="mx-auto mt-2">{!! trans('main.account_info') !!}</p>
                                <div class="text-center mt-2 mb-3">
                                    <div class="btn-group w-100 d-flex flex-column flex-lg-row">
                                        <button class="btn btn-outline-primary col-lg-6 col-12" data-toggle="modal" data-target="#changeEmail" style="white-space: inherit;">{!! trans('main.buttons.change_account_email') !!}</button>
                                        <button class="btn btn-outline-primary col-lg-6 col-12" data-toggle="modal" data-target="#changePass" style="white-space: inherit;">{!! trans('main.buttons.change_account_password') !!}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-5">
                                <p class="mx-auto mt-2">
                                    {!! trans('main.helpers_tooltips') !!}
                                </p>
                                <div class="text-center mb-3">
                                    <div class="btn-group w-100" data-toggle="buttons">
                                        <label class="btn active btn-outline-primary mb-0 w-50 d-flex flex-column justify-content-center align-items-center tooltipOnOff">
                                            <input type="radio" name="tooltip" id="on" value="on"  autocomplete="off">
                                            {!! trans('main.buttons.enable') !!}
                                        </label>
                                        <label class="btn btn-outline-primary mb-0 w-50 d-flex flex-column justify-content-center align-items-center tooltipOnOff">
                                            <input type="radio" name="tooltip" id="off" value="off"  autocomplete="off">
                                            {!! trans('main.buttons.disable') !!}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-6">
                            <div class="col-12">

                                <p class="mx-auto mt-2">
                                    {!! trans('main.language') !!}
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" style="vertical-align: middle; margin-top: -3px; cursor: pointer; opacity: 0.4;">
                                        <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </p>
                                <p class="mb-1">{!! trans('main.choose_language') !!}</p>
                                <select class="form-control form-control-sm mb-1" id="setting-languages-list">
                                    {{--<option>English (Default)</option>
                                    <option>French</option>--}}
                                </select>
                                <!-- {!! trans('main.language') !!}
                                <div class="row" id="setting-languages-list">

                                </div> -->
                            </div>

                            <div class="col-md-12 mt-5">
                                <p class="mx-auto mt-2">
                                    {!! trans('main.setting_email_send') !!}
                                </p>
                                <div class="text-center mb-3">
                                    <div class="btn-group w-100" data-toggle="buttons">
                                        <label class="btn active btn-outline-primary mb-0 w-50 d-flex flex-column justify-content-center align-items-center email-send-OnOff">
                                            <input type="radio" name="email_send" id="on" value="on"  autocomplete="off">
                                            {!! trans('main.buttons.enable') !!}
                                        </label>
                                        <label class="btn btn-outline-primary mb-0 w-50 d-flex flex-column justify-content-center align-items-center email-send-OnOff">
                                            <input type="radio" name="email_send" id="off" value="off"  autocomplete="off">
                                            {!! trans('main.buttons.disable') !!}
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- type password MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="typePassword" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title">Change Email</h5>
                    <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-5">
                    <p>
                        <strong>Please type your password</strong>
                    </p>

                    <p>
                        <input type="password" name="password" placeholder="Type your password" class="form-control">
                    </p>

                    <p>
                        <input type="button" name="change" value="Verify" class="btn btn-primary btn-block"
                               data-toggle="modal" data-target="#changeEmail" data-dismiss="modal">
                    </p>

                </div>

            </div>
        </div>
    </div>
    <!-- type password MODAL END!!!!!!!!!!!!!!! -->

    <!-- change Email MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="changeEmail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title">{!! trans('modals.title.change_cr_email') !!}</h5>
                    <button type="button" class="close text-right" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-5">
                    <p class="change-email-warning" style="display: none">
                        <strong style="color: red">{!! trans('modals.text.change_cr_email') !!}</strong>
                    </p>
                    <p>
                        <strong>{!! trans('fields.label.current_cr_email') !!}</strong>
                    </p>

                    <p>
                        <input type="email" id="currentEmail" value="" class="form-control" readonly>
                    </p>

                    <p>
                        <strong>{!! trans('fields.label.new_email') !!}</strong>
                    </p>

                    <p>
                        <input type="email" name="email" placeholder="{!! trans('fields.placeholder.new_email') !!}" class="form-control">
                    </p>

                    <p>
                        <input type="button" id="btnChangeEmail" value="{!! trans('main.buttons.change') !!}" class="btn btn-primary btn-block">
                    </p>

                </div>

            </div>
        </div>
    </div>
    <!-- change Email MODAL END!!!!!!!!!!!!!!! -->

    <!-- change Email Confirmation MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="changeEmailConfirmation" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title">{!! trans('modals.title.change_cr_email') !!}</h5>
                    <button type="button" class="close text-right" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-5">
                    <p>
                        We sent you an email. Please, click on the link to confirm the new email.
                    </p>
                    <button type="button" class="btn btn-primary btn-block" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">OK</button>
                </div>

            </div>
        </div>
    </div>
    <!-- change Email Confirmation MODAL END!!!!!!!!!!!!!!! -->

    <!-- change password MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title">{!! trans('modals.title.change_cr_password') !!}</h5>
                    <button type="button" class="close text-right" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-5">
                    <p>
                        <strong>{!! trans('fields.label.current_cr_password') !!}</strong>
                    </p>

                    <p>
                        <input type="password" name="password" placeholder="{!! trans('fields.placeholder.enter_password') !!}" class="form-control">
                    </p>

                    <p>
                        <input type="button" id="btnChangePass" value="{!! trans('main.buttons.change') !!}" class="btn btn-primary btn-block">
                    </p>

                </div>

            </div>
        </div>
    </div>
    <!-- change password MODAL END!!!!!!!!!!!!!!! -->

    <!-- change password Confirmation MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="changePasswordConfirmation" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title">{!! trans('modals.title.change_cr_password') !!}</h5>
                    <button type="button" class="close text-right" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-5">
                    <p>
                        We sent you an email. Please, click on the link to confirm the new password.
                    </p>
                    <button type="button" class="btn btn-primary btn-block" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">OK</button>
                </div>

            </div>
        </div>
    </div>
    <!-- change password Confirmation MODAL END!!!!!!!!!!!!!!! -->
@endsection
