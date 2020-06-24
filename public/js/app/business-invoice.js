function BusinessInvoice() {
    this.objects;
}


BusinessInvoice.prototype = {
    init: function () {
        var invoice_id = location.pathname.split('/business/billing/invoice/')[1];

        var params = {
            "id": invoice_id,
            "business_id": APIStorage.read('business-id')
        };
        new GraphQL("query", "invoice", params,
            ['html_print'], true, false, function () {
                Loader.stop();
            }, function (data) {
                //

            }, false).request();
    }
};

$(document).ready(function () {
    setTimeout(function () {
        BusinessInvoice = new BusinessInvoice();
        BusinessInvoice.init();
    }, 700);
});
