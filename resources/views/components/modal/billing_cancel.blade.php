<!--Plan cancel modal-->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="logoutModalLabel">Cancel Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="conteiner">
                    <div class="row justify-content-center">
                        <div class="col-11">
                            <p class="mb-2">{!! trans('pages.billing.billing_cancel.were_sad') !!}</p>
                            <p>{!! trans('pages.billing.billing_cancel.lets_get_in_touch') !!}</p>
                            <p class="mb-0"><small>{!! trans('pages.billing.billing_cancel.reachable_phone') !!}</small></p>
                            <p><input type="text" name="cancel-plan-phone" class="form-control" placeholder="{!! trans('pages.billing.billing_cancel.input_number_placeholder') !!}"></p>
                            <p>{!! trans('pages.billing.billing_cancel.your_next_monthly') !!}</p>
                            <p class="text-center">
                                <button type="button" class="btn btn-outline-secondary" id="cancelModal__confirm">
                                    {!! trans('pages.billing.billing_cancel.confirm_cancelation') !!}
                                </button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                                    {!! trans('pages.billing.billing_cancel.close') !!}
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!--/Plan cancel modal-->