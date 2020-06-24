@extends('emails.en.layouts.main')

@section('body')
	Hello {{ $reference->full_name }}, 
	<b>{{ $user->full_name }}</b> needs your help to fill a reference for a new position they are applying for.
	Follow this link to fill in the information needed and make sure the credibility of  <b>{{ $user->full_name }}</b>
	is good to go. <a href="{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}">{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}</a>

	You may be contacted by an employer.

	Thank You,
@endsection