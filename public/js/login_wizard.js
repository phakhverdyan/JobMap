$(document).ready(function() {
    // $('.sign-up-step-1').show();
    // $('.sign-up-step-2').hide();
    $('.sign-up-step-3').hide();
    $('.sign-up-step-4').hide();
    // $('.sign-up-user-wizard .next-btn').click(function(e) {
    //     e.preventDefault();
    //     $('.sign-up-step-1').fadeOut();
    //     $('.sign-up-step-2').fadeIn();
    // })
    $('.sign-up-business-wizard .next-btn').click(function(e) {
        var elem = {};
        e.preventDefault();
        elem = $(this).parent().parent().parent().parent().parent().parent().parent().parent();
        if(elem.hasClass('sign-up-business-wizard')) {
            elem = elem.find('.sign-up-step-3');
        }
        elem.fadeOut();
        elem.next().fadeIn();
    });
    $('.sign-up-business-wizard .prev-btn').click(function(e) {
        var elem = {};
        e.preventDefault();
        elem = $(this).parent().parent().parent().parent().parent().parent().parent().parent();
        if(elem.hasClass('sign-up-business-wizard')) {
            elem = elem.find('.sign-up-step-3');
        }
        elem.fadeOut();
        elem.prev().fadeIn();
    });
});

$(document).ready(function() {
    $('.referer-step-1').show();
    $('.referer-step-2').hide();
    $('.referer-step-3').hide();
    $('.referer-step-wizard .next-btn').click(function(e) {
        e.preventDefault();
        $('.referer-step-1').fadeOut();
        $('.referer-step-2').fadeIn();
    })
    $('.referer-step-wizard .next-btn').click(function(e) {
        var elem = {};
        e.preventDefault();
        elem = $(this).parent().parent().parent().parent().parent().parent();
        if(elem.hasClass('referer-step-wizard')) {
            elem = elem.find('.referer-step-3');
        }
        elem.fadeOut();
        elem.next().fadeIn();
    });
    $('.referer-step-wizard .prev-btn').click(function(e) {
        var elem = {};
        e.preventDefault();
        elem = $(this).parent().parent().parent().parent().parent().parent();
        elem = $(this).parent().parent().parent().parent().parent().parent();
        if(elem.hasClass('referer-step-wizard')) {
            elem = elem.find('.referer-step-3');
        }
        elem.fadeOut();
        elem.prev().fadeIn();
    });
})

