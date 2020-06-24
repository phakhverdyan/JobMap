<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>JobMap Landing</title>
	
	<link rel="stylesheet" href="{{ asset('/libs/bootstrap4/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset_no_cache('/manager_assets/css/applicants.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset_no_cache('/manager_assets/css/common.css') }}">
	
	@stack('styles')
	@yield('head')
</head>
<body>
	@yield('body')
	
	<script>
		window.user = JSON.parse(atob('{{ base64_encode(json_encode($user->makeVisible(["api_token"])->toArray())) }}'));
		window.business = JSON.parse(atob('{{ base64_encode(json_encode($business->toArray())) }}'));
		window.dashboard = {};
	</script>
	
	@stack('ejs-templates')
	
	<script src="{{ asset_no_cache('/manager_assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<script src="{{ asset_no_cache('/libs/bootstrap4/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset_no_cache('/manager_assets/js/vendor/ejs.min.js') }}"></script>
	<script src="{{ asset('/manager_assets/js/vendor/notify.min.js') }}"></script>
	<script src="{{ asset('/js/moment.js') }}"></script>
	<script src="{{ asset_no_cache('/manager_assets/js/main.js') }}"></script>
	<script src="{{ asset_no_cache('/manager_assets/js/dashboard.js') }}"></script>
	<script src="{{ asset_no_cache('/manager_assets/js/applicant-additional-info-toggle.js') }}"></script>
	<script src="{{ asset_no_cache('/manager_assets/js/sidebar-toggle.js') }}"></script>
</body>
</html>