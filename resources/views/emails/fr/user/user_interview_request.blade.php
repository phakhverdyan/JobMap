@extends('emails.fr.layouts.main')

@section('body')
	Félicitations {{ $user->full_name }},

	{{ $business->name }} veut vous passer en entrevue. Connectez-vous à votre compte et cliquez dans le
	menu Entrevues pour voir et accepter cette entrevue.

	Bonne chance,
@endsection