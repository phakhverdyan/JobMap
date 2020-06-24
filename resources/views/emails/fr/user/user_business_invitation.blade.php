@extends('emails.fr.layouts.main')

@section('body')
	
	Nous sommes {{ $business->name }} et nous aimerions vous ajouter à notre
	liste des candidats inexpirable. Acceptez notre invitation et suivez les
	instructions afin de créer votre profil. Restez à l'affut, nous pourrions vous contacter.
	 
	<a href="{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}">{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}</a>


	(Remarque: Même si vous n'êtes pas intéressé à travailler avec nous, 
	n'hésiter pas à créer votre compte pour plusieurs avantages.)

@endsection