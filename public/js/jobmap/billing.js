jQuery(document).ready(function($){var animationDelay=2500,barAnimationDelay=3800,barWaiting=barAnimationDelay-3000,lettersDelay=50,typeLettersDelay=150,selectionDuration=500,typeAnimationDelay=selectionDuration+800,revealDuration=600,revealAnimationDelay=1500;initHeadline();function initHeadline(){singleLetters($('.cd-headline.letters').find('b'));animateHeadline($('.cd-headline'));}
    function singleLetters($words){$words.each(function(){var word=$(this),letters=word.text().split(''),selected=word.hasClass('is-visible');for(i in letters){if(word.parents('.rotate-2').length>0)letters[i]='<em>'+letters[i]+'</em>';letters[i]=(selected)?'<i class="in">'+letters[i]+'</i>':'<i>'+letters[i]+'</i>';}
        var newLetters=letters.join('');word.html(newLetters);});}
    function animateHeadline($headlines){var duration=animationDelay;$headlines.each(function(){var headline=$(this);if(headline.hasClass('loading-bar')){duration=barAnimationDelay;setTimeout(function(){headline.find('.cd-words-wrapper').addClass('is-loading')},barWaiting);}else if(headline.hasClass('clip')){var spanWrapper=headline.find('.cd-words-wrapper'),newWidth=spanWrapper.width()+10
        spanWrapper.css('width',newWidth);}else if(!headline.hasClass('type')){var words=headline.find('.cd-words-wrapper b'),width=0;words.each(function(){var wordWidth=$(this).width();if(wordWidth>width)width=wordWidth;});headline.find('.cd-words-wrapper').css('width',width);};setTimeout(function(){hideWord(headline.find('.is-visible').eq(0))},duration);});}
    function hideWord($word){var nextWord=takeNext($word);if($word.parents('.cd-headline').hasClass('type')){var parentSpan=$word.parent('.cd-words-wrapper');parentSpan.addClass('selected').removeClass('waiting');setTimeout(function(){parentSpan.removeClass('selected');$word.removeClass('is-visible').addClass('is-hidden').children('i').removeClass('in').addClass('out');},selectionDuration);setTimeout(function(){showWord(nextWord,typeLettersDelay)},typeAnimationDelay);}else if($word.parents('.cd-headline').hasClass('letters')){var bool=($word.children('i').length>=nextWord.children('i').length)?true:false;hideLetter($word.find('i').eq(0),$word,bool,lettersDelay);showLetter(nextWord.find('i').eq(0),nextWord,bool,lettersDelay);}else if($word.parents('.cd-headline').hasClass('clip')){$word.parents('.cd-words-wrapper').animate({width:'2px'},revealDuration,function(){switchWord($word,nextWord);showWord(nextWord);});}else if($word.parents('.cd-headline').hasClass('loading-bar')){$word.parents('.cd-words-wrapper').removeClass('is-loading');switchWord($word,nextWord);setTimeout(function(){hideWord(nextWord)},barAnimationDelay);setTimeout(function(){$word.parents('.cd-words-wrapper').addClass('is-loading')},barWaiting);}else{switchWord($word,nextWord);setTimeout(function(){hideWord(nextWord)},animationDelay);}}
    function showWord($word,$duration){if($word.parents('.cd-headline').hasClass('type')){showLetter($word.find('i').eq(0),$word,false,$duration);$word.addClass('is-visible').removeClass('is-hidden');}else if($word.parents('.cd-headline').hasClass('clip')){$word.parents('.cd-words-wrapper').animate({'width':$word.width()+10},revealDuration,function(){setTimeout(function(){hideWord($word)},revealAnimationDelay);});}}
    function hideLetter($letter,$word,$bool,$duration){$letter.removeClass('in').addClass('out');if(!$letter.is(':last-child')){setTimeout(function(){hideLetter($letter.next(),$word,$bool,$duration);},$duration);}else if($bool){setTimeout(function(){hideWord(takeNext($word))},animationDelay);}
        if($letter.is(':last-child')&&$('html').hasClass('no-csstransitions')){var nextWord=takeNext($word);switchWord($word,nextWord);}}
    function showLetter($letter,$word,$bool,$duration){$letter.addClass('in').removeClass('out');if(!$letter.is(':last-child')){setTimeout(function(){showLetter($letter.next(),$word,$bool,$duration);},$duration);}else{if($word.parents('.cd-headline').hasClass('type')){setTimeout(function(){$word.parents('.cd-words-wrapper').addClass('waiting');},200);}
        if(!$bool){setTimeout(function(){hideWord($word)},animationDelay)}}}
    function takeNext($word){return(!$word.is(':last-child'))?$word.next():$word.parent().children().eq(0);}
    function takePrev($word){return(!$word.is(':first-child'))?$word.prev():$word.parent().children().last();}
    function switchWord($oldWord,$newWord){$oldWord.removeClass('is-visible').addClass('is-hidden');$newWord.removeClass('is-hidden').addClass('is-visible');}
    var intro=$('.cd-intro');$('.cd-filter input').on('change',function(event){var selected=$(event.target).attr('id')
        switch(selected){case 'rotate-1':intro.load('content.html .rotate-1',function(){initHeadline();});break;case 'type':intro.load('content.html .type',function(){initHeadline();});break;case 'rotate-2':intro.load('content.html .rotate-2',function(){initHeadline();});break;case 'loading-bar':intro.load('content.html .loading-bar',function(){initHeadline();});break;case 'slide':intro.load('content.html .slide',function(){initHeadline();});break;case 'clip':intro.load('content.html .clip',function(){initHeadline();});break;case 'zoom':intro.load('content.html .zoom',function(){initHeadline();});break;case 'rotate-3':intro.load('content.html .rotate-3',function(){initHeadline();});break;case 'scale':intro.load('content.html .scale',function(){initHeadline();});break;case 'push':intro.load('content.html .push',function(){initHeadline();});break;}});});




// CHANGE Versus POSITION
$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    var objectSelect = $(".steps_section");
    var positionTop = objectSelect.position();
    var objectTitle = $(".never_lose_title");
    var positionTitle = objectTitle.position();
    if (positionTop) {
        if (scroll > (positionTop.top + 88)) {
            $(".steps_top").addClass("steps_fixed_top");
            $(".need_to_margin").addClass("margin_fixed_section");
            if (scroll > (positionTitle.top)) {
                $(".steps_top").fadeOut(300);

                $(".need_to_margin").addClass("margin_fixed_section");
            }
            else{
                $(".steps_top").fadeIn(300);

                // $(".need_to_margin").removeClass("margin_fixed_section");

            }
        } else {
            $(".steps_top").removeClass("steps_fixed_top");
            $(".need_to_margin").removeClass("margin_fixed_section");

        }
    }

});

// SHOW JOBMAP LOGO
$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    var objectSelect = $(".jobmap_infograf");
    var positionTop = objectSelect.position();
    var objectTitle = $(".last_jobmap_step");
    var positionTitle = objectTitle.position();

    if (positionTop && positionTitle) {
        if (scroll > (positionTop.top) && scroll < (positionTitle.top)) {
            $(".fixed_jobmap").fadeIn(300);
            // $(".steps_top").addClass("steps_fixed_top");
            // $(".need_to_margin").addClass("margin_fixed_section");
        } else {
            // $(".steps_top").removeClass("steps_fixed_top");
            // $(".need_to_margin").removeClass("margin_fixed_section");
            $(".fixed_jobmap").fadeOut(300);
        }
    }

});

// SHOW PRICING HEADER
// $(window).scroll(function() {
//     var scroll = $(window).scrollTop();
//     var objectSelect = $(".pricing_section");
//     var positionTop = objectSelect.position();
//     var objectTitle = $(".discover_section");
//     var positionTitle = objectTitle.position();

//     if (scroll > (positionTop.top - 68)) {
//         $(".pricing_fixedHeader").addClass("pricing_fixed_top");
//         $(".pricing_margin").addClass("margin_fixed_pricing");
//         if (scroll > (positionTitle.top - 700)) {
//             $(".pricing_fixedHeader").fadeOut(300);

//             // $(".need_to_margin").removeClass("margin_fixed_pricing");
//         }
//         else{
//             $(".pricing_fixedHeader").fadeIn(300);

//             // $(".need_to_margin").addClass("margin_fixed_pricing");

//         }
//     } else {
//         $(".pricing_fixedHeader").removeClass("pricing_fixed_top");
//         $(".pricing_margin").removeClass("margin_fixed_pricing");

//     }
// });


$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    var objectSelect = $(".discover_section");

    if (objectSelect.offset()) {
        if (scroll > (objectSelect.offset().top - 450)) {
            $(".landing_sidebar").addClass("sidebar_absolute");
            $(".landing_sidebar").css('top', objectSelect.offset().top - 370);
        }
        else {
            $(".landing_sidebar").removeClass("sidebar_absolute");
            $(".landing_sidebar").css('top', '150px');
        }
    }

});



if ($(window).width() < 992) {
    $(".pricing_fixedHeader").addClass("pricing_on_mobile");
    $(".pricing_margin").addClass("mobile_margin_pricing");
}
else {
    $(".pricing_fixedHeader").removeClass("pricing_on_mobile");
    $(".pricing_margin").removeClass("mobile_margin_pricing");
}


//ANCHOR SYSTEM

$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    var objectAnchor = $(".anchor");
    var positionAnchor = objectAnchor.position();

    var objectEasysteps = $(".3_easy_steps");
    var positionEasysteps = objectEasysteps.position();

    // if (scroll > (positionAnchor.top - 150)) {
    //     $(".anchor").addClass('anchor_fixed');
    // } else {
    //     $(".anchor").removeClass('anchor_fixed');
    // }

    if (positionEasysteps) {
        if (scroll > (positionEasysteps.top + 350)) {
            $(".anchor").addClass('anchor_fixed');
        } else {
            $(".anchor").removeClass('anchor_fixed');
        }
    }

});


$(window).scroll(function() {

    if ($('div[data-anchor="main-wrapper"]').offset()) {
        if ($(this).scrollTop() < $('div[data-anchor="main-wrapper"]').offset().top) {
            $('.anchor_div a').removeClass('active');
        }
        if ($(this).scrollTop() >= $('div[data-anchor="main-wrapper"]').offset().top) {
            $('.anchor_div a').removeClass('active');
            $('.anchor_div a:eq(0)').addClass('active');
        }
    }

    if ($('div[data-anchor="jobmap_section"]').offset()) {
        if ($(this).scrollTop() >= $('div[data-anchor="jobmap_section"]').offset().top - 150) {
            $('.anchor_div a').removeClass('active');
            $('.anchor_div a:eq(1)').addClass('active');
        }
    }

    if ($('div[data-anchor="pricing_section"]').offset()) {
        if ($(this).scrollTop() >= $('div[data-anchor="pricing_section"]').offset().top - 200) {
            $('.anchor_div a').removeClass('active');
            $('.anchor_div a:eq(2)').addClass('active');
        }
    }

});

// SLOW ANCHOR
$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();
    var element_id = $(this).attr('href').slice(1);

    if (!element_id) {
        return;
    }

    $('html, body').animate({
        scrollTop: $('#' + element_id).offset().top - 150,
    }, 500);
});


//PRICING CLICK SYSTEM
$(".price_toggle .nowrap_mobile").click(function(){
    $('.price_toggle .nowrap_mobile.active').not(this).removeClass('active').find('.selected').toggle();
    $(this).toggleClass('active').find('.selected').toggle();
})


// ICONS ANIMATION
$("#slideshow > div:gt(0)").hide();
$("#slideshow2 > div:gt(0)").hide();
$("#slideshow3 > div:gt(0)").hide();
$("#slideshow4 > div:gt(0)").hide();

setInterval(function() {
    $('#slideshow > div:first')
        .fadeOut(1000)
        .next()
        .fadeIn(1000)
        .end()
        .appendTo('#slideshow');
},  2500);
setInterval(function() {
    $('#slideshow2 > div:first')
        .fadeOut(1000)
        .next()
        .fadeIn(1000)
        .end()
        .appendTo('#slideshow2');
},  3500);
setInterval(function() {
    $('#slideshow3 > div:first')
        .fadeOut(1000)
        .next()
        .fadeIn(1000)
        .end()
        .appendTo('#slideshow3');
},  2200);
setInterval(function() {
    $('#slideshow4 > div:first')
        .fadeOut(1000)
        .next()
        .fadeIn(1000)
        .end()
        .appendTo('#slideshow4');
},  3000);

$(document).ready(function () {

    //- start script for page pricing
    var startCandidatesCountPlanStarter = 10,
        startCandidatesCountPlanTeam = startCandidatesCountPlanStarter,
        addCandidatesCountPlanStarter = 100,
        addCandidatesCountPlanTeam = addCandidatesCountPlanStarter *10,
        monthlyPricePlanStarter = 25,
        monthlyPricePlanTeam = monthlyPricePlanStarter *10,
        addCandidatesCount = 100,
        minCandidatesCount = startCandidatesCountPlanStarter,
        monthlyPrice = monthlyPricePlanStarter,
        kCP = addCandidatesCount / monthlyPrice,
        candidatesCount = startCandidatesCountPlanStarter;
    new GraphQL("query", "getPricingStrategy", {}, [
        'monthly_price',
        'candidates',
        'free_version_candidates'
    ], false, false, function () {
        Loader.stop();
    }, function (data) {
        if (data) {
            startCandidatesCountPlanStarter = data.free_version_candidates;
            startCandidatesCountPlanTeam = startCandidatesCountPlanStarter;
            addCandidatesCountPlanStarter = data.candidates;
            addCandidatesCountPlanTeam = addCandidatesCountPlanStarter *10;
            monthlyPricePlanStarter = data.monthly_price;
            monthlyPricePlanTeam = monthlyPricePlanStarter *10;

            setSowPlan('starter');
        }
    }, false).request();

    var setSowPlan = function (plan) {
        var priceCount = 0;
        switch (plan) {
            case 'starter':
                candidatesCount = startCandidatesCountPlanStarter;
                addCandidatesCount = addCandidatesCountPlanStarter;
                minCandidatesCount = startCandidatesCountPlanStarter;
                monthlyPrice = monthlyPricePlanStarter;
                break;
            case 'team':
                candidatesCount = startCandidatesCountPlanTeam;
                addCandidatesCount = addCandidatesCountPlanTeam;
                minCandidatesCount = startCandidatesCountPlanTeam;
                monthlyPrice = monthlyPricePlanTeam;
                break;
        }
        kCP = addCandidatesCount / monthlyPrice;

        $('.plan-candidates').text(candidatesCount);
        $('.plan-min-candidates').text(addCandidatesCount);
        $('.plan-min-price-month').text(monthlyPrice);
        priceCount = (candidatesCount - minCandidatesCount) / kCP;
        $('.plan-price-month').text('$'+priceCount.toFixed());
        priceCount = priceCount * 12 - (priceCount * 12 / 10);
        $('.plan-price-year').text('$'+priceCount.toFixed());

        return true;
    };
    $('.plan-starter').click(function() {
        setSowPlan('starter');
    });
    $('.plan-team').click(function() {
        setSowPlan('team');
    });

    $('.plan-minus').click(function () {
        let priceCount = 0;
        if (candidatesCount > minCandidatesCount) {
            candidatesCount -= addCandidatesCount;
            priceCount = candidatesCount / kCP;
            if (candidatesCount == 0) {
                candidatesCount =minCandidatesCount;
            }
            $('.plan-candidates').text(candidatesCount);
            $('.plan-price-month').text('$'+priceCount.toFixed());
            priceCount = priceCount * 12 - (priceCount * 12 / 10);
            $('.plan-price-year').text('$'+priceCount.toFixed());
        }
    });

    $('.plan-plus').click(function () {
        let priceCount = 0;
        if (candidatesCount == minCandidatesCount) {
            candidatesCount -=minCandidatesCount;
        }
        candidatesCount += addCandidatesCount;
        priceCount = candidatesCount / kCP;
        $('.plan-candidates').text(candidatesCount);
        $('.plan-price-month').text('$'+priceCount.toFixed());
        priceCount = priceCount * 12 - (priceCount * 12 / 10);
        $('.plan-price-year').text('$'+priceCount.toFixed());
    });

    var savePlan = function (type) {
        var data = {
            "count": candidatesCount
        };
        switch (type) {
            case 'month':
                data['price_month'] = $('.plan-price-month').text();
                break;
            case 'year':
                data['price_year'] = $('.plan-price-year').text();
                break;
        }
        APIStorage.create('plan-price',JSON.stringify(data));
        return true;
    };
    $('.save-plan-month').click(function () {
        savePlan('month');
    });
    $('.save-plan-year').click(function () {
        savePlan('year');
    });
    //-end script for page pricing

    $('[data-target="#requestCallbackModal"]').click(function () {
        var form = $('#requestCallbackModal');
        form.find('input').val('');
        form.find('textarea').val('');
        FormValidate.fieldsValidateClear(form);
    });
    $('#sendRequestCallback').click(function () {
        var form = $('#requestCallbackModal'),
            modalPopup = $('#sendCallbackModal');

        var params = {
            email: FormValidate.getFieldValue("email", form),
            contact_name: FormValidate.getFieldValue("contact_name", form),
            employer_name: FormValidate.getFieldValue("employer_name", form),
            employer_number: FormValidate.getFieldValue("employer_number", form),
            location_number: FormValidate.getFieldValue("location_number", form),
            phone: FormValidate.getFieldValue("phone", form),
            extension: FormValidate.getFieldValue("extension", form),
            message: FormValidate.getFieldValue("message", form),
            time: FormValidate.getFieldValue("time", form),
            country: FormValidate.getFieldValue("country", form),
        };

        if (form.find('input[name="business_name"]').length > 0) {
            params['business_name'] = FormValidate.getFieldValue("business_name", form);
            params['website'] = FormValidate.getFieldValue("website", form);
        }
        new GraphQL("mutation", "sendRequestCallback", params, [
            'response',
            'message'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            $('#responseMessage').text(data.message);
            modalPopup.modal('show');
            if (data.response == 'success') {
                form.find('input').val('');
                form.find('textarea').val('');
                form.modal('hide');
            }
        }, form).request();
    });
    $('#requestCallbackModal').on('click, keydown, focus', 'input, textarea', function () {
        FormValidate.fieldValidateClear($(this));
    });

    //-old script for page pricing
    /*var currentCandidatesCount = 100,
     startCandidatesCount = 10,
     endCandidatesCount = 50000,
     addCandidatesCount = 100,
     kCP = 4,
     candidatesCountPlanStarter = 10,
     candidatesCountPlanTeam = 100;
     candidatesCountPlanCustom = 2000;
     new GraphQL("query", "getPricingStrategy", {}, [
     'monthly_price',
     'candidates',
     'free_version_candidates'
     ], false, false, function () {
     Loader.stop();
     }, function (data) {
     if (data) {
     var candidatesCount = data.candidates,
     monthlyPrice = data.monthly_price,
     priceCount =0;
     addCandidatesCount = data.candidates;
     candidatesCountPlanStarter = data.free_version_candidates;
     kCP = candidatesCount / monthlyPrice;
     $('.plan-candidates').text(currentCandidatesCount);
     $('.plan-min-candidates').text(candidatesCount);
     $('.plan-min-price-month').text(monthlyPrice);
     priceCount = addCandidatesCount / kCP;
     $('.plan-price-month').text('$'+priceCount.toFixed());
     priceCount = priceCount * 12 - (priceCount * 12 / 10);
     $('.plan-price-year').text('$'+priceCount.toFixed());

     }
     }, false).request();

     var checkPlan = function (count) {
     $('.justify-content-between > div').removeClass('active');
     $('.justify-content-between > div').find('.selected').css('display', 'none');
     var elem;
     if (count == startCandidatesCount) {
     elem = $('.plan-starter');
     }
     if (count > startCandidatesCount && count <= endCandidatesCount) {
     elem = $('.plan-team');
     }
     if (count >= candidatesCountPlanCustom) {
     elem = $('.plan-custom');
     }
     elem.addClass('active');
     elem.find('.selected').css('display', 'block');
     };

     $('.plan-minus').click(function () {
     var candidatesCount = parseInt($('.plan-candidates').eq(0).text()),
     priceCount = 0;
     if (candidatesCount > (startCandidatesCount + candidatesCountPlanStarter)) {
     if (candidatesCount == candidatesCountPlanTeam) {
     candidatesCount = candidatesCountPlanStarter;
     priceCount = 0;
     } else {
     candidatesCount -= addCandidatesCount;
     priceCount = candidatesCount / kCP;
     }
     $('.plan-candidates').text(candidatesCount);
     $('.plan-price-month').text('$'+priceCount.toFixed());
     priceCount = priceCount * 12 - (priceCount * 12 / 10);
     $('.plan-price-year').text('$'+priceCount.toFixed());
     checkPlan(candidatesCount);
     }
     });

     $('.plan-plus').click(function () {
     var candidatesCount = parseInt($('.plan-candidates').eq(0).text()),
     priceCount = 0;
     if (candidatesCount < endCandidatesCount) {
     if (candidatesCount == candidatesCountPlanStarter) {
     candidatesCount = addCandidatesCount;
     } else {
     candidatesCount += addCandidatesCount;
     }
     $('.plan-candidates').text(candidatesCount);
     priceCount = candidatesCount / kCP;
     $('.plan-price-month').text('$'+priceCount.toFixed());
     priceCount = priceCount * 12 - (priceCount * 12 / 10);
     $('.plan-price-year').text('$'+priceCount.toFixed());
     checkPlan(candidatesCount);
     }
     });

     $('.save-plan-month').click(function () {
     var data = {
     "count": $('.plan-candidates').eq(0).text(),
     "price_month": $('.plan-price-month').text(),
     //"price_year": $('.plan-price-year').text(),
     };
     APIStorage.create('plan-price',JSON.stringify(data));
     return true;
     });

     $('.save-plan-year').click(function () {
     var data = {
     "count": $('.plan-candidates').eq(0).text(),
     //"price_month": $('.plan-price-month').text(),
     "price_year": $('.plan-price-year').text(),
     };
     APIStorage.create('plan-price',JSON.stringify(data));
     return true;
     });

     $('.plan-starter').click(function () {
     var candidatesCount = candidatesCountPlanStarter,
     priceCount = 0;
     $('.plan-candidates').text(candidatesCount);
     priceCount = ( candidatesCount - candidatesCountPlanStarter ) / kCP;
     $('.plan-price-month').text('$'+priceCount);
     priceCount = priceCount * 12 - (priceCount * 12 / 10);
     $('.plan-price-year').text('$'+priceCount);
     return true;
     });

     $('.plan-team').click(function () {
     var candidatesCount = candidatesCountPlanTeam,
     priceCount = 0;
     $('.plan-candidates').text(candidatesCount);
     priceCount = candidatesCount / kCP;
     $('.plan-price-month').text('$'+priceCount);
     priceCount = priceCount * 12 - (priceCount * 12 / 10);
     $('.plan-price-year').text('$'+priceCount);
     return true;
     });

     $('.plan-custom').click(function () {
     var candidatesCount = candidatesCountPlanCustom,
     priceCount = 0;
     $('.plan-candidates').text(candidatesCount);
     priceCount = candidatesCount / kCP;
     $('.plan-price-month').text('$'+priceCount);
     priceCount = priceCount * 12 - (priceCount * 12 / 10);
     $('.plan-price-year').text('$'+priceCount);
     return true;
     });*/

});