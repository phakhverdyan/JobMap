@extends('emails.en.layouts.main')

@section('body')
	You received a new message from {{ $business->name }} in JobMap. 
	Follow this link to know more about it:
	<a href="{{ env('APP_URL', url('/')) }}/user/messages">{{ env('APP_URL', url('/')) }}/user/messages</a>

@endsection