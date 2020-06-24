@extends('emails.en.layouts.main')

@section('body')
	{{ $user->full_name }},

	{{ $business_creator->full_name }} wants you to become a manager
	on JobMap with {{ $business->name }}. 
	
	Please confirm your account information here:
	<a href="{{ config('app.url') }}/user/signup?i={{ $user->invite_token }}">{{ config('app.url') }}/user/signup?i={{ $user->invite_token }}</a>

@endsection