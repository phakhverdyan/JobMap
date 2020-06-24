@extends('layouts.main_business')

@section('content')

	<div class="row">

		<div id="slide-out" class="col-3 sidebar_adaptive">
            @include('components.sidebar.sidebar_business')
		</div>

		<div class="container text-center content-main">
			<p class="text large bold text-center mt-2">Account users</p>
			<p class="text-center mt-2">
				<a class="text middle" href="{!! url('/business/profile/edit') !!}">Edit profile</a>
			</p>
		</div>


	</div>

	<div class="row">
		<div class="divide-line black responsive"></div>
	</div>

@endsection