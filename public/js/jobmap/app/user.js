function User() {
    this.data;
}

User.prototype = {
    init: function (done) {
        // var userData = localStorage.getItem('user');
        // if (userData) {
        //     this.data = JSON.parse(userData) || false;
        //     if (this.data) {
        //if the refresh param exist - get data from server
        // if (this.data.refresh === 1) {
        //     this.get();
        // } else {
        //     this.fillUserData();
        // }
        //     } else {
        //         this.get();
        //     }
        // } else {
        this.get(done);
        // }
        APIStorage.create('api-token', APIStorage.read('api-token'));

        $('.user-resume-attach_file-click').click(function () {
            $('#user-resume-attach_file-input').click();
        });

        $('#user-resume-attach_file-input').change(function () {
            var filename = $(this).val();
            filename = filename.substr(filename.lastIndexOf('\\')+1);
            $('#user-resume-attach_file-name').text(filename);
            new GraphQL("mutation", "updateUser", {}, [ 'token', 'attach_file' ], false, false, function () {
                Loader.stop();
            }, function (data) {
                var userData = JSON.parse(localStorage.getItem('user'));
                userData['attach_file'] = data.attach_file;
                localStorage.setItem('user', JSON.stringify(userData));
            }, false, new FormData($('#user-resume-attach_file-form').get(0))).request();
            $('#user-resume-attach_file-ok').modal('show');
        });
        $('#user-resume-attach_file-ok').on('hidden.bs.modal', function () {
            $('#userFirstTime').modal('hide');

            $('#user-resume-attach_file-input').val('');
            $('#user-resume-attach_file-name').text('');
            sR.send(sR.btnClickSend);
        });
    },
    fillUserData: function () {
        if (this.data.user_pic) {
            var userPic = $('.userpic');
            var userPicMenu = $('#menu-userpic');
            var userPicNavbarHover = $('.user-image');
            userPicMenu.parent().attr('data-filter', this.data.user_pic_filter);
            userPic.parent().attr('data-filter', this.data.user_pic_filter);
            userPicNavbarHover.parent().attr('data-filter', this.data.user_pic_filter);
            userPicMenu.attr('src', this.data.user_pic_options).parent().addClass(this.data.user_pic_filter);
            userPic.attr('src', this.data.user_pic_options_sm).parent().addClass(this.data.user_pic_filter);
            userPicNavbarHover.attr('src', this.data.user_pic_options_md).parent().addClass(this.data.user_pic_filter);
        } else {
            $('.userpic').attr('src', '/img/profilepic2.png');
        }
        var fullName = this.data.first_name + ' ' + this.data.last_name;
        $('#user-navbar').find('#user-username').text(fullName);
        $('.menu-username, #menu-username').text(fullName);
    },
    get: function (done) {
        var _this = this;
        //get user data
        new GraphQL("query", "me", {}, [
            'id',
            'email',
            'username',
            'first_name',
            'last_name',
            'user_pic',
            'user_pic_options(width: 200, height: 200)',
            'user_pic_options_md(width: 100, height: 100)',
            'user_pic_options_sm(width: 50, height: 50)',
            'user_pic_filter',
            'city',
            'region',
            'country',
            'country_code',
            'language{ id, name, prefix }',
            'lang_prefix',
            'realtime_token',
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            _this.set(data);
            done && done(data);
        }, false).request();
    },
    getDaysFromSendResume: function () {
        if($('.send-resume').length == 1) {
            var locationID = $('.send-resume').attr('data-id'),
                businessID = $('.send-resume').attr('data-b-id'),
                jobID = $('.send-resume').attr('data-j-id'),
                params = {
                    'business_id': businessID
                };
            if (typeof locationID !== "undefined") {
                params['location_id'] = locationID;
            }
            if (typeof jobID !== "undefined") {
                params['job_id'] = jobID;
            }

            new GraphQL("query", "getDaysFromSendResume", params, [
                'days',
                'token'
            ], true, false, function () {
                Loader.stop();
            }, function (data) {
                if (data.days > 0) {
                    $('.text-button-send-resume').hide();
                    $('.send-resume').text('You can reapply in ' + data.days + ' days');
                }
            }, false).request();
        }
    },
    //save all params for user to local storage
    set: function (data) {
        if (data) {
            delete data['token'];
            this.data = data;
            data['refresh'] = 0;
            localStorage.setItem('user', JSON.stringify(data));
            if (data.lang_prefix && APIStorage.read('language') && APIStorage.read('language') != data.lang_prefix) {
                APIStorage.create('language', data.lang_prefix);
                window.location.reload();
            }
            this.fillUserData();

            this.getDaysFromSendResume();
        }
    },
    //set last active business
    setLastBusiness: function (user, redirect) {
        new GraphQL("mutation", "updateUser", {
            last_active_business: +user
        }, [
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function () {
            Loader.stop();
            if (user === 0) {
                APIStorage.remove('last-business-id');
            } else {
                APIStorage.create('last-business-id', user);
            }
            window.location.href = redirect;
        }, false).request();
    },
    //set refresh param in local storage
    refresh: function () {
        var userData = JSON.parse(localStorage.getItem('user'));
        userData['refresh'] = 1;
        localStorage.setItem('user', JSON.stringify(userData));
    },
    logout: function () {
        //remove all api cookies
        APIStorage.remove('api-token');
        APIStorage.remove('api-user');
        //clear user data from local storage
        localStorage.removeItem('user');
        // $('#navbar').show();
        // $('#navbar-auth').hide();
        window.location.reload();
    }
};
