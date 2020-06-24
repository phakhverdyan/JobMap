
<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUpModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; top:10px; right: 15px;">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="row justify-content-center">
                <div class="col-12 col-md-11 col-lg-11 text-center">
                    <form class="my-5 py-5 bg-white rounded" action="" method="post" id="sign-up-user-form" autocomplete="off">
                        <div class="block_business-logo-medium">
                            <p class="text-center mt-0">
                                <img class="border" src="{{ isset($data) && isset($data->picture) ? asset($data->picture) : '' }}" style="width: 80px; height: 80px; background-color: transparent; border-radius: 10px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);">
                            </p>
                        </div>
                        <div class="row justify-content-center sign-up-user-wizard">
                            <div class="col-11 col-sm-10 col-md-10 col-lg-9 text-left sign-up-step-1">
                                <h3 class="h3 mb-3 text-center">{!! trans('main.signup_first_text') !!}</h3>
                                {{-- <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <a class="modal-button google google-auth" href="javascript:void(0)" id="">
                                            <img class="social-logo" src="/img/social/google.png">
                                            {!! trans('main.buttons.login_google') !!}
                                        </a>
                                    </div>
                                    <div class="col-lg-6">
                                        <a class="modal-button facebook facebook-auth" href="javascript:void(0)">
                                            <img class="social-logo" src="/img/social/facebook.png">
                                            {!! trans('main.buttons.login_fb') !!}
                                        </a>
                                    </div>
                                </div> --}}
                                <div class="mb-2">
                                    <p class="text-center">
                                        <button type="button" class="btn btn-outline-primary-boot" id="show-sign-in-send-resume">{!! trans('main.buttons.button_login') !!}</button>
                                    </p>
                                </div>
                                <p class="mb-1">{!! trans('main.choose_system_language') !!}</p>
                                <div class="mb-3" id="setting-languages-list_signup"></div>
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
                                <div class="form-group mb-3">
                                    <label>{!! trans('fields.label.username') !!}</label>
                                    <input type="text" class="form-control" placeholder="{!! trans('fields.placeholder.username') !!}"
                                           name="username" value=""  autocomplete="off">
                                    <small class="form-text text-muted" id="profile-link" data-text="Your profile: "
                                           data-url="{!! request()->getSchemeAndHttpHost() !!}"><strong>{!! trans('main.you_profile_link') !!}</strong>
                                        {!! request()->getSchemeAndHttpHost().'/u/' !!}<span></span>
                                    </small>
                                </div>
                                <div class="form-group mb-2">
                                    <label>{!! trans('fields.label.phone_number') !!}</label>
                                    <input type="text" class="form-control" placeholder="{!! trans('fields.placeholder.phone_number') !!}"
                                           value="" name="mobile_phone"  autocomplete="off">
                                </div>
                                <div class="form-group mb-3">
                                    <label>{!! trans('fields.label.city') !!}</label>
                                    <div class="input-group mb-1">
                                        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon"></i> </span>
                                        <input type="text" class="form-control border-right-0"
                                               placeholder="{!! trans('fields.placeholder.location') !!}" id="user-location" name="city" autocomplete="disabeld">
                                        <span class="input-group-btn border-0">
                                            <button class="btn mx-0 input-group-addon" type="button" id="location-clear"
                                                    style="border-left: 0px;">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <small class="form-text text-muted">{!! trans('fields.placeholder.city_ex') !!}</small>
                                </div>
                                <h5 class="h5 mb-2">{!! trans('fields.label.birth_date') !!}</h5>
                                <div class="d-flex justify-content-center flex-column flex-sm-row mb-2">
                                    <div class="col-12 col-sm-4 pl-0 pxa-0">
                                        <div class="mb-2 mb-sm-0">
                                            <label class="form-control-label">{!! trans('fields.label.year') !!}</label>
                                            <select class="form-control" name="user-year" style="width: 100%;">
                                                @for($i = date('Y') - 13; $i>= date('Y') - 100; $i--)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 pxa-0">
                                        <div class="mb-2 mb-sm-0">
                                            <label class="form-control-label">{!! trans('fields.label.month') !!}</label>
                                            <select class="form-control" name="user-month" style="width: 100%;">
                                                @for($m = 1; $m <= 12; $m++)
                                                    <option {{ $m == date('n') ? 'selected' : '' }}
                                                            value="{{ date('m', mktime(0, 0, 0, $m, 1)) }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 pr-0 pxa-0">
                                        <div class="mb-2 mb-sm-0">
                                            <label class="form-control-label">{!! trans('fields.label.day') !!}</label>
                                            <select class="form-control" name="user-day" style="width: 100%;">
                                                @for($d = 1; $d <= date('t'); $d++)
                                                    <option {{ $d == date('j') ? 'selected' : '' }}
                                                            value="{{ $d }}" >{{ $d }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
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
                                <div class="form-group mb-2">
                                    <input type="password" class="form-control" placeholder="{!! trans('fields.placeholder.confirm_password') !!}"
                                           name="confirm_password" autocomplete="user-password">
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-12">
                                        <p class="text-center mb-4">{!! trans('main.signup_hint') !!}</p>
                                    </div>
                                </div>
                                <p class="text-center mt-4">
                                    <button type="button" id="go-to-terms" class="btn btn-primary px-5">{!! trans('main.buttons.next') !!}</button>
                                </p>
                            </div>
                            <div class="col-12 sign-up-terms" style="display: none">
                              <div class="row justify-content-center">
                                <div class="col-md-12 col-lg-10 text-center mb-5">
                                    <div class="card border-0">
                                        <div class="bg-white text-center mb-4">
                                            <i class="fa fa-external-link-square text-primary" aria-hidden="true"
                                               style="font-size: 45px"></i>
                                            <h3 class="h3 mb-3 text-center">{!! trans('pages.title.terms.title') !!}</h3>
                                        </div>
                                        <div class="text-center">
                                          <label class="custom-control mt-2 custom-checkbox">
                                              <input type="checkbox" class="custom-control-input user-terms" value="4">
                                              <span class="custom-control-indicator"></span>
                                              <span class="custom-control-description">{!! trans('fields.label.i_agree') !!}</span>
                                          </label>
                                        </div>
                                        <div class="mt-1 text-center">
                                            <label class="custom-control custom-checkbox">
                                                <span id="user-terms" class="custom-control-description" data-text="{!! trans('fields.placeholder.user_terms') !!}" style="color: red; display: none">
                                                    {!! trans('fields.placeholder.user_terms') !!}
                                                </span>
                                            </label>
                                        </div>
                                        <p class="text-center mt-3 mb-4">
                                            <button type="button" id="return-terms" class="btn btn-primary px-5">{!! trans('main.buttons.continue') !!}</button>
                                        </p>
                                        <div class="card-body px-0">
                                            <div class="row justify-content-center">
                                                <div class="col-12">
                                                    <div class=" mb-3">
                                                        <div class="px-3 pt-3">
                                                            <div class="row justify-content-center">
                                                                <div class="col-12 col-sm-11 col-md-6">
                                                                    {!! trans('pages.text.terms.box_1.item_1') !!}
                                                                </div>
                                                                <div class="col-12 col-sm-11 col-md-6">
                                                                    {!! trans('pages.text.terms.box_1.item_2') !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-5">
                                                        <div class="px-3 pt-3">
                                                            <div class="row justify-content-center">
                                                                <div class="col-12 col-sm-11 col-md-6">
                                                                    {!! trans('pages.text.terms.box_2.item_1') !!}
                                                                </div>
                                                                <div class="col-12 col-sm-11 col-md-6">
                                                                    {!! trans('pages.text.terms.box_2.item_2') !!}

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
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
