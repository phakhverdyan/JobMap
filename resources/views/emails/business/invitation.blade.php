@extends('emails.layouts.main')

@section('body')
	Hi,

	This is {{ $business->name }} and we would like to be able to add you to our 
	unexpirable candidates list. Simply accept our invitation and follow the 
	instruction to create your very own CloudResume. We might contact you
	sooner than you expect:
	 
	<a href="{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}">{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}</a>


	(Note: Even you are not interested at the moment to work with us, don't
	hesitate to create your account for a lot of great benefits)

	Thank you,
@endsection