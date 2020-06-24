@extends('emails.en.layouts.main')

@section('body')
	{{ $user->full_name }},
	There's still something missing for you to activate your account!
	Here's the link:
	<a href="{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $user->verification_code }}">{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $user->verification_code }}</a>.

@endsection