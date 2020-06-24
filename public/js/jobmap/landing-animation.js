$(document).ready(function() {
    var $pseudo_input_title = $('.pseudo-input-title');
    setTimeout(function () {
        $pseudo_input_title.fadeIn()
        $('.pseudo-input').removeClass('hide-pseudo-input')
    },1500)
    $('.landing-blank').addClass('animated fadeInRight');


    landingForm();
    function landingForm() {
        $(".mailField").keyup(function (event) {
            var mailVal = $(event.target).val();

            if(mailVal.length > 3) {
                $(".nameFieldBox").show(500);
            } else {
                $(".nameFieldBox").hide(500);
            }
        });
    }
});