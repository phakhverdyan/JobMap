@extends('emails.en.layouts.main')

@section('body')
	{{ $user->full_name }} sent you something that might be interesting for you:

	<a href="{{ $link }}">{{ $link }}</a>

@endsection