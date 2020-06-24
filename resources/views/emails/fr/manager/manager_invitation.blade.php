@extends('emails.fr.layouts.main')

@section('body')
{{ $user->full_name }},

	{{ $business_creator->full_name }} a besoin de vous comme gestionnaire
	JobMap sur la page carrière de {{ $business->name }}. 
	
	SVP confirmez vos informations de compte ici:
	<a href="{{ config('app.url') }}/user/signup?i={{ $user->invite_token }}">{{ config('app.url') }}/user/signup?i={{ $user->invite_token }}</a>

@endsection