<nav class="navbar navbar-light cr-navbar">
    <a class="navbar-brand py-0" href="#">
        <img src="{{ asset('img/cr-white-small-logo.png') }}" height="31" class="d-inline-block" alt="">
        <span class="logo-text" style="vertical-align: middle;">CloudResume</span>
    </a>
    <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex cr-nav-items" style="height: 40px;vertical-align: middle;box-sizing: border-box; padding-top: 10px;">
        <li class="nav-item d-md-block d-none align-self-end">
            {!! trans('landing.nav.lang') !!}
        </li>
        <li class="nav-item">
            <a class="cr-nav-text" href="{!! url('/business-landing') !!}" id="show-sign-in">{!! trans('landing.nav.employers') !!}</a>
        </li>
        <li class="nav-item">
            <a class="cr-nav-text" href="#" id="show-sign-in">Login</a>
        </li>
        <li class="nav-item">
            <a class="cr-nav-button" href="/user/signup" style="margin-top: -5px; background: #4266ff; border:1px solid #4266ff;">Get Started</a>
        </li>
    </ul>
</nav>