var pictureForm =false;
var backgroundForm =false;

var cropBG;

function Business() {
    this.data;
    this.currentID;
    this.currentData;

    this.currentDataBrand = false;

    this.notLoadWhenUrl = ['signup', 'business/view'];

    this.updateForm = $('#business-profile-form');
    this.city;
    this.region;
    this.country;
    this.countryCode;

    this.geoFullName;

    this.msIndustry;
    this.msSubIndustry;

    this.msIndustryValue = [];
    this.msSubIndustryValue = null;

    // this.msKeywords;
    // this.msKeywordsElement = $('#keywords');
    // this.msKeywordsFr;
    // this.msKeywordsFrElement = $('#keywords-fr');

    this.msLanguages;
    this.msLanguagesElement = $('#languages');
    this.no_id_lang = 1;

    this.htmlGalka = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 448.8 448.8" style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px;" xml:space="preserve">
                          <g>
                              <g id="check">
                                  <polygon points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"></polygon>
                              </g>
                          </g>
                      </svg>`;
}

Business.prototype = {
    init: function (done) {
        Loader.init();
        var _this = this;
        _this.importEmail();
        _this.getUserPaid();
        return new Promise(function (resolve, reject) {
            if (_this.checkLoadUrl()) {
                resolve();
            }
        }).then(function () {
            return _this.get(done);
        }).then(function () {
            return _this.profileInit();

        });

    },
    checkLoadUrl: function () {
        var _this = this;
        var url = window.location.href;
        var valid = true;
        $.map(_this.notLoadWhenUrl, function (item) {
            if (url.search(item) !== -1) {
                valid = false;
            }
        });

        return valid;
    },
    profileInit: function () {
        var _this = this;

        var promise = new Promise(function (resolve, reject) {
            var url = document.location.pathname;
            var urlData = explode('/business/profile/', url);
            _this.currentID = APIStorage.read('business-id');
            if (urlData[1]) {
                if (urlData[1] === 'edit') {
                    resolve(1);
                }
            } else {
                resolve(2);
            }
        });

        promise.then(function (value) {
            if (value === 1) {
                _this.profile();
                _this.getCurrentData();
            } else {
                // setTimeout(function () {
                return _this.getCurrentData();
                // }, 0);
            }
        });

        return promise;
    },
    profile: function () {
        var _this = this;
        var locationField = this.updateForm.find('#user-location');
        var clearLocationField = this.updateForm.find('#user-location-clear');

        //clear location field and focus
        $('body').on('click', '#user-location-clear', function () {
            locationField.val('');
            locationField.focus();
            clearLocationField.parent().addClass('hide');
            locationField.addClass('autocomplete-border');
            _this.city = "";
            _this.region = "";
            _this.country = "";
            _this.countryCode = "";
            _this.geoFullName = '';
            locationField.parent().find('.glyphicon').attr('class','glyphicon');
        });
        //autocomplete locations
        locationField.autocomplete({
            source: function (request, response) {
                if (request.term.length === 0) {
                    clearLocationField.parent().addClass('hide');
                    locationField.addClass('autocomplete-border');
                    this.geoFullName = '';
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
                        _this.city = "no_geo_data";
                        _this.region = "";
                        _this.country = "";
                        _this.countryCode = "";
                        _this.geoFullName = '';
                        locationField.removeClass('ui-autocomplete-loading');
                    }
                }).autocomplete();
            },
            select: function (event, ui) {
                _this.city = ui.item.data.city;
                _this.region = ui.item.data.region;
                _this.country = ui.item.data.country;
                _this.countryCode = ui.item.id;
                var flag = _this.updateForm.find('#basic-addon1');
                flag.find('i').removeClassRegex(/^bfh-flag-/);
                flag.find('i').addClass('bfh-flag-' + ui.item.id);
                _this.geoFullName = ui.item.data.fullName;
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
            _this.city = "no_geo_data";
            _this.region = "";
            _this.country = "";
            _this.countryCode = "";
            _this.geoFullName = '';
            locationField.parent().find('.glyphicon').attr('class','glyphicon');
        });

        //location street
        var $formForLocation = $('#business-profile-form'),
            $locationStreet = $formForLocation.find('#business-location-street'),
            $clearLocationStreet = $formForLocation.find('#location-street-clear'),
            $inputStreetCheck = $formForLocation.find('#input-street-check'),
            $selectStreet = $('#ui-id-3'),
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
        $clearLocationStreet.click(function () {
            $locationStreet.val('');
            $locationStreet.focus();
            $clearLocationStreet.parent().addClass('hide');
            $locationStreet.addClass('autocomplete-border');
            _this.street = "";
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
                if (_this.geoFullName.length > 1) {
                    geocoder.geocode({'address': _this.geoFullName}, function (results, status) {
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
                            _this.street = "no_geo_data";
                            $locationStreet.removeClass('ui-autocomplete-loading');
                        }
                    }).autocomplete();
                },200);
            },
            select: function (event, ui) {
                //_this.street = ui.item.data.street;
                if (ui.item.data.description.length > 1) {
                    geocoder.geocode({'address': ui.item.data.description}, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            _this.updateForm.find('input[name="zip_code"]').val(results[0].address_components[results[0].address_components.length - 1].long_name);
                        }
                    });
                }
            },
            close: function (event, ui) {
                if ($locationStreet.val().indexOf(',') != -1) {
                    var street = $locationStreet.val();
                    street = street.substr(0, street.indexOf(','));
                    $locationStreet.val(street);
                    _this.street = street;
                }
            },
            response: function (e, u) {
                $locationStreet.removeClass('ui-autocomplete-loading');
            }
        }).attr('autocomplete', 'disabled');

        $locationStreet.keydown(function () {
            _this.street = "no_geo_data";
        });

        this.updateForm.on('keyup', 'input, textarea', function () {
            FormValidate.fieldValidateClear($(this));
        });

        this.updateForm.on('click', '#business-profile-update', function () {
            _this.update();
        });
    },
    getMSList: function (callback, method, el, keywords, defaultData) {
        var params = {};
        var need = ['items{id name name_fr localized_name}'];

        if (method == 'keywords') {
            // if ($(el).attr('data-language-prefix')) {
            //     params.language_prefix = $(el).attr('data-language-prefix');
            // }

            // need = ['items{id name}'];
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
        } else {
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
    },
    profileSet: function (currentDataProfile) {
        var _this = this;
        currentDataProfile = currentDataProfile || _this.currentData;
        //init cropper
        new CropAvatar('business-pic-view', 'business-pic-change-btn', false, false, false, false, currentDataProfile.picture_o);
        //new CropBusinessBG('business_background', 'business-bg-change-btn', false, false, false, false, currentDataProfile.bg_picture);
        cropBG = new CropBusinessBG('business_background', 'business-bg-change-btn', false, false, false, false, currentDataProfile.images);
        var locationField = this.updateForm.find('#user-location');
        this.updateForm.find('input[name="name_en"]').val(currentDataProfile.name);
        this.updateForm.find('input[name="name_fr"]').val(currentDataProfile.name_fr);
        this.updateForm.find('input[name="type"][value="' + currentDataProfile.type_value + '"]').prop('checked', 'checked').parent().addClass('active');
        this.updateForm.find('textarea[name="description_en"]').val(currentDataProfile.description);
        this.updateForm.find('textarea[name="description_fr"]').val(currentDataProfile.description_fr);
        this.updateForm.find('input[name="website"]').val(currentDataProfile.website);
        this.updateForm.find('input[name="website_fr"]').val(currentDataProfile.website_fr);
        // this.updateForm.find('input[name="direct_link"]').val(currentDataProfile.direct_link);
        // this.updateForm.find('input[name="direct_link_fr"]').val(currentDataProfile.direct_link_fr);
        this.updateForm.find('input[name="street"]').val(currentDataProfile.street);
        this.updateForm.find('input[name="street_number"]').val(currentDataProfile.street_number);
        this.updateForm.find('input[name="suite"]').val(currentDataProfile.suite);

        this.updateForm.find('input[name="industry"]').val(currentDataProfile.industry);

        this.getSizes(function (data, updateForm) {
            updateForm.find('select[name="size"]').val(data);
        }, currentDataProfile.size_id, _this.updateForm);

        this.getLanguages(function(data, updateForm) {
            updateForm.find('select[name="language_prefix"]').val(data);
            //updateForm.find('select[name="current_language_prefix"]').val(data);
        }, (currentDataProfile.language ? currentDataProfile.language.prefix : 'en'), _this.updateForm);

        this.getIndustry(currentDataProfile.assign_industries.split(','));
        /*if (currentDataProfile.industry) {
            this.updateForm.find("#citypicker").hide();
            this.updateForm.find("#picked_city_block").show();
            this.updateForm.find(".city_location_new").val(currentDataProfile.industry).attr('data-id', currentDataProfile.industry_id);
        }*/
        if (currentDataProfile.picture) {
            this.updateForm.find('.business-pic-view img').attr('src', currentDataProfile.picture);
        }
        /*if (currentDataProfile.bg_picture) {
            this.updateForm.find('.business_background img').attr('src', currentDataProfile.bg_picture);
        }*/
        if (currentDataProfile.images.length > 0) {
            var first = true;
            currentDataProfile.images.forEach(function (item) {
                let htmlBlock = '<div class="carousel-item ';
                if (first) {
                    htmlBlock += 'active';
                }
                htmlBlock += '" data-id="' + item.id + '"><img class="d-block w-100" src="' + item.bg_picture + '" alt="' + currentDataProfile.name + '"></div>';
                first = false;
                _this.updateForm.find('.business_background .carousel-inner').append(htmlBlock);
                //_this.updateForm.find('.business_background img').attr('src', item.bg_picture).attr('data-id',item.id);
            });
        } else {
            let htmlBlock = '<div class="carousel-item active" data-id="0"><img class="d-block w-100" src="/img/bg-white-cr.png" alt="' + currentDataProfile.name + '"></div>';
            _this.updateForm.find('.business_background .carousel-inner').append(htmlBlock);
        }
        if (currentDataProfile.phone) {
            this.updateForm.find('input[name="phone"]').val(currentDataProfile.phone);
        }
        if (currentDataProfile.phone_country_code) {
            this.updateForm.find('.country').val(currentDataProfile.phone_country_code);
            this.updateForm.find('.bfh-selectbox-option').html('');
            this.updateForm.find('.bfh-selectbox-option').html('<i class="glyphicon bfh-flag-' + currentDataProfile.phone_country_code + '"></i>' + BFHCountriesList[currentDataProfile.phone_country_code]);
        }
        if (currentDataProfile.zip_code) {
            this.updateForm.find('input[name="zip_code"]').val(currentDataProfile.zip_code);
        }
        if (currentDataProfile.facebook) {
            this.updateForm.find('input[name="facebook"]').val(currentDataProfile.facebook);
        }
        // if (currentDataProfile.facebook_fr) {
        //     this.updateForm.find('input[name="facebook_fr"]').val(currentDataProfile.facebook_fr);
        // }
        if (currentDataProfile.instagram) {
            this.updateForm.find('input[name="instagram"]').val(currentDataProfile.instagram);
        }
        // if (currentDataProfile.instagram_fr) {
        //     this.updateForm.find('input[name="instagram_fr"]').val(currentDataProfile.instagram_fr);
        // }
        if (currentDataProfile.linkedin) {
            this.updateForm.find('input[name="linkedin"]').val(currentDataProfile.linkedin);
        }
        // if (currentDataProfile.linkedin_fr) {
        //     this.updateForm.find('input[name="linkedin_fr"]').val(currentDataProfile.linkedin_fr);
        // }
        if (currentDataProfile.twitter) {
            this.updateForm.find('input[name="twitter"]').val(currentDataProfile.twitter);
        }
        // if (currentDataProfile.twitter_fr) {
        //     this.updateForm.find('input[name="twitter_fr"]').val(currentDataProfile.twitter_fr);
        // }
        if (currentDataProfile.youtube) {
            this.updateForm.find('input[name="youtube"]').val(currentDataProfile.youtube);
        }
        // if (currentDataProfile.youtube_fr) {
        //     this.updateForm.find('input[name="youtube_fr"]').val(currentDataProfile.youtube_fr);
        // }
        if (currentDataProfile.snapchat) {
            this.updateForm.find('input[name="snapchat"]').val(currentDataProfile.snapchat);
        }
        // if (currentDataProfile.snapchat_fr) {
        //     this.updateForm.find('input[name="snapchat_fr"]').val(currentDataProfile.snapchat_fr);
        // }
        // if (currentDataProfile.video) {
        //     this.updateForm.find('input[name="video"]').val(currentDataProfile.video);
        // }
        // if (currentDataProfile.video_fr) {
        //     this.updateForm.find('input[name="video_fr"]').val(currentDataProfile.video_fr);
        // }

        this.city = currentDataProfile.city;
        this.region = currentDataProfile.region;
        this.country = currentDataProfile.country;
        this.countryCode = currentDataProfile.country_code;

        this.street = currentDataProfile.street;
        this.street_number = currentDataProfile.street_number;

        var flag = this.updateForm.find('#basic-addon1');
        flag.find('i').removeClassRegex(/^bfh-flag-/);
        flag.find('i').addClass('bfh-flag-' + this.countryCode);
        var location = this.city;

        if (this.region !== null) {
            location += "," + this.region;
        }

        if (this.country !== null) {
            location += "," + this.country;
        }
        _this.geoFullName = location;
        locationField.val(location);
        $('#business-signup-preview-career').attr('href', '/business/view/' + currentDataProfile.id + '/' + currentDataProfile.slug);

        // multilanguage keywords

        [ 'en', 'fr' ].forEach(function(current_language_prefix) {
            var capitalized_current_language_prefix = current_language_prefix[0].toUpperCase() + current_language_prefix.slice(1);
            var language_injection = '';

            if (current_language_prefix != 'en') {
                 language_injection = capitalized_current_language_prefix;
            }

            // _this.getMSList(
            //     function(items, defaultData) {
            //         _this['msKeywords' + language_injection] = _this['msKeywords' + language_injection + 'Element'].magicSuggest({
            //             placeholder: Langs.type_keywords,
            //             toggleOnClick: false,
            //             allowFreeEntries: true,
            //             data: items,
            //             hideTrigger: true,
            //             noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found_add,

            //             cls: [
            //                 'jack',
            //                 'input_style',
            //                 'multilanguage',
            //                 'multilanguage-' + current_language_prefix,
            //             ].concat(current_language_prefix != 'en' ? [ 'd-none' ] : []).join(' '),
            //         });

            //         if (defaultData) {
            //             _this['msKeywords' + language_injection].setSelection(defaultData);
            //         }

            //         var timeout = null;

            //         $(_this['msKeywords' + language_injection]).on('keyup', function() {
            //             clearTimeout(timeout);

            //             timeout = setTimeout(function() {
            //                 _this.getMSList(
            //                     function(items) {
            //                         _this['msKeywords' + language_injection].setData(items);
            //                     },

            //                     'keywords',
            //                     _this['msKeywords' + language_injection + 'Element'],
            //                     _this['msKeywords' + language_injection].getRawValue()
            //                 );
            //             }, 500);
            //         });
            //     },

            //     'keywords',
            //     _this['msKeywords' + language_injection + 'Element'],
            //     undefined,
            //     currentDataProfile['keywords' + (current_language_prefix != 'en' ? '_' + current_language_prefix : '')]
            // );
        });

        // this.no_id_lang = this.currentData.language;

        /*this.getMSList(function (items, defaultData) {
            _this.msLanguages = _this.msLanguagesElement.magicSuggest({
                placeholder: Langs.type_language,
                toggleOnClick: true,
                allowFreeEntries: false,
                data: items,
                hideTrigger: true,
                noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                cls: 'jack input_style'
            });
            if (defaultData && defaultData != "") {
                _this.msLanguages.setValue(defaultData);
            }
            var timeout = null;
            $(_this.msLanguages).on('keyup', function () {
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    _this.getMSList(function (items) {
                        _this.msLanguages.setData(items);
                    }, 'languages', _this.msLanguagesElement, _this.msLanguages.getRawValue());
                }, 500);
            });
        }, 'languages', _this.msLanguagesElement, undefined, _this.currentData.languages.split(","));

        $('select[name="language"]').change(function () {
            _this.no_id_lang = $(this).val();
            _this.msLanguages.clear();
            _this.getMSList(function (items) {
                _this.msLanguages.setData(items);
            }, 'languages', _this.msLanguagesElement, _this.msLanguages.getRawValue());
        });*/

        // $('select[name="current_language_prefix"]').each(function() {
        //     alert($(this).children('option[value="' + (_this.currentData.language ? _this.currentData.language.prefix : 'en') + '"]').length);
        //     alert($(this).html());

        //     $(this).children('option[value="' + (_this.currentData.language ? _this.currentData.language.prefix : 'en') + '"]').each(function() {
        //         $(this).text($(this).text() + ' (Default)');
        //         alert('1');
        //         alert(_this.currentData.language ? _this.currentData.language.prefix : 'en');
        //     });
        // });

        // $('select[name="current_language_prefix"]').change(function() {
        //     var current_language_prefix = $(this).val();
        //     _this.updateForm.find('.multilanguage').addClass('d-none');
        //     _this.updateForm.find('.multilanguage-' + $(this).val()).removeClass('d-none');
        //
        //     _this.updateForm.find('.multilanguage').siblings('label').each(function() {
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
        //         if (!_this[current_jack_name] || !_this[current_jack_name].getSelection) {
        //             return;
        //         }
        //
        //         _this[current_jack_name].setData(_this[current_jack_name].getData().map(function(item) {
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
        //         _this[current_jack_name].setSelection(_this[current_jack_name].getSelection().map(function(item) {
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

            $('select[name="current_language_prefix"]').children('option').each(function() {
                $(this).text($(this).text().replace(/\s+\(Default\)$/, ''));
            });

            $('select[name="current_language_prefix"]').children('option[value="' + default_language + '"]').each(function() {
                $(this).text($(this).text() + ' (Default)');
            });
        });

        // _this.updateForm.find('.multilanguage').addClass('d-none');
        // _this.updateForm.find('.multilanguage-' + (currentDataProfile.language ? currentDataProfile.language.prefix : 'en')).removeClass('d-none');
        //
        // _this.updateForm.find('.multilanguage').siblings('label').each(function() {
        //     $(this).html($(this).html() + ' (' + (currentDataProfile.language ? currentDataProfile.language.prefix : 'en') + ')');
        // });
    },
    getSizes: function (callback, val, signUpForm) {
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
            // Loader.contentLoader = true;
            // Loader.loaderToElement = signUpForm.find('select[name="size"]');
            // }, false).request(signUpForm.find('select[name="size"]'), false, false);
        }, false).request();
    },
    getLanguages: function (callback, val, signUpForm) {
        var _this = this;

        new GraphQL("query", "languages", {}, [
            'id',
            'name',
            'prefix',
        ], false, false, function () {
            //
        }, function(languages) {
            var html = '';

            $.map(languages, function(language) {
                html += '<option value="' + language.prefix + '">';
                html += language.name;
                html += '</option>';
            });

            signUpForm.find('select[name="current_language_prefix"]').html(html);
            signUpForm.find('select[name="language_prefix"]').html(html);

            signUpForm.find('select[name="current_language_prefix"]').each(function() {
                var default_language = _this.currentData && _this.currentData.language ? _this.currentData.language.prefix : 'en';
                if (_this.currentDataBrand) {
                    default_language = _this.currentDataBrand && _this.currentDataBrand.language ? _this.currentDataBrand.language.prefix : 'en';
                }

                $(this).children('option[value="' + default_language + '"]').each(function() {
                    $(this).text($(this).text() + ' (Default)');
                });
            });

            if (callback) {
                callback(val, signUpForm);
            }

            // Loader.contentLoader = false;
            // Loader.loaderToElement = signUpForm.find('select[name="language"]');
        }).request(signUpForm.find('select[name="language_prefix"]'), false, false);
    },
    /*getIndustry: function (sub, val, subVal) {
        var _this = this;
        if (sub) {
            $('#sub_industry_id').parent().removeClass('hide');
            _this.msIndustryValue = val;
        }
        if (subVal) {
            _this.msSubIndustryValue = subVal;
        }
        var select = (sub) ? $('#sub_industry_id') : $('#industry_id');
        var params = (sub) ? {parent_id: sub+''} : {};
        new GraphQL("query", "industries", params, [
            'id',
            'name',
            'name_fr',
            'localized_name',
        ], false, false, function () {
            //
        }, function (data) {
            if (data) {
                data.forEach(function(item) {
                    item.name_en = item.name;
                    item.name_fr = item.name_fr;
                    item.name = item.localized_name || item.name;
                });
                if (!sub) {
                    if (_this.msIndustry) {
                        _this.msIndustry.setData(data);
                    } else {
                        _this.msIndustry = select.magicSuggest({
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
                        _this.msIndustry.setValue([val]);
                        // if(subVal){
                        //_this.getIndustry(val, val, subVal);
                        // }
                    }
                } /!*else {
                    if (_this.msSubIndustry) {
                        _this.msSubIndustry.setData(data);
                    } else {
                        _this.msSubIndustry = select.magicSuggest({
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
                            _this.msSubIndustry.setValue([subVal]);
                        }
                    }
                }*!/
                var a = _this.msIndustry;
                if (sub) {
                    //a = _this.msSubIndustry;
                }
                $(a).unbind('selectionchange');
                $(a).on('selectionchange', function () {
                    FormValidate.fieldValidateClear('#industry_id');

                    if (!sub) {
                        if (this.getValue().length !== 0) {
                            var id = this.getValue()[0];
                            _this.msIndustryValue = id;

                            /!*_this.msSubIndustryValue = null;
                            if (_this.msSubIndustry) {
                                _this.msSubIndustry.clear();
                            }
                            _this.getIndustry(id, id, null);*!/
                        } else {
                            _this.msIndustryValue = null;
                            /!*_this.msSubIndustry.clear();
                            _this.msSubIndustryValue = null;*!/
                        }
                    } else {
                        /!*var id = this.getValue()[0];
                        _this.msSubIndustryValue = id;*!/
                    }
                });
                Loader.contentLoader = true;
                Loader.loaderToElement = select;
            }
        }).request(select, false, false);
    },*/
    getIndustry: function (val) {
        var _this = this;
        _this.msIndustryValue = val;
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
            if (data) {
                data.forEach(function(item) {
                    item.name_en = item.name;
                    item.name_fr = item.name_fr;
                    item.name = item.localized_name || item.name;
                });

                if (_this.msIndustry) {
                    _this.msIndustry.setData(data);
                } else {
                    _this.msIndustry = select.magicSuggest({
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
                    _this.msIndustry.setValue(val);
                }

                var a = _this.msIndustry;
                $(a).unbind('selectionchange');
                $(a).on('selectionchange', function () {
                    FormValidate.fieldValidateClear('#industry_id');
                    if (this.getValue().length !== 0) {
                        var id = this.getValue();//[0];
                        _this.msIndustryValue = id;
                    } else {
                        _this.msIndustryValue = [];
                    }
                });
                Loader.contentLoader = true;
                Loader.loaderToElement = select;
            }
        }).request(select, false, false);
    },
    fillCurrentData: function (name, picture) {
        //fill
        $('.menu-business-name').text(name);
        $('.menu-business-picture').attr('src', picture);
        $('.business-logo-modal').attr('src', picture);
    },
    fillData: function () {
        if (this.data.length !== 0) {
            //$('.show-no-businesses').hide();
            var id = 0;
            $.map(this.data, function (item) {
                var html = '<li class="my-2">\n' +
                    '    <a href="javascript:void(0)" class="profile-switcher switch-to-business" data-business="' + item.id + '" style="color: #4E5C6E;">\n' +
                    '        <div class="business-list-icon">\n' +
                    '            <img class="business-image mr-2" src="' + item.picture_50 + '">\n' +
                    '        </div> ' + item.name + '</a>\n' +
                    '</li>';
                $('.business-list').prepend(html);
                id++;
            });
            $('#business-switcher').attr('data-business', this.data[id - 1].id);
        }
        Loader.contentLoader = false;
    },
    update: function () {
        var _this = this;
        var geocoder = new google.maps.Geocoder();
        /*var formData = pictureForm;
        if (formData) {
            for (var pair of backgroundForm.entries()) {
                formData.append(pair[0], pair[1]);
            }
        } else {
            formData = backgroundForm;
        }*/
        var typeQuery = 'updateBusiness';
        var code = $('#country-phone .bfh-selectbox-option').clone();
        code.find('span').remove();

        /*var languages = $.map(this.msLanguages.getSelection(), function (item) {
            return item.id;
        }).join(',');*/

        var params = {
            "id": _this.currentID,
            "name": FormValidate.getFieldValue('name_en', _this.updateForm),
            "name_fr": FormValidate.getFieldValue('name_fr', _this.updateForm),
            "description": FormValidate.getFieldValue('description_en', _this.updateForm),
            "description_fr": FormValidate.getFieldValue('description_fr', _this.updateForm),
            //"industry_id": +_this.msIndustryValue,
            "industries": _this.msIndustryValue.length > 0 ? _this.msIndustryValue.join() : FormValidate.getFieldValue('industries', _this.updateForm),
            //"sub_industry_id": (_this.msSubIndustryValue) ? +_this.msSubIndustryValue : 0,
            "industry": FormValidate.getFieldValue('industry', _this.updateForm),
            "size_id": +FormValidate.getFieldValue("size", _this.updateForm),
            "type": FormValidate.getCheckedFieldValue("type", _this.updateForm),
            //"street": FormValidate.getFieldValue("street", _this.updateForm),
            "street": _this.street,
            "street_number": FormValidate.getFieldValue("street_number", _this.updateForm),
            "suite": FormValidate.getFieldValue("suite", _this.updateForm),
            "latitude": 0,
            // "keywords": keywords, // NOT DISABLED BUT SEE BELOW
            "language_prefix": FormValidate.getFieldValue("language_prefix", _this.updateForm),
            //"languages": languages,
            "longitude": 0,
            "website": FormValidate.getFieldValue("website", _this.updateForm),
            "website_fr": FormValidate.getFieldValue("website_fr", _this.updateForm),
            // "direct_link": FormValidate.getFieldValue("direct_link", _this.updateForm),
            // "direct_link_fr": FormValidate.getFieldValue("direct_link_fr", _this.updateForm),
            "city": _this.city,
            "region": _this.region,
            "country": _this.country,
            "country_code": _this.countryCode,
            "phone": FormValidate.getFieldValue('phone', _this.updateForm),
            "phone_code": code.text(),
            "phone_country_code": _this.updateForm.find('.country').val(),
            "zip_code": FormValidate.getFieldValue('zip_code', _this.updateForm),
            "facebook": FormValidate.getFieldValue('facebook', _this.updateForm),
            "facebook_fr": FormValidate.getFieldValue('facebook_fr', _this.updateForm),
            "instagram": FormValidate.getFieldValue('instagram', _this.updateForm),
            "instagram_fr": FormValidate.getFieldValue('instagram_fr', _this.updateForm),
            "linkedin": FormValidate.getFieldValue('linkedin', _this.updateForm),
            "linkedin_fr": FormValidate.getFieldValue('linkedin_fr', _this.updateForm),
            "twitter": FormValidate.getFieldValue('twitter', _this.updateForm),
            "twitter_fr": FormValidate.getFieldValue('twitter_fr', _this.updateForm),
            "youtube": FormValidate.getFieldValue('youtube', _this.updateForm),
            "youtube_fr": FormValidate.getFieldValue('youtube_fr', _this.updateForm),
            "snapchat": FormValidate.getFieldValue('snapchat', _this.updateForm),
            "snapchat_fr": FormValidate.getFieldValue('snapchat_fr', _this.updateForm),
            // "video": FormValidate.getFieldValue('video', _this.updateForm),
            // "video_fr": FormValidate.getFieldValue('video_fr', _this.updateForm),
        };

        //var brand_id = APIStorage.read('brand-id') || 0;
        var brand_id = getUrlParameter('id') || 0;
        if (brand_id) {
            params['id'] = brand_id;
        }

        // add `keywords` to params variable

        // [ 'en', 'fr' ].forEach(function(current_language_prefix) {
        //     var param_name = 'keywords' + (current_language_prefix != 'en' ? '_' + current_language_prefix : '');

        //     var this_ms_keywords_name = '' +
        //         'msKeywords' +
        //         (current_language_prefix != 'en' ? current_language_prefix[0].toUpperCase() + current_language_prefix.slice(1) : '') +
        //     '';

        //     params[param_name] = $.map(_this[this_ms_keywords_name].getSelection(), function(item) {
        //         return item.id;
        //     }).join(',');
        // });


        var location = params['street'] + ' ' + params['street_number'];
        location += "," + _this.city;
        if (_this.country !== null) {
            location += "," + _this.country;
        }
        geocoder.geocode({'address': location}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                params['latitude'] = results[0].geometry.location.lat();
                params['longitude'] = results[0].geometry.location.lng();
            }

            var needParams = ['token'];
            //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
            new GraphQL("mutation", typeQuery, params, needParams, true, false, function () {
                //
            }, function () {
                if (brand_id) {
                    //APIStorage.remove('brand-id');
                    window.location.href = '/business/brands';
                } else {
                    window.location.href = '/business/profile/edit';
                }
            }, _this.updateForm/*, formData*/).request();
        });
    },
    get: function (done) {
        var _this = this;
        _this.currentID = APIStorage.read('business-id');
        new GraphQL("query", "businesses", {}, [
            'id',
            'name',
            'picture_50(width:50, height:50)',
            'realtime_token',
            'token'
        ], true, false, function () {
            //
        }, function (data) {
            _this.set(data);
            done && done(data);
        }, false).request();
    },
    getCurrentData: function () {
        var _this = this;
        return new Promise(function (resolve, reject) {
            resolve();
        }).then(function (value) {
            var url = document.location.pathname;
            var urlData = explode('/business/profile/', url);
            var brand_id = false;
            if (urlData[1] && urlData[1] === 'edit') {
                //brand_id = APIStorage.read('brand-id');
                brand_id = getUrlParameter('id');
                if (brand_id) {
                    new GraphQL("query", "business", {
                        "id": brand_id
                    }, [
                        'id',
                        'parent_id',
                        'name', 'name_fr',
                        'slug',
                        'description', 'description_fr',
                        //'industry_id',
                        'assign_industries',
                        //'sub_industry_id',
                        'industry',
                        'size_id',
                        // 'keywords{id name}',
                        // 'keywords_fr{id name}',
                        'type',
                        'type_value',
                        'website', 'website_fr',
                        // 'direct_link', 'direct_link_fr',
                        'street',
                        'street_number',
                        'suite',
                        'city',
                        'region',
                        'country',
                        'country_code',
                        'phone',
                        'phone_code',
                        'phone_country_code',
                        'zip_code',
                        'language{id, name, prefix}',
                        'indeed_account{id}',
                        // 'language_id',
                        // 'language_prefix',
                        // 'languages',
                        // 'languages_list{id name}',
                        'picture_o(origin: true)',
                        'picture(width:200, height:200)',
                        'picture_50(width:50, height:50)',
                        'picture_100(width:100, height:100)',
                        'bg_picture',
                        'images{id, business_id, bg_picture}',
                        'picture_filename',
                        'applicants_new_count',
                        'applicants_count',
                        'count_of_clicked_candidates',
                        'stripe_id',
                        'plan_id',
                        'plan_type',
                        'billing_warning',
                        'next_plan_id',
                        'next_plan_type',
                        'owner',
                        'applicants',
                        'integration_guide_steps',
                        'lets_get_started',
                        'integration_toggle',
                        'code_bitly',
                        'new_start_here',
                        'first_plan_payment_was_at',
                        'last_plan_payment_was_at',
                        'facebook', 'facebook_fr',
                        'instagram', 'instagram_fr',
                        'linkedin', 'linkedin_fr',
                        'twitter', 'twitter_fr',
                        'youtube', 'youtube_fr',
                        'snapchat', 'snapchat_fr',
                        // 'video', 'video_fr',
                        'run_first'
                    ], true, false, function () {
                        //
                    }, function (data) {
                        var d = data;
                        delete d.token;

                        _this.currentDataBrand = d;
                        $('#business-profile-edit__title').text(trans('title_brand_edit'));
                        _this.profileSet(_this.currentDataBrand);

                    }, false).request();
                }
            }
            if (_this.currentID) {
                new GraphQL("query", "business", {
                    "id": _this.currentID
                }, [
                    'id',
                    'parent_id',
                    'name', 'name_fr',
                    'slug',
                    'description', 'description_fr',
                    //'industry_id',
                    'assign_industries',
                    //'sub_industry_id',
                    'industry',
                    'size_id',
                    // 'keywords{id name}',
                    // 'keywords_fr{id name}',
                    'type',
                    'type_value',
                    'website', 'website_fr',
                    // 'direct_link', 'direct_link_fr',
                    'street',
                    'street_number',
                    'suite',
                    'city',
                    'region',
                    'country',
                    'country_code',
                    'phone',
                    'phone_code',
                    'phone_country_code',
                    'zip_code',
                    'language{id, name, prefix}',
                    'indeed_account{id}',
                    // 'language_id',
                    // 'language_prefix',
                    // 'languages',
                    // 'languages_list{id name}',
                    'picture_o(origin: true)',
                    'picture(width:200, height:200)',
                    'picture_50(width:50, height:50)',
                    'picture_100(width:100, height:100)',
                    'bg_picture',
                    'images{id, business_id, bg_picture}',
                    'picture_filename',
                    'applicants_new_count',
                    'applicants_count',
                    'count_of_clicked_candidates',
                    'stripe_id',
                    'plan_id',
                    'plan_type',
                    'billing_warning',
                    'next_plan_id',
                    'next_plan_type',
                    'owner',
                    'applicants',
                    'integration_guide_steps',
                    'lets_get_started',
                    'integration_toggle',
                    'code_bitly',
                    'new_start_here',
                    'first_plan_payment_was_at',
                    'last_plan_payment_was_at',
                    'facebook', 'facebook_fr',
                    'instagram', 'instagram_fr',
                    'linkedin', 'linkedin_fr',
                    'twitter', 'twitter_fr',
                    'youtube', 'youtube_fr',
                    'snapchat', 'snapchat_fr',
                    // 'video', 'video_fr',
                    'run_first'
                ], true, false, function () {
                    //
                }, function (data) {
                    if (brand_id) {
                        _this.counters();
                        _this.fillCurrentData(data.name, data.picture_50);
                        return;
                    }
                    if (!data.run_first && data.id) {
                        $('#businessFirstTime').modal('show');
                        new GraphQL("mutation", "updateBusinessRunFirst", {
                            'id': data.id,
                            'run_first': 1
                        }, [
                            'token', 'response'
                        ], true, false, function () {
                            //
                        }, function (data) {

                        }, false).request();
                        data.run_first = 1;
                    }
                    var d = data;
                    delete d.token;
                    _this.currentData = d;
                    if (_this.currentData.billing_warning === 1) {
                        $('.notification[data-type="billing"]').removeClass('d-none');
                    }
                    var url = document.location.pathname;
                    var urlData = explode('/business/profile/', url);
                    if (urlData[1]) {
                        if (urlData[1] === 'edit') {
                            _this.profileSet();
                        }
                    }
                    urlData = explode('/business/', url);
                    if (urlData[1] === 'dashboard') {
                        var html = '<div><p class="mb-0"><button class="btn btn-primary">' + Langs.text_start_candidates + '</button></p></div>';
                        if (data.applicants_count > 0) {
                            html = "<p class=\"lastsee-view-sent\" style=\"color:#4E5C6E; font-family: 'AvenirNext'; font-size: 14px;\">" + data.applicants_new_count + " " + Langs.new_applicants + " <br><strong>(" + data.applicants_count + " " + Langs.total + ")</strong></p>";
                        }
                        $('#applicants-link').find('div').append(html);
                    }

                    _this.fillCurrentData(data.name, data.picture_50);
                    // }).then(function () {
                    _this.counterIntegrationGuide();
                    _this.counters();
                    $('.email-forwarder-business').val('b-' + business.currentData.id + '@jobmap.co');
                    if (_this.currentData.integration_toggle == 1) {
                        $('.plus_icon').parent().next('div').slideToggle();
                        $('.plus_icon').toggleClass('collapsed');
                        $('.plus_icon_title').hide();
                        $('.simple_guide').hide();
                        $('.switch_to_basic').show();
                        $('.plus_icon_title').parent().next('div').slideToggle();
                        $('.plus_icon_title').next('.plus_icon').toggleClass('collapsed');
                    }
                    if (_this.currentData.new_start_here == 0) {
                        $('#new_start_here').hide();
                        $('#new_start_here').parent().removeClass('my-4');
                        $('.plus_icon_title').show();
                        $('.simple_guide').show();
                        $('.advanced_guide').slideToggle();
                    }
                    $('#crLink-CodeBitLyBusiness').val(_this.currentData.code_bitly);
                    // if ($('#clipboard-button').length > 0) {
                    //     var clipboard = new Clipboard('#clipboard-button');
                    //     clipboard.on('success', function (e) {
                    //         $.notify('Copied!', 'success');
                    //         e.clearSelection();
                    //     });
                    // }
                }, false).request();
            }
        });
    },
    saveIntegrationToggle: function () {
        if (business.currentData.integration_toggle == 1) {
            business.currentData.integration_toggle = 0;
        } else {
            business.currentData.integration_toggle = 1;
        }
        new GraphQL("mutation", "saveIntegrationToggle",{
                business_id: business.currentData.id,
                integration_toggle: business.currentData.integration_toggle
            },[ 'response, token' ],
            true, false, function () {
                //
            }, function (data) {
            }, false).request();
    },
    counterIntegrationGuide: function () {
        var _this = this;
        let data,
            countNo = 0;
        if (_this.currentData.lets_get_started) {
            data = _this.currentData.lets_get_started.split(',');
            if (data[0] != 1 && data[9] != 1) {
                $('.countIntegration-WebsiteButton').removeClass('red').addClass('grey');
            }
            if (data[3] !== 1 && data[7] != 1) {
                $('.countIntegration-ATSImport').removeClass('red').addClass('grey');
            }
            if (data[2] != 1) {
                $('.countIntegration-CREmail').removeClass('red').addClass('grey');
            }
            if (data[8] != 1) {
                $('.countIntegration-EmailForwarder').removeClass('red').addClass('grey');
            }
            if (data[4] != 1) {
                $('.countIntegration-resume_scaner').removeClass('red').addClass('grey');
            }
        } else {
            _this.currentData.lets_get_started = '1,1,1,1,1,1,1,1,1,1';
        }
        if (_this.currentData.integration_guide_steps) {
            data = _this.currentData.integration_guide_steps.split(',');
            jQuery.each(data, function (index, value) {
                if (value == 1) {
                    let tab = '';
                    switch (index) {
                        case 0:
                            tab = 'WebsiteButton';
                            break;
                        case 1:
                            tab = 'ATSImport';
                            break;
                        case 2:
                            tab = 'CREmail';
                            break;
                        case 3:
                            tab = 'EmailForwarder';
                            break;
                        /*case 4:
                            tab = 'resume_scaner';
                            break;*/
                    }
                    if (tab != '') {
                        countNo++;
                        let countClass = '.countIntegration-' + tab;
                        //$(countClass).text('');
                        //$(countClass).fadeOut();
                        $(countClass).removeClass('red').removeClass('grey').addClass('green_a').html(_this.htmlGalka);
                    }
                }
            });
            if (countNo < 4) {
                $('.countIntegration').text(4 - countNo);
                $('.countIntegration').fadeIn();
                $('.countIntegration').addClass('bounceIn');
                setTimeout(function () {
                    $('.countIntegration').removeClass('bounceIn');
                }, 500);
            }
        } else {
            $('.countIntegration').text('4');
            $('.countIntegration').fadeIn();
            $('.countIntegration').addClass('bounceIn');
            setTimeout(function () {
                $('.countIntegration').removeClass('bounceIn');
            }, 500);
        }
    },
    counters: function () {
        var _this = this;
        if (_this.currentID) {
            //get notify Counter Applicants
            new GraphQL("query", 'notifyCounterBusiness', {
                'business_id': _this.currentID
            }, [
                'applicants_total',
                'applicants_new',
                'managers',
                'locations',
                //'departments',
                'jobs',
                'brands',
                'failed_invoices',
                'token'
            ], true, false, function () {
                //
            }, function (data) {

                let type = window.location.pathname.split("/");
                if (type.length > 2) {
                    new GraphQL("query", "getHowToStartGotIt", {
                        'business_id': business.currentID,
                        'user_id': user.data.id,
                        'type': type[2],
                        'section': type[1]
                    }, [
                        'result',
                        'token'
                    ], true, false, function () {
                        //
                    }, function (data) {
                        if (data.result == 'show') {
                            $('.help-how-to-start-block').show();
                        } else {
                            $('.help-how-to-start-block').hide();
                        }
                    }, false).request();
                } else {
                    $('.help-how-to-start-block').hide();
                }

                if (data.applicants_total == 0) {
                    $('.countApplicantsTotal').text('');
                    $('.countApplicantsTotal').fadeOut();
                    $('.noBusinessApplicantsTitle').show();
                    $('.businessApplicantsBlock').hide();
                } else {
                    $('.countApplicantsTotal').text(data.applicants_total);
                    $('.countApplicantsTotal').fadeIn();
                    $('.noBusinessApplicantsTitle').hide();
                    $('.howToStartBusinessApplicants').hide();
                    $('.businessApplicantsBlock').show();
                }
                if (data.applicants_new == 0) {
                    $('.countApplicantsNew').text('');
                    $('.countApplicantsNew').addClass("hide");
                } else {
                    $('.countApplicantsNew').text(data.applicants_new);
                    $('.countApplicantsNew').removeClass("hide");
                }
                if (data.managers == 0) {
                    $('.countManagers').text('');
                    $('.countManagers').addClass("hide");
                } else {
                    $('.countManagers').text(data.managers);
                    $('.countManagers').removeClass("hide");
                }
                if(data.failed_invoices) {
                    $('.countManagers').text(data.failed_invoices);
                    $('.countManagers').addClass('bg-danger').addClass('text-white');
                }
                else {
                    $('.countManagers').text(data.managers);
                    $('.countManagers').removeClass('bg-danger').removeClass('text-white');
                }
                if (data.locations == 0) {
                    $('.countLocations').text('');
                    $('.countLocations').addClass("hide");
                } else {
                    $('.countLocations').text(data.locations);
                    $('.countLocations').removeClass("hide");
                }
                // if (data.departments == 0) {
                //     $('.countDepartments').text('');
                //     $('.countDepartments').fadeOut();
                // } else {
                //     $('.countDepartments').text(data.departments);
                //     $('.countDepartments').fadeIn();
                // }
                if (data.jobs == 0) {
                    $('.countJobs').text('');
                    $('.countJobs').addClass("hide");
                } else {
                    $('.countJobs').text(data.jobs);
                    $('.countJobs').removeClass("hide");
                }
                if (data.brands == 0) {
                    $('.countBrands').text('');
                    $('.countBrands').addClass("hide");
                } else {
                    $('.countBrands').text(data.brands);
                    $('.countBrands').removeClass("hide");
                }
            }).request();
        }
    },
    //save all params for user to local storage
    set: function (data) {
        var _this = this;
        if (data && data.length > 0) {
            if (data[0].id) {
                this.data = data;
                for (var i = 0; i < this.data.length; i++) {
                    if (data[i].id === _this.currentID) {
                        // _this.fillCurrentData(data[i].name, data[i].picture_50);
                    }
                    delete this.data[i].token;
                }
                this.fillData();
            }
        } else {
            $('.show-no-businesses').removeClass("hide");
            $('.show-yes-businesses').hide();
            $('.business_switch').off();
        }
    },
    importEmail: function () {
        var _this = this;
        $('.js-submit_email').on('click', function () {
            var form = $(this).closest('.formQuickApplImport');
            //if ($('.js-import_email').val() !== '') {
                $('.js-submit_email').attr('disabled', 'disabled');
                new GraphQL("mutation", "ImportEmail", {
                        "business_id": parseInt(APIStorage.read('business-id')),
                        "email": FormValidate.getFieldValue('email', form)
                    },
                    ['status, token'], true, false, function () {
                        //
                    }, function (data) {
                        var path = location.pathname;

                        if (path.indexOf('business/candidate/manage') !== -1) {
                            if (path.indexOf('-ats') !== -1) {
                                BusinessATS.getList();
                            } else {
                                if ($('#pipeline-buttons button[data-id="ats"]').length > 0) {
                                    _this.counters();
                                    $('#pipeline-buttons button[data-id="ats"]').click();
                                }
                            }

                        }
                        if (data.status === 'Pending') {
                            $.notify(Langs.invitation_sent, 'success');
                        } else if (data.status === 'Exist') {
                            $.notify(Langs.pipeline_already_registered, 'success');
                        }
                        $('.js-submit_email').attr('disabled', false);
                        $('.js-import_email').val('');
                    }, form).request();
            //}
        });
        $('.formQuickApplImport [name="email"]').keyup(function () {
            $('.js-submit_email').attr('disabled', false);
            var form = $(this).closest('.formQuickApplImport');
            FormValidate.fieldsValidateClear(form);

            /*var inputFeedback = form.find('[name="email"]');
            if (inputFeedback.get(0) && inputFeedback.get(0).scrollHeight > inputFeedback.innerHeight() && inputFeedback.height() < 70) {
                inputFeedback.css('height', inputFeedback.height() + 36);//animate({'height': inputFeedback.height()+36}, 500);
                countItem++;
                countCharts[countItem] = inputFeedback.val().length - 1;
            }
            if (inputFeedback.val().length < countCharts[countItem]) {
                inputFeedback.css('height', inputFeedback.innerHeight() - 20);//animate({'height': inputFeedback.height()+36}, 500);
                countItem--;
            }*/
        });
    },
    logout: function () {
        //remove all api cookies
        APIStorage.remove('business-id');
        //clear business data from local storage
        localStorage.removeItem('businesses');
    },
    getUserPaid: function() {
        let _this = this;
        request({
            url: "/billing/get-current-user-paid",
            data: {
                business_id: APIStorage.read('business-id'),
            },
        }, function (response) {
            console.log(response);
            if(response.error === undefined ){
                var widget_link = $(document).find('#business-widget-link');
                var candidate_link = $(document).find('#business-candidate-manage-link');
                if(response.trial || response.paid)
                {
                    $(document).trigger('billing:user_is_paid');
                    widget_link.attr('href',widget_link.attr('data-href'));
                    candidate_link.attr('href', candidate_link.attr('data-href'));
                }
                else if(response.manager_paid == true) {
                    $(document).trigger('billing:user_is_paid');
                    widget_link.attr('href',widget_link.attr('data-href'));
                    candidate_link.attr('href', candidate_link.attr('data-href'));
                }
                else if (response.manager_paid == false){
                    $(document).trigger('billing:user_not_paid');
                    widget_link.attr('data-toggle',"modal").attr('data-target',"#modalForPay");
                    candidate_link.attr('data-toggle',"modal").attr('data-target',"#modalForPay");
                }
                else {
                    $(document).trigger('billing:user_not_paid');
                    candidate_link.attr('href', candidate_link.attr('data-href'));
                    widget_link.attr('data-toggle',"modal").attr('data-target',"#modalForPay");
                    
                }
            }
            else console.log(response.error);
        });
    },
};
