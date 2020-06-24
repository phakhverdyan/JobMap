var id;
var currentForm;
var params;
var buttonCode;
var shareButton;
var image;
var scriptID;
var loaded = 0;


function ShareButton() {
    this.objects;
    this.scriptID;
    this.readyCode
}

ShareButton.prototype = {
    init: function () {
        shareButton.getAllButton();
    },
    getAllButton: function () {
        var params = {
            "business_id": APIStorage.read('business-id')
        };
        new GraphQL("query", "businessWebsiteButtons", params, [
            'id',
            'title',
            'code',
            'data',
            'html',
            'button_count',
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            if (data.length > 0) {
                $.each(data, function (i, el) {
                    $('.js-buttons_view').append(el.html);
                    $('.js-total').html(el.button_count);
                })
            }
        }, false).request();
    },
    create: function () {
        scriptID = 'z' + shareButton.generateID(6) + APIStorage.read('business-id');
        this.scriptID = scriptID
        currentForm = '#create-button-modal';
        shareButton.updateValue();
        $(currentForm + ' input,  ' + currentForm + ' textarea, ' + currentForm + ' select').on('input click change', function (e, el) {
            shareButton.updateValue();
        });
        $(currentForm + ' .js-example-basic-single').on('select2:select', function (e) {
            shareButton.updateValue();
        });
    },

    edit: function () {
        currentForm = '#edit-button-modal';
        var updateParams = {
            "business_id": APIStorage.read('business-id'),
            "id": id
        };
        new GraphQL("query", "businessWebsiteButton", updateParams, [
            'id',
            'title',
            'code',
            'data',
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            if (data.data) {
                params = JSON.parse(Base64.decode(data.data));
                shareButton.setValue();
            }
        }, false).request();

        $(currentForm + ' input,' + currentForm + ' textarea, ' + currentForm + ' select').on('input click change', function (e) {
            shareButton.updateValue();
        });
        $(currentForm + ' .js-example-basic-single').on('select2:select', function (e) {
            shareButton.updateValue();
        });
    },

    setValue: function () {

        $(currentForm + ' input[name="button_name"]').val(params.btnName);
        $(currentForm + ' input[name="bg_color"]').val('#' + params.bgColor);
        $(currentForm + ' input[name="bg_hover_color"]').val('#' + params.bgHoverColor);
        $(currentForm + ' input[name="border_color"]').val('#' + params.borderColor);
        $(currentForm + ' input[name="border_hover_color"]').val('#' + params.borderHoverColor);
        $(currentForm + ' input[name="border_size"]').val(params.borderSize);
        $(currentForm + ' input[name="font_color"]').val('#' + params.fontColor);
        $(currentForm + ' input[name="font_hover_color"]').val('#' + params.fontHoverColor);
        $(currentForm + ' input[name="font_size"]').val(params.fontSize);
        $(currentForm + ' select[name="font_family"]').val(params.fontFamily);
        $(currentForm + ' input[name="button_message"]').val(params.buttonMessage);
        $(currentForm + ' input[name="width"]').val(params.width);
        $(currentForm + ' input[name="height"]').val(params.height);
        $(currentForm + ' input[name="button-shape-options"][value=' + params.btnShape + ']').attr('checked', 'checked');
        this.scriptID = params.scriptID;
        shareButton.preview();
        shareButton.code();
    },
    updateValue: function () {
        params = {
            btnName: $(currentForm + ' input[name="button_name"]').val(),
            bgColor: shareButton.removeHash($(currentForm + ' input[name="bg_color"]').val()),
            bgHoverColor: shareButton.removeHash($(currentForm + ' input[name="bg_hover_color"]').val()),
            borderColor: shareButton.removeHash($(currentForm + ' input[name="border_color"]').val()),
            borderHoverColor: shareButton.removeHash($(currentForm + ' input[name="border_hover_color"]').val()),
            borderSize: $(currentForm + ' input[name="border_size"]').val(),
            fontColor: shareButton.removeHash($(currentForm + ' input[name="font_color"]').val()),
            fontHoverColor: shareButton.removeHash($(currentForm + ' input[name="font_hover_color"]').val()),
            fontSize: $(currentForm + ' input[name="font_size"]').val(),
            fontFamily: $(currentForm + ' select[name="font_family"]').val(),
            btnShape: $(currentForm + ' input[name="button-shape-options"]:checked').val(),
            buttonMessage: $(currentForm + ' input[name="button_message"]').val(),
            width: parseInt($(currentForm + ' input[name="width"]').val()),
            height: parseInt($(currentForm + ' input[name="height"]').val()),
            scriptID: this.scriptID
        };
        shareButton.preview();
        shareButton.code();
    },
    preview: function () {
        var parent = $(currentForm + ' .js-preview')[0];
        parent.innerHTML = '';
        var css = '.js-preview a{ color: #' + params.fontColor + '; font-size: ' + params.fontSize + 'px; font-family: ' + params.fontFamily + '; line-height:1.3; background-color: #' + params.bgColor + '; border: ' + params.borderSize + 'px solid #' + params.borderColor + '; width:' + params.width + 'px; height:' + params.height + 'px; display:flex; justify-content: center; align-items: center; transition: all 0.3s; position:relative; overflow: hidden;}' +
            '.js-preview a:hover{ color: #' + params.fontHoverColor + '; background-color: #' + params.bgHoverColor + '; border-color: #' + params.borderHoverColor + '; transition: all 0.3s; }' +
            '.js-preview .block_image{position: absolute;  top: 0px; left: 0px; width: 0;height: 0; background-image:url("") no-repeat; }' +
            '.js-preview .button_text{ position:absolute; }';

        var block = document.createElement("a");
        var block_image = document.createElement("div");
        block_image.className = 'block_image';
        var text = document.createElement("span");
        text.className = 'button_text';
        block.href = 'https://jobmap.co/business/view/' + shareButton.getUrl();
        switch (params.btnShape) {
            case 'style1':
                css += '.js-preview a{border-radius: 15px;}';
                break;
            case 'style2':
                css += '.js-preview a{border-radius: 4px;}';
                break;
            case 'style3':
                css += '.js-preview a{border-radius: 0;}';
                break;
            case 'style4':
                css += '.js-preview a{border-radius: 0;}';
                break;
            case 'style5':
                css += '.js-preview a{border-radius: 4px;}';
                break;
            case 'style6':
                css += '.js-preview a{border-radius: 100%;}';
                break;
            default:
                break
        }

        var style = document.getElementById('preview-style');
        if (!style) {
            style = document.createElement('style');
        }
        style.id = 'preview-style';
        style.innerHTML = '';
        style.appendChild(document.createTextNode(css));
        document.getElementsByTagName('head')[0].appendChild(style);
        text.innerHTML = params.buttonMessage;
        block.appendChild(block_image);
        block.appendChild(text)
        parent.appendChild(block);

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
    code: function () {
        this.readyCode = '<script id="' + params.scriptID + '">var _crb = _crb || [];_crb.push(["' + params.buttonMessage + '", "' + params.scriptID + '", "' + shareButton.getUrl() + '", "' + params.fontColor + '|' + params.fontSize + '|' + params.fontFamily + '|' + params.fontHoverColor + '","' + params.bgColor + '|' + params.width + '|' + params.height + '|' + params.bgHoverColor + '", "' + params.borderColor + '|' + params.borderSize + '|' + params.btnShape + '|' + params.borderHoverColor + '"])</script><script async src="http://jobmap.co/js/app/d.js?ver=' + params.scriptID + '"></script>';
        buttonCode = shareButton.escapeHtml(this.readyCode);
    },
    escapeHtml: function (string) {
        return String(string).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    },
    copy: function (target) {
        var clipboard = new Clipboard('.js-copy_code');
        clipboard.on('success', function (e) {
            $.notify('Copied!', 'success');
            e.clearSelection();
        });
    },
    submit: function () {
        var createParams = {
            "business_id": APIStorage.read('business-id'),
            "title": params.btnName,
            "code": Base64.encode(shareButton.escapeHtml(this.readyCode)),
            "data": Base64.encode(JSON.stringify(params))
        };
        new GraphQL("mutation", "createButton", createParams, [
            'token', 'html'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            setTimeout(function () {
                $('.js-buttons_view').html('')
                shareButton.getAllButton();
                $('#create-button-modal').modal('hide')
            }, 700);
        }, false).request();
    },
    update: function () {
        var createParams = {
            "id": id,
            "business_id": APIStorage.read('business-id'),
            "title": params.btnName,
            "code": Base64.encode(shareButton.escapeHtml(this.readyCode)),
            "data": Base64.encode(JSON.stringify(params))
        };
        new GraphQL("mutation", "updateButton", createParams, [
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            $('.js-buttons_view').html('')
            shareButton.getAllButton();
            $('#edit-button-modal').modal('hide')
        }, false).request();
    },
    delete: function () {
        var createParams = {
            "business_id": APIStorage.read('business-id'),
            'id': id
        };
        new GraphQL("mutation", "deleteButton", createParams, [
            'token'
        ], true, false, function () {
            Loader.stop();
            Loader.stop();delete-button-modal
        }, function (data) {
            $('#delete-button-modal').modal('hide');
            $('#button-' + id).remove();
        }, false).request();
    }
};

$(document).ready(function () {
    $(document).ajaxComplete(function () {
        if (typeof business.currentData !== 'undefined' && loaded === 0) {
            loaded = 1;
            shareButton = new ShareButton();
            shareButton.init();
        }
    });


    $('.js-create-button').on('click', function () {
        $('#create-button-modal').modal('show');
        shareButton.create();
    });

    $('#create-button-modal .js-submit').on('click', function (e) {

        e.preventDefault();
        shareButton.submit();
        document.getElementById('share_button_create_form').reset();
    });
    $('#edit-button-modal .js-submit').on('click', function (e) {
        e.preventDefault();
        shareButton.update();
        document.getElementById('share_button_edit_form').reset();


    });

    $('.js-buttons_view').on('click', '.js-edit-button', function () {
        $('#edit-button-modal').modal('show');
        id = $(this).data('id');
        shareButton.edit();
    });
    $('.js-buttons_view').on('click', '.js-delete-button', function () {
        $('#delete-button-modal').modal('show');
        id = $(this).data('id');
    });
    $('.js-buttons_view').on('click', '.js-copy_code', function () {
        shareButton.copy();
    });
    $('#business-website-button-confirm-delete').on('click', function () {
        shareButton.delete();
    });
    $('.js-reset').on('click', function () {
        document.getElementById('share_button_edit_form').reset();
        document.getElementById('share_button_create_form').reset();
    });
});



