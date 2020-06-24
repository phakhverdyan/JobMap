window.modals = {};

window.modals.location_qr_code = function(options) {
    var location = options.location;
    var location_scan_url = window.location.origin + '/scan/' + location.id;

    if (!window.modals.location_qr_code.qr_code) {
        var $qr_code = $('#location-qr-code-modal').find('.modal__qr-code');
        window.modals.location_qr_code.qr_code = new QRCode($qr_code[0], {
            text: location_scan_url,
            width: 458,
            height: 458,
        });
    } else {
        window.modals.location_qr_code.qr_code.clear();
        window.modals.location_qr_code.qr_code.makeCode(location_scan_url);
    }

    $('#location-qr-code-modal').modal('show');
};

// ---------------------------------------------------------------------- //

var request = function(options, callback) {
    // examples of usage:
    // - request('query', 'login', { email: '', password: '' }, [ 'token' ], callback); // <--- GraphQL request
    // - request({ method: 'GET', data: { param: 1 } }, callback); // <--- REST API request to /api endpoint by default

    if (Array.isArray(options)) {
        options = { many: options, parallel: true };
    }

    if (typeof options == 'string') {
        return (function(type, name, data, params, callback) {
            data = data || {};

            if (typeof data == 'string') {
                data = data.split(/&/).map(function(part) {
                    part = part.split(/=/);
                    var part_name = part[0];
                    var part_value = decodeURIComponent(part[1]);
                    part = {};
                    part[part_name] = part_value;
                    return part;
                }).reduce(function(data, part) {
                    return Object.assign(data, part);
                }, {});
            }

            var query = '';
            query += type;
            query += ' { ';
            query += name;

            if (Object.keys(data).length > 0) {
                query += ' (' + Object.keys(data).map(function(key) {
                    return key + ': ' + JSON.stringify(data[key]);
                }).join(', ') + ')';
            }

            query += ' { ';

            if (Array.isArray(params)) {
                query += params.join(', ');
            } else {
                query += params;
            }

            query += ' }';
            query += ' }';

            return request({
                root: '/graphql',
                url: '',
                method: 'POST',

                data: {
                    query: query,
                },
            }, function(response) {
                response.data = response.data[name];
                return callback(response);
            });
        }).apply(null, arguments);
    }

    if (options.many) {
        var responses = {};
        var requests = options.many;
        
        if (options.parallel) {
            return requests.map(function(options, request_index) {
                return request(options, function(response) {
                    responses[request_index] = response;

                    if (Object.keys(responses).length < requests.length) {
                        return;
                    }

                    responses.length = requests.length;
                    return callback.apply(null, Array.prototype.slice.call(responses));
                });
            });
        }

        return request({
            url: '/',

            data: {
                requests: requests.map(function(request) {
                    if (typeof request == 'string') {
                        request = { url: request };
                    }

                    var query_string = $.param(request.data || {});
                    return request.url + (query_string ? '?' + query_string : '');
                }),
            },
        }, function(response) {
            return callback.apply(null, response.responses);
        });
    }

    var data = null;

    if (typeof options.data == 'string') {
        data = options.data;

        if (Array.isArray(options.fields) && options.fields.length > 0) {
            if (data) {
                data += '&';
            }

            data += '@=' + options.fields;
        }
    } else if (options.data instanceof FormData) {
        data = options.data;
    } else {
        data = {};
        options.data && Object.assign(data, options.data);

        if (Array.isArray(options.fields) && options.fields.length > 0) {
            Object.assign(data, { '@': options.fields });
        }
    }

    if (typeof options == 'string') {
        options = { url: options };
    }

    options.root = (options.root === undefined ? '/api' : options.root);
    options.url = options.url.replace(/\/{2,}/, '/').replace(/^\//, '');

    return $.ajax({
        method: (options.method || 'GET'),
        dataType: options.dataType || null,
        url: (
            options.root
            +
            (options.url && options.url[0] != '/' ? '/' : '')
            +
            options.url
            // +
            // (window.user && window.user.api_token ? '?api_token=' + window.user.api_token : '')
        ),

        data: data,

        beforeSend: function(request) {
            var cookies = {};

            document.cookie.split(/;/).forEach(function(cookie) {
                cookie = cookie.trim().split(/=/);
                cookies[cookie[0]] = cookie[1];
            });

            if (options.root == '/graphql' && cookies['api-token']) {
                request.setRequestHeader('Authorization', 'Bearer ' + cookie[1]);
            }

            if (options.root == '/api' && window.auth) {
                request.setRequestHeader('Authorization', 'Basic ' + window.auth.user.api_token);
            }

            if (cookies['CSRF-TOKEN']) {
                request.setRequestHeader('X-CSRF-Token', cookies['CSRF-TOKEN']);
            }
        },
    }).done(function(response, textStatus, xhr) {
        // var error = response.error || response.exception;

        if (response.error && response.error != 'Validation') {
            return callback && callback(response);
        }

        return callback && callback(response);
    }).fail(function(xhr) {
        if (xhr.statusText == 'abort') {
            return;
        }

        var response = xhr.responseJSON || null;

        if (response && response.error) {
            return callback && callback(response);
        }
        
        if (response && response.exception) {
            return callback && callback(Object.assign({
                error: 'INTERNAL_ERROR',
            }, response));
        }

        console.error(xhr.responseJSON);
        $.notify('Server error: ' + xhr.status, 'error');
    });
};

// ---------------------------------------------------------------------- //

$(document).ready(function () {
    var elem;
    $(".form-tab-menu button:not('#tabs-show-all')").on('click', function (e) {
        e.preventDefault();
        elem = $(this).parent();
        if (!user.clickSaveStep) {
            $('#confirmContinueModal').modal('show');
            e.stopPropagation();
        } else {
            user.clickSaveStep = true;
            elem.siblings('.active').removeClass("active");
            elem.addClass("active");

            var index = elem.index();
            $(".form-tab-content").removeClass("active");
            $(".form-tab-content").eq(index).addClass("active");
        }
    });
    $("#confirm-continue-submit").on('click', function () {
        user.clickSaveStep = true;
        elem.find('button').click();
        /*elem.siblings('.active').removeClass("active");
        elem.addClass("active");

        var index = elem.index();
        $(".form-tab-content").removeClass("active");
        $(".form-tab-content").eq(index).addClass("active");*/
    });

    // From jobmap
    $(".form-tab-menu button").click(function(e) {
        e.preventDefault();
        var elem = $(this).parent();
        elem.siblings('.active').removeClass("active");
        elem.addClass("active");

        var index = elem.index();
        $(".form-tab-content").removeClass("active");
        $(".form-tab-content").eq(index).addClass("active");
    });

    // From jobmap
    // $('.thumbnail').on('click', function () {
    //     $('.fade-fast').slideToggle();
    // });
});

// From jobmap
// OPEN & CLOSE MAP FILTER
$(document).ready(
    function () {
        $('.open_jmFilter').on('click', function () {
            $('.jobmap_filter').toggle({ direction: "left" }, 500);
            $('.open_jmFilter').toggle();
        });
    });

$(document).ready(
    function () {
        $('.close_jmFilter').on('click', function () {
            $('.jobmap_filter').toggle({ direction: "right" }, 500);
            $('.open_jmFilter').delay(500).fadeToggle();
        });
    });
// /OPEN & CLOSE MAP FILTER

// From jobmap
// OPEN & CLOSE MAP LOCATION
$(document).ready(
    function () {
        $('.open_mapObject').on('click', function () {
            $('.jobmap_object_view').toggle({ direction: "right" }, 500);
        });
    });

$(document).ready(
    function () {
        $('.close_mapObject').on('click', function () {
            $('.jobmap_object_view').toggle({ direction: "left" }, 500);
        });
    });

// /OPEN & CLOSE MAP LOCATION

 $( function() {
    $( "#sortable" ).sortable({
        revert: true,
        update : function(event, ui) {
            cropBG.updateSortURLs();
        }
    });
    $( "#draggable" ).draggable({
      connectToSortable: "#sortable",
      helper: "clone",
      revert: "invalid"
    });
    $( "ul, li" ).disableSelection();
  } );


$(function () {
    $("#skill-slider-range-min").slider({
        range: "min",
        value: 50,
        min: 0,
        max: 100,
        step: 1,
        slide: function (event, ui) {
            $("#skill-slider-amount").html(ui.value + "%");
        }
    });
    $("#skill-slider-amount").html($("#skill-slider-range-min").slider("value") + "%");

    $("#language-slider-range-min").slider({
        range: "min",
        value: 50,
        min: 0,
        max: 100,
        step: 1,
        slide: function (event, ui) {
            $("#language-slider-amount").html(ui.value + "%");
        }
    });
    $("#language-slider-amount").html($("#language-slider-range-min").slider("value") + "%");


    $("#sk_skill-slider-range-min").slider({
        range: "min",
        value: 50,
        min: 0,
        max: 100,
        step: 1,
        slide: function (event, ui) {
            $("#sk_skill-slider-amount").html(ui.value + "%");
        }
    });
    $("#sk_skill-slider-amount").html($("#sk_skill-slider-range-min").slider("value") + "%");

    $("#l_language-slider-range-min").slider({
        range: "min",
        value: 50,
        min: 0,
        max: 100,
        step: 1,
        slide: function (event, ui) {
            $("#l_language-slider-amount").html(ui.value + "%");
        }
    });
    $("#l_language-slider-amount").html($("#l_language-slider-range-min").slider("value") + "%");
});

$(function () {
    $("#hourly_salary").slider({
        range: true,
        min: 5,
        max: 60,
        values: [5, 60],
        change: function (event, ui) {
            $("#amount_salary").val(ui.values[0] + "h - " + ui.values[1] + "h");
        },
        slide: function (event, ui) {
            $("#amount_salary").val(ui.values[0] + "h - " + ui.values[1] + "h");
        }
    });
    $("#amount_salary").val($("#hourly_salary").slider("values", 0) +
        "h - " + $("#hourly_salary").slider("values", 1) + "h");

    $("#c_hourly_salary").slider({
        range: true,
        min: 5,
        max: 60,
        values: [5, 60],
        change: function (event, ui) {
            $("#c_amount_salary").val(ui.values[0] + "h - " + ui.values[1] + "h");
        },
        slide: function (event, ui) {
            $("#c_amount_salary").val(ui.values[0] + "h - " + ui.values[1] + "h");
        }
    });
    $("#c_amount_salary").val($("#c_hourly_salary").slider("values", 0) +
        "h - " + $("#c_hourly_salary").slider("values", 1) + "h");
});

$(function () {
    $("#hr").slider({
        value: 10,
        min: 0,
        max: 1500,
        step: 10,
        slide: function (event, ui) {
            $("#hr_value").val(" " + ui.value);
        }
    });
    $("#hr_value").val(" " + $("#hr").slider("value"));
});

$(function () {
    $("#loc_num").slider({
        value: 100,
        min: 0,
        max: 500,
        step: 50,
        slide: function (event, ui) {
            $("#locnum_value").val(" " + ui.value);
        }
    });
    $("#locnum_value").val(" " + $("#loc_num").slider("value"));
});

$(function () {
    $('body').tooltip({
        selector: '[data-toggle="tooltip"]'
    });
    // $('[data-toggle="tooltip"]').tooltip()
});

$("#active-table .cell").on('click', function () {
    var element = $(this);
    if (element.hasClass('active-cell')) {
        element.removeClass('active-cell')
    } else {
        element.addClass('active-cell')
    }
});

// SELECT2
// from jobmap
$(document).ready(function() {
    if ($(".js-example-basic-single").length > 0) {
        $(".js-example-basic-single").select2({
            dropdownParent: $("#edit-button-modal")
        });
    }
});

// SELECT2
$(document).ready(function () {
    // $(".js-example-basic-single").select2({
    //         dropdownParent: $("#edit-button-modal")
    // });
});

// From jobmap
$(function () {
    $('body').tooltip({
        selector: '[data-toggle="tooltip"]'
    });
    // $('[data-toggle="tooltip"]').tooltip()
});


$(document).ready(
    function () {
        $('#icon_search').on('click', function () {
            $('#div_search').slideToggle();
        });
    });

$(document).ready(
    function () {
        if($('.sidebar_adaptive').css('display') == 'none')
        {
            $('.thumbnail-user').on('click', function () {
                $('.fade-fast-adaptive-user').slideToggle();
            });
        }
        else
        {
            $('.thumbnail-user').on('click', function () {
                $('.user-fade-fast').slideToggle();
            });
        }
    });

$(document).ready(
    function () {
        if($('.sidebar_adaptive').css('display') == 'none')
        {
            $('.thumbnail-business').on('click', function () {
                $('.fade-fast-adaptive-business').slideToggle();
            });
        }
        else
        {
            $('.thumbnail-business').on('click', function () {
                $('.business-fade-fast').slideToggle();
            });
        }
    });

$(document).ready(
    function () {
        $('#icon_search_location').on('click', function () {
            $('#div_search_location').slideToggle();
        });
    });

$(document).ready(
    function () {
        $('#icon_search_job').on('click', function () {
            $('#div_search_job').slideToggle();
        });
    });


$(document).ready(
    function () {
        $('#accord_button').on('click', function () {
            // $('#accordion_effect').slideToggle();
            //console.log("test");
        });
    });


$(document).ready(
    function(){
        $('.avatar_hover').hover(function(){
            $('.avatar_edit_icon').toggle();
            return false;
        });
    });

$(document).ready(
    function(){
        $('.plus_icon').click(function(){
            business.saveIntegrationToggle();
            $(this).parent().next('div').slideToggle();
            $(this).toggleClass('collapsed');
            return false;
        });

        $('.widget_job_open').click(function(){
            $('.widget_view_job').slideToggle();
        });

        $('.close_crWidget-job').click(function(){
            $('.widget_view_job').slideToggle();
        });
    });

$(document).ready(
    function(){
        $('.faq_title').click(function(){
            $(this).parent().find('.faq_description').slideToggle();
            return false;
        });
    });

$(document).ready(
    function(){
        $('.collapse_connect').click(function(){
            $('.advanced_guides').slideToggle();
            $(this).find('.toggle_arrow').toggleClass('collapsed');
            return false;
        });

        $('.collapse_candidates').click(function(){
            $('.candidates_menu').slideToggle();
            $(this).find('.toggle_arrow').toggleClass('collapsed');
            return false;
        });

        $('.collapse_career').click(function(){
            $('.career_menu').slideToggle();
            $(this).find('.toggle_arrow').toggleClass('collapsed');
            return false;
        });
    });

$(document).ready(
    function(){
        $('.plus_icon_thumb').click(function(){
            $(this).parent().next('div').slideToggle();
            $(this).toggleClass('collapsed');
            $('.business-fade-fast').toggleClass('fade-fast-forBigHeight');
            return false;
        });
    });
// SWITCH ADVANCED AND BASIC
$(document).ready(
    function(){
        $('.plus_icon_title').click(function(){
            business.saveIntegrationToggle();
            $(this).hide();
            $('.simple_guide').hide();
            $(this).parent().next('div').slideToggle();
            $(this).next('.plus_icon').toggleClass('collapsed');
            return false;
        });
    });

//

$(document).ready(
    function(){
        $('.business_switch_caret').click(function(){
            $(this).parent().find('.switcher_to_business').slideToggle();
            return false;
        });
        $('.business_switch').click(function(){
            $('.switcher_to_business').slideToggle();
            return false;
        });
        $('.switcher_name').click(function(){
            $('.switcher_to_business').slideToggle();
            return false;
        });
    });

$(document).scroll(function () {
    var y = $(this).scrollTop();
    if (y > 55) {
        $('.topbar_save_skip').fadeIn();
    } else {
        $('.topbar_save_skip').fadeOut();
    }
});


$(document).mouseup(function(e)
{
    var business_list = $(".business-list-outclick");
    var thumbnail_menu = $(".fade-fast");

    if (!business_list.is(e.target) && business_list.has(e.target).length === 0)
    {
        business_list.hide();
    }
    if (!thumbnail_menu.is(e.target) && thumbnail_menu.has(e.target).length === 0)
    {
        thumbnail_menu.hide();
    }
});

$(document).ready(
    function () {
        if ($('.business-fade-fast').height() > 1200) {
            //console.log("more");
            $('.business-fade-fast').addClass('fade-fast-forBigHeight');
        }
        else{
            //console.log("less");
            $('.business-fade-fast').removeClass('fade-fast-forBigHeight');
        }
    });


// LESS MORE DISCRIPTION
$(document).ready(
    function () {
        $('.more_less').click(function(){
            var more_less = $(this);
            var pre_discription = more_less.parent().find('.pre_discription');
            pre_discription.toggleClass('discription_cut');
            if (pre_discription.hasClass("discription_cut")) {
                more_less.html(trans('more').toLowerCase());
            } else {
                more_less.html(trans('less').toLowerCase());
            }
        });
    });

// From jobmap
$(document).ready(
    function () {

        $(document).on('click', '#tab-opened-jobs', function() {
            if (!$(this).hasClass('business_tabs')) {
                $(this).addClass('business_tabs');
                $('#tab-closed-jobs').removeClass('business_tabs');
                $('#block-opened-jobs').removeClass('hide');
                $('#block-closed-jobs').addClass('hide');
            }
        });

        $(document).on('click', '#tab-closed-jobs', function() {
            if (!$(this).hasClass('business_tabs')) {
                $(this).addClass('business_tabs');
                $('#tab-opened-jobs').removeClass('business_tabs');
                $('#block-closed-jobs').removeClass('hide');
                $('#block-opened-jobs').addClass('hide');
            }
        });

        let urlParams = new URLSearchParams(window.location.search);
        let openedJobs = $('#tab-opened-jobs');
        let closedJobs = $('#tab-closed-jobs');

        let openedCount = openedJobs.data('items-count');
        let closedCount = closedJobs.data('items-count');

        if (urlParams.has('jobs_tab')) {
            let requestedTab = urlParams.get('jobs_tab');
            if (requestedTab == 'opened') {
                openedJobs.click();
            }
            if (requestedTab == 'closed') {
                closedJobs.click();
            }
        } else {
            if (openedCount > closedCount || closedCount == openedCount) {
                openedJobs.click();
            }

            if (closedCount > openedCount) {
                closedJobs.click();
            }
        }
    });

setInterval(function() {
    $('.email_confirm_push.active').removeClass('animated bounce').delay(1000).queue(function(next) {
      $(this).addClass('animated bounce');
      next();
    });
}, 5000);

$(document).ready(function() {
    $('#no-click').on('click mousedown mouseup mouseleave touchend touchstart', function (e) {
        e.preventDefault();
        return false;
    });
});


$(document).ready(function() {
    $('.show-sign-up').on('click', function () {
        $('#signUpModal').modal('show');
    });
});
