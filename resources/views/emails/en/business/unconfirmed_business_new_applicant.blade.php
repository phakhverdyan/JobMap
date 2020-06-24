@extends('emails.en.layouts.main')

@section('body')
	A new candidate has applied to your business.
	To see this candidates, follow this link: <a href="{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $business_creator->verification_code }}">{{ env('APP_URL', url('/')) }}/user/verification?vc={{ $business_creator->verification_code }}</a>.

	You'll be able to  see the full resume of the candidate, ask for updates, chat and even ask for an
	interview. 

	Find out all the advantages that can help you be more efficient on JobMap.

@endsection