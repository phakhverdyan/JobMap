
function BusinessFunc() {

    this.form = null;
    this.form_type = null;
    this.event_type = null;
    this.manager_role = null;
    this.is_modal = false;
    this.id_locations = [];
    this.current_brand_id = 0;
    this.businessID = APIStorage.read('business-id');
    this.isMobile = false;
    this.business_table = null;
    this.business_table_id = null;
    this.location_table_id = null;
    this.location_table_desktop = null;
    this.button_create = null;
    this.redirect_url = null;
    this.current_language_prefix = null;
    this.current_edit_id = getUrlParameter('id');
    this.msLanguagesElement = null;
    this.msDepartmentsElement = null;
    this.msCertificatesElement = null;
    this.typeLocationTable = "assign";
    this.defaultLang = defaultLang;
    this.inputJob = {
        title: "",
        title_fr: "",
        description: "",
        description_fr: ""
    };

}

BusinessFunc.prototype = {
    init: function () {
        let _this = this;



        if(window.innerWidth <= 992){
            _this.isMobile = true;
        }

        $(window).resize( function () {
            if(window.innerWidth <= 992){
                _this.location_table_desktop.html("");
                _this.isMobile = true;

            }else{
                if(_this.isMobile === true){
                    _this.isMobile = false;
                    _this.business_table.draw();
                    _this.business_table_id.find("tbody tr td p.details-control").first().trigger("click");
                }
            }
        });

        if(_this.form !== null){
            _this.form.find('select[name="current_language_prefix"]').change(function() {
                var current_language_prefix = $(this).val();

                _this.form.find('input[name="name_fr"]').addClass("d-none");
                _this.form.find('input[name="name"]').addClass("d-none");
                if(current_language_prefix === "fr"){
                    _this.form.find('input[name="name_fr"]').removeClass("d-none");
                }else {
                    _this.form.find('input[name="name"]').removeClass("d-none");
                }

            });

            _this.form.on('click', 'input, select, textarea', function () {
                FormValidate.fieldValidateClear($(this));
            });
        }

        _this.businessTable();

        switch (_this.form_type) {
            case "manager-edit":
                _this.managerLoadAjax();
                _this.managerEditAjax();
                break;
            case  "manager-create":
                _this.managerGetSlots();
                _this.managerCreateAjax();
                break;
            case  "department-edit":
                //_this.departmentLoadAjax();
                //_this.departmentEditAjax();
                break;
            case  "department-create":
                //_this.departmentCreateAjax();
                break;
            case  "department-list-location-table":
            case  "job-list-location-table":
            case  "manager-list-location-table":
                _this.initManageListLocationTable();
                break;
            case  "job-create":
                _this.initJobEvent();
                _this.initJobSelected();
                _this.jobCreateAjax();
                break;
            case  "job-edit":
                _this.initJobEvent();
                _this.initJobSelected();
                _this.jobLoadAjax();
                _this.editJobAjax();
                break;
        }


        //_this.locationTable();

        _this.businessTableEvent();

        _this.searchTable();


    },
    searchTable: function(){
        let _this = this;
        $(document).find("#table-brand-location-search").on("keyup", function (event) {
            let keywords = $(this).val();
            $(document).find("#business-table_wrapper .dataTables_filter input").val(keywords).trigger("keyup");
            $(document).find("#location-table-desktop .dataTables_filter input").val(keywords).trigger("keyup");
            console.log(keywords);
        });
    },
    initManageListLocationTable: function(){
        let _this = this;
        $(document).on("click", "#business-"+_this.event_type+"-location-set-new", function (event) {
            event.preventDefault();
            _this.manageSetLocationAjax();
        });

        $(document).on("click", ".business-"+_this.event_type+"-assign-new", function (event) {
            event.preventDefault();
            _this.current_edit_id = $(this).attr("data-id");
            switch (_this.event_type) {
                case "department":
                    //_this.departmentLoadAjax();
                    break;
                case "job":
                    _this.jobLoadAjax();
                    break;
                case "manager":
                    _this.managerLoadAjax();
                    break;
            }
        });
    },
    businessTable: function(){
        let _this = this;

        $(document).on("business_table:draw", function (event) {
            if(_this.business_table !== null){
                _this.business_table.draw();
                event.preventDefault();
            }
        });

         _this.business_table = _this.business_table_id.DataTable({
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
            initComplete: function (settings, json) {
                if(_this.isMobile === false){
                   // _this.business_table_id.find("tbody tr td p.details-control").first().trigger("click");
                }
            },
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
    },
    businessTableEvent: function(){
        let _this = this;

        $(document).on("hide.bs.modal", "#ManaInLocModal", function () {
            _this.business_table_id.find('tbody tr.shown p.details-control').trigger('click');
        });

        _this.business_table_id.find('tbody').on('click', 'p.details-control', function (event) {
            event.preventDefault();
            let tr = $(this).closest('tr');
            let row = _this.business_table.row(tr);
            _this.current_brand_id = row.data().id;
            let tableId = 'location-' + _this.current_brand_id;

            let template_assign_button = '';
            if(_this.typeLocationTable === "assign"){
                template_assign_button = '<div class="col-md-6 col-lg-6 col-sm-6 button-assign-block">\n' +
                    '<button type="button" class="btn btn-success btn-block button-assign assign-current-brand" role="button">\n' +
                    '<i class="fas fa-check-square" aria-hidden="true"></i> '+ trans('assign_all') +'</button>\n' +
                    '<button type="button" class="btn btn-primary btn-block button-assign unassign-current-brand" role="button">\n' +
                    '<i class="fas fa-square" aria-hidden="true"></i> ' +trans('unassign_all')+'</button>\n' +
                    '</div>';
            }

            let template = '<div class="row">' +
                '<div class="col-md-6 col-lg-6 col-sm-6">' +
                '<h4 class="dataTable-header step-2" style="display: inline-block; padding-right: 25px;">'+ trans('header_step_selected_location')+'</h4>' +
                '</div>'+template_assign_button+'</div>' +

                '<table class="table details-table display responsive no-wrap" style="width: 100%;" id="'+tableId+'">\n' +
                '            <thead>\n' +
                '            <tr>\n' +
                '                <th>' +
                '</th>\n' +
                '            </tr>\n' +
                '            </thead>\n' +
                '        </table>';

            if(window.innerWidth <= 992){
                _this.isMobile = true;
            }else{
                _this.isMobile = false;
            }

            let _url = "/api/datatable/get-location-assign-by-business/"+_this.current_brand_id;
            if(_this.typeLocationTable !== "assign"){
                _url = "/api/datatable/get-location-by-business/"+_this.current_brand_id;//$(this).attr("data-business-id");
            }

            if(!_this.isMobile){
                _this.business_table_id.find("tr").removeClass('shown');
                for(let i = 0; i < _this.business_table.rows().count(); i++){
                    if (_this.business_table.row(i).child.isShown() && row.index() !== i){
                        _this.business_table.row(i).child.hide();
                    }
                }

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(template).show();
                    _this.locationTableNew(tableId, _url);
                    tr.addClass('shown');
                    tr.next().find('td').addClass('no-padding bg-gray child-table');
                }
            }else{
                _this.location_table_desktop.html(template);
                _this.locationTable(tableId, _url);
            }
        });
    },
    locationTableNew: function(tableId, _url){
        let _this = this;
        // let _url = "/api/datatable/get-location-assign-data";
        // if(_this.typeLocationTable !== "assign"){
        //     _url = "/api/datatable/get-location-data";
        // }
        _this.assignEvent();
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
                    _this.business_table_id.find('tbody tr.shown p.details-control').trigger('click');
                });

            },
            drawCallback: function(settings){

                if (this.api().page.info().pages <= 1) {
                    $(document).find('#' + settings.sTableId + '_paginate').hide();

                }else{
                    $(document).find('#' + settings.sTableId + '_paginate').show();
                }

                $(document).find('.location-item').prop('checked', false);
                if(_this.id_locations.length > 0){
                    $(_this.id_locations).each(function (index, value) {
                        $(document).find('.location-item[value='+value+']').prop('checked', true);
                    });
                }

                $(document).find(".location-item").on("click", function (event) {
                    let id_location = parseInt($(this).val());
                    if($(this).prop("checked") === true){
                        _this.id_locations.push(id_location);
                        _this.form.find("#assigned-locations").closest('.panel').removeClass("has-error-panel");
                        _this.form.find('#no_location_error_text').addClass('hide');
                    }else{
                        _this.id_locations.splice($.inArray(id_location ,_this.id_locations),1);
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
    locationTable: function(){
        let _this = this;
        let _url = "/api/datatable/get-location-assign-data";
        if(_this.typeLocationTable !== "assign"){
            _url = "/api/datatable/get-location-data";
        }
        _this.location_table = _this.location_table_id.DataTable({
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
            initComplete: function (settings, json) {},
            drawCallback: function(settings){
                if (this.api().page.info().pages <= 1) {
                    $(document).find('#' + settings.sTableId + '_paginate').hide();
                }else{
                    $(document).find('#' + settings.sTableId + '_paginate').show();
                }
                if(_this.id_locations.length > 0){
                    $(_this.id_locations).each(function (index, value) {
                        $(document).find('.location-item[value='+value+']').prop('checked', true);
                    });
                }
                $(document).find(".location-item").on("click", function (event) {
                    let id_location = parseInt($(this).val());
                    if($(this).prop("checked") === true){
                        _this.id_locations.push(id_location);
                    }else{
                        _this.id_locations.splice($.inArray(id_location ,_this.id_locations),1);
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
            "info": false
        });
    },
    assignEvent: function(){
        let _this = this;
        //let keyword = $(document).find("#table-brand-location-search").val();
        $(document).find(".assign-current-brand").on("click", function (event) {
            event.preventDefault();
            request({
                url: "/datatable/get-id-list-locations-assign",
                data: {
                    business_id: _this.current_brand_id,
                    //business_id: _this.businessID,
                    //keyword: keyword
                },
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    //_this.location_table_id.find('.location-item').prop('checked', true);
                    $(document).find('#location-' + _this.current_brand_id + ' .location-item').prop('checked', true);
                    $(response.data).each(function (index, value) {
                        _this.id_locations.push(value);
                    });
                }
            });
        });
        $(document).find(".unassign-current-brand").on("click", function (event) {
            event.preventDefault();
            request({
                url: "/datatable/get-id-list-locations-assign",
                data: {
                    business_id: _this.current_brand_id,
                    //business_id: _this.businessID,
                    //keyword: keyword
                },
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    $(document).find('#location-' + _this.current_brand_id + ' .location-item').prop('checked', false);
                    $(response.data).each(function (index, value) {
                        _this.id_locations.splice($.inArray(parseInt(value) ,_this.id_locations),1);
                    });
                }
            });
        });
    },
    managerGetSlots: function() {
        let _this = this;
        request({
            url: "/billing/get-empty-slots-for-manager",
            data: { business_id: _this.businessID },
        }, function (response) {
            if (response.error === undefined)
            {
                var paidSelector = document.getElementById('paid-plan');
                for (let [key, value] of Object.entries(response.packages)) {
                    var option = document.createElement("option");
                    option.setAttribute('value', JSON.stringify({ 
                        plan_id: value.plan_id,
                        pack_id: value.pack_id
                    })
                    );
                    option.innerHTML = value.descriptor + " " + value.pack_id + " (" +value.counted+ " available)" ;
                    paidSelector.appendChild(option);
                };
                for (let [key, value] of Object.entries(response.individual)) {
                    var option = document.createElement("option");
                    option.setAttribute('value', JSON.stringify({ 
                        plan_id: value.plan_id,
                        pack_id: value.pack_id || null
                    })
                    );
                    option.innerHTML = value.descriptor + " " + (value.pack_id || "") + " (" +value.counted+ " available)" ;
                    paidSelector.appendChild(option);
                };
            }
        });
    },
    managerCreateAjax: function(){
        let _this = this;
        _this.button_create.on('click', function () {
            let permits = [];
            $.each(_this.form.find('.manager__permit-item:checked'), function () {
                permits.push($(this).val());
            });

            let data = {
                business_id: _this.businessID,
                first_name: FormValidate.getFieldValue('first_name', _this.form),
                last_name: FormValidate.getFieldValue('last_name', _this.form),
                email: FormValidate.getFieldValue('email', _this.form),
                locations: _this.id_locations,
                permits: permits,
                role: _this.manager_role,
                paid_plan: $('#paid-plan').val()
            };

            request({
                url: "managers/create",
                data: data,
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    location.href = _this.redirect_url;
                }else {
                    FormValidate.fieldsValidate(response.validator, _this.form);
                }
            });
        });
    },
    managerLoadAjax: function () {
        let _this = this;
        let data = {
            id: _this.current_edit_id,
            business_id: _this.businessID,
        };

        request({
            url: "managers/"+_this.current_edit_id+"/get",
            data: data,
        }, function (response) {
            console.log(response);
            if(response.error === undefined ){
                if(_this.form !== null){
                    _this.form.find("[name=first_name]").val(response.data.manager.user.first_name).prop("disabled", true);
                    _this.form.find("[name=last_name]").val(response.data.manager.user.last_name).prop("disabled", true);
                    _this.form.find("[name=email]").val(response.data.manager.user.email).prop("disabled", true);
                    if(_this.is_modal) {
                        _this.form.find("[name=role]").val(response.data.manager.role);
                        _this.form.find("[name=first_name]").prop("disabled", false);
                        _this.form.find("[name=last_name]").prop("disabled", false);
                        _this.form.find("[name=email]").prop("disabled", false);
                    }
                    $.each(_this.form.find('.manager__permit-item'), function () {
                        let elemPermit = $(this);
                        let permitId = parseInt(elemPermit.val());
                        response.data.manager.permits.forEach(function(item, i, arr) {
                            if (item.id === permitId && item.pivot.value === 1) {
                                elemPermit.prop('checked', true);
                            }
                        });
                    });
                }
                _this.id_locations = [];
                $.each(response.data.locations, function (index, value) {
                    _this.id_locations.push(value.location_id);
                    if(_this.is_modal)
                    {
                        $(document).find('#location-' + _this.current_brand_id + ' .location-item[value='+value.location_id+']').prop('checked', true);
                    }
                });
            }
        });
    },
    managerEditAjax: function () {
        let _this = this;
        _this.button_create.on('click', function () {
            let permits = [];
            $.each(_this.form.find('.manager__permit-item:checked'), function () {
                permits.push($(this).val());
            });
            let data;
            if(_this.is_modal) {
                data = {
                    business_id: _this.businessID,
                    id: _this.current_edit_id,
                    first_name: FormValidate.getFieldValue('first_name', _this.form),
                    last_name: FormValidate.getFieldValue('last_name', _this.form),
                    email: FormValidate.getFieldValue('email', _this.form),
                    role: FormValidate.getFieldValue('role', _this.form),
                    locations: _this.id_locations,
                    permits: permits
                };
            }
            else {
                data = {
                    business_id: _this.businessID,
                    id: _this.current_edit_id,
                    first_name: FormValidate.getFieldValue('first_name', _this.form),
                    last_name: FormValidate.getFieldValue('last_name', _this.form),
                    email: FormValidate.getFieldValue('email', _this.form),
                    role: _this.manager_role,
                    locations: _this.id_locations,
                    permits: permits
                };
            }

            request({
                url: "managers/"+_this.current_edit_id+"/update",
                data: data,
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    if(_this.is_modal)
                    {
                        _this.modal_callback();
                    }
                    else {
                        location.href = _this.redirect_url;
                    }
                    
                }else {
                    FormValidate.fieldsValidate(response.validator, _this.form);
                }
            });
        });
    },
    departmentCreateAjax: function () {
        let _this = this;
        _this.button_create.on('click', function () {
            let data = {
                business_id: _this.businessID,
                name: FormValidate.getFieldValue('name', _this.form),
                name_fr: FormValidate.getFieldValue('name_fr', _this.form),
                status: _this.form.find('.business-department-status.active').attr('data-status'),
                locations: _this.id_locations
            };
            request({
                url: "departments/create",
                data: data,
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    location.href = _this.redirect_url;
                }else {
                    FormValidate.fieldsValidate(response.validator,_this.form);
                }
            });
        });
    },
    departmentLoadAjax: function () {
        let _this = this;
        let data = {
            id: _this.current_edit_id,
            business_id: _this.businessID,
        };

        request({
            url: "departments/"+_this.current_edit_id+"/get",
            data: data,
        }, function (response) {
            console.log(response);
            if(response.error === undefined ){
                if(_this.form !== null){
                    _this.form.find("[name=name]").val(response.data.department.name).prop("disabled", true);
                    _this.form.find("[name=name_fr]").val(response.data.department.name_fr).prop("disabled", true);
                    _this.form.find('.business-department-status[data-status="' + response.data.department.status + '"]').addClass('active');
                }
                _this.id_locations = [];
                $.each(response.data.locations, function (index, value) {
                    _this.id_locations.push(value.location_id);
                    //$(document).find('#location-' + _this.current_brand_id + ' .location-item[value='+value.location_id+']').prop('checked', true);
                });
            }
        });
    },
    departmentEditAjax: function () {
        let _this = this;
        _this.button_create.on('click', function () {
            let data = {
                business_id: _this.businessID,
                id: _this.current_edit_id,
                name: FormValidate.getFieldValue('name', _this.form),
                name_fr: FormValidate.getFieldValue('name_fr', _this.form),
                status: _this.form.find('.business-department-status.active').attr('data-status'),
                locations: _this.id_locations
            };
            request({
                url: "departments/"+_this.current_edit_id+"/update",
                data: data,
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    location.href = _this.redirect_url;
                }else {
                    FormValidate.fieldsValidate(response.validator,_this.form);
                }
            });
        });
    },
    manageSetLocationAjax: function () {
        let _this = this;
        let data = {
            business_id: _this.businessID,
            id: _this.current_edit_id,
            locations: _this.id_locations
        };
        request({
            url: _this.event_type+"s/"+_this.current_edit_id+"/set-locations",
            data: data,
        }, function (response) {
            console.log(response);
            if(response.error === undefined ){
                $(document).find("#ManaInLocModal").modal("hide");
                $(document).trigger("business:job:items:table:draw");
            }
        });
    },
    updateInputJob: function(){
        let _this = this;

        // if(_this.current_language_prefix === "en"){
        //     _this.inputJob.title = _this.form.find("[name=title]").val();
        //     _this.inputJob.description = _this.form.find("[name=description]").val();
        //     _this.form.find("[name=title]").val(_this.inputJob.title_fr);
        //     _this.form.find("[name=description]").val(_this.inputJob.description_fr);
        // }
        // if(_this.current_language_prefix === "fr"){
        //     _this.inputJob.title_fr = _this.form.find("[name=title]").val();
        //     _this.inputJob.description_fr = _this.form.find("[name=description]").val();
        //     _this.form.find("[name=title]").val(_this.inputJob.title);
        //     _this.form.find("[name=description]").val(_this.inputJob.description);
        // }

    },
    initJobSelected: function(){
        let _this = this;
        _this.msLanguagesElement = $(document).find("#select-languages");
        //_this.msDepartmentsElement = $(document).find("#select-departments");
        //_this.msCertificatesElement = $(document).find("#select-certificates");

        _this.msLanguagesElement.selectElement({
            url: '/api/datatable/get-selected-list',
            placeholder: trans('ex_languages'),
            current_language_prefix: _this.current_language_prefix,
            query_type: "WorldLanguage",
            sub: 1,
        });

        // _this.msDepartmentsElement.selectElement({
        //     url: '/api/datatable/get-selected-list',
        //     placeholder: trans('choose_departments'),
        //     current_language_prefix: _this.current_language_prefix,
        //     query_type: "Department",
        //     sub: 1,
        //     business_id: _this.businessID
        // });

        // _this.msCertificatesElement.selectElement({
        //     url: '/api/datatable/get-selected-list',
        //     placeholder: trans('type_certificate'),
        //     current_language_prefix: _this.current_language_prefix,
        //     query_type: "Certificate"
        // });
    },
    initJobEvent: function(){
        let _this = this;

        // _this.current_language_prefix = _this.form.find("[name=current_language_prefix]").val();
        //
        if(_this.current_language_prefix === ""){
            _this.current_language_prefix = "en";
        }

        // _this.form.find('.multilanguage').parent().find('label:first').each(function() {
        //     $(this).html($(this).html() + ' (' + _this.current_language_prefix + ')');
        // });
        //
        // _this.form.find("[name=current_language_prefix]").change(function (event) {
        //     _this.updateInputJob();
        //     _this.current_language_prefix = $(this).val();
        //     _this.form.find('.multilanguage').parent().find('label:first').each(function() {
        //         $(this).html($(this).html().split(/\(/).slice(0, -1).join('(') + ' (' + _this.current_language_prefix + ')');
        //     });
        //
        //     _this.msCertificatesElement.trigger("update", _this.current_language_prefix);
        // });

        _this.form.on( "click", "[data-language-prefix]", function () {
            _this.current_language_prefix = $(this).attr("data-language-prefix");
        });

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
    },
    jobCreateAjax: function () {
        let _this = this;
        _this.button_create.on("click", function (event) {
            event.preventDefault();

            let timeArray1 = [];
            let timeArray2 = [];
            let timeArray3 = [];
            let timeArray4 = [];

            _this.form.find("input:checkbox[name=time_1]:checked").each(function () {
                timeArray1.push($(this).val());
            });
            _this.form.find("input:checkbox[name=time_2]:checked").each(function () {
                timeArray2.push($(this).val());
            });
            _this.form.find("input:checkbox[name=time_3]:checked").each(function () {
                timeArray3.push($(this).val());
            });
            _this.form.find("input:checkbox[name=time_4]:checked").each(function () {
                timeArray4.push($(this).val());
            });

            let data = {
                business_id: _this.businessID,
                title_en: _this.form.find("[name=title_en]").val(),
                title_fr: _this.form.find("[name=title_fr]").val(),
                description_en: _this.form.find("[name=description_en]").val(),
                description_fr: _this.form.find("[name=description_fr]").val(),
                salary: _this.form.find("[name=salary]").val(),
                salary_type: _this.form.find("[name=salary_type]").val(),
                hours: _this.form.find("[name=hours]").val(),
                type_key: _this.form.find("[name=type_key]").val(),
                //departments_id: _this.msDepartmentsElement.val(),
                languages_id: _this.msLanguagesElement.val(),
                //certificates_id: _this.msCertificatesElement.val(),
                certificate_name: _this.form.find("[name=certificate_name]").val(),
                time_1: timeArray1,
                time_2: timeArray2,
                time_3: timeArray3,
                time_4: timeArray4,
                locations_id: _this.id_locations
            };
            if(data.locations_id.length == 0) {
                _this.form.find('#no_location_error_text').removeClass('hide');
                $([document.documentElement, document.body]).animate({
                    scrollTop: _this.form.find("#assigned-locations").closest('.panel').addClass("has-error-panel").offset().top - 100
                }, 500);
                return false;
            }

            if(data.title_en === "" && data.title_fr === ""){
                if(data.title_en === ""){
                    $([document.documentElement, document.body]).animate({
                        scrollTop: _this.form.find("[name=title_en]").parent().addClass("has-error").offset().top - 100
                    }, 500);
                    return false;
                }else if(data.title_fr === ""){
                    $([document.documentElement, document.body]).animate({
                        scrollTop: _this.form.find("[name=title_fr]").parent().addClass("has-error").offset().top - 100
                    }, 500);
                    return false;
                }
            }

            if(data.description_en === "" && data.description_fr === ""){
                if(data.description_en === ""){
                    $([document.documentElement, document.body]).animate({
                        scrollTop: _this.form.find("#cke_job-description-en").css({"border-color": "#ff0000"}).offset().top - 100
                    }, 500);
                    return false;
                }else if(data.description_fr === ""){
                    $([document.documentElement, document.body]).animate({
                        scrollTop: _this.form.find("#cke_job-description-fr").css({"border-color": "#ff0000"}).offset().top - 100
                    }, 500);
                    return false;
                }
            }

            let formData = new FormData();
            $.each(data, function (key, value) {
                formData.append(key, value);
            });

            $.ajaxSetup({
                contentType: false,
                processData: false,
            });

            request({
                url: "jobs/create",
                data: formData,
                method: 'POST',
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    location.href = _this.redirect_url;
                }
            });
        });
    },
    jobLoadAjax: function () {
        let _this = this;

        request({
            url: "jobs/"+_this.current_edit_id+"/get",
            data: {
                id: _this.current_edit_id,
                business_id: _this.businessID,
            },
        }, function (response) {
            if(_this.form !== null) {
                _this.form.find("[name=title_en]").val(response.data.job.title);
                _this.form.find("[name=title_fr]").val(response.data.job.title_fr);
                _this.form.find("[name=description_en]").val(response.data.job.description);
                _this.form.find("[name=description_fr]").val(response.data.job.description_fr);
                _this.form.find("[name=salary]").val(response.data.job.salary);
                _this.form.find("[name=salary_type]").val(response.data.job.salary_type);
                _this.form.find("[name=hours]").val(response.data.job.hours);
                _this.form.find("[name=type_key]").val(response.data.job.type_key);
                _this.form.find("[name=certificate_name]").val(response.data.job.certificate_name);

                // $.each(response.data.departments, function (index, value) {
                //     let newOption = new Option(value.name, value.id, true, true);
                //     _this.msDepartmentsElement.append(newOption);
                // });
                // _this.msDepartmentsElement.trigger('change');

                //console.log(response.data.languages);
                $.each(response.data.languages, function (index, value) {
                    let newOption = new Option(value.name, value.id, true, true);
                    _this.msLanguagesElement.append(newOption);
                });
                _this.msLanguagesElement.trigger('change');

                // $.each(response.data.certificates, function (index, value) {
                //     let newOption = new Option(value.name, value.id, true, true);
                //     _this.msCertificatesElement.append(newOption);
                // });
                // _this.msCertificatesElement.trigger('change');

                for (let t = 1; t <= 4; t += 1) {
                    if (response.data.job["time_" + t] !== null) {
                        let time = response.data.job["time_" + t].split(",");
                        let i = 1;
                        $.each(time, function (k, v) {
                            _this.form.find('input[name="time_' + t + '"][value="' + v + '"]').prop('checked', true);
                            i += 1;
                        });
                        if (time.length === 7) {
                            _this.form.find('input[data-time="' + (t - 1) + '"]').prop('checked', true);
                        }
                    }
                }
            }
            _this.id_locations = [];
            $.each(response.data.locations, function (index, value) {
                _this.id_locations.push(value.location_id);
                //$(document).find('#location-' + _this.current_brand_id + ' .location-item[value='+value.location_id+']').prop('checked', true);
            });
        });
    },
    editJobAjax: function () {
        let _this = this;
        _this.button_create.on("click", function (event) {
            event.preventDefault();

            let timeArray1 = [];
            let timeArray2 = [];
            let timeArray3 = [];
            let timeArray4 = [];
            _this.form.find("input:checkbox[name=time_1]:checked").each(function () {
                timeArray1.push($(this).val());
            });
            _this.form.find("input:checkbox[name=time_2]:checked").each(function () {
                timeArray2.push($(this).val());
            });
            _this.form.find("input:checkbox[name=time_3]:checked").each(function () {
                timeArray3.push($(this).val());
            });
            _this.form.find("input:checkbox[name=time_4]:checked").each(function () {
                timeArray4.push($(this).val());
            });

            let data = {
                id: _this.current_edit_id,
                business_id: _this.businessID,
                title_en: _this.form.find("[name=title_en]").val(),
                title_fr: _this.form.find("[name=title_fr]").val(),
                description_en: _this.form.find("[name=description_en]").val(),
                description_fr: _this.form.find("[name=description_fr]").val(),
                salary: _this.form.find("[name=salary]").val(),
                salary_type: _this.form.find("[name=salary_type]").val(),
                hours: _this.form.find("[name=hours]").val(),
                type_key: _this.form.find("[name=type_key]").val(),
                //departments_id: _this.msDepartmentsElement.val(),
                languages_id: _this.msLanguagesElement.val(),
                //certificates_id: _this.msCertificatesElement.val(),
                certificate_name: _this.form.find("[name=certificate_name]").val(),
                time_1: timeArray1,
                time_2: timeArray2,
                time_3: timeArray3,
                time_4: timeArray4,
                locations_id: _this.id_locations
            };

            if(data.locations_id.length == 0) {
                _this.form.find('#no_location_error_text').removeClass('hide');
                $([document.documentElement, document.body]).animate({
                    scrollTop: _this.form.find("#assigned-locations").closest('.panel').addClass("has-error-panel").offset().top - 100
                }, 500);
                return false;
            }

            if(data.title_en === "" && data.title_fr === ""){
                if(data.title_en === ""){
                    $([document.documentElement, document.body]).animate({
                        scrollTop: _this.form.find("[name=title_en]").parent().addClass("has-error").offset().top - 100
                    }, 500);
                    return false;
                }else if(data.title_fr === ""){
                    $([document.documentElement, document.body]).animate({
                        scrollTop: _this.form.find("[name=title_fr]").parent().addClass("has-error").offset().top - 100
                    }, 500);
                    return false;
                }
            }

            if(data.description_en === "" && data.description_fr === ""){
                if(data.description_en === ""){
                    $([document.documentElement, document.body]).animate({
                        scrollTop: _this.form.find("#cke_job-description-en").css({"border-color": "#ff0000"}).offset().top - 100
                    }, 500);
                    return false;
                }else if(data.description_fr === ""){
                    $([document.documentElement, document.body]).animate({
                        scrollTop: _this.form.find("#cke_job-description-fr").css({"border-color": "#ff0000"}).offset().top - 100
                    }, 500);
                    return false;
                }
            }

            let formData = new FormData();
            $.each(data, function (key, value) {
                formData.append(key, value);
            });

            $.ajaxSetup({
                contentType: false,
                processData: false,
            });

            request({
                url: "jobs/update",
                data: formData,
                method: 'POST',
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    location.href = _this.redirect_url;
                }
            });
        });
    },
};

$.fn.selectElement = function (options) {
    options = options || {};

    this.on("update", function (event, data) {
        options.current_language_prefix = data;
    });

    return $(this).select2({
        ajax: {
            url: options.url,
            headers: {
                'Authorization': 'Basic ' + window.auth.user.api_token
            },
            dataType: 'json',
            delay: 250,
            data: function (params) {
                options.keywords = params.term;
                options.page = params.page;
                return options;
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data.data.items,
                    pagination: {
                        more: (params.page * 20) < data.data.total_count
                    }
                };
            },
            cache: true
        },
        placeholder: options.placeholder,
        allowClear: true,
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 0,
        templateResult: function (repo) {
            if (repo.loading) {
                return repo.text;
            }
            if(options.current_language_prefix === "fr"){
                return "<option value='"+repo.id+"'>"+repo.name_fr+"</option>";
            }
            return "<option value='"+repo.id+"'>"+repo.name+"</option>";
        },
        templateSelection: function (repo) {
            if(options.current_language_prefix === "fr"){
                return repo.name_fr || repo.text;
            }
            return repo.name || repo.text;
        }
    });
};