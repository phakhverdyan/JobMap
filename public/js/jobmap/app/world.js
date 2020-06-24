function World(type) {
    this.type = type;

    this.sortElement = $('#items-sort');
    this.searchElement = $('#items-search');

    this.perPage = 25;
    this.countPages = 1;
    this.currentPage = 1;
    this.sort;
    this.order;
    this.search;
}

World.prototype = {
    init: function () {
        var _this = this;
        var body = $('body');
        $('body').on('click', '.job-locations', function () {
            $('#overlay-view').show();
            $(this).parent().next().show();
        });
        $('body').on('click', '#overlay-view', function () {
            $(this).hide();
            $('.job-locations-view').hide();
        });
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
        this.searchElement.on('keyup', function (e) {
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
    },
    getItems: function () {
        var _this = this;
        var el = $('#items-list');
        var params = {};
        var query = 'businessLocations';
        var search;
        var param = '';
        var assignParams = '';
        if (getUrlParameter('sort'))
            params['sort'] = getUrlParameter('sort');
        if (getUrlParameter('order'))
            params['order'] = getUrlParameter('order');
        _this.perPage = params['limit'] = (getUrlParameter('limit')) ? +getUrlParameter('limit') : this.perPage;
        params['page'] = (getUrlParameter('page')) ? +getUrlParameter('page') : this.currentPage;
        search = this.search;

        var link = '';
        switch (_this.type) {
            case 'locations':
                params['type'] = 'location';
                assignParams = ' name business{picture_50(width:50,height:50)}';
                link = '/map/view/location/';
                break;
            case 'keywords':
                query = 'mapKeywords';
                assignParams = ' name';
                link = '/search/jobs';
                break;
            case 'headquarters':
                params['type'] = 'headquarter';
                assignParams = ' name business{picture_50(width:50,height:50)}';
                link = '/map/view/location/';
                break;
            case 'jobs':
                link = '/map/view/job/';
                query = 'mapJobs';
                params['status'] = 1;
                param = '';
                assignParams = ' title category_name business{picture_50(width:50,height:50)} assign_locations {id job_id business{picture_50(width:50,height:50)} name street street_number city region country created_date job_status}';
                if (getUrlParameter('filters')) {
                    params['filters'] = getUrlParameter('filters');
                }
                break;
            default:
                query = 'mapBusinesses';
                assignParams = ' name picture_50(width:50,height:50)';
                link = getBaseURL() + '/business/view/';
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
            'id ' + assignParams +
            '}',
            'pages',
            'count',
            'current_page ' + param
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            el.html('');
            if (data.items) {
                var items = data.items;
                var i = 0;
                var j = 0;
                var count = items.length;
                var startOf = (_this.currentPage === 1) ? _this.currentPage : _this.currentPage * _this.perPage;
                var endOf = (_this.currentPage !== data.pages) ? (_this.currentPage * _this.perPage) + _this.perPage : data.count;
                var start = (data.count > 0) ? startOf : 0;
                var end = (data.count > 0) ? endOf : 0;
                $('#items-display').find('span:first').text(start + '-' + end);
                $('#items-display').find('span:last').text(data.count);
                var html = '';
                $.map(items, function (item) {
                    if (_this.type !== 'keywords') {
                        var picture = (item.picture_50) ? item.picture_50 : item.business.picture_50;
                        var name = (item.title) ? item.category_name + ' ' + item.title : item.name;
                        var sl = (_this.type !== 'jobs') ? slug(name) : '';
                        var params = item.id + '/' + sl;
                        var url = link + params;
                        var classEl = '';
                    } else {
                        var name = item.name;
                        var url = link + '?a_keywords=' + item.id;
                        var classEl = '';
                    }
                    if (_this.type === 'jobs') {
                        if (item.assign_locations.length > 1) {
                            url = 'javascript:void(0)';
                            classEl = 'job-locations';
                        } else {
                            url = link + item.assign_locations[0].job_id;
                        }
                    }
                    if (i === 0) {
                        html += '<div class="col-12 col-lg-4 pxa-0">';
                    }
                    html += '<div style="position: relative;">' +
                        '<p>' +
                        '<a href="' + url + '" class="breadcrumb_custom ' + classEl + '" target="_blank">';
                    if (_this.type !== 'keywords') {
                        html += '<img ' +
                            'src="' + picture + '"' +
                            'class="mr-2"' +
                            'style="width: 20px; height: 20px; margin-top: -3px;">';
                    }
                    html += name.trim() +
                        '</a>' +
                        '</p>';
                    if (_this.type === 'jobs') {
                        html += '<div class="bg-white p-2 rounded border job-locations-view"' +
                            'style="position: absolute; top: 20px; right: 0; width: 230px; display: none; z-index: 222; box-shadow: inset 0 1px 1px rgba(0,0,0,0.075); max-height: 265px; overflow: auto;">' +
                            '<p class="mb-0"><strong>'+Langs.available_in+' ' + item.assign_locations.length + Langs.locations + '</strong></p>';
                        $.map(item.assign_locations, function (assign) {
                            html += '<div class="mb-0 mt-2">' +
                                '<a href="' + link + assign.job_id + '"' +
                                'class="breadcrumb_custom mt-2 w-100 d-flex" target="_blank">' +
                                '<img src="' + picture + '" class="mr-2"' +
                                'style="width: 20px; height: 20px;">' +
                                '<div>' + assign.name +
                                '<p class="mb-0 text-muted" style="font-size: 12px;">' +
                                assign.street + ' ' + assign.street_number + ',' + assign.city + ',' + assign.country + '</p>' +
                                '</div>' +
                                '</a>' +
                                '</div>';
                        });
                        html += '</div>';
                    }
                    html += '</div>';

                    i++;
                    j++;
                    if (i === 3 || (i !== 3 && j === count)) {
                        i = 0;
                        html += '</div>';
                    }

                });
                el.html(html);
            }
            _this.countPages = data.pages;
            _this.pagination(data.pages);
        }).request(el, false, true);
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