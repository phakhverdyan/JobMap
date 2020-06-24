@extends('emails.fr.layouts.main')

@section('body')
	Merci de vous créer un compte avec JobMap. Malheureusement
	quelque chose est arrivé et votre compte n'a pas été complété, mais bonnes nouvelles,
	nous avons sauvegarder ce que vous avez fait jusqu'à présent.
	Suivez ce lien pour complété votre activation de compte:

	<a href="{{ env('APP_URL', url('/')) }}/user/resume/create">{{ env('APP_URL', url('/')) }}/user/resume/create</a>
	
@endsection


