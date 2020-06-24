<!--Confirm modal for logout-->
<div class="modal fade bd-example-modal-lg" id="logoutModal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">{!! trans('modals.logout') !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="conteiner">
                    <div class="row justify-content-center">
                        <div class="col-11">
                            {!! trans('modals.are_you_sure_you_want_to_logout') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center bg-light">
                <div class="bg-white">
                    <button type="button" class="btn btn-outline-warning" data-dismiss="modal" aria-label="Close">
                        {!! trans('modals.cancel') !!}
                    </button>
                    <button type="button" class="btn btn-outline-primary" id="confirm-logout-button">
                        {!! trans('modals.logout') !!}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>