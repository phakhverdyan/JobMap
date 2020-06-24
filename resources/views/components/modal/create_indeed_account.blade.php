<div class="modal fade" id="create-indeed-account-modal" tabindex="-1" role="dialog" aria-labelledby="signInModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header pb-0 border-bottom-0">
                <p class="col-12 text large regular blue text-center auth-title">{!! trans('modals.title.connect_indeed_account') !!}</p>
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
                    <form id="create-indeed-account-modal__form" autocomplete="off">
                        <div class="row">
                            <div class="col-md-12">
                                <input class="modal-input mt-0" type="text" placeholder="{!! trans('fields.placeholder.email') !!}" name="email"  autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input class="modal-input" type="password" placeholder="{!! trans('fields.placeholder.password') !!}" name="password" autocomplete="user-password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <a class="modal-button btn btn-primary btn-lg" id="create-indeed-account-modal__form__connect-button" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing...">{!! trans('main.buttons.connect_account') !!}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function() {
            $('#create-indeed-account-modal__form__connect-button').click(function(event) {
                event.preventDefault();
                var $this = $(this);
                var $form = $('#create-indeed-account-modal__form');
                $this.addClass('disabled').text('Processing...');

                new GraphQL('mutation', 'createIndeedAccount', {
                    email:          $form.find('input[name="email"]').val(),
                    password:       $form.find('input[name="password"]').val(),
                    business_id:    business.currentData.id,
                }, [ 'id' ], true, false, function(data) {
                    $this.removeClass('disabled');
                }, function(data) {
                    if (data) {
                        //
                    }

                    $.notify('Indeed Account was connected!', 'success');
                    $('.indeed-account-toggle').prop('checked', true);
                    $('#create-indeed-account-modal').modal('hide');
                    $this.removeClass('disabled');
                }).request();
            });
        });
    </script>
@endpush