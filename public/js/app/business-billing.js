'use strict';
var plans = {};
var businessBilling;
var tax = {};
var price = {
    summary: 0,
    price: 0,
    priceTotal: 0
};

var typing = false;

var coupon = {};
var loaded = 0;
var loaded_info = 0;

function BusinessBilling() {
    this.objects;
    this.bmic;
    this.updateTax;

    this.error = 0;
    this.currentPage = 1;
    this.limit = 10
    this.countPages = 1;
    this.city = '';
    this.region = '';
    this.country = '';
    this.countryCode = '';
    this.companyName = '';
    this.ownerName = '';
    this.streetNumber = '';
    this.street = '';
    this.suite = '';
    this.zipCode = '';
    this.checkCouponTimer;
    this.updateData = false;
    this.canceled = 0;
    this.curPlan = 0;
    this.curTmpPlan = 0;
    this.nextPlanID = 0;
    this.customerID = '';
    this.planPrice = 0;
    this.planApplications = 0;
    this.HTMLDOM = {
        checkCanada: $('.js-check-ca'),
        countryInfo: $('.js-country-info'),
        cardTable: $('.card-table tbody'),
        lastFour: $('.js-last-four'),
        cardType: $('.js-last-four'),
        upgradePlan: $('.js-upgrade-plan'),
        cancelPlan: $('.js-cancel-plan'),
        invoiceTable: $('.invoice-table tbody'),
        invoiceList: $('.js-invoices-list'),
        currentPlanName: $('.js-current-plan_name'),
        // currentPlanApplicants: $('.js-current-plan_name'),
        chooseCard: $('#chooseCard'),
        upgradeBilling: $('#upgradeBilling'),

        billingContact: $('#billingContact'),
        billing: {
            companyName: $('#billingContact .js-billing-company_name'),
            ownerName: $('#billingContact .js-billing-owner_name'),
            streetNumber: $('#billingContact .js-billing-street_number'),
            street: $('#billingContact .js-billing-street'),
            suite: $('#billingContact .js-billing-suite'),
            zipCode: $('#billingContact .js-billing-zip_code'),
        },
        billingAddress: $('.js-billing-address p'),
        slider: $("#hr_slider"),
        sliderValue: $('#hr_value'),
        sliderPrice: $('#hr_price'),

        discount: $('.js-discount'),
        priceDescriptionTD: $('.js-price-description td'),
        priceDescription: $('.js-price-description'),

        subtotal: $('.js-subtotal'),
        subtotalText: $('.js-subtotal-text'),
        pricePerMonth: $('.js-price-permonth'),
        totalPrice: $('.js-total-price'),
        tax: $('.js-tax'),
        taxTable: $('.js-tax-table'),
        canadaTax: $('.js-ca-tax'),
        coupon: $('.js-coupon'),

    };
}

BusinessBilling.prototype = {
    init: function () {
        var _this = this;
        _this.customerID = business.currentData.stripe_id;
        var body = $('body');
        //get per-page limit from url
        if (getUrlParameter('limit')) {
            this.limit = +getUrlParameter('limit');
        }
        //get current page from url
        if (getUrlParameter('page')) {
            this.currentPage = +getUrlParameter('page')
        }
        body.on('click', '.page-link.page', function () {
            _this.currentPage = +$(this).text();
            updateQueryStringParam('page', _this.currentPage);
            _this.getInvoiceLists();
        });
        body.on('click', '.page-prev', function () {
            if (_this.currentPage > 1) {
                _this.currentPage -= 1;
                updateQueryStringParam('page', _this.currentPage);
                _this.getInvoiceLists();
            }
        });
        body.on('click', '.page-next', function () {
            if (_this.currentPage < _this.countPages) {
                _this.currentPage += 1;
                updateQueryStringParam('page', _this.currentPage);
                _this.getInvoiceLists();
            }
        });
        if (_this.customerID === '') {
            _this.createCustomer();
        }
        _this.getBillingAddress()
            .then(function () {
                _this.getTax(_this.region)
                    .then(function () {
                        // _this.currentPlan()
                        //     .then(function () {
                        //         _this.getPlanLists();
                                _this.getCardLists();
                                _this.getInvoiceLists();
                                _this.getCountryInfo();
                                _this.getSizes();
                                _this.price = price;
                            // })
                    })
            });
    },
    getBillingAddress: function (data) {
        var _this = this;
        return new Promise(function (resolve, reject) {
            var params = {
                "business_id": APIStorage.read('business-id')
            };
            new GraphQL("query", "billingAddress", params,
                ['business_id, company_name, owner_name, street_number, street, suite, city, region, country, country_code, zip_code, token'], true, false, function () {
                    Loader.stop();
                }, function (data) {
                    _this.companyName = data.company_name !== '' && data.company_name !== null ? data.company_name : business.currentData.name;
                    _this.ownerName = data.owner_name !== '' && data.owner_name !== null ? data.owner_name : business.currentData.owner;
                    _this.streetNumber = data.street_number !== '' && data.street_number !== null ? data.street_number : business.currentData.street_number;
                    _this.street = data.street !== '' && data.street !== null ? data.street : business.currentData.street;
                    _this.suite = data.suite !== '' && data.suite !== null ? data.suite : business.currentData.suite;
                    _this.city = data.city !== '' && data.city !== null ? data.city : business.currentData.city;
                    _this.region = data.region !== '' && data.region !== null ? data.region : business.currentData.region;
                    _this.country = data.country !== '' && data.country !== null ? data.country : business.currentData.country;
                    _this.countryCode = data.country_code !== '' && data.country_code !== null ? data.country_code : business.currentData.country_code;
                    _this.zipCode = data.zip_code !== '' && data.zip_code !== null ? data.zip_code : business.currentData.zip_code;
                    _this.nextPlanID = business.currentData.next_plan_id;
                    resolve();
                }, false).request();
        })

    },
    getTax: function (region) {
        var _this = this;
        return new Promise(function (resolve, reject) {
            var params = {
                "province_en": region
            };
            new GraphQL("query", "tax", params,
                ['code, province_fr, province_en, type_1, rate_1, type_2, rate_2'], true, false, function () {
                    Loader.stop();
                }, function (data) {
                    _this.tax = data;
                    resolve();
                }, false).request();
        })
    },
    setBillingAddress: function () {
        var params = {
            "business_id": APIStorage.read('business-id'),
            "company_name": this.companyName,
            "owner_name": this.ownerName,
            "street_number": this.streetNumber,
            "street": this.street,
            "suite": this.suite,
            "city": this.city,
            "region": this.region,
            "country": this.country,
            "country_code": this.countryCode,
            "zip_code": this.zipCode
        };
        new GraphQL("mutation", "updateBillingAddress", params,
            ['token'], true, false, function () {
                Loader.stop();
            }, function (data) {

            }, false).request();
    },
    pagination: function (pages) {
        var _this = this;
        var html = '';
        if (pages > 1) {
            html = '<li class="page-item"><a class="page-link page-prev" href="javascript:void(0)"><</a></li>';
            for (var i = 1; i <= pages; i++) {
                var active = '';
                if (_this.currentPage === i) {
                    active = 'active';
                }
                html += '<li class="page-item ' + active + '"><a class="page-link page" href="javascript:void(0)">' + i + '</a></li>';
            }
            html += '<li class="page-item"><a class="page-link page-next" href="javascript:void(0)">></a></li>';
        }
        $('.pagination-content').html(html);
    },
    getCountryInfo: function () {
        var _this = this;
        var info = '';
        info = ' <span style="vertical-align: middle; margin-top: -3px;"' +
            'class="item-location-flag bfh-flag-' + _this.countryCode.toUpperCase() + ' mr-1 ">' +
            '<i class="glyphicon"></i>' +
            '</span>' +
            _this.country;
        if (_this.countryCode !== 'CA') {
            if (!_this.HTMLDOM.checkCanada.hasClass('d-none')) {
                _this.HTMLDOM.checkCanada.addClass('d-none')
            }
        } else {
            _this.HTMLDOM.checkCanada.removeClass('d-none');
            var taxname = _this.tax.type_2 !== '' && _this.tax.type_2 !== null ? ' ' + _this.tax.type_1 + ', ' + _this.tax.type_2 : ' ' + _this.tax.type_1;
            var taxAmount = parseFloat(_this.tax.rate_1) + parseFloat(_this.tax.rate_2);
            info += taxname + ' +' + taxAmount + '%';
        }
        _this.HTMLDOM.countryInfo.html(info);
        return true;
    },
    getPlanLists: function () {
        var _this = this;
        return new Promise(function (resolve, reject) {
            var params = {
                "country_code": _this.countryCode
            };
            new GraphQL("query", "monthlyPlans", params,
                ['items{id,order,applicants,price,plan_name}, coefficient'], true, false, function () {
                    Loader.stop();
                }, function (data) {
                    if (data.items.length > 0) {
                        _this.bmic = data.coefficient;
                        _this.plans = {
                            count: data.items.length - 1,
                            items: data.items,
                        };
                        if (_this.curTmpPlan > 0) {
                            _this.updateSlider();
                        } else {
                            _this.printSlider();
                        }
                    }
                    setTimeout(function () {
                        if (business.currentData.stripe_id === '') {
                            _this.createCustomer();
                        }
                    }, 200)
                }, false).request();
            resolve();
        });
    },
    getSizes: function () {
        var _this = this;
        return new Promise(function(resolve, reject) {
            new GraphQL("query", "sizes", {},
                [ 'id, name' ], true, false, function () {
                    Loader.stop();
                }, function(sizes) {
                    $('.billing__sizes-select').html('');

                    sizes.forEach(function(size) {
                        $('<option />').text(size.name + ' ' + trans('employees')).val(size.id).appendTo('.billing__sizes-select');
                    });

                    $('.billing__sizes-select').val(business.currentData.size_id);

                    if (business.currentData.size_id == 9) {
                        $('.billing__call-us-for-a-bigger-discount').removeClass('d-none');
                    }
                }, false).request();
            resolve();
        });
    },
    getCardLists: function () {
        var _this = this;
        var params = {
            "business_id": APIStorage.read('business-id')
        };
        new GraphQL("query", "cards", params,
            ['items{id, card_brand, owner, card_last_four, is_default, expire_month, expire_year, html}'], true, false, function () {
                Loader.stop();
            }, function (data) {
                _this.HTMLDOM.cardTable.html('');
                var html = '';
                if (data.items.length > 0) {
                    _this.addCard = 0;
                    _this.HTMLDOM.lastFour.html('');
                    $.each(data.items, function (i, el) {
                        var selected = '';
                        if (el.is_default == 1) {
                            selected = 'selected';
                            _this.HTMLDOM.cardType.attr('src', location.origin + '/img/' + el.card_brand.toLowerCase() + '.png')
                        }
                        _this.HTMLDOM.lastFour.append('<option ' + selected + ' value="' + el.card_last_four + '" class="' + el.card_brand + '">xxxx xxxx xxxx ' + el.card_last_four + '</option>');
                        _this.HTMLDOM.cardTable.append(el.html);
                    });
                } else {
                    _this.addCard = 1;
                    // _this.HTMLDOM.upgradePlan.html(Langs.add_credit_card);
                }
            }, false).request();
    },
    getInvoiceLists: function () {
        var _this = this;
        var params = {
            "business_id": APIStorage.read('business-id'),
            "page": this.currentPage,
            "limit": this.limit
        };
        new GraphQL("query", "invoices", params,
            ['items{html},pages,current_page'], true, false, function () {
                Loader.stop();
            }, function (data) {
                var html = '';
                _this.HTMLDOM.invoiceTable.html('');
                if (data.items.length > 0) {
                    _this.HTMLDOM.invoiceList.removeClass('d-none');
                    $.each(data.items, function (i, el) {
                        _this.HTMLDOM.invoiceTable.append(el.html);
                    });
                    _this.countPages = data.pages;
                    _this.pagination(data.pages);
                }
            }, false
        ).request();
    },
    currentPlan: function () {
        var _this = this;
        return new Promise(function (resolve, reject) {
            if (business.currentData.plan_id > 0) {
                var params = {
                    "id": business.currentData.plan_id,
                    "business_id": APIStorage.read('business-id')
                };
                new GraphQL("query", "businessMonthlyPlan", params,
                    ['id, applicants, plan_name, price, is_canceled'], true, false, function () {
                        Loader.stop();
                    }, function (data) {
                        if (data) {
                            _this.HTMLDOM.currentPlanName.html(data.plan_name);
                            _this.HTMLDOM.sliderValue.html(data.applicants);
                            _this.planPrice = data.price;
                            _this.planApplications = data.applicants;
                            _this.curPlan = data.id;
                            resolve();
                        }
                    }, false).request();
            } else {
                resolve();
            }

        });
    },
    checkCard: function () {
        var _this = this;
        var params = {
            "business_id": APIStorage.read('business-id'),
        };
        new GraphQL("query", "card", params,
            ['id, card_brand, owner, card_last_four, is_default, expire_month, expire_year'], true, false, function () {
                Loader.stop();
            }, function (data) {
                if (data.card_last_four) {
                    _this.currentCard = data;
                    _this.HTMLDOM.chooseCard.modal('hide');
                    _this.HTMLDOM.upgradeBilling.modal('show');
                    _this.showInfoUpgrade();
                }
            }, false).request();
    },
    updateBillingInfo: function () {
        var _this = this;
        _this.HTMLDOM.billing.companyName.val(this.companyName);
        _this.HTMLDOM.billing.ownerName.val(this.ownerName);
        _this.HTMLDOM.billing.streetNumber.val(this.streetNumber);
        _this.HTMLDOM.billing.street.val(this.street);
        _this.HTMLDOM.billing.suite.val(this.suite);
        _this.HTMLDOM.billing.zipCode.val(this.zipCode);
        var locationField = _this.HTMLDOM.billingContact.find('#user-location');
        var clearLocationField = _this.HTMLDOM.billingContact.find('#user-location-clear');

        //clear location field and focus
        $('body').on('click', '#user-location-clear', function () {
            locationField.val('');
            locationField.focus();
            clearLocationField.parent().addClass('hide');
            locationField.addClass('autocomplete-border');
        });
        //autocomplete locations
        locationField.autocomplete({
            source: function (request, response) {
                if (request.term.length === 0) {
                    clearLocationField.parent().addClass('hide');
                    locationField.addClass('autocomplete-border');
                } else {
                    clearLocationField.parent().removeClass('hide');
                    locationField.removeClass('autocomplete-border');
                }
                //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler
                new GraphQL("query", "geo", {
                    "key": request.term
                }, ['fullName', 'city', 'region', 'country', 'countryCode'], false, false, function () {
                    response([]);
                }, function (data) {
                    if (data.length !== 0) {
                        var transformed = $.map(data, function (el) {
                            return {
                                label: el.fullName,
                                id: el.countryCode,
                                data: el
                            };
                        });
                        response(transformed);
                    } else {
                        _this.city = "";
                        _this.region = 0;
                        _this.country = 0;
                        _this.countryCode = 0;
                        locationField.removeClass('ui-autocomplete-loading');
                    }
                }).autocomplete();
            },
            select: function (event, ui) {
                if (_this.countryCode !== ui.item.id) {
                    _this.updateBmic(ui.item.id);
                }
                _this.city = ui.item.data.city;
                _this.region = ui.item.data.region;
                _this.country = ui.item.data.country;
                _this.countryCode = ui.item.id;
                _this.updateTax = 1;
                flag.find('i').removeClassRegex(/^bfh-flag-/);
                flag.find('i').addClass('bfh-flag-' + ui.item.id);

            },
            response: function () {
                locationField.removeClass('ui-autocomplete-loading');
            }
        }).attr('autocomplete', 'disabled').autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                .append('<span><i class="glyphicon bfh-flag-' + item.id + '"></i> </span><span>' + item.label + '</span>')
                .appendTo(ul);
        };

        var flag = _this.HTMLDOM.billingContact.find('#basic-addon1');
        flag.find('i').removeClassRegex(/^bfh-flag-/);
        flag.find('i').addClass('bfh-flag-' + this.countryCode);
        var location = this.city;
        if (this.region !== null) {
            location += "," + this.region;
        } else {
            this.error++;
        }
        if (this.country !== null) {
            location += "," + this.country;
        } else {
            this.error++;
        }
        locationField.val(location);
    },
    updateBmic: function (countryCode) {
        var _this = this;
        var params = {
            "country_code": countryCode,
            "business_id": APIStorage.read('business-id')
        };
        new GraphQL("query", "bmic", params,
            ['coefficient'], true, false, function () {
                Loader.stop();
            }, function (data) {
                _this.bmic = data.coefficient || 1;
            }, false).request();
    },
    updateShowInfo: function () {
        var _this = this;
        if (this.HTMLDOM.billing.companyName.val() !== '') {
            this.companyName = this.HTMLDOM.billing.companyName.val()
        }
        if (this.HTMLDOM.billing.ownerName.val() !== '') {
            this.ownerName = this.HTMLDOM.billing.ownerName.val();
        }
        if (this.HTMLDOM.billing.streetNumber.val() !== '') {
            this.streetNumber = this.HTMLDOM.billing.streetNumber.val();
        }
        if (this.HTMLDOM.billing.street.val() !== '') {
            this.street = this.HTMLDOM.billing.street.val();
        }
        if (this.HTMLDOM.billing.suite.val() !== '') {
            this.suite = this.HTMLDOM.billing.suite.val();
        }
        if (this.HTMLDOM.billing.zipCode.val() !== '') {
            this.zipCode = this.HTMLDOM.billing.zipCode.val();
        }
        this.setBillingAddress();
        this.showInfoUpgrade();
        if (_this.updateTax === 1) {
            _this.getTax(_this.region).then(function () {
                _this.getPlanLists().then(function () {
                    _this.printTotal();
                    _this.updateTax = 0
                })
            });
        }
    },
    showInfoUpgrade: function () {
        var _this = this;
        var plan_type = $('#upgradeBilling__payment-type-select').val();
        this.HTMLDOM.billing.companyName.val(this.companyName);
        this.HTMLDOM.billing.ownerName.val(this.ownerName);
        this.HTMLDOM.billing.streetNumber.val(this.streetNumber);
        this.HTMLDOM.billing.street.val(this.street);
        this.HTMLDOM.billing.suite.val(this.suite);
        this.HTMLDOM.billing.zipCode.val(this.zipCode);

        $(this.HTMLDOM.billingAddress[0]).html(this.companyName);
        $(this.HTMLDOM.billingAddress[1]).html(this.ownerName);
        $(this.HTMLDOM.billingAddress[2]).html(this.streetNumber + ' ' + this.street + ' ' + this.suite);
        $(this.HTMLDOM.billingAddress[3]).html(this.region + ', ' + this.city + ', ' + this.zipCode + ' PO BOX');
        $(this.HTMLDOM.billingAddress[4]).html(this.country);

        // var plan = this.plans.items[this.HTMLDOM.slider.slider("value")];

        var candidates_count_per_step = 100;
        var price_per_candidate = 0.25;

        if (window.active_pricing_strategy && window.active_pricing_strategy.candidates > 0) {
            price_per_candidate = window.active_pricing_strategy.monthly_price / window.active_pricing_strategy.candidates;
        }

        var current_count_of_candidates = parseInt($('.plan-candidates:first').text());
        current_count_of_candidates = (current_count_of_candidates < candidates_count_per_step ? 0 : current_count_of_candidates);
        var price_per_month = current_count_of_candidates * price_per_candidate;
        var price_per_year = current_count_of_candidates * price_per_candidate * 12 * 0.9;
        var price_to_upgrade = 0.0;
        var days_left_to_upgrade = 0;
        var old_count_of_candidates = parseInt($('.plan-candidates').attr('data-current-plan-candidates'));
        old_count_of_candidates = old_count_of_candidates < candidates_count_per_step ? 0 : old_count_of_candidates;
        var old_plan_id = old_count_of_candidates / candidates_count_per_step;
        var current_plan_id = current_count_of_candidates / candidates_count_per_step;
        var count_of_days_in_last_payment_period;
        var next_plan_payment_date = null;

        if (old_count_of_candidates > 0) {
            next_plan_payment_date = (function(last_payment_date, first_payment_date) {
                var some_day_of_next_date_month = null;

                if (business.currentData.plan_type == 'year') {
                    some_day_of_next_date_month = new Date(
                        last_payment_date.getFullYear() + 1,
                        last_payment_date.getMonth(),
                        1
                    );
                }
                else {
                    some_day_of_next_date_month = new Date(
                        last_payment_date.getFullYear(),
                        last_payment_date.getMonth() + 1,
                        1
                    );
                }

                var next_date = new Date(
                    some_day_of_next_date_month.getFullYear(),
                    some_day_of_next_date_month.getMonth(),
                    first_payment_date.getDate()
                );

                for (var iteration = 0; next_date.getMonth() != some_day_of_next_date_month.getMonth() && iteration < 100; ++iteration) {
                    next_date = new Date(next_date.getTime() - 86400 * 1000); // -1 day
                }

                return next_date;
            })(new Date(business.currentData.last_plan_payment_was_at || 0), new Date(business.currentData.first_plan_payment_was_at || 0));

            days_left_to_upgrade = Math.ceil((next_plan_payment_date.getTime() - Date.now()) / 1000 / 86400);

            count_of_days_in_last_payment_period = (function(date) {
                if (business.currentData.plan_type == 'year') {
                    return (
                        new Date(date.getFullYear(), 11, 31).getTime()
                        -
                        new Date(date.getFullYear(), 0, 0).getTime()
                    ) / 1000 / 86400;
                }
                
                return new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
            })(new Date(business.currentData.last_plan_payment_was_at));

            if (business.currentData.plan_type == 'year') {
                price_to_upgrade = (
                    (current_plan_id - old_plan_id)
                    *
                    candidates_count_per_step
                    *
                    price_per_candidate
                    *
                    12
                    *
                    0.9
                    /
                    count_of_days_in_last_payment_period
                    *
                    days_left_to_upgrade
                );
            }
            else {
                price_to_upgrade = (
                    (current_plan_id - old_plan_id)
                    *
                    candidates_count_per_step
                    *
                    price_per_candidate
                    /
                    count_of_days_in_last_payment_period
                    *
                    days_left_to_upgrade
                );
            }

            this.price.price = parseFloat(price_to_upgrade * (this.bmic || 1)).toFixed(2);

            // if (business.currentData.plan_type == 'year') {
            //     _this.price.price *= 0.9;
            // }

            this.price.priceTotal = this.price.price;
            $('.js-total-price-per-month').addClass('d-none');
            $('.js-total-price-per-year').addClass('d-none');
            $('.js-price-to-upgrade').removeClass('d-none');
            // $('#upgradeBilling__payment-type').addClass('d-none');
            $('#upgradeBilling__payment-type-select').prop('disabled', true);

            if (business.currentData.plan_type == 'year') {
                $('#upgradeBilling__payment-type-select').val('year');
            }
            else {
                $('#upgradeBilling__payment-type-select').val('month');
            }

            if (business.currentData.next_plan_type == 'year') {
                $('#upgradeBilling__next-payment-type-select').val('year');
            }
            else {
                $('#upgradeBilling__next-payment-type-select').val('month');
            }
        }
        else {
            if (plan_type == 'year') {
                this.price.price = parseFloat(price_per_year * (this.bmic || 1)).toFixed(2);
            }
            else {
                this.price.price = parseFloat(price_per_month * (this.bmic || 1)).toFixed(2);
            }

            this.price.priceTotal = this.price.price;

            if (plan_type == 'year') {
                $('.js-total-price-per-year').removeClass('d-none');
                $('.js-total-price-per-month').addClass('d-none');
            }
            else {
                $('.js-total-price-per-month').removeClass('d-none');
                $('.js-total-price-per-year').addClass('d-none');
            }

            $('.js-price-to-upgrade').addClass('d-none');
            // $('#upgradeBilling__payment-type').removeClass('d-none');
            $('#upgradeBilling__payment-type-select').prop('disabled', false);
        }

        var htmlDiscount = '';
        var discountAmount = 0;
        $('.js-discount').remove();

        if (this.coupon) {
            if (_this.coupon.off_an_plans_type === '$') {
                _this.price.priceTotal = (_this.price.price - _this.coupon.off_an_plans_value).toFixed(2);
                _this.price.priceTotal = parseFloat(_this.price.priceTotal) < 0 ? 0 : _this.price.priceTotal;
                discountAmount = (_this.coupon.off_an_plans_value).toFixed(2);
            }
            else {
                _this.price.priceTotal = _this.price.priceTotal - (_this.price.price * (_this.coupon.off_an_plans_value / 100)).toFixed(2);
                discountAmount = (_this.price.price * (_this.coupon.off_an_plans_value / 100)).toFixed(2);
            }

            htmlDiscount = '' +
                '<tr class="text-center js-discount">' +
                    '<td class="border p-2">' + trans('discount_code') + ' (<strong>' + _this.coupon.code + '</strong>)</td>' +
                    '<td class="border p-2">1</td>' +
                    '<td class="border p-2">-' + _this.coupon.off_an_plans_value + ' ' + _this.coupon.off_an_plans_type + '</td>' +
                    '<td class="border p-2"> -' + discountAmount + '$</td>' +
                '</tr>' +
            '';
        }

        $(this.HTMLDOM.priceDescriptionTD[0]).html(current_count_of_candidates + ' applicants');
        $(this.HTMLDOM.priceDescriptionTD[2]).html('$' + this.price.price);
        $(this.HTMLDOM.priceDescriptionTD[3]).html('$' + parseFloat(this.price.price).toFixed(2));
        this.HTMLDOM.priceDescription.after(htmlDiscount);
        this.HTMLDOM.subtotal.html('$' + parseFloat(this.price.priceTotal).toFixed(2));
        this.printTotal();
    },
    printTotal: function () {
        var _this = this;
        if (_this.HTMLDOM.tax.find('>tr').length === 3) {
            _this.HTMLDOM.tax.find('tr')[0].remove();
            _this.HTMLDOM.tax.find('tr')[0].remove();
        }
        if (_this.HTMLDOM.tax.find('>tr').length === 2) {
            _this.HTMLDOM.tax.find('tr')[0].remove();
        }
        var taxHTML = '';
        var taxprice1 = 0;
        var taxprice2 = 0;
        if (_this.tax) {
            _this.HTMLDOM.taxTable.show();
            _this.HTMLDOM.canadaTax.show();
            taxprice1 = (_this.price.priceTotal * (_this.tax.rate_1 / 100)).toFixed(2);
            taxprice2 = (_this.price.priceTotal * (_this.tax.rate_2 / 100)).toFixed(2);
            if (_this.tax.type_1 !== null) {
                taxHTML += '<tr class="text-center">' +
                    '<td></td>' +
                    '<td class="border p-2">' + _this.tax.type_1 + '</td>' +
                    '<td class="border p-2">' + _this.tax.rate_1 + '%</td>' +
                    '<td class="border p-2">' + taxprice1 + '</td>' +
                    '</tr>';
            }
            if (_this.tax.type_2 !== null) {
                taxHTML += '<tr class="text-center">' +
                    '<td></td>' +
                    '<td class="border p-2">' + _this.tax.type_2 + '</td>' +
                    '<td class="border p-2">' + _this.tax.rate_2 + '%</td>' +
                    '<td class="border p-2">' + taxprice2 + '</td>' +
                    '</tr>';
            }
            _this.HTMLDOM.tax.prepend(taxHTML);
            _this.HTMLDOM.totalPrice.html((Number(taxprice1) + Number(taxprice2) + Number(_this.price.priceTotal)).toFixed(2));
        } else {
            _this.HTMLDOM.canadaTax.hide();
            _this.HTMLDOM.taxTable.hide();
            _this.HTMLDOM.subtotalText.html('Total')
        }
        _this.price.summary = (Number(taxprice1) + Number(taxprice2) + Number(_this.price.priceTotal)).toFixed(2);
        _this.HTMLDOM.pricePerMonth.html('$' + _this.price.summary);
    },
    checkCoupon: function () {
        var _this = this;
        var params = {
            "business_id": APIStorage.read('business-id'),
            "code": _this.HTMLDOM.coupon.val()
        };
        new GraphQL("query", "checkCoupon", params,
            ['id, off_an_plans_value, off_an_plans_type, off_on_month_value, off_on_month_type, duration_value, code, token'], true, false, function () {
                Loader.stop();
            }, function (data) {
                if (data.id > 0) {
                    $.notify('Coupon successful. Update Price', 'success');
                    _this.coupon = data;
                    _this.showInfoUpgrade();
                } else {
                    $.notify('Coupon expired or does not exist', 'Warning');
                }

            }, false).request();
    },
    cancelPlan: function () {
        var createParams = {
            "business_id": APIStorage.read('business-id'),
        };
        new GraphQL("mutation", "cancelPayment", createParams, [
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            location.reload(true)
        }, false).request();
    },
    createCustomer: function () {
        var _this = this;
        var createParams = {
            "business_id": APIStorage.read('business-id'),
        };
        new GraphQL("mutation", "createCustomer", createParams, [
            'token, id'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            _this.customerID = data.id
        }, false).request();
    },
    updateSlider: function () {
        var _this = this;
        _this.HTMLDOM.slider.slider("destroy");
        _this.HTMLDOM.slider.slider({
            value: _this.curTmpPlan,
            min: 0,
            max: _this.plans.count,
            step: 1,
            slide: function (event, ui) {
                _this.HTMLDOM.sliderValue.val(" " + _this.plans.items[ui.value].applicants);
                _this.HTMLDOM.sliderPrice.html((_this.plans.items[ui.value].price * _this.bmic).toFixed(2));
                if (parseInt(_this.plans.items[ui.value].price) === 0) {
                    _this.HTMLDOM.upgradePlan.addClass('d-none');
                } else {
                    if (_this.plans.items[ui.value].id === _this.curPlan) {
                        _this.HTMLDOM.upgradePlan.addClass('d-none');
                    } else {
                        _this.HTMLDOM.upgradePlan.removeClass('d-none');
                    }
                }
                _this.curTmpPlan = ui.value;
                _this.planApplications = _this.plans.items[ui.value].applicants
                _this.planPrice = _this.plans.items[ui.value].price
            },
            create: function (event, ui) {
                if (_this.curTmpPlan > 0 && _this.canceled == 0) {
                    _this.HTMLDOM.cancelPlan.removeClass('d-none');
                }
                _this.HTMLDOM.sliderValue.val(" " + _this.plans.items[_this.HTMLDOM.slider.slider("value")].applicants);
                _this.HTMLDOM.sliderPrice.html((_this.plans.items[_this.HTMLDOM.slider.slider("value")].price * _this.bmic).toFixed(2));
                if (_this.HTMLDOM.slider.slider("value") == _this.curTmpPlan) {
                    _this.HTMLDOM.sliderPrice.html((_this.planPrice * _this.bmic).toFixed(2));
                    _this.HTMLDOM.sliderValue.val(" " + _this.planApplications);
                }
            }
        });

        setTimeout(function () {
            if (parseInt(_this.plans.items[_this.HTMLDOM.slider.slider("value")].price) === 0 ) {
                _this.HTMLDOM.upgradePlan.addClass('d-none');
            } else {
                _this.HTMLDOM.upgradePlan.removeClass('d-none');
                _this.HTMLDOM.sliderPrice.html((_this.planPrice * _this.bmic).toFixed(2));
                _this.HTMLDOM.sliderValue.val(" " + _this.planApplications);
            }
            _this.HTMLDOM.sliderValue.removeClass('d-none')
        }, 150)
    },
    printSlider: function () {
        var curTmpPlan = 0;
        var _this = this;
        $.each(_this.plans.items, function (i, el) {
            if (business.currentData.next_plan_id != 0) {
                if (el.id === business.currentData.next_plan_id) {
                    curTmpPlan = i;
                }
            } else {
                if (el.id === business.currentData.plan_id) {
                    curTmpPlan = i;
                }
            }
        });

        0 && _this.HTMLDOM.slider.slider({
            value: curTmpPlan,
            min: 0,
            max: _this.plans.count,
            step: 1,
            slide: function (event, ui) {
                _this.HTMLDOM.sliderValue.val(" " + _this.plans.items[ui.value].applicants);
                _this.HTMLDOM.sliderPrice.html((_this.plans.items[ui.value].price * _this.bmic).toFixed(2));
                if (_this.plans.items[ui.value].price == 0 || ui.value == curTmpPlan) {
                    _this.HTMLDOM.upgradePlan.addClass('d-none');
                } else {
                    _this.HTMLDOM.upgradePlan.removeClass('d-none');
                }
                _this.curTmpPlan = ui.value;
                _this.planApplications = _this.plans.items[ui.value].applicants;
                _this.planPrice = _this.plans.items[ui.value].price;
            },
            create: function (event, ui) {
                if (curTmpPlan > 0 && _this.canceled == 0) {
                    _this.HTMLDOM.cancelPlan.removeClass('d-none');
                }
                _this.HTMLDOM.sliderValue.val(" " + _this.plans.items[_this.HTMLDOM.slider.slider("value")].applicants);
                _this.HTMLDOM.sliderPrice.html((_this.plans.items[_this.HTMLDOM.slider.slider("value")].price * _this.bmic).toFixed(2));
                if (_this.HTMLDOM.slider.slider("value") == curTmpPlan) {
                    _this.HTMLDOM.sliderPrice.html((_this.planPrice * _this.bmic).toFixed(2));
                    _this.HTMLDOM.sliderValue.val(" " + _this.planApplications);
                    _this.HTMLDOM.upgradePlan.addClass('d-none');
                }
            }
        });
        setTimeout(function () {
            if (_this.plans.items[_this.HTMLDOM.slider.slider("value")].price == 0 || _this.HTMLDOM.slider.slider("value") == curTmpPlan) {
                _this.HTMLDOM.upgradePlan.addClass('d-none');
            } else {
                _this.HTMLDOM.sliderPrice.html((_this.planPrice * _this.bmic).toFixed(2));
                _this.HTMLDOM.sliderValue.val(" " + _this.planApplications);
                _this.HTMLDOM.upgradePlan.removeClass('d-none');
            }
            _this.HTMLDOM.sliderValue.removeClass('d-none')

        }, 150)
    },
    goBackToFreePlan: function() {
        var _this = this;

        if (!$('input[name="cancel-plan-phone"]').val()) {
            $('input[name="cancel-plan-phone"]').addClass('is-invalid');
            return;
        }

        var createParams = {
            "business_id": APIStorage.read('business-id'),
            "coupon_id": 0,
            "plan_id": 0,
            "cancel_plan_phone": $('input[name="cancel-plan-phone"]').val(),
            "last4": _this.HTMLDOM.lastFour.val(),
            "company_name": _this.HTMLDOM.billing.companyName.val(),
            "owner_name": _this.HTMLDOM.billing.ownerName.val(),
            "street_number": _this.HTMLDOM.billing.streetNumber.val(),
            "street": _this.HTMLDOM.billing.street.val(),
            "suite": _this.HTMLDOM.billing.suite.val(),
            "region": this.region,
            "city": this.city,
            "country": this.country,
            "zip_code": _this.HTMLDOM.billing.zipCode.val()
        };

        new GraphQL("mutation", "createPayment", createParams, [
            'token, status, html'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            if (data.status === 'paid') {
                $('#cancelModal').modal('hide');
                $.notify('Successful cancelation', 'success');

                // if (selected_plan_id > current_plan_id) {
                    setTimeout(function () {
                        location.reload(true)
                    }, 700);
                // }
            } else {
                $.notify('Payment error', 'error');
            }
        }, false).request();
    },
    pay: function () {
        var _this = this;
        var coupon_id = 0;
        if (typeof _this.coupon !== "undefined") {
            if (Object.keys(_this.coupon).length > 0) {
                coupon_id = _this.coupon.id;
            }
        }

        var candidates_count_per_step = 100;
        var selected_count_of_candidates = parseInt($('.plan-candidates:first').text());
        selected_count_of_candidates = (selected_count_of_candidates < candidates_count_per_step ? 0 : selected_count_of_candidates);
        var selected_plan_id = selected_count_of_candidates / candidates_count_per_step;
        var current_count_of_candidates = parseInt($('.plan-candidates:first').attr('data-current-plan-candidates'));
        current_count_of_candidates = (current_count_of_candidates < candidates_count_per_step ? 0 : current_count_of_candidates);
        var current_plan_id = current_count_of_candidates / candidates_count_per_step;

        var createParams = {
            "business_id": APIStorage.read('business-id'),
            "coupon_id": coupon_id,
            "plan_id": selected_plan_id,
            "last4": _this.HTMLDOM.lastFour.val(),
            "company_name": _this.HTMLDOM.billing.companyName.val(),
            "owner_name": _this.HTMLDOM.billing.ownerName.val(),
            "street_number": _this.HTMLDOM.billing.streetNumber.val(),
            "street": _this.HTMLDOM.billing.street.val(),
            "suite": _this.HTMLDOM.billing.suite.val(),
            "region": this.region,
            "city": this.city,
            "country": this.country,
            "zip_code": _this.HTMLDOM.billing.zipCode.val(),
            'plan_type': $('#upgradeBilling__payment-type-select').val(),
            'next_plan_type': $('#upgradeBilling__next-payment-type-select').val(),
        };

        new GraphQL("mutation", "createPayment", createParams, [
            'token, status, html'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            if (data.status === 'paid') {
                _this.getInvoiceLists();
                _this.HTMLDOM.upgradeBilling.modal('hide');

                if (selected_plan_id > current_plan_id) {
                    $.notify('Payment successful', 'success');
                }
                else if (selected_plan_id < current_plan_id) {
                    $.notify('Downgraded successfully', 'success');
                }

                setTimeout(function () {
                    location.reload(true)
                }, 700)
            } else {
                $.notify('Payment error', 'error');
            }
        }, false).request();
    },
    setDefault: function (id) {
        var _this = this;
        var createParams = {
            "business_id": APIStorage.read('business-id'),
            "id": id,
        };
        new GraphQL("mutation", "updateCard", createParams, [
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            _this.getCardLists();
        }, false).request();
    },
    removeCard: function (id) {
        var _this = this;
        var createParams = {
            "business_id": APIStorage.read('business-id'),
            "id": id,
        };
        new GraphQL("mutation", "deleteCard", createParams, [
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function () {
            _this.getCardLists();
        }, false).request();
    },
    setTimerCoupon: function () {
        var _this = this;
        clearTimeout(_this.checkCouponTimer);
        _this.checkCouponTimer = setTimeout(function () {
            _this.checkCoupon();
        }, 1000);
    }
};

$(document).ready(function () {
    var starting_count_of_candidates = window.active_pricing_strategy ? window.active_pricing_strategy.free_version_candidates : 10;
    var end_count_of_candidates = 50000;
    var candidates_count_per_step = 100;
    var price_per_candidate = 0.25;

    if (window.active_pricing_strategy && window.active_pricing_strategy.candidates > 0) {
        price_per_candidate = window.active_pricing_strategy.monthly_price / window.active_pricing_strategy.candidates;
    }

    loadPromise.then(function () {
        businessBilling = new BusinessBilling();
        businessBilling.init();
    }).then(function () {
        app.runPromise();
    });

    $('.js-change-plan').on('click', function () {
        $('#upgradeBilling').modal('hide');
    });

    $('.js-check-four').on('click', function () {
        businessBilling.showInfoUpgrade();
    });
    $('.js-upgrade-plan').on('click', function () {
        if (businessBilling.addCard === 0) {
            businessBilling.checkCard();
        } else {
            location.href = '/business/billing/modify';
        }
    });

    $('.js-downgrade-plan').click(function() {
        var selected_plan_count_of_candidates = parseInt($('.plan-candidates:first').text());
        selected_plan_count_of_candidates = (selected_plan_count_of_candidates < 1000 ? 0 : selected_plan_count_of_candidates);
        var selected_plan_id = Math.floor(selected_plan_count_of_candidates / 1000);

        var next_plan_payment_date = (function(last_payment_date, first_payment_date) {
            var some_day_of_next_date_month = new Date(
                last_payment_date.getFullYear(),
                last_payment_date.getMonth() + 1,
                1
            );

            var next_date = new Date(
                some_day_of_next_date_month.getFullYear(),
                some_day_of_next_date_month.getMonth(),
                first_payment_date.getDate()
            );

            for (var iteration = 0; next_date.getMonth() != some_day_of_next_date_month.getMonth() && iteration < 100; ++iteration) {
                next_date = new Date(next_date.getTime() - 86400 * 1000); // -1 day
            }

            return next_date;
        })(new Date(business.currentData.last_plan_payment_was_at), new Date(business.currentData.first_plan_payment_was_at));

        $('#downGrade-next-bill-starting-on').text('' +
            [
                "January", "February", "March", "April",
                "May", "June", "July", "August",
                "September", "October", "November", "December",
            ][next_plan_payment_date.getMonth()] + ' ' + next_plan_payment_date.getDate() + 'th, ' + next_plan_payment_date.getFullYear() +
        '');

        $('#downGrade-next-bill-price').text('$' + (selected_plan_id * candidates_count_per_step * price_per_candidate));
        $('#downGrade').modal('show');
    });

    $('#downGrade-got-it').click(function() {
        businessBilling.pay();
    });

    $('#cancelModal__confirm').click(function() {
        businessBilling.goBackToFreePlan();
    });

    $('.js-pay-stripe').on('click', function () {
        businessBilling.pay();
    });

    // Set primary card
    $('.billing-info').on('click', '.js-set-primary', function () {
        businessBilling.setDefault($(this).data('id'));
    });
    // Remove card
    $('.billing-info').on('click', '.js-removeCard', function () {
        businessBilling.removeCard($(this).data('id'));
    });
    $('.js-last-four').on('input', function () {
        $('.js-cardType').attr('src', location.origin + '/img/' + $('.js-last-four option[value="' + $(this).val() + '"]').attr('class').toLowerCase() + '.png');
    });
    $('.js-coupon').on('input', function () {
        businessBilling.setTimerCoupon();
    });

    // validation edit billing info
    $('.js-open-upgrade').on('click', function () {
        businessBilling.error = 0;
        businessBilling.HTMLDOM.billing.companyName.parent().removeClass('has-error');
        if (businessBilling.HTMLDOM.billing.companyName.val().length === 0) {
            businessBilling.HTMLDOM.billing.companyName.parent().addClass('has-error');
            businessBilling.error++;
        }
        businessBilling.HTMLDOM.billing.ownerName.parent().removeClass('has-error');
        if (businessBilling.HTMLDOM.billing.ownerName.val().length === 0) {
            businessBilling.HTMLDOM.billing.ownerName.parent().addClass('has-error');
            businessBilling.error++;
        }
        businessBilling.HTMLDOM.billing.zipCode.parent().removeClass('has-error');
        if (businessBilling.HTMLDOM.billing.zipCode.val().length === 0) {
            businessBilling.HTMLDOM.billing.zipCode.parent().addClass('has-error');
            businessBilling.error++;
        }
        businessBilling.HTMLDOM.billing.streetNumber.removeClass('is-invalid');
        if (businessBilling.HTMLDOM.billing.streetNumber.val().length === 0) {
            businessBilling.HTMLDOM.billing.streetNumber.addClass('is-invalid');
            businessBilling.error++;
        }
        businessBilling.HTMLDOM.billing.street.removeClass('is-invalid');
        if (businessBilling.HTMLDOM.billing.street.val().length === 0) {
            businessBilling.HTMLDOM.billing.street.addClass('is-invalid');
            businessBilling.error++;
        }
        $('#user-location').parent().removeClass('has-error')
        if (businessBilling.region === 0 || businessBilling.city === 0 || businessBilling.countryCode === 0) {
            businessBilling.error++;
            $('#user-location').parent().addClass('has-error')
        }

        if (businessBilling.error === 0) {
            businessBilling.updateShowInfo();
            businessBilling.HTMLDOM.billingContact.modal('hide');
            businessBilling.HTMLDOM.upgradeBilling.modal('show');
        }
    });
    
    $('.js-billingContact').on('click', function () {
        businessBilling.updateBillingInfo();
        businessBilling.HTMLDOM.billingContact.modal('show');
    });

    $('#upgradeBilling').on('hidden.bs.modal', function () {
        businessBilling.HTMLDOM.coupon.val('');
        businessBilling.updateData = true;
    });

    $('.js-close-modal-update').on('click', function () {
        businessBilling.HTMLDOM.billingContact.modal('hide');
    });

    $('.js-cancel-plan').on('click', function () {
        $('#cancelModal').modal('show');
    });

    $('#business-cancel-payment-confirm').on('click', function () {
        businessBilling.cancelPlan();
        $('#delete-button-modal').modal('hide');
    });

    $('#upgradeBilling__payment-type-select').change(function(event) {
        businessBilling.showInfoUpgrade();
        $('#upgradeBilling__next-payment-type-select').val($(this).val());
    });

    // copied from landing

    var update_candidate_price_informer = function() {
        var $plan_candidates = $('.plan-candidates:first');
        var current_count_of_candidates = parseInt($plan_candidates.attr('data-current-plan-candidates'));
        var selected_count_of_candidates = parseInt($plan_candidates.text());

        if (selected_count_of_candidates <= starting_count_of_candidates) {
            selected_count_of_candidates = starting_count_of_candidates;
        }

        $('.plan-candidates').text(selected_count_of_candidates);
        var price_per_month = 0;

        if (selected_count_of_candidates > starting_count_of_candidates) {
            price_per_month = selected_count_of_candidates * price_per_candidate;
        }

        $('.plan-price-month').text('$' + price_per_month.toFixed());
        var price_per_year = price_per_month * 12 - (price_per_month * 12 / 10);
        $('.plan-price-year').text('$' + price_per_year.toFixed());
        $('.plan-candidates__current').css('opacity', selected_count_of_candidates == current_count_of_candidates ? 1.0 : 0.0);
    };

    var update_candidate_price_informer_dependencies = function() {
        var $plan_candidates = $('.plan-candidates:first');
        var current_count_of_candidates = parseInt($plan_candidates.attr('data-current-plan-candidates'));
        var selected_count_of_candidates = parseInt($plan_candidates.text());

        if (selected_count_of_candidates > current_count_of_candidates) {
            if ($('.billing-credit-cards').children().length == 0) {
                $('.js-upgrade-plan').addClass('d-none');
                $('.js-add-creadit-card').removeClass('d-none');
            }
            else {
                $('.js-upgrade-plan').removeClass('d-none');
                $('.js-add-creadit-card').addClass('d-none');
            }

            $('.js-downgrade-plan').addClass('d-none');
            $('.js-cancel-plan').addClass('d-none');
            $('.js-plan-changes-block').removeClass('d-none');
        }
        else if (selected_count_of_candidates < current_count_of_candidates) {
            $('.js-upgrade-plan').addClass('d-none');

            if (selected_count_of_candidates <= starting_count_of_candidates) {
                $('.js-downgrade-plan').addClass('d-none');
            }
            else {
                $('.js-downgrade-plan').removeClass('d-none');
            }

            $('.js-add-creadit-card').addClass('d-none');

            if (selected_count_of_candidates <= starting_count_of_candidates) {
                $('.js-cancel-plan').removeClass('d-none');
            }
            else {
                $('.js-cancel-plan').addClass('d-none');
            }

            $('.js-plan-changes-block').removeClass('d-none');

            // $('.js-plan-changes-block').removeClass('d-none');
            // $('.js-plan-changes-block').removeClass('d-none');
        }
        else {
            $('.js-plan-changes-block').addClass('d-none');
        }
    };

    var get_size_id_candidates_per_step = function(size_id) {
        if (size_id <= 3) {
            return 100;
        }

        if (size_id <= 6) {
            return 1000;
        }

        return 2000;
    };

    $('.plan-minus').click(function(event) {
        var current_size_id = parseInt($('.billing__sizes-select').val());
        var current_count_of_candidates = parseInt($('.plan-candidates:first').text());
        current_count_of_candidates = (current_count_of_candidates <= starting_count_of_candidates ? 0 : current_count_of_candidates);

        if (current_count_of_candidates > starting_count_of_candidates) {
            current_count_of_candidates -= get_size_id_candidates_per_step(current_size_id);
            $('.plan-candidates:first').text(current_count_of_candidates);
            update_candidate_price_informer();
            update_candidate_price_informer_dependencies();
        }
    });

    $('.plan-plus').click(function(event) {
        var current_size_id = parseInt($('.billing__sizes-select').val());
        var current_count_of_candidates = parseInt($('.plan-candidates:first').text());
        current_count_of_candidates = (current_count_of_candidates <= starting_count_of_candidates ? 0 : current_count_of_candidates);

        if (current_count_of_candidates < end_count_of_candidates) {
            current_count_of_candidates += get_size_id_candidates_per_step(current_size_id);
            $('.plan-candidates:first').text(current_count_of_candidates);
            update_candidate_price_informer();
            update_candidate_price_informer_dependencies();
        }
    });

    $('.plan-candidates:first').text(business.currentData.plan_id > 0 ? business.currentData.plan_id * candidates_count_per_step : starting_count_of_candidates);

    $('.plan-candidates:first')
        .attr('data-current-plan-candidates', business.currentData.plan_id > 0 ? business.currentData.plan_id * candidates_count_per_step : starting_count_of_candidates);

    $('.billing__current-plan-value').text(business.currentData.plan_id > 0 ? business.currentData.plan_id * candidates_count_per_step : starting_count_of_candidates);
    update_candidate_price_informer();
    update_candidate_price_informer_dependencies();

    $('.billing__sizes-select').change(function() {
        var current_size_id = parseInt($(this).val());

        new GraphQL("mutation", "updateBusinessSizeId", {
            id: business.currentData.id,
            size_id: current_size_id,
        }, [ 'token' ], true, false, function() {
            Loader.stop();
        }, function(data) {
            $.notify('Business size successfully updated.', 'success');
            business.currentData.size_id = current_size_id;
            
            if (business.currentData.size_id == 9) {
                $('.billing__call-us-for-a-bigger-discount').removeClass('d-none');
            }
            else {
                $('.billing__call-us-for-a-bigger-discount').addClass('d-none');
            }

            $('.plan-candidates:first').text(starting_count_of_candidates);
            update_candidate_price_informer();
            update_candidate_price_informer_dependencies();
        }, false).request();
    });
});
