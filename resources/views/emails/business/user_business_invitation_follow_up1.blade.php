@extends('emails.en.layouts.main')

@section('body')
	Hello,
	{{ $business->name }} recently contacted you to fill in a CloudResume.
	They are looking to refresh their candidate list and you are part of the 
	candidate list they want to be updated on!
	
	Follow this link to complete your profile and let them know that you are
	still interested to work at their company.

	<a href="{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}">{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}</a>

	Thank You,
@endsection