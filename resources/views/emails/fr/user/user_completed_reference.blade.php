@extends('emails.fr.layouts.main')

@section('body')
	Félicitations,

	Vous avez reçu une référence de {{ $referer->full_name }}. 
	Vous pouvez accepter cette référence et l'ajouter à votre profil public.
	
	{{ REFERENCE_PAGE & NOT_SET_YET & IT_IS_OK }}

@endsection

