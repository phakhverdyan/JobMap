@extends('emails.fr.layouts.main')

@section('body')
	Vous cherchez l'emploi de vos rêves en {{ date('Y') }}}? Complété votre inscription afin de pouvoir débuter
	ce qui compte: Trouver l'emploi parfait!

	<a href="{{ env('APP_URL', url('/')) }}/user/resume/create">{{ env('APP_URL', url('/')) }}/user/resume/create</a>

@endsection

