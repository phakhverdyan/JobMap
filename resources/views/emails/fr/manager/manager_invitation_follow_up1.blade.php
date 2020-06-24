@extends('emails.fr.layouts.main')

@section('body')
	{{ $user->full_name }},

	N'oubliez pas de compléter votre inscription afin que vous puissiez voir tout les
	candidats potentiels.
@endsection