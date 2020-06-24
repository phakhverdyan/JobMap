<div class="col-12 pb-3 pt-2 form-tab-content resume-builder-step" data-builder-step="Experience">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row px-3 mb-3">
                <h5 class="h5 mb-3 text w-100 light-grey text-center">{!! trans('resume_builder.experience.first_job') !!}</h5>
                <div class="btn-group w-100" data-toggle="buttons">
                    <label class="btn btn-outline-primary mb-0 py-4 w-50 d-flex flex-column justify-content-center align-items-center">
                        <input name="first_job" id="first-job-yes" type="radio" value="1">
                        <span>
                            <svg class="mr-2" enable-background="new 0 0 48 48" height="40px" width="40px" id="Layer_1" version="1.1" viewBox="0 0 48 48" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle;     margin-top: -3px; width: 20px; height: 20px;">
                                <path clip-rule="evenodd" d="M45.037,28.426C45.629,29.123,46,30.015,46,31.001  c0,1.461-0.792,2.727-1.963,3.424C44.629,35.123,45,36.015,45,37.001c0,1.462-0.793,2.726-1.963,3.424  C43.629,41.122,44,42.014,44,43c0,2.209-1.791,4-4,4l-23.404-0.002v-0.024c-1.602-0.069-3.018-0.824-3.975-1.976H6  c-2.762,0-5-5.373-5-12s2.238-12,5-12h8.387L22,10v-5c0.541-3.262,3-3,3-3c2.212,0,3,1,3,1c3,3,3,8,3,8c0,6.608-3,10-3,10h15  c2.209,0,4,1.791,4,4C47,26.462,46.207,27.728,45.037,28.426z M6,22.998c-0.771,0-3,3.438-3,10s2.229,10,3,10h5.578  c-0.056-0.198-0.119-0.393-0.152-0.6C10.834,39.526,10,34.805,10,30.998c0-4.043,2.203-6.897,3-8h0.002l0,0H6z M43,23H23.561  l2.941-3.325C26.527,19.646,29,16.691,29,11.006c0-0.042-0.054-4.232-2.414-6.591l-0.117-0.105  c-0.673-0.423-1.599-0.314-1.599-0.314c-0.533,0-0.77,0.686-0.87,1.185v5.444l-9.379,13.543l-0.109,0.152  C13.696,25.441,12,27.773,12,30.998c0,3.714,0.867,8.484,1.398,11.073c0.268,1.611,1.648,2.833,3.285,2.904L40,45  c1.103,0,2-0.897,2-2c0-0.584-0.266-1.019-0.487-1.281l-1.529-1.801l2.028-1.211C42.631,38.338,43,37.7,43,37.001  c0-0.584-0.266-1.021-0.488-1.283l-1.528-1.803l2.03-1.209C43.631,32.339,44,31.701,44,31.001c0-0.584-0.266-1.019-0.487-1.281  l-1.529-1.801l2.028-1.211C44.631,26.339,45,25.701,45,25.001C45,23.897,44.103,23,43,23z M7.5,40.998c-0.828,0-1.5-0.672-1.5-1.5  s0.672-1.5,1.5-1.5S9,38.67,9,39.498S8.328,40.998,7.5,40.998z" fill-rule="evenodd"></path>
                            </svg>
                            {!! trans('main.buttons.yes') !!}
                        </span>
                    </label>
                    <label class="btn  btn-outline-primary mb-0 py-4 w-50 d-flex flex-column justify-content-center align-items-center">
                        <input name="first_job" id="first-job-no" type="radio" value="2">
                        <span>
                            <svg class="mr-2" enable-background="new 0 0 48 48" height="40px" width="40px" id="Layer_1" version="1.1" viewBox="0 0 48 48" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle;     margin-top: -3px; width: 20px; height: 20px;">
                                <path clip-rule="evenodd" d="M46,17.995c0,0.986-0.371,1.878-0.963,2.575C46.207,21.269,47,22.534,47,23.995  c0,2.21-1.791,4.001-4,4.001H28c0,0,3,3.392,3,10c0,0,0,5-3,7.999c0,0-0.788,1-3,1c0,0-2.459,0.263-3-3v-4.999l-7.613-10.998H6  c-2.762,0-5-5.373-5-12s2.238-12,5-12h6.621c0.957-1.151,2.373-1.906,3.975-1.976V1.998L40,1.996c2.209,0,4,1.791,4,4  c0,0.986-0.371,1.878-0.963,2.575C44.207,9.27,45,10.533,45,11.995c0,0.986-0.371,1.878-0.963,2.576  C45.208,15.269,46,16.534,46,17.995z M6,5.998c-0.771,0-3,3.438-3,10s2.229,10,3,10h7.002l0,0H13c-0.797-1.103-3-3.957-3-8  c0-3.807,0.834-8.528,1.426-11.4c0.033-0.207,0.097-0.402,0.152-0.6H6z M44.012,22.288l-2.028-1.211l1.529-1.801  C43.734,19.014,44,18.579,44,17.995c0-0.7-0.369-1.338-0.986-1.705l-2.03-1.209l1.528-1.803C42.734,13.016,43,12.579,43,11.995  c0-0.699-0.369-1.337-0.988-1.706l-2.028-1.211l1.529-1.801C41.734,7.015,42,6.58,42,5.996c0-1.103-0.897-2-2-2L16.684,4.021  c-1.637,0.071-3.018,1.293-3.285,2.904C12.867,9.514,12,14.284,12,17.998c0,3.225,1.696,5.557,2.512,6.677l0.109,0.152L24,38.371  v5.443C24.101,44.313,24.337,45,24.87,45c0,0,0.926,0.109,1.599-0.314l0.117-0.105C28.946,42.222,29,38.031,29,37.989  c0-5.685-2.473-8.64-2.498-8.668l-2.941-3.325H43c1.103,0,2-0.897,2-2.001C45,23.295,44.631,22.657,44.012,22.288z M7.5,10.998  c-0.828,0-1.5-0.671-1.5-1.5s0.672-1.5,1.5-1.5S9,8.669,9,9.498S8.328,10.998,7.5,10.998z" fill-rule="evenodd"></path>
                            </svg>
                            {!! trans('main.buttons.no') !!}
                        </span>
                    </label>
                </div>
                <p class="text-center w-100">{!! trans('resume_builder.experience.first_job_sub_text') !!}</p>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="mb-4">
                        <button type="button" class="btn btn-lg btn-outline-primary w-100 p-4" data-toggle="modal"
                                data-target="#editModalExperience" id="resume-experience-add">
                            <span class="d-block h3 mb-0">
                                <svg id="Layer_1" width="45px" height="45px" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                     <g>
                                        <g>
                                            <g>
                                                <path d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"></path>
                                            </g>
                                        </g>
                                        <g>
                                            <polygon
                                            points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  "></polygon>
                                        </g>
                                     </g>
                                </svg>
                            </span>
                            {!! trans('resume_builder.experience.add_btn') !!}
                        </button>
                    </div>
                </div>
            </div>
            <div class="row items-list" data-type-item="resume-experience">
                <div class="col-12 hide" id="resume-not-experience">
                    <div class="border bg-light rounded p-2">
                        <p class="mb-0" style="opacity: 0.8;">{!! trans('resume_builder.experience.no_items') !!}</p>
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
                    <h5 class="modal-title mt-0">{!! trans('modals.title.experience') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
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
                                                <label>{!! trans('fields.label.job_position_title') !!}</label>
                                                {{--<input type="text" class="form-control" placeholder="{!! trans('fields.placeholder.job_position_title') !!}"
                                                       name="title">--}}
                                                <div id="job_subcategories"></div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>{!! trans('fields.label.company') !!}</label>
                                                {{--<input type="text" class="form-control" placeholder="{!! trans('fields.placeholder.company') !!}"
                                                       name="company">--}}
                                                <div id="experience-company"></div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>{!! trans('fields.label.location') !!}</label>
                                                <div class="input-group">
                                                <span class="input-group-addon" id="experience-addon1"><i
                                                            class="glyphicon"></i> </span>
                                                    <input type="text" class="form-control"
                                                           placeholder="{!! trans('fields.placeholder.location') !!}" name="city"
                                                           id="experience-location">
                                                    <span class="input-group-btn border-0">
                                            <button class="btn mx-0" type="button" id="experience-location-clear"
                                                    style="background-color: #e9ecef; border: 1px solid #ced4da; border-left: 0px;">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </span>
                                                    <input type="hidden" name="location">
                                                    <input type="hidden" name="region">
                                                    <input type="hidden" name="country">
                                                    <input type="hidden" name="country_code">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3" data-field-name="date_from">
                                                <label>{!! trans('main.label.from') !!}</label>
                                                <div class="form-group mb-1">
                                                    <select class="form-control" name="month_from">
                                                        <option value="">{!! trans('fields.label.month') !!}</option>
                                                        @for($m = 1; $m <= 12; $m++)
                                                            <option value="{{ date('m', mktime(0, 0, 0, $m, 1)) }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <select class="form-control" name="year_from">
                                                        <option value="">{!! trans('fields.label.year') !!}</option>
                                                        @for($i = date('Y'); $i>= date('Y') - 70; $i--)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3" data-field-name="date_to">
                                                <label>{!! trans('main.label.to') !!}</label>
                                                <div class="form-group mb-1">
                                                    <select class="form-control" name="month_to">
                                                        <option value="">{!! trans('fields.label.month') !!}</option>
                                                        @for($m = 1; $m <= 12; $m++)
                                                            <option value="{{ date('m', mktime(0, 0, 0, $m, 1)) }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <select class="form-control" name="year_to">
                                                        <option value="">{!! trans('fields.label.year') !!}</option>
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
                                                    <span class="custom-control-description">{!! trans('fields.label.currently_work') !!}</span>
                                                </label>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>{!! trans('fields.label.industry') !!}</label>
                                                <div id="industry_id"></div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>{!! trans('fields.label.sub_industry') !!}</label>
                                                <div id="sub_industry_id"></div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>{!! trans('fields.label.description') !!}</label>
                                                <textarea name="description" maxlength="1000" class="form-control"
                                                          rows="6"></textarea>
                                            </div>
                                            <div class="form-group mb-0">
                                                <label>{!! trans('fields.label.additional_info') !!}</label>
                                                <textarea name="additional_info" maxlength="1000" class="form-control"
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
                            {!! trans('main.buttons.save') !!}
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
                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.experience') !!}</h5>
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
                        <button type="button" class="btn btn-outline-warning" id="resume-experience-confirm-edit-cancel"
                                data-dismiss="modal" aria-label="{!! trans('main.buttons.cancel') !!}">
                            {!! trans('main.buttons.cancel') !!}
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="resume-experience-confirm-edit">
                            {!! trans('main.buttons.update') !!}
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
                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.experience') !!}</h5>
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
                        <button type="button" class="btn btn-outline-primary" id="resume-experience-confirm-delete">
                            {!! trans('main.buttons.remove') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>