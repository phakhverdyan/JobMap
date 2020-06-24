@extends('emails.en.layouts.main')

@section('body')
	Congratulation {{ $user->full_name }},

	{{ $business->name }} wants to interview you. Just log into your account and click the
	interview menu to view and accept the interview.

	Break a leg,
@endsection