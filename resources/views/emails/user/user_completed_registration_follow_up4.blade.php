@extends('emails.en.layouts.main')

@section('body')
	You need to activate your account to access the full benefits of CloudResume.
	Please fill in whats missing so it doesn't expire.

	<a href="{{ env('APP_URL', url('/')) }}/user/resume/create">{{ env('APP_URL', url('/')) }}/user/resume/create</a>

	Thank You,
@endsection