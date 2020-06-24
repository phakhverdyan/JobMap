'use strict';

function BusinessNewBilling() {


    this.businessID = APIStorage.read('business-id');

    this.current_paid_table_id = $(document).find("#current-paid-table");
    this.current_total_amount_id = $(document).find("#current-total-amount");
    this.create_card_form_id = $(document).find("#create-card-form");
    this.create_card_modal_id = $(document).find("#add_card");
    this.card_success_modal = $(document).find('#card_added');
    this.credit_cards_table_id = $(document).find("#credit-cards-table");
    this.confirmation_subscription_modal_id = $(document).find("#add_seats");
    this.confirmation_subscription_for_one_modal_id = $(document).find('#add_seats');
    this.credit_cards_table = null;
    this.table_invoices_data_id = $(document).find("#table-invoices-data");
    this.table_invoices_data = null;
    this.table_paid_location_data_id = $(document).find("#table-paid-location-data");
    this.table_paid_location_data = null;
    this.table_paid_user_data_id = $(document).find("#table-paid-user-data");
    this.table_paid_user_data = null;
    this.button_remove_manager = $(document).find('.remove-manager');
    this.modify_modal = $(document).find('#modify');
    this.formManagerEdit = $(document).find('#business-manager-form');
    // this.modal_remove_item = $(document).find('#remove_item');


    this.filter_invoices_from_date_id = $(document).find('#filter-invoices-from_date');
    this.filter_invoices_to_date_id = $(document).find('#filter-invoices-to_date');

    this.dataSubscription = {
        "business_id": APIStorage.read('business-id'),
        "user_id": 0,
        "quantity": 1,
    }
}

BusinessNewBilling.prototype = {

    stripe: undefined,
    elements: undefined,
    cardElement: undefined,

    init: function () {

        let _this = this;

        //load STRIPE.JS functions

        var script = document.createElement('script');
        script.onload = function () {
            //do stuff with the script
            _this.stripe = Stripe('pk_test_biMEgHBmiaUwkGmoVuEJaKZ400fKkBYB0z');
            _this.elements = _this.stripe.elements();
            _this.cardElement = _this.elements.create("card");
            _this.cardElement.mount("#card-element");
            console.log(_this.stripe);
        };
        script.src = 'https://js.stripe.com/v3/';
        document.head.appendChild(script);

        let _url = window.location.href;
        if(_url.indexOf('billing') > -1){
            _this.initCurrentPaid();

            _this.initDatatableCard();
            _this.initTableInvoices();
            _this.createCard();
            _this.initFiltersTableInvoices();

            _this.initPaidUserData();
            _this.initPaidLocationData();

        }
        if(_url.indexOf('manager') > -1){
            _this.initSubscriptionEvent();
            _this.initManagerSubscriptionEvent();
        }
        if(_url.indexOf('locations') > -1){
            _this.initSubscriptionEvent();
            _this.initLocationSubscriptionEvent();
        }
        if(_url.indexOf('candidate/manage') > -1){
            _this.initSubscriptionEvent();
            _this.initCandidateSubscriptionEvent();
        }
        _this.refreshListeners();
        // _this.getPrices();

    },

    initSubscriptionEvent: function(){
        let _this = this;



        $(document).find(".month-price").parent().css({"font-weight": "bold"});


        _this.create_card_form_id.on("submit", function (event) {
            event.preventDefault();
            let self = $(this);
            self.find('i').show();
            self.prop('disabled', true); 
            _this.stripe.confirmCardSetup(
                _this.create_card_form_id.data('secret'),
                {
                    payment_method: {
                        card: _this.cardElement,
                    }
              }).then(function(result) {
                    if (result.error)
                    {
                        console.log(result.error);
                        _this.create_card_modal_id.find('.error-message').text(result.error.message);
                        return;
                    }
                    console.log(result);
                    let data = {
                        "business_id": _this.businessID,
                        "setup_intent": JSON.stringify(result.setupIntent),
                    };
                    request({
                        url: "/billing/create-cart",
                        data: data,
                    }, function (response) {
                        self.find('i').hide();
                        self.prop('disabled', false);
                        console.log(response);
                        if(response.error === undefined ){
                            _this.create_card_modal_id.modal("hide");
                            $('#card_added').modal('show');
                            $(document).trigger('billing:refresh');
                        }else {
                            if(response.card_exists === 1){//error-message
                                _this.create_card_modal_id.find(".error-message").html(response.error);
                                $(document).trigger('billing:refresh');
                            }
                        }
                    });
              });

        });

        $('#remove_card_button').on('click', function(){
            let self = $(this);
            self.find('i').show();
            self.prop('disabled', true); 
            request({
                url: "/billing/datatable/action-cart",
                data: {
                    card_id: _this.card.cardId,
                    action: "remove",
                    business_id: _this.businessID
                },
            }, function (response) {
                self.find('i').hide();
                self.prop('disabled', false);
                console.log(response);
                if(response.error === undefined ){
                    if(response.removed)
                    {
                        $('[data-card-id='+response.removed+']').remove();
                    }
                    $('.modal').modal("hide");
                    $(document).trigger('billing:refresh');
                } else {
                    $('#remove_card_button').find(".error-message").html(response.error);
                }
            });
        });

        $('#pay_invoice_button').on('click', function(event) {
            let self = $(this);
            self.find('i').show();
            self.prop('disabled', true); 
            request({
                url: "billing/pay-invoice",
                data: {
                    invoice_id: _this.invoice.invoiceId
                },
            }, function (response) {
                console.log(response);
                self.find('i').hide();
                self.prop('disabled', false);
                if (response.client_secret)
                {
                    _this.stripe.confirmCardPayment(response.client_secret).then(function(result) {
                        if (result.error) {
                            $(document).trigger('billing:refresh');
                        } else {
                            request({
                                url: "/billing/update-invoice",
                                data: {id: response.invoice_id}
                            }, function (response) {
                                if(response.error === undefined ){
                                    console.log(result);
                                    $('.modal').modal("hide");
                                    $('#payment_success').modal('show');
                                    $(document).trigger('billing:refresh');
                                }
                                else {
                                    $('.error-message').text(response.error.message);
                                }
                            });
                        }
                        });
                        return true;
                } else {
                    $('.modal').modal('hide');
                    $('#payment_success').modal('show');
                    $(document).trigger('billing:refresh');
                }
            });
        });

        $('#set_default_card_button').on('click', function(){
            let self = $(this);
            self.find('i').show();
            self.prop('disabled', true); 
            request({
                url: "/billing/datatable/action-cart",
                data: {
                    card_id: _this.card.cardId,
                    action: "set-default",
                    business_id: _this.businessID
                },
            }, function (response) {
                self.find('i').hide();
                self.prop('disabled', false);
                console.log(response);
                if(response.error === undefined ){
                    if(response.removed)
                    {
                        $('[data-card-id='+response.removed+']').remove();
                    }
                    $('.modal').modal("hide");
                    $(document).trigger('billing:refresh');
                } else {
                    $('#remove_card_button').find(".error-message").html(response.error);
                }
            });
        });

        $('input[name=package]').on('change', function(){
            _this.dataSubscription.plan = $(this).val();
            var el = $('input[name=package]:checked').closest('.card').find('.quantity-billing'),
            quantity = el.val(),
            amount = el.data('amount');
            if (quantity && amount)
            {
                $('#m_total_to_pay').text(quantity*amount);
            }
            $('.error-stripe').text('');
        });

        $('#remove_item .confirm').on('click', function() {
            let self = $(this);
            self.find('i').show();
            self.prop('disabled', true); 
            request({
                url: "/managers/"+_this.admin_id+'/remove',
                data: _this.dataSubscription,
            }, function (response) {
                self.find('i').hide();
                self.prop('disabled', false);
                console.log(response);
                if(response.error === undefined ){
                    if(response.removed)
                    {
                        $('[data-item-id='+response.removed+']').remove();
                    }
                    $('#remove_item').modal("hide");
                    $(document).trigger('billing:refresh');
                } else {
                    $('#remove_item').find(".error-message").html(response.error);
                }
            });
        });

        $('#deactivate_slot').on('click', function(event) {
            let self = $(this);
            self.find('i').show();
            self.prop('disabled', true); 
            console.log(event);
            event.preventDefault();
            request({
                url: "billing/"+_this.deactivate_slot_id+"/deactivate",
                data: {user_id: _this.deactivate_user_id},
            }, function (response) {
                self.find('i').hide();
                self.prop('disabled', false);
                console.log(response);
                if(response.status === 'ok' ){
                    $(document).trigger('billing:refresh');
                    $('#deactivate').modal('hide');
                }else {
                    FormValidate.fieldsValidate(response.validator, _this.form);
                }
            });
            return true;
        });

        $('#cancel_plan_button').on('click', function(event) {
            console.log(event);
            let self = $(this);
            self.find('i').show();
            self.prop('disabled', true); 
            event.preventDefault();
            request({
                url: "billing/cancel-subscription",
                data: {
                    business_id: _this.businessID,
                    plan_id: _this.cancel_plan_id
                },
            }, function (response) {
                self.find('i').hide();
                self.prop('disabled', false);
                if(response.status === 'ok' ){
                    $(document).trigger('billing:refresh');
                    $('.modal').modal('hide');
                }else {
                    console.log(response);
                }
            });
            return true;
        });

        $('#modify_plan_button').on('click', function(event){
            let self = $(this);
            self.find('i').show();
            self.prop('disabled', true); 
            request({
                url: "billing/modify-subscription",
                data: {
                    business_id: _this.businessID,
                    plan_id: _this.modify_object.planId,
                    quantity: _this.modify_object.quantity
                },
            }, function (response) {
                self.find('i').hide();
                self.prop('disabled', false);
                if(response.status === 'ok' ){
                    $(document).trigger('billing:refresh');
                    $('.modal').modal('hide');
                } else if (response.client_secret) {
                    _this.stripe.confirmCardPayment(response.client_secret).then(function(result) {
                        if (result.error) {
                            $(document).trigger('billing:refresh');
                            console.log(result);
                        } else {
                            request({
                                url: "/billing/update-invoice",
                                data: {id: response.invoice_id}
                            }, function (response) {
                                if(response.error === undefined ){
                                    console.log(result);
                                    $('.modal').modal("hide");
                                    $('#payment_success').modal('show');
                                    $(document).trigger('billing:refresh');
                                }
                                else {
                                    $('.error-message').text(response.error.message);
                                }
                            });
                        }
                      });
                } else {
                    console.log(response);
                }
            });
            return true;
        });

        $('#hidden_counter').on('change', function(event) {
            _this.modify_object.quantity >= 1 ? _this.modify_object.quantity = event.target.value : _this.modify_object.quantity = 1;
            $(this).val(_this.modify_object.quantity);
            _this.tax_1 = Number.parseFloat($(this).data('tax-1')) || 0;
            _this.tax_2 = Number.parseFloat($(this).data('tax-2')) || 0;
            console.log(_this.tax_1, _this.tax_2);
            var price = _this.modify_object.quantity*_this.modify_object.amount/100;
            _this.modify_modal.find('#m_counter').text(_this.modify_object.quantity);
            _this.modify_modal.find('#m_month').text(price);
            _this.modify_modal.find('#m_month_tax').text( Number(price*(1+_this.tax_1/100+_this.tax_2/100)).toFixed(2));
        });

        $(document).on('billing:refresh', function(event) {
            $('#business_table_processing').show();
            var tab_id = $('.nav-link.active').attr('id');
            request({
                url: "/billing/refresh",
                dataType: "text"
            }, function (response) {
                if(response.error === undefined ){
                    $('.billing.content-main').html(response).promise().then(function(){
                        $('#business_table_processing').hide();
                        $('#'+tab_id).tab('show');
                        _this.refreshListeners();
                        window.business.counters();
                    });
                }
                else {
                    $('.error-message').text(response.error.message);
                }
            });
        });
        $('.quantity-billing').on('change', function(event) {
            var el = $('input[name=package]:checked').closest('.card').find('.quantity-billing'),
            quantity = el.val(),
            amount = el.data('amount');
            if (quantity && amount)
            {
                $('#m_total_to_pay').text(quantity*amount);
            }
        });

        $(document).on("billing:manager:billing-create-subscription", function (event) {
            _this.dataSubscription.quantity = $('input[name=package]:checked').closest('.card').find('.quantity-billing').val();
            request({
                url: "/billing/manager/create-subscription",
                data: _this.dataSubscription,
            }, function (response) {
                console.log(response);
                if(response.error === undefined ){
                    if (response.client_secret)
                    {
                            _this.stripe.confirmCardPayment(response.client_secret).then(function(result) {
                                if (result.error) {
                                  // Display error message in your UI.
                                  // The card was declined (i.e. insufficient funds, card has expired, etc)
                                  $('.error-stripe').text(result.error);
                                } else {
                                    request({
                                        url: "/billing/update-invoice",
                                        data: {id: response.invoice_id}
                                    }, function (response) {
                                        console.log(response);
                                        $('.modal').modal('hide');
                                        $('button i.fa-spin').hide();
                                        _this.confirmation_subscription_modal_id.find('button').prop('disabled', false);
                                          if(window.location.href.indexOf('candidate/manage') > -1){
                                              $(document).trigger("business:applicants:candidate:table:draw");
                                          }
                                          else{
                                              $(document).trigger('billing:refresh');
                                          }
                                    });
    
                                }
                              });
                          return true;
                    }
                    $('.modal').modal('hide');
                    $('button i.fa-spin').hide();
                    _this.confirmation_subscription_modal_id.find('button').prop('disabled', false);
                    $(document).find("#text-user-paid").remove();
                    if(window.location.href.indexOf('candidate/manage') > -1){
                        $(document).trigger("business:applicants:candidate:table:draw");
                    }
                    else{
                        $(document).trigger('billing:refresh');
                    }
                }
                else {
                    $('.error-stripe').text(response.error.message);
                }
            });
        });

        $('#resend_invite_button').on('click', function() {
            let self = $(this);
            self.find('i').show();
            self.prop('disabled', true); 
            event.preventDefault();
            let data = {
                admin_id: window.businessFunctions.current_edit_id,
                email: $('#m_resend_email').val(),
            };

            request({
                url: "managers/resend-invite",
                data: data,
            }, function (response) {
                self.find('i').hide();
                self.prop('disabled', false);
                if(response.error === undefined ){
                    $('#invite_sent').modal('show');
                    $('#m_invite_email_sent').text(data.email);
                    $('#m_invite_name_sent').text(window.businessFunctions.form.find('[name=first_name]').val()+' '+window.businessFunctions.form.find('[name=last_name]').val());
                }else {
                    FormValidate.fieldsValidate(response.validator, _this.form);
                }
            });
            
        });

        $('#change_seat_button').on('click', function(event) {
            let self = $(this);
            self.find('i').show();
            self.prop('disabled', true); 
            event.preventDefault();
            var slot = JSON.parse($('#m_plan_select').val()); 
            let data = {
                business_id: _this.businessID,
                admin_id: _this.assign_id,
                plan_id:  slot.plan,
                pack_id:  slot.pack
            };
            request({
                url: "billing/activate",
                data: data,
            }, function (response) {
                self.find('i').hide();
                self.prop('disabled', false);
                console.log(response);
                if(response.status === 'ok' ){
                    $('.modal').modal('hide');
                    $(document).trigger('billing:refresh');
                }else {
                    
                }
            });
            return true;
        });

        $('.resend-invite').on('click', function() {
            $('#m_resend_email').val(window.businessFunctions.form.find('[name=email]').val());
        });
        
    },

    refreshListeners: function() {
        let _this = this;

        var $options = $("#plan_select > option").clone();
        $('#m_plan_select').empty();
        $('#m_plan_select').append($options);
        // var cards_on_modal = $('#choose_payment_method #cards');
        // cards_on_modal.empty();

        // $.each(cards, function (index, value) {
        //     cards_on_modal.append(
        //         '<div class="row justify-content-start align-items-center mb-2" data-card-id="'+value.id+'">'+
        //             '<div class="col-lg-1 text-center">'+
        //             '<div class="col-lg-12">'+
        //                 '<div class="row align-items-center">'+
        //                     // '<img src="../../images/'+value.type+'.png" width="20" alt="">'+
        //                     '<span class="ml-2">'+value.brand+'</span>'+(
        //                         value.default ? '<span class="badge badge-sm badge-success ml-2">Default</span>' : ''
        //                     )+
        //                 '</div>'+
        //             '</div>'+ 
        //         '</div>'+
        //         '<div class="col-lg-4 text-center">'+
        //             '<img src="../../images/'+value.type+'.png" width="20" alt="">'+
        //             '<span class="ml-2">'+value.brand+'</span>'+
        //             '<span class="last-four">****'+value.last4+'</span>'+
        //         '</div>'+
        //     '</div>');
        // });

        $('.remove-card').on('click', function() {
            _this.card = $(this).data();
            $('.m_last4').text(_this.card.last4);
            console.log(_this.card.last4);
        });

        $('.set-default').on('click', function() {
            _this.card = $(this).data();
            $('.m_last4').text(_this.card.last4);
            console.log(_this.card.last4);
        });

        $('.remove-manager').on('click', function() {
            _this.admin_id = $(this).attr('data-admin-id');
            console.log(_this.admin_id);
        });

        $('#autocomplete_assign').autocomplete(
            {
                source: users,
                select: function(event, selected) {
                   _this.assign_id = selected.item.id;
                   console.log(_this.assign_id);
                }
            });
        $('#assign_user_button').on('click', function(event) {
            let self = $(this);
            self.find('i').show();
            self.prop('disabled', true); 
            event.preventDefault();
            var slot = JSON.parse($('#plan_select').val()); 
            let data = {
                business_id: _this.businessID,
                admin_id: _this.assign_id,
                plan_id:  slot.plan,
                pack_id:  slot.pack
            };
            request({
                url: "billing/activate",
                data: data,
            }, function (response) {
                self.find('i').hide();
                self.prop('disabled', false);
                console.log(response);
                if(response.status === 'ok' ){
                    $(document).trigger('billing:refresh');
                }else {
                    
                }
            });
            return true;
        });

        $('#add_user_button').on('click',function (event) {
            let self = $(this);
            self.find('i').show();
            self.prop('disabled', true); 
            event.preventDefault();
            let data = {
                business_id: _this.businessID,
                email: $('#user_email').val(),
                role:  $('#user_type_select').val(),
            };

            request({
                url: "managers/create",
                data: data,
            }, function (response) {
                self.find('i').hide();
                self.prop('disabled', false);
                console.log(response);
                if(response.error === undefined ){
                    $(document).trigger('billing:refresh');
                }else {
                    FormValidate.fieldsValidate(response.validator, _this.form);
                }
            });
        });

        $('.deactivate-button').on('click', function(event) {
            _this.deactivate_slot_id = $(this).data('id');
            _this.deactivate_user_id = $(this).data('user-id');
            console.log(_this.deactivate_slot_id, _this.deactivate_user_id);
        });

        $('.modify-plan').on('click', function() {
            _this.modify_object = $(this).data();
            _this.modify_object.quantity = _this.modify_object.counter;
            console.log(_this.modify_object);
            _this.modify_modal.find('#hidden_counter').val(_this.modify_object.counter);
            _this.modify_modal.find('#m_counter').text(_this.modify_object.counter);
            _this.modify_modal.find('#m_descriptor').text($(this).data('descriptor'));
            _this.modify_modal.find('#m_month').text($(this).data('sum'));
            $('#hidden_counter').trigger('change');
        });

        $('.cancel-plan').on('click', function(event) {
            _this.cancel_plan_id = $(this).data('plan-id');
        });

        $('.pay-invoice').on('click', function(event){
            _this.invoice = $(this).data();
            $('#m_invoice_number').text(_this.invoice.number);
            $('#m_invoice_date').text(_this.invoice.date);
            $('#m_invoice_amount').text(_this.invoice.amount);
        });

        $('.edit-manager').on('click', function(event) {
            _this.formManagerEdit.find('.manager__permit-item').prop('checked', false);
            $('#data-table-assigned-locations-collapse').collapse('hide');
            window.businessFunctions.current_edit_id = $(this).data('admin-id');
            if(window.businessFunctions.is_modal)
            {
                $(document).find('#location-' + window.businessFunctions.current_brand_id + ' .location-item').prop('checked', false);
            }
            window.businessFunctions.modal_callback = function() {
                $('.modal').modal('hide');
                $(document).trigger('billing:refresh');
            };
            window.businessFunctions.managerLoadAjax();
            });

        $('.email-filter').on('keyup paste', function() {
            $('[data-item-id]').show();
            var val = $(this).val();
            $('.email-filter').val(val);
            var hidden = $.map(users,function(el, key){
                return (el.label.indexOf(val) == -1 ? el.id : null);
            });
            $.each(hidden, function(index, value) {
                $('[data-item-id='+value+']').hide();
            });
        });

        $('.change-seat').on('click', function() {
            _this.assign_id = $(this).data('id');
            console.log($(this).data('value'));
            $('#m_plan_select').val(JSON.stringify($(this).data('value')));
            console.log($('#m_plan_select').val());
        });
    },

    initFiltersTableInvoices: function(){
        let _this = this;

        _this.filter_invoices_from_date_id.datetimepicker({
            debug: true,
            widgetPositioning: {
                vertical: 'top',
            },
            format: 'L'
        });

        _this.filter_invoices_from_date_id.on('hide.datetimepicker', function(event){
            $(document).trigger("table_invoices_data:draw");
        });

        _this.filter_invoices_to_date_id.datetimepicker({
            debug: true,
            widgetPositioning: {
                vertical: 'top',
            },
            format: 'L'
        });

        _this.filter_invoices_to_date_id.on('hide.datetimepicker', function(event){
            $(document).trigger("table_invoices_data:draw");
        });

        $(document).find("select[name=type_invoices]").on("change", function (event) {
            $(document).trigger("table_invoices_data:draw");
        });

        $(document).find("input[name=find_invoices_by_customer_email]").on("keyup", function (event) {
            $(document).trigger("table_invoices_data:draw");
        });

    },

    initTableInvoices: function(){
        let _this = this;

        $(document).on("table_invoices_data:draw", function (event) {
            if(_this.table_invoices_data !== null){
                _this.table_invoices_data.draw();
                event.preventDefault();
            }
        });

        _this.table_invoices_data = _this.table_invoices_data_id.DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "/api/billing/datatable/get-invoices-data",
                data: function (data) {
                    data.business_id =_this.businessID;
                    data.data_from = $(document).find("input[name=date_from_filter_invoices]").val();
                    data.data_to = $(document).find("input[name=date_to_filter_invoices]").val();
                    data.type_invoices = $(document).find("select[name=type_invoices]").val();
                    data.find_email = $(document).find("input[name=find_invoices_by_customer_email]").val();
                },
                headers: {
                    'Authorization': 'Basic ' + window.auth.user.api_token
                }
            },
            columns: [
                {data: 'period', name: 'period' },
                {data: 'customer_email', name: 'customer_email' },
                {data: 'price', name: 'price' },
                {data: 'type', name: 'type' },
                {data: 'action', name: 'action' }
            ],
            initComplete: function (settings, json) {},
            drawCallback: function(settings){
                if (this.api().page.info().pages <= 1) {
                    $('#' + settings.sTableId + '_paginate').hide();
                }else{
                    $('#' + settings.sTableId + '_paginate').show();
                }

                // $(document).find("#"+ settings.sTableId +" .invoice-action").on("click", function (event) {
                //     event.preventDefault();
                //     let data = {
                //         "business_id": APIStorage.read('business-id'),
                //         "invoice_id": $(this).attr("data-invoice-id")
                //     };
                //
                //     request({
                //         url: "/billing/get-invoices-pdf",
                //         data: data,
                //     }, function (response) {
                //         console.log(response);
                //         if(response.error === undefined ){
                //
                //         }
                //     });
                // });
            },
            language: {
                searchPlaceholder: "",
                sSearch: "",
                oPaginate: {
                    sPrevious: " ",
                    sNext: " ",
                },
                processing: '<i class="fa fa-circle-o-notch fa-spin  fa-3x fa-fw"></i><span class="sr-only">Loading..n.</span>'
            },
            dom:"<'row'<'col-sm-12 col-md-6'f><'col-sm-12 col-md-6'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "info": false,
            "sort": false,
            "searching": false,
            "pageLength": 5,
            "lengthChange": false
        });
    },

    initDatatableCard: function(){
        let _this = this;
        _this.credit_cards_table = _this.credit_cards_table_id.DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "/api/billing/datatable/get-cards-data",
                data: {
                    business_id: _this.businessID,
                    language_prefix: defaultLang
                },
                headers: {
                    'Authorization': 'Basic ' + window.auth.user.api_token
                }
            },
            columns: [
                {data: 'primary', name: 'primary' },
                {data: 'name', name: 'name' },
                {data: 'action', name: 'action' }
            ],
            initComplete: function (settings, json) {},
            drawCallback: function(settings){
                if (this.api().page.info().pages <= 1) {
                    $('#' + settings.sTableId + '_paginate').hide();
                }else{
                    $('#' + settings.sTableId + '_paginate').show();
                }

                $(document).find("#"+ settings.sTableId +" .card-action").on("click", function (event) {
                    event.preventDefault();
                    let data = {
                        "business_id": APIStorage.read('business-id'),
                        "action": $(this).attr("data-action"),
                        "card_id": $(this).attr("data-card-id")
                    };

                    request({
                        url: "/billing/datatable/action-cart",
                        data: data,
                    }, function (response) {
                        console.log(response);
                        if(response.error === undefined ){
                            _this.credit_cards_table.ajax.reload();
                        }
                    });
                });
            },
            language: {
                searchPlaceholder: "",
                sSearch: "",
                oPaginate: {
                    sPrevious: " ",
                    sNext: " ",
                },
                processing: '<i class="fa fa-circle-o-notch fa-spin  fa-3x fa-fw"></i><span class="sr-only">Loading..n.</span>'
            },
            dom:"<'row'<'col-sm-12 col-md-6'f><'col-sm-12 col-md-6'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "info": false,
            "sort": false,
            "searching": false,
            "pageLength": 5,
            "lengthChange": false
        });
    },

    createCard: function(){
        let _this = this;
        _this.create_card_form_id.on("submit", function (event) {
            event.preventDefault();
            console.log("SUBMIT - #create-card-form");
            _this.stripe.confirmCardSetup(
                _this.create_card_modal_id.data('secret'),
                {
                    payment_method: {
                        card: _this.cardElement,
                    }
              }).then(function(result) {
                    if (result.error)
                    {
                        console.log(result.error);
                        _this.create_card_modal_id.find(".error-message").text(result.error.message);
                        return;
                    }
                    console.log(result);
                    let data = {
                        "business_id": _this.businessID,
                        "setup_intent": JSON.stringify(result.setupIntent),
                    };
                    request({
                        url: "/billing/create-cart",
                        data: data,
                    }, function (response) {
                        if(response.error === undefined ){
                            $('.modal').modal("hide");
                            $(document).trigger('billing:refresh');
                        }else {
                            if(response.card_exists === 1){//error-message
                                _this.create_card_modal_id.find(".error-message").html(response.error);
                            }
                        }
                    });
              });

        });
    },

    initCurrentPaid: function(){
        let _this = this;

        request({
            url: "/billing/get-current-paid",
            data: {
                business_id: _this.businessID,
            },
        }, function (response) {
            console.log(response);
            if(response.error === undefined ){
                _this.current_paid_table_id.find("tbody").html(response.data.html);
                _this.current_total_amount_id.find(".monthly-total-amount .total-amount").html(response.data.monthly_total_amount);
                _this.current_total_amount_id.find(".yearly-total-amount .total-amount").html(response.data.yearly_total_amount);
            }
        });
    },

    initPaidUserData: function(){
        let _this = this;

        $(document).on("click", ".show-details-invoice-users", function (event) {
            event.preventDefault();
            let _user_role = $(this).attr("data-users-role");
            console.log("EVENT - show-details-invoice-users");

            _this.table_paid_user_data = _this.table_paid_user_data_id.DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "/api/billing/datatable/get-paid-user-data",
                    data: function (data) {
                        data.business_id =_this.businessID;
                        data.language_prefix = defaultLang;
                        data.find_paid_user = $(document).find("#show-paid-users-modal input[name=find_paid_user]").val();
                        data.user_role = _user_role;
                    },
                    headers: {
                        'Authorization': 'Basic ' + window.auth.user.api_token
                    }
                },
                columns: [
                    {data: 'name', name: 'name' }
                ],
                initComplete: function (settings, json) {},
                drawCallback: function(settings){
                    if (this.api().page.info().pages <= 1) {
                        $('#' + settings.sTableId + '_paginate').hide();
                    }else{
                        $('#' + settings.sTableId + '_paginate').show();
                    }
                },
                language: {
                    searchPlaceholder: "",
                    sSearch: "",
                    oPaginate: {
                        sPrevious: " ",
                        sNext: " ",
                    },
                    processing: '<i class="fa fa-circle-o-notch fa-spin  fa-3x fa-fw"></i><span class="sr-only">Loading..n.</span>'
                },
                dom:"<'row'<'col-sm-12 col-md-6'f><'col-sm-12 col-md-6'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "info": false,
                "sort": false,
                "searching": false,
                "pageLength": 5,
                "lengthChange": false
            });

            $(document).find("#show-paid-locations-modal input[name=find_paid_location]").on("keyup", function (event) {
                if(_this.table_paid_location_data !== null){
                    _this.table_paid_location_data.draw();
                    event.preventDefault();
                }
            });

            $(document).find("#show-paid-users-modal").modal("show");
        });

        $(document).find("#show-paid-users-modal").on("hide.bs.modal", function () {
            if(_this.table_paid_user_data !== null){
                _this.table_paid_user_data.destroy();
            }
        });
    },

    

    initManagerSubscriptionEvent: function () {
        let _this = this;
        $(document).trigger("billing:get-user-slots");

        $(document).on("click", "[name=billing-paid]", function (event) {
            _this.dataSubscription.user_id = $(this).attr("data-id");

            if(_this.dataSubscription.checked === 1){
                $(document).trigger("billing:checked-card");
            }else {
                $(document).trigger("billing:manager:billing-delete-subscription");
            }
        });

        _this.confirmation_subscription_modal_id.find(".confirmation-subscription-button").on("click", function (event) {
            $(this).find('i').show();
            $(this).prop('disabled', true);

            if(!_this.dataSubscription.plan)
            {
                $('.error-stripe').text('Please choose a plan before');
                return false;
            }
                $(document).trigger("billing:manager:billing-create-subscription");

        });

        _this.confirmation_subscription_for_one_modal_id.find(".confirmation-subscription-button").on("click", function (event) {
            $(this).find('i').show();
            $(this).prop('disabled', true);
            if(_this.dataSubscription.confirmation === 1){
                $(document).trigger("billing:manager:billing-create-subscription");
            }else {
                $(document).find("[name=billing-paid][data-id="+_this.dataSubscription.user_id+"]").prop("checked", false);
            }
        });
    },

    initCandidateSubscriptionEvent: function () {
        let _this = this;
        let _candidate_flag = 0;
        $(document).on("click", ".candidate-card-limited", function (event) {
            event.preventDefault();
            _this.dataSubscription.user_id = window.auth.user.id;
            _this.dataSubscription.business_id = $(this).attr("data-business-id");
            _this.dataSubscription.checked = 1;
            _candidate_flag = 0;
            $(document).trigger("billing:checked-card");
        });

        $(document).on("click", ".candidate-card-scanner-limited", function (event) {
            event.preventDefault();
            _this.dataSubscription.location_id = $(this).attr("data-location-id");
            _this.dataSubscription.business_id = $(this).attr("data-business-id");
            _this.dataSubscription.checked = 1;
            _candidate_flag = 1;
            $(document).trigger("billing:checked-card");
        });

        _this.confirmation_subscription_modal_id.find(".confirmation-subscription-button").on("click", function (event) {
            _this.dataSubscription.confirmation = parseInt($(this).attr("data-action"));

            if(_this.dataSubscription.confirmation === 1){
                if(_candidate_flag === 0){
                    $(document).trigger("billing:manager:billing-create-subscription");
                }else {
                    $(document).trigger("billing:location:billing-create-subscription");
                }
            }
        });
    }
};

$(document).ready(function () {


    let businessNewBilling = new BusinessNewBilling();
    businessNewBilling.init();

});
