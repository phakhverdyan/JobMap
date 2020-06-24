

<div class="modal fade bd-example-modal-lg" id="notifyModal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.send_CR') !!}</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="conteiner">
                    <div class="row justify-content-center">
                        <div class="col-11" id="send-resume-message">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center bg-light">
                <div class="bg-white">
                    <button type="button" class="btn btn-outline-warning"
                            data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        {!! trans('main.buttons.close') !!}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>