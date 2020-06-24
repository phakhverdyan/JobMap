@extends('emails.en.layouts.main')

@section('body')
	{{ $reference->full_name }}, 
	<b>{{ $user->full_name }}</b> needs your help to fill a reference for a new position they are applying for.
	Follow this link to fill in the information needed and make sure that the credibility of  <b>{{ $user->full_name }}</b>
	is great for a new position. <a href="{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}">{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}</a>

	You may be contacted by an employer regarding this reference.

@endsection