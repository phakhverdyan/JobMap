@extends('emails.en.layouts.main')

@section('body')
	You accepted the interview with {{ $business->name }} for the '{{ \Carbon\Carbon::parse($interview_request->date)->format('d/m/Y H:i') }}.
	You can change information or propose a different date and hour by going on JobMap.

@endsection
