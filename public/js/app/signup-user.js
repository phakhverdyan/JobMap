
function signupUser () {

    this.form = null;
    this.userSocialData = null;

    userCity = '';
    userRegion = '';
    userCountry = '';
    userCountryCode = '';

}

signupUser.prototype = {

    init: function () {

        /*
        APIStorage.remove('api-user');
        //clear user data from local storage
        localStorage.removeItem('user');
        //remove all api cookies
        APIStorage.remove('business-id');
        //clear business data from local storage
        localStorage.removeItem('businesses');
        */

        Loader.init();

        this.form = $('#form-user-academy');
        if (APIStorage.read("user_social_data")) {
            this.userSocialData = JSON.parse(APIStorage.read("user_social_data"));
        }
        this.setFields();
        this.setEvent();
    },
    setFields : function() {
        var form = this.form,
            userSocialData = this.userSocialData;
        if (userSocialData) {
            form.find('input[name="first_name"]').val(userSocialData.first_name);
            form.find('input[name="last_name"]').val(userSocialData.last_name);
            form.find('input[name="email"]').val(userSocialData.email);
            var username = userSocialData.first_name + userSocialData.last_name;
            if (username) {
                form.find('input[name="username"]').val(username.toLowerCase());
            }
            if (userSocialData.birthday) {
                var birthday = formatDate(new Date(userSocialData.birthday));
                signUpForm.find('select[name="user-year"]').val(birthday[2]);
                signUpForm.find('select[name="user-month"]').val(birthday[1]);
                signUpForm.find('select[name="user-day"]').val(birthday[0]);
            }
        }
    },
    setEvent : function() {
        var _this = this,
            form = _this.form;

        form.on('keyup', 'input', function () {
            FormValidate.fieldValidateClear($(this));
        });

        var locationField = form.find('#academy-location'),
            clearLocationField = form.find('#academy-location-clear');
        GEO.initAcademy(form);
        //clear location field and focus
        clearLocationField.click(function () {
            locationField.val('');
            form.find('#basic-addon1 i').attr('class','glyphicon');
            locationField.focus();
            clearLocationField.parent().addClass('hide');
            locationField.addClass('autocomplete-border');
        });
        //autocomplete locations
        locationField.autocomplete({
            source: function (request, response) {
                if (request.term.length === 0) {
                    clearLocationField.parent().addClass('hide');
                    locationField.addClass('autocomplete-border');
                } else {
                    clearLocationField.parent().removeClass('hide');
                    locationField.removeClass('autocomplete-border');
                }
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
                        userCity = "";
                        userRegion = 0;
                        userCountry = 0;
                        userCountryCode = 0;
                        locationField.removeClass('ui-autocomplete-loading');
                    }
                }).autocomplete();
            },
            select: function (event, ui) {
                userCity = ui.item.data.city;
                userRegion = ui.item.data.region;
                userCountry = ui.item.data.country;
                userCountryCode = ui.item.id;
                var flag = form.find('#basic-addon1');
                flag.find('i').removeClassRegex(/^bfh-flag-/);
                flag.find('i').addClass('bfh-flag-' + ui.item.id);
            },
            response: function (e, u) {
                locationField.removeClass('ui-autocomplete-loading');
            }
        }).autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                .append('<span><i class="glyphicon bfh-flag-' + item.id + '"></i> </span><span>' + item.label + '</span>')
                .appendTo(ul);
        };

        _this.form.on('keyup change', 'input[name="first_name"], input[name="last_name"]', function () {
            var username = _this.form.find('input[name="first_name"]').val() + _this.form.find('input[name="last_name"]').val();
            var regexp = /[^a-zA-Z0-9]/g;
            if (username.search(regexp) !== -1) {
                username = username.replace(regexp, '');
            }
            _this.form.find('input[name="username"]').val(username.toLowerCase());
        });

        _this.form.on('submit', function (e) {
            e.preventDefault();
            var type = _this.form.data('type'),
                token = _this.form.find('input[name="token"]').val();
            var year = FormValidate.getFieldValue('user-year'),
                month = FormValidate.getFieldValue('user-month'),
                day = FormValidate.getFieldValue('user-day'),
                birthDate = year + '-' + month + '-' + day;
            token = token.substr(token.indexOf('/',30)+1);
            var params = {
                "token": token,
                "first_name": FormValidate.getFieldValue('first_name'),
                "last_name": FormValidate.getFieldValue('last_name'),
                "username": FormValidate.getFieldValue('username'),
                "email": FormValidate.getFieldValue('email'),
                "city": (userCity && userCity !== "") ? userCity : FormValidate.getFieldValue('city'),
                "region": userRegion,
                "country": userCountry,
                "country_code": userCountryCode,
                "teaching": FormValidate.getFieldValue('teaching'),
                "academy": FormValidate.getFieldValue('academy'),
                "password": FormValidate.getFieldValue('password'),
                "confirm_password": FormValidate.getFieldValue('confirm_password'),
                "birth_date": birthDate,
                "user_pic": (_this.userSocialData && _this.userSocialData.userpic) ? _this.userSocialData.userpic : "",
                "user_pic_original": (_this.userSocialData && _this.userSocialData.userpic_original) ? _this.userSocialData.userpic_original : "",
                "social": (_this.userSocialData) ? _this.userSocialData.social : "",
                "social_id": (_this.userSocialData) ? _this.userSocialData.id : "",
                "social_token": (_this.userSocialData) ? _this.userSocialData.token : "",
                "type": type
            };

            new GraphQL("mutation", "createUserAcademy", params, ['redirect'], false, false, function () {
                Loader.stop();
            }, function (data) {
                if (data.redirect) {
                    setTimeout(function () {
                        Loader.stop();
                        window.location.href = data.redirect;
                    }, 500);
                }
            }, _this.form).request();

        });
    }


};

$( document ).ready( function(){

    var signup = new signupUser();
    signup.init();

    var clipboard = new Clipboard('#clipboard-button');
    clipboard.on('success', function (e) {
        $.notify(Langs.copied, 'success');
        e.clearSelection();
    });

});