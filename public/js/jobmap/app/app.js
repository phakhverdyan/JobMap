var userCity, userRegion, userCountry, userCountryCode = "";
var user;
var business;
var app;

function App() {
    this.objects;

    this.load = 0;
}

App.prototype = {
    init: function () {
        var _this = this;
        new GraphQL("query", "api", {}, [
            'token'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            if (data) {
                if (data.token) {
                    APIStorage.create('api-token', data.token);
                    user = new User();

                    user.init(function(data) {
                        // console.log('DATA.U', data);
                        realtime.subscribeToUser(data);
                        window.chat_initialize && chat_initialize();
                    });

                    // setTimeout(function () {
                    //     $('#navbar').hide();
                    //     $('#navbar-auth').show();
                    // }, 0);
                } else {
                    // setTimeout(function () {
                    //     APIStorage.remove('api-token');
                    //     $('#navbar').show();
                    //     $('#navbar-auth').hide();
                    // }, 0);

                    window.chat_initialize && chat_initialize();
                }
            } else {
                hardReset();
            }
            $('#auth-no-login').css('visibility', 'visible');
        }, false).request();
    },
    api: function () {

    },

    run: function (module) {
        var _this = this;
        setTimeout(function () {
            if (_this.objects) {
                _this.objects();
            }
            setTimeout(function () {
                if (module) {
                    module.request();
                }
            }, 0);
        }, 0);
    },

    scripts: function (callback) {
        this.objects = callback;
    },

    logout: function () {
        var _this = this;
        user.logout();
        // business.logout();
        APIStorage.remove("user_social_data");
        //redirect

        window.location.href = "/";

        // business.logout();

        //redirect
        // window.location.href = "/";
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
    app.init();

    var body = $('body');

    //click on confirm logout button
    $('#confirm-logout-button').on('click', function () {
        app.logout();
    });

    body.on('click', '.switch-to-business', function () {
        var id = $(this).attr('data-business');
        if (id !== "") {
            APIStorage.create('business-id', id);
            user.setLastBusiness(id, '/business/dashboard');
        }
    });

    body.on('click', '.switch-to-user', function () {
        user.setLastBusiness(0, '/user/dashboard');
    });

    //---------------------------------------------------------------------------------job share

    body.on('click', '[data-target="#ShareModal"]', function () {
        var linkShare = '';

        if ($(this).attr('data-link')) {
            linkShare = $(this).attr('data-link');
        } else {
            linkShare = 'https://jobmap.co/map/view/job/' + $(this).attr('data-id');
        }

        if ($(this).attr('data-title')) {
            linkTitle = $(this).attr('data-title');
        } else {
            linkTitle = 'JobMap';
        }

        if ($(this).attr('data-image')) {
            linkImage = $(this).attr('data-image');
        } else {
            linkImage = null;
        }

        if ($(this).attr('data-description')) {
            linkDescription = $(this).attr('data-description');
        } else {
            linkDescription = '';
        }

        $('#share-link').val(linkShare);
        $('#share-link-title').val(linkTitle);
        $('#share-link-description').val(linkDescription);
        $('#share-link-image').val(linkImage);
    });

    $('#shareFacebook').click(function () {
        // var ogUrl = $('#share-link').val();

        var shareImage = $('#share-link-image').val();

        var ogTitle = $('#share-link-title').val();
        if (!ogTitle) {
            ogTitle = $('title').text();
        }

        ogDescription = $('#share-link-description').val();
        if (!ogDescription) {
            ogDescription = '';
        }

        let ogUrl = $('#share-link').val(),
            ogImage = shareImage ? shareImage : window.location.origin + '/img/jm_logo.png';

        FB.ui({
                method: 'share_open_graph',
                action_type: 'og.shares',
                action_properties: JSON.stringify({
                    object : {
                        'og:url': ogUrl,
                        'og:title': ogTitle,
                        'og:description': ogDescription,
                        'og:image': ogImage
                    }
                })
                /*method: 'feed',
                link: ogUrl,*/
            },
            function(response) {
                if (response && !response.error_message) {
                    //
                } else {
                    console.log('Something went error.');
                }
            });


        // FB.ui({
        //     method: 'share',
        //     href: ogUrl,
        // }, function(response){});
    });

    $('#shareGoogle').click(function () {
        var ogUrl = $('#share-link').val();
        window.open("https://plus.google.com/share?url=" + ogUrl, 'sharer', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=600');return false;
    });

    $('#shareTwitter').click(function () {
        var ogUrl = $('#share-link').val();
        window.open("https://twitter.com/share?url=" + ogUrl, 'sharer', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=600');return false;
    });

    $('#shareLinkedin').click(function () {
        var ogUrl = $('#share-link').val();
        window.open("https://www.linkedin.com/sharing/share-offsite/?url=" + ogUrl, 'sharer', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=600');return false;
    });

    if ($('#clipboard-button').length > 0) {
        var clipboard = new Clipboard('#clipboard-button');
        clipboard.on('success', function (e) {
            $.notify('Copied!', 'success');
            e.clearSelection();
        });
    }

    $('.jobmap__signup').click(function () {
        if ($('#signUpBusinessModal').length > 0) {
            $('#signUpBusinessModal').modal('show');
        } else if ($('.widget_open').length > 0) {
            $('.widget_open').click();
        } else {
            console.error('NEED SOME REACTION HERE!');
        }
    });
});
