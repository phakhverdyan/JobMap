@extends('emails.en.layouts.main')

@section('body')
	You are no longer a manager at {{ $business->name }}, but you can still use
	JobMap as a regular User profile.

	Thank you for using JobMap,
@endsection

