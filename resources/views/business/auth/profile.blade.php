@extends('layouts.main_business')

@section('content')

<div class="row">
	<div id="slide-out" class="col-3">
		@include('components.sidebar.sidebar_business')
	</div>

	<div class="col-8">
		<div class="row">
			<p class="text large bold text-center mt-2">Business Profile</p>
		</div>
	</div>
</div>

<div class="row">
	<div class="divide-line black responsive"></div>
</div>

@endsection