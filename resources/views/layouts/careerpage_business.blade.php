<!DOCTYPE html>
<html lang="{{ \App::getLocale() }}">
<head>
    <meta charset="utf-8">

    <title>JobMap</title>
    <meta name="description" content="">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <meta property="og:image" content="path/to/image.jpg">
    <link rel="shortcut icon" href="/img/jm_favicon.png" type="image/png">
    <link rel="apple-touch-icon" href="/img/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-touch-icon-114x114.png">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#000">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#000">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">

    <link rel="stylesheet" href="{{ asset('/css/main.css?v='.time()) }}">
    <link href="{{ asset('/libs/card-js/card-js.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/cropper.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/cssgram.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/s.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/back.css?v='.time()) }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app/chat.css?' . time()) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css">
    @yield('style')
    @stack('styles')
    <script>
        var Langs;
        var defaultLang = '<?php echo \Illuminate\Support\Facades\App::getLocale() ?>';
        @if (auth()->check())
            window.auth = {};
            window.auth.user = JSON.parse(atob('{{ base64_encode(json_encode(auth()->user()->makeVisible(["api_token"])->toArray())) }}'));
        @endif
    </script>
</head>
<body style="background: #f7f7f9;">
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

    {{-- @include('components.navbar.navbar_business_careerpage')
    @include('components.navbar.navbar_user_logged_out') --}}

    @if (jwt_is_auth())
        @include('components.navbar.navbar_business_careerpage')
    @else
        @include('components.navbar.navbar_user_logged_out')
    @endif

    @yield('content')

    <!-- Modal -->
    <div class="modal-frame">
        @include('components.modal.contact_form')
        {{--@include('components.modal.reset_password')--}}
        {{--@include('components.modal.sign_up')--}}
        {{--@include('components.modal.sign_in')--}}
        @include('components.footer.footer_user')
        @include('components.modal.logout')
    </div>
    <div class="modal-overlay"></div>
    <!-- End Modal -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.0/socket.io.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
    <script src="{{ asset('/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>
    <script src="{{ asset('/libs/bootstrap4/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('/js/landing-animation.js') }}"></script>
    <script src="{{ asset('/libs/card-js/card-js.min.js') }}"></script>
    <script src="{{ asset('/js/jack.js') }}"></script>
    <script src="{{ asset('/js/notify.min.js') }}"></script>
    <script src="{{ asset('/js/bob.js') }}"></script>
    <script src="{{ asset('/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('/js/moment.js') }}"></script>
    <script src="{{ asset('/js/tempusdominus-bootstrap-4.min.js') }}"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>--}}
    <script src="{{ asset('/js/modal.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/main.js?v='.time()) }}"></script>
    <script>var jt = "{{ request()->cookie('jt') }}";</script>
    <script src="{{ asset('/js/app/main.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/cv_widget.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/user.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/business.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/app.js?v='.time()) }}"></script>
    {{--<script src="{{ asset('/js/app/cookielistener.js?v='.time()) }}"></script>--}}
    <script src="{{ asset('/js/app/signup.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/s.min.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/realtime.js?' . time()) }}"></script>
<script src="{{ asset('/js/jquery.mask.js?v='.time()) }}"></script>
<script src="{{ asset('/js/phone-mask.js?v='.time()) }}"></script>
    @yield('script')
    @stack('scripts')
    <script src="{{ asset('/js/ejs.min.js') }}"></script>
    <script src="{{ asset('/js/app/timeago.js?' . time()) }}"></script>
    <script src="{{ asset('/js/app/chat.js?' . time()) }}"></script>

    @stack('ejs-templates')
</body>
</html>
