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
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#000">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#000">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">


    <link rel="stylesheet" href="{{ asset('/css/main.css?v='.time()) }}">
    <!-- <link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet" type="text/css"/> -->
    <link href="{{ asset('/css/cropper.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/cssgram.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/s.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/back.css?v='.time()) }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app/chat.css?' . time()) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ asset('/css/tempusdominus-bootstrap-4.css?' . time()) }}">
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
<body style="background:rgb(244, 247, 250);">
    @include('components.navbar.navbar_user')
    <br>
    <br>
    @yield('content')

    @includeWhen(jwt_is_auth() === false, 'components.widget.cv_widget')

    @include('components.chat.mini-chat-content')
    @include('components.modal.interview_request_modal')
    @include('components.modal.new_chat_message_modal')
    @include('components.modal.user_first_time')

    <!-- Modal -->
    <div class="modal-frame">
        @include('components.modal.contact_form')
        @include('components.modal.reset_password')
        @include('components.modal.sign_up')
        @include('components.modal.sign_in')
        @include('components.modal.cropped_modal')
        @include('components.modal.logout')
        @include('components.modal.verification')
        @include('components.modal.confirm_continue')
        @include('components.modal.support')
        @include('components.modal.error_image')
        @include('components.modal.send_my_user_profile')
    </div>
    <div class="modal-overlay"></div>
    <!-- End Modal -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.0/socket.io.js"></script>
    <script src="{{ asset('/libs/jquery/dist/jquery.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>
    <script src="{{ asset('/libs/bootstrap4/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/notify.min.js') }}"></script>
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script> -->
    <script src="{{ asset('/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('/js/moment.js') }}"></script>
    <script src="{{ asset('/js/tempusdominus-bootstrap-4.min.js') }}"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>--}}

    <script src="{{ asset('/js/sidenav.js?v='.time()) }}"></script>

    <script src="{{ asset('/js/main.js?v='.time()) }}"></script>
    <script>var jt = "{{ request()->cookie('jt') }}";</script>
    <script src="{{ asset('/js/app/main.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/user.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/business.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/app.js?v='.time()) }}"></script>
    {{-- <script src="{{ asset('/js/app/cookielistener.js?v='.time()) }}"></script> --}}
    <script src="{{ asset('/js/app/realtime.js?' . time()) }}"></script>
    @yield('script')
    @stack('scripts')
    <script src="{{ asset('/js/ejs.min.js') }}"></script>
    <script src="{{ asset('/js/app/timeago.js?' . time()) }}"></script>
    <script src="{{ asset('/js/app/chat.js?' . time()) }}"></script>
    <script src="{{ asset('/js/app/interview-requests.js?' . time()) }}"></script>

    <script src="{{ asset('/js/landing-animation.js') }}"></script>
    <script src="{{ asset('/js/s.min.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/jquery.mask.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/phone-mask.js?v='.time()) }}"></script>
    @stack('ejs-templates')
    @include('components.chat.chat-ejs-templates')
</body>
</html>
