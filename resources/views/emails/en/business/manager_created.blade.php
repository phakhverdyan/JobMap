@extends('emails.layouts.main')

@section('body')
	A new manager from
	@if ($user->country)
		{{ $user->country }}, {{ $user->region }}, {{ $user->city }}
	@endif
	has created a profile for {{ $business->name }}.
@endsection