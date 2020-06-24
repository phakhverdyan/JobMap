@extends('layouts.main_business')

@section('content')

	<div class="row">

		<div id="slide-out" class="col-3 sidebar_adaptive">
            @include('components.sidebar.sidebar_business')
		</div>

		<div class="col-8 content-main">
			<div class="row text-center">
				<p class="text large bold mt-2">Candidate list</p>
				<p><a href="{!! url('/business/candidate/profile') !!}">candidate profile</a></p>
			</div>
		</div>

	</div>
	
	<div class="row">
		<div class="divide-line black responsive"></div>
	</div>

@endsection