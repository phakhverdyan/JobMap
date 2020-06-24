@extends('emails.en.layouts.main')

@section('body')
	Don't forget to accept the changed date for your interview that is coming up!

	<a href="{{ env('APP_URL', url('/')) }}/user/interviews">{{ env('APP_URL', url('/')) }}/user/interviews</a>

	Thank You,
@endsection