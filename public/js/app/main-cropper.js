function CropAvatar(avatarView, changeBtn, form, query, needParams, callback, origin, type_cropper) {
    var $element = $('body');
    this.avatarView = avatarView;
    this.$container = $element;
    this.$form = form;
    this.query = query;
    this.needParams = needParams;
    this.callback = callback;
    this.type_cropper = type_cropper || 'business';

    this.$avatarView = this.$container.find('.' + avatarView);
    this.$avatar = this.$avatarView.find('img');
    this.$avatarModal = this.$container.find('#avatar-modal');
    this.$loading = this.$container.find('.loading');

    this.$changeBtn = this.$container.find('#' + changeBtn);
    this.$saveBtn = this.$container.find('.avatar-save');

    this.$avatarForm = this.$avatarModal.find('.avatar-form');
    this.$avatarUpload = this.$avatarForm.find('.avatar-upload');
    this.$avatarSrc = this.$avatarForm.find('.avatar-src');
    this.$avatarData = this.$avatarForm.find('.avatar-data');
    this.$avatarInput = this.$avatarForm.find('.avatar-input');
    this.$avatarSave = this.$avatarForm.find('.avatar-save');
    this.$avatarBtns = this.$avatarForm.find('.avatar-btns');

    this.$avatarWrapper = this.$avatarModal.find('.avatar-wrapper');
    this.$avatarPreview = this.$avatarModal.find('.avatar-preview');

    this.originURL = origin;

    this.init();
}

CropAvatar.prototype = {
    constructor: CropAvatar,

    support: {
        fileList: !!$('<input type="file">').prop('files'),
        blobURLs: !!window.URL && URL.createObjectURL,
        formData: !!window.FormData
    },

    init: function () {
        this.support.datauri = this.support.fileList && this.support.blobURLs;

        if (!this.support.formData) {
            this.initIframe();
        }
        this.initModal();
        this.addListener();
    },

    addListener: function () {
        this.$avatarView.on('click', $.proxy(this.click, this));
        this.$changeBtn.on('click', $.proxy(this.click, this));
        this.$avatarInput.on('change', $.proxy(this.change, this));
        this.$saveBtn.on('click', $.proxy(this.submit, this));
        this.$avatarBtns.on('click', $.proxy(this.rotate, this));
    },

    initModal: function () {
        this.$avatarModal.modal({
            show: false
        });
        var _this = this;
        this.$avatarModal.on('hidden.bs.modal', function () {
            _this.$avatarForm.get(0).reset();
            _this.stopCropper();
        })
    },

    initPreview: function () {
        var url = this.$avatar.attr('src');

        this.$avatarPreview.html('<img src="' + url + '">');
    },

    initIframe: function () {
        var target = 'upload-iframe-' + (new Date()).getTime();
        var $iframe = $('<iframe>').attr({
            name: target,
            src: ''
        });
        var _this = this;

        // Ready iframe
        $iframe.one('load', function () {

            // respond response
            $iframe.on('load', function () {
                var data;

                try {
                    data = $(this).contents().find('body').text();
                } catch (e) {
                    console.log(e.message);
                }

                if (data) {
                    try {
                        data = $.parseJSON(data);
                    } catch (e) {
                        console.log(e.message);
                    }

                    _this.submitDone(data);
                } else {
                    _this.submitFail('Image upload failed!');
                }

                _this.submitEnd();

            });
        });

        this.$iframe = $iframe;
        this.$avatarForm.attr('target', target).after($iframe.hide());
    },

    click: function () {
        this.$avatarModal.modal('show');
        this.initPreview();

        if(this.originURL){
            this.url = this.originURL;
            this.startCropper();
        }
    },

    change: function () {
        var files;
        var file;

        if (this.support.datauri) {
            files = this.$avatarInput.prop('files');

            if (files.length > 0) {
                file = files[0];

                if (this.isImageFile(file)) {
                    if (this.url) {
                        URL.revokeObjectURL(this.url); // Revoke the old one
                    }

                    this.url = URL.createObjectURL(file);
                    this.startCropper();
                }
            }
        } else {
            file = this.$avatarInput.val();

            if (this.isImageFile(file)) {
                this.syncUpload();
            }
        }
    },

    submit: function () {
        if (!this.query) {
            this.tmpPreview();
            return;
        }

        if (!this.$avatarSrc.val() && !this.$avatarInput.val()) {
            this.ajaxUpload();
            return;
        }

        if (this.support.formData) {
            this.ajaxUpload();
            return false;
        }
    },

    tmpPreview: function () {
        var _this = this;
        // if($('.avatar-input').prop('files').length !== 0) {
            pictureForm = new FormData(this.$avatarForm.get(0));
            var file_image = document.getElementById('avatar-input').files[0];
            if(typeof file_image != "undefined") {
                var reader = new FileReader();
                reader.onloadend = function() {
                    logoBusiness = reader.result;
                };
                reader.readAsDataURL(file_image);
            }
            var data = $('.cropper-hidden').cropper('getCroppedCanvas').toDataURL("image/png");
            //this.$avatarView.find('img').attr('src', data);
        // }
        //_this.cropDone();
        var currentData = business.currentData || business.currentDataBrand || null;

        if (currentData && _this.type_cropper != 'location_add') {
            var method_mutation = 'updateImageBusiness';
            var params = { id: currentData.id };
            if (_this.type_cropper == 'location_edit') {
                method_mutation = 'updateImageLocation';
                params['business_id'] = currentData.id;
                params['id'] = getUrlParameter('id');
            }

            new GraphQL("mutation", method_mutation, params, ['picture_o','token','error_message'], true, false, function () {
                Loader.stop();
            }, function (data) {
                if (data.picture_o) {
                    currentData.picture_o = data.picture_o;
                    _this.originURL = data.picture_o;
                    _this.$avatarView.find('img').attr('src', _this.originURL);
                }
                if (data.error_message){
                    $('#errorImageAvatar').modal('show');
                    return;
                }
                _this.cropDone();
            },false, pictureForm).request();
        } else {
            _this.$avatarView.find('img').attr('src', data);
            _this.cropDone();
        }
    },

    rotate: function (e) {
        var data;

        if (this.active) {
            data = $(e.target).data();

            if (data.method) {
                this.$img.cropper(data.method, data.option);
            }
        }
    },

    isImageFile: function (file) {
        if (file.type) {
            return /^image\/\w+$/.test(file.type);
        } else {
            return /\.(jpg|jpeg|png|gif)$/.test(file);
        }
    },

    startCropper: function () {
        var _this = this;

        if (this.active) {
            this.$img.cropper('replace', this.url);
        } else {
            this.$img = $('<img src="' + this.url + '">');
            this.$avatarWrapper.empty().html(this.$img);
            this.$img.cropper({
                aspectRatio: 1,
                viewMode: 0,
                minCropBoxWidth: 200,
                background: true,
                highlight: false,
                preview: this.$avatarPreview,
                crop: function (e) {
                    var json = [
                        '{"x":' + e.x,
                        '"y":' + e.y,
                        '"height":' + e.height,
                        '"width":' + e.width,
                        '"rotate":' + e.rotate + '}'
                    ].join();

                    _this.$avatarData.val(json);
                }
            });

            this.active = true;
        }

        this.$avatarModal.one('hidden.bs.modal', function () {
            _this.$avatarPreview.empty();
            _this.stopCropper();
        });
    },

    stopCropper: function () {
        if (this.active) {
            this.$img.cropper('destroy');
            this.$img.remove();
            this.active = false;
        }
    },

    ajaxUpload: function () {
        var data = new FormData(this.$avatarForm[0]);
        var _this = this;

        var form = this.form;
        //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
        new GraphQL("mutation", this.query, {}, this.needParams, true, false, function (data) {
            Loader.stop();
        }, function (data) {
            _this.submitDone(data);
        }, form, data).request();
    },

    syncUpload: function () {
        this.$avatarSave.click();
    },

    submitDone: function (data) {
        var _this = this;
        if ($.isPlainObject(data)) {

            if (data.error_message){
                $('#errorImageAvatar').modal('show');
                return;
            }

            if (data.user_pic) {
                _this.url = data.user_pic;

                user.data.user_pic = data.user_pic_o;
                _this.originURL = data.user_pic_o;

                if (_this.support.datauri || _this.uploaded) {
                    _this.uploaded = false;
                    if (data.user_pic) {
                        _this.callback(data);
                    }
                    _this.cropDone();
                } else {
                    _this.uploaded = true;
                    _this.startCropper();
                }

                _this.$avatarInput.val('');
            } else if (data.message) {
                _this.alert(data.message);
            }
        } else {
            _this.alert('Failed to response');
        }
    },

    submitFail: function (msg) {
        this.alert(msg);
    },

    submitEnd: function () {
        this.$loading.fadeOut();
    },

    cropDone: function () {
        var _this = this;
        _this.$avatarForm.get(0).reset();
        _this.stopCropper();
        _this.$avatarModal.modal('hide');
        Loader.stop();
    },

    alert: function (msg) {
        var $alert = [
            '<div class="alert alert-danger avatar-alert alert-dismissable">',
            '<button type="button" class="close" data-dismiss="alert">&times;</button>',
            msg,
            '</div>'
        ].join('');

        this.$avatarUpload.after($alert);
    }
};
