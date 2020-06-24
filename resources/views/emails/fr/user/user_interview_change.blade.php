@extends('emails.fr.layouts.main')

@section('body')
	{{ $user->first_name }},

	Vous venez de recevoir une demande de modification de date pour votre entrevue. Veuillez suivre le
	lien afin d'approuver ou apporter plus de changements à l'entrevue.

	<a href="{{ env('APP_URL', url('/')) }}/user/interviews">{{ env('APP_URL', url('/')) }}/user/interviews</a>

@endsection