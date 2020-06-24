@extends('emails.en.layouts.main')

@section('body')
	{{ $user->full_name }},

    @if (!empty($tmp_password))
        <p>Your password: <strong>{{ $tmp_password }}</strong></p>
    @endif

	We need you to confirm your email to complete your profile.
	Please follow this link to fully activate your account:
	<a href="{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $user->verification_code }}">{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $user->verification_code }}</a>

@endsection
