@extends('emails.en.layouts.main')

@section('body')
	Hi,

	You're almost done with your account creation. Follow this link to complete what's missing:
	<a href="{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $business_creator->verification_code }}">{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $business_creator->verification_code }}</a>

@endsection