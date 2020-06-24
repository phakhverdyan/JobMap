@extends('emails.en.layouts.main')

@section('body')
	Hello,

	It may be an error on our part, but it seem like your account wasn't fully completed.
	Please follow this link to complete your account on CloudResume and be able to interact with
	candidates.
	<a href="{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $business_creator->verification_code }}">{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $business_creator->verification_code }}</a>

@endsection