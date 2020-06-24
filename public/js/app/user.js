function User() {
    this.data;
    this.clickSaveStep = true;

}

User.prototype = {
    init: function (done) {
        var userData = localStorage.getItem('user');
        if (userData) {
            this.data = JSON.parse(userData) || false;
            if (this.data) {
                //if the refresh param exist - get data from server
                if (this.data.refresh === 1 || APIStorage.read('r_u')) {
                    this.get(done);
                } else {
                    this.fillUserData();
                    done && done(this.data);
                }
            } else {
                this.get(done);
            }
        } else {
            this.get(done);
        }
        if (APIStorage.read('api-token').length !== 0) {
            APIStorage.create('api-token', APIStorage.read('api-token'));
        }

        $('#profile-user__add-to-pipeline-user').click(function () {
            var params = {
                'business_id': APIStorage.read('last-business-id') || 0,
                'user_id': parseInt($(this).attr('data-id'))
            };
            new GraphQL("mutation", "CreateCandidate", params, ['token'], true, false, function () {
                Loader.stop();
            }, function (data) {
                alert('ok');
            }).request();
        });

        this.settings();

        //get notify Counters: references, send_resume, resume_builder
        new GraphQL("query", 'notifyCounterLastDateUser', {
            //'user_id': this.data.id
        }, [
            'references',
            'sent_resumes',
            'sent_resumes_new',
            'sent_resumes_not_new',
            'sent_resumes_ask',
            'sent_resumes_ask_new',
            'sent_resumes_ask_not_new',
            'sent_resumes_companies',
            'resume_builder',
            'last_update',
            'last_viewed',
            'last_sent',
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            if (!data.references || data.references == 0) {
                $('.countReferences').text('');
                $('.countReferences').addClass("hide");
            } else {
                $('.countReferences').text(data.references);
                $('.countReferences').removeClass("hide");
            }
            if (!data.sent_resumes || data.sent_resumes == 0) {
                $('.countSentResumes').text('');
                $('.countSentResumes').fadeOut();
            } else {
                $('.countSentResumes').text(data.sent_resumes);
                $('.countSentResumes').fadeIn();
            }

            if (!data.sent_resumes_ask ||data.sent_resumes_ask == 0) {
                $('.countSentResumesAsk').text('');
                $('.countSentResumesAsk').addClass("hide");
            } else {
                $('.countSentResumesAsk').text(data.sent_resumes_ask);
                $('.countSentResumesAsk').removeClass("hide");
            }

            $('.countSentResumesL').text(data.sent_resumes).fadeIn();
            $('.countSentResumesNew').text(data.sent_resumes_new).fadeIn();
            $('.countSentResumesNotNew').text(data.sent_resumes_not_new).fadeIn();
            $('.countSentResumesAskL').text(data.sent_resumes_ask).fadeIn();
            $('.countSentResumesAskNew').text(data.sent_resumes_ask_new).fadeIn();
            $('.countSentResumesAskNotNew').text(data.sent_resumes_ask_not_new).fadeIn();
            $('.countSentResumesCompanies').text(data.sent_resumes_companies).fadeIn();

            if (!data.resume_builder || data.resume_builder == 0) {
                $('.countResumeBuilder').text('');
                $('.countResumeBuilder').addClass("hide")
            } else {
                $('.countResumeBuilder').text(data.resume_builder);
                $('.countResumeBuilder').removeClass("hide")
            }
            $('.lastUpdate').text(data.last_update);
            $('.lastViewed').text(data.last_viewed);
            $('.lastSent').text(data.last_sent);
        }).request();

        //----------------------------------------------------------Settings
        if (user.data.social) {
            $('.change-email-warning').fadeIn();
        }

        if(user.data.on_email_send === 1){
            $(document).find('.email-send-OnOff input[value="off"]').parent().removeClass('active');
            $(document).find('.email-send-OnOff input[value="on"]').parent().addClass('active');
        }else if(user.data.on_email_send === 0){
            $(document).find('.email-send-OnOff input[value="on"]').parent().removeClass('active');
            $(document).find('.email-send-OnOff input[value="off"]').parent().addClass('active');
        }

        $('.tooltipOnOff input[value="' + user.data.show_tooltip +'"]').parent().addClass('active');
        if (user.data.show_tooltip == 'on') {
            $('[data-toggle="tooltip"]').tooltip('enable');
        } else {
            $('[data-toggle="tooltip"]').tooltip('disable');
        }
        $('#currentEmail').val(user.data.email);

        $('#changeEmail, #changePass').on('click keyup', 'input', function () {
            FormValidate.fieldValidateClear($(this));
        });
        $('[data-target="#changeEmail"], [data-target="#changePass"]').click(function () {
            $('#changeEmail input[name="email"]').val('');
            $('#changePass input[name="password"]').val('');
        });
        $('#btnChangeEmail').click(function () {
            var $currentForm = $('#changeEmail');
            var email = $currentForm.find('input[name="email"]').val();

            new GraphQL("mutation", "changeEmail", {
                id: user.data.id,
                email: FormValidate.getFieldValue('email', $currentForm),
            }, [
                'result',
                'token',
            ], true, false, function () {
                Loader.stop();
            }, function(data) {
                $currentForm.modal('hide');
                $('#changeEmailConfirmation').modal('show');
                // APIStorage.create('api-token', data.token);
                // var userData = JSON.parse(localStorage.getItem('user'));
                // userData['email'] = email;
                // localStorage.setItem('user', JSON.stringify(userData));
                // currentForm.modal('hide');
            }, $currentForm).request();
        });
        $('#btnChangePass').click(function () {
            var $currentForm = $('#changePass');

            new GraphQL("mutation", "changePass", {
                id: user.data.id,
                current_password: FormValidate.getFieldValue('current_password', $currentForm),
                new_password: FormValidate.getFieldValue('new_password', $currentForm),
                new_password_confirmation: FormValidate.getFieldValue('new_password_confirmation', $currentForm),
            }, [
                'result',
                'token',
            ], true, false, function() {
                Loader.stop();
            }, function(data) {
                $currentForm.modal('hide');
                $('#changePasswordConfirmation').modal('show');
                // APIStorage.create('api-token', data.token);
            }, $currentForm).request();
        });
        $('.tooltipOnOff').click(function () {
            if ($(this).hasClass('active')) {
                return;
            }
            let action = $(this).find('input').val();

            if (action == 'on') {
                $('[data-toggle="tooltip"]').tooltip('enable');
            } else {
                $('[data-toggle="tooltip"]').tooltip('disable');
            }
            new GraphQL("mutation", "setShowTooltip", {
                "id": user.data.id,
                "action": action,
            }, [
                'result',
                'token'
            ], true, false, function () {
                Loader.stop();
            }, function (data) {
                let userData = JSON.parse(localStorage.getItem('user'));
                userData['show_tooltip'] = action;
                localStorage.setItem('user', JSON.stringify(userData));
            }, false).request();
        });

        $(document).find('.email-send-OnOff').click(function () {
            if ($(this).hasClass('active')) {
                return;
            }
            let action = $(this).find('input').val();
            console.log(user.data.id);
            request({
                url: "/users/update-on-email-send",
                data: {
                    id: user.data.id,
                    action: action,
                },
                //method: "POST"
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    let userData = JSON.parse(localStorage.getItem('user'));
                    if(action === "on"){
                        userData['on_email_send'] = 1;
                    }else if(action === "off"){
                        userData['on_email_send'] = 0;
                    }
                    localStorage.setItem('user', JSON.stringify(userData));
                }
            });

        });

        this.getDaysFromSendResume();

        $('#sidebar-looking_job').click(function () {
            let value,
                params = {
                    'looking_job': 'yes'
                };
            if ($(this).is(':checked')) {
                value = 'yes';
                params['new_job'] = 'no';
                user.data.new_job = 'no';
                $('#sidebar-looking_job').closest('.block-checkbox').find('.yes-no').text(trans('yes'));
                $('#sidebar-its_urgent').closest('.block-checkbox').show();
                $('#sidebar-new_job').closest('.block-checkbox').hide();
                $('#sidebar-new_job').closest('.block-checkbox').find('.yes-no').text(trans('no'));
                $('#sidebar-new_job').prop('checked', false);
                $('[name="looking_job"][value="yes"]').parent().addClass('active');
                $('[name="looking_job"][value="no"]').parent().removeClass('active');
                $('[name="new_job"][value="yes"]').closest('.form-group').hide();
            } else {
                value = 'no';
                params['its_urgent'] = 'no';
                user.data.its_urgent = value;
                $('#sidebar-looking_job').closest('.block-checkbox').find('.yes-no').text(trans('no'));
                $('#sidebar-its_urgent').closest('.block-checkbox').hide();
                $('#sidebar-its_urgent').closest('.block-checkbox').find('.yes-no').text(trans('no'));
                $('#sidebar-its_urgent').prop('checked', false);
                $('#sidebar-new_job').closest('.block-checkbox').show();
                $('[name="looking_job"][value="yes"]').parent().removeClass('active');
                $('[name="looking_job"][value="no"]').parent().addClass('active');
                $('[name="new_job"][value="yes"]').closest('.form-group').show();
            }
            user.data.looking_job = value;
            localStorage.setItem('user', JSON.stringify(user.data));
            params['looking_job'] = value;
            new GraphQL("mutation", "savePreferenceFieldsUser", params, [
                'result',
                'token'
            ], true, false, function () {
                Loader.stop();
            }, function (data) {

            }, false).request();
        });

        $('#sidebar-its_urgent').click(function () {
            let value;
            if ($(this).is(':checked')) {
                $('#sidebar-its_urgent').closest('.block-checkbox').find('.yes-no').text(trans('yes'));
                value = 'yes';
            } else {
                $('#sidebar-its_urgent').closest('.block-checkbox').find('.yes-no').text(trans('no'));
                value = 'no';
            }
            user.data.its_urgent= value;
            localStorage.setItem('user', JSON.stringify(user.data));
            new GraphQL("mutation", "savePreferenceFieldsUser", {
                "its_urgent": value
            }, [
                'result',
                'token'
            ], true, false, function () {
                Loader.stop();
            }, function (data) {

            }, false).request();
        });

        $('#sidebar-new_job').click(function () {
            let value;
            if ($(this).is(':checked')) {
                value = 'yes';
                $('#sidebar-new_job').closest('.block-checkbox').find('.yes-no').text(trans('yes'));
                $('[name="new_job"][value="yes"]').parent().addClass('active');
                $('[name="new_job"][value="no"]').parent().removeClass('active');
            } else {
                value = 'no';
                $('#sidebar-new_job').closest('.block-checkbox').find('.yes-no').text(trans('no'));
                $('[name="new_job"][value="yes"]').parent().removeClass('active');
                $('[name="new_job"][value="no"]').parent().addClass('active');
            }
            user.data.new_job = value;
            localStorage.setItem('user', JSON.stringify(user.data));
            new GraphQL("mutation", "savePreferenceFieldsUser", {
                "new_job": value
            }, [
                'result',
                'token'
            ], true, false, function () {
                Loader.stop();
            }, function (data) {

            }, false).request();
        });
        //set user link
        $('#link-user-profile').val($('#link-user-profile').attr('data-url') + this.data.username);
         if ($('#clipboard-button').length > 0) {
             var clipboard = new Clipboard('#clipboard-button');
             clipboard.on('success', function (e) {
                 $.notify('Copied!', 'success');
                 e.clearSelection();
             });
         }

        $('#send-my-user-profile').click(function () {
            let form = $('#emailmodal'),
                modalPopup = $('#okSendMyUserProfile');

            new GraphQL("mutation", "sendMyUserProfile", {
                type: form.find('label.active input').val(),
                email: FormValidate.getFieldValue('email', form),
                message: FormValidate.getFieldValue('message', form)
            }, [
                'response',
                'token'
            ], false, false, function () {
                Loader.stop();
            }, function (data) {
                $('#emailmodal').modal('hide');
                modalPopup.modal('show');
            }, form).request();
        });
        $('#emailmodal').on('click', 'input, textarea', function () {
            FormValidate.fieldValidateClear($(this));
        });

        // work attach_file in resume

        $('.user-resume-attach_file-click').click(function () {
            $('#user-resume-attach_file-input').click();
        });

        $('#user-resume-attach_file-input').change(function () {
            var filename = $(this).val();
            filename = filename.substr(filename.lastIndexOf('\\')+1);
            $('#user-resume-attach_file-name').text(filename);

            var formData = new FormData();
            formData.append('attach_file', $('#user-resume-attach_file-input').get(0).files[0]);

            new GraphQL(
                "mutation",
                "updateUser",
                {},
                [ 'token', 'attach_file' ],
                true,
                false,
                function () {
                    Loader.stop();
                }, function (data) {
                    var userData = JSON.parse(localStorage.getItem('user'));
                    userData['attach_file'] = data.attach_file;
                    localStorage.setItem('user', JSON.stringify(userData));
                },
                false,
                formData
            ).request();

            $('#user-resume-attach_file-ok').modal('show');

        });
        $('#user-resume-attach_file-ok').on('hidden.bs.modal', function () {
            $('#userFirstTime').modal('hide');

            $('#user-resume-attach_file-input').val('');
            $('#user-resume-attach_file-name').text('');

            if(typeof sR !== 'undefined'){
                sR.send(sR.btnClickSend);
            }

        });
    },
    fillUserData: function () {
        if (this.data.user_pic) {
            var userPic = $('.userpic');
            var userPicMenu = $('.menu-userpic');
            var userPicNavbarHover = $('.user-image');
            userPicMenu.parent().parent().attr('data-filter', this.data.user_pic_filter);
            userPic.parent().attr('data-filter', this.data.user_pic_filter);
            userPicNavbarHover.parent().attr('data-filter', this.data.user_pic_filter);
            userPicMenu.attr('src', this.data.user_pic_options);
            userPicMenu.parent().parent().addClass(this.data.user_pic_filter);
            userPic.attr('src', this.data.user_pic_options_sm).parent().addClass(this.data.user_pic_filter);
            userPicNavbarHover.attr('src', this.data.user_pic_options_md).parent().addClass(this.data.user_pic_filter);
            $('.user-logo-modal').attr('src', this.data.user_pic_options_md).parent().addClass(this.data.user_pic_filter);
        } else {
            $('.userpic').attr('src', '/img/profilepic2.png');
        }
        var fullName = this.data.first_name + ' ' + this.data.last_name;
        $('#user-navbar').find('#user-username').text(this.data.username);
        $('.menu-firstname').text(this.data.first_name);
        $('.menu-username').text(fullName);
        $('.menu-profile-link').attr('href', $('.menu-profile-link').attr('href') + this.data.username);
        $('.user-name-modal').text(fullName);

        if (this.data.looking_job == 'yes') {
            $('#sidebar-looking_job').attr('checked', true);
            $('#sidebar-looking_job').closest('.block-checkbox').find('.yes-no').text(trans('yes'));
            $('#sidebar-its_urgent').closest('.block-checkbox').show();
            $('#sidebar-new_job').closest('.block-checkbox').hide();
            $('[name="new_job"][value="yes"]').closest('.form-group').hide();
        } else {
            $('#sidebar-looking_job').attr('checked', false);
            $('#sidebar-looking_job').closest('.block-checkbox').find('.yes-no').text(trans('no'));
            $('#sidebar-its_urgent').closest('.block-checkbox').hide();
            $('#sidebar-new_job').closest('.block-checkbox').show();
            $('[name="new_job"][value="yes"]').closest('.form-group').show();
        }
        if (this.data.its_urgent == 'yes') {
            $('#sidebar-its_urgent').attr('checked', true);
            $('#sidebar-its_urgent').closest('.block-checkbox').find('.yes-no').text(trans('yes'));
        } else {
            $('#sidebar-its_urgent').attr('checked', false);
            $('#sidebar-its_urgent').closest('.block-checkbox').find('.yes-no').text(trans('no'));
        }
        if (this.data.new_job == 'yes') {
            $('#sidebar-new_job').attr('checked', true);
            $('#sidebar-new_job').closest('.block-checkbox').find('.yes-no').text(trans('yes'));
        } else {
            $('#sidebar-new_job').attr('checked', false);
            $('#sidebar-new_job').closest('.block-checkbox').find('.yes-no').text(trans('no'));
        }
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
            'attach_file',
            'user_pic(origin: true)',
            'user_pic_options(width: 200, height: 200)',
            'user_pic_options_md(width: 100, height: 100)',
            'user_pic_options_sm(width: 50, height: 50)',
            'user_pic_filter',
            'street',
            'city',
            'region',
            'country',
            'country_code',
            'phone_number',
            'phone_code',
            'phone_country_code',
            'birth_date',
            'language{ id, name, prefix }',
            'realtime_token',
            'token',
            'verification_code',
            'verification_date',
            'show_tooltip',
            'social',
            'looking_job',
            'new_job',
            'its_urgent',
            'run_first',
            'on_email_send'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            if (!data.run_first) {
                $('#userFirstTime').modal('show');
                new GraphQL("mutation", "updateFieldRunFirst", {
                    'run_first': 1
                }, [
                    'token', 'response'
                ], true, false, function () {
                    Loader.stop();
                }, function (data) {

                }, false).request();
                data.run_first = 1;
            }
            _this.set(data);
            APIStorage.remove("user_social_data");
            // APIStorage.remove("r_u");
            done && done(data);
        }, false).request();
    },
    getDaysFromSendResume: function () {
        var locationID = $('.send-resume').attr('data-id'),
            businessID = $('.send-resume').attr('data-b-id'),
            jobID = $('.send-resume').attr('data-j-id'),
            params = {
                'business_id': businessID
            };
        if (businessID) {
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
                if (data.days >0 ) {
                    $('.text-button-send-resume').hide();
                    $('.send-resume').text(trans('you_can_reapply_in') + ' ' + data.days + ' ' + trans('days'));
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
            this.fillUserData();
        }
    },
    //set last active business
    setLastBusiness: function (user, redirect, reload) {
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
            if (reload && $('.switch-to-user').length > 0) {
                location.reload();
            } else {
                window.location.href = redirect;
            }
        }, false).request();
    },
    settings: function () {
        var _this = this;
        var promise = new Promise(function (resolve, reject) {
            var url = document.location.pathname;
            var urlData = url.split(/\//).slice(1);

            if (urlData[1]) {
                if (urlData[1] === 'settings') { // handle: `/user/settings` and `/business/settings`
                    resolve(1);
                }
            }
            else {
                resolve(2);
            }
        });

        promise.then(function (value) {
            if (value === 1) {
                _this.getLanguagesList();

            } else {
                return false;
            }
        });

        return promise;
    },
    getLanguagesList: function () {
        var _this = this;
        new GraphQL("query", "languages", {}, [
            'id',
            'name',
            'prefix'
        ], false, false, function () {
            Loader.stop();
        }, function(languages) {
            if (languages) {
                var userData = JSON.parse(localStorage.getItem('user'));
                var html = '';
                var i = 0;
                var j = 0;
                languages.forEach(function(language) {
                    /*if (i === 0) {
                        html += '<div class="mr-2">';
                    }
                    i++;
                    j++;
                    var classActive = '';
                    if (userData && item.id == userData.language) {
                        classActive = 'active';
                    }
                    var prefix = (item.prefix === 'en') ? 'US' : item.prefix.toUpperCase();
                    html += '<button class="language-item btn btn-outline-primary mb-0 btn-block d-flex ' + classActive + '" data-id="' + item.id + '">\n' +
                        '<span>\n' +
                        '<i class="glyphicon bfh-flag-' + prefix + '"></i>\n' +
                        '</span>\n' +
                        '<span>' + item.name + '</span>\n' +
                        '</button>';*/
                    /*if (i === 3 || (j === data.length)) {
                        i = 0;
                        html += '</div>';
                    }*/
                    // var classActive = '';

                    // if (userData && item.id == userData.language) {
                        // classActive = 'selected';
                    // }

                    // var addName = '';
                    /*if (item.id ==1) {
                        addName = ' (Default)';
                    }*/

                    $('#setting-languages-list').append('<option value="'+ language.prefix +'">'+ language.name +'</option>');
                });
                $('#setting-languages-list').val(userData.language && userData.language.prefix || 'en');
                //$('#setting-languages-list').html(html);

                /*$('body').on('click', '.language-item', function () {
                    $('#setting-languages-list').find('button').removeClass('active');
                    $(this).addClass('active');
                    var id = $(this).attr('data-id');
                    _this.setUserLanguage(id);
                });*/
            }
        }, false).request();
        /*$('body').on('click', '.language-item', function () {
            $('#setting-languages-list').find('button').removeClass('active');
            $(this).addClass('active');
            var id = $(this).attr('data-id');
            _this.setUserLanguage(id);
        });*/
        $('#setting-languages-list').change(function() {
            _this.setUserLanguage($(this).val());
        });
    },
    setUserLanguage: function(language_prefix) {
        if (language_prefix) {
            new GraphQL("mutation", "updateUser", {
                language_prefix: language_prefix,
            }, [
                'token'
            ], true, false, function () {
                Loader.stop();
            }, function () {
                Loader.stop();
                user.refresh();

                setTimeout(function() {
                    window.location.reload();
                }, 200);
            }, false).request();
        }
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
    }
};
