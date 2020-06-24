@extends('emails.fr.layouts.main')

@section('body')
	Vous faites maintenant partie de JobMap. Assurez-vous de visiter notre canal YouTube
	pour apprendre de nouveaux trucs et astuces. Posez-nous vos questions dans la section 
	commentaires, nous répondons à tout le monde. Il y a aussi notre section FAQ pour plus
	information:   <a href="{{ config('app.url') }}/faq">{{ config('app.url') }}/faq</a>

@endsection