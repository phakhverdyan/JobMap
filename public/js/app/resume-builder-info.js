function ResumeInfo(name) {
    this.type = 'resume-' + name;
    this.name = name;
    this.nameType = name;
    this.method = capitalizeFirstLetter(name);
    this.editModal = 'editModal' + capitalizeFirstLetter(name);
    this.confirmModal = 'saveEditModal' + capitalizeFirstLetter(name);
    this.deleteModal = 'deleteEditModal' + capitalizeFirstLetter(name);

    this.msIndustry;
    this.msSubIndustry;

    this.msIndustryValue = null;
    this.msSubIndustryValue = null;

    this.msJobSubCategory = null;
    this.msJobSubCategoryElement = $('#job_subcategories');

    this.msCompany = null;
    this.msCompanyElement = $('#experience-company');

    this.msSkillTitle = null;
    this.msSkillTitleElement = $('#skill-title');

    this.msLanguageTitle = null;
    this.msLanguageTitleElement = $('#language-title');

    this.msHobbyTitle = null;
    this.msHobbyTitleElement = $('#hobby-title');

    this.msInterestTitle = null;
    this.msInterestTitleElement = $('#interest-title');

    this.msCertificateTitle = null;
    this.msCertificateTitleElement = $('#certificate-title');

    this.msDistinctionTitle = null;
    this.msDistinctionTitleElement = $('#distinction-title');

    this.msGrade = null;
    this.msGradeElement = $('#education-grade');

    this.msDegree = null;
    this.msDegreeElement = $('#education-degree');

    this.msStudy = null;
    this.msStudyElement = $('#education-study');
}

ResumeInfo.prototype.init = function () {
    var body = $('body');
    var _this = this;

    //create or update data from modal
    $('#resume-save-' + this.name).on('click', function () {
        if ($('#resume-' + _this.name + '-form input[name="item-id"]').val() === "0") {
            _this.save();
        } else {
            _this.update();
        }
    });

    //edit resume item
    body.on('click', 'button[data-item-action="resume-' + this.name + '-edit"]', function () {
        _this.getItem($(this).attr('data-id'));
    });

    //delete resume item
    body.on('click', 'button[data-item-action="resume-' + this.name + '-delete"]', function () {
        _this.delete($(this).attr('data-id'));
    });

    //add new item
    $('#resume-' + this.name + '-add').on('click', function () {
        _this.clear();
    });

    //only for education and experience
    var autocompleteElements = ['education', 'experience'];
    var form = $('#resume-' + _this.name + '-form');
    var fieldInput = '';
    if ($.inArray(this.name, autocompleteElements) !== -1) {
        if (this.name === 'education') {
            form.find('input[name="current"]').change(function () {
                if ($(this).prop('checked')) {
                    form.find('select[name="year_to"] option[value="' + (new Date()).getFullYear() + '"]').prop('selected', 'selected').change();
                    form.find('select[name="year_to"]').attr('disabled', true);
                } else {
                    form.find('select[name="year_to"]').attr('disabled', false);
                }
            });
            _this.autocompleteField('grade');
            _this.autocompleteField('degree');
            _this.autocompleteField('study');
        } else {
            _this.msIndustry = $('#industry_id').magicSuggest({
                placeholder: Langs.choose_industry,
                toggleOnClick: true,
                allowFreeEntries: false,
                data: [],
                maxSelection: 1,
                maxSelectionRenderer: function () {
                    return trans('jack_max_1');
                },
                required: true,
                hideTrigger: true,
                noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                cls: 'jack input_style industries_box field-box'
            });

            _this.msSubIndustry = $('#sub_industry_id').magicSuggest({
                placeholder: Langs.choose_sub_industry,
                toggleOnClick: true,
                allowFreeEntries: false,
                data: [],
                maxSelection: 1,
                maxSelectionRenderer: function () {
                    return trans('jack_max_1');
                },
                required: true,
                hideTrigger: true,
                noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                cls: 'jack input_style industries_box field-box'
            });

            $(_this.msIndustry).on('selectionchange', function () {
                if (this.getValue().length !== 0) {
                    var id = this.getValue()[0];
                    _this.msIndustryValue = id;
                    _this.msSubIndustryValue = null;
                    _this.getIndustries(id);
                } else {
                    _this.msIndustryValue = 0;
                    _this.msSubIndustryValue = null;
                    _this.msSubIndustry.setData([]);
                }
                _this.msSubIndustry.clear();
            });

            $(_this.msSubIndustry).on('selectionchange', function () {
                if (this.getValue().length !== 0) {
                    var id = this.getValue()[0];
                    _this.msSubIndustryValue = id;
                } else {
                    _this.msSubIndustryValue = 0;
                    _this.msSubIndustryValue = null;
                }
            });

            _this.getMSList(function (items, defaultData) {
                _this.msJobSubCategory = _this.msJobSubCategoryElement.magicSuggest({
                    placeholder: trans('field_job_title'),
                    maxSelection: 1,
                    maxSelectionRenderer: function () {
                        return trans('jack_max_1');
                    },
                    toggleOnClick: true,
                    allowFreeEntries: true,
                    data: [],
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                    cls: 'jack input_style'
                });
                if (defaultData) {
                    _this.msJobSubCategory.setSelection(defaultData);
                }
                var timeout = null;
                $(_this.msJobSubCategory).on('keyup focus', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this.msJobSubCategory.setData(items);
                        }, 'categories', _this.msJobSubCategoryElement, _this.msJobSubCategory.getRawValue(), undefined, 1);
                    }, 500);
                });
            }, 'categories', _this.msJobSubCategoryElement, undefined, undefined,1);
            setTimeout(function () {
                $('#job_subcategories input').attr('name','title');
            },3000);

            form.find('input[name="current"]').change(function () {
                if ($(this).prop('checked')) {
                    var month = (new Date()).getMonth() + 1;
                    if (month < 10)
                        month = "0" + month;
                    form.find('select[name="month_to"] option[value="' + month + '"]').prop('selected', 'selected').change();
                    form.find('select[name="year_to"] option[value="' + (new Date()).getFullYear() + '"]').prop('selected', 'selected').change();
                    form.find('select[name="month_to"]').attr('disabled', true);
                    form.find('select[name="year_to"]').attr('disabled', true);
                } else {
                    form.find('select[name="month_to"]').attr('disabled', false);
                    form.find('select[name="year_to"]').attr('disabled', false);
                }
            });
            _this.autocompleteField('company');
        }

        var searchElement = $('#' + this.name + '-location');
        var clearLocationField = $('#' + this.name + '-location-clear');
        //clear location field and focus
        $('body').on('click', '#' + this.name + '-location-clear', function () {
            searchElement.val('');
            searchElement.focus();
            clearLocationField.parent().addClass('hide');
            searchElement.addClass('autocomplete-border');
        });
        //autocomplete locations
        searchElement.autocomplete({
            source: function (request, response) {
                if (request.term.length === 0) {
                    clearLocationField.parent().addClass('hide');
                    searchElement.addClass('autocomplete-border');
                } else {
                    clearLocationField.parent().removeClass('hide');
                    searchElement.removeClass('autocomplete-border');
                }
                //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler
                new GraphQL("query", "geo", {
                    "key": request.term
                }, ['fullName', 'city', 'region', 'country', 'countryCode'], false, false, function (data) {
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
                        //set empty values
                        form.find('input[name="location"]').val('');
                        form.find('input[name="region"]').val('');
                        form.find('input[name="country"]').val('');
                        form.find('input[name="country_code"]').val('');
                        searchElement.removeClass('ui-autocomplete-loading');
                    }
                }).autocomplete();
            },
            select: function (event, ui) {
                var form = $('#resume-' + _this.name + '-form');
                form.find('input[name="location"]').val(ui.item.data.city);
                form.find('input[name="region"]').val(ui.item.data.region);
                form.find('input[name="country"]').val(ui.item.data.country);
                form.find('input[name="country_code"]').val(ui.item.id);
                var flag = $('#' + _this.name + '-addon1');
                flag.find('i').removeClassRegex(/^bfh-flag-/);
                flag.find('i').addClass('bfh-flag-' + ui.item.id);
            },
            response: function (e, u) {
                searchElement.removeClass('ui-autocomplete-loading');
            }
        }).attr('autocomplete', 'disabled').autocomplete("instance")._renderItem = function (ul, item) {
            //show country flag in dropdown
            return $("<li>")
                .append('<span><i class="glyphicon bfh-flag-' + item.id + '"></i> </span><span>' + item.label + '</span>')
                .appendTo(ul);
        };
    }
    //only for NOT education and experience
    else {
        if (_this.name !== 'reference') {
            _this.autocompleteField();
        } else {
            $('#resume-builder__goto-references').click(function () {
                APIStorage.create('reference-back', 'yes');
            });
        }
    }

};
ResumeInfo.prototype.getIndustries = function (id, sub) {
    var _this = this;
    var params = {};
    params['parent_id'] = id;
    new GraphQL("query", "industries", params, [
        'id',
        'name'
    ], false, false, function () {
        Loader.stop();
    }, function (data) {
        if (data) {
            _this.msSubIndustry.setData(data);
            if (sub) {
                _this.msSubIndustry.setValue([sub]);
            }
        }
    }).request($('sub_industry_id'), false, false);
};
ResumeInfo.prototype.getMSList = function (callback, method, el, keywords, defaultData, sub, type) {
    var params = {};
    if (sub) {
        params = { 'sub': 1 };
    }
    if (method === 'autocompleteResume') {
        if (type) {
            params = { 'type': type };
        } else {
            params = { 'type': this.nameType };
        }
    }
    var need = ['items{id name}'];
    if (method === 'categories' || method === 'autocompleteResume') {
        need = ['id name'];
    }

    if (defaultData) {
        params['default'] = defaultData;
        need.push('default{id name}')
    }

    if (((keywords && keywords.length === 0) || !keywords) && method === 'keywords') {
        callback([], defaultData);
    } else {
        if (keywords) {
            if (keywords.length > 0) {
                params['keywords'] = keywords;
            }
        }
        new GraphQL("query", method, params, need, false, false, function (data) {
            //show error
        }, function (data) {
            if (data) {
                if (method === 'categories' || method === 'autocompleteResume') {
                    callback(data, data.default);
                } else {
                    var items = $.map(data.items, function (item) {
                        return {
                            id: item.id,
                            name: item.name
                        };
                    });
                    callback(items, (method === 'keywords') ? defaultData : data.default);
                }
            }
        }).request(el);
    }
};
//clear all from fields in modal
ResumeInfo.prototype.clear = function () {
    var _this = this;

    var form = $('#' + this.type + '-form');
    FormValidate.fieldsValidateClear(form);
    //set default value for modal form
    form.find('input:text').val('');
    form.find('[name="item-id"]').val(0);
    form.find('textarea').val('');
    form.find('select').attr('disabled', false);
    if (this.name === 'certification') {
        form.find('select').find('option:first').prop('selected', 'selected').change();
    } else {
        form.find('select').val('').change();
    }
    form.find('input:checkbox').prop('checked', false);

    if (this.name === 'education' || this.name === 'experience') {
        var location = builder.data.city;
        if (builder.region) {
            location += "," + builder.region;
        }
        if (builder.country) {
            location += "," + builder.country;
        }

        //set default location and flag  for education and experience
        $('#' + this.name + '-location').val(location);
        var flag = $('#' + this.name + '-addon1');
        flag.find('i').removeClassRegex(/^bfh-flag-/);
        flag.find('i').addClass('bfh-flag-' + builder.countryCode);

        //set default location data for education and experience
        form.find('input[name="location"]').val(builder.city);
        form.find('input[name="region"]').val(builder.region);
        form.find('input[name="country"]').val(builder.country);
        form.find('input[name="country_code"]').val(builder.countryCode);

        if (this.name === 'experience') {
            _this.msIndustry.setData(builder.industries);
            _this.msSubIndustry.setData([]);
            _this.msIndustry.clear();
            _this.msSubIndustry.clear();
            _this.msIndustryValue = null;
            _this.msSubIndustryValue = null;

            _this.msJobSubCategory.setData([]);
            _this.msJobSubCategory.clear();

            _this.msCompany.setData([]);
            _this.msCompany.clear();
        } else {
            _this.msGrade.setData([]);
            _this.msGrade.clear();

            _this.msDegree.setData([]);
            _this.msDegree.clear();

            _this.msStudy.setData([]);
            _this.msStudy.clear();
        }
    } else {
        if (_this.msSkillTitle) {
            _this.msSkillTitle.setData([]);
            _this.msSkillTitle.clear();
        }
        if (_this.msLanguageTitle) {
            _this.msLanguageTitle.setData([]);
            _this.msLanguageTitle.clear();
        }
        if (_this.msHobbyTitle) {
            _this.msHobbyTitle.setData([]);
            _this.msHobbyTitle.clear();
        }
        if (_this.msInterestTitle) {
            _this.msInterestTitle.setData([]);
            _this.msInterestTitle.clear();
        }
        if (_this.msCertificateTitle) {
            _this.msCertificateTitle.setData([]);
            _this.msCertificateTitle.clear();
        }
        if (_this.msDistinctionTitle) {
            _this.msDistinctionTitle.setData([]);
            _this.msDistinctionTitle.clear();
        }
    }

    if (this.name === 'skill' || this.name === 'language') {
        //set default slider position for skill and language
        form.find("#" + this.name + "-slider-range-min").slider("value", 50);
        form.find("#" + this.name + "-slider-amount").html(form.find("#" + this.name + "-slider-range-min").slider("value") + "%");
    }
};
//insert all items by object type to page
ResumeInfo.prototype.getList = function (items,data/*,first_job*/) {
    if (data !== undefined) {
        var first_job = data.first_job === undefined ? false : data.first_job;
        if (first_job === 1) {
            $('#first-job-no').parent().removeClass('active');
            $('#first-job-yes').parent().addClass('active');
        } else if (first_job === 0) {
            $('#first-job-yes').parent().removeClass('active');
            $('#first-job-no').parent().addClass('active');
        }
        var not_education = data.not_education === undefined ? false : data.not_education;
        if (not_education === 1) {
            $('#not-education-no').parent().removeClass('active');
            $('#not-education-yes').parent().addClass('active');
        } else if (not_education === 0) {
            $('#not-education-yes').parent().removeClass('active');
            $('#not-education-no').parent().addClass('active');
        }
        var not_certification = data.not_certification === undefined ? false : data.not_certification;
        if (not_certification === 1) {
            $('#not-certification-no').parent().removeClass('active');
            $('#not-certification-yes').parent().addClass('active');
        } else if (not_certification === 0) {
            $('#not-certification-yes').parent().removeClass('active');
            $('#not-certification-no').parent().addClass('active');
        }
        var not_distinction = data.not_distinction === undefined ? false : data.not_distinction;
        if (not_distinction === 1) {
            $('#not-distinction-no').parent().removeClass('active');
            $('#not-distinction-yes').parent().addClass('active');
        } else if (not_distinction === 0) {
            $('#not-distinction-yes').parent().removeClass('active');
            $('#not-distinction-no').parent().addClass('active');
        }
    }

    if (items.length !== 0) {
        $('#resume-not-' + this.name).addClass('hide');
        var type = this.type;
        $.map(items, function (item) {
            $('.items-list[data-type-item="' + type + '"]').prepend(item.html);
        });
    } else {
        $('#resume-not-' + this.name).removeClass('hide');
    }
};
//send data to server
ResumeInfo.prototype.save = function () {
    var _this = this;
    var form = $('#' + this.type + '-form');
    var type = this.type;
    var id = form.find('*[name="item-id"]').val();
    //type graphql query
    var typeQuery = "create" + this.method;
    //confirm modal on update
    var confirmModal = this.confirmModal;
    //default edit modal on create or edit
    var editModal = this.editModal;
    var name = this.name;
    //request params
    var params;
    //response params needed
    var needParams;
    switch (this.name) {
        case 'education':
            params = {
                "school_name": FormValidate.getFieldValue('school_name', form),
                "city": (FormValidate.getFieldValue('location', form) !== "") ? FormValidate.getFieldValue('location', form) : FormValidate.getFieldValue('city', form),
                "region": FormValidate.getFieldValue('region', form),
                "country": FormValidate.getFieldValue('country', form),
                "country_code": FormValidate.getFieldValue('country_code', form),
                "year_from": FormValidate.getFieldValue('year_from', form),
                "year_to": FormValidate.getFieldValue('year_to', form),
                //"grade": FormValidate.getFieldValue('grade', form),
                "grade": this.msGrade.getSelection()[0] ? this.msGrade.getSelection()[0].name : (FormValidate.getFieldValue('grade', form) || null),
                "grade_id": this.msGrade.getSelection()[0] ? this.msGrade.getSelection()[0].id : (FormValidate.getFieldValue('grade', form) || null),
                "current": +FormValidate.getCheckedFieldValue('current', form),
                //"degree": FormValidate.getFieldValue('degree', form),
                "degree": this.msDegree.getSelection()[0] ? this.msDegree.getSelection()[0].name : (FormValidate.getFieldValue('degree', form) || null),
                "degree_id": this.msDegree.getSelection()[0] ? this.msDegree.getSelection()[0].id : (FormValidate.getFieldValue('degree', form) || null),
                //"study": FormValidate.getFieldValue('study', form),
                "study": this.msStudy.getSelection()[0] ? this.msStudy.getSelection()[0].name : (FormValidate.getFieldValue('study', form) || null),
                "study_id": this.msStudy.getSelection()[0] ? this.msStudy.getSelection()[0].id : (FormValidate.getFieldValue('study', form) || null),
                "activities": FormValidate.getFieldValue('activities', form),
                "description": FormValidate.getFieldValue('description', form),
                "achievement_title": FormValidate.getFieldValue('achievement_title', form),
                "achievement_description": FormValidate.getFieldValue('achievement_description', form)
            };
            needParams = [
                'school_name',
                'city',
                'region',
                'country',
                'country_code',
                'year_from',
                'year_to',
                'grade',
                'grade_id',
                'assign_grade{id name}',
                'current',
                'degree',
                'degree_id',
                'assign_degree{id name}',
                'study',
                'study_id',
                'assign_study{id name}',
                'activities',
                'description',
                'achievement_title',
                'achievement_description'
            ];
            break;
        case 'experience':
            params = {
                //"title": FormValidate.getFieldValue('title', form),
                "title": this.msJobSubCategory.getSelection()[0] ? this.msJobSubCategory.getSelection()[0].name : FormValidate.getFieldValue('title', form),
                "title_id": this.msJobSubCategory.getSelection()[0] ? this.msJobSubCategory.getSelection()[0].id : FormValidate.getFieldValue('title', form),
                //"company": FormValidate.getFieldValue('company', form),
                "company": this.msCompany.getSelection()[0] ? this.msCompany.getSelection()[0].name : FormValidate.getFieldValue('company', form),
                "company_id": this.msCompany.getSelection()[0] ? this.msCompany.getSelection()[0].id : FormValidate.getFieldValue('company', form),
                "city": (FormValidate.getFieldValue('location', form) !== "") ? FormValidate.getFieldValue('location', form) : FormValidate.getFieldValue('city', form),
                "region": FormValidate.getFieldValue('region', form),
                "country": FormValidate.getFieldValue('country', form),
                "country_code": FormValidate.getFieldValue('country_code', form),
                "date_from": FormValidate.getFieldDateMonthYear('month_from', 'year_from', form),
                "date_to": FormValidate.getFieldDateMonthYear('month_to', 'year_to', form),
                "current": +FormValidate.getCheckedFieldValue('current', form),
                "industry_id": (_this.msIndustryValue) ? +_this.msIndustryValue : 0,
                "sub_industry_id": (_this.msSubIndustryValue) ? +_this.msSubIndustryValue : 0,
                "description": FormValidate.getFieldValue('description', form),
                "additional_info": FormValidate.getFieldValue('additional_info', form),
            };
            needParams = [
                'title',
                'title_id',
                'assign_title{id name}',
                'company',
                'company_id',
                'assign_company{id name}',
                'city',
                'region',
                'country',
                'country_code',
                'year_from',
                'month_from',
                'year_to',
                'month_to',
                'current',
                'industry_id',
                'sub_industry_id',
                'description',
                'additional_info'
            ];
            break;
        case 'skill':
            params = {
                //"title": FormValidate.getFieldValue('title', form),
                "title": this.msSkillTitle.getSelection()[0] ? this.msSkillTitle.getSelection()[0].name : FormValidate.getFieldValue('title', form),
                "title_id": this.msSkillTitle.getSelection()[0] ? this.msSkillTitle.getSelection()[0].id : FormValidate.getFieldValue('title', form),
                "description": FormValidate.getFieldValue('description', form),
                "level": +form.find("#" + this.name + "-slider-range-min").slider("value")
            };
            needParams = [
                'title',
                'title_id',
                'assign_title{id name}',
                'description',
                'level'
            ];
            break;
        case 'language':
            params = {
                //"title": FormValidate.getFieldValue('title', form),
                "title": this.msLanguageTitle.getSelection()[0] ? this.msLanguageTitle.getSelection()[0].name : FormValidate.getFieldValue('title', form),
                "title_id": this.msLanguageTitle.getSelection()[0] ? this.msLanguageTitle.getSelection()[0].id : FormValidate.getFieldValue('title', form),
                "level": +form.find("#" + this.name + "-slider-range-min").slider("value")
            };
            needParams = [
                'title',
                'title_id',
                'assign_title{id name}',
                'level'
            ];
            break;
        case 'certification':
            params = {
                //"title": FormValidate.getFieldValue('title', form),
                "title": this.msCertificateTitle.getSelection()[0] ? this.msCertificateTitle.getSelection()[0].name : FormValidate.getFieldValue('title', form),
                "title_id": this.msCertificateTitle.getSelection()[0] ? this.msCertificateTitle.getSelection()[0].id : FormValidate.getFieldValue('title', form),
                "type": FormValidate.getFieldValue('type', form),
                "year": FormValidate.getFieldValue('year', form)
            };
            needParams = [
                'title',
                'title_id',
                'assign_title{id name}',
                'type',
                'year'
            ];
            break;
        case 'distinction':
            params = {
                //"title": FormValidate.getFieldValue('title', form),
                "title": this.msDistinctionTitle.getSelection()[0] ? this.msDistinctionTitle.getSelection()[0].name : FormValidate.getFieldValue('title', form),
                "title_id": this.msDistinctionTitle.getSelection()[0] ? this.msDistinctionTitle.getSelection()[0].id : FormValidate.getFieldValue('title', form),
                "year": FormValidate.getFieldValue('year', form)
            };
            needParams = [
                'title',
                'title_id',
                'assign_title{id name}',
                'year'
            ];
            break;
        case 'hobby':
            params = {
                //"title": FormValidate.getFieldValue('title', form),
                "title": this.msHobbyTitle.getSelection()[0] ? this.msHobbyTitle.getSelection()[0].name : FormValidate.getFieldValue('title', form),
                "title_id": this.msHobbyTitle.getSelection()[0] ? this.msHobbyTitle.getSelection()[0].id : FormValidate.getFieldValue('title', form),
                "description": FormValidate.getFieldValue('description', form)
            };
            needParams = [
                'title',
                'title_id',
                'assign_title{id name}',
                'description'
            ];
            break;
        case 'interest':
            params = {
                //"title": FormValidate.getFieldValue('title', form),
                "title": this.msInterestTitle.getSelection()[0] ? this.msInterestTitle.getSelection()[0].name : FormValidate.getFieldValue('title', form),
                "title_id": this.msInterestTitle.getSelection()[0] ? this.msInterestTitle.getSelection()[0].id : FormValidate.getFieldValue('title', form),
                "description": FormValidate.getFieldValue('description', form)
            };
            needParams = [
                'title',
                'title_id',
                'assign_title{id name}',
                'description'
            ];
            break;
        case 'reference':
            params = {
                "email": FormValidate.getFieldValue('email', form),
                "phone_number": FormValidate.getFieldValue('phone_number', form),
                "full_name": FormValidate.getFieldValue('full_name', form),
                "company": FormValidate.getFieldValue('company', form)
            };
            needParams = [
                'email',
                'phone_number',
                'full_name',
                'company'
            ];
            break;
    }
    needParams.push('id');
    needParams.push('html');
    needParams.push('token');
    if (id !== "0") {
        typeQuery = "update" + this.method;
        params['id'] = id;
    }
    //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form

    new GraphQL("mutation", typeQuery, params, needParams, true, false, function (data) {
        Loader.stop();
        if (!data) {
            $('#' + confirmModal).on('hidden.bs.modal', function () {
                $('#' + editModal).modal('show');
                $(this).unbind();
            });
        }
    }, function (data) {
        if (id !== "0") {
            var index = findObjectIndexByKey(builder[name], 'id', id);
            builder[name][index] = data;
            $('.items-list[data-type-item="' + type + '"]').find('.item-row[data-id="' + id + '"]').replaceWith(data.html);
        } else {
            $('.items-list[data-type-item="' + type + '"]').prepend(data.html);
            builder[name].push(data);
        }
        $('#resume-not-' + name).addClass('hide');
        $('#' + editModal).modal('hide');
    }, form).request();
};
//get item data
ResumeInfo.prototype.getItem = function (id) {
    this.clear();
    var currentItem = builder[this.name];
    var item = findObjectByKey(currentItem, 'id', id);
    var _this = this;
    if (item) {
        var form = $('#' + this.type + '-form');
        form.find('input[name="item-id"]').val(id);
        $.map(item, function (val, key) {
            switch (key) {
                case "current":
                    if (val === 1) {
                        form.find('*[name="' + key + '"]').prop('checked', true);
                    }
                    break;
                case 'level':
                    form.find("#" + _this.name + "-slider-range-min").slider("value", val);
                    form.find("#" + _this.name + "-slider-amount").html(form.find("#" + _this.name + "-slider-range-min").slider("value") + "%");
                    break;
                case "city":
                    form.find('*[name="location"]').val(val);
                    break;
                default:
                    form.find('*[name="' + key + '"]').val(val);
                    break;
            }
        });
        if (this.name === 'education' || this.name === 'experience') {
            var location = item.city;
            if (item.region) {
                location += "," + item.region;
            }
            if (item.country) {
                location += "," + item.country;
            }
            form.find('*[name="city"]').val(location);
            var flag = $('#' + this.name + '-addon1');
            flag.find('i').removeClassRegex(/^bfh-flag-/);
            flag.find('i').addClass('bfh-flag-' + item.country_code);

            if (item.industry_id) {
                _this.msIndustryValue = item.industry_id;
                _this.msIndustry.setValue([item.industry_id]);
                var sub = (item.sub_industry_id) ? item.sub_industry_id : null;
                _this.getIndustries(item.industry_id, sub);
            }
            if (item.assign_title) {
                _this.msJobSubCategory.setSelection(item.assign_title);
            }
            if (item.assign_company) {
                _this.msCompany.setSelection(item.assign_company);
            }

            if (item.assign_grade) {
                _this.msGrade.setSelection(item.assign_grade);
            }
            if (item.assign_degree) {
                _this.msDegree.setSelection(item.assign_degree);
            }
            if (item.assign_study) {
                _this.msStudy.setSelection(item.assign_study);
            }
        } else {
            if (item.assign_title) {
                switch (_this.name) {
                    case 'skill':
                        _this.msSkillTitle.setSelection(item.assign_title);
                        break;
                    case 'language':
                        _this.msLanguageTitle.setSelection(item.assign_title);
                        break;
                    case 'certification':
                        _this.msCertificateTitle.setSelection(item.assign_title);
                        break;
                    case 'distinction':
                        _this.msDistinctionTitle.setSelection(item.assign_title);
                        break;
                    case 'hobby':
                        _this.msHobbyTitle.setSelection(item.assign_title);
                        break;
                    case 'interest':
                        _this.msInterestTitle.setSelection(item.assign_title);
                        break;
                    case 'reference':
                        break;
                }
            }
        }

    }
};
ResumeInfo.prototype.update = function () {
    //show confirm popup
    var editModal = $('#' + this.editModal);
    var saveModal = $('#' + this.confirmModal);
    var _this = this;
    editModal.modal('hide');
    editModal.on('hidden.bs.modal', function () {
        saveModal.modal('show');
        $(this).unbind();
    });

    var confirmEditButton = $('#' + this.type + '-confirm-edit');
    confirmEditButton.unbind();
    confirmEditButton.click(function () {
        saveModal.modal('hide');
        _this.save();
    });

    var cancelButton = $('#' + this.type + '-confirm-edit-cancel');
    cancelButton.unbind();
    cancelButton.click(function () {
        saveModal.on('hidden.bs.modal', function () {
            editModal.modal('show');
            $(this).unbind();
        });
    });
};
ResumeInfo.prototype.delete = function (id) {
    //show confirm popup
    var deleteModal = $('#' + this.deleteModal);
    deleteModal.modal('show');
    var type = this.type;
    var method = this.method;
    var name = this.name;
    var deleteButton = $('#' + this.type + '-confirm-delete');
    deleteButton.unbind();
    deleteButton.click(function () {
        deleteModal.modal('hide');
        $('.items-list[data-type-item="' + type + '"]').find('.item-row[data-id="' + id + '"]').remove();
        //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
        new GraphQL("mutation", "delete" + method, {
            "id": id
        }, ['token'], true, false, function () {
            Loader.stop();
        }, function () {
            var index = findObjectIndexByKey(builder[name], 'id', id);
            builder[name].splice(index, 1);
            if (builder[name].length === 0) {
                $('#resume-not-' + name).removeClass('hide');
            }
        }, false).request();
    });

};
ResumeInfo.prototype.autocompleteField = function (typeName)
{
    var _this = this;
    typeName = typeName || _this.name;
    _this.nameType = typeName;

    switch (typeName) {
        case 'skill':
            _this.getMSList(function (items, defaultData) {
                _this.msSkillTitle = _this.msSkillTitleElement.magicSuggest({
                    placeholder: trans('resume-builder-title.skill'),
                    maxSelection: 1,
                    maxSelectionRenderer: function () {
                        return trans('jack_max_1');
                    },
                    toggleOnClick: true,
                    //expandOnFocus: true,
                    allowFreeEntries: true,
                    data: items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                    cls: 'jack input_style'
                });
                if (defaultData) {
                    _this.msSkillTitle.setSelection(defaultData);
                }
                var timeout = null;
                $(_this.msSkillTitle).on('keyup focus', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this.msSkillTitle.setData(items);
                        }, 'autocompleteResume', _this.msSkillTitleElement, _this.msSkillTitle.getRawValue());
                    }, 500);
                });
            }, 'autocompleteResume', _this.msSkillTitleElement);
            setTimeout(function () {
                $('#skill-title input').attr('name','title');
            },3000);
            break;
        case 'language':
            _this.getMSList(function (items, defaultData) {
                _this.msLanguageTitle = _this.msLanguageTitleElement.magicSuggest({
                    placeholder: trans('resume-builder-title.language'),
                    maxSelection: 1,
                    maxSelectionRenderer: function () {
                        return trans('jack_max_1');
                    },
                    toggleOnClick: true,
                    allowFreeEntries: false,
                    data: items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                    cls: 'jack input_style'
                });
                if (defaultData) {
                    _this.msLanguageTitle.setSelection(defaultData);
                }
                var timeout = null;
                $(_this.msLanguageTitle).on('keyup focus', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this.msLanguageTitle.setData(items);
                        }, 'autocompleteResume', _this.msLanguageTitleElement, _this.msLanguageTitle.getRawValue());
                    }, 500);
                });
            }, 'autocompleteResume', _this.msLanguageTitleElement);
            setTimeout(function () {
                $('#language-title input').attr('name','title');
            },3000);
            break;
        case 'certification':
            _this.getMSList(function (items, defaultData) {
                _this.msCertificateTitle = _this.msCertificateTitleElement.magicSuggest({
                    placeholder: trans('resume-builder-title.certificate'),
                    maxSelection: 1,
                    maxSelectionRenderer: function () {
                        return trans('jack_max_1');
                    },
                    toggleOnClick: true,
                    allowFreeEntries: true,
                    data: items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                    cls: 'jack input_style'
                });
                if (defaultData) {
                    _this.msCertificateTitle.setSelection(defaultData);
                }
                var timeout = null;
                $(_this.msCertificateTitle).on('keyup focus', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this.msCertificateTitle.setData(items);
                        }, 'autocompleteResume', _this.msCertificateTitleElement, _this.msCertificateTitle.getRawValue());
                    }, 500);
                });
            }, 'autocompleteResume', _this.msCertificateTitleElement);
            setTimeout(function () {
                $('#certificate-title input').attr('name','title');
            },3000);
            break;
        case 'distinction':
            _this.getMSList(function (items, defaultData) {
                _this.msDistinctionTitle = _this.msDistinctionTitleElement.magicSuggest({
                    placeholder: trans('resume-builder-title.distinction'),
                    maxSelection: 1,
                    maxSelectionRenderer: function () {
                        return trans('jack_max_1');
                    },
                    toggleOnClick: true,
                    allowFreeEntries: true,
                    data: items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                    cls: 'jack input_style'
                });
                if (defaultData) {
                    _this.msDistinctionTitle.setSelection(defaultData);
                }
                var timeout = null;
                $(_this.msDistinctionTitle).on('keyup focus', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this.msDistinctionTitle.setData(items);
                        }, 'autocompleteResume', _this.msDistinctionTitleElement, _this.msDistinctionTitle.getRawValue());
                    }, 500);
                });
            }, 'autocompleteResume', _this.msDistinctionTitleElement);
            setTimeout(function () {
                $('#distinction-title input').attr('name','title');
            },3000);
            break;
        case 'hobby':
            _this.getMSList(function (items, defaultData) {
                _this.msHobbyTitle = _this.msHobbyTitleElement.magicSuggest({
                    placeholder: trans('resume-builder-title.hobby'),
                    maxSelection: 1,
                    maxSelectionRenderer: function () {
                        return trans('jack_max_1');
                    },
                    toggleOnClick: true,
                    allowFreeEntries: true,
                    data: items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                    cls: 'jack input_style'
                });
                if (defaultData) {
                    _this.msHobbyTitle.setSelection(defaultData);
                }
                var timeout = null;
                $(_this.msHobbyTitle).on('keyup focus', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this.msHobbyTitle.setData(items);
                        }, 'autocompleteResume', _this.msHobbyTitleElement, _this.msHobbyTitle.getRawValue());
                    }, 500);
                });
            }, 'autocompleteResume', _this.msHobbyTitleElement);
            setTimeout(function () {
                $('#hobby-title input').attr('name','title');
            },3000);
            break;
        case 'interest':
            _this.getMSList(function (items, defaultData) {
                _this.msInterestTitle = _this.msInterestTitleElement.magicSuggest({
                    placeholder: trans('resume-builder-title.interest'),
                    maxSelection: 1,
                    maxSelectionRenderer: function () {
                        return trans('jack_max_1');
                    },
                    toggleOnClick: true,
                    allowFreeEntries: true,
                    data: items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                    cls: 'jack input_style'
                });
                if (defaultData) {
                    _this.msInterestTitle.setSelection(defaultData);
                }
                var timeout = null;
                $(_this.msInterestTitle).on('keyup focus', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this.msInterestTitle.setData(items);
                        }, 'autocompleteResume', _this.msInterestTitleElement, _this.msInterestTitle.getRawValue());
                    }, 500);
                });
            }, 'autocompleteResume', _this.msInterestTitleElement);
            setTimeout(function () {
                $('#interest-title input').attr('name','title');
            },3000);
            break;
        case 'reference':
            break;
        case 'company':
            _this.getMSList(function (items, defaultData) {
                _this.msCompany = _this.msCompanyElement.magicSuggest({
                    placeholder: trans('resume-builder-title.company'),
                    maxSelection: 1,
                    maxSelectionRenderer: function () {
                        return trans('jack_max_1');
                    },
                    toggleOnClick: true,
                    allowFreeEntries: true,
                    data: items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                    cls: 'jack input_style'
                });
                if (defaultData) {
                    _this.msCompany.setSelection(defaultData);
                }
                var timeout = null;
                $(_this.msCompany).on('keyup focus', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this.msCompany.setData(items);
                        }, 'autocompleteResume', _this.msCompanyElement, _this.msCompany.getRawValue());
                    }, 500);
                });
            }, 'autocompleteResume', _this.msCompanyElement);
            setTimeout(function () {
                $('#experience-company input').attr('name','company');
            },3000);
            break;
        case 'grade':
            _this.getMSList(function (items, defaultData) {
                _this.msGrade = _this.msGradeElement.magicSuggest({
                    placeholder: trans('resume-builder-title.grade'),
                    maxSelection: 1,
                    maxSelectionRenderer: function () {
                        return trans('jack_max_1');
                    },
                    toggleOnClick: true,
                    allowFreeEntries: false,
                    data: items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                    cls: 'jack input_style'
                });
                if (defaultData) {
                    _this.msGrade.setSelection(defaultData);
                }
                var timeout = null;
                $(_this.msGrade).on('keyup focus', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this.msGrade.setData(items);
                        }, 'autocompleteResume', _this.msGradeElement, _this.msGrade.getRawValue(),undefined,undefined,'grade');
                    }, 500);
                });
            }, 'autocompleteResume', _this.msGradeElement);
            setTimeout(function () {
                $('#education-grade input').attr('name','grade');
            },3000);
            break;
        case 'degree':
            _this.getMSList(function (items, defaultData) {
                _this.msDegree = _this.msDegreeElement.magicSuggest({
                    placeholder: trans('resume-builder-title.degree'),
                    maxSelection: 1,
                    maxSelectionRenderer: function () {
                        return trans('jack_max_1');
                    },
                    toggleOnClick: true,
                    allowFreeEntries: true,
                    data: items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                    cls: 'jack input_style'
                });
                if (defaultData) {
                    _this.msDegree.setSelection(defaultData);
                }
                var timeout = null;
                $(_this.msDegree).on('keyup focus', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this.msDegree.setData(items);
                        }, 'autocompleteResume', _this.msDegreeElement, _this.msDegree.getRawValue(),undefined,undefined,'degree');
                    }, 500);
                });
            }, 'autocompleteResume', _this.msDegreeElement);
            setTimeout(function () {
                $('#education-degree input').attr('name','degree');
            },3000);
            break;
        case 'study':
            _this.getMSList(function (items, defaultData) {
                _this.msStudy = _this.msStudyElement.magicSuggest({
                    placeholder: trans('resume-builder-title.study'),
                    maxSelection: 1,
                    maxSelectionRenderer: function () {
                        return trans('jack_max_1');
                    },
                    toggleOnClick: true,
                    allowFreeEntries: true,
                    data: items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                    cls: 'jack input_style'
                });
                if (defaultData) {
                    _this.msStudy.setSelection(defaultData);
                }
                var timeout = null;
                $(_this.msStudy).on('keyup focus', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this.msStudy.setData(items);
                        }, 'autocompleteResume', _this.msStudyElement, _this.msStudy.getRawValue(),undefined,undefined,'study');
                    }, 500);
                });
            }, 'autocompleteResume', _this.msStudyElement);
            setTimeout(function () {
                $('#education-study input').attr('name','study');
            },3000);
            break;
    }
    /*
    var fieldAutocomplete = elemInput,
        typeAutocomplete = type || elemInput.attr('name');
    fieldAutocomplete.autocomplete({
        source: function (request, response) {
            new GraphQL("query", "autocompleteResume", {
                "type": typeAutocomplete,
                "key": request.term
            }, [
                'id',
                'title'
            ], false, false, function () {
                response([]);
            }, function (data) {
                if (data.length !== 0) {
                    var transformed = $.map(data, function (el) {
                        return {
                            label: el.title,
                            id: el.id,
                            data: el
                        };
                    });
                    response(transformed);
                } else {
                    response([]);
                    fieldAutocomplete.removeClass('ui-autocomplete-loading');
                }
            }).autocomplete();
        },
        response: function (e, u) {
            fieldAutocomplete.removeClass('ui-autocomplete-loading');
        }
    });
    */
};