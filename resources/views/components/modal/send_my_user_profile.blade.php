<!-- EMAIL MODAL -->
<div class="modal fade" id="emailmodal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header pt-0">
				<h5 class="modal-title">{!! trans('modals.title.send_cloudresume') !!}</h5>
				<button type="button" class="close text-right" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pb-5">
				<div class="col-12">
					<p>{!! trans('modals.text.who_are_sending') !!}</p>
					<div class="btn-group w-100" data-toggle="buttons">
						<label class="btn btn-outline-primary mb-0 py-4 w-50 d-flex flex-column justify-content-center align-items-center"
							   data-toggle="tooltip" data-placement="top" title="Coming soon">
							<input type="radio" name="type"  autocomplete="off" value="Friend">
							{!! trans('resume_builder.header.friend') !!}
						</label>
						<label class="btn btn-outline-primary mb-0 py-4 w-50 d-flex flex-column justify-content-center align-items-center active">
							<input type="radio" name="type"  autocomplete="off" value="HR/Manager" checked>
							{!! trans('resume_builder.header.hr_manager') !!}
						</label>
					</div>
				</div>
				<div class="col-12 mt-3">
					<input type="email" name="email" class="form-control" placeholder="{!! trans('fields.placeholder.send_cr_email_friend_manager') !!}">
				</div>
				<div class="col-12 mt-3">
					<textarea name="message" class="form-control" placeholder="{!! trans('fields.placeholder.send_cr_notes') !!}"></textarea>
				</div>
				<div class="col-6 mx-auto mt-3">
					<button type="button" id="send-my-user-profile" class="btn btn-block btn-outline-primary">{!! trans('main.buttons.send') !!}</button>
				</div>

			</div>

		</div>
	</div>
</div>
<!-- EMAIL MODAL -->


<div class="modal fade bd-example-modal-lg" id="okSendMyUserProfile" tabindex="-1" role="dialog"
	 aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title mt-0" id="exampleModalLabel">{!! trans('modals.title.you_sent_link') !!}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-11">{!! trans('modals.text.profile_link_sent') !!}</div>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-center bg-light">
				<div class="bg-white">
					<button type="button" class="btn btn-outline-warning" data-dismiss="modal" aria-label="Close">{!! trans('main.buttons.ok') !!}</button>
				</div>
			</div>
		</div>
	</div>
</div>
