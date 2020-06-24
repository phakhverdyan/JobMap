<div class="col-12 pb-3 pt-5 form-tab-content">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row">
                <div class="col-12">
                    <div class="mb-4">
                        <button type="button" class="btn btn-lg btn-outline-primary w-100 p-4" data-toggle="modal"
                                data-target="#editModalEducation" id="resume-education-add">
                            <span class="d-block h3 mb-0">
                                                                            <svg id="Layer_1" width="45px" height="45px"
                                                                                 style="enable-background:new 0 0 512 512;"
                                                                                 version="1.1" viewBox="0 0 512 512"
                                                                                 xml:space="preserve"
                                                                                 xmlns="http://www.w3.org/2000/svg"
                                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><g><path
                                                                                                    d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"
                                                                                                    fill="#007bff"></path></g></g><g><polygon
                                                                                                points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  "
                                                                                                fill="#007bff"></polygon></g></g></svg>
                                                                        </span> Add Education
                        </button>
                    </div>
                </div>
            </div>
            <div class="row items-list" data-type-item="resume-education">
                <div class="col-12 hide" id="resume-not-education">
                    <div class="border bg-light rounded p-2">
                        <p class="mb-0" style="opacity: 0.8;">You did not add an education yet.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL -->
    <div class="modal fade bd-example-modal-lg" id="editModalEducation" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Education</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                <div id="resume-education-form">
                                <div class="row text-left justify-content-center">
                                    <div class="col-12 text-left">
                                        <div class="form-group mb-3">
                                            <label>School Name</label>
                                            <input type="text" class="form-control" name="school_name" placeholder="School Name ( ex. Boston University)">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label>Location</label>
                                            <div class="input-group">
                                                <span class="input-group-addon" id="education-addon1"><i
                                                            class="glyphicon"></i> </span>
                                                <input type="text" class="form-control" placeholder="Enter location" name="city"
                                                       id="education-location">
                                                <input type="hidden" name="location">
                                                <input type="hidden" name="region">
                                                <input type="hidden" name="country">
                                                <input type="hidden" name="country_code">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-left align-items-end mb-3">
                                    <div class="col-4">
                                        <div class="form-group mb-0">
                                            <select class="form-control" name="year_from">
                                                <option value="">From year</option>
                                                @for($i = date('Y'); $i>= date('Y') - 70; $i--)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group mb-0">
                                            <select class="form-control" name="year_to">
                                                <option value="">To year</option>
                                                @for($i = date('Y'); $i>= date('Y') - 70; $i--)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group mb-0">
                                            <label>Grade</label>
                                            <input type="text" class="form-control" placeholder="Grade" name="grade">
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-left mb-3">
                                    <div class="col-12">
                                        <div class="form-group text-left mb-3">
                                            <label class="custom-control custom-checkbox mb-0">
                                                <input type="checkbox" class="custom-control-input  mb-0" name="current"
                                                       value="1">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">I currently study here</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mb-0">
                                            <label>Degree</label>
                                            <input type="text" class="form-control" placeholder="Degree ( ex. Bachelor’s )" name="degree">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mb-0">
                                            <label>Field of study</label>
                                            <input type="text" class="form-control" placeholder="Field of study ( ex. Computer Science )" name="study">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label>Activities and societies</label>
                                            <textarea maxlength="1000" class="form-control" rows="3" name="activities"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label>Description</label>
                                            <textarea maxlength="1000" class="form-control" rows="3" name="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label>Achievement title</label>
                                            <input type="text" class="form-control" placeholder="Enter achievement" name="achievement_title">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label>Achievement description</label>
                                            <textarea maxlength="1000" class="form-control" rows="3" name="achievement_description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                    <input type="hidden" name="item-id">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-primary" id="resume-save-education">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Confirm modal for edit-->
    <div class="modal fade bd-example-modal-lg" id="saveEditModalEducation" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Education</h5>
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
                        <button type="button" class="btn btn-outline-warning" id="resume-education-confirm-edit-cancel"
                                data-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="resume-education-confirm-edit">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Confirm modal for delete-->
    <div class="modal fade bd-example-modal-lg" id="deleteEditModalEducation" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Education</h5>
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
                        <button type="button" class="btn btn-outline-primary" id="resume-education-confirm-delete">
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>