@extends('emails.en.layouts.main')

@section('body')
	Hey,
	It seem that {{ $business->name }}  is still interested to know if you're still available. 
	Please follow this link so they can always have the ltest update of your Resume.


	<a href="{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}">{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}</a>

	Note: You will have the opportunity to create the perfect 2.0 online Resume
	completely free to use! Print it, send it by email and a lot more!)

	Thank You,
@endsection