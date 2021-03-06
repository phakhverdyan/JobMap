@extends('emails.en.layouts.main')

@section('body')
	Thank you for creating an account with JobMap, unfortunately
	something happened and your account wasn't completed, but we saved what you did so far.
	Follow this link to fully activate your account:

	<a href="{{ env('APP_URL', url('/')) }}/user/resume/create">{{ env('APP_URL', url('/')) }}/user/resume/create</a>
	
@endsection