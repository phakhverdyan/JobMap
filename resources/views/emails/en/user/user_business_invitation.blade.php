@extends('emails.en.layouts.main')

@section('body')

	This is {{ $business->name }} and we would like to add you to our 
	unexpirable candidates list. Simply accept our invitation and follow the 
	instructions to create or import your very own resume. We may contact you
	for more information:
	 
	<a href="{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}">{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}</a>


	(Note: Even though you are not interested at the moment to work with us, don't
	hesitate to create your account for many great benefits)

@endsection