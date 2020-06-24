    <!-- NAVBAR -->
    <nav class="navbar px-0">
        <div class="container">
            <div class="d-flex justify-content-between w-100 navbar-fixed">
                <a href="{{ url('/') }}" class="d-flex">
                    <img src="{{ asset('img/jm_logo.png') }}" class="align-self-center" width="45px">
                    <p class="mb-0 logo_title align-self-center ml-3">JobMap</p>
                </a>

                <ul class="navbar-nav justify-content-around desktop_menu flex-row flex-1 align-self-center">
                    <li class="nav-item align-self-center"><a class="nav-link" href="{!! url('/') !!}">{!! trans('landing.nav.job_seeker') !!}</a></li>
                    {{--<li class="nav-item align-self-center"><a class="nav-link" href="{{ env('APP_URI','https://jobmap.co') }}/employers">{!! trans('landing.nav.employers') !!}</a></li>--}}
                    <li class="nav-item align-self-center">{!! trans('landing.nav.lang') !!}</li>
                    <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;" id="show-sign-in" data-toggle="modal" data-target="#signInModal">{!! trans('landing.nav.login') !!}</a></li>
                    <li class="nav-item align-self-center">
                      <a class="btn btn-landing active" href="javascript:;" data-toggle="modal" data-target="#signUpBusinessModal" style="background: #4266ff;">
                        {!! trans('landing.nav.get_started') !!}
                      </a>
                    </li>
                </ul>
                <div class="d-flex">
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
    </nav>
    <!-- MOBILE MENU -->
    <div class="mobile_menu px-3" style="margin-top: 70px;">
        <ul class="navbar-nav justify-content-around" style="flex-direction: column;">
            <li class="nav-item align-self-center"><a class="nav-link" href="{!! url('/') !!}">{!! trans('landing.nav.job_seeker') !!}</a></li>
            <!-- <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;">Academic</a></li> -->
            <li class="nav-item align-self-center"><a class="nav-link" href="{{ config('app.url') }}/employers"  style="font-weight: 500;">{!! trans('landing.nav.employers') !!}</a></li>
            <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;">{!! trans('landing.nav.lang') !!}</a></li>
            <li class="nav-item align-self-center"><a class="nav-link" href="javascript:;" id="show-sign-in" data-toggle="modal" data-target="#signInModal">{!! trans('landing.nav.login') !!}</a></li>
{{--            --}}
{{--            <li class="nav-item align-self-center"><a class="btn btn-landing active mb-3" href="{{ config('app.url') }}/user/signup" style="background: #4266ff;">{!! trans('landing.nav.get_started') !!}</a></li>--}}

            <li class="nav-item align-self-center">
                <a class="btn btn-landing active" href="javascript:;" data-toggle="modal" data-target="#signUpBusinessModal" style="background: #4266ff;">
                    Try JobMap
                </a>
            </li>
        </ul>
    </div>
    <!-- /MOBILE MENU -->
    <!-- NAVBAR -->
