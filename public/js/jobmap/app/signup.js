var mainForm;
var signUpForm;
var signUpStep1;
var signUpStep3;
var userSocialData;
var birthday;

var setUserSocialDataToForm = function () {
    if (APIStorage.read("user_social_data")) {
        userSocialData = JSON.parse(APIStorage.read("user_social_data"));
        signUpForm.find('input[name="first_name"]').val(userSocialData.first_name);
        signUpForm.find('input[name="last_name"]').val(userSocialData.last_name);
        signUpForm.find('input[name="email"]').val(userSocialData.email);
        var username = userSocialData.first_name + userSocialData.last_name;
        var regexp = /[^a-zA-Z0-9]/g;
        if (username.search(regexp) !== -1) {
            username = username.replace(regexp, '');
        }
        signUpForm.find('input[name="username"]').val(username.toLowerCase());
        signUpForm.find('#profile-link span').text(username.toLowerCase());
        signUpForm.find('#profile-link').text(signUpForm.find('#profile-link').attr('data-text') + signUpForm.find('#profile-link').attr('data-url') + "/u/" + username.toLowerCase());
        if (userSocialData.birthday) {
            birthday = formatDate(new Date(userSocialData.birthday));
            signUpForm.find('select[name="user-year"]').val(birthday[2]);
            signUpForm.find('select[name="user-month"]').val(birthday[1]);
            signUpForm.find('select[name="user-day"]').val(birthday[0]);
        }
    }
};

$(document).ready(function () {
/*    if (window.signup_js_initialized) {
        return;
    }*/

    if (APIStorage.read('api-token') && APIStorage.read('api-token').length !== 0) {

    } else {
        APIStorage.remove('api-user');
        //clear user data from local storage
        localStorage.removeItem('user');
        //remove all api cookies
        APIStorage.remove('business-id');
        //clear business data from local storage
        localStorage.removeItem('businesses');
    }

    var body = $('body');
    mainForm = $('#landing-signup');
    signUpForm = $('#sign-up-user-form');
    signUpStep1 = $('.sign-up-user-wizard .sign-up-step-1');
    signUpStep3 = $('.sign-up-user-wizard .sign-up-terms');

    //AJAX Activity Indicator
    Loader.init();

    new GraphQL("query", "languages", {}, [
        'id',
        'name',
        'prefix'
    ], false, false, function () {
        Loader.stop();
    }, function (data) {
        if (data) {
            var lang = APIStorage.read('language');
            var html = '';
            var i = 0;
            var j = 0;
            $.map(data, function (item) {
                if (i === 0) {
                    html += '<div class="d-flex">';
                }
                i++;
                j++;
                var classActive = '';
                if (item.prefix == lang) {
                    classActive = 'active';
                }
                var prefix = (item.prefix === 'en') ? 'US' : item.prefix.toUpperCase();
                html += '<button type="button" class="item-language btn btn-outline-primary mb-0 mr-2 ' + classActive + '" data-id="' + item.id + '">\n' +
                    '<span>\n' +
                    '<i class="glyphicon bfh-flag-' + prefix + '"></i>\n' +
                    '</span>\n' +
                    '<span>' + item.name + '</span>\n' +
                    '</button>';
                /*if (i === 3 || (j === data.length)) {
                 i = 0;
                 html += '</div>';
                 }*/
            });

            $('#setting-languages-list').html(html);

            if ($('.footer__change-language').length >0) {

                data.forEach(function(language) {
                    $('.footer__change-language').append('<option value="'+ language.prefix +'">'+ language.name +'</option>');
                });
                let lang = '';
                if (lang = APIStorage.read('language')) {
                    $('.footer__change-language').val(lang);
                }

                $('.footer__change-language').change(function () {
                    let lang = $(this).val();
                    APIStorage.create('language',lang);
                    setTimeout(function () {
                        window.location.reload();
                    }, 200);
                });
            }
        }
    }, false).request();

    $('body').on('click', '.item-language', function () {
        $('#setting-languages-list').find('button').removeClass('active');
        $(this).addClass('active');
    });

    //---START autocomplete location field
    var locationField = signUpForm.find('#user-location');
    var clearLocationField = signUpForm.find('#location-clear');
    if (locationField.length > 0) {
        GEO.init();
        //clear location field and focus
        clearLocationField.click(function () {
            locationField.val('');
            locationField.focus();
            clearLocationField.parent().addClass('hide');
            locationField.parent().parent().find('.glyphicon').attr('class','glyphicon');
            userCity = "";
            userRegion = "";
            userCountry = "";
            userCountryCode = "";
        });
        locationField.autocomplete({
            source: function (request, response) {

                clearLocationField.parent().addClass('hide');

                console.log("TTTTTTTTTTTTTTTTTT");

                // if (request.term.length === 0) {
                //     clearLocationField.parent().addClass('hide');
                //     locationField.addClass('autocomplete-border');
                // } else {
                //     clearLocationField.parent().removeClass('hide');
                //     locationField.removeClass('autocomplete-border');
                // }
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
                        userCity = "no_geo_data";
                        userRegion = "";
                        userCountry = "";
                        userCountryCode = "";
                        locationField.removeClass('ui-autocomplete-loading');
                    }
                    clearLocationField.parent().removeClass('hide');
                }).autocomplete();
            },
            select: function (event, ui) {
                userCity = ui.item.data.city;
                userRegion = ui.item.data.region;
                userCountry = ui.item.data.country;
                userCountryCode = ui.item.id;
                var flag = $('#basic-addon1');
                flag.find('i').removeClassRegex(/^bfh-flag-/);
                flag.find('i').addClass('bfh-flag-' + ui.item.id);
            },
            response: function (e, u) {
                locationField.removeClass('ui-autocomplete-loading');
                clearLocationField.parent().removeClass('hide');
            }
        }).attr('autocomplete', 'disabled').autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                .append('<span><i class="glyphicon bfh-flag-' + item.id + '"></i> </span><span>' + item.label + '</span>')
                .appendTo(ul);
        };

        locationField.keydown(function () {
            userCity = "no_geo_data";
            userRegion = "";
            userCountry = "";
            userCountryCode = "";
            locationField.parent().find('.glyphicon').attr('class','glyphicon');
            FormValidate.fieldValidateClear($(this));
        });
    }
    //---END autocomplete location field
    //---START events form
    body.on('keyup change', '#sign-up-user-form input[name="first_name"], #sign-up-user-form input[name="last_name"]', function () {
        var username = $('input[name="first_name"]').val() + $('input[name="last_name"]').val();
        FormValidate.fieldValidateClear($('input[name="username"]'));
        var regexp = /[^a-zA-Z0-9]/g;
        if (username.search(regexp) !== -1) {
            username = username.replace(regexp, '');
        }
        $('input[name="username"]').val(username.toLowerCase());
        $('#profile-link').text($('#profile-link').attr('data-text') + $('#profile-link').attr('data-url') + "/u/" + username.toLowerCase());
    });

    signUpForm.find('input[name="username"]').keyup(function () {
        var username = $(this).val();
        var regexp = /[^a-zA-Z0-9]/g;
        if (username.search(regexp) !== -1) {
            username = username.replace(regexp, '');
        }
        $(this).val(username.toLowerCase());
        $('#profile-link').text($('#profile-link').attr('data-text') + $('#profile-link').attr('data-url') + "/u/" + username.toLowerCase());
    });

    body.on('keyup', 'input', function () {
        FormValidate.fieldValidateClear($(this));
    });

    $('input.user-terms').click(function(){
        var userTerms = $('#user-terms');
        if ($('input.user-terms:checked').length > 0) {
            userTerms.hide();
        } else {
            userTerms.show();
        }
    });
    $('#signUpModal').on('hidden.bs.modal', function () {
        signUpForm[0].reset();
        GEO.init();
        signUpStep1.show();
        signUpStep3.hide();
    });
    $('#signUpBusinessModal').on('hidden.bs.modal', function () {
        signUpForm[0].reset();
        GEO.init();
    });
    //---END events form
    //---START click NEXT - show Terms and APPLY terms
    var setParamsForMethodUserNew = function () {
        var year = FormValidate.getFieldValue('user-year');
        var month = FormValidate.getFieldValue('user-month');
        var day = FormValidate.getFieldValue('user-day');
        var birthDate = year + '-' + month + '-' + day;

        var code = $('#country-phone .bfh-selectbox-option').clone();
        code.find('span').remove();

        var params = {
            "first_name": FormValidate.getFieldValue('first_name', signUpForm),
            "last_name": FormValidate.getFieldValue('last_name', signUpForm),
            "username": FormValidate.getFieldValue('username', signUpForm),
            //"mobile_phone": FormValidate.getFieldValue('mobile_phone', signUpForm),
            "phone_number": FormValidate.getFieldValue('phone_number', signUpForm),
            "phone_code": code.text().replace(" ", ""),
            "phone_country_code": signUpForm.find('.country').val(),
            "city": (userCity && userCity !== "") ? userCity : FormValidate.getFieldValue('city'),
            "region": userRegion,
            "country": userCountry,
            "country_code": userCountryCode,
            "birth_date": birthDate,
            "email": FormValidate.getFieldValue('email', signUpForm),
            "password": FormValidate.getFieldValue('password', signUpForm),
            "confirm_password": FormValidate.getFieldValue('confirm_password', signUpForm),
            "social": (userSocialData) ? userSocialData.social : "",
            "social_id": (userSocialData) ? userSocialData.id : "",
            "social_token": (userSocialData) ? userSocialData.token : "",
            "gender": (userSocialData && userSocialData.gender) ? userSocialData.gender : "",
            "user_pic": (userSocialData && userSocialData.userpic) ? userSocialData.userpic : "",
            "user_pic_original": (userSocialData && userSocialData.userpic_original) ? userSocialData.userpic_original : "",
            "type": 'student',
            "inviting_business_id": FormValidate.getFieldValue('inviting_business_id'),
        };
        var idL = 1, l;
        if (l = APIStorage.read('language')) {
            if (l == 'fr') {
                idL = 2;
            }
        }
        params["language"] = idL;

        return params;
    };
    $('#go-to-terms').click(function(event) {
        event.preventDefault();

        FormValidate.fieldsValidateClear(signUpForm);

        if (FormValidate.getFieldValue('city') === "") {
            userCity = "";
        }
        var params = setParamsForMethodUserNew();
        new GraphQL("mutation", "createUserCheckNew", params, ['response'], false, false, function () {
            Loader.stop();
        }, function (data) {
            signUpStep1.hide();
            $('.logo-p-up').hide();
            signUpStep3.show();
        }, signUpForm).request();
        return;
    });

    $('#return-terms').click(function(event) {
        event.preventDefault();

        var userTerms = $('#user-terms');
        if ($('input.user-terms:checked').length < 1) {
            userTerms.show();
            return false;
        }
        var params = setParamsForMethodUserNew();
        params['login'] = 1;
        new GraphQL("mutation", "createUserNew", params, ['username', 'token', 'first_name'], false, false, function () {
            Loader.stop();
        }, function (data) {
            APIStorage.setToken(data);
            setTimeout(function () {
                app.init();

                $('#userFirstTime').modal('show');
                //sR.send(sR.btnClickSend);
            },100);
            $('#signUpModal').modal('hide');
        }, signUpForm).request();
        return;
    });

    $('#go-to-create_business').click(function(event) {
        event.preventDefault();

        signUpForm.find(".modal-loading").show();
        var params = setParamsForMethodUserNew();
        params['login'] = 1;
        //console.log(params);return;
        new GraphQL("mutation", "createUserNew", params, ['username', 'token', 'first_name'], false, false, function () {
            Loader.stop();
        }, function (data) {
            APIStorage.setToken(data);
            setTimeout(function () {
                app.init();
                window.location.href = getBaseURL() + '/business/signup';
            },100);
            $('#signUpBusinessModal').modal('hide');
        }, signUpForm).request();
        return;
    });
    //---END click NEXT - show Terms and APPLY terms

    //window.signup_js_initialized = true;

    $('#show-sign-in').click(function () {
        $('.block_business-logo-medium').hide();
        if ( typeof sR !== "undefined") {
            sR.clear();
        }
    });
    $('#show-sign-in-send-resume').click(function () {
        $('#signUpModal').modal('hide');
        if ( typeof sR === "undefined") {
            $('.block_business-logo-medium').hide();
        }
        $('#signInModal').modal('show');
    });

});
