let businessCard;

function BusinessCard() {
    this.objects;
}

BusinessCard.prototype = {
    createCard: function () {
        var createParams = {
            "business_id": APIStorage.read('business-id'),
            "number": $('input[name="card-number"]').val(),
            "expiryYear": parseInt($('input[name="expiry-year"]').val()),
            "expiryMonth": parseInt($('input[name="expiry-month"]').val()),
            "code": parseInt($('input[name="cvc"]').val()),
            "name": $('input[name="card-holders-name"]').val(),
            "stripe_id": business.currentData.stripe_id,
        };
        new GraphQL("mutation", "createCard", createParams, [
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            setTimeout(function () {
                location.href = window.location.origin + '/business/billing';
            }, 300)
        }, false).request();
    },
};


$(document).ready(function () {

    let form = $('#createCard');
    form.on('submit', function (e) {
        e.preventDefault();
        businessCard = new BusinessCard();
        businessCard.createCard();

    });

});