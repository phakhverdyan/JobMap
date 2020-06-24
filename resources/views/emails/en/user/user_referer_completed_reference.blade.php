@extends('emails.en.layouts.main')

@section('body')
	Congratulation,

	You received a reference from {{ $reference->full_name }}. You can accept this reference to add it to your public profile.

	<a href="{{ env('APP_URL', url('/')) }}/user/references">{{ env('APP_URL', url('/')) }}/user/references</a>

@endsection