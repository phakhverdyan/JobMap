<div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="signInModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header pb-0 border-bottom-0">
                <p class="col-12 text large regular blue text-center auth-title">{!! trans('modals.title.log_in') !!}</p>
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                         class="modal-close-icon">
                        <path d="M18.1 19.17l1.4-1.42L1.7.29.3 1.7z"></path>
                        <path d="M19.5 1.71L18.1.3.3 17.75l1.4 1.42z"></path>
                    </svg>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="contact-form">
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <a class="modal-button google google-auth" href="javascript:void(0)">
                                <img class="social-logo" src="{{ asset('img/social/google.png') }}"/>
                                {!! trans('main.buttons.login_google') !!}
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <a class="modal-button facebook facebook-auth" href="javascript:void(0)">
                                <img class="social-logo" src="{{ asset('img/social/facebook.png') }}"/>
                                {!! trans('main.buttons.login_fb') !!}
                            </a>
                        </div>
                    </div> --}}

                    {{-- <div class="division">
                        <div class="line l"></div>
                        <span>{!! trans('main.or') !!}</span>
                        <div class="line r"></div>
                    </div> --}}

                    <form id="signin-form" autocomplete="off" class="mt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <input class="modal-input mt-0" type="text" placeholder="{!! trans('fields.placeholder.email') !!}" name="email" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input class="modal-input" type="password" placeholder="{!! trans('fields.placeholder.password') !!}" name="password" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pt-3">
                                <a href="#" id="show_reset_password" data-toggle="modal" data-target="#resetPasswordModal">{!! trans('main.buttons.forgot') !!}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a class="modal-button button__container-blue" id="login-button">{!! trans('main.buttons.log_in') !!}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
