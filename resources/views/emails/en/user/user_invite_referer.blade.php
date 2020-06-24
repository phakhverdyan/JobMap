@extends('emails.en.layouts.main')

@section('body')
	{{ $reference->full_name }},
	<b>{{ $user->full_name }}</b> is asking you for a reference when working at <b>{{ $reference->company }}</b>. 
	Here's the link so you can help complete the JobMap profile for finding the perfect Job.
	<a href="{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}">{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}</a>.

	JobMap is the future to creating a resume and exchanging
	with businesses. Try it out for yourself and never worry about creating a 
	resume everytime it is asked.

	Do you own or manage a business? JobMap is free to advertise job positions
	and gather candidates, try us out!

	Thank You,
@endsection