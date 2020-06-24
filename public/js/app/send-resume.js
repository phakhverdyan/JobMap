var sR;

function SendResume(businessID, locationID, jobID) {
    this.businessID = businessID;
    this.locationID = locationID;
    this.jobID = jobID;
    this.btnClickSend;
}

SendResume.prototype = {
    init: function () {
        var _this = this;
        $('body').on('click', '.send-resume', function () {
            _this.locationID = $(this).attr('data-id');
            _this.businessID = $(this).attr('data-b-id');
            _this.jobID = $(this).attr('data-j-id');
            _this.btnClickSend = $(this);
            _this.send($(this));
        });

        $('body').on('click', '#send-login-sign-in', function () {
            $('#sendLoginModal').on('hidden.bs.modal', function () {
                $('#signInModal').modal('show');
                $('#sendLoginModal').unbind('hidden.bs.modal');
            });
            $('#sendLoginModal').modal('hide');
        });

        $('body').on('click', '#send-login-sign-up', function () {
            /*var url = $(this).attr('data-href') + '/user/signup?b=' + _this.businessID;
            $('#sendLoginModal').on('hidden.bs.modal', function () {
                window.open(url, '_blank');
                $('#sendLoginModal').unbind('hidden.bs.modal');
            });
            $('#sendLoginModal').modal('hide');*/

            $('#sendLoginModal').modal('hide');
            setTimeout(function () {
                $('#signUpModal').modal('show');
            },500);
        });
    },

    send: function (elButton) {
        Loader.init();
        var _this = this;
        if (APIStorage.read('api-token')) {
            if (_this.businessID) {
                var params = {
                    "business_id": _this.businessID
                };
                if (_this.locationID) {
                    params['location_id'] = _this.locationID;
                }
                if (_this.jobID) {
                    params['job_id'] = _this.jobID;
                }
                new GraphQL("mutation", "sendResume", params, ['message', 'status', 'token'], true, false, function () {
                    Loader.stop();
                }, function (data) {
                    var html = '';
                    if (data.status === 2) {
                        html = '<p class="text-center mb-0">\n' +
                            '   <a href="' + getBaseURL() + '/user/resume/create" class="btn btn-outline-success p-4" target="_blank">'+Langs.update_my_cr+'</a>\n' +
                            '</p>';
                    }
                    $('#notifyModal').find('#send-resume-message').html('<p>' + data.message + '</p>' + html);
                    $('#notifyModal').modal('show');
                    $('.text-button-send-resume').hide();
                    elButton.text(Langs.you_can_reapply);
                }).request();
            }
        } else {
            //show login modal
            /*
            $('#modal-single-location').on('hidden.bs.modal', function () {
                var img = $('#modal-single-location').find('#location-pic').attr('src');
                var name = $('#modal-single-location').find('#location-name').text();
                $('#sendLoginModal').find('#send-login-name').text(name);
                $('#sendLoginModal').find('.business-logo-medium').attr('src', img);
                $('#sendLoginModal').modal('show');

                $('#modal-single-location').unbind('hidden.bs.modal');
            });
            $('#modal-single-location').modal('hide');
            */
            // $('.block_business-logo-medium').show();
            // $('#signUpModal').modal('show');
            //$('#sendLoginModal').modal('show');

            var widgetOpen = '.widget_open';

            $('.modal-backdrop-custom').toggleClass('show');

            $('.widget_block').slideToggle();

            if ($(widgetOpen).val() == "Upload Resume") {
                $(widgetOpen).val("Close");
            } else {
                $(widgetOpen).val("Upload Resume");
            }

            let _data = {
                location_id: _this.locationID,
                business_id: _this.businessID,
                job_id: _this.jobID,
            };
            $(document).trigger("send:resume:not:login:user", _data);
            console.log("send:resume:not:login:user");
            return false;
        }
    },

    clear: function () {
        this.businessID = null;
        this.locationID = null;
        this.jobID = null;
        this.btnClickSend = null;
    }
};

$(document).ready(function () {
    sR = new SendResume();
    sR.init();
});
