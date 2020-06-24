<!DOCTYPE html>
<html lang="{{ \App::getLocale() }}">
<head>

    <meta charset="utf-8">

    <title>JobMap</title>
    <meta name="description" content="">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta property="og:image" content="path/to/image.jpg">


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

    <link rel="stylesheet" href="{{ asset('/css/main.css?v='.time()) }}">
    <link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/cropper.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/cssgram.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/back.css?v='.time()) }}" rel="stylesheet" type="text/css"/>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />


</head>

<body style="background: #fff;">

@include('components.jobmap.navbar.navbar_user')
<br/><br/>
@yield('content')
@include('components.jobmap.chat.mini-chat-content')

<!-- Modal -->
<div class="modal-frame">

    @include('components.jobmap.modal.contact_form')

    @include('components.jobmap.modal.reset_password')

    @include('components.jobmap.modal.sign_up')
    @include('components.jobmap.modal.user_first_time')

    @include('components.jobmap.modal.sign_in')

    @include('components.jobmap.modal.logout')
    @include('components.jobmap.modal.resume_sended')
    @include('components.jobmap.modal.send_login')

</div>
<div class="modal-overlay"></div>
<!-- End Modal -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.0/socket.io.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
<script src="{{ asset('/libs/jquery/dist/jquery.min.js') }}"></script>
<script>
    window.Langs = {!! json_encode(get_language_array()) !!};
    localStorage.setItem('language', '<?php echo \Illuminate\Support\Facades\App::getLocale() ?>');
</script>
<script src="{{ asset('/libs/bootstrap4/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/jobmap/notify.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="{{ asset('/js/jobmap/jquery-ui.js') }}"></script>
<script src="{{ asset('/js/main.js?v='.time()) }}"></script>
<script>var jt = "{{ request()->cookie('jt') }}";</script>
<script src="{{ asset('/js/app/main.js?v='.time()) }}"></script>
<script src="{{ asset('/js/jobmap/app/user.js?v='.time()) }}"></script>
{{--<script src="{{ asset('/js/jobmap/app/business.js?v='.time()) }}"></script>--}}
<script src="{{ asset('/js/jobmap/app/app.js?v='.time()) }}"></script>
<script src="{{ asset('/js/jobmap/app/realtime.js?' . time()) }}"></script>
<script src="{{ asset('/js/jobmap/app/send-resume.js?v='.time()) }}"></script>
<script src="{{ asset('/js/jobmap/app/signup.js?v='.time()) }}"></script>
<script src="{{ asset('/js/jquery.mask.js?v='.time()) }}"></script>
<script src="{{ asset('/js/phone-mask.js?v='.time()) }}"></script>
@yield('script')
<script src="{{ asset('/js/jobmap/landing-animation.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

</body>
</html>
