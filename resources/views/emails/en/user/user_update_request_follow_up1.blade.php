@extends('emails.en.layouts.main')

@section('body')
	It's time to show your interest by telling {{ $business->name }} if you are still looking
	for a job or not. Follow the link to make changes or approve your resume:
	<a href="{{ env('APP_URL', url('/')) }}/user/resume/sent">{{ env('APP_URL', url('/')) }}/user/resume/sent</a>

@endsection