<!DOCTYPE html>
<html lang="eng">

<head>

	<meta charset="utf-8">

	<title>Title</title>
	<meta name="description" content="">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<meta property="og:image" content="path/to/image.jpg">
	<link rel="shortcut icon" href="/img/favicon/favicon.ico" type="image/x-icon">
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

	<style>body { opacity: 0; overflow-x: hidden; } html { background-color: #fff; }</style>

</head>

<body style="background: #F4F7FA;">

    @include('components.navbar.navbar_user')

    @yield('content')

    
    <!-- Modal -->
    <div class="modal-frame">
        
        @include('components.modal.contact_form')
        
        @include('components.modal.reset_password')

        @include('components.modal.sign_up')
		@include('components.modal.user_first_time')

        @include('components.modal.sign_in')

      </div>
    <div class="modal-overlay"></div>
    <!-- End Mdal -->

  	<link   rel="stylesheet" href="{{ asset('/ui/app/css/main.min.css') }}">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="{{ asset('/js/jquery-ui.js') }}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3mcG8oAZzzlCSGZt5B4u5h5LmBX1SgjE"></script>
	<script src="{{ asset('/ui/app/js/scripts.min.js') }}"></script>
	<script src="{{ asset('/js/app/signup.js?v='.time()) }}"></script>
</body>
</html>
