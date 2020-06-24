@extends('emails.fr.layouts.main')

@section('body')
	Félicitations,

	{{ $user->full_name }} a appliqué pour {{ $business->name }}.

@endsection