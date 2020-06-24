@extends('emails.fr.layouts.main')

@section('body')
	Nous avons un candidat qui attend que vous examiniez le CV qu'il vous a envoyé.
	Regardez ce que vous pouvez faire avec des candidats actifs!
	<a href="{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $business_creator->verification_code }}">{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $business_creator->verification_code }}</a>

@endsection