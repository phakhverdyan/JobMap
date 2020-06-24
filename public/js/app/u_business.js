var uBis;

function uBusiness() {
    this.businessID;
    this.form = $('#claimUnconfirmedBusiness');
}

uBusiness.prototype = {
    init: function () {
        var _this = this;
        $('body').on('click', '.ubis-send-resume', function () {
            _this.businessID = $(this).attr('data-b-id');
            _this.form.find('input, textarea').val('');
            FormValidate.fieldsValidateClear(_this.form);
            $('#claimUnconfirmedBusiness').modal('show');
            $('#ubis-send-resume-sent').attr('data-ubis_id',_this.businessID);
        });
        $('body').on('click', '#ubis-send-resume-sent', function () {
            new GraphQL("query", "sendClaimUBis", {
                "id": _this.businessID,
                'first_name': FormValidate.getFieldValue('first_name', _this.form),
                'last_name': FormValidate.getFieldValue('last_name', _this.form),
                'email': FormValidate.getFieldValue('email', _this.form),
                'phone': FormValidate.getFieldValue('phone', _this.form),
                'employer_number': FormValidate.getFieldValue('employer_number', _this.form),
                'time': FormValidate.getFieldValue('time', _this.form),
                'message': FormValidate.getFieldValue('message', _this.form)
            }, ['response', 'message'], false, false, function () {
                Loader.stop();
            }, function (data) {
                $('#claimUnconfirmedBusiness').modal('hide');
            },_this.form).request();
        });

        $('body').on('click', '#UshareFacebook', function () {
            let ogUrl = $('#share-link-ubis').val();
            FB.ui({
                method: 'share',
                href: ogUrl,
            }, function(response){});
        });
        $('body').on('click', '#UshareGoogle', function () {
            let ogUrl = $('#share-link-ubis').val();
            window.open("https://plus.google.com/share?url=" + ogUrl, 'sharer', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;
        });

        $('body').on('click', '#UshareTwitter', function () {
            let ogUrl = $('#share-link-ubis').val();
            window.open("https://twitter.com/share?url=" + ogUrl, 'sharer', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;
        });

        $('body').on('click', '#UshareLinkedin', function () {
            let ogUrl = $('#share-link-ubis').val();
            window.open("https://www.linkedin.com/share?url=" + ogUrl, 'sharer', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;
        });

        $('body').on('click', '#UshareEmailSend', function () {
            event.preventDefault();
            var link = $('#share-link-ubis').val();
            var email = $('#UshareEmailInput').val();
            if (!email) {
                $.notify('Please, enter email!', 'warning');
                return;
            }
            new GraphQL("mutation", 'shareLink', {
                "email": email,
                "link": link,
            }, ['response'], true, false, function(data) {
                //
            }, function () {
                $.notify('Link sent!', 'success');
            }).request();
        });

    },

    clear: function () {
        this.businessID = null;
    }
};

$(document).ready(function () {
    uBis = new uBusiness();
    uBis.init();
});