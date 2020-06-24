@extends('emails.fr.layouts.main')

@section('body')
	Félicitations,

	Vous avez reçu une référence de {{ $referer->full_name }}. Vous pouvez accepter cette référence et l'ajouter à votre profil public.
	
	<a href="{{ env('APP_URL', url('/')) }}/user/references">{{ env('APP_URL', url('/')) }}/user/references</a>


@endsection

