@extends('layouts.main_user')

@section('content')

    <div class="container mt-3 text-center">
		<p class="text large bold text-center mt-2">Congrats_cta</p>
		<p class="text-center">
			<a href="{!! url('/user/dashboard'); !!}">Dashboard</a><br />
			<a href="{!! url('/user/messages'); !!}">Messanger</a>
		</p>
	</div>
	
	<div class="row">
		<div class="divide-line black responsive"></div>
	</div>

    @include('components.call_to_action')

    @include('components.keep_in_touch')


@endsection