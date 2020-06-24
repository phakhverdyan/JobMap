@extends('emails.en.layouts.main')

@section('body')

	{{ $user->full_name }} has created an account.

	You can assign to specific locations and adjust permissions in the 
	Manager section on the Dashboard.


@endsection