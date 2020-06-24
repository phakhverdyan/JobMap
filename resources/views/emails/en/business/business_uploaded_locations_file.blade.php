@extends('emails.en.layouts.main')

@section('body')
	Business "{{ $business->name }}" <b>[business ID: {{ $business->id }}]</b> sent you a file with locations. Need to create each location from the file. The file is available by this link:

	<a href="{{ env('APP_URL', url('/')) }}/business/location_files/{{ $file_name }}">{{ env('APP_URL', url('/')) }}/business/location_files/{{ $file_name }}</a>

	Thank You,
@endsection