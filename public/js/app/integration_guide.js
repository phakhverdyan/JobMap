
function IntegrationGuide() {

    this.form = $('#integration-guide-form');
    this.currentStep = {};
    this.prevCurrentStep = {};
    this.nextStep = {};
    this.prevNextStep = {};
    this.htmlGalka = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 448.8 448.8" style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px;" xml:space="preserve">
                          <g>
                              <g id="check">
                                  <polygon points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"></polygon>
                              </g>
                          </g>
                      </svg>`;
    this.steps = [
        { 'numb': 1,  'tab': 'WebsiteButton',       'title': trans('website'),      'type': 'uncompleted', 'time': trans('less_than_1_minute'), 'visible': 0 },
        { 'numb': 2,  'tab': 'ATSImport',           'title': trans('import'),       'type': 'uncompleted', 'time': trans('less_than_1_minute'), 'visible': 0 },
        { 'numb': 3,  'tab': 'CREmail',             'title': trans('cr_email'),     'type': 'uncompleted', 'time': trans('less_than_1_minute'), 'visible': 0 },
        { 'numb': 4,  'tab': 'EmailForwarder',      'title': trans('email_fr'),     'type': 'uncompleted', 'time': trans('less_than_1_minute'), 'visible': 0 },
        { 'numb': 5,  'tab': 'resume_scaner',       'title': trans('scan'),         'type': 'uncompleted', 'time': trans('less_than_1_minute'), 'visible': 0 },
        { 'numb': 6,  'tab': 'linkto_careerpage',   'title': trans('career'),       'type': 'uncompleted', 'time': trans('less_than_1_minute'), 'visible': 0 },
        { 'numb': 7,  'tab': 'job_words',           'title': trans('boards'),       'type': 'uncompleted', 'time': trans('less_than_1_minute'), 'visible': 0 },
        { 'numb': 8,  'tab': 'social_media',        'title': trans('social'),       'type': 'uncompleted', 'time': trans('less_than_1_minute'), 'visible': 0 },
        { 'numb': 9,  'tab': 'job_posting',         'title': trans('posting'),      'type': 'uncompleted', 'time': trans('less_than_1_minute'), 'visible': 1 },
    ];
    this.percent = 11.11;
    this.complitedCount = 9;

    this.percents = 0;
    this.complited = 0;
}

IntegrationGuide.prototype = {
    init: function () {
        if (this.form.length > 0) {
            if ($('.resume-tab.hide').length > 0) {
                $('#tabs-show-all').removeClass('hide');
            }
            this.setData();
            this.initEvents();
        }
    },
    setData: function () {
        let _this = this;
        let data,
            countSteps =0;
        if (business.currentData.lets_get_started) {
            data = business.currentData.lets_get_started.split(',');
            if (data[0] == 1 || data[9] == 1) {
                countSteps++;
                _this.steps[0].visible = 1;
            }
            if (data[3] == 1 || data[7] == 1) {
                countSteps++;
                _this.steps[1].visible = 1;
            }
            if (data[2] == 1) {
                countSteps++;
                _this.steps[2].visible = 1;
            }
            if (data[8] == 1) {
                countSteps++;
                _this.steps[3].visible = 1;
            }
            if (data[4] == 1) {
                countSteps++;
                _this.steps[4].visible = 1;
            }
            if (data[1] == 1) {
                countSteps++;
                _this.steps[5].visible = 1;
            }
            if (data[6] == 1) {
                countSteps++;
                _this.steps[6].visible = 1;
            }
            if (data[5] == 1) {
                countSteps++;
                _this.steps[7].visible = 1;
            }
            _this.complitedCount = countSteps +1;
            _this.percent = 100 / _this.complitedCount;
        }
        if (business.currentData.integration_guide_steps) {
            data = business.currentData.integration_guide_steps.split(',');
            jQuery.each(data, function (index, value) {
                if (value == 1) {
                    _this.steps[index].type = 'completed';
                    _this.percents += _this.percent;
                    _this.complited += 1;
                }
            });
        }
        _this.showAllSteps();

        let number = 0;
        //_this.currentStep = _this.steps[number];
        _this.currentStep.number = number;
        _this.currentStep.tab = _this.steps[number].tab;
        _this.currentStep.title = _this.steps[number].title;
        _this.currentStep.type = _this.steps[number].type;
        _this.currentStep.numb = _this.steps[number].numb;
        _this.currentStep.time = _this.steps[number].time;
        number = _this.getNumberNextStep(number);
        if (number == -1) {
            if (_this.currentStep.type == 'uncompleted') {
                //_this.nextStep = this.currentStep;
                _this.nextStep.number = _this.currentStep.number;
                _this.nextStep.tab = _this.steps[_this.currentStep.number].tab;
                _this.nextStep.title = _this.steps[_this.currentStep.number].title;
                _this.nextStep.type = _this.steps[_this.currentStep.number].type;
                _this.nextStep.numb = _this.steps[_this.currentStep.number].numb;
                _this.nextStep.time = _this.steps[_this.currentStep.number].time;
            } else {
                _this.nextStep = {};
            }
        } else {
            //_this.nextStep = _this.steps[number];
            _this.nextStep.number = number;
            _this.nextStep.tab = _this.steps[number].tab;
            _this.nextStep.title = _this.steps[number].title;
            _this.nextStep.type = _this.steps[number].type;
            _this.nextStep.numb = _this.steps[number].numb;
            _this.nextStep.time = _this.steps[number].time;
        }
        _this.showActivesSteps();
    },
    showAllSteps: function () {
        let _this = this;
        jQuery.each(_this.steps, function (index, value) {
            if (value.type == 'uncompleted') {
                $('.resume-tab[data-tab="'+value.tab+'"] .rb_steps').addClass('notactive');
            } else {
                $('.resume-tab[data-tab="'+value.tab+'"] .rb_steps').addClass('done_check').html(_this.htmlGalka);
            }
        });
    },
    showActivesSteps: function () {
        let _this = this;
        if (typeof _this.prevCurrentStep.number !== "undefined") {
            $('.resume-tab[data-tab="'+_this.prevCurrentStep.tab+'"] .rb_steps').removeClass('done');
            if (_this.prevCurrentStep.type == 'uncompleted') {
                $('.resume-tab[data-tab="'+_this.prevCurrentStep.tab+'"] .rb_steps').addClass('notactive');
            } else {
                $('.resume-tab[data-tab="'+_this.prevCurrentStep.tab+'"] .rb_steps').addClass('done_check').html(_this.htmlGalka);
            }
        }
        if (typeof _this.prevNextStep.number !== "undefined") {
            $('.resume-tab[data-tab="'+_this.prevNextStep.tab+'"] .rb_steps').removeClass('notdone');
            if (_this.prevNextStep.type == 'uncompleted') {
                $('.resume-tab[data-tab="'+_this.prevNextStep.tab+'"] .rb_steps').addClass('notactive');
            } else {
                $('.resume-tab[data-tab="'+_this.prevNextStep.tab+'"] .rb_steps').addClass('done_check').html(_this.htmlGalka);
            }
        }
        $('.resume-tab[data-tab="'+_this.currentStep.tab+'"] .rb_steps').removeClass('notdone').removeClass('done_check').removeClass('notactive').addClass('done').text(_this.currentStep.numb);
        if (typeof _this.nextStep.number !== "undefined" && _this.nextStep.number != _this.currentStep.number) {
            $('.resume-tab[data-tab="'+_this.nextStep.tab+'"] .rb_steps').removeClass('notactive').addClass('notdone');
        }
        _this.showTitleStep();
        _this.showProgress();
    },
    initEvents: function () {
        let _this = this;

        $('.resume-tab').click(function () {
            _this.currentStep.tab = $(this).attr('data-tab');
            _this.setActivesSteps();
            _this.showActivesSteps();
        });

        $('#step-done').click(function () {

            if (_this.currentStep.type == 'uncompleted') {
                _this.steps[_this.currentStep.number].type = 'completed';
                new GraphQL("mutation", "doneStepIntegrationGuide", {
                    'business_id' : business.currentData.id,
                    'number' : _this.currentStep.number,
                }, [
                    'data',
                    'token'
                ], true, false, function () {
                    Loader.stop();
                }, function (data) {
                }, false).request();
                _this.percents += _this.percent;
                _this.complited += 1;
                if (_this.currentStep.numb != 9) {
                    let countClass = '.countIntegration-' + _this.currentStep.tab;
                    //$(countClass).fadeOut();
                    $(countClass).html(_this.htmlGalka);
                    $(countClass).removeClass('red').removeClass('grey').addClass('green_a');
                    if (_this.currentStep.numb < 5){
                        let countNo = parseInt($('.countIntegration').eq(0).text()) -1;
                        if (countNo == 0) {
                            $('.countIntegration').text('');
                            $('.countIntegration').fadeOut();
                        } else {
                            $('.countIntegration').text(countNo);
                            $('.countIntegration').addClass('bounceIn');
                            setTimeout(function() {
                                $('.countIntegration').removeClass('bounceIn');
                            },500);
                        }
                    }
                }
                //_this.showProgress();
            }
            $('.resume-tab[data-tab="'+_this.nextStep.tab+'"] button').click();
        });

        $('#step-skip').click(function () {
            $('.resume-tab[data-tab="'+_this.nextStep.tab+'"] button').click();
        });

        $('#tabs-show-all').click(function () {
            $('.resume-tab.hide').removeClass('hide').addClass('no-show-tabs');
            business.currentData.lets_get_started = "1,1,1,1,1,1,1,1,1,1";
            new GraphQL("mutation", "saveLetsGetStarted", {
                "business_id": business.currentID,
                "data": business.currentData.lets_get_started,
            }, [
                'data',
                'token'
            ], true, false, function () {
                Loader.stop();
            }, function (data) {
            }, false).request();

            jQuery.each(_this.steps, function(i, val) {
                if (val.visible != 1) {
                    _this.steps[i].visible = 1;
                    let countClass = '.countIntegration-' + _this.steps[i].tab;
                    $(countClass).removeClass('green_a').removeClass('grey').addClass('red');
                }
            });
            _this.complitedCount = 9;
            _this.percent = 100 / _this.complitedCount;
            _this.percents = _this.complited * _this.percent;

            let number = _this.getNumberNextStep(_this.currentStep.number);
            if (typeof _this.nextStep.number !== "undefined") {
                if (_this.nextStep.number != number) {
                    let numb = _this.nextStep.number;
                    //_this.prevNextStep = _this.steps[number];
                    _this.prevNextStep.number = numb;
                    _this.prevNextStep.tab = _this.steps[numb].tab;
                    _this.prevNextStep.type =  _this.steps[numb].type;
                    _this.prevNextStep.numb =  _this.steps[numb].numb;
                }
            }
            //_this.nextStep = _this.steps[number];
            _this.nextStep.number = number;
            _this.nextStep.tab = _this.steps[number].tab;
            _this.nextStep.title = _this.steps[number].title;
            _this.nextStep.type = _this.steps[number].type;
            _this.nextStep.numb = _this.steps[number].numb;
            _this.nextStep.time = _this.steps[number].time;
            _this.showActivesSteps();

            $(this).addClass('hide');
        });
    },
    showProgress: function () {
        let _this = this;
        $('#progress-diagram').text(_this.complited + '/' + _this.complitedCount);
        $('#progress-bar').css('width',_this.percents + '%');
        $('#progress-percent').text(Math.round(_this.percents) + '%');
    },
    showTitleStep: function () {
        let _this = this;
        $('#current-step-title').text(_this.currentStep.title);
        $('#current-step-time').text(_this.currentStep.time);
        if (typeof _this.nextStep.number !== "undefined") {
            if (_this.nextStep.number == _this.currentStep.number) {
                $('#next-step-title').text(Langs.you_have_only_this_step_left);
                $('#next-step-title').parent().find('strong').text('');
                $('#next-step-title').parent().find('span').text('');
            } else {
                $('#next-step-title').text(_this.nextStep.title);
                $('#next-step-title').parent().find('strong').text(Langs.next_step);
                $('#next-step-title').parent().find('span').text(Langs.fill_in_your);
            }
        } else {
            $('#next-step-title').text(Langs.fill_in_your);
            $('#next-step-title').parent().find('strong').text('');
            $('#next-step-title').parent().find('span').text('');
        }
    },
    setActivesSteps: function () {
        let _this = this,
            number;
        number = _this.currentStep.number;
        //_this.prevCurrentStep = _this.steps[number];
        _this.prevCurrentStep.number = number;
        _this.prevCurrentStep.tab = _this.steps[number].tab;
        _this.prevCurrentStep.type =  _this.steps[number].type;
        _this.prevCurrentStep.numb =  _this.steps[number].numb;
        if (typeof _this.nextStep.number !== "undefined") {
            number = _this.nextStep.number;
            //_this.prevNextStep = _this.steps[number];
            _this.prevNextStep.number = number;
            _this.prevNextStep.tab = _this.steps[number].tab;
             _this.prevNextStep.type =  _this.steps[number].type;
             _this.prevNextStep.numb =  _this.steps[number].numb;
        } else {
            _this.prevNextStep = {};
        }

        number = _this.getNumberCurrentStep();
        //_this.currentStep = _this.steps[number];
        _this.currentStep.number = number;
        _this.currentStep.title = _this.steps[number].title;
        _this.currentStep.type = _this.steps[number].type;
        _this.currentStep.numb = _this.steps[number].numb;
        _this.currentStep.time = _this.steps[number].time;
        number = _this.getNumberNextStep(number);
        if (number == -1) {
            if (_this.currentStep.type == 'uncompleted') {
                //_this.nextStep = this.steps[_this.currentStep.number];
                _this.nextStep.number = __this.currentStep.number;
                _this.nextStep.tab = _this.steps[_this.currentStep.number].tab;
                _this.nextStep.title = _this.steps[_this.currentStep.number].title;
                _this.nextStep.type = _this.steps[_this.currentStep.number].type;
                _this.nextStep.numb = _this.steps[_this.currentStep.number].numb;
                _this.nextStep.time = _this.steps[_this.currentStep.number].time;
            } else {
                _this.nextStep = {};
            }
        } else {
            //_this.nextStep = _this.steps[number];
            _this.nextStep.number = number;
            _this.nextStep.tab = _this.steps[number].tab;
            _this.nextStep.title = _this.steps[number].title;
            _this.nextStep.type = _this.steps[number].type;
            _this.nextStep.numb = _this.steps[number].numb;
            _this.nextStep.time = _this.steps[number].time;
        }
    },
    getNumberCurrentStep: function () {
        let _this = this,
            number = 0;
        jQuery.each(_this.steps, function (index, value) {
            if (value.tab == _this.currentStep.tab) {
                number = index;
            }
        });
        return number;
    },
    getNumberNextStep: function (numb) {
        let _this = this,
            number = -1,
            i = 0,
            iBegin = numb+1,
            iEnd = _this.steps.length;
        for (i=iBegin; i<iEnd; i++) {
            if (_this.steps[i].visible && _this.steps[i].type == 'uncompleted') {
                return i;
            }
        }
        for (i=0; i<iBegin; i++) {
            if (_this.steps[i].visible && _this.steps[i].type == 'uncompleted') {
                return i;
            }
        }
        return -1;
    },

};

$(document).ready(function () {

    loadPromise.then(function () {
        var integrationGuide = new IntegrationGuide();
        integrationGuide.init();
    }).then(function () {
        app.runPromise();
    });

    
});
