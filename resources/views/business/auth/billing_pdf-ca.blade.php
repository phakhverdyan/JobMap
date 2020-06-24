@extends('layouts.main_business')

@section('content')

	{{--//TODO Need change layout--}}

	<style>
		body {
			background: #ffffff !important;
		}
		.navbar {
			display: none;
		}
	</style>


	<div class="container">
		<div class="row mb-5 pb-5">
			<div class="col-12 pb-5 mx-auto js-invoice">

			</div>
		</div>
		<div class="row mt-5">
			<div class="col-12 mx-auto my-5 py-5">
				<strong class="mb-3">Terms and conditions</strong>
				<p class="mb-3">
					All prices are shown in USD.
					This amount is recurring and will be charged on your account next month. <br>
					If you have any questions regarding this receipt, contact us at: 1-877-181-1919 or by email at: <br>
					<a href="#" class="mb-2">financial@jobmap.co</a>
				</p>
				<p class="mb-3">Always a pleasure to serve you in your quest to find the perfect candidate!<br>
					Thank you
				</p>
				<p>The CloudResume team</p>
			</div>
		</div>
	</div>

@endsection
@section('script')
	<script src="{{ asset('/js/app/business-invoice.js?v='.time()) }}"></script>
@endsection