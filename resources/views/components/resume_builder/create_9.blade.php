<div class="col-12 pb-3 pt-5 form-tab-content">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row">
                <div class="col-12">
                    <div>
                        {{--<button type="button" class="btn btn-lg btn-outline-primary w-100 p-4" data-toggle="modal" data-target="#editModalReference" id="resume-reference-add">--}}
                        <a href="{!! url('/user/references') !!}" class="btn btn-lg btn-outline-primary w-100 p-4" id="resume-builder__goto-references">
                            <span class="d-block h3 mb-0">
                                <svg id="Layer_1" width="45px" height="45px" style="enable-background:new 0 0 512 512;"
                                     version="1.1" viewBox="0 0 512 512" xml:space="preserve"
                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                     <g>
                                        <g>
                                            <g>
                                                <path d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"></path>
                                            </g>
                                        </g>
                                        <g>
                                            <polygon points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  "></polygon>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                            {!! trans('resume_builder.reference.add_btn') !!}
                        </a>
                    </div>
                    <p class="text-center mb-4">{!! trans('resume_builder.reference.text') !!}b</p>
                </div>
            </div>
            <div class="row items-list" data-type-item="resume-reference">
                <div class="col-12 hide" id="resume-not-reference">
                    <div class="border bg-light rounded p-2 text-center">
                        <p class="mb-0 text-grey" style="opacity: 0.8;">{!! trans('resume_builder.reference.no_items') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL -->
    <div class="modal fade" id="editModalReference" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{!! trans('modals.title.reference') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row mb-4">
                            <div class="col-12">
                                <div id="resume-reference-form">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label>{!! trans('fields.label.email_referer') !!}</label>
                                                <input type="text" class="form-control"
                                                       placeholder="{!! trans('fields.placeholder.email_referer') !!}" name="email" readonly>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>{!! trans('fields.placeholder.phone_number') !!}</label>
                                                <input type="text" class="form-control"
                                                       placeholder="{!! trans('fields.placeholder.phone_referer') !!}" name="phone" readonly>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>{!! trans('fields.label.full_name_referer') !!}</label>
                                                <input type="text" class="form-control"
                                                       placeholder="{!! trans('fields.placeholder.full_name_referer') !!}" name="full_name">
                                            </div>
                                            <div class="form-group mb-0">
                                                <label>{!! trans('fields.label.company_referer') !!}</label>
                                                <input type="text" class="form-control"
                                                       placeholder="{!! trans('fields.placeholder.company_referer') !!}" name="company">
                                            </div>
                                        </div>
                                        <input type="hidden" name="item-id">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-primary" id="resume-save-reference">
                            {!! trans('main.buttons.send') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Confirm modal for edit-->
    <div class="modal fade bd-example-modal-lg" id="saveEditModalReference" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.reference') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                {!! trans('modals.text.update') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-warning" id="resume-reference-confirm-edit-cancel"
                                data-dismiss="modal" aria-label="{!! trans('main.buttons.cancel') !!}">
                            {!! trans('main.buttons.cancel') !!}
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="resume-reference-confirm-edit">
                            {!! trans('main.buttons.update') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Confirm modal for delete-->
    <div class="modal fade bd-example-modal-lg" id="deleteEditModalReference" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.reference') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                {!! trans('main.buttons.remove') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal" aria-label="{!! trans('main.buttons.cancel') !!}">
                            {!! trans('main.buttons.cancel') !!}
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="resume-reference-confirm-delete">
                            {!! trans('main.buttons.remove') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


