<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta charset="UTF-8">
		<title>ResumeUploader</title>
		<style>
			body {
				background-color: #ffffff;
				padding: 0;
				margin: 0;
				border: 0;
			}

			.container {
				background-color: red;
				width: 540px;
				height: 200px;
			}

			.widget {
				bottom: 50px !important;
			}

			.widget_open {
				background-color: #eeeeee !important;
				border-color: #cccccc !important;
				color: #000000 !important;
			}

			.widget_open:focus {
				box-shadow: 0 0 0 0.2rem rgba(204, 204, 204, 0.5) !important;
			}
		</style>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Google+Sans">
		<link rel="stylesheet" href="{{ asset('/css/main.css?' . time()) }}">
		<link rel="stylesheet" href="{{ asset('/css/back.css?' . time()) }}">
		<link rel="stylesheet" href="{{ asset('/css/cv_widget.css?' . time()) }}">
	</head>
	<body style="background-color: transparent;">
		@include('components.widget.cv_widget', [
			'is_iframe' => true,
		])

		<script src="{{ asset('/libs/jquery/dist/jquery.min.js') }}"></script>
		<script src="{{ asset('/js/jobmap/jquery-ui.js') }}"></script>
		<script src="{{ asset('/js/jobmap/notify.min.js') }}"></script>
		<script src="{{ asset('/js/app/main.js') }}"></script>
		<script src="{{ asset('/js/cv_widget.js?' . time()) }}"></script>
	</body>
</html>