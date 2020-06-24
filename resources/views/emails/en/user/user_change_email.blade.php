@extends('emails.en.layouts.main')

@section('body')
	Please confirm your new email address:
	<a href="{{ env('APP_URL', url('/')) }}/user/confirm-new-email?code={{ $user->new_email_confirmation_code }}">{{ env('APP_URL', url('/')) }}/user/confirm-new-email?code={{ $user->new_email_confirmation_code }}</a>

@endsection