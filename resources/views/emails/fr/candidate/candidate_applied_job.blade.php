@extends('emails.en.layouts.main')

@section('body')

	<strong>{{ $user->full_name }}</strong> has applied job - <a href="{{ $job_url }}"><strong>{{ $job_title }}</strong></a> in location - <a href="{{ $location_url }}"><strong>{{ $location_title }}</strong></a>.

@endsection
