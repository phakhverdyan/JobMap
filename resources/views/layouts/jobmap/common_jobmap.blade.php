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

	<link href="{{ asset('/css/cssgram.min.css') }}" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="{{ asset('/css/main.css?' . time()) }}">

</head>

<body style="background: #fff">

    @if (jwt_is_auth())
        @include('components.jobmap.navbar.navbar_business')
    @else
        @include('components.jobmap.navbar.navbar_user_logged_out')
    @endif

	<br /><br />
    @yield('content')

    @include('components.jobmap.footer.footer_new')

    <!-- Modal -->
    <div class="modal-frame">
        @include('components.jobmap.modal.contact_form')
        @include('components.jobmap.modal.reset_password')
        @include('components.jobmap.modal.sign_up')
		@include('components.jobmap.modal.user_first_time')
        @include('components.jobmap.modal.sign_in')
		@include('components.jobmap.modal.resume_sended')
		@include('components.jobmap.modal.send_login')
      </div>
    <div class="modal-overlay"></div>
    <!-- End Modal -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<script src="{{ asset('/libs/jquery/dist/jquery.min.js') }}"></script>
	<script>
	    window.Langs = {!! json_encode(get_language_array()) !!};
		localStorage.setItem('language', '<?php echo \Illuminate\Support\Facades\App::getLocale() ?>');
	</script>
	<script src="{{ asset('/libs/bootstrap4/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/js/jobmap/modal.js') }}"></script>
	<script src="{{ asset('/js/jobmap/login_wizard.js') }}"></script>
	<script src="{{ asset('/js/jobmap/landing-animation.js') }}"></script>
	<script src="{{ asset('/js/jobmap/jquery-ui.js') }}"></script>
	<script src="{{ asset('/js/jobmap/app/signup.js?v='.time()) }}"></script>
	<script src="{{ asset('/js/jquery.mask.js?v='.time()) }}"></script>
	<script src="{{ asset('/js/phone-mask.js?v='.time()) }}"></script>


</body>
</html>
