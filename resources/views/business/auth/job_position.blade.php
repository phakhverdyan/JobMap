@extends('layouts.main_business')

@section('content')

    <div class="row">
		<div id="slide-out" class="col-3 sidebar_adaptive">
            @include('components.sidebar.sidebar_business')
		</div>

		<div class="col-8 content-main">
			<div class="row">
				<p class="text large bold text-center mt-2">Job Positions</p>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="divide-line black responsive"></div>
	</div>

@endsection