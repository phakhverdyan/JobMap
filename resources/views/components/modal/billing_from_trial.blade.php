<!--Confirm modal for logout-->
<div class="modal fade" id="fromTrial" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="logoutModalLabel">{!! trans('modals.from_trial_to_paid.title') !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="conteiner">
                    <div class="row justify-content-center">
                        <div class="col-11">
                            <p class="text-center mb-2" style="font-size: 17px;">{!! trans('modals.from_trial_to_paid.love_our') !!}</p>
                            <p class="text-center" style="font-size: 17px;">{!! trans('modals.from_trial_to_paid.need_more') !!}</p>
                            <p class="text-center">
                                <a href="{!! url('/business/billing') !!}" type="button" class="btn btn-primary rounded" data-dismiss="modal" aria-label="Close" role="button">
                                    {!! trans('modals.from_trial_to_paid.bring_me_to') !!}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>