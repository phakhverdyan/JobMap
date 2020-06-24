let GlobalQRCodeType = {
    location: 0,
    scanner: 1,
};

function QRCodeFunc($_type) {

    if(GlobalQRCodeType.location ===  $_type){
        this.QRCodeCustomStepBlock = $(document).find("#QRCodeCustomStepModal");
        this.QRCodeDefaultStepBlock = $(document).find("#QRCodeDefaultStepModal");
    }else if (GlobalQRCodeType.scanner === $_type){
        this.QRCodeCustomStepBlock = $(document).find("#QRCodeCustomStepCard");
        this.QRCodeDefaultStepBlock = $(document).find("#QRCodeDefaultStepCard");
    }

    this.show_action_button = $(document).find(".QRCodeFunc-show-action");
    this.QRCodeFirstStepModal = $(document).find("#QRCodeFirstStepModal");


    this.SelectLocationScannerBlock = $(document).find("#select-location-scanner-block");
    this.QRCodeCustomSaveTemplateStepModal = $(document).find("#QRCodeCustomSaveTemplateStepModal");
    this.QRCodeLoading = $(document).find(".qr-code-loading");

    this.CurrentLocation = null;
    this.$CropAvatar = null;
    this.$reader = null;

    this.$CropAvatarBlock = $(document).find('#avatar-block');
    this.$avatarWrapper = this.$CropAvatarBlock.find('.avatar-wrapper');
    this.$avatarPreview = this.$CropAvatarBlock.find('.avatar-preview');
    this.$imgCropper = null;
    this.$avatarData = null;
    this.$activeCropper = false;

    this.data = {
        data: window.location.origin + '/scan/',
        outEyeColor: "",
        innerEyeColor: "",
        //backgroundColor: "",
        singleColor: "",
        size: 600,
        name: "",
        business_id: APIStorage.read('business-id'),
        title_one: "Scan & Apply",
        title_two: "Scan & Apply",
        title_one_size: 3,
        title_two_size: 3,
        title_one_color: 3,
        title_two_color: 3,
        dataLogo: "",
        url: "",
        file_name: "",
        setting_name: "",
        setting_id: "",
        setting_change: 0,
    };

    this.businessID = APIStorage.read('business-id');
    this.CurrentLanguagePrefix = APIStorage.read('language');

    this.CardQrCodeActionId = $(document).find("#card-qr-code-action");
    this.SelectSelectedBrandId = $(document).find("#select-location-scanner");
    this.SelectSelectedBrand = null;
    this.SelectBrandId = null;

    this.CardSelectLocationScannerActionId = $(document).find("#card-select-location-scanner-action");
    this.CardSelectLocationScannerAction = null;
    this.CardSelectLocationScannerTableId = $(document).find("#card-select-location-scanner-table");
    this.CardSelectLocationScannerTable = null;

    this.CurrentType = $_type;
    this.constructor($_type);
}

QRCodeFunc.prototype = {

    constructor: function($_type){
        let _this = this;

        console.log("Event - QRCodeFunc - constructor");

        _this.initEvents();

        if(GlobalQRCodeType.location ===  $_type){
            _this.initLocationType();
        }else if (GlobalQRCodeType.scanner === $_type){
            _this.initScannerType();
        }
    },

    initLocationType: function () {
        let _this = this;
        console.log("Event - QRCodeFunc - initLocationType");
        _this.initLocationTypeEvents();

    },

    initScannerType: function () {
        let _this = this;
        console.log("Event - QRCodeFunc - initScannerType");
        _this.initScannerTypeEvents();
        //_this.initSelectedBrands();
        _this.initSelectedBrandsTable();


    },

    initEvents: function(){
        let _this = this;
        console.log("Event - QRCodeFunc - initEvents");

        $(document).on("qr-code:clear:qr-code-setting", function (event){
            _this.data.setting_name = "";
            _this.data.setting_id = 0;
            _this.data.setting_change = 0;
            _this.QRCodeCustomStepBlock.find("[name=selector-setting]").val(0);
            _this.QRCodeDefaultStepBlock.find("[name=selector-setting]").val(0);
            _this.data.dataLogo = "";
            _this.data.url = "";
            _this.data.file_name = "";
            _this.data.outEyeColor = "";
            _this.data.innerEyeColor = "";
            _this.data.singleColor = "";
        });

        $(document).on("qr-code:get:qr-code-setting", function (event){
            let formData = new FormData();
            formData.append("business_id", _this.CurrentLocation.business_id);
            console.log("EVENT - qr-code:get:qr-code-setting");
            //console.log(_this.CurrentLocation.business_id);
            $.ajax({
                url: "/api/qr-code/get-qr-code-setting",
                headers: {
                    'Authorization': 'Basic ' + window.auth.user.api_token
                },
                type: 'POST',
                data: formData,
                dataType: false,
                cache: false,
                contentType: false,
                processData: false,
                error: function(data) {
                    console.log("ERROR");
                },
                success: function (response) {
                    if(response.error === undefined ){
                        if(response.data !== null){
                            _this.QRCodeCustomStepBlock.find(".selector-setting-block").show();
                            _this.QRCodeCustomStepBlock.find("[name=selector-setting]").html(response.data);
                            _this.QRCodeDefaultStepBlock.find(".selector-setting-block").show();
                            _this.QRCodeDefaultStepBlock.find("[name=selector-setting]").html(response.data);
                        }

                    }
                }
            });
        });

        $(document).on("qr-code:refresh:pdf", function (event) {
            _this.QRCodeLoading.show();
            console.log(_this.CurrentLocation);
            _this.data.location_id = _this.CurrentLocation.id;
            _this.data.business_id = _this.CurrentLocation.business_id;
            _this.data.data = window.location.origin + '/scan/' + _this.CurrentLocation.id;

            _this.data.title_one = _this.QRCodeDefaultStepBlock.find("[name=qr_code_title_one]").val();
            _this.data.title_two = _this.QRCodeDefaultStepBlock.find("[name=qr_code_title_two]").val();
            _this.data.title_one_color = _this.QRCodeDefaultStepBlock.find("[name=one_text_color]").val();
            _this.data.title_two_color = _this.QRCodeDefaultStepBlock.find("[name=two_text_color]").val();

            if(_this.data.setting_change === 1){
                _this.data.dataLogo = "";
                _this.data.url = "";
                _this.data.file_name = "";
                _this.data.outEyeColor = "";
                _this.data.innerEyeColor = "";
                _this.data.singleColor = "";
            }

            console.log(_this.data);
            let formData = new FormData();
            $.each(_this.data, function (key, value) {
                formData.append(key, value);
            });
            $.ajax({
                url: "/api/qr-code/get-pdf-code",
                headers: {
                    'Authorization': 'Basic ' + window.auth.user.api_token
                },
                type: 'POST',
                data: formData,
                dataType: false,
                cache: false,
                contentType: false,
                processData: false,
                error: function(data) {
                    console.log("ERROR");
                    console.log(data);
                },
                success: function (response) {
                    console.log(response);
                    if(response.error === undefined ){
                        if(response.data.setting !== null){
                            let _setting = response.data.setting;
                            if(_setting.logo_url !== undefined && _setting.logo_url !== null){
                                _this.data.url = _setting.logo_url;
                                _this.data.file_name = _setting.file_name;
                            }
                            if(_setting.single !== undefined && _setting.single !== null){
                                _this.data.singleColor = _setting.single;
                            }
                            if(_setting.out_eye !== undefined && _setting.out_eye !== null){
                                _this.data.outEyeColor = _setting.out_eye;
                            }
                            if(_setting.inner_eye !== undefined && _setting.inner_eye !== null){
                                _this.data.innerEyeColor = _setting.inner_eye;
                            }
                        }
                        _this.QRCodeDefaultStepBlock.find("object").attr("data", response.data.pdf_data);
                        _this.QRCodeLoading.hide();
                        _this.data.setting_change = 0;
                    }
                }
            });
        });

        $(document).on("qr-code:refresh:generate:code", function (event){
            _this.QRCodeLoading.show();
            _this.data.data = window.location.origin + '/scan/' + _this.CurrentLocation.id;

            if(_this.data.setting_change === 1){
                _this.data.dataLogo = "";
                _this.data.url = "";
                _this.data.file_name = "";
                _this.data.outEyeColor = "";
                _this.data.innerEyeColor = "";
                _this.data.singleColor = "";
            }

            let formData = new FormData();
            $.each(_this.data, function (key, value) {
                formData.append(key, value);
            });
            $.ajax({
                url: "/api/qr-code/generate-code",
                headers: {
                    'Authorization': 'Basic ' + window.auth.user.api_token
                },
                type: 'POST',
                data: formData,
                dataType: false,
                cache: false,
                contentType: false,
                processData: false,
                error: function(data) {
                    console.log("ERROR");
                },
                success: function (response) {
                    console.log(response);
                    if(response.error === undefined ){
                        if(response.data.setting !== null){
                            let _setting = response.data.setting;
                            if(_setting.logo_url !== undefined && _setting.logo_url !== null){
                                _this.QRCodeCustomStepBlock.find(".business-pic-view img").attr("src", _setting.logo_url);
                                _this.data.url = _setting.logo_url;
                                _this.data.file_name = _setting.file_name;
                            }else {
                                if(_this.CurrentLocation.business.image_url !== undefined && _this.CurrentLocation.business.image_url !== ""){
                                    _this.QRCodeCustomStepBlock.find(".business-pic-view img").attr("src", _this.CurrentLocation.business.image_url);
                                }
                            }
                            // if(_setting.background !== undefined && _setting.background !== null){
                            //     _this.QRCodeCustomStepBlock.find("#backgroundColor").val(_setting.background);
                            //     _this.QRCodeCustomStepBlock.find("#styleBackgroundColor").css({"background-color": "#"+_setting.background});
                            //     _this.data.backgroundColor = _setting.background;
                            // }
                            if(_setting.single !== undefined && _setting.single !== null){
                                _this.QRCodeCustomStepBlock.find("#singleColor").val(_setting.single);
                                _this.QRCodeCustomStepBlock.find("#styleSingleColor").css({"background-color": "#"+_setting.single});
                                _this.data.singleColor = _setting.single;
                            }
                            if(_setting.out_eye !== undefined && _setting.out_eye !== null){
                                _this.QRCodeCustomStepBlock.find("#outEyeColor").val(_setting.out_eye);
                                _this.QRCodeCustomStepBlock.find("#styleOutEyeColor").css({"background-color": "#"+_setting.out_eye});
                                _this.data.outEyeColor = _setting.out_eye;
                            }
                            if(_setting.inner_eye !== undefined && _setting.inner_eye !== null){
                                _this.QRCodeCustomStepBlock.find("#innerEyeColor").val(_setting.inner_eye);
                                _this.QRCodeCustomStepBlock.find("#styleInnerEyeColor").css({"background-color": "#"+_setting.inner_eye});
                                _this.data.innerEyeColor = _setting.inner_eye;
                            }
                        }

                        _this.QRCodeCustomStepBlock.find(".qr-code").html(response.data.svg);
                        _this.QRCodeLoading.hide();
                        _this.data.setting_change = 0;
                    }
                }
            });
        });

        $(document).on("click", "#QRCodeDefaultStepAction", function (event) {
            event.preventDefault();

            if(GlobalQRCodeType.location ===  _this.CurrentType){
                _this.QRCodeFirstStepModal.modal("hide");
                _this.QRCodeDefaultStepBlock.modal("show");
            }else if (GlobalQRCodeType.scanner === _this.CurrentType){
                _this.CardQrCodeActionId.fadeOut();
                _this.SelectLocationScannerBlock.fadeOut();
                _this.QRCodeDefaultStepBlock.fadeIn();
            }

            $(document).trigger("qr-code:clear:qr-code-setting");

            $(document).trigger("qr-code:refresh:pdf");

            $(document).trigger("qr-code:get:qr-code-setting");
        });

        $(document).on("click", "#QRCodeCustomStepAction", function (event) {
            event.preventDefault();

            _this.data.location_id = _this.CurrentLocation.id;
            _this.data.business_id = _this.CurrentLocation.business_id;
            console.log(_this.CurrentLocation.business.image_url, 'image url');

            _this.QRCodeCustomStepBlock.find(".business-pic-view img").attr("src", "");
            if(_this.CurrentLocation.business.image_url !== undefined && _this.CurrentLocation.business.image_url !== ""){
                _this.QRCodeCustomStepBlock.find(".business-pic-view img").attr("src", _this.CurrentLocation.business.image_url);
            }

            if(GlobalQRCodeType.location ===  _this.CurrentType){
                _this.QRCodeFirstStepModal.modal("hide");
                _this.QRCodeCustomStepBlock.modal("show");
            }else if (GlobalQRCodeType.scanner === _this.CurrentType){
                _this.CardQrCodeActionId.fadeOut();
                _this.SelectLocationScannerBlock.fadeOut();
                _this.QRCodeCustomStepBlock.fadeIn();
            }

            $(document).trigger("qr-code:clear:qr-code-setting");

            $(document).trigger("qr-code:refresh:generate:code");

            $(document).trigger("qr-code:get:qr-code-setting");
        });

        _this.QRCodeDefaultStepBlock.on("click", ".button-refresh-pdf", function (event) {
            event.preventDefault();
            $(document).trigger("qr-code:refresh:pdf");
        });

        _this.QRCodeDefaultStepBlock.on("click", ".button-back", function (event) {

            _this.QRCodeDefaultStepBlock.find("object").attr("data", "");

            if(GlobalQRCodeType.location ===  _this.CurrentType){
                _this.QRCodeDefaultStepBlock.modal("hide");
                _this.QRCodeFirstStepModal.modal("show");
            }else if (GlobalQRCodeType.scanner === _this.CurrentType){
                _this.QRCodeDefaultStepBlock.fadeOut();
                _this.SelectLocationScannerBlock.fadeIn();
                _this.CardQrCodeActionId.fadeIn();
            }

            $(document).trigger("qr-code:clear:qr-code-setting");
        });

        _this.QRCodeCustomStepBlock.on("click", ".button-back", function (event) {
            _this.QRCodeCustomStepBlock.find(".qr-code").html("");

            if(GlobalQRCodeType.location ===  _this.CurrentType){
                _this.QRCodeCustomStepBlock.modal("hide");
                _this.QRCodeFirstStepModal.modal("show");
            }else if (GlobalQRCodeType.scanner === _this.CurrentType){
                _this.QRCodeCustomStepBlock.fadeOut();
                _this.SelectLocationScannerBlock.fadeIn();
                _this.CardQrCodeActionId.fadeIn();
            }

            $(document).trigger("qr-code:clear:qr-code-setting");
        });

        _this.QRCodeCustomStepBlock.on("click", ".button-reset-svg", function (event) {
            event.preventDefault();
            _this.data.outEyeColor = "";
            _this.data.innerEyeColor = "";
            //_this.data.backgroundColor = "";
            _this.data.singleColor = "";
            _this.data.dataLogo = "";
            _this.data.url = "";
            _this.data.file_name = "";

            //_this.QRCodeCustomStepBlock.find("#backgroundColor").val("000000");
            //_this.QRCodeCustomStepBlock.find("#styleBackgroundColor").css({"background-color": "rgb(0, 0, 0)"});

            _this.QRCodeCustomStepBlock.find("#singleColor").val("000000");
            _this.QRCodeCustomStepBlock.find("#styleSingleColor").css({"background-color": "rgb(0, 0, 0)"});

            _this.QRCodeCustomStepBlock.find("#outEyeColor").val("000000");
            _this.QRCodeCustomStepBlock.find("#styleOutEyeColor").css({"background-color": "rgb(0, 0, 0)"});

            _this.QRCodeCustomStepBlock.find("#innerEyeColor").val("000000");
            _this.QRCodeCustomStepBlock.find("#styleInnerEyeColor").css({"background-color": "rgb(0, 0, 0)"});

            if(_this.CurrentLocation.business.image_url !== undefined && _this.CurrentLocation.business.image_url !== ""){
                _this.QRCodeCustomStepBlock.find(".business-pic-view img").attr("src", _this.CurrentLocation.business.image_url);
            }
            $(document).trigger("qr-code:clear:qr-code-setting");
            $(document).trigger("qr-code:refresh:generate:code");
        });

        _this.QRCodeCustomStepBlock.on("click", ".button-download-svg", function () {
            _this.QRCodeLoading.show();
            _this.data.size = 2000;
            _this.data.location_id = _this.CurrentLocation.id;
            _this.data.business_id = _this.CurrentLocation.business_id;
            let formData = new FormData();
            $.each(_this.data, function (key, value) {
                formData.append(key, value);
            });
            $.ajax({
                url: "/api/qr-code/generate-code",
                headers: {
                    'Authorization': 'Basic ' + window.auth.user.api_token
                },
                type: 'POST',
                data: formData,
                dataType: false,
                cache: false,
                contentType: false,
                processData: false,
                error: function(data) {
                    console.log("ERROR");
                },
                success: function (response) {
                    if(response.error === undefined ){
                        _this.data.size = 600;
                        let svgData = response.data.svg;
                        let svgBlob = new Blob([svgData], {type:"image/svg+xml;charset=utf-8"});
                        let svgUrl = URL.createObjectURL(svgBlob);
                        let downloadLink = document.createElement("a");
                        downloadLink.href = svgUrl;
                        downloadLink.download = "qr-code-location-"+_this.CurrentLocation.name+".svg";
                        document.body.appendChild(downloadLink);
                        downloadLink.click();
                        document.body.removeChild(downloadLink);
                        _this.QRCodeLoading.hide();
                    }
                }
            });
        });

        _this.QRCodeCustomStepBlock.on("change", "[name=outEyeColor]", function () {
            _this.data.outEyeColor = $(this).val();
            $(document).trigger("qr-code:refresh:generate:code");
        });

        _this.QRCodeCustomStepBlock.on("change", "[name=innerEyeColor]", function () {
            _this.data.innerEyeColor = $(this).val();
            $(document).trigger("qr-code:refresh:generate:code");
        });

        _this.QRCodeCustomStepBlock.on("change", "[name=singleColor]", function () {
            _this.data.singleColor = $(this).val();
            $(document).trigger("qr-code:refresh:generate:code");
        });

        _this.QRCodeCustomStepBlock.on("change", "[name=logo]", function () {
            console.log($(this)[0].files[0].type);
            if($(this)[0].files[0].type !== "image/svg+xml" && $(this)[0].files[0].type !== "image/png" && $(this)[0].files[0].type !== "image/jpeg" && $(this)[0].files[0].type !== "image/jpg"){
                console.log("Error file type");
                return;
            }

            _this.$reader = new FileReader();
            _this.$reader.readAsDataURL($(this)[0].files[0]);
            //console.log($(this)[0].files[0].type);//image/svg+xml//image/png
            _this.$reader.onloadend = function () {

                _this.data.dataLogo = _this.$reader.result;
                _this.QRCodeCustomStepBlock.find(".business-pic-view img").attr("src", "");///_this.$reader.result
                _this.startCropper();
            };

        });

        _this.QRCodeCustomStepBlock.on("click", "#business-pic-change-btn", function () {
            _this.QRCodeCustomStepBlock.find("[name=logo]").val("");
            _this.QRCodeCustomStepBlock.find("[name=logo]").trigger("click");
        });

        _this.QRCodeCustomSaveTemplateStepModal.on("click", ".button-save-template", function (){

            _this.QRCodeCustomSaveTemplateStepModal.modal("hide");
            _this.QRCodeLoading.show();
            _this.data.setting_name = _this.QRCodeCustomSaveTemplateStepModal.find("[name=name_template]").val();
            let formData = new FormData();
            $.each(_this.data, function (key, value) {
                formData.append(key, value);
            });
            $.ajax({
                url: "/api/qr-code/update-qr-code-setting",
                headers: {
                    'Authorization': 'Basic ' + window.auth.user.api_token
                },
                type: 'POST',
                data: formData,
                dataType: false,
                cache: false,
                contentType: false,
                processData: false,
                error: function(data) {
                    console.log("ERROR");
                },
                success: function (response) {
                    console.log(response);
                    if(response.error === undefined ){
                        _this.QRCodeCustomStepBlock.find(".selector-setting-block").show();
                        _this.QRCodeCustomStepBlock.find("[name=selector-setting]").html(response.data);
                        _this.data.setting_id = response.current_id;
                        _this.QRCodeCustomStepBlock.find("[name=selector-setting]").val(_this.data.setting_id);
                        _this.QRCodeLoading.hide();
                    }
                }
            });
        });

        _this.QRCodeCustomStepBlock.on("click", ".button-save-setting", function () {
            _this.QRCodeCustomSaveTemplateStepModal.find("[name=name_template]").val(_this.data.setting_name);
            _this.QRCodeCustomSaveTemplateStepModal.modal("show");
        });

        _this.QRCodeCustomStepBlock.on("change", "[name=selector-setting]", function () {
            _this.data.setting_id = $(this).val();
            _this.data.setting_name = $(this).find("option:selected").attr("data-name");

            _this.data.setting_change = 1;
            $(document).trigger("qr-code:refresh:generate:code");
        });

        _this.QRCodeDefaultStepBlock.on("change", "[name=selector-setting]", function () {
            _this.data.setting_id = $(this).val();
            _this.data.setting_name = $(this).find("option:selected").attr("data-name");

            _this.data.setting_change = 1;
            $(document).trigger("qr-code:refresh:pdf");
        });

        let _timeout_one_size = null;
        _this.QRCodeDefaultStepBlock.on("change keyup", "[name=qr_code_title_one_size]", function () {
            _this.data.title_one_size = $(this).val();
            if(_timeout_one_size === null){
                _timeout_one_size = setTimeout(function () {
                    $(document).trigger("qr-code:refresh:pdf");
                    _timeout_one_size = null;
                }, 500);
            }
        });
        let _timeout_two_size = null;
        _this.QRCodeDefaultStepBlock.on("change keyup", "[name=qr_code_title_two_size]", function () {
            _this.data.title_two_size = $(this).val();
            if(_timeout_two_size === null){
                _timeout_two_size = setTimeout(function () {
                    $(document).trigger("qr-code:refresh:pdf");
                    _timeout_two_size = null;
                }, 500);
            }
        });
        let _timeout_one = null;
        _this.QRCodeDefaultStepBlock.on("keyup", "[name=qr_code_title_one]", function () {
            _this.data.title_one = $(this).val();
            if(_timeout_one === null){
                _timeout_one = setTimeout(function () {
                    $(document).trigger("qr-code:refresh:pdf");
                    _timeout_one = null;
                }, 2000);
            }
        });
        let _timeout_two = null;
        _this.QRCodeDefaultStepBlock.on("keyup", "[name=qr_code_title_two]", function () {
            _this.data.title_two = $(this).val();
            if(_timeout_two === null){
                _timeout_two = setTimeout(function () {
                    $(document).trigger("qr-code:refresh:pdf");
                    _timeout_two = null;
                }, 2000);
            }
        });
        let _timeout_one_color = null;
        _this.QRCodeDefaultStepBlock.on("change", "[name=one_text_color]", function () {
            _this.data.title_one_color = $(this).val();
            if(_timeout_one_color === null){
                _timeout_one_color = setTimeout(function () {
                    $(document).trigger("qr-code:refresh:pdf");
                    _timeout_one_color = null;
                }, 500);
            }
        });
        let _timeout_two_color = null;
        _this.QRCodeDefaultStepBlock.on("change", "[name=two_text_color]", function () {
            _this.data.title_two_color = $(this).val();
            if(_timeout_two_color === null){
                _timeout_two_color = setTimeout(function () {
                    $(document).trigger("qr-code:refresh:pdf");
                    _timeout_two_color = null;
                }, 500);
            }
        });

        _this.$CropAvatarBlock.on("click", ".avatar-save", function (event) {
            _this.QRCodeLoading.show();
            let formData = new FormData();
            formData.append("image-data", _this.data.dataLogo);
            formData.append("crop-data", _this.$avatarData);
            formData.append("business_id", _this.CurrentLocation.business_id);
            $.ajax({
                url: "/api/qr-code/get-crop-image",
                headers: {
                    'Authorization': 'Basic ' + window.auth.user.api_token
                },
                type: 'POST',
                data: formData,
                dataType: false,
                cache: false,
                contentType: false,
                processData: false,
                error: function(data) {
                    console.log("ERROR");
                },
                success: function (response) {
                    console.log(response);
                    console.log(response.data.url);
                    if(response.error === undefined ){
                        _this.stopCropper();
                        _this.$CropAvatarBlock.hide();
                        _this.$avatarPreview.empty();
                        _this.QRCodeLoading.hide();
                        if(response.data){
                            _this.data.dataLogo = response.data;
                            _this.data.url = response.data.url;
                            _this.data.file_name = response.data.file_name;
                            _this.QRCodeCustomStepBlock.find(".business-pic-view img").attr("src", response.data.url);
                            $(document).trigger("qr-code:refresh:generate:code");
                        }
                    }
                }
            });
        });

        _this.$CropAvatarBlock.on("click", ".avatar-close", function (event) {
            _this.$CropAvatarBlock.hide();
            _this.$avatarPreview.empty();
            _this.stopCropper();
        });
    },

    initScannerTypeEvents: function(){
        let _this = this;
        console.log("Event - QRCodeFunc - initScannerTypeEvents");

        _this.CardSelectLocationScannerActionId.on("click", function (event) {
            console.log("Event - QRCodeFunc - CardSelectLocationScannerActionId - click");
            let _status = $(this).attr("aria-expanded");
            _this.QRCodeCustomStepBlock.hide();
            _this.QRCodeDefaultStepBlock.hide();

            if(_status === "false"){
                _this.CardQrCodeActionId.hide();
            }else {
                _this.CardQrCodeActionId.fadeIn();
            }

            if(_this.CurrentLocation === null){
                _this.CardQrCodeActionId.hide();
            }

        });
    },

    initSelectedBrandsTable: function(){
        let _this = this;

        $(document).on("business:qrcode:selected:location:datatable:draw", function (event) {
            if(_this.CardSelectLocationScannerTable !== null){
                _this.CardSelectLocationScannerTable.draw();
                event.preventDefault();
            }
        });

        _this.CardSelectLocationScannerTable =_this.CardSelectLocationScannerTableId.DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "/api/datatable/get-business-data",
                data: {
                    business_id: _this.businessID,
                    language_prefix: _this.CurrentLanguagePrefix,
                    all: true
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
                $('.brand-loading').hide();
                console.log(this.api().rows());
                if (this.api().page.info().recordsTotal <= 1) {
                    $('.selectBrandPanel').hide();
                    $(document).find('p.details-control').trigger('click');
                    $(document).find('p.details-control').trigger('click');
                }else{
                    $('.selectBrandPanel').show();
                }
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

        $(document).on("business:qrcode:selected:location:datatable:hide", function () {
            _this.CardSelectLocationScannerActionId.hide();
            _this.CardSelectLocationScannerTable.find('tbody tr.shown p.details-control').trigger('click');
        });

        _this.CardSelectLocationScannerTableId.find('tbody').on('click', 'p.details-control', function (event) {
            event.preventDefault();
            _this.CurrentLocation = JSON.parse($(this).attr("data-business-json"));
            _this.CurrentLocation.id = _this.CurrentLocation.business_id;
            _this.CurrentLocation.business = JSON.parse($(this).attr("data-business-json"));
            _this.CardSelectLocationScannerActionId.trigger("click");
            // let tr = $(this).closest('tr');
            // let row = _this.CardSelectLocationScannerTable.row(tr);
            // _this.current_brand_id = row.data().id;
            // let tableId = 'location-' + _this.current_brand_id;

            // let template = '<div class="row">' +
            //     '<div class="col-md-12 col-lg-12 col-sm-12">' +
            //     '<h4 class="dataTable-header step-2" style="display: inline-block; padding-right: 25px;">'+ trans('header_step_selected_location')+'</h4>' +
            //     '</div></div>' +
            //     '<table class="table details-table display responsive no-wrap" style="width: 100%;" id="'+tableId+'">\n' +
            //     '            <thead>\n' +
            //     '            <tr>\n' +
            //     '                <th>' +
            //     '</th>\n' +
            //     '            </tr>\n' +
            //     '            </thead>\n' +
            //     '        </table>';

            // let _url = "/api/datatable/get-location-assign-by-business/"+_this.current_brand_id;

            // _this.CardSelectLocationScannerTableId.find("tr").removeClass('shown');
            // for(let i = 0; i < _this.CardSelectLocationScannerTable.rows().count(); i++){
            //     if (_this.CardSelectLocationScannerTable.row(i).child.isShown() && row.index() !== i){
            //         _this.CardSelectLocationScannerTable.row(i).child.hide();
            //     }
            // }

            // if (row.child.isShown()) {
            //     // This row is already open - close it
            //     row.child.hide();
            //     tr.removeClass('shown');
            // } else {
            //     // Open this row
            //     row.child(template).show();
            //     _this.locationTable(tableId, _url);
            //     tr.addClass('shown');
            //     tr.next().find('td').addClass('no-padding bg-gray child-table');
            // }
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

                $(document).find(".location-item").on("click", function (event) {
                    let id_location = parseInt($(this).val());
                    if($(this).prop("checked") === true){
                        $(document).find('.location-item').prop('checked', false);
                        $(document).find('.location-item[value='+id_location+']').prop('checked', true);
                        _this.CurrentLocation = JSON.parse($(this).attr("data-json"));
                        _this.CardSelectLocationScannerActionId.trigger("click");

                    }else{
                        _this.CurrentLocation = null;
                    }
                    console.log(_this.CurrentLocation);
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

    initSelectedBrands: function(){
        let _this = this;
        //
        let options = {
            url: "/api/qr-code/get-selected-location-by-business",
            keywords: "",
            page: "",
            placeholder: "",
            language_prefix: _this.CurrentLanguagePrefix,
            business_id: APIStorage.read('business-id'),
        };
        console.log(options);
        _this.SelectSelectedBrandId.select2({
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
                            more: (params.page * 25) < data.data.total_count
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
                console.log(repo);
                if(options.language_prefix === "fr"){
                    return "<option value='"+repo.id+"'>"+repo.name_fr+"</option>";
                }
                return "<p style='margin-bottom: 2px;'>"+repo.name+"</p><p style='margin-bottom: 0;'>"+repo.full_address+"</p>";
            },
            templateSelection: function (repo) {
                if(options.language_prefix === "fr"){
                    return repo.name_fr || repo.text;
                }
                return repo.name || repo.text;
            }
        });

        _this.SelectSelectedBrandId.on("select2:selecting", function (event) {
           console.log(event);
           console.log(event.params.args.data);

           if(event.params.args.data !== undefined){
               _this.CardQrCodeActionId.fadeIn();
               _this.CurrentLocation = event.params.args.data;
           }else {
               _this.CardQrCodeActionId.hide();
               _this.CurrentLocation = null;
           }
        });

        _this.SelectSelectedBrandId.on("select2:clearing", function (event) {
           console.log(event);
           console.log(event.params.args.data);

            _this.CardQrCodeActionId.fadeOut();
            _this.CurrentLocation = null;
        });

    },

    initLocationTypeEvents: function () {
        let _this = this;
        console.log("Event - QRCodeFunc - initLocationTypeEvents");

        $(document).on("click", ".QRCodeFunc-show-action", function (event) {
           event.preventDefault();
            _this.QRCodeFirstStepModal.modal("show");
            _this.CurrentLocation = JSON.parse(atob($(this).attr('data-json')));
        });




    },

    startCropper: function () {
        let _this = this;
        if(!_this.$activeCropper){
            _this.$CropAvatarBlock.show();
            _this.$imgCropper = $('<img src="' + _this.data.dataLogo + '">');
            _this.$avatarWrapper.empty().html(_this.$imgCropper);
            _this.$imgCropper.cropper({
                aspectRatio: 1,
                viewMode: 0,
                minCropBoxWidth: 200,
                background: true,
                highlight: false,
                preview: _this.$avatarPreview,
                crop: function (e) {
                    let _json = [
                        '{"x":' + e.x,
                        '"y":' + e.y,
                        '"height":' + e.height,
                        '"width":' + e.width,
                        '"rotate":' + e.rotate + '}'
                    ].join();

                    _this.$avatarData = _json;
                }
            });

            _this.$activeCropper = true;
        }

    },

    stopCropper: function () {
        let _this = this;
        if (_this.$activeCropper) {
            _this.$imgCropper.cropper('destroy');
            _this.$imgCropper.remove();
            _this.$activeCropper = false;
        }
    }
};

function CropAvatar(dataLogo, callback) {
    this.callback = callback;
    this.dataLogo = dataLogo;

    this.$avatarSave = this.$avatarModal.find('.avatar-save');
    this.$avatarClose = this.$avatarModal.find('.avatar-close');
    this.$avatarWrapper = this.$avatarModal.find('.avatar-wrapper');
    this.$avatarPreview = this.$avatarModal.find('.avatar-preview');
    this.$avatarData = "";

    this.init();
}

CropAvatar.prototype = {
    constructor: CropAvatar,

    init: function () {
        this.$avatarModal.show();
        this.addListener();
        this.startCropper();
    },

    addListener: function () {
        let _this = this;
        _this.$avatarSave.on('click', function (event) {
            event.preventDefault();
            _this.save();
        });
        _this.$avatarClose.on('click', $.proxy(_this.close, this));
    },

    save: function () {
        let _this = this;

        // _this.callback($(_this.$avatarPreview[0]).find("img").attr("src"));
        // _this.$avatarModal.hide();
        // _this.$avatarPreview.empty();
        // _this.stopCropper();

        let formData = new FormData();
        formData.append("image-data", $(_this.$avatarPreview[0]).find("img").attr("src"));
        formData.append("crop-data", _this.$avatarData);
        $.ajax({
            url: "/api/qr-code/get-crop-image",
            headers: {
                'Authorization': 'Basic ' + window.auth.user.api_token
            },
            type: 'POST',
            data: formData,
            dataType: false,
            cache: false,
            contentType: false,
            processData: false,
            error: function(data) {
                console.log("ERROR");
            },
            success: function (response) {
                console.log(response);
                if(response.error === undefined ){
                    _this.stopCropper();

                    _this.$avatarModal.hide();
                    _this.$avatarPreview.empty();

                    _this.callback(response.data);

                }
            }
        });

    },

    close: function () {
        let _this = this;
        _this.$avatarModal.hide();
        _this.$avatarPreview.empty();
        _this.stopCropper();
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

    startCropper: function () {
        let _this = this;
        this.$img = $('<img src="' + _this.dataLogo + '">');
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

                _this.$avatarData = json;
            }
        });

        this.active = true;
    },

    stopCropper: function () {
        if (this.active) {
            this.$img.cropper('destroy');
            this.$img.remove();
            this.active = false;
        }
    }
};

let GlobalQRCodeFunc = null;



jQuery(document).ready(function ($) {
    //GlobalQRCodeFunc = new QRCodeFunc();

});
