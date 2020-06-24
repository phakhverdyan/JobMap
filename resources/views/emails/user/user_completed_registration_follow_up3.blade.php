@extends('emails.en.layouts.main')

@section('body')
	Do you still want your dream job in {{ date('Y') }}? Complete registration so you can start
	doing what matters most: Looking for the perfect job!

	<a href="{{ env('APP_URL', url('/')) }}/user/resume/create">{{ env('APP_URL', url('/')) }}/user/resume/create</a>

	Thank You,
@endsection

