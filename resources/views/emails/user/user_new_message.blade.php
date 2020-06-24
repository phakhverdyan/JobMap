@extends('emails.en.layouts.main')

@section('body')
	You received a new message from {{ $business->name }} in CloudResume. 
	Follow this link to know more about them:
	<a href="{{ env('APP_URL', url('/')) }}/user/messages">{{ env('APP_URL', url('/')) }}/user/messages</a>

	Thank You,
@endsection