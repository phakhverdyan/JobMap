@extends('emails.fr.layouts.main')

@section('body')
	N'oubliez pas d'accepter votre entrevue aussi vite que possible!
	Vous pouvez également envoyer un message à l'entreprise pour changer la date si cela ne convient 
	pas à votre horaire.

	<a href="{{ env('APP_URL', url('/')) }}/user/interviews">{{ env('APP_URL', url('/')) }}/user/interviews</a>

@endsection