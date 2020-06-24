var loaded = 0;
var businessATS;

function BusinessATS() {
    this.objects;
    this.searchText = '';
    this.checkSearchTimer;
    this.orderDirection = 'DESC';
    this.DOMHtml = {
        statusUpload: {},
        successImport: {},
        countAplicants: 0,
        chooseBtn: {},
        saveBtn: {}

    };
}

BusinessATS.prototype = {
    init: function () {
        BusinessATS.DOMHtml.saveBtn = $('.js-fileInput');
        BusinessATS.DOMHtml.chooseBtn = $('.js-uploadFile');
        BusinessATS.DOMHtml.countAplicants = $('.js-countApplicants');
        BusinessATS.DOMHtml.successImport = $('.js-success-import');
        BusinessATS.DOMHtml.statusUpload = $('.js-statusUpload');
        this.getList();
    },
    getList: function () {
        var params = {
            "business_id": APIStorage.read('business-id'),
            "order": $('.js-orderAts').val() || null,
            "direction": this.orderDirection
        };
        var htmlUpload = ' <div class="col-md-10 mx-auto mt-3">' +
            '<div class="row">' +
            '<div class="col-md-2 pr-0">' +
            '<div class="spinner">' +
            '<div class="rect1"></div>' +
            '<div class="rect2"></div>' +
            '<div class="rect3"></div>' +
            '<div class="rect4"></div>' +
            '<div class="rect5"></div>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-10 pl-0">' +
            '<p class="text-center"><strong>'+Langs.loading+'</strong> '+Langs.please_wait+'</p>' +
            '</div></div></div>';
        $('.js-atsItems').html(htmlUpload)

        var locale = APIStorage.read('language');
        if (locale != 'en') {
            params['locale'] = locale;
        }

        new GraphQL("query", "atsList", params,
            ['items{id, html}, count'], true, false, function () {
                Loader.stop();
            }, function (data) {
                $('.js-count').html(data.count)
                $('.js-atsItems').html('');
                $.each(data.items, function (i, el) {
                    $('.js-atsItems').append(el.html)
                })

            }, false).request();
    },
    resendEmail: function (id) {
        var params = {
            "business_id": APIStorage.read('business-id'),
            "id": id,
        };
        new GraphQL("query", "resendInvitationATS", params,
            ['token'], true, false, function () {
                Loader.stop();
            }, function () {
                BusinessATS.getList()
                $.notify(Langs.message_resubmitted, 'success');
            }, false).request();
    },
    search: function () {
        var params = {
            "business_id": APIStorage.read('business-id'),
            "order": $('.js-orderAts').val(),
            "direction": this.orderDirection
        };
        if(this.searchText != ''){
            alert(this.searchText);
            params["email"] = this.searchText;
        }

        var locale = APIStorage.read('language');
        if (locale != 'en') {
            params['locale'] = locale;
        }

        new GraphQL("query", "atsList", params,
            ['items{id, html}, count', 'token'], true, false, function () {
                Loader.stop();
            }, function (data) {
                $('.js-count').html(data.count)
                $('.js-atsItems').html('');
                $.each(data.items, function (i, el) {
                    $('.js-atsItems').append(el.html)
                })
            }, false).request();
    },
    importStatus: function () {
        var htmlUpload = ' <div class="col-md-10 mx-auto mt-3">' +
            '<div class="row">' +
            '<div class="col-md-2 pr-0">' +
            '<div class="spinner">' +
            '<div class="rect1"></div>' +
            '<div class="rect2"></div>' +
            '<div class="rect3"></div>' +
            '<div class="rect4"></div>' +
            '<div class="rect5"></div>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-10 pl-0">' +
            '<p class="text-center"><strong>'+Langs.uploading+'</strong> '+Langs.please_do_not_close+'</p>' +
            '</div></div></div>';

        var htmlImport = '<div class="col-md-10 mx-auto mt-3">' +
            '<div class="row">' +
            '<div class="col-md-2 pr-0">' +
            '<div class="spinner">' +
            '<div class="rect1"></div>' +
            '<div class="rect2"></div>' +
            '<div class="rect3"></div>' +
            '<div class="rect4"></div>' +
            '<div class="rect5"></div>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-10 pl-0">' +
            '<p class="text-center"><strong>'+Langs.importing+'</strong> '+Langs.please_do_not_close+'</p>' +
            '</div></div></div>';

        var formData = new FormData($('#ats_upload')[0])
        var createParams = {
            "business_id": APIStorage.read('business-id'),
        };
        $.each($('#ats_files')[0].files, function (i, file) {
            BusinessATS.DOMHtml.statusUpload.append(htmlUpload)
        });
        new GraphQL("mutation", "uploadImportAts", createParams, [
            'token, items{email,status, html}, count'
        ], true, false, function () {
            Loader.stop();
            BusinessATS.DOMHtml.statusUpload.html('');
            $.each($('#ats_files')[0].files, function (i, file) {
                BusinessATS.DOMHtml.statusUpload.append(htmlImport)
            });
        }, function (data) {
            BusinessATS.DOMHtml.statusUpload.html('');
            $('.js-success-import').removeClass('d-none');
            $('.js-countApplicants').html(data.count);
            BusinessATS.getList();
        }, false, formData).request();
    },
    setTimerSearch: function () {
        var _this = this;
        clearTimeout(_this.checkSearchTimer);
        _this.checkSearchTimer = setTimeout(function () {
            _this.searchText = $('#business-job-search').val();
            _this.search();
        }, 200);
    }
};


$(document).ready(function () {
    $(document).ajaxComplete(function () {
        if (typeof business.currentData !== 'undefined' && loaded === 0) {
            loaded = 1;
            BusinessATS = new BusinessATS();
            BusinessATS.init();
        }
    });

    $('.js-uploadFile').on('click', function () {
        $('.js-fileInput').click();
    });
    $('.js-fileInput').on('input', function () {
        BusinessATS.importStatus();
    });
    $('#import-ats').on('hidden.bs.modal', function () {
        BusinessATS.DOMHtml.statusUpload.html('');
        $('.js-success-import').addClass('d-none');
        $('.js-countApplicants').html(0);
    });

    $('.js-atsItems').on('click', '.js-resendEmail', function () {
        BusinessATS.resendEmail($(this).data('id'));
    });
    $('.js-searchATS').on('input', function () {
        BusinessATS.setTimerSearch();
    });
    $('.js-orderAts').on('input', function () {
        BusinessATS.setTimerSearch();
    });
    $('.js-orderDirection').on('click', function () {
        BusinessATS.orderDirection = $(this).data('val');
        if ($(this).data('val') === 'ASC') {
            $(this).data('val', 'DESC');
        } else {
            $(this).data('val', 'ASC')
        }
        BusinessATS.setTimerSearch();
    });
});
