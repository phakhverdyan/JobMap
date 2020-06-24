@extends('emails.fr.layouts.main')

@section('body')
	SVP confirmé votre nouveau mot de passe ici:
	<a href="{{ env('APP_URL', url('/')) }}/user/confirm-new-password?code={{ $user->new_password_confirmation_code }}">{{ env('APP_URL', url('/')) }}/user/confirm-new-password?code={{ $user->new_password_confirmation_code }}</a>

@endsection