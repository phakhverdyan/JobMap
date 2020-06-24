@extends('emails.en.layouts.main')

@section('body')
	Hello {{ $reference->full_name }}, 
	<b>{{ $user->full_name }}</b> would appreciate if you can help him by clicking
	on this link to give a reference for a job position they are applying for.
	<a href="{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}">{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}</a>

	You may be contacted by an employer.

	Thank You,
@endsection