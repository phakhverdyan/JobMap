var pictureForm;
var logoBusiness;
var backgroundForm;

var msIndustry;
var msSubIndustry;

var msIndustryValue = [];
var msSubIndustryValue = null;

var msKeywords;
var msKeywordsElement = $('#keywords');
var msKeywordsFr;
var msKeywordsFrElement = $('#keywords-fr');

var msLanguages;
var msLanguagesElement = $('#languages');

var businessKeywords = [];
var businessLanguages = [];

var no_id_lang = 1;

function BusinessSignUp() {
    var businessId = null;
    var body = $('body');
    var signUpForm = $('#sign-up-business-form');
    var signUpStep1 = $('.sign-up-business-wizard .sign-up-step-1');

    var businessSteps = $('.business-steps');

    //init cropper
    new CropAvatar('business-pic-view', 'business-pic-change-btn', false, false, false);
    cropBG = new CropBusinessBG('business_background', 'business-bg-change-btn', false, false, false, false, []);

    //AJAX Activity Indicator
    Loader.init();

    businessId = getUrlParameter('b_id');

    businessSteps.hide();
    signUpStep1.show();
    var businessCity, businessRegion, businessCountry, businessCountryCode ="", businessStreet;
    var geoFullName='';

    var location = user.data.city;
    businessCity = location;
    businessRegion = user.data.region;
    businessCountry = user.data.country;
    businessCountryCode = user.data.country_code;
    businessStreet = user.data.street;

    if (user.data.region !== null) {
        location += "," + user.data.region;
    }
    if (user.data.country !== null) {
        location += "," + user.data.country;
    }
    geoFullName = location;
    if (businessId) {
        /*new GraphQL("query", "business", {
            "id": +businessId
        }, [
            'id',
            'name',
            'description',
            'industry_id',
            'sub_industry_id',
            'size_id',
            'keywords{id name}',
            'type',
            'street',
            'street_number',
            'suite',
            'website',
            'city',
            'region',
            'country',
            'country_code',
            'picture',
            'phone',
            'phone_code',
            'phone_country_code',
            'zip_code',
            'language',
            'languages',
            'token'
        ], true, false, function () {
            //
        }, function (data) {
            if (!data.id) {
                window.location.href = '/user/dashboard';
            }
            businessCity = data.city;
            businessRegion = data.region;
            businessCountry = data.country;
            businessCountryCode = data.country_code;

            signUpForm.find('input[name="name"]').val(data.name);
            signUpForm.find('input[name="zip_code"]').val(data.zip_code);
            signUpForm.find('textarea[name="description"]').val(data.description);
            signUpForm.find('input[name="website"]').val(data.website);
            signUpForm.find('input[name="street"]').val(data.street);
            signUpForm.find('input[name="street_number"]').val(data.street_number);
            signUpForm.find('input[name="suite"]').val(data.suite);
            signUpForm.find('input[name="type"][value="' + data.type + '"]').prop('checked', 'checked').parent().addClass('active');
            getSizes(function (data, signUpForm) {
                signUpForm.find('select[name="size"]').val(data);
            }, data.size_id, signUpForm);
            getLanguage(function (data, signUpForm) {
                signUpForm.find('select[name="language"]').val(data);
            }, data.language, signUpForm);
            getIndustry(false, data.industry_id, data.sub_industry_id);
            getIndustry(data.industry_id, data.industry_id, data.sub_industry_id);
            if (data.industry) {
                signUpForm.find("#citypicker").hide();
                signUpForm.find("#picked_city_block").show();
                signUpForm.find(".city_location_new").val(data.industry).attr('data-id', data.industry_id);
            }

            if (data.picture) {
                signUpForm.find('.business-pic-view img').attr('src', data.picture);
            }

            var location = businessCity;

            if (businessRegion !== null) {
                location += "," + businessRegion;
            }
            if (businessCountry !== null) {
                location += "," + businessCountry;
            }
            signUpForm.find('#user-location').val(location);

            var flag = signUpForm.find('#basic-addon1');
            flag.find('i').removeClassRegex(/^bfh-flag-/);
            flag.find('i').addClass('bfh-flag-' + businessCountryCode);

            if (data.phone) {
                signUpForm.find('input[name="phone"]').val(data.phone);
            }
            if (data.phone_country_code) {
                signUpForm.find('.country').val(data.phone_country_code);
                signUpForm.find('.bfh-selectbox-option').html('');
                signUpForm.find('.bfh-selectbox-option').html('<i class="glyphicon bfh-flag-' + data.phone_country_code + '"></i>' + BFHCountriesList[data.phone_country_code]);
            }
            businessKeywords = data.keywords;
            businessLanguages = data.languages.split(",");
            no_id_lang = data.language;
            msInit();
            Loader.contentLoader = false;
        }, false).request();*/
    } else {
        getSizes(false, false, signUpForm);

        this.getLanguages(function(data, signUpForm) {
            signUpForm.find('select[name="language_prefix"]').val(data);
            //signUpForm.find('select[name="current_language_prefix"]').val(data);
        }, ('en'), signUpForm);

        getLanguage(false, false, signUpForm);
        getIndustry();
        no_id_lang = 1;
        msInit();

        [ 'en', 'fr' ].forEach(function(current_language_prefix) {
            var capitalized_current_language_prefix = current_language_prefix[0].toUpperCase() + current_language_prefix.slice(1);
            var language_injection = '';

            if (current_language_prefix != 'en') {
                 language_injection = capitalized_current_language_prefix;
            }

            getMSList(
                function(items, defaultData) {
                    window['msKeywords' + language_injection] = window['msKeywords' + language_injection + 'Element'].magicSuggest({
                        placeholder: Langs.type_keywords,
                        toggleOnClick: false,
                        allowFreeEntries: true,
                        data: items,
                        hideTrigger: true,
                        noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found_add,

                        cls: [
                            'jack',
                            'input_style',
                            'multilanguage',
                            'multilanguage-' + current_language_prefix,
                        ].concat(current_language_prefix != 'en' ? [ 'd-none' ] : []).join(' '),
                    });

                    if (defaultData) {
                        window['msKeywords' + language_injection].setSelection(defaultData);
                    }

                    var timeout = null;

                    $(window['msKeywords' + language_injection]).on('keyup', function() {
                        clearTimeout(timeout);

                        timeout = setTimeout(function() {
                            getMSList(
                                function(items) {
                                    window['msKeywords' + language_injection].setData(items);
                                },

                                'keywords',
                                window['msKeywords' + language_injection + 'Element'],
                                window['msKeywords' + language_injection].getRawValue()
                            );
                        }, 500);
                    });
                },

                'keywords',
                window['msKeywords' + language_injection + 'Element'],
                undefined,
                ''
            );
        });

        // $('select[name="current_language_prefix"]').change(function() {
        //     var current_language_prefix = $(this).val();
        //     $('.multilanguage').addClass('d-none');
        //     $('.multilanguage-' + $(this).val()).removeClass('d-none');
        //
        //     $('.multilanguage').siblings('label').each(function() {
        //         $(this).html($(this).html().split(/\(/).slice(0, -1).join('(') + ' (' + current_language_prefix + ')');
        //     });
        //
        //     // changing localized name in job category jack:
        //
        //     var available_locales = [
        //         current_language_prefix,
        //     ].concat($(this).children().toArray().map(function(element) {
        //         return $(element).val();
        //     }).filter(function(current_locale) {
        //         return current_locale != current_language_prefix;
        //     }));
        //
        //     [
        //         'msIndustry',
        //         'msSubIndustry',
        //         'msLanguages',
        //     ].forEach(function(current_jack_name) {
        //         if (!window[current_jack_name] || !window[current_jack_name].getSelection) {
        //             return;
        //         }
        //
        //         window[current_jack_name].setData(window[current_jack_name].getData().map(function(item) {
        //             item.name = '';
        //
        //             available_locales.some(function(current_locale) {
        //                 if (item['name_' + current_locale]) {
        //                     item.name = item['name_' + current_locale];
        //                     return true;
        //                 }
        //
        //                 return false;
        //             });
        //
        //             return item;
        //         }));
        //
        //         window[current_jack_name].setSelection(window[current_jack_name].getSelection().map(function(item) {
        //             item.name = '';
        //
        //             available_locales.some(function(current_locale) {
        //                 if (item['name_' + current_locale]) {
        //                     item.name = item['name_' + current_locale];
        //                     return true;
        //                 }
        //
        //                 return false;
        //             });
        //
        //             return item;
        //         }));
        //     });
        // });

        $('select[name="language_prefix"]').change(function() {
            var default_language = $(this).val();

            // $('select[name="current_language_prefix"]').children('option').each(function() {
            //     $(this).text($(this).text().replace(/\s+\(Default\)$/, ''));
            // });
            //
            // $('select[name="current_language_prefix"]').children('option[value="' + default_language + '"]').each(function() {
            //     $(this).text($(this).text() + ' (Default)');
            // });
        });

        // $('.multilanguage').addClass('d-none');
        // $('.multilanguage-' + ($('html').attr('lang') || 'en')).removeClass('d-none');
        //
        // $('.multilanguage').siblings('label').each(function() {
        //     $(this).html($(this).html() + ' (' + ($('html').attr('lang') || 'en') + ')');
        // });
    }

    /*signUpForm.find('select[name="language"]').change(function () {
        no_id_lang = $(this).val();
        msLanguages.clear();
        getMSList(function (items) {
            msLanguages.setData(items);
        }, 'languages', msLanguagesElement, msLanguages.getRawValue());
    });*/

    new GraphQL("query", "amenities", {}, [
        'id',
        'name',
        'key'
    ], false, false, function () {
        //
    }, function (data) {
        var html = '';

        $.map(data, function(item) {
            html += '' +
                '<label class="btn btn-outline-primary btn-block py-1 mt-0 amenities" ' +
                'data-toggle="tooltip" ' +
                'title="' + item.name + '" data-id="' + item.id + '"> ' +
                '<input type="checkbox" autocomplete="off"> ' +
                $('#amenities-icon-' + item.key).html() +
                '</label>' +
                '';
        });

        signUpForm.find('.amenities-list').html(html);
    }, false).request(signUpForm.find('.amenities-list'), false, true);

    $('.business-job-status[data-status="2"]').click(function () {
        if (!$(this).hasClass('active')) {
            if (!$(this).hasClass('active')) {
                new GraphQL("query", "businessesAll", {}, [
                    'id',
                    'name',
                    'picture_50(width:50, height:50)'
                ], true, false, function () {
                    //
                }, function (data) {
                    var html = ''
                    $.map(data, function(item) {
                        html += `
                        <div class="my-3 businesses-item" style="display: flex">
                          <input type="radio" name="business_id" class="form-control align-self-center mr-2" value="`+ item.id +`">
                          <img class="rounded align-self-center mr-2" alt="`+ item.name +`" style="width: 100px; height: 100px;" src="`+ item.picture_50 +`">
                          <p class="mb-0 align-self-center">
                            <strong>`+ item.name +`</strong>
                          </p>
                        </div>
                        `;
                    });
                    $('#create-business__franchise-businesses').html(html);
                    //$('#franchiseConnect').modal('show');
                }, false).request();
            }
        }
    });
    $('#create-business__franchise-search').keyup(function () {
        var key = $(this).val();
        /*if (key.length > 0 ) {
            $('input[name="business_id"]:checked').prop('checked', false);
        }*/
        $('#create-business__franchise-businesses strong').each(function (index, value) {
            if ($(this).text().indexOf(key) == -1) {
                $(this).closest('.businesses-item').hide();
                $(this).closest('.businesses-item').find('input[name="business_id"]:checked').prop('checked', false);
            } else {
                if(!$(this).closest('.businesses-item').is(':visible')) {
                    $(this).closest('.businesses-item').show();
                }
            }
        });
    });
    $('#create-business__franchise-ok').click(function () {
        var businessId = $('input[name="business_id"]:checked').val();
        var params = [];
        if (businessId) {
            params['business_id'] = businessId;
            new GraphQL("mutation", "createAdministratorFranchise", {
                'business_id': businessId,
            }, [
                'token',
            ], true, false, function() {
                Loader.stop();
            }, function(data) {
                //$('#franchiseConnect').modal('hide');
                APIStorage.remove('last-business-id');
                APIStorage.create('business-id', businessId);
                setTimeout(function () {
                    window.location.href = '/business/branch/add';
                }, 300);
            }).request();
        } else {
            $.notify('Select Business ID', 'error');
        }
    });


    $('#create-business').on('click', function () {
        $(document).find("#global-loading").show();
        var geocoder = new google.maps.Geocoder();
        var formData = pictureForm;
        /*if (formData) {
            for (var pair of backgroundForm.entries()) {
                formData.append(pair[0], pair[1]);
            }
        } else {
            formData = backgroundForm;
        }*/

        var typeQuery = 'createBusiness';
        var code = $('#country-phone .bfh-selectbox-option').clone();
        code.find('span').remove();
        // var keywords = $.map(msKeywords.getSelection(), function (item) {
        //     return item.id;
        // }).join(',');
        /*var languages = $.map(msLanguages.getSelection(), function (item) {
            return item.id;
        }).join(',');*/

        //cropBG.sortURLs();
        var images =[];
        var crop_data_images =[];
        let i;
        for (i=0; i<cropBG.originURLs.length; i++) {
            images.push(cropBG.originURLs[i].bg_picture_origin);
            crop_data_images.push(cropBG.originURLs[i].bg_crop_data);
        }

        var logo = '';
        if(typeof logoBusiness != "undefined") {
            logo = logoBusiness;
        }
        var logo_data = $('#avatar-modal input[name="avatar_data"]').val();

        var amenities = [];
        $.each(signUpForm.find('.amenities.active'), function () {
            amenities.push($(this).attr('data-id'));
        });

        var params = {
            "name": FormValidate.getFieldValue('name', signUpForm),
            "name_fr": FormValidate.getFieldValue('name_fr', signUpForm),
            "description": FormValidate.getFieldValue('description', signUpForm),
            "description_fr": FormValidate.getFieldValue('description_fr', signUpForm),
            //"industry_id": +msIndustryValue,
            "industries": msIndustryValue.length > 0 ? msIndustryValue.join() : FormValidate.getFieldValue('industries', signUpForm),
            "industry": FormValidate.getFieldValue('industry', signUpForm),
            //"sub_industry_id": (msSubIndustryValue) ? +msSubIndustryValue : 0,
            "size_id": +signUpForm.find('select[name="size"]').val(),
            "type": FormValidate.getCheckedFieldValue("type", signUpForm) == "0" ? '' : FormValidate.getCheckedFieldValue("type", signUpForm),
            //"street": FormValidate.getFieldValue("street", signUpForm),
            "street": businessStreet,
            "street_number": FormValidate.getFieldValue("street_number", signUpForm),
            "suite": FormValidate.getFieldValue("suite", signUpForm),
            // "keywords": keywords, // NOT DISABLED BUT SEE BELOW
            "latitude": 0,
            "longitude": 0,
            "website": FormValidate.getFieldValue("website", signUpForm),
            "website_fr": FormValidate.getFieldValue("website_fr", signUpForm),
            "city": businessCity,
            "region": businessRegion,
            "country": businessCountry,
            "country_code": businessCountryCode,
            "phone": FormValidate.getFieldValue('phone', signUpForm),
            "phone_code": code.text(),
            "phone_country_code": signUpForm.find('.country').val(),
            "zip_code": FormValidate.getFieldValue('zip_code', signUpForm),
            "language_prefix": FormValidate.getFieldValue('language_prefix', signUpForm),
            "images": images,
            "crop_data_images": crop_data_images,
            'logo': logo,
            'logo_data': logo_data,
            "facebook": FormValidate.getFieldValue('facebook', signUpForm),
            "facebook_fr": FormValidate.getFieldValue('facebook_fr', signUpForm),
            "instagram": FormValidate.getFieldValue('instagram', signUpForm),
            "instagram_fr": FormValidate.getFieldValue('instagram_fr', signUpForm),
            "linkedin": FormValidate.getFieldValue('linkedin', signUpForm),
            "linkedin_fr": FormValidate.getFieldValue('linkedin_fr', signUpForm),
            "twitter": FormValidate.getFieldValue('twitter', signUpForm),
            "twitter_fr": FormValidate.getFieldValue('twitter_fr', signUpForm),
            "youtube": FormValidate.getFieldValue('youtube', signUpForm),
            "youtube_fr": FormValidate.getFieldValue('youtube_fr', signUpForm),
            "snapchat": FormValidate.getFieldValue('snapchat', signUpForm),
            "snapchat_fr": FormValidate.getFieldValue('snapchat_fr', signUpForm),
            // "video": FormValidate.getFieldValue('video', signUpForm),
            // "video_fr": FormValidate.getFieldValue('video_fr', signUpForm),
            "amenities": amenities.join(',')
        };

        // [ 'en', 'fr' ].forEach(function(current_language_prefix) {
        //     var param_name = 'keywords' + (current_language_prefix != 'en' ? '_' + current_language_prefix : '');

        //     var this_ms_keywords_name = '' +
        //         'msKeywords' +
        //         (current_language_prefix != 'en' ? current_language_prefix[0].toUpperCase() + current_language_prefix.slice(1) : '') +
        //     '';

        //     params[param_name] = $.map(window[this_ms_keywords_name].getSelection(), function(item) {
        //         return item.id;
        //     }).join(',');
        // });


        //var brand_business = APIStorage.read('brand-business-id') || 0;
        var brand_business = getUrlParameter('id') || 0;
        if (brand_business) {
            params['parent_id'] = brand_business;
        }

        var location = params['street'] + ' ' + params['street_number'];
        location += "," + businessCity;
        if (businessCountry !== null) {
            location += "," + businessCountry;
        }
        geocoder.geocode({'address': location}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    params['latitude'] = results[0].geometry.location.lat();
                    params['longitude'] = results[0].geometry.location.lng();
                }

            var needParams = ['id', 'token', 'error_message'];
            if (businessId) {
                typeQuery = 'updateBusiness';
                params['id'] = businessId;
                needParams = ['token', 'error_message'];
            }
//console.log(typeQuery, params, needParams);return;
            //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
            new GraphQL("mutation", typeQuery, params, needParams, true, false, function () {
                $(document).find("#global-loading").hide();
            }, function (data) {
                $(document).find("#global-loading").hide();
                if (data.error_message == 'business_exist') {
                    uBis.businessID = data.id;
                    $('#claimUnconfirmedBusiness').modal('show');
                    return;
                }

                if (data.error_message){
                    $('#errorImageAvatar').modal('show');
                    return;
                }
                APIStorage.remove('last-business-id');
                if (brand_business) {
                    //APIStorage.remove('brand-business-id');
                    window.location.href = '/business/brands';
                } else {
                    if (!businessId) {
                        updateQueryStringParam('b_id', data.id);
                    }
                    APIStorage.create('business-id', (businessId) ? businessId : data.id);
                    setTimeout(function () {
                        //window.location.href = '/lets-get-started-business';
                        //window.location.href = '/business/dashboard';
                        window.location.href = '/business/candidate/manage';
                    }, 500);
                }

            }, signUpForm/*, formData*/).request();
        });

    });

    if (user.data.country_code) {
        signUpForm.find('.country').val(user.data.country_code);
        signUpForm.find('.bfh-selectbox-option').html('');
        signUpForm.find('.bfh-selectbox-option').html('<i class="glyphicon bfh-flag-' + user.data.country_code + '"></i>' + BFHCountriesList[user.data.country_code]);
    }

    var locationField = $('#user-location-business');
    var clearLocationField = $('#user-location-clear');
    // locationField.val(location);

    var flag = $('#basic-addon1');
    flag.find('i').removeClassRegex(/^bfh-flag-/);
    flag.find('i').addClass('bfh-flag-' + user.data.country_code);

    //clear location field and focus
    $('body').on('click', '#user-location-clear', function () {
        locationField.val('');
        locationField.focus();
        clearLocationField.parent().addClass('hide');
        locationField.addClass('autocomplete-border');
        businessCity = "";
        businessRegion = "";
        businessCountry = "";
        businessCountryCode = "";
        locationField.parent().find('.glyphicon').attr('class','glyphicon');
        geoFullName = '';
    });
    //autocomplete locations
    locationField.autocomplete({
        source: function (request, response) {
            if (request.term.length === 0) {
                clearLocationField.parent().addClass('hide');
                locationField.addClass('autocomplete-border');
                geoFullName = '';
            } else {
                clearLocationField.parent().removeClass('hide');
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
                    businessCity = "no_geo_data";
                    businessRegion = "";
                    businessCountry = "";
                    businessCountryCode = "";
                    geoFullName = '';
                    locationField.removeClass('ui-autocomplete-loading');
                }
            }).autocomplete();
        },
        select: function (event, ui) {
            businessCity = ui.item.data.city;
            businessRegion = ui.item.data.region;
            businessCountry = ui.item.data.country;
            businessCountryCode = ui.item.id;
            flag.find('i').removeClassRegex(/^bfh-flag-/);
            flag.find('i').addClass('bfh-flag-' + ui.item.id);
            geoFullName = ui.item.data.fullName;
        },
        response: function () {
            locationField.removeClass('ui-autocomplete-loading');
        }
    }).attr('autocomplete', 'disabled').autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
            .append('<span><i class="glyphicon bfh-flag-' + item.id + '"></i> </span><span>' + item.label + '</span>')
            .appendTo(ul);
    };
    locationField.keydown(function () {
        businessCity = "no_geo_data";
        businessRegion = "";
        businessCountry = "";
        businessCountryCode = "";
        geoFullName = '';
        locationField.parent().find('.glyphicon').attr('class','glyphicon');
    });

    //location street
    var $formForLocation = $('#sign-up-business-form'),
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
            $selectStreet.css('top','1024px');
            isVisibleInputStreetCheck = true;
        }
    });
    $inputStreetNumberClear.click(function () {
        $locationStreet.val($locationStreet.val().replace(/[0-9]/g, ''));
        $inputStreetCheck.fadeOut();
        $selectStreet.css('top','984px');
        isVisibleInputStreetCheck = false;
    });
    $inputStreetNumberKeep.click(function () {
        $inputStreetCheck.fadeOut();
        $selectStreet.css('top','984px');
        isVisibleInputStreetCheck = false;
    });
    //clear location street and focus
    $clearLocationStreet.click(function () {
        $locationStreet.val('');
        $locationStreet.focus();
        $clearLocationStreet.parent().addClass('hide');
        $locationStreet.addClass('autocomplete-border');
        businessStreet = "";
    });

    var geocoder = new google.maps.Geocoder();
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
            var params = {
                'key': request.term
            };
            if (geoFullName.length > 1) {
                geocoder.geocode({'address': geoFullName}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        params['latitude'] = results[0].geometry.location.lat();
                        params['longitude'] = results[0].geometry.location.lng();
                    }
                });
            }
            setTimeout(function () {
                new GraphQL("query", "geoStreet", params, [
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
                        businessStreet = "no_geo_data";
                        $locationStreet.removeClass('ui-autocomplete-loading');
                    }
                }).autocomplete();
            },200);

        },
        select: function (event, ui) {
            //businessCity.street = ui.item.data.street;
            if (ui.item.data.description.length > 1) {
                geocoder.geocode({'address': ui.item.data.description}, function (results, status) {

                    if (status == google.maps.GeocoderStatus.OK) {
                        let post_code = results[0].address_components[results[0].address_components.length - 1];
                        if(post_code && post_code.types[0] === "post_code"){
                            signUpForm.find('input[name="zip_code"]').val(post_code.long_name);
                        }

                        //signUpForm.find('input[name="zip_code"]').val(results[0].address_components[results[0].address_components.length - 1].long_name);
                    }
                });
            }
        },
        close: function (event, ui) {
            if ($locationStreet.val().indexOf(',') != -1 ) {
                var street = $locationStreet.val();
                street = street.substr(0,street.indexOf(','));
                $locationStreet.val(street);
                businessStreet = street;
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
        businessStreet = "no_geo_data";
    });

    signUpForm.on('keyup', 'input, textarea', function () {
        FormValidate.fieldValidateClear($(this));
    });
    $('.business-job-status').click(function () {
        FormValidate.fieldValidateClear($('.business-job-status input'));
    });
}

function msInit() {
    !!!1 && getMSList(function (items, defaultData) {
        msKeywords = msKeywordsElement.magicSuggest({
            placeholder: Langs.type_keywords,
            toggleOnClick: false,
            allowFreeEntries: true,
            data: [],
            hideTrigger: true,
            noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found_add,

            cls: [
                'jack',
                'input_style',
                'multilanguage',
                'multilanguage-' + current_language_prefix,
            ].concat(current_language_prefix != 'en' ? [ 'd-none' ] : []).join(' '),
        });
        if (defaultData) {
            msKeywords.setSelection(defaultData);
        }
        var timeout = null;
        $(msKeywords).on('keyup', function () {
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                getMSList(function (items) {
                    msKeywords.setData(items);
                }, 'keywords', msKeywordsElement, msKeywords.getRawValue());
            }, 500);
        });
    }, 'keywords', msKeywordsElement, undefined, businessKeywords);

    /*getMSList(function (items, defaultData) {
        msLanguages = msLanguagesElement.magicSuggest({
            placeholder: Langs.type_language_name,
            toggleOnClick: true,
            allowFreeEntries: false,
            data: items,
            hideTrigger: true,
            noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
            cls: 'jack input_style'
        });
        if (defaultData) {
            msLanguages.setValue(defaultData);
        }
        var timeout = null;
        $(msLanguages).on('keyup', function () {
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                getMSList(function (items) {
                    msLanguages.setData(items);
                }, 'languages', msLanguagesElement, msLanguages.getRawValue());
            }, 500);
        });
    }, 'languages', msLanguagesElement, undefined, businessLanguages);*/
}

var getMSList = function (callback, method, el, keywords, defaultData) {
    var params = {};
    var need = ['items{id name name_fr localized_name}'];

    if (method == 'keywords') {
        if ($(el).attr('data-language-prefix')) {
            params.language_prefix = $(el).attr('data-language-prefix');
        }

        need = [ 'items{id, name}' ];
    }
    else if (method === 'languages') {
        params.no_id = parseInt(this.no_id_lang);
        need = ['id name name_fr localized_name'];
    }

    // if (defaultData) {
    //     params['default'] = defaultData;
    //     need.push('default{id name}')
    // }

    if ((!keywords || keywords.length === 0) && method === 'keywords') {
        callback([], defaultData);
    }
    else {
        new GraphQL("query", method, params, need, false, false, function (data) {
            //show error
        }, function (data) {
            if (data) {
                var items = $.map((method === 'languages') ? data : data.items, function (item) {
                    return {
                        id:         item.id,
                        name:       item.localized_name || item.name,
                        name_en:    item.name,
                        name_fr:    item.name_fr,
                    };
                });

                callback(items, defaultData);
            }
        }).request(el);
    }
};

/*function getIndustry(sub, val, subVal) {
    if (sub) {
        $('#sub_industry_id').parent().removeClass('hide');
        msIndustryValue = val;
    }
    if (subVal) {
        msSubIndustryValue = subVal;
    }
    var select = (sub) ? $('#sub_industry_id') : $('#industry_id');
    var params = (sub) ? {parent_id: sub} : {};

    new GraphQL("query", "industries", params, [
        'id',
        'name',
        'name_fr',
        'localized_name',
    ], false, false, function () {
        //
    }, function (data) {
        // var html = '';
        if (data) {
            data.forEach(function(item) {
                item.name_en = item.name;
                item.name_fr = item.name_fr;
                item.name = item.localized_name || item.name;
            });

            if (!sub) {
                if (msIndustry) {
                    msIndustry.setData(data);
                }
                else {
                    msIndustry = select.magicSuggest({
                        placeholder: Langs.choose_industry,
                        toggleOnClick: true,
                        allowFreeEntries: false,
                        data: data,
                        required: true,
                        maxSelection: 1,
                        maxSelectionRenderer: function () {
                            return trans('jack_max_1');
                        },
                        hideTrigger: true,
                        noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                        cls: 'jack input_style industries_box field-box'
                    });
                }
                if (val) {
                    msIndustry.setValue([val]);
                    if (subVal) {
                        getIndustry(val, val, subVal);
                    }
                }
            }
            else {
                if (msSubIndustry) {
                    msSubIndustry.setData && msSubIndustry.setData(data);
                }
                else {
                    msSubIndustry = select.magicSuggest({
                        placeholder: Langs.choose_sub_industry,
                        toggleOnClick: true,
                        allowFreeEntries: false,
                        data: data,
                        maxSelection: 1,
                        maxSelectionRenderer: function () {
                            return trans('jack_max_1');
                        },
                        hideTrigger: true,
                        noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                        cls: 'jack input_style industries_box field-box'
                    });

                    if (subVal) {
                        msSubIndustry.setValue && msSubIndustry.setValue([subVal]);
                    }
                }
            }
            var a = msIndustry;

            if (sub) {
                a = msSubIndustry;
            }

            $(a).unbind('selectionchange');

            $(a).on('selectionchange', function () {
                FormValidate.fieldValidateClear('#industry_id');
                if (!sub) {
                    if (this.getValue().length !== 0) {
                        var id = this.getValue();//[0];
                        msIndustryValue = id;
                        msSubIndustryValue = 0;

                        if (msSubIndustry && msSubIndustry.clear) {
                            msSubIndustry.clear();
                        }

                        getIndustry(id, id, null);
                    }
                    else {
                        if (msSubIndustry && msSubIndustry.clear) {
                            msSubIndustry.clear();
                        }

                        msIndustryValue = null;
                        msSubIndustryValue = null;
                    }
                } else {
                    var id = this.getValue()[0];
                    msSubIndustryValue = id;
                }
            });
            Loader.contentLoader = true;
            Loader.loaderToElement = select;
        }
    }).request(select, false, false);
}*/
function getIndustry(val) {

    var select = $('#industry_id');
    var params = {};

    new GraphQL("query", "industries", params, [
        'id',
        'name',
        'name_fr',
        'localized_name',
    ], false, false, function () {
        //
    }, function (data) {
        // var html = '';
        if (data) {
            data.forEach(function(item) {
                item.name_en = item.name;
                item.name_fr = item.name_fr;
                item.name = item.localized_name || item.name;
            });

            if (msIndustry) {
                msIndustry.setData(data);
            }
            else {
                msIndustry = select.magicSuggest({
                    placeholder: Langs.choose_industry,
                    toggleOnClick: true,
                    allowFreeEntries: false,
                    data: data,
                    required: true,
                    maxSelection: 100,
                    maxSelectionRenderer: function () {
                        return trans('jack_max_1');
                    },
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                    cls: 'jack input_style industries_box field-box'
                });
            }
            if (val) {
                msIndustry.setValue(val);
            }
            $('#industry_id input').addClass('form-control').attr('name','industries');

            var a = msIndustry;
            $(a).unbind('selectionchange');
            $(a).on('selectionchange', function () {
                FormValidate.fieldValidateClear('#industry_id');
                if (this.getValue().length !== 0) {
                    var id = this.getValue();//[0];
                    msIndustryValue = id;
                    //getIndustry(id);
                }
                else {
                    msIndustryValue = [];
                }
            });
            Loader.contentLoader = true;
            Loader.loaderToElement = select;
        }
    }).request(select, false, false);
}

function getLanguage(callback, val, signUpForm) {
    new GraphQL("query", "languages", {}, [
        'id',
        'name'
    ], false, false, function () {
        //
    }, function (data) {
        var html = '';
        $.map(data, function (item) {
            let textDefault = '';
            if (item.id == 1) {
                textDefault = ' (Default)';
            }
            html += '<option value="' + item.id + '">' + item.name + textDefault + '</option>';
        });
        signUpForm.find('select[name="language"]').html(html);
        if (callback) {
            callback(val, signUpForm);
        }
        Loader.contentLoader = true;
        Loader.loaderToElement = signUpForm.find('select[name="language"]');
    }).request(signUpForm.find('select[name="language"]'), false, true);
}

function getLanguages(callback, val, signUpForm) {
    var _this = this;

    new GraphQL("query", "languages", {}, [
        'id',
        'name',
        'prefix',
    ], false, false, function () {
        //
    }, function(languages) {
        var html = '';
        var selectedOption = '';

        var langDefaultPrefix = signUpForm.find('select[name="language_prefix"]').data('default-prefix');

        $.map(languages, function(language) {
            html += '<option value="' + language.prefix + '" '+selectedOption+'>';
            html += language.name;
            html += '</option>';
        });

        signUpForm.find('select[name="current_language_prefix"]').html(html);
        signUpForm.find('select[name="language_prefix"]').html(html);

        signUpForm.find('select[name="current_language_prefix"]').each(function() {
            var default_language = _this.currentData && _this.currentData.language ? _this.currentData.language.prefix : 'en';

            $(this).children('option[value="' + default_language + '"]').each(function() {
                $(this).text($(this).text() + ' (Default)');
            });
        });

        if (callback) {
            callback(val, signUpForm);
        }

        $('select[name="language_prefix"]').val(langDefaultPrefix).change();

        // Loader.contentLoader = false;
        // Loader.loaderToElement = signUpForm.find('select[name="language"]');
    }).request(signUpForm.find('select[name="language_prefix"]'), false, false);
}

function getSizes(callback, val, signUpForm) {
    new GraphQL("query", "sizes", {}, [
        'id',
        'name'
    ], false, false, function () {
        //
    }, function (data) {
        var html = '';
        $.map(data, function (item) {
            html += '<option value="' + item.id + '">' + item.name + '</option>';
        });
        signUpForm.find('select[name="size"]').html(html);
        if (callback) {
            callback(val, signUpForm);
        }
        Loader.contentLoader = true;
        Loader.loaderToElement = signUpForm.find('select[name="size"]');
    }).request(signUpForm.find('select[name="size"]'), false, true);
}

$(document).ready(function () {
    loadPromise.then(function () {
        app.addToPromise(BusinessSignUp);
    }).then(function () {
        app.runPromise();
    });
});
