'use strict';

function BusinessNewApplicants() {

    this.requests = [];
    this.locale = APIStorage.read('language');
    this.current_pipeline = "new";
    this.only_waves = 0;

    this.candidate_keywords = "";
    this.candidate_sort = "updated_date_desc";

    this.businessID = APIStorage.read('business-id');
    this.brand_id = 0;
    this.pipeline_button_block = $(document).find('#pipeline-buttons');
    this.candidate_edit_select_pipeline_block = $(document).find('#candidate_edit-select-pipeline');
    this.candidate_add_select_pipeline_block = $(document).find('#candidate_add-select-pipeline');
    this.business_candidate_list_table_id = $(document).find('#business-candidate-list-table');
    this.business_candidate_list_table = null;
    this.candidate_add_jobs = null;
    this.candidate_add_job_location = {};
    this.candidate_edit_job_location = {};

    this.dataTableFilterLocationId = $(document).find("#filter-location-table");
    this.dataTableFilterLocation = null;

    this.filterLocationIds = [];

    this.switch_brand_select = $(document).find("[name=switch-brand]");

    this.chatID = null;
    this.chatRoom = null;
}

BusinessNewApplicants.prototype = {
    init: function () {
        let _this = this;

        _this.initSwitchBrand();

        _this.initPipeline();

        _this.initCandidateTable();

        _this.initCountOnlyWaves();

        _this.initCandidateEvent();

    },

    initSwitchBrand: function(){
        let _this = this;
        let _data = {
            business_id: _this.businessID
        };
        $.ajaxSetup({
            processData: true,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        });
        request({
            url: "/candidate/brand/get",
            data: _data,
            method: "GET"
        }, function (response) {
            console.log(response);
            if(response.error === undefined ){

                let _options_html = "";
                let _main = "(Main business)";
                $.each(response.data.items, function () {
                    let _name = this.name;
                    if(_this.locale !== "en"){
                        _name = this.name_fr?this.name_fr:this.name;
                    }

                    if(this.id === parseInt(_this.businessID)){
                        _options_html += '<option value="'+this.id+'" selected>'+_name+" "+_main+' ('+this.candidate_count+')</option>';
                    }else {
                        _options_html += '<option value="'+this.id+'">'+_name+' ('+this.candidate_count+')</option>';
                    }
                });

                _this.switch_brand_select.html(_options_html);
            }
        });
        _this.switch_brand_select.on('change', function () {
            _this.brand_id = $(this).val();
            console.log("Event - change - switch_brand_select");
            console.log(_this.brand_id);

            _this.candidate_keywords = "";

            _this.filterLocationIds = [];

            _this.initPipeline();

            $(document).trigger("business_candidate_list_table:draw");

        });
    },

    initCountOnlyWaves: function(){
        let _this = this;
        $(document).find("#business-wave-candidate-count").html(0);
        let _data = {
            business_id: _this.businessID,
            brand_id: _this.brand_id,
            pipeline: _this.current_pipeline
        };

        $.ajaxSetup({
            processData: true,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        });

        request({
            url: "/candidate/get-count-only-waves",
            data: _data,
        }, function (response) {
            console.log(response);
            if(response.error === undefined ){
                $(document).find("#business-wave-candidate-count").html(response.data.wave_count);
            }
        });
    },

    initPipeline: function () {
        let _this = this;
        let _data = {
            business_id: _this.businessID,
            brand_id: _this.brand_id,
            keywords: _this.candidate_keywords,
            filter_by_location: _this.filterLocationIds,
        };

        $.ajaxSetup({
            processData: true,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        });

        request({
            url: "/candidate/pipeline/get",
            data: _data,
            method: "GET"
        }, function (response) {
            console.log(response);
            if(response.error === undefined ){

                let html = '';
                let html_select = '';
                if(response.data.items){
                    $.map(response.data.items, function (item, k) {
                        let pipeline = item.type;

                        if (!item.type || item.type === 'custom') {
                            pipeline = item.id;
                        }

                        html += '' +
                            '<button class="p-item btn btn-outline-primary rounded-0 flex-1 py-2 mt-0" style="position: relative;" type="button" data-id="' + pipeline + '">' +
                            '<span class="mb-0">' + $('#pipeline-icon-' + (item.icon || 'default')).html() + '</span>' +
                            '<p class="mb-0 mt-1" style="font-size:12px;" data-id="' + item.id + '">' +
                            '<span>' +
                            '<strong class="p-item__count-of-candidates">' + item.candidates + '</strong>' +
                            '</span>' +
                            ' ' +
                            '<span style="font-weight:lighter;">' + item.localized_name + '</span>' +
                            '</p>' +
                            ' ' +
                            '<span class="[ p-item__count-of-waving-candidates ] notification_dashboard_business" style="font-size: 12px !important; top:-8px; right:3px; opacity:0.7; ' + (item.waving_candidates == 0 ? 'visibility: hidden;' : '') + '">' + item.waving_candidates + '</span>' +
                            '</button>' +
                            '';

                        html_select += '<option value="' + pipeline +'">' + item.localized_name + '</option>';
                    });

                    _this.pipeline_button_block.html(html);
                    _this.candidate_edit_select_pipeline_block.html(html_select);
                    _this.candidate_add_select_pipeline_block.html(html_select);

                    $(document).find('.p-item[data-id="' + _this.current_pipeline + '"]').addClass('active');
                }
            }
        });
    },

    initCandidateTable: function () {
        let _this = this;

        $(document).on("business_candidate_list_table:draw", function (event) {
            if(_this.business_candidate_list_table !== null){
                _this.business_candidate_list_table.draw();
                event.preventDefault();
            }
        });

        _this.business_candidate_list_table = _this.business_candidate_list_table_id.DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                processData: true,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                url: "/api/candidate/get-candidate-table-data",
                data: function (data) {
                    data.business_id = _this.businessID;
                    data.brand_id = _this.brand_id;
                    data.pipeline = _this.current_pipeline;
                    data.only_waves = _this.only_waves;
                    data.keywords = _this.candidate_keywords;
                    data.sort = _this.candidate_sort;
                    data.language_prefix = defaultLang;
                    data.filter_by_location = _this.filterLocationIds;
                    console.log(data);
                },
                headers: {
                    'Authorization': 'Basic ' + window.auth.user.api_token
                }
            },
            columns: [
                {data: 'item', name: 'item' },
            ],
            initComplete: function (settings, json) {

            },
            drawCallback: function(settings){
                if (this.api().page.info().pages <= 1) {
                    $('#' + settings.sTableId + '_paginate').hide();
                }else{
                    $('#' + settings.sTableId + '_paginate').show();
                }
                $(document).find('.candidate-tools [data-toggle="tooltip"]').tooltip({
                    delay: { show: 300, hide: 100 }
                });
            },
            language: {
                searchPlaceholder: "",
                sSearch: "",
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

        $(document).on("business:applicants:candidate:table:draw", function (event) {
            if(_this.business_candidate_list_table !== null){
                _this.business_candidate_list_table.draw();
                event.preventDefault();
            }
        });
    },

    initCandidateEvent: function () {
        let _this = this;

        $(document).on('mouseover', '.candidate-card', function () {
            $(this).find('.candidate-tools').removeClass('hide');
            $(this).find('.candidate-applied-info').addClass('hide');
        }).on('mouseout', '.candidate-card *', function () {
            $(this).find('.candidate-tools').addClass('hide');
            $(this).find('.candidate-applied-info').removeClass('hide');
        });

        $(document).on('click', '.candidate-send-message', function () {
            $(document).find('#new-chat-message-modal').data('initialize')({
                with_user_id: parseInt($(this).attr('data-user-id')),
            });
            $(document).find('#new-chat-message-modal').modal('show');
        });

        $(document).on('click', '.candidate-resume-update', function () {
            let _data = {
                business_id: _this.businessID,
                brand_id: _this.brand_id,
                candidate_id: $(this).attr('data-candidate-id'),
                user_id: $(this).attr("data-user-id")
            };

            $.ajaxSetup({
                processData: true,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            });

            request({
                url: "/candidate/get-resume-request",
                data: _data,
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    _this.resumeRequest(response.data.items, _data);
                }
            });
        });

        $(document).on('click', '.candidate-overview', function (event) {
            event.preventDefault();
            $('#candidate-overview__block-buttons').hide();
            let _data = {
                business_id: _this.businessID,
                brand_id: _this.brand_id,
                candidate_id: $(this).attr("data-candidate-id"),
                user_id: $(this).attr("data-user-id")
            };

            if (_this.locale !== 'en') {
                _data['locale'] = _this.locale;
            }

            $.ajaxSetup({
                processData: true,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            });

            request({
                url: "/candidate/get-candidate-overview",
                data: _data,
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    $('#candidate-overview__block-buttons').show();
                    if (response.data.download_resume) {
                        var filename = response.data.download_resume;
                        filename = filename.substr(filename.lastIndexOf('\\')+1);
                        $('#candidate-overview__block-buttons > a').attr('href', filename);
                        $('#candidate-overview__block-buttons > a').show();
                    } else {
                        $('#candidate-overview__block-buttons > a').hide();
                    }
                    if (response.data.candidate_import) {
                        $('#candidate-overview__block-buttons .candidate_edit-show-form').attr('data-candidate-id',response.data.candidate_id);
                        $('#candidate-overview__block-buttons').show();
                    } else {
                        $('#candidate-overview__block-buttons .candidate_edit-show-form').hide();
                    }
                    if (response.data.overview) {
                        $('#candidateOverviewModal').find('#candidate-overview-body').html(response.data.overview);
                        $('#candidateOverviewModal').modal('show');
                    } else {
                        $('#candidateOverviewModal').find('#candidate-overview-body').html('')
                    }
                }
            });
        });

        $(document).on('click', '.candidate__interview', function(event) {
            //event.preventDefault();
            var user_id = $(this).attr('data-user-id');
            $(document).find('#interview-request-modal').modal('show');
            $(document).find('#interview-request-modal__title').text(trans('send_interview_request'));

            $(document).find('#interview-request-modal').data('initialize')({
                user_id: user_id,
            });
        });

        $(document).on('click', ".candidate-video", function (event) {
            event.preventDefault();
            console.log("EVENT - candidate-video");
            $(document).find('#candidate-video-block').attr("src", $(this).attr("data-user-video"));
            $(document).find('#candidate-video-modal').modal('show');
        });

        $(document).find('#candidate-video-modal').on("hide.bs.modal", function(){
            console.log("EVENT - hide - candidate-video");
            $(document).find('#candidate-video-block').attr("src", "");
        });

        $(document).on('click', '#candidate-resume-remind', function () {

            let candidate_id = $(this).attr('data-candidate-id');
            let _data = {
                business_id: _this.businessID,
                brand_id: _this.brand_id,
                candidate_id: candidate_id,
                user_id: $(this).attr("data-user-id"),
                id: $(this).attr("data-id"),
            };

            $.ajaxSetup({
                processData: true,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            });

            request({
                url: "/candidate/update-resume-request",
                data: _data,
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    _this.resumeRequest(response.data.items, _data);
                }
            });
        });

        $(document).on('click', '#candidate-send-request', function () {
            let _data = {
                business_id: _this.businessID,
                brand_id: _this.brand_id,
                candidate_id: $(this).attr('data-candidate-id'),
                user_id: $(this).attr("data-user-id"),
                id: $(this).attr("data-id"),
            };

            $.ajaxSetup({
                processData: true,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            });

            request({
                url: "/candidate/update-resume-request",
                data: _data,
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    _this.resumeRequest(response.data.items, _data);
                }
            });
        });

        $(document).on('click', '.candidate-notes', function () {
            let _data = {
                business_id: _this.businessID,
                brand_id: _this.brand_id,
                candidate_id: $(this).attr('data-candidate-id'),
                user_id: $(this).attr("data-user-id"),
            };

            $.ajaxSetup({
                processData: true,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            });

            request({
                url: "/candidate/note/get",
                data: _data,
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    _this.userNotes(response.data.items, _data);
                }
            });
        });

        $(document).on('click keydown', '#candidate-note-message', function () {
            FormValidate.fieldValidateClear($(this));
        });

        $(document).on('click', '#candidate-note-add', function () {
            let form = $('#candidate_notes');
            let _data = new FormData();
            _data.append ("business_id", _this.businessID);
            _data.append ("brand_id", _this.brand_id);
            _data.append ("candidate_id", $(this).attr('data-candidate-id'));
            _data.append ("user_id", $(this).attr("data-user-id"));
            _data.append ("message", FormValidate.getFieldValue('message', form));
            _data.append ("rating", parseInt(FormValidate.getFieldValue('rating', form)));
            _data.append ("attach_file", $(document).find("#candidate-note-attach_file")[0].files[0]);

            $.ajaxSetup({
                processData: false,
                contentType: false,
            });

            request({
                url: "/candidate/note/create",
                data: _data,
                method: "POST"
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    _this.userNotes(response.data.items, _data, false);
                }else{
                    if(response.error === "validation"){
                        FormValidate.fieldsValidate(response.validation_fields, form);
                    }else{
                        $.notify(response.message, 'error');
                    }
                }
            });
        });

        $(document).on('click', '.candidate-note-item-delete', function () {
            let _data = {
                business_id: _this.businessID,
                brand_id: _this.brand_id,
                candidate_id: $(this).attr('data-candidate-id'),
                note_id: $(this).attr('data-note-id'),
                user_id: $(this).attr("data-user-id"),
            };

            $.ajaxSetup({
                processData: true,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            });

            request({
                url: "/candidate/note/delete",
                data: _data,
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    _this.userNotes(response.data.items, _data, false);
                }else{
                    $.notify(response.message, 'error');
                }
            });
        });

        $(document).on('click', '#candidate-note-attach_file-click', function () {
            $('#candidate-note-attach_file').click();
        });

        $(document).on('change', '#candidate-note-attach_file', function () {
            let filename = $(this).val();
            filename = filename.substr(filename.lastIndexOf('\\')+1);
            $(document).find('#candidate-note-attach_file-name').text(filename);
        });

        $(document).on('click', '.candidate-history', function () {

            let _data = {
                business_id: _this.businessID,
                brand_id: _this.brand_id,
                candidate_id: $(this).attr('data-candidate-id'),
                user_id: $(this).attr("data-user-id"),
            };

            let name = $(document).find('.candidate-card[data-candidate-id="' + _data.candidate_id + '"]').find('.candidate-name').text();
            let picture = $(document).find('.candidate-card[data-candidate-id="' + _data.candidate_id +'"]').find('.candidate-picture').attr('src');

            $.ajaxSetup({
                processData: true,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            });

            request({
                url: "/candidate/history/get",
                data: _data,
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    let html = '';

                    $.map(response.data.items, function (item) {
                        if (item.candidate) {
                            html += '<div class="d-flex px-3 mt-1">\n' +
                                '                                        <div>';
                            if (item.candidate.job) {
                                html += '<p class="mb-1">\n' +
                                    '                                                <svg xmlns="http://www.w3.org/2000/svg"\n' +
                                    '                                                     xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"\n' +
                                    '                                                     id="Capa_1"\n' +
                                    '                                                     x="0px" y="0px" viewBox="0 0 512 512"\n' +
                                    '                                                     style="enable-background:new 0 0 512 512; vertical-align: middle; margin-top: -4px;"\n' +
                                    '                                                     xml:space="preserve" width="16px" height="16px" fill="#4E5C6E">\n' +
                                    '<g>\n' +
                                    '    <g>\n' +
                                    '        <path d="M488.727,279.273c-6.982,0-11.636,4.655-11.636,11.636v151.273c0,6.982-4.655,11.636-11.636,11.636H46.545    c-6.982,0-11.636-4.655-11.636-11.636V290.909c0-6.982-4.655-11.636-11.636-11.636s-11.636,4.655-11.636,11.636v151.273    c0,19.782,15.127,34.909,34.909,34.909h418.909c19.782,0,34.909-15.127,34.909-34.909V290.909    C500.364,283.927,495.709,279.273,488.727,279.273z"/>\n' +
                                    '    </g>\n' +
                                    '</g>\n' +
                                    '                            <g>\n' +
                                    '                                <g>\n' +
                                    '                                    <path d="M477.091,116.364H34.909C15.127,116.364,0,131.491,0,151.273v74.473C0,242.036,11.636,256,26.764,259.491l182.691,40.727    v37.236c0,6.982,4.655,11.636,11.636,11.636h69.818c6.982,0,11.636-4.655,11.636-11.636v-37.236l182.691-40.727    C500.364,256,512,242.036,512,225.745v-74.473C512,131.491,496.873,116.364,477.091,116.364z M279.273,325.818h-46.545v-46.545    h46.545V325.818z M488.727,225.745c0,5.818-3.491,10.473-9.309,11.636l-176.873,39.564v-9.309c0-6.982-4.655-11.636-11.636-11.636    h-69.818c-6.982,0-11.636,4.655-11.636,11.636v9.309L32.582,237.382c-5.818-1.164-9.309-5.818-9.309-11.636v-74.473    c0-6.982,4.655-11.636,11.636-11.636h442.182c6.982,0,11.636,4.655,11.636,11.636V225.745z"/>\n' +
                                    '                                </g>\n' +
                                    '                            </g>\n' +
                                    '                            <g>\n' +
                                    '                                <g>\n' +
                                    '                                    <path d="M314.182,34.909H197.818c-19.782,0-34.909,15.127-34.909,34.909v11.636c0,6.982,4.655,11.636,11.636,11.636    s11.636-4.655,11.636-11.636V69.818c0-6.982,4.655-11.636,11.636-11.636h116.364c6.982,0,11.636,4.655,11.636,11.636v11.636    c0,6.982,4.655,11.636,11.636,11.636c6.982,0,11.636-4.655,11.636-11.636V69.818C349.091,50.036,333.964,34.909,314.182,34.909z"/>\n' +
                                    '                                </g>\n' +
                                    '                            </g>\n' +
                                    '</svg>\n <strong>' + item.candidate.job.title + '</strong></p>';
                            }
                            let location = '';
                            let countryCode = '';
                            let locationName = '';

                            let locationData = item.candidate.location;
                            if (locationData) {
                                locationName = locationData.name;

                                location = locationData.street_number+" "+locationData.street;
                                if (locationData.city !== null) {
                                    location += ", " + locationData.city;
                                }
                                if (locationData.region !== null) {
                                    location += ", " + locationData.region;
                                }
                                if (locationData.country !== null) {
                                    location += ", " + locationData.country;
                                }

                                countryCode = locationData.country_code;
                            } else {
                                var businessData = item.candidate.business;
                                locationName = businessData.name;

                                location = businessData.street_number+" "+businessData.street;

                                if (businessData.city !== null) {
                                    location += ", " + businessData.city;
                                }
                                if (businessData.region !== null) {
                                    location += ", " + businessData.region;
                                }
                                if (businessData.country !== null) {
                                    location += ", " + businessData.country;
                                }
                                countryCode = businessData.country_code;
                            }
                            if (item.candidate.user.is_import) {
                                if (item.candidate.user.city || item.candidate.user.region || item.candidate.user.country || item.candidate.user.country_code) {
                                    location = item.candidate.user.city;
                                    if (item.candidate.user.region !== null) {
                                        location += ", " + item.candidate.user.region;
                                    }
                                    if (item.candidate.user.country !== null) {
                                        location += ", " + item.candidate.user.country;
                                    }
                                    countryCode = item.candidate.user.country_code;
                                } else {
                                    location = ''
                                }
                            }
                            let user_video_html = "";
                            if(item.candidate.user_video){
                                user_video_html = '<div style="cursor: pointer;" class="[ candidate-video ] pull-right" data-user-video="'+item.candidate.user_video+'" data-id="'+item.candidate.user.id+'" style="background-image: url('+item.candidate.thumbnail_url+');">\n' +
                                    '                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"\n' +
                                    '                                             viewBox="0 0 350 350" style="enable-background:new 0 0 350 350;" xml:space="preserve">\n' +
                                    '                                            <path d="M175,0C78.343,0,0,78.343,0,175c0,96.656,78.343,175,175,175c96.656,0,175-78.344,175-175C350,78.343,271.656,0,175,0z\n' +
                                    '                                                 M258.738,189.05l-104.386,71.812c-2.904,1.989-6.284,3.006-9.673,3.006c-2.728,0-5.436-0.648-7.93-1.951\n' +
                                    '                                                c-5.605-2.965-9.125-8.777-9.125-15.103V103.188c0-6.326,3.52-12.139,9.125-15.104c5.605-2.94,12.377-2.535,17.603,1.055\n' +
                                    '                                                l104.386,71.811c4.619,3.18,7.387,8.441,7.387,14.05C266.125,180.609,263.358,185.87,258.738,189.05z"/>\n' +
                                    '                                                                                        <g>\n' +
                                    '                                                                                        </g>\n' +
                                    '                                                                                        <g>\n' +
                                    '                                                                                        </g>\n' +
                                    '                                                                                        <g>\n' +
                                    '                                                                                        </g>\n' +
                                    '                                                                                        <g>\n' +
                                    '                                                                                        </g>\n' +
                                    '                                                                                        <g>\n' +
                                    '                                                                                        </g>\n' +
                                    '                                                                                        <g>\n' +
                                    '                                                                                        </g>\n' +
                                    '                                                                                        <g>\n' +
                                    '                                                                                        </g>\n' +
                                    '                                                                                        <g>\n' +
                                    '                                                                                        </g>\n' +
                                    '                                                                                        <g>\n' +
                                    '                                                                                        </g>\n' +
                                    '                                                                                        <g>\n' +
                                    '                                                                                        </g>\n' +
                                    '                                                                                        <g>\n' +
                                    '                                                                                        </g>\n' +
                                    '                                                                                        <g>\n' +
                                    '                                                                                        </g>\n' +
                                    '                                                                                        <g>\n' +
                                    '                                                                                        </g>\n' +
                                    '                                                                                        <g>\n' +
                                    '                                                                                        </g>\n' +
                                    '                                                                                        <g>\n' +
                                    '                                                                                        </g>\n' +
                                    '                                        </svg>\n' +
                                    '                                    </div>';

                            }


                            html += '<div class="mb-1">\n' +
                                '<img class="mr-1" src="' + item.candidate.business.image_url + '"\n' +
                                'style="width: 35px; height: 35px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); border-radius: 5px;">\n' +
                                locationName + user_video_html +
                                '</div>\n';
                            if (location.length > 0) {
                                html += '<p class="mb-0" style="font-size: 14px; padding-top: 15px;">\n' +
                                    '<span class="item-location-flag bfh-flag-' + countryCode + '"><i' +
                                    'class="glyphicon"></i> </span>\n' +
                                    Langs.applied_to + ' ' + location +
                                    '</p>\n' +
                                    '</div>\n' +
                                    '<div class="ml-auto">\n' +
                                    '<p class="pt-1">' + item.candidate.date + '</p>\n' +
                                    '</div>\n' +
                                    '</div>\n';
                            }
                            html += '<hr>';
                        } else if (item.pipeline) {
                            let user_pic = item.pipeline.manager.user_pic;
                            if(user_pic === ""){
                                user_pic = item.pipeline.manager.image_url;
                            }
                            html += '<div class="d-flex px-3">\n' +
                                '    <div>\n' +
                                '        <img class="mr-3" src="' + user_pic + '"\n' +
                                '             style="width: 40px; height: 40px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); border-radius: 5px;">\n' +
                                '    </div>\n' +
                                '    <div>\n' +
                                '        <p class="mb-0 pt-2"><strong>' + item.pipeline.manager.first_name + ' ' + item.pipeline.manager.last_name + '</strong></p>\n' +
                                '<p>'+Langs.moved+' ' + name + ' '+Langs.to+' ' + item.pipeline.pipeline + '</p>' +
                                '    </div>\n' +
                                '    <div class="ml-auto pt-2">\n' +
                                '        ' + item.pipeline.date + '\n' +
                                '    </div>\n' +
                                '</div>\n' +
                                '<hr>';
                        }
                    });

                    $('#history-modal-body').html(html);
                    $('#history-name-modal').text(name);
                    $('#history-picture-modal').attr('src', picture);

                    $('#history').modal('show');
                }else{
                    $.notify(response.message, 'error');
                }
            });
        });

        $(document).on('click', '.candidate-send-data', function () {
            $(document).find('#candidate-send-data-go').attr('data-user-id', $(this).attr('data-user-id'));
            $(document).find('#candidate-send-data-go').attr('data-candidate-id', $(this).attr('data-candidate-id'));
            $(document).find('#send_candidate').modal('show');
        });

        $(document).on("keydown", '#send_candidate input[name="email"]', function () {
            FormValidate.fieldValidateClear($(this));
        });

        $(document).on('click', '#candidate-send-data-go', function () {
            let form = $(document).find('#send_candidate');
            let _data = {
                business_id: _this.businessID,
                brand_id: _this.brand_id,
                candidate_id: $(this).attr('data-candidate-id'),
                user_id: $(this).attr("data-user-id"),
                email: FormValidate.getFieldValue('email', form)
            };

            $.ajaxSetup({
                processData: true,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            });

            request({
                url: "/candidate/send-candidate-data",
                data: _data,
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    $(document).find('#send_candidate').modal('hide');
                }else{
                    if(response.error === "validation"){
                        FormValidate.fieldsValidate(response.validation_fields, form);
                    }else{
                        $.notify(response.message, 'error');
                    }
                }
            });
        });

        $(document).on('click', '.candidate-pipeline-move', function () {
            let _data = {
                business_id: _this.businessID,
                brand_id: _this.brand_id,
                candidate_id: $(this).attr('data-candidate-id'),
                user_id: $(this).attr("data-user-id"),
                pipeline: $(this).attr('data-type')
            };

            $.ajaxSetup({
                processData: true,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            });

            request({
                url: "/candidate/update-pipeline",
                data: _data,
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    //$('.candidate-card[data-candidate-id="' + _data.candidate_id + '"]').parent().remove();
                    _this.initPipeline();

                    $(document).trigger("business_candidate_list_table:draw");

                }else{
                    $.notify(response.message, 'error');
                }
            });
        });

        $(document).on('click', '#pipeline-buttons > button', function () {
            _this.current_pipeline = $(this).attr("data-id");
            //$(document).trigger("business_candidate_list_table:draw");
            _this.initPipeline();
            setTimeout(function() {
                $(document).trigger("business_candidate_list_table:draw");
            }, 100);
        });

        $(document).on('click', '.candidates__wave-filter', function() {
            if ($(this).hasClass('enabled')) {
                $(this).removeClass('enabled').css({ 'color': '#9ba6b2', 'border-color': '#9ba6b2' });
                _this.only_waves = 0;
            } else {
                $(this).addClass('enabled').css({ 'color': '#007bff', 'border-color': '#007bff' });
                _this.only_waves = 1;
            }

            setTimeout(function() {
                $(document).trigger("business_candidate_list_table:draw");
            }, 100);
        });

        $(document).on('keyup', "#business-candidate-search", function (event) {
            if (event.which <= 90 && event.which >= 48 || event.which === 13 || event.which === 8) {
                _this.candidate_keywords = $(this).val().trim();
                setTimeout(function() {
                    _this.initPipeline();
                    $(document).trigger("business_candidate_list_table:draw");
                }, 100);
            }
        });

        $(document).on('change', "#business-candidate-sort", function (event) {
            _this.candidate_sort = $(this).val();
            setTimeout(function() {
                $(document).trigger("business_candidate_list_table:draw");
            }, 100);
        });

        $(document).on('change', "#business-candidate-limit", function () {
            if(_this.business_candidate_list_table != null){
                _this.business_candidate_list_table.page.len($(this).val()).draw();
            }
        });

        $(document).on('click', '.candidate_edit-show-form', function () {
            let _form = $(document).find('#candidate_edit-form');
            FormValidate.fieldsValidateClear(_form);

            let $_candidate_id = $(this).attr("data-candidate-id");
            let $_user_id = $(this).attr("data-user-id");
            _form.find("[name=id]").val($_candidate_id);
            let _data = {
                business_id: _this.businessID,
                brand_id: _this.brand_id,
                candidate_id: $_candidate_id,
                user_id: $_user_id,
            };

            _this.initJobAppliedTo($(document).find('#candidate_edit-select-job'), function (data) {
                _this.initLocationAppliedTo($(document).find('#candidate_edit-select-location'), function (data) {

                    $.ajaxSetup({
                        processData: true,
                        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    });

                    request({
                        url: "/candidate/get-data-user-import",
                        data: _data,
                    }, function (response) {
                        console.log(response);
                        if(response.error === undefined ){
                            //////////////////////////////////
                            _form.find("[name=first_name]").val(response.data.candidate.first_name);
                            _form.find("[name=last_name]").val(response.data.candidate.last_name);
                            _form.find("[name=email]").val(response.data.candidate.email);
                            _form.find("[name=pipeline_id]").val(response.data.candidate.pipeline);
                            _form.find("[name=job_id]").val(response.data.candidate.job_id?response.data.candidate.job_id:0);
                            _form.find("[name=location_id]").val(response.data.candidate.location_id?response.data.candidate.location_id:0);
                            _form.find("[name=phone_number]").val(response.data.candidate.phone_number);
                            _form.find("#country-phone").attr("data-country", response.data.candidate.phone_country_code);
                            /////////////////////////////////////////////
                            _this.locationAutocomplete(_form);
                            _form.find("[name=location]").val(response.data.candidate.city+", "+response.data.candidate.region+", "+response.data.candidate.country);

                        }else{
                            $.notify(response.message, 'error');
                        }
                    });
                });
            });
        });

        $(document).on('click', '.candidate_add-show-form', function () {
            FormValidate.fieldsValidateClear($(document).find('#candidate_add-form'));
            _this.locationAutocomplete($(document).find('#candidate_add-form'));

            _this.initJobAppliedTo($(document).find('#candidate_add-select-job'));
            _this.initLocationAppliedTo($(document).find('#candidate_add-select-location'));
        });

        $(document).find('#candidate_edit-resume-attach_file-btn').click(function () {
            $('#candidate_add-resume-attach_file-input').click();
        });

        $(document).find('#candidate_edit-resume-attach_file-input').change(function () {
            var filename = $(this).val();
            filename = filename.substr(filename.lastIndexOf('\\')+1);
            $('#candidate_edit-resume-attach_file-name').text(filename);
            $('#candidate_edit-resume-delete-btn').show();
            $('#candidate_resume_delete_input').val(false);
        });

        $(document).find('#candidate_add-resume-attach_file-btn').click(function () {
            $('#candidate_add-resume-attach_file-input').click();
        });

        $(document).find('#candidate_add-resume-attach_file-input').change(function () {
            var filename = $(this).val();
            filename = filename.substr(filename.lastIndexOf('\\')+1);
            $('#candidate_add-resume-attach_file-name').text(filename);
            $('#candidate_add-resume-delete-btn').show();
            $('#candidate_resume_delete_input').val(false);
        });

        $(document).on('click', '#candidate_add-resume-delete-btn, #candidate_edit-resume-delete-btn', function () {
            $('#candidate_add-resume-attach_file-input, #candidate_edit-resume-attach_file-input').val('');
            $('#candidate_add-resume-attach_file-name, #candidate_edit-resume-attach_file-name').text('');
            $('#candidate_resume_delete_input').val(true);
            $(this).hide();
        });

        $(document).find('#candidate_add-form').on('click keydown', 'input', function () {
            FormValidate.fieldValidateClear($(this));
        });

        $(document).on('click', '#candidate_add-btn-click', function () {
            let form = $(document).find('#candidate_add-form');
            FormValidate.fieldsValidateClear(form);

            let pipeline_id = form.find('#candidate_add-select-pipeline').val();
            if(pipeline_id === ""){
                form.find('#candidate_add-select-pipeline').parent().addClass("has-error");
                return;
            }

            let job_id = parseInt(form.find('#candidate_add-select-job').val());

            let location_id = parseInt(form.find('#candidate_add-select-location').val());

            let language_prefix = 'en';
            if (_this.locale) {
                language_prefix = _this.locale;
            }

            let code = form.find('#country-phone .bfh-selectbox-option').clone();
            code.find('span').remove();

            let _data = new FormData();
            _data.append ("business_id", _this.businessID);
            _data.append ("brand_id", _this.brand_id);
            _data.append ("first_name", FormValidate.getFieldValue('first_name', form));
            _data.append ("last_name", FormValidate.getFieldValue('last_name', form));
            _data.append ("email", FormValidate.getFieldValue('email', form));
            _data.append ("phone_number", FormValidate.getFieldValue('phone_number', form));
            _data.append ("phone_code", code.text().replace(" ", ""));
            _data.append ("phone_country_code", form.find('.country').val());
            _data.append ("language_prefix", language_prefix);
            _data.append ("job_id", job_id);
            _data.append ("pipeline_id", pipeline_id);
            _data.append ("location_id", location_id);
            _data.append ("location", FormValidate.getFieldValue('location', form) || '');
            _data.append ("city", form.find("[name=city_name]").val() || '');
            _data.append ("region", form.find("[name=region]").val() || '');
            _data.append ("country", form.find("[name=country]").val() || '');
            _data.append ("country_code", form.find("[name=country_code]").val() || '');
            _data.append ("attach_file", form.find("#candidate_add-resume-attach_file-input")[0].files[0]);

            $.ajaxSetup({
                processData: false,
                contentType: false,
            });

            request({
                url: "/candidate/create-user-import",
                data: _data,
                method: "POST"
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    $(document).find('#addNewCandidate').modal('hide');
                    setTimeout(function() {
                        _this.initPipeline();
                        $(document).trigger("business_candidate_list_table:draw");
                    }, 500);
                }else{
                    if(response.error === "validation"){
                        FormValidate.fieldsValidate(response.validation_fields, form);
                    }else{
                        $.notify(response.message, 'error');
                    }
                }
            });
        });

        $(document).on('click', '#candidate_edit-btn-click', function () {
            let form = $(document).find('#candidate_edit-form');
            FormValidate.fieldsValidateClear(form);

            let pipeline_id = form.find('#candidate_edit-select-pipeline').val();
            if(pipeline_id === ""){
                form.find('#candidate_edit-select-pipeline').parent().addClass("has-error");
                return;
            }

            let job_id = parseInt(form.find('#candidate_edit-select-job').val());

            let location_id = parseInt(form.find('#candidate_edit-select-location').val());

            let language_prefix = 'en';
            if (_this.locale) {
                language_prefix = _this.locale;
            }

            let code = form.find('#country-phone .bfh-selectbox-option').clone();
            code.find('span').remove();

            let _data = new FormData();
            _data.append ("business_id", _this.businessID);
            _data.append ("brand_id", _this.brand_id);
            _data.append ("first_name", FormValidate.getFieldValue('first_name', form));
            _data.append ("last_name", FormValidate.getFieldValue('last_name', form));
            _data.append ("email", FormValidate.getFieldValue('email', form));
            _data.append ("phone_number", FormValidate.getFieldValue('phone_number', form));
            _data.append ("phone_code", code.text().replace(" ", ""));
            _data.append ("phone_country_code", form.find('.country').val());
            _data.append ("language_prefix", language_prefix);
            _data.append ("job_id", job_id);
            _data.append ("pipeline_id", pipeline_id);
            _data.append ("location_id", location_id);
            _data.append ("candidate_id", form.find("[name=id]").val());
            _data.append ("delete_resume", form.find("[name=delete_resume]").val());
            _data.append ("location", FormValidate.getFieldValue('location', form) || '');
            _data.append ("city", form.find("[name=city_name]").val() || '');
            _data.append ("region", form.find("[name=region]").val() || '');
            _data.append ("country", form.find("[name=country]").val() || '');
            _data.append ("country_code", form.find("[name=country_code]").val() || '');
            _data.append ("attach_file", form.find("#candidate_edit-resume-attach_file-input")[0].files[0]);

            $.ajaxSetup({
                processData: false,
                contentType: false,
            });

            request({
                url: "/candidate/update-user-import",
                data: _data,
                method: "POST"
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    $(document).find('#editCandidate').modal('hide');
                    setTimeout(function() {
                        _this.initPipeline();
                        $(document).trigger("business_candidate_list_table:draw");
                    }, 500);
                }else{
                    if(response.error === "validation"){
                        FormValidate.fieldsValidate(response.validation_fields, form);
                    }else{
                        $.notify(response.message, 'error');
                    }
                }
            });
        });

        $(document).on('click', '.candidate__dismiss-wave', function(event) {
            event.preventDefault();
            let candidate_id = $(this).parents('.candidate-card:first').attr('data-candidate-id');

            let _data = {
                business_id: _this.businessID,
                brand_id: _this.brand_id,
                candidate_id: candidate_id
            };

            $.ajaxSetup({
                processData: true,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            });

            return request({
                url: "/candidate/delete-candidate-wave",
                data: _data,
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    _this.initCountOnlyWaves();
                    _this.initPipeline();
                    $(document).trigger("business_candidate_list_table:draw");

                }else{
                    $.notify(response.message, 'error');
                }
            });
        });

        ///TODO test
        $(document).on('keyup', '#candidate-note-filters', function () {
            var keyword = $(this).val();
            $('#notes-modal-body .candidate-note-message').each(function() {
                var message = $(this).text();
                if (message.indexOf(keyword)==-1) {
                    $(this).closest('.candidate-note-item').removeClass('d-flex').hide();
                    $(this).closest('.candidate-note-item').next('hr').hide();
                } else {
                    $(this).closest('.candidate-note-item').addClass('d-flex').show();
                    $(this).closest('.candidate-note-item').next('hr').show();
                }
            });
        });

        $(document).on("click", "#set-filters", function () {
            console.log(_this.filterLocationIds);
            $(document).find("#candidateFilterModal").modal("hide");
            _this.initPipeline();
            $(document).trigger("business_candidate_list_table:draw");
        });

        $(document).on("click", "#clear-filters", function () {
            _this.filterLocationIds = [];
            $(document).find("#candidateFilterModal").modal("hide");
            $(document).trigger("business_candidate_list_table:draw");
        });

        $(document).on("show.bs.modal", "#candidateFilterModal", function () {
            if(_this.dataTableFilterLocation === null){
                _this.initDataTableFilterLocation();
            }
        });
    },

    initDataTableFilterLocation: function () {
        let _this = this;

        $(document).on("business:candidate:filter:location:datatable:draw", function (event) {
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
                processData: true,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                url: "/api/datatable/get-business-data",
                data: {
                    business_id: _this.businessID,
                    brand_id: _this.brand_id,
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

        $(document).on("hide.bs.modal", "#candidateFilterModal", function () {
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
                processData: true,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                url: _url,
                data: {
                    business_id: _this.businessID,
                    brand_id: _this.brand_id,
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

    initJobAppliedTo: function($_container, callback = null){
        let _this = this;

        let _data = {
            business_id: _this.businessID,
            brand_id: _this.brand_id,
            locale: _this.locale
        };

        $.ajaxSetup({
            processData: true,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        });

        request({
            url: "/candidate/get-candidate-job-applied-to",
            data: _data,
        }, function (response) {
            console.log(response);
            if(response.error === undefined ){
                $_container.html(response.data.html);
            }else{
                $.notify(response.message, 'error');
            }
            if(callback !== null){
                return callback(response);
            }

        });
    },

    initLocationAppliedTo: function($_container, callback = null){
        let _this = this;

        let _data = {
            business_id: _this.businessID,
            brand_id: _this.brand_id,
            locale: _this.locale
        };

        $.ajaxSetup({
            processData: true,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        });

        request({
            url: "/candidate/get-candidate-location-applied-to",
            data: _data,
        }, function (response) {
            console.log(response);
            if(response.error === undefined ){
                $_container.html(response.data.html);
            }else{
                $.notify(response.message, 'error');
            }
            if(callback !== null){
                return callback(response);
            }
        });
    },

    /**
     * User location autocomplete
     */
    locationAutocomplete: function ($_form_id, $_init_value = "") {
        let locationField = $_form_id.find('#field-location');
        let _city_name = $_form_id.find('input[name="city_name"]');
        let _city = $_form_id.find('input[name="city"]');
        let _region = $_form_id.find('input[name="region"]');
        let _country = $_form_id.find('input[name="country"]');
        let _countryCode = $_form_id.find('input[name="country_code"]');
        let _geoFullName = $_form_id.find('input[name="geo_full_name"]');

        $_form_id.on('click', '#location-clear', function () {
            locationField.val('');
            locationField.focus();
            $_form_id.find('#location-clear').parent().addClass('hide');
            //locationField.addClass('autocomplete-border');
            //_city.val("");
            _city_name.val("");
            _region.val("");
            _country.val("");
            _countryCode.val("");
            _geoFullName.val("");
            locationField.parent().find('.glyphicon').attr('class','glyphicon');
        });

        locationField.autocomplete({
            source: function (request, response) {
                //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler

                $_form_id.find('#location-clear').parent().addClass('hide');

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
                        //_city.val("");
                        _city_name.val("");
                        _region.val("");
                        _country.val("");
                        _countryCode.val("");
                        _geoFullName.val("");
                        locationField.removeClass('ui-autocomplete-loading');
                        $_form_id.find('#location-clear').parent().removeClass('hide');
                    }
                }).autocomplete();
            },
            select: function (event, ui) {
                //_city.val(ui.item.data.city);
                _city_name.val(ui.item.data.city);
                _region.val(ui.item.data.region);
                _country.val(ui.item.data.country);
                _countryCode.val(ui.item.id);
                var flag = $_form_id.find('#basic-addon1');
                flag.find('i').removeClassRegex(/^bfh-flag-/);
                flag.find('i').addClass('bfh-flag-' + ui.item.id);

                _geoFullName.val(ui.item.data.fullName);

                //$_form_id.find('.country').val(ui.item.id);
                //$_form_id.find('.bfh-selectbox-option').html('');
                //$_form_id.find('.bfh-selectbox-option').html('<i class="glyphicon bfh-flag-' + ui.item.id + '"></i>' + BFHCountriesList[ui.item.id]);
            },
            response: function (e, u) {
                locationField.removeClass('ui-autocomplete-loading');
                $_form_id.find('#location-clear').parent().removeClass('hide');
            }
        }).attr('autocomplete', 'disabled').autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                .append('<span><i class="glyphicon bfh-flag-' + item.id + '"></i> </span><span>' + item.label + '</span>')
                .appendTo(ul);
        };

        locationField.keydown(function () {
            //_city.val("");
            _city_name.val("");
            _region.val("");
            _country.val("");
            _countryCode.val("");
            _geoFullName.val("");
            locationField.parent().find('.glyphicon').attr('class','glyphicon');
        });
    },

    /**
     * @return {string}
     */
    CountRatingCandidate: function (items) {
        let rating = 0;
        let count = 0;
        $.map(items, function (item) {
            if (item['rating']) {
                count++;
                rating += item['rating'];
            }
        });
        rating = rating / count;
        return rating.toFixed();
    },

    userNotes: function (items, _data, modal_show = true, ) {
        $(document).find('#candidate-note-message').val('');
        $(document).find('#candidate-note-rating').val('');
        $(document).find('#candidate-note-attach_file').val('');
        $(document).find('#candidate-note-attach_file-name').text('');
        let html = '';
        $.map(items, function (item) {
            let html_plus = '';
            let user_pic = item.manager.user_pic;
            if(user_pic === ""){
                user_pic = item.manager.image_url;
            }

            if (item.attach_file) {
                html_plus += '<br><span>file - <a href="/candidate/' + _data.user_id + '/' + item.attach_file + '" target="_blank"><small>' + item.attach_file + '</small></a></span> ';
            }
            if (item.rating) {
                if (html_plus.length === 0) {
                    html_plus = '<br>';
                }
                html_plus += '<span>rating - <small>' + item.rating + '</small></span>';
            }
            html += '<div class="d-flex px-3 mt-3 candidate-note-item">\n' +
                '    <div>\n' +
                '        <img class="mr-3" src="' + user_pic + '"\n' +
                '             style="width: 40px; height: 40px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); border-radius: 5px;">\n' +
                '    </div>\n' +
                '    <div>\n' +
                '        <p class="mb-0"><strong>' + item.manager.first_name + ' ' + item.manager.last_name + '</strong></p>\n' +
                '        <span><small class="candidate-note-message">' + item.message + '</small></span>\n' +
                html_plus +
                '    </div>\n' +
                '    <div class="ml-auto text-right">\n' +
                '        <p class="mb-1">' + item.date + '</p>'+
                '        <button type="button" class="btn btn-outline-primary btn-sm candidate-note-item-delete" data-candidate-id="'+_data.candidate_id+'" data-user-id="'+ _data.user_id +'" data-note-id="' + item.id + '"> <small>Delete</small> </button>' +
                '    </div>\n' +
                '</div>\n' +
                '<hr>';
        });
        $(document).find('#notes-modal-body').html(html);

        $(document).find('#candidate_notes').find('#candidate-note-add').attr('data-user-id', _data.user_id);
        $(document).find('#candidate_notes').find('#candidate-note-add').attr('data-candidate-id', _data.candidate_id);

        if(modal_show === true){
            $(document).find('#candidate_notes').modal('show');
        }else {
            setTimeout(function () {
                $(document).trigger("business_candidate_list_table:draw");
            }, 300);
        }
    },

    resumeRequest: function (items, _data) {
        let name = $('.candidate-card[data-candidate-id="' + _data.candidate_id + '"]').find('.candidate-name').text();
        let html = '';
        let remind = 0;
        $.map(items, function (item) {
            if (item.response === 1) {
                html += '<div class="d-flex mt-3 px-3">\n' +
                    '                                            <div class="ml-auto">\n' +
                    '<span class="mr-3 badge badge-success">\n' +
                    '  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"\n' +
                    '       id="Capa_1" x="0px" y="0px" width="13px" height="13px" viewBox="0 0 94.026 94.026"\n' +
                    '       style="enable-background:new 0 0 94.026 94.026; vertical-align: middle; margin-top: -3px;"\n' +
                    '       xml:space="preserve" fill="#ffffff">\n' +
                    '  <g>\n' +
                    '      <g>\n' +
                    '          <g>\n' +
                    '              <path d="M76.497,6.772c3.207,4.848,3.565,12.041,1.078,21.434c6.192,2.121,14.082,8.084,15.953,24.516     c1.612,14.15-0.69,24.828-6.856,31.734c-4.978,5.579-11.988,8.407-20.841,8.407c-14.853,0-31.035-8.331-34.131-10.002     c-2.996-1.619-4.857-4.741-4.857-8.146V35.249c0-4.497,3.213-8.331,7.646-9.118c1.334-0.235,13.113-2.533,15.66-10.566     c2.774-8.749,9.098-14.402,16.112-14.402C70.4,1.163,74.131,3.206,76.497,6.772z M37.066,74.136     c3.143,1.646,16.955,8.504,28.766,8.504c5.895,0,10.217-1.633,13.213-4.989c4.143-4.642,5.598-12.638,4.328-23.771     c-1.215-10.654-5.619-16.543-12.404-16.583l-7.16-0.042l2.367-6.759c2.982-8.516,3.654-15.275,1.801-18.076     c-0.313-0.471-0.864-1.033-1.715-1.033c-1.971,0-4.871,2.548-6.367,7.268C55.903,31.247,41.545,35.13,37.067,36.046     L37.066,74.136L37.066,74.136z"/>\n' +
                    '          </g>\n' +
                    '          <g>\n' +
                    '              <path d="M20.011,82.123V30.336c0-1.118-0.906-2.024-2.025-2.024H2.023C0.906,28.312,0,29.218,0,30.336v51.787     c0,1.119,0.906,2.024,2.023,2.024h15.963C19.105,84.147,20.011,83.242,20.011,82.123z M13.927,76.173     c0,2.162-1.76,3.922-3.922,3.922c-2.162,0-3.922-1.76-3.922-3.922s1.76-3.922,3.922-3.922     C12.167,72.251,13.927,74.011,13.927,76.173z"/>\n' +
                    '          </g>\n' +
                    '      </g>\n' +
                    '  </g>\n' +
                    '  </svg>\n' +
                    name + ' ' + Langs.updated_his_resume +
                    '</span>\n' +
                    '                          <span>' + item.date + '</span>\n' +
                    '                      </div>\n' +
                    '                  </div>\n' +
                    '                  <hr>';
            } else {
                remind = 1;
                html += '<div class="d-flex px-3">\n' +
                    '                       <div>\n' +
                    '                           <button type="button" class="btn btn-outline-warning" id="candidate-resume-remind" data-candidate-id="' + _data.candidate_id + '" data-id="' + item.id + '" data-user-id="' + item.user_id + '">'+Langs.remind+'</button>\n' +
                    '                       </div>\n' +
                    '                       <div class="ml-auto pt-2">\n' +
                    ' <span class="mr-3 badge badge-warning">\n' +
                    '   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"\n' +
                    '        id="Capa_1" x="0px" y="0px" width="13px" height="13px" viewBox="0 0 97.16 97.16"\n' +
                    '        style="enable-background:new 0 0 97.16 97.16; vertical-align: middle; margin-top: -3px;"\n' +
                    '        xml:space="preserve">\n' +
                    '   <g>\n' +
                    '       <g>\n' +
                    '           <path d="M48.58,0C21.793,0,0,21.793,0,48.58s21.793,48.58,48.58,48.58s48.58-21.793,48.58-48.58S75.367,0,48.58,0z M48.58,86.823    c-21.087,0-38.244-17.155-38.244-38.243S27.493,10.337,48.58,10.337S86.824,27.492,86.824,48.58S69.667,86.823,48.58,86.823z"/>\n' +
                    '           <path d="M73.898,47.08H52.066V20.83c0-2.209-1.791-4-4-4c-2.209,0-4,1.791-4,4v30.25c0,2.209,1.791,4,4,4h25.832    c2.209,0,4-1.791,4-4S76.107,47.08,73.898,47.08z"/>\n' +
                    '       </g>\n' +
                    '   </g>\n' +
                    '   </svg>\n' +
                    Langs.request_sent_waiting + '    ' + name +
                    ' </span>\n' +
                    '                           <span>' + item.date + '</span>\n' +
                    '                       </div>\n' +
                    '                   </div>\n' +
                    '                   <hr>';
            }

        });

        if (remind === 0 || items.length === 0) {
            $('#candidate-resume-send-button').removeClass('hide');
        } else {
            $('#candidate-resume-send-button').addClass('hide');
        }
        $('#candidate-resume-modal-body').html(html);

        $('#candidate-send-request').attr('data-candidate-id', _data.candidate_id);
        $('#candidate-send-request').attr('data-user-id', _data.user_id);
        $('#candidate-resume-name').text(name);
        $('#pipeline').modal('show');
    }

};



$(document).ready(function () {
    let businessNewApplicants = new BusinessNewApplicants();
    businessNewApplicants.init();


});
