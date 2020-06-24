function BusinessJobItems() {

    this.current_job_id = 0;
    this.jobStatus = 0;
    this.businessID = APIStorage.read('business-id');
    this.dataTableListJobsId = $(document).find("#datatable-list-jobs");
    this.dataTableFilterLocationId = $(document).find("#filter-location-table");
    this.dataTableFilterLocation = null;
    this.filterLocationIds = [];
    this.dataTableListJobs = null;
    this.dataTableListJobsSortName = "title";
    this.dataTableListJobsSort = "asc";
    this.job_search_keywords = "";
    this.dataEvent = {
        event: "",
        business_id: 0,
        job_id: 0,
        location_job_id: 0,
        is_checked: 0
    };


    this.current_brand_id = 0;
    this.location_table = null;

}

BusinessJobItems.prototype = {
    init: function () {
        let _this = this;

        _this.initDataTableListJobs();
        _this.initEvents();

    },

    initEvents: function () {
        let _this = this;

        $(document).on("get:opened:closed:location", function (event) {
            event.preventDefault();
            console.log("Event - get:opened:closed:location");
            request({
                url: "/jobs/get-opened-closed-location",
                data: {
                    business_id: _this.businessID,
                    job_id: _this.current_job_id
                },
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    _this.jobStatus = response.data.job_status;
                    $(document).find('#OpenClosedModal .open-item').remove();
                    $(document).find('#OpenClosedModal .close-item').remove();
                    $(document).find('#jobs-open-close-title').find('span:first').text(response.data.opened_count);
                    $(document).find('#jobs-open-close-title').find('span:last').text(response.data.closed_count);
                    $(document).find('#OpenClosedModal .open-header').after(response.data.opened_html);
                    $(document).find('#OpenClosedModal .close-header').after(response.data.closed_html);
                }
            });
        });

        $(document).on("event:opened:closed:location", function (event) {
            event.preventDefault();
            console.log("Event - event:opened:closed:location");

            console.log(_this.dataEvent);

            request({
                url: "/jobs/event-opened-closed-location",
                data: _this.dataEvent,
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                     $(document).trigger("get:opened:closed:location");
                }
            });

        });

        $(document).on("click", "#open-all", function (event) {
            //event.preventDefault();
            console.log("Event - open-all");
            _this.dataEvent.event = "open:all";
            _this.dataEvent.business_id = _this.businessID;
            _this.dataEvent.job_id = _this.current_job_id;
            $(document).trigger("event:opened:closed:location");
        });

        $(document).on("click", "#close-all", function (event) {
            //event.preventDefault();
            console.log("Event - close-all");
            _this.dataEvent.event = "close:all";
            _this.dataEvent.business_id = _this.businessID;
            _this.dataEvent.job_id = _this.current_job_id;
            $(document).trigger("event:opened:closed:location");
        });

        $(document).on("click", ".close-item .item-checkbox", function (event) {
            //
            console.log("Event - close-item:item-checkbox");
            _this.dataEvent.event = "close:item";
            _this.dataEvent.business_id = _this.businessID;
            _this.dataEvent.job_id = _this.current_job_id;
            _this.dataEvent.location_job_id = $(this).val();
            _this.dataEvent.is_checked = $(this).prop('checked') ? 1 : 0;
            //event.preventDefault();
            $(document).trigger("event:opened:closed:location");
        });

        $(document).on("click", ".open-item .item-checkbox", function (event) {
            //
            console.log("Event - open-item:item-checkbox");

            _this.dataEvent.event = "open:item";
            _this.dataEvent.business_id = _this.businessID;
            _this.dataEvent.job_id = _this.current_job_id;
            _this.dataEvent.location_job_id = $(this).val();
            _this.dataEvent.is_checked = $(this).prop('checked') ? 1 : 0;
            //event.preventDefault();
            $(document).trigger("event:opened:closed:location");
        });

        $(document).on("click", ".job-status-change", function (event) {
            console.log("Event - job-status-change");
            _this.current_job_id = $(this).attr('data-id');
            _this.jobStatus = ($(this).prop('checked')) ? 1 : 0;
            if (_this.jobStatus === 1) {
                $(document).find('.job-status-change[data-id="' + _this.current_job_id + '"]').prop('checked', true);
            } else {
                $(document).find('.job-status-change[data-id="' + _this.current_job_id + '"]').prop('checked', false);
            }

            $(document).trigger("get:opened:closed:location");

            $(document).find('#OpenClosedModal').modal('show');

        });

        $(document).on("hidden.bs.modal", "#OpenClosedModal", function () {
            console.log("Event - hidden.bs.modal - OpenClosedModal");
            if (_this.jobStatus === 1) {
                $(document).find('.job-status-change[data-id="' + _this.current_job_id + '"]').prop('checked', true);
            } else {
                $(document).find('.job-status-change[data-id="' + _this.current_job_id + '"]').prop('checked', false);
            }
        });

        $(document).on("click", ".business-job-delete", function (event) {
            _this.current_job_id = $(this).attr("data-id");
        });

        $(document).on("click", "#business-job-confirm-delete", function (event) {
            console.log("Event - delete job");
            request({
                url: "/jobs/delete",
                data: {
                    business_id: _this.businessID,
                    job_id: _this.current_job_id
                },
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    $(document).find("#deleteModal").modal("hide");
                    $(document).trigger("business:job:items:table:draw");
                }
            });
        });

        $(document).on("change", "#business-job-limit", function (event) {
            console.log("Event - business-job-limit");
            let _limit = $(this).val();
            console.log(_limit);
            _this.dataTableListJobs.page.len(_limit).draw();
            event.preventDefault();
        });

        $(document).on("change", "#business-job-sort", function (event) {
            console.log("Event - business-job-sort");
            _this.dataTableListJobsSortName = $(this).val();
            _this.dataTableListJobsSort = $(this).find("option:selected").attr("data-order");
            console.log(_this.dataTableListJobsSortName);
            console.log(_this.dataTableListJobsSort);
            $(document).trigger("business:job:items:table:draw");
            event.preventDefault();
        });

        $(document).on('keyup', "#business-job-search", function (event) {
            if (event.which <= 90 && event.which >= 48 || event.which === 13 || event.which === 8) {
                _this.job_search_keywords = $(this).val().trim();
                setTimeout(function() {
                    $(document).trigger("business:job:items:table:draw");
                }, 100);
            }
        });

        $(document).on("click", "#set-filters", function () {
            console.log(_this.filterLocationIds);
            $(document).find("#jobfiltermodal").modal("hide");
            $(document).trigger("business:job:items:table:draw");
        });

        $(document).on("click", "#clear-filters", function () {
            _this.filterLocationIds = [];
            $(document).find("#jobfiltermodal").modal("hide");
            $(document).trigger("business:job:items:table:draw");
        });

        $(document).on("show.bs.modal", "#jobfiltermodal", function () {
            if(_this.dataTableFilterLocation === null){
                _this.initDataTableFilterLocation();
            }
        });
    },

    initDataTableFilterLocation: function () {
        let _this = this;

        $(document).on("business:jobs:filter:location:datatable:draw", function (event) {
            if(_this.dataTableFilterLocation !== null){
                _this.dataTableFilterLocation.draw();
                event.preventDefault();
            }
        });

        _this.dataTableFilterLocation =_this.dataTableFilterLocationId.DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "/api/datatable/get-business-data",
                data: {
                    business_id: _this.businessID,
                    language_prefix: defaultLang
                },
                headers: {
                    'Authorization': 'Basic ' + window.auth.user.api_token
                }
            },
            columns: [
                {data: 'name', name: 'name' }
            ],
            initComplete: function (settings, json) { },
            drawCallback: function(settings){
                if (this.api().page.info().pages <= 1) {
                    $('#' + settings.sTableId + '_paginate').hide();
                }else{
                    $('#' + settings.sTableId + '_paginate').show();
                }
            },
            language: {
                searchPlaceholder: "Find brands",
                sSearch: "",
                oPaginate: {
                    sPrevious: " ",
                    sNext: " ",
                },
                processing: '<i class="fa fa-circle-o-notch fa-spin  fa-3x fa-fw"></i><span class="sr-only">Loading..n.</span>'
            },
            dom:"<'row'<'col-sm-12 col-md-6'f><'col-sm-12 col-md-6'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "info": false,
            "sort": false
        });

        $(document).on("hide.bs.modal", "#jobfiltermodal", function () {
            _this.dataTableFilterLocationId.find('tbody tr.shown p.details-control').trigger('click');
        });

        _this.dataTableFilterLocationId.find('tbody').on('click', 'p.details-control', function (event) {
            event.preventDefault();
            let tr = $(this).closest('tr');
            let row = _this.dataTableFilterLocation.row(tr);
            _this.current_brand_id = row.data().id;
            let tableId = 'location-' + _this.current_brand_id;

            let template = '<div class="row">' +
                '<div class="col-md-12 col-lg-12 col-sm-12">' +
                '<h4 class="dataTable-header step-2" style="display: inline-block; padding-right: 25px;">'+ trans('header_step_selected_location')+'</h4>' +
                '</div></div>' +
                '<table class="table details-table display responsive no-wrap" style="width: 100%;" id="'+tableId+'">\n' +
                '            <thead>\n' +
                '            <tr>\n' +
                '                <th>' +
                '</th>\n' +
                '            </tr>\n' +
                '            </thead>\n' +
                '        </table>';

            let _url = "/api/datatable/get-location-assign-by-business/"+_this.current_brand_id;

            _this.dataTableFilterLocationId.find("tr").removeClass('shown');
            for(let i = 0; i < _this.dataTableFilterLocation.rows().count(); i++){
                if (_this.dataTableFilterLocation.row(i).child.isShown() && row.index() !== i){
                    _this.dataTableFilterLocation.row(i).child.hide();
                }
            }

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(template).show();
                _this.locationTable(tableId, _url);
                tr.addClass('shown');
                tr.next().find('td').addClass('no-padding bg-gray child-table');
            }
        });

    },

    locationTable: function(tableId, _url){
        let _this = this;

        //_this.assignEvent();
        _this.location_table = $(document).find("#"+tableId).DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: _url,
                data: {
                    business_id: _this.businessID,
                    language_prefix: defaultLang
                },
                headers: {
                    'Authorization': 'Basic ' + window.auth.user.api_token
                }
            },
            columns: [
                { data: 'name', name: 'name' }
            ],
            initComplete: function (settings, json) {
                //$(document).find('#' + settings.sTableId + '_wrapper .dataTables_length label select').before("<span class='"+ settings.sTableId +"-close button-close'>Close</span>");
                $(document).find('.dataTable-header.step-2').after("<span class='"+ settings.sTableId +"-close button-close'><span class='button-symbol-close'>×</span>Hide Locations</span>");
                $(document).find("."+ settings.sTableId +"-close").on("click", function (event) {
                    _this.dataTableFilterLocationId.find('tbody tr.shown p.details-control').trigger('click');
                });

            },
            drawCallback: function(settings){

                if (this.api().page.info().pages <= 1) {
                    $(document).find('#' + settings.sTableId + '_paginate').hide();

                }else{
                    $(document).find('#' + settings.sTableId + '_paginate').show();
                }

                $(document).find('.location-item').prop('checked', false);
                if(_this.filterLocationIds.length > 0){
                    $(_this.filterLocationIds).each(function (index, value) {
                        $(document).find('.location-item[value='+value+']').prop('checked', true);
                    });
                }

                $(document).find(".location-item").on("click", function (event) {
                    let id_location = parseInt($(this).val());
                    if($(this).prop("checked") === true){
                        _this.filterLocationIds.push(id_location);
                    }else{
                        _this.filterLocationIds.splice($.inArray(id_location ,_this.filterLocationIds),1);
                    }
                });
            },
            language: {
                searchPlaceholder: "Find locations",
                sSearch: "",
                oPaginate: {
                    sPrevious: " ",
                    sNext: " ",
                },
                processing: '<i class="fa fa-circle-o-notch fa-spin  fa-3x fa-fw"></i><span class="sr-only">Loading..n.</span>'
            },
            dom:"<'row'<'col-sm-12 col-md-6'f><'col-sm-12 col-md-6'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "info": false,
            "sort": false
        });
    },

    initDataTableListJobs: function () {
        let _this = this;

        $(document).on("business:job:items:table:draw", function (event) {
            if(_this.dataTableListJobs !== null){
                _this.dataTableListJobs.draw();
                event.preventDefault();
            }
        });

        let _not_jobs_text = "Not Jobs Yet!";
        if(defaultLang !== "en"){
            _not_jobs_text = "Aucun Emplois!";
        }

        _this.dataTableListJobs = _this.dataTableListJobsId.DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "/api/jobs/get-business-data-table-jobs",
                data: function (data) {
                    data.business_id = _this.businessID;
                    data.sort_name = _this.dataTableListJobsSortName;
                    data.sort = _this.dataTableListJobsSort;
                    data.language_prefix = defaultLang;
                    data.keywords = _this.job_search_keywords;
                    data.filter_by_location = _this.filterLocationIds;
                    console.log(data);
                },
                headers: {
                    'Authorization': 'Basic ' + window.auth.user.api_token
                }
            },
            columns: [
                {data: 'name', name: 'name' }
            ],
            initComplete: function (settings, json) {

            },
            drawCallback: function(settings){
                if (this.api().page.info().pages <= 1) {
                    $('#' + settings.sTableId + '_paginate').hide();
                }else{
                    $('#' + settings.sTableId + '_paginate').show();
                }

            },
            language: {
                searchPlaceholder: "",
                sSearch: "",
                sEmptyTable: _not_jobs_text,
                oPaginate: {
                    sPrevious: " ",
                    sNext: " ",
                },
                processing: '<i class="fa fa-circle-o-notch fa-spin  fa-3x fa-fw"></i><span class="sr-only">Loading..n.</span>'
            },
            dom:"<'row'<'col-sm-12 col-md-6'f><'col-sm-12 col-md-6'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "info": false,
            "sort": false,
            "searching": false,
            "pageLength": 25,
            "lengthChange": false
        });
    }
};


jQuery(document).ready(function ($) {
    let $BusinessJobItems = new BusinessJobItems();
    $BusinessJobItems.init();
});