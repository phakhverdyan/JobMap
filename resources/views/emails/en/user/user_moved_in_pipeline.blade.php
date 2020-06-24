@extends('emails.en.layouts.main')

@section('body')

	This message is just to let you know that {{ $business->name }} has moved you in the pipeline.
	It might be a good idea to check it out and maybe wave them back to show them you're still 
	interested.

	Learn how to Wave here: <a href="{{ env('APP_URL', url('/')) }}/faq">{{ env('APP_URL',url('/')) }}/faq</a>
@endsection