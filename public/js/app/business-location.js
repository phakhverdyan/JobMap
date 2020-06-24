function BusinessLocation() {
    //current item ID
    this.currentID;
    //current business ID
    this.businessID = APIStorage.read('business-id');
    //set default location data from business settings
    this.city = business.currentData.city;
    this.region = business.currentData.region;
    this.country = business.currentData.country;
    this.countryCode = business.currentData.country_code;
    this.street = business.currentData.street;
    this.zipCode = business.currentData.zip_code;
    this.geoFullName ='';
    //set form element
    this.form = $('#business-location-form');
    //default name query for createLocation
    this.query = "createLocation";
    //default param for clone event
    this.cloneQuery = false;
    //element with sort list params
    this.sortElement = $('#business-location-sort');
    this.limitElement = $('#business-location-limit');
    //one time load departments
    this.loadDepartments = 0;
    //one time load jobs
    this.loadJobs = 0;
    //one time load managers
    this.loadManagers = 0;

    this.sort;// = 'name';
    this.order;// = 'asc';
    this.perPage = 0; // = 5;
    this.perPageBusiness = 10;
    this.currentPage = 0; // = 1;
    this.currentPageBusiness = 1;
    this.countPages = 1;
    //list limits
    this.perPageElement = $('.perpage');

    this.search = 0;
    //set param for job empty search
    this.searchJob = 0;
    //set param for department empty search
    this.searchDepartment = 0;
    //set param for manager empty search
    this.searchManager = 0;

    this.currentPageDepartment = 1;
    this.currentPageManager = 1;
    this.currentPageJob = 1;

    this.countPagesDepartment = 1;
    this.countPagesManager = 1;
    this.countPagesJob = 1;

    this.assigmentData = {};
    this.loadLocationsData = {};

    this.assigmentJobData = {};
    this.loadJobData = {};

    this.isClearLocations = true;
    this.elemUploadLocations = null;
    this.businessIDforLocation = 0;
}

BusinessLocation.prototype = {
    init: function () {
        var _this = this;
        var body = $('body');
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
            _this.currentPage = 1;
            _this.currentPageBusiness = 1;
            _this.elemUploadLocations = null;
            _this.isClearLocations = true;
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
            _this.currentPage = 1;
            _this.currentPageBusiness = 1;
            _this.elemUploadLocations = null;
            _this.isClearLocations = true;
            setTimeout(function () {
                _this.getItems();
            }, 0);
        });
        //confirm item delete
        $('#business-location-confirm-delete').click(function () {
            _this.delete();
        });
        //set current ID for delete
        body.on('click', '.business-location-delete', function () {
            var id = $(this).attr('data-id');
            _this.currentID = id;
        });
        //search location items
        $('#business-location-search').on('keydown', function (event) {
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        var timeout = null;
        $('#business-location-search').on('keyup', function (e) {
            if (e.which <= 90 && e.which >= 48 || e.which === 13 || e.which === 8) {
                var keywords = $(this).val().trim();
                updateQueryStringParam('search', keywords);
                updateQueryStringParam('page', 1);
                _this.currentPage = 1;
                _this.currentPageBusiness = 1;
                clearTimeout(timeout);
                _this.elemUploadLocations = null;
                _this.isClearLocations = true;
                timeout = setTimeout(function () {
                    _this.getItems(keywords);
                }, 500);
            }
        });

        //set per-page limit
        $('select[name="managers_type"]').on('change', function () {
            _this.getManagers();
        });

        /*body.on('click', '.page-link.page', function () {
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
        });*/
        var timeout2 = null;
        //search all unsiggned managers
        this.form.find('#manager-location-search').on('keyup', function (e) {
            if (e.which <= 90 && e.which >= 48 || e.which === 13 || e.which === 8) {
                var keywords = $(this).val();
                _this.currentPageManager = 1;
                clearTimeout(timeout2);
                timeout2 = setTimeout(function () {
                    var modal = false;
                    if ($('#ManaInLocModal:visible').length === 1) {
                        modal = true;
                    }
                    _this.getManagers(keywords.trim(), modal);
                }, 500);
            }
        });

        //select all checkboxes by type panel
        this.form.find('.assign-panel').on('click', '.assign-all', function () {
            var type = $(this).attr('data-type');
            _this.form.find('.' + type + '-item').prop('checked', true);
        });
        //deselect all checkboxes by type panel
        this.form.find('.assign-panel').on('click', '.unassign-all', function () {
            var type = $(this).attr('data-type');
            _this.form.find('.' + type + '-item').prop('checked', false);
        });

        this.form.on('click', '.pagination-manager-unassign .page-link.unassign-page', function () {
            _this.currentPageManager = +$(this).text();
            var keywords = $('#manager-location-search').val().trim();
            var modal = false;
            if ($('#ManaInLocModal:visible').length === 1) {
                modal = true;
            }
            _this.getManagers((keywords.length <= 1) ? undefined : keywords, modal);
        });
        this.form.on('click', '.pagination-manager-unassign .page-unassign-prev', function () {
            if (_this.currentPageManager > 1) {
                _this.currentPageManager -= 1;
                var keywords = $('#manager-location-search').val().trim();
                var modal = false;
                if ($('#ManaInLocModal:visible').length === 1) {
                    modal = true;
                }
                _this.getManagers((keywords.length <= 1) ? undefined : keywords, modal);
            }
        });
        this.form.on('click', '.pagination-manager-unassign .page-unassign-next', function () {
            if (_this.currentPageManager < _this.countPagesManager) {
                _this.currentPageManager += 1;
                var keywords = $('#manager-location-search').val().trim();
                var modal = false;
                if ($('#ManaInLocModal:visible').length === 1) {
                    modal = true;
                }
                _this.getManagers((keywords.length <= 1) ? undefined : keywords, modal);
            }
        });
        body.on('click', '#business-location-manager-set', function () {
            _this.setManagers();
        });
        //set current ID for assign modal
        body.on('click', '.business-manager-assign', function () {
            _this.currentID = $(this).attr('data-id');
            if (_this.assigmentData[_this.currentID]) {
                _this.managerItem(_this.assigmentData[_this.currentID], true, 'assigned');
            }
            if (_this.loadLocationsData[_this.currentID] === 0) {
                _this.getManagers(undefined, true);
                _this.loadLocationsData[_this.currentID] = 1;
            }
        });

        //set current ID for assign modal
        body.on('click', '.business-job-status-assign', function () {
            _this.currentID = $(this).attr('data-id');
            if (_this.assigmentJobData[_this.currentID]) {
                _this.jobItem(_this.assigmentJobData[_this.currentID]);
            }
        });

        body.on('click', '#open-all', function () {
            _this.form.find('.item-checkbox').prop('checked', true);
            _this.setJobStatus($(this));
        });
        body.on('click', '#close-all', function () {
            _this.form.find('.item-checkbox').prop('checked', false);
            _this.setJobStatus($(this));
        });

        this.form.find('#OpenClosedModal').on('click', '.item-checkbox', function () {
            _this.setJobStatus($(this));
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

        $('.js-upload-locations-from-file').click(function(event) {
            event.preventDefault();
            $('#upload-locations-from-file-modal').modal('show');
        });

        $('#upload-locations-from-file-modal__cancel').click(function(event) {
            event.preventDefault();
            $('#upload-locations-from-file-modal').modal('hide');
        });

        $('#upload-locations-from-file-modal__upload-field').click(function(event) {
            event.preventDefault();
            $('#upload-locations-from-file-modal__upload-input').click();
        });

        $('#upload-locations-from-file-modal__upload-input').change(function(event) {
            var form = $('#upload-locations-from-file-modal')[0] || null;
            var data = new FormData(form);

            new GraphQL("mutation", 'uploadLocationsFromFile', {
                business_id: _this.businessID,
            }, [ 'token' ], true, false, function(data) {
                Loader.stop();
            }, function(data) {
                $('#upload-locations-from-file-modal').modal('hide');
                $('#upload-locations-from-file-congrats-modal').modal('show');
            }, form, data).request();
        });

        $('#upload-locations-from-file-congrats-modal__close').click(function(event) {
            event.preventDefault();
            $('#upload-locations-from-file-congrats-modal').modal('hide');
        });

        /*body.on('click', '.list-add__upload-locations', function () {
            var businessId = parseInt($(this).attr('data-business_id'));
            _this.businessIDforLocation = businessId;
            var page = parseInt($(this).attr('data-page'));
            _this.currentPage = page +1;
            _this.isClearLocations = false;
            _this.elemUploadLocations = $(this);
            _this.getItems();
        });*/

        body.on('click', '.block_locations_business .page-item:not(.inactive):not(.active)', function () {

            var businessId = parseInt($(this).attr('data-business_id'));
            _this.businessIDforLocation = businessId;
            var page = parseInt($(this).attr('data-page'));
            _this.currentPageBusiness = page;
            _this.isClearLocations = false;
            _this.elemUploadLocations = $(this).closest('.block_locations_business');
            _this.getItems();
        });

        body.on('click', '#pagination_business_for_locations .page-item:not(.inactive):not(.active)', function () {

            var page = parseInt($(this).attr('data-page'));
            _this.currentPage = page;
            updateQueryStringParam('page', page);
            _this.currentPageBusiness = 1;
            _this.isClearLocations = true;
            _this.elemUploadLocations = null;
            _this.getItems();
        });


    },
    //init event for create or update form
    formEvents: function () {
        var _this = this;
        //clear all fileds in form
        this.form.on('click', 'input, select', function () {
            FormValidate.fieldValidateClear($(this));
        });

        new GraphQL('query', 'businessBrands', { // businessBrandsAuth
            business_id: _this.businessID,
            limit: 9999,
            page: 1
        }, [
            'items { id localized_name picture_o(origin: true) picture(width:200, height:200) picture_filename }',
        ], true, false, function() {
            //
        }, function(data) {
            /*var html_select = '<option data-picture_filename="' + business.currentData.picture_filename + '" data-picture="' + business.currentData.picture
                            + '" data-picture_o="' + business.currentData.picture_o + '" value="' + _this.businessID + '" selected>' + business.currentData.name + trans('main_business') + '</option>';*/

            var html_select = '';

            $.map(data.items, function (item, k) {
                if (item.id == _this.businessID) {
                    html_select += '<option data-picture_filename="' + item.picture_filename + '" data-picture="' + item.picture + '" data-picture_o="' + item.picture_o
                        + '" value="' + item.id +'">' + item.localized_name + trans('main_business') + '</option>';
                }
            });

            $.map(data.items, function (item, k) {
                if (item.id != _this.businessID) {
                    html_select += '<option data-picture_filename="' + item.picture_filename + '" data-picture="' + item.picture + '" data-picture_o="' + item.picture_o
                        + '" value="' + item.id +'">' + item.localized_name + '</option>';
                }
            });

            $('#location-select-brand').html(html_select);
        }, false).request();
        /*$('#location-checkbox-main').change(function () {
            if ($(this).is(':checked')) {
                $('#location-select-brand').val(0);
            }
        });*/
        $('#location-select-brand').change(function () {
            var logo = $('.business-pic-view input[name="logo"]').data('logo');
            if (!logo) {
                var picture = $(this).find('option:selected').data('picture');
                var picture_o = $(this).find('option:selected').data('picture_o');
                var picture_filename = $(this).find('option:selected').data('picture_filename');
                $('.business-pic-view img').attr('src',picture);
                $('.business-pic-view input[name="logo"]').val(picture_filename);
                new CropAvatar('business-pic-view', 'business-pic-change-btn', false, false, false, false, picture_o, 'location_edit');
            }
        });

        var timeout1 = null;
        //search all unsiggned departments
        this.form.find('#department-location-search').on('keyup', function (e) {
            if (e.which <= 90 && e.which >= 48 || e.which === 13 || e.which === 8) {
                var keywords = $(this).val();
                _this.currentPageDepartment = 1;
                clearTimeout(timeout1);
                timeout1 = setTimeout(function () {
                    _this.getDepartments(keywords.trim());
                }, 500);
            }
        });
        var timeout3 = null;
        //search all unsiggned jobs
        this.form.find('#job-location-search').on('keyup', function (e) {
            if (e.which <= 90 && e.which >= 48 || e.which === 13 || e.which === 8) {
                var keywords = $(this).val();
                _this.currentPageJob = 1;
                clearTimeout(timeout3);
                timeout3 = setTimeout(function () {
                    _this.getJobs(keywords.trim());
                }, 500);
            }
        });

        (function initialize_multilanguage() {
            var default_language = 'en';

            if (business.currentData.language) {
                default_language = business.currentData.language.prefix;
            }

            $('select[name="current_language_prefix"]').children('option').each(function() {
                $(this).text($(this).text().replace(/\s+\(Default\)$/, ''));
            });

            $('select[name="current_language_prefix"]').children('option[value="' + default_language + '"]').each(function() {
                $(this).text($(this).text() + ' (Default)');
            });

            $('select[name="current_language_prefix"]').val(default_language);

            $('select[name="current_language_prefix"]').change(function() {
                var current_language_prefix = $(this).val();
                _this.form.find('.multilanguage').addClass('d-none');
                _this.form.find('.multilanguage-' + $(this).val()).removeClass('d-none');

                _this.form.find('.multilanguage').siblings('label').each(function() {
                    $(this).html($(this).html().split(/\(/).slice(0, -1).join('(') + ' (' + current_language_prefix + ')');
                });
            });

            this.form.find('.multilanguage').addClass('d-none');
            this.form.find('.multilanguage-' + default_language).removeClass('d-none');

            this.form.find('.multilanguage').siblings('label').each(function() {
                $(this).html($(this).html() + ' (' + default_language + ')');
            });
        }).apply(this);

        //create location
        this.form.find('#business-location-create').on('click', function () {
            _this.save();
        });
        //one time load all items by clicking on panel
        this.form.on('click', '.main-panel', function () {
            var type = $(this).attr('data-type-panel');
            switch (type) {
                case 'jobs':
                    if (_this.loadJobs === 0) {
                        _this.getJobs();
                        _this.loadJobs = 1;
                    }
                    break;
                case 'managers':
                    if (_this.loadManagers === 0) {
                        _this.getManagers();
                        _this.loadManagers = 1;
                    }
                    break;
                case 'departments':
                    if (_this.loadDepartments === 0) {
                        _this.getDepartments();
                        _this.loadDepartments = 1;
                    }
                    break;
            }
        });
        this.form.on('click', '.pagination-department-unassign .page-link.unassign-page', function () {
            _this.currentPageDepartment = +$(this).text();
            var keywords = $('#department-location-search').val().trim();
            _this.getDepartments((keywords.length <= 1) ? undefined : keywords);
        });
        this.form.on('click', '.pagination-department-unassign .page-unassign-prev', function () {
            if (_this.currentPageDepartment > 1) {
                _this.currentPageDepartment -= 1;
                var keywords = $('#department-location-search').val().trim();
                _this.getDepartments((keywords.length <= 1) ? undefined : keywords);
            }
        });
        this.form.on('click', '.pagination-department-unassign .page-unassign-next', function () {
            if (_this.currentPageDepartment < _this.countPagesDepartment) {
                _this.currentPageDepartment += 1;
                var keywords = $('#department-location-search').val().trim();
                _this.getDepartments((keywords.length <= 1) ? undefined : keywords);
            }
        });

        this.form.on('click', '.pagination-job-unassign .page-link.unassign-page', function () {
            _this.currentPageJob = +$(this).text();
            var keywords = $('#job-location-search').val().trim();
            _this.getJobs((keywords.length <= 1) ? undefined : keywords);
        });
        this.form.on('click', '.pagination-job-unassign .page-unassign-prev', function () {
            if (_this.currentPageJob > 1) {
                _this.currentPageJob -= 1;
                var keywords = $('#job-location-search').val().trim();
                _this.getJobs((keywords.length <= 1) ? undefined : keywords);
            }
        });
        this.form.on('click', '.pagination-job-unassign .page-unassign-next', function () {
            if (_this.currentPageJob < _this.countPagesJob) {
                _this.currentPageJob += 1;
                var keywords = $('#job-location-search').val().trim();
                _this.getJobs((keywords.length <= 1) ? undefined : keywords);
            }
        });
        this.form.find('#business-location-street').keyup(function (eventObject) {
            if (!isVisibleInputStreetCheck && $.isNumeric(eventObject.key)) {
                $('#input-street-check').fadeIn();
                $('#ui-id-3').css('top', '1024px');
                isVisibleInputStreetCheck = true;
            }
        });

        new GraphQL("query", "amenities", {}, [
            'id',
            'name',
            'key'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            var html = '';

            $.map(data, function(item) {
                html += '' +
                    '<label class="btn btn-outline-primary btn-block py-1 mt-0 amenities" ' +
                        'data-toggle="tooltip" ' +
                        'title="' + item.name + '" data-id="' + item.id + '"> ' +
                            '<input type="checkbox" autocomplete="off"> ' +
                            $('#amenities-icon-' + item.key).html() +
                    '</label>' +
                '';
            });

            _this.form.find('.amenities-list').html(html);
        }, false).request(_this.form.find('.amenities-list'), false, true);
        var locationField = this.form.find('#business-location-auto');
        //clear location field and focus
        this.form.on('click', '#location-clear', function () {
            locationField.val('');
            locationField.focus();
            $('#location-clear').parent().addClass('hide');
            locationField.addClass('autocomplete-border');
            _this.city = "";
            _this.region = "";
            _this.country = "";
            _this.countryCode = "";
            _this.geoFullName = '';
            locationField.parent().find('.glyphicon').attr('class','glyphicon');
        });
        //autocomplete locations
        locationField.autocomplete({
            source: function (request, response) {
                //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler
                if (request.term.length === 0) {
                    $('#location-clear').parent().addClass('hide');
                    locationField.addClass('autocomplete-border');
                    _this.geoFullName = '';
                } else {
                    $('#location-clear').parent().removeClass('hide');
                    locationField.removeClass('autocomplete-border');
                }
                new GraphQL("query", "geo", {
                    "key": request.term
                }, ['fullName', 'city', 'region', 'country', 'countryCode'], false, false, function () {
                    response([]);
                }, function (data) {
                    if (data.length !== 0) {
                        var transformed = $.map(data, function (el) {
                            return {
                                label: el.fullName,
                                id: el.countryCode,
                                data: el
                            };
                        });
                        response(transformed);
                    } else {
                        _this.city = "no_geo_data";
                        _this.region = "";
                        _this.country = "";
                        _this.countryCode = "";
                        _this.geoFullName = '';
                        locationField.removeClass('ui-autocomplete-loading');
                    }
                }).autocomplete();
            },
            select: function (event, ui) {
                _this.city = ui.item.data.city;
                _this.region = ui.item.data.region;
                _this.country = ui.item.data.country;
                _this.countryCode = ui.item.id;
                var flag = _this.form.find('#basic-addon1');
                flag.find('i').removeClassRegex(/^bfh-flag-/);
                flag.find('i').addClass('bfh-flag-' + ui.item.id);

                _this.geoFullName = ui.item.data.fullName;

                _this.form.find('.country').val(ui.item.id);
                _this.form.find('.bfh-selectbox-option').html('');
                _this.form.find('.bfh-selectbox-option').html('<i class="glyphicon bfh-flag-' + ui.item.id + '"></i>' + BFHCountriesList[ui.item.id]);
            },
            response: function (e, u) {
                locationField.removeClass('ui-autocomplete-loading');
            }
        }).attr('autocomplete', 'disabled').autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                .append('<span><i class="glyphicon bfh-flag-' + item.id + '"></i> </span><span>' + item.label + '</span>')
                .appendTo(ul);
        };

        locationField.keydown(function () {
            _this.city = "no_geo_data";
            _this.region = "";
            _this.country = "";
            _this.countryCode = "";
            _this.geoFullName = '';
            locationField.parent().find('.glyphicon').attr('class','glyphicon');
        });

        //location street
        var $formForLocation = $('#business-location-form'),
            $locationStreet = $formForLocation.find('#business-location-street'),
            $clearLocationStreet = $formForLocation.find('#location-street-clear'),
            $inputStreetCheck = $formForLocation.find('#input-street-check'),
            $selectStreet = $('#ui-id-4'),
            $inputStreetNumberClear = $formForLocation.find('#input-street-number-clear'),
            $inputStreetNumberKeep = $formForLocation.find('#input-street-number-keep'),
            isVisibleInputStreetCheck = false;
        $locationStreet.keyup(function (eventObject) {
            if (!isVisibleInputStreetCheck && $.isNumeric(eventObject.key)) {
                $inputStreetCheck.fadeIn();
                $selectStreet.css('top', '1024px');
                isVisibleInputStreetCheck = true;
            }
        });
        $inputStreetNumberClear.click(function () {
            $locationStreet.val($locationStreet.val().replace(/[0-9]/g, ''));
            $inputStreetCheck.fadeOut();
            $selectStreet.css('top', '984px');
            isVisibleInputStreetCheck = false;
        });
        $inputStreetNumberKeep.click(function () {
            $inputStreetCheck.fadeOut();
            $selectStreet.css('top', '984px');
            isVisibleInputStreetCheck = false;
        });
        //clear location street and focus
        this.form.on('click', '#location-street-clear', function () {
            $locationStreet.val('');
            $locationStreet.focus();
            $clearLocationStreet.parent().addClass('hide');
            $locationStreet.addClass('autocomplete-border');
            _this.street = "";
        });
        var geocoder = new google.maps.Geocoder();
        //autocomplete locations street
        $locationStreet.autocomplete({
            source: function (request, response) {
                if (request.term.length === 0) {
                    $clearLocationStreet.parent().addClass('hide');
                    $locationStreet.addClass('autocomplete-border');
                } else {
                    $clearLocationStreet.parent().removeClass('hide');
                    $locationStreet.removeClass('autocomplete-border');
                }
                var params = {
                    'key': request.term
                };
                if (_this.geoFullName.length > 1) {
                    geocoder.geocode({'address': _this.geoFullName}, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            params['latitude'] = results[0].geometry.location.lat();
                            params['longitude'] = results[0].geometry.location.lng();
                        }
                    });
                }
                setTimeout(function () {
                    new GraphQL("query", "geoStreet", params, [
                        'description',
                        'id',
                        'street'
                    ], false, false, function () {
                        response([]);
                    }, function (data) {
                        if (data.length !== 0) {
                            var transformed = $.map(data, function (el) {
                                return {
                                    label: el.description,
                                    id: el.id,
                                    data: el
                                };
                            });
                            response(transformed);
                        } else {
                            _this.street = "no_geo_data";
                            $locationStreet.removeClass('ui-autocomplete-loading');
                        }
                    }).autocomplete();
                },200);
            },
            select: function (event, ui) {
                //_this.street = ui.item.data.description;
                if (ui.item.data.description.length > 1) {
                    geocoder.geocode({'address': ui.item.data.description}, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            _this.form.find('input[name="zip_code"]').val(results[0].address_components[results[0].address_components.length - 1].long_name);
                        }
                    });
                }
            },
            close: function (event, ui) {
                if ($locationStreet.val().indexOf(',') != -1) {
                    var street = $locationStreet.val();
                    street = street.substr(0, street.indexOf(','));
                    $locationStreet.val(street);
                    _this.street = street;
                }
            },
            response: function (e, u) {
                $locationStreet.removeClass('ui-autocomplete-loading');
            }
        }).attr('autocomplete', 'disabled')/*.autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                .append('<span>' + item.id + '</span><span>' + item.label + '</span>')
                .appendTo(ul);
        }*/;
        $locationStreet.keydown(function () {
            _this.street = "no_geo_data";
        });
    },
    //location create
    create: function () {
        var _this = this;
        this.formEvents();

        //this.form.find('[name="phone"]').val(business.currentData.phone);
        if (this.countryCode) {
            this.form.find('.country').val(this.countryCode);
            this.form.find('.bfh-selectbox-option').html('');
            this.form.find('.bfh-selectbox-option').html('<i class="glyphicon bfh-flag-' + this.countryCode + '"></i>' + BFHCountriesList[this.countryCode]);
        }

       /* var flag = this.form.find('#basic-addon1');
        flag.find('i').removeClassRegex(/^bfh-flag-/);
        flag.find('i').addClass('bfh-flag-' + this.countryCode);


        var location = this.city;
        if (this.region !== null) {
            location += "," + this.region;
        }
        if (this.country !== null) {
            location += "," + this.country;
        }
        this.geoFullName = location;

        this.form.find('input[name="city"]').val(location);
        this.form.find('input[name="street"]').val(this.street);
        this.form.find('input[name="zip_code"]').val(this.zipCode);*/
        //if ($('.business-pic-view').length > 0) {
        //init cropper
        $('.business-pic-view img').attr('src',business.currentData.picture);
        $('.business-pic-view input[name="logo"]').val(business.currentData.picture_filename);
        new CropAvatar('business-pic-view', 'business-pic-change-btn', false, false, false, false, business.currentData.picture_o, 'location_add');

        //new CropAvatar('business-pic-view', 'business-pic-change-btn', false, false, false, false, false, 'location_add');
        //}
    },
    //location delete request
    delete: function () {
        if (this.currentID) {
            var l = $('.location-item').length;
            if (l > 1) {
                var _this = this;
                //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
                new GraphQL("mutation", "deleteLocation", {
                    "id": _this.currentID,
                    "business_id": _this.businessID
                }, ['token'], true, false, function () {
                    Loader.stop();
                }, function () {
                    $('.location-item[data-item-id="' + _this.currentID + '"]').remove();
                    $('#deleteModal').modal('hide');
                }, this.form).request();
            } else {
                $('#deleteModal').modal('hide');
                $('#deleteModal').on('hidden.bs.modal', function () {
                    $('#noDeleteModal').modal('show');
                    $('#deleteModal').unbind('hidden.bs.modal');
                });
            }
        }
    },
    //clone location item
    clone: function () {
        this.form.find('.business-location-type').removeClass('active');
        this.cloneQuery = true;
        var _this = this;
        setTimeout(function () {
            _this.getItem();
        }, 0);
    },
    //save location
    save: function () {
        var _this = this;

        var amenities = [];
        $.each(this.form.find('.amenities.active'), function () {
            amenities.push($(this).attr('data-id'));
        });
        var code = this.form.find('#country-phone .bfh-selectbox-option').clone();
        code.find('span').remove();

        var geocoder = new google.maps.Geocoder();

        var formData = pictureForm;

        var params = {
            "business_id": this.businessID,
            "brand_id": parseInt($('#location-select-brand').val()),
            "name": FormValidate.getFieldValue('name', this.form),
            "name_fr": FormValidate.getFieldValue('name_fr', this.form),
            //"main": +FormValidate.getCheckedFieldValue('main', this.form),
            //"street": FormValidate.getFieldValue('street', this.form),
            "street": this.street,
            "street_number": streetNumber = FormValidate.getFieldValue('street_number', this.form),
            "latitude": 0,
            "longitude": 0,
            "suite": FormValidate.getFieldValue('suite', this.form),
            "type": "",//this.form.find('.business-location-type.active').attr('data-type'),
            "city": this.city,
            "region": this.region,
            "country": this.country,
            "country_code": this.countryCode,
            "phone": FormValidate.getFieldValue('phone', this.form),
            "phone_code": code.text(),
            "managers_type": "",///$('select[name="managers_type"]').val(),
            "phone_country_code": this.form.find('.country').val(),
            "zip_code": this.form.find('input[name="zip_code"]').val(),
            "amenities": amenities.join(','),
            "logo": $('.business-pic-view input[name="logo"]').val()
        };

        var location = params['street'] + ' ' + params['street_number'];
        location += "," + _this.city;
        if (_this.country !== null) {
            location += "," + _this.country;
        }

        geocoder.geocode({'address': location}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                params['latitude'] = results[0].geometry.location.lat();
                params['longitude'] = results[0].geometry.location.lng();
            }

            //get departments for location
            var departments = [];
            $.each(_this.form.find('.department-item:checked'), function () {
                departments.push($(this).val());
            });
            params['department_locations'] = departments.join(",");
            //get managers for location
            var managers = [];
            $.each(_this.form.find('.manager-item:checked'), function () {
                managers.push($(this).val());
            });
            params['manager_locations'] = managers.join(",");
            //get jobs for location
            var jobs = [];
            $.each(_this.form.find('.job-item:checked'), function () {
                jobs.push($(this).val());
            });
            params['job_locations'] = jobs.join(",");
            //params for response
            var needParams = ['id', 'token'];
            if (_this.currentID && !_this.cloneQuery) {
                params['id'] = +_this.currentID;
                _this.query = 'updateLocation';
            }
            //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
            new GraphQL("mutation", _this.query, params, needParams, true, '/business/branch/locations', function () {
                Loader.stop();
            //}, false, _this.form).request();
            }, false, _this.form, formData).request();
        });
    },
    setManagers: function () {
        var _this = this;
        var params = {
            "business_id": this.businessID
        };

        //get managers for location
        var managers = [];
        $.each(this.form.find('.manager-item:checked'), function () {
            managers.push($(this).val());
        });
        params['manager_locations'] = managers.join(",");

        //params for response
        var needParams = ['id', 'token', ' assign_managers {' +
        'id first_name last_name user_picture_50(width: 50, height: 50) role created_date' +
        '}'];
        params['id'] = +this.currentID;
        this.query = 'updateLocationManager';
        //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
        new GraphQL("mutation", this.query, params, needParams, true, false, function () {
            Loader.stop();
        }, function (data) {
            if (data) {
                $('#ManaInLocModal').modal('hide');
                _this.assigmentData[_this.currentID] = data.assign_managers;
                _this.loadLocationsData[_this.currentID] = 0;
                _this.form.find('.business-manager-assign[data-id="' + _this.currentID + '"] span').text(data.assign_managers.length);
            }
        }).request();
    },
    setJobStatus: function (element) {
        var _this = this;
        var params = {
            "business_id": this.businessID
        };
        var open = [];
        var close = [];
        if (element.is('.item-checkbox')) {
            var type = 'close';
            if (element.prop('checked')) {
                type = 'open';
            }
            params[type + '_jobs'] = element.val();
        } else if (element.is('button')) {
            var el = element.parents('.modal-body');
            $.each(el.find('.item-checkbox'), function () {
                if ($(this).prop('checked')) {
                    open.push($(this).val());
                } else {
                    close.push($(this).val());
                }
            });
            params['open_jobs'] = open.join(",");
            params['close_jobs'] = close.join(",");
        }
        //params for response
        var needParams = ['id', 'token', 'assign_jobs {' +
        'id title job_status' +
        '}'];
        var query = 'updateJobLocationStatus';
        //set update method
        params['id'] = +this.currentID;
        //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
        new GraphQL("mutation", query, params, needParams, true, false, function () {
            Loader.stop();
        }, function (data) {
            if (data) {
                $('#ManaInLocModal').modal('hide');
                _this.assigmentJobData[_this.currentID] = data.assign_jobs;
                _this.loadJobData[_this.currentID] = 0;
                _this.counterRefresh();
            }
        }).request();
    },
    counterRefresh: function () {
        var _this = this;
        if (_this.assigmentJobData[_this.currentID]) {
            var open = 0;
            var close = 0;
            $.map(_this.assigmentJobData[_this.currentID], function (item) {
                if (item) {
                    if (item.job_status === 0) {
                        close++;
                    } else {
                        open++;
                    }
                }
            });
            _this.form.find('.business-job-status-assign[data-id="' + _this.currentID + '"] span:first').text(open);
            _this.form.find('.business-job-status-assign[data-id="' + _this.currentID + '"] span:last').text(close);
        }
    },
    //get all departments for current business
    getDepartments: function (keywords) {
        var _this = this;
        var params = {
            "business_id": this.businessID,
            "limit": 10
        };
        if (typeof keywords !== 'undefined') {
            if (keywords.length > 1) {
                params['keywords'] = keywords;
                this.searchDepartment = 0;
            } else {
                if (this.searchDepartment === 1) {
                    return;
                } else {
                    this.searchDepartment = 1;
                }
            }
        }
        params['page'] = this.currentPageDepartment;
        var type = 'unassigned';
        if (this.currentID) {
            params['location_id'] = this.currentID;
            params['assignment'] = 0;
        }
        var el = _this.form.find('.department-' + type + '-header');
        new GraphQL("query", "businessDepartments", params, [
            'items {' +
            'id name created_date' +
            '}',
            'pages',
            'current_page'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            _this.form.find('.department' + type + '-item').remove();
            if (data.items) {
                _this.departmentItem(data.items, type);
            }
            _this.countPagesDepartment = data.pages;
            _this.paginationUnAssignItems(data.pages, 'department');
        }).request(el, true);
    },
    //get all managers for current business
    getManagers: function (keywords, modal) {
        var _this = this;
        var params = {
            "business_id": this.businessID,
            "limit": 10
        };
        if (typeof keywords !== 'undefined') {
            if (keywords.length > 1) {
                params['keywords'] = keywords;
                this.searchManager = 0;
            } else {
                if (this.searchManager === 1) {
                    return;
                } else {
                    this.searchManager = 1;
                }
            }
        }
        params['page'] = this.currentPageManager;
        var type = 'unassigned';
        if (this.currentID) {
            params['location_id'] = this.currentID;
            params['assignment'] = 0;
        }
        var locale = APIStorage.read('language');
        if (locale != 'en') {
            params['locale'] = locale;
        }
        var el = _this.form.find('.manager-' + type + '-header');

        params['managers_type'] = $('select[name="managers_type"]').val();

        new GraphQL("query", "businessManagers", params, [
            'items {' +
            'id first_name last_name user_picture_50(width: 50, height: 50) role manager_type created_date' +
            '}',
            'pages',
            'current_page'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            _this.form.find('.manager-' + type + '-item').remove();
            if (data.items) {
                _this.managerItem(data.items, false, type);
            }
            _this.countPagesManager = data.pages;
            _this.paginationUnAssignItems(data.pages, 'manager');
        }).request(el, true);

    },
    //get all jobs for current business
    getJobs: function (keywords) {
        var _this = this;
        var params = {
            "business_id": this.businessID,
            "limit": 10
        };
        if (typeof keywords !== 'undefined') {
            if (keywords.length > 1) {
                params['keywords'] = keywords;
                this.searchJob = 0;
            } else {
                if (this.searchJob === 1) {
                    return;
                } else {
                    this.searchJob = 1;
                }
            }
        }
        params['page'] = this.currentPageJob;
        var type = 'unassigned';
        if (this.currentID) {
            params['location_id'] = this.currentID;
            params['assignment'] = 0;
        }
        var el = _this.form.find('.job-' + type + '-header');
        new GraphQL("query", "businessJobsLocations", params, [
            'items {' +
            'id title created_date' +
            '}',
            'pages',
            'current_page'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            _this.form.find('.job-' + type + '-item').remove();
            if (data.items) {
                _this.jobAssignItem(data.items, type);
            }
            _this.countPagesJob = data.pages;
            _this.paginationUnAssignItems(data.pages, 'job');
        }).request(el, true);
    },
    //get location by current ID
    managerItem: function (data, modal, type) {
        var checkedAttr = '';
        if (type === 'assigned') {
            checkedAttr = 'checked';
        }
        var _this = this;
        var el = _this.form.find('.manager-' + type + '-header');
        _this.form.find('.manager-' + type + '-item').remove();
        $.map(data, function (item) {
            if (item.id) {
                var picture = (item.user_picture_50) ? item.user_picture_50 : '/img/profilepic2.png';
                var ownerManager = '';
                if (item.role === 'admin') {
                    ownerManager = ' onclick="return false;"';
                    if (checkedAttr != 'checked') {
                        ownerManager += ' checked';
                    }
                }
                var html = '<div class="col-md-11 mt-2 mx-auto pl-4 manager-' + type + '-item">\n' +
                    '           <div class="d-flex">\n' +
                    '               <div class="col-1 pt-1 mt-2 pr-5 pxa-0">\n' +
                    '                   <label class="custom-control custom-checkbox m-0 pl-3">\n' +
                    '                       <input type="checkbox"\n' +
                    '                              class="custom-control-input manager-item" ' + checkedAttr + ownerManager + ' value="' + item.id + '">\n' +
                    '                       <span class="custom-control-indicator"></span>\n' +
                    '                   </label>\n' +
                    '               </div>\n' +
                    '               <div class="col-lg-10 col-11 pxa-0 pl-0">\n' +
                    '                   <div class="d-flex flex-column flex-md-row justify-content-between">\n' +
                    '                       <div class="d-flex">\n' +
                    '                           <div class="pr-4 pxa-0">\n' +
                    '                               <img src="' + picture + '"\n' +
                    '                                   alt="avatar" width="50px;"/>\n' +
                    '                           </div>\n' +
                    '                           <div class="">\n' +
                    '                               <p class="my-0 px-3 coll_name">\n' +
                    '                                   <strong>' + item.first_name + ' ' + item.last_name + '</strong></p>\n' +
                    '                               <p class="my-0 px-3 coll_title">' + item.manager_type + '</p>\n' +
                    '                           </div>\n' +
                    '                       </div>\n';
                if (!modal) {
                    html += '                       <div class="col-md-3 text-right">\n' +
                        '                           <p class="my-0 small">\n' +
                        '                               <strong>'+trans('created')+'</strong>\n' +
                        '                           </p>\n' +
                        '                           <p class="my-0">' + item.created_date + '</p>\n' +
                        '                       </div>\n';
                }
                html += '                   </div>\n' +
                    '               </div>\n' +
                    '           </div>\n' +
                    '       </div>';
                el.after(html);
            }
        });
    },
    //job item html
    departmentItem: function (data, type) {
        var _this = this;
        var checkedAttr = '';
        if (type === 'assigned') {
            checkedAttr = 'checked';
        }
        var el = _this.form.find('.department-' + type + '-header');
        _this.form.find('.department' + type + '-item').remove();
        $.map(data, function (item) {
            if (item.id) {
                var html = '<div class="col-md-11 mt-2 mx-auto pl-4 department-' + type + '-item">\n' +
                    '           <div class="d-flex">\n' +
                    '               <div class="col-1 pt-1 mt-2 pr-5 pxa-0">\n' +
                    '                   <label class="custom-control custom-checkbox m-0 pl-3">\n' +
                    '                       <input type="checkbox"\n' +
                    '                              class="custom-control-input department-item" ' + checkedAttr + ' value="' + item.id + '">\n' +
                    '                       <span class="custom-control-indicator"></span>\n' +
                    '                   </label>\n' +
                    '               </div>\n' +
                    '               <div class="col-lg-10 col-11 pl-0">\n' +
                    '                   <div class="d-flex flex-column flex-md-row">\n' +
                    '                       <div class="col-md-9">\n' +
                    '                           <p class="my-0 px-3 mt-2 pt-1 coll_name">\n' +
                    '                               <strong>' + item.name + '</strong></p>\n' +
                    '                       </div>\n' +
                    '                       <div class="col-md-3 text-right">\n' +
                    '                           <p class="my-0 small">\n' +
                    '                               <strong>'+Langs.created+'</strong>\n' +
                    '                           </p>\n' +
                    '                           <p class="my-0">' + item.created_date + '</p>\n' +
                    '                       </div>\n' +
                    '                   </div>\n' +
                    '               </div>\n' +
                    '           </div>\n' +
                    '       </div>';
                el.after(html);
            }
        });
    },
    jobAssignItem: function (data, type) {
        var _this = this;
        var checkedAttr = '';
        if (type === 'assigned') {
            checkedAttr = 'checked';
        }
        var el = _this.form.find('.job-' + type + '-header');
        _this.form.find('.job-' + type + '-item').remove();
        $.map(data, function (item) {
            if (item.id) {
                var html = '<div class="col-md-11 mt-3 mx-auto pl-4 job-' + type + '-item">\n' +
                    '           <div class="d-flex">\n' +
                    '               <div class="col-1 pt-1 mt-2 pr-5 pxa-0">\n' +
                    '                   <label class="custom-control custom-checkbox m-0 pl-3">\n' +
                    '                       <input type="checkbox"\n' +
                    '                              class="custom-control-input job-item" ' + checkedAttr + ' value="' + item.id + '">\n' +
                    '                       <span class="custom-control-indicator"></span>\n' +
                    '                   </label>\n' +
                    '               </div>\n' +
                    '               <div class="col-lg-10 col-11 pl-0 pxa-0">\n' +
                    '                   <div class="d-flex flex-column flex-md-row">\n' +
                    '                       <div class="col-md-9">\n' +
                    '                           <p class="my-0 px-3 coll_name"><strong>' + item.title + '</strong></p>\n' +
                    //'                           <p class="my-0 px-3 coll_title">job type</p>\n' +
                    '                       </div>\n' +
                    '                       <div class="col-md-3 text-right">\n' +
                    '                           <p class="my-0 small">\n' +
                    '                               <strong>'+Langs.created+'</strong>\n' +
                    '                           </p>\n' +
                    '                           <p class="my-0">' + item.created_date + '</p>\n' +
                    '                       </div>\n' +
                    '                   </div>\n' +
                    '               </div>\n' +
                    '           </div>\n' +
                    '       </div>';
                el.after(html);
            }
        });
    },
    jobItem: function (data) {
        var _this = this;
        var type = 'open';
        var checked = 'checked';
        _this.form.find('.open-item').remove();
        _this.form.find('.close-item').remove();
        var open = 0;
        var close = 0;
        $.map(data, function (item) {
            if (item) {
                if (item.job_status === 0) {
                    close++;
                    type = 'close';
                    checked = '';
                } else {
                    open++;
                    type = 'open';
                    checked = 'checked';
                }
                var el = _this.form.find('.' + type + '-header');

                var html = '<div class="col-md-12 mt-2 ' + type + '-item">\n' +
                    '           <div class="row">\n' +
                    '               <div class="col-md-8 ml-3">\n' +
                    '                   <p class="my-0 px-3 coll_name"><strong>' + item.title + '</strong></p>\n' +
                    '               </div>\n' +
                    '               <div class="col-sm-5 col-md-2 offset-md-1">\n' +
                    '                   <label class="switch mt-3">\n' +
                    '                       <input type="checkbox" class="item-checkbox" ' + checked + ' value="' + item.id + '">\n' +
                    '                       <span class="slider round"></span>\n' +
                    '                   </label>\n' +
                    '               </div>\n' +
                    '           </div>\n' +
                    '       </div>';
                el.after(html);
            }
        });
        $('#jobs-open-close-title').find('span:first').text(open);
        $('#jobs-open-close-title').find('span:last').text(close);
    },
    getItem: function () {
        this.formEvents();

        if (this.currentID = getUrlParameter('id')) {
            var _this = this;
            var params = {
                "id": _this.currentID,
                //"business_id": _this.businessID
            };
            new GraphQL("query", "businessLocation", params, [
                'id',
                'business_id',
                'name', 'name_fr',
                'picture_o(origin: true)',
                'picture(width:200, height:200)',
                //'picture_50(width:50, height:50)',
                //'picture_100(width:100, height:100)',
                'picture_filename',
                'main',
                'street',
                'street_number',
                'suite',
                'type',
                'city',
                'region',
                'country',
                'country_code',
                'phone',
                'phone_code',
                'zip_code',
                'managers_type',
                'phone_country_code',
                'amenities_string',
                'assign_departments {' +
                    'id name created_date' +
                '}',
                'assign_managers {' +
                    'id first_name last_name user_picture_50(width: 50, height: 50) role created_date manager_type' +
                '}',
                'assign_jobs {' +
                    'id title created_date' +
                '}'
            ], false, false, function () {
                Loader.stop();
            }, function (data) {
                if (data.id) {
                    var type = 'assigned';
                    _this.form.find('input[name="name"]').val(data.name);
                    _this.form.find('input[name="name_fr"]').val(data.name_fr);

                    if (data.main === 1) {
                        _this.form.find('input[name="main"]').prop('checked', true);
                        _this.form.find('input[name="main"]').attr('disabled', true);
                    }
                    if (data.business_id) {
                        setTimeout(function() {
                            /*$('#location-select-brand').val(0);
                            if (data.business_id != _this.businessID) {
                                $('#location-select-brand').val(data.business_id);
                            }*/
                            $('#location-select-brand').val(data.business_id);
                        },1000);
                    }

                    _this.street = data.street;
                    _this.form.find('input[name="street"]').val(data.street);
                    _this.form.find('input[name="street_number"]').val(data.street_number);
                    _this.form.find('input[name="suite"]').val(data.suite);
                    _this.form.find('input[name="phone"]').val(data.phone);
                    _this.form.find('input[name="zip_code"]').val(data.zip_code);
                    $('select[name="managers_type"]').val(data.managers_type);

                    var location = data.city;
                    _this.city = location;
                    if (data.region !== null) {
                        location += "," + data.region;
                        _this.region = data.region;
                    }
                    if (data.country !== null) {
                        location += "," + data.country;
                        _this.country = data.country;
                    }
                    _this.geoFullName = location;
                    _this.form.find('input[name="city"]').val(location);
                    _this.countryCode = data.country_code;
                    var flag = _this.form.find('#basic-addon1');
                    flag.find('i').removeClassRegex(/^bfh-flag-/);
                    flag.find('i').addClass('bfh-flag-' + _this.countryCode);
                    if (data.phone_country_code) {
                        _this.form.find('.country').val(data.phone_country_code);
                        _this.form.find('.bfh-selectbox-option').html('');
                        _this.form.find('.bfh-selectbox-option').html('<i class="glyphicon bfh-flag-' + data.phone_country_code + '"></i>' + BFHCountriesList[data.phone_country_code]);
                    }
                    _this.form.find('.business-location-type[data-type="' + data.type + '"]').addClass('active');
                    $.map(data.amenities_string.split(','), function (item) {
                        _this.form.find('.amenities[data-id="' + item + '"]').addClass('active');
                    });

                    if (data.assign_departments) {
                        _this.departmentItem(data.assign_departments, type);
                    }

                    if (data.assign_jobs) {
                        _this.jobAssignItem(data.assign_jobs, type);
                    }

                    if (data.assign_managers) {
                        _this.managerItem(data.assign_managers, false, type);
                    }

                    if (data.picture_filename) {
                        $('.business-pic-view img').attr('src',data.picture);
                        $('.business-pic-view input[name="logo"]').val(data.picture_filename);
                        $('.business-pic-view input[name="logo"]').attr('data-logo',1);
                        new CropAvatar('business-pic-view', 'business-pic-change-btn', false, false, false, false, data.picture_o, 'location_edit');
                    } else {
                        setTimeout(function () {
                            var picture = $('#location-select-brand option[value=' + data.business_id + ']').data('picture');
                            var picture_o = $('#location-select-brand option[value=' + data.business_id + ']').data('picture_o');
                            var picture_filename = $('#location-select-brand option[value=' + data.business_id + ']').data('picture_filename');

                            $('.business-pic-view img').attr('src', picture);
                            $('.business-pic-view input[name="logo"]').val(picture_filename);
                            new CropAvatar('business-pic-view', 'business-pic-change-btn', false, false, false, false, picture_o, 'location_edit');
                        }, 1000);
                    }

                } else {
                    window.location.href = '/business/branch/locations';
                }
            }).request();
        } else {
            window.location.href = '/business/branch/locations';
        }
    },
    //get all locations by business ID
    /*getItems: function (keywords, show) {
        var _this = this;
        var params = {
            "business_id": this.businessID,
            "user_id": user.data.id
        };
        if (!this.isClearLocations) {
            params["business_id"] = this.businessIDforLocation;
        }
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
            $('#business-location-search').val(keywords);
        }
        var locationListElement = $('.business-location-list');
        params['no_brands'] = 1;
        new GraphQL("query", "businessLocations", params, [
            'items {' +
                'id html' +
                ' assign_managers {' +
                    'id first_name last_name user_picture_50(width: 50, height: 50) role manager_type created_date' +
                '}',
                ' assign_jobs {' +
                    'id title localized_title job_status' +
                '}',
            '}',
            'brands {'+
                'id name count_locations pages_locations' +
                ' locations { id html }' +
            '}',
            'pages',
            'business_id',
            'count',
            'current_page'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            if (_this.isClearLocations) {
                locationListElement.html('');
            } else {
                _this.elemUploadLocations.children().remove();
            }
            var html = '<div class="block_locations_business">';
            if (data.items) {
                $.map(data.items, function (item) {

                    html += item.html;
                    _this.assigmentData[item.id] = item.assign_managers;
                    _this.loadLocationsData[item.id] = 0;

                    _this.assigmentJobData[item.id] = item.assign_jobs;
                    _this.loadJobData[item.id] = 0;
                });
            }

            html += _this.pagination(data.business_id,data.count) + '</div>';

            if (_this.isClearLocations) {
                locationListElement.append(html);
            } else {
                _this.elemUploadLocations.append(html);
            }
            if (data.brands && _this.isClearLocations) {
                $.map(data.brands, function (brand) {
                    if (brand.locations.length > 0) {
                        html = '<p class="pl-3 h5 mt-3">' + brand.name + '</p><div class="block_locations_business">';
                        $.map(brand.locations, function (item) {
                            html += item.html;
                            _this.assigmentData[item.id] = item.assign_managers;
                            _this.loadLocationsData[item.id] = 0;

                            _this.assigmentJobData[item.id] = item.assign_jobs;
                            _this.loadJobData[item.id] = 0;
                        });

                        html += _this.pagination(brand.id, brand.count_locations) + '</div>';
                        locationListElement.append(html);
                    }
                });
            }
            _this.countPages = data.pages;
            //_this.pagination(data.pages);
        }).request((notShowLoader) ? locationListElement : false);
    },*/
    getItems: function (keywords, show) {
        var _this = this;
        var params = {
            "business_id": this.businessID,
        };
        if (!this.isClearLocations) {
            params["business_id"] = this.businessIDforLocation;
            if (this.businessIDforLocation == this.businessID) {
                params['no_brands'] = 1;
            }
        }
        if (this.sort) {
            params['sort'] = this.sort;
        }
        if (this.order) {
            params['order'] = this.order;
        }
        if (this.perPage) {
            params['limit'] = this.perPage;
        }
        if (this.currentPage) {
            params['page'] = this.currentPage;
        }
        //params['limit'] = this.perPage;
        //params['page'] = this.currentPage;
        params['page_location'] = this.currentPageBusiness;

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
            $('#business-location-search').val(keywords);
        }
        var locale = APIStorage.read('language');
        if (locale != 'en') {
            params['locale'] = locale;
        }
        var locationListElement = $('.business-location-list');
        new GraphQL("query", "businessLocationsBrands", params, [
            'items { '+
                'id name count_locations pages_locations locations { ' +
                    'id html assign_managers { ' +
                        'id first_name last_name user_picture_50(width: 50, height: 50) role manager_type created_date' +
                    ' } ' +
                    'assign_jobs { ' +
                        'id title localized_title job_status' +
                    ' } ' +
                ' } ' +
            ' }',
            'pages',
            'count',
            'current_page'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            var html = '';
            if (data.count) {
                $.map(data.items, function (business) {
                    if (business.locations.length > 0) {
                        html += '<div class="block_locations_business"><p class="pl-3 h5 mt-3">' + business.name + '</p>';
                        $.map(business.locations, function (location) {
                            html += location.html;
                            _this.assigmentData[location.id] = location.assign_managers;
                            _this.loadLocationsData[location.id] = 0;

                            _this.assigmentJobData[location.id] = location.assign_jobs;
                            _this.loadJobData[location.id] = 0;
                        });

                        html += _this.pagination(business.id, business.pages_locations, _this.currentPageBusiness) + '</div>';
                    }
                });
            }
            if (_this.isClearLocations) {
                locationListElement.html(html);
            } else {
                //_this.elemUploadLocations.children().remove();
                _this.elemUploadLocations.html(html);
            }
            if (data.pages > 1 && _this.isClearLocations) {
                $('#pagination_business_for_locations').html(_this.pagination(_this.businessID, data.pages, _this.currentPage));
            }
        }).request((notShowLoader) ? locationListElement : false);
    },
    pagination: function (businessId, countPages, currentPage) {
        var _this = this;
        //var countPages = Math.ceil(countLocations / perPage);
        var html = '';
        if (countPages > 1) {
            html = '<div class="mx-auto mt-2"><nav aria-label="Page navigation example"><ul class="pagination pagination-content">';
            var active = '';
            var inactive = '';
            if (currentPage == 1) {
                active = 'active';
                inactive = 'inactive';
            }
            html += '<li class="page-item ' + inactive + '" data-business_id="' + businessId + '" data-page="' + (currentPage-1) + '"><a class="page-link" href="javascript:;">' + trans('previous') + '</a></li>'
                    + '<li class="page-item ' + active + '" data-business_id="' + businessId + '" data-page="' + 1 + '"><a class="page-link" href="javascript:;">1</a></li>';
            if (countPages < 8 ) {
                for (var i = 2; i < countPages; i++) {
                    active = '';
                    if (currentPage === i) {
                        active = 'active';
                    }
                    html += '<li class="page-item ' + active + '" data-business_id="' + businessId + '" data-page="' + i + '"><a class="page-link" href="javascript:;">' + i + '</a></li>';
                }
            } else {
                if (currentPage > 4) {
                    html += '<li class="page-item inactive"><a class="page-link" href="javascript:;">...</a></li>';
                    if (currentPage > countPages -4) {
                        for (var i = countPages -4; i < countPages; i++) {
                            active = '';
                            if (currentPage === i) {
                                active = 'active';
                            }
                            html += '<li class="page-item ' + active + '" data-business_id="' + businessId + '" data-page="' + i + '"><a class="page-link" href="javascript:;">' + i + '</a></li>';
                        }
                    } else {
                        html += '<li class="page-item" data-business_id="' + businessId + '" data-page="' + (currentPage-1) + '"><a class="page-link" href="javascript:;">' + (currentPage-1) + '</a></li>'
                            + '<li class="page-item active" data-business_id="' + businessId + '" data-page="' + currentPage + '"><a class="page-link" href="javascript:;">' + currentPage + '</a></li>'
                            + '<li class="page-item" data-business_id="' + businessId + '" data-page="' + (currentPage+1) + '"><a class="page-link" href="javascript:;">' + (currentPage+1) + '</a></li>'
                            + '<li class="page-item inactive"><a class="page-link" href="javascript:;">...</a></li>';
                    }
                } else {
                    for (var i = 2; i < 6; i++) {
                        active = '';
                        if (currentPage === i) {
                            active = 'active';
                        }
                        html += '<li class="page-item ' + active + '" data-business_id="' + businessId + '" data-page="' + i + '"><a class="page-link" href="javascript:;">' + i + '</a></li>';
                    }
                    html += '<li class="page-item inactive"><a class="page-link" href="javascript:;">...</a></li>';
                }
            }

            active = '';
            inactive = '';
            if (currentPage == countPages) {
                active = 'active';
                inactive = 'inactive';
            }
            html += '<li class="page-item ' + active + '" data-business_id="' + businessId + '" data-page="' + countPages + '"><a class="page-link" href="javascript:;">' + countPages + '</a></li>'
                    + '<li class="page-item ' + inactive + '" data-business_id="' + businessId + '" data-page="' + (currentPage+1) + '"><a class="page-link" href="javascript:;">' + trans('next') + '</a></li>';
            html += '</ul></nav></div>';
        }

        return html;
    },
    /*pagination: function (pages) {
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
    },*/
    paginationUnAssignItems: function (pages, type) {
        var _this = this;
        var html = '';
        var currentPage = _this.currentPageDepartment;
        switch (type) {
            case 'manager':
                currentPage = _this.currentPageManager;
                break;
            case 'job':
                currentPage = _this.currentPageJob;
                break;
        }
        if (pages > 1) {
            html = '<li class="page-item"><a class="page-link page-unassign-prev" href="javascript:void(0)"><</a></li>';
            for (var i = 1; i <= pages; i++) {
                var active = '';
                if (currentPage === i) {
                    active = 'active';
                }
                html += '<li class="page-item ' + active + '"><a class="page-link unassign-page" href="javascript:void(0)">' + i + '</a></li>';
            }
            html += '<li class="page-item"><a class="page-link page-unassign-next" href="javascript:void(0)">></a></li>';
        }
        $('.pagination-' + type + '-unassign').html(html);
    }
};

$(document).ready(function () {
    // setTimeout(function () {
    loadPromise.then(function () {
        var businessLocation = new BusinessLocation();
        businessLocation.init();

        var url = document.location.pathname;
        var method = explode("branch", url);
        switch (method[1]) {
            case '/add':
                app.scripts(businessLocation, 'create');
                // app.scripts(businessLocation.create());
                break;
            case '/edit':
                app.scripts(businessLocation, 'getItem');
                // app.scripts(businessLocation.getItem());
                break;
            case '/clone':
                app.scripts(businessLocation, 'clone');
                // app.scripts(businessLocation.clone());
                break;
            default:
                //app.scripts(businessLocation, 'getItems');
                // app.scripts(businessLocation.getItems(undefined, true));
                break;
        }
        // app.run();
    }).then(function () {
        app.runPromise();
    });
    // }, 2000);
});
