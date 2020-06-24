
<div class="modal fade" id="editCandidate" tabindex="-1" role="dialog" aria-labelledby="signInModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="business-bg-modal-label">{!! trans('main.buttons.edit_candidate') !!}</h5>
                <button type="button" class="close mt-0" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 5px; right: 10px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0" style="position: relative;">
                <div class="col-12 text-center mt-3">
                    <form id="candidate_edit-form" autocomplete="off" class="candidate__user-form">
                        <input type="hidden" name="id">
                        <input type="hidden" name="delete_resume" value="false" id="candidate_resume_delete_input">
                        <div class="row mb-3">
                            <div class="align-self-center col-lg-6">
                                <label for="first_name" style="text-align: left;">First Name</label>
                                <input id="first_name" type="text" name="first_name" placeholder="First Name" class="form-control">
                            </div>
                            <div class="align-self-center col-lg-6">
                                <label for="last_name" style="text-align: left;">Last Name</label>
                                <input id="last_name" type="text" name="last_name" placeholder="Last Name" class="form-control">
                            </div>
                        </div>
                        <p>
                            <label for="email" style="text-align: left;">Email</label>
                            <input id="email" type="email" name="email" placeholder="Email" class="form-control">
                        </p>

                        {{--                <p><input type="text" name="mobile_phone" placeholder="Phone Number" class="form-control"></p>--}}

                        <div class="d-flex flex-column flex-lg-row mb-3">
                            <div class="col-12 col-lg-6 pl-0 pxa-0">
                                <label style="text-align: left;">{!! trans('fields.label.phone_code') !!}</label>
                                <div id="country-phone" class="bfh-selectbox bfh-countries"
                                     data-country="CA" data-flags="true">
                                    <input type="hidden" name="phone_country_code" value="CA"
                                           class="country"><a
                                            class="bfh-selectbox-toggle   form-control"
                                            role="button" data-toggle="bfh-selectbox" href="#"
                                            style="padding: 8px 20px;">
                                                            <span class="bfh-selectbox-option" id="phone_code">
                                                                <i class="glyphicon bfh-flag-CA"></i>+1 <span>Canada</span></span></a>
                                    <div class="bfh-selectbox-options">
                                        <div class="bfh-selectbox-filter-container"><input
                                                    type="text"
                                                    class="bfh-selectbox-filter form-control"
                                                    placeholder="search"  autocomplete="off"></div>
                                        @include('components.phone_flag')</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 pr-0 pxa-0">
                                <label for="input-phone" style="text-align: left;">{!! trans('fields.label.phone_number') !!}</label>
                                <input type="tel" class="form-control" id="input-phone"  autocomplete="off"
                                       placeholder="{!! trans('fields.placeholder.phone_number') !!}" name="phone_number">
                            </div>
                        </div>

                        <div class=" flex-lg-row flex-column w-100" style="position: relative;">
                            <div class="col-12 pr-0 pl-0">
                                <label style="text-align: left;" for="field-location">Enter candidate city</label>
                            </div>
                            <div class="d-flex mb-3 col-12 pr-0 pl-0">
                                                              <span class="input-group-addon" id="basic-addon1"
                                                                    style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                                                                  <i class="glyphicon"></i>
                                                              </span>
                                <input type="text" class="form-control border-right-0"
                                       placeholder="Enter candidate city" name="location"
                                       id="field-location"  autocomplete="off" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                <span class="input-group-btn border-0 hide"
                                      style="border-top-right-radius: 10px; border-bottom-right-radius: 10px; position: absolute; top: 7px;">
                                                                  <button class="btn mx-0 border-0" type="button" id="location-clear"
                                                                          style="background-color: #f4f4f4; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                                                      <i class="fa fa-times" aria-hidden="true"></i>
                                                                  </button>
                                                              </span>
                            </div>
                        </div>

                        <p><label id="candidate_edit-resume-attach_file-name"></label></p>
                        <p><a id="candidate_edit-resume-delete-btn" style="display: none;">{!! trans('main.buttons.delete_resume') !!}</a></p>
                        <p><button type="button" id="candidate_edit-resume-attach_file-btn" class="btn btn-outline-success btn-block">{!! trans('main.buttons.upload_resume') !!}</button></p>
                        <input type="file" name="attach_file" id="candidate_edit-resume-attach_file-input" style="display: none" accept=".pdf, .jpg, .jpeg, .png">
                        <p>
                            <label for="candidate_edit-select-pipeline" style="text-align: left;">Select Pipeline applied to</label>
                            <select name="pipeline_id" class="form-control" id="candidate_edit-select-pipeline"></select>
                        </p>
                        <p>
                            <label for="candidate_edit-select-job" style="text-align: left;">Select Job applied to</label>
                            <select name="job_id" class="form-control" id="candidate_edit-select-job"></select>
                        </p>

                        <p>
                            <label for="candidate_edit-select-location" style="text-align: left;">Select Location applied to</label>
                            <select name="location_id" class="form-control" id="candidate_edit-select-location"></select>
                        </p>

                        <div class="row mb-3">
                            <div class="align-self-center col-lg-6">
                                <button type="button" class="btn btn-outline-primary px-5" data-dismiss="modal" aria-label="Close">{!! trans('main.buttons.back') !!}</button>
                            </div>
                            <div class="align-self-center col-lg-6">
                                <button type="button" id="candidate_edit-btn-click" class="btn btn-primary px-5">{!! trans('main.buttons.edit') !!}</button>
                            </div>
                        </div>
                        <input type="hidden" name="city_name">
                        <input type="hidden" name="region">
                        <input type="hidden" name="country">
                        <input type="hidden" name="country_code">
                        <input type="hidden" name="geo_full_name">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
