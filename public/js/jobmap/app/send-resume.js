var sR;

function SendResume(businessID, locationID, jobID, jobLocationID) {
    this.businessID = businessID;
    this.locationID = locationID;
    this.jobID = jobID;
    this.jobLocationID = jobLocationID;
    this.questions = [];
    this.questionsCount = 0;
    this.btnClickSend;
}

SendResume.prototype = {
    init: function () {
        var _this = this;
        $('body').on('click', '.send-resume', function () {
            _this.locationID = $(this).attr('data-id');
            _this.businessID = $(this).attr('data-b-id');
            _this.jobID = $(this).attr('data-j-id');
            _this.jobLocationID = $(this).attr('data-j-l-id');
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
            $('#sendLoginModal').modal('hide');
            setTimeout(function () {
                $('#signUpModal').modal('show');
            },500);
        });

        $('#job-question__btn-next').click(function () {
            var number = parseInt($(this).attr('data-number'));
            var question_id = _this.questions[number-1].id;
            var form = $('#questionnaireModalRun');
            var params = {
                'question_id': question_id,
                'answer': FormValidate.getFieldValue('answer', form)
            };
            if (_this.questions[number-1].type == 1) {
                params['answer'] = FormValidate.getCheckedFieldValue('answer', form) == "0" ? '' : FormValidate.getCheckedFieldValue('answer', form)
            }
            new GraphQL("mutation", "saveAnswerQuestionJob", params, ['answer', 'token'], true, false, function () {
                Loader.stop();
            }, function (data) {
                $('#job-question__btn-prev').attr('data-number',number-1);
                _this.questions[number-1]['answer'] = data.answer;
                $('#job-question__btn-prev').show();
                if (number == _this.questionsCount) {
                    $('#job-question__btn-finish').show();
                    $('#job-question__btn-next').removeAttr('data-number');
                    $('#job-question__btn-next').hide();
                } else {
                    $('#job-question__btn-next').attr('data-number',number+1);
                    $('#job-question__btn-finish').hide();
                }
                var typeStr = '';
                if (_this.questions[number].type == 1) {
                    typeStr = ' (answer yes/no)';
                    $('#job-question__answer').hide();
                    $('#job-question__answer input[name="answer"]').attr('disabled',true);
                    $('#job-question__answer_radio').css('display','flex');
                    $('#job-question__answer_radio input[name="answer"]').removeAttr('disabled');
                    form.find('input[name="answer"]').removeAttr('checked');
                    if (_this.questions[number].answer) {
                        form.find('input[name="answer"][value="'+_this.questions[number].answer+'"]').prop('checked', true);
                    }
                } else {
                    $('#job-question__answer_radio').hide();
                    $('#job-question__answer_radio input[name="answer"]').attr('disabled',true);
                    $('#job-question__answer').show();
                    $('#job-question__answer input[name="answer"]').removeAttr('disabled');
                    form.find('input[name="answer"]:not([type="radio"])').val(_this.questions[number].answer || '');
                }
                $('#job-question__question').text(_this.questions[number].localized_question + typeStr);

            },form).request();
        });
        $('#job-question__btn-prev').click(function () {
            var number = parseInt($(this).attr('data-number'));
            var question_id = _this.questions[number+1].id;
            var form = $('#questionnaireModalRun');
            var params = {
                'question_id': question_id,
                'answer': FormValidate.getFieldValue('answer', form)
            };
            var is_change = form.find('input[name="answer"]:not([disabled])').val();
            if (_this.questions[number+1].type == 1) {
                params['answer'] = FormValidate.getCheckedFieldValue('answer', form) == "0" ? '' : FormValidate.getCheckedFieldValue('answer', form)
                is_change = form.find('input[name="answer"]:not([disabled]):checked').val();
            }
            if (is_change) {
                new GraphQL("mutation", "saveAnswerQuestionJob", params, ['answer', 'token'], true, false, function () {
                    Loader.stop();
                }, function (data) {
                    $('#job-question__btn-next').attr('data-number',number+1);
                    _this.questions[number+1]['answer'] = data.answer;
                    $('#job-question__btn-next').show();
                    $('#job-question__btn-finish').hide();
                    if (number == 0) {
                        $('#job-question__btn-prev').removeAttr('data-number');
                        $('#job-question__btn-prev').hide();
                    } else {
                        $('#job-question__btn-prev').attr('data-number',number-1);
                        $('#job-question__btn-prev').show();
                    }
                    var typeStr = '';
                    if (_this.questions[number].type == 1) {
                        typeStr = ' (answer yes/no)';
                        $('#job-question__answer').hide();
                        $('#job-question__answer input[name="answer"]').attr('disabled',true);
                        $('#job-question__answer_radio').css('display','flex');
                        $('#job-question__answer_radio input[name="answer"]').removeAttr('disabled');
                        form.find('input[name="answer"]').removeAttr('checked');
                        if (_this.questions[number].answer) {
                            form.find('input[name="answer"][value="'+_this.questions[number].answer+'"]').prop('checked', true);
                        }
                    } else {
                        $('#job-question__answer_radio').hide();
                        $('#job-question__answer_radio input[name="answer"]').attr('disabled',true);
                        $('#job-question__answer').show();
                        $('#job-question__answer input[name="answer"]').removeAttr('disabled');
                        form.find('input[name="answer"]:not([type="radio"])').val(_this.questions[number].answer);
                    }
                    $('#job-question__question').text(_this.questions[number].localized_question + typeStr);

                },form).request();
            } else {
                $('#job-question__btn-next').attr('data-number',number+1);
                $('#job-question__btn-next').show();
                $('#job-question__btn-finish').hide();
                if (number == 0) {
                    $('#job-question__btn-prev').removeAttr('data-number');
                    $('#job-question__btn-prev').hide();
                } else {
                    $('#job-question__btn-prev').attr('data-number',number-1);
                    $('#job-question__btn-prev').show();
                }
                var typeStr = '';
                if (_this.questions[number].type == 1) {
                    typeStr = ' (answer yes/no)';
                    $('#job-question__answer').hide();
                    $('#job-question__answer input[name="answer"]').attr('disabled',true);
                    $('#job-question__answer_radio').css('display','flex');
                    $('#job-question__answer_radio input[name="answer"]').removeAttr('disabled');
                    form.find('input[name="answer"]').removeAttr('checked');
                    if (_this.questions[number].answer) {
                        form.find('input[name="answer"][value="'+_this.questions[number].answer+'"]').prop('checked', true);
                    }
                } else {
                    $('#job-question__answer_radio').hide();
                    $('#job-question__answer_radio input[name="answer"]').attr('disabled',true);
                    $('#job-question__answer').show();
                    $('#job-question__answer input[name="answer"]').removeAttr('disabled');
                    form.find('input[name="answer"]:not([type="radio"])').val(_this.questions[number].answer);
                }
                $('#job-question__question').text(_this.questions[number].localized_question + typeStr);

            }

        });
        $('#job-question__btn-finish').click(function () {
            var number = _this.questionsCount;
            var question_id = _this.questions[number].id;
            var form = $('#questionnaireModalRun');
            var params = {
                'question_id': question_id,
                'answer': FormValidate.getFieldValue('answer', form)
            };
            if (_this.questions[number].type == 1) {
                params['answer'] = FormValidate.getCheckedFieldValue('answer', form) == "0" ? '' : FormValidate.getCheckedFieldValue('answer', form)
            }
            new GraphQL("mutation", "saveAnswerQuestionJob", params, ['token'], true, false, function () {
                Loader.stop();
            }, function (data) {
                $('#job-question__btn-finish').hide();
                $('#job-question__btn-prev').removeAttr('data-number');
                $('#job-question__btn-prev').show();
                $('#job-question__btn-next').removeAttr('data-number');
                $('#job-question__btn-next').show();
                $('#job-question__question').text('');
                form.find('input[name="answer"]').val('');

                $('#questionnaireModalRun').modal('hide');
                //$('#notifyModal').modal('show');
            },form).request();
        });
        $('#questionnaireModalRun').on('hidden.bs.modal', function () {
            $('#notifyModal').modal('show');
        });
        $('#questionnaireModalRun input').on('keyup click', function () {
            //FormValidate.fieldValidateClear($(this));
            FormValidate.fieldsValidateClear($('#questionnaireModalRun'));
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
                if (_this.jobLocationID) {
                    params['job_loc_id'] = _this.jobLocationID;
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

                    if (data.status === 1 && _this.jobID) {
                        new GraphQL("query", "questionsJob", { job_id: _this.jobID }, [
                            'items { id question question_fr localized_question type job_id }',
                            'token'
                        ], true, false, function () {
                            Loader.stop();
                        }, function (questions) {
                            if (questions.items && questions.items.length > 0){
                                var typeStr = '';
                                if (questions.items[0].type == 1) {
                                    typeStr = ' (answer yes/no)';
                                    $('#job-question__answer').hide();
                                    $('#job-question__answer input[name="answer"]').attr('disabled',true);
                                    $('#job-question__answer_radio').css('display','flex');
                                    $('#job-question__answer_radio input[name="answer"]').removeAttr('disabled');

                                } else {
                                    $('#job-question__answer_radio').hide();
                                    $('#job-question__answer_radio input[name="answer"]').attr('disabled',true);
                                    $('#job-question__answer').show();
                                    $('#job-question__answer input[name="answer"]').removeAttr('disabled');
                                }
                                $('#job-question__question').text(questions.items[0].localized_question + typeStr);
                                _this.questions = questions.items;
                                _this.questionsCount = _this.questions.length -1;
                                if (_this.questionsCount) {
                                    $('#job-question__btn-prev').hide();
                                    $('#job-question__btn-finish').hide();
                                    $('#job-question__btn-next').attr('data-number',1);
                                    $('#job-question__btn-next').show();
                                } else {
                                    $('#job-question__btn-prev').hide();
                                    $('#job-question__btn-next').hide();
                                    $('#job-question__btn-finish').show();
                                }

                                $('#questionnaireModalRun').modal('show');
                            } else {
                                $('#notifyModal').modal('show');
                            }
                        }).request();
                    } else {
                        $('#notifyModal').modal('show');
                    }

                    $('#notifyModal').find('#send-resume-message').html('<p>' + data.message + '</p>' + html);
                    //$('#notifyModal').modal('show');
                    $('.text-button-send-resume').hide();

                    //$('.send-resume').text(Langs.you_can_reapply_in);
                    //$('.send-resume').text('You can reapply in 30 days');

                    if (typeof elButton == "undefined") {
                        elButton = $('[data-send-this]');
                        elButton.removeAttr('data-send-this');
                    }
                    elButton.text(Langs.you_can_reapply_in);

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
            // elButton.attr('data-send-this',1);
            // if (window.location.pathname.length < 2) {
            //     $('.business-logo-medium').attr('src', $(elButton).closest('.jobmap_list_view').find('.candidate-picture').attr('src'));
            // }
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

            return false;
        }
    },

    clear: function () {
        this.businessID = null;
        this.locationID = null;
        this.jobID = null;
        this.btnClickSend = null;
        this.questions = [];
        this.questionsCount = 0;
    }
};

$(document).ready(function () {
    sR = new SendResume();
    sR.init();
});
