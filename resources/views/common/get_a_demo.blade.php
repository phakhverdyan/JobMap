@extends('layouts.common_user')

@section('content')

<div class="container-fluid px-0" style="overflow: hidden;">
	<div class="d-flex justify-content-between flex-lg-row flex-column">
		<div id="requestCallbackModal" class="offset-lg-2 col-xl-3 col-lg-5  mr-lg-3 mr-0" style="padding: 50px 0;">
			<p class="mt-3" style="font-weight: 500; font-size: 20px;">{!! trans('landing.get_a_demo.title_1') !!}</p>
			<div class="mb-3 d-flex flex-lg-row flex-column justify-content-between">
				<div class="col-lg-6 pl-lg-0 pl-3">
					<input type="email" name="email" class="form-control bg-white" placeholder="{!! trans('landing.form.email') !!}"  autocomplete="off">
				</div>			
				<div class="col-lg-6 pr-lg-0 pr-3">
					<input type="text" name="contact_name" class="form-control bg-white" placeholder="{!! trans('landing.form.contact_name') !!}"  autocomplete="off">
				</div>
			</div>
			<div class="mb-3 d-flex flex-lg-row flex-column justify-content-between">
				<div class="col-lg-6 pl-lg-0 pl-3">
					<input type="text" name="employer_name" class="form-control bg-white" placeholder="{!! trans('landing.form.employer_name') !!}"  autocomplete="off">
				</div>
				<div class="col-lg-6 pr-lg-0 pr-3">
					<input type="text" name="country" class="form-control bg-white" placeholder="{!! trans('landing.form.country') !!}"  autocomplete="off">
				</div>
			</div>
            <p></p>
			<div class="mb-3 d-flex flex-lg-row flex-column">
				<div class="col-lg-4 pl-lg-0 pl-3">
					<input type="text" name="phone" class="form-control bg-white" placeholder="{!! trans('landing.form.phone_number') !!}"  autocomplete="off">
				</div>
				<div class="col-lg-4 px-lg-0 px-3">
					<input type="text" name="extension" class="form-control bg-white" placeholder="{!! trans('landing.form.extension') !!}"  autocomplete="off">
				</div>
				<div class="col-lg-4 pr-lg-0 pr-3">
					<input type="text" name="time" class="form-control bg-white" placeholder="{!! trans('landing.form.time_to_call_back') !!}"  autocomplete="off">
				</div>
				
			</div>
			
            <p class="mt-3" style="font-weight: 500; font-size: 20px;">{!! trans('landing.get_a_demo.title_2') !!}</p>
			<textarea name="message" class="form-control bg-white" rows="2" placeholder="{!! trans('landing.form.message_optional') !!}"></textarea>

			<p class="mt-3" style="font-weight: 500; font-size: 20px;">{!! trans('landing.get_a_demo.title_3') !!}</p>
			<p><input type="text" name="business_name" placeholder="{!! trans('landing.form.business_name') !!}" class="form-control bg-white"></p>
			<p><input type="text" name="website" placeholder="{!! trans('landing.form.website') !!}" class="form-control bg-white"></p>
			<p><input type="text" name="employer_number" class="form-control bg-white" placeholder="{!! trans('landing.form.number_of_employees') !!}"  autocomplete="off"></p>
            <p><input type="text" name="location_number" class="form-control bg-white" placeholder="{!! trans('landing.form.number_of_location') !!}"  autocomplete="off"></p>
			<p><button id="sendRequestCallback" class="btn btn-yellow btn-block py-2">{!! trans('landing.button.request_a_demo') !!}</button></p>
		</div>
		<div class="col-lg-7 bg-white bg_after pl-lg-5 pl-3" style="padding: 50px 0;">
			<div class="inside_right_side">
				<p style="font-size: 30px;">{!! trans('landing.get_a_demo.title_4') !!}</p>
				<p style="font-size: 20px;">{!! trans('landing.get_a_demo.title_5') !!}</p>

				<p>{!! trans('landing.get_a_demo.title_8') !!}</p>
				<p><img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2"> {!! trans('landing.get_a_demo.tag_1') !!}</p>
				<p><img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2"> {!! trans('landing.get_a_demo.tag_2') !!}</p>
				<p><img src="{{ asset('img/landing/galochka.svg') }}" width="25px" class="mr-2"> {!! trans('landing.get_a_demo.tag_3') !!}</p>

				<p class="mt-5">{!! trans('landing.get_a_demo.title_6') !!}</p>
				<p style="font-size: 20px;">{!! trans('landing.get_a_demo.title_7') !!}</p>
			</div>
		</div>
	</div>
	<!-- REQUEST CALLBACK OK MODAL -->
	<div class="modal fade bd-example-modal-lg" id="sendCallbackModal" tabindex="-1" role="dialog"
		 aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0" id="exampleModalLabel">{!! trans('landing.thanks') !!}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-11" id="responseMessage"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-center bg-light">
					<div class="bg-white">
						<button type="button" class="btn btn-outline-warning" data-dismiss="modal" aria-label="Close">{!! trans('landing.form.ok') !!}</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /REQUEST CALLBACK OK MODAL -->
</div>
@endsection
