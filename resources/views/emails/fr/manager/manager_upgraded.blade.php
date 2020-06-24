@extends('emails.fr.layouts.main')

@section('body')
	Vous êtes maintenant Gestionnaire d'entreprise chez {{ $business->name }}.
	Allez voir vos nouvelles possibilités dans JobMap.

@endsection