@extends('emails.fr.layouts.main')

@section('body')
	SVP confirmer votre nouvelle adresse email ici:
	<a href="{{ env('APP_URL', url('/')) }}/user/confirm-new-email?code={{ $user->new_email_confirmation_code }}">{{ env('APP_URL', url('/')) }}/user/confirm-new-email?code={{ $user->new_email_confirmation_code }}</a>

@endsection