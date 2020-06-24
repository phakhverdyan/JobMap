<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUpModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header pb-0 border-bottom-0">
                <p class="col-12 text large regular blue text-center auth-title" id="signUpModal">Sign Up</p>
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="modal-close-icon"><path d="M18.1 19.17l1.4-1.42L1.7.29.3 1.7z"></path><path d="M19.5 1.71L18.1.3.3 17.75l1.4 1.42z"></path></svg>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="contact-form">
                    <div class="row">
                        <div class="col-md-12">
                            <a class="modal-button google google-auth" href="javascript:void(0)" id="">
                                <img class="social-logo" src="{{ asset('img/social/google.png') }}" />
                                Sign Up with Google
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <a class="modal-button facebook facebook-auth" href="javascript:void(0)" id="">
                                <img class="social-logo" src="{{ asset('img/social/facebook.png') }}" />
                                Sign Up with Facebook
                            </a>
                        </div>
                    </div>

                    <div class="division">
                        <div class="line l"></div>
                        <span>or</span>
                        <div class="line r"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <input class="modal-input mailField mt-0" type="text" placeholder="Email">
                        </div>
                    </div>

                    <div class="row nameFieldBox" style="display: none;">
                        <div class="col-md-12">
                            <input class="modal-input" type="text" placeholder="Name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a class="modal-button button__container-blue">Ceate My Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>