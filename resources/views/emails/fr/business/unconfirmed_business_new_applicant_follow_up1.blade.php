@extends('emails.fr.layouts.main')

@section('body')
	Il peut s'agir d'une erreur de notre part, mais votre compte ne semble pas avoir été complété.
	S'il vous plaît, suivez ce lien pour achever votre compte sur JobMap et être en mesure d'intéragir avec
	des candidats.
	<a href="{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $business_creator->verification_code }}">{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $business_creator->verification_code }}</a>

@endsection