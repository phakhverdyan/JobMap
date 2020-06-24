var userCity, userRegion, userCountry, userCountryCode = "";
var currentLocation="", currentCountryCode = "", currentCity, currentRegion, currentCountry;
var business;
var app;
var appPromise;
var appPromiseStatus = false;
var loadPromise;
var user;


var promiseStack = [];

function App() {
    this.objects = [];
    this.method = [];
    this.init();
    this.addToPromise(this._getLanguage);
    this.load = 0;
}

App.prototype = {
    init: function () {
        if (APIStorage.read('api-token') && APIStorage.read('api-token').length !== 0) {
            var _this = this;

            _this.addToPromise(_this._getLanguage);
            _this.addToPromise(_this._u);
            _this.addToPromise(function () {

                window.business = window.business || new Business();

                business.init(function (data) {
                    if (window.location.pathname.indexOf('/business') > -1) {
                        data.filter(function (business) {
                            return parseInt(business.id) === (parseInt(APIStorage.read('business-id')) || 0);
                        }).forEach(function (business) {
                            realtime.subscribeToBusiness(business);
                            window.chat_initialize && chat_initialize();
                        });
                    }

                });
            });

            // //$('#navbar').remove();
            // $('#navbar').hide();
            // $('#navbar-auth').show();
        } else {
            // //$('#navbar-auth').remove();
            // $('#navbar-auth').hide();
            // $('#navbar').show();
        }
        $('#auth-no-login').css('visibility', 'visible');
    },
    _getLanguage: function () {
        var _this = this;

        if (typeof defaultLang === 'undefined') {
            defaultLang = 'en';
        }

        localStorage.setItem('language', defaultLang);
        $.ajax({
            url: '/langs/' + defaultLang,
            dataType: 'json',
            async: false,
            method: "GET",
            success: function (lang) {
                Langs = lang
            },
            error: function () {
                defaultLang = 'en';
                //_this.getLanguage();
                localStorage.setItem('language', defaultLang);
                $.ajax({
                    url: '/langs/' + defaultLang,
                    dataType: 'json',
                    method: "GET",
                    async: false,
                    success: function(lang) {
                        Langs = lang;
                    },
                    error: function () {
                    }
                });
            }
        });

        return true;
    },
    _setLanguage: function (lang) {
        //
    },
    _u: function () {
        window.user = window.user || new User();

        user.init(function (data) {
            if (window.location.pathname.indexOf('/user') > -1 && data) {
                window.realtime && realtime.subscribeToUser(data);
            }

            window.chat_initialize && chat_initialize();
        });

        return user;
    },

    _r: function (module) {
        var _this = this;
        if (_this.objects && _this.method) {
            _this.objects[_this.method]();
        }
        if (module) {
            module.request();
        }

        _this.appPromiseStatus = true;
    },
    addToPromise: function (f) {
        var _this = this;
        if (typeof f === 'number') {
            promiseStack.push(Promise.resolve(_this.objects[f - 1][_this.method[f - 1]]()));
        } else {
            promiseStack.push(Promise.resolve(f()));
        }
    },
    runPromise: function () {
        var _this = this;
        var p = Promise.resolve();
        return promiseStack.reduce(function (pacc, fn) {
            return pacc.then(function () {
                return fn;
            });
        }, p);
    },
    // run: function (module) {
    //     var _this = this;
    //     if (_this.appPromiseStatus) {
    //         _this._r(module);
    //     } else {
    //         _this.appPromise.then(function () {
    //             return _this._r(module);
    //         });
    //     }
    // },

    scripts: function (callback, method) {
        this.objects.push(callback);
        this.method.push(method);
        this.addToPromise(this.objects.length);
    },

    logout: function () {
        user.logout();
        business.logout();
        APIStorage.remove("user_social_data");
        //redirect

        window.location.href = "/";
    }
};

window.trans = function(path, parameters) {
    if (!window.Langs) {
        throw new Error('[LANG] No language loaded');
    }

    parameters = parameters || [];

    var expression = path.split(/\./).reduce(function(list, part) {
        return (list && list[part]) ? list[part] : null;
    }, Langs) || '';

    expression && (expression.match(/\:[a-z_]+/g) || []).map(function(match) {
        return match.slice(1);
    }).filter(function(parameter_name, parameter_name_index, parameter_names) {
        return parameter_names.indexOf(parameter_name) == parameter_name_index;
    }).sort(function(parameter_name0, parameter_name1) {
        return parameter_name1.length - parameter_name0.length;
    }).forEach(function(parameter_name) {
        if (typeof parameters[parameter_name] === 'undefined') {
            throw new Error('[LANG] Parameter `' + parameter_name + '` is not set in `' + path + '` path');
        }

        expression = expression.replace(new RegExp('\:' + parameter_name, 'g'), parameters[parameter_name] || '');
    });

    return expression || path;
};

$(document).ready(function () {
    //init app object
    window.app = window.app || new App();
    loadPromise = Promise.resolve();

    $.get('/get/session_value', {
        session_name: 'verification'
    }, function (response) {
        setTimeout(function () {
            if (!(typeof user === 'undefined') && user) {
                if (response.success) {
                    if (response.value == 'update') {
                        user.data.verification_code = null;
                        user.data.verification_date = 'no';
                        localStorage.setItem('user', JSON.stringify(user.data));
                    }
                    $('#verificationCodeOk').modal('show');
                }
                else {
                    if (user.data.verification_date == 'goTime') {
                        // $('#verificationCodeGoTime').modal('show');
                        $('.email_confirm_push').prev('.email_confirm_push_separator').show();
                        $('.email_confirm_push').addClass('active').show();
                    } else if (user.data.verification_date == 'endTime') {

                    }
                }
            }
        }, 1000);
    });

    var body = $('body');

    //click on confirm logout button
    $('#confirm-logout-button').on('click', function () {
        app.logout();
    });

    body.on('click', '.switch-to-business', function () {
        var id = $(this).attr('data-business');
        APIStorage.create('seeker-mode', false);
        if ($(this).next().next().find('li').length > 3) {
            $(this).next().click();
            return false;
        } else {
            if (id !== "") {
                APIStorage.create('business-id', id);
                //user.setLastBusiness(id, '/business/dashboard', true);
                user.setLastBusiness(id, '/business/candidate/manage', true);
            }
        }
    });

    body.on('click', '.switch-to-user', function () {
        APIStorage.create('seeker-mode', true);
        user.setLastBusiness(0, '/user/dashboard', false);
    });

    /*body.on('click', '.business-link__edit-career, .business-link__create_new', function () {
        APIStorage.remove('brand-business-id');
        APIStorage.remove('brand-id');
    });*/

    var countItem = 0, countCharts = [];
    countItem[0] = 0;
    $('.formSendFeedback [name="message"]').keyup(function () {
        var form = $(this).closest('.formSendFeedback'),
            inputFeedback = form.find('[name="message"]');
        FormValidate.fieldsValidateClear(form);
        if (inputFeedback.get(0) && inputFeedback.get(0).scrollHeight > inputFeedback.innerHeight() && inputFeedback.height() < 70) {
            inputFeedback.css('height', inputFeedback.height() + 36);//animate({'height': inputFeedback.height()+36}, 500);
            countItem++;
            countCharts[countItem] = inputFeedback.val().length - 1;
        }
        if (inputFeedback.val().length < countCharts[countItem]) {
            inputFeedback.css('height', inputFeedback.innerHeight() - 20);//animate({'height': inputFeedback.height()+36}, 500);
            countItem--;
        }
    });
    $('.btnSendFeedback').click(function () {
        var form = $(this).closest('.formSendFeedback');
        var inputFeedback = form.find('[name="message"]');
        var business_id = 0;

        if (window.location.pathname.indexOf('/business') === 0) {
            business_id = parseInt(APIStorage.read('business-id')) || 0;
        }

        new GraphQL("mutation", "sendFeedback", {
            //business_id: business_id,
            message: FormValidate.getFieldValue('message', form)
        }, [
            'token',
            'response',
        ], true, false, function() {
            Loader.stop();
        }, function(data) {
            inputFeedback.val('');
            inputFeedback.css('height', 36);
            $('#feedbackModalSend').modal('show');
            $('.modal-backdrop').toggleClass('show');
            $('.modal-backdrop').toggleClass('hide');
        }, form).request();
    });

    $(body).on('click', '.help-how-to-start-show', function () {

        if ($('.help-how-to-start-block').is(':hidden')) {
            $('.help-how-to-start-block').show();
        }
    });

    $(body).on('click', '.help-how-to-start-hide', function () {

        if ($('.help-how-to-start-block').is(':visible')) {
            $('.help-how-to-start-block').hide();
        }
    });

    $(body).on('click', '.help-how-to-start-gotit', function () {

        let type = window.location.pathname.split("/")[2],
            section = window.location.pathname.split("/")[1];

        new GraphQL("mutation", "saveHowToStartGotIt", {
            'business_id': business.currentID,
            'user_id': user.data.id,
            'type': type,
            'section': section
        }, [
            'result',
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
        }, false).request();
    });

    $(body).on('click', '#close-new_start_here', function () {

        $('#new_start_here').hide();
        $('#new_start_here').parent().removeClass('my-4');

        new GraphQL("mutation", "saveNewStartHereBusiness", {
            'business_id': business.currentID
        }, [
            'result',
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
        }, false).request();

        return false;
    });
});
