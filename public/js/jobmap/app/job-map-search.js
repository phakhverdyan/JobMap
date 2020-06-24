function JobMapSearch(type, typeItems) {
    this.type = type;
    this.typeItems = typeItems;

    this.scrollLoad = true;
    this.firstSearch = false;
    this.hasResults = true;
    this.perPage = 25;
    this.countPages = 1;
    this.currentPage = 1;
    this.mapSizeShort = '30vh';
    this.mapSizeFull = '70vh';
    this.sort;
    this.order;
    this.assigmentData = {};
    this.loadLocationsData = {};

    this.loadFilters = 0;

    this.jobs = {};
    this.exceptParams = ['result_type'];
    this.jobMap = '#job-map';

    // Result tabs
    this.resultTabs = $('#result-type-tabs');
    this.resultTabJobs = this.resultTabs.find('div[data-type="job"]');
    this.resultTabBusinesses = this.resultTabs.find('div[data-type="business"]');
    this.resultTabLocations = this.resultTabs.find('div[data-type="location"]');

    this.searchForm = $('#map-search-form');
    this.scrollToElement = 'footer';
    this.searchTitleBox = $('#title-box');
    this.searchButtonBox = $('#button-box');
    this.itemsList = $('#items-list');
    this.preloader = $('#search-job-preloader');
    this.searchTitle = this.searchForm.find('input[name="title"]');
    this.searchButton = this.searchForm.find('#jobs-search-button');

    // Filters
    this.filterBar = $('#map-filters-search-bar');
    this.filterStatus = this.filterBar.find('select[name="status"]');
    this.filterType = this.filterBar.find('select[name="type"]');
    this.filterSort = this.filterBar.find('select[name="sort"]');
    this.filterResultType = this.filterBar.find('select[name="result_type"]');

    this.clearContentView = $('.clear-cardinal-content-view');
    this.jobmapObjectView = $('.jobmap_object_view');
    this.clearFilterLink = $('.clear-cardinal-content-view');

    this.modalAllItems = $('#catInModal');
    this.modalType = "categories";
}

JobMapSearch.prototype = {
    init: function() {
        var _this = this;

        $(document).ready(function(e){
            if (_this.searchTitle.val()) {
                _this.searchJobs(true);
            }
        });

        $(document).scroll(function(e){
            if (_this.hasResults && _this.scrollLoad && _this.elementInScroll(_this.scrollToElement)) {
                _this.searchJobs();
            }
        });

        _this.resultTabJobs.on('click', function () {
            _this.setActiveResultTypeTab(this);
            _this.searchJobs(true);
        });
        _this.resultTabBusinesses.on('click', function () {
            _this.setActiveResultTypeTab(this);
            _this.searchJobs(true);
        });
        _this.resultTabLocations.on('click', function () {
            _this.setActiveResultTypeTab(this);
            _this.searchJobs(true);
        });

        _this.searchButton.on('click', function () {
            _this.searchJobs(true);
        });

        _this.clearContentView.on('click', function () {
            _this.clearAllFiltersAndContentContent();
        });

        _this.filterStatus.on('change', function () {
            _this.searchJobs(true);
        });

        _this.filterType.on('change', function () {
            _this.searchJobs(true);
        });

        _this.filterSort.on('change', function () {
            _this.searchJobs(true);
        });

        // _this.filterResultType.on('change', function () {
        //     _this.searchJobs(true);
        // });

        _this.searchForm.on('submit', function(e){
            e.preventDefault();
            _this.searchJobs(true);
        });

        $(document).on("map:change:map:size:short", function () {
            _this.changeMapSize(_this.mapSizeShort);
        });

    },

    elementInScroll: function (elem) {
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();

        var elemTop = $(elem).offset().top;
        var elemBottom = parseInt(elemTop + $(elem).height());

        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    },

    searchJobs: function (resetSearch = false) {

        var _this = this;
        _this.scrollLoad = false;

        if (!_this.searchTitle.val()) {
            return false;
        }

        if (resetSearch) {
            _this.clearListItems();
            _this.hideFilterBar();
            _this.currentPage = 1;
        }

        _this.showPreloader();
        _this.changeMapSize(_this.mapSizeShort);

        var resultType = _this.getResultType();
        var params = _this.fillRequestFilters({
            "limit": _this.perPage,
            "page": _this.currentPage,
        });

        var query = _this.queryFactory(resultType);

        _this.sendRequest(query, params);
    },

    showJobs: function (data) {

        var _this = this;

        var html = '';

        $.map(data.items, function (item) {
            html += item.html_career;
        });

        _this.hasResults = true;
        if (html.length === 0) {
            html = '<div class="text-center pt-5 pb-3">No more results!</div>';
            _this.hasResults = false;
        }

        _this.hidePreloader();
        _this.showFilterBar();
        _this.clearFilterLink.show();
        _this.setListItems(html);
    },

    queryFactory: function (type) {
        var query = null;

        switch(type) {
            case 'business':
                query = 'businessesSearch';
                break;

            case 'location':
                query = 'locationsSearch';
                break;

            case 'job':
            default:
                query = 'allBusinessJobs';
                break;
        }

        return query;
    },

    sendRequest: function (query, params) {
        var _this = this;

        new GraphQL("query", query, params, [
            'items {' +
                'html_career' +
            '}',
            'pages',
            'count',
            'current_page'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            _this.currentPage = data.current_page + 1;
            _this.showJobs(data);
            _this.scrollLoad = true;
        }).request();
    },

    fillRequestFilters: function (params) {
        var _this = this;

        if (this.filterStatus.val() != '') {
            params.status = this.filterStatus.val();
            updateQueryStringParam('status', params.status);
        } else {
            removeQueryStringParam('status');
        }

        if (this.filterType.val() != '') {
            params.type = this.filterType.val();
            updateQueryStringParam('type', params.type);
        } else {
            removeQueryStringParam('type');
        }

        if (this.filterSort.val() != '') {
            params.sort = this.filterSort.val();
            updateQueryStringParam('sort', params.sort);
        } else {
            removeQueryStringParam('sort');
        }

        // Result type tabs
        var resultType = _this.getResultType();
        if (resultType) {
            params.result_type = resultType;
            updateQueryStringParam('result_type', params.result_type);
        } else {
            removeQueryStringParam('result_type');
        }

        if (this.searchTitle.val() != '') {
            params.keywords = this.searchTitle.val();
        }

        return _this.clearRequest(params);
    },

    clearRequest: function (params) {
        var _this = this;
        var exceptParams = _this.exceptParams;

        for (var i = 0; i < exceptParams.length; i++) {
            if (exceptParams[i] in params) {
                delete params[exceptParams[i]];
            }
        }

        return params;
    },

    setActiveResultTypeTab: function (tab) {
        var _this = this;

        // remove active class from all tabs
        _this.resultTabJobs.removeClass('active');
        _this.resultTabBusinesses.removeClass('active');
        _this.resultTabLocations.removeClass('active');

        // set active class for current tab
        $(tab).addClass('active');
    },

    getResultType: function () {
        var _this = this;
        var activeTab = _this.resultTabs.find('.active');

        if (activeTab.length < 1) {
            return false;
        }

        return $(activeTab[0]).data('type');
    },

    changeMapSize: function (size) {
        $(this.jobMap).height(size);
    },

    setListItems: function (html) {
        this.itemsList.append(html);
    },

    clearListItems: function () {
        this.itemsList.empty();
    },

    showFilterBar: function () {
        this.filterBar.show();
    },

    hideFilterBar: function () {
        this.filterBar.attr('style', 'display:none!important');
    },

    showPreloader: function () {
        this.preloader.removeClass('d-none');
    },

    hidePreloader: function () {
        this.preloader.addClass('d-none');
    },

    clearAllFiltersAndContentContent: function () {
        this.changeMapSize(this.mapSizeShort);
        window.location.href = window.location.origin;
    }
};
