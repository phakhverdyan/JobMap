@extends('emails.fr.layouts.main')

@section('body')	
	Un nouveau candidat a appliqué à votre entreprise.
	Pour voir son profil, suivez ce lien: <a href="{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $business_creator->verification_code }}">{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $business_creator->verification_code }}</a>.

	Vous serez en mesure de voir le CV complet du candidat, demandez des mises à jour, discutez 
	et même demandez un entretien.

	Découvrez tous les avantages qui vous aiderons à être plus efficace avec JobMap.

@endsection