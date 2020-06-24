        <div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- <div class="modal-header pb-0 border-bottom-0">
                        <h5 class="col-12 text large regular blue text-center auth-title" id="resetPasswordModal">Reset Password</h5>
                        <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="modal-close-icon"><path d="M18.1 19.17l1.4-1.42L1.7.29.3 1.7z"></path><path d="M19.5 1.71L18.1.3.3 17.75l1.4 1.42z"></path></svg>
                        </button>
                    </div> -->
                    <div class="modal-header pb-0 border-bottom-0">
                        <p class="col-12 text large regular blue text-center auth-title">{!! trans('modals.title.reset_password') !!}</p>
                        <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                 class="modal-close-icon">
                                <path d="M18.1 19.17l1.4-1.42L1.7.29.3 1.7z"></path>
                                <path d="M19.5 1.71L18.1.3.3 17.75l1.4 1.42z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="contact-form">
                            <div class="row">
                                <div class="col-md-12">
                                    <input class="modal-input mt-0" type="text" placeholder="Email" name="email">
                                </div>
                            </div>

                            {{--<div class="row">
                                <div class="col-md-12">
                                    <a class="modal-button button__container-blue mb-3">{!! trans('main.buttons.send') !!}</a>
                                </div>
                            </div>--}}
                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <a class="modal-button btn btn-primary" id="reset-password-button">{!! trans('main.buttons.send') !!}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span id="resetPasswordResponseModal">{!! trans('modals.title.check_your_email') !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>