@extends('layouts.common_user_landing')

@section('content')

<div class="main-wrapper" id="main-wrapper"  data-anchor="main-wrapper">
    <!-- NAVBAR -->
    <nav class="navbar px-0">
        <div class="container">
            <div class="d-flex justify-content-between w-100 navbar-fixed">
                <a href="javascript:;" class="d-flex">
                    <img src="{{ asset('img/jm_logo.png') }}" class="align-self-center" width="45px">
                    <p class="mb-0 logo_title align-self-center ml-3">JobMap</p>
                </a>
                <div class="flex-1 align-self-center navigation_bar">
                    <ul class="navbar-nav justify-content-around desktop_menu">
                        <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;" style="font-weight: 500;">{!! trans('landing.nav.job_seeker') !!}</a></li>
                        <!-- <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;">Academic</a></li> -->
                        <li class="nav-item align-self-center"><a class="nav-link" href="{!! url('/employers') !!}">{!! trans('landing.nav.employers') !!}</a></li>
                        <li class="nav-item align-self-center">{!! trans('landing.nav.lang') !!}</li>
                        <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;" id="show-sign-in" data-toggle="modal" data-target="#signInModal">{!! trans('landing.nav.login') !!}</a></li>
                        <li class="nav-item align-self-center"><a class="btn btn-landing active text-white user__signup" href="javascript:;" style="background: #4266ff;">{!! trans('landing.nav.upload_resume') !!}</a></li>
                    </ul>
                    <div class="mobile_hamb">
                        <div id="nav-icon1" class="mx-0 mb-0 mx-auto" style="margin-top: 15px;">
                          <span></span>
                          <span></span>
                          <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- MOBILE MENU -->
    <div class="mobile_menu px-3" style="margin-top: 70px;">
        <ul class="navbar-nav justify-content-around" style="flex-direction: column;">
            <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;"  style="font-weight: 500;">{!! trans('landing.nav.mobile.job_seeker') !!}</a></li>
            <!-- <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;">Academic</a></li> -->
            <li class="nav-item align-self-center"><a class="nav-link" href="{!! url('/employers') !!}">{!! trans('landing.nav.employers') !!}</a></li>
            <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;">{!! trans('landing.nav.lang') !!}</a></li>
            <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;" id="show-sign-in" data-toggle="modal" data-target="#signInModal">{!! trans('landing.nav.login') !!}</a></li>
            <li class="nav-item align-self-center"><a class="btn btn-landing active mb-3" href="{!! url('/user/signup') !!}" style="background: #4266ff;">{!! trans('landing.nav.upload_resume') !!}</a></li>
        </ul>
    </div>
    <!-- /MOBILE MENU -->
    <!-- NAVBAR -->
    <!-- LANDING CONTENT -->
    <div class="top_content text-center" id="top_content" style="margin-top: 100px;">
        <div class="container">
            <h2 class="h3 my-5 text-center">{!! trans('landing.form_start.title') !!}</h2>
            <div class="d-flex justify-content-between flex-lg-row flex-column" style="margin-bottom: 100px;">
                <div class="col-lg-6 text-left">
                  <div class="mx-auto">
                    <p class="mt-2"><strong>{!! trans('landing.about.title_1') !!}</strong></p>
                    <ul style="list-style: none;" class="">
                      <li class="mb-2">
                        <img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2">
                          {!! trans('landing.about.tag_11') !!}
                      </li>
                      <li class="mb-2">
                        <img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2">
                          {!! trans('landing.about.tag_12') !!}
                      </li>
                      <li class="mb-2">
                        <img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2">
                          {!! trans('landing.about.tag_13') !!}
                      </li>
                    </ul>

                    <p><strong>{!! trans('landing.about.title_2') !!}</strong></p>
                    <ul style="list-style: none;" class="">
                      <li class="mb-2">
                        <img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2">
                          {!! trans('landing.about.tag_21') !!}
                      </li>
                      <li class="mb-2">
                        <img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2">
                          {!! trans('landing.about.tag_22') !!}
                      </li>
                      <li class="mb-2">
                        <img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2">
                          {!! trans('landing.about.tag_23') !!}
                      </li>
                    </ul>

                    <p>{!! trans('landing.text_p') !!}</p>

                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="row justify-content-center sign-up-user-wizard">
                      <div class="col-12 text-center business-invite hide">
                          <img src="">
                          <h3 class="h3 mb-5 text-center">{!! trans('main.you_invited_by') !!}</h3>
                      </div>
                      <div class="col-12 text-center resume-business-signup hide">
                          <img src="">
                          <h3 class="h3 mb-5 text-center">{!! trans('main.you_invited_by_text') !!}</h3>
                      </div>
                      <div class="col-12 text-left sign-up-step-1" id="form-start-now">
                          <p class="text-center mb-3 mt-2"><strong>{!! trans('landing.form_start.tag_1') !!}</strong></p>
                          {{-- <div class="row mb-3">
                              <div class="col-12 col-lg-8 mx-auto">
                                  <a class="modal-button google google-auth rounded" href="javascript:void(0)" id="">
                                      <img class="social-logo" src="/img/social/google.png">
                                      {!! trans('main.buttons.login_google') !!}
                                  </a>
                              </div>
                              <div class="col-12 col-lg-8 mx-auto">
                                  <a class="modal-button facebook facebook-auth rounded" href="javascript:void(0)">
                                      <img class="social-logo" src="/img/social/facebook.png">
                                      {!! trans('main.buttons.login_fb') !!}
                                  </a>
                              </div>
                          </div> --}}
                          {{--<div id="setting-languages-list"></div>--}}
                          <div class="col-12 col-lg-8 mb-3 mx-auto px-0">
                              <div class="form-group mb-3 mb-sm-0">
                                  <!-- <label>{!! trans('fields.label.first_name') !!}</label> -->
                                  <input type="text" class="form-control" placeholder="{!! trans('fields.label.first_name') !!}"
                                         name="first_name" value="{{ $data['first_name'] or "" }}"  autocomplete="off">
                              </div>
                          </div>
                          <div class="col-12 col-lg-8 mb-3 mx-auto px-0">
                              <div class="form-group mb-0 text-left">
                                  <!-- <label>{!! trans('fields.label.last_name') !!}</label> -->
                                  <input type="text" class="form-control" placeholder="{!! trans('fields.label.last_name') !!}"
                                         name="last_name" value="{{ $data['last_name'] or "" }}"  autocomplete="off">
                              </div>
                          </div>

                          <div class="col-lg-8 mx-auto px-0 mb-2">
                              <button class="btn btn-primary btn-block py-2" id="start-now">
                                    {!! trans('landing.nav.upload_resume') !!}
                              </button>
                          </div>
                          <div class="col-lg-8 mx-auto px-0">
                            <p class="mb-0 text-center"><strong>{!! trans('landing.form_start.tag_2') !!}</strong></p>
                          </div>

                          <!-- <div class="mt-4 text-center d-flex justify-content-between flex-lg-row flex-column">

                              <div class="col-lg-6">
                                  <a href="{!! url('/get-a-demo') !!}" role="button" class="btn button_anchor btn-block py-2">Request a demo</a>
                              </div>
                          </div> -->
                      </div>
                  </div>
            </div>
        </div>
        <div class="container 3_easy_steps">
            <div class="d-flex justify-content-between flex-column flex-lg-row mb-5" id="easy_hiring">
                <div class="mt-0 text-center align-self-start start_steps_trial">
                    <p><img src="{{ asset('img/jm_logo.png') }}" class="align-self-center" width="70px"></p>
                    <p class="mb-2" style="font-size: 16px;"><strong>{!! trans('landing.steps.title_1') !!}</strong></p>
                    <p class="col-lg-10 mx-auto">{!! trans('landing.steps.tag_1') !!}</p>
                    <div style="width: 50px; height: 50px; border:1px solid #374251; border-radius: 50%; margin:0 auto; box-sizing: border-box; padding-top: 15px; background-color: #374251; color: #fff; font-size: 20px;">1</div>
                </div>
                <div class="gradient_line align-self-center" style="height: 1px; width: 120px;"></div>
                <div class="mt-5 mt-lg-0 text-center align-self-start start_steps_trial">
                    <p><img src="{{ asset('img/landing/networking.svg') }}" class="align-self-center" width="75px"></p>
                    <p class="mb-2" style="font-size: 16px;"><strong>{!! trans('landing.steps.title_2') !!}</strong></p>
                    <p class="col-lg-10 mx-auto">{!! trans('landing.steps.tag_2') !!}</p>
                    <div style="width: 50px; height: 50px; border:1px solid #374251; border-radius: 50%; margin:0 auto; box-sizing: border-box; padding-top: 15px; background-color: #374251; color: #fff; font-size: 20px;">2</div>
                </div>
                <div class="gradient_line align-self-center" style="height: 1px; width: 120px;"></div>
                <div class="mt-5 mt-lg-0 text-center align-self-start start_steps_trial">
                    <p><img src="{{ asset('img/landing/connection.svg') }}" class="align-self-center" width="75px"></p>
                    <p class="mb-2" style="font-size: 16px;"><strong>{!! trans('landing.steps.title_3') !!}</strong></p>
                    <p class="col-lg-10 mx-auto">{!! trans('landing.steps.tag_3') !!}</p>
                    <div class="mb-3" style="width: 50px; height: 50px; border:1px solid #374251; border-radius: 50%; margin:0 auto; box-sizing: border-box; padding-top: 15px; background-color: #374251; color: #fff; font-size: 20px;">3</div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center flex-lg-row flex-column mb-5">
          <div class="align-self-center mx-lg-3 mx-0 col-lg-4">
            <p>
                <img src="{{ asset('img//landing/jobmap_logo.svg') }}" width="170px" class="">
            </p>
            <p class="mt-4" style="font-size: 20pt; font-weight: 500;">
                {!! trans('landing.explore_jobmap_for_free') !!}
            </p>
            <p><img src="{{ asset('img//landing/phoneforlanding.png') }}" width="100%" class="jobmap_infograf"></p>

          </div>
          <div class="align-self-center mx-lg-3 mx-0 col-lg-4">

              <p class="mb-5 text-center"><strong>{!! trans('landing.apply_with_your_cloudresume') !!}</strong></p>
              <p class="mb-0 text-center">
                  <a class="btn button_for_jobmap py-3" href="http://jobmap.co/map" role="button">{!! trans('landing.button.explore_jobmap') !!}</a>
              </p>
          </div>
        </div>
    </div>
    <!-- /LANDING CONTENT -->
</div>


@endsection
