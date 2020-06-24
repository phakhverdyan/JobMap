//instantiate object Resume Builder
var builder;
//instantiate objects Resume Builder Info
var education;
var experience;
var skill;
var language;
var certification;
var distinction;
var hobby;
var interest;
var reference;

function ResumeBuilder(data) {
    //default user data
    this._data = data;
    this.data = user.data;
    this.street = user.data.street;
    this.city = user.data.city;
    this.region = user.data.region;
    this.country = user.data.country;
    this.countryCode = user.data.country_code;

    //default data for resume info
    this.preference = data.preference;
    this.availability = data.availability;
    this.basic = data.basic;
    this.education = data.education;
    this.experience = data.experience;
    this.reference = data.reference;
    this.skill = data.skill;
    this.language = data.languages;
    this.certification = data.certification;
    this.distinction = data.distinction;
    this.hobby = data.hobby;
    this.interest = data.interest;

    //set location value
    this.location = this.city;
    if (this.region) {
        this.location += "," + this.region;
    }
    if (this.country) {
        this.location += "," + this.country;
    }

    //check complete resume
    //this.complete = this.preference.is_complete + this.availability.is_complete + this.basic.is_complete;

    education = new ResumeInfo('education');
    experience = new ResumeInfo('experience');
    skill = new ResumeInfo('skill');
    language = new ResumeInfo('language');
    certification = new ResumeInfo('certification');
    distinction = new ResumeInfo('distinction');
    hobby = new ResumeInfo('hobby');
    interest = new ResumeInfo('interest');
    reference = new ResumeInfo('reference');

    this.init();
    this.status();
    //this.showStatus();

    this.msIndustry;
    this.msSubIndustry;

    this.msIndustryValue = null;
    this.msSubIndustryValue = null;

    this.industries;

    this.msCategory;
    this.msCategoryElement = $('#categories');
    this.msSubCategory;

    this.msCategoryValue = null;
    this.msSubCategoryValue = null;

    this.categories;
}

ResumeBuilder.prototype = {
    init: function () {
        var _this = this;
        //init cropper
        new CropAvatar('user-pic-view', 'resume-user-pic-change-btn', $('#resume-builder-form'), 'updateUser', [
            'token', 'user_pic', 'user_pic_filter', 'user_pic_original', 'error_message',
            'user_pic_options(width: 200, height: 200)', 'user_pic_o(origin: true)',
            'user_pic_options_md(width: 100, height: 100)',
            'user_pic_options_sm(width: 50, height: 50)'], function (data) {
            var resumePic = $('.resume-userpic');
            var userPic = $('.userpic');
            var userPicMenu = $('#menu-userpic');
            var filter = userPic.parent().attr('data-filter');
            userPicMenu.parent().removeClass(filter);
            userPicMenu.attr('src', data.user_pic_options).parent().addClass(data.user_pic_filter);
            resumePic.parent().removeClass(filter);
            resumePic.attr('src', data.user_pic_options).parent().addClass(data.user_pic_filter);
            userPic.parent().removeClass(filter);
            userPic.attr('src', data.user_pic_options_sm).parent().addClass(data.user_pic_filter);
            userPicMenu.parent().attr('data-filter', data.user_pic_filter);
            resumePic.parent().attr('data-filter', data.user_pic_filter);
            userPic.parent().attr('data-filter', data.user_pic_filter);
            user.refresh();
        }, this.data.user_pic);
        //set user link
        //$('#link-user-profile').val($('#link-user-profile').attr('data-url') + this.data.username);

        //set resume user picture
        if (this.data.user_pic) {
            $('.resume-userpic').attr('src', this.data.user_pic_options).parent().addClass(this.data.user_pic_filter);
        } else {
            $('.resume-userpic').attr('src', '/img/profilepic2.png');
        }

        if (getUrlParameter("r")) {
            removeQueryStringParam('r');
            $.notify('Please fill in the required points of resume', 'error');
        }

        //clear all fileds in resume builder form
        $('#resume-builder-form').on('click', 'input, select', function () {
            FormValidate.fieldValidateClear($(this));
        });

        //check change for resume builder
        $('#resume-builder-form').on('click', '#resume-save-education, #resume-education-confirm-delete, #resume-save-experience, #resume-experience-confirm-delete, '
                                            + '#resume-save-skill, #resume-skill-confirm-delete, #resume-save-language, #resume-language-confirm-delete '
                                            + '#resume-save-certification, #resume-certification-confirm-delete, #resume-save-distinction, #resume-distinction-confirm-delete '
                                            + '#resume-save-hobby, #resume-hobby-confirm-delete, #resume-save-interest, #resume-interest-confirm-delete '
                                            + '#resume-save-reference, #resume-reference-confirm-delete', function () {
            user.clickSaveStep = false;
            $('.topbar_save_rb').fadeIn();
        });

        $('#resume-builder-form').on('change', [
            'input',
            'textarea',
            'select:not([name^="year_"], [name^="month_"], [name="current_language_prefix"])',
        ].join(', '), function() {
            user.clickSaveStep = false;
            $('.topbar_save_rb').fadeIn();
        });

        $('#resume-builder-form').on('change', 'select[name="current_language_prefix"]', function() {
            var current_language_prefix = $(this).val();
            $('.multilanguage').addClass('d-none');
            $('.multilanguage_' + current_language_prefix).removeClass('d-none');
            $('select[current_language_prefix]').not(this).val(current_language_prefix);
        });

        $('#resume-builder-form').on('mousedown', '.ui-slider-handle', function () {
            user.clickSaveStep = false;
            $('.topbar_save_rb').fadeIn();
        });

        $('.multilanguage').addClass('d-none');
        $('.multilanguage_' + (user.data.language && user.data.language.prefix || 'en')).removeClass('d-none');
        $('#resume-builder-form').find('select[name="current_language_prefix"]').val(user.data.language && user.data.language.prefix || 'en');

        //initialization all event for resume info objects
        interest.init();
        hobby.init();
        certification.init();
        distinction.init();
        language.init();
        skill.init();
        reference.init();
        experience.init();
        education.init();

        var userLocationElement = $('#user-location');
        var clearLocationField = $('#user-location-clear');
        //clear location field and focus
        $('body').on('click', '#user-location-clear', function () {
            userLocationElement.val('');
            userLocationElement.focus();
            clearLocationField.parent().addClass('hide');
            userLocationElement.addClass('autocomplete-border');
            builder.city = "";
            builder.region = "";
            builder.country = "";
            builder.countryCode = "";
            // locationField.parent().find('.glyphicon').attr('class','glyphicon');
        });

        //autocomplete education
        userLocationElement.autocomplete({
            source: function (request, response) {
                if (request.term.length === 0) {
                    clearLocationField.parent().addClass('hide');
                    userLocationElement.addClass('autocomplete-border');
                } else {
                    clearLocationField.parent().removeClass('hide');
                    userLocationElement.removeClass('autocomplete-border');
                }
                //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler
                new GraphQL("query", "geo", {
                    "key": request.term
                }, ['fullName', 'city', 'region', 'country', 'countryCode'], false, false, function (data) {
                    response([]);
                }, function (data) {
                    if (data.length != 0) {
                        var transformed = $.map(data, function (el) {
                            return {
                                label: el.fullName,
                                id: el.countryCode,
                                data: el
                            };
                        });
                        response(transformed);
                    } else {
                        builder.city = "no_geo_data";
                        builder.region = "";
                        builder.country = "";
                        builder.countryCode = "";
                        userLocationElement.removeClass('ui-autocomplete-loading');
                    }
                }).autocomplete();
            },
            select: function (event, ui) {
                builder.city = ui.item.data.city;
                builder.region = ui.item.data.region;
                builder.country = ui.item.data.country;
                builder.countryCode = ui.item.id;
                $('#basic-addon1').find('i').removeClassRegex(/^bfh-flag-/);
                $('#basic-addon1').find('i').addClass('bfh-flag-' + ui.item.id);
            },
            response: function (e, u) {
                userLocationElement.removeClass('ui-autocomplete-loading');
            }
        }).attr('autocomplete', 'disabled').autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                .append('<span><i class="glyphicon bfh-flag-' + item.id + '"></i> </span><span>' + item.label + '</span>')
                .appendTo(ul);
        };

        userLocationElement.keydown(function () {
            builder.city = "no_geo_data";
            builder.region = "";
            builder.country = "";
            builder.countryCode = "";
            // locationField.parent().find('.glyphicon').attr('class','glyphicon');
        });
        //location street
        var $formForLocation = $('#resume-builder-form'),
            $locationStreet = $formForLocation.find('#user-location-street'),
            $clearLocationStreet = $formForLocation.find('#user-location-street-clear'),
            $inputStreetCheck = $formForLocation.find('#input-street-check'),
            $selectStreet = $('#ui-id-4'),
            $inputStreetNumberClear = $formForLocation.find('#input-street-number-clear'),
            $inputStreetNumberKeep = $formForLocation.find('#input-street-number-keep'),
            isVisibleInputStreetCheck = false;
        $locationStreet.keyup(function (eventObject) {
            if (!isVisibleInputStreetCheck && $.isNumeric(eventObject.key)) {
                $inputStreetCheck.fadeIn();
                $selectStreet.css('top', '1024px');
                isVisibleInputStreetCheck = true;
            }
        });
        $inputStreetNumberClear.click(function () {
            $locationStreet.val($locationStreet.val().replace(/[0-9]/g, ''));
            $inputStreetCheck.fadeOut();
            $selectStreet.css('top', '984px');
            isVisibleInputStreetCheck = false;
        });
        $inputStreetNumberKeep.click(function () {
            $inputStreetCheck.fadeOut();
            $selectStreet.css('top', '984px');
            isVisibleInputStreetCheck = false;
        });
        //clear location street and focus
        $('body').on('click', '#user-location-street-clear', function () {
            userLocationStreet.val('');
            userLocationStreet.focus();
            $clearLocationStreet.parent().addClass('hide');
            builder.street = "";
            userLocationStreet.addClass('autocomplete-border');
        });
        var _this = this;

        $('body').on('click', '.cat-popular-item', function () {
            var id = $(this).attr('data-id');
            var name = $(this).text();
            _this.msCategory.addToSelection({
                id: id,
                name: name
            })
        });

        //autocomplete locations street
        $locationStreet.autocomplete({
            source: function (request, response) {
                if (request.term.length === 0) {
                    $clearLocationStreet.parent().addClass('hide');
                    $locationStreet.addClass('autocomplete-border');
                } else {
                    $clearLocationStreet.parent().removeClass('hide');
                    $locationStreet.removeClass('autocomplete-border');
                }
                new GraphQL("query", "geoStreet", {
                    "key": request.term
                }, [
                    'description',
                    'id',
                    'street'
                ], false, false, function () {
                    response([]);
                }, function (data) {
                    if (data.length !== 0) {
                        var transformed = $.map(data, function (el) {
                            return {
                                label: el.description,
                                id: el.id,
                                data: el
                            };
                        });
                        response(transformed);
                    } else {
                        builder.street = "no_geo_data";
                        $locationStreet.removeClass('ui-autocomplete-loading');
                    }
                }).autocomplete();
            },
            select: function (event, ui) {
                //builder.street = ui.item.data.description;
            },
            close: function (event, ui) {
                if ($locationStreet.val().indexOf(',') != -1) {
                    var street = $locationStreet.val();
                    street = street.substr(0, street.indexOf(','));
                    $locationStreet.val(street);
                    builder.street = street;
                }
            },
            response: function (e, u) {
                $locationStreet.removeClass('ui-autocomplete-loading');
            }
        }).attr('autocomplete', 'disabled')/*.autocomplete("instance")._renderItem = function (ul, item) {
         return $("<li>")
         .append('<span>' + item.id + '</span><span>' + item.label + '</span>')
         .appendTo(ul);
         }*/;
        $locationStreet.keydown(function () {
            builder.street = "no_geo_data";
        });
        $('#user-availabilities').on('click', '#user-availabilities-all input', function () {
            var dataDay = $(this).attr('data-time');
            if ($(this).prop('checked')) {
                $('#user-availabilities').find('input[data-parent-time="' + dataDay + '"]').prop('checked', true);
            } else {
                $('#user-availabilities').find('input[data-parent-time="' + dataDay + '"]').prop('checked', false);
            }
        });

        $('#user-availabilities').on('click', 'input[data-parent-time]', function () {
            var dataDay = $(this).attr('data-parent-time');
            if (!$(this).prop('checked')) {
                $('#user-availabilities-all').find('input[data-time="' + dataDay + '"]').prop('checked', false);
            }
        });
        $('#resume-builder-step-save-too').click(function () {
            $('#resume-builder-step-save').click();
        });
        $('#resume-builder-step-save').click(function () {
            user.clickSaveStep = true;
            var step = $('.resume-builder-step.active').attr('data-builder-step');
            var _form = $('#resume-builder-form');
            switch (step) {
                case 'Preference':
                    var interestedJobs = [];
                    $("input:checkbox[name=interested_jobs]:checked").each(function () {
                        interestedJobs.push($(this).val());
                    });
                    var hours = $('#hourly_salary').slider('values');
                    var categories = $.map(_this.msCategory.getSelection(), function (item) {
                        return item.id;
                    }).join(',');
                    builder.stepSave(step, {
                        "looking_job": FormValidate.getCheckedFieldValue("looking_job"),
                        "current_type": +FormValidate.getCheckedFieldValue("current_type"),
                        "current_job": +FormValidate.getCheckedFieldValue("current_job"),
                        "interested_jobs": interestedJobs.join(","),
                        "new_job": FormValidate.getCheckedFieldValue("new_job"),
                        "new_opportunities": FormValidate.getCheckedFieldValue("new_opportunities"),
                        "distance": FormValidate.getFieldValue('distance'),
                        "distance_type": FormValidate.getCheckedFieldValue("distance_type"),
                        "industries": (_this.msIndustryValue) ? _this.msIndustryValue.join(",") : "",
                        "sub_industries": (_this.msSubIndustryValue) ? _this.msSubIndustryValue.join(",") : "",
                        // "categories": (_this.msCategoryValue) ? _this.msCategoryValue.join(",") : "",
                        "sub_categories": categories,
                        "salary": FormValidate.getFieldValue('salary'),
                        "hours_from": +hours[0],
                        "hours_to": +hours[1]
                    }, ['new_job', 'is_complete', 'token'], true, function (data) {
                        if (data.is_complete === 1) {
                            builder.preference.is_complete = 1;
                            builder.status();
                        }
                    });
                    break;
                case 'Availability':
                    var timeArray1 = [];
                    var timeArray2 = [];
                    var timeArray3 = [];
                    var timeArray4 = [];
                    $("input:checkbox[name=time_1]:checked").each(function () {
                        timeArray1.push($(this).val());
                    });
                    $("input:checkbox[name=time_2]:checked").each(function () {
                        timeArray2.push($(this).val());
                    });
                    $("input:checkbox[name=time_3]:checked").each(function () {
                        timeArray3.push($(this).val());
                    });
                    $("input:checkbox[name=time_4]:checked").each(function () {
                        timeArray4.push($(this).val());
                    });
                    builder.stepSave(step, {
                        "full_time": FormValidate.getCheckedFieldValue("full_time"),
                        "part_time": FormValidate.getCheckedFieldValue("part_time"),
                        "internship": FormValidate.getCheckedFieldValue('internship'),
                        "contractual": FormValidate.getCheckedFieldValue("contractual"),
                        "summer_positions": FormValidate.getCheckedFieldValue('summer_positions'),
                        "recruitment": FormValidate.getCheckedFieldValue('recruitment'),
                        "field_placement": FormValidate.getCheckedFieldValue('field_placement'),
                        "volunteer": FormValidate.getCheckedFieldValue('volunteer'),
                        "time_1": timeArray1.join(","),
                        "time_2": timeArray2.join(","),
                        "time_3": timeArray3.join(","),
                        "time_4": timeArray4.join(",")
                    }, ['full_time', 'is_complete', 'token'], true, function (data) {
                        if (data.is_complete === 1) {
                            builder.availability.is_complete = 1;
                            builder.status();
                        }
                    });
                    break;
                case 'BasicInfo':
                    var year = FormValidate.getFieldValue('user-year');
                    var month = FormValidate.getFieldValue('user-month');
                    var day = FormValidate.getFieldValue('user-day');
                    var birthDate = year + '-' + month + '-' + day;

                    var code = $('#country-phone .bfh-selectbox-option').clone();
                    code.find('span').remove();

                    builder.stepSave(step, {
                        "first_name": FormValidate.getFieldValue("first_name"),
                        "last_name": FormValidate.getFieldValue("last_name"),
                        "headline": _form.find('[name=headline]').val(),
                        "headline_fr": _form.find('[name=headline_fr]').val(),
                        //"street": FormValidate.getFieldValue("street"),
                        "street": builder.street,
                        //"mobile_phone": FormValidate.getFieldValue("mobile_phone"),
                        "phone_number": FormValidate.getFieldValue("phone_number"),
                        "phone_code": code.text().replace(" ", ""),
                        "phone_country_code": _form.find('.country').val(),
                        "website": FormValidate.getFieldValue("website"),
                        "about": FormValidate.getFieldValue("about"),
                        "about_fr": FormValidate.getFieldValue("about_fr"),
                        "birth_date": birthDate,
                        "city": builder.city,
                        "region": builder.region,
                        "country": builder.country,
                        "country_code": builder.countryCode,
                        "facebook": FormValidate.getFieldValue('facebook'),
                        "instagram": FormValidate.getFieldValue('instagram'),
                        "linkedin": FormValidate.getFieldValue('linkedin'),
                        "twitter": FormValidate.getFieldValue('twitter')
                    }, ['headline', 'is_complete', 'token'], true, function (data) {
                        if (data.is_complete === 1) {
                            builder.basic.is_complete = 1;
                            builder.status();
                            user.refresh();
                        }
                    });
                    break;
                case 'Education':
                    if (FormValidate.getCheckedFieldValue("not_education") == 0) {
                        $('#resume-builder-form .form-tab-menu .bg-white.active').next().find('button').click();
                        $('html, body').animate({
                            scrollTop: $("#resume-builder-form").offset().top
                        }, 500);
                    } else {
                        var not_education = FormValidate.getCheckedFieldValue("not_education") == 1 ? 1 : 0;
                        builder.stepSave(step, {
                            "not_education": not_education,
                        }, ['not_education', 'token'], true, function (data) {
                            if (data.not_education === 1) {
                                builder.preference.not_education = 1;
                            } else {
                                builder.preference.not_education = 2;
                            }
                            builder.status();
                        });
                    }
                    break;
                case 'Experience':
                    if (FormValidate.getCheckedFieldValue("first_job") == 0) {
                        $('#resume-builder-form .form-tab-menu .bg-white.active').next().find('button').click();
                        $('html, body').animate({
                            scrollTop: $("#resume-builder-form").offset().top
                        }, 500);
                    } else {
                        var first_job = FormValidate.getCheckedFieldValue("first_job") == 1 ? 1 : 0;
                        builder.stepSave(step, {
                            "first_job": first_job,
                        }, ['first_job', 'token'], true, function (data) {
                            if (data.first_job === 1) {
                                builder.preference.first_job = 1;
                            } else {
                                builder.preference.first_job = 2;
                            }
                            builder.status();
                        });
                    }
                    break;
                case 'Certification':
                    if (FormValidate.getCheckedFieldValue("not_certification") == 0 && FormValidate.getCheckedFieldValue("not_distinction") == 0) {
                        $('#resume-builder-form .form-tab-menu .bg-white.active').next().find('button').click();
                        $('html, body').animate({
                            scrollTop: $("#resume-builder-form").offset().top
                        }, 500);
                    } else {
                        var params = {};
                        if (FormValidate.getCheckedFieldValue("not_certification") != 0) {
                            params['not_certification'] = FormValidate.getCheckedFieldValue("not_certification") == 1 ? 1 : 0;
                        }
                        if (FormValidate.getCheckedFieldValue("not_distinction") != 0) {
                            params['not_distinction'] = FormValidate.getCheckedFieldValue("not_distinction") == 1 ? 1 : 0;
                        }
                        builder.stepSave(step, params, [
                            'not_certification',
                            'not_distinction',
                            'token'
                        ], true, function (data) {
                            if (data.not_certification !== undefined) {
                                builder.preference.not_education = data.not_certification === 1 ? 1 : 2;
                            }
                            if (data.not_distinction !== undefined) {
                                builder.preference.not_distinction = data.not_distinction === 1 ? 1 : 2;
                            }
                            builder.status();
                        });
                    }
                    break;
                default:
                    if ($('#resume-builder-form .form-tab-menu .bg-white.active').next().length > 0) {
                        $('#resume-builder-form .form-tab-menu .bg-white.active').next().find('button').click();
                        $('html, body').animate({
                            scrollTop: $("#resume-builder-form").offset().top
                        }, 500);
                    } else {
                        if ( _this.preference.is_complete == 1 && _this.availability.is_complete == 1 && _this.basic.is_complete == 1
                            && (_this.preference.not_education == 1 || _this.education.length > 0) && (_this.preference.first_job!== null || _this.experience.length > 0) ) {
                            window.location.href = '/user/dashboard';
                        } else {
                            var tab;
                            if (_this.preference.is_complete != 1) {
                                tab = 'preferences';
                            } else if (_this.availability.is_complete != 1) {
                                tab = 'availabilities';
                            } else if (_this.basic.is_complete != 1) {
                                tab = 'basic';
                            } else if (_this.preference.not_education != 1 || _this.education.length == 0) {
                                tab = 'education';
                            } else if (_this.preference.first_job ==null && _this.experience.length ==0) {
                                tab = 'experience';
                            }
                            $('#resume-builder-form .form-tab-menu').find('[data-tab="'+tab+'"]').find('button').click();
                        }
                    }
                    break;
            }
            /*setTimeout(function () {
                builder.showStatus();
            },1000);*/
        });

        /*$formForLocation.find('.form-tab-menu button').on('click', function () {
            var elem = $(this).parent();
            setTimeout(function () {
                builder.showStatus(elem.attr('data-tab'), elem.next().attr('data-tab'));
            }, 0);

        });*/

        //scroll to top form and showStatus resume builder
        $('.resume-tab').click(function () {
            $('html, body').animate({
                scrollTop: $("#resume-builder-form").offset().top
            }, 500);
            var param = $(this).attr('data-tab');
            updateQueryStringParam("tab", param);
            var elem = $(this);
            setTimeout(function () {
                builder.showStatus(elem.attr('data-tab'), elem.next().attr('data-tab'));
            }, 1000);
        });

        //set active tab by url
        var urlTabParam = getUrlParameter("tab");
        if (urlTabParam) {
            user.clickSaveStep = true;
            $('.resume-tab[data-tab="' + urlTabParam + '"]').find('button').click();
        } else {
            this.showStatus();
            //$('#next-step-title').text('Availabilities');
        }


        //show all items in resume
        this._preferenceGet();
        this._availabilityGet();
        this._basicGet();
        this._educationGet();
        this._experienceGet();
        this._referenceGet();
        this._skillGet();
        this._languageGet();
        this._certificationGet();
        this._distinctionGet();
        this._hobbyGet();
        this._interestGet();

        //show view content
        setTimeout(function () {
            $('#loaded-data').show();
        }, 0);

        $('#not-education-yes, #not-certification-yes, #not-distinction-yes').parent().click(function () {
            if (!$(this).hasClass('active')) {
                $('#infoModal').modal('show');
            }

        });

        $('[name="looking_job"]').parent().click(function () {
            if ($(this).find('input').val() == 'yes') {
                $('[name="new_job"][value="yes"]').closest('.form-group').hide();
                $('[name="new_job"][value="no"]').parent().click();
            } else {
                $('[name="new_job"][value="yes"]').closest('.form-group').show();
            }
        });
    },
    //check status resume
    checkShowStatus: function (type, number, rezCheckValue, typeTab, typeNextTab, progress, percent, time, required) {
        var svgCheck = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 448.8 448.8" style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px;" xml:space="preserve"><g><g id="check"><polygon points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"></polygon></g></g></svg>';
        required = required || false;
        if (typeTab == type) {
            if (!$('.resume-tab[data-tab="' + type + '"] button div').hasClass('done')) {
                $('.resume-tab[data-tab="' + type + '"] button div').removeClass('notactive').removeClass('done_check').removeClass('notdone').addClass('done').text(number);
            }
            if (rezCheckValue) {
                progress['percent'] += percent;
                progress['number']++;
            } else {
                progress['uncompleted'].push([number, type]);
            }
            $('#current-step-time').text(Langs.less_than + time + ' minute');
        } else if (rezCheckValue) {
            if (!$('.resume-tab[data-tab="' + type + '"] button div').hasClass('done_check')) {
                $('.resume-tab[data-tab="' + type + '"] button div').removeClass('notactive').removeClass('done').removeClass('notdone').addClass('done_check').text('').append(svgCheck);
            }
            progress['percent'] += percent;
            progress['number']++;
        } else {
            progress['uncompleted'].push([number, type]);
            if (typeNextTab == type) {
                if (!$('.resume-tab[data-tab="' + type + '"] button div').hasClass('notdone')) {
                    $('.resume-tab[data-tab="' + type + '"] button div').removeClass('notactive').removeClass('done_check').removeClass('done').addClass('notdone').text(number);
                }
            } else {
                if (required) {
                    if (!$('.resume-tab[data-tab="' + type + '"] button div').hasClass('notdone')) {
                        $('.resume-tab[data-tab="' + type + '"] button div').removeClass('notactive').removeClass('done_check').removeClass('done').addClass('notdone').text(number);
                    }
                } else {
                    if (!$('.resume-tab[data-tab="' + type + '"] button div').hasClass('notactive')) {
                        $('.resume-tab[data-tab="' + type + '"] button div').removeClass('notdone').removeClass('done_check').removeClass('done').addClass('notactive').text(number);
                    }
                }
            }
        }
        return progress;
    },
    showStatus: function (typeTab, typeNextTab) {
        typeNextTab = typeNextTab || (typeTab ? 'end' : 'availabilities');
        typeTab = typeTab || 'preferences';
        var progress = [];
        progress['percent'] = 0;
        progress['number'] = 0;
        progress['uncompleted'] = [];

        progress = this.checkShowStatus('preferences', 1, (this.preference.is_complete == 1), typeTab, typeNextTab, progress, 12, 1, true);
        progress = this.checkShowStatus('availabilities', 2, (this.availability.is_complete == 1), typeTab, typeNextTab, progress, 12, 1, true);
        progress = this.checkShowStatus('basic', 3, (this.basic.is_complete == 1), typeTab, typeNextTab, progress, 12, 1, true);
        progress = this.checkShowStatus('education', 4, (this.preference.not_education == 1 || this.education.length > 0), typeTab, typeNextTab, progress, 12, 1, true);
        progress = this.checkShowStatus('experience', 5, (this.preference.first_job !== null || this.experience.length > 0), typeTab, typeNextTab, progress, 12, 1, true);

        progress = this.checkShowStatus('skills', 6, (this.skill.length > 0 || this.language.length > 0), typeTab, typeNextTab, progress, 10, 1);
        progress = this.checkShowStatus('certifications', 7, (this.preference.not_certification || this.certification.length > 0 || this.preference.not_distinction || this.distinction.length > 0), typeTab, typeNextTab, progress, 10, 1);
        progress = this.checkShowStatus('interests', 8, (this.hobby.length > 0 || this.interest.length > 0), typeTab, typeNextTab, progress, 10, 1);
        progress = this.checkShowStatus('references', 9, (this.reference.length > 0), typeTab, typeNextTab, progress, 10, 1);

        var elSpan = $('.resume-tab[data-tab="' + typeTab + '"]').find('button .tab-span').clone(),
            stepType = elSpan.find('.tab-type').text(),
            classType = 'tab-type-' + stepType.toLowerCase();
        elSpan.find('.tab-type').remove();
        if (typeTab == 'done') {
            $('#current-step-title').parent().find('strong').text('');
        } else {
            $('#current-step-title').parent().find('strong').text(Langs.current_step);
        }
        $('#current-step-title').text(elSpan.text());
        $('#current-step-type').text(stepType).addClass(classType);

        var nnn = 0;
        switch (typeTab) {
            case 'preferences' :
                nnn = 1;
                break;
            case 'availabilities' :
                nnn = 2;
                break;
            case 'basic' :
                nnn = 3;
                break;
            case 'education' :
                nnn = 4;
                break;
            case 'experience' :
                nnn = 5;
                break;
            case 'skills' :
                nnn = 6;
                break;
            case 'certifications' :
                nnn = 7;
                break;
            case 'interests' :
                nnn = 8;
                break;
            case 'references' :
                nnn = 9;
                break;
        }
        var tabNext = [],
            isFind = false;
        if (progress['uncompleted'].length > 0) {
            jQuery.each(progress['uncompleted'], function (index, value) {
                if (!isFind && value[0] > nnn) {
                    tabNext = value;
                    isFind = true;
                }
            });
            if (tabNext.length == 0) {
                tabNext = progress['uncompleted'][0];
            }
            elSpan = $('.resume-tab[data-tab="' + tabNext[1] + '"]').find('button .tab-span').clone();
            elSpan.find('.tab-type').remove();
            $('#next-step-title').text(elSpan.text());
            $('#next-step-title').parent().find('strong').text(Langs.next_step);
            $('#next-step-title').parent().find('span').text(Langs.fill_in_your);
            $('#next-step-title').parent().find('button').remove();
        } else {
            $('#next-step-title').text(Langs.all_completed);
            $('#next-step-title').parent().find('strong').text('');
            $('#next-step-title').parent().find('span').text('');

            if ($('#next-step-title').parent().find('button').length == 0) {
                var buttonHtml = '<button type="button" class="btn btn-primary ml-4 btn-sm">' +
                    Langs.done_what_now +
                    '</button>';
                $('#next-step-title').parent().append(buttonHtml);
            }
        }

        /*if (nnn.tab=='end') {
            $('#next-step-title').text('');
            $('#next-step-title').parent().find('strong').text('End');
            $('#next-step-title').parent().find('span').text('');
        } else {
            $('#next-step-title').parent().find('strong').text('Next step');
            $('#next-step-title').parent().find('span').text('Fill in your');
        }
        if (nnn.tab=='done') {
            $('#next-step-title').parent().find('span').text('');
        } else {
            $('#next-step-title').parent().find('span').text('Fill in your');
        }*/

        $('#progress-text').text(progress['percent'] + '%');
        $('#progress-percent').css({width: progress['percent'] + '%'});
        $('#progress-count').text(progress['number'] + '/9');
        var countResumeBuilder = 9 - progress['number'];
        if ($('.countResumeBuilder').eq(0).text() != countResumeBuilder) {
            if (countResumeBuilder == 0) {
                //$('.countResumeBuilder').toggle("bounce", { times: 5, distance : 10 }, "slow" );
                $('.countResumeBuilder').fadeOut().text(0);
            } else {
                //$('.countResumeBuilder').fadeOut().text(countResumeBuilder).toggle("bounce", /*{ times: 5, distance : 10 },*/ "slow" );
                $('.countResumeBuilder').text(countResumeBuilder).addClass('bounceIn');
                setTimeout(function () {
                    $('.countResumeBuilder').removeClass('bounceIn');
                }, 500);
            }
        }
    },
    status: function () {
        this.complete = this.preference.is_complete + this.availability.is_complete + this.basic.is_complete;
        if (this.complete === 3 && (this.preference.not_education || this.education.length > 0) && (this.preference.first_job !== null || this.experience.length > 0)) {
            $('#menu-content').find('a:not(.profile-switcher)').unbind();
            $('.navigation a').unbind();
            $('.resume-builder_link-preview').attr('href','/user/resume/view');
        } else {
            $('.resume-builder_link-preview').attr('href', this.data.attach_file);

            var needFill = "";
            if (this.preference.is_complete === 0) {
                needFill += Langs.job_preference + ";";
            }
            if (this.availability.is_complete === 0) {
                needFill += Langs.availability + ";";
            }
            if (this.basic.is_complete === 0) {
                needFill += Langs.basic_info + ";";
            }
            if (!this.preference.not_education && this.education.length > 0) {
                needFill += Langs.education + ";";
            }
            if (this.preference.first_job == null && this.experience.length == 0) {
                needFill += Langs.experience + ";";
            }
            $('#menu-content').find('a:not(.profile-switcher)').unbind();
            $('.navigation a').unbind();
            $('#menu-content').find('a:not(.profile-switcher)').click(function (e) {
                e.preventDefault();
                $.notify(Langs.please_fill_in_resume + ' - ' + needFill, 'error');
            });
            $('.navigation a').click(function (e) {
                e.preventDefault();
                $.notify(Langs.please_fill_in_resume + ' - ' + needFill, 'error');
            });
        }
    },

    getIndustry: function (sub, val, subVal) {
        var _this = this;
        if (sub) {
            if (typeof val === 'string') {
                _this.msIndustryValue = explode(",", val);
            }
        }
        if (subVal) {
            if (typeof subVal === 'string') {
                _this.msSubIndustryValue = explode(",", subVal);
            }
        }
        var select = (sub) ? $('#sub_industries') : $('#industries');
        if (sub && typeof sub !== 'string') {
            let sub_str = '';
            $.each( sub, function( key, value ) {
                if (sub_str.length > 0) {
                    sub_str += ',';
                }
                sub_str += value;
            });
            sub = sub_str
        }
        var params = (sub) ? {parent_id: sub} : {};
        new GraphQL("query", "industries", params, [
            'id',
            'name'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            if (data) {
                if (!sub) {
                    _this.industries = data;
                    if (_this.msIndustry) {
                        _this.msIndustry.setData(data);
                    } else {
                        _this.msIndustry = select.magicSuggest({
                            placeholder: Langs.choose_industry,
                            toggleOnClick: true,
                            allowFreeEntries: false,
                            data: data,
                            required: true,
                            hideTrigger: true,
                            noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                            cls: 'jack input_style industries_box field-box'
                        });
                    }
                    if (val) {
                        var v = explode(",", val);
                        _this.msIndustry.setValue(v);
                        _this.getIndustry(val, val, subVal);
                    }
                } else {
                    if (_this.msSubIndustry) {
                        _this.msSubIndustry.setData(data);
                    } else {
                        _this.msSubIndustry = select.magicSuggest({
                            placeholder: Langs.choose_sub_industry,
                            toggleOnClick: true,
                            allowFreeEntries: false,
                            data: data,
                            hideTrigger: true,
                            noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                            cls: 'jack input_style industries_box field-box'
                        });
                        if (subVal) {
                            var v = explode(",", subVal);
                            _this.msSubIndustry.setValue(v);
                        }
                    }
                }
                var a = _this.msIndustry;
                if (sub) {
                    a = _this.msSubIndustry;
                }
                $(a).unbind('selectionchange');
                $(a).on('selectionchange', function () {
                    FormValidate.fieldValidateClear('#industries');
                    user.clickSaveStep = false;
                    if (!sub) {
                        if (this.getValue().length !== 0) {
                            var id = this.getValue();
                            _this.msIndustryValue = id;
                            _this.msSubIndustryValue = null;
                            if (_this.msSubIndustry) {
                                _this.msSubIndustry.clear();
                            }
                            _this.getIndustry(id, id, null);
                        } else {
                            _this.msSubIndustry.clear();
                            _this.msSubIndustry.setData([]);
                            _this.msIndustryValue = null;
                            _this.msSubIndustryValue = null;
                        }
                    } else {
                        var id = this.getValue();
                        _this.msSubIndustryValue = id;
                    }
                });
                Loader.contentLoader = true;
                Loader.loaderToElement = select;
                Loader.stop();
            }
        }).request(select, false, false);
    },

    getCategoryPopular: function () {
        new GraphQL("query", 'categories', {
            'sub': 1,
            'popular': 1
        }, ['id', 'name'], false, false, function (data) {
            //show error
        }, function (data) {
            if (data) {
                var html = '';
                $.map(data, function (item) {
                    html += '<div class="text-center pl-0 pxa-0 mb-2">\n' +
                        '<a href="javascript:void(0)" class="cat-popular-item rounded px-2" style="border:1px solid #007bff;" data-id="' + item.id + '">' + item.name + '</a>\n' +
                        '</div>';
                });
                $('#category-popular-list').html(html);
            }
        }).request($('#category-popular-list'));
    },

    getCategory: function (def) {
        var _this = this;
        this.getMSList(function (items, defaultData) {
            _this.msCategory = _this.msCategoryElement.magicSuggest({
                placeholder: Langs.type_category_name,
                maxSelection: 30,
                toggleOnClick: false,
                allowFreeEntries: true,
                data: [],
                hideTrigger: true,
                noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                cls: 'jack input_style'
            });
            if (defaultData) {
                //console.log(defaultData);
                _this.msCategory.setSelection(defaultData);
            }
            var timeout = null;
            $(_this.msCategory).on('keyup', function () {
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    _this.getMSList(function (items) {
                        _this.msCategory.setData(items);
                    }, 'categories', _this.msCategoryElement, _this.msCategory.getRawValue());
                }, 500);
            });
        }, 'categories', $('#categories'), undefined, def);
    },

    getMSList: function (callback, method, el, keywords, defaultData) {
        var params = {
            'sub': 1
        };
        var need = ['id name'];
        if (defaultData) {
            params['default'] = defaultData;
            //     need.push('default{id name}')
        }
        if (keywords) {
            params['keywords'] = keywords;
        }

        // if ((!keywords || keywords.length === 0) && method === 'categories') {
        //     callback([], defaultData);
        // } else {
        new GraphQL("query", method, params, need, false, false, function (data) {
            //show error
        }, function (data) {
            if (data) {
                var items = $.map(data, function (item) {
                    return {
                        id: item.id,
                        name: item.name
                    };
                });
                if ((!keywords || keywords.length === 0) && method === 'categories') {
                    callback([], items);
                } else {
                    callback(items);
                }
            }
        }).request(el);
        // }
    },

    // getCategory: function (sub, val, subVal) {
    // var _this = this;
    // if (sub) {
    //     if (typeof val === 'string') {
    //         _this.msCategoryValue = explode(",", val);
    //     }
    // }
    // if (subVal) {
    //     if (typeof subVal === 'string') {
    //         _this.msSubCategoryValue = explode(",", subVal);
    //     }
    // }
    // var select = (sub) ? $('#sub_categories') : $('#categories');
    // var params = (sub) ? {parent_id: sub} : {};
    // new GraphQL("query", "categories", params, [
    //     'id',
    //     'name'
    // ], false, false, function () {
    //     Loader.stop();
    // }, function (data) {
    //     if (data) {
    //         if (!sub) {
    //             _this.categories = data;
    //             if (_this.msCategory) {
    //                 _this.msCategory.setData(data);
    //             } else {
    //                 _this.msCategory = select.magicSuggest({
    //                     placeholder: 'Choose an Category',
    //                     toggleOnClick: true,
    //                     allowFreeEntries: false,
    //                     data: data,
    //                     required: true,
    //                     hideTrigger: true,
    //                     noSuggestionText: '<strong>{{query}}</strong> not found',
    //                     cls: 'jack input_style industries_box field-box'
    //                 });
    //             }
    //             if (val) {
    //                 var v = explode(",", val);
    //                 _this.msCategory.setValue(v);
    //                 _this.getCategory(val, val, subVal);
    //             }
    //         } else {
    //             if (_this.msSubCategory) {
    //                 _this.msSubCategory.setData(data);
    //             } else {
    //                 _this.msSubCategory = select.magicSuggest({
    //                     placeholder: 'Choose an sub-Category',
    //                     toggleOnClick: true,
    //                     allowFreeEntries: false,
    //                     data: data,
    //                     hideTrigger: true,
    //                     noSuggestionText: '<strong>{{query}}</strong> not found',
    //                     cls: 'jack input_style industries_box field-box'
    //                 });
    //                 if (subVal) {
    //                     var v = explode(",", subVal);
    //                     _this.msSubCategory.setValue(v);
    //                 }
    //             }
    //         }
    //         var a = _this.msCategory;
    //         if (sub) {
    //             a = _this.msSubCategory;
    //         }
    //         $(a).unbind('selectionchange');
    //         $(a).on('selectionchange', function () {
    //             FormValidate.fieldValidateClear('#categories');
    //             if (!sub) {
    //                 if (this.getValue().length !== 0) {
    //                     var id = this.getValue();
    //                     _this.msCategoryValue = id;
    //                     _this.msSubCategoryValue = null;
    //                     if (_this.msSubCategory) {
    //                         _this.msSubCategory.clear();
    //                     }
    //                     _this.getCategory(id, id, null);
    //                 } else {
    //                     _this.msSubCategory.clear();
    //                     _this.msSubCategory.setData([]);
    //                     _this.msCategoryValue = null;
    //                     _this.msSubCategoryValue = null;
    //                 }
    //             } else {
    //                 var id = this.getValue();
    //                 _this.msSubCategoryValue = id;
    //             }
    //         });
    //         Loader.contentLoader = true;
    //         Loader.loaderToElement = select;
    //         Loader.stop();
    //     }
    // }).request(select, false, false);
    // },

    _preferenceGet: function () {
        if (this.preference) {
            $('input[name="looking_job"][value="' + this.preference.looking_job + '"]').prop('checked', 'checked').parent().addClass('active');
            $('input[name="current_type"][value="' + this.preference.current_type + '"]').prop('checked', 'checked').parent().addClass('active');
            $('input[name="current_job"][value="' + this.preference.current_job + '"]').prop('checked', 'checked').parent().addClass('active');
            if (this.preference.interested_jobs) {
                var interestedJobs = this.preference.interested_jobs.split(",");
                $.each(interestedJobs, function (k, v) {
                    $('input[name="interested_jobs"][value="' + v + '"]').prop('checked', true).parent().addClass('active');
                });
            }
            $('input[name="new_job"][value="' + this.preference.new_job + '"]').prop('checked', 'checked').parent().addClass('active');
            $('input[name="new_opportunities"][value="' + this.preference.new_opportunities + '"]').prop('checked', 'checked').parent().addClass('active');
            var distance = this.preference.distance;
            if (distance) {
                $('input[name="distance"]').val(distance);
            }
            $('input[name="distance_type"][value="' + this.preference.distance_type + '"]').prop('checked', 'checked').parent().addClass('active');
            $('select[name="industries"]').val(this.preference.industries).change();
            var salary = this.preference.salary;
            if (salary) {
                $('input[name="salary"]').val(salary);
            }
            var hoursFrom = this.preference.hours_from;
            var hoursTo = this.preference.hours_to;
            $('#hourly_salary').slider("values", [hoursFrom, hoursTo]);

            this.getIndustry(false, this.preference.industries, this.preference.sub_industries);
            if (this.preference.sub_categories == '') {
                this.preference.sub_categories = 'null';
            }
            this.getCategory(this.preference.sub_categories);
            //this.getCategoryPopular();
        }
    },

    _availabilityGet: function () {
        if (this.availability) {
            $.each(this.availability, function (k, v) {
                if (v === 1 && $.inArray(k, ['time_1', 'time_2', 'time_3', 'time_4']) === -1) {
                    $('input[name="' + k + '"]').prop('checked', 'checked').parent().addClass('active');
                }
            });
            for (var t = 1; t <= 4; t += 1) {
                if (this.availability['time_' + t] !== null) {
                    var time = this.availability['time_' + t].split(",");
                    var i = 1;
                    $.each(time, function (k, v) {
                        $('input[name="time_' + t + '"][value="' + v + '"]').prop('checked', true);
                        i += 1;
                    });
                    if (time.length === 7) {
                        $('#user-availabilities').find('input[data-time="' + (t - 1) + '"]').prop('checked', true);
                    }
                }
            }
        }
    },

    _basicGet: function () {
        if (this.basic) {
            var city = this.data.city;
            var region = this.data.region;
            var country = this.data.country;
            var countryCode = this.data.country_code;

            var location = city;
            if (region !== null) {
                location += "," + region;
            }
            if (country !== null) {
                location += "," + country;
            }

            var birthday = formatDate(new Date(this.data.birth_date));
            $('select[name="user-year"]').val(birthday[2]);
            $('select[name="user-month"]').val(birthday[1]+1);
            $('select[name="user-day"]').val(parseInt(birthday[0]));

            $('#user-location').val(location);
            $('#basic-addon1').find('i').removeClassRegex(/^bfh-flag-/);
            $('#basic-addon1').find('i').addClass('bfh-flag-' + countryCode);

            $('input[name="street"]').val(this.data.street);
            //$('input[name="mobile_phone"]').val(this.data.mobile_phone);
            $('input[name="phone_number"]').val(this.data.phone_number);
            
            if (this.data.phone_country_code) {
                $(document).find('.country').val(this.data.phone_country_code);
                $(document).find('#country-phone').attr("data-country", this.data.phone_country_code);
                $(document).find('#country-phone a[data-option=' + this.data.phone_country_code + ']').trigger("click");
            }

            $('input[name="first_name"]').val(this.data.first_name);
            $('input[name="last_name"]').val(this.data.last_name);
            $.each(this.basic, function (k, v) {
                if (v !== null && $.inArray(k, ['region', 'country', 'country_code', 'city']) === -1) {
                    $('*[name="' + k + '"]').val(v);
                }
            });
            if ($('input[name="mobile_phone"]').val() === $('input[name="country_phone"]').val()) {
                $('input[name="country_phone"]').attr('readonly', true);
                $('#phone-same-as').prop('checked', true);
            }
            $('input[name="facebook"]').val(this.basic.facebook);
            $('input[name="instagram"]').val(this.basic.instagram);
            $('input[name="linkedin"]').val(this.basic.linkedin);
            $('input[name="twitter"]').val(this.basic.twitter);
        }
    },

    _educationGet: function () {
        education.getList(this.education, {'not_education': this.preference.not_education});
    },

    _experienceGet: function () {
        experience.getList(this.experience, {'first_job': this.preference.first_job});
    },

    _referenceGet: function () {
        reference.getList(this.reference);
    },

    _skillGet: function () {
        skill.getList(this.skill);
    },

    _languageGet: function () {
        language.getList(this.language);
    },

    _certificationGet: function () {
        certification.getList(this.certification, {'not_certification': this.preference.not_certification});
    },

    _distinctionGet: function () {
        distinction.getList(this.distinction, {'not_distinction': this.preference.not_distinction});
    },

    _hobbyGet: function () {
        hobby.getList(this.hobby);
    },

    _interestGet: function () {
        interest.getList(this.interest);
    },

    stepSave: function (step, data, needParams, showNext, callback, objectData) {
        var form = $('#resume-builder-form');
        //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
        new GraphQL("mutation", "updateUser" + step, data, needParams, true, false, function (data) {
            Loader.stop();
        }, function (data) {
            if (showNext) {
                if ($('#resume-builder-form .form-tab-menu .bg-white.active').next()) {
                    $('#resume-builder-form .form-tab-menu .bg-white.active').next().find('button').click();
                    $('html, body').animate({
                        scrollTop: $("#resume-builder-form").offset().top
                    }, 500);
                }
            }
            if (callback) {
                callback(data);
            }
        }, form, objectData).request();
    }
};

function SentResume() {
    //set param for empty items search
    this.search = 0;

    this.history = [];

    this.currentAcceptId;

    this.keywordsSeen;
    this.sortSeen;
    this.orderSeen;
    this.perPageSeen = 25;
    this.currentPageSeen = 1;
    this.countPagesSeen;

    this.keywordsNotSeen;
    this.sortNotSeen;
    this.orderNotSeen;
    this.perPageNotSeen = 25;
    this.currentPageNotSeen = 1;
    this.countPagesNotSeen;
}

SentResume.prototype = {
    init: function () {
        var _this = this;

        var body = $('body');

        //search items by current type
        var timeout = null;
        $('.resume-search').on('keyup', function (e) {
            if (e.which <= 90 && e.which >= 48 || e.which === 13 || e.which === 8) {
                var type = +$(this).attr('data-type');
                if (type === 1) {
                    _this.keywordsSeen = $(this).val().trim();
                    _this.currentPageSeen = 1;
                } else {
                    _this.keywordsNotSeen = $(this).val().trim();
                    _this.currentPageNotSeen = 1;
                }
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    _this.getItems(true, type);
                }, 500);
            }
        });

        //set sort & order for items
        $('.sort-resume').change(function () {
            var type = +$(this).attr('data-type');
            if (type === 1) {
                _this.sortSeen = $(this).val();
                _this.currentPageSeen = 1;
                _this.orderSeen = $(this).find('option:selected').attr('data-order');
            } else {
                _this.sortNotSeen = $(this).val();
                _this.currentPageNotSeen = 1;
                _this.orderNotSeen = $(this).find('option:selected').attr('data-order');
            }
            setTimeout(function () {
                _this.getItems(true, type);
            }, 0);
        });

        //set per-page limit
        $('.resume-per-page').on('change', function () {
            var limit = $(this).val();
            var type = +$(this).attr('data-type');
            if (type === 1) {
                _this.perPageSeen = +limit;
                _this.currentPageSeen = 1;
            } else {
                _this.perPageNotSeenSeen = +limit;
                _this.currentPageNotSeenSeen = 1;
            }
            setTimeout(function () {
                _this.getItems(true, type);
            }, 0);
        });

        body.on('click', '.page-link.page', function () {
            var type = +$(this).attr('data-type');
            if (type === 1) {
                _this.currentPageSeen = +$(this).text();
            } else {
                _this.currentPageNotSeen = +$(this).text();
            }
            _this.getItems(true, type);
        });
        body.on('click', '.page-prev', function () {
            var type = +$(this).attr('data-type');
            if (type === 1) {
                if (_this.currentPageSeen > 1) {
                    _this.currentPageSeen -= 1;
                    _this.getItems(true, type);
                }
            } else {
                if (_this.currentPageNotSeen > 1) {
                    _this.currentPageNotSeen -= 1;
                    _this.getItems(true, type);
                }
            }
        });
        body.on('click', '.page-next', function () {
            var type = +$(this).attr('data-type');
            if (type === 1) {
                if (_this.currentPageSeen < _this.countPagesSeen) {
                    _this.currentPageSeen += 1;
                    _this.getItems(true, type);
                }
            } else {
                if (_this.currentPageNotSeen < _this.countPagesNotSeen) {
                    _this.currentPageNotSeen += 1;
                    _this.getItems(true, type);
                }
            }
        });

        body.on('click', '.resume-update-btn', function () {
            window.location.href = '/user/resume/create';
        });

        body.on('click', '.accept-resume-request', function () {
            var id = $(this).attr('data-id');
            if (id) {
                _this.currentAcceptId = id;
                $('#update-resume-modal').modal('show');
            }
        });

        body.on('click', '#accept-update', function () {
            new GraphQL("mutation", "resumeResponse", {
                "id": +_this.currentAcceptId
            }, ['id', 'response', 'date', 'token'], true, false, function () {
                Loader.stop();
            }, function (data) {
                if (data) {
                    setTimeout(function () {
                        $('.update-request-box[data-id="' + _this.currentAcceptId + '"]').remove();
                        var countSentResumesAsk = parseInt($('.countSentResumesAsk').eq(0).text()) - 1;
                        if (countSentResumesAsk == 0) {
                            //$('.countSentResumesAsk').toggle("bounce", { times: 5, distance : 10 }, "slow" );
                            $('.countSentResumesAsk').addClass("hide").text(0);
                        } else {
                            //$('.countSentResumesAsk').fadeOut().text(countSentResumesAsk).toggle("bounce", /*{ times: 5, distance : 10 },*/ "slow" );
                            $('.countSentResumesAsk').removeClass("hide");
                            $('.countSentResumesAsk').text(countSentResumesAsk).addClass('bounceIn');
                            setTimeout(function () {
                                $('.countSentResumesAsk').removeClass('bounceIn');
                            }, 500);
                        }
                        $('#update-resume-modal').modal('hide');
                    }, 100);
                }
            }).request();
        });

        body.on('click', '.resume-history', function () {
            var id = $(this).attr('data-id');
            var name = $(this).parent().parent().find('.resume-business-name').text();

            var html = '';
            $.map(_this.history[id], function (item) {
                if (item.candidate) {
                    html += '<div class="d-flex px-3 mt-1">\n' +
                        '                                        <div>';
                    if (item.candidate.job) {
                        html += '<p class="mb-0">\n' +
                            '                                                <svg xmlns="http://www.w3.org/2000/svg"\n' +
                            '                                                     xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"\n' +
                            '                                                     id="Capa_1"\n' +
                            '                                                     x="0px" y="0px" viewBox="0 0 512 512"\n' +
                            '                                                     style="enable-background:new 0 0 512 512; vertical-align: middle; margin-top: -4px;"\n' +
                            '                                                     xml:space="preserve" width="16px" height="16px" fill="#4E5C6E">\n' +
                            '<g>\n' +
                            '    <g>\n' +
                            '        <path d="M488.727,279.273c-6.982,0-11.636,4.655-11.636,11.636v151.273c0,6.982-4.655,11.636-11.636,11.636H46.545    c-6.982,0-11.636-4.655-11.636-11.636V290.909c0-6.982-4.655-11.636-11.636-11.636s-11.636,4.655-11.636,11.636v151.273    c0,19.782,15.127,34.909,34.909,34.909h418.909c19.782,0,34.909-15.127,34.909-34.909V290.909    C500.364,283.927,495.709,279.273,488.727,279.273z"/>\n' +
                            '    </g>\n' +
                            '</g>\n' +
                            '                            <g>\n' +
                            '                                <g>\n' +
                            '                                    <path d="M477.091,116.364H34.909C15.127,116.364,0,131.491,0,151.273v74.473C0,242.036,11.636,256,26.764,259.491l182.691,40.727    v37.236c0,6.982,4.655,11.636,11.636,11.636h69.818c6.982,0,11.636-4.655,11.636-11.636v-37.236l182.691-40.727    C500.364,256,512,242.036,512,225.745v-74.473C512,131.491,496.873,116.364,477.091,116.364z M279.273,325.818h-46.545v-46.545    h46.545V325.818z M488.727,225.745c0,5.818-3.491,10.473-9.309,11.636l-176.873,39.564v-9.309c0-6.982-4.655-11.636-11.636-11.636    h-69.818c-6.982,0-11.636,4.655-11.636,11.636v9.309L32.582,237.382c-5.818-1.164-9.309-5.818-9.309-11.636v-74.473    c0-6.982,4.655-11.636,11.636-11.636h442.182c6.982,0,11.636,4.655,11.636,11.636V225.745z"/>\n' +
                            '                                </g>\n' +
                            '                            </g>\n' +
                            '                            <g>\n' +
                            '                                <g>\n' +
                            '                                    <path d="M314.182,34.909H197.818c-19.782,0-34.909,15.127-34.909,34.909v11.636c0,6.982,4.655,11.636,11.636,11.636    s11.636-4.655,11.636-11.636V69.818c0-6.982,4.655-11.636,11.636-11.636h116.364c6.982,0,11.636,4.655,11.636,11.636v11.636    c0,6.982,4.655,11.636,11.636,11.636c6.982,0,11.636-4.655,11.636-11.636V69.818C349.091,50.036,333.964,34.909,314.182,34.909z"/>\n' +
                            '                                </g>\n' +
                            '                            </g>\n' +
                            '</svg>\n ' + item.candidate.job.title + '</p>';
                    }
                    var location = '';
                    var countryCode = '';
                    var locationName = '';

                    var locationData = item.candidate.location;
                    if (locationData) {
                        locationName = locationData.name;

                        location = locationData.city;
                        if (locationData.region !== null) {
                            location += "," + locationData.region;
                        }
                        if (locationData.country !== null) {
                            location += "," + locationData.country;
                        }

                        countryCode = locationData.country_code;
                    } else {
                        var businessData = item.candidate.business;
                        locationName = businessData.name;

                        location = businessData.city;
                        if (businessData.region !== null) {
                            location += "," + businessData.region;
                        }
                        if (businessData.country !== null) {
                            location += "," + businessData.country;
                        }
                        countryCode = businessData.country_code;
                    }
                    html += '<p class="mb-0">\n' +
                        '<svg xmlns="http://www.w3.org/2000/svg"\n' +
                        '     xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"\n' +
                        '     id="Capa_1"\n' +
                        '     x="0px" y="0px" width="16px" height="16px"\n' +
                        '     viewBox="0 0 459.758 459.758"\n' +
                        '     style="enable-background:new 0 0 459.758 459.758; vertical-align: middle; margin-top: -4px;"\n' +
                        '     xml:space="preserve" fill="#4E5C6E">\n' +
                        '<g>\n' +
                        '<g>\n' +
                        '<path d="M447.258,73.081l-105.004,0.016V54.086c0-6.903-5.597-12.5-12.5-12.5h-199.75c-6.903,0-12.5,5.597-12.5,12.5v19.011    L12.5,73.081c-6.904,0-12.5,5.597-12.5,12.5v320.091c0,6.903,5.596,12.5,12.5,12.5h69.917c6.903,0,12.5-5.597,12.5-12.5V346.68    l22.587-0.049v59.041c0,6.903,5.597,12.5,12.5,12.5h76.795c6.903,0,12.5-5.597,12.5-12.5v-66.027h21.16v66.027    c0,6.903,5.597,12.5,12.5,12.5h76.795c6.903,0,12.5-5.597,12.5-12.5v-59.041l22.587,0.049v58.992c0,6.903,5.597,12.5,12.5,12.5    h69.917c6.904,0,12.5-5.597,12.5-12.5V85.581C459.758,78.678,454.162,73.081,447.258,73.081z M117.504,321.68H82.417    c-6.904,0-12.5,5.598-12.5,12.5v58.992H25V98.081l92.504-0.034V321.68z M317.254,393.172h-51.795v-66.027    c0-6.902-5.598-12.5-12.5-12.5h-46.16c-6.903,0-12.5,5.598-12.5,12.5v66.027h-51.795V66.586h174.75V393.172z M434.758,393.172    h-44.917V334.18c0-6.902-5.596-12.5-12.5-12.5h-35.087V98.047h4.847c0.195,0.01,0.388,0.034,0.584,0.034h87.072L434.758,393.172    L434.758,393.172z"/>\n' +
                        '<path d="M84.742,128.686H60.655c-2.476,0-4.484,2.008-4.484,4.484v24.087c0,2.478,2.008,4.484,4.484,4.484h24.087    c2.477,0,4.484-2.007,4.484-4.484V133.17C89.227,130.693,87.219,128.686,84.742,128.686z"/>\n' +
                        '<path d="M84.742,196.227H60.655c-2.476,0-4.484,2.007-4.484,4.484v24.086c0,2.477,2.008,4.484,4.484,4.484h24.087    c2.477,0,4.484-2.008,4.484-4.484v-24.086C89.227,198.233,87.219,196.227,84.742,196.227z"/>\n' +
                        '<path d="M84.742,263.766H60.655c-2.476,0-4.484,2.008-4.484,4.484v24.088c0,2.477,2.008,4.484,4.484,4.484h24.087    c2.477,0,4.484-2.008,4.484-4.484V268.25C89.227,265.773,87.219,263.766,84.742,263.766z"/>\n' +
                        '<path d="M375.016,161.741h24.087c2.478,0,4.484-2.007,4.484-4.484V133.17c0-2.477-2.008-4.484-4.484-4.484h-24.087    c-2.477,0-4.483,2.008-4.483,4.484v24.087C370.531,159.734,372.539,161.741,375.016,161.741z"/>\n' +
                        '<path d="M375.016,229.281h24.087c2.478,0,4.484-2.008,4.484-4.484v-24.086c0-2.478-2.008-4.484-4.484-4.484h-24.087    c-2.477,0-4.483,2.007-4.483,4.484v24.086C370.531,227.274,372.539,229.281,375.016,229.281z"/>\n' +
                        '<path d="M375.016,296.822h24.087c2.478,0,4.484-2.008,4.484-4.484V268.25c0-2.477-2.008-4.484-4.484-4.484h-24.087    c-2.477,0-4.483,2.008-4.483,4.484v24.088C370.531,294.814,372.539,296.822,375.016,296.822z"/>\n' +
                        '<path d="M179.045,137.077h24.087c2.477,0,4.484-2.008,4.484-4.485v-24.086c0-2.477-2.008-4.484-4.484-4.484h-24.087    c-2.477,0-4.485,2.008-4.485,4.484v24.086C174.56,135.069,176.568,137.077,179.045,137.077z"/>\n' +
                        '<path d="M179.045,204.617h24.087c2.477,0,4.484-2.008,4.484-4.484v-24.087c0-2.477-2.008-4.484-4.484-4.484h-24.087    c-2.477,0-4.485,2.008-4.485,4.484v24.087C174.56,202.609,176.568,204.617,179.045,204.617z"/>\n' +
                        '<path d="M179.045,272.156h24.087c2.477,0,4.484-2.008,4.484-4.483v-24.087c0-2.479-2.008-4.484-4.484-4.484h-24.087    c-2.477,0-4.485,2.008-4.485,4.484v24.087C174.56,270.15,176.568,272.156,179.045,272.156z"/>\n' +
                        '<path d="M256.626,137.077h24.087c2.477,0,4.485-2.008,4.485-4.485v-24.086c0-2.477-2.009-4.484-4.485-4.484h-24.087    c-2.478,0-4.483,2.008-4.483,4.484v24.086C252.143,135.069,254.15,137.077,256.626,137.077z"/>\n' +
                        '<path d="M256.626,204.617h24.087c2.477,0,4.485-2.008,4.485-4.484v-24.087c0-2.477-2.009-4.484-4.485-4.484h-24.087    c-2.478,0-4.483,2.008-4.483,4.484v24.087C252.143,202.609,254.15,204.617,256.626,204.617z"/>\n' +
                        '<path d="M256.626,272.156h24.087c2.477,0,4.485-2.008,4.485-4.483v-24.087c0-2.479-2.009-4.484-4.485-4.484h-24.087    c-2.478,0-4.483,2.008-4.483,4.484v24.087C252.143,270.15,254.15,272.156,256.626,272.156z"/>\n' +
                        '</g>\n' +
                        '</g>\n' +
                        '</svg>\n' +
                        locationName +
                        '</p>\n' +
                        '<p class="mb-0" style="font-size: 14px;">\n' +
                        '<span class="item-location-flag bfh-flag-' + countryCode + '"><i' +
                        'class="glyphicon"></i> </span>\n' +
                        Langs.applied_to + ' ' + location +
                        '</p>\n' +
                        '</div>\n' +
                        '<div class="ml-auto">\n' +
                        '<p class="pt-1">' + item.candidate.date + '</p>\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '<hr>';
                }
            });

            $('#history-modal-body').html(html);
            $('#history-name-modal').text(name);

            $('#history').modal('show');
        });

        body.on('click', '.sent-item__wave', function(event) {
            event.preventDefault();
            var $el = $(this);

            new GraphQL('mutation', 'createCandidateWave', {
                'candidate_id': $(this).attr('data-candidate-id'),
            }, [
                'id',
                'time_left',
                'expired_at',
                'token',
            ], true, false, function() {
                Loader.stop();
            }, function(candidate_wave) {
                $el.attr('data-original-title', Langs.next_wave_available + ' ' + timeago().format(candidate_wave.expired_at));
                $el.removeClass('btn-primary');
                $el.addClass('btn-default');
                $el.find('svg').css('fill', '');
            }).request();
        });

        realtime.on('candidates.wave_was_deleted', function(data) {
            var $element = $('.sent-item__wave[data-candidate-id="' + data.candidate_id + '"]');
            $element.attr('data-original-title', Langs.wave_days);
            $element.removeClass('btn-default').addClass('btn-primary');
            $element.find('svg').css({ 'fill': 'rgb(255, 255, 255)' });
        });

        _this.getItems(true, 1);
        _this.getItems(true, 0);


    },
    getItems: function (show, type) {
        var _this = this;
        var params = {};
        params['status'] = type;

        var notShowLoader = (show) ? show : false;
        var keywords;
        if (type === 1) {
            keywords = _this.keywordsSeen;
            if (_this.sortSeen) {
                params['sort'] = _this.sortSeen;
            }
            if (_this.orderSeen) {
                params['order'] = _this.orderSeen;
            }
            params['limit'] = this.perPageSeen;
            params['page'] = this.currentPageSeen;
        } else {
            keywords = _this.keywordsNotSeen;
            if (this.sortNotSeen) {
                params['sort'] = _this.sortNotSeen;
            }
            if (_this.orderNotSeen) {
                params['order'] = _this.orderNotSeen;
            }
            params['limit'] = this.perPageNotSeen;
            params['page'] = this.currentPageNotSeen;
        }
        if (keywords && keywords.length > 1) {
            params['keywords'] = keywords;
        }
        // $('#business-' + this.type + '-search').val(keywords);
        var listElement = (type === 1) ? $('#seen #seen-map-list') : $('#not-seen #not-seen-map-list');
        var needItems = 'id ' +
            'html ' +
            'business{id name picture} ' +
            'history{' +
            'candidate{ ' +
            ' location{name city region country country_code} ' +
            ' job{id title} ' +
            ' business{name city region country country_code} ' +
            ' date} }' +
            ' last_wave{ time_left expired_at }';

        var need = [
            'items {' +
            needItems +
            '}',
            'pages',
            'current_page',
            'count',
            'token'
        ];
        new GraphQL("query", "sentResume", params, need, true, false, function () {
            Loader.stop();
        }, function (data) {
            listElement.html('');
            if (data.items) {
                $.map(data.items, function (item) {
                    var el = $(item.html);

                    el.find('.sent-item__wave').each(function() {
                        if (item.last_wave && item.last_wave.time_left > 0) {
                            $(this).attr('title', Langs.next_wave_available + ' ' + timeago().format(item.last_wave.expired_at));
                        }
                        else {
                            $(this).find('svg').css('fill', '#ffffff');
                        }
                    }).removeClass('btn-primary').addClass(item.last_wave && item.last_wave.time_left > 0 ? 'btn-default' : 'btn-primary');

                    el.find('.resume-history span').text(item.history.length);
                    _this.history[item.business.id] = item.history;
                    listElement.append(el);
                });
            }
            if (type === 1) {
                _this.countPagesSeen = data.pages;
            } else {
                _this.countPagesNotSeen = data.pages;
            }
            _this.pagination(data.pages, type);
        }).request((notShowLoader) ? listElement : false);
    },
    pagination: function (pages, type) {
        var _this = this;
        var html = '';
        if (pages > 1) {
            html = '<li class="page-item"><a class="page-link page-prev" data-type="' + type + '" href="javascript:void(0)"><</a></li>';
            var p = (type === 1) ? _this.currentPageSeen : _this.currentPageNotSeen;
            for (var i = 1; i <= pages; i++) {
                var active = '';
                if (p === i) {
                    active = 'active';
                }
                html += '<li class="page-item ' + active + '"><a class="page-link page" data-type="' + type + '" href="javascript:void(0)">' + i + '</a></li>';
            }
            html += '<li class="page-item"><a class="page-link page-next" data-type="' + type + '" href="javascript:void(0)">></a></li>';
        }
        if (type === 1) {
            $('#seen-items .pagination-content').html(html);
        } else {
            $('#not-seen-items .pagination-content').html(html);
        }
    }
};

$(document).ready(function () {
    loadPromise.then(function () {
        var url = document.location.pathname;
        var method = explode("user/resume/", url);
        switch (method[1]) {
            case 'create':
                //get user data
                app.addToPromise(function () {
                    new GraphQL("query", "resume", {}, [
                        'preference {' +
                            'id ' +
                            'looking_job ' +
                            'current_type ' +
                            'current_job ' +
                            'interested_jobs ' +
                            'new_job ' +
                            'new_opportunities ' +
                            'distance ' +
                            'distance_type ' +
                            'industries ' +
                            'sub_industries ' +
                            // 'categories ' +
                            'sub_categories ' +
                            'salary ' +
                            'hours_from ' +
                            'hours_to ' +
                            'is_complete ' +
                            'first_job ' +
                            'not_education ' +
                            'not_certification ' +
                            'not_distinction' +
                        '} availability {' +
                            'full_time ' +
                            'part_time ' +
                            'internship ' +
                            'contractual ' +
                            'summer_positions ' +
                            'recruitment ' +
                            'field_placement ' +
                            'volunteer ' +
                            'time_1 ' +
                            'time_2 ' +
                            'time_3 ' +
                            'time_4 ' +
                            'is_complete' +
                        '} basic {' +
                            'headline headline_fr ' +
                            'website ' +
                            'about about_fr ' +
                            'is_complete ' +
                            'facebook ' +
                            'instagram ' +
                            'linkedin ' +
                            'twitter ' +
                        '} education {' +
                            'id ' +
                            'school_name ' +
                            'city ' +
                            'region ' +
                            'country ' +
                            'country_code ' +
                            'year_from ' +
                            'year_to ' +
                            'grade ' +
                            'grade_id ' +
                            'assign_grade{id name} '+
                            'current ' +
                            'degree ' +
                            'degree_id ' +
                            'assign_degree{id name} ' +
                            'study ' +
                            'study_id ' +
                            'assign_study{id name} ' +
                            'activities ' +
                            'description ' +
                            'achievement_title ' +
                            'achievement_description ' +
                            'html' +
                        '} experience {' +
                            'id ' +
                            'title ' +
                            'title_id ' +
                            'assign_title{id name} ' +
                            'company ' +
                            'company_id ' +
                            'assign_company{id name} ' +
                            'city ' +
                            'region ' +
                            'country ' +
                            'country_code ' +
                            'year_from ' +
                            'year_to ' +
                            'month_from ' +
                            'month_to ' +
                            'current ' +
                            'industry_id ' +
                            'industry{name} ' +
                            'sub_industry_id ' +
                            'sub_industry{name} ' +
                            'description ' +
                            'additional_info ' +
                            'html' +
                        '} reference {' +
                            'id ' +
                            'email ' +
                            'phone ' +
                            'full_name ' +
                            'company ' +
                            'status ' +
                            'message ' +
                            'html' +
                        '} skill {' +
                            'id ' +
                            'title ' +
                            'title_id ' +
                            'assign_title{id name} ' +
                            'description ' +
                            'level ' +
                            'html' +
                        '} languages {' +
                            'id ' +
                            'title ' +
                            'title_id ' +
                            'assign_title{id name} ' +
                            'level ' +
                            'html' +
                        '} certification{' +
                            'id ' +
                            'title ' +
                            'title_id ' +
                            'assign_title{id name} ' +
                            'type ' +
                            'year ' +
                            'html' +
                        '} distinction {' +
                            'id ' +
                            'title ' +
                            'title_id ' +
                            'assign_title{id name} ' +
                            'year ' +
                            'html' +
                        '} hobby{' +
                            'id ' +
                            'title ' +
                            'title_id ' +
                            'assign_title{id name} ' +
                            'description ' +
                            'html' +
                        '} interest{' +
                            'id ' +
                            'title ' +
                            'title_id ' +
                            'assign_title{id name} ' +
                            'description ' +
                            'html' +
                        '} token'], true, false, function (data) {
                        Loader.stop();
                    }, function (data) {
                        setTimeout(function () {
                            user.get();
                            builder = new ResumeBuilder(data);
                        }, 500);
                    }, false).request();
                });
                /*app.addToPromise(function () {
                    //AJAX Activity Indicator
                    Loader.init();

                    var clipboard = new Clipboard('#clipboard-button');
                    clipboard.on('success', function (e) {
                        $.notify('Copied!', 'success');
                        e.clearSelection();
                    });
                });*/
                //load resume builder module
                // app.run(load);
                break;
            case 'sent':
                app.addToPromise(function () {
                    //AJAX Activity Indicator
                    Loader.init();
                    var sent = new SentResume();
                    sent.init();
                });
                // app.run();
                break;
        }
    }).then(function () {
        app.runPromise();
    });
});
