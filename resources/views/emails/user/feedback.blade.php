@extends('emails.layouts.main')

@section('body')
	@if ($business)
		You have received an new feedback from Business <b>{{ $business->name }}</b>:
	@else
		You have received an new feedback from User <b>{{ $user->fullname }}</b>:
	@endif
	<br>
	<br>
	{{ $message_text }}
@endsection