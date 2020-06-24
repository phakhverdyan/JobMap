@extends('layouts.common_user')

@section('content')
    
    <div class="container mt-2 text-center">
		<p class="text large bold text-center mt-2">Landing for employers</p>
	</div>
	
	<div class="row">
		<div class="divide-line black responsive"></div>
	</div>

    @include('components.call_to_action')
    @include('components.keep_in_touch')

@endsection