@extends('emails.layouts.main')

@section('body')
	Hello,
	{{ $business->name }} recently contacted you to fill up a CloudResume account.
	They are looking to refresh their candidate list and you are part of the 
	candidates they want to have an update on!
	Follow this link to complete your profile and make them know that you are
	still interested to work at their company.

	<a href="{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}">{{ env('APP_URL', url('/')) }}/user/signup?a={{ $affiliate_token }}</a>

	Thank you,
@endsection