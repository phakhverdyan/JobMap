@extends('layouts.jobmap.common_user')

@section('content')
    
    <div class="container mt-2 text-center">
		<p class="text large bold text-center mt-2">How it works together</p>
	</div>
	
	<div class="row">
		<div class="divide-line black responsive"></div>
	</div>

    @include('components.jobmap.call_to_action')
    @include('components.jobmap.keep_in_touch')

@endsection
