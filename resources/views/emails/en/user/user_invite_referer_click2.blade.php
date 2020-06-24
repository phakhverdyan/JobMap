@extends('emails.en.layouts.main')

@section('body')
	It seem that you forgot just one thing in making your reference for
	<b>{{ $user->full_name }}</b> available. Please follow the link to complete it:
	<a href="{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}">{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}</a>

@endsection