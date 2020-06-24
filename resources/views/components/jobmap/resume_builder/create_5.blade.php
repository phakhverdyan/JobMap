<div class="col-12 pb-3 pt-5 form-tab-content">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row">
                <div class="col-12">
                    <div class="mb-4">
                        <button type="button" class="btn btn-lg btn-outline-primary w-100 p-4" data-toggle="modal"
                                data-target="#editModalExperience" id="resume-experience-add">
                            <span class="d-block h3 mb-0">
                                                                            <svg id="Layer_1" width="45px" height="45px"
                                                                                 style="enable-background:new 0 0 512 512;"
                                                                                 version="1.1" viewBox="0 0 512 512"
                                                                                 xml:space="preserve"
                                                                                 xmlns="http://www.w3.org/2000/svg"><g><g><g><path
                                                                                                    d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"
                                                                                                    fill="#007bff"></path></g></g><g><polygon
                                                                                                points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  "
                                                                                                fill="#007bff"></polygon></g></g></svg>
                                                                        </span> Add Experience
                        </button>
                    </div>
                </div>
            </div>
            <div class="row items-list" data-type-item="resume-experience">
                <div class="col-12 hide" id="resume-not-experience">
                    <div class="border bg-light rounded p-2">
                        <p class="mb-0" style="opacity: 0.8;">You did not add an experience yet.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL -->
    <div class="modal fade bd-example-modal-lg" id="editModalExperience" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Experience</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                <div id="resume-experience-form">
                                    <div class="row text-left">
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label>Job position title</label>
                                                <input type="text" class="form-control" placeholder="Enter title"
                                                       name="title">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Company</label>
                                                <input type="text" class="form-control" placeholder="Enter company"
                                                       name="company">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Location</label>
                                                <div class="input-group">
                                                <span class="input-group-addon" id="experience-addon1"><i
                                                            class="glyphicon"></i> </span>
                                                    <input type="text" class="form-control"
                                                           placeholder="Enter location" name="city"
                                                           id="experience-location">
                                                    <input type="hidden" name="location">
                                                    <input type="hidden" name="region">
                                                    <input type="hidden" name="country">
                                                    <input type="hidden" name="country_code">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3" data-field-name="date_from">
                                                <label>From</label>
                                                <div class="form-group mb-1">
                                                    <select class="form-control" name="month_from">
                                                        <option value="">Month</option>
                                                        @for($m = 1; $m <= 12; $m++)
                                                            <option value="{{ date('m', mktime(0, 0, 0, $m, 1)) }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <select class="form-control" name="year_from">
                                                        <option value="">Year</option>
                                                        @for($i = date('Y'); $i>= date('Y') - 70; $i--)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3" data-field-name="date_to">
                                                <label>To</label>
                                                <div class="form-group mb-1">
                                                    <select class="form-control" name="month_to">
                                                        <option value="">Month</option>
                                                        @for($m = 1; $m <= 12; $m++)
                                                            <option value="{{ date('m', mktime(0, 0, 0, $m, 1)) }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <select class="form-control" name="year_to">
                                                        <option value="">Year</option>
                                                        @for($i = date('Y'); $i>= date('Y') - 70; $i--)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row text-left">
                                        <div class="col-12">
                                            <div class="form-group text-left mb-3">
                                                <label class="custom-control custom-checkbox mb-0">
                                                    <input type="checkbox" class="custom-control-input  mb-0"
                                                           name="current"
                                                           value="1">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">I currently work here</span>
                                                </label>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Industry</label>
                                                <select class="form-control" name="industry">
                                                    <option>Select industry</option>
                                                    <option value="1">1998</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-0">
                                                <label>Description</label>
                                                <textarea name="description" maxlength="1000" class="form-control"
                                                          rows="6"></textarea>
                                            </div>
                                            <input type="hidden" name="item-id">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-primary" id="resume-save-experience">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Confirm modal for edit-->
    <div class="modal fade bd-example-modal-lg" id="saveEditModalExperience" tabindex="-1" role="dialog"
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
                        <button type="button" class="btn btn-outline-warning" id="resume-experience-confirm-edit-cancel"
                                data-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="resume-experience-confirm-edit">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Confirm modal for delete-->
    <div class="modal fade bd-example-modal-lg" id="deleteEditModalExperience" tabindex="-1" role="dialog"
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
                        <button type="button" class="btn btn-outline-primary" id="resume-experience-confirm-delete">
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>