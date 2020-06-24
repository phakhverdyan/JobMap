@extends('emails.fr.layouts.main')

@section('body')

	{{ $business->name }} vous a récemment contacté pour créer votre compte profil.
	Ils recherchent à rafraîchir leur liste de candidats et vous faites partie des
	candidats qu'ils aimeraient mettre à jour!
	Suivez ce lien pour compléter votre profil et leur faire savoir que vous êtes
	toujours disponible.

	<a href="{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}">{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}</a>

@endsection
