var invite, inviteATS, b;
var mainForm;
var signUpForm;
var signUpStep1;
var signUpStep2;
var signUpStep3;

function updateUser(signUpForm, type) {
    if (FormValidate.getFieldValue('city') === "") {
        userCity = "";
    }
    var year = FormValidate.getFieldValue('user-year');
    var month = FormValidate.getFieldValue('user-month');
    var day = FormValidate.getFieldValue('user-day');
    var birthDate = year + '-' + month + '-' + day;
    var userSocialData = false;
    if (APIStorage.read("user_social_data")) {
        var userSocialData = JSON.parse(APIStorage.read("user_social_data"));
        signUpForm.find('input[name="social"]').val(userSocialData.id);
        signUpForm.find('input[name="social_id"]').val(userSocialData.social);
        signUpForm.find('input[name="social_token"]').val(userSocialData.token);
        if (userSocialData.gender) {
            signUpForm.find('input[name="gender"]').val(userSocialData.gender);
        }
        if (userSocialData.userpic) {
            signUpForm.find('input[name="userpic"]').val(userSocialData.userpic);
        }
        if (userSocialData.userpic_original) {
            signUpForm.find('input[name="userpic_original"]').val(userSocialData.userpic_original);
        }
    }

    var params = {
        "city": (userCity && userCity !== "") ? userCity : FormValidate.getFieldValue('city'),
        "region": userRegion,
        "country": userCountry,
        "country_code": userCountryCode,
        "birth_date": birthDate,
        "social": (userSocialData) ? userSocialData.social : "",
        "social_id": (userSocialData) ? userSocialData.id : "",
        "social_token": (userSocialData) ? userSocialData.token : "",
        "gender": (userSocialData && userSocialData.gender) ? userSocialData.gender : "",
        "user_pic": (userSocialData && userSocialData.userpic) ? userSocialData.userpic : "",
        "user_pic_original": (userSocialData && userSocialData.userpic_original) ? userSocialData.userpic_original : ""
    };

    //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
    //new GraphQL("mutation", "updateUser", params, ['username', 'token'], true, (type) ? "/business/signup" : "/user/resume/create", function () {
    //new GraphQL("mutation", "updateUser", params, ['username', 'token'], true, (type) ? "/business/signup" : "/lets-get-started-jobseeker", function () {
    new GraphQL("mutation", "updateUser", params, ['username', 'token'], true, (type) ? "/business/signup" : "/user/dashboard", function () {
        Loader.stop();
    }, function (data, firstName) {
        if (type) {
            APIStorage.setToken(data);
            $('#welcome-username span').text(firstName);
        }
    }, signUpForm).request();
}

function getDataByInvite() {
    new GraphQL("query", "inviteInfo", {
        'invite_token': invite
    }, ['first_name', 'last_name', 'username', 'email', 'picture', 'business_name', 'invite_business_id'], false, false, function () {
        Loader.stop();
    }, function (data) {
        if (data) {
            signUpStep1.find('input[name="first_name"]').val(data.first_name);
            signUpStep1.find('input[name="last_name"]').val(data.last_name);
            signUpStep1.find('input[name="username"]').val(data.username);
            signUpStep1.find('#profile-link span').text(data.username);
            signUpStep1.find('input[name="email"]').val(data.email);
            signUpForm.find('input[name="inviting_business_id"]').val(data.invite_business_id);
            $('#business-create-start').parent().parent().prev('div').removeClass('col-6').addClass('col-12');
            $('#business-create-start').parent().parent().remove();
            $('.business-invite').removeClass('hide');
            $('.business-invite').find('img').attr('src', data.picture);
            $('.business-invite').find('h3 span').text(data.business_name);
            $('.sign-up-step-1').find('h3').replaceWith('<h6 class="mb-5 text-center">' + $('.sign-up-step-1').find('h3').html() + '</h6>');
        }
    }).request();
}

function getDataByInviteATS() {
    new GraphQL("query", "inviteATSInfo", {
        'affiliate_token': inviteATS
    }, ['email'], false, false, function () {
        Loader.stop();
    }, function (data) {
        if (data) {
            signUpStep1.find('input[name="email"]').val(data.email);
        }
    }).request();
}

function getDataByBusiness() {
    new GraphQL("query", "business", {
        'id': b
    }, ['name', 'picture_100'], false, false, function () {
        Loader.stop();
    }, function (data) {
        if (data) {
            $('.resume-business-signup').removeClass('hide');
            $('.resume-business-signup').find('img').attr('src', data.picture_100);
            $('.resume-business-signup').find('h3 span').text(data.name);
            $('.sign-up-step-1').find('h3').replaceWith('<h6 class="mb-5 text-center">' + $('.sign-up-step-1').find('h3').html() + '</h6>');
        }
    }).request();
}

$(document).ready(function () {
    if (window.signup_js_initialized) {
        return;
    }

    APIStorage.remove('api-user');
    //clear user data from local storage
    localStorage.removeItem('user');
    //remove all api cookies
    APIStorage.remove('business-id');
    //clear business data from local storage
    localStorage.removeItem('businesses');

    var body = $('body');
    mainForm = $('#landing-signup');
    signUpForm = $('#sign-up-user-form');
    signUpStep1 = $('.sign-up-user-wizard .sign-up-step-1');
    signUpStep2 = $('.sign-up-user-wizard .sign-up-step-2');
    signUpStep3 = $('.sign-up-user-wizard .sign-up-terms');
    if (APIStorage.read('api-token')) {
        var url = document.location.pathname;
        var urlSignup = explode('/user/signup', url);
        if (urlSignup[1]) {
            window.location.href = '/user/dashboard';
        }
    }

    if (getUrlParameter('i')) {
        invite = getUrlParameter('i');
        getDataByInvite();
        if (APIStorage.read("user_social_data")) {
            var userSocialData = JSON.parse(APIStorage.read("user_social_data"));
            if (userSocialData.birthday) {
                var birthday = formatDate(new Date(userSocialData.birthday));
                signUpForm.find('select[name="user-year"]').val(birthday[2]);
                signUpForm.find('select[name="user-month"]').val(birthday[1]);
                signUpForm.find('select[name="user-day"]').val(birthday[0]);
            }
        }
    } else if (getUrlParameter('b')) {
        b = getUrlParameter('b');
        getDataByBusiness();
    } else if (APIStorage.read("user_social_data")) {
        var userSocialData = JSON.parse(APIStorage.read("user_social_data"));
        signUpForm.find('input[name="first_name"]').val(userSocialData.first_name);
        signUpForm.find('input[name="last_name"]').val(userSocialData.last_name);
        signUpForm.find('input[name="email"]').val(userSocialData.email);
        var username = userSocialData.first_name + userSocialData.last_name;
        signUpForm.find('input[name="username"]').val(username.toLowerCase());
        signUpForm.find('#profile-link span').text(username.toLowerCase());
        if (userSocialData.birthday) {
            var birthday = formatDate(new Date(userSocialData.birthday));
            signUpForm.find('select[name="user-year"]').val(birthday[2]);
            signUpForm.find('select[name="user-month"]').val(birthday[1]);
            signUpForm.find('select[name="user-day"]').val(birthday[0]);
        }
    } else if (getUrlParameter('a')) {
        inviteATS = getUrlParameter('a');
        getDataByInviteATS();
    }
    //AJAX Activity Indicator
    Loader.init();
    //Landing signup form events
    mainForm.on('keyup', 'input', function () {
        FormValidate.fieldValidateClear($(this));
    });

    $('.landing-blank-button').click(function () {
        hardReset();
        $.ajax({
            url: mainForm.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: mainForm.serialize(),
            statusCode: {
                422: function (data) {
                    FormValidate.fieldsValidate(data.responseJSON.errors, mainForm);
                }
            },
            beforeSend: function () {
                Loader.start();
                FormValidate.fieldsValidateClear(mainForm);
            },
            success: function (data) {
                if (data.url) {
                    mainForm.attr('action', data.url);
                    mainForm.submit();
                }
                Loader.stop();
            },
            error: function () {
                Loader.stop();
            }
        });
    });
    //End (Landing signup form events)

    //User signup form
    if (signUpForm.length !== 0) {
        //-get language
        //if (signUpStep2.length > 0) {
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
                        html += '<button type="button" class="item-language btn btn-outline-primary mb-0 mr-2 ' + classActive + '" data-prefix="'+ prefix +'" data-id="' + item.id + '">\n' +
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
                }
            }, false).request();
            $('body').on('click', '.item-language', function () {
                $('#setting-languages-list').find('button').removeClass('active');
                $(this).addClass('active');
                $(document).find(".btn-change-language").trigger("click");
            });
        //}
        //-end
        //get first/last name in coockie
        var fName='', lName='';
        if (fName = APIStorage.read('f_name')) {
            $('#sign-up-user-form input[name="first_name"]').val(fName);
            //APIStorage.remove('f_name');
        }
        if (lName = APIStorage.read('l_name')) {
            $('#sign-up-user-form input[name="last_name"]').val(lName);
            //APIStorage.remove('l_name');
        }
        //-end
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
                    //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler
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

        /*if (APIStorage.read('api-token')) {
            signUpStep1.hide();
            signUpStep2.show();
        } else {
            signUpStep1.show();
            signUpStep2.hide();
        }*/

        $('#welcome-username').find('span').text(APIStorage.read('api-user'));

        $('#go-to-terms').click(function(event) {
            event.preventDefault();
            var form = $('#sign-up-user-form');
            FormValidate.fieldsValidateClear(form);
            var params = {
                "first_name": FormValidate.getFieldValue('first_name', form),
                "last_name": FormValidate.getFieldValue('last_name', form),
                "username": FormValidate.getFieldValue('username', form),
                "email": FormValidate.getFieldValue('email', form),
                "password": FormValidate.getFieldValue('password', form),
                "confirm_password": FormValidate.getFieldValue('confirm_password', form),
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

            if (invite) {
                params['invite'] = invite;
            }
            if (b) {
                params['f_business'] = +b;
            }
            new GraphQL("mutation", "createCheck", params, ['response'], false, false, function () {
                Loader.stop();
            }, function (data) {
                if (signUpStep3.length > 0) { // if it is the default registration page
                    signUpStep1.hide();
                    $('.logo-p-up').hide();
                    signUpStep3.show();
                }
                else { // if it is /employers page
                    $('#sign-up-user-form-terms-modal').modal('show');
                }
            }, form).request();
            return;
        });

        $('#go-to-signup-save').click(function(event) {
            event.preventDefault();
            var code = $('#country-phone .bfh-selectbox-option').clone();
            code.find('span').remove();

            var redirectTo = "/business/signup";
            if ($(this).attr('id') === 'user-signup-info-send') {
                redirectTo = "/user/dashboard";
            }else if(inviteATS !== ""){
                redirectTo = "/user/dashboard";
            }else if(parseInt(signUpForm.find('input[name="inviting_business_id"]').val()) > 0){
                redirectTo = "/business/candidate/manage";
            }

            var form = $('#sign-up-user-form');
            FormValidate.fieldsValidateClear(form);

            if (FormValidate.getFieldValue('city') === "") {
                userCity = "";
            }

            var year = FormValidate.getFieldValue('user-year');
            var month = FormValidate.getFieldValue('user-month');
            var day = FormValidate.getFieldValue('user-day');
            var birthDate = year + '-' + month + '-' + day;
            var userSocialData = false;
            if (APIStorage.read("user_social_data")) {
                var userSocialData = JSON.parse(APIStorage.read("user_social_data"));
                signUpForm.find('input[name="social"]').val(userSocialData.id);
                signUpForm.find('input[name="social_id"]').val(userSocialData.social);
                signUpForm.find('input[name="social_token"]').val(userSocialData.token);
                if (userSocialData.gender) {
                    signUpForm.find('input[name="gender"]').val(userSocialData.gender);
                }
                if (userSocialData.userpic) {
                    signUpForm.find('input[name="userpic"]').val(userSocialData.userpic);
                }
                if (userSocialData.userpic_original) {
                    signUpForm.find('input[name="userpic_original"]').val(userSocialData.userpic_original);
                }
            }

            var params = {
                "first_name": FormValidate.getFieldValue('first_name', form),
                "last_name": FormValidate.getFieldValue('last_name', form),
                "username": FormValidate.getFieldValue('username', form),
                "phone_number": FormValidate.getFieldValue('phone_number', form),
                "phone_code": code.text().replace(" ", ""),
                "phone_country_code": form.find('.country').val(),
                "city": (userCity && userCity !== "") ? userCity : FormValidate.getFieldValue('city'),
                "region": userRegion,
                "country": userCountry,
                "country_code": userCountryCode,
                "birth_date": birthDate,
                "email": FormValidate.getFieldValue('email', form),
                "password": FormValidate.getFieldValue('password', form),
                "confirm_password": FormValidate.getFieldValue('confirm_password', form),
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

            if (invite) {
                params['invite'] = invite;
            }
            if (b) {
                params['f_business'] = +b;
            }


            APIStorage.remove('f_name');
            APIStorage.remove('l_name');
            new GraphQL("mutation", "createUserNew", params, ['username', 'token', 'first_name', ''], false, redirectTo, function () {
                Loader.stop();
            }, function (data) {
                //APIStorage.remove('user-terms');
                APIStorage.setToken(data);
            }, form).request();

            return;

        });
        $('.go-to-terms---').click(function(event) {
            event.preventDefault();

            var code = $('#country-phone .bfh-selectbox-option').clone();
            code.find('span').remove();

            var redirectTo = "/business/signup";
            if ($(this).attr('id') == 'user-signup-info-send') {
                redirectTo = "/user/dashboard";
            }
            var form = $('#sign-up-user-form');
            FormValidate.fieldsValidateClear(form);

            if (FormValidate.getFieldValue('city') === "") {
                userCity = "";
            }
            var year = FormValidate.getFieldValue('user-year');
            var month = FormValidate.getFieldValue('user-month');
            var day = FormValidate.getFieldValue('user-day');
            var birthDate = year + '-' + month + '-' + day;
            /*var userSocialData = false;
            if (APIStorage.read("user_social_data")) {
                var userSocialData = JSON.parse(APIStorage.read("user_social_data"));
                signUpForm.find('input[name="social"]').val(userSocialData.id);
                signUpForm.find('input[name="social_id"]').val(userSocialData.social);
                signUpForm.find('input[name="social_token"]').val(userSocialData.token);
                if (userSocialData.gender) {
                    signUpForm.find('input[name="gender"]').val(userSocialData.gender);
                }
                if (userSocialData.userpic) {
                    signUpForm.find('input[name="userpic"]').val(userSocialData.userpic);
                }
                if (userSocialData.userpic_original) {
                    signUpForm.find('input[name="userpic_original"]').val(userSocialData.userpic_original);
                }
            }*/

            var params = {
                "first_name": FormValidate.getFieldValue('first_name', form),
                "last_name": FormValidate.getFieldValue('last_name', form),
                "username": FormValidate.getFieldValue('username', form),
                "phone_number": FormValidate.getFieldValue('phone_number', form),
                "phone_code": code.text().replace(" ", ""),
                "phone_country_code": form.find('.country').val(),
                "city": (userCity && userCity !== "") ? userCity : FormValidate.getFieldValue('city'),
                "region": userRegion,
                "country": userCountry,
                "country_code": userCountryCode,
                "birth_date": birthDate,
                "email": FormValidate.getFieldValue('email', form),
                "password": FormValidate.getFieldValue('password', form),
                "confirm_password": FormValidate.getFieldValue('confirm_password', form),
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

            if (invite) {
                params['invite'] = invite;
            }
            if (b) {
                params['f_business'] = +b;
            }

            new GraphQL("mutation", "createUserCheckNew", params, ['response', 'redirect_to'], false, false, function () {
                Loader.stop();
            }, function (data) {
                if (signUpStep3.length > 0) { // if it is the default registration page
                    signUpStep1.hide();
                    $('.logo-p-up').hide();
                    if (data['redirect_to']) {
                        redirectTo = data['redirect_to'];
                    }
                    $('#return-terms').attr('data-redirectTo',redirectTo);
                    signUpStep3.show();
                }
                else { // if it is /employers page
                    $('#sign-up-user-form-terms-modal').modal('show');
                }
            }, form).request();
            return;
        });

        /*$('#return-terms-modal').click(function () {
            $('#sign-up-user-form').submit();
        });*/

        $('#return-terms---').click(function(event) {
            event.preventDefault();

            var code = $('#country-phone .bfh-selectbox-option').clone();
            code.find('span').remove();

            var userTerms = $('#user-terms');
            if ($('input.user-terms:checked').length < 1) {
                userTerms.show();
                return false;
            }
            var form = $('#sign-up-user-form');

            if (FormValidate.getFieldValue('city') === "") {
                userCity = "";
            }
            var year = FormValidate.getFieldValue('user-year');
            var month = FormValidate.getFieldValue('user-month');
            var day = FormValidate.getFieldValue('user-day');
            var birthDate = year + '-' + month + '-' + day;
            var userSocialData = false;
            if (APIStorage.read("user_social_data")) {
                var userSocialData = JSON.parse(APIStorage.read("user_social_data"));
                signUpForm.find('input[name="social"]').val(userSocialData.id);
                signUpForm.find('input[name="social_id"]').val(userSocialData.social);
                signUpForm.find('input[name="social_token"]').val(userSocialData.token);
                if (userSocialData.gender) {
                    signUpForm.find('input[name="gender"]').val(userSocialData.gender);
                }
                if (userSocialData.userpic) {
                    signUpForm.find('input[name="userpic"]').val(userSocialData.userpic);
                }
                if (userSocialData.userpic_original) {
                    signUpForm.find('input[name="userpic_original"]').val(userSocialData.userpic_original);
                }
            }

            var params = {
                "first_name": FormValidate.getFieldValue('first_name', form),
                "last_name": FormValidate.getFieldValue('last_name', form),
                "username": FormValidate.getFieldValue('username', form),
                "phone_number": FormValidate.getFieldValue('phone_number', form),
                "phone_code": code.text().replace(" ", ""),
                "phone_country_code": form.find('.country').val(),
                "city": (userCity && userCity !== "") ? userCity : FormValidate.getFieldValue('city'),
                "region": userRegion,
                "country": userCountry,
                "country_code": userCountryCode,
                "birth_date": birthDate,
                "email": FormValidate.getFieldValue('email', form),
                "password": FormValidate.getFieldValue('password', form),
                "confirm_password": FormValidate.getFieldValue('confirm_password', form),
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

            if (invite) {
                params['invite'] = invite;
            }
            if (b) {
                params['f_business'] = +b;
            }

            var redirectTo = $(this).attr('data-redirectTo');
            APIStorage.remove('f_name');
            APIStorage.remove('l_name');
            new GraphQL("mutation", "createUserNew", params, ['username', 'token', 'first_name', ''], false, redirectTo, function () {
                Loader.stop();
            }, function (data) {
                //APIStorage.remove('user-terms');
                APIStorage.setToken(data);
            }, form).request();

            return;
        });

        var username = $('input[name="first_name"]').val() + $('input[name="last_name"]').val();
        FormValidate.fieldValidateClear($('input[name="username"]'));
        var regexp = /[^a-zA-Z0-9]/g;
        if (username.search(regexp) !== -1) {
            username = username.replace(regexp, '');
        }
        $('input[name="username"]').val(username.toLowerCase());
        $('#profile-link').text($('#profile-link').attr('data-text') + $('#profile-link').attr('data-url') + "/u/" + username.toLowerCase());

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
        /*body.on('click', '#user-terms', function () {
            FormValidate.fieldValidateClear($(this));
        });*/

        //submit first step of the user signup form
        signUpForm.unbind();
        //signUpForm.submit(function (e) {
        $('#return-terms-modal').click(function (e) {
            e.preventDefault();
            var form = $('#sign-up-user-form');
            FormValidate.fieldsValidateClear(form);
            var userTerms = $('#user-terms');

            if ($('input.user-terms:checked').length < 1) {
                userTerms.show();
                return false;
            }

            if (APIStorage.read("user_social_data")) {
                var userSocialData = JSON.parse(APIStorage.read("user_social_data"));
                signUpForm.find('input[name="social"]').val(userSocialData.id);
                signUpForm.find('input[name="social_id"]').val(userSocialData.social);
                signUpForm.find('input[name="social_token"]').val(userSocialData.token);
                if (userSocialData.gender) {
                    signUpForm.find('input[name="gender"]').val(userSocialData.gender);
                }
                if (userSocialData.userpic) {
                    signUpForm.find('input[name="userpic"]').val(userSocialData.userpic);
                }
                if (userSocialData.userpic_original) {
                    signUpForm.find('input[name="userpic_original"]').val(userSocialData.userpic_original);
                }
            }

            var params = {
                "first_name": FormValidate.getFieldValue('first_name', form),
                "last_name": FormValidate.getFieldValue('last_name', form),
                "username": FormValidate.getFieldValue('username', form),
                "email": FormValidate.getFieldValue('email', form),
                "password": FormValidate.getFieldValue('password', form),
                "confirm_password": FormValidate.getFieldValue('confirm_password', form),
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


            if (invite) {
                params['invite'] = invite;
            }
            if (b) {
                params['f_business'] = +b;
            }
            APIStorage.remove('f_name');
            APIStorage.remove('l_name');

            //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
            new GraphQL("mutation", "createUser", params, ['username', 'token', 'first_name'], false, "/business/signup", function () {
                Loader.stop();
            //}, function (data, firstName) {
            }, function (data) {
                //APIStorage.remove('user-terms');
                APIStorage.setToken(data);

               /* if (signUpStep2.length == 0) {
                    window.location.href = '/user/signup';
                }
                APIStorage.remove('f_name');
                APIStorage.remove('l_name');
                //APIStorage.remove('user-terms');

                APIStorage.setToken(data);
                signUpStep3.fadeOut();
                signUpStep2.fadeIn();
                $('#welcome-username').text($('#welcome-username').attr('data-text') + ' ' + firstName + '!');
                $('input[name="city"]').val(GEO.fullLocation());*/
            }, form).request();
            return false;
        });

        /*body.on('click', '#business-create-start', function errorHandler() {
            updateUser(signUpForm, 'business');
        });

        body.on('click', '#user-signup-info-send', function errorHandler() {
            updateUser(signUpForm);
        });*/
    }

    $('input.user-terms').click(function(){
        var userTerms = $('#user-terms');
        if ($('input.user-terms:checked').length < 1) {
            userTerms.show();
        } else {
            userTerms.hide();
        }
    });

    window.signup_js_initialized = true;
});
