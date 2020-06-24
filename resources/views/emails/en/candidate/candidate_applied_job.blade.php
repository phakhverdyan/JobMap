@extends('emails.en.layouts.main')

@section('body')

	@if (!$subscribe)
	<strong>{{ $user->full_name }}</strong>
	@else
	new User
	@endif has applied job - <a href="{{ $job_url }}"><strong>{{ $job_title }}</strong></a> in location - <a href="{{ $location_url }}"><strong>{{ $location_title }}</strong></a>.

	@if ($subscribe)
	<h3>What you will miss if you stay on freemium plan:</h3>
	<ul>
		<li>Everything from Freemium</li>
		<li>Access to the widget section</li>
		<li>Access to the QR code section</li>
		<li>Full access to ATS:
			<ul>
				<li>candidate pdf and all his account infos</li> 
				<li>video presentation</li> 
				<li>add notes to candidates</li> 
				<li>ask for interviews with interview manager</li> 
				<li>ask for a Resume update</li> 
				<li>Instant message candidates on the cellphone from the app</li>
			</ul>
		</li>
    </ul>
	@endif

@endsection
