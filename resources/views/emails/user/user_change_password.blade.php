@extends('emails.en.layouts.main')

@section('body')
	Please confirm your new password here:
	{{ NOT_SET_YET & IT_IS_OK }}

	Thank You,
@endsection