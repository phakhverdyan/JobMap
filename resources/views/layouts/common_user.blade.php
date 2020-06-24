<!DOCTYPE html>
<html lang="{{ \App::getLocale() }}">
<head>

    <meta charset="utf-8">

    <title>JobMap</title>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    @yield('meta')
    @stack('meta')

    <link rel="shortcut icon" href="/img/jm_favicon.png" type="image/png">
    <link rel="apple-touch-icon" href="/img/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-touch-icon-114x114.png">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#000">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#000">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">

    <link rel="stylesheet" href="{{ asset('/css/main.css?v='.time()) }}">
    <link rel="stylesheet" href="{{ asset('/css/back.css?v='.time()) }}">
    <link rel="stylesheet" href="{{ asset('/css/business_landing.css?v='.time()) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css?' . time()) }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css?' . time()) }}"/>
    @yield('style')

    <script>
        var Langs;
        var defaultLang = '<?php echo \Illuminate\Support\Facades\App::getLocale() ?>';
        @if (auth()->check())
            window.auth = {};
            window.auth.user = JSON.parse(atob('{{ base64_encode(json_encode(auth()->user()->makeVisible(["api_token"])->toArray())) }}'));
        @endif
    </script>
</head>

<body style="background:rgb(244, 247, 250);">
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

@if (jwt_is_auth())
    @include('components.navbar.navbar_business')
@else
    @include('components.navbar.landing_business')
@endif

<br/><br/>
@yield('content')

@include('components.footer.footer_new')

<!-- Modal -->
<div class="modal-frame">
    @include('components.modal.contact_form')
    @include('components.modal.reset_password')

    @include('components.modal.sign_up')
    @include('components.modal.sign_in')
    @include('components.modal.support')

      @include('components.jobmap.modal.sign_up_business')
      @include('components.jobmap.modal.sign_in')

    @include('components.modal.logout')
</div>
<div class="modal-overlay"></div>
<!-- End Modal -->
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
<script src="{{ asset('/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('/libs/bootstrap4/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/notify.min.js') }}"></script>
<script src="{{ asset('/js/modal.js') }}"></script>
<script src="{{ asset('/js/app/user.js?v='.time()) }}"></script>
<script src="{{ asset('/js/app/business.js?v='.time()) }}"></script>
<script src="{{ asset('/js/app/app.js?v='.time()) }}"></script>
<script src="{{ asset('/js/app/main.js?v='.time()) }}"></script>
<script src="{{ asset('/js/business_landing.js?v='.time()) }}"></script>
<script src="{{ asset('/js/business_landing_typing.js?v='.time()) }}"></script>
<script src="{{ asset('/js/app/signup_modal.js?v='.time()) }}"></script>
<script src="{{ asset('/js/login_wizard.js?v='.time()) }}"></script>
<script src="{{ asset('/js/landing-animation.js') }}"></script>
<script src="{{ asset('/js/jquery-ui.js') }}"></script>
<script src="{{ asset('/js/main.js?v='.time()) }}"></script>
<script src="{{ asset('/js/modal.js?v='.time()) }}"></script>
<script src="{{ asset('/js/jobmap/app/signup.js?v='.time()) }}"></script>
<script type="text/javascript" src="{{ asset('/js/jobmap/slick.min.js') }}"></script>
<script src="{{ asset('/js/jquery.mask.js?v='.time()) }}"></script>
<script src="{{ asset('/js/phone-mask.js?v='.time()) }}"></script>
@yield('script')
<script>
    $(function () {
        $("#slider-hours").slider({
            range: true,
            min: 0,
            max: 45,
            values: [15, 30],
            slide: function (event, ui) {
                $("#slider-hours-amount").val("" + ui.values[0] + " - " + ui.values[1] + " HR");
            }
        });
        $("#slider-hours-amount").val("" + $("#slider-hours").slider("values", 0) +
            " - " + $("#slider-hours").slider("values", 1) + " HR");
        $("#slider-hours .ui-widget-header").css('background', '#4266ff');
    });
</script>
<script type="text/javascript">
    $(document).ready(
    function () {
        $('.mobile_hamb').on('click', function () {
            $('.mobile_menu').toggle("slow");
        });
    });

    $(document).ready(function(){
        $('#nav-icon1,#nav-icon2,#nav-icon3,#nav-icon4').click(function(){
            $(this).toggleClass('open');
        });
    });
</script>
</body>
</html>
