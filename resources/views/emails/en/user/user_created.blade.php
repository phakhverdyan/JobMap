@extends('emails.layouts.main')

@section('body')
	A new user #{{ $user->id }}
	@if ($user->country)
		from {{ $user->country }}, {{ $user->region }}, {{ $user->city }}
	@endif
	has created a profile.
@endsection