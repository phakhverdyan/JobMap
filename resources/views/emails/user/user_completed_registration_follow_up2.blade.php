@extends('emails.en.layouts.main')

@section('body')
	Please make sure to complete your CloudResume profile so you won't loose
	an opportunity.

	Embrace the new way of finding jobs!
	<a href="{{ env('APP_URL', url('/')) }}/user/resume/create">{{ env('APP_URL', url('/')) }}/user/resume/create</a>

	Thank You,
@endsection