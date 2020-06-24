@extends('emails.fr.layouts.main')

@section('body')
	Vous avez suivi le lien pour aider <b>{{ $user->full_name }}</b>. 
	Si vous voulez toujours aider, vous n'avez qu'à tout confirmer ici:
	
	<a href="{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}">{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}</a>

@endsection