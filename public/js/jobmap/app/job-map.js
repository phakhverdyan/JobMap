function JobMap() {
    this.items;
    this.items_u;

    this.msDepartments;
    this.msDepartmentsElement = $('#departments');
    this.msJobTypes;
    this.msJobTypesElement = $('#job_types');
    this.msCareerLevel;
    this.msCareerLevelElement = $('#careers');
    this.msLanguages;
    this.msLanguagesElement = $('#languages');
    this.msCertificates;
    this.msCertificatesElement = $('#certifications');
    this.msKeywords;
    this.msKeywordsElement = $('#a_keywords');

    this.searchBusinessName = $('input[name="b_name"]');
    this.searchTitle = $('input[name="title"]');
    this.searchLocation = $('input[name="location"]');

    // Filters
    this.filterBar = $('#map-filters-search-bar');
    this.filterStatus = this.filterBar.find('select[name="status"]');
    this.filterType = this.filterBar.find('select[name="type"]');

    this.msLoad = 0;

    this.perPage = 25;
    this.countPages = 1;
    this.currentPage = 1;
    this.sortElement = $('#items-sort');
    this.limitElement = $('#items-limit');

    this.filterJobStatus;
    this.filterHoursFrom;
    this.filterHoursTo;

    this.msCategory;
    this.msCategoryValue = null;
    this.msCategoryElement = $('#categories');

    this.msSubCategory;
    this.msSubCategoryValue = null;
    this.msSubCategoryElement = $('#sub_categories');

    this.msIndustry;
    this.msIndustryValue = null;
    this.msIndustryElement = $('#popular_industries');

    this.industries;
    this.categories;
    this.sub_categories;

    this.map;

    //marker clusterer
    this.mc;
    this.markers = [];
    this.mcOptions = {
        gridSize: 20,
        maxZoom: 17,
        imagePath: "https://cdn.rawgit.com/googlemaps/v3-utility-library/master/markerclustererplus/images/m"
    };
    //create empty LatLngBounds object
    this.bounds;

    this.mapItems = [];

    this.modalAllItems = $('#catInModal');
    this.modalType = "categories";

    this.clearHours = false;
}

JobMap.prototype = {
    init: function () {
        var _this = this;

        var url = document.location.pathname;
        var urlData = explode('/', url);
        /*if(urlData[1]){
            if (urlData[1] !== 'cardinal') {
                $('#job-map, #job-filters').height($(window).height() - 70);
            }
        }*/

        this.limitElement.on('change', function () {
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


        $('body').on('click', '#location-more-info', function () {
            var id = $(this).attr('data-id');
            var slug = $(this).attr('data-slug');
            window.location.href = '/map/view/location/' + id + '/' + slug;
        });
        $('body').on('click', '#locations-more-info', function () {
            var id = $(this).attr('data-id');
            window.location.href = id;
        });

        var themeMap = APIStorage.read('map-theme');

        var options = {
            maxZoom: 19,
            zoom: 10,
            gestureHandling: 'greedy',
        };

        if (themeMap != null) {
            options.style = _this.getStyleThemeMap(themeMap);
        }

        _this.map = new google.maps.Map(document.getElementById('job-map'), options);

        _this.bounds = new google.maps.LatLngBounds();
        _this.mc = new MarkerClusterer(_this.map, [], _this.mcOptions);

        if (window.location.search.length !== 0) {
            if ($('.clear-filters-box').length === 0) {
                var html = '<div class="col-12 py-2 clear-filters-box" style="border-bottom:1px solid #e9ecef;">\n' +
                    '    <a href="javascript:void(0)" class="cardinal_links clear-all-filter"><img\n' +
                    '                src="/img/round-delete-button.svg"\n' +
                    '                style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;">\n' +
                    trans('clear_all_filters') + '        </a>\n' +
                    '</div>';
                $('.category_section').prepend(html);
            }
        }

        _this.filterStatus.on('change', function () {
            _this.filter();
        });

        _this.filterType.on('change', function () {
            _this.filter();
        });

        _this.searchBusinessName.on('change', function () {
            var value = $(this).val();
            if (value.length !== 0) {
                updateQueryStringParam('b_name', value);
            } else {
                removeQueryStringParam('b_name');
            }
            _this.filter();
        });
        _this.searchTitle.on('change', function () {
            var value = $(this).val();
            if (value.length !== 0) {
                updateQueryStringParam('title', value);
            } else {
                removeQueryStringParam('title');
            }
            _this.filter();
        });
        _this.searchLocation.on('change', function () {
            var value = $(this).val();
            if (value.length !== 0) {
                updateQueryStringParam('location', value);
            } else {
                removeQueryStringParam('location');
            }
            _this.filter();
        });

        $('body').on('click', '.add-filter', function () {
            var filter = $(this).attr('data-filter');
            var value = $(this).attr('data-id');
            var text = $(this).text();
            if (url = getUrlParameter(filter)) {
                var params = url.split(",");
                params.push(value);
                value = params.join(",");
            }
            var replaceHTML = '<a href="javascript:void(0)"\n' +
                '   class="cardinal_links remove-filter"\n' +
                '   data-filter="' + filter + '"\n' +
                '   data-id="' + $(this).attr('data-id') + '"> <img\n' +
                '            src="/img/round-delete-button.svg"\n' +
                '            style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>\n' +
                '<span class="cardinal_links active">' + text + '</span>';
            if ($(this).parents('.filter-group').find('.remove-all-filter:not(.in-filter)').length === 0) {
                var filterGroup = filter;
                if (filter === 'career_status' || filter === 'work_status' || filter === 'job_status') {
                    filterGroup = 'employers_data';
                }
                if (filter === 'time_1' || filter === 'time_2' || filter === 'time_3' || filter === 'time_4') {
                    filterGroup = 'times';
                }
                $(this).parents('.filter-group').prepend('<a href="javascript:void(0)"\n' +
                    '                               class="cardinal_links remove-all-filter"\n' +
                    '                               data-filter="' + filterGroup + '"> <img\n' +
                    '                                        src="/img/round-delete-button.svg"\n' +
                    '                                        style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>');
            }
            $(this).replaceWith(replaceHTML);
            updateQueryStringParam(filter, value);
            _this.filter();
        });

        $('body').on('click', '.remove-filter', function () {
            var filter = $(this).attr('data-filter');
            var value = $(this).attr('data-id');
            var text = $(this).next().text();
            var replaceHTML = '<a href="javascript:void(0)"\n' +
                'class="cardinal_links add-filter"\n' +
                'data-filter="' + filter + '" data-id="' + $(this).attr('data-id') + '">' + text + '</a>';
            var url = getUrlParameter(filter);
            var params = url.split(",");
            if (params.length === 1) {
                if ($(this).parents('.filter-group').find('.remove-filter').length === 1) {
                    $(this).parents('.filter-group').find('.remove-all-filter:not(.in-filter)').remove();
                }
                if (filter === 'posted') {
                    removeQueryStringParam(filter, encodeURIComponent(getUrlParameter(filter)));
                } else {
                    removeQueryStringParam(filter);
                }
            } else {
                params = params.remove(value);
                updateQueryStringParam(filter, params.join(","));
            }
            $(this).next().remove();
            $(this).replaceWith(replaceHTML);
            _this.filter();
        });

        $('body').on('click', '.remove-all-filter', function () {
            _this.clearFilter($(this));
        });

        $('body').on('click', '.clear-all-filter', function () {
            _this.clearAllFilters();
            $('.clear-filters-box').remove();
        });

        $('.add-filter-ms').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
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
            var title = "Categories";
            var defaultItems = [];
            _this.modalType = type;

            if (type == 'categories') {
                if (_this.msCategory) {
                    defaultItems = $.map(_this.msCategory.getSelection(), function(item) {
                        return item.id;
                    });
                }
                else {
                    defaultItems = getUrlParameter(type).split(",");
                }
            }
            else if (type == 'popular_industries') {
                    query = "industries";
                    items = _this.industries;
                    title = "Industries";

                    if (_this.msIndustry) {
                        defaultItems = $.map(_this.msIndustry.getSelection(), function(item) {
                            return item.id;
                        });
                    }
                    else {
                        defaultItems = getUrlParameter(type).split(",");
                    }
            }

            _this.modalAllItems.find('.modal-title').text(title);

            if (items) {
                var html = _this.modalItems(items, defaultItems);
                _this.modalAllItems.find('.modal-body .row').html(html);
                _this.modalAllItems.modal('show');
            }
            else {
                new GraphQL("query", query, params, [
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

        $("#slider-hours").slider({
            range: true,
            min: 0,
            max: 80,
            values: [0, 80],
            slide: function (event, ui) {
                $("#slider-hours-amount").html("" + ui.values[0] + " - " + ui.values[1] + " HR");
                _this.clearHours = true;
            },
            change: function (event, ui) {
                $("#slider-hours-amount").html("" + ui.values[0] + " - " + ui.values[1] + " HR");
                if (_this.clearHours) {
                    updateQueryStringParam('hours_from', ui.values[0]);
                    updateQueryStringParam('hours_to', ui.values[1]);
                    _this.filter();
                    _this.clearHours = false;
                }
            }
        });
        $("#slider-hours-amount").html("" + $("#slider-hours").slider("values", 0) +
            " - " + $("#slider-hours").slider("values", 1) + " HR");
        $("#slider-hours .ui-widget-header").css('background', '#007bff');

        if (_this.msLoad === 0) {
            _this.initMS();
            _this.msLoad = 1;
        }

        $('#show_hide-blocks-search').click(function () {
            $('#block-basic-search').hide();
            $('#block-advanced-search').show();

        });

        setTimeout(function () {
            _this.getLocations();
        }, 10);
        setTimeout(function () {
            // _this.getJobs();
        }, 200);
        _this.initChangeMapTheme();
    },
    clearFilter: function (el) {
        var _this = this;
        var filter = el.attr('data-filter');
        var groupItems = el.parents('.filter-group').find('.remove-filter');
        $.each(groupItems, function () {
            var replaceHTML = '<a href="javascript:void(0)"\n' +
                'class="cardinal_links add-filter"\n' +
                'data-filter="' + $(this).attr('data-filter') + '" data-id="' + $(this).attr('data-id') + '">' + $(this).next().text() + '</a>';
            $(this).next().remove();
            $(this).replaceWith(replaceHTML);
        });
        switch (filter) {
            case 'employers_data':
                removeQueryStringParam('career_status');
                removeQueryStringParam('work_status');
                removeQueryStringParam('job_status');
                _this.filter();
                break;
            case 'times':
                removeQueryStringParam('time_1');
                removeQueryStringParam('time_2');
                removeQueryStringParam('time_3');
                removeQueryStringParam('time_4');
                _this.filter();
                break;
            case 'posted':
                removeQueryStringParam(filter, encodeURI(getUrlParameter(filter)));
                _this.filter();
                break;
            case 'categories':
                _this.msCategory.setSelection([]);
                break;
            case 'title':
                _this.msSubCategory.setSelection([]);
                break;
            case 'popular_industries':
                _this.msIndustry.setSelection([]);
                break;
            case 'a_keywords':
                _this.msKeywords.setSelection([]);
                break;
            case 'departments':
                _this.msDepartments.setSelection([]);
                break;
            case 'certifications':
                _this.msCertificates.setSelection([]);
                break;
            case 'languages':
                _this.msLanguages.setSelection([]);
                break;
            default:
                removeQueryStringParam(filter);
                _this.filter();
                break;
        }
        el.remove();
    },
    filter: function () {
        var _this = this;
        if (window.location.search.length !== 0) {
            if ($('.clear-filters-box').length === 0) {
                var html = '<div class="col-12 py-2 clear-filters-box" style="border-bottom:1px solid #e9ecef;">\n' +
                    '    <a href="javascript:void(0)" class="cardinal_links clear-all-filter"><img\n' +
                    '                src="/img/round-delete-button.svg"\n' +
                    '                style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;">\n' +
                    trans('clear_all_filters') + '        </a>\n' +
                    '</div>';
                $('.category_section').prepend(html);
            }
        } else {
            $('.clear-filters-box').remove();
        }
        if (window.location.pathname.length < 2) {
            // window.location.href = '/search/jobs' + window.location.search;
        }
        setTimeout(function () {
            _this.getLocations();
        }, 200);
        setTimeout(function () {
            // _this.getJobs();
        }, 500);
    },
    // clearCardinalContentView: function () {
    //     var _this = this;
    //     $('.jobmap_object_view').hide();
    // },
    clearAllFilters: function () {
        var _this = this;

        var filters = $('.remove-all-filter');
        $.each(filters, function () {
            _this.clearFilter($(this));
        });
        $('#slider-hours').slider('values', [0, 80]);

        removeQueryStringParam(encodeURI(_this.searchBusinessName.val()));
        removeQueryStringParam(encodeURI(_this.searchTitle.val()));
        removeQueryStringParam(encodeURI(_this.searchLocation.val()));
        removeQueryStringParam('hours_from');
        removeQueryStringParam('hours_to');

        _this.searchBusinessName.val('');
        _this.searchTitle.val('');
        _this.searchLocation.val('');
        _this.clearHours = false;
        if (filters.length === 0) {
            _this.filter();
        }
        // return _this.getLocations();
    },
    initMS: function () {
        var _this = this;

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
        if (getUrlParameter('hours_from')) {
            $('#slider-hours').slider('values', [+getUrlParameter('hours_from'), +getUrlParameter('hours_to')]);
        }
        var keywords = getUrlParameter('a_keywords');
        var departments = getUrlParameter('departments');
        var certifications = getUrlParameter('certifications');
        var languages = getUrlParameter('languages');
        var title = getUrlParameter('title');
        var categories = getUrlParameter('categories');
        var industries = getUrlParameter('popular_industries');
        var bName = getUrlParameter('b_name');
        var location = getUrlParameter('location');

        if (bName) {
            _this.searchBusinessName.val(bName);
        }
        if (window.location.pathname == '/map') {
            if (title) {
                _this.getSubCategory(title);
            } else {
                _this.getSubCategory();
            }
        } else {
            if (title) {
                _this.searchTitle.val(title);
            }
        }
        if (location) {
            _this.searchLocation.val(location);
        }
        if (categories) {
            _this.getCategory(categories);
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
        // new GraphQL("query", "businessDepartments", params, ['items{id name}, default {id name}'], false, false, function (data) {
        //     //show error
        // }, function (data) {
        //     if (data.items) {
        //         _this.msDepartments = _this.msDepartmentsElement.magicSuggest({
        //             placeholder: trans('choose_departments'),
        //             toggleOnClick: true,
        //             allowFreeEntries: false,
        //             data: data.items,
        //             hideTrigger: true,
        //             noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
        //             cls: 'jack'
        //         });
        //         $(_this.msDepartments).unbind('selectionchange');
        //         $(_this.msDepartments).on('selectionchange', function () {
        //             var items = this.getValue();
        //             if (items.length > 0) {
        //                 if ($('#departments').parents('.filter-group').find('.remove-all-filter').length === 0) {
        //                     $('#departments').parents('.filter-group').prepend('<a href="javascript:void(0)"\n' +
        //                         'class="cardinal_links remove-all-filter"\n' +
        //                         'data-filter="departments"> <img\n' +
        //                         '         src="/img/round-delete-button.svg"\n' +
        //                         '         style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>');
        //                 }
        //                 updateQueryStringParam('departments', items.join(","));
        //                 _this.filter();
        //             } else {
        //                 $('#departments').parents('.filter-group').find('.remove-all-filter').remove();
        //                 removeQueryStringParam('departments');
        //                 _this.filter();
        //             }
        //         });
        //     }
        //     if (data.default) {
        //         _this.msDepartments.setSelection(data.default);
        //     }
        // }).request(_this.msDepartmentsElement);

        this.getMSList(function (items, defaultData) {
            _this.msLanguages = _this.msLanguagesElement.magicSuggest({
                placeholder: trans('type_language_level'),
                toggleOnClick: true,
                allowFreeEntries: false,
                data: items,
                hideTrigger: true,
                noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found,'),
                cls: 'jack'
            });
            $(_this.msLanguages).unbind('selectionchange');
            $(_this.msLanguages).on('selectionchange', function () {
                var items = this.getValue();
                if (items.length > 0) {
                    if ($('#languages').parents('.filter-group').find('.remove-all-filter').length === 0) {
                        $('#languages').parents('.filter-group').prepend('<a href="javascript:void(0)"\n' +
                            'class="cardinal_links remove-all-filter"\n' +
                            'data-filter="languages"> <img\n' +
                            '         src="/img/round-delete-button.svg"\n' +
                            '         style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>');
                    }
                    updateQueryStringParam('languages', items.join(","));
                    _this.filter();
                } else {
                    $('#languages').parents('.filter-group').find('.remove-all-filter').remove();
                    removeQueryStringParam('languages');
                    _this.filter();
                }
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
                placeholder: trans('type_certificate'),
                toggleOnClick: true,
                allowFreeEntries: false,
                data: items,
                hideTrigger: true,
                noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                cls: 'jack'
            });
            $(_this.msCertificates).unbind('selectionchange');
            $(_this.msCertificates).on('selectionchange', function () {
                var items = this.getValue();
                if (items.length > 0) {
                    if ($('#certifications').parents('.filter-group').find('.remove-all-filter').length === 0) {
                        $('#certifications').parents('.filter-group').prepend('<a href="javascript:void(0)"\n' +
                            'class="cardinal_links remove-all-filter"\n' +
                            'data-filter="certifications"> <img\n' +
                            '         src="/img/round-delete-button.svg"\n' +
                            '         style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>');
                    }
                    updateQueryStringParam('certifications', items.join(","));
                    _this.filter();
                } else {
                    $('#certifications').parents('.filter-group').find('.remove-all-filter').remove();
                    removeQueryStringParam('certifications');
                    _this.filter();
                }
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
        this.getMSList(function (items, defaultData) {
            _this.msKeywords = _this.msKeywordsElement.magicSuggest({
                placeholder: trans('type_keywords'),
                toggleOnClick: false,
                allowFreeEntries: false,
                data: [],
                hideTrigger: true,
                noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                cls: 'jack'
            });
            $(_this.msKeywords).unbind('selectionchange');
            $(_this.msKeywords).on('selectionchange', function () {
                var items = this.getValue();
                if (items.length > 0) {
                    if ($('#a_keywords').parents('.filter-group').find('.remove-all-filter').length === 0) {
                        $('#a_keywords').parents('.filter-group').prepend('<a href="javascript:void(0)"\n' +
                            'class="cardinal_links remove-all-filter"\n' +
                            'data-filter="a_keywords"> <img\n' +
                            '         src="/img/round-delete-button.svg"\n' +
                            '         style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>');
                    }
                    updateQueryStringParam('a_keywords', items.join(","));
                    _this.filter();
                } else {
                    $('#a_keywords').parents('.filter-group').find('.remove-all-filter').remove();
                    removeQueryStringParam('a_keywords');
                    _this.filter();
                }
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
    getIndustry: function (sub, val, subVal) {
        var _this = this;
        if (typeof val === 'string') {
            _this.msIndustryValue = explode(",", val);
        }
        var select = $('#popular_industries');
        var params = {};
        if (APIStorage.read('language') != 'en') {
            params['locale'] = APIStorage.read('language');
        }
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
                        placeholder: trans('choose_industry'),
                        toggleOnClick: true,
                        allowFreeEntries: false,
                        data: data,
                        required: true,
                        maxSelection: 30,
                        hideTrigger: true,
                        noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found,'),
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
                    // FormValidate.fieldValidateClear('#categories');
                    var items = this.getValue();
                    if (items.length > 0) {
                        _this.msIndustryValue = items;
                        if ($('#popular_industries').parents('.filter-group').find('.remove-all-filter').length === 0) {
                            $('#popular_industries').parents('.filter-group').prepend('<a href="javascript:void(0)"\n' +
                                'class="cardinal_links remove-all-filter"\n' +
                                'data-filter="popular_industries"> <img\n' +
                                '         src="/img/round-delete-button.svg"\n' +
                                '         style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>');
                        }
                        updateQueryStringParam('popular_industries', items.join(","));
                        _this.filter();
                    } else {
                        $('#popular_industries').parents('.filter-group').find('.remove-all-filter').remove();
                        removeQueryStringParam('popular_industries');
                        _this.filter();
                    }
                });
                Loader.contentLoader = true;
                Loader.loaderToElement = select;
                Loader.stop();
            }
        }).request(select, false, false);
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
        if (APIStorage.read('language') != 'en' && method == 'certificates') {
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

    getCategory: function (val, subVal) {
        var _this = this;

        if (typeof val === 'string') {
            _this.msCategoryValue = explode(",", val);
        }
        var select = $('#categories');
        var params = {};

        if (APIStorage.read('language') != 'en') {
            params['locale'] = APIStorage.read('language');
        }

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
                }
                else {
                    _this.msCategory = select.magicSuggest({
                        placeholder: trans('choose_categories'),
                        toggleOnClick: true,
                        allowFreeEntries: false,
                        data: data,
                        required: true,
                        maxSelection: 30,
                        hideTrigger: true,
                        noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
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
                    var items = this.getValue();
                    if (items.length > 0) {
                        _this.msCategoryValue = items;
                        if ($('#categories').parents('.filter-group').find('.remove-all-filter').length === 0) {
                            $('#categories').parents('.filter-group').prepend('<a href="javascript:void(0)"\n' +
                                'class="cardinal_links remove-all-filter"\n' +
                                'data-filter="categories"> <img\n' +
                                '         src="/img/round-delete-button.svg"\n' +
                                '         style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>');
                        }
                        updateQueryStringParam('categories', items.join(","));
                        _this.filter();
                    } else {
                        $('#categories').parents('.filter-group').find('.remove-all-filter').remove();
                        removeQueryStringParam('categories');
                        _this.filter();
                    }
                });
                Loader.contentLoader = true;
                Loader.loaderToElement = select;
                Loader.stop();
            }
        }).request(select, false, false);
    },
    getSubCategory: function (val, subVal) {
        var _this = this;
        if (typeof val === 'string') {
            _this.msSubCategoryValue = explode(",", val);
        }
        var select = $('#sub_categories');
        var params = { 'sub': 1 };
        if (APIStorage.read('language') != 'en') {
            params['locale'] = APIStorage.read('language');
        }
        new GraphQL("query", "categories", params, [
            'id',
            'name'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            if (data) {
                _this.sub_categories = data;
                if (_this.msSubCategory) {
                    _this.msSubCategory.setData(data);
                } else {
                    _this.msSubCategory = select.magicSuggest({
                        placeholder: trans('field_job_title'),
                        toggleOnClick: true,
                        allowFreeEntries: true,
                        data: data,
                        required: true,
                        maxSelection: 10,
                        hideTrigger: true,
                        noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                        cls: 'jack input_style industries_box field-box'
                    });
                }
                if (val) {
                    var v = explode(",", val);
                    _this.msSubCategory.setValue(v);
                }
                var a = _this.msSubCategory;
                $(a).unbind('selectionchange');
                $(a).on('selectionchange', function () {
                    var items = this.getValue();
                    if (items.length > 0) {
                        _this.msSubCategoryValue = items;
                        if ($('#sub_categories').parents('.filter-group').find('.remove-all-filter').length === 0) {
                            $('#sub_categories').parents('.filter-group').prepend('<a href="javascript:void(0)"\n' +
                                'class="cardinal_links remove-all-filter"\n' +
                                'data-filter="sub_categories"> <img\n' +
                                '         src="/img/round-delete-button.svg"\n' +
                                '         style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>');
                        }
                        updateQueryStringParam('title', items.join(","));
                        _this.filter();
                    } else {
                        $('#sub_categories').parents('.filter-group').find('.remove-all-filter').remove();
                        removeQueryStringParam('title');
                        _this.filter();
                    }
                });
                Loader.contentLoader = true;
                Loader.loaderToElement = select;
                Loader.stop();
            }
        }).request(select, false, false);
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
    mapRender: function () {
        var _this = this;
        var i, k;
        for (i = 0; i < _this.markers.length; i++) {
            _this.markers[i].setMap(null);
        }
        _this.mc.clearMarkers();
        _this.markers = [];
        _this.mapItems = [];
        _this.bounds = new google.maps.LatLngBounds();

        if (_this.items.length > 0 || _this.items_u.length > 0) {
            var latitude, longitude;
            var id, picture, slug, name;
            var latLng;
            setTimeout(function () {
                if (_this.items.length > 0) {
                    //setTimeout(function () {
                    for (i = 0; i < _this.items.length; i++) {
                        latitude = _this.items[i].latitude;
                        longitude = _this.items[i].longitude;
                        id = _this.items[i].id;
                        picture = _this.items[i].business.picture_50;
                        name = _this.items[i].business.name;
                        if (latitude != 0 && longitude != 0) {
                            latLng = new google.maps.LatLng(latitude, longitude);
                            _this.createMapItem(latLng, id, picture, name);
                        }
                    }
                    //if (_this.mapItems.length !== 0) {
                    for (i = 0; i < _this.mapItems.length; i++) {
                        if (_this.mapItems[i].ids.length > 1) {
                            var tt = _this.mapItems[i].name;
                            tt.sort();
                            var n = _this.mapItems[i].name.indexOf(tt[0]);
                            var tmp = _this.mapItems[i].ids[0];
                            _this.mapItems[i].ids[0] = _this.mapItems[i].ids[n];
                            _this.mapItems[i].ids[0] = tmp;
                            tmp = _this.mapItems[i].pictures[0];
                            _this.mapItems[i].pictures[0] = _this.mapItems[i].pictures[n];
                            _this.mapItems[i].pictures[0] = tmp;
                            tmp = _this.mapItems[i].name[0];
                            _this.mapItems[i].name[0] = _this.mapItems[i].name[n];
                            _this.mapItems[i].name[0] = tmp;
                        }
                        _this.createMapMarker(_this.mapItems[i].latLng, _this.mapItems[i].ids, _this.mapItems[i].pictures);
                    }
                    //}
                    k = i;
                    //now fit the map to the newly inclusive bounds
                    //_this.map.fitBounds(_this.bounds);
                    //}, 200);
                }
                if (_this.items_u.length > 0) {
                    //setTimeout(function () {
                    for (i = 0; i < _this.items_u.length; i++) {
                        latitude = _this.items_u[i].latitude;
                        longitude = _this.items_u[i].longitude;
                        id = _this.items_u[i].business.id;
                        picture = _this.items_u[i].business.picture_50;
                        name = _this.items_u[i].business.name;
                        slug = _this.items_u[i].business.slug;
                        if (latitude != 0 && longitude != 0) {
                            latLng = new google.maps.LatLng(latitude, longitude);
                            _this.createMapItem(latLng, id, picture, name, slug);
                        }
                    }
                    //if (_this.mapItems.length !== 0) {
                    for (i = k; i < _this.mapItems.length; i++) {
                        if (_this.mapItems[i].ids.length > 1) {
                            var tt = _this.mapItems[i].name;
                            tt.sort();
                            var n = _this.mapItems[i].name.indexOf(tt[0]);
                            var tmp = _this.mapItems[i].ids[0];
                            _this.mapItems[i].ids[0] = _this.mapItems[i].ids[n];
                            _this.mapItems[i].ids[n] = tmp;
                            tmp = _this.mapItems[i].pictures[0];
                            _this.mapItems[i].pictures[0] = _this.mapItems[i].pictures[n];
                            _this.mapItems[i].pictures[n] = tmp;
                            tmp = _this.mapItems[i].name[0];
                            _this.mapItems[i].name[0] = _this.mapItems[i].name[n];
                            _this.mapItems[i].name[n] = tmp;
                            tmp = _this.mapItems[i].slug[0];
                            _this.mapItems[i].slug[0] = _this.mapItems[i].slug[n];
                            _this.mapItems[i].slug[n] = tmp;
                        }
                        _this.createMapMarker_U(_this.mapItems[i].latLng, _this.mapItems[i].ids, _this.mapItems[i].pictures, _this.mapItems[i].slug);
                    }
                    //}
                    //now fit the map to the newly inclusive bounds
                    //_this.map.fitBounds(_this.bounds);
                    //}, 200);
                }

                //now fit the map to the newly inclusive bounds
                _this.map.fitBounds(_this.bounds);

                if (window.navigator && navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        _this.currentPosition = position;
                        _this.map.setCenter({ lat: position.coords.latitude, lng: position.coords.longitude });
                        _this.map.setZoom(12);
                    });
                }
            }, 200);
        } else {
            _this.map.fitBounds(_this.bounds);
            _this.map.setZoom(3);

            // var center_location = {
            //     lat: 40.0,
            //     lng: 0.0,
            // };

            // if (_this.currentPosition) {
            //     center_location.lat = _this.currentPosition.latitude;
            //     center_location.lng = _this.currentPosition.longitude;
            // }

            // _this.map.panTo(center_location);
        }

    },
    createMapItem: function (latlng, id, picture, name, slug) {
        slug = slug || '';
        var _this = this;
        var n = true;
        //if (_this.mapItems.length !== 0) {
            for (var i = 0; i < _this.mapItems.length; i++) {
                if (_this.mapItems[i].latLng.equals(latlng)) {
                    _this.mapItems[i]['ids'].push(id);
                    _this.mapItems[i]['pictures'].push(picture);
                    _this.mapItems[i]['slug'].push(slug);
                    _this.mapItems[i]['name'].push(name);
                    n = false;
                    break;
                }
            }
        //}
        if (n) {
            _this.mapItems.push({
                'latLng': latlng,
                'ids': [id],
                'pictures': [picture],
                'slug': [slug],
                'name': [name]
            });
        }
    },
    createMapMarker: function (latLng, ids, pictures) {
        var _this = this;
        var marker = new CustomMarker(
            latLng,
            _this.map,
            {
                marker_id: ids.join(",")
            },
            pictures
        );
        _this.bounds.extend(marker.getPosition());
        var id = ids;
        google.maps.event.addListener(marker, 'click', function () {
            var newCenter = {
                lat: this.latlng.lat(),
                lng: this.latlng.lng()
            };

            _this.map.panTo(newCenter);
            if ( $('.jobmap_object_view').length > 0 && $('.jobmap_filter').length > 0) {
                // var offset_x = $('.jobmap_object_view').width() - $('.jobmap_filter').width();
                // _this.map.panBy(offset_x,0);
                // _this.markerModal(id);
                _this.markerCardinal(id);
            } else if ($('.jobmap_object_view').length > 0) {
                // var offset_x = $('.jobmap_object_view').width();
                // _this.map.panBy(offset_x/2,0);
                // _this.markerModal(id);
                _this.markerCardinal(id);
            }

            $('.clear-cardinal-content-view').show();

            $(document).trigger("map:change:map:size:short");

            //_this.markerModal(id);
        });
        _this.markers.push(marker);
        return _this.mc.addMarker(marker);
    },
    markerModal: function (ids) {
        this.getLocationsList(ids);
        $('.jobs-count').parent().show();
        /*if (ids.length > 1) {
            //$('#modal-locations-list').modal('show');
            this.getLocationsList(ids);
        } else {
            //$('#modal-single-location').modal('show');
            this.getLocation(ids[0]);
        }*/
        if ($('.jobmap_object_view').is(":visible")) {
            $('.jobmap_content_view').fadeOut().fadeIn();

        } else {
            $('.jobmap_object_view').toggle({ direction: "right" }, 500);
        }

    },
    markerCardinal: function (ids) {
        this.getLocationsList(ids);
        $('.jobs-count').parent().show();
        /*if (ids.length > 1) {
            //$('#modal-locations-list').modal('show');
            this.getLocationsList(ids);
        } else {
            //$('#modal-single-location').modal('show');
            this.getLocation(ids[0]);
        }*/
        if ($('.jobmap_object_view').is(":visible")) {
            $('.jobmap_content_view').show();
        } else {
            $('.jobmap_object_view').toggle();
        }

    },
    createMapMarker_U: function (latLng, ids, pictures, slug) {
        var _this = this;
        var marker = new CustomMarker(
            latLng,
            _this.map,
            {
                marker_id: ids.join(",")
            },
            pictures
        );
        _this.bounds.extend(marker.getPosition());
        var id = ids;
        google.maps.event.addListener(marker, 'click', function () {
            //window.location.href = getBaseURL() + '/unconfirmed-business/view/' + id[0] + '/' + slug;

            var newCenter = {
                lat: this.latlng.lat(),
                lng: this.latlng.lng()
            };

            _this.map.panTo(newCenter);
            if ( $('.jobmap_object_view').length > 0 && $('.jobmap_filter').length > 0) {
                var offset_x = $('.jobmap_object_view').width() - $('.jobmap_filter').width();
                _this.map.panBy(offset_x,0);
                _this.markerModal_U(id);
            } else if ($('.jobmap_object_view').length > 0) {
                var offset_x = $('.jobmap_object_view').width();
                _this.map.panBy(offset_x/2,0);
                _this.markerModal_U(id);
            }
        });
        this.markers.push(marker);
        return _this.mc.addMarker(marker);
    },
    markerModal_U: function (ids) {
        this.getLocationsList_U(ids);
        $('.jobs-count').parent().hide();
        if ($('.jobmap_object_view').is(":visible")) {
            $('.jobmap_content_view').fadeOut().fadeIn();

        } else {
            $('.jobmap_object_view').toggle({ direction: "right" }, 500);
        }
    },
    setLocations: function (data) {
        var _this = this;
        this.items = data.items;
        this.items_u = data.items_u;
        _this.mapRender()
    },
    showJobs: function (data) {
        var html = '';
        //var jobsIds = [];
        $.map(data.items, function (item) {
            html += item.html_career;
        });
        /*$.map(data.items_u, function (item) {
            $.map(item.assign_jobs, function (job) {
                if (jobsIds.indexOf(job.id)==-1) {
                    html += job.html_career;
                    jobsIds.push(job.id);
                }
            });
        });*/
        if (html.length ==0) {
            html = 'No results!';
        }
        $('#items-list').html(html);
    },
    getLocationsList: function (ids) {
        //var _this = this;
        if (ids) {
            var _this = this;

            var params = {
                "id": ids.join(',')
            };
            //if (APIStorage.read('api-token')) {
            if (user) {
                params['login_user_id'] = parseInt(user.data.id);
            }
            var locale = APIStorage.read('language');
            if (locale != 'en') {
              params['locale'] = locale;
            }

            console.log(params);

            new GraphQL("query", "locations", params, [
                'id',
                'name',
                'localized_name',
                'slug',
                'street',
                'street_number',
                'city',
                'country',
                'jobs_count_open',
                'jobs_count',
                'assign_jobs{id title localized_title description localized_description job_status created_date_ago job_id days_send_resume type_key salary_type salary hours}',
                //'assign_jobs{id title description job_status created_date_ago job_id}',
                'business{id name localized_name slug picture_50(width:50,height:50) locations_count jm_jobs_count type industry}'
            ], false, false, function () {
                Loader.stop();
            }, function (data) {
            /*
                var modal = $('#modal-locations-list');

                var html = '';
                $.map(data, function (item) {
                    html += '<div class="d-flex align-items-center justify-content-between mb-3 flex-lg-row flex-column">\n' +
                        '<div class="d-inline-flex align-items-center mr-2 mxa-0 flex-lg-row flex-column" style="flex: 1">\n' +
                        '    <div class="rounded p-1 bg-white d-inline-block mr-2 mxa-0"\n' +
                        '         style="box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);">\n' +
                        '        <a href="/map/view/location/' + item.id + '/' + item.slug + '"><img style="width: 70px;" class="location-pic" src="' + item.business.picture_50 + '"></a>\n' +
                        '    </div>\n' +
                        '<div class="text-center">' +
                        '    <h6 class="h6 my-0"><a data-toggle="tooltip" data-placement="top" data-original-title="View ' + item.business.name + ' ' +Langs.jobs_in_this_location+ '" href="' + getBaseURL() + '/business/view/' + item.business.id + '/' + item.business.slug + '" target="_blank">' + item.business.name + '</a></h6>\n';
                    if (item.business.locations_count > 1) {
                        html += '    <h6 class="h6 mb-0"><a href="/map/view/location/' + item.id + '/' + item.slug + '" target="_blank">' + item.name + '</a></h6>';
                    }
                    html += '</div></div>\n' +
                        '<div class="d-inline-flex align-items-center">\n' +
                        '    <p class="mb-0 mr-2"><a href="/map/view/location/' + item.id + '/' + item.slug + '" target="_blank">' + item.jobs_count + ' '+ Langs.jobs+'</a></p>\n' +
                        '    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Capa_1" x="0px" y="0px"\n' +
                        '                                 width="20px" height="20px" viewBox="0 0 366.736 366.736"\n' +
                        '                                 style="enable-background:new 0 0 366.736 366.736;" xml:space="preserve">\n' +
                        '<path d="M338.11,75.789h-77.312V61.955c0-16.314-13.271-29.587-29.586-29.587h-95.688c-16.313,0-29.586,13.272-29.586,29.587   v13.834H28.627C12.842,75.789,0,88.63,0,104.414v201.328c0,15.784,12.842,28.626,28.627,28.626h309.482   c15.785,0,28.627-12.842,28.627-28.626V104.414C366.737,88.631,353.896,75.789,338.11,75.789z M130.939,61.955   c0-2.529,2.058-4.587,4.586-4.587h95.688c2.528,0,4.586,2.058,4.586,4.587v13.834h-104.86V61.955z M28.628,100.789H338.11   c2,0,3.627,1.626,3.627,3.625v65.598c-38.738,14.37-97.169,22.858-158.474,22.858c-61.17,0-119.521-8.459-158.263-22.781v-65.675   C25.001,102.415,26.628,100.789,28.628,100.789z M338.11,309.368H28.628c-2,0-3.627-1.626-3.627-3.626V196.575   c35.458,11.697,82.077,19.008,132.882,20.84c-0.003,0.145-0.021,0.285-0.021,0.432v5.513c0,10.335,8.408,18.743,18.744,18.743   h13.527c10.336,0,18.744-8.408,18.744-18.743v-5.513c0-0.147-0.02-0.291-0.021-0.438c50.837-1.848,97.449-9.18,132.883-20.9   v109.234C341.737,307.742,340.11,309.368,338.11,309.368z"\n' +
                        '                                                                  fill="#007bff"/>\n' +
                        '</svg>\n' +
                        '    </div>\n' +
                        '</div>';
                });
                modal.find('.modal-body').html(html);

                var location = data[0].street_number + ' ' + data[0].street + ', ' + data[0].city;
                var link = data[0].street_number + '+' + data[0].street + '+' + data[0].city;
                if (data[0].country !== null) {
                    location += ", " + data[0].country;
                    link += "+" + data[0].country;
                }
                modal.find('*[data-id]').attr('data-id', setLocationURL('address', data[0]));
                modal.find('#location-address').text(location);
                modal.find('#locations-more-info span').text(data.length);
                $('[data-toggle="tooltip"]').tooltip();
            /*
            }).request($('#modal-locations-list').find('.modal-body'), false, true);
            */
                var modal = $('.jobmap_content_view');

                var html = '';
                var jobsCount = 0;
                $.map(data, function (item) {
                    jobsCount += item.jobs_count;
                    html += '<div class="d-lg-inline-flex d-flex flex-column flex-lg-row mt-5 ml-3">'+
                            '   <div class="text-center text-lg-left mb-3">'+
                            '       <div data-filter="hudson" class="" style="width: 60px; border-radius: 5px; overflow: hidden; margin:0 auto;">'+
                            '           <img class="mr-3 mxa-0 candidate-picture" src="'+ item.business.picture_50 +'" style="width: 60px; height: 60px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); border-radius: 5px;">'+
                            '       </div>'+
                            '   </div>'+
                            '   <div class="text-center text-lg-left mxa-0" style="margin-left: 20px">'+
                            '       <div class="d-flex flex-column flex-lg-row">'+
                            '           <p class="mb-0" style="font-size: 18px;  font-weight: 500;">'+ _this.ucFirst(item.business.localized_name) +'</p>'+
                            '       </div>'+
                            '       <p class="mb-0">'+  data[0].localized_name +'</p>';
                    var strLocation  = item.business.locations_count + ' ';
                    if (item.business.locations_count > 1) {
                        strLocation += ' ' + trans('locations');
                    } else {
                        strLocation += ' ' + trans('location');
                    }
                    var strJob = item.business.jm_jobs_count + ' ';
                    if (item.business.jm_jobs_count > 1) {
                        strJob += ' ' + trans('jobs');
                    } else {
                        strJob += ' ' + trans('job');
                    }
                    html += '       <p class="mb-2" style="font-size: 14px;">'+ strLocation + ', '+ strJob + ', '+ _this.ucFirst(item.business.type) + _this.ucFirst(item.business.industry, ', ') +'</p>'+
                            '       <span>'+
                            '           <a href="'+ getBaseURL() +'/business/view/'+ item.business.id +'/'+ item.business.slug +'" class="btn btn-outline-viewcp btn-sm" style="font-size: 13px;">' + trans('view_career_page') + '</a>'+
                            '           <a href="/map/view/location/'+ data[0].id +'/'+ data[0].slug +'" class="btn btn-outline-viewcp btn-sm" style="font-size: 13px;">'+ trans('view_location') +'</a>'+
                            '       </span>'+
                            '   </div>'+
                            '</div>';
                    $.map(item.assign_jobs, function (job) {
                        console.log(job);
                        html += '<div class="mt-5 ml-3">'+
                                '   <div class="text-center text-lg-left mxa-0">'+
                                '       <div class="mb-1 d-flex flex-column flex-lg-row">'+
                                '           <p class="mb-0" style="font-size: 18px; font-weight: 500;">'+ _this.ucFirst(job.localized_title);
                        if (job.job_status == 1) {
                            html += '<div class="ml-2">'+
                                    '    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 448.8 448.8" style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px; fill:rgb(40, 167, 69);" xml:space="preserve">'+
                                    '       <g><g id="check"><polygon points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"></polygon></g></g>'+
                                    '    </svg>'+
                                    '    <small style="color:rgb(40, 167, 69);">' + trans('open') + '</small>'+
                                    '</div>';
                        }

                        let _salary = "";
                        if(job.type_key){
                            _salary += '<span>'+job.type_key+'</span>';
                        }
                        if(job.type_key && job.salary){
                            _salary += '<span class="mx-1">•</span>';
                        }
                        if(job.salary){
                            _salary += '<span class="rounded"><span>'+job.salary_type+job.salary+'</span><span class="ml-1">'+trans('per_hour')+'</span></span>';
                        }
                        if(job.hours && job.salary){
                            _salary += '<span class="mx-1">•</span>';
                        }
                        if(job.hours){
                            _salary += '<span class="rounded"><span>'+job.hours+trans('hours')+'</span><span class="ml-1">'+trans('per_week')+'</span></span>';
                        }

                        html += '           </p>'+
                                '       </div>'+
                                '       <div class="d-flex flex-lg-row- flex-column justify-content-between">'+
                                            '<p class="mb-1 open-sans" style="opacity: 0.5;">'+_salary+'</p>'+
                                '           <p class="mb-2 align-self-center" style="font-size: 14px; display: -webkit-box; -webkit-line-clamp: 6; -webkit-box-orient: vertical; overflow: hidden;">'+ _this.ucFirst(job.localized_description) +'</p>'+
                                '           <div class="col-lg-2 col-12 align-self-center">'+
                                '               <small>'+ job.created_date_ago +'</small>'+
                                '           </div>'+
                                '       </div>'+
                                '       <span>'+
                                '           <a href="/map/view/job/'+ job.job_id +'" class="btn btn-viewcp btn-sm ttt" style="font-size: 13px;">' + trans('view_job') + '</a>';
                        if (job.days_send_resume == 0 ) {
                            html += '<button class="btn btn-outline-viewcp ml-2 btn-sm send-resume" style="font-size: 13px;"'+
                                    '   data-id="'+ item.id +'" data-j-id="'+ job.id +'" data-b-id="'+ item.business.id +'">' + trans('im_interested') + '</button>';
                        } else {
                            html += '<button class="btn btn-outline-viewcp ml-2 btn-sm send-resume" style="font-size: 13px;"'+
                                    '   data-id="'+ item.id +'" data-j-id="'+ job.id +'" data-b-id="'+ item.business.id +'">' + trans('you_can_reapply_in') + job.days_send_resume + trans('days') + '</button>';
                        }
                        html += '       </span>'+
                                '   </div>'+
                                '</div>';
                    });
                    if (item.jobs_count == 0) {
                        if (item.business.jm_jobs_count == 0) {
                            html += '<div class="mt-5 ml-3">'+ _this.ucFirst(item.business.localized_name) + trans('didnt_list_jobs_in_location_1') + '</div>';
                        } else {
                            html += '<div class="mt-5 ml-3">'+ _this.ucFirst(item.business.localized_name) + trans('didnt_list_jobs_in_location_21') + item.business.jm_jobs_count + trans('didnt_list_jobs_in_location_22') + item.business.locations_count + trans('didnt_list_jobs_in_location_23') + '</div>';
                        }
                    }
                    html += '<hr>';
                });

                modal.find('.jobmap_list_view').html(html);

                var location = data[0].street_number + ' ' + data[0].street + ', ' + data[0].city;
                if (data[0].country !== null) {
                    location += ", " + data[0].country;
                }
                var businessCount = data.length + ' ';
                if (data.length > 1) {
                    businessCount += trans('employer_branches_here');
                } else {
                    businessCount += trans('employer_branch_here');
                }

                modal.find('.location-address').text(location);
                modal.find('.businesses-count').text(businessCount);
                if (jobsCount > 1) {
                    jobsCount += ' ' + trans('jobs');
                } else {
                    jobsCount += ' ' + trans('job');
                }
                modal.find('.jobs-count').text(jobsCount);


            }).request();
        }
    },
    getLocationsList_U: function (ids) {
        //var _this = this;
        if (ids) {
            var _this = this;

            var params = {
                "id": ids.join(',')
            };
            var locale = APIStorage.read('language');
            if (locale != 'en') {
                params['locale'] = locale;
            }
            new GraphQL("query", "locationsUnconfirmed", params, [
                'id',
                'name',
                'slug',
                'street',
                'street_number',
                'city',
                'country',
                'business{id name slug picture_50(width:50,height:50) locations_count jm_jobs_count type industry}'
            ], false, false, function () {
                Loader.stop();
            }, function (data) {
                var modal = $('.jobmap_content_view');

                var html = '';
                var jobsCount = 0;
                $.map(data, function (item) {
                    html += '<div class="d-lg-inline-flex d-flex flex-column flex-lg-row mt-5 ml-3">'+
                        '   <div class="text-center text-lg-left mb-3">'+
                        '       <div data-filter="hudson" class="" style="width: 60px; border-radius: 5px; overflow: hidden; margin:0 auto;">'+
                        '           <img class="mr-3 mxa-0 candidate-picture" src="'+ item.business.picture_50 +'" style="width: 60px; height: 60px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); border-radius: 5px;">'+
                        '       </div>'+
                        '   </div>'+
                        '   <div class="text-center text-lg-left mxa-0" style="margin-left: 20px">'+
                        '       <div class="d-flex flex-column flex-lg-row">'+
                        '           <p class="mb-0" style="font-size: 18px;  font-weight: 500;">'+ _this.ucFirst(item.business.name) +'</p>'+
                        '       </div>'+
                        '       <p class="mb-0">'+  data[0].name +'</p>';
                    var strLocation  = item.business.locations_count + ' ';
                    if (item.business.locations_count > 1) {
                        strLocation += ' ' + trans('locations');
                    } else {
                        strLocation += ' ' + trans('location');
                    }
                    html += '       <p class="mb-2" style="font-size: 14px;">'+ strLocation + ', '+ _this.ucFirst(item.business.type) + _this.ucFirst(item.business.industry, ', ') +'</p>'+
                        '       <span>'+
                        '           <a href="'+ getBaseURL() +'/unconfirmed-business/view/'+ item.business.id +'/'+ item.business.slug +'" class="btn btn-outline-viewcp btn-sm" style="font-size: 13px;">' + trans('view_career_page') + '</a>'+
                        '           <a href="/map/view/unconfirmed-location/'+ data[0].id +'/'+ data[0].slug +'" class="btn btn-outline-viewcp btn-sm" style="font-size: 13px;">'+ trans('view_location') +'</a>'+
                        '       </span>'+
                        '   </div>'+
                        '</div>';
                    html += '<hr>';
                });

                modal.find('.jobmap_list_view').html(html);

                var location = '';
                if (data[0].street_number) {
                    location += data[0].street_number;
                }
                if (data[0].street) {
                    location += ' ' + data[0].street;
                }
                if (data[0].city) {
                    location += ', ' + data[0].city;
                }
                if (data[0].country !== null) {
                    location += ", " + data[0].country;
                }
                var businessCount = data.length + ' ';
                if (data.length > 1) {
                    businessCount += trans('employer_branches_here');
                } else {
                    businessCount += trans('employer_branch_here');
                }

                modal.find('.location-address').text(location);
                modal.find('.businesses-count').text(businessCount);

            }).request();
        }
    },
    ucFirst: function (s,z) {
        z = z || '';
        if (s) {
            return z + s.charAt(0).toUpperCase() + s.substr(1);
        }
        return '';
    },
    getLocation: function (id) {
        if (id) {
            var _this = this;

            var params = {
                "id": id
            };
            new GraphQL("query", "location", params, [
                'id',
                'name',
                'slug',
                'street_number',
                'street',
                'region',
                'city',
                'country',
                'business {id name slug}',
                'assign_amenities {id name key}',
                'jobs_count_open',
                'jobs_count',
                'business{picture_50(width:50,height:50) locations_count}'
            ], false, false, function () {
                Loader.stop();
            }, function (data) {
                var modal = $('#modal-single-location');
                var count = (data.business.locations_count) ? data.business.locations_count : 0;
                modal.find('.view-location-link').attr('href', '/map/view/location/' + data.id + '/' + data.slug);
                modal.find('#link-location-country').text(data.country).attr('href', setLocationURL('country', data));
                modal.find('#link-location-city').text(data.city).attr('href', setLocationURL('city', data));
                modal.find('#link-location-region').text(data.region).attr('href', setLocationURL('region', data));
                modal.find('#link-location-street').text(data.street).attr('href', setLocationURL('street', data));
                modal.find('#link-location-address').text(data.street + ' ' + data.street_number).attr('href', setLocationURL('address', data));

                modal.find('#business_name_header').html('<a href="' + getBaseURL() + '/business/view/' + data.business.id + '/' + data.business.slug + '" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="'+trans('view')+' ' + data.business.name + ' '+trans('career_page')+'">' + data.business.name + '</a>');
                modal.find('#all-locations').attr('href', getBaseURL() + '/business/view/' + data.business.id + '/' + data.business.slug).attr('target', '_blank');
                modal.find('#all-locations').find('span').text(count);
                modal.find('#location-name').html('<a href="' + getBaseURL() + '/business/view/' + data.business.id + '/' + data.business.slug + '" target="_blank">' + data.name + '</a>');
                modal.find('*[data-id]').attr('data-id', data.id);
                // modal.find('.send-resume').attr('data-b-id', data.business.id);
                var countJobs = data.jobs_count;
                modal.find('#location-open-jobs span').text(data.jobs_count_open);
                modal.find('#location-jobs span').text(countJobs);
                modal.find('#location-pic').attr('src', data.business.picture_50);

                var html = '';
                $.map(data.assign_amenities, function (item) {
                    html += '<div class="border rounded-circle text-center mr-2"\n' +
                        '                         style="padding-top: 7px;width: 40px;height: 40px; box-shadow: 0 4px 10px 0 rgba(0,0,0,.14), 0 1px 2px 0 rgba(0,0,0,.12), 0 3px 1px -2px rgba(0,0,0,.2);"\n' +
                        '                         data-toggle="tooltip" data-placement="top" title="' + item.name + '">\n' +
                        '<span>\n' +
                        '<svg xmlns="http://www.w3.org/2000/svg"\n' +
                        '                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"\n' +
                        '                                                                 version="1.1" id="Layer_1" x="0px" y="0px"\n' +
                        '                                                                 viewBox="0 0 512 512"\n' +
                        '                                                                 style="enable-background:new 0 0 512 512; fill:#007bff; width: 20px;"\n' +
                        '                                                                 xml:space="preserve">\n' +
                        '<g>\n' +
                        '<g>\n' +
                        '<g>\n' +
                        '<path d="M486.4,460.8c-1.476,0-2.944,0.128-4.386,0.384c-5.888-10.607-17.092-17.451-29.747-17.451     c-12.655,0-23.859,6.844-29.747,17.451c-1.442-0.256-2.91-0.384-4.386-0.384c-14.114,0-25.6,11.486-25.6,25.6     c0,3.004,0.614,5.845,1.579,8.533H358.4v-51.2h42.667c4.71,0,8.533-3.823,8.533-8.533V93.867c0-4.71-3.823-8.533-8.533-8.533     h-256c-4.71,0-8.533,3.823-8.533,8.533v409.6c0,4.71,3.823,8.533,8.533,8.533H486.4c14.114,0,25.6-11.486,25.6-25.6     S500.514,460.8,486.4,460.8z M358.4,102.4h34.133v51.2H358.4V102.4z M358.4,170.667h34.133v51.2H358.4V170.667z M358.4,238.933     h34.133v51.2H358.4V238.933z M358.4,307.2h34.133v51.2H358.4V307.2z M358.4,375.467h34.133v51.2H358.4V375.467z M187.733,494.933     H153.6v-51.2h34.133V494.933z M187.733,426.667H153.6v-51.2h34.133V426.667z M187.733,358.4H153.6v-51.2h34.133V358.4z      M187.733,290.133H153.6v-51.2h34.133V290.133z M187.733,221.867H153.6v-51.2h34.133V221.867z M187.733,153.6H153.6v-51.2h34.133     V153.6z M238.933,494.933H204.8v-51.2h34.133V494.933z M238.933,426.667H204.8v-51.2h34.133V426.667z M238.933,358.4H204.8v-51.2     h34.133V358.4z M238.933,290.133H204.8v-51.2h34.133V290.133z M238.933,221.867H204.8v-51.2h34.133V221.867z M238.933,153.6     H204.8v-51.2h34.133V153.6z M290.133,494.933H256v-51.2h34.133V494.933z M290.133,426.667H256v-51.2h34.133V426.667z      M290.133,358.4H256v-51.2h34.133V358.4z M290.133,290.133H256v-51.2h34.133V290.133z M290.133,221.867H256v-51.2h34.133V221.867     z M290.133,153.6H256v-51.2h34.133V153.6z M341.333,494.933H307.2v-51.2h34.133V494.933z M341.333,426.667H307.2v-51.2h34.133     V426.667z M341.333,358.4H307.2v-51.2h34.133V358.4z M341.333,290.133H307.2v-51.2h34.133V290.133z M341.333,221.867H307.2v-51.2     h34.133V221.867z M341.333,153.6H307.2v-51.2h34.133V153.6z M486.4,494.933h-68.267c-4.702,0-8.533-3.831-8.533-8.533     s3.831-8.533,8.533-8.533c1.638,0,3.191,0.469,4.625,1.391c2.338,1.502,5.257,1.775,7.834,0.734     c2.577-1.041,4.48-3.277,5.103-5.982c1.801-7.774,8.619-13.21,16.572-13.21c7.953,0,14.771,5.436,16.572,13.21     c0.623,2.705,2.526,4.941,5.103,5.982c2.577,1.041,5.495,0.768,7.834-0.734c5.547-3.584,13.167,0.802,13.158,7.142     C494.933,491.102,491.102,494.933,486.4,494.933z"/>\n' +
                        '<path d="M187.733,59.733v-25.6h59.733c4.71,0,8.533-3.823,8.533-8.533v-8.533h34.133V25.6c0,4.71,3.823,8.533,8.533,8.533H358.4     V51.2H213.333c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h213.333v353.954c0,4.71,3.823,8.533,8.533,8.533     s8.533-3.823,8.533-8.533V59.733c0-4.71-3.823-8.533-8.533-8.533h-59.733V25.6c0-4.71-3.823-8.533-8.533-8.533H307.2V8.533     c0-4.71-3.823-8.533-8.533-8.533h-51.2c-4.71,0-8.533,3.823-8.533,8.533v8.533H179.2c-4.71,0-8.533,3.823-8.533,8.533v25.6     h-59.733c-4.71,0-8.533,3.823-8.533,8.533v435.2H51.2v-34.995c19.447-3.968,34.133-21.197,34.133-41.805     c0-1.109-0.486-110.933-42.667-110.933C0.486,307.2,0,417.024,0,418.133c0,20.608,14.686,37.837,34.133,41.805v34.995h-25.6     c-4.71,0-8.533,3.823-8.533,8.533S3.823,512,8.533,512h102.4c4.71,0,8.533-3.823,8.533-8.533v-435.2H179.2     C183.91,68.267,187.733,64.444,187.733,59.733z M17.067,418.133c0-42.513,11.418-93.867,25.6-93.867     c14.182,0,25.6,51.354,25.6,93.867c0,14.114-11.486,25.6-25.6,25.6S17.067,432.247,17.067,418.133z"/>\n' +
                        '</g>\n' +
                        '</g>\n' +
                        '</g>\n' +
                        '</svg>\n' +
                        '</span></div>';
                });
                modal.find('#amenities-list').html(html);
                $('[data-toggle="tooltip"]').tooltip();
            }).request($('#modal-single-location'));
        }
    },

    getLocations: function () {
        var _this = this;

        var params = {};
        // params['job_status'] = 1;
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&');

        if (sPageURL) {
            for (var i = 0; i < sURLVariables.length; i++) {
                var sParameterName = sURLVariables[i].split('=');
                if (['sort','order','limit','page', 'result_type'].indexOf(sParameterName[0]) == -1) {
                    if (sParameterName[0] === 'hours_from' || sParameterName[0] === 'hours_to') {
                        params[sParameterName[0]] = +sParameterName[1];
                    } else {
                        params[sParameterName[0]] = sParameterName[1];
                    }
                    if (sParameterName[0] === 'status') {
                        params['job_status'] = sParameterName[1];
                        delete params[sParameterName[0]];
                    }
                    if (sParameterName[0] === 'type') {
                        params['types'] = sParameterName[1];
                        delete params[sParameterName[0]];
                    }
                }

            }
        }

        new GraphQL("query", "map", params, [
            'items {' +
            'id name type latitude longitude business {id name picture_50(width:50, height:50)} street city region country ' +
            //'assign_jobs {id html_career} ' +
            '}' +
            'items_u {' +
            'id name slug type latitude longitude business {id name slug picture_50(width:50, height:50)} street city region country ' +
            //'assign_jobs {id html_career} ' +
            '}'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            _this.setLocations(data);
        }).request();
    },
    getJobs: function () {
        var _this = this;

        var params = {};
        // params['job_status'] = 1;
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&');

        if (sPageURL) {
            for (var i = 0; i < sURLVariables.length; i++) {
                var sParameterName = sURLVariables[i].split('=');
                if (['hours_from','hours_to','limit','page', 'sort', 'result_type'].indexOf(sParameterName[0]) !== -1) {
                //if (sParameterName[0] === 'hours_from' || sParameterName[0] === 'hours_to') {
                    params[sParameterName[0]] = +sParameterName[1];
                } else {
                    params[sParameterName[0]] = sParameterName[1];
                }
                if (sParameterName[0] === 'status') {
                    params['job_status'] = sParameterName[1];
                    delete params[sParameterName[0]];
                }
                if (sParameterName[0] === 'type') {
                    params['types'] = sParameterName[1];
                    delete params[sParameterName[0]];
                }
            }
        }
        new GraphQL("query", "searchJobs", params, [
            'items {' +
            'id html_career title assign_locations {id job_id business{picture_50(width:50,height:50)} name street street_number city region country created_date job_status}' +
            '}',
            'pages',
            'count',
            'current_page'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            _this.showJobs(data);
        }).request();
    },
    initChangeMapTheme: function () {
        var _this = this;
        $('#map-theme-standard').click(function () {
            var themeStyle = [];
            _this.map.setOptions({styles: themeStyle});
            APIStorage.create('map-theme','standard');
        });

        $('#map-theme-silver').click(function () {
            var themeStyle = [
                {
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f5f5f5"
                        }
                    ]
                },
                {
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#616161"
                        }
                    ]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "color": "#f5f5f5"
                        }
                    ]
                },
                {
                    "featureType": "administrative.land_parcel",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#bdbdbd"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#eeeeee"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#757575"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#e5e5e5"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#9e9e9e"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#757575"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#dadada"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#616161"
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#9e9e9e"
                        }
                    ]
                },
                {
                    "featureType": "transit.line",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#e5e5e5"
                        }
                    ]
                },
                {
                    "featureType": "transit.station",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#eeeeee"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#c9c9c9"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#9e9e9e"
                        }
                    ]
                }
            ]
            _this.map.setOptions({styles: themeStyle});
            APIStorage.create('map-theme','silver');
        });

        $('#map-theme-retro').click(function () {
            var themeStyle = [
                {
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#ebe3cd"
                        }
                    ]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#523735"
                        }
                    ]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "color": "#f5f1e6"
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#c9b2a6"
                        }
                    ]
                },
                {
                    "featureType": "administrative.land_parcel",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#dcd2be"
                        }
                    ]
                },
                {
                    "featureType": "administrative.land_parcel",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#ae9e90"
                        }
                    ]
                },
                {
                    "featureType": "landscape.natural",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#dfd2ae"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#dfd2ae"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#93817c"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#a5b076"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#447530"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f5f1e6"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#fdfcf8"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f8c967"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#e9bc62"
                        }
                    ]
                },
                {
                    "featureType": "road.highway.controlled_access",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#e98d58"
                        }
                    ]
                },
                {
                    "featureType": "road.highway.controlled_access",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#db8555"
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#806b63"
                        }
                    ]
                },
                {
                    "featureType": "transit.line",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#dfd2ae"
                        }
                    ]
                },
                {
                    "featureType": "transit.line",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#8f7d77"
                        }
                    ]
                },
                {
                    "featureType": "transit.line",
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "color": "#ebe3cd"
                        }
                    ]
                },
                {
                    "featureType": "transit.station",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#dfd2ae"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#b9d3c2"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#92998d"
                        }
                    ]
                }
            ];
            _this.map.setOptions({styles: themeStyle});
            APIStorage.create('map-theme','retro');
        });
    },
    getStyleThemeMap: function (themeMap) {
        themeMap = themeMap || 'silver';
        var styleThemeMap = [
                {
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f5f5f5"
                        }
                    ]
                },
                {
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#616161"
                        }
                    ]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "color": "#f5f5f5"
                        }
                    ]
                },
                {
                    "featureType": "administrative.land_parcel",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#bdbdbd"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#eeeeee"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#757575"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#e5e5e5"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#9e9e9e"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#757575"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#dadada"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#616161"
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#9e9e9e"
                        }
                    ]
                },
                {
                    "featureType": "transit.line",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#e5e5e5"
                        }
                    ]
                },
                {
                    "featureType": "transit.station",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#eeeeee"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#c9c9c9"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#9e9e9e"
                        }
                    ]
                }
            ];

        switch (themeMap) {
            case 'standard':
                styleThemeMap = [];
                break;
            case 'silver':
                styleThemeMap = [
                    {
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#f5f5f5"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#616161"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "color": "#f5f5f5"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.land_parcel",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#bdbdbd"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#eeeeee"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#757575"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#e5e5e5"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#757575"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#dadada"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#616161"
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                        ]
                    },
                    {
                        "featureType": "transit.line",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#e5e5e5"
                            }
                        ]
                    },
                    {
                        "featureType": "transit.station",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#eeeeee"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#c9c9c9"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                        ]
                    }
                ];
                break;
            case 'retro':
                styleThemeMap = [
                    {
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#ebe3cd"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#523735"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "color": "#f5f1e6"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#c9b2a6"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.land_parcel",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#dcd2be"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.land_parcel",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#ae9e90"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.natural",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#dfd2ae"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#dfd2ae"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#93817c"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#a5b076"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#447530"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#f5f1e6"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#fdfcf8"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#f8c967"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#e9bc62"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway.controlled_access",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#e98d58"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway.controlled_access",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#db8555"
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#806b63"
                            }
                        ]
                    },
                    {
                        "featureType": "transit.line",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#dfd2ae"
                            }
                        ]
                    },
                    {
                        "featureType": "transit.line",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#8f7d77"
                            }
                        ]
                    },
                    {
                        "featureType": "transit.line",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "color": "#ebe3cd"
                            }
                        ]
                    },
                    {
                        "featureType": "transit.station",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#dfd2ae"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#b9d3c2"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#92998d"
                            }
                        ]
                    }
                ];
                break;
        }
        return styleThemeMap;
    }

};
var jobMap;
$(document).ready(function () {
    jobMap = new JobMap();
    jobMap.init();
});
