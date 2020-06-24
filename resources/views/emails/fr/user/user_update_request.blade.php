@extends('emails.fr.layouts.main')

@section('body')
	{{ $business->name }} a besoin de savoir si les informations de votre CV sont toujours
	pertinentes. Veuillez suivre le lien pour modifier ou approuver vos informations JobMap.

	<a href="{{ env('APP_URL', url('/')) }}/user/resume/sent">{{ env('APP_URL', url('/')) }}/user/resume/sent</a>

@endsection


