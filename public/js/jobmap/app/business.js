var pictureForm;

function Business() {
    this.data;
    this.currentID;
    this.currentData;

    this.notLoadWhenUrl = 'signup';

    this.updateForm = $('#business-profile-form');
    this.city;
    this.region;
    this.country;
    this.countryCode;
}

Business.prototype = {
    init: function () {
        if (explode(this.notLoadWhenUrl, window.location.href).length === 1) {
            if (getUrlParameter('b_id')) {
                APIStorage.create('business-id', getUrlParameter('b_id'));
                removeQueryStringParam('b_id');
            }
            if (APIStorage.read('business-id')) {
                this.currentID = APIStorage.read('business-id');
            }
            var data = localStorage.getItem('businesses');
            if (data && this.currentID) {
                this.data = JSON.parse(data) || false;
                if (this.data) {
                    //if the refresh param exist - get data from server
                    if (localStorage.getItem('business-refresh') === "1") {
                        this.get();
                        this.getCurrentData();
                    } else {
                        this.fillData();
                    }
                } else {
                    this.get();
                }
            } else {
                this.get();
            }
        }
    },
    profileInit: function () {
        var url = document.location.pathname;
        var urlData = explode('/business/profile/', url);
        if (urlData[1]) {
            if (urlData[1] === 'edit') {
                setTimeout(function () {
                    business.profile();
                }, 0);
            }
        }
    },
    profile: function () {
        Loader.init();
        var _this = this;
        var locationField = this.updateForm.find('#user-location');
        //init cropper
        new CropAvatar('business-pic-view', 'business-pic-change-btn', false, false, false);

        this.updateForm.find('input[name="name"]').val(this.currentData.name);
        this.updateForm.find('textarea[name="description"]').val(this.currentData.description);
        this.updateForm.find('input[name="website"]').val(this.currentData.website);
        this.updateForm.find('input[name="street"]').val(this.currentData.street);

        if (this.currentData.industry) {
            this.updateForm.find("#citypicker").hide();
            this.updateForm.find("#picked_city_block").show();
            this.updateForm.find(".city_location_new").val(this.currentData.industry).attr('data-id', this.currentData.industry_id);
        }
        if (this.currentData.picture) {
            this.updateForm.find('.business-pic-view img').attr('src', this.currentData.picture);
        }

        this.city = this.currentData.city;
        this.region = this.currentData.region;
        this.country = this.currentData.country;
        this.countryCode = this.currentData.country_code;

        var flag = this.updateForm.find('#basic-addon1');
        flag.find('i').removeClassRegex(/^bfh-flag-/);
        flag.find('i').addClass('bfh-flag-' + this.countryCode);
        var location = this.city;
        if (this.region !== null) {
            location += "," + this.region;
        }
        if (this.country !== null) {
            location += "," + this.countryCode;
        }
        locationField.val(location);
        $('#business-signup-preview-career').attr('href', '/business/view/' + this.currentData.id + '/' + this.currentData.name);
        //clear location field and focus
        this.updateForm.find('#user-location-clear').click(function () {
            locationField.val('');
            locationField.focus();
        });
        //autocomplete locations
        locationField.autocomplete({
            source: function (request, response) {
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
                _this.city = ui.item.data.city;
                _this.region = ui.item.data.region;
                _this.country = ui.item.data.country;
                _this.countryCode = ui.item.id;
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

        this.updateForm.on('keyup', 'input, textarea', function () {
            FormValidate.fieldValidateClear($(this));
        });

        this.updateForm.on('click', '#business-profile-update', function () {
            _this.update();
        });

        var timeout = null;
        this.updateForm.on("keyup", "#citypicker", function (e) {
            if (e.which <= 90 && e.which >= 48 || e.which === 13 || e.which === 8) {
                var value = $(this).val().toLowerCase().trim();
                if (value.length > 1) {
                    clearTimeout(timeout);
                    $("#citypicker_list").css("display", "block");
                    timeout = setTimeout(function () {
                        _this.getCategories(value);
                    }, 500);
                } else {
                    $("#citypicker_list").css("display", "none");
                }
            }
        });
        this.updateForm.on('blur', '#citypicker', function () {
            if (!$(this).val()) {
                $("#citypicker_list").css("display", "none");
            }
        });

        this.updateForm.on('click', ".citypickeritem", function () {
            // var div_citypicker = $(this).find(".input_citypicker");
            var element = $(this);
            var category = element.find("#left_category_block .category").html();
            var subcategory = element.find("#right_subcategory_block .subcategory").html();

            $("#citypicker").hide();
            $("#picked_city_block").show();
            $(".city_location_new").val(category + " - " + subcategory).attr('data-id', $(this).attr('data-id'));
            $("#citypicker_list").css("display", "none");
            // $(".delete").html();
        });

        this.updateForm.on('click', '.input_citypicker button.delete', function () {
            $("#picked_city_block").hide();
            $("#citypicker").val("");
            $("#citypicker").show();
        });
    },
    getCategories: function (keywords) {
        var params = {};
        if (keywords) {
            params['keywords'] = keywords;
        }
        new GraphQL("query", "industryCategories", params, [
            'industry {\n' +
            '      id\n' +
            '      name\n' +
            '    }',
            '    categories{\n' +
            '      id\n' +
            '      name\n' +
            '    }'
        ], false, false, function (data) {
            //show error
        }, function (data) {
            if (data) {
                var html = '';
                $.map(data, function (item) {
                    var industry = item.industry;
                    $.map(item.categories, function (category) {
                        html += '<a href="javascript:void(0)" class="list-group-item list-group-item-action citypickeritem" data-id="' + category.id + '">\n' +
                            '           <div class="float-left" id="left_category_block">\n' +
                            '               <span class="category">' + industry.name + '</span>\n' +
                            '               <p class="mb-0">\n' +
                            '                   <small>'+Langs.category+'</small>\n' +
                            '               </p>\n' +
                            '           </div>\n' +
                            '           <div class="float-right" id="right_subcategory_block">\n' +
                            '               <span class="subcategory">' + category.name + ' ' + industry.name + '</span>\n' +
                            '               <p class="mb-0">\n' +
                            '                   <small>'+Langs.subcategory+'</small>\n' +
                            '               </p>\n' +
                            '           </div>\n' +
                            '       </a>';
                    });
                });
                $('#cityitems').html(html);
            }
        }).request($('#cityitems'));
    },
    fillCurrentData: function () {
        this.currentData = localStorage.getItem('c_b');
        if (!this.currentData) {
            this.getCurrentData();
        } else {
            this.currentData = JSON.parse(this.currentData);
            if (this.currentData.id === this.currentID) {
                //fill
                $('#menu-business-name').text(this.currentData.name);
                $('#menu-business-picture').attr('src', this.currentData.picture_100);
            } else {
                this.getCurrentData();
            }
        }
    },
    fillData: function () {
        this.fillCurrentData();
        if (this.data.length !== 0) {
            var id = 0;
            $.map(this.data, function (item) {
                var html = '<li>\n' +
                    '    <a href="javascript:void(0)" class="profile-switcher switch-to-business" data-business="' + item.id + '">\n' +
                    '        <div class="business-list-icon">\n' +
                    '            <img class="business-image" src="' + item.picture_50 + '">\n' +
                    '        </div> ' + item.name + '</a>\n' +
                    '</li>';
                $('#business-list').prepend(html);
                id++;
            });
            $('#business-switcher').attr('data-business', this.data[id - 1].id);
            this.profileInit();
        }
    },
    update: function () {
        var _this = this;
        var formData = pictureForm;
        var typeQuery = 'updateBusiness';
        var params = {
            "id": _this.currentID,
            "name": FormValidate.getFieldValue('name', _this.updateForm),
            "description": FormValidate.getFieldValue('description', _this.updateForm),
            "industry_id": +_this.updateForm.find('.city_location_new').attr('data-id'),
            "street": FormValidate.getFieldValue("street", _this.updateForm),
            "website": FormValidate.getFieldValue("website", _this.updateForm),
            "city": _this.city,
            "region": _this.region,
            "country": _this.country,
            "country_code": _this.countryCode
        };
        var needParams = ['token'];
        //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
        new GraphQL("mutation", typeQuery, params, needParams, true, false, function () {
            Loader.stop();
        }, function () {
            _this.refresh();
            setTimeout(function () {
                window.location.href = '/business/profile/edit';
            }, 0);
        }, _this.updateForm, formData).request();
    },
    get: function () {
        var _this = this;
        new GraphQL("query", "businesses", {}, [
            'id',
            'name',
            'picture_50(width:50, height:50)',
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            _this.set(data);
        }, false).request();
    },
    getCurrentData: function () {
        var _this = this;
        new GraphQL("query", "business", {
            "id": _this.currentID
        }, [
            'id',
            'name',
            'description',
            'industry_id',
            'industry',
            'website',
            'street',
            'city',
            'region',
            'country',
            'country_code',
            'picture(width:200, height:200)',
            'picture_50(width:50, height:50)',
            'picture_100(width:100, height:100)'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            var d = data;
            delete d.token;
            localStorage.setItem('c_b', JSON.stringify(d));
            _this.fillCurrentData();
        }, false).request();
    },
    //save all params for user to local storage
    set: function (data) {
        if (data) {
            if (data[0].id) {
                this.data = data;
                for (var i = 0; i < this.data.length; i++) {
                    delete this.data[i].token;
                }
                localStorage.removeItem('business-refresh');
                localStorage.setItem('businesses', JSON.stringify(this.data));
                if (!APIStorage.read('business-id')) {
                    var id = data[0].id;
                    APIStorage.create('business-id', id);
                    this.currentID = id;
                } else {
                    this.currentID = APIStorage.read('business-id');
                }
                this.fillData();
            }
        }
    },
    refresh: function () {
        localStorage.setItem('business-refresh', "1");
    },
    logout: function () {
        //remove all api cookies
        APIStorage.remove('business-id');
        //clear business data from local storage
        localStorage.removeItem('businesses');
    }
};