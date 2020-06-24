<!DOCTYPE html>
<html lang="{{ \App::getLocale() }}">
<head>
	<meta charset="utf-8">
	<title>JobMap</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    @yield('meta')
    @stack('meta')

	<link rel="shortcut icon" href="img/jm_favicon.png" type="image/png">
	<link rel="apple-touch-icon" href="img/favicon/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-touch-icon-114x114.png">

	<!-- font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#000">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#000">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#000">
    <!-- Verify Google -->
    <meta name="google-site-verification" content="{{ env('GOOGLE_SITE_VERIFICATION', '') }}" />

	<link rel="stylesheet" href="{{ asset('/css/main.css?' . time()) }}">
	<link href="{{ asset('/css/cssgram.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('/css/back.css?' . time()) }}">
	<link rel="stylesheet" href="{{ asset('/css/app/chat.css?' . time()) }}">
	@yield('style')
</head>
<body style="background: #fff;">
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
        @include('components.jobmap.navbar.navbar_business')
    @else
        @include('components.jobmap.navbar.navbar_user_logged_out')
    @endif

	<br /><br />
    @yield('content')
    @include('components.jobmap.chat.mini-chat-content')
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

		@include('components.jobmap.modal.logout')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.0/socket.io.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
	<script src="{{ asset('/libs/jquery/dist/jquery.min.js') }}"></script>
	<script>
        window.Langs = {!! json_encode(get_language_array()) !!};
        localStorage.setItem('language', '<?php echo \Illuminate\Support\Facades\App::getLocale() ?>');
	</script>
    <script src="{{ asset('/js/jobmap/moment.js') }}"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>
	<script src="{{ asset('/libs/bootstrap4/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/libs/card-js/card-js.min.js') }}"></script>
    <script src="{{ asset('/js/jobmap/bob.js') }}"></script>
    <script>var jt = "{{ request()->cookie('jt') }}";</script>
	<script src="{{ asset('/js/jobmap/notify.min.js') }}"></script>
	<script src="{{ asset('/js/jobmap/modal.js') }}"></script>
    <script src="{{ asset('/js/cv_widget.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/jobmap/jack.js') }}"></script>
	<script src="{{ asset('/js/jobmap/wow.min.js') }}"></script>
	<script src="{{ asset('/js/jobmap/app/user.js?v='.time()) }}"></script>
	{{-- <script src="{{ asset('/js/jobmap/app/business.js?v='.time()) }}"></script> --}}
	<script src="{{ asset('/js/jobmap/app/app.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/jobmap/app/realtime.js?' . time()) }}"></script>
    <script src="{{ asset('/js/jobmap/ejs.min.js') }}"></script>
    <script src="{{ asset('/js/jobmap/app/timeago.js?' . time()) }}"></script>
    <script src="{{ asset('/js/jobmap/app/chat.js?' . time()) }}"></script>
	<script src="{{ asset('/js/app/main.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/jobmap/app/send-resume.js?v='.time()) }}"></script>
    {{--<script src="{{ asset('/js/jobmap/app/signup.js?v='.time()) }}"></script>--}}
    {{--<script src="{{ asset('/js/jobmap/login_wizard.js?v='.time()) }}"></script>--}}
	<script src="{{ asset('/js/jobmap/landing-animation.js') }}"></script>
	<script src="{{ asset('/js/jobmap/jquery-ui.js') }}"></script>
	<script src="{{ asset('/js/jobmap/app/signup.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/main.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/jquery.mask.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/phone-mask.js?v='.time()) }}"></script>
	@yield('script')
    @stack('scripts')
	<script>
      new WOW().init();
    </script>
    <script type="text/javascript">
    	$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		});
    </script>

    <script type="text/javascript">
        $(document).ready(
        function(){
            $('.open_close_category').click(function(){
                $(this).next('div').slideToggle();
                $(this).find("span.plus_icon").toggleClass('collapsed');
                return false;
            });
        });
    </script>
    @stack('ejs-templates')
    @include('components.jobmap.chat.chat-ejs-templates')
</body>
</html>
