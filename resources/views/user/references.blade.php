@extends('layouts.main_user')
{{--user/resume/create?tab=references--}}
@section('content')
    <div>
        <div class="mt-3 mb-3 container-fluid">
            <div class="row">
                <div id="slide-out" class="col-3- pl-0- sidebar_adaptive">
                    @include('components.sidebar.sidebar_user')
                </div>
                <div class="flex-1 col-12 col-lg-8 mx-auto text-center my-3 content-main">
                    <div class="row">
                        <div class="col-12 px-0">
                            <form autocomplete="off">
                                <div class="col-12 rounded pb-3 pt-5 bg-white">
                                    <div class="row justify-content-center">
                                        <div class="pt-1">
                                            <a href="/user/resume/create?tab=references" role="button" class="btn btn-primary btn-sm width-100-lg" id="references__goto-resume-builder" style="display: none">
                                                {!! trans('resume_builder.reference.back_to_resume_builder') !!}
                                            </a>
                                        </div>
                                        <div class="col-12 col-lg-11">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-4">
                                                        <button type="button"
                                                                class="btn btn-lg btn-outline-primary w-100 p-4"
                                                                data-toggle="modal" data-target="#formRefEditModal"
                                                                id="reference-new">
                                                            <span class="d-block h3 mb-0">
																	<svg id="Layer_1" width="45px" height="45px"
                                                                         style="enable-background:new 0 0 512 512;"
                                                                         version="1.1" viewBox="0 0 512 512"
                                                                         xml:space="preserve"
                                                                         xmlns="http://www.w3.org/2000/svg"><g><g><g><path
                                                                                            d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"/></g></g><g><polygon
                                                                                        points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  "/></g></g></svg>
																</span> {!! trans('resume_builder.reference.add_btn') !!}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- INCOMING START -->
                                                <div class="col-xl-4 col-lg-12 col-md-12">
                                                    <div class="col-12">
                                                        <p class="my-3 h5 mb-3 text light-grey">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 version="1.1" id="Capa_1" x="0px" y="0px" width="18px"
                                                                 height="18px" viewBox="0 0 512 512"
                                                                 style="enable-background:new 0 0 512 512; vertical-align: middle; margin-top: -3px; fill:#868ea6;"
                                                                 xml:space="preserve" class="mr-1">
                                                                <g>
                                                                    <path d="M288,96H128V64h160V96z M384,256H128v32h256V256z M352,128H128v32h224V128z M384,192H128v32h256V192z M512,320v192H0V320   l64-128V0h288l96,96v96L512,320z M448,320h28.219L448,263.562V320z M96,320h31.984L192,416h128l64-96h32v-96V109.25L338.75,32H96   v192V320z M35.781,320H64v-56.438L35.781,320z M480,352h-78.875l-64,96h-162.25l-64.016-96H32v128h448V352z"/>
                                                                </g>
                                                            </svg>
                                                            {!! trans('resume_builder.reference.incoming') !!}
                                                            <span class="notification_ref ml-3 countReferences"
                                                                  style="display: none"></span>
                                                        </p>
                                                    </div>
                                                    <div class="col-12 mb-5" id="block-incoming">

                                                        <div class="border rounded p-2 text-center" id="no-incoming">
                                                            <p class="mb-0"
                                                               style="opacity: 0.8;">{!! trans('resume_builder.reference.incoming_no_items') !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- INCOMING END -->
                                                <!-- CONFIRMED START -->
                                                <div class="col-xl-4 col-lg-12 col-md-12">
                                                    <div class="col-12">
                                                        <p class="my-3 h5 mb-3 text light-grey">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 version="1.1" id="Capa_1" x="0px" y="0px" width="18px"
                                                                 height="18px" viewBox="0 0 448.8 448.8"
                                                                 style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px; fill:#868ea6;"
                                                                 xml:space="preserve" class="mr-1">
                                                                <g>
                                                                    <g id="check">
                                                                        <polygon
                                                                                points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"></polygon>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                            {!! trans('resume_builder.reference.confirmed') !!}
                                                        </p>
                                                    </div>
                                                    <div class="col-12" id="block-confirmed">

                                                        <div class="border rounded p-2 text-center" id="no-confirmed">
                                                            <p class="mb-0"
                                                               style="opacity: 0.8;">{!! trans('resume_builder.reference.confirmed_no_items') !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- CONFIRMED END -->
                                                <!-- REQUESTED START -->
                                                <div class="col-xl-4 col-lg-12 col-md-12">
                                                    <div class="col-12">
                                                        <p class="my-3 h5 mb-3 text light-grey">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 version="1.1" id="Capa_1" x="0px" y="0px"
                                                                 viewBox="0 0 487.958 487.958" width="18px"
                                                                 height="18px"
                                                                 style="enable-background:new 0 0 512 512; vertical-align: middle; margin-top: -3px; fill:#868ea6;"
                                                                 xml:space="preserve" class="mr-1">
                                                                <g>
                                                                    <path d="M483.058,215.613l-215.5-177.6c-4-3.3-9.6-4-14.3-1.8c-4.7,2.2-7.7,7-7.7,12.2v93.6c-104.6,3.8-176.5,40.7-213.9,109.8   c-32.2,59.6-31.9,130.2-31.6,176.9c0,3.8,0,7.4,0,10.8c0,6.1,4.1,11.5,10.1,13.1c1.1,0.3,2.3,0.4,3.4,0.4c4.8,0,9.3-2.5,11.7-6.8   c73-128.7,133.1-134.9,220.2-135.2v93.3c0,5.2,3,10,7.8,12.2s10.3,1.5,14.4-1.8l215.4-178.2c3.1-2.6,4.9-6.4,4.9-10.4   S486.158,218.213,483.058,215.613z M272.558,375.613v-78.1c0-3.6-1.4-7-4-9.5c-2.5-2.5-6-4-9.5-4c-54.4,0-96.1,1.5-136.6,20.4   c-35,16.3-65.3,44-95.2,87.5c1.2-39.7,6.4-87.1,28.1-127.2c34.4-63.6,101-95.1,203.7-96c7.4-0.1,13.4-6.1,13.4-13.5v-78.2   l180.7,149.1L272.558,375.613z"/>
                                                                </g>
                                                            </svg>
                                                            {!! trans('resume_builder.reference.requested') !!}
                                                        </p>
                                                    </div>
                                                    <div class="col-12 mb-5" id="block-requested">

                                                        <div class="border rounded p-2 text-center" id="no-requested">
                                                            <p class="mb-0"
                                                               style="opacity: 0.8;">{!! trans('resume_builder.reference.requested_no_items') !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- REQUESTED END -->
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
    </div>

    <div class="modal fade" id="formRefEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{!! trans('modals.title.reference') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label>{!! trans('fields.label.email_referer') !!}</label>
                                            <input type="text" name="email" class="form-control bg-light"
                                                   placeholder="{!! trans('fields.placeholder.email_referer') !!}"  autocomplete="off">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>{!! trans('fields.placeholder.phone_number') !!}</label>
                                            <input type="text" name="phone" class="form-control bg-light"
                                                   placeholder="{!! trans('fields.placeholder.phone_referer') !!}"  autocomplete="off">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>{!! trans('fields.label.full_name_referer') !!}</label>
                                            <input type="text" name="full_name" class="form-control bg-light"
                                                   placeholder="{!! trans('fields.placeholder.full_name_referer') !!}"  autocomplete="off">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label>{!! trans('fields.label.company_referer') !!}</label>
                                            <input type="text" name="company" class="form-control bg-light"
                                                   placeholder="{!! trans('fields.placeholder.company_referer') !!}"  autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-primary"
                                {{--data-type="requested"--}} data-id="0" id="reference-save">
                            {!! trans('main.buttons.send') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="requestedRefEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{!! trans('modals.title.modify_referrer') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3 d-flex align-items-start justify-content-between">
                                            <div>
                                                <p class="mb-0 font-weight-bold">{!! trans('fields.label.sent_to') !!}</p>
                                                <p class="mb-0" id="email-resend"></p>
                                            </div>
                                            <div class="bg-white d-inline-block">
                                                <button type="button" class="btn btn-outline-primary"
                                                        id="reference-resend">
                                                    {!! trans('main.buttons.send_again') !!}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label>{!! trans('fields.label.new_email_referrer') !!}</label>
                                            <input type="text" name="email" class="form-control bg-light"
                                                   placeholder="{!! trans('fields.placeholder.email_referer') !!}"  autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-primary" id="reference-new-resend">
                            {!! trans('main.buttons.resend') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Confirm modal for delete-->
    <div class="modal fade bd-example-modal-lg" id="deleteEditModalReference" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.reference') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                {!! trans('main.buttons.remove') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal"
                                aria-label="{!! trans('main.buttons.cancel') !!}">
                            {!! trans('main.buttons.cancel') !!}
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="resume-reference-confirm-delete">
                            {!! trans('main.buttons.remove') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Message already sent modal-->
    <div class="modal fade bd-example-modal-lg" id="alredySendMessageModalReference" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.reference') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                {!! trans('modals.text.you_have_already_sent_a_request') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('/js/app/reference.js?v='.time()) }}"></script>
@stop