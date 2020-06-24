function LocationView(id, businessID) {
    this.id = id;
    this.businessID = businessID;
    this.errorRedirectTo = '/';

    this.map;

    this.sortElement = $('#items-sort');
    this.searchElement = $('#items-search');

    this.perPage = 25;
    this.countPages = 1;
    this.currentPage = 1;
    this.sort;
    this.order;
    this.search;

    this.msDepartments;
    this.msDepartmentsElement = $('#department');
    this.msJobTypes;
    this.msJobTypesElement = $('#job_type');
    this.msCareerLevel;
    this.msCareerLevelElement = $('#career_level');
    this.msLanguages;
    this.msLanguagesElement = $('#language_level');
    this.msCertificates;
    this.msCertificatesElement = $('#certification_required');

    this.assigmentData = {};
    this.loadLocationsData = {};

    this.loadFilters = 0;

    this.itemsType = 'list';
}

LocationView.prototype = {
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
                _this.getItems();
            }, 0);
        });
        var timeout1 = null;
        $('#items-search').on('keyup', function (e) {
            if (e.which <= 90 && e.which >= 48 || e.which === 13 || e.which === 8) {
                var keywords = $(this).val();
                _this.currentPage = 1;
                clearTimeout(timeout1);
                timeout1 = setTimeout(function () {
                    updateQueryStringParam('keywords', keywords);
                    updateQueryStringParam('page', _this.currentPage);
                    setTimeout(function () {
                        _this.getItems();
                    }, 100);
                }, 500);
            }
        });
        //set sort & order for items
        this.sortElement.change(function () {
            updateQueryStringParam('sort', $(this).val());
            updateQueryStringParam('order', $(this).find('option:selected').attr('data-order'));
            _this.currentPage = 1;
            setTimeout(function () {
                _this.getItems();
            }, 100);
        });

        body.on('click', '.page-link.page-page', function () {
            _this.currentPage = +$(this).text();
            updateQueryStringParam('page', _this.currentPage);
            setTimeout(function () {
                _this.getItems();
            }, 100);
        });
        body.on('click', '.page-prev', function () {
            if (_this.currentPage > 1) {
                _this.currentPage -= 1;
                updateQueryStringParam('page', _this.currentPage);
                setTimeout(function () {
                    _this.getItems();
                }, 100);
            }
        });
        body.on('click', '.page-next', function () {
            if (_this.currentPage < _this.countPages) {
                _this.currentPage += 1;
                updateQueryStringParam('page', _this.currentPage);
                setTimeout(function () {
                    _this.getItems();
                }, 100);
            }
        });
        body.on('click', '.page-last', function () {
            if (_this.currentPage !== _this.countPages) {
                _this.currentPage = _this.countPages;
                updateQueryStringParam('page', _this.currentPage);
                setTimeout(function () {
                    _this.getItems();
                }, 100);
            }
        });

        body.on('click', '#filters-modal', function () {
            if (_this.loadFilters === 0) {
                _this.msFields(true);
                _this.loadFilters = 1;
            }
        });
        body.on('click', '#set-filters', function () {
            _this.setFilters();
        });
        body.on('click', '#clear-filters', function () {
            _this.msCareerLevel.setSelection([]);
            _this.msDepartments.setSelection([]);
            _this.msCertificates.setSelection([]);
            _this.msLanguages.setSelection([]);
            _this.msJobTypes.setSelection([]);
            $('#jobfiltermodal').find('input').val('');
            _this.setFilters();
        });

        $('#map-resize').on('click', function () {
            var height = 150;
            var text = $(this).attr('data-text');
            if (!$(this).hasClass('bigger')) {
                height = 400;
            }
            var btn = $(this);
            $("#map").animate({
                height: height + 'px'
            }, 500, function () {
                btn.attr('data-text', btn.text());
                btn.text(text);
                btn.toggleClass('bigger');
                _this.mapCenter();
            });
        });
    },
    renderMap: function (latitude, longitude, id, picture) {
        var _this = this;
        var myLatLng = {lat: latitude, lng: longitude};
        var latLng = new google.maps.LatLng(latitude, longitude);
        _this.map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            maxZoom: 19,
            center: myLatLng,
            options: {
                gestureHandling: 'greedy'
              },
            zoomControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            mapTypeControl: true,
            mapTypeControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: true,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            /*styles: [
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
            ]*/
        });
        new CustomMarker(
            latLng,
            _this.map,
            {
                marker_id: id
            },
            [picture]
        );
        google.maps.event.addDomListener(window, "resize", function () {
            _this.mapCenter();
        });
    },
    setFilters: function () {
        var _this = this;

        var careers = $.map(this.msCareerLevel.getSelection(), function (item) {
            return item.id;
        }).join(',');
        var types = $.map(this.msJobTypes.getSelection(), function (item) {
            return item.id;
        }).join(',');
        var languages = $.map(this.msLanguages.getSelection(), function (item) {
            return item.id;
        }).join(',');
        var certifications = $.map(this.msCertificates.getSelection(), function (item) {
            return item.id;
        }).join(',');
        var departments = $.map(this.msDepartments.getSelection(), function (item) {
            return item.id;
        }).join(',');
        var hours = $('#filter-hours').val();
        var salary = $('#filter-salary').val();

        var filters = '';
        if (careers.length !== 0) {
            filters += 'careers:' + careers + ';';
        }
        if (types.length !== 0) {
            filters += 'types:' + types + ';';
        }
        if (languages.length !== 0) {
            filters += 'languages:' + languages + ';';
        }
        if (certifications.length !== 0) {
            filters += 'certifications:' + certifications + ';';
        }
        if (departments.length !== 0) {
            filters += 'departments:' + departments + ';';
        }
        if (hours.length !== 0) {
            filters += 'hours:' + hours + ';';
        }
        if (salary.length !== 0) {
            filters += 'salary:' + salary + ';';
        }
        if (filters.length !== 0 || (filters.length === 0 && getUrlParameter('filters'))) {
            updateQueryStringParam('filters', filters);
            _this.currentPage = 1;
            updateQueryStringParam('page', 1);
            setTimeout(function () {
                _this.getItems();
            }, 0);
            if (filters.length === 0) {
                removeQueryStringParam('filters');
            }
        }
        $('#jobfiltermodal').modal('hide');
    },
    msFields: function (filters) {
        var _this = this;

        var departments;
        var types;
        var careers;
        var certifications;
        var languages;
        if (getUrlParameter('filters')) {
            var filters = getUrlParameter('filters');
            var filtersData = explode(';', filters);
            for (var i = 0; i < filtersData.length; i++) {
                if (filtersData[i].length !== 0) {
                    var data = explode(':', filtersData[i]);
                    var name = data[0];
                    var info = (data[1]) ? data[1] : false;
                    switch (name) {
                        case 'hours':
                            _this.form.find('#filter-hours').val(info);
                            break;
                        case 'salary':
                            _this.form.find('#filter-salary').val(info);
                            break;
                        case 'jobs_open':
                            _this.form.find('#filter-job-open').prop('checked', true);
                            break;
                        case 'departments':
                            departments = info;
                            break;
                        case 'types':
                            types = info;
                            break;
                        case 'careers':
                            careers = info;
                            break;
                        case 'languages':
                            languages = info;
                            break;
                        case 'certifications':
                            certifications = info;
                            break;
                    }
                }
            }
        }

        var params = {
            "business_id": _this.id,
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
                allowFreeEntries: (filters) ? false : true,
                data: items,
                hideTrigger: true,
                noSuggestionText: (filters) ? '<strong>{{query}}</strong> ' + Langs.not_found : '<strong>{{query}}</strong> ' + Langs.not_found_add,
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
                allowFreeEntries: (filters) ? false : true,
                data: items,
                hideTrigger: true,
                noSuggestionText: (filters) ? '<strong>{{query}}</strong> ' + Langs.not_found : '<strong>{{query}}</strong> ' + Langs.not_found_add,
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
                allowFreeEntries: (filters) ? false : true,
                data: items,
                hideTrigger: true,
                noSuggestionText: (filters) ? '<strong>{{query}}</strong> ' + Langs.not_found : '<strong>{{query}}</strong> ' + Langs.not_found_add,
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

    },
    getMSList: function (callback, method, el, keywords, defaultData) {
        var params = {};
        var need = ['items{id name}'];
        if (keywords) {
            if (keywords.length > 1) {
                params['keywords'] = keywords;
            }
        }
        if (defaultData) {
            params['default'] = defaultData;
            need.push('default{id name}')
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
    getItems: function () {
        var _this = this;
        var el = $('#items-list');
        var params = {
            "location_id": this.id,
            "business_id": this.businessID
        };
        var query = 'mapJobs';
        var search;
        if (getUrlParameter('sort'))
            params['sort'] = getUrlParameter('sort');
        if (getUrlParameter('order'))
            params['order'] = getUrlParameter('order');
        params['limit'] = (getUrlParameter('limit')) ? +getUrlParameter('limit') : this.perPage;
        params['page'] = (getUrlParameter('page')) ? +getUrlParameter('page') : this.currentPage;
        search = this.search;

        var param = 'jobs_open jobs_close';
        var assignParams = ' title ';
        if (getUrlParameter('filters')) {
            params['filters'] = getUrlParameter('filters');
        }
        if (getUrlParameter('keywords')) {
            if (getUrlParameter('keywords').length > 0) {
                params['keywords'] = getUrlParameter('keywords');
                this.search = 0;
            } else {
                if (search === 1) {
                    return;
                } else {
                    this.search = 1;
                }
            }
        }
        new GraphQL("query", query, params, [
            'items {' +
            'id html_career status status_in_location ' + assignParams +
            '}',
            'pages',
            'count',
            'jobs_open',
            'jobs_close',
            'current_page ' + param
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            el.find('#block-opened-jobs').html('');
            el.find('#block-closed-jobs').html('');
            if (data.items) {
                var htmlO = '', htmlC = '';
                $.map(data.items, function (item) {
                    if (item.status_in_location) {
                        htmlO += item.html_career;
                    } else {
                        htmlC += item.html_career;
                    }
                });
                el.find('#block-opened-jobs').html(htmlO);
                el.find('#block-closed-jobs').html(htmlC);
                $('#job-o-count').text(data.jobs_open);
                $('#job-c-count').text(data.jobs_close);
            }
            _this.countPages = data.pages;
            _this.pagination(data.pages);
        }).request(el, false, true);
    },
    mapCenter: function () {
        var center = this.map.getCenter();
        google.maps.event.trigger(this.map, "resize");
        this.map.setCenter(center);
    },
    pagination: function (pages) {
        var _this = this;
        var html = '';
        var el = $('#items-pagination');
        var current = _this.currentPage;
        if (pages > 1) {
            html = '<li class="page-item"><a class="page-link page-prev" href="javascript:void(0)">'+Langs.previous+'</a></li>';
            for (var i = 1; i <= pages; i++) {
                var active = '';
                if (current === i) {
                    active = 'active';
                }
                html += '<li class="page-item ' + active + '"><a class="page-link page-page" href="javascript:void(0)">' + i + '</a></li>';
            }
            html += '<li class="page-item"><a class="page-link page-next" href="javascript:void(0)">'+Langs.next+'</a></li>';
            html += '<li class="page-item"><a class="page-link page-last" href="javascript:void(0)">'+Langs.last+'</a></li>';
        }
        el.html(html);
    }
};