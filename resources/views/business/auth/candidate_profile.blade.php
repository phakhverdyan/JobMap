@extends('layouts.main_business')

@section('content')

	<div class=" mt-2 text-center">
		<div class="row">
			<div class="col-12">
				<div class="col-4">
					<p class="col-12 text bold left site-map-title">Candidate profile</p>
					<p class="col-12 text left"><a href="{!! url('/business/dashboard') !!}">dashboard</a></p>
					<p class="col-12 text left"><a href="{!! url('/business/candidate/list') !!}">candidates</a></p>
					<p class="col-12 text left"><a href="{!! url('/#feedback') !!}">feedback</a></p>
					<p class="col-12 text left"><a href="{!! url('/business/messages')  !!}">instant messanger</a></p>
					<p class="col-12 text left"><a href="{!! url('/user/profile')  !!}">employer profile</a></p>
					<p class="col-12 text left"><a href="{!! url('/business/job/position')  !!}">job_position page</a></p>
					<p class="col-12 text left"><a href="{!! url('/business/branch/locations')  !!}">branch locations</a></p>
					<p class="col-12 text left"><a href="{!! url('/business/profile')  !!}">businesses profile</a></p>
					<p class="col-12 text left"><a href="{!! url('/business/account/users')  !!}">account users</a></p>
					<p class="col-12 text left"><a href="{!! url('/business/branch/locations')  !!}">locations</a></p>
					<p class="col-12 text left"><a href="{!! url('/business/integrations'); !!}">integrations</a></p>
					<p class="col-12 text left"><a href="{!! url('/business/settings')  !!}">settings</a></p>
					<p class="col-12 text left"><a href="{!! url('/business/billing')  !!}">billing</a></p>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="divide-line black responsive"></div>
	</div>

@endsection