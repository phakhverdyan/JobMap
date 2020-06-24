@extends('emails.fr.layouts.main')

@section('body')
	Il semble que vous ayez oublié quelque chose en créant votre référence pour
	<b>{{ $user->full_name }}</b>. SVP Suivez ce lien pour complété la référence ici:
	<a href="{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}">{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}</a>

@endsection