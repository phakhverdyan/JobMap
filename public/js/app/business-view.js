function BusinessView(id, type) {
    this.id = id;

    this.map;
    this.map_small;


    switch (type) {
        case 'jobs':
            this.type = 'job';
            break;
        case 'headquarters':
            this.type = 'headquarter';
            break;
        case 'locations':
            this.type = 'location';
            break;
        case 'brands':
            this.type = 'brand';
            break;
        case 'unconfirmed_locations':
            this.type = 'unconfirmed_location';
            break;
        case 'description':
            this.type = 'description';
            break;
    }

    this.sortElement = $('#items-sort');
    this.searchElement = $('#items-search');

    this.perPage = 25;
    this.countPages = 1;
    this.currentPage = 1;
    this.businessSlugName;
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

    //marker clusterer
    this.mc;
    //this.markers = [];
    this.mcOptions = {
        gridSize: 20,
        maxZoom: 17,
        imagePath: "https://cdn.rawgit.com/googlemaps/v3-utility-library/master/markerclustererplus/images/m"
    };
    //create empty LatLngBounds object
    this.bounds;

    this.pointsLocations = [];
    this.mapItems = [];
}

BusinessView.prototype = {
    init: function () {
        console.log("%cEvent - BusinessView - init", "color:red;");
        var _this = this;
        var body = $('body');
        //set per-page limit
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
                if (_this.type == 'description') {
                    window.location.href = window.location.href + '/jobs?keywords=' + keywords + '&page=1';
                } else {
                    clearTimeout(timeout1);
                    timeout1 = setTimeout(function () {
                        updateQueryStringParam('keywords', keywords);
                        updateQueryStringParam('page', _this.currentPage);
                        setTimeout(function () {
                            _this.getItems();
                        }, 100);
                    }, 500);
                }
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

        $('#map-resize').on('click', function () {
            var height = 160;
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

        body.on('click', '#carouselExampleControls .carousel-item.active', function () {
            var number = $(this).attr('data-number');
            $('#modal_bg_business_carousel .carousel-item').removeClass('active');
            $('#modal_bg_business_carousel .carousel-item').each(function () {
                if ($(this).attr('data-number') == number) {
                    $(this).addClass('active');
                }
            });
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

            return true;
        });

        //---------------------------------------------------------------------------------job share
        body.on('click', '[data-target="#ShareModal"]', function () {
            _this.currentID = $(this).attr('data-id');

            var linkShare = '';

            if ($(this).attr('data-link')) {
                linkShare = $(this).attr('data-link');
            } else {
                linkShare = 'https://jobmap.co/map/view/job/' + $(this).attr('data-id');
            }

            if ($(this).attr('data-title')) {
                linkTitle = $(this).attr('data-title');
            } else {
                linkTitle = 'JobMap';
            }

            if ($(this).attr('data-image')) {
                linkImage = $(this).attr('data-image');
            } else {
                linkImage = null;
            }

            if ($(this).attr('data-description')) {
                linkDescription = $(this).attr('data-description');
            } else {
                linkDescription = '';
            }

            $('#share-link').val(linkShare);
            $('#share-link-title').val(linkTitle);
            $('#share-link-description').val(linkDescription);
            $('#share-link-image').val(linkImage);
        });

        $('#shareFacebook').click(function () {
            // var ogUrl = $('#share-link').val();

            var shareImage = $('#share-link-image').val();

            var ogTitle = $('#share-link-title').val();
            if (!ogTitle) {
                ogTitle = $('title').text();
            }

            ogDescription = $('#share-link-description').val();
            if (!ogDescription) {
                ogDescription = '';
            }

            let ogUrl = $('#share-link').val(),
                ogImage = shareImage ? shareImage : window.location.origin + '/img/jm_logo.png';

            FB.ui({
                    method: 'share_open_graph',
                    action_type: 'og.shares',
                    action_properties: JSON.stringify({
                        object : {
                            'og:url': ogUrl,
                            'og:title': ogTitle,
                            'og:description': ogDescription,
                            'og:image': ogImage
                        }
                    })
                    /*method: 'feed',
                    link: ogUrl,*/
                },
                function(response) {
                    if (response && !response.error_message) {
                        //
                    } else {
                        console.log('Something went error.');
                    }
                });


            // FB.ui({
            //     method: 'share',
            //     href: ogUrl,
            // }, function(response){});
        });

        $('#shareGoogle').click(function () {
            let ogUrl = $('#share-link').val();
            window.open("https://plus.google.com/share?url=" + ogUrl, 'sharer', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;
        });

        $('#shareTwitter').click(function () {
            let ogUrl = $('#share-link').val();
            window.open("https://twitter.com/share?url=" + ogUrl, 'sharer', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;
        });

        $('#shareLinkedin').click(function () {
            let ogUrl = $('#share-link').val();
            window.open("https://www.linkedin.com/share?url=" + ogUrl, 'sharer', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;
        });

        var clipboard = new Clipboard('#clipboard-button');
        clipboard.on('success', function (e) {
            $.notify('Copied!', 'success');
            e.clearSelection();
        });

    },
    renderMap: function (latitude, longitude, id, picture) {
        var _this = this;
        var myLatLng = {lat: latitude, lng: longitude};
        var latLng = new google.maps.LatLng(latitude, longitude);
        _this.map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
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
        if (_this.type == 'job' || _this.type == 'description') {
            new CustomMarker(
                latLng,
                _this.map,
                {
                    marker_id: id
                },
                [picture]
            );
        } else {
            _this.bounds = new google.maps.LatLngBounds();
            _this.mc = new MarkerClusterer(_this.map, [], _this.mcOptions);
            let latitude, longitude;
            let id, picture;
            let latLng;
            var i;
            for (i = 0; i < _this.pointsLocations.length; i++) {
                latitude = _this.pointsLocations[i].latitude;
                longitude = _this.pointsLocations[i].longitude;
                id = _this.pointsLocations[i].id;
                picture = _this.pointsLocations[i].picture;
                if (latitude != 0 && longitude != 0) {
                    latLng = new google.maps.LatLng(latitude, longitude);
                    _this.createMapItem(latLng, id, picture);
                }
            }

            for (i = 0; i < _this.mapItems.length; i++) {
                _this.createMapMarker(_this.mapItems[i].latLng, _this.mapItems[i].ids, _this.mapItems[i].pictures);
            }

            /*for (var i = 0; i < _this.pointsLocations.length; i++) {
                let pointLocations = _this.pointsLocations[i];
                let itemLatLng =  new google.maps.LatLng(pointLocations.latitude, pointLocations.longitude);

                var marker = new CustomMarker(
                    itemLatLng,
                    _this.map,
                    {
                        marker_id: pointLocations.id
                    },
                    [pointLocations.picture]
                );
                google.maps.event.addListener(marker, 'click', function () {
                    if(_this.type == 'unconfirmed_location') {
                        //window.location.href = getBaseURLFotMap() + '/map/view/unconfirmed-location/' + pointLocations.id + '/' + pointLocations.name;
                        $('.unconfirmed-business__location-item[data-id]').removeClass('ubiz_choosed');
                        $('.unconfirmed-business__location-item[data-id="'+ pointLocations.id +'"]').addClass('ubiz_choosed');
                    } else {
                        window.location.href = getBaseURLFotMap() + '/map/view/location/' + pointLocations.id + '/' + pointLocations.name;
                    }

                });
                bounds.extend(itemLatLng);
            }*/

            _this.map.fitBounds(_this.bounds);
        }

        google.maps.event.addDomListener(window, "resize", function () {
            _this.mapCenter();
        });
    },
    createMapItem: function (latlng, id, picture) {
        var _this = this;
        var n = true;
        for (var i = 0; i < _this.mapItems.length; i++) {
            if (_this.mapItems[i].latLng.equals(latlng)) {
                _this.mapItems[i]['ids'].push(id);
                _this.mapItems[i]['pictures'].push(picture);
                n = false;
                break;
            }
        }
        if (n) {
            _this.mapItems.push({
                'latLng': latlng,
                'ids': [id],
                'pictures': [picture],
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
        google.maps.event.addListener(marker, 'click', function () {
            let businessSlugName = _this.businessSlugName;
            let locationID = marker.args.marker_id;

            if(_this.type == 'location') {
                window.location.href = getBaseURLFotMap() + '/map/view/location/' + locationID + '/' + businessSlugName;
            }

            // if(_this.type == 'unconfirmed_location') {
            //     //window.location.href = getBaseURLFotMap() + '/map/view/unconfirmed-location/' + pointLocations.id + '/' + pointLocations.name;
            //     $('.unconfirmed-business__location-item[data-id]').removeClass('ubiz_choosed');
            //     $('.unconfirmed-business__location-item[data-id="'+ pointLocations.id +'"]').addClass('ubiz_choosed');
            // }
        });
        //_this.markers.push(marker);
        return _this.mc.addMarker(marker);
    },
    renderMapSmall: function (latitude, longitude, id, picture) {
        var _this = this;
        var myLatLng = {lat: latitude, lng: longitude};
        var latLng = new google.maps.LatLng(latitude, longitude);
        _this.map_small = new google.maps.Map(document.getElementById('map-small'), {
            zoom: 13,
            maxZoom: 19,
            center: myLatLng,

            /*zoomControl: true,
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
            },*/
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
            _this.map_small,
            {
                marker_id: id
            },
            [picture]
        );
        /*google.maps.event.addDomListener(window, "resize", function () {
            _this.mapCenter();
        });*/
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
            _this.currentPage = 1;
            if (_this.type == 'description') {
                window.location.href = window.location.href + '/jobs?filters=' + filters + '&page=1';
            } else {
                updateQueryStringParam('filters', filters);
                updateQueryStringParam('page', 1);
                setTimeout(function () {
                    _this.getItems();
                }, 0);
            }
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
    getLocationsList: function (id) {
        var _this = this;
        var modal = $('#modal-job-locations-list');

        var html = '';
        if (_this.assignLocations[id]) {
            $.map(_this.assignLocations[id], function (item) {
                html += '<div class="d-flex align-items-center justify-content-between mb-3">\n' +
                    '                        <div class="d-inline-flex align-items-center mr-2" style="flex: 1">\n' +
                    '                            <div class="rounded p-1 bg-white d-inline-block mr-2"\n' +
                    '                                 >\n' +
                    '                                <img class="location-pic rounded" src="' + item.business.picture_50 + '" width="50px" height="50px">\n' +
                    '                            </div>\n' +
                    '                            <h6 class="h6 mb-0">' + item.localized_name + '' +
                    '<p><small>' + item.street + ' ' + item.street_number + ', ' + item.city + ', ' + item.country + '</small></p></h6>\n' +
                    '                        </div>\n' +
                    '                        <div class="d-inline-flex align-items-center">\n' +
                    '                            <p class="mb-0 mr-2"><a href="' + getBaseURLFotMap() + '/map/view/job/' + item.job_id + '">'+Langs.view_job+'</a></p>\n' +
                    '                        </div>\n' +
                    '                    </div>';
            });
        }
        $('#modal-job-name').text(_this.jobs[id]);
        modal.find('#count-job-locations span').text(_this.assignLocations[id].length);
        modal.find('#link-job-union').attr('href',getBaseURLFotMap() + '/map/view/job-union/' + id);
        modal.find('.modal-body').html(html);
        modal.modal('show');
    },
    getItems: function () {
        var _this = this;
        var el = $('#items-list');
        var params = {
            "business_id": this.id
        };
        var query = 'businessLocations';
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

        console.log(_this.type);
        switch (_this.type) {
            case 'location':
            case 'headquarter':
                params['type'] = _this.type;
                params['page'] = 1;
                params['limit'] = 999999999;
                break;
            case 'unconfirmed_location':
                params['type'] = 'location';
                break;
            case 'brand':
                query = 'businessBrands';
                params['business_id'] = business.currentID;
                break;
            case 'job':
            //case 'description':
                query = 'businessJobs';
                params['status'] = 1;
                params['join'] = 1;
                param = 'jobs_open jobs_close';
                assignParams = ' title assign_locations {id job_id business{picture_50(width:50,height:50)} name street street_number city region country created_date job_status}';
                if (getUrlParameter('filters')) {
                    params['filters'] = getUrlParameter('filters');
                }
                break;
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
            'id html_career ' + assignParams +
            '}',
            'pages',
            'count',
            'current_page ' + param
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            el.html('');
            // $('#' + type + '-count').text(data.count);
            if (data.items) {
                var html = '';
                var i = 0;
                $.map(data.items, function (item) {
                    html += item.html_career;
                    if (_this.type === 'job') {
                        if (item.assign_locations) {
                            _this.assignLocations[item.id] = item.assign_locations;
                        }
                        _this.jobs[item.id] = item.title;
                    }
                });
                el.html(html);
            }
            $('#job-count .business_tabs_numbers').text(data.count);
            console.log(data.count);
            _this.countPages = data.pages;
            _this.pagination(data.pages);
        }).request(el, false, true);
    },
    mapCenter: function () {
        var center = this.map.getCenter();
        google.maps.event.trigger(this.map, "resize");
        this.map.setCenter(center);
    },
    setBusinessSlugName: function (slugName) {
        var _this = this;
        _this.businessSlugName = slugName;
    },
    setAssignLocations: function (data) {
        var _this = this;
        if (_this.type === 'description') {
            return;
        }
        var i = 0;

        let _data = data.items;
        if(data.items === undefined){
            _data = data;
        }
        $.map(_data, function (item) {
            if (_this.type === 'job') {
                if (item.assign_locations) {
                    _this.assignLocations[item.id] = item.assign_locations;
                }
                _this.jobs[item.id] = item.title;
            } else {
                _this.pointsLocations[i] = {
                    'id': item.id,
                    'latitude': item.latitude,
                    'longitude': item.longitude,
                    'name': item.name,
                    'picture': item.picture_50
                };
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
