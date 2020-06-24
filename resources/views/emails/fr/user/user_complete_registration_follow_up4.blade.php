@extends('emails.fr.layouts.main')

@section('body')
	Vous devez activer votre compte pour accéder à tous les avantages de JobMap.
	SVP remplir ce qui manque afin qu'il n'expire jamais.

	<a href="{{ env('APP_URL', url('/')) }}/user/resume/create">{{ env('APP_URL', url('/')) }}/user/resume/create</a>

@endsection