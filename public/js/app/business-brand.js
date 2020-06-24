function BusinessBrand() {
    //current item ID
    this.currentID;
    //current business ID
    this.businessID = APIStorage.read('business-id');
    //set default location data from business settings
    /*this.city = business.currentData.city;
    this.region = business.currentData.region;
    this.country = business.currentData.country;
    this.countryCode = business.currentData.country_code;
    this.street = business.currentData.street;*/
    //set form element
    this.form = $('#business-brand-form');
    //default name query for createLocation
    //this.query = "createLocation";
    //default param for clone event
    //this.cloneQuery = false;
    //element with sort list params
    this.sortElement = $('#business-brand-sort');
    this.limitElement = $('#business-brand-limit');
    //one time load departments
    //this.loadDepartments = 0;
    //one time load jobs
    //this.loadJobs = 0;
    //one time load managers
    //this.loadManagers = 0;

    //sort params
    this.sort;
    //order params
    this.order;
    //default limit items on page
    this.perPage = 25;
    //default page
    this.currentPage = 1;
    //pages count
    this.countPages = 1;
    //list limits
    this.perPageElement = $('.perpage');

    this.search = 0;
    //set param for job empty search
    //this.searchJob = 0;
    //set param for department empty search
    //this.searchDepartment = 0;
    //set param for manager empty search
    //this.searchManager = 0;

    //this.currentPageDepartment = 1;
    //this.currentPageManager = 1;
    //this.currentPageJob = 1;

    //this.countPagesDepartment = 1;
    //this.countPagesManager = 1;
    //this.countPagesJob = 1;

    //this.assigmentData = {};
    //this.loadLocationsData = {};

    //this.assigmentJobData = {};
    //this.loadJobData = {};
}

BusinessBrand.prototype = {
    init: function () {
        var _this = this;
        var body = $('body');

//------start URL-filter-sort-pagination
        //get sort param from url
        if (this.sort = getUrlParameter('sort')) {
            this.sortElement.val(this.sort);
        }
        //get order param from url
        if (this.order = getUrlParameter('order')) {
            this.sortElement.find('option[value="' + this.sort + '"][data-order="' + this.order + '"]').prop('selected', true);
        }
        //get per-page limit from url
        if (getUrlParameter('per-page')) {
            this.perPage = +getUrlParameter('per-page');
        }
        //set active class on current page
        this.perPageElement.removeClass('activesortamount');
        this.perPageElement.find('a[data-limit="' + this.perPage + '"]').parent().addClass('activesortamount');
        //get current page from url
        if (getUrlParameter('page')) {
            this.currentPage = +getUrlParameter('page')
        }
        //set per-page limit
        this.limitElement.change(function () {
            var limit = $(this).val();
            _this.perPage = +limit;
            updateQueryStringParam('per-page', limit);
            updateQueryStringParam('page', 1);
            setTimeout(function () {
                _this.getItems();
            }, 0);
        });
        //set sort & order for items
        this.sortElement.change(function () {
            updateQueryStringParam('sort', $(this).val());
            _this.sort = $(this).val();
            updateQueryStringParam('order', $(this).find('option:selected').attr('data-order'));
            _this.order = $(this).find('option:selected').attr('data-order');
            updateQueryStringParam('page', 1);
            setTimeout(function () {
                _this.getItems();
            }, 0);
        });
        body.on('click', '.page-link.page', function () {
            _this.currentPage = +$(this).text();
            updateQueryStringParam('page', _this.currentPage);
            _this.getItems(undefined, true);
        });
        body.on('click', '.page-prev', function () {
            if (_this.currentPage > 1) {
                _this.currentPage -= 1;
                updateQueryStringParam('page', _this.currentPage);
                _this.getItems(undefined, true);
            }
        });
        body.on('click', '.page-next', function () {
            if (_this.currentPage < _this.countPages) {
                _this.currentPage += 1;
                updateQueryStringParam('page', _this.currentPage);
                _this.getItems(undefined, true);
            }
        });
//------end URL-filter-sort-pagination
        //confirm item delete
        $('#business-brand-confirm-delete').click(function () {
            _this.delete();
        });

        //---------------------------------------------------------------------------------job share
        body.on('click', '[data-target="#ShareModal"]', function() {
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

        $('#ShareModal__send').click(function(event) {
            event.preventDefault();
            var link = $('#share-link').val();
            var email = $('#ShareModal__email').val();

            if (!email) {
                $.notify('Please, enter email!', 'warning');
                return;
            }

            new GraphQL("mutation", 'shareLink', {
                "email": email,
                "link": link,
            }, ['response'], true, false, function(data) {
                //
            }, function () {
                $.notify('Link sent!', 'success');
            }).request();
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
            $.notify(Langs.copied, 'success');
            e.clearSelection();
        });

        //set current ID for delete
        body.on('click', '.business-brand-delete', function () {
            var id = $(this).attr('data-id');
            _this.currentID = id;
        });
        //search location items
        var timeout = null;
        $('#business-brand-search').on('keyup', function (e) {
            if (e.which <= 90 && e.which >= 48 || e.which === 13 || e.which === 8) {
                var keywords = $(this).val().trim();
                updateQueryStringParam('search', keywords);
                updateQueryStringParam('page', 1);
                _this.currentPage = 1;
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    _this.getItems(keywords);
                }, 500);
            }
        });

        /*$('#business-brand__add-btn').click(function () {
            APIStorage.create('brand-business-id', _this.businessID);
        });*/

        /*body.on('click', '.business-brand__edit-btn', function () {
            var brandId = $(this).attr('data-id');
            if (brandId != _this.businessID) {
                APIStorage.create('brand-id', $(this).attr('data-id'));
            } else {
                APIStorage.remove('brand-business-id');
                APIStorage.remove('brand-id');
            }
        });*/
        $('#business-brand__add-btn').attr('href',$('#business-brand__add-btn').attr('href')+'?id='+business.currentID);
    },
    delete: function () {
        if (this.currentID) {
            /*var l = $('.brand-item').length;
            if (l > 1) {*/
                var _this = this;
                //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
                new GraphQL("mutation", "deleteBrand", {
                    "id": _this.currentID,
                    //"business_id": _this.businessID
                }, ['token'], true, false, function () {
                    Loader.stop();
                }, function () {
                    $('.brand-item[data-item-id="' + _this.currentID + '"]').remove();
                    $('#deleteModal').modal('hide');
                }, this.form).request();
            /*} else {
                $('#deleteModal').modal('hide');
                $('#deleteModal').on('hidden.bs.modal', function () {
                    $('#noDeleteModal').modal('show');
                    $('#deleteModal').unbind('hidden.bs.modal');
                });
            }*/
        }
    },
    //get all brands by business ID
    getItems: function (keywords, show) {
        var _this = this;
        var params = {
            "business_id": this.businessID
        };
        if (this.sort) {
            params['sort'] = this.sort;
        }
        if (this.order) {
            params['order'] = this.order;
        }
        params['limit'] = this.perPage;
        params['page'] = this.currentPage;

        var notShowLoader = (show) ? show : false;
        if (typeof keywords !== 'undefined') {
            if (keywords.length > 1) {
                params['keywords'] = keywords;
                this.search = 0;
            } else {
                if (this.search === 1) {
                    return;
                } else {
                    this.search = 1;
                }
            }
            notShowLoader = true;
        } else if (keywords = getUrlParameter('search')) {
            if (keywords.length > 1) {
                params['keywords'] = keywords;
            }
            $('#business-brand-search').val(keywords);
        }
        var brabdListElement = $('.business-brand-list');
        new GraphQL("query", "businessBrandsAuth", params, [
            'items {id html}',
            'pages',
            'current_page'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            brabdListElement.html('');
            if (data.items) {
                $.map(data.items, function (item) {
                    brabdListElement.append(item.html);
                });
            }
            _this.countPages = data.pages;
            _this.pagination(data.pages);
        }).request((notShowLoader) ? brabdListElement : false);
    },
    pagination: function (pages) {
        var _this = this;
        var html = '';
        if (pages > 1) {
            html = '<li class="page-item"><a class="page-link page-prev" href="javascript:void(0)"><</a></li>';
            for (var i = 1; i <= pages; i++) {
                var active = '';
                if (_this.currentPage === i) {
                    active = 'active';
                }
                html += '<li class="page-item ' + active + '"><a class="page-link page" href="javascript:void(0)">' + i + '</a></li>';
            }
            html += '<li class="page-item"><a class="page-link page-next" href="javascript:void(0)">></a></li>';
        }
        $('.pagination-content').html(html);
    },

};

$(document).ready(function () {
    loadPromise.then(function () {
        var businessBrand = new BusinessBrand();
        businessBrand.init();
        businessBrand.getItems();

    }).then(function () {
        app.runPromise();
    });
});
