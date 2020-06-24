@extends('emails.en.layouts.main')

@section('body')
	Congratulation {{ $user->first_name }}, 
	You are now ready to use the full potential of CloudResume.
	Enjoy and if you have any feedback, don't hesitate to let us know from
	your CloudResume Account.

	Live your life to the fullest,
@endsection