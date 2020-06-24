@extends('emails.layouts.main')

@section('body')
	<b>{{ $business->name }}</b> from <b>{{ $business->country }}, {{ $business->region }}, {{ $business->city }}</b> has created an account.
@endsection