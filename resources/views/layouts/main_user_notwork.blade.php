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
    <!-- <link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet" type="text/css"/> -->
    <link href="{{ asset('/css/cropper.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/cssgram.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/s.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/back.css?v='.time()) }}" rel="stylesheet" type="text/css">
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
<body style="background: rgb(244, 247, 250);">
    <nav class="navbar navbar-fixed-top navbar-expand-md navbar-light cr-navbar">
        <a class="navbar-brand py-0" href="{!! url('/user/dashboard') !!}">
            <img src="{{ asset('img/cr-white-small-logo.png') }}" height="31" class="d-inline-block" alt="">
            <span class="logo-text" style="vertical-align: middle;">CloudResume</span>
        </a>
        <div style="background-color: #07357c; width: 1px; height: 55px;"></div>
        <div class="justify-content-center mr-2 ml-auto">

            <div class="thumbnail thumbnail-user avatar" id="user-navbar">
                <div class="current-lang avatar rounded" style="overflow: hidden;">
                    <img src="{{ asset('img/profilepic2.png') }}" class="userpic rounded">
                </div>
                <div>
                    <ul class="fade-fast user-fade-fast" style="height: 50vh;">
                        <a href="javascript:;">
                            <li>
                                <div class="text-center rounded" style="position: relative;width: 100px;margin-left: -50px;left: 50%; overflow: hidden;">
                                    <img class="user-image userpic rounded" style="width: 100px" src="{{ asset('img/profilepic2.png') }}">
                                </div>
                            </li>
                        </a>
                        <a href="#">
                            <li>
                                <legend class="text-center" id="user-username" style="font-family: sans-regular;">Mark</legend>
                            </li>
                        </a>
                        <div class="divide-line thumbnail-divide responsive mt-top-4"></div>
                        <div class="divide-line thumbnail-divide responsive mt-2"></div>
                        <a href="#">
                            <li>
                                <p class="text fs-16 clear-padding text-center" data-toggle="modal"
                                   data-target="#logoutModal"><strong>{!! trans('modals.logout') !!}</strong></p>
                            </li>
                        </a>
                        <li class="no-hover">
                            <a style="width: 100%; margin-left: 0;">
                                <img src="{{ asset('img/C_logo_white.png') }}"  height="60" style="
                        display: block;
                        text-align: center;
                        margin: auto;
                        margin-top: 50px;
                        box-shadow: none;
                        max-width: 100%;
                    "/>
                                <span style="
                        display: block;
                        text-align: center;
                        opacity: 0.3;
                        line-height: 15px;
                        font-size: 13px;
                        margin: 10px 0;
                        font-weight: bold;
                    ">Updated</span>
                                <span style="
                        display: block;
                        text-align: center;
                        opacity: 0.3;
                        margin-bottom: 30px;
                        line-height: 15px;
                        font-size: 13px;
                    ">11.12.2017</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Modal -->
    <div class="modal-frame">
        @include('components.modal.logout')
        @include('components.modal.verification')
    </div>
    <div class="modal-overlay"></div>
    <!-- End Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.0/socket.io.js"></script>
    <script src="{{ asset('/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap4/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/notify.min.js') }}"></script>
    <script src="{{ asset('/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('/js/main.js?v='.time()) }}"></script>
    <script>var jt = "{{ request()->cookie('jt') }}";</script>
    <script src="{{ asset('/js/app/main.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/user.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/business.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/app.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/cookielistener.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/realtime.js?' . time()) }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
    <script src="{{ asset('/js/ejs.min.js') }}"></script>
    <script src="{{ asset('/js/app/timeago.js?' . time()) }}"></script>
    <script src="{{ asset('/js/app/chat.js?' . time()) }}"></script>

    <script src="{{ asset('/js/landing-animation.js') }}"></script>
    <script src="{{ asset('/js/s.min.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/jquery.mask.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/phone-mask.js?v='.time()) }}"></script>
</body>
</html>
