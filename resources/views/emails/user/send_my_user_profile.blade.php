@extends('emails.layouts.main')

@section('body')
	Hello {{ $data->type }}!
	I send you a link to my profile on the site JobMap.co:

	http://jobmap.co/u/{{ $user->fullname }}

	<br>
	<br>
	{!! $data->message !!}
@endsection
