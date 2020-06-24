@extends('emails.en.layouts.main')

@section('body')
	Hi {{ $reference->full_name }},
	<b>{{ $user->full_name }}</b> is asking you for a reference of the work
	at <b>{{ $reference->company }}</b>. Here's the link so you can help complete
	the CloudResume profile for finding the perfect Job.
	<a href="{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}">{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}</a>.

	<a href="{{ env('APP_URL', url('/')) }}/reference/user/{{$user->id}}?r={{ $reference->id }}">{{ env('APP_URL', url('/')) }}/reference/user/{{$user->id}}?r={{ $reference->id }}</a>.

	CloudResume is the future to creating a resume and exchanging
	with businesses. Try it out for yourself and never worry about creating a 
	resume everytime it is asked.

	Do you own or manage a business? CloudResume is free to advertise job positions
	and gather candidates, use it!

	Thank You,
@endsection