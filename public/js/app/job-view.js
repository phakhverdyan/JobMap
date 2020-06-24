function JobView(id) {
    this.id = id;
    this.businessID;
    this.locationID;
    this.latitude;
    this.longitude;
    this.errorRedirectTo = '/';

    this.map;

    this.perPageElement = '.perpage';

    this.localGroup = $('.job-group[data-group="locations"]');
    this.jobGroup = $('.job-group[data-group="jobs"]');

    this.sortElementLocal = $('#locations-sort');
    this.searchElementLocal = $('#locations-search');
    this.nearbyElementLocal = '#locations-nearby';

    this.nearbyLocal = 1;
    this.perPageLocal = 3;
    this.countPagesLocal = 1;
    this.currentPageLocal = 1;
    this.sortLocal;
    this.orderLocal;
    this.searchLocal;

    this.sortElementJob = $('#jobs-sort');
    this.searchElementJob = $('#jobs-search');
    this.nearbyElementJob = '#jobs-nearby';

    this.nearbyJob = 1;
    this.perPageJob = 3;
    this.countPagesJob = 1;
    this.currentPageJob = 1;
    this.sortJob;
    this.orderJob;
    this.searchJob;
    this.statusJob = 1;

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

    this.assignLocations = {};
    this.jobs = {};
}

JobView.prototype = {
    init: function () {
        var _this = this;
        var body = $('body');

        this.localGroup.find('#locations-limit').on('change', function () {
            var limit = $(this).val();
            _this.perPageLocal = +limit;
            _this.currentPageLocal = 1;
            var keywords = _this.searchElementLocal.val().trim();
            setTimeout(function () {
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'location');
            }, 0);
        });
        var timeout2 = null;
        this.localGroup.find('#locations-search').on('keyup', function (e) {
            if (e.which <= 90 && e.which >= 48 || e.which === 13 || e.which === 8) {
                var keywords = $(this).val();
                _this.currentPageLocal = 1;
                clearTimeout(timeout2);
                timeout2 = setTimeout(function () {
                    _this.getItems(keywords.trim(), 'location');
                }, 500);
            }
        });
        this.localGroup.on('click', '.pagination-locations .page-link.page-page', function () {
            _this.currentPageLocal = +$(this).text();
            var keywords = _this.searchElementLocal.val().trim();
            _this.getItems((keywords.length <= 1) ? undefined : keywords, 'location');
        });
        this.localGroup.on('click', '.pagination-locations .page-prev', function () {
            if (_this.currentPageLocal > 1) {
                _this.currentPageLocal -= 1;
                var keywords = _this.searchElementLocal.val().trim();
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'location');
            }
        });
        this.localGroup.on('click', '.pagination-locations .page-next', function () {
            if (_this.currentPageLocal < _this.countPagesLocal) {
                _this.currentPageLocal += 1;
                var keywords = _this.searchElementLocal.val().trim();
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'location');
            }
        });
        //set sort & order for items
        this.sortElementLocal.change(function () {
            _this.sortLocal = $(this).val();
            _this.orderLocal = $(this).find('option:selected').attr('data-order');
            _this.currentPageLocal = 1;
            var keywords = _this.searchElementLocal.val().trim();
            setTimeout(function () {
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'location');
            }, 0);
        });
        //set nearby radius for locations
        this.localGroup.on('change', _this.nearbyElementLocal, function () {
            _this.nearbyLocal = $(this).val();
            _this.currentPageLocal = 1;
            var keywords = _this.searchElementLocal.val().trim();
            setTimeout(function () {
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'location');
            }, 0);
        });


        this.jobGroup.find('#jobs-limit').on('change', function () {
            var limit = $(this).val();
            _this.perPageJob = +limit;
            _this.currentPageJob = 1;
            var keywords = _this.searchElementJob.val().trim();
            setTimeout(function () {
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'job');
            }, 0);
        });
        var timeout3 = null;
        this.jobGroup.find('#jobs-search').on('keyup', function (e) {
            if (e.which <= 90 && e.which >= 48 || e.which === 13 || e.which === 8) {
                var keywords = $(this).val();
                _this.currentPageJob = 1;
                clearTimeout(timeout3);
                timeout3 = setTimeout(function () {
                    _this.getItems(keywords.trim(), 'job');
                }, 500);
            }
        });
        this.jobGroup.on('click', '.pagination-jobs .page-link.page-page', function () {
            _this.currentPageJob = +$(this).text();
            var keywords = _this.searchElementJob.val().trim();
            _this.getItems((keywords.length <= 1) ? undefined : keywords, 'job');
        });
        this.jobGroup.on('click', '.pagination-jobs .page-prev', function () {
            if (_this.currentPageJob > 1) {
                _this.currentPageJob -= 1;
                var keywords = _this.searchElementJob.val().trim();
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'job');
            }
        });
        this.jobGroup.on('click', '.pagination-jobs .page-next', function () {
            if (_this.currentPageJob < _this.countPagesJob) {
                _this.currentPageJob += 1;
                var keywords = _this.searchElementJob.val().trim();
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'job');
            }
        });
        //set sort & order for items
        this.sortElementJob.change(function () {
            _this.sortJob = $(this).val();
            _this.orderJob = $(this).find('option:selected').attr('data-order');
            _this.currentPageJob = 1;
            var keywords = _this.searchElementJob.val().trim();
            setTimeout(function () {
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'job');
            }, 0);
        });
        //set nearby radius for jobs
        this.jobGroup.on('change', _this.nearbyElementJob, function () {
            _this.nearbyJob = $(this).val();
            _this.currentPageJob = 1;
            var keywords = _this.searchElementJob.val().trim();
            setTimeout(function () {
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'job');
            }, 0);
        });
        this.jobGroup.on('click', '#jobs_open', function () {
            var keywords = _this.searchElementJob.val().trim();
            if (!$(this).hasClass('btn btn-primary')) {
                _this.statusJob = 1;
                _this.currentPageJob = 1;
                $(this).addClass('active');
                $('#jobs_close').removeClass('active');
                _this.jobGroup.find('#jobs_close').removeClass('btn btn-primary').addClass('btn btn-default');
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'job');
            }
        });
        this.jobGroup.on('click', '#jobs_close', function () {
            var keywords = _this.searchElementJob.val().trim();
            if (!$(this).hasClass('btn btn-primary')) {
                _this.statusJob = 0;
                _this.currentPageJob = 1;
                $(this).addClass('active');
                $('#jobs_open').removeClass('active');
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'job');
            }
        });

        this.jobGroup.on('click', '.blockorlist', function () {
            var type = $(this).attr('data-type');
            _this.itemsType = type;
            if (type === 'list') {
                $('#jobs-accordion-list').removeClass('hide');
                $('#map-items').addClass('hide');
            } else {
                $('#jobs-accordion-list').addClass('hide');
                $('#map-items').removeClass('hide');
            }
        });

        this.localGroup.on('click', '.blockorlist', function () {
            var type = $(this).attr('data-type');
            _this.itemsType = type;
            if (type === 'list') {
                $('#locations-accordion-list').removeClass('hide');
                $('#locations-items').addClass('hide');
            } else {
                $('#locations-accordion-list').addClass('hide');
                $('#locations-items').removeClass('hide');
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

        this.jobGroup.on('click', '.view-job-link', function () {
            var id = $(this).attr('data-id');
            if (_this.assignLocations[id]) {
                if (_this.assignLocations[id].length > 1) {
                    _this.getLocationsList(id);
                } else {
                    if (_this.assignLocations[id].length > 0) {
                        window.location.href = '/map/view/job/' + _this.assignLocations[id][0].job_id;
                    } else {
                        window.location.href = '/map/view/job/' + id;
                    }
                }
            }

            return false;
        });
    },
    renderMap: function(latitude, longitude, id, picture){
        var _this = this;
        var myLatLng = {lat: latitude, lng: longitude};
        var latLng = new google.maps.LatLng(latitude, longitude);
        _this.map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            maxZoom: 19,
            options: {
                gestureHandling: 'greedy'
              },
            center: myLatLng,
            styles: [
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
    getLocationsList: function (id) {
        var _this = this;
        var modal = $('#modal-job-locations-list');

        var html = '';
        if (_this.assignLocations[id]) {
            $.map(_this.assignLocations[id], function (item) {
                html += '<div class="d-flex align-items-center justify-content-between mb-3">\n' +
                    '                        <div class="d-inline-flex align-items-center mr-2" style="flex: 1">\n' +
                    '                            <div class="rounded p-1 bg-white d-inline-block mr-2"\n' +
                    '                                 style="box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);">\n' +
                    '                                <img class="location-pic" src="' + item.business.picture_50 + '">\n' +
                    '                            </div>\n' +
                    '                            <h6 class="h6 mb-0">' + item.name + '</a></h6>\n' +
                    '                        </div>\n' +
                    '                        <div class="d-inline-flex align-items-center">\n' +
                    '                            <p class="mb-0 mr-2"><a href="/map/view/job/' + item.job_id + '">View Job</a></p>\n' +
                    '                        </div>\n' +
                    '                    </div>';
            });
        }
        $('#modal-job-name').text(_this.jobs[id]);
        modal.find('#count-job-locations span').text(_this.assignLocations[id].length);
        modal.find('.modal-body').html(html);
        modal.modal('show');
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
        var jobOpen = $('#filter-job-open').prop('checked');

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
        if (jobOpen) {
            filters += 'jobs_open:1;'
        }
        if (filters.length !== 0 || (filters.length === 0 && getUrlParameter('filters'))) {
            updateQueryStringParam('filters', filters);
            var keywords = _this.searchElementJob.val().trim();
            setTimeout(function () {
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'job');
            }, 0);
            if (filters.length === 0) {
                removeQueryStringParam('filters');
            }
        }
        $('#jobfiltermodal').modal('hide');
    },
    msFields: function (filters) {
        var _this = this;

        var body = $('body');

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
                            body.find('#filter-hours').val(info);
                            break;
                        case 'salary':
                            body.find('#filter-salary').val(info);
                            break;
                        case 'jobs_open':
                            body.find('#filter-job-open').prop('checked', true);
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
            "business_id": _this.businessID,
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
                    placeholder: 'Choose departments',
                    toggleOnClick: true,
                    allowFreeEntries: false,
                    data: data.items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> not found',
                    cls: 'jack'
                });
            }
            if (data.default) {
                _this.msDepartments.setSelection(data.default);
            }
        }).request(_this.msDepartmentsElement);

        this.getMSList(function (items, defaultData) {
            _this.msJobTypes = _this.msJobTypesElement.magicSuggest({
                placeholder: 'Type job type',
                toggleOnClick: true,
                allowFreeEntries: false,
                data: items,
                hideTrigger: true,
                noSuggestionText: '<strong>{{query}}</strong> not found',
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
                placeholder: 'Type career level',
                toggleOnClick: true,
                allowFreeEntries: (filters) ? false : true,
                data: items,
                hideTrigger: true,
                noSuggestionText: (filters) ? '<strong>{{query}}</strong> not found' : '<strong>{{query}}</strong> not found, press enter to add',
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
                placeholder: 'Type language level',
                toggleOnClick: true,
                allowFreeEntries: (filters) ? false : true,
                data: items,
                hideTrigger: true,
                noSuggestionText: (filters) ? '<strong>{{query}}</strong> not found' : '<strong>{{query}}</strong> not found, press enter to add',
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
                placeholder: 'Type a certificate name and press enter (we do tags with them)',
                toggleOnClick: true,
                allowFreeEntries: (filters) ? false : true,
                data: items,
                hideTrigger: true,
                noSuggestionText: (filters) ? '<strong>{{query}}</strong> not found' : '<strong>{{query}}</strong> not found, press enter to add',
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
    getItems: function (keywords, type) {
        var _this = this;
        // var el = $('#' + type + 's-list');
        var el = $('#' + type + 's-list');
        var elList = $('#' + type + 's-accordion-list');
        var params = {
            "latitude": this.latitude,
            "longitude": this.longitude
        };
        var query = 'nearbyLocations';
        var search;
        var param = '';
        var assignParams = '';
        switch (type) {
            case 'location':
                if (this.sortLocal)
                    params['sort'] = this.sortLocal;
                if (this.orderLocal)
                    params['order'] = this.orderLocal;
                params['location_id'] = this.locationID;
                params['limit'] = this.perPageLocal;
                params['page'] = this.currentPageLocal;
                params['nearby'] = +this.nearbyLocal;
                search = this.searchLocal;
                break;
            case 'job':
                if (this.sortJob)
                    params['sort'] = this.sortJob;
                if (this.orderJob)
                    params['order'] = this.orderJob;
                params['limit'] = this.perPageJob;
                params['job_id'] = this.id;
                params['page'] = this.currentPageJob;
                params['status'] = this.statusJob;
                params['join'] = 1;
                params['nearby'] = +this.nearbyJob;
                search = this.searchJob;
                query = 'nearbyJobs';
                param = 'jobs_open jobs_close';
                assignParams = ' title assign_locations {id job_id business{picture_50(width:50,height:50)} name street street_number city region country created_date job_status}';
                if (getUrlParameter('filters')) {
                    params['filters'] = getUrlParameter('filters');
                }
                break;
        }
        if (typeof keywords !== 'undefined') {
            if (keywords.length > 1) {
                params['keywords'] = keywords;
                if (type === 'location') {
                    this.searchLocal = 0;
                } else if (type === 'job') {
                    this.searchJob = 0;
                }
            } else {
                if (search === 1) {
                    return;
                } else {
                    if (type === 'location') {
                        this.searchLocal = 1;
                    } else if (type === 'job') {
                        this.searchJob = 1;
                    }
                }
            }
        }
        new GraphQL("query", query, params, [
            'items {' +
            'id html_career html_career_list ' + assignParams +
            '}',
            'pages',
            'count',
            'current_page ' + param
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            el.html('');
            elList.html('');
            $('.business-group[data-group="' + type + 's"]').find('.group-count span').text(data.count);
            if (data.items) {
                var html = '';
                var htmlList = '';
                var i = 0;
                $.map(data.items, function (item) {
                    if (i === 0) {
                        html += '<div class="row pb-5">';
                    }
                    html += item.html_career;
                    htmlList += item.html_career_list;
                    i++;
                    if (i === 3) {
                        html += '</div>';
                        htmlList += '</div>';
                        i = 0;
                    }
                    if (type === 'job') {
                        if (item.assign_locations) {
                            _this.assignLocations[item.id] = item.assign_locations;
                        }
                        _this.jobs[item.id] = item.title;
                    }
                });
                el.html(html);
                elList.html(htmlList);
            }
            if (type === 'location') {
                _this.countPagesLocal = data.pages;
            } else if (type === 'job') {
                _this.countPagesJob = data.pages;
                _this.jobGroup.find('.group-count span').text(data.jobs_open + data.jobs_close);
                _this.jobGroup.find('#jobs_open span').text(data.jobs_open);
                _this.jobGroup.find('#jobs_close span').text(data.jobs_close);
            }
            _this.pagination(data.pages, type);
        }).request(el, false, true);
    },
    mapCenter: function () {
        var center = this.map.getCenter();
        google.maps.event.trigger(this.map, "resize");
        this.map.setCenter(center);
    },
    pagination: function (pages, type) {
        var _this = this;
        var html = '';
        var el = $('.pagination-' + type + 's');
        var current = _this.currentPageHead;
        if (type === 'location') {
            current = _this.currentPageLocal;
        } else if (type === 'job') {
            current = _this.currentPageJob;
        }
        if (pages > 1) {
            html = '<li class="page-item"><a class="page-link page-prev" href="javascript:void(0)"><</a></li>';
            for (var i = 1; i <= pages; i++) {
                var active = '';
                if (current === i) {
                    active = 'active';
                }
                html += '<li class="page-item ' + active + '"><a class="page-link page-page" href="javascript:void(0)">' + i + '</a></li>';
            }
            html += '<li class="page-item"><a class="page-link page-next" href="javascript:void(0)">></a></li>';
        }
        el.html(html);
    }
};