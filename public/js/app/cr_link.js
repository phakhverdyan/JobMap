
function CrLink() {

    this.form = $('#formGenerateCode');

    this.jobTitle = '';
    this.jobid = 0;
    this.elemJobTitle = $('#crLink-TitleJob');
    this.elemJobTitleClear = $('#crLink-TitleJob-clear');

    this.locationTitle = '';
    this.locationId = 0;
    this.elemLocationTitle = $('#crLink-TitleLocation');
    this.elemLocationTitleClear = $('#crLink-TitleLocation-clear');

    this.elemNoLocation = $('#crLink-NoLocation');
    this.elemGenerateLink = $('#crLink-GenerateLink');
    this.elemShowCode = $('#crLink-ShowCode');
    this.elemCodeBitLyBusiness = $('#crLink-CodeBitLyBusiness');

}

CrLink.prototype = {
    init: function () {
        let _this = this;

        _this.elemCodeBitLyBusiness.val(business.currentData.code_bitly);
        _this.initAutoComplete();
        _this.initEvents();

    },
    initAutoComplete: function () {
        let _this = this;

        _this.elemJobTitle.autocomplete({
            source: function (request, response) {
                /*if (request.term.length === 0) {
                 elemJobTitleClear.parent().addClass('hide');
                 } else {
                 elemJobTitleClear.parent().removeClass('hide');
                 }*/
                let param = {
                    "business_id": business.currentData.id,
                    "key": request.term
                };
                if (_this.locationId != 0) {
                    param['location_id'] = _this.locationId;
                }
                new GraphQL("query", "getJobsAutoComplete", param, [
                    'id',
                    'title'
                ], false, false, function () {
                    response([]);
                }, function (data) {
                    if (data.length !== 0) {
                        let transformed = $.map(data, function (el) {
                            return {
                                label: el.title,
                                id: el.id,
                                data: el
                            };
                        });
                        response(transformed);
                    } else {
                        _this.jobTitle = '';
                        _this.jobid = 0;
                        _this.elemJobTitle.removeClass('ui-autocomplete-loading');
                    }
                }).autocomplete();
            },
            select: function (event, ui) {
                _this.jobTitle = ui.item.data.title;
                _this.jobid = ui.item.data.id;
                _this.elemJobTitleClear.parent().removeClass('hide');
            },
            close: function (event, ui) {
            },
            response: function (e, u) {
                _this.elemJobTitle.removeClass('ui-autocomplete-loading');
            }
        });
        _this.elemJobTitleClear.click(function () {
            _this.elemJobTitle.val('');
            _this.jobid = 0;
            _this.jobTitle = '';
            _this.elemJobTitle.focus();
            _this.elemJobTitleClear.parent().addClass('hide');
        });

        _this.elemLocationTitle.autocomplete({
            source: function (request, response) {
                /*if (request.term.length === 0) {
                 elemLocationTitleClear.parent().addClass('hide');
                 } else {
                 elemLocationTitleClear.parent().removeClass('hide');
                 }*/
                let param = {
                    "business_id": business.currentData.id,
                    "key": request.term
                };
                if (_this.jobid != 0) {
                    param['job_id'] = _this.jobid;
                }
                new GraphQL("query", "getLocationsAutoComplete", param, [
                    'id',
                    'address',
                    'name'
                ], false, false, function () {
                    response([]);
                }, function (data) {
                    if (data.length !== 0) {
                        let transformed = $.map(data, function (el) {
                            return {
                                label: el.address,
                                id: el.id,
                                data: el
                            };
                        });
                        response(transformed);
                    } else {
                        _this.locationTitle = '';
                        _this.locationId = 0;
                        _this.elemLocationTitle.removeClass('ui-autocomplete-loading');
                    }
                }).autocomplete();
            },
            select: function (event, ui) {
                _this.locationTitle = ui.item.data.address;
                _this.locationId = ui.item.data.id;
                _this.elemLocationTitleClear.parent().removeClass('hide');
            },
            close: function (event, ui) {
            },
            response: function (e, u) {
                _this.elemLocationTitle.removeClass('ui-autocomplete-loading');
            }
        });
        _this.elemLocationTitleClear.click(function () {
            _this.elemLocationTitle.val('');
            _this.locationId = 0;
            _this.locationTitle = '';
            _this.elemLocationTitle.focus();
            _this.elemLocationTitleClear.parent().addClass('hide');
        });
    },

    initEvents: function () {
        let _this = this;

        _this.elemNoLocation.click(function () {
            if ($(this).is(':checked')) {
                _this.elemLocationTitle.attr('disabled', true);
            } else {
                _this.elemLocationTitle.attr('disabled', false);
            }
        });

        _this.elemGenerateLink.click(function () {
            let location_no = 0;
            if (_this.elemNoLocation.is(':checked')) {
                location_no = 1;
            }
            new GraphQL("mutation", "buildCodeBitLyJob", {
                'job_id': _this.jobid,
                'location_id': _this.locationId,
                'job': FormValidate.getFieldValue('job', _this.form),
                'location': FormValidate.getFieldValue('location', _this.form),
                'location_no': location_no
            }, [
                'code_bitly'
            ], true, false, function (data) {
                Loader.stop();
            }, function (data) {
                if (data.code_bitly) {
                    //_this.elemGenerateLink.hide();
                    _this.elemShowCode.find('input').val(data.code_bitly);
                    _this.elemShowCode.show();
                }
            }, _this.form).request();

        });

        _this.form.on('keyup, click', function () {
            FormValidate.fieldsValidateClear(_this.form);
        });

        var clipboard = new Clipboard('#clipboard-button');
        clipboard.on('success', function (e) {
            $.notify('Copied!', 'success');
            e.clearSelection();
        });
        var clipboard = new Clipboard('#clipboard-button-too');
        clipboard.on('success', function (e) {
            $.notify('Copied!', 'success');
            e.clearSelection();
        });
    },

};

$(document).ready(function () {

    loadPromise.then(function () {
        var crLink = new CrLink();
        crLink.init();
    }).then(function () {
        app.runPromise();
    });

});
