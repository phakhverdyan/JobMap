@extends('emails.en.layouts.main')

@section('body')
	Hey,

	This message is letting you know that {{ $business->name }} has moved you in the pipeline.
	It might be a good idea to check it out and maybe wave them back to show them you're still 
	interested.

	Learn how to Wave here: {{ NOT_SET_YET & IT_IS_OK }}
@endsection

