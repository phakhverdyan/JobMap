@extends('emails.en.layouts.main')

@section('body')
	{{ $business->name }} needs to know if the information in your CloudResume is still
	relevant. Please follow the link to change or approve your CloudResume information.

	<a href="{{ env('APP_URL', url('/')) }}/user/resume/sent">{{ env('APP_URL', url('/')) }}/user/resume/sent</a>

	Thank You,
@endsection