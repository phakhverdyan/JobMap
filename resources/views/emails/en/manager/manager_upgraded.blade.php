@extends('emails.en.layouts.main')

@section('body')
	You are now a business manager at {{ $business->name }}.
	Go see your new possibilities in JobMap.

	Thank You,
@endsection