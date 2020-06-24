function Search(type, typeItems) {
    this.type = type;
    this.typeItems = typeItems;

    this.msDepartments;
    this.msDepartmentsElement = $('#department');
    this.msJobTypes;
    this.msJobTypesElement = $('#job_types');
    this.msCareerLevel;
    this.msCareerLevelElement = $('#career_level');
    this.msLanguages;
    this.msLanguagesElement = $('#languages');
    this.msCertificates;
    this.msCertificatesElement = $('#certification');
    this.msKeywords;
    this.msKeywordsElement = $('#a_keywords');

    this.sortElement = $('#items-sort');

    this.perPage = 25;
    this.countPages = 1;
    this.currentPage = 1;
    this.sort;
    this.order;
    this.assigmentData = {};
    this.loadLocationsData = {};

    this.loadFilters = 0;

    this.assignLocations = {};
    this.jobs = {};

    this.msCategory;
    this.msCategoryValue = null;

    this.msIndustry;
    this.msIndustryValue = null;

    this.industries;
    this.categories;
    this.searchForm = $('#search-form');
    this.searchTitleBox = $('#title-box');
    this.searchLocationBox = $('#location-box');
    this.searchButtonBox = $('#button-box');
    this.searchTitle = this.searchForm.find('input[name="title"]');
    this.searchLocation = this.searchForm.find('input[name="location"]');
    this.searchButton = this.searchForm.find('#search-button');

    this.modalAllItems = $('#catInModal');
    this.modalType = "categories";
}

Search.prototype = {
    init: function () {
        var _this = this;

        var body = $('body');

        $('#items-limit').on('change', function () {
            var limit = $(this).val();
            updateQueryStringParam('limit', limit);
            _this.perPage = +limit;
            _this.currentPage = 1;
            setTimeout(function () {
                updateQueryStringParam('page', _this.currentPage);
                location.reload();
            }, 50);
        });
        //set sort & order for items
        this.sortElement.change(function () {
            // _this.sort = $(this).val();
            updateQueryStringParam('sort', $(this).val());
            // _this.order = $(this).find('option:selected').attr('data-order');
            updateQueryStringParam('order', $(this).find('option:selected').attr('data-order'));
            _this.currentPage = 1;
            setTimeout(function () {
                location.reload();
            }, 50);
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

        this.searchButton.on('click', function () {
            var url = _this.setParams();
            window.location.href = url;
        });

        _this.searchTitle.focus(function () {
            _this.searchTitleBox.find('.form-control').addClass('focused');
            _this.searchLocationBox.find('.form-control').removeClass('focused');

            _this.searchTitleBox.removeClass('col-5').addClass('col-7');
            _this.searchLocationBox.removeClass('col-5').addClass('col-3');
        }).focusout(function () {
            _this.searchTitleBox.find('.form-control').removeClass('focused');

            _this.searchTitleBox.removeClass('col-7').addClass('col-5');
            _this.searchLocationBox.removeClass('col-3').addClass('col-5');
        });

        _this.searchLocation.focus(function () {
            _this.searchLocationBox.find('.form-control').addClass('focused');
            _this.searchTitleBox.find('.form-control').removeClass('focused');

            _this.searchTitleBox.removeClass('col-5').addClass('col-3');
            _this.searchLocationBox.removeClass('col-5').addClass('col-7');
        }).focusout(function () {
            _this.searchLocationBox.find('.form-control').removeClass('focused');

            _this.searchTitleBox.removeClass('col-3').addClass('col-5');
            _this.searchLocationBox.removeClass('col-7').addClass('col-5');
        });

        $('.popular_industries, .amenities').on('click', function () {
            $(this).toggleClass("active");
        });

        $('.add-filter').on('click', function () {
            var url = _this.setParams($(this).attr('data-filter'), $(this).attr('data-id'));
            url = _this.removeStringParam(url, 'page');
            url = _this.removeStringParam(url, 'sort');
            url = _this.removeStringParam(url, 'order');
            window.location.href = url;
        });

        $('.remove-filter').on('click', function () {
            var url = _this.removeStringParam(false, $(this).attr('data-filter'), $(this).attr('data-id'));
            url = _this.removeStringParam(url, 'page');
            url = _this.removeStringParam(url, 'sort');
            url = _this.removeStringParam(url, 'order');
            window.location.href = url;
        });

        $('.remove-all-filter').on('click', function () {
            var url = "";
            if ($(this).attr('data-filter') === "times") {
                url = _this.removeStringParam(false, "time_1");
                url = _this.removeStringParam(url, "time_2");
                url = _this.removeStringParam(url, "time_3");
                url = _this.removeStringParam(url, "time_4");
            } else {
                url = _this.removeStringParam(false, $(this).attr('data-filter'));
            }
            url = _this.removeStringParam(url, 'page');
            url = _this.removeStringParam(url, 'sort');
            url = _this.removeStringParam(url, 'order');
            window.location.href = url;
        });

        $('.clear-all-filter').on('click', function () {
            var title = getUrlParameter('title');
            var location = getUrlParameter('location');
            window.location.href = "/search/" + _this.typeItems + "?title=" + title + "&location=" + location;
        });

        body.on('click', '.view-job-link', function () {
            var id = $(this).attr('data-id');
            if (_this.assignLocations[id]) {
                if (_this.assignLocations[id].length > 1) {
                    _this.getLocationsList(id);
                    return false;
                } else {
                    if (_this.assignLocations[id].length > 0) {
                        window.location.href = '/map/view/job/' + _this.assignLocations[id][0].job_id;
                    }
                }
            }

            return true;
        });

        $('.add-filter-ms').on('click', function () {
            var msType = $(this).attr('data-filter');
            switch (msType) {
                case 'categories':
                    var v = {
                        id: $(this).attr('data-id'),
                        name: $(this).text()
                    };
                    if (_this.msCategory) {
                        _this.msCategory.addToSelection(v);
                    }
                    break;
                case 'popular_industries':
                    var v = {
                        id: $(this).attr('data-id'),
                        name: $(this).text()
                    };
                    if (_this.msIndustry) {
                        _this.msIndustry.addToSelection(v);
                    }
                    break;
                case 'keywords':
                    var v = {
                        id: $(this).attr('data-id'),
                        name: $(this).text()
                    };
                    if (_this.msKeywords) {
                        _this.msKeywords.addToSelection(v);
                    }
                    break;
            }
        });

        $('.see-all').on('click', function () {
            var type = $(this).attr('data-id');
            var query = "categories";
            var items = _this.categories;
            var title = Langs.categories;
            var defaultItems = [];
            _this.modalType = type;
            switch (type) {
                case 'categories':
                    if (_this.msCategory) {
                        defaultItems = $.map(_this.msCategory.getSelection(), function (item) {
                            return item.id;
                        });
                    } else {
                        defaultItems = getUrlParameter(type).split(",");
                    }
                    break;
                case 'popular_industries':
                    query = "industries";
                    items = _this.industries;
                    title = Langs.industries;
                    if (_this.msIndustry) {
                        defaultItems = $.map(_this.msIndustry.getSelection(), function (item) {
                            return item.id;
                        });
                    } else {
                        defaultItems = getUrlParameter(type).split(",");
                    }
                    break;
            }
            _this.modalAllItems.find('.modal-title').text(title);
            if (items) {
                var html = _this.modalItems(items, defaultItems);
                _this.modalAllItems.find('.modal-body .row').html(html);
                _this.modalAllItems.modal('show');
            } else {
                new GraphQL("query", query, {}, [
                    'id',
                    'name'
                ], false, false, function () {
                    Loader.stop();
                }, function (data) {
                    if (data) {
                        var html = _this.modalItems(data, cat);
                        _this.modalAllItems.find('.modal-body .row').html(html);
                        _this.modalAllItems.modal('show');
                    }
                }).request(select, false, false);
            }
        });

        $('#modal-items-accept').on('click', function () {
            var items = [];
            $.each(_this.modalAllItems.find('input[type="checkbox"]:checked'), function () {
                var id = $(this).val();
                var name = $(this).parent().parent().parent().find('.coll_name strong').text();
                items.push({
                    id: id,
                    name: name
                });
            });
            switch (_this.modalType) {
                case 'categories':
                    _this.msCategory.setSelection(items);
                    break;
                case 'popular_industries':
                    _this.msIndustry.setSelection(items);
                    break;
            }
            _this.modalAllItems.modal('hide');
        });

        _this.getJobTitleCategory();
        _this.getLocation();
        _this.msFields(true);


        $('#show_hide-blocks-search').click(function () {
            $('#block-basic-search').hide();
            $('#block-advanced-search').show();

        });

    },
    modalItems: function (items, defaultValues) {
        var html = '';
        $.map(items, function (item) {
            var checked = '';
            if ($.inArray(item.id, defaultValues) !== -1) {
                checked = 'checked';
            }
            html += '<div class="col-md-6 modal-items">\n' +
                '            <div class="row">\n' +
                '                <div class="col-md-1">\n' +
                '                    <label class="custom-control custom-checkbox m-0 pl-3">\n' +
                '                        <input type="checkbox"\n' +
                '                               class="custom-control-input location-item " ' + checked + ' value="' + item.id + '">\n' +
                '                        <span class="custom-control-indicator"></span>\n' +
                '                    </label>\n' +
                '                </div>\n' +
                '                <div class="col-md-10">\n' +
                '                    <div class="row">\n' +
                '                        <div class="col-md-12">\n' +
                '                            <p class="my-0 px-3 coll_name"><strong>' + item.name + '</strong></p>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '            </div>\n' +
                '        </div>';
        });

        return html;
    },
    getLocationsList: function (id) {
        var _this = this;
        var modal = $('#modal-job-locations-list');

        var html = '';
        if (_this.assignLocations[id]) {
            $.map(_this.assignLocations[id], function (item) {
                html += '<div class="d-flex align-items-center justify-content-between mb-3">\n' +
                    '    <div class="d-inline-flex align-items-center mr-2" style="flex: 1">\n' +
                    '        <div class="rounded p-1 bg-white d-inline-block mr-2"\n' +
                    '             style="box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);">\n' +
                    '            <img class="location-pic" src="' + item.business.picture_50 + '" style="width:50px; height:50px;">\n' +
                    '        </div>\n' +
                    '        <h6 class="h6 mb-0">' + item.name + '</a></h6>\n' +
                    '    </div>\n' +
                    '    <div class="d-inline-flex align-items-center">\n' +
                    '        <p class="mb-0 mr-2"><a href="/map/view/job/' + item.job_id + '">'+Langs.view_job+'</a></p>\n' +
                    '    </div>\n' +
                    '</div>';
            });
        }
        $('#modal-job-name').text(_this.jobs[id]);
        modal.find('#count-job-locations span').text(_this.assignLocations[id].length);
        modal.find('.modal-body').html(html);
        modal.modal('show');
    },
    removeStringParam: function (url, key, value) {
        var _this = this;
        var urlValue = (url) ? url : this.searchForm.attr('action');

        if (value && key !== value) {
            var item = getUrlParameter(key);
            var items = item.split(",");
            if (items.length > 1) {
                var newItems = '';
                $.each(items, function (k, v) {
                    if (v !== value) {
                        newItems += v + ",";
                    }
                });
                newItems = newItems.slice(0, -1);
                return _this.updateStringParam(false, key, newItems);
            }
        }
        //Get query string value
        var searchUrl = this.searchForm.attr('action');

        if (key != "") {
            var oldValue = getUrlParameter(key);
            var removeVal = key + "=" + oldValue;
            if (searchUrl.indexOf('?' + removeVal + '&') != "-1") {
                urlValue = urlValue.replace('?' + removeVal + '&', '?');
            }
            else if (searchUrl.indexOf('&' + removeVal + '&') != "-1") {
                urlValue = urlValue.replace('&' + removeVal + '&', '&');
            }
            else if (searchUrl.indexOf('?' + removeVal) != "-1") {
                urlValue = urlValue.replace('?' + removeVal, '');
            }
            else if (searchUrl.indexOf('&' + removeVal) != "-1") {
                urlValue = urlValue.replace('&' + removeVal, '');
            }
        }
        return urlValue;
    },
    updateStringParam: function (url, key, value, add) {
        if (key) {
            var urlQueryString = (url) ? url : this.searchForm.attr('action'),
                newParam = key + '=' + value,
                params = '?' + newParam;

            // If the "search" string exists, then build params from it
            if (urlQueryString) {
                var keyRegex = new RegExp('([\?&])' + key + '[^&]*');

                // If param exists already, update it
                if (urlQueryString.match(keyRegex) !== null) {
                    if (add) {
                        var addParam = key + '=' + getUrlParameter(key) + "," + value;
                        params = urlQueryString.replace(keyRegex, "$1" + addParam);
                    } else {
                        params = urlQueryString.replace(keyRegex, "$1" + newParam);
                    }
                } else { // Otherwise, add it to end of query string
                    params = urlQueryString + '&' + newParam;
                }
            }

            return params;
        }
    },
    setParams: function (key, value) {
        var _this = this;

        var url = _this.searchForm.attr('action');
        if (_this.searchTitle.val().length !== 0) {
            url = _this.updateStringParam(url, 'title', _this.searchTitle.val());
        } else {
            url = _this.updateStringParam(url, 'title', '');
        }
        if (_this.searchLocation.val().length !== 0) {
            url = _this.updateStringParam(url, 'location', _this.searchLocation.val());
        } else {
            url = _this.updateStringParam(url, 'location', '');
        }
        switch (_this.type) {
            case 'basic':
                break;
            case 'advanced':
                var checkItems = ['career_status', 'work_status', 'job_status', 'options'];
                $.map(checkItems, function (item) {
                    var array = [];
                    $("input:checkbox[name=" + item + "]:checked").each(function () {
                        array.push($(this).val());
                    });
                    var str = array.join(",");
                    if (str.length !== 0) {
                        url = _this.updateStringParam(url, item, str);
                    } else {
                        url = _this.removeStringParam(url, item);
                    }
                });

                for (var i = 1; i <= 4; i++) {
                    var timeArray = [];
                    $("input:checkbox[name=time_" + i + "]:checked").each(function () {
                        timeArray.push($(this).val());
                    });
                    var time = timeArray.join(",");
                    if (time.length !== 0) {
                        url = _this.updateStringParam(url, "time_" + i, time);
                    } else {
                        url = _this.removeStringParam(url, "time_" + i);
                    }
                }

                if (FormValidate.getFieldValue('hours', _this.searchForm).length !== 0) {
                    url = _this.updateStringParam(url, 'hours', FormValidate.getFieldValue('hours', _this.searchForm));
                } else {
                    url = _this.removeStringParam(url, 'hours');
                }

                var buttonItems = ['popular_industries', 'amenities'];
                $.map(buttonItems, function (item) {
                    var array = [];
                    $("." + item + ".active").each(function () {
                        array.push($(this).attr('data-id'));
                    });
                    var str = array.join(",");
                    if (str.length !== 0) {
                        url = _this.updateStringParam(url, item, str);
                    } else {
                        url = _this.removeStringParam(url, item);
                    }
                });

                var types = "";
                if (this.msJobTypes) {
                    types = $.map(this.msJobTypes.getSelection(), function (item) {
                        return item.id;
                    }).join(',');
                }
                if (types.length !== 0) {
                    url = _this.updateStringParam(url, 'types', types);
                } else {
                    url = _this.removeStringParam(url, 'types');
                }
                var languages = "";
                if (this.msLanguages) {
                    languages = $.map(this.msLanguages.getSelection(), function (item) {
                        return item.id;
                    }).join(',');
                }
                if (languages.length !== 0) {
                    url = _this.updateStringParam(url, 'languages', languages);
                } else {
                    url = _this.removeStringParam(url, 'languages');
                }
                var certifications = "";
                if (this.msCertificates) {
                    certifications = $.map(this.msCertificates.getSelection(), function (item) {
                        return item.id;
                    }).join(',');
                }
                if (certifications.length !== 0) {
                    url = _this.updateStringParam(url, 'certifications', certifications);
                } else {
                    url = _this.removeStringParam(url, 'certifications');
                }
                var departments = "";
                if (this.msDepartments) {
                    departments = $.map(this.msDepartments.getSelection(), function (item) {
                        return item.id;
                    }).join(',');
                }
                if (departments.length !== 0) {
                    url = _this.updateStringParam(url, 'departments', departments);
                } else {
                    url = _this.removeStringParam(url, 'departments');
                }
                var categories = "";
                if (this.msCategory) {
                    categories = $.map(this.msCategory.getSelection(), function (item) {
                        return item.id;
                    }).join(',');
                }
                if (categories.length !== 0) {
                    url = _this.updateStringParam(url, 'categories', categories);
                } else {
                    url = _this.removeStringParam(url, 'categories');
                }
                break;
            case 'search':
                if (key && value) {
                    url = _this.updateStringParam(url, key, value, true);
                }
                var categories = "";
                if (this.msCategory) {
                    categories = $.map(this.msCategory.getSelection(), function (item) {
                        return item.id;
                    }).join(',');
                }
                if (categories.length !== 0) {
                    url = _this.updateStringParam(url, 'categories', categories);
                } else {
                    url = _this.removeStringParam(url, 'categories');
                }
                var industries = "";
                if (this.msIndustry) {
                    industries = $.map(this.msIndustry.getSelection(), function (item) {
                        return item.id;
                    }).join(',');
                }
                if (industries.length !== 0) {
                    url = _this.updateStringParam(url, 'popular_industries', industries);
                } else {
                    url = _this.removeStringParam(url, 'popular_industries');
                }
                var keywords = "";
                if (this.msKeywords) {
                    keywords = $.map(this.msKeywords.getSelection(), function (item) {
                        return item.id;
                    }).join(',');
                }
                if (keywords.length !== 0) {
                    url = _this.updateStringParam(url, 'a_keywords', keywords);
                } else {
                    url = _this.removeStringParam(url, 'a_keywords');
                }
                if($('#openned:checked').length !== 0){
                    url = _this.updateStringParam(url, 'job_status', 1);
                } else {
                    url = _this.removeStringParam(url, 'job_status');
                }
                break;
        }

        return url;
    },
    setDefaultAvailabilities: function (n, info) {
        var time = info.split(",");
        var i = 1;
        $.each(time, function (k, v) {
            $('input[name="time_' + n + '"][value="' + v + '"]').prop('checked', true);
            i += 1;
        });
        if (time.length === 7) {
            $('#user-availabilities').find('input[data-time="' + (n - 1) + '"]').prop('checked', true);
        }
    },
    msFields: function (filters) {
        var _this = this;

        var body = $('body');

        var departments;
        var types;
        var careers;
        var certifications;
        var languages;
        var categories;
        var industries;
        var keywords;
        var jobStatus;
        switch (_this.type) {
            case 'advanced':
                for (var i = 1; i <= 4; i++) {
                    if (getUrlParameter('time_' + i)) {
                        _this.setDefaultAvailabilities(i, getUrlParameter('time_' + i));
                    }
                }
                var checkItems = ['career_status', 'work_status', 'job_status', 'options'];
                $.map(checkItems, function (item) {
                    if (getUrlParameter(item)) {
                        var params = getUrlParameter(item).split(",");
                        $.each(params, function (k, v) {
                            $('input[name="' + item + '"][value="' + v + '"]').prop('checked', true).parent().addClass('active');
                        });
                    }
                });
                var buttonItems = ['popular_industries', 'amenities'];
                $.map(buttonItems, function (item) {
                    if (getUrlParameter(item)) {
                        var params = getUrlParameter(item).split(",");
                        $.each(params, function (k, v) {
                            $('.' + item + '[data-id="' + v + '"]').addClass('active');
                        });
                    }
                });
                departments = getUrlParameter('departments');
                types = getUrlParameter('types');
                careers = getUrlParameter('careers');
                certifications = getUrlParameter('certifications');
                languages = getUrlParameter('languages');
                categories = getUrlParameter('categories');
                break;
            case 'search':
                categories = getUrlParameter('categories');
                industries = getUrlParameter('popular_industries');
                keywords = getUrlParameter('a_keywords');
                jobStatus = getUrlParameter('job_status');
                break;
        }

        if(jobStatus){
            $('#openned').prop('checked', true);
        }

        if (categories) {
            _this.getCategory(true, categories);
        } else {
            _this.getCategory();
        }

        if (industries) {
            _this.getIndustry(true, industries);
        } else {
            _this.getIndustry();
        }

        var params = {
            "limit": 0
        };
        if (departments) {
            params['default'] = departments;
        }
        new GraphQL("query", "businessDepartments", params, ['items{id name}, default {id name}'], false, false, function (data) {
            //show error
        }, function (data) {
            if (data.items) {
                _this.msDepartments = _this.msDepartmentsElement.magicSuggest({
                    placeholder: Langs.choose_departments,
                    toggleOnClick: true,
                    allowFreeEntries: false,
                    data: data.items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                    cls: 'jack'
                });
            }
            if (data.default) {
                _this.msDepartments.setSelection(data.default);
            }
        }).request(_this.msDepartmentsElement);


        if (_this.type === 'advanced') {
            this.getMSList(function (items, defaultData) {
                _this.msJobTypes = _this.msJobTypesElement.magicSuggest({
                    placeholder: Langs.type_job_type,
                    toggleOnClick: true,
                    allowFreeEntries: false,
                    data: items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                    cls: 'jack'
                });
                if (defaultData) {
                    _this.msJobTypes.setSelection(defaultData);
                }
                var timeout = null;
                $(_this.msJobTypes).on('keyup', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this.msJobTypes.setData(items);
                        }, 'jobTypes', _this.msJobTypesElement, _this.msJobTypes.getRawValue());
                    }, 500);
                });
            }, 'jobTypes', _this.msJobTypesElement, undefined, types);

            this.getMSList(function (items, defaultData) {
                _this.msCareerLevel = _this.msCareerLevelElement.magicSuggest({
                    placeholder: Langs.type_career_level,
                    toggleOnClick: true,
                    allowFreeEntries: false,
                    data: items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                    cls: 'jack'
                });
                if (defaultData) {
                    _this.msCareerLevel.setSelection(defaultData);
                }
                var timeout = null;
                $(_this.msCareerLevel).on('keyup', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this.msCareerLevel.setData(items);
                        }, 'careerLevels', _this.msCareerLevelElement, _this.msCareerLevel.getRawValue());
                    }, 500);
                });
            }, 'careerLevels', _this.msCareerLevelElement, undefined, careers);

            this.getMSList(function (items, defaultData) {
                _this.msLanguages = _this.msLanguagesElement.magicSuggest({
                    placeholder: Langs.type_language_level,
                    toggleOnClick: true,
                    allowFreeEntries: false,
                    data: items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                    cls: 'jack'
                });
                if (defaultData) {
                    _this.msLanguages.setSelection(defaultData);
                }
                var timeout = null;
                $(_this.msLanguages).on('keyup', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this.msLanguages.setData(items);
                        }, 'worldLanguages', _this.msLanguagesElement, _this.msLanguages.getRawValue());
                    }, 500);
                });
            }, 'worldLanguages', _this.msLanguagesElement, undefined, languages);

            this.getMSList(function (items, defaultData) {
                _this.msCertificates = _this.msCertificatesElement.magicSuggest({
                    placeholder: Langs.type_certificate,
                    toggleOnClick: true,
                    allowFreeEntries: false,
                    data: items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                    cls: 'jack'
                });
                if (defaultData) {
                    _this.msCertificates.setSelection(defaultData);
                }
                var timeout = null;
                $(_this.msCertificates).on('keyup', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this.msCertificates.setData(items);
                        }, 'certificates', _this.msCertificatesElement, _this.msCertificates.getRawValue());
                    }, 500);
                });
            }, 'certificates', _this.msCertificatesElement, undefined, certifications);
        } else if (_this.type === 'search') {
            this.getMSList(function (items, defaultData) {
                _this.msKeywords = _this.msKeywordsElement.magicSuggest({
                    placeholder: Langs.type_keywords,
                    toggleOnClick: false,
                    allowFreeEntries: false,
                    data: [],
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                    cls: 'jack'
                });
                if (defaultData) {
                    _this.msKeywords.setSelection(defaultData);
                }
                var timeout = null;
                $(_this.msKeywords).on('keyup', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this.msKeywords.setData(items);
                        }, 'keywords', _this.msKeywordsElement, _this.msKeywords.getRawValue());
                    }, 500);
                });
            }, 'keywords', _this.msKeywordsElement, undefined, keywords);
        }
    },
    getMSList: function (callback, method, el, keywords, defaultData) {
        var params = {};
        var need = ['items{id name}'];
        if (defaultData) {
            params['default'] = defaultData;
            need.push('default{id name}')
        }
        if (keywords) {
            if (keywords.length > 0) {
                params['keywords'] = keywords;
            }
        }
        if (APIStorage.read('language') != 'en') {
            params['locale'] = APIStorage.read('language');
        }
        new GraphQL("query", method, params, need, false, false, function (data) {
            //show error
        }, function (data) {
            if (data) {
                var items = $.map(data.items, function (item) {
                    return {
                        id: item.id,
                        name: item.name
                    };
                });
                callback(items, data.default);
            }
        }).request(el);
    },
    getJobTitleCategory: function () {
        var _this = this;

        _this.searchTitle.autocomplete({
            source: function (request, response) {
                var locale = APIStorage.read('language');
                new GraphQL("query", "getCategoriesJobsSearch", {
                    "locale": locale,
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
                        _this.searchTitle.removeClass('ui-autocomplete-loading');
                    }
                }).autocomplete();
            },
            select: function (event, ui) {
               updateQueryStringParam('title', ui.item.label);
                jobMap.filter();
            },
            response: function (e, u) {
                _this.searchTitle.removeClass('ui-autocomplete-loading');
            }
        }).attr('autocomplete', 'disabled');
    },
    getLocation: function () {
        var _this = this;

        _this.searchLocation.autocomplete({
            source: function (request, response) {
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
                        response([]);
                        _this.searchLocation.removeClass('ui-autocomplete-loading');
                    }
                }).autocomplete();
            },
            select: function (event, ui) {
                updateQueryStringParam('location', ui.item.label);
                jobMap.filter();
            },
            response: function (e, u) {
                _this.searchLocation.removeClass('ui-autocomplete-loading');
            }
        }).attr('autocomplete', 'disabled');
    },
    getCategory: function (sub, val, subVal) {
        if (jobMap) {
            return;
        }
        var _this = this;
        if (typeof val === 'string') {
            _this.msCategoryValue = explode(",", val);
        }
        var select = $('#categories');
        var params = {};
        new GraphQL("query", "categories", params, [
            'id',
            'name'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            if (data) {
                _this.categories = data;
                if (_this.msCategory) {
                    _this.msCategory.setData(data);
                } else {
                    _this.msCategory = select.magicSuggest({
                        placeholder: Langs.choose_categories,
                        toggleOnClick: true,
                        allowFreeEntries: false,
                        data: data,
                        required: true,
                        maxSelection: 30,
                        hideTrigger: true,
                        noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                        cls: 'jack input_style industries_box field-box'
                    });
                }
                if (val) {
                    var v = explode(",", val);
                    _this.msCategory.setValue(v);
                }
                var a = _this.msCategory;
                $(a).unbind('selectionchange');
                $(a).on('selectionchange', function () {
                    FormValidate.fieldValidateClear('#categories');
                    if (this.getValue().length !== 0) {
                        var id = this.getValue();
                        _this.msCategoryValue = id;
                    }
                });
                Loader.contentLoader = true;
                Loader.loaderToElement = select;
                Loader.stop();
            }
        }).request(select, false, false);
    },
    getIndustry: function (sub, val, subVal) {
        if (jobMap) {
            return;
        }
        var _this = this;
        if (typeof val === 'string') {
            _this.msIndustryValue = explode(",", val);
        }
        var select = $('#popular_industries');
        var params = {};
        new GraphQL("query", "industries", params, [
            'id',
            'name'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            if (data) {
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
                        maxSelection: 30,
                        hideTrigger: true,
                        noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                        cls: 'jack input_style industries_box field-box'
                    });
                }
                if (val) {
                    var v = explode(",", val);
                    _this.msIndustry.setValue(v);
                }
                var a = _this.msIndustry;
                $(a).unbind('selectionchange');
                $(a).on('selectionchange', function () {
                    FormValidate.fieldValidateClear('#categories');
                    if (this.getValue().length !== 0) {
                        var id = this.getValue();
                        _this.msIndustryValue = id;
                    }
                });
                Loader.contentLoader = true;
                Loader.loaderToElement = select;
                Loader.stop();
            }
        }).request(select, false, false);
    },
    setAssignLocations: function (data) {
        var _this = this;
        $.map(data.items, function (item) {
            if (_this.typeItems === 'jobs') {
                if (item.assign_locations) {
                    _this.assignLocations[item.id] = item.assign_locations;
                }
                _this.jobs[item.id] = item.title;
            }
        });
    }

};
