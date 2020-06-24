function LocationView(find, findBy) {
    this.find = find;
    this.findData = explode('+', find);
    this.findBy = findBy;
    this.errorRedirectTo = '/';
    this.perPageElement = '.perpage';

    this.locationGroup = $('.items-group[data-group="employers"]');

    this.sortElementLocation = $('#locations-sort');
    this.searchElementLocation = $('#locations-search');

    this.perPageLocation = 3;
    this.countPagesLocation = 1;
    this.currentPageLocation = 1;
    this.sortLocation;
    this.orderLocation;
    this.searchLocation;
    this.statusLocation = 1;

    this.assigmentData = {};
    this.loadLocationsData = {};

    this.itemsType = 'list';


    this.map;
    this.items;

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

LocationView.prototype = {
    init: function () {
        var _this = this;
        var body = $('body');
        this.locationGroup.find('#page-limit-location').on('change', function () {
            var limit = $(this).val();
            _this.perPageLocation = +limit;
            _this.currentPageLocation = 1;
            var keywords = _this.searchElementLocation.val().trim();
            setTimeout(function () {
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'location');
            }, 0);
        });
        var timeout3 = null;
        _this.searchElementLocation.on('keyup', function (e) {
            if (e.which <= 90 && e.which >= 48 || e.which === 13 || e.which === 8) {
                var keywords = $(this).val();
                _this.currentPageLocation = 1;
                clearTimeout(timeout3);
                timeout3 = setTimeout(function () {
                    _this.getItems(keywords.trim(), 'location');
                }, 500);
            }
        });
        body.on('click', '.pagination-location .page-link.page-page', function () {
            _this.currentPageLocation = +$(this).text();
            var keywords = _this.searchElementLocation.val().trim();
            _this.getItems((keywords.length <= 1) ? undefined : keywords, 'location');
        });
        body.on('click', '.pagination-location .page-prev', function () {
            if (_this.currentPageLocation > 1) {
                _this.currentPageLocation -= 1;
                var keywords = _this.searchElementLocation.val().trim();
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'location');
            }
        });
        body.on('click', '.pagination-location .page-next', function () {
            if (_this.currentPageLocation < _this.countPagesLocation) {
                _this.currentPageLocation += 1;
                var keywords = _this.searchElementLocation.val().trim();
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'location');
            }
        });
        //set sort & order for items
        this.sortElementLocation.change(function () {
            _this.sortLocation = $(this).val();
            _this.orderLocation = $(this).find('option:selected').attr('data-order');
            _this.currentPageLocation = 1;
            var keywords = _this.searchElementLocation.val().trim();
            setTimeout(function () {
                _this.getItems((keywords.length <= 1) ? undefined : keywords, 'location');
            }, 0);
        });

        body.on('click', '.blockorlist', function () {
            var type = $(this).attr('data-type');
            _this.itemsType = type;
            if (type === 'list') {
                $('#location-accordion-items').removeClass('hide');
                $('#map-items').addClass('hide');
            } else {
                $('#location-accordion-items').addClass('hide');
                $('#map-items').removeClass('hide');
            }
        });

        _this.mapRender();
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
        _this.map = new google.maps.Map(document.getElementById('map'), options);
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
    // render: function () {
    //     var _this = this;
    //     var decode = decodeURI(_this.find);
    //     $('#name').text(decode.replaceAll('+', ','));
    //
    //     $('#location-view').removeClass('hide');
    //
    //     switch (_this.findBy) {
    //         case 'country':
    //             var data = {
    //                 "country": _this.findData
    //             };
    //             $('#link-location-country').text(data.country).attr('href', setLocationURL('country', data));
    //             break;
    //         case 'city':
    //             var data = {
    //                 "city": _this.findData[0],
    //                 "country": _this.findData[1]
    //             };
    //             $('#link-location-country').text(data.country).attr('href', setLocationURL('country', data));
    //             $('#link-location-city').text(data.city).attr('href', setLocationURL('city', data));
    //             break;
    //         case 'region':
    //             var data = {
    //                 "region": _this.findData[0],
    //                 "country": _this.findData[1]
    //             };
    //             $('#link-location-country').text(data.country).attr('href', setLocationURL('country', data));
    //             $('#link-location-region').text(data.region).attr('href', setLocationURL('region', data));
    //             break;
    //         case 'street':
    //             var data = {
    //                 "street": _this.findData[0],
    //                 "city": _this.findData[1],
    //                 "country": _this.findData[2]
    //             };
    //             $('#link-location-country').text(data.country).attr('href', setLocationURL('country', data));
    //             $('#link-location-city').text(data.city).attr('href', setLocationURL('city', data));
    //             $('#link-location-street').text(data.street).attr('href', setLocationURL('street', data));
    //             break;
    //         case 'address':
    //             var data = {
    //                 "street_number": _this.findData[0],
    //                 "street": _this.findData[1],
    //                 "city": _this.findData[2],
    //                 "country": _this.findData[3]
    //             };
    //             $('#link-location-country').text(data.country).attr('href', setLocationURL('country', data));
    //             $('#link-location-city').text(data.city).attr('href', setLocationURL('city', data));
    //             $('#link-location-street').text(data.street).attr('href', setLocationURL('street', data));
    //             $('#link-location-address').text(data.street + ' ' + data.street_number).attr('href', setLocationURL('address', data));
    //             break;
    //     }
    //
    //     setTimeout(function () {
    //         _this.getItems(undefined, 'location');
    //     }, 0);
    // },
    getItems: function (keywords, type) {
        var _this = this;
        var el = $('#' + type + '-items');
        var elList = $('#' + type + '-accordion-items');
        var defaultEl = (this.itemsType === 'list') ? elList : el;
        var params = {};
        var search;
        var param = '';
        if (this.sortLocation)
            params['sort'] = this.sortLocation;
        if (this.orderLocation)
            params['order'] = this.orderLocation;
        params['limit'] = this.perPageLocation;
        params['page'] = this.currentPageLocation;
        // params['find'] = _this.find;
        params['findBy'] = _this.findBy;
        switch (_this.findBy) {
            case 'country':
                params['country'] = _this.findData[0];
                break;
            case 'city':
                params['city'] = _this.findData[0];
                params['country'] = _this.findData[1];
                break;
            case 'region':
                params['region'] = _this.findData[0];
                params['country'] = _this.findData[1];
                break;
            case 'street':
                params['street'] = _this.findData[0];
                params['city'] = _this.findData[1];
                params['country'] = _this.findData[2];
                break;
            case 'address':
                params['street_number'] = _this.findData[0];
                params['street'] = _this.findData[1];
                params['city'] = _this.findData[2];
                params['country'] = _this.findData[3];
                break;
        }
        search = this.searchLocation;
        var query = 'mapBusinesses';
        if (typeof keywords !== 'undefined') {
            if (keywords.length > 1) {
                params['keywords'] = keywords;
                this.searchLocation = 0;
            } else {
                if (search === 1) {
                    return;
                } else {
                    this.searchLocation = 1;
                }
            }
        }
        new GraphQL("query", query, params, [
            'items {' +
            'id html_jobmap html_jobmap_list ' +
            '}',
            'pages',
            'count',
            'current_page ' + param
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            el.html('');
            elList.html('');
            if (data.items) {
                var html = '';
                var htmlList = '';
                var i = 0;
                $.map(data.items, function (item) {
                    html += item.html_jobmap;
                    htmlList += item.html_jobmap_list;
                });
                el.html(html);
                elList.html(htmlList);
            }
            $('.group-count[data-g="employers"] span').text(data.count);
            _this.countPagesLocation = data.pages;
            _this.pagination(data.pages, type);
        }).request(defaultEl, false, true);
    },
    pagination: function (pages, type) {
        var _this = this;
        var html = '';
        var el = $('.pagination-' + type);
        var current = 0;
        current = _this.currentPageLocal;
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
// $(document).ready(function () {
//     Loader.init();
//     var url = document.location.pathname;
//     var urlDataCountry = explode('/map/country/', url);
//     var urlDataCity = explode('/map/city/', url);
//     var urlDataRegion = explode('/map/region/', url);
//     var urlDataStreet = explode('/map/street/', url);
//     var urlDataAddress = explode('/map/address/', url);
//     var id, View;
//     if (urlDataCountry[1]) {
//         id = urlDataCountry[1];
//         View = new LocationView(id, 'country');
//         app.scripts(View.init());
//         app.run();
//     } else if (urlDataCity[1]) {
//         id = urlDataCity[1];
//         View = new LocationView(id, 'city');
//         app.scripts(View.init());
//         app.run();
//     } else if (urlDataRegion[1]) {
//         id = urlDataRegion[1];
//         View = new LocationView(id, 'region');
//         app.scripts(View.init());
//         app.run();
//     } else if (urlDataStreet[1]) {
//         id = urlDataStreet[1];
//         View = new LocationView(id, 'street');
//         app.scripts(View.init());
//         app.run();
//     } else if (urlDataAddress[1]) {
//         id = urlDataAddress[1];
//         View = new LocationView(id, 'address');
//         app.scripts(View.init());
//         app.run();
//     } else {
//         window.location.href = '/';
//     }
// });