@extends('layouts.main_business')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mt-3 mb-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-9 text-center">
                        <div class="mt-5 mb-5 py-5 bg-white rounded">
                            <div class="row mb-3">
                                <div class="col-lg-4 mx-auto text-center">
                                    <img id="user-img" class="img-thumbnail mb-3 border-0" data-src="holder.js/100px180/?text=Image cap" alt="Image cap [100%x180]" style="width: 100px; height: 100px;"
                                         src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_15fa7e2b3d5%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_15fa7e2b3d5%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.4296875%22%20y%3D%22104.5%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                                    <p class="lead"><strong id="user-name"></strong></p>
                                </div>
                            </div>
                            <div class="col-lg-12 mx-auto mb-3">
                                <div class="row mb-1 center-text">
                                    <p class="mx-auto" id="user-update"></p>
                                </div>
                                <div class="row">
                                    <p id="user-title" class="lead text-center mx-auto"></p>
                                </div>
                                <div class="row mb-1 justify-content-md-center">
                                    <button id="user-resume-update" type="button" class="btn btn-success ml-1 mr-1 candidate-resume-update" data-id>
                                        {{ trans('pages.scan-business.request_a_real_time_update') }}</button>
                                    <a href="" id="user-profile" type="button" class="btn btn-primary ml-1 mr-1">
                                        {{ trans('pages.scan-business.view_candidate_profile') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--ask update MODAL!!!!!!!!!!!!!!! -->
            <div class="modal fade" id="pipeline" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0 pt-0">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                     version="1.1" id="Capa_1" x="0px" y="0px" width="20px" height="18px"
                                     viewBox="0 0 487.23 487.23"
                                     style="enable-background:new 0 0 487.23 487.23; vertical-align: middle; margin-bottom: 3px;"
                                     xml:space="preserve" data-toggle="tooltip" data-placement="top"
                                     title="Ask update" fill="#4E5C6E">
                                            <g>
                                                <g>
                                                    <path d="M55.323,203.641c15.664,0,29.813-9.405,35.872-23.854c25.017-59.604,83.842-101.61,152.42-101.61    c37.797,0,72.449,12.955,100.23,34.442l-21.775,3.371c-7.438,1.153-13.224,7.054-14.232,14.512    c-1.01,7.454,3.008,14.686,9.867,17.768l119.746,53.872c5.249,2.357,11.33,1.904,16.168-1.205    c4.83-3.114,7.764-8.458,7.796-14.208l0.621-131.943c0.042-7.506-4.851-14.144-12.024-16.332    c-7.185-2.188-14.947,0.589-19.104,6.837l-16.505,24.805C370.398,26.778,310.1,0,243.615,0C142.806,0,56.133,61.562,19.167,149.06    c-5.134,12.128-3.84,26.015,3.429,36.987C29.865,197.023,42.152,203.641,55.323,203.641z"/>
                                                    <path d="M464.635,301.184c-7.27-10.977-19.558-17.594-32.728-17.594c-15.664,0-29.813,9.405-35.872,23.854    c-25.018,59.604-83.843,101.61-152.42,101.61c-37.798,0-72.45-12.955-100.232-34.442l21.776-3.369    c7.437-1.153,13.223-7.055,14.233-14.514c1.009-7.453-3.008-14.686-9.867-17.768L49.779,285.089    c-5.25-2.356-11.33-1.905-16.169,1.205c-4.829,3.114-7.764,8.458-7.795,14.207l-0.622,131.943    c-0.042,7.506,4.85,14.144,12.024,16.332c7.185,2.188,14.948-0.59,19.104-6.839l16.505-24.805    c44.004,43.32,104.303,70.098,170.788,70.098c100.811,0,187.481-61.561,224.446-149.059    C473.197,326.043,471.903,312.157,464.635,301.184z"/>
                                                </g>
                                            </g>
                                        </svg>
                                <span class="pt-2">{!! trans('modals.title.ask_update') !!}</span>
                            </h5>
                            <button type="button" class="close pt-0 mt-0" data-dismiss="modal"
                                    aria-label="{!! trans('main.buttons.close') !!}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body px-0 pb-3">
                            <div class="px-3 hide" id="candidate-resume-send-button">
                                <p class="pt-2 text-center" style="font-size: 16px;">{!! trans('modals.text.ask_update') !!}</p>
                                <p class="text-center">
                                    <button type="button" name="req_update"
                                            class="btn btn-outline-success py-3 px-5"
                                            id="candidate-send-request" data-id="">
                                <p class="text-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                         x="0px" y="0px" width="25px" height="25px" viewBox="0 0 487.23 487.23"
                                         style="enable-background:new 0 0 487.23 487.23; vertical-align: middle; margin-top:-3px;"
                                         xml:space="preserve" fill="#27cfc3">
                                    <g>
                                        <g>
                                            <path d="M55.323,203.641c15.664,0,29.813-9.405,35.872-23.854c25.017-59.604,83.842-101.61,152.42-101.61    c37.797,0,72.449,12.955,100.23,34.442l-21.775,3.371c-7.438,1.153-13.224,7.054-14.232,14.512    c-1.01,7.454,3.008,14.686,9.867,17.768l119.746,53.872c5.249,2.357,11.33,1.904,16.168-1.205    c4.83-3.114,7.764-8.458,7.796-14.208l0.621-131.943c0.042-7.506-4.851-14.144-12.024-16.332    c-7.185-2.188-14.947,0.589-19.104,6.837l-16.505,24.805C370.398,26.778,310.1,0,243.615,0C142.806,0,56.133,61.562,19.167,149.06    c-5.134,12.128-3.84,26.015,3.429,36.987C29.865,197.023,42.152,203.641,55.323,203.641z"/>
                                            <path d="M464.635,301.184c-7.27-10.977-19.558-17.594-32.728-17.594c-15.664,0-29.813,9.405-35.872,23.854    c-25.018,59.604-83.843,101.61-152.42,101.61c-37.798,0-72.45-12.955-100.232-34.442l21.776-3.369    c7.437-1.153,13.223-7.055,14.233-14.514c1.009-7.453-3.008-14.686-9.867-17.768L49.779,285.089    c-5.25-2.356-11.33-1.905-16.169,1.205c-4.829,3.114-7.764,8.458-7.795,14.207l-0.622,131.943    c-0.042,7.506,4.85,14.144,12.024,16.332c7.185,2.188,14.948-0.59,19.104-6.839l16.505-24.805    c44.004,43.32,104.303,70.098,170.788,70.098c100.811,0,187.481-61.561,224.446-149.059    C473.197,326.043,471.903,312.157,464.635,301.184z"/>
                                        </g>
                                    </g>
                                 </svg>
                                </p>
                                {!! trans('main.buttons.send_request') !!}
                                </button>
                                </p>
                            </div>

                            <hr>

                            <div id="candidate-resume-modal-body">
                            </div>


                        </div>

                        <div class="modal-footer justify-content-center bg-light">
                            <div class="col-md-4 mx-auto">
                                <button class="btn btn-success btn-block" data-dismiss="modal">{!! trans('main.buttons.ok') !!}</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- ask update MODAL END!!!!!!!!!!!!!!! -->

        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('/js/app/business-applicants.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/scan_business_new.js?v='.time()) }}"></script>
@stop