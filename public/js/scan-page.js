

function ScanPage() {

    this.locale = APIStorage.read('language');

    this.bScanForm = $(document).find("#scan-form");
    this.bUserNoPicForm = $(document).find("#user-no-pic-form");


    this.locationField = this.bScanForm.find('#widget-user-location');
    this.userCityName = this.bScanForm.find('input[name="city_name"]');
    this.userCity = this.bScanForm.find('input[name="city"]');
    this.userRegion = this.bScanForm.find('input[name="region"]');
    this.userCountry = this.bScanForm.find('input[name="country"]');
    this.userCountryCode = this.bScanForm.find('input[name="country_code"]');
    this.user_pic_view = this.bScanForm.find('.user-pic-view');

    this.modalChangeJob = $(document).find('#JobChangeModal');

    this.dataTableListJobsId = this.modalChangeJob.find("#datatable-list-jobs");
    this.dataTableListJobs = null;
    this.dataTableListJobsSortName = "title";
    this.dataTableListJobsSort = "asc";
    this.job_search_keywords = "";

    this.cookies = {};

    this.loading = $(document).find(".loading");

    this.cropper_modal = $(document).find('#UserPictureCropperModal');
    this.cropper_wrapper = this.cropper_modal.find('.avatar-wrapper');
    this.cropper_preview = this.cropper_modal.find('.avatar-preview');
    this.cropper_img = this.cropper_modal.find('img');
    this.cropper_data = null;
    this.cropper_active = false;
    this.picture_data = null;
    this.temp_user_picture_name = null;

    this.user = null;
}

ScanPage.prototype = {
    init: function () {
        let _this = this;


        document.cookie.split(/;/).forEach(function(cookie) {
            cookie = cookie.trim().split(/=/);
            _this.cookies[cookie[0]] = cookie[1];
        });

        _this.takePicture();

        _this.locationAutocomplete();

        _this.submitForm();

        _this.jobApply();

        $(document).on("click", ".btn-to-step3", function () {
            //$(document).find(".step-1").fadeOut();
            $(document).find(".step-2").fadeOut();
            $(document).find(".step-3").fadeIn();
        });
    },

    takePicture: function(){
        let _this = this;

        $(document).on("click", "#user-pic-change-btn", function () {
            console.log("Event - click - user-pic-change-btn");
            _this.bScanForm.find("[name=logo_file]").val("");
            _this.bScanForm.find("[name=logo_file]").trigger("click");
            _this.user_pic_view = _this.bScanForm.find('.user-pic-view');
        });

        $(document).on("click", "#user-no-pic-change-btn", function () {
            console.log("Event - click - user-pic-change-btn");
            _this.bUserNoPicForm.find("[name=logo_file]").val("");
            _this.bUserNoPicForm.find("[name=logo_file]").trigger("click");
            _this.user_pic_view = _this.bUserNoPicForm.find('.user-pic-view');
        });

        $(document).on("change", "[name=logo_file]", function (event) {
            console.log("Event - change - logo_file");
            if($(this)[0].files[0] !== undefined){
                console.log($(this)[0].files[0].type);
                if($(this)[0].files[0].type !== "image/svg+xml" && $(this)[0].files[0].type !== "image/png" && $(this)[0].files[0].type !== "image/jpeg" && $(this)[0].files[0].type !== "image/jpg"){
                    console.log("Error file type");
                    return;
                }

                _this.$reader = new FileReader();
                _this.$reader.readAsDataURL($(this)[0].files[0]);
                _this.$reader.onloadend = function () {
                    _this.picture_data = _this.$reader.result;
                    //_this.user_pic_view.find("img").attr("src", "");
                    _this.cropper_modal.modal("show");
                };
            }else{
                console.log("Error - change - user picture");
            }

        });

        _this.cropper_modal.on("click", ".avatar-save", function () {
            _this.loading.show();

            let formData = new FormData();
            formData.append("user_picture_data",  _this.picture_data);
            formData.append("cropper_data",  _this.cropper_data);
            formData.append("user_id",  _this.user?_this.user.id:null);

            $.ajax({
                url: "/scan/ajax/set-cropper-picture",
                headers: {
                    'X-CSRF-Token': _this.cookies['CSRF-TOKEN']
                },
                type: 'POST',
                data: formData,
                dataType: false,
                cache: false,
                contentType: false,
                processData: false,
                error: function(data) {
                    console.log("ERROR");
                    console.log(data);
                },
                success: function (response) {
                    console.log(response);
                    if(response.error === undefined ){
                        if(response.data != null){
                            _this.user_pic_view.find("img").attr("src", response.data.file_data);
                            _this.temp_user_picture_name = response.data.file_name;
                            _this.loading.hide();
                            _this.cropper_modal.modal("hide");
                        }
                    }
                }
            });
        });

        _this.cropper_modal.on("show.bs.modal", function () {
            setTimeout(function () {
                _this.startCropper();
            }, 200);

        });
        _this.cropper_modal.on("hide.bs.modal", function () {
            _this.stopCropper();
        });

    },

    submitForm: function () {
        let _this = this;

        _this.bScanForm.on("submit", function (event) {
            event.preventDefault();

            let code = _this.bScanForm.find('#country-phone .bfh-selectbox-option').clone();
            code.find('span').remove();

            let formData = new FormData();
            formData.append("email", _this.bScanForm.find("[name=email]").val());
            formData.append("first_name", _this.bScanForm.find("[name=first_name]").val());
            formData.append("last_name", _this.bScanForm.find("[name=last_name]").val());
            formData.append("phone_number", _this.bScanForm.find("[name=phone_number]").val());
            formData.append("phone_code", code.text().replace(" ", ""));
            formData.append("phone_country_code", _this.bScanForm.find('.country').val());
            formData.append("city", _this.bScanForm.find("[name=city_name]").val());
            formData.append("region", _this.bScanForm.find("[name=region]").val());
            formData.append("country", _this.bScanForm.find("[name=country]").val());
            formData.append("country_code", _this.bScanForm.find("[name=country_code]").val());
            formData.append("applying_business_id", _this.bScanForm.find("[name=business_id]").val());
            formData.append("applying_job_id", _this.bScanForm.find("[name=job_id]").val());
            formData.append("applying_location_id", _this.bScanForm.find("[name=location_id]").val());
            formData.append("type", 'student');
            formData.append("temp_user_picture_name",  _this.temp_user_picture_name);
            formData.append("resume_file",  _this.bScanForm.find("[name=resume_file]")[0].files[0]);

            $.ajax({
                url: "/scan/ajax/user-sign-up",
                headers: {
                    'X-CSRF-Token': _this.cookies['CSRF-TOKEN']
                },
                type: 'POST',
                data: formData,
                dataType: false,
                cache: false,
                contentType: false,
                processData: false,
                error: function(data) {
                    console.log("ERROR");
                    console.log(data);
                },
                success: function (response) {
                    console.log(response.data);
                    if(response.error === undefined ){

                        if(response.data != null){
                            _this.user = response.data;

                            $(document).find(".user_name").html(_this.user.first_name);

                            $(document).find(".step-1").fadeOut();
                            if(_this.user.user_pic != null && _this.user.user_pic !== ""){
                                $(document).find(".step-3").fadeIn();
                            }else {
                                $(document).find(".step-2").fadeIn();
                            }
                        }


                        //$(document).find(".step-1");
                        //$(document).find(".step-2");
                        //$(document).find(".step-3");
                        //$(document).find(".user_name").html("");
                    }
                }
            });
        });




    },

    locationAutocomplete: function () {
        let _this = this;

        let location_clear = _this.bScanForm.find("#user-location-clear");
        let location_flag = _this.bScanForm.find("#widget-user-location-flag");

        location_clear.on("click", function () {
            console.log("clear");
            _this.locationField.val('');
            _this.locationField.focus();
            $(this).parent().addClass('hide');
            _this.userCityName.val('');
            _this.userCity.val('');
            _this.userRegion.val('');
            _this.userCountry.val('');
            _this.userCountryCode.val('');
            _this.locationField.parent().find('.glyphicon').attr('class','glyphicon');
        });

        if (_this.locationField.length > 0) {
            GEO.init();
            //autocomplete locations
            _this.locationField.autocomplete({
                source: function (request, response) {
                    location_clear.parent().addClass('hide');
                    if (request.term.length === 0) {
                        location_flag.addClass('hide');
                        _this.locationField.addClass('autocomplete-border');
                    } else {
                        location_flag.removeClass('hide');
                        _this.locationField.removeClass('autocomplete-border');
                    }
                    //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler
                    new GraphQL("query", "geo", {
                        "key": request.term
                    }, ['fullName', 'city', 'region', 'country', 'countryCode'], false, false, function () {
                        response([]);
                    }, function (data) {
                        if (data.length !== 0) {
                            var transformed = $.map(data, function (el) {
                                return {
                                    label: el.fullName,
                                    id: el.countryCode,
                                    data: el
                                };
                            });
                            response(transformed);
                        } else {
                            _this.locationField.removeClass('ui-autocomplete-loading');
                            location_clear.parent().removeClass('hide');
                            _this.userCityName.val('no_geo_data');
                            _this.userCity.val('');
                            _this.userRegion.val('');
                            _this.userCountry.val('');
                            _this.userCountryCode.val('');
                        }
                    }).autocomplete();
                },
                select: function (event, ui) {
                    var data = ui.item.data;
                    _this.userCityName.val(data.city);
                    _this.userCity.val(data.fullName);
                    _this.userRegion.val(data.region);
                    _this.userCountry.val(data.country);
                    _this.userCountryCode.val(ui.item.id);
                    location_flag.find('i').removeClassRegex(/^bfh-flag-/);
                    location_flag.find('i').addClass('bfh-flag-' + ui.item.id);
                    location_clear.parent().removeClass('hide');
                },
                response: function (e, u) {
                    _this.locationField.removeClass('ui-autocomplete-loading');
                }
            }).attr('autocomplete', 'disabled').autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>")
                    .append('<span><i class="glyphicon bfh-flag-' + item.id + '"></i> </span><span>' + item.label + '</span>')
                    .appendTo(ul);
            };

            _this.locationField.keydown(function () {
                _this.userCityName.val('no_geo_data');
                _this.userCity.val('');
                _this.userRegion.val('');
                _this.userCountry.val('');
                _this.userCountryCode.val('');
            });
        }
    },

    jobApply: function () {
        let _this = this;

        _this.modalChangeJob.on("show.bs.modal", function (event) {
            console.log("show.bs.modal");
            if(_this.dataTableListJobs === null){
                _this.initDataTableListJobs();
            }
        });

        $(document).on("change", "#scanner-job-sort", function (event) {
            console.log("Event - scanner-job-sort");
            _this.dataTableListJobsSortName = $(this).val();
            _this.dataTableListJobsSort = $(this).find("option:selected").attr("data-order");
            $(document).trigger("scanner:job:items:table:draw");
            event.preventDefault();
        });

        $(document).on("change", "#scanner-job-limit", function (event) {
            console.log("Event - scanner-job-limit");
            let _limit = $(this).val();
            _this.dataTableListJobs.page.len(_limit).draw();
            event.preventDefault();
        });

        $(document).on('keyup', "#scanner-job-search", function (event) {
            console.log("Event - scanner-job-search");
            if (event.which <= 90 && event.which >= 48 || event.which === 13 || event.which === 8) {
                _this.job_search_keywords = $(this).val().trim();
                setTimeout(function() {
                    $(document).trigger("scanner:job:items:table:draw");
                }, 100);
            }
        });

        _this.modalChangeJob.on("click", ".apply-job", function (event) {
            console.log("Event - apply-job");
            $(document).find(".job-general-application").html( $(this).attr("data-job-name") );
            _this.bScanForm.find("[name=job_id]").val($(this).attr("data-job-id"));
            // _this.modalChangeJob.find(".apply-job").each(function () {
            //     $(this).attr("disabled", false);
            // });
            // $(this).attr("disabled", true);
            _this.modalChangeJob.modal("hide");
        });

    },

    initDataTableListJobs: function () {
        let _this = this;

        $(document).on("scanner:job:items:table:draw", function (event) {
            if(_this.dataTableListJobs !== null){
                _this.dataTableListJobs.draw();
                event.preventDefault();
            }
        });

        let _not_jobs_text = "Not Jobs Yet!";
        if(_this.locale !== "en"){
            _not_jobs_text = "Aucun Emplois!";
        }

        _this.dataTableListJobs = _this.dataTableListJobsId.DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "/scan/ajax/get-jobs",
                data: function (data) {
                    data.business_id = _this.bScanForm.find("[name=business_id]").val();
                    data.location_id = _this.bScanForm.find("[name=location_id]").val();
                    data.sort_name = _this.dataTableListJobsSortName;
                    data.sort = _this.dataTableListJobsSort;
                    data.language_prefix = _this.locale;
                    data.keywords = _this.job_search_keywords;
                    console.log(data);
                },
                headers: {
                    'X-CSRF-Token': _this.cookies['CSRF-TOKEN']
                }
            },
            columns: [
                {data: 'name', name: 'name' }
            ],
            initComplete: function (settings, json) {},
            drawCallback: function(settings){
                if (this.api().page.info().pages <= 1) {
                    $('#' + settings.sTableId + '_paginate').hide();
                }else{
                    $('#' + settings.sTableId + '_paginate').show();
                }
            },
            language: {
                searchPlaceholder: "",
                sSearch: "",
                sEmptyTable: _not_jobs_text,
                oPaginate: {
                    sPrevious: " ",
                    sNext: " ",
                },
                processing: '<i class="fa fa-circle-o-notch fa-spin  fa-3x fa-fw"></i><span class="sr-only">Loading....</span>'
            },
            dom:"<'row'<'col-sm-12 col-md-6'f><'col-sm-12 col-md-6'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "info": false,
            "sort": false,
            "searching": false,
            "pageLength": 25,
            "lengthChange": false
        });
    },

    startCropper: function () {
        let _this = this;
        if(!_this.cropper_active){
            _this.cropper_img.attr("src", _this.picture_data);
            _this.cropper_img.cropper({
                aspectRatio: 1,
                viewMode: 0,
                minCropBoxWidth: 100,
                background: true,
                highlight: false,
                preview: _this.cropper_preview,
                crop: function (e) {
                    _this.cropper_data = [
                        '{"x":' + e.x,
                        '"y":' + e.y,
                        '"height":' + e.height,
                        '"width":' + e.width,
                        '"rotate":' + e.rotate + '}'
                    ].join();
                }
            });

            _this.cropper_active = true;
        }

    },

    stopCropper: function () {
        let _this = this;
        if (_this.cropper_active) {
            _this.cropper_img.cropper('destroy');
            _this.cropper_img.attr("src", "");
            _this.cropper_active = false;
        }
    }

};

$(document).ready(function () {
   new ScanPage().init();
});
