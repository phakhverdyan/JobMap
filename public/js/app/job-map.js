function JobMap() {
    this.items;

    this.msIndustry;
    this.msIndustryElement = $('#industry');
    this.msJobTypes;
    this.msJobTypesElement = $('#job_type');
    this.msCareerLevel;
    this.msCareerLevelElement = $('#career_level');

    this.msLoad = 0;

    this.filterJobStatus;
    this.filterHoursFrom;
    this.filterHoursTo;

    this.map;

    //marker clusterer
    this.mc;
    this.mcOptions = {
        gridSize: 20,
        maxZoom: 17,
        imagePath: "https://cdn.rawgit.com/googlemaps/v3-utility-library/master/markerclustererplus/images/m"
    };
    //global infowindow
    // this.infowindow = new google.maps.InfoWindow();
    //create empty LatLngBounds object
    this.bounds = new google.maps.LatLngBounds();

    this.mapItems = [];
}

JobMap.prototype = {
    init: function () {
        var _this = this;

        this.getLocations();
        $('#job-map').height($(window).height() - 40);

        $('#dropdownMenuButton').on('click', function () {
            if (_this.msLoad === 0) {
                _this.initMS();
                _this.msLoad = 1;
            }
        });

        $('#map-set-filters').on('click', function () {
            $('#modal-filters').modal('hide');
            _this.filters();
        });

        $('body').on('click', '#location-more-info', function () {
            var id = $(this).attr('data-id');
            window.location.href = '/map/view/location/' + id;
        });
        $('body').on('click', '#locations-more-info', function () {
            var id = $(this).attr('data-id');
            window.location.href = id;
        });
    },
    initMS: function () {
        var _this = this;
        this.getMSList(function (items) {
            _this.msJobTypes = _this.msJobTypesElement.magicSuggest({
                placeholder: 'Type job type',
                toggleOnClick: true,
                allowFreeEntries: false,
                data: items,
                hideTrigger: true,
                noSuggestionText: '<strong>{{query}}</strong> not found',
                cls: 'jack'
            });
            var timeout = null;
            $(_this.msJobTypes).on('keyup', function () {
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    _this.getMSList(function (items) {
                        _this.msJobTypes.setData(items);
                    }, 'jobTypes', _this.msJobTypesElement, _this.msJobTypes.getRawValue());
                }, 500);
            });
        }, 'jobTypes', _this.msJobTypesElement);

        this.getMSList(function (items) {
            _this.msCareerLevel = _this.msCareerLevelElement.magicSuggest({
                placeholder: 'Type career level',
                toggleOnClick: true,
                allowFreeEntries: false,
                data: items,
                hideTrigger: true,
                noSuggestionText: '<strong>{{query}}</strong> not found',
                cls: 'jack'
            });
            var timeout = null;
            $(_this.msCareerLevel).on('keyup', function () {
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    _this.getMSList(function (items) {
                        _this.msCareerLevel.setData(items);
                    }, 'careerLevels', _this.msCareerLevelElement, _this.msCareerLevel.getRawValue());
                }, 500);
            });
        }, 'careerLevels', _this.msCareerLevelElement);
    },
    filters: function () {
        var _this = this;

        if ($('#filter-jobs:checked').length === 1) {
            _this.filterJobStatus = true;
        }
        var hours = $('#slider-hours').slider('values');
        _this.filterHoursFrom = hours[0];
        _this.filterHoursTo = hours[1];

        _this.getLocations();
    },
    getMSList: function (callback, method, el, keywords) {
        var params = {};
        if (keywords) {
            if (keywords.length > 1) {
                params['keywords'] = keywords;
            }
        }
        new GraphQL("query", method, params, ['items{id name}'], false, false, function (data) {
            //show error
        }, function (data) {
            if (data) {
                var items = $.map(data.items, function (item) {
                    return {
                        id: item.id,
                        name: item.name
                    };
                });
                callback(items);
            }
        }).request(el);
    },
    mapRender: function () {
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
        _this.map = new google.maps.Map(document.getElementById('job-map'), options);
        //now fit the map to the newly inclusive bounds
        _this.map.fitBounds(_this.bounds);
        //marker cluster
        _this.mc = new MarkerClusterer(_this.map, [], _this.mcOptions);
        for (var i = 0; i < this.items.length; i++) {
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
    },
    markerModal: function (ids) {
        if (ids.length > 1) {
            $('#modal-locations-list').modal('show');
            this.getLocationsList(ids);
        } else {
            $('#modal-single-location').modal('show');
            this.getLocation(ids);
        }
    },
    setLocations: function (data) {
        this.items = data.items;
        this.mapRender();
    },
    getLocationsList: function (ids) {
        if (ids) {
            var _this = this;

            var params = {
                "id": ids.join(',')
            };
            new GraphQL("query", "locations", params, [
                'id',
                'name',
                'street',
                'street_number',
                'city',
                'country',
                'jobs_count_open',
                'jobs_count',
                'business{id name slug picture_50(width:50,height:50) locations_count}'
            ], false, false, function () {
                Loader.stop();
            }, function (data) {
                var modal = $('#modal-locations-list');

                var html = '';
                $.map(data, function (item) {
                    html += '<div class="d-flex align-items-center justify-content-between mb-3">\n' +
                        '<div class="d-inline-flex align-items-center mr-2" style="flex: 1">\n' +
                        '    <div class="rounded p-1 bg-white d-inline-block mr-2"\n' +
                        '         style="box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);">\n' +
                        '        <img style="width: 70px;" class="location-pic" src="' + item.business.picture_50 + '">\n' +
                        '    </div>\n' +
                        '<div>' +
                        '    <h6 class="h6 mb-0"><a data-toggle="tooltip" data-placement="top" data-original-title="View ' + item.business.name + ' jobs in this location" href="' + getBaseURL() + '/business/view/' + item.business.id + '/' + item.business.slug + '" target="_blank">' + item.business.name + '</a></h6>\n';
                    if (item.business.locations_count > 1) {
                        html += '    <h6 class="h6 mb-0"><a href="/map/view/location/' + item.id + '" target="_blank">' + item.name + '</a></h6>';
                    }
                    html += '</div></div>\n' +
                        '<div class="d-inline-flex align-items-center">\n' +
                        '    <p class="mb-0 mr-2"><a href="/map/view/location/' + item.id + '" target="_blank">' + item.jobs_count + ' Jobs</a></p>\n' +
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

            }).request($('#modal-locations-list').find('.modal-body'), false, true);
        }
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

                modal.find('#link-location-country').text(data.country).attr('href', setLocationURL('country', data));
                modal.find('#link-location-city').text(data.city).attr('href', setLocationURL('city', data));
                modal.find('#link-location-region').text(data.region).attr('href', setLocationURL('region', data));
                modal.find('#link-location-street').text(data.street).attr('href', setLocationURL('street', data));
                modal.find('#link-location-address').text(data.street + ' ' + data.street_number).attr('href', setLocationURL('address', data));

                modal.find('#business_name_header').html('<a href="' + getBaseURL() + '/business/view/' + data.business.id + '/' + data.business.slug + '" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="View ' + data.business.name + ' career page">' + data.business.name + '</a>');
                modal.find('#all-locations').attr('href', getBaseURL() + '/business/view/' + data.business.id + '/' + data.business.slug).attr('target', '_blank');
                modal.find('#all-locations').find('span').text(count);
                modal.find('#location-name').html('<a href="' + getBaseURL() + '/business/view/' + data.business.id + '/' + data.business.slug + '" target="_blank">' + data.name + '</a>');
                modal.find('*[data-id]').attr('data-id', data.id);
                modal.find('.send-resume').attr('data-b-id', data.business.id);
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
        if (_this.filterJobStatus) {
            params['job_status'] = 1;
        }
        if (_this.filterHoursFrom) {
            params['hours_from'] = _this.filterHoursFrom;
        }
        if (_this.filterHoursTo) {
            params['hours_to'] = _this.filterHoursTo;
        }
        if (_this.msCareerLevel) {
            var careers = $.map(_this.msCareerLevel.getSelection(), function (item) {
                return item.id;
            }).join(',');
            if (careers.length > 0) {
                params['careers'] = careers;
            }
        }
        if (_this.msJobTypes) {
            var jobTypes = $.map(_this.msJobTypes.getSelection(), function (item) {
                return item.id;
            }).join(',');
            if (jobTypes.length > 0) {
                params['job_types'] = jobTypes;
            }
        }
        new GraphQL("query", "map", params, [
            'items {' +
            'id name type latitude longitude business {picture_50(width:50, height:50)} ' +
            '}'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            _this.setLocations(data);
        }).request();
    }
};

$(document).ready(function () {
    var jobMap = new JobMap();
    jobMap.init();
});
