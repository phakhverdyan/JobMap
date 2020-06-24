function JobUnionView(id) {
    this.id = id;
    // this.businessID = businessID;
    this.errorRedirectTo = '/';

    this.map;

    //marker clusterer
    this.mc;
    this.mcOptions = {
        gridSize: 20,
        maxZoom: 17,
        imagePath: "https://cdn.rawgit.com/googlemaps/v3-utility-library/master/markerclustererplus/images/m"
    };

    //marker clusterer
    this.mc;
    this.markers = [];
    this.mcOptions = {
        gridSize: 20,
        maxZoom: 17,
        imagePath: "https://cdn.rawgit.com/googlemaps/v3-utility-library/master/markerclustererplus/images/m"
    };

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

    this.assignLocations = {};
    this.jobs = {};

    this.pointsLocations = [];
}

JobUnionView.prototype = {
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
        //var myLatLng = {lat: latitude, lng: longitude};
        //var latLng = new google.maps.LatLng(latitude, longitude);
        _this.map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            maxZoom: 19,
            //center: myLatLng,
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
        //marker cluster
        _this.mc = new MarkerClusterer(_this.map, [], _this.mcOptions);
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < _this.pointsLocations.length; i++) {
            var pointLocations = _this.pointsLocations[i];
            var itemLatLng =  new google.maps.LatLng(pointLocations.latitude, pointLocations.longitude);
            bounds.extend(itemLatLng);
            _this.map.fitBounds(bounds);

            var a= _this.createMapMarker(itemLatLng,pointLocations,pointLocations.picture);

            /*google.maps.event.addListener(marker, 'click', function () {
                var newCenter = {
                    lat: this.latlng.lat(),
                    lng: this.latlng.lng()
                };

                _this.map.panTo(newCenter);
                if ( $('.jobmap_object_view').length > 0 && $('.jobmap_filter').length > 0) {
                    var offset_x = $('.jobmap_object_view').width() - $('.jobmap_filter').width();
                    _this.map.panBy(offset_x,0);
                    _this.markerModal(pointLocations['id']);
                } else if ($('.jobmap_object_view').length > 0) {
                    var offset_x = $('.jobmap_object_view').width();
                    _this.map.panBy(offset_x/2,0);
                    _this.markerModal(pointLocations['id']);
                }

                //_this.markerModal(_this.pointLocations.id);
            });*/

        }
        google.maps.event.addDomListener(window, "resize", function () {
            _this.mapCenter();
        });
    },
    createMapMarker: function (itemLatLng, pointLocations, picture) {
        var _this = this;

        var marker = new CustomMarker(
            itemLatLng,
            _this.map,
            {
                marker_id: pointLocations.id
            },
            [picture]
        );

        var jobId = pointLocations.job_id;
        google.maps.event.addListener(marker, 'click', function () {
            window.location.href = '/map/view/job/' + jobId;
        });

        return _this.mc.addMarker(marker);
    },
    markerModal: function (id) {
        this.getLocationsList(id);
        if ($('.jobmap_object_view').is(":visible")) {
            $('.jobmap_content_view').fadeOut().fadeIn();

        } else {
            $('.jobmap_object_view').toggle({ direction: "right" }, 500);
        }

    },
    getLocationsList: function (id) {
        if (id) {
            var _this = this;

            var params = {
                //"id": ids.join(',')
                "id": id
            };
            if (user) {
                params['login_user_id'] = parseInt(user.data.id);
            }
            new GraphQL("query", "locations", params, [
                'id',
                'name',
                'slug',
                'street',
                'street_number',
                'city',
                'country',
                'jobs_count_open',
                'jobs_count',
                'assign_jobs{id title description job_status created_date_ago job_id days_send_resume}',
                'business{id name slug picture_50(width:50,height:50) locations_count jm_jobs_count type industry}'
            ], false, false, function () {
                Loader.stop();
            }, function (data) {
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
                        '           <p class="mb-0" style="font-size: 18px;  font-weight: 500;">'+ _this.ucFirst(item.business.name) +'</p>'+
                        '       </div>'+
                        '       <p class="mb-0">'+  data[0].name +'</p>';
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
                        html += '<div class="mt-5 ml-3">'+
                            '   <div class="text-center text-lg-left mxa-0">'+
                            '       <div class="mb-1 d-flex flex-column flex-lg-row">'+
                            '           <p class="mb-0" style="font-size: 18px; font-weight: 500;">'+ _this.ucFirst(job.title);
                        if (job.job_status == 1) {
                            html += '<div class="ml-2">'+
                                '    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 448.8 448.8" style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px; fill:rgb(40, 167, 69);" xml:space="preserve">'+
                                '       <g><g id="check"><polygon points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"></polygon></g></g>'+
                                '    </svg>'+
                                '    <small style="color:rgb(40, 167, 69);">' + trans('open') + '</small>'+
                                '</div>';
                        }
                        html += '           </p>'+
                            '       </div>'+
                            '       <div class="d-flex flex-lg-row flex-column justify-content-between">'+
                            '           <p class="mb-2 align-self-center" style="font-size: 14px; display: -webkit-box; -webkit-line-clamp: 6; -webkit-box-orient: vertical; overflow: hidden;">'+ _this.ucFirst(job.description) +'</p>'+
                            '           <div class="col-lg-2 col-12 align-self-center">'+
                            '               <small>'+ job.created_date_ago +'</small>'+
                            '           </div>'+
                            '       </div>'+
                            '       <span>'+
                            '           <a href="/map/view/job/'+ job.job_id +'" class="btn btn-viewcp btn-sm" style="font-size: 13px;">' + trans('view_job') + '</a>';
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
                            html += '<div class="mt-5 ml-3">'+ _this.ucFirst(item.business.name) + trans('didnt_list_jobs_in_location_1') + '</div>';
                        } else {
                            html += '<div class="mt-5 ml-3">'+ _this.ucFirst(item.business.name) + trans('didnt_list_jobs_in_location_21') + item.business.jm_jobs_count + trans('didnt_list_jobs_in_location_22') + item.business.locations_count + trans('didnt_list_jobs_in_location_23') + '</div>';
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
    ucFirst: function (s,z) {
        z = z || '';
        if (s) {
            return z + s.charAt(0).toUpperCase() + s.substr(1);
        }
        return '';
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
            "id": this.id
        };
        var query = 'jobUnion';
        var search;
        if (getUrlParameter('sort'))
            params['sort'] = getUrlParameter('sort');
        if (getUrlParameter('order'))
            params['order'] = getUrlParameter('order');
        params['limit'] = (getUrlParameter('limit')) ? +getUrlParameter('limit') : this.perPage;
        params['page'] = (getUrlParameter('page')) ? +getUrlParameter('page') : this.currentPage;
        search = this.search;

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
            'id',
            'title',
            'salary',
            'salary_type',
            'description',
            //'category_name',
            'street',
            'street_number',
            'city',
            'country',
            'country_code',
            'region',
            'suite',
            'date',
            'status',
            'status_in_location',
            'jobs_open',
            'jobs_close',
            'html',
            'assign_types{ id name}'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            el.find('#block-opened-jobs').html('');
            el.find('#block-closed-jobs').html('');
            if (data) {
                var htmlO = '', htmlC = '';
                $.map(data, function (item) {
                    if (item.status_in_location) {
                        htmlO += item.html;
                    } else {
                        htmlC += item.html;
                    }
                });
                el.find('#block-opened-jobs').html(htmlO);
                el.find('#block-closed-jobs').html(htmlC);
                $('#job-o-count').text(data[0].jobs_open);
                $('#job-c-count').text(data[0].jobs_close);
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
    setAssignLocations: function (data) {
        var _this = this;
        var i = 0;
        $.map(data, function (item) {
            _this.pointsLocations[i] = {
                'id': item.id,
                'latitude': item.latitude,
                'longitude': item.longitude,
                'job_id': item.job_id,
                'picture': item.picture_50,
            };
            i++;
        });
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