<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="UTF-8">
		<title>{{ $business->localized_name }}</title>
	</head>
	<body style="background: #ffffff; font-family: Arial; margin: 0;">
		<div class="content" style="width: 100%; margin: 200px auto; background-color: #ffffff;">
			<div class="jm-w" style="position: relative; min-height: 200px;">
				<div class="jm-w__loader" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
					<img src="{{ asset('/img/widget_loading.gif') }}" alt="">
				</div>
				<!-- <script async src="http://jobmap.dv/widget.1.js"></script> -->
				<script async src="{{ asset('/widget.' . $id . '.js') }}"></script>
			</div>
		</div>
	</body>
</html>