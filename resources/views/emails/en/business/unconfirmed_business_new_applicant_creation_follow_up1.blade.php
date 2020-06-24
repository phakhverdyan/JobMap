@extends('emails.en.layouts.main')

@section('body')
	We have a candidate that is awaiting for you to review their resume that they sent you.

	Look at what you can do with Active candidates that wasn't posible before!
	<a href="{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $business_creator->verification_code }}">{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $business_creator->verification_code }}</a>

@endsection