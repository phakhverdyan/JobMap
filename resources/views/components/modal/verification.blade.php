<!-- MODALS FOR FERIFY EMAIL -->

<!-- VERIFY EMAIL MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade" id="verificationCodeGoTime" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body pb-5">
                <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p class="mt-4 text-center mb-1">
                    {!! trans('modals.verification.it_looks_like_you_did') !!}
                </p>
                <p class="text-center">{!! trans('modals.verification.please_check_your') !!}</p>

                <div class="d-flex flex-column flex-lg-row justify-content-between">
                    <button class="btn btn-primary col-lg-5 col-12 resend-verification-code">{!! trans('modals.verification.resend') !!}</button>
                    <button class="btn btn-outline-primary col-lg-5 col-12" data-toggle="modal" data-dismiss="modal" data-target="#anotherEmail">{!! trans('modals.verification.change_email') !!}</button>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- VERIFY EMAIL MODAL END!!!!!!!!!!!!!!! -->

<!-- NEW EMAIL MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade" id="anotherEmail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body pb-3">
                <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p class="text-center mt-4">
                    {!! trans('modals.verification.to_what_email_should') !!}
                </p>

                <p>
                    <input type="email" name="email" id="email-verification-code" placeholder="Enter Email" class="form-control">
                </p>

                <p>
                    <input type="button" name="change" value="Send" id="send-verification-code" class="btn btn-primary btn-block">
                </p>

            </div>

        </div>
    </div>
</div>
<!-- NEW MODAL END!!!!!!!!!!!!!!! -->

<!-- THANK YOU MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade" id="verificationCodeOk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body pb-3">
                <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p class="text-center mb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="enable-background:new 0 0 50 50; fill:#9BA6B2; vertical-align: middle;" version="1.1" viewBox="0 0 50 50" xml:space="preserve" width="50px" height="50px"><g id="Layer_1"><path d="M1,8.259V9c0,15.767,8.366,30.655,21.835,38.853L25,49.17l2.165-1.318C40.634,39.655,49,24.767,49,9V8.259L25,0.955   L1,8.259z M26.126,46.145L25,46.83l-1.126-0.685C11.209,38.435,3.263,24.538,3.007,9.739L25,3.045l21.993,6.693   C46.737,24.538,38.791,38.435,26.126,46.145z"/><polygon points="15.707,25.293 14.293,26.707 22,34.414 41.707,14.707 40.293,13.293 22,31.586  "/></g><g/></svg>
                </p>
                <p class="text-center mt-4">
                    {!! trans('modals.verification.thank_you_for_verifying') !!}
                </p>
            </div>

        </div>
    </div>
</div>
<!-- THANK YOU MODAL END!!!!!!!!!!!!!!! -->

<!-- MODALS FOR FERIFY EMAIL -->
