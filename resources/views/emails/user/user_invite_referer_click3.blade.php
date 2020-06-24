@extends('emails.en.layouts.main')

@section('body')
	Hi,
	You actually did follow the link to help <b>{{ $user->full_name }}</b>. 
	If you still would like to help, you just need to confirm everything. 
	
	<a href="{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}">{{ env('APP_URL', url('/')) }}/user/reference?t={{ $reference->remember_token }}</a>

	Thank You,
@endsection