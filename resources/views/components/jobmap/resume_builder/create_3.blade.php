<div class="col-12 pb-3 pt-5 form-tab-content resume-builder-step" data-builder-step="BasicInfo">
    <div class="row justify-content-center" id="user-basic-info">
        <div class="col-11">
            <div class="row text-left">
                <div class="col-12">
                    <div class="mb-5 border p-3 bg-light rounded text-center">
                        <h5 class="h5 mb-3 text light-grey">Profile picture</h5>
                        <div class="p-4 mb-3 d-inline-block rounded bg-white user-pic-view"
                             style="box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);">
                            <img src="" class="resume-userpic">
                        </div>
                        <div class="d-block">
                            <div class="d-inline-block bg-white">
                                <button type="button" class="btn btn-outline-primary" id="resume-user-pic-change-btn">
                                    Modify
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <h5 class="h5 mb-3 text-center text light-grey">Headline</h5>
                    <div class="form-group mb-4">
                        <input name="headline" type="text" class="form-control bg-white"
                               placeholder="(ex. Looking for opportunities in IT)">
                    </div>
                </div>
                <div class="col-12">
                    <h5 class="h5 mb-3 text-center text light-grey">Location</h5>
                    <div class="form-group mb-4">
                        <label class="text light-grey">Street address</label>
                        <input type="text" name="street" class="form-control bg-white"
                               placeholder="Street address (ex. 55 Main St. Appt. 5)">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group input-group mb-4">
                            <span class="input-group-addon bg-white" id="basic-addon1"><i
                                        class="glyphicon"></i> </span>
                        <input type="text" id="user-location" name="city" class="form-control bg-white"
                               placeholder="City">
                        <button class="input-group-addon  bg-white" type="button" id="user-location-clear">
                            <i class="fa fa-times text light-grey" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="col-12">
                    <h5 class="h5 mb-3 text-center text light-grey">Contact</h5>
                </div>
            </div>
            <div class="selectskill mb-3">
                <div class="row no-gutters text-left">
                    <div class="col-3">
                        <div id="mobile-phone" class="bfh-selectbox bfh-countries mr-2" data-country="CA"
                             data-flags="true"></div>
                    </div>
                    <div class="col-12">
                        <input type="tel" class="form-control" name="mobile_phone"
                               placeholder="Type your mobile phone number">
                    </div>
                </div>
            </div>
            <div class="row text-left">
                <div class="col-12">
                    <div class="form-group mb-5">
                        <label class="text light-grey">Website</label>
                        <input type="text" class="form-control bg-white" name="website"
                               placeholder="Website (ex. http://www.yourwebsite.com)">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <h5 class="h5 mb-3 text-center text light-grey">About me <span class="h6 text-secondary">(Max characters 1000)</span>
                        </h5>
                        <textarea name="about" maxlength="1000" class="form-control bg-white text-secondary"
                                  rows="6"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>