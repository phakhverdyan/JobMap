@extends('layouts.common_landing')

@section('content')

	@php($active = 'director')
	@php($child = "teacher's")
	@php($token = md5(str_random(24)))
	@php($routeName = 'landing.' . $active . '-inside')

	@include('common.academy.form')

@endsection
@section('script')
	<script src="{{ asset('/js/app/signup-user.js?v='.time()) }}"></script>
	<script src="{{ asset('/js/wow.min.js?v='.time()) }}"></script>
	<script>
        new WOW().init();
	</script>
@endsection