@extends('emails.fr.layouts.main')

@section('body')
	Félicitations {{ $user->first_name }}, 
	Vous êtes maintenant prêt à utiliser tout le potentiel de JobMap.
	Si vous avez des commentaires, n'hésitez pas à nous le faire savoir
	depuis votre compte JobMap.

@endsection


