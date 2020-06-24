@extends('emails.fr.layouts.main')

@section('body')
	N'oubliez pas d'accepter la nouvelle date de votre entrevue à venir!

	<a href="{{ env('APP_URL', url('/')) }}/user/interviews">{{ env('APP_URL', url('/')) }}/user/interviews</a>

@endsection

