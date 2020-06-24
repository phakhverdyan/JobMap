@extends('emails.fr.layouts.main')

@section('body')
	{{ $user->full_name }},

    @if (!empty($tmp_password))
        <p>Votre mot de passe</p>: <strong>{{ $tmp_password }}</strong></p>
    @endif

	Nous avons besoin de vous pour confirmer votre email afin de compléter votre profil.
	Veuillez suivre ce lien pour activer votre compte:
	<a href="{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $user->verification_code }}">{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $user->verification_code }}</a>

@endsection
