function BusinessItems(type) {
    //set type page
    this.type = type;
    this.role = type;
    if (this.type == 'franchisee') {
        this.type = 'manager'
    }
    this.typeClass = capitalizeFirstLetter(this.type);
    //current item ID
    this.currentID;
    this.currentUserID;
    //current business ID
    this.businessID = APIStorage.read('business-id');
    //create or update item form
    this.form = $('#business-' + this.type + '-form');
    //name query for create
    this.query = "create" + this.typeClass;
    //name query for update
    this.queryUpdate = "update" + this.typeClass;
    this.queryUpdateLocation = "update" + this.typeClass + 'Location';
    //name query for delete
    this.queryDelete = "delete" + this.typeClass;
    //name query for setAdmin
    this.querySetAdmin = "setAdmin" + this.typeClass;
    //name query for get item
    this.queryItem = "business" + this.typeClass;
    //name query for get all items
    this.queryItems = "business" + this.typeClass + "s";
    if (this.typeClass == 'Job') {
        this.queryItems += 'Locations';
    }
    //element with sort list params
    this.sortElement = $('#business-' + this.type + '-sort');
    this.limitElement = $('#business-' + this.type + '-limit');
    //one time load location
    this.loadLocations = 0;

    //sort params
    this.sort;
    //order params
    this.order;
    this.perPage = 0; // = 5;
    this.perPageBusiness = 10;
    this.currentPage = 0; // = 1;
    this.currentPageBusiness = 1;
    this.countPages = 1;
    this.perPageElement = $('.perpage');
    //set param for empty items search
    this.search = 0;
    //set param for empty location items search
    this.searchLocation = 0;
    //default status for clone event
    this.cloneQuery = false;
    //default URL for redirect
    this.redirectURL = '';

    this.msDepartments;
    this.msDepartmentsElement = $('#department');
    // this.msJobTypes;
    // this.msJobTypesElement = $('#job_type');
    // this.msCareerLevel;
    // this.msCareerLevelData = null;
    // this.msCareerLevelElement = $('#career_level');
    this.msLanguages;
    this.msLanguagesElement = $('#language_level');
    this.msCertificates;
    this.msCertificatesData = null;
    this.msCertificatesElement = $('#certification_required');
    // this.msKeywords;
    // this.msKeywordsFr;
    // this.msKeywordsElement = $('#keywords');
    // this.msKeywordsFrElement = $('#keywords-fr');
    this.msJobCategory;
    this.msJobCategoryElement = $('#job_categories');
    this.msJobSubCategory;
    this.msJobSubCategoryElement = $('#job_subcategories');
    this.msJobSubCategoryFrElement = $('#job_subcategories-fr');

    this.assigmentData = {};
    this.allLocationsList = {};
    this.assigmentJobs = {};
    this.loadLocationsData = {};

    this.loadFilters = 0;

    this.isClearLocations = true;
    this.elemUploadLocations = null;
    this.businessIDforLocation = 0;

    this.urlMethod = 'add';
}

BusinessItems.prototype = {
    init: function () {
        //init ajax loader
        Loader.init();

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
        $('[data-toggle="tooltip"]').tooltip();
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
        //set current ID for delete
        body.on('click', '.business-' + this.type + '-delete', function () {
            _this.currentID = $(this).attr('data-id');
            if (_this.type === 'job') {
                $('#deleteModal .modal-body').find('span').text(_this.form.find('.business-job-status-assign[data-id="' + _this.currentID + '"] span').text());
            }
        });
        body.on('click', '#business-' + this.type + '-location-set', function () {
            _this.setLocations();
        });
        //set current ID for assign modal
        body.on('click', '.business-' + this.type + '-assign', function () {
            _this.currentID = $(this).attr('data-id');
            if (_this.assigmentData[_this.currentID]) {
                _this.locationItem(_this.assigmentData[_this.currentID]);
            }
            if (_this.loadLocationsData[_this.currentID] === 0) {
                _this.getLocations();
                _this.loadLocationsData[_this.currentID] = 1;
            }
        });
        //set current ID for assign modal
        body.on('click', '.business-job-status-assign', function () {
            _this.currentID = $(this).attr('data-id');
            if (_this.assigmentData[_this.currentID]) {
                _this.jobItem(_this.assigmentData[_this.currentID]);
            }
        });
        body.on('click', '.business-manager__set-admin', function () {
            _this.currentUserID = $(this).data('id');
        });
        //confirm item delete
        $('#business-' + this.type + '-confirm-delete').on('click', function () {
            _this.delete();
        });
        //confirm item setAdmin
        $('#business-' + this.type + '__confirm__set-admin').on('click', function () {
            _this.setAdmin();
        });
        //search items by current type
        var timeout = null;
        $('#business-' + this.type + '-search').on('keyup', function (e) {
            if (e.which <= 90 && e.which >= 48 || e.which === 13 || e.which === 8) {
                var keywords = $(this).val().trim();
                _this.currentPage = 1;
                updateQueryStringParam('page', 1);
                updateQueryStringParam('search', keywords);
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    _this.getItems(keywords);
                }, 500);
            }
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

        body.on('click', '#filters-modal', function () {
            if (_this.loadFilters === 0) {
                switch (_this.type) {
                    case 'job':
                    case 'department':
                        _this.msFields(true);
                        break;
                }
                _this.loadFilters = 1;
            }
        });
        this.form.on('click', '#set-filters', function () {
            _this.setFilters();
        });
        this.form.on('click', '#clear-filters', function () {
            // _this.msCareerLevel.setSelection([]);
            _this.msDepartments.setSelection([]);
            _this.msCertificates.setSelection([]);
            _this.msLanguages.setSelection([]);
            // _this.msJobTypes.setSelection([]);
            $('#jobfiltermodal').find('input').val('');
            _this.setFilters();
        });

        switch (this.type) {
            case 'job':
                this.redirectURL = '/business/job/manage';

                var jobStatus;
                var cancelStatus = 0;

                body.on('click', '.job-status-change', function () {

                    _this.currentID = $(this).attr('data-id');
                    jobStatus = ($(this).prop('checked')) ? 1 : 0;
                    //$('#changeStatusModal').modal('show');
                    if (jobStatus === 1) {
                        $('.job-status-change[data-id="' + _this.currentID + '"]').prop('checked', true);
                    } else {
                        $('.job-status-change[data-id="' + _this.currentID + '"]').prop('checked', false);
                    }

                    $('.business-job-status-assign[data-id="' + _this.currentID + '"]').click();
                    if (_this.assigmentData[_this.currentID]) {

                        _this.jobItem(_this.assigmentData[_this.currentID]);
                        $('#OpenClosedModal').modal('show');
                    }
                });

                body.on('click', '#business-job-cancel-change', function () {
                    cancelStatus = 1;
                    $('#changeStatusModal').modal('hide');
                });
                $('#changeStatusModal').on('hidden.bs.modal', function () {
                    if (cancelStatus === 1) {
                        if (jobStatus === 1) {
                            $('.job-status-change[data-id="' + _this.currentID + '"]').prop('checked', false);
                        } else {
                            $('.job-status-change[data-id="' + _this.currentID + '"]').prop('checked', true);
                        }
                        $('.business-job-status-assign[data-id="' + _this.currentID + '"]').click();
                    }
                });
                body.on('click', '#business-job-confirm-change', function () {
                    cancelStatus = 0;
                    new GraphQL("mutation", "updateJobStatus", {
                        "business_id": _this.businessID,
                        "id": _this.currentID,
                        "status": jobStatus
                    }, ['id', 'token', ' assign_locations {' +
                    'id name street street_number city region country created_date job_status' +
                    '}'], true, false, function () {
                        Loader.stop();
                    }, function (data) {
                        _this.assigmentData[_this.currentID] = data.assign_locations;
                        _this.loadLocationsData[_this.currentID] = 0;
                        _this.counterRefresh();
                        $('#changeStatusModal').modal('hide');
                    }).request();
                });
                break;
            case 'manager':
                this.redirectURL = '/business/manage/manager';

                body.on('click', '.business-manager-type', function () {
                    $('input[name="jobs"]').prop('checked', true);
                    $('input[name="jobs"]').closest('.col-md-12').show();
                    $('input[name="locations"]').prop('checked', true);
                    $('input[name="locations"]').closest('.col-md-12').show();
                    $('input[name="departments"]').prop('checked', true);
                    $('input[name="departments"]').closest('.col-md-12').show();
                    /*$('input[name="share"]').prop('checked', true);
                    $('input[name="share"]').closest('.col-md-12').show();
                    $('input[name="contact_employees"]').prop('checked', true);
                    $('input[name="contact_employees"]').closest('.col-md-12').show();*/
                    var type = $(this).attr('data-type');
                    if (type === 'manager') {
                        $('input[name="demote_promote"]').prop('checked', false);
                        $('input[name="demote_promote"]').closest('.col-md-12').hide();
                        $('input[name="add_new_seat"]').prop('checked', false);
                        $('input[name="add_new_seat"]').closest('.col-md-12').hide();
                        $('input[name="managers"]').prop('checked', false);
                        $('input[name="managers"]').closest('.col-md-12').hide();
                        $('input[name="business"]').prop('checked', false);
                        $('input[name="business"]').closest('.col-md-12').hide();
                        $('input[name="contact_candidates"]').prop('checked', false);
                        $('input[name="contact_candidates"]').closest('.col-md-12').hide();
                        $('input[name="view_candidates"]').prop('checked', false);
                        $('input[name="view_candidates"]').closest('.col-md-12').hide();
                        $('input[name="view_candidates_own"]').prop('checked', false);
                        $('input[name="view_candidates_own"]').closest('.col-md-12').hide();
                        $('input[name="candidates"]').prop('checked', false);
                        $('input[name="candidates"]').closest('.col-md-12').hide();
                        $('input[name="candidates_own"]').prop('checked', false);
                        $('input[name="candidates_own"]').closest('.col-md-12').hide();
                    } else {
                        $('input[name="demote_promote"]').prop('checked', false);
                        $('input[name="demote_promote"]').closest('.col-md-12').show();
                        $('input[name="add_new_seat"]').prop('checked', false);
                        $('input[name="add_new_seat"]').closest('.col-md-12').show();
                        $('input[name="managers"]').prop('checked', true);
                        $('input[name="managers"]').closest('.col-md-12').show();
                        $('input[name="business"]').prop('checked', true);
                        $('input[name="business"]').closest('.col-md-12').show();
                        $('input[name="contact_candidates"]').prop('checked', true);
                        $('input[name="contact_candidates"]').closest('.col-md-12').show();
                        $('input[name="view_candidates"]').prop('checked', true);
                        $('input[name="view_candidates"]').closest('.col-md-12').show();
                        $('input[name="view_candidates_own"]').prop('checked', false);
                        $('input[name="view_candidates_own"]').closest('.col-md-12').show();
                        $('input[name="candidates"]').prop('checked', true);
                        $('input[name="candidates"]').closest('.col-md-12').show();
                        $('input[name="candidates_own"]').prop('checked', false);
                        $('input[name="candidates_own"]').closest('.col-md-12').show();
                    }
                });

                body.on('change', '.switch input', function () {
                    let name_checkbox = $(this).attr('name');
                    let checkbox_dependent = false;
                    switch (name_checkbox) {
                        case 'view_candidates':
                            checkbox_dependent = $('input[name="view_candidates_own"]');
                            break;
                        case 'view_candidates_own':
                            checkbox_dependent = $('input[name="view_candidates"]');
                            break;
                        case 'candidates':
                            checkbox_dependent = $('input[name="candidates_own"]');
                            break;
                        case 'candidates_own':
                            checkbox_dependent = $('input[name="candidates"]');
                            break;
                    }
                    if (checkbox_dependent) {
                        if ($(this).is(':checked')) {
                            checkbox_dependent.prop('checked', false);
                        } else {
                            checkbox_dependent.prop('checked', true);
                        }
                    }
                });
                break;
            case 'department':
                this.redirectURL = '/business/manage/department/list';
                break;
        }

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
                //updateQueryStringParam('search', keywords);
                //updateQueryStringParam('page', 1);
                _this.currentPage = 1;
                _this.currentPageBusiness = 1;
                clearTimeout(timeout);
                _this.elemUploadLocations = null;
                _this.isClearLocations = true;
                timeout = setTimeout(function () {
                    _this.getLocations(keywords);
                }, 500);
            }
        });
        /*var timeout1 = null;
        //search all unsiggned locations
        this.form.find('#department-location-search').on('keyup', function (e) {
            if (e.which <= 90 && e.which >= 48 || e.which === 13 || e.which === 8) {
                var keywords = $(this).val();
                _this.currentPage = 1;
                clearTimeout(timeout1);
                timeout1 = setTimeout(function () {
                    _this.getLocations(keywords.trim());
                }, 500);
            }
        });

        this.form.on('click', '.page-link.unassign-page', function () {
            _this.currentPage = +$(this).text();
            var keywords = $('#department-location-search').val().trim();
            _this.getLocations((keywords.length <= 1) ? undefined : keywords);
        });
        this.form.on('click', '.page-unassign-prev', function () {
            if (_this.currentPage > 1) {
                _this.currentPage -= 1;
                var keywords = $('#department-location-search').val().trim();
                _this.getLocations((keywords.length <= 1) ? undefined : keywords);
            }
        });
        this.form.on('click', '.page-unassign-next', function () {
            if (_this.currentPage < _this.countPages) {
                _this.currentPage += 1;
                var keywords = $('#department-location-search').val().trim();
                _this.getLocations((keywords.length <= 1) ? undefined : keywords);
            }
        });*/

        var timeout1 = null;
        //search all unsiggned locations
        this.form.find('#job-apply-location-search').on('keyup', function (e) {
            if (e.which <= 90 && e.which >= 48 || e.which === 13 || e.which === 8) {
                var keywords = $(this).val();
                _this.currentPage = 1;
                clearTimeout(timeout1);
                timeout1 = setTimeout(function () {
                    _this.getLocations(keywords.trim());
                }, 500);
            }
        });

        this.form.on('click', '.page-link.unassign-page', function () {
            _this.currentPage = +$(this).text();
            var keywords = $('#job-apply-location-search').val().trim();
            _this.getLocations((keywords.length <= 1) ? undefined : keywords);
        });
        this.form.on('click', '.page-unassign-prev', function () {
            if (_this.currentPage > 1) {
                _this.currentPage -= 1;
                var keywords = $('#job-apply-location-search').val().trim();
                _this.getLocations((keywords.length <= 1) ? undefined : keywords);
            }
        });
        this.form.on('click', '.page-unassign-next', function () {
            if (_this.currentPage < _this.countPages) {
                _this.currentPage += 1;
                var keywords = $('#job-apply-location-search').val().trim();
                _this.getLocations((keywords.length <= 1) ? undefined : keywords);
            }
        });
        //---------------------------------------------------------------------------------job share

        body.on('click', '[data-target="#customShareModal"]', function () {
            _this.currentID = $(this).attr('data-id');
            if (_this.assigmentData[_this.currentID]) {
                _this.jobItemShare(_this.assigmentData[_this.currentID]);
            }
        });
        body.on('click', '#business-job-confirm-share', function () {
            let linkShare = getBaseURLFotMap() + '/map/view/job-union/' + _this.currentID;
            $('#share-link').val(linkShare);
            $('#ShareModal').modal('show');
        });
        body.on('click', '#business-job-cancel-share', function () {
            if (_this.assigmentData[_this.currentID]) {
                _this.jobItemShare(_this.assigmentData[_this.currentID]);
            }
            $('#customShareModal').modal('show');
        });
        body.on('click', '.custom-share-job',function () {
            let linkShare = getBaseURLFotMap() + '/map/view/job/' + $(this).attr('data-id');
            $('#customShareModal').modal('hide');
            $('#share-link').val(linkShare);
            $('#ShareModal').modal('show');
        });
        body.on('click', '#share-all',function () {
            let linkShare = getBaseURLFotMap() + '/map/view/job-union/' + _this.currentID;
            $('#customShareModal').modal('hide');
            $('#share-link').val(linkShare);
            $('#ShareModal').modal('show');
        });

        $('#shareFacebook').click(function () {
            let ogUrl = $('#share-link').val(),
                ogTitle = _this.assigmentJobs[_this.currentID].title,
                ogDescription = _this.assigmentJobs[_this.currentID].description,
                ogImage = business.currentData.picture_o;
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
        });

        $('#shareGoogle').click(function () {
            let ogUrl = $('#share-link').val(),
                ogTitle = _this.assigmentJobs[_this.currentID].title;
            window.open("https://plus.google.com/share?url=" + ogUrl + "&text=" + ogTitle, 'sharer', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=600');return false;
        });

        $('#shareTwitter').click(function () {
            let ogUrl = $('#share-link').val(),
                ogTitle = _this.assigmentJobs[_this.currentID].title;
            window.open("https://twitter.com/share?url=" + ogUrl + "&text=" + ogTitle, 'sharer', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=600');return false;
        });

        $('#shareLinkedin').click(function () {
            let ogUrl = $('#share-link').val(),
                ogTitle = _this.assigmentJobs[_this.currentID].title;
            window.open("https://www.linkedin.com/sharing/share-offsite/?url=" + ogUrl, 'sharer', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=600');return false;
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

        var clipboard = new Clipboard('#clipboard-button');
        clipboard.on('success', function (e) {
            $.notify(trans('copied'), 'success');
            e.clearSelection();
        });

        $('#OpenClosedModal').on('shown.bs.modal', function () {
            _this.counterRefresh();
        });
        $('#OpenClosedModal').on('hidden.bs.modal', function () {
            _this.counterRefresh();
        });


        //---check edit or create
        var ch_url = document.location.pathname;
        var ch_pages = ['job', 'manager', 'department'];
        for (var i = 0; i < ch_pages.length; i++) {
            page = ch_pages[i];
            var m = explode(page, ch_url);
            if (typeof m[1] !== 'undefined') {
                _this.urlMethod = m[1].substr(1);
                break;
            }
        }

        body.on('click', '.block_locations_business .page-item:not(.inactive):not(.active)', function () {
            var businessId = parseInt($(this).attr('data-business_id'));
            if (_this.urlMethod == 'edit' || (_this.currentID  && !_this.cloneQuery)) {
                _this.saveAssignLocation();
            } else {
                _this.save(1);
            }
            _this.businessIDforLocation = businessId;
            var page = parseInt($(this).attr('data-page'));
            _this.currentPageBusiness = page;
            _this.isClearLocations = false;
            _this.elemUploadLocations = $(this).closest('.block_locations_business');
            //_this.getLocations();
        });

        body.on('click', '#pagination_business_for_locations .page-item:not(.inactive):not(.active)', function () {
            var page = parseInt($(this).attr('data-page'));
            if (_this.urlMethod == 'edit' || _this.currentID) {
                _this.saveAssignLocation();
            } else {
                _this.save(1);
            }
            _this.currentPage = page;
            //updateQueryStringParam('page', page);
            _this.currentPageBusiness = 1;
            _this.isClearLocations = true;
            _this.elemUploadLocations = null;
            _this.getLocations();
        });

        this.form.find('.assign-panel .assign-all').attr('data-business_id',_this.businessID);
        this.form.find('.assign-panel').on('click', '.assign-all', function () {
            if (_this.urlMethod == 'edit' || (_this.currentID  && !_this.cloneQuery)) {
                var businessId = $(this).attr('data-business_id');
                _this.saveAssignLocation(1,businessId);
            } else {
                _this.save(1,1);
            }
            _this.form.find('.location-item').prop('checked', true);
        });
        this.form.find('.assign-panel .unassign-all').attr('data-business_id',_this.businessID);
        this.form.find('.assign-panel').on('click', '.unassign-all', function () {
            if (_this.urlMethod == 'edit' || (_this.currentID  && !_this.cloneQuery)) {
                var businessId = $(this).attr('data-business_id');
                _this.saveAssignLocation(2,businessId);
            } else {
                //_this.save(1,2);
            }
            _this.form.find('.location-item').prop('checked', false);
        });

        this.form.find('.assign-panel').on('click', '.business_assign-all', function () {
            if (_this.urlMethod == 'edit' || (_this.currentID  && !_this.cloneQuery)) {
                var businessId = $(this).attr('data-business_id');
                _this.saveAssignLocation(3,businessId);
            } else {
                _this.save(1,3);
            }
            $(this).closest('.block_locations_business').find('.location-item').prop('checked', true);
        });
        this.form.find('.assign-panel').on('click', '.business_unassign-all', function () {
            if (_this.urlMethod == 'edit' || (_this.currentID  && !_this.cloneQuery)) {
                var businessId = $(this).attr('data-business_id');
                _this.saveAssignLocation(4,businessId);
            } else {
                //_this.save(1,4);
            }
            $(this).closest('.block_locations_business').find('.location-item').prop('checked', false);
        });


    },

    setFilters: function () {
        // var careers = $.map(this.msCareerLevel.getSelection(), function (item) {
        //     return item.id;
        // }).join(',');
        // var types = $.map(this.msJobTypes.getSelection(), function (item) {
        //     return item.id;
        // }).join(',');
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
        // if (careers.length !== 0) {
        //     filters += 'careers:' + careers + ';';
        // }
        // if (types.length !== 0) {
        //     filters += 'types:' + types + ';';
        // }
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
            this.getItems();
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
        // var careers;
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
                        // case 'careers':
                        //     careers = info;
                        //     break;
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
        new GraphQL("query", "businessDepartments", params, [
            'items{id name name_fr}',
            'default {id name name_fr}',
        ], false, false, function (data) {
            //show error
        }, function (data) {
            if (data.items) {
                _this.msDepartments = _this.msDepartmentsElement.magicSuggest({
                    placeholder: trans('choose_departments'),
                    toggleOnClick: true,
                    allowFreeEntries: false,
                    data: data.items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                    cls: 'jack input_style'
                });
            }
            if (data.default) {
                _this.msDepartments.setSelection(data.default);
            }
        }).request(_this.msDepartmentsElement);

        // this.getMSList(function (items, defaultData) {
        //     _this.msJobTypes = _this.msJobTypesElement.magicSuggest({
        //         placeholder: trans('type_job_type'),
        //         toggleOnClick: true,
        //         allowFreeEntries: false,
        //         data: items,
        //         hideTrigger: true,
        //         noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
        //         cls: 'jack input_style'
        //     });
        //     if (defaultData) {
        //         _this.msJobTypes.setSelection(defaultData);
        //     }
        //     var timeout = null;
        //     $(_this.msJobTypes).on('keyup', function () {
        //         clearTimeout(timeout);
        //         timeout = setTimeout(function () {
        //             _this.getMSList(function (items) {
        //                 _this.msJobTypes.setData(items);
        //             }, 'jobTypes', _this.msJobTypesElement, _this.msJobTypes.getRawValue());
        //         }, 500);
        //     });
        // }, 'jobTypes', _this.msJobTypesElement, undefined, types);

        // this.getMSList(function (items, defaultData) {
        //     _this.msCareerLevel = _this.msCareerLevelElement.magicSuggest({
        //         placeholder: trans('type_career_level'),
        //         toggleOnClick: true,
        //         //allowFreeEntries: (filters) ? false : true,
        //         allowFreeEntries: false,
        //         data: items,
        //         hideTrigger: true,
        //         //noSuggestionText: (filters) ? '<strong>{{query}}</strong> ' + trans('not_found') : '<strong>{{query}}</strong> ' + trans('not_found_add'),
        //         noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
        //         cls: 'jack input_style'
        //     });

        //     if (defaultData) {
        //         _this.msCareerLevel.setSelection(defaultData);
        //     } else if (_this.msCareerLevelData) {
        //         _this.msCareerLevel.setSelection(_this.msCareerLevelData);
        //         _this.msCareerLevelData = null;
        //     }

        //     var timeout = null;
        //     $(_this.msCareerLevel).on('keyup', function () {
        //         clearTimeout(timeout);
        //         timeout = setTimeout(function () {
        //             _this.getMSList(function (items) {
        //                 _this.msCareerLevel.setData(items);
        //             }, 'careerLevels', _this.msCareerLevelElement, _this.msCareerLevel.getRawValue());
        //         }, 500);
        //     });
        // }, 'careerLevels', _this.msCareerLevelElement, undefined, careers);

        this.getMSList(function (items, defaultData) {
            _this.msLanguages = _this.msLanguagesElement.magicSuggest({
                placeholder: trans('ex_languages'),
                toggleOnClick: true,
                //allowFreeEntries: (filters) ? false : true,
                allowFreeEntries: false,
                data: items,
                hideTrigger: true,
                //noSuggestionText: (filters) ? '<strong>{{query}}</strong> ' + trans('not_found') : '<strong>{{query}}</strong> ' + trans('not_found_add'),
                noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                cls: 'jack input_style'
            });
            if (defaultData) {
                _this.msLanguages.setSelection(defaultData);
            }
            var timeout = null;
            $(_this.msLanguages).on('keydown focus', function () {
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    _this.getMSList(function (items) {
                        _this.msLanguages.setData(items);
                    }, 'worldLanguages', _this.msLanguagesElement, _this.msLanguages.getRawValue());
                }, 0);
            });
        }, 'worldLanguages', _this.msLanguagesElement, undefined, languages);

        this.getMSList(function (items, defaultData) {
            _this.msCertificates = _this.msCertificatesElement.magicSuggest({
                placeholder: trans('type_certificate'),
                toggleOnClick: true,
                //allowFreeEntries: (filters) ? false : true,
                allowFreeEntries: true,
                data: items,
                hideTrigger: true,
                //noSuggestionText: (filters) ? '<strong>{{query}}</strong> ' + trans('not_found') : '<strong>{{query}}</strong> ' + trans('not_found_add'),
                noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                cls: 'jack input_style'
            });

            if (defaultData) {
                _this.msCertificates.setSelection(defaultData);
            } else if (_this.msCertificatesData) {
                _this.msCertificates.setSelection(_this.msCertificatesData);
                _this.msCertificatesData = null;
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

        /*[ 'en', 'fr' ].forEach(function(current_language_prefix) {
            var msKeywordsName = 'msKeywords';
            var msKeywordsElementName = 'msKeywords';

            if (current_language_prefix != 'en') {
                msKeywordsName += (current_language_prefix[0].toUpperCase() + current_language_prefix.slice(1));
                msKeywordsElementName += (current_language_prefix[0].toUpperCase() + current_language_prefix.slice(1));
            }

            msKeywordsElementName += 'Element';

            _this.getMSList(function(items, defaultData) {
                _this[msKeywordsName] = _this[msKeywordsElementName].magicSuggest({
                    placeholder: trans('type_keywords'),
                    toggleOnClick: false,
                    allowFreeEntries: true,
                    data: [],
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found_add'),

                    cls: (function() {
                        var classes = (_this[msKeywordsElementName].attr('class') || '').split(/\s+/);
                        classes = classes.concat('jack input_style');
                        return classes.join(' ');
                    })(),
                });

                if (defaultData) {
                    _this[msKeywordsName].setSelection(defaultData);
                }

                var timeout = null;

                $(_this[msKeywordsName]).on('keyup', function () {
                    clearTimeout(timeout);

                    timeout = setTimeout(function () {
                        _this.getMSList(function(items) {
                            _this[msKeywordsName].setData(items);
                        }, 'keywords', _this[msKeywordsElementName], _this[msKeywordsName].getRawValue());
                    }, 500);
                });

                console.log('>>>>>AAA', _this[msKeywordsName]);
            }, 'keywords', _this[msKeywordsElementName], undefined, undefined);
        });*/

        this.getMSList(function (items, defaultData) {
            _this.msJobCategory = _this.msJobCategoryElement.magicSuggest({
                placeholder: trans('type_category_name'),
                maxSelection: 1,
                maxSelectionRenderer: function () {
                    return trans('jack_max_1');
                },
                toggleOnClick: false,
                allowFreeEntries: false,
                data: [],
                hideTrigger: true,
                noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),
                cls: 'jack input_style'
            });

            if (defaultData) {
                _this.msJobCategory.setSelection(defaultData);
            }

            var timeout = null;
            $(_this.msJobCategory).on('keyup', function () {
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    _this.getMSList(function (items) {
                        _this.msJobCategory.setData(items);
                    }, 'categories', _this.msJobCategoryElement, _this.msJobCategory.getRawValue());
                }, 500);
            });
        }, 'categories', _this.msJobCategoryElement, undefined, undefined);

        [ 'en', 'fr' ].forEach(function(current_locale) {
            var msJobSubCategoryElementName = 'msJobSubCategoryElement';
            var msJobSubCategoryName = 'msJobSubCategory';

            if (current_locale != 'en') {
                msJobSubCategoryElementName = 'msJobSubCategory' + (current_locale[0].toUpperCase() + current_locale.slice(1)) + 'Element';
                msJobSubCategoryName = 'msJobSubCategory' + (current_locale[0].toUpperCase() + current_locale.slice(1));
            }

            _this.getMSList(function(items, defaultData) {
                _this[msJobSubCategoryName] = _this[msJobSubCategoryElementName].magicSuggest({
                    placeholder: trans('field_job_title'),
                    maxSelection: 1,

                    maxSelectionRenderer: function () {
                        return trans('jack_max_1');
                    },

                    toggleOnClick: false,
                    allowFreeEntries: true,
                    data: [],
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + trans('not_found'),

                    cls: (function() {
                        var classes = _this[msJobSubCategoryElementName].attr('class').split(/\s+/);
                        classes = classes.concat('jack input_style');
                        return classes.join(' ');
                    })(),
                });

                if (defaultData) {
                    _this[msJobSubCategoryName].setSelection(defaultData);
                }

                var timeout = null;

                $(_this[msJobSubCategoryName]).on('keyup', function () {
                    clearTimeout(timeout);

                    timeout = setTimeout(function () {
                        _this.getMSList(function (items) {
                            _this[msJobSubCategoryName].setData(items);
                        }, 'categories', _this[msJobSubCategoryElementName], _this[msJobSubCategoryName].getRawValue(), undefined, 1, current_locale);
                    }, 500);
                });
            }, 'categories', _this[msJobSubCategoryElementName], undefined, undefined, 1, current_locale);
        });

        setTimeout(function () {
            $('#job_subcategories input').attr('name', 'title');
            $('#job_subcategories-fr input').attr('name', 'title_fr');
        }, 3000);
    },
    create: function () {
        this.formEvents();
    },
    //init event for create or update form
    formEvents: function () {
        var _this = this;
        //clear all fileds in form
        this.form.on('click', 'input, select, textarea', function () {
            FormValidate.fieldValidateClear($(this));
        });
        //one time load all items by clicking on panel
        this.form.on('click', '.main-panel', function () {
            var type = $(this).attr('data-type-panel');
            switch (type) {
                case 'location':
                    if (_this.loadLocations === 0) {
                        _this.getLocations();
                        _this.loadLocations = 1;
                    }
                    break;
            }
        });

        (function initialize_multilanguage() {
            var default_language = 'en';

            if (business.currentData.language) {
                default_language = business.currentData.language.prefix || 'en';
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

                _this.form.find('.multilanguage').parent().find('label:first').each(function() {
                    $(this).html($(this).html().split(/\(/).slice(0, -1).join('(') + ' (' + current_language_prefix + ')');
                });

                // changing localized name in job category jack:

                var available_locales = [
                    current_language_prefix,
                ].concat($(this).children().toArray().map(function(element) {
                    return $(element).val();
                }).filter(function(current_locale) {
                    return current_locale != current_language_prefix;
                }));

                [
                    'msDepartments',
                    'msJobCategory',
                    // 'msJobTypes',
                    // 'msCareerLevel',
                    'msLanguages',
                    'msCertificates',
                ].forEach(function(current_jack_name) {
                    if (!_this[current_jack_name]) {
                        return;
                    }

                    _this[current_jack_name].setData(_this[current_jack_name].getData().map(function(item) {
                        item.name = '';

                        available_locales.some(function(current_locale) {
                            if (item['name_' + current_locale]) {
                                item.name = item['name_' + current_locale];
                                return true;
                            }

                            return false;
                        });

                        return item;
                    }));

                    _this[current_jack_name].setSelection(_this[current_jack_name].getSelection().map(function(item) {
                        item.name = '';

                        available_locales.some(function(current_locale) {
                            if (item['name_' + current_locale]) {
                                item.name = item['name_' + current_locale];
                                return true;
                            }

                            return false;
                        });

                        return item;
                    }));
                });
            });

            this.form.find('.multilanguage').addClass('d-none');
            this.form.find('.multilanguage-' + default_language).removeClass('d-none');

            this.form.find('.multilanguage').parent().find('label:first').each(function() {
                $(this).html($(this).html() + ' (' + default_language + ')');
            });
        }).apply(this);

        //click on create button
        this.form.find('#business-' + this.type + '-create').on('click', function () {
            _this.save();
        });
        //init form events by page type
        switch (this.type) {
            case 'job':
                _this.form.on('click', '#job-availabilities-all input', function () {
                    var dataDay = $(this).attr('data-time');
                    if ($(this).prop('checked')) {
                        _this.form.find('input[data-parent-time="' + dataDay + '"]').prop('checked', true);
                    } else {
                        _this.form.find('input[data-parent-time="' + dataDay + '"]').prop('checked', false);
                    }
                });
                _this.form.on('click', 'input[data-parent-time]', function () {
                    var dataDay = $(this).attr('data-parent-time');
                    if (!$(this).prop('checked')) {
                        _this.form.find('#job-availabilities-all').find('input[data-time="' + dataDay + '"]').prop('checked', false);
                    }
                });
                // $('#job-question__add-type-on-off').click(function () {
                //     var questionElem = $('#job-question__type-on-off').clone();
                //     questionElem.removeAttr('id').show();
                //     questionElem.find('input').removeAttr('disabled');
                //     $('#job-question__block-questions').append(questionElem);
                //     $('.job-question__question:last-child input:not(.d-none)').focus();
                // });
                // $('#job-question__add-type-detailed').click(function () {
                //     var questionElem = $('#job-question__type-detailed').clone();
                //     questionElem.removeAttr('id').show();
                //     questionElem.find('input').removeAttr('disabled');
                //     $('#job-question__block-questions').append(questionElem);
                //     $('.job-question__question:last-child input:not(.d-none)').focus();
                // });
                // _this.form.on('click', '.job-question__del-question', function () {
                //     $(this).closest('.job-question__question').remove();
                // });
                _this.msFields();
                break;
        }
    },
    getMSList: function (callback, method, el, keywords, defaultData, sub, locale) {
        var params = {};
        if (sub) {
            params = {
                'sub': 1
            };
        }
        var need = ['items{id name name_fr localized_name}'];

         if (method == 'keywords') {
            if ($(el).attr('data-language-prefix')) {
                params.language_prefix = $(el).attr('data-language-prefix');
            }

            need = [ 'items{id name}' ];
        }
        else if (method === 'categories') {
            need = [ 'id name name_fr localized_name' ];
        }

        if (defaultData) {
            params['default'] = defaultData;
            need.push('default{id name}')
        }

        if (((keywords && keywords.length === 0) || !keywords) && method === 'keywords') {
            callback([], defaultData);
        } else {
            if (keywords) {
                if (keywords.length > 0) {
                    params['keywords'] = keywords;
                }
            }

            if (locale) {
                params['locale'] = locale;
            }

            new GraphQL("query", method, params, need, false, false, function (data) {
                //show error
            }, function (data) {
                if (data) {
                    if (method === 'categories') {
                        if (sub) {
                            data = data.map(function(item) {
                                return {
                                    id: item.id,
                                    name: item['name' + (locale && locale != 'en' ? '_' + locale : '')],
                                };
                            });
                        }
                        else {
                            data = data.map(function(item) {
                                return {
                                    id:         item.id,
                                    name:       item.localized_name || item.name,
                                    name_en:    item.name,
                                    name_fr:    item.name_fr,
                                }
                            });
                        }

                        callback(data, data.default);
                    } else {
                        var items = $.map(data.items, function(item) {
                            return {
                                id:         item.id,
                                name:       item.localized_name || item.name,
                                name_en:    item.name,
                                name_fr:    item.name_fr,
                            };
                        });

                        callback(items, (method === 'keywords') ? defaultData : data.default);
                    }
                }
            }).request(el);
        }
    },
    //delete request
    delete: function () {
        if (this.currentID) {
            var _this = this;
            //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
            new GraphQL("mutation", this.queryDelete, {
                "id": _this.currentID,
                "business_id": _this.businessID
            }, ['token'], true, false, function () {
                Loader.stop();
            }, function () {
                $('.' + _this.type + '-item[data-item-id="' + _this.currentID + '"]').remove();
                $('#deleteModal').modal('hide');
            }, this.form).request();
        }
    },
    // setAdmin
    setAdmin: function () {
        var _this = this;
        if (_this.currentUserID) {
            //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
            new GraphQL("mutation", this.querySetAdmin, {
                "id": _this.currentUserID,
                "business_id": _this.businessID
            }, ['token'], true, false, function () {
                Loader.stop();
            }, function () {
                /*$('.' + _this.type + '-item[data-item-id="' + _this.currentID + '"]').remove();
                $('#deleteModal').modal('hide');*/
                window.location.reload();
            }, this.form).request();
        }
    },
    //clone item
    clone: function () {
        this.form.find('.business-' + this.type + '-status').removeClass('active');
        this.cloneQuery = true;
        var _this = this;
        setTimeout(function () {
            _this.getItem();
        }, 0);
    },
    setLocations: function () {
        var _this = this;
        var params = {
            "business_id": this.businessID
        };
        var locations = [];
        $.each(this.form.find('.location-item:checked'), function () {
            locations.push($(this).val());
        });
        params[this.type + '_locations'] = locations.join(",");
        //params for response
        // var needParams = ['id', 'token', 'assign_locations {' +
        // 'id name street street_number city region country created_date job_status' +
        // '}'];
        var needParams = ['id', 'token'];
        var query = this.queryUpdateLocation;
        //set update method
        params['id'] = +this.currentID;
        //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
        new GraphQL("mutation", query, params, needParams, true, false, function () {
            Loader.stop();
        }, function (data) {
            if (data) {
                $('#ManaInLocModal').modal('hide');
                _this.assigmentData[_this.currentID] = data.assign_locations;
                _this.loadLocationsData[_this.currentID] = 0;
                _this.counterRefresh();
                _this.getItems();
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
            params[type + '_locations'] = element.val();
        } else if (element.is('button')) {
            var el = element.parents('.modal-body');
            $.each(el.find('.item-checkbox'), function () {
                if ($(this).prop('checked')) {
                    open.push($(this).val());
                } else {
                    close.push($(this).val());
                }
            });
            params['open_locations'] = open.join(",");
            params['close_locations'] = close.join(",");
        }
        //params for response
        var needParams = ['id', 'token', 'assign_locations {' +
        'id name street street_number city region country created_date job_status' +
        '}'];
        var query = 'updateJobStatuses';
        //set update method
        params['id'] = +this.currentID;
        //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
        new GraphQL("mutation", query, params, needParams, true, false, function () {
            Loader.stop();
        }, function (data) {
            if (data) {
                $('#ManaInLocModal').modal('hide');
                _this.assigmentData[_this.currentID] = data.assign_locations;
                _this.loadLocationsData[_this.currentID] = 0;
                _this.counterRefresh();
                _this.getItems();
            }
        }).request();
    },
    counterRefresh: function () {
        var _this = this;
        if (_this.assigmentData[_this.currentID]) {
            var open = 0;
            var close = 0;
            $.map(_this.assigmentData[_this.currentID], function (item) {
                if (item) {
                    if (item.job_status === 0) {
                        close++;
                    } else {
                        open++;
                    }
                }
            });
            _this.form.find('.business-job-status-assign[data-id="' + _this.currentID + '"] span').text(open);
            $('#jobs-open-close-title').find('span:first').text(open);
            $('#jobs-open-close-title').find('span:last').text(close);
            if (open) {
                _this.form.find('.job-status-change[data-id="' + _this.currentID + '"]').prop( "checked", true );
            } else {
                _this.form.find('.job-status-change[data-id="' + _this.currentID + '"]').prop( "checked", false );
            }
        }
    },
    //save request
    save: function (noRedirect, type) {
        noRedirect = noRedirect || 0;
        var _this = this;
        var params = {
            "business_id": this.businessID
        };

        switch (this.type) {
            case 'job':
                var timeArray1 = [];
                var timeArray2 = [];
                var timeArray3 = [];
                var timeArray4 = [];
                $("input:checkbox[name=time_1]:checked").each(function () {
                    timeArray1.push($(this).val());
                });
                $("input:checkbox[name=time_2]:checked").each(function () {
                    timeArray2.push($(this).val());
                });
                $("input:checkbox[name=time_3]:checked").each(function () {
                    timeArray3.push($(this).val());
                });
                $("input:checkbox[name=time_4]:checked").each(function () {
                    timeArray4.push($(this).val());
                });
                // var careers = $.map(this.msCareerLevel.getSelection(), function (item) {
                //     return item.id;
                // }).join(',');
                // var jobTypes = $.map(this.msJobTypes.getSelection(), function (item) {
                //     return item.id;
                // }).join(',');
                var languages = $.map(this.msLanguages.getSelection(), function (item) {
                    return item.id;
                }).join(',');
                var certificates = $.map(this.msCertificates.getSelection(), function (item) {
                    return item.id;
                }).join(',');
                // var keywords = $.map(this.msKeywords.getSelection(), function (item) {
                //     return item.id;
                // }).join(',');
                // var keywords_fr = $.map(this.msKeywordsFr.getSelection(), function (item) {
                //     return item.id;
                // }).join(',');
                var checkItems = ['career_status', 'work_status', 'options'];
                $.map(checkItems, function (item) {
                    var array = [];
                    $("input:checkbox[name=" + item + "]:checked").each(function () {
                        array.push($(this).val());
                    });
                    var str = array.join(",");
                    params[item] = str;
                });

                var i =0
                // var question_type_onoff =[];
                // this.form.find('input[name="question_type_onoff"]').each(function () {
                //     if (!$(this).attr('disabled')) {
                //         question_type_onoff.push($(this).val());
                //     }
                // });
                // var question_type_onoff_fr =[];
                // this.form.find('input[name="question_type_onoff_fr"]').each(function () {
                //     if (!$(this).attr('disabled')) {
                //         question_type_onoff_fr.push($(this).val());
                //     }
                // });
                // var question_type_detailed =[];
                // this.form.find('input[name="question_type_detailed"]').each(function () {
                //     if (!$(this).attr('disabled')) {
                //         question_type_detailed.push($(this).val());
                //     }
                // });
                // var question_type_detailed_fr =[];
                // this.form.find('input[name="question_type_detailed_fr"]').each(function () {
                //     if (!$(this).attr('disabled')) {
                //         question_type_detailed_fr.push($(this).val());
                //     }
                // });
                params = $.extend({}, params, {
                    //"title": FormValidate.getFieldValue('title', this.form),
                    "title": this.msJobSubCategory.getSelection()[0] ? this.msJobSubCategory.getSelection()[0].name : '',
                    "title_id": this.msJobSubCategory.getSelection()[0] ? this.msJobSubCategory.getSelection()[0].id : '',
                    "title_fr": this.msJobSubCategoryFr.getSelection()[0] ? this.msJobSubCategoryFr.getSelection()[0].name : '',
                    "title_fr_id": this.msJobSubCategoryFr.getSelection()[0] ? this.msJobSubCategoryFr.getSelection()[0].id : '',
                    "description": FormValidate.getFieldValue('description', this.form),
                    "description_fr": FormValidate.getFieldValue('description_fr', this.form),
                    // "notes": FormValidate.getFieldValue('notes', this.form),
                    // "notes_fr": FormValidate.getFieldValue('notes_fr', this.form),
                    "salary": FormValidate.getFieldValue('salary', this.form),
                    "salary_type": FormValidate.getFieldValue('salary_type', this.form),
                    "hours": +FormValidate.getFieldValue('hours', this.form),
                    "type_key": FormValidate.getFieldValue('type_key', this.form),
                    "status": +this.form.find('.business-job-status.active').attr('data-status'),
                    "time_1": timeArray1.join(","),
                    "time_2": timeArray2.join(","),
                    "time_3": timeArray3.join(","),
                    "time_4": timeArray4.join(","),
                    // "category_id": this.msJobCategory.getSelection()[0] ? parseInt(this.msJobCategory.getSelection()[0].id) : 0,
                    "departments": this.msDepartments.getValue().join(','),
                    // "careers": careers,
                    // "types": jobTypes,
                    "languages": languages,
                    "certificates": certificates,
                    // "keywords": keywords,
                    // "keywords_fr": keywords_fr,
                    // "questions_t_onoff": question_type_onoff.join(','),
                    // "questions_t_onoff_fr": question_type_onoff_fr.join(','),
                    // "questions_t_detailed": question_type_detailed.join(','),
                    // "questions_t_detailed_fr": question_type_detailed_fr.join(','),
                });
                break;
            case 'manager':
                params = $.extend({}, params, {
                    "first_name": FormValidate.getFieldValue('first_name', this.form),
                    "last_name": FormValidate.getFieldValue('last_name', this.form),
                    "email": FormValidate.getFieldValue('email', this.form),
                    "role": this.role,
                     /*"demote_promote": +FormValidate.getCheckedFieldValue('demote_promote', this.form),
                    "add_new_seat": +FormValidate.getCheckedFieldValue('add_new_seat', this.form),
                    "jobs": +FormValidate.getCheckedFieldValue('jobs', this.form),
                    "locations": +FormValidate.getCheckedFieldValue('locations', this.form),
                    "departments": +FormValidate.getCheckedFieldValue('departments', this.form),
                    "business": +FormValidate.getCheckedFieldValue('business', this.form),
                    "managers": +FormValidate.getCheckedFieldValue('managers', this.form),
                    //"share": +FormValidate.getCheckedFieldValue('share', this.form),
                    //"contact_employees": +FormValidate.getCheckedFieldValue('contact_employees', this.form),
                    "contact_candidates": +FormValidate.getCheckedFieldValue('contact_candidates', this.form),
                    "view_candidates": +FormValidate.getCheckedFieldValue('view_candidates', this.form),
                    "view_candidates_own": +FormValidate.getCheckedFieldValue('view_candidates_own', this.form),
                    "candidates": +FormValidate.getCheckedFieldValue('candidates', this.form),
                    "candidates_own": +FormValidate.getCheckedFieldValue('candidates_own', this.form),*/
                });
                var permits = [];
                $.each(this.form.find('.manager__permit-item:checked'), function () {
                    permits.push($(this).val());
                });
                params['permits'] = permits.join(",");
                break;
            case 'department':
                params = $.extend({}, params, {
                    "name": FormValidate.getFieldValue('name', this.form),
                    "name_fr": FormValidate.getFieldValue('name_fr', this.form),
                    "status": +this.form.find('.business-department-status.active').attr('data-status')
                });
                break;
        }

        if (type) {
            params['type'] = type;
        } else {
            var locations = [];
            $.each(this.form.find('.location-item:checked'), function () {
                locations.push($(this).val());
            });
            params[this.type + '_locations'] = locations.join(",");
            var locations_detach = [];
            $.each(this.form.find('.location-item:not(:checked)'), function () {
                locations_detach.push($(this).val());
            });
            params[this.type + '_locations_detach'] = locations_detach.join(",");
        }

        //params for response
        var needParams = ['id', 'token'];
        var query = this.query;
        //set update method
        if (this.currentID && !this.cloneQuery) {
            params['id'] = +this.currentID;
            query = this.queryUpdate;
        }

        var redirectUrl = _this.redirectURL;
        if (noRedirect) {
            redirectUrl = false;
        }
        //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form

        new GraphQL("mutation", query, params, needParams, true, redirectUrl, function () {
            Loader.stop();
        }, function (data) {
            if (data && data.id) {
                _this.currentID = data.id;
            }
            if (!redirectUrl) {
                _this.getLocations();
            }
        }, this.form).request();
    },

    saveAssignLocation: function (type, businessID) {
        var _this = this;
        var params = {
            "business_id": this.businessID,
            'id': +this.currentID,
        };
        if (businessID) {
            params['business_id'] = +businessID;
        }
        if (type) {
            params['type'] = type;
        } else {
            var locations = [];
            $.each(this.form.find('.location-item:checked'), function () {
                locations.push($(this).val());
            });
            params[this.type + '_locations'] = locations.join(",");
            var locations_detach = [];
            $.each(this.form.find('.location-item:not(:checked)'), function () {
                locations_detach.push($(this).val());
            });
            params[this.type + '_locations_detach'] = locations_detach.join(",");
        }
        //params for response
        var needParams = ['id', 'token'];
        var query = this.queryUpdate + 'Location';

        new GraphQL("mutation", query, params, needParams, true, false, function () {
            Loader.stop();
        }, function (data) {
            if (data && data.id) {
                _this.currentID = data.id;
            }
            if (!type) {
                _this.getLocations();
            }
        }).request();
    },
    //get all locations for items
    getLocations: function (keywords) {
        var _this = this;
        //---check edit or create
        /*var ch_url = document.location.pathname;
        var ch_pages = ['job', 'manager', 'department'];
        var ch_method;
        for (var i = 0; i < ch_pages.length; i++) {
            page = ch_pages[i];
            var m = explode(page, ch_url);
            if (typeof m[1] !== 'undefined') {
                ch_method = m[1].substr(1);
                break;
            }
        }*/

        var params = {
            "business_id": this.businessID,
        };
        if (!this.isClearLocations) {
            params["business_id"] = this.businessIDforLocation;
            if (this.businessIDforLocation == this.businessID) {
                params['no_brands'] = 1;
            }
        }
        /*if (this.sort) {
            params['sort'] = this.sort;
        }
        if (this.order) {
            params['order'] = this.order;
        }*/
        if (this.perPage) {
            params['limit'] = this.perPage;
        }
        if (this.currentPage) {
            params['page'] = this.currentPage;
        }
        params['page_location'] = this.currentPageBusiness;
        if (this.urlMethod == 'edit' || (this.currentID  && !this.cloneQuery)) {
            params['assignment'] = 1;
            params[this.type+'_id'] = this.currentID;
        }
        // switch (this.type) {
        //     case 'manager':
        //         params['manager_id'] = this.currentID;
        //         break;
        // }

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
        console.log('location');
        var locationListElement = $('.business-location-list');
        new GraphQL("query", "businessLocationsBrands", params, [
            'items { '+
                'id name count_locations pages_locations locations { ' +
                    'id name name_fr street street_number city region country created_date html_assign is_assigned' +
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
                        html += '<div class="block_locations_business" data-business_id="' + business.id + '">';
                        html += '<div class="row" style="margin-right: 0;"><div class="col-md-4"><p class="pl-3 h5 mt-3">' + business.name + '</p></div>';
                        html += '<div class="col-md-3"><button type="button" class="btn btn-success btn-block business_assign-all" data-business_id="' + business.id + '">'
                            + trans('assign_all') + '</button></div>';
                        html += '<div class="col-md-3"><button type="button" class="btn btn-primary btn-block business_unassign-all" data-business_id="' + business.id + '">'
                            + trans('unassign_all') + '</button></div></div>';
                        $.map(business.locations, function (location) {
                            html += location.html_assign;
                        });

                        html += _this.pagination(business.id, business.pages_locations, _this.currentPageBusiness) + '</div>';
                    }
                });
            }
            if (_this.isClearLocations) {
                locationListElement.html(html);
            } else {
                _this.elemUploadLocations.html(html);
            }
            if (data.pages > 1 && _this.isClearLocations) {
                $('#pagination_business_for_locations').html(_this.pagination(_this.businessID, data.pages, _this.currentPage));
            }

            // if (keywords && keywords.length > 1) {
                _this.renderSearchItem(data);
            // }

        }).request();
    },
    renderSearchItem: function (data) {
        var _this = this;
        var type = 'unassigned';
        var el = _this.form.find('.' + type + '-header');
        console.log(el);
        _this.form.find('.' + type + '-item').remove();
        var itemsCount = 0;
        var locationsList = _this.allLocationsList;

        var jobIDs = [];
        $.map(locationsList, function (item) {
            if (item) {
                jobIDs.push(parseInt(item.id));
            }
        });

        $.map(data.items, function (business) {
            if (business.locations.length > 0) {
                $.map(business.locations, function (location) {
                    if (jobIDs.includes(parseInt(location.id)) ) {
                        if (location.is_assigned == 0) {
                            itemsCount++;
                            el.after(_this.renderLocationItem(location, type));
                        }
                    }
                });
            }
        });

        if (itemsCount < 1) {
            el.after('<div class="col-md-12 mt-2 mx-auto pr-0 unassigned-item"><div class="d-flex">Locations not found</div></div>');
        }
    },
    pagination: function (businessId, countPages, currentPage) {
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

    /*getLocations: function (keywords) {
        var _this = this;
        //---check edit or create
        var ch_url = document.location.pathname;
        var ch_pages = ['job', 'manager', 'department'];
        var ch_method;
        var ch_page;
        for (var i = 0; i < ch_pages.length; i++) {
            page = ch_pages[i];
            var m = explode(page, ch_url);
            if (typeof m[1] !== 'undefined') {
                ch_method = m;
                break;
            }
        }
        //---
        var params = {
            "business_id": this.businessID,
            "limit": 10
        };
        if (typeof keywords !== 'undefined') {
            if (keywords.length > 1) {
                params['keywords'] = keywords;
                this.searchLocation = 0;
            } else {
                if (this.searchLocation === 1) {
                    return;
                } else {
                    this.searchLocation = 1;
                }
            }
        }
        params['page'] = this.currentPage;
        var type = 'unassigned';
        params['assignment'] = 1;
        if (ch_method == 'add') {
            params['no_brands'] = 1;
        }
        if (this.currentID) {
            params[this.type + '_id'] = this.currentID;
        }
        var el = _this.form.find('.' + type + '-header');
        new GraphQL("query", "businessLocations", params, [
            'items {' +
            'id name street street_number city region country created_date, count_linked' +
            '}',
            'brands {'+
            'id name' +
            ' locations { id name street street_number city region country created_date, count_linked }' +
            '}',
            'pages',
            'current_page'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            _this.form.find('.' + type + '-item').remove();
            if (data.items) {
                $.map(data.items, function (item) {
                    if (item.id) {
                        var location = item.street + ' ' + item.street_number + ', ' + item.city;
                        var checked = '';
                        if (item.region !== null) {
                            location += ", " + item.region;
                        }
                        if (item.country !== null) {
                            location += ", " + item.country;
                        }
                        if (item.count_linked) {
                            checked = ' checked';
                        }
                        var html = '<div class="col-md-11 mt-2 mx-auto pxa-0 pr-0 ' + type + '-item">\n' +
                            '            <div class="d-flex">\n' +
                            '                <div class="align-self-center mr-2">\n' +
                            '                    <label class="custom-control custom-checkbox m-0 pl-3">\n' +
                            '                        <input type="checkbox"' + checked + '\n' +
                            '                               class="custom-control-input location-item " value="' + item.id + '">\n' +
                            '                        <span class="custom-control-indicator"></span>\n' +
                            '                    </label>\n' +
                            '                </div>\n' +
                            '                <div class="flex-1 align-self-center">\n' +
                            '                    <div class="d-flex flex-column flex-md-row">\n' +
                            '                        <div class="align-self-center flex-1">\n' +
                            '                            <p class="my-0 px-3 coll_name"><strong>' + item.name + '</strong></p>\n' +
                            '                            <p class="my-0 px-3 coll_title">' + location + '</p>\n' +
                            '                        </div>\n' +
                            '                        <div class="align-self-center ml-3 text-right">\n' +
                            '                            <p class="my-0 small">\n' +
                            '                                <strong>'+trans('created')+'</strong></p>\n' +
                            '                            <p class="my-0">' + item.created_date + '</p>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                </div>\n' +
                            '            </div>\n' +
                            '        </div>';
                        el.after(html);
                    }
                });
            }
            if (data.brands) {
                el = _this.form.find('.' + type + '-header-brand');
                    $.map(data.brands, function (brand) {
                        var html = '<p class="pl-3 h5 mt-3">Brand ' + brand.name + '</p>';
                        $.map(brand.locations, function (item) {
                            var location = item.street + ' ' + item.street_number + ', ' + item.city;
                            var checked = '';
                            if (item.region !== null) {
                                location += ", " + item.region;
                            }
                            if (item.country !== null) {
                                location += ", " + item.country;
                            }
                            if (item.count_linked) {
                                checked = ' checked';
                            }
                            html += '<div class="col-md-11 mt-2 mx-auto pxa-0 pr-0 ' + type + '-item">\n' +
                                '            <div class="d-flex">\n' +
                                '                <div class="align-self-center mr-2">\n' +
                                '                    <label class="custom-control custom-checkbox m-0 pl-3">\n' +
                                '                        <input type="checkbox"' + checked + '\n' +
                                '                               class="custom-control-input location-item " value="' + item.id + '">\n' +
                                '                        <span class="custom-control-indicator"></span>\n' +
                                '                    </label>\n' +
                                '                </div>\n' +
                                '                <div class="flex-1 align-self-center">\n' +
                                '                    <div class="d-flex flex-column flex-md-row">\n' +
                                '                        <div class="flex-1 align-self-center">\n' +
                                '                            <p class="my-0 px-3 coll_name"><strong>' + item.name + '</strong></p>\n' +
                                '                            <p class="my-0 px-3 coll_title">' + location + '</p>\n' +
                                '                        </div>\n' +
                                '                        <div class="align-self-center ml-3 text-right">\n' +
                                '                            <p class="my-0 small">\n' +
                                '                                <strong>'+trans('created')+'</strong></p>\n' +
                                '                            <p class="my-0">' + item.created_date + '</p>\n' +
                                '                        </div>\n' +
                                '                    </div>\n' +
                                '                </div>\n' +
                                '            </div>\n' +
                                '        </div>';
                        });
                        el.after(html);
                    });
            }
            _this.countPages = data.pages;
            _this.paginationUnAssignItems(data.pages);
        }).request(el, true);
    },*/
    //location item html for getLocations method
    locationItem: function (data) {
        var _this = this;
        var type = 'assigned';
        var el = _this.form.find('.' + type + '-header');
        _this.form.find('.' + type + '-item').remove();
        var jobIDs = [];
        $.map(data, function (item) {
            if (item) {
                el.after(_this.renderLocationItem(item, type));
                jobIDs.push(item.id);
            }
        });

        var type = 'unassigned';
        var el = _this.form.find('.' + type + '-header');
        _this.form.find('.' + type + '-item').remove();
        var locationsList = _this.allLocationsList;

        $.map(locationsList, function (item) {
            if (item && !jobIDs.includes(item.id) ) {
                el.after(_this.renderLocationItem(item, type));
            }
        });
    },
    //job item html
    renderLocationItem: function (item, type) {
        var location = item.street + ' ' + item.street_number + ', ' + item.city;
        if (item.region !== null) {
            location += ", " + item.region;
        }
        if (item.country !== null) {
            location += ", " + item.country;
        }

        var checked = (type === 'assigned') ? 'checked' : '';

        var html = '<div class="col-md-11 mt-2 pr-0 mr-0 mx-auto pr-0 ' + type + '-item">\n' +
            '            <div class="d-flex">\n' +
            '                <div class="mr-2 align-self-center">\n' +
            '                    <label class="custom-control custom-checkbox m-0 pl-3">\n' +
            '                        <input type="checkbox"\n' +
            '                               class="custom-control-input location-item " ' + checked + ' value="' + item.id + '">\n' +
            '                        <span class="custom-control-indicator"></span>\n' +
            '                    </label>\n' +
            '                </div>\n' +
            '                <div class="flex-1 align-self-center">\n' +
            '                    <div class="d-flex flex-column flex-md-row">\n' +
            '                        <div class="align-self-center flex-1">\n' +
            '                            <p class="my-0 px-3 coll_name"><strong>' + item.name + '</strong></p>\n' +
            '                            <p class="my-0 px-3 coll_title">' + location + '</p>\n' +
            '                        </div>\n' +
            '                        <div class="align-self-center text-right ml-3">\n' +
            '                            <p class="my-0 small">\n' +
            '                                <strong>'+trans('created')+'</strong></p>\n' +
            '                            <p class="my-0">' + item.created_date + '</p>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '            </div>\n' +
            '        </div>';

        return html;
    },
    //job item html
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
                var location = item.street + ' ' + item.street_number + ', ' + item.city;
                if (item.region !== null) {
                    location += ", " + item.region;
                }
                if (item.country !== null) {
                    location += ", " + item.country;
                }
                var html = '<div class="col-md-12 mt-2 ' + type + '-item">\n' +
                    '           <div class="row">\n' +
                    '               <div class="col-md-8 ml-3">\n' +
                    '                   <p class="my-0 px-3 coll_name"><strong>' + item.name + '</strong></p>\n' +
                    '                   <p class="my-0 px-3 coll_title">' + location + '</p>\n' +
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
    //job item html for share
    jobItemShare: function (data) {
        var _this = this;
        _this.form.find('.open-item_share').remove();
        _this.form.find('.close-item_share').remove();
        $.map(data, function (item) {
            if (item) {
                if (item.job_status === 0) {
                    type = 'close';
                } else {
                    type = 'open';
                }
                var el = _this.form.find('.' + type + '-header_share');
                var location = item.street + ' ' + item.street_number + ', ' + item.city;
                if (item.region !== null) {
                    location += ", " + item.region;
                }
                if (item.country !== null) {
                    location += ", " + item.country;
                }
                var html = '<div class="col-md-12 mt-2 ' + type + '-item_share">\n' +
                    '           <div class="row justify-content-between flex-md-row flex-column">\n' +
                    '               <div class="col-md-9 pl-0 align-self-center">\n' +
                    '                   <p class="my-0 px-2 coll_name"><strong>' + item.name + '</strong></p>\n' +
                    '                   <p class="my-0 px-2 coll_title">' + location + '</p>\n' +
                    '               </div>\n' +
                    '               <div class="align-self-center">\n' +
                    '                   <button type="button" class="custom-share-job btn btn-primary" data-id="' + item.job_id + '">'+trans('share_t')+'</button>\n' +
                    '               </div>\n' +
                    '           </div>\n' +
                    '       </div>';
                el.after(html);
            }
        });
    },
    //get item data by item ID
    getItem: function () {
        this.formEvents();

        var _this = this;
        
        if (this.currentID == undefined) this.currentID = getUrlParameter('id');

        if (this.currentID == getUrlParameter('id') || this.currentID !== undefined) {
            var params = {
                "id": _this.currentID
            };
            //set params for response
            var needParams = [];
            switch (this.type) {
                case 'job':
                    needParams = [
                        'id',
                        'title', 'title_fr',
                        'category_id',
                        'description', 'description_fr',
                        // 'notes', 'notes_fr',
                        'salary',
                        'salary_type',
                        'hours',
                        'type_key',
                        'time_1',
                        'time_2',
                        'time_3',
                        'time_4',
                        'career_status',
                        'work_status',
                        'options',
                        'status',
                        'assign_locations {' +
                            'id name name_fr street street_number city region country created_date' +
                        '}',
                        'keywords {' +
                            'id name' +
                        '}',
                        'keywords_fr {' +
                            'id name' +
                        '}',
                        'assign_departments {' +
                            'id name name_fr' +
                        '}',
                        'assign_career_levels {' +
                            'id name name_fr' +
                        '}',
                        'assign_types {' +
                            'id name name_fr' +
                        '}',
                        'assign_languages {' +
                            'id name name_fr' +
                        '}',
                        'assign_certificates {' +
                            'id name name_fr' +
                        '}',
                        'assign_title {' +
                            'id name' +
                        '}',
                        'assign_title_fr {' +
                            'id name' +
                        '}',
                        'assign_category {' +
                            'id name name_fr' +
                        '}',
                        // 'questions {' +
                        // 'id question question_fr localized_question type job_id' +
                        // '}'
                    ];
                    break;
                case 'manager':
                    needParams = [
                        'id',
                        'role',
                        'invite',
                        'user { ' +
                            'id first_name last_name email ' +
                        '}',
                        'permits { ' +
                            'id localized_title pivot_value pivot_business_id ' +
                        '}',
                        'assign_locations { ' +
                            'id name name_fr street street_number city region country created_date ' +
                        '}',
                        'token'
                    ];
                    params["business_id"] = _this.businessID;
                    break;
                case 'department':
                    needParams = [
                        'id',
                        'name',
                        'name_fr',
                        'status',

                        'assign_locations {' +
                            'id name name_fr street street_number city region country created_date' +
                        '}'
                    ];

                    params["business_id"] = _this.businessID;
                    break;
            }
            var auth = (this.type == 'manager') ? true : false;
            new GraphQL("query", this.queryItem, params, needParams, auth, false, function () {
                Loader.stop();
            }, function (data) {
                if (data.id) {
                    switch (_this.type) {
                        case 'job':
                            //_this.form.find('input[name="title"]').val(data.title);
                            _this.form.find('textarea[name="description"]').val(data.description);
                            _this.form.find('textarea[name="description_fr"]').val(data.description_fr);
                            // _this.form.find('textarea[name="notes"]').val(data.notes);
                            // _this.form.find('textarea[name="notes_fr"]').val(data.notes_fr);
                            _this.form.find('input[name="salary"]').val(data.salary);
                            _this.form.find('select[name="salary_type"]').val(data.salary_type);
                            _this.form.find('input[name="hours"]').val(data.hours);
                            _this.form.find('select[name="type_key"]').val(data.type_key || 'full');
                            _this.form.find('.business-job-status[data-status="' + data.status + '"]').addClass('active');

                            var checkItems = ['career_status', 'work_status', 'options'];
                            $.map(checkItems, function (item) {
                                if (data[item]) {
                                    var params = data[item].split(",");
                                    $.each(params, function (k, v) {
                                        $('input[name="' + item + '"][value="' + v + '"]').prop('checked', true).parent().addClass('active');
                                    });
                                }
                            });

                            for (var t = 1; t <= 4; t += 1) {
                                if (data['time_' + t] !== null) {
                                    var time = data['time_' + t].split(",");
                                    var i = 1;
                                    $.each(time, function (k, v) {
                                        _this.form.find('input[name="time_' + t + '"][value="' + v + '"]').prop('checked', true);
                                        i += 1;
                                    });
                                    if (time.length === 7) {
                                        _this.form.find('input[data-time="' + (t - 1) + '"]').prop('checked', true);
                                    }
                                }
                            }

                            var multilanguage_selection = function(selection) {
                                if (!Array.isArray(selection)) {
                                    selection = [ selection ];
                                }

                                return selection.map(function(item) {
                                    var current_language_prefix = $('select[name="current_language_prefix"]').val();

                                    var available_locales = [
                                        current_language_prefix,
                                    ].concat($(this).children().toArray().map(function(element) {
                                        return $(element).val();
                                    }).filter(function(current_locale) {
                                        return current_locale != current_language_prefix;
                                    }));

                                    item = {
                                        id:         item.id,
                                        name:       '',
                                        name_en:    item.name,
                                        name_fr:    item.name_fr,
                                    };

                                    available_locales.some(function(current_locale) {
                                        if (item['name_' + current_locale]) {
                                            item.name = item['name_' + current_locale];
                                            return true;
                                        }

                                        return false;
                                    });

                                    return item;
                                });
                            };

                            if (data.assign_departments) {
                                _this.msDepartments.setSelection(multilanguage_selection(data.assign_departments));
                            }

                            // if (data.assign_career_levels) {
                            //     _this.msCareerLevelData = multilanguage_selection(data.assign_career_levels);

                            //     if (_this.msCareerLevel) {
                            //         _this.msCareerLevel.setSelection(_this.msCareerLevelData);
                            //         _this.msCareerLevelData = null;
                            //     }
                            // }
                            // if (data.assign_types) {
                            //     _this.msJobTypes.setSelection(multilanguage_selection(data.assign_types));
                            // }
                            // if (data.assign_languages) {
                            //     _this.msLanguages.setSelection(data.assign_languages);
                            // }
                            if (data.assign_certificates) {
                                _this.msCertificatesData = multilanguage_selection(data.assign_certificates);

                                if (_this.msCertificates) {
                                    _this.msCertificates.setSelection(_this.msCertificatesData);
                                    _this.msCertificatesData = null;
                                }
                            }

                            // console.log('BBBBB>>>>', _this.msKeywords, _this.msKeywordsFr);
                            // _this.msKeywords.setSelection(data.keywords);
                            // _this.msKeywordsFr.setSelection(data.keywords_fr);

                            /*if (data.category_id) {
                                _this.getMSList(function (items) {
                                    _this.msCategory.setData(items);
                                    _this.msCategory.setValue([data.category_id]);
                                }, 'jobCategories', _this.msCategoryElement, data.title);
                            }*/
                            if (data.assign_category) {
                                setTimeout(function () {
                                    _this.msJobCategory.setSelection(multilanguage_selection(data.assign_category));
                                }, 550);
                            }
                            if (data.assign_title) {
                                setTimeout(function () {
                                    _this.msJobSubCategory.setSelection(data.assign_title);
                                }, 500);
                            }
                            if (data.assign_title_fr) {
                                setTimeout(function () {
                                    _this.msJobSubCategoryFr.setSelection(data.assign_title_fr);
                                }, 500);
                            }

                            // if (data.questions.length > 0) {
                            //     var questionElem;
                            //     $.map(data.questions, function (item) {
                            //         if (item.type == 1) {
                            //             questionElem = $('#job-question__type-on-off').clone();
                            //             questionElem.removeAttr('id').show();
                            //             questionElem.find('input').removeAttr('disabled');
                            //             questionElem.find('input[name="question_type_onoff"]').val(item.question);
                            //             questionElem.find('input[name="question_type_onoff_fr"]').val(item.question_fr);
                            //             $('#job-question__block-questions').append(questionElem);
                            //         } else if (item.type == 2) {
                            //             questionElem = $('#job-question__type-detailed').clone();
                            //             questionElem.removeAttr('id').show();
                            //             questionElem.find('input').removeAttr('disabled');
                            //             questionElem.find('input[name="question_type_detailed"]').val(item.question);
                            //             questionElem.find('input[name="question_type_detailed_fr"]').val(item.question_fr);
                            //             $('#job-question__block-questions').append(questionElem);
                            //         }
                            //     });
                            // }
                            break;
                        case 'manager':
                            _this.form.find('input[name="first_name"]').val(data.user.first_name);
                            _this.form.find('input[name="last_name"]').val(data.user.last_name);
                            _this.form.find('input[name="email"]').val(data.user.email);
                            if (data.invite === 0) {
                                _this.form.find('input[name="first_name"]').attr('disabled', true);
                                _this.form.find('input[name="last_name"]').attr('disabled', true);
                                _this.form.find('input[name="email"]').attr('disabled', true);
                            }

                            var blocks = $('#manager-role-permissions, #assigned-locations');
                            if (data.role === 'admin') {
                                blocks.hide();
                            }

                            $.each(_this.form.find('.manager__permit-item'), function () {
                                let elemPermit = $(this);
                                let permitId = parseInt(elemPermit.val());
                                data.permits.forEach(function(item, i, arr) {
                                    if (item.id == permitId && item.pivot_value) {
                                        elemPermit.prop('checked', true);
                                    }
                                });

                            });
                            break;
                        case 'department':
                            _this.form.find('input[name="name"]').val(data.name);
                            _this.form.find('input[name="name_fr"]').val(data.name_fr);
                            _this.form.find('.business-department-status[data-status="' + data.status + '"]').addClass('active');
                            break;
                    }
                    if (data.assign_locations) {
                        //_this.locationItem(data.assign_locations);
                    }
                } else {
                    window.location.href = _this.redirectURL;
                }
            }).request();
        } else {
            window.location.href = _this.redirectURL;
        }
    },
    //get all items by page type
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
            $('#business-' + this.type + '-search').val(keywords);
        }
        var listElement = $('.business-' + this.type + '-list');
        var needItems = '';
        var headers = false;
        switch (this.type) {
            case 'job':
                needItems = 'id title localized_title description localized_description html';
                if (getUrlParameter('filters')) {
                    params['filters'] = getUrlParameter('filters');
                }
                break;
            case 'manager':
                headers = true;
                needItems = 'id html user_id role email';
                break;
            case 'department':
                needItems = 'id name created_date html';
                if (getUrlParameter('filters')) {
                    params['filters'] = getUrlParameter('filters');
                }
                break;
        }
        var need = [
            'items {' +
            needItems +
            ' assign_locations {' +
            'id name street street_number city region country created_date job_status job_id' +
            '}',
            '}',
            'pages',
            'current_page'
        ];

        if (this.type === 'manager') {
            need.push('token');
        }

        var locale = APIStorage.read('language');

        if (locale != 'en') {
            params['locale'] = locale;
        }
        if(this.queryItems == "businessManagers") return;
        new GraphQL("query", this.queryItems, params, need, headers, false, function () {
            Loader.stop();
        }, function (data) {
            listElement.html('');
            if (data.items) {
                $.map(data.items, function (item) {
                    var listElementActive = listElement;

                    if (item.role == 'admin') {
                        listElementActive = $('.business-admin-list');
                        listElementActive.append(item.html);
                    } else {
                        if (item.role == 'franchisee') {
                            listElementActive = $('.business-franchisee-list');
                            listElementActive.append(item.html);
                        } else {
                            listElement.append(item.html);
                        }
                    }

                    if (item.role === 'admin') {
                        var nameEl = listElementActive.find('.manager-item[data-item-id="' + item.id + '"] a:first');
                        nameEl.html('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512.002 512.002" style="enable-background:new 0 0 512.002 512.002; fill:#7b7b7b; vertical-align: middle; margin-top: -3px;" width="20px" height="20px" class="mr-2" xml:space="preserve"><g><g><circle cx="364" cy="140.062" r="32"/></g></g><g><g><path d="M506.478,165.937c-10.68-27.194-30.264-66.431-62.915-98.927c-32.535-32.384-71.356-51.408-98.194-61.666    c-29.464-11.261-62.945-4.163-85.295,18.082l-78.538,78.17c-23.281,23.171-29.991,58.825-16.698,88.72    c4.122,9.272,8.605,18.341,13.395,27.103L5.858,389.793C2.107,393.544,0,398.631,0,403.936v88c0,11.046,8.954,20,20,20h88    c11.046,0,20-8.954,20-20v-36l36-0.001c11.046,0,20-8.954,20-20v-35.999h36c11.046,0,20-8.954,20-20c0-11.046-8.954-20-20-20h-56    c-11.046,0-20,8.954-20,20v35.999l-36,0.001c-11.046,0-20,8.954-20,20v36H40V412.22l177.355-177.354    c6.516-6.516,7.737-16.639,2.958-24.517c-6.931-11.424-13.298-23.632-18.923-36.285c-6.599-14.841-3.237-32.57,8.366-44.119    l78.537-78.169c11.213-11.159,28.011-14.718,42.798-9.068c23.222,8.876,56.69,25.214,84.256,52.652    c27.735,27.604,44.62,61.567,53.9,85.197c5.791,14.748,2.272,31.503-8.965,42.687l-79.486,79.114    c-11.575,11.519-28.851,14.887-44.016,8.58c-12.507-5.202-24.62-11.382-36-18.367c-9.413-5.778-21.729-2.83-27.507,6.584    c-5.778,9.414-2.831,21.73,6.583,27.508c13.152,8.072,27.136,15.207,41.562,21.207c30.142,12.539,64.525,5.8,87.595-17.161    l79.486-79.113C511.044,229.157,518.101,195.534,506.478,165.937z"/></g></g></svg>' + nameEl.text());
                    }

                    _this.assigmentData[item.id] = item.assign_locations;
                    _this.loadLocationsData[item.id] = 0;
                    if (_this.type === 'job') {
                        _this.assigmentJobs[item.id] = { 'title': item.title, 'description': item.description };
                    }
                });
            }
            _this.countPages = data.pages;
            _this.pagination(data.pages);
        }).request((notShowLoader) ? listElement : false);

        var el = $('#items-list');
        var userData = JSON.parse(localStorage.getItem('user'));

        new GraphQL("query", 'businessManager', {'business_id': this.businessID, 'id': 0, 'user_id': userData['id']}, [
            'assign_locations { id name name_fr street street_number city region country created_date }',
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            if (data.assign_locations) {
                _this.allLocationsList = data.assign_locations;
            }
        }).request(el, false, true);
    },
    languageTabs: function(){
        if (this.type === 'job') {
            // setTimeout(function () {
            if (business.currentData) {
                var languageList = business.currentData.languages_list;
                var html = '<div class="row px-3 mt-2">' +
                    '<ul class="nav nav-tabs w-100 justify-content-end" id="myTab" role="tablist" style="margin: 0; padding: 0; border-bottom:0;">';
                var i = 0;
                $.map(languageList, function (item) {
                    var classActive = (i === 0) ? 'active' : '';
                    html += '<li class="nav-item">\n' +
                        '<a class="nav-link ' + classActive + ' p-1 pt-2" id="lang-tab' + i + '" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><label>' + item.name + '</label></a>\n' +
                        '</li>';
                    i++;
                });
                html += '<li class="nav-item" data-toggle="modal" data-target="#lang_modal">' +
                    '    <a class="nav-link p-1 pt-2" id="contact-tab" role="tab" aria-controls="contact" aria-selected="false">' +
                    '        <label>' +
                    '            <img src="/img/edit.png">' +
                    '        </label>' +
                    '    </a>' +
                    '</li></ul></div>';
                $('.languages-tabs').html(html);
            }
        }

        // }, 500);
    },

    //pagination for unassigment items
    paginationUnAssignItems: function (pages) {
        var _this = this;
        var html = '';
        if (pages > 1) {
            /*html = '<li class="page-item"><a class="page-link page-unassign-prev" href="javascript:;"><</a></li>';
            for (var i = 1; i <= pages; i++) {
                var active = '';
                if (_this.currentPage === i) {
                    active = 'active';
                }
                html += '<li class="page-item ' + active + '"><a class="page-link unassign-page" href="javascript:;">' + i + '</a></li>';
            }
            html += '<li class="page-item"><a class="page-link page-unassign-next" href="javascript:;">></a></li>';*/

            var active = '';
            var inactive = '';
            if (_this.currentPage == 1) {
                active = 'active';
                inactive = 'inactive';
            }
            html = '<li class="page-item"><a class="page-link page-unassign-prev ' + inactive + '" href="javascript:;">' + trans('previous') + '</a></li>'
                    + '<li class="page-item ' + active + '"><a class="page-link unassign-page" href="javascript:;">1</a></li>';
            if (pages < 8 ) {
                for (var i = 2; i < pages; i++) {
                    active = '';
                    if (_this.currentPage === i) {
                        active = 'active';
                    }
                    html += '<li class="page-item ' + active + '"><a class="page-link unassign-page" href="javascript:;">' + i + '</a></li>';
                }
            } else {
                if (_this.currentPage > 4) {
                    html += '<li class="page-item inactive"><a class="page-link" href="javascript:;">...</a></li>';
                    if (_this.currentPage > pages -4) {
                        for (var i = pages -4; i < pages; i++) {
                            active = '';
                            if (_this.currentPage === i) {
                                active = 'active';
                            }
                            html += '<li class="page-item ' + active + '"><a class="page-link unassign-page" href="javascript:;">' + i + '</a></li>';
                        }
                    } else {
                        html += '<li class="page-item"><a class="page-link unassign-page" href="javascript:;">' + (_this.currentPage-1) + '</a></li>'
                                + '<li class="page-item active"><a class="page-link unassign-page" href="javascript:;">' + _this.currentPage + '</a></li>'
                                + '<li class="page-item "><a class="page-link unassign-page" href="javascript:;">' + (_this.currentPage+1) + '</a></li>'
                                + '<li class="page-item inactive"><a class="page-link" href="javascript:;">...</a></li>';
                    }
                } else {
                    for (var i = 2; i < 6; i++) {
                        active = '';
                        if (_this.currentPage === i) {
                            active = 'active';
                        }
                        html += '<li class="page-item ' + active + '"><a class="page-link unassign-page" href="javascript:;">' + i + '</a></li>';
                    }
                    html += '<li class="page-item inactive"><a class="page-link" href="javascript:;">...</a></li>';
                }
            }

            active = '';
            inactive = '';
            if (_this.currentPage == pages) {
                active = 'active';
                inactive = 'inactive';
            }
            html += '<li class="page-item ' + active + '"><a class="page-link unassign-page" href="javascript:;">' + pages + '</a></li>'
                    + '<li class="page-item"><a class="page-link page-unassign-next" href="javascript:;">' + trans('next') + '</a></li>';
        }
        $('.pagination-unassign').html(html);
    }
};
$(document).ready(function () {
    // setTimeout(function () {
    loadPromise.then(function () {
        var url = document.location.pathname;
        var pages = ['job', 'manager', 'franchisee', 'department'];
        var BusinessItem;
        var method;
        var page;
        for (var i = 0; i < pages.length; i++) {
            page = pages[i];
            var m = explode(page, url);
            if (typeof m[1] !== 'undefined') {
                method = m;
                break;
            }
        }
        if (typeof method !== 'undefined') {
            window.businessItem = BusinessItem = new BusinessItems(page);
            BusinessItem.init();
            switch (method[1]) {
                case '/add':
                    app.scripts(BusinessItem, 'create');
                    app.scripts(BusinessItem, 'languageTabs');
                    break;
                case '/edit':
                    app.scripts(BusinessItem, 'getItem');
                    app.scripts(BusinessItem, 'languageTabs');
                    // app.scripts(BusinessItem.getItem);
                    break;
                case '/clone':
                    app.scripts(BusinessItem, 'clone');
                    // app.scripts(BusinessItem.clone);
                    break;
                default:
                    BusinessItem.perPage = 25;
                    BusinessItem.currentPage = 1;
                    // app.scripts(BusinessItem.getItems(undefined, true));
                    app.scripts(BusinessItem, 'getItems');
                    break;
            }
        }
    }).then(function () {
        app.runPromise();
    });
    // app.run();
    // }, 500);
});
