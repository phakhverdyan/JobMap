<nav class="navbar navbar-light d-flex justify-content-between" id="navbar" style="background-color: #fff; box-shadow: none!important; -webkit-box-shadow:none!important;">
    <div class="container">
        <div class="d-flex justify-content-between w-100 navbar-fixed">
            <a href="{{ url('/') }}" class="d-flex align-self-center">
                <img src="{{ asset('img/jm_logo.png') }}" class="align-self-center" width="45px">
                <p class="mb-0 logo_title align-self-center ml-3">JobMap</p>
            </a>
            <div class="flex-1 align-self-center navigation_bar">
                <ul class="navbar-nav d-lg-flex justify-content-around desktop_menu">
                    <li class="nav-item align-self-center"><a class="nav-link" href="{!! url('') !!}" style="font-weight: 500;">{!! trans('landing.nav.job_seeker') !!}</a></li>
                    <!-- <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;">Academic</a></li> -->
                    <li class="nav-item align-self-center"><a class="nav-link" href="{!! url('/employers') !!}">{!! trans('landing.nav.employers') !!}</a></li>
                    <li class="nav-item align-self-center">{!! trans('landing.nav.lang') !!}</li>
                    <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;" id="show-sign-in" data-toggle="modal" data-target="#signInModal">{!! trans('landing.nav.login') !!}</a></li>
                    <li class="nav-item align-self-center"><a class="btn btn-landing active" href="{!! url('/user/signup') !!}" style="background: #4266ff; color:#fff;">{!! trans('landing.nav.get_started') !!}</a></li>
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
        <li class="nav-item align-self-center"><a class="nav-link" href="{!! url('/jobseeker-landing') !!}">{!! trans('landing.nav.job_seeker') !!}</a></li>
        <!-- <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;">Academic</a></li> -->
        <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;">{!! trans('landing.nav.employers') !!}</a></li>
        <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;">{!! trans('landing.nav.lang') !!}</a></li>
        <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;" id="show-sign-in" data-toggle="modal" data-target="#signInModal">{!! trans('landing.nav.login') !!}</a></li>
{{--        --}}
{{--        <li class="nav-item align-self-center"><a class="btn btn-landing active mb-3" href="{!! url('/user/signup') !!}" style="background: #4266ff; color:#fff;">{!! trans('landing.nav.get_started') !!}</a></li>--}}

        <li class="nav-item align-self-center">
            <a class="btn btn-landing active" href="javascript:;" data-toggle="modal" data-target="#signUpBusinessModal" style="background: #4266ff;">
                Try JobMap
            </a>
        </li>
    </ul>
</div>
<!-- /MOBILE MENU -->
