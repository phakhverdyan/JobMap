<!-- SHARE MODAL!!!!!!!!!!!!!!! -->
	{{--<div class="modal fade" id="ShareModal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h5></h5>
	        <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body pb-5">
	       	 <p><strong>Share this location, get more applicants</strong></p>
	       	 <input class="form-control text-center" type="text" name="sharelink" value="/l/434343" readonly>
	         <button type="button" class="btn btn-primary btn-block mt-3" role='button'>Copy link</button>
	      </div>

	    </div>
	  </div>
	</div>--}}
	<!-- SHARE MODAL END!!!!!!!!!!!!!!! -->
{{-- job share ##################################--}}

<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId            : '{!! config('services.facebook.client_id') !!}',
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v3.0'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

{{--<script src="https://apis.google.com/js/client:platform.js" async defer></script>--}}

<!-- SELECT SHARE MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade bd-example-modal-lg" id="selectShareModal" tabindex="-1" role="dialog"
	 aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.share') !!}</h5>
				<button type="button" class="close mt-0" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-11">
							{!! trans('modals.text.share_link_all') !!}
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-center bg-light">
				<div class="bg-white">
					<button type="button" class="btn btn-outline-warning" data-dismiss="modal"
							aria-label="Close" id="business-job-cancel-share">
						{!! trans('main.buttons.no') !!}
					</button>
					<button type="button" class="btn btn-outline-primary" data-dismiss="modal"
							aria-label="Close" id="business-job-confirm-share">
						{!! trans('main.buttons.yes') !!}
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- SELECT SHARE MODAL END!!!!!!!!!!!!!!! -->

<!-- SHARE MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade" id="ShareModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header pt-0">
				<h5 class="modal-title">{!! trans('modals.title.share') !!}</h5>
				<button type="button" class="close text-right mt-0" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pb-5">
				<div class="d-flex justify-content-between mb-3">
					<p class="mb-0">
						<strong>{!! trans('modals.text.share_get_more') !!}</strong>
					</p>

				</div>
				<p>
				<div class="btn-group w-100" role="group" aria-label="Basic example">
                    <input id="share-link" class="form-control text-center border-top-right-0 border-bottom-right-0" type="text" name="sharelink" value="" readonly>
                    <input id="share-link-title" class="form-control text-center border-top-right-0 border-bottom-right-0" type="text" name="sharelinktitle" value="" readonly hidden>
                    <input id="share-link-description" class="form-control text-center border-top-right-0 border-bottom-right-0" type="text" name="sharelinktitle" value="" readonly hidden>
					<input id="share-link-image" class="form-control text-center border-top-right-0 border-bottom-right-0" type="text" name="sharelinkimage" value="" readonly hidden>
					<button type="button" class="btn btn-outline-primary" data-clipboard-action="copy" data-clipboard-target="#share-link" id="clipboard-button">{!! trans('main.buttons.copy_btn') !!}</button>
				</div>
				</p>
				<p>
					<strong>{!! trans('modals.text.share_via_email') !!}</strong>
				</p>
				<p>
                <div class="btn-group w-100" role="group" aria-label="Basic example">
                    <input class="form-control border-top-right-0 border-bottom-right-0" type="text" name="sharelink" placeholder="{!! trans('fields.placeholder.email') !!}" id="share-link-email">
                    <a class="btn btn-primary" id="share-link-send-email">{!! trans('main.buttons.send') !!}</a>
                </div>
				</p>
				<p class="mt-3">
					<strong>{!! trans('modals.text.share_social') !!}</strong>
				</p>
				<ul style="list-style: none; display: inline-flex;" class="pl-0">
					<li class="pr-3" id="shareLinkedin"><a href="javascript:;"><img src="{{ asset('img/social/linkedin.png') }}" alt="" height="50" /></a></li>
					<li class="pr-3" id="shareFacebook"><a href="javascript:;"><img src="{{ asset('img/social/facebook.png') }}" alt="" height="50" /></a></li>
					<!-- <li class="pr-3" id="shareGoogle"><a href="javascript:;"><img src="{{ asset('img/social/google.png') }}" alt="" height="50" /></a></li> -->
					<!-- <li class="pr-3" id="shareTwitter"><a href="javascript:;"><img src="{{ asset('img/social/twitter.png') }}" alt="" height="50" /></a></li> -->
				</ul>
				<p>{!! trans('modals.text.share_why') !!}</p>
			</div>

		</div>
	</div>
</div>
<!-- SHARE MODAL END!!!!!!!!!!!!!!! -->

<!-- Custom job share for location MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade" id="customShareModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header pt-0">
				<h5 class="modal-title">{!! trans('modals.title.share_for_location') !!}</h5>
				<button type="button" class="close mt-0" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pb-5">
				<div class="row pb-3 pt-1 px-3">
					<div class="col-lg-6 col-12 pxa-0 pl-0">
						<button type="button" class="btn btn-outline-primary btn-block"
								role="button" id="share-all">{!! trans('main.buttons.share_all') !!}
						</button>
					</div>
				</div>

				<div class="row py-3 card border rounded-0 border-top-0">
					<h5 class="pl-3 pb-2 open-header_share">{!! trans('modals.text.open') !!}</h5>

				</div>

				<div class="row py-3">
					<h5 class="pl-3 pb-2 close-header_share">{!! trans('modals.text.closed') !!}</h5>

				</div>

			</div>

		</div>
	</div>
</div>
<!-- Custom job share for location MODAL END!!!!!!!!!!!!!!! -->

<!-- SHARE MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade" id="ShareModalUBis" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header pt-0">
				<h5 class="modal-title">{!! trans('modals.title.share') !!}</h5>
				<button type="button" class="close text-right mt-0" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pb-5">
				<p>
					<strong>{!! trans('modals.text.share_get_more') !!}</strong>
				</p>
				<p>
				<div class="btn-group w-100" role="group" aria-label="Basic example">
					<input id="share-link-ubis" class="form-control text-center border-top-right-0 border-bottom-right-0" type="text" name="sharelink"
						   value="{{ isset($data->id) && isset($data->name) ? (url('/').'/unconfirmed-business/view/'.$data->id.'/'.$data->name) : '' }}" readonly>
					<button type="button" class="btn btn-outline-primary" data-clipboard-action="copy" data-clipboard-target="#share-link-ubis" id="clipboard-button">{!! trans('main.buttons.copy_btn') !!}</button>
				</div>
				</p>
				<p>
					<strong>{!! trans('modals.text.share_via_email') !!}</strong>
				</p>
				<p>
				<div class="btn-group w-100" role="group" aria-label="Basic example">
					<input class="form-control border-top-right-0 border-bottom-right-0" type="text" id="UshareEmailInput" name="share_link" placeholder="{!! trans('fields.placeholder.email') !!}">
					<button class="btn btn-primary" id="UshareEmailSend">{!! trans('main.buttons.send') !!}</button>
				</div>
				</p>
				<p class="mt-3">
					<strong>{!! trans('modals.text.share_social') !!}</strong>
				</p>
				<ul style="list-style: none; display: inline-flex;" class="pl-0">
					<li class="pr-3" id="UshareLinkedin"><a href="javascript:;"><img src="{{ asset('img/social/linkedin.png') }}" alt="" height="50" /></a></li>
					<li class="pr-3" id="UshareFacebook"><a href="javascript:;"><img src="{{ asset('img/social/facebook.png') }}" alt="" height="50" /></a></li>
					<li class="pr-3" id="UshareGoogle"><a href="javascript:;"><img src="{{ asset('img/social/google.png') }}" alt="" height="50" /></a></li>
					<li class="pr-3" id="UshareTwitter"><a href="javascript:;"><img src="{{ asset('img/social/twitter.png') }}" alt="" height="50" /></a></li>
				</ul>
				<p>{!! trans('modals.text.share_why') !!}</p>
			</div>

		</div>
	</div>
</div>
<!-- SHARE MODAL END!!!!!!!!!!!!!!! -->
