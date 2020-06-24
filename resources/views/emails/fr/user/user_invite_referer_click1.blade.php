@extends('emails.fr.layouts.main')

@section('body')
	{{ $reference->full_name }},
	Vous avez presque complété la référence pour <b>{{ $user->full_name }}</b>.

	<a href="{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}">{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}</a>

	JobMap est l'avenir pour la création de CV et d'échanges
	avec les entreprises. Essayez-le par vous-même et ne vous inquiétez plus jamais d'avoir à
	réécrire un CV chaque fois qu'il vous ai demandé.

	Possédez-vous ou gérez-vous une entreprise? JobMap vous permet de créer des offres d'emplois
	et rassembler des candidats. Utilisez-le Gratuitement.

@endsection


