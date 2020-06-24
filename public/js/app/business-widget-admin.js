var id;
var currentForm;
var params;
var buttonCode;
var widgetButton;
var image;
var scriptID;
var loaded = 0;


function BusinessWidgetAdmin() {
    this.objects;
    this.scriptID;
}

BusinessWidgetAdmin.prototype = {
    init: function () {
        widgetButton.getAllButton();
        widgetButton.getBrands();
    },
    getAllButton: function () {
        var params = {
            "business_id": APIStorage.read('business-id')
        };
        new GraphQL("query", "businessWebsiteWidgets", params, [
            'id',
            'code',
            'business {id name picture_50(width:50, height:50)}',
            'html',
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            // var widgetPreview = $('.website-widget select[name="widget_preview"]');
            if (data.length > 0) {
                // widgetPreview.find('option').not(':first').remove();

                $.each(data, function (i, el) {
                    $('.js-widget-view').append(el.html);
                    $('.brand-logo-' + el.business.id).attr('src', el.business.picture_50);
                    // widgetPreview.append('<option value="'+ el.code +'">'+ el.code.substring(0, 8) + ' - ' + el.business.name +'</option>');
                });
            }
        }, false).request();
    },
    getBrands: function () {
        var params = {
            "business_id": APIStorage.read('business-id')
        };
        new GraphQL("query", "businessBrandsAll", params, [
            'items {id name}',
            'pages',
            'current_page'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            $.each(data.items, function (key, brand) {
                $('#widget-modal select[name="brand"]').append('<option value="'+ brand.id +'">'+ brand.name +'</option>');
            });
        }, false).request();
    },
    create: function () {
        widgetButton.showCreateElements();
        var businessID = APIStorage.read('business-id');
        scriptID = 'z' + widgetButton.generateID(11) + businessID;
        this.scriptID = scriptID
        currentForm = '#widget-modal';
        widgetButton.resetModalForm();
        widgetButton.updateValue();
    },

    edit: function () {
        widgetButton.showUpdateElements();
        currentForm = '#widget-modal';
        var updateParams = {
            "business_id": APIStorage.read('business-id'),
            "id": id
        };
        new GraphQL("query", "businessWebsiteWidget", updateParams, [
            'id',
            'business_id',
            'brand_id',
            'show_job_posted_date',
            'size_widget',
            'background_color',
            'link_one_color',
            'font_color',
            'button_background_color',
            'button_text_color',
            'background_image',
            'show_background_image',
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            if (data) {
                params = data;
                console.log(data);
                widgetButton.setValue();
            }
        }, false).request();
    },

    setValue: function () {
        $('#widget-modal select[name="brand"]').val(params.brand_id);
        $('#widget-modal input[name="show_job_posted_date"]').attr('checked', params.show_job_posted_date);
        $('#widget-modal select[name="size_widget"]').val(params.size_widget||"small");
        $('#widget-modal input[name="bg_color"]').css({"background-color": params.background_color||"transparent"}).val(params.background_color||"transparent");
        $('#widget-modal input[name="link_1_color"]').css({"background-color": params.link_one_color||"0000ff"}).val(params.link_one_color||"0000ff");
        $('#widget-modal input[name="font_color"]').css({"background-color": params.font_color||"000000"}).val(params.font_color||"000000");
        $('#widget-modal input[name="button_background_color"]').css({"background-color": params.button_background_color||"4266ff"}).val(params.button_background_color||"4266ff");
        $('#widget-modal input[name="button_text_color"]').css({"background-color": params.button_text_color||"ffffff"}).val(params.button_text_color||"ffffff");
        $('#widget-modal input[name="background_image_file"]').val(params.background_image);
        $('#widget-modal .background-image-prev').attr('src', widgetButton.imageUrl(params.background_image));
        $('#widget-modal input[name="show_background_image"]').attr('checked', params.show_background_image);
    },
    updateValue: function () {
        params = {
            brand_id: $(currentForm + ' select[name="brand"]').val(),
            show_job_posted_date: $(currentForm + ' input[name="show_job_posted_date"]').is(':checked') ? 1 : 0,
            size_widget: $(currentForm + ' select[name="size_widget"]').val(),
            background_color: widgetButton.removeHash($(currentForm + ' input[name="bg_color"]').val()),
            link_one_color: widgetButton.removeHash($(currentForm + ' input[name="link_1_color"]').val()),
            font_color: widgetButton.removeHash($(currentForm + ' input[name="font_color"]').val()),
            button_background_color: widgetButton.removeHash($(currentForm + ' input[name="button_background_color"]').val()),
            button_text_color: widgetButton.removeHash($(currentForm + ' input[name="button_text_color"]').val()),
            background_image: $(currentForm + ' input[name="background_image_file"]').val(),
            show_background_image: $(currentForm + ' input[name="show_background_image"]').is(':checked') ? 1 : 0,
        };
    },
    getUrl: function () {
        return business.currentData.id + '/' + business.currentData.slug;
    },
    removeHash: function (str) {
        return str.replace('#', '');
    },
    generateID: function (limit) {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < limit; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    },
    copyToClipboard: function (target) {
        $(target).select();
        document.execCommand('copy');
        $.notify('The widget code was copied!', 'success');
    },
    submit: function () {
        widgetButton.updateValue();
        var createParams = {
            "business_id": APIStorage.read('business-id'),
            "code": this.scriptID
        };

        new GraphQL("mutation", "createWidget", Object.assign(createParams, params), [
            'token', 'html'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            setTimeout(function () {
                $('.js-widget-view').html('')
                widgetButton.getAllButton();
                $('#widget-modal').modal('hide')
            }, 700);
        }, false).request();
    },
    update: function () {
        widgetButton.updateValue();
        var updateParams = {
            "id": id,
            "business_id": APIStorage.read('business-id'),
        };
        new GraphQL("mutation", "updateWidget", Object.assign(updateParams, params), [
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            $('.js-widget-view').html('');
            widgetButton.getAllButton();
            $('#widget-modal').modal('hide');
            widgetButton.resetModalForm();
        }, false).request();
    },
    delete: function () {
        var createParams = {
            "business_id": APIStorage.read('business-id'),
            'id': id
        };
        new GraphQL("mutation", "deleteWidget", createParams, [
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            $('#delete-widget-modal').modal('hide');
            $('#widget-' + id).remove();
        }, false).request();
    },
    uploadBackgroundImage: function (files) {

        if (files.length === 0) {
            $.notify('Please, choose background image', 'error');
            return false;
        }

        var file = files[0];
        var fileType = file.type;
        var fileSize = file.size;

        if (widgetButton.imageValidationType(fileType) === false) {
            $.notify('Background image can be one of the following formats: png, jpg', 'error');
            return false;
        }

        // Validate CV file size (max 5mb)
        if (widgetButton.imageValidationSize(fileSize) === false) {
            $.notify('Image file size can\'t exceed 5 megabytes', 'error');
            return false;
        }

        var formData = new FormData();
        formData.append('background_image_file', file);

        var params = {
            'id': APIStorage.read('business-id')
        };

        /**
         * Upload background image
         */
        new GraphQL(
            "query",
            "businessWidgetUploadBgImage",
            params,
            [ 'background_image_file' ],
            false,
            false,
            function () {
                Loader.stop();
            }, function (data) {
                $(currentForm + ' input[name="background_image_file"]').val(data.background_image_file);
                $(currentForm + ' .background-image-prev').attr('src', widgetButton.imageUrl(data.background_image_file));
            },
            false,
            formData
        ).request();
    },
    // preview: function (code) {
    //     $('#widget_preview_box').text('Selected widget code -' + code);
    // },
    imageValidationType: function (fileType) {
        var types = [
            'image/jpeg',
            'image/png',
        ];
        return types.includes(fileType);
    },
    imageValidationSize: function (fileSize) {
        var maxFileBytes = 5000000; // 5MB (in decimal)

        return fileSize < maxFileBytes
    },
    resetModalForm: function () {
        document.getElementById('business_widget_create_form').reset();
        $(currentForm + ' .background-image-prev').attr('src', '');
    },
    imageUrl: function (fileName) {
        return window.location.origin + '/business/' + APIStorage.read('business-id') + '/widgets/' +  fileName;
    },
    showCreateElements: function () {
        $('.create-widget-title, .js-submit').show();
        $('.update-widget-title, .js-update').hide();
    },
    showUpdateElements: function () {
        $('.create-widget-title, .js-submit').hide();
        $('.update-widget-title, .js-update').show();
    },
};

$(document).ready(function () {
    $(document).ajaxComplete(function () {
        if (typeof business.currentData !== 'undefined' && loaded === 0) {
            loaded = 1;
            widgetButton = new BusinessWidgetAdmin();
            widgetButton.init();
        }
    });

    $('.js-create-widget-button').on('click', function () {
        $('#widget-modal').modal('show');
        widgetButton.create();
    });

    $('#widget-modal .js-submit').on('click', function (e) {
        e.preventDefault();
        widgetButton.submit();
        document.getElementById('business_widget_create_form').reset();
    });
    $('#widget-modal .js-update').on('click', function (e) {
        e.preventDefault();
        widgetButton.update();
    });

    $('.js-widget-preview').on('click', '.js-preview-button', function () {
        id = $(this).data('id');
        widgetButton.edit();
    });

    $('.js-widget-view').on('click', '.js-edit-button', function () {
        $('#widget-modal').modal('show');
        id = $(this).data('id');
        widgetButton.edit();
    });

    $('.js-widget-view').on('click', '.js-delete-button', function () {
        $('#delete-widget-modal').modal('show');
        id = $(this).data('id');
    });
    $('.js-widget-view').on('click', '.js-copy_code', function () {
        widgetButton.copyToClipboard($(this).data('code-id'));
    });
    $('#business-website-button-confirm-delete').on('click', function () {
        widgetButton.delete();
    });
    $('.js-reset').on('click', function () {
        document.getElementById('business_widget_create_form').reset();
    });

    $('#widget-modal .select_background_image').on('click', function(e){
        e.preventDefault();
        $('#widget-modal input[name="background_image"]').trigger('click');
    });

    $('#widget-modal input[name="background_image"]').on('change', function(e){
        e.preventDefault();
        widgetButton.uploadBackgroundImage(e.target.files);
    });

    // $('.website-widget select[name="widget_preview"]').on('change', function(e){
    //     e.preventDefault();
    //     widgetButton.preview(e.target.value);
    // });
});



