@extends('emails.en.layouts.main')

@section('body')
	You accepted the interview with {{ $business->name }} for the '{{ $interview_request->date->format('d/m/Y H:i') }}.

	Thank You,
@endsection
