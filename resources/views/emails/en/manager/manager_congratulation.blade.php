@extends('emails.en.layouts.main')

@section('body')
	Congratulation,

	You're now part of JobMap. Make sure to visit our YouTube
	channel to learn new tips and tricks. Ask questions in the comment
	section, we respond to everyone. There's also our FAQ section for more
	information:   <a href="{{ config('app.url') }}/faq">{{ config('app.url') }}/faq</a>

@endsection