@extends('emails.fr.layouts.main')

@section('body')
	Vous avez reçu un nouveau message de {{ $business->name }} sur JobMap. 
	Suivez ce lien pour en savoir plus:
	<a href="{{ env('APP_URL', url('/')) }}/user/messages">{{ env('APP_URL', url('/')) }}/user/messages</a>

@endsection