<!DOCTYPE html>
<html lang="{{ \App::getLocale() }}">
<head>

  <meta charset="utf-8">

  <title>JobMap</title>
  <meta name="description" content="">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <meta property="og:image" content="path/to/image.jpg">
  @yield('meta')
  @stack('meta')

  <link rel="shortcut icon" href="img/jm_favicon.png" type="image/png">
  <link rel="apple-touch-icon" href="img/favicon/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-touch-icon-114x114.png">
  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Chrome, Firefox OS and Opera -->
  <meta name="theme-color" content="#000">
  <!-- Windows Phone -->
  <meta name="msapplication-navbutton-color" content="#000">
  <!-- iOS Safari -->
  <meta name="apple-mobile-web-app-status-bar-style" content="#000">

  <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css?' . time()) }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css?' . time()) }}"/>

  <link rel="stylesheet" href="{{ asset('/css/main.css?' . time()) }}">
  <link href="{{ asset('/css/business_landing.css?' . time()) }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('/css/cropper.min.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('/css/cssgram.min.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('/css/back.css?' . time()) }}" rel="stylesheet" type="text/css"/>
  {{-- <link href="{{ asset('/css/landing.css?' . time()) }}" rel="stylesheet" type="text/css"/> --}}
  @yield('style')

</head>
<body>
<div class="main-wrapper" id="main-wrapper" data-anchor="main-wrapper">
    @if (jwt_is_auth())
        @include('components.navbar.navbar_business')
    @else
        @include('components.navbar.landing_business')
    @endif

    @yield('content')

    {{-- <footer>
      <div class="container footer_grey py-4">
        <div class="d-flex flex-wrap flex-md-row flex-column">

          <div class="col-lg-3 col-md-3 mb-3 mb-lg-0">
            <a href="javascript:;" class="d-flex">
                <img src="{{ asset('img/jm_logo.png') }}" class="align-self-center" width="45px">
                <p class="mb-0 logo_title align-self-center ml-3">JobMap</p>
            </a>
          </div>
          <div class="col-lg-3 col-md-3 mb-3 mb-lg-0">
            <h3 class="mb-3 h6"><strong>{!! trans('landing.new.footer.title_1') !!}</strong></h3>
            <p class="mb-1"><a href="/about">{!! trans('main.footer.general.about') !!}</a></p>
            <p class="mb-1"><a href="#">{!! trans('main.footer.general.contact') !!}</a></p>
            <p class="mb-1"><a href="/faq">{!! trans('main.footer.general.general_faq') !!}</a></p>
            <p class="mb-1"><a href="/sitemap">{!! trans('main.footer.general.site_map') !!}</a></p>
            <p class="mb-1"><a href="javascript:;" id="show-sign-in" data-toggle="modal" data-target="#signInModal">{!! trans('main.footer.employers.login') !!}</a></p>
          </div>

          <div class="col-lg-3 col-md-3 mb-3 mb-lg-0">
            <h3 class="mb-3 h6"><strong>{!! trans('landing.new.footer.title_2') !!}</strong></h3>
            <p class="mb-1"><a href="javascript:;" class="jobmap__signup">{!! trans('main.footer.job_seekers.create_resume') !!}</a></p>
            <p class="mb-1"><a href="{!! url('/map') !!}">{!! trans('main.footer.job_seekers.explore_jobs') !!}</a></p>
            <p class="mb-1"><a href="{!! url('/career-with-us') !!}">{!! trans('landing.button.a_career_with_us') !!}</a></p>
          </div>

          <div class="col-lg-3 col-md-3 mb-3 mb-lg-0">
            <h3 class="mb-3 h6"><strong>{!! trans('landing.new.footer.title_3') !!}</strong></h3>
            <p class="mb-1"><a href="javascript:;" class="jobmap__signup">{!! trans('main.footer.employers.create_account') !!}</a></p>
            <p class="mb-1"><a href="{!! url('/pricing') !!}">{!! trans('main.footer.employers.pricing') !!}</a></p>
          </div>

        </div>
      </div>
      <hr>
      <div class="container pb-3">
        <div class="d-flex justify-content-between flex-lg-row flex-column">

          <div class="align-self-center d-flex flex-lg-row flex-column">

            <div class="align-self-center mr-lg-4 mb-2 mb-lg-0">
              <select class="form-control border-0">
                <option>Languages</option>
              </select>
            </div>

            <div class="align-self-center mr-lg-4 mb-2 mb-lg-0">
              <a href="#">Terms & Privacy</a>
            </div>

            <div class="align-self-center mr-lg-4 mb-2 mb-lg-0" style="opacity: 0.7;">
              2019 JobMap ®
            </div>

            <div class="align-self-center">
              <a href="tel:+18442441447">1-844-244-1447</a>
            </div>


          </div>

          <div class="align-self-center mt-3 mt-lg-0">
            <a href="#" class="mx-2">
                @svg('/img/social/arroba.svg', [
                 'width' => '35px',
                 'height' => '35px',
                 'style' => 'fill: #45456c;',
                ])
            </a>
            <a href="#" class="mx-2">
               @svg('/img/social/instagram.svg', [
                 'width' => '35px',
                 'height' => '35px',
                 'style' => 'fill: #45456c;',
                ])
            </a>
            <a href="#" class="mx-2">
              @svg('/img/social/facebook-circle.svg', [
                 'width' => '35px',
                 'height' => '35px',
                 'style' => 'fill: #45456c;',
                ])
            </a>
            <a href="#" class="mx-2">
              @svg('/img/social/linkedin.svg', [
                 'width' => '35px',
                 'height' => '35px',
                 'style' => 'fill: #45456c;',
                ])
            </a>
            <a href="#" class="mx-2">
              @svg('/img/social/youtube-logo2.svg', [
                 'width' => '35px',
                 'height' => '35px',
                 'style' => 'fill: #45456c;',
                ])
            </a>
          </div>

        </div>
      </div>
    </footer> --}}
    @include('components.jobmap.footer.footer_new')
  @include('components.jobmap.modal.sign_up_business')
  @include('components.jobmap.modal.sign_in')

</div>

<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '{!! config('services.facebook.client_id') !!}',
            cookie: true,
            xfbml: true,
            version: 'v2.12'
        });

        FB.AppEvents.logPageView();
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script async defer src="https://apis.google.com/js/api.js" onload="this.onload=function(){};HandleGoogleApiLibrary()" onreadystatechange="if (this.readyState === 'complete') this.onload()"></script>
<script>
    function HandleGoogleApiLibrary() {
        // Load "client" & "auth2" libraries
        gapi.load('client:auth2',  {
            callback: function() {
                // Initialize client & auth libraries
                gapi.client.init({
                    apiKey: '{!! config('services.google.client_secret') !!}',
                    clientId: '{!! config('services.google.client_id') !!}',
                    scope: 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me'
                }).then(
                    function(success) {
                        // Libraries are initialized successfully
                        // You can now make API calls
                    },
                    function(error) {
                        // Error occurred
                        // console.log(error) to find the reason
                    }
                );
            },
            onerror: function() {
                // Failed to load libraries
            }
        });
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.0/socket.io.js"></script>
<script src="{{ asset('/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('/js/jobmap/moment.js') }}"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>
<script src="{{ asset('/libs/bootstrap4/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/jobmap/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jobmap/slick.min.js') }}"></script>
<script src="{{ asset('/js/jobmap/notify.min.js') }}"></script>

<script src="{{ asset('/js/app/main.js?v='.time()) }}"></script>
<script src="{{ asset('/js/jobmap/app/app.js?v='.time()) }}"></script>
<script src="{{ asset('/js/jobmap/app/realtime.js?' . time()) }}"></script>
<script src="{{ asset('/js/jobmap/app/user.js?v='.time()) }}"></script>
<script src="{{ asset('/js/jobmap/app/send-resume.js?v='.time()) }}"></script>
<script src="{{ asset('/js/jobmap/app/signup.js?v='.time()) }}"></script>
<script src="{{ asset('/js/jobmap/bob.js?v='.time()) }}"></script>
<script src="{{ asset('/js/jquery.mask.js?v='.time()) }}"></script>
<script src="{{ asset('/js/phone-mask.js?v='.time()) }}"></script>
@yield('script')

</body>
</html>
