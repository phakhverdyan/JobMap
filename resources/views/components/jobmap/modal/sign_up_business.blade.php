<div class="modal fade" id="signUpBusinessModal" tabindex="-1" role="dialog" aria-labelledby="signUpModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-loading" style="display: none;">
                <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; top:10px; right: 15px; z-index: 1;">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="row justify-content-center">
                <div class="col-12 col-md-11 col-lg-11 text-center">
                    <form class="my-5 py-5 bg-white rounded" action="" method="post" id="sign-up-user-form" autocomplete="off">
                        <div class="block_business-logo-medium">
                            <p class="text-center mt-0">
                                <img class=""
                                     src="{{ asset('img/jm_logo.png') }}"
                                     style="width: 80px; height: 80px; background-color: transparent; border-radius: 10px;">
                            </p>
                        </div>
                        <div class="row justify-content-center sign-up-user-wizard">
                            <div class="col-11 col-sm-10 col-md-10 col-lg-9 text-left sign-up-step-1">
                                <h3 class="h3 mb-3 text-center">{!! trans('main.signup_business_title') !!}</h3>
                                <p class="mb-3 text-center">{!! trans('main.signup_first_text') !!}</p>
                                {{-- <div class="row mb-5">
                                    <div class="col-lg-6">
                                        <a class="modal-button google google-auth" href="javascript:void(0)" id="">
                                            <img class="social-logo" src="{{ url('/') }}/img/social/google.png">
                                            {!! trans('main.buttons.login_google') !!}
                                        </a>
                                    </div>
                                    <div class="col-lg-6">
                                        <a class="modal-button facebook facebook-auth" href="javascript:void(0)">
                                            <img class="social-logo" src="{{ url('/') }}/img/social/facebook.png">
                                            {!! trans('main.buttons.login_fb') !!}
                                        </a>
                                    </div>
                                </div> --}}
                                <div class="col-12 pl-0 pr-0">
                                    <div class="d-flex justify-content-between flex-column flex-lg-row mb-3">
                                        <div class="col-12 col-lg-5 px-0">
                                            <div class="form-group mb-3 mb-sm-0">
                                                <label>{!! trans('fields.label.first_name') !!}</label>
                                                <input type="text" class="form-control" placeholder="{!! trans('fields.placeholder.first_name') !!}"
                                                       name="first_name" value="" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-5 px-0">
                                            <div class="form-group mb-0 text-left">
                                                <label>{!! trans('fields.label.last_name') !!}</label>
                                                <input type="text" class="form-control" placeholder="{!! trans('fields.placeholder.last_name') !!}"
                                                       name="last_name" value="" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
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
                                            <input type="tel" class="form-control" id="input-phone"  autocomplete="off" value=""
                                                   placeholder="{!! trans('fields.placeholder.phone_number') !!}" name="phone_number">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label>{!! trans('fields.label.city') !!}</label>
                                    <div class="form-group input-group mb-1">
                                        <span class="input-group-addon" id="basic-addon1" style="border-bottom-left-radius: 10px; border-top-left-radius: 10px;"><i class="glyphicon"></i> </span>
                                        <input type="text" class="form-control border-right-0"
                                               placeholder="{!! trans('fields.placeholder.location') !!}" id="user-location" name="city" autocomplete="disabeld"  style="border-bottom-right-radius: 10px; border-top-right-radius: 10px;">
                                        <span class="input-group-btn border-0" style="top: 8px; z-index: 999;">
                                            <button class="btn mx-0 input-group-addon" type="button" id="location-clear"
                                                    style="border-left: 0px;">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <small class="form-text text-muted">{!! trans('fields.placeholder.city_ex') !!}</small>
                                </div>
                                <div class="form-group mb-2">
                                    <label>{!! trans('fields.label.email') !!}</label>
                                    <input type="email" class="form-control" placeholder="{!! trans('fields.placeholder.email') !!}"
                                           value="" name="email"  autocomplete="off">
                                </div>
                                <div class="form-group mb-2">
                                    <input type="password" class="form-control" placeholder="{!! trans('fields.placeholder.password') !!}"
                                           name="password" autocomplete="user-password">
                                </div>
                                <div class="form-group mb-0">
                                    <input type="password" class="form-control" placeholder="{!! trans('fields.placeholder.confirm_password') !!}"
                                           name="confirm_password" autocomplete="user-password">
                                </div>
                                <div class="row no-gutters pt-3">
                                    <div class="col-12">
                                        <p class="text-center mb-4">{!! trans('fields.label.by_clicking') !!} <a href="{{ url('/terms-of-service') }}" target="_blank" style="text-decoration: underline;">terms & conditions and the privacy policies</a></p>
                                    </div>
                                </div>
                                <p class="text-center mt-4">
                                    <button type="button" id="go-to-create_business" class="btn btn-primary px-5">{!! trans('main.buttons.next') !!}</button>
                                </p>
                            </div>
                        </div>
                        <input type="hidden" name="username" value="1">
                        <input type="hidden" name="user-year" value="{{ date('Y') - 13 }}">
                        <input type="hidden" name="user-month" value="{{ date('n') }}">
                        <input type="hidden" name="user-day" value="{{ date('j') }}">
                        <input type="hidden" name="gender" value="">
                        <input type="hidden" name="social" value="">
                        <input type="hidden" name="social_id" value="">
                        <input type="hidden" name="user_pic" value="">
                        <input type="hidden" name="user_pic_original" value="">
                        <input type="hidden" name="social_token" value="">
                        <input type="hidden" name="inviting_business_id" value="{{ request()->cookie('inviting_business_id', '0') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
