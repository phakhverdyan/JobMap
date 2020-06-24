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

    @if (jwt_is_auth())
        @include('components.navbar.navbar_user')
    @else
        @include('components.navbar.navbar_user_logged_out')
    @endif

	<br /><br />
    @yield('content')

    @include('components.footer.footer_jobmap')

    <!-- Modal -->
    <div class="modal-frame">
        @include('components.modal.contact_form')
        @include('components.modal.reset_password')
        @include('components.modal.sign_up')
        @include('components.modal.sign_in')
      </div>
    <div class="modal-overlay"></div>
    <!-- End Modal -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<script src="{{ asset('/libs/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('/libs/bootstrap4/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/js/modal.js') }}"></script>
	<script src="{{ asset('/js/login_wizard.js') }}"></script>
	<script src="{{ asset('/js/landing-animation.js') }}"></script>
	<script src="{{ asset('/js/jquery-ui.js') }}"></script>
	<script src="{{ asset('/js/jquery.mask.js?v='.time()) }}"></script>
	<script src="{{ asset('/js/phone-mask.js?v='.time()) }}"></script>

</body>
</html>
