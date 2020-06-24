<div class="card-footer py-4 mt-0 bg-white" style="border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
    <div class="d-inline-block bg-white">
        <button type="button" class="btn btn-primary" id="resume-builder-step-save">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 448.8 448.8" style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px; fill:#fff;" xml:space="preserve"><g><g id="check"><polygon points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"></polygon></g></g></svg>
            {!! trans('main.buttons.save_continue') !!}
        </button>
    </div>
</div>

<!--Info modal for edit-->
<div class="modal fade bd-example-modal-lg" id="infoModal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="certificationModalLabel">Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="conteiner">
                    <div class="row justify-content-center">
                        <div class="col-11">
                            At any time you can change this choice
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <div class="bg-white">
                    <button type="button" class="btn btn-outline-warning" data-dismiss="modal" aria-label="Close">
                        {!! trans('main.buttons.got_it') !!}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>