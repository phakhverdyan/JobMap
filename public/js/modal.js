$(document).ready(function() {
    /*Modal Popup*/

    //add login/signup modal

    $modal   = $('.modal-frame');
    $overlay = $('.modal-overlay');

    $modal_sign_in = $('.modal_sign_in');
    $modal_sign_up = $('.modal_sign_up');
    $modal_reset_password = $('.modal_reset_password');
    $modal_contact_form = $('.modal_contact_form');
    $pseudo_input_title = $('.pseudo-input-title');
    $referal_modal_authenticated = $('.referal_modal_authenticated');
    $referal_modal = $('.referal_modal');


    $modal_sign_in.hide();
    $modal_sign_up.hide();
    $modal_contact_form.hide();
    $modal_reset_password.hide();
    $pseudo_input_title.hide();
    $referal_modal_authenticated.hide();
    $referal_modal.hide();

    /* Need this to clear out the keyframe classes so they dont clash with each other between ener/leave. Cheers. */
    $modal.bind('webkitAnimationEnd oanimationend msAnimationEnd animationend', function (e) {
        if ($modal.hasClass('state-leave')) {
            $modal.removeClass('state-leave');
        }
    });

    function showModal () {
        $overlay.addClass('state-show');
        $modal.removeClass('state-leave').addClass('state-appear');
    }

    function hideModal () {
        $overlay.removeClass('state-show');
        // $modal.removeClass('state-appear').addClass('state-leave');
        $modal.removeClass('state-appear');
    }

    function hideAll () {
    $modal_sign_in.hide();
    $modal_sign_up.hide();
    $modal_contact_form.hide();
    $modal_reset_password.hide();
    $referal_modal_authenticated.hide();
    $referal_modal.hide();
    }

    $(".show-sign-in").on('click', function () {
    if(!$modal_sign_up.is(":visible")) {
        showModal();
    } else {
        hideAll();
    }
    $modal_sign_in.show();
    });

    $(".show-sign-up").on('click', function () {
    if(!$modal_sign_in.is(":visible")) {
        showModal();
    } else {
        hideAll();
    }
    $modal_sign_up.show();
    });

    $(".show-reset-password").on('click',function () {
    if(!$modal_sign_in.is(":visible")) {
        showModal();
    } else {
        hideAll();
    }
    $modal_reset_password.fadeIn();
    });

    $(".show-contact-form").on('click', function () {
    if(!$modal_sign_in.is(":visible")) {
        showModal();
    } else {
        hideAll();
    }
    $modal_contact_form.show();
    });

    $("#referal_modal_authenticated").on('click', function () {
    if(!$modal_sign_in.is(":visible")) {
        showModal();
    } else {
        hideAll();
    }
    $referal_modal_authenticated.show();
    });

    $("#referal_modal").on('click', function () {
    if(!$modal_sign_in.is(":visible")) {
        showModal();
    } else {
        hideAll();
    }
    $referal_modal.show();
    });


    $('.close-modal').on('click', function () {
    hideModal();
    hideAll();
    });

    $('#show-modal').on('click', function () {
    showModal ();
    });

    /* End Modal */
})


$('#editModal').modal('handleUpdate');