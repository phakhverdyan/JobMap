@extends('emails.fr.layouts.main')

@section('body')
	{{ $business->name }} est toujours intéressé à vous. 
	Suivez ce lien afin qu'ils puissent avoir la dernière mise à jour sur votre CV.

	<a href="{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}">{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}</a>

	Note: Créez votre CV 2.0 en ligne Gratuitement! 
	Imprimez-le, envoyez-le par email et bien plus encore!)

@endsection

