@extends('emails.en.layouts.main')

@section('body')
	{{ $user->first_name }},

	You just received a request for a changed date of your interview. Please follow the 
	link to approve or make more changes to the interview.

	<a href="{{ env('APP_URL', url('/')) }}/user/interviews">{{ env('APP_URL', url('/')) }}/user/interviews</a>

@endsection