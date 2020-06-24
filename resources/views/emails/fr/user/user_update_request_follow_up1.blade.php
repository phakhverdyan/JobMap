@extends('emails.fr.layouts.main')

@section('body')
	Il est temps de démontrer votre intérêt à {{ $business->name }} si vous cherchez toujours
	un emploi ou pas. Suivez le lien pour apporter des modifications ou approuver votre profil:
	<a href="{{ env('APP_URL', url('/')) }}/user/resume/sent">{{ env('APP_URL', url('/')) }}/user/resume/sent</a>

@endsection
