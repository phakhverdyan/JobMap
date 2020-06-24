@extends('emails.fr.layouts.main')

@section('body')
	Assurez-vous de compléter votre profil JobMap pour ne perdre aucune opportunité.

	Adoptez la toute nouvelle façon de trouver un emploi!
	<a href="{{ env('APP_URL', url('/')) }}/user/resume/create">{{ env('APP_URL', url('/')) }}/user/resume/create</a>

@endsection


