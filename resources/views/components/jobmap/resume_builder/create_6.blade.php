<div class="col-12 pb-3 pt-5 form-tab-content">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row">
                <div class="col-12">
                    <div class="mb-4">
                        <button type="button" class="btn btn-lg btn-outline-primary w-100 p-4" data-toggle="modal"
                                data-target="#editModalSkill" id="resume-skill-add">
                            <span class="d-block h3 mb-0">
                                <svg id="Layer_1" width="45px" height="45px" style="enable-background:new 0 0 512 512;"
                                     version="1.1" viewBox="0 0 512 512" xml:space="preserve"
                                     xmlns="http://www.w3.org/2000/svg"><g><g><g><path
                                                        d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"
                                                        fill="#007bff"></path></g></g><g><polygon
                                                    points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  "
                                                    fill="#007bff"></polygon></g></g></svg>
                            </span> Add Skills
                        </button>
                    </div>
                </div>
            </div>
            <div class="row items-list" data-type-item="resume-skill">
                <div class="col-12 hide" id="resume-not-skill">
                    <div class="border bg-light rounded p-2 text-center">
                        <p class="mb-0" style="opacity: 0.8;">You did not add any Skills yet.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="mb-4">
                        <button type="button" class="btn btn-lg btn-outline-primary w-100 p-4" data-toggle="modal"
                                data-target="#editModalLanguage" id="resume-language-add">
                            <span class="d-block h3 mb-0">
                                <svg id="Layer_1" width="45px" height="45px" style="enable-background:new 0 0 512 512;"
                                     version="1.1" viewBox="0 0 512 512" xml:space="preserve"
                                     xmlns="http://www.w3.org/2000/svg"><g><g><g><path
                                                        d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"
                                                        fill="#007bff"></path></g></g><g><polygon
                                                    points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  "
                                                    fill="#007bff"></polygon></g></g></svg>
                                </span> Add Languages
                        </button>
                    </div>
                </div>
            </div>
            <div class="row items-list" data-type-item="resume-language">
                <div class="col-12 hide" id="resume-not-language">
                    <div class="border bg-light rounded p-2 text-center">
                        <p class="mb-0" style="opacity: 0.8;">You did not add any Languages yet.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODALS -->
    <div class="modal fade" id="editModalSkill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Skills</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div id="resume-skill-form">
                                            <div class="form-group mb-3">
                                                <label class="text-grey">Skill title</label>
                                                <input type="text" class="form-control" placeholder="Enter skill"
                                                       name="title">
                                            </div>
                                            <div class="form-group mb-0">
                                                <label class="text-grey">Skill description</label>
                                                <textarea maxlength="1000" class="form-control" rows="3"
                                                          name="description"></textarea>
                                            </div>
                                            <!-- SKILL SLIDER BEGIN -->
                                            <div class="pt-4 pl-0 pr-3">
                                                <label>Skill level</label>
                                                <div class="row">
                                                    <div class="col-md-9 pt-2 mt-1 pl-4">
                                                        <div id="skill-slider-range-min"></div>
                                                    </div>
                                                    <div class="col-md-2 card text-center offset-md-1"
                                                         style="background-color: #eee;">
                                                        <!-- <input type="text" id="amount" class="form-control" readonly> -->
                                                        <h5 class="my-0 py-1" id="skill-slider-amount"
                                                            style="opacity: 0.6;">0%</h5>
                                                    </div>
                                                </div>
                                                <!-- SKILL SLIDER END -->
                                                <input type="hidden" name="item-id">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-primary" id="resume-save-skill">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModalLanguage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Languages</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div id="resume-language-form">
                                            <div class="form-group mb-3">
                                                <label>Language title</label>
                                                <input type="text" class="form-control" placeholder="Enter language"
                                                       name="title">
                                            </div>
                                            <!-- SKILL SLIDER BEGIN -->
                                            <div class="pt-4 pl-0 pr-3">
                                                <label>Language level</label>
                                                <div class="row">
                                                    <div class="col-md-9 pt-2 mt-1 pl-4">
                                                        <div id="language-slider-range-min"></div>
                                                    </div>
                                                    <div class="col-md-2 card text-center offset-md-1"
                                                         style="background-color: #eee;">
                                                        <!-- <input type="text" id="amount" class="form-control" readonly> -->
                                                        <h5 class="my-0 py-1" id="language-slider-amount"
                                                            style="opacity: 0.6;">
                                                            0%</h5>
                                                    </div>
                                                </div>
                                                <!-- SKILL SLIDER END -->
                                                <input type="hidden" name="item-id">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-primary" id="resume-save-language">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Confirm modal for edit-->
    <div class="modal fade bd-example-modal-lg" id="saveEditModalSkill" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="skillModalLabel">Skill</h5>
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
                        <button type="button" class="btn btn-outline-warning" id="resume-skill-confirm-edit-cancel"
                                data-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="resume-skill-confirm-edit">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Confirm modal for delete-->
    <div class="modal fade bd-example-modal-lg" id="deleteEditModalSkill" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="skillDeleteModalLabel">Skill</h5>
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
                        <button type="button" class="btn btn-outline-primary" id="resume-skill-confirm-delete">
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Confirm modal for edit-->
    <div class="modal fade bd-example-modal-lg" id="saveEditModalLanguage" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="languageModalLabel">Language</h5>
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
                        <button type="button" class="btn btn-outline-warning" id="resume-language-confirm-edit-cancel"
                                data-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="resume-language-confirm-edit">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Confirm modal for delete-->
    <div class="modal fade bd-example-modal-lg" id="deleteEditModalLanguage" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="languageDeleteModalLabel">Language</h5>
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
                        <button type="button" class="btn btn-outline-primary" id="resume-language-confirm-delete">
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
