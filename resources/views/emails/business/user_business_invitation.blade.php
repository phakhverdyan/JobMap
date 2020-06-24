@extends('emails.en.layouts.main')

@section('body')
	Hi,

	This is {{ $business->name }} and we would like to add you to our 
	unexpirable candidates list. Simply accept our invitation and follow the 
	instructions to create your very own CloudResume. We may contact you
	sooner than you expect:
	 
	<a href="{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}">{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}</a>

	<a href="{{ env('APP_URL', url('/')) }}/invite/business/{{ $business->id }}">{{ env('APP_URL', url('/')) }}/invite/business/{{ $business->id }}</a>


	(Note: Even though you are not interested at the moment to work with us, don't
	hesitate to create your account for many great benefits)

	Thank You,
@endsection