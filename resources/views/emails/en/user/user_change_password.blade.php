@extends('emails.en.layouts.main')

@section('body')
	Please confirm your new password here:
	<a href="{{ env('APP_URL', url('/')) }}/user/confirm-new-password?code={{ $user->new_password_confirmation_code }}">{{ env('APP_URL', url('/')) }}/user/confirm-new-password?code={{ $user->new_password_confirmation_code }}</a>

@endsection