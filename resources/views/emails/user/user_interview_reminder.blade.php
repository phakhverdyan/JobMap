@extends('emails.en.layouts.main')

@section('body')
	Don't forget to accept your interview as fast as possible! 
	You can also message the company to change the date if it does not working
	for you.

	<a href="{{ env('APP_URL', url('/')) }}/user/interviews">{{ env('APP_URL', url('/')) }}/user/interviews</a>

	Thank You,
@endsection