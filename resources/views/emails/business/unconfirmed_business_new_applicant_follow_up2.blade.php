@extends('emails.en.layouts.main')

@section('body')
	Hi,

	You're almost done with your account creation. Follow this link to complete what's missing:
	{{link=CloudResume_confirm_account}}

	Thank you,
@endsection