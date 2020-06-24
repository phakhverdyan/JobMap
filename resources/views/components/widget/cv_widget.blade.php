<div class="modal fade modal-backdrop-custom">
</div>
<div class="widget " data-business-id="{{ isset($business) && $business ? $business->id : 0 }}">

    <div class="widget_block p-3">
        <div class="mb-3" id="main_registration_block" style="display: none;">
            <!-- STEP 1 -->
            <div id="step_fill_info" class="mb-3 widget_size" style="display: none;">
                {{-- <p class="text-center mb-2">Continue with</p>

                <div class="row mb-3">
                    <div class="col-6">
                        <button class="btn btn-sm btn-block google google-auth">Google</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm btn-block facebook facebook-auth">Facebook</button>
                    </div>
                </div>

                <p class="text-center separator_lines">or</p> --}}
                <form id="widget_info_user">
                    <div class="row mb-3">
                        <div class="col-6">
                            <input type="text" name="first_name" placeholder="First name" class="form-control form-control-sm">
                        </div>
                        <div class="col-6">
                            <input type="text" name="last_name" placeholder="Last name" class="form-control form-control-sm">
                        </div>
                    </div>
                    <p class="mb-0"><input type="email" name="email" placeholder="Email" class="form-control form-control-sm"></p>
                </form>
                <div class="row mt-3">
                    <div class="col-9"></div>
                    <div class="col-3">
                        <button class="btn btn-primary btn-block" data-step="create_account">{{ __('cv_widget.next') }}</button>
                    </div>
                </div>
            </div>
            <!-- /STEP 1 -->

            <!-- STEP 2 -->
            <div id="step_create_account" class="mb-3 widget_size" style="display: none;">
                <p class="mb-1 text-center"><strong>{{ __('cv_widget.last_step') }}</strong></p>
                <div>
                    <form id="widget-create-user">

                        <div class="d-flex flex-column flex-lg-row">
                            <div class="col-12 col-lg-6 pl-0 pxa-0">
                                <label>{!! trans('fields.label.phone_code') !!}</label>
                                <div id="country-phone" class="bfh-selectbox bfh-countries"
                                     data-country="CA" data-flags="true">
                                    <input type="hidden" name="phone_country_code" value="CA"
                                           class="country"><a
                                            class="bfh-selectbox-toggle   form-control"
                                            role="button" data-toggle="bfh-selectbox" href="#"
                                            style="padding: 8px 20px;">
                                                            <span class="bfh-selectbox-option" id="phone_code">
                                                                <i class="glyphicon bfh-flag-CA"></i>+1 <span>Canada</span></span></a>
                                    <div class="bfh-selectbox-options">
                                        <div class="bfh-selectbox-filter-container"><input
                                                    type="text"
                                                    class="bfh-selectbox-filter form-control"
                                                    placeholder="search"  autocomplete="off"></div>
                                        @include('components.phone_flag')</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 pr-0 pxa-0">
                                <label>{!! trans('fields.label.phone_number') !!}</label>
                                <input type="tel" class="form-control" id="input-phone"  autocomplete="off"
                                       placeholder="{!! trans('fields.placeholder.phone_number') !!}" name="phone_number">
                            </div>
                        </div>

{{--                        <p><input type="phone" name="phone" placeholder="Phone number" class="form-control"></p>--}}
                        <p><input type="text" name="city" id="widget-user-location" autocomplete="disabled" placeholder="City" class="form-control" autocomplete="off"></p>
                        <div class="row">
                            <div class="col-6 mx-auto">
                                <button class="btn btn-yellow btn-sm btn-block" data-step="created_account">
                                    {{ __('cv_widget.create_account') }}
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="city_name">
                        <input type="hidden" name="region">
                        <input type="hidden" name="country">
                        <input type="hidden" name="country_code">
                    </form>
                </div>
            </div>
            <!-- /STEP 2 -->

            <!-- STEP 3 -->
            <div id="step_account_created" class="widget_size" style="display: none;">
                <p class="mb-4 text-center"><strong>{{ __('cv_widget.THANK_YOU') }}</strong></p>
                @if (!isset($is_iframe) || !$is_iframe)
                    <p class="text-center mb-4">{{ __('cv_widget.your_account_has_been_create') }}</p>
                @endif
                <p class="text-center mb-0">{{ __('cv_widget.your_resume_is_sent') }}</p>
            </div>
            <!-- /STEP 3 -->
        </div>

        <div class="drag_drop widget_size">
                <!-- STEP 1 -->
                <div class="drag_drop_zone" id="upload_cv_file">
                    <div class="plus_block">
                        @svg('/img/plus_add_button.svg', [
                           'width' => '60px',
                           'height' => '60px',
                           'style' => 'fill: #fff;',
                        ])
                    </div>
                    <p class="text-center mb-0 mt-2 text-white">{{ __('cv_widget.drag_and_drop_your_CV') }}</p>
                </div>
                <input type="file" name="cv_file" hidden>
                <!-- STEP 1 -->

                <!-- STEP 2 -->
                <div class="uploading_file">
                    <div>
                        @svg('/img/widget/cv.svg', [
                           'width' => '60px',
                           'height' => '60px',
                           'style' => 'fill: #fff;',
                        ])
                    </div>
                    <div class="d-flex">
                        <div class="align-self-center mr-3 text-white">{{ __('cv_widget.uploading') }}</div>
                        <div class="align-self-center w-100 cv_progress">
                            <div id="progressbar" class="border-0" style="height: 0.7em;"></div>
                        </div>
                    </div>
                </div>
                <!-- STEP 2 -->

                <!-- STEP 3 -->
                <div class="uploaded_file">
                    <div class="d-flex">
                        <div class="mr-3">
                            @svg('/img/widget/cv.svg', [
                               'width' => '60px',
                               'height' => '60px',
                               'style' => 'fill: #fff;',
                            ])
                        </div>
                        <div id="resume_name" class="mr-3 text-white"></div>
                        <div>
                            <button type="button" class="cv_widget_delete">
                                <span aria-hidden="true" class="text-white" style="font-size: 25px;">×</span>
                            </button>
                        </div>
                    </div>
                    <p class="mb-0 text-right text-white">
                        <small>{{ __('cv_widget.by_dragging_your_CV_you_accept_the') }}</small>
                        @svg('/img/widget/down-arrow.svg', [
                           'width' => '15px',
                           'height' => '15px',
                           'style' => 'fill: #fff; vertical-align:middle; margin-left:5px;',
                        ])
                    </p>
                </div>
                <!-- STEP 3 -->
        </div>

        <div class="d-flex justify-content-between">
            <p class="align-self-center mb-0">
                <img src="{{ asset('/img/jm_logo.png') }}" class="align-self-center" width="20px" height="20px">
                <small>
                    {!! __('cv_widget.by_jobmap') !!}
                    <a href="#" class="ml-2" id="widget-without-resume">{{ __('cv_widget.i_dont_have_a_resume') }}</a>
                    <a href="#" class="ml-2" id="widget-have-resume" style="display: none;">{{ __('cv_widget.i_have_a_resume') }}</a>
                </small>
            </p>
            <p class="align-self-center mb-0">
                <a href="{{ url('/terms-of-service') }}" target="_blank"><small>{{ __('cv_widget.terms_and_privacy') }}</small></a>
            </p>
        </div>

    </div>

    @if(jwt_is_auth() === false)
        <div class="widget_toggle float-right ">
            <input type="button" class="btn btn-primary mr-2 widget_open" value="{{ __('cv_widget.upload_resume') }}" data-text-upload-resume="{{ __('cv_widget.upload_resume') }}" data-text-close="{{ __('cv_widget.close') }}">
        </div>
    @else
        <div class="widget_toggle float-right " style="display: none;">
            <input type="button" class="btn btn-primary mr-2 widget_open" value="{{ __('cv_widget.upload_resume') }}" data-text-upload-resume="{{ __('cv_widget.upload_resume') }}" data-text-close="{{ __('cv_widget.close') }}">
        </div>
    @endif
</div>
