function CropBusinessBG(avatarView, changeBtn, form, query, needParams, callback, origin) {
    var $element = $('body');
    this.avatarView = avatarView;
    this.$container = $element;
    this.$form = form;
    this.query = query;
    this.needParams = needParams;
    this.callback = callback;

    this.$avatarView = this.$container.find('.' + avatarView);
    this.$avatar = this.$avatarView.find('img');
    this.$avatarModal = this.$container.find('#business-bg-modal');
    this.$loading = this.$container.find('.loading');

    this.$changeBtn = this.$container.find('#' + changeBtn);
    this.$addBtn = this.$container.find('.business-bg-add');
    this.$delBtn = this.$container.find('.business-bg-del');
    this.$saveBtn = this.$container.find('.business-bg-save');

    this.$avatarForm = this.$avatarModal.find('.business-bg-form');
    this.$avatarUpload = this.$avatarForm.find('.business-bg-upload');
    this.$avatarSrc = this.$avatarForm.find('.business-bg-src');
    this.$avatarData = this.$avatarForm.find('.business-bg-data');
    this.$avatarInput = this.$avatarForm.find('.business-bg-input');
    this.$avatarSave = this.$avatarForm.find('.business-bg-save');
    this.$avatarBtns = this.$avatarForm.find('.business-bg-btns');

    this.$avatarWrapper = this.$avatarModal.find('.business-bg-wrapper');
    this.$avatarPreview = this.$avatarModal.find('.business-bg-preview');

    this.originURL ='';
    this.originURLs =[];
    if (origin.length > 0) {
        //this.originURL = origin[origin.length-1].bg_picture;
        this.originURLs = origin;
    }

    this.numberId = 1;

    this.init();
}

CropBusinessBG.prototype = {
    constructor: CropBusinessBG,

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
        //this.$avatarView.on('click', $.proxy(this.click, this));
        this.$changeBtn.on('click', $.proxy(this.click, this));
        this.$avatarInput.on('change', $.proxy(this.change, this));
        this.$addBtn.on('click', $.proxy(this.add, this));
        //this.$saveBtn.on('click', $.proxy(this.submit, this));
        this.$avatarBtns.on('click', $.proxy(this.rotate, this));

        this.$delBtn.on('click', $.proxy(this.del, this));
        var _this = this;
        this.$container.on('click','.business-bg-del',function () { _this.del($(this)); });
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
        //var url = this.$avatar.attr('src');
        var url = '/img/bg-white-cr.png';
        if (this.originURL) {
            url = this.originURL;
        }

        this.$avatarPreview.html('<img src="' + url + '">');

        if (this.originURLs.length > 0) {//} && this.originURLs[0].id != 0) {
            $('#sortable').children().remove();
            this.originURLs.forEach(function (item) {
                let htmlBlock = `<div class="col-lg-4 pl-lg-0 my-3">
                                <button type="button" class="close business-bg-del" style="position: absolute; right: 20px; color:#000; cursor: pointer; opacity:1;" data-id="` + item.id + `">&times;</button>
                                <img class="d-block w-100 rounded" src="` + item.bg_picture + `" alt="First slide">
                            </div>`;
                $('#sortable').append(htmlBlock);
            });
        }
        
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

    add: function () {
        if (this.originURL ) {
            backgroundForm = new FormData(this.$avatarForm.get(0));
            var data = $('.cropper-hidden').cropper('getCroppedCanvas').toDataURL("image/png");
            var _this = this;
            var currentData = business.currentData || business.currentDataBrand || null;

            if (currentData) {
                new GraphQL("mutation", 'updateImageBusiness', { id: currentData.id }, ['id', 'business_id', 'bg_picture','token','error_message'], true, false, function () {
                    Loader.stop();
                }, function (data) {
                    if (data.id) {
                        let dataIm = {
                            'id': data.id,
                            'business_id': data.business_id,
                            'bg_picture': data.bg_picture,
                        };
                        var addClass = '';
                        if (_this.originURLs.length == 0) {
                            _this.$avatarView.find('.carousel-inner').children().remove();
                            addClass = 'active';
                        }
                        //business.currentData.images.push(dataIm);
                        _this.originURLs.push(dataIm);
                        _this.$avatarForm.get(0).reset();
                        _this.originURL = '';
                        //_this.$avatarView.find('img').attr('src', dataIm.bg_picture).attr('data-id',dataIm.id);
                        let htmlBlock = `<div class="col-lg-4 pl-lg-0 my-3">
                                <button type="button" class="close business-bg-del" style="position: absolute; right: 20px; color:#000; cursor: pointer; opacity:1;" data-id="` + dataIm.id + `">&times;</button>
                                <img class="d-block w-100 rounded" src="` + dataIm.bg_picture + `" alt="First slide">
                            </div>`;
                        $('#sortable').append(htmlBlock);

                        htmlBlock = '<div class="carousel-item ' + addClass + '" data-id="' + dataIm.id + '"><img class="d-block w-100" src="' + dataIm.bg_picture + '" alt="' + currentData.name + '"></div>';
                        _this.$avatarView.find('.carousel-inner').append(htmlBlock);

                    }
                    if (data.error_message){
                        $('#errorImageAvatar').modal('show');
                        return;
                    }
                    _this.cropDone();
                },false, backgroundForm).request();
            } else {
                //this.$avatarView.find('img').attr('src', data);

                var file_image = document.getElementById('business-bg-input').files[0];
                var database64='';
                var reader = new FileReader();
                reader.onloadend = function() {
                    database64 = reader.result;

                    let dataIm = {
                        'id': this.numberId,
                        'business_id': 0,
                        'bg_picture': data,
                        'bg_picture_origin': database64,
                        'bg_crop_data': $('.business-bg-data').val(),
                    };
                    var addClass = '';
                    if (_this.originURLs.length == 0) {
                        _this.$avatarView.find('.carousel-inner').children().remove();
                        addClass = 'active';
                    }
                    _this.originURLs.push(dataIm);
                    _this.$avatarForm.get(0).reset();
                    _this.originURL = '';
                    let htmlBlock = `<div class="col-lg-4 pl-lg-0 my-3">
                                <button type="button" class="close business-bg-del" style="position: absolute; right: 20px; color:#000; cursor: pointer; opacity:1;" data-id="` + this.numberId + `">&times;</button>
                                <img class="d-block w-100 rounded" src="` + data + `" alt="First slide">
                            </div>`;
                    $('#sortable').append(htmlBlock);

                    htmlBlock = '<div class="carousel-item ' + addClass + '" data-id="' + this.numberId + '"><img class="d-block w-100" src="' + data + '" alt=""></div>';
                    _this.$avatarView.find('.carousel-inner').append(htmlBlock);

                    this.numberId++;

                    _this.cropDone();

                };
                reader.readAsDataURL(file_image);
            }
        }

    },

    del: function (elem) {
        var _this = this;
        var id = elem.attr('data-id');
        var currentData = business.currentData || business.currentDataBrand || null;

        if (currentData) {
            new GraphQL("mutation", 'deleteImageBusiness', { id: id }, ['token','response'], true, false, function () {
                Loader.stop();
            }, function (data) {
                if (data.response == 'ok') {
                    for(let i=0;i<_this.originURLs.length;i++) {
                        if (_this.originURLs[i].id == id) {
                            _this.originURLs.splice(i, 1);
                            break;
                        }
                    }
                    elem.parent().remove();
                    if (_this.originURLs.length == 0) {
                        let htmlBlock = '<div class="carousel-item active" data-id="0"><img class="d-block w-100" src="/img/bg-white-cr.png" alt="' + currentData.name + '"></div>';
                        _this.$avatarView.find('.carousel-inner').append(htmlBlock);
                    }
                    _this.$avatarView.find('.carousel-inner .carousel-item').each(function() {
                        if ($(this).attr('data-id') == id) {
                            $setActive = false;
                            if ($(this).hasClass('active')) {
                                $(this).removeClass('active');
                                $setActive = true;
                            }
                            $(this).remove();
                            if ($setActive) {
                                _this.$avatarView.find('.carousel-inner .carousel-item').eq(0).addClass('active');
                            }
                        }
                    });

                } else {
                }
            }).request();
        } else {
            for(let i=0;i<_this.originURLs.length;i++) {
                if (_this.originURLs[i].id == id) {
                    _this.originURLs.splice(i, 1);
                    break;
                }
            }
            elem.parent().remove();
            if (_this.originURLs.length == 0) {
                let htmlBlock = '<div class="carousel-item active" data-id="0"><img class="d-block w-100" src="/img/bg-white-cr.png" alt=""></div>';
                _this.$avatarView.find('.carousel-inner').append(htmlBlock);
            }
            _this.$avatarView.find('.carousel-inner .carousel-item').each(function() {
                if ($(this).attr('data-id') == id) {
                    $setActive = false;
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active');
                        $setActive = true;
                    }
                    $(this).remove();
                    if ($setActive) {
                        _this.$avatarView.find('.carousel-inner .carousel-item').eq(0).addClass('active');
                    }
                }
            });
        }

    },

    sortURLs: function () {
        var _this = this;
        var sortArray = [];
        var htmlItems = '';
        $('#sortable .business-bg-del').each(function (ind) {
            let id = $(this).attr('data-id');
            for(let i=0;i<_this.originURLs.length;i++) {
                if (_this.originURLs[i].id == id) {
                    sortArray.push(_this.originURLs[i]);
                    break;
                }
            }
            _this.$avatarView.find('.carousel-inner .carousel-item').each(function (ind) {
                if ($(this).attr('data-id') == id) {
                    htmlItems += $(this)[0].outerHTML;
                }
            });
        });
        _this.originURLs = sortArray;
        _this.$avatarView.find('.carousel-inner').children().remove();
        _this.$avatarView.find('.carousel-inner').append(htmlItems);
    },

    updateSortURLs: function () {
        var _this = this;
        _this.sortURLs();
        var currentData = business.currentData || business.currentDataBrand || null;

        if (currentData) {
            var images_ids_sort = [];
            for(let i=0;i<_this.originURLs.length;i++) {
                images_ids_sort.push(parseInt(_this.originURLs[i].id));
            }
            new GraphQL("mutation", 'updateImageBusiness', {
                id: currentData.id,
                'images_ids_sort': images_ids_sort,
            }, ['token'], true, false, function () {
                Loader.stop();
            }, function (data) {

            },false).request();
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
        // if($('.avatar-input').prop('files').length !== 0) {
            backgroundForm = new FormData(this.$avatarForm.get(0));
            var data = $('.cropper-hidden').cropper('getCroppedCanvas').toDataURL("image/png");
            //this.$avatarView.find('img').attr('src', data);
        // }
        var _this = this;
        //_this.cropDone();
        var currentData = business.currentData || business.currentDataBrand || null;

        if (currentData) {
            new GraphQL("mutation", 'updateImageBusiness', { id: currentData.id }, ['bg_picture','token','error_message'], true, false, function () {
                Loader.stop();
            }, function (data) {
                if (data.bg_picture) {
                    currentData.bg_picture = data.bg_picture;
                    _this.originURL = data.bg_picture;
                    _this.$avatarView.find('img').attr('src', _this.originURL);
                }
                if (data.error_message){
                    $('#errorImageAvatar').modal('show');
                    return;
                }
                _this.cropDone();
            },false, backgroundForm).request();
        } else {
            this.$avatarView.find('img').attr('src', data);
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
                aspectRatio: 1920/450,
                viewMode: 1,
                minCropBoxWidth: 200,
                background: false,
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
            _this.originURL = this.url;
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
            _this.url = data.user_pic;
            if (data.user_pic) {
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
        //_this.$avatarModal.modal('hide');
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
