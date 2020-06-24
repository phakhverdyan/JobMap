@extends('emails.fr.layouts.main')

@section('body')
	Vous avez presque terminé la création de votre compte. Suivez ce lien pour le compléter:
	<a href="{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $business_creator->verification_code }}">{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $business_creator->verification_code }}</a>

@endsection