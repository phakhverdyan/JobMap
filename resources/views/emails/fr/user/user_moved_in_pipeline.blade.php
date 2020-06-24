@extends('emails.fr.layouts.main')

@section('body')

	{{ $ business-> name }} vous a déplacé dans le pipeline.
	Ce pourrait être une bonne idée de vérifier et peut-être leurs envoyer 
	un "Wave" pour leur demontrer votre intérêt.


	Apprenez comment envoyer un "Wave" ici: <a href="{{ env('APP_URL', url('/')) }}/faq">{{ env('APP_URL',url('/')) }}/faq</a>
@endsection




