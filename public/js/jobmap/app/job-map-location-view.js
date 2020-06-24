function LocationView(findData, type) {
    this.findData = JSON.parse(findData);
    this.findBy = this.findData.findBy;
    this.type = type;
    this.errorRedirectTo = '/';

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

    this.assignLocations = {};
    this.jobs = {};

    this.map;
    this.items =[];// ={};

    //marker clusterer
    this.mc;
    this.markers = [];
    this.mcOptions = {
        gridSize: 20,
        maxZoom: 17,
        imagePath: "https://cdn.rawgit.com/googlemaps/v3-utility-library/master/markerclustererplus/images/m"
    };
    //global infowindow
    // this.infowindow = new google.maps.InfoWindow();
    //create empty LatLngBounds object
    //this.bounds = new google.maps.LatLngBounds();
    this.bounds;

    this.mapItems = [];
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
            }, 50);
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
            // _this.sort = $(this).val();
            updateQueryStringParam('sort', $(this).val());
            // _this.order = $(this).find('option:selected').attr('data-order');
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

        body.on('click', '.view-job-link', function () {
            var id = $(this).attr('data-id');
            if (_this.assignLocations[id]) {
                if (_this.assignLocations[id].length > 1) {
                    _this.getLocationsList(id);
                    return false;
                } else {
                    if (_this.assignLocations[id].length > 0) {
                        window.location.href = getBaseURLFotMap() + '/map/view/job/' + _this.assignLocations[id][0].job_id;
                    }
                }
            }

            return false;
        });

        var pathArray = window.location.pathname.split('/');
        var zoom;
        switch (pathArray[2]) {
            case 'country':
                zoom = 3;
                break;
            case 'city':
                zoom = 8;
                break;
            case 'street':
                zoom = 13;
                break;
            default:
                zoom = 15;
                break;
        }
        console.log('zoom', zoom, 'patharray',pathArray[2] );
        var address = pathArray.slice(3).toString();
        var gg = new google.maps.Geocoder();
        gg.geocode(
            {
                address: address
            },
            function(results, status) {
                var options = {
                    zoom: zoom,
                    maxZoom: 19,
                    center: results[0].geometry.location,
                    options: {
                        gestureHandling: 'greedy'
                      },
                    styles: []
                };

        _this.map = new google.maps.Map(document.getElementById('map'), options);
            });
        //_this.bounds = new google.maps.LatLngBounds();
        //_this.map.fitBounds(_this.bounds);
        _this.mc = new MarkerClusterer(_this.map, [], _this.mcOptions);
        //_this.map.setOptions({styles: []});
        _this.mapRender();

        
    },

    mapRender: function () {
        var _this = this;
        var i;
        for (i = 0; i < _this.markers.length; i++) {
            _this.markers[i].setMap(null);
        }
        _this.mc.clearMarkers();
        _this.markers = [];
        _this.mapItems = [];
        _this.bounds = new google.maps.LatLngBounds();

        if (_this.items.length > 0) {

            setTimeout(function () {
                var latitude, longitude;
                var id, picture, name;
                var latLng;
                var ids = [];
                for (i = 0; i < _this.items.length; i++) {
                    if (_this.type === 'jobs' || _this.type === 'employers') {
                        $.map(_this.items[i], function (item) {
                            if (ids.indexOf(item.id) === -1) {
                                latitude = item.latitude;
                                longitude = item.longitude;
                                id = item.id;
                                picture = item.business.picture_50;
                                name = item.name;
                                if (latitude != 0 && longitude != 0) {
                                    latLng = new google.maps.LatLng(latitude, longitude);
                                    _this.createMapItem(latLng, id, picture, name);
                                }
                                ids.push(item.id);
                            }
                        });
                    } else {
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

                }

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
        }

    },
    createMapItem: function (latlng, id, picture, name, slug) {
        slug = slug || '';
        var _this = this;
        var n = true;
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
        /*google.maps.event.addListener(marker, 'click', function () {
            var newCenter = {
                lat: this.latlng.lat(),
                lng: this.latlng.lng()
            };

            _this.map.panTo(newCenter);
            if ( $('.jobmap_object_view').length > 0 && $('.jobmap_filter').length > 0) {
                var offset_x = $('.jobmap_object_view').width() - $('.jobmap_filter').width();
                _this.map.panBy(offset_x,0);
                _this.markerModal(id);
            } else if ($('.jobmap_object_view').length > 0) {
                var offset_x = $('.jobmap_object_view').width();
                _this.map.panBy(offset_x/2,0);
                _this.markerModal(id);
            }
        });*/
        _this.markers.push(marker);
        return _this.mc.addMarker(marker);
    },
    /*mapRender: function () {
        var _this = this;

        var options = {
            maxZoom: 19,
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
        };
        _this.map = new google.maps.Map(document.getElementById('map'), options);
        //now fit the map to the newly inclusive bounds
        _this.map.fitBounds(_this.bounds);
        //marker cluster
        _this.mc = new MarkerClusterer(_this.map, [], _this.mcOptions);
        for (var i = 0; i < _this.items.length; i++) {
            var latitude = _this.items[i].latitude;
            var longitude = _this.items[i].longitude;
            var id = _this.items[i].id;
            var picture = _this.items[i].business.picture_50;
            if (latitude != 0 && longitude != 0) {
                var latLng = new google.maps.LatLng(latitude, longitude);
                _this.createMapItem(latLng, id, picture);
            }
        }
        var allMapItems = _this.mapItems;
        if (_this.mapItems !== 0) {
            for (var i = 0; i < allMapItems.length; i++) {
                var a = _this.createMapMarker(allMapItems[i].latLng, allMapItems[i].ids, allMapItems[i].pictures);
            }
        }
    },
    createMapItem: function (latlng, id, picture) {
        var _this = this;
        var allMapItems = _this.mapItems;
        var n = true;
        if (_this.mapItems !== 0) {
            for (var i = 0; i < allMapItems.length; i++) {
                if (allMapItems[i].latLng.equals(latlng)) {
                    allMapItems[i]['ids'].push(id);
                    allMapItems[i]['pictures'].push(picture);
                    n = false;
                    break;
                }
            }
            if (n) {
                allMapItems.push({
                    'latLng': latlng,
                    'ids': [id],
                    'pictures': [picture]
                });
            }
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
            _this.markerModal(id);
        });
        return _this.mc.addMarker(marker);
    },*/
    markerModal: function (ids) {
        if (ids.length > 1) {
            $('#modal-locations-list').modal('show');
            this.getLocationsList(ids);
        } else {
            $('#modal-single-location').modal('show');
            this.getLocation(ids);
        }
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
    getLocationsList: function (id) {
        var _this = this;
        var modal = $('#modal-job-locations-list');

        var html = '';
        if (_this.assignLocations[id]) {
            $.map(_this.assignLocations[id], function (item) {
                html += '<div class="d-flex align-items-center justify-content-between mb-3 flex-lg-row flex-column">\n' +
                    '                        <div class="d-inline-flex align-items-center mr-2 mxa-0 flex-lg-row flex-column" style="flex: 1">\n' +
                    '                            <div class="rounded p-1 bg-white d-inline-block mr-2 mxa-0"\n' +
                    '                                 style="box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);">\n' +
                    '                                <img class="location-pic" src="' + item.business.picture_50 + '">\n' +
                    '                            </div>\n' +
                    '                            <h6 class="h6 mb-0">' + item.name + '' +
                    '<p>' + item.street + ' ' + item.street_number + ',' + item.city + ',' + item.country + '</p></h6>\n' +
                    '                        </div>\n' +
                    '                        <div class="d-inline-flex align-items-center">\n' +
                    '                            <p class="mb-0 mr-2"><a href="/map/view/job/' + item.job_id + '">'+Langs.view_job+'</a></p>\n' +
                    '                        </div>\n' +
                    '                    </div>';
            });
        }
        $('#modal-job-name').text(_this.jobs[id]);
        modal.find('#count-job-locations span').text(_this.assignLocations[id].length);
        modal.find('.modal-body').html(html);
        modal.modal('show');
    },
    getItems: function () {
        var _this = this;
        var el = $('#items-list');
        var params = {};
        var query;
        var search;
        var param = '';
        var assignParams = '';
        if (getUrlParameter('sort'))
            params['sort'] = getUrlParameter('sort');
        if (getUrlParameter('order'))
            params['order'] = getUrlParameter('order');
        params['limit'] = (getUrlParameter('limit')) ? +getUrlParameter('limit') : this.perPage;
        params['page'] = (getUrlParameter('page')) ? +getUrlParameter('page') : this.currentPage;
        search = this.search;

        switch (_this.type) {
            case 'locations':
                query = 'businessLocations';
                params['type'] = 'location';
                break;
            case 'headquarters':
                query = 'businessLocations';
                params['type'] = 'headquarter';
                break;
            case 'jobs':
                query = 'mapJobs';
                assignParams = ' title assign_locations {id job_id business{picture_50(width:50,height:50)} name street street_number city region country created_date job_status}';
                if (getUrlParameter('filters')) {
                    params['filters'] = getUrlParameter('filters');
                }
                break;
            default:
                query = 'mapBusinesses';
                break;
        }
        switch (_this.findBy) {
            case 'country':
                params['country'] = _this.findData.country;
                break;
            case 'city':
                params['city'] = _this.findData.city;
                params['country'] = _this.findData.country;
                break;
            case 'region':
                params['region'] = _this.findData.region;
                params['country'] = _this.findData.country;
                break;
            case 'street':
                params['street'] = _this.findData.street;
                params['city'] = _this.findData.city;
                params['country'] = _this.findData.country;
                break;
            case 'address':
                params['street_number'] = _this.findData.street_number;
                params['street'] = _this.findData.street;
                params['city'] = _this.findData.city;
                params['country'] = _this.findData.country;
                break;
        }
        params['findBy'] = _this.findBy;
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
            'id html_career ' + assignParams +
            '}',
            'pages',
            'count',
            'current_page ' + param
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            el.html('');
            if (data.items) {
                var html = '';
                var i = 0;
                $.map(data.items, function (item) {
                    html += item.html_career;
                    if (_this.type === 'jobs') {
                        if (item.assign_locations) {
                            _this.assignLocations[item.id] = item.assign_locations;
                        }
                        _this.jobs[item.id] = item.title;
                    }
                });
                el.html(html);
            }
            _this.countPages = data.pages;
            _this.pagination(data.pages);
        }).request(el, false, true);
    },
    setAssignLocations: function(data){
        var _this = this;
        var i = 0;
        $.map(data.items, function (item) {
            if (_this.type === 'jobs' || _this.type === 'employers') {
                if (item.assign_locations) {
                    //_this.assignLocations[item.id] = item.assign_locations;
                    _this.items[i] = item.assign_locations;
                    i++;
                }
                _this.jobs[item.id] = item.title;
            } else {
                _this.items[i] = item;
                i++;
            }
        });
    },
    pagination: function (pages, type) {
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
