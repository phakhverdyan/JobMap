@extends('emails.fr.layouts.main')

@section('body')
	Vous n'êtes plus gestionnaire chez {{ $business->name }},mais continuez à utiliser
	JobMap en tant que profil utilisateur standard.

@endsection
