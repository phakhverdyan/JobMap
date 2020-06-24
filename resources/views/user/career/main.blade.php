@extends('layouts.main_user')

@section('content')

    <div class="row">
		<div class="col-3">
            @include('components.sidebar.sidebar_user')
		</div>

		<div class="col-8 mt-3">
			<div class="row">
				<p class="text large bold text-center mt-2">Career</p>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="divide-line black responsive"></div>
	</div>

@endsection