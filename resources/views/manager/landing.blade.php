<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>JobMap Landing</title>
	
	<link rel="stylesheet" href="{{ asset('/libs/bootstrap4/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/main.css?v='.time()) }}">
	<link rel="stylesheet" type="text/css" href="{{ asset_no_cache('/manager_assets/css/landing.css') }}">
</head>
<body>
	<div class="main-wrapper">
		<main class="landing-container">
			<p class="landing__jm-logo">
				<img src="{{ asset_no_cache('/manager_assets/img/jm-logo.png') }}">
			</p>
			<h1 class="landing__jm-main-title">JobMap</h1>
			<h3 class="landing__jm-tagline">Increase the productivity of users<br> and businesses.</h3>
			<form class="landing__registration-form">
				<div class="landing__registration-form__block">
					<label>Your email</label>
					<div class="invalid-feedback"></div>
					<input type="email" name="email" data-name="email">
				</div>
				<div class="landing__registration-form__block">
					<label>Your password</label>
					<div class="invalid-feedback"></div>
					<input type="password" name="password" data-name="password">
				</div>
				<div>
					<button class="submit-btn" type="submit">Submit</button>
				</div>
			</form>
		</main>
		<div class="landing__call-with-sales">
			<img src="{{ asset_no_cache('/manager_assets/img/Shape_1.svg') }}" width="100%" class="landing__call-with-sales__bg-shape">
			<div class="landing-container">
				<h3 class="landing__inlimited-title">Unlimited In-Store Candidates</h3>
				<p class="landing__people-with-plant">
					<img src="{{ asset_no_cache('/manager_assets/img/people.png') }}">
				</p>
				<p class="landing__call-with-sales__tagline">Talk with Sales</p>
				<p>
					<button class="landing__call-with-sales__call-btn" type="button">514-917-6357</button>
				</p>
				<p class="landing__call-with-sales__offered">Service offered by JopMap</p>
			</div>
		</div>
	</div>
	<script src="{{ asset_no_cache('/manager_assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<script src="{{ asset_no_cache('/libs/bootstrap4/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/js/notify.min.js') }}"></script>
	<script src="{{ asset_no_cache('/manager_assets/js/main.js') }}"></script>
	<script src="{{ asset_no_cache('/manager_assets/js/landing.js') }}"></script>
</body>
</html>