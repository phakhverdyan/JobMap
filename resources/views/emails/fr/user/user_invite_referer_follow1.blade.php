@extends('emails.fr.layouts.main')

@section('body')
	{{ $reference->full_name }}, 
	<b>{{ $user->full_name }}</b> a besoin de votre aide pour une référence pour un nouvel emploi.
	Suivez ce lien pour remplir les informations nécessaires et merci, de la part de <b>{{ $user->full_name }}</b>
	<a href="{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}">{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}</a>

	Vous pourriez être contacté par une entreprise.

@endsection



