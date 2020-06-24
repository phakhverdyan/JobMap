<!-- SHARE MODAL!!!!!!!!!!!!!!! -->
{{--	<div class="modal fade" id="ShareModal" tabindex="-1" role="dialog" aria-hidden="true">
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
	       	 <input class="form-control text-center" type="text" name="sharelink" value="jobmap.co/l/434343" readonly>
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

<!-- SHARE MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade" id="ShareModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header pt-0">
				<h5 class="modal-title">Share this job</h5>
				<button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pb-5">
				<p>
					<strong>Share this job, get more applicants</strong>
				</p>
				<p>
					<div class="btn-group w-100" role="group" aria-label="Basic example">
						<input id="share-link" class="form-control text-center" type="text" name="sharelink" value="" readonly>
                        <input id="share-link-title" class="form-control text-center border-top-right-0 border-bottom-right-0" type="text" name="sharelinktitle" value="" readonly hidden>
                        <input id="share-link-description" class="form-control text-center border-top-right-0 border-bottom-right-0" type="text" name="sharelinktitle" value="" readonly hidden>
                        <input id="share-link-image" class="form-control text-center border-top-right-0 border-bottom-right-0" type="text" name="sharelinkimage" value="" readonly hidden>
						<button type="button" class="btn btn-outline-primary" data-clipboard-action="copy" data-clipboard-target="#share-link" id="clipboard-button">Copy</button>
					</div>
				</p>
				<p>
					<strong>Share job via email</strong>
				</p>
				<p>
					<div class="btn-group w-100" role="group" aria-label="Basic example">
						<input class="form-control" type="text" name="sharelink" placeholder="Enter an email" id="ShareModal__email">
						<button class="btn btn-primary" id="ShareModal__send">Send</button>
					</div>
				</p>
				<p class="mt-3">
					<strong>Share to social media</strong>
				</p>
				<ul style="list-style: none; display: inline-flex;" class="pl-0">
					<li class="pr-3" id="shareLinkedin"><a href="javascript:;"><img src="{{ asset('img/social/linkedin.png') }}" alt="" height="50" /></a></li>
					<li class="pr-3" id="shareFacebook"><a href="javascript:;"><img src="{{ asset('img/social/facebook.png') }}" alt="" height="50" /></a></li>
					<!-- <li class="pr-3" id="shareGoogle"><a href="javascript:;"><img src="{{ asset('img/social/google.png') }}" alt="" height="50" /></a></li> -->
					<!-- <li class="pr-3" id="shareTwitter"><a href="javascript:;"><img src="{{ asset('img/social/twitter.png') }}" alt="" height="50" /></a></li> -->
				</ul>
				<p><strong>Why?</strong> This will bring you more visibility and candidates for free.</p>
			</div>

		</div>
	</div>
</div>
<!-- SHARE MODAL END!!!!!!!!!!!!!!! -->
