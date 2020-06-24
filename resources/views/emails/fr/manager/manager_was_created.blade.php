@extends('emails.fr.layouts.main')

@section('body')
	{{ $user->full_name }} à créé un compte.

	Vous pouvez l'attribuer à des emplacements spécifiques et ajuster les autorisations dans la
	section "Gestionnaire" sur le Tableau de bord.

@endsection