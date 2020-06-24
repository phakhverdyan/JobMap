@extends('emails.fr.layouts.main')

@section('body')
	{{ $reference->full_name }}, 
	<b>{{ $user->full_name }}</b> aimerais que vous l'aidiez en cliquant
	sur ce lien afin de lui fournir une référence pour un emploi.
	<a href="{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}">{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}</a>

	Vous pourriez être contacté par l'entreprise.

@endsection