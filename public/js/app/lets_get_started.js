
function LetsGetStarted() {

    this.result = [ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 ];

}

LetsGetStarted.prototype = {
    init: function () {
        let _this = this;
        _this.getData();

        $('.btnChoiceLetsGetStartResume').click(function() {
            let number = parseInt($(this).find('input').val());
            if($(this).hasClass('option01') == true)
            {
                if ($('.blockResult p[data-number="' + number + '"]').length == 0) {
                    $(this).next('.btnChoiceLetsGetStartResume').find('.active_icon').hide();
                    $(this).find('.active_icon').show();
                    let blockHtml = '<p data-number="' + number + '"><img src="/img/sidebar/active.png" style="margin-top: -3px;" class="mr-2">' + $(this).attr('data-text') + '</p>';
                    let insert = true;
                    $('.blockResult p[data-number]').each(function( index ) {
                        if (insert && $(this).attr('data-number') > number ) {
                            $(this).before(blockHtml);
                            insert = false;
                        }
                    });
                    if (insert) {
                        $('.blockResult').append(blockHtml);
                    }
                    if ($('.blockResult').is(':hidden')) {
                        $('.blockResult').show("slide", {direction: "left"}, "slow");
                    }
                    _this.result[number-1] = 1;
                }
            } else if ($(this).hasClass('option02') == true) {
                if ($('.blockResult p[data-number="' + number + '"]').length > 0) {
                    $(this).prev('.btnChoiceLetsGetStartResume').find('.active_icon').hide();
                    $(this).find('.active_icon').show();
                    $('.blockResult').find('[data-number="' + number + '"]').remove();
                    if ($('.blockResult p').length < 2 && $('.blockResult').is(':visible')) {
                        $('.blockResult').hide("slide", {direction: "right"}, "slow");
                    }
                } else {
                    $(this).find('.active_icon').show();
                }
                _this.result[number-1] = 0;
            }
        });

        $('#btnNextReceive').click(function() { _this.saveData('/lets-get-started-business-receive'); });

        $('.btnChoiceLetsGetStartReceive').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            let number = parseInt($(this).find('input').val());

            if($(this).hasClass('active') == true)
            {
                if ($('.blockResult p[data-number="' + number + '"]').length > 0) {
                    $(this).find('.active_icon').hide();
                    $(this).removeClass('active');
                    $('.blockResult').find('[data-number="' + number + '"]').remove();
                    if ($('.blockResult p').length < 2 && $('.blockResult').is(':visible')) {
                        $('.blockResult').hide("slide", {direction: "right"}, "slow");
                    }
                    _this.result[number-1] = 0;
                }
            } else {
                if ($('.blockResult p[data-number="' + number + '"]').length == 0) {
                    $(this).find('.active_icon').show();
                    $(this).addClass('active');
                    let blockHtml = '<p data-number="' + number + '"><img src="/img/sidebar/active.png" style="margin-top: -3px;" class="mr-2">' + $(this).attr('data-text') + '</p>';
                    let insert = true;
                    $('.blockResult p[data-number]').each(function( index ) {
                        if (insert && $(this).attr('data-number') > number ) {
                            $(this).before(blockHtml);
                            insert = false;
                        }
                    });
                    if (insert) {
                        $('.blockResult').append(blockHtml);
                    }
                    if ($('.blockResult').is(':hidden')) {
                        $('.blockResult').show("slide", {direction: "left"}, "slow");
                    }
                    _this.result[number-1] = 1;
                }
            }
        });

        $('#btnLetsGo').click(function() {
            //_this.saveData('/business/profile/edit');
            // _this.saveData('/business/integration_overview');
            //_this.saveData('/business/dashboard');
            _this.saveData('/business/candidate/manage');
        });

    },
    getData: function () {
        let _this = this;
        $('.businessName').text(business.currentData.name);
        $('.business-logo').attr('src',business.currentData.picture);
        new GraphQL("query", "letsGetStarted", {
            "business_id": business.currentID,
        }, [
            'data',
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            if (data.data){
                let selectedItems = [
                    'You own a website',
                    'Your website have a job posting section',
                    'You use free emails to receive candidates such as apply.yourcompany@GMAIL.COM',
                    /*'We get candidates from Hiring Agencies/Staffing Firms',
                    'We receive in-store resumes',
                    'We posting on social networks/social media',
                    'We post jobs Job Boards like Monster, Jobboom, Indeed, etc...',
                    'We have an ATS, Candidate Database in Excel or CSV format',
                    'We receive emails via an email like hiring@email.com',
                    'We have a website/online career page',*/
                ];
                $.each(data.data.split(','), function (index, value) {
                    let secection = 'input[name="item' + (index+1) + '"]';
                    if ($(secection).length == 0) {
                        if (value==1 && index < 3) {
                            let blockHtml = '<p data-number="' + (index + 1) + '"><img src="/img/sidebar/active.png" style="margin-top: -3px;" class="mr-2">' + selectedItems[index] + '</p>';
                            $('.blockResult').append(blockHtml);
                        }
                        _this.result[index] = parseInt(value);
                    } else {
                        if (value==1) {
                            $(secection).eq(0).parent().click();
                        }
                        if (value==0) {
                            $(secection).eq(1).parent().click();
                        }
                    }
                });
                if (_this.result.indexOf(0)!==-1 || _this.result.indexOf(1)!==-1) {
                    $('.blockResult').show();
                }
            } else {

            }
        }, false).request();
    },
    saveData: function (redirect) {
        let _this = this;
        if ($('.blockResult').is(':hidden')) {
            $('.blockResult').show("slide", {direction: "left"}, "slow");
            return;
        }
        if ($('.btnChoiceLetsGetStartResume').length > 0) {
            let nnn = 0;
            $('.btnChoiceLetsGetStartResume .active_icon').each(function( index ) {
                if ($(this).is(':visible')) {
                    nnn++;
                }
            });
            if (nnn < 3) {
                return;
            }
        }
        new GraphQL("mutation", "saveLetsGetStarted", {
            "business_id": business.currentID,
            "data": _this.result.join(','),
        }, [
            'data',
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            window.location.href = redirect;
        }, false).request();
    },

};

$(document).ready(function () {

    loadPromise.then(function () {
        var letsGetStarted = new LetsGetStarted();
        letsGetStarted.init();
    }).then(function () {
        app.runPromise();
    });

});
