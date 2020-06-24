<div class="col-12 pb-3 pt-5 form-tab-content">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row">
                <div class="col-12">
                    <div class="mb-4">
                        <button type="button" class="btn btn-lg btn-outline-primary w-100 p-4" data-toggle="modal"
                                data-target="#editModalReference" id="resume-reference-add">
                            <span class="d-block h3 mb-0">
                                <svg id="Layer_1" width="45px" height="45px" style="enable-background:new 0 0 512 512;"
                                     version="1.1" viewBox="0 0 512 512" xml:space="preserve"
                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><g><path
                                                        d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"
                                                        fill="#007bff"></path></g></g><g><polygon
                                                    points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  "
                                                    fill="#007bff"></polygon></g></g></svg>
                            </span> Add References
                        </button>
                    </div>
                </div>
            </div>
            <div class="row items-list" data-type-item="resume-reference">
                <div class="col-12 hide" id="resume-not-reference">
                    <div class="border bg-light rounded p-2 text-center">
                        <p class="mb-0 text-grey" style="opacity: 0.8;">You don't have any references yet.</p>
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
                    <h5 class="modal-title">References</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                <label>Email of referer</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Enter email of referer" name="email">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Full name of referer</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Enter full name of referer" name="full_name">
                                            </div>
                                            <div class="form-group mb-0">
                                                <label>Company of referer</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Enter company of referer" name="company">
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
                            Send
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
                    <h5 class="modal-title" id="exampleModalLabel">Experience</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                Are you sure you want to save changes?
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-warning" id="resume-reference-confirm-edit-cancel"
                                data-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="resume-reference-confirm-edit">
                            Update
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
                    <h5 class="modal-title" id="exampleModalLabel">Experience</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                Are you sure you want to remove this item?
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="resume-reference-confirm-delete">
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


