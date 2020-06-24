@extends('emails.fr.layouts.main')

@section('body')
	Vous avez acceptez l'entrevue avec {{ $business->name }} pour '{{ \Carbon\Carbon::parse($interview_request->date)->format('d/m/Y H:i') }}.

@endsection
