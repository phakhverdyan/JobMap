// CV WIDGET
$(document).ready(function() {
    var is_in_iframe = function() {
        try {
            return window.self !== window.top;
        } catch (e) {
            return true;
        }
    };

    /**
     * Blocks
     */
    var widgetOpen = '.widget_open';
    let widgetBlock = '.widget_block';
    let dropZoneBlock = '.drag_drop_zone';
    let dropZone = '.drag_drop';
    let modalBackdropCustom = '.modal-backdrop-custom';
    var applying_business_id = 0;
    var applying_job_id = 0;
    var applying_location_id = 0;

    /**
     * Elements
     */
    let buttonDataStep = 'button[data-step]';
    let inputFile = 'input[name="cv_file"]';

    /**
     * Classes
     */
    let dragDropOver = 'drag_drop_over';

    /**
     * Select CV file
     */
    $(dropZoneBlock).on('click', function(e){
        e.preventDefault();
        $(inputFile).trigger('click');
    })
    .bind('touchstart', function(e){
        $(inputFile).trigger('click');
    });
    $(inputFile).on('change', function(e){
        e.preventDefault();
        widgetUploadCvFile(e.target.files);
    });

    /**
     * Drag and drop file
     */
    $(modalBackdropCustom).on('dragover', function(){
        return false;
    })
    .on('dragleave', function(){
        return false;
    });

    $(dropZone).on('dragover', function(){
        $(this).addClass(dragDropOver);
        return false;
    })
    .on('dragleave', function(){
        $(this).removeClass(dragDropOver);
        return false;
    });
    $('.modal-backdrop-custom, ' + dropZone).on('drop', function(e){
        e.preventDefault();
        $(this).removeClass(dragDropOver);
        widgetUploadCvFile(e.originalEvent.dataTransfer.files);
    });

    $('.modal-backdrop-custom').on('click', function(e){
        e.preventDefault();
        toggleCvWidget();
    });

    /**
     * Skip upload resume step
     */
    $('#widget-without-resume').click(function() {
        showStep('uploaded_file');
        localStorage.setItem('widget_resume_file', '');
        $(dropZone).hide();
        $('#widget-have-resume').show();
        $(this).hide();
    });

    /**
     * Show / hide widget button
     */
    $('.widget .widget_toggle .btn, .navbar a.show-cv-widget').click(function() {
        if (is_current_window_opened_as_iframe()) {
            if (!$('.widget').hasClass('open')) {
                parent.postMessage('jm-w.open', '*');
            } else {
                toggleCvWidget();
            }
        } else {
            toggleCvWidget();
        }
    });

    /**
     * Wgiget delete uploaded file
     */
    $('.cv_widget_delete, #widget-have-resume').click(function(){
        showStep('drag_cv');
        localStorage.removeItem('widget_resume_file');
        setProgressbarValue(0);
        $(inputFile).val('');
        $(dropZone).show();
        return false;
    });

    /**
     * Button next step
     */
    $(buttonDataStep).click(function(e) {
        e.preventDefault();
        let stepName = $(this).data('step');

        switch (stepName) {
            case 'create_account':
                widgetValidateInfo(stepName);
                break;

            case 'created_account':
                widgetCreateAccount(stepName);
                break;

            default:
                return false;
        }
    });

    /**
     * No thanks button
     */
    $("#cancel_registration").click(function(e) {
        e.preventDefault();
        showStep('drag_cv');
        widgetClearLocalStorage();
        $('#widget-create-user', '#widget_info_user').trigger('reset');
        $('.widget_toggle').click();
    });

    $(modalBackdropCustom).click(function(event) {
        event.preventDefault();
        $('.widget_toggle').click();
    });

    $(document).on("send:resume:not:login:user", function (event, data) {
       console.log("send:resume:not:login:user");
       console.log(data);
       if(data !== undefined){
           applying_business_id = parseInt(data.business_id?data.business_id:0);
           applying_job_id = parseInt(data.job_id?data.job_id:0);
           applying_location_id = parseInt(data.location_id?data.location_id:0);
       }
    });

    /**
     * Upload widget CV file
     */
    function widgetUploadCvFile(files)
    {
        if (files.length === 0) {
            $.notify('Please, choose CV file', 'error');
            return false;
        }

        var file = files[0];
        var fileType = file.type;
        var fileSize = file.size;

        if (checkFileExtension(file) === false) {
            $.notify('CV file can be one of the following formats: pdf, txt, doc, docx, png, jpg', 'error');
            return false;
        }

        // Validate CV file size (max 5mb)
        if (widgetValidationSize(fileSize) === false) {
            $.notify('CV file size can\'t exceed 5 megabytes', 'error');
            return false;
        }

        var formData = new FormData();
        formData.append('resume_file', file);
        setProgressbarValue(0);
        showStep('uploading_file');

        /* uploading progress */
        $.ajaxSetup({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        $( "#progressbar" ).progressbar({
                            value: percentComplete
                        });
                    }
               }, false);

               return xhr;
            },
        });

        /**
         * GraphQL Client
         * @param buildSchema
         * @param typeQuery
         * @param paramsQuery
         * @param needParamsFromResponse
         * @param headers
         * @param redirectTo
         * @param errorHandler
         * @param successHandler
         * @param form
         * @param objectData
         */
        new GraphQL(
            "query",
            "widgetUploadCV",
            {},
            [ 'resume_file' ],
            false,
            false,
            function () {
                Loader.stop();
            }, function (data) {
                showStep('uploaded_file');
                localStorage.setItem('widget_resume_file', data.resume_file);
                setProgressbarValue(100);
                $('#resume_name').text(data.resume_file);
            },
            false,
            formData
        ).request();
    }

    /**
     * Widget validation basic info
     */
    function widgetValidateInfo(stepName)
    {
        var form = $('#widget_info_user');
        var formData = new FormData(form[0]);
        var params = {
            email: formData.get('email'),
            first_name: formData.get('first_name'),
            last_name: formData.get('last_name'),
        };

        new GraphQL(
            "query",
            "widgetCheckInfo",
            params,
            [ 'response', ],
            false,
            false,
            function () {
                Loader.stop();
            }, function (data) {
                if (data.response === 'ok') {
                    showStep(stepName);
                    localStorage.setItem('widget_info', JSON.stringify(params));
                } else {
                    showStep('drag_cv');
                    localStorage.removeItem('widget_resume_file');
                    setProgressbarValue(0);
                }
            },
            form
        ).request();
    }

    /**
     * Widget crear local storage
     */
    function widgetClearLocalStorage()
    {
        localStorage.removeItem('widget_info');
        localStorage.removeItem('widget_resume_file');
    }

    /**
     * Show widget step
     */
    function showStep(stepName)
    {
        // Dropzone file blocks
        let uploadingFileBlock = $('.uploading_file');
        let uploadedFileBlock = $('.uploaded_file');

        // Info blocks
        let mainRegistrationBlock = $('#main_registration_block');
        let fillInfoBlock = $('#step_fill_info');
        let createAccountFileBlock = $('#step_create_account');
        let createdAccountFileBlock = $('#step_account_created');

        $(dropZoneBlock).hide();
        uploadingFileBlock.hide();
        uploadedFileBlock.hide();
        mainRegistrationBlock.hide();
        fillInfoBlock.hide();
        createAccountFileBlock.hide();
        createdAccountFileBlock.hide();

        switch (stepName) {
            case 'drag_cv':
                $(dropZoneBlock).show();
                $('#widget-without-resume').show();
                $('#widget-have-resume').hide();
                break;

            case 'uploading_file':
                uploadingFileBlock.show();
                break;

            case 'uploaded_file':
                uploadedFileBlock.show();
                mainRegistrationBlock.show();
                fillInfoBlock.show();
                break;

            case 'create_account':
                uploadedFileBlock.show();
                mainRegistrationBlock.show();
                createAccountFileBlock.show();
                locationAutocomplete();
                break;

            case 'created_account':
                $(dropZone).hide();
                mainRegistrationBlock.show();
                createdAccountFileBlock.show();
                break;

            default:
                return false;
        }
    }

    /**
     * Widget file type validation
     * png, jpg, doc, docx, pdf
     */
    function widgetValidationType(fileType)
    {
        var types = [
            'application/pdf',
            'image/jpeg',
            'image/png',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
        ];
        return types.includes(fileType);
    }

    /**
     * Check file extension
     */
    function checkFileExtension(file) {
        var fileName = file.name;
        var extension = fileName.substr((fileName.lastIndexOf('.') +1));

        return /(pdf|txt|doc|docx|png|jpg|jpeg|xls)$/ig.test(extension);
    }

    /**
     * Widget file size validation
     */
    function widgetValidationSize(fileSize)
    {
        var maxFileBytes = 5000000; // 5MB (in decimal)

        return fileSize < maxFileBytes
    }

    /**
     * Widget create account
     */
    function widgetCreateAccount(stepName)
    {
        var code = $('#country-phone .bfh-selectbox-option').clone();
        code.find('span').remove();

        var form = $('#widget-create-user');
        var formData = new FormData(form[0]);

        let _business_id = parseInt($('.widget').attr('data-business-id'));
        if(_business_id === 0){
            _business_id =applying_business_id;
        }
        var params = {
            ...JSON.parse(localStorage.getItem('widget_info')),
            phone_number: formData.get('phone_number'),
            phone_code: code.text().replace(" ", ""),
            phone_country_code: form.find('.country').val(),
            city: formData.get('city_name'),
            attach_file: localStorage.getItem('widget_resume_file'),
            type: 'student',
            region: formData.get('region'),
            country: formData.get('country'),
            country_code: formData.get('country_code'),
            applying_business_id: _business_id,
            applying_job_id: applying_job_id,
            applying_location_id: applying_location_id,
        };

        new GraphQL(
            "mutation",
            "widgetUserCreate",
            params,
            ['username', 'token', 'first_name'],
            false,
            false, // redirectTO
            function () {
                Loader.stop();
            }, function (data) {
                var cvFile = localStorage.getItem('widget_resume_file');

                if (data) {
                    showStep(stepName);
                    localStorage.removeItem('widget_info');
                    localStorage.removeItem('widget_resume_file');
                    $('.widget').addClass('user-logged-in');
                }

                if (!is_current_window_opened_as_iframe()) {
                    APIStorage.setToken(data);

                    if (!cvFile) {
                        openWindow('/user/resume/create');
                    }

                    location.reload();
                }
            },
            form
        ).request();
    }

    function openWindow(url)
    {
        let newWindow = window.open(url, 'example')
        newWindow.onload = function() {
            //
        };
    }

    function widgetApplyToJob(options)
    {
        if (!$('.widget').hasClass('user-logged-in')) {
            applying_location_id = options.location_id;
            applying_job_id = options.job_id;
            toggleCvWidget();
            return;
        }

        var params = {};
        params.business_id = parseInt($('.widget').attr('data-business-id'));
        params.location_id = options.location_id;
        params.job_id = options.job_id;

        new GraphQL("mutation", "sendResume", params, [
            'message',
            'status',
            'token',
        ], true, false, function() {
            Loader.stop();
        }, function(data) {
            showStep('created_account');
            toggleCvWidget();
        }).request();
    }

    /**
     * Set progressbar value
     */
    function setProgressbarValue(value = 0)
    {
        $( "#progressbar" ).progressbar({
            value: value
        });
    }

    /**
     * Check if this window is opened as an iframe
     */
    function is_current_window_opened_as_iframe()
    {
        return parent != window;
    }

    /**
     * Open/close widget
     */
    function toggleCvWidget()
    {
        var was_open = $('.widget').hasClass('open');
        $(modalBackdropCustom).toggleClass('show');

        $(widgetBlock).slideToggle(400, function() {
            if (was_open) {
                parent.postMessage('jm-w.close', '*');
            } else {
                parent.postMessage('jm-w.opened', '*');
            }
        });

        if (was_open) {
            $(widgetOpen).val($(widgetOpen).attr('data-text-upload-resume'));
            $('.widget').removeClass('open');
        } else {
            $(widgetOpen).val($(widgetOpen).attr('data-text-close'));
            $('.widget').addClass('open');
        }

        return false;
    }

    /**
     * User location autocomplete
     */
    function locationAutocomplete()
    {
        var signUpForm = $('#widget-create-user');
        var locationField = signUpForm.find('#widget-user-location');
        var userCityName = signUpForm.find('input[name="city_name"]');
        var userCity = signUpForm.find('input[name="city"]');
        var userRegion = signUpForm.find('input[name="region"]');
        var userCountry = signUpForm.find('input[name="country"]');
        var userCountryCode = signUpForm.find('input[name="country_code"]');

        if (locationField.length > 0) {
            GEO.init();
            //autocomplete locations
            locationField.autocomplete({
                source: function (request, response) {
                    if (request.term.length === 0) {
                        // clearLocationField.parent().addClass('hide');
                        locationField.addClass('autocomplete-border');
                    } else {
                        // clearLocationField.parent().removeClass('hide');
                        locationField.removeClass('autocomplete-border');
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
                            locationField.removeClass('ui-autocomplete-loading');
                            userCityName.val('no_geo_data');
                            userCity.val('');
                            userRegion.val('');
                            userCountry.val('');
                            userCountryCode.val('');
                        }
                    }).autocomplete();
                },
                select: function (event, ui) {
                    var data = ui.item.data;
                    userCityName.val(data.city);
                    userCity.val(data.fullName);
                    userRegion.val(data.region);
                    userCountry.val(data.country);
                    userCountryCode.val(ui.item.id);
                },
                response: function (e, u) {
                    locationField.removeClass('ui-autocomplete-loading');
                }
            }).attr('autocomplete', 'disabled').autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>")
                    .append('<span><i class="glyphicon bfh-flag-' + item.id + '"></i> </span><span>' + item.label + '</span>')
                    .appendTo(ul);
            };

            locationField.keydown(function () {
                userCityName.val('no_geo_data');
                // userCity.val('');
                userRegion.val('');
                userCountry.val('');
                userCountryCode.val('');
                FormValidate.fieldValidateClear($(this));
            });
        }
    }

    window.addEventListener('message', function(event) {
        console.log('IFRAME: ', event.data);

        try {
            var data = JSON.parse(event.data);
        } catch (error) {
            return;
        }

        if (data.action == 'jm-w.toggle') {
            toggleCvWidget();
            return;
        }

        if (data.action == 'jm-w.apply') {
            widgetApplyToJob({
                location_id: data.location_id,
                job_id: data.job_id,
            });

            return;
        }
    });
});
