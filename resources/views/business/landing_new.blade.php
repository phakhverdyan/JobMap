@extends('layouts.common_business_landing')

@section('content')

<div class="main-wrapper" id="main-wrapper" data-anchor="main-wrapper">
        <!-- NAVBAR -->
        <nav class="navbar px-0">
            <div class="container">
                <div class="d-flex justify-content-between w-100 navbar-fixed">
                    <a href="javascript:;" class="d-flex">
                        <img src="{{ asset('img/jm_logo.png') }}" class="align-self-center" width="45px">
                        <p class="mb-0 logo_title align-self-center ml-3">JobMap</p>
                    </a>
                    <div class="flex-1 align-self-center navigation_bar mr-0 ml-0">
                        <ul class="navbar-nav justify-content-around desktop_menu">
                            <li class="nav-item align-self-center"><a class="nav-link" href="{!! url('/jobseeker-landing') !!}">{!! trans('landing.nav.job_seeker') !!}</a></li>
                            <!-- <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;">Academic</a></li> -->
                            <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;" style="font-weight: 500;">{!! trans('landing.nav.employers') !!}</a></li>
                            <li class="nav-item align-self-center">{!! trans('landing.nav.lang') !!}</li>
                            <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;" id="show-sign-in" data-toggle="modal" data-target="#signInModal">{!! trans('landing.nav.login') !!}</a></li>
                            <li class="nav-item align-self-center"><a class="btn btn-landing active text-white" href="{!! url('/user/signup') !!}" style="background: #4266ff; color:#fff;">{!! trans('landing.nav.get_started') !!}</a></li>
                        </ul>
                        <div class="d-flex">
                            <div class="request_mobile align-self-center mr-sm-3 mr-2 ml-0" style="display: none;">
                                <div class="d-flex">
                                    <a class="btn btn-yellow active mr-1 btn-sm" href="{!! url('/user/signup') !!}" style="background: #27cfc3; border: 1px solid #27cfc3; font-size: 11pt;">{!! trans('landing.button.start_trial') !!}</a>
                                    <a href="{!! url('/get-a-demo') !!}" class="btn btn-outline-yellow btn-sm align-self-center" role="button" style="font-size: 11pt;">{!! trans('landing.button.get_demo') !!}</a>
                                </div>
                            </div>
                            <div class="mobile_hamb align-self-center">
                                <div id="nav-icon1" class="mx-0 mb-0 mx-auto" style="margin-top: 15px;">
                                  <span></span>
                                  <span></span>
                                  <span></span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </nav>
        <!-- MOBILE MENU -->
        <div class="mobile_menu px-3" style="margin-top: 70px;">
            <ul class="navbar-nav justify-content-around" style="flex-direction: column;">
                <li class="nav-item align-self-center"><a class="nav-link" href="{!! url('/jobseeker-landing') !!}">{!! trans('landing.nav.job_seeker') !!}</a></li>
                <!-- <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;">Academic</a></li> -->
                <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;"  style="font-weight: 500;">{!! trans('landing.nav.employers') !!}</a></li>
                <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;">{!! trans('landing.nav.lang') !!}</a></li>
                <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;" id="show-sign-in" data-toggle="modal" data-target="#signInModal">{!! trans('landing.nav.login') !!}</a></li>
                <li class="nav-item align-self-center"><a class="btn btn-landing active mb-3" href="{!! url('/user/signup') !!}" style="background: #4266ff;">{!! trans('landing.nav.get_started') !!}</a></li>
            </ul>
        </div>
        <!-- /MOBILE MENU -->
        <!-- NAVBAR -->


        <!-- LANDING CONTENT -->
        <div style="margin-top: 70px;">

          <div class="container-fluid px-0 text-center">
            <!-- CONTENT -->
            <div class="top_content">
                <div class="col-12">
                  <div class="container d-flex justify-content-between flex-lg-row flex-column">
                    <div class="col-lg-6 col-12">
                        <p class="top_title mb-0" style="font-size: 25pt;">{!! trans('landing.empower_your_hiring_efforts_with') !!}</p>
                        <div class="align-self-start ml-3 d-inline-flex" style="line-height: 3.2;">
                           <div class="text-center">
                              <span class="cd-words-wrapper text-center">
                                {!! trans('landing.what_if_you_had_always') !!}
                              </span>
                            </div>
                        </div>
                        <p class="mt-3">
                            <a class="btn btn-warning px-5 py-3 mt-2" href="#easy_hiring" role="button" style="color:#fff; text-transform: uppercase; background-color: #ffb642; border-color: #ffb642;">{!! trans('landing.button.discover_how') !!}</a>
                        </p>
                        <p style="padding-bottom: 100px;">
                            <img src="{{ asset('img//integration-icons/interview.png') }}" width="85%">
                        </p>
                    </div>
                    <div class="col-lg-6 col-12">
                        <form action="" method="post" id="sign-up-user-form" autocomplete="off">
                            <input type="hidden" name="inviting_business_id" value="0">
                            <p class="text-center mb-0">
                                <img src="{{ asset('img/jm_logo.png') }}" class="align-self-center mr-3" width="50px">
                                <span class="mb-3 text-center" style="font-size: 20px; font-weight: 500;">{!! trans('landing.join_the_cloudresume_community') !!}</span>
                            </p>
                            <div class="row justify-content-center sign-up-user-wizard">
                                <div class="col-11 col-sm-10 col-md-10 col-lg-9 text-center business-invite hide">
                                    <img src="">
                                    <h3 class="h3 mb-5 text-center">{!! trans('main.you_invited_by') !!}</h3>
                                </div>
                                <div class="col-11 col-sm-10 col-md-10 col-lg-9 text-center resume-business-signup hide">
                                    <img src="">
                                    <h3 class="h3 mb-5 text-center">{!! trans('main.you_invited_by_text') !!}</h3>
                                </div>
                                <div class="col-11 col-sm-10 col-md-10 col-lg-11 text-left sign-up-step-1 mb-3">
                                    {{-- <h3 ></h3> --}}
                                    {{-- <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <a class="modal-button google google-auth rounded" href="javascript:void(0)" id="">
                                                <img class="social-logo" src="/img/social/google.png">
                                                {!! trans('main.buttons.login_google') !!}
                                            </a>
                                        </div>
                                        <div class="col-lg-12">
                                            <a class="modal-button facebook facebook-auth rounded" href="javascript:void(0)">
                                                <img class="social-logo" src="/img/social/facebook.png">
                                                {!! trans('main.buttons.login_fb') !!}
                                            </a>
                                        </div>
                                    </div> --}}
                                    <div id="setting-languages-list"></div>
                                    <div class="col-12 pl-0 pr-0">
                                        <div class="d-flex justify-content-between flex-column flex-lg-row mb-3">
                                            <div class="col-12 col-lg-5 px-0">
                                                <div class="form-group mb-3 mb-sm-0">
                                                    <label>{!! trans('fields.label.first_name') !!}</label>
                                                    <input type="text" class="form-control" placeholder="{!! trans('fields.label.first_name') !!}"
                                                           name="first_name" value="{{ $data['first_name'] or "" }}"  autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-5 px-0">
                                                <div class="form-group mb-0 text-left">
                                                    <label>{!! trans('fields.label.last_name') !!}</label>
                                                    <input type="text" class="form-control" placeholder="{!! trans('fields.label.last_name') !!}"
                                                           name="last_name" value="{{ $data['last_name'] or "" }}"  autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>{!! trans('fields.label.username') !!}</label>
                                        <input type="text" class="form-control" placeholder="{!! trans('fields.placeholder.username') !!}"
                                               name="username" value="{{ $data['username'] or "" }}"  autocomplete="off">
                                        <small class="form-text text-muted" id="profile-link" data-text="Your profile: "
                                               data-url="{!! request()->getSchemeAndHttpHost() !!}"><strong>{!! trans('main.you_profile_link') !!}</strong>
                                            {!! request()->getSchemeAndHttpHost().'/u/' !!}<span>{{ $data['username'] or "" }}</span>
                                        </small>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>{!! trans('fields.label.email') !!}</label>
                                        <input type="email" class="form-control" placeholder="{!! trans('fields.label.email') !!}"
                                               value="{{ $data['email'] or ""}}" name="email"  autocomplete="off">
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="password" class="form-control" placeholder="{!! trans('fields.placeholder.password') !!}"
                                               name="password" autocomplete="user-password">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="password" class="form-control" placeholder="{!! trans('fields.placeholder.confirm_password') !!}"
                                               name="confirm_password" autocomplete="user-password">
                                    </div>

                                    <div class="mt-4 text-center d-flex justify-content-between flex-lg-row flex-column">
                                        <div class="col-lg-6">
                                            <button type="button" class="btn btn-primary btn-block py-2" id="go-to-terms">{!! trans('main.buttons.confirm') !!}
                                            </button>
                                       </div>
                                        <div class="col-lg-6">
                                            <a href="{!! url('/get-a-demo') !!}" role="button" class="btn button_anchor btn-block py-2">{!! trans('landing.button.request_a_demo') !!}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="sign-up-user-form-terms-modal" tabindex="-1" role="dialog" aria-labelledby="sign-up-user-form-terms-modal" aria-hidden="false">
                              <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header pb-0 border-bottom-0">
                                          <p class="col-12 text large regular blue text-center auth-title">Terms</p>
                                          <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="modal-close-icon"><path d="M18.1 19.17l1.4-1.42L1.7.29.3 1.7z"></path><path d="M19.5 1.71L18.1.3.3 17.75l1.4 1.42z"></path></svg>
                                          </button>
                                      </div>
                                      <div class="modal-body pt-0">
                                          <div class="card border-0">
                                              <div class="bg-white text-center pt-4">
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
                                                  <button type="button" id="return-terms-modal" class="btn btn-primary px-5">{!! trans('main.buttons.continue') !!}</button>
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
                                              {{--<div class="card-body px-0">
                                                  <div class="row justify-content-center">
                                                      <div class="col-12">
                                                          <div class=" mb-3">
                                                              <div class="px-3 pt-3">
                                                                  <div class="row justify-content-center">
                                                                      <div class="col-12 col-sm-11 col-md-6">
                                                                          {!! trans('pages.text.terms.box_1.item_1') !!}
                                                                          <label class="custom-control mt-2 custom-checkbox">
                                                                              <input type="checkbox" class="custom-control-input user-terms" value="1">
                                                                              <span class="custom-control-indicator"></span>
                                                                              <span class="custom-control-description">{!! trans('fields.label.i_agree') !!}</span>
                                                                          </label>
                                                                      </div>
                                                                      <div class="col-12 col-sm-11 col-md-6">
                                                                          {!! trans('pages.text.terms.box_1.item_2') !!}
                                                                          <label class="custom-control mt-2 custom-checkbox">
                                                                              <input type="checkbox" class="custom-control-input user-terms" value="2">
                                                                              <span class="custom-control-indicator"></span>
                                                                              <span class="custom-control-description">{!! trans('fields.label.i_agree') !!}</span>
                                                                          </label>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class="mt-5">
                                                              <div class="px-3 pt-3">
                                                                  <div class="row justify-content-center">
                                                                      <div class="col-12 col-sm-11 col-md-6">
                                                                          {!! trans('pages.text.terms.box_2.item_1') !!}
                                                                          <label class="custom-control mt-2 custom-checkbox">
                                                                              <input type="checkbox" class="custom-control-input user-terms" value="3">
                                                                              <span class="custom-control-indicator"></span>
                                                                              <span class="custom-control-description">{!! trans('fields.label.i_agree') !!}</span>
                                                                          </label>
                                                                      </div>
                                                                      <div class="col-12 col-sm-11 col-md-6">
                                                                          {!! trans('pages.text.terms.box_2.item_2') !!}
                                                                          <label class="custom-control mt-2 custom-checkbox">
                                                                              <input type="checkbox" class="custom-control-input user-terms" value="4">
                                                                              <span class="custom-control-indicator"></span>
                                                                              <span class="custom-control-description">{!! trans('fields.label.i_agree') !!}</span>
                                                                          </label>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="mt-3 text-center">
                                                  <label class="custom-control custom-checkbox">
                                                      --}}{{--<span id="user-terms" class="custom-control-description" data-text="{!! trans('fields.placeholder.user_terms') !!}">{!! trans('fields.label.user_terms') !!}</span>--}}{{--
                                                      <span id="user-terms" class="custom-control-description" data-text="{!! trans('fields.placeholder.user_terms') !!}" style="color: red; display: none">
                                                    {!! trans('fields.placeholder.user_terms') !!}
                                                </span>
                                                  </label>
                                              </div>
                                              <p class="text-center mt-5">
                                                  <button type="button" id="return-terms-modal" class="btn btn-primary px-5">{!! trans('main.buttons.continue') !!}</button>
                                              </p>--}}
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                        </form>
                  </div>
                </div>

                <div class="d-flex justify-content-center flex-column flex-md-row mb-5 mt-5">
                    <p class="mb-0 top_title" style="font-weight: lighter; font-size: 22pt;">{!! trans('landing.you_spend_a_lot') !!}</p>
                    <div class="align-self-center ml-3 cd-headline rotate-1 d-inline-flex" style="line-height: 3.2;">
                        <div>
                            <span class="cd-words-wrapper">
                                <b class="is-visible"><img src="{{ asset('img//integration-icons/linkedin.png') }}" style="width: 120px; vertical-align: middle;"></b>
                                <b><img src="{{ asset('img//integration-icons/monster.png') }}" style="width: 120px; vertical-align: middle;"></b>
                                <b>
                                    <img src="{{ asset('img//integration-icons/jobboom.svg') }}" style="width: 120px; vertical-align: middle;">
                                </b>
                                <b>
                                    <img src="{{ asset('img//integration-icons/zip_recruiter.svg') }}" style="width: 120px; vertical-align: middle;">
                                </b>
                                <b>
                                    <img src="{{ asset('img//integration-icons/indeed.svg') }}" style="width: 120px; vertical-align: middle;">
                                </b>
                                <b><img src="{{ asset('img//integration-icons/career_b.png') }}" style="width: 120px; vertical-align: middle;"></b>
                                <b><img src="{{ asset('img//integration-icons/snag.png') }}" style="width: 110px; vertical-align: middle;"></b>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="container 3_easy_steps">
                    <div class="d-flex justify-content-between flex-column flex-lg-row mb-5" id="easy_hiring">
                        <div class="mt-0 text-center align-self-start start_steps_trial">
                            <p><img src="{{ asset('img/jm_logo.png') }}" class="align-self-center" width="70px"></p>
                            <p>{!! trans('landing.start_your_free_trial') !!}</p>
                            <div style="width: 50px; height: 50px; border:1px solid #374251; border-radius: 50%; margin:0 auto; box-sizing: border-box; padding-top: 15px; background-color: #374251; color: #fff; font-size: 20px;">1</div>
                        </div>
                        <div class="gradient_line align-self-center" style="height: 1px; width: 120px;"></div>
                        <div class="mt-5 mt-lg-0 text-center align-self-start start_steps_trial">
                            <p><img src="{{ asset('img/landing/networking.svg') }}" class="align-self-center" width="75px"></p>
                            <p>{!! trans('landing.easy_step_by_step_integration') !!}</p>
                            <div style="width: 50px; height: 50px; border:1px solid #374251; border-radius: 50%; margin:0 auto; box-sizing: border-box; padding-top: 15px; background-color: #374251; color: #fff; font-size: 20px;">2</div>
                        </div>
                        <div class="gradient_line align-self-center" style="height: 1px; width: 120px;"></div>
                        <div class="mt-5 mt-lg-0 text-center align-self-start start_steps_trial">
                            <p><img src="{{ asset('img/landing/connection.svg') }}" class="align-self-center" width="75px"></p>
                            <p>{!! trans('landing.only_pay_for_results') !!}</p>
                            <div class="mb-3" style="width: 50px; height: 50px; border:1px solid #374251; border-radius: 50%; margin:0 auto; box-sizing: border-box; padding-top: 15px; background-color: #374251; color: #fff; font-size: 20px;">3</div>
                            <p><img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2">{!! trans('landing.your_candidates_will_never_expire') !!}</p>
                            <p class="mb-0"><img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2">{!! trans('landing.your_hiring_budget') !!}</p>
                        </div>
                    </div>
                    <p class="text-center" style="padding-bottom: 100px;">
                        <a class="btn btn-landing active px-4 py-3" href="{!! url('/user/signup') !!}" style="color: #fff; background-color: #ffb642; border-color: #ffb642;">
                            {!! trans('landing.nav.get_started') !!}
                        </a>
                    </p>
                </div>

                <!-- ANCHOR STAFF -->
                <div class="anchor">
                    <div class="container">
                        <div class="d-flex justify-content-center anchor_div">
                            <a href="#main-wrapper" role="button" class="button_anchor cloudResume mx-sm-3 mx-1">
                                {!! trans('landing.anchor.cloudresume') !!}
                            </a>
                            <a href="#jobmap_section" role="button" class="button_anchor jobMap mx-sm-3 mx-0">
                                {!! trans('landing.anchor.jobmap') !!}
                            </a>
                            <!-- <a href="#pricing_section" role="button" class="button_anchor pricing mx-sm-3 mx-1">
                                {!! trans('landing.anchor.pricing') !!}
                            </a> -->
                            <a class="button_anchor request_callback mx-sm-3 mx-0" href="{!! url('/get-a-demo') !!}">
                                {!! trans('landing.anchor.request_callback') !!}
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /ANCHOR STAFF -->

                <!-- EASY HIRING SECTION -->
                <div class="easy_hiring" id="">
                  <div class="container">
                    <div class="text-center py-5">

                        <p class="mt-4" style="font-size: 20pt; font-weight: 500;">{!! trans('landing.your_hiring_efforts') !!}</p>
                        <p style="font-size: 17pt;">{!! trans('landing.every_month_you_spend') !!}</p>

                        <div class="d-flex justify-content-between flex-column flex-xl-row wow fadeInDown mb-5" data-wow-delay="0.6s" style="margin-top: 80px; position: relative;">
                            <div class="text-center every_month_step">
                                <img src="{{ asset('img//landing/website.svg') }}" class="mb-4" width="50px">
                                <p class="circle_title"><strong>{!! trans('landing.step_horizon.website') !!}</strong></p>
                                <div class="gradient_line" style="height: 135px;">
                                    <div style="position: absolute; z-index: 1; bottom:0; margin-left: -22px;">
                                        <p class="mb-0"><img src="{{ asset('img//landing/boy.svg') }}" width="45px"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mt-md-0 text-center every_month_step">
                                <img src="{{ asset('img//landing/instore.svg') }}" class="mb-4" width="50px">
                                <p class="circle_title"><strong>{!! trans('landing.step_horizon.store_branches') !!}</strong></p>
                                <div class="gradient_line" style="height: 135px;">
                                    <div style="position: absolute; z-index: 1; bottom:0; margin-left: -22px;">
                                        <p><img src="{{ asset('img//landing/boy2.svg') }}" width="45px"></p>
                                        <p class="mb-0"><img src="{{ asset('img//landing/man.svg') }}" width="45px"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mt-md-0 text-center every_month_step">
                                <div class="align-self-center mb-4 cd-headline rotate-1 d-inline-flex" style="line-height: 3.6;">
                                    <div>
                                        <span class="cd-words-wrapper">
                                            <b class="is-visible"><img src="{{ asset('img//integration-icons/monster.png') }}" style="width: 120px; vertical-align: middle;"></b>
                                            <b>
                                                <img src="{{ asset('img//integration-icons/jobboom.svg') }}" style="width: 120px; vertical-align: middle;">
                                            </b>
                                            <b>
                                                <img src="{{ asset('img//integration-icons/zip_recruiter.svg') }}" style="width: 120px; vertical-align: middle;">
                                            </b>
                                            <b>
                                                <img src="{{ asset('img//integration-icons/indeed.svg') }}" style="width: 120px; vertical-align: middle;">
                                            </b>
                                            <b><img src="{{ asset('img//integration-icons/career_b.png') }}" style="width: 120px; vertical-align: middle;"></b>
                                            <b><img src="{{ asset('img//integration-icons/snag.png') }}" style="width: 110px; vertical-align: middle;"></b>
                                        </span>
                                    </div>
                                </div>
                                <p class="circle_title"><strong>{!! trans('landing.step_horizon.job_boards_ads') !!}</strong></p>
                                <div class="gradient_line" style="height: 135px;">
                                    <div style="position: absolute; z-index: 1; bottom:0; margin-left: -22px;">
                                        <p><img src="{{ asset('img//landing/man1.svg') }}" width="45px"></p>
                                        <p class="mb-0"><img src="{{ asset('img//landing/man2.svg') }}" width="45px"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mt-md-0 text-center every_month_step">
                                <div style="position: relative;  width: 182px; height: 75px; margin: 0 auto;">
                                    <img src="{{ asset('img//landing/twitter.svg') }}" width="50px" style="position: absolute; z-index: 1; left: 0;">
                                    <img src="{{ asset('img//landing/in.svg') }}" width="50px" style="position: absolute; z-index: 1; left: 48%;">
                                    <img src="{{ asset('img//landing/insta.svg') }}" width="50px" style="position: absolute; z-index: 2; bottom: 14px; left: 23%;">
                                    <img src="{{ asset('img//landing/face.svg') }}" width="50px" style="position: absolute; z-index: 2; bottom: 14px; right:0;">
                                </div>
                                <p class="circle_title"><strong>{!! trans('landing.step_horizon.social_network_job_posts') !!}</strong></p>
                                <div class="gradient_line" style="height: 135px;">
                                    <div style="position: absolute; z-index: 1; bottom:0; margin-left: -22px;">
                                        <p><img src="{{ asset('img//landing/man3.svg') }}" width="45px"></p>
                                        <p class="mb-0"><img src="{{ asset('img//landing/girl.svg') }}" width="45px"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mt-md-0 text-center every_month_step">
                                <div style="position: relative;  width: 93px; height: 75px; margin: 0 auto;">
                                    <img src="{{ asset('img//landing/database.svg') }}" width="50px" style="position: absolute; z-index: 1; left: 0;">
                                    <img src="{{ asset('img//landing/excel.svg') }}" width="50px" style="position: absolute; z-index: 2; bottom: 14px; right: 0;">
                                </div>
                                <p class="circle_title"><strong>{!! trans('landing.step_horizon.ats') !!}</strong></p>
                                <div class="gradient_line" style="height: 135px;">
                                    <div style="position: absolute; z-index: 1; bottom:0; margin-left: -22px;">
                                        <img src="{{ asset('img//landing/girl2.svg') }}" width="45px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-0 col-xl-5 col-12 mx-auto align-self-center wow fadeInDown" data-wow-delay="1.3s">
                            <p class="mb-0 text-center md_small_font" style="font-size: 20pt;">{!! trans('landing.you_recieve_static_resumes') !!}</p>
                            <p class="mb-0 text-center md_small_font" style="font-size: 16pt;"><strong>{!! trans('landing.after_a_few_days') !!}</strong></p>
                            <p class="text-center md_small_font" style="font-size: 25pt;">{!! trans('landing.they_are') !!}
                                <span>
                                    <strong>
                                        <a class="typewrite" data-period="2000" data-type='[ {!! trans('landing.expirable_out_inactive_useless') !!} ]' style="text-transform: uppercase; color:#4266ff;">
                                            <span class="wrap"></span>
                                        </a>
                                    </strong>
                                </span>
                            </p>
                            <div class="gradient_line" style="display: block!important;"></div>
                            <p class="mb-2 text-center mt-3">
                                <!-- <img src="{{ asset('img//landing/angry_smile.png') }}" width="64px"> -->
                                <img src="{{ asset('img//landing/fuck_smile.png') }}" width="64px">
                                <!-- <img src="{{ asset('img//landing/sad_smile.png') }}" width="64px"> -->

                            </p>
                            <p class="text-center">{!! trans('landing.step_vertical.hrs_blow_a_fuse_here') !!}</p>
                        </div>

                        <div class="gradient_line wow fadeInDown" data-wow-delay="1.6s" style="display: block!important;"></div>

                        <div class="mx-auto wow fadeInDown" data-wow-delay="0.6s">
                            <p class="mb-0 align-self-center" style="font-size: 15pt;">
                                {!! trans('landing.step_vertical.but_with') !!}
                                <img src="{{ asset('img/landing/cr-logo.png') }}" width="45px" class="">
                                {!! trans('landing.step_vertical.cloudresume') !!}
                            </p>
                        </div>

                        <div class="gradient_line wow fadeInDown" data-wow-delay="0.9s" style="display: block!important;"></div>

                        <div class="mb-0 col-xl-4 col-12 mx-auto align-self-center text-center wow fadeInDown" data-wow-delay="1.2s" style="font-size: 15pt;">
                            <div>
                                <div style="position: relative; height: 115px;" class="d-inline-flex">
                                    <img src="{{ asset('img//landing/cloud.svg') }}" width="105px">
                                    <img src="{{ asset('img/landing/reload.svg') }}" width="35px" style="position: absolute; z-index: 1; right: 31px; top:42%;" class="rotate_animation">
                                    <img src="{{ asset('img/landing/cr-logo.png') }}" width="35px" style="position: absolute; z-index: 1; right: -15px; bottom: 10px;">
                                </div>

                            </div>
                            <p>
                                <img src="{{ asset('img/landing/galochka.svg') }}" width="25px">
                                {!! trans('landing.step_vertical.you_get_active_resumes') !!}
                            </p>
                        </div>

                        <div class="gradient_line wow fadeInDown" data-wow-delay="0.6s" style="display: block!important;"></div>
                        <p class="text-center wow fadeInDown" data-wow-delay="0.9s">
                            <a class="btn btn-warning px-5 py-3 mt-2" href="#steps_section" role="button" style="color:#fff; text-transform: uppercase; background-color: #ffb642; border-color: #ffb642;">{!! trans('landing.button.see_the_difference') !!}</a>
                        </p>
                    </div>
                  </div>
                </div>
                <!-- /EASY HIRING SECTIOn -->

                <!-- STEPS SECTION -->
                <div class="steps_section" id="steps_section">
                    <div class="container">
                        <div>

                            <div class="row px-0 justify-content-between steps_top">
                                <div class="text-center align-self-center col-5 dino" style="font-size: 17pt;">
                                    <p>
                                        <img src="{{ asset('img//landing/tyran.svg') }}" width="55px">
                                        <img src="{{ asset('img//landing/dacen.svg') }}" width="55px">
                                    </p>
                                    <strong>{!! trans('landing.vs.how_it_used_to_be') !!}</strong>
                                </div>
                                <div class="col-2 text-center align-self-center">
                                    <p class="my-2 term_size">{!! trans('landing.vs.vs') !!}</p>
                                </div>
                                <div class="text-center align-self-center col-5 cloudR" style="font-size: 17pt;">
                                    <p>
                                        <img src="{{ asset('img/landing/cr-logo.png') }}" width="55px">
                                    </p>
                                    <strong>{!! trans('landing.vs.with_cloudresume') !!}</strong>
                                </div>
                            </div>

                            <!-- STEP 1 -->
                            <div class="d-flex justify-content-between text-xl-left mt-5 mt-lg-0 text-center flex-column flex-xl-row need_to_margin  wow fadeIn">
                                <div class="align-self-center col-lg-5 col-12">
                                    <p style="padding-left: 38px;"><img src="{{ asset('img/landing/legal-paper.svg') }}" width="35px"></p>
                                    <p class="mb-0" style="font-size: 16px;">
                                        <img src="{{ asset('img/landing/cancel.svg') }}" width="25px" class="mr-2">
                                        <strong>{!! trans('landing.vs.candidates_apply') !!}</strong>
                                    </p>
                                    <p class="mb-0" style="padding-left: 38px;">{!! trans('landing.vs.candidate_handed_paper_resume') !!}</p>
                                </div>
                                <div class="col-xl-2 col-12 my-3 my-xl-0 text-center">
                                    <div class="gradient_line" style="height:60px;"></div>
                                    <p class="my-2 term_size">{!! trans('landing.vs.day_1') !!}</p>
                                    <div class="gradient_line" style="height:60px;"></div>
                                </div>
                                <div class="align-self-center col-lg-5 col-12">
                                    <p style="padding-left: 38px;"><img src="{{ asset('img/landing/approved.svg') }}" width="35px"></p>
                                    <p class="mb-0" style="font-size: 16px;">
                                        <img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2">
                                        <strong>{!! trans('landing.vs.cloudresume_received') !!}</strong>
                                    </p>
                                   <p class="mb-0" style="padding-left: 38px;">{!! trans('landing.vs.candidate_sent_a_cloudresume') !!}</p>
                                </div>
                            </div>
                            <!-- /STEP 1 -->
                            <div class="big_gradient_line for_steps" style="display: none;"></div>
                            <!-- STEP 2 -->
                            <div class="d-flex justify-content-between text-xl-left mt-5 mt-lg-0 text-center flex-column flex-xl-row  wow fadeIn" data-wow-delay="0.3s">
                                <div class="align-self-center col-lg-5 col-12">
                                    <p style="padding-left: 38px;"><img src="{{ asset('img/landing/phone-call.svg') }}" width="35px"></p>
                                    <p class="mb-0" style="font-size: 16px;">
                                        <img src="{{ asset('img/landing/cancel.svg') }}" width="25px" class="mr-2">
                                        <strong>{!! trans('landing.vs.no_replies') !!}</strong>
                                    </p>
                                    <p class="mb-0" style="padding-left: 38px;">{!! trans('landing.vs.you_call_but_theres_no_reply') !!}</p>
                                </div>
                                <div class="col-xl-2 col-12 my-3 my-xl-0 text-center">
                                    <div class="gradient_line" style="height:60px;"></div>
                                    <p class="my-2 term_size">{!! trans('landing.vs.after_1_week') !!}</p>
                                    <div class="gradient_line" style="height:60px;"></div>
                                </div>
                                <div class="align-self-center col-lg-5 col-12">
                                    <p style="padding-left: 38px;"><img src="{{ asset('img/landing/video-conference.svg') }}" width="35px"></p>
                                    <p class="mb-0" style="font-size: 16px;">
                                        <img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2">
                                        <strong>{!! trans('landing.vs.instant_messages_interviews') !!}</strong>
                                    </p>
                                   <p class="mb-0" style="padding-left: 38px;">{!! trans('landing.vs.you_instant_message_your_candidate') !!}</p>
                                </div>
                            </div>
                            <!-- /STEP 2 -->
                            <div class="big_gradient_line for_steps" style="display: none;"></div>
                            <!-- STEP 3 -->
                            <div class="d-flex justify-content-between text-xl-left mt-5 mt-lg-0 text-center flex-column flex-xl-row  wow fadeIn" data-wow-delay="0.6s">
                                <div class="align-self-center col-lg-5 col-12">
                                    <p style="padding-left: 38px;"><img src="{{ asset('img/landing/briefcase.svg') }}" width="35px"></p>
                                    <p class="mb-0" style="font-size: 16px;">
                                        <img src="{{ asset('img/landing/cancel.svg') }}" width="25px" class="mr-2">
                                        <strong>{!! trans('landing.vs.already_elsewhere') !!}</strong>
                                    </p>
                                    <p class="mb-0" style="padding-left: 38px;">{!! trans('landing.vs.candidate_got_a_job') !!}</p>
                                </div>
                                <div class="col-xl-2 col-12 my-3 my-xl-0 text-center">
                                    <div class="gradient_line" style="height:60px;"></div>
                                    <p class="my-2 term_size">{!! trans('landing.vs.after_1_month') !!}</p>
                                    <div class="gradient_line" style="height:60px;"></div>
                                </div>
                                <div class="align-self-center col-lg-5 col-12">
                                    <p style="padding-left: 38px;"><img src="{{ asset('img/landing/like.svg') }}" width="35px"></p>
                                    <p class="mb-0" style="font-size: 16px;">
                                        <img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2">
                                        <strong>{!! trans('landing.vs.live_resume_details') !!}</strong>
                                    </p>
                                    <p class="mb-0" style="padding-left: 38px;">{!! trans('landing.vs.you_can_see_in_his_profile') !!}</p>
                                </div>
                            </div>
                            <!-- /STEP 3 -->
                            <div class="big_gradient_line for_steps" style="display: none;"></div>
                            <!-- STEP 4 -->
                            <div class="d-flex justify-content-between text-xl-left mt-5 mt-lg-0 text-center flex-column flex-xl-row  wow fadeIn" data-wow-delay="0.9s">
                                <div class="align-self-center col-lg-5 col-12">
                                    <p style="padding-left: 38px;"><img src="{{ asset('img/landing/moving.svg') }}" width="35px"></p>
                                    <p class="mb-0" style="font-size: 16px;">
                                        <img src="{{ asset('img/landing/cancel.svg') }}" width="25px" class="mr-2">
                                        <strong>{!! trans('landing.vs.too_late') !!}</strong>
                                    </p>
                                    <p class="mb-0" style="padding-left: 38px;">{!! trans('landing.vs.candidate_moved_and_needs') !!}</p>
                                </div>
                                <div class="col-xl-2 col-12 my-3 my-xl-0 text-center">
                                    <div class="gradient_line" style="height:60px;"></div>
                                    <p class="my-2 term_size">{!! trans('landing.vs.after_2_months') !!}</p>
                                    <div class="gradient_line" style="height:60px;"></div>
                                </div>
                                <div class="align-self-center col-lg-5">
                                    <p style="padding-left: 38px;"><img src="{{ asset('img/landing/pin.svg') }}" width="35px"></p>
                                    <p class="mb-0" style="font-size: 16px;">
                                        <img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2">
                                        <strong>{!! trans('landing.vs.always_up_to_date') !!}</strong>
                                    </p>
                                    <p class="mb-0" style="padding-left: 38px;">{!! trans('landing.vs.you_can_see_that_the_candidate') !!}</p>
                                </div>
                            </div>
                            <!-- /STEP 4 -->
                            <div class="big_gradient_line for_steps" style="display: none;"></div>
                            <!-- STEP 5 -->
                            <div class="d-flex justify-content-between text-xl-left mt-5 mt-lg-0 text-center flex-column flex-xl-row  wow fadeIn" data-wow-delay="1.2s">
                                <div class="align-self-center col-lg-5">
                                    <p style="padding-left: 38px;"><img src="{{ asset('img/landing/no-entry-symbol.svg') }}" width="35px"></p>
                                    <p class="mb-0" style="font-size: 16px;">
                                        <img src="{{ asset('img/landing/cancel.svg') }}" width="25px" class="mr-2">
                                        <strong>{!! trans('landing.vs.no_updates') !!}</strong>
                                    </p>
                                    <p class="mb-0" style="padding-left: 38px;">{!! trans('landing.vs.this_resume_is_no_longer_relevant') !!}</p>
                                </div>
                                <div class="col-xl-2 my-3 my-xl-0 text-center">
                                    <div class="gradient_line" style="height:60px;"></div>
                                    <p class="my-2 term_size">{!! trans('landing.vs.after_3_months') !!}</p>
                                    <div class="gradient_line" style="height:60px;"></div>
                                </div>
                                <div class="align-self-center col-lg-5">
                                    <p style="padding-left: 38px;"><img src="{{ asset('img/landing/refresh.svg') }}" width="35px"></p>
                                    <p class="mb-0" style="font-size: 16px;">
                                        <img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2">
                                        <strong>{!! trans('landing.vs.update_requests') !!}</strong>
                                    </p>
                                    <p class="mb-0" style="padding-left: 38px;">{!! trans('landing.vs.rhis_applicant_is_no_longer_looking') !!}</p>
                                </div>
                            </div>
                            <!-- /STEP 5 -->
                            <div class="big_gradient_line for_steps" style="display: none;"></div>
                            <!-- STEP 6 -->
                            <div class="d-flex justify-content-between text-xl-left mt-5 mt-lg-0 text-center flex-column flex-xl-row never_lose_title  wow fadeIn" data-wow-delay="0.4s">
                                <div class="align-self-center col-lg-5">
                                    <p style="padding-left: 38px;"><img src="{{ asset('img/landing/trash.svg') }}" width="35px"></p>
                                    <p class="mb-0" style="font-size: 16px;">
                                        <img src="{{ asset('img/landing/cancel.svg') }}" width="25px" class="mr-2">
                                        <strong>{!! trans('landing.vs.useless') !!}</strong>
                                    </p>
                                    <p class="mb-0" style="padding-left: 38px;">{!! trans('landing.vs.this_resume_shouldnt_be_in') !!}</p>
                                </div>
                                <div class="col-xl-2 my-3 my-xl-0 text-center">
                                    <div class="gradient_line" style="height:60px;"></div>
                                    <p class="my-2 term_size">{!! trans('landing.vs.after_1_year') !!}</p>
                                    <div class="gradient_line" style="height:60px;"></div>
                                </div>
                                <div class="align-self-center col-lg-5">
                                    <p style="padding-left: 38px;"><img src="{{ asset('img/landing/list.svg') }}" width="35px"></p>
                                    <p class="mb-0" style="font-size: 16px;">
                                        <img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2">
                                        <strong>{!! trans('landing.vs.organize_hiring_pipeline') !!}</strong>
                                    </p>
                                    <p class="mb-0" style="padding-left: 38px;">{!! trans('landing.vs.with_time_you_can_organize_all') !!}</p>
                                </div>
                            </div>
                            <!-- /STEP 6 -->

                            <p class="text-center mt-xl-3 mt-5" style="font-size: 17pt;">
                                <img src="{{ asset('img/landing/galochka.svg') }}" width="25px" style="margin-top: -3px;">
                                <strong>{!! trans('landing.vs.never_lose_candidates_again') !!}</strong>
                            </p>

                        </div>
                    </div>
                </div>
                <!-- /STEPS SECTIOn -->

                <!-- JOBMAP SECTION -->
                    <!-- fixed top jobmaplogo -->
                    <div class="fixed_jobmap">
                        <p class="mb-0 fixed_jobmap_text" style="font-size: 20pt; font-weight: 500;">
                            <img src="{{ asset('img//landing/jobmap_logo.svg') }}" width="70px" class="fixed_jobmap_img">
                            {!! trans('landing.jobmap.free_unlimited_access_to_jobmap') !!}
                        </p>
                    </div>
                    <!-- /fixed top jobmaplogo -->
                <div class="jobmap_section" id="jobmap_section" data-anchor="jobmap_section">
                    <div class="container text-center">
                        <p>
                            <img src="{{ asset('img//landing/jobmap_logo.svg') }}" width="170px" class="wow fadeInDown" data-wow-delay="0.2s">
                        </p>
                        <p class="mt-4 wow fadeInDown" data-wow-delay="0.2s" style="font-size: 20pt; font-weight: 500;">{!! trans('landing.jobmap.free_unlimited_access_to_jobmap') !!}</p>
                        <p><img src="{{ asset('img//landing/phoneforlanding.png') }}" width="100%" class="jobmap_infograf wow fadeInUpBig" data-wow-delay="0.3s"></p>

                        <div class="gradient_line wow fadeInDown" data-wow-delay="0.4s" style="height:60px; display: block!important;"></div>
                        <div class="align-self-center my-3 wow fadeInDown" data-wow-delay="0.5s">
                            <p><img src="{{ asset('img/landing/brands.svg') }}" width="35px"></p>
                            <p class="mb-0" style="font-size: 16px;"><strong>{!! trans('landing.jobmap.unlimited_brands') !!}</strong></p>
                            {!! trans('landing.jobmap.easily_manage_multiple_company') !!}
                        </div>

                        <div class="gradient_line wow fadeInDown" data-wow-delay="0.6s" style="height:60px; display: block!important;"></div>
                        <div class="align-self-center my-3 wow fadeInDown" data-wow-delay="0.7s">
                            <p><img src="{{ asset('img/landing/departments.svg') }}" width="35px"></p>
                            <p class="mb-0" style="font-size: 16px;"><strong>{!! trans('landing.jobmap.unlimited_departments') !!}</strong></p>
                            {!! trans('landing.jobmap.easily_organize_your_jobs') !!}
                        </div>

                        <div class="gradient_line wow fadeInDown" data-wow-delay="0.8s" style="height:60px; display: block!important;"></div>
                        <div class="align-self-center my-3 wow fadeInDown" data-wow-delay="0.9s">
                            <p><img src="{{ asset('img/landing/managers.svg') }}" width="35px"></p>
                            <p class="mb-0" style="font-size: 16px;"><strong>{!! trans('landing.jobmap.unlimited_managers') !!}</strong></p>
                            {!! trans('landing.jobmap.multiple_hr_managers') !!}
                        </div>

                        <div class="gradient_line wow fadeInDown" data-wow-delay="0.2s" style="height:60px; display: block!important;"></div>
                        <div class="align-self-center my-3 wow fadeInDown" data-wow-delay="0.3s">
                            <p><img src="{{ asset('img/landing/location.svg') }}" width="35px"></p>
                            <p class="mb-0" style="font-size: 16px;"><strong>{!! trans('landing.jobmap.unlimited_locations') !!}</strong></p>
                            {!! trans('landing.jobmap.add_as_many_branch') !!}
                        </div>

                        <div class="gradient_line wow fadeInDown" data-wow-delay="0.4s" style="height:60px; display: block!important;"></div>
                        <div class="align-self-center my-3 wow fadeInDown" data-wow-delay="0.5s">
                            <p><img src="{{ asset('img/landing/jobposts.svg') }}" width="35px"></p>
                            <p class="mb-0" style="font-size: 16px;"><strong>{!! trans('landing.jobmap.unlimited_job_posts') !!}</strong></p>
                            {!! trans('landing.jobmap.it_is_free_to_re_activate') !!}
                        </div>

                        <div class="gradient_line wow fadeInDown" data-wow-delay="0.2s" style="height:60px; display: block!important;"></div>
                        <div class="align-self-center my-3 wow fadeInDown" data-wow-delay="0.3s">
                            <p><img src="{{ asset('img/landing/local_candidates.svg') }}" width="35px"></p>
                            <p class="mb-0 last_jobmap_step" style="font-size: 16px;"><strong>{!! trans('landing.jobmap.unlimited_local_candidates') !!}</strong></p>
                            {!! trans('landing.jobmap.receive_unlimited_applicants') !!}
                        </div>

                        <div class="gradient_line wow fadeInDown" data-wow-delay="0.4s" style="height:60px; display: block!important;"></div>
                        <div class="align-self-center my-3 wow fadeInDown" data-wow-delay="0.5s">
                            <p><img src="{{ asset('img/landing/career_page.svg') }}" width="35px"></p>
                            <p class="mb-0" style="font-size: 16px;"><strong>{!! trans('landing.jobmap.free_career_page') !!}</strong></p>
                            {!! trans('landing.jobmap.your_brand_will_have') !!}
                        </div>

                        <div class="d-flex justify-content-center flex-md-row flex-column" style="margin-top: 120px;">
                            <div class="col-lg-3 col-md-5 col-12 mx-md-2 mx-0 px-1">
                                <a  href="http://jobmap.co/cardinal" class="btn btn-warning py-2 px-5 btn-block" style="color:#fff; text-transform: uppercase; background-color: #ffb642; border-color: #ffb642;">{!! trans('landing.button.explore_jobmap') !!}</a>
                            </div>
                            <div class="col-lg-3 col-md-5 col-12 mx-md-2 mx-0 mt-3 mt-md-0 px-1">
                                <a class="btn btn-landing py-2 px-1 btn-block" href="{!! url('/user/signup') !!}" style="background: #4266ff; color:#fff;">
                                    {!! trans('landing.button.get_started') !!}
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /JOBMAP SECTION -->
            </div>

            <!-- /CONTENT -->

          </div>

          <!-- DISCOVER SECTION -->
          <div class="discover_section">
              <div class="container text-center">
                  <p class="top_bold_title" style="font-size: 17pt;">{!! trans('landing.discover_how_you_can_improve') !!}</p>
                  <p style="font-weight: lighter; line-height: 2.3; font-size: 12pt;">{!! trans('landing.get_unlimited_access_to_jobmap') !!}</p>
                  <div class="d-flex justify-content-center flex-lg-row flex-column mt-4">
                      <!-- <div class="col-lg-3 col-12 mx-md-2 mx-0 px-1">
                          <a href="#pricing_section" role="button" class="btn see_talent_button btn-block" style="font-size: 16pt;">{!! trans('landing.button.see_pricing') !!}</a>
                      </div> -->
                      <div class="col-lg-3 mx-auto col-12 mx-md-2 mx-0 mt-3 mt-lg-0 px-1">
                          <a href="{!! url('/get-a-demo') !!}" role="button" class="btn hiring_outline_button btn-block" style="font-size: 16pt;">{!! trans('landing.anchor.request_callback') !!}</a>
                      </div>
                  </div>
              </div>
          </div>
          <!-- /DISCOVER SECTIOn -->


        </div>
        <!-- /LANDING CONTENT -->






    </div>

<!-- HELP MODAL -->
<div class="modal fade" id="helpLandingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <p class="text-center mb-0"><button type="button" class="btn btn-primary">{!! trans('landing.form.okay') !!}</button></p>
      </div>
    </div>
  </div>
</div>
<!-- /HELP MODAL -->

</div>
@endsection
