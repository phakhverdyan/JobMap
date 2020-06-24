@extends('emails.en.layouts.main')

@section('body')
	{{ $reference->full_name }},
	you almost completed the reference for <b>{{ $user->full_name }}</b>.

	<a href="{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}">{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}</a>

	JobMap is the future to creating a resume and exchanging
	with businesses. Try it out for yourself and never worry about creating a 
	resume everytime it is asked.

	Do you own or manage a business? JobMap is free to advertise job positions
	and gather candidates, try it out!

@endsection