@extends('emails.en.layouts.main')

@section('body')
	Congratulation,

	You received a reference from {{ $referer->full_name }}. 
	You can accept this reference to add it to your public profile.
	
	{{ REFERENCE_PAGE & NOT_SET_YET & IT_IS_OK }}

	Thank You,
@endsection

