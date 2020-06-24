@extends('emails.fr.layouts.main')

@section('body')
	{{ $user->full_name }},
	Il vous manque encore quelque chose pour activer votre compte!
	Voici le lien:
	<a href="{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $user->verification_code }}">{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $user->verification_code }}</a>.

@endsection


