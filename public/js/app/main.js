//create jquery method for remove class by regexp
$.fn.removeClassRegex = function (regex) {
    return this.removeClass(function (index, classes) {
        return classes.split(/\s+/).filter(function (c) {
            return regex.test(c);
        }).join(' ')
    });
};
$(document).on('show.bs.modal', function()
{
    $('nav, .container-fluid').css('filter','blur(4px)');
});
$(document).on('hidden.bs.modal', function()
{
    $('nav, .container-fluid').css('filter','none');
});	
Array.prototype.remove = function () {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};

function getBaseURL() {
    return document.location.origin;
}

String.prototype.replaceAll = function (search, replace) {
    return this.split(search).join(replace);
};

function formatDate(date) {

    var day = date.getDate();
    var month = date.getMonth();
    var year = date.getFullYear();

    if (day < 10) {
        day = '0' + day;
    }
    if (month < 10) {
        month = '0' + (month + 1)
    }

    return [
        day,
        month,
        year
    ];
}

function setLocationURL(type, param) {
    var url = getBaseURLFotMap() + '/map/';
    var delimiter = '+';
    switch (type) {
        case 'country':
            url += 'country/' + param.country;
            break;
        case 'city':
            url += 'city/' + param.city + delimiter + param.country;
            break;
        case 'region':
            url += 'region/' + param.region + delimiter + param.country;
            break;
        case 'street':
            url += 'street/' + param.street + delimiter + param.city + delimiter + param.country;
            break;
        case 'address':
            url += 'address/' + param.street_number + delimiter + param.street + delimiter + param.city + delimiter + param.country;
            break;
    }

    return url;
}

function auto_replacer(str) {
    var replacer = {
        '&lt;': '', '&gt;': '', '&#039;': '', '&amp;': '',
        '&quot;': '', 'À': 'A', 'Á': 'A', 'Â': 'A', 'Ã': 'A', 'Ä': 'Ae',
        '&Auml;': 'A', 'Å': 'A', 'Ā': 'A', 'Ą': 'A', 'Ă': 'A', 'Æ': 'Ae',
        'Ç': 'C', 'Ć': 'C', 'Č': 'C', 'Ĉ': 'C', 'Ċ': 'C', 'Ď': 'D', 'Đ': 'D',
        'Ð': 'D', 'È': 'E', 'É': 'E', 'Ê': 'E', 'Ë': 'E', 'Ē': 'E',
        'Ę': 'E', 'Ě': 'E', 'Ĕ': 'E', 'Ė': 'E', 'Ĝ': 'G', 'Ğ': 'G',
        'Ġ': 'G', 'Ģ': 'G', 'Ĥ': 'H', 'Ħ': 'H', 'Ì': 'I', 'Í': 'I',
        'Î': 'I', 'Ï': 'I', 'Ī': 'I', 'Ĩ': 'I', 'Ĭ': 'I', 'Į': 'I',
        'İ': 'I', 'Ĳ': 'IJ', 'Ĵ': 'J', 'Ķ': 'K', 'Ł': 'L', 'Ľ': 'K',
        'Ĺ': 'K', 'Ļ': 'K', 'Ŀ': 'K', 'Ñ': 'N', 'Ń': 'N', 'Ň': 'N',
        'Ņ': 'N', 'Ŋ': 'N', 'Ò': 'O', 'Ó': 'O', 'Ô': 'O', 'Õ': 'O',
        'Ö': 'Oe', '&Ouml;': 'Oe', 'Ø': 'O', 'Ō': 'O', 'Ő': 'O', 'Ŏ': 'O',
        'Œ': 'OE', 'Ŕ': 'R', 'Ř': 'R', 'Ŗ': 'R', 'Ś': 'S', 'Š': 'S',
        'Ş': 'S', 'Ŝ': 'S', 'Ș': 'S', 'Ť': 'T', 'Ţ': 'T', 'Ŧ': 'T',
        'Ț': 'T', 'Ù': 'U', 'Ú': 'U', 'Û': 'U', 'Ü': 'Ue', 'Ū': 'U',
        '&Uuml;': 'Ue', 'Ů': 'U', 'Ű': 'U', 'Ŭ': 'U', 'Ũ': 'U', 'Ų': 'U',
        'Ŵ': 'W', 'Ý': 'Y', 'Ŷ': 'Y', 'Ÿ': 'Y', 'Ź': 'Z', 'Ž': 'Z',
        'Ż': 'Z', 'Þ': 'T', 'à': 'a', 'á': 'a', 'â': 'a', 'ã': 'a',
        'ä': 'ae', '&auml;': 'ae', 'å': 'a', 'ā': 'a', 'ą': 'a', 'ă': 'a',
        'æ': 'ae', 'ç': 'c', 'ć': 'c', 'č': 'c', 'ĉ': 'c', 'ċ': 'c',
        'ď': 'd', 'đ': 'd', 'ð': 'd', 'è': 'e', 'é': 'e', 'ê': 'e',
        'ë': 'e', 'ē': 'e', 'ę': 'e', 'ě': 'e', 'ĕ': 'e', 'ė': 'e',
        'ƒ': 'f', 'ĝ': 'g', 'ğ': 'g', 'ġ': 'g', 'ģ': 'g', 'ĥ': 'h',
        'ħ': 'h', 'ì': 'i', 'í': 'i', 'î': 'i', 'ï': 'i', 'ī': 'i',
        'ĩ': 'i', 'ĭ': 'i', 'į': 'i', 'ı': 'i', 'ĳ': 'ij', 'ĵ': 'j',
        'ķ': 'k', 'ĸ': 'k', 'ł': 'l', 'ľ': 'l', 'ĺ': 'l', 'ļ': 'l',
        'ŀ': 'l', 'ñ': 'n', 'ń': 'n', 'ň': 'n', 'ņ': 'n', 'ŉ': 'n',
        'ŋ': 'n', 'ò': 'o', 'ó': 'o', 'ô': 'o', 'õ': 'o', 'ö': 'oe',
        '&ouml;': 'oe', 'ø': 'o', 'ō': 'o', 'ő': 'o', 'ŏ': 'o', 'œ': 'oe',
        'ŕ': 'r', 'ř': 'r', 'ŗ': 'r', 'š': 's', 'ù': 'u', 'ú': 'u',
        'û': 'u', 'ü': 'ue', 'ū': 'u', '&uuml;': 'ue', 'ů': 'u', 'ű': 'u',
        'ŭ': 'u', 'ũ': 'u', 'ų': 'u', 'ŵ': 'w', 'ý': 'y', 'ÿ': 'y',
        'ŷ': 'y', 'ž': 'z', 'ż': 'z', 'ź': 'z', 'þ': 't', 'ß': 'ss',
        'ſ': 'ss', 'ый': 'iy', 'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G',
        'Д': 'D', 'Е': 'E', 'Ё': 'YO', 'Ж': 'ZH', 'З': 'Z', 'И': 'I',
        'Й': 'Y', 'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O',
        'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U', 'Ф': 'F',
        'Х': 'H', 'Ц': 'C', 'Ч': 'CH', 'Ш': 'SH', 'Щ': 'SCH', 'Ъ': '',
        'Ы': 'Y', 'Ь': '', 'Э': 'E', 'Ю': 'YU', 'Я': 'YA', 'а': 'a',
        'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo',
        'ж': 'zh', 'з': 'z', 'и': 'i', 'й': 'y', 'к': 'k', 'л': 'l',
        'м': 'm', 'н': 'n', 'о': 'o', 'п': 'p', 'р': 'r', 'с': 's',
        'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'c', 'ч': 'ch',
        'ш': 'sh', 'щ': 'sch', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e',
        'ю': 'yu', 'я': 'ya'
    };


    for (i = 0; i < str.length; i++) {
        if (replacer[str[i].toLowerCase()] != undefined) {

            if (str[i] == str[i].toLowerCase()) {
                replace = replacer[str[i].toLowerCase()];
            } else if (str[i] == str[i].toUpperCase()) {
                replace = replacer[str[i].toLowerCase()].toUpperCase();
            }

            str = str.replace(str[i], replace);
        }
    }
    return str;

}

function slug(title, separator) {
    if(typeof separator == 'undefined') separator = '-';

    // Convert all dashes/underscores into separator
    var flip = separator == '-' ? '_' : '-';
    title = title.replace(flip, separator);

    // Remove all characters that are not the separator, letters, numbers, or whitespace.
    title = title.toLowerCase()
        .replace(new RegExp('[^a-z0-9' + separator + '\\s]', 'g'), '');

    // Replace all separator characters and whitespace by a single separator
    title = title.replace(new RegExp('[' + separator + '\\s]+', 'g'), separator);

    return title.replace(new RegExp('^[' + separator + '\\s]+|[' + separator + '\\s]+$', 'g'),'');
}

function explode(delimiter, string) {	// Split a string by string
    var emptyArray = {0: ''};

    if (arguments.length != 2
        || typeof arguments[0] == 'undefined'
        || typeof arguments[1] == 'undefined') {
        return null;
    }

    if (delimiter === ''
        || delimiter === false
        || delimiter === null) {
        return false;
    }

    if (typeof delimiter == 'function'
        || typeof delimiter == 'object'
        || typeof string == 'function'
        || typeof string == 'object') {
        return emptyArray;
    }

    if (delimiter === true) {
        delimiter = '1';
    }

    return string.toString().split(delimiter.toString());
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

//Function used to remove querystring
function removeQueryStringParam(key) {
    var urlValue = document.location.href;

    //Get query string value
    var searchUrl = location.search;

    if (key != "") {
        var oldValue = getUrlParameter(key);
        var removeVal = key + "=" + oldValue;
        if (searchUrl.indexOf('?' + removeVal + '&') != "-1") {
            urlValue = urlValue.replace('?' + removeVal + '&', '?');
        }
        else if (searchUrl.indexOf('&' + removeVal + '&') != "-1") {
            urlValue = urlValue.replace('&' + removeVal + '&', '&');
        }
        else if (searchUrl.indexOf('?' + removeVal) != "-1") {
            urlValue = urlValue.replace('?' + removeVal, '');
        }
        else if (searchUrl.indexOf('&' + removeVal) != "-1") {
            urlValue = urlValue.replace('&' + removeVal, '');
        }
    }
    else {
        urlValue = urlValue.replace(location.search, '');
    }
    history.pushState({state: 1, rand: Math.random()}, '', urlValue);
}

function updateQueryStringParam(key, value) {
    var baseUrl = [location.protocol, '//', location.host, location.pathname].join(''),
        urlQueryString = document.location.search,
        newParam = key + '=' + value,
        params = '?' + newParam;

    // If the "search" string exists, then build params from it
    if (urlQueryString) {
        var keyRegex = new RegExp('([\?&])' + key + '[^&]*');

        // If param exists already, update it
        if (urlQueryString.match(keyRegex) !== null) {
            params = urlQueryString.replace(keyRegex, "$1" + newParam);
        } else { // Otherwise, add it to end of query string
            params = urlQueryString + '&' + newParam;
        }
    }
    window.history.replaceState({}, "", baseUrl + params);
}

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
}

function findObjectByKey(array, key, value) {
    for (var i = 0; i < array.length; i++) {
        if (array[i][key] === value) {
            return array[i];
        }
    }
    return null;
}

function findObjectIndexByKey(array, key, value) {
    for (var i = 0; i < array.length; i++) {
        if (array[i][key] === value) {
            return i;
        }
    }
    return null;
}

// AJAX Activity Indicator

var Loader = (function() {
    var Loader = function(type) {
        this.type = (type == 'GLOBAL' ? 'GLOBAL' : 'INLINE');
        Loader.list.push(this);
        Loader.update();

        this.destroy = function() {
            Loader.list.splice(Loader.list.indexOf(this), 1);
            Loader.update();
        };
    };

    Loader.$global = null;
    Loader.$inline = null;
    Loader.list = [];

    Loader.init = function() {
        if (!Loader.$global) {
            Loader.$global = $('' +
                '<div class="global-loader">' +
                    '<div class="global-loader-spin"></div>' +
                '</div>' +
            '').prependTo('body');
        }

        if (!Loader.$inline) {
            Loader.$inline = $('' +
                // '<div class="inline-loader">' +
                //     '<div class="loader-spin"></div>' +
                // '</div>' +

                '<div class="inline-loader" mode="indeterminate">' +
                    '<svg class="inline-loader-background inline-loader-element" focusable="false" height="5" width="100%">' +
                        '<defs>' +
                            '<pattern height="5" patternUnits="userSpaceOnUse" width="10" x="5" y="0" id="inline-loader-0">' +
                                '<circle cx="2.5" cy="2.5" r="2.5"></circle>' +
                            '</pattern>' +
                        '</defs>' +
                        '<rect height="100%" width="100%" fill="url(#inline-loader-0)"></rect>' +
                    '</svg>' +
                    '<div class="inline-loader-buffer inline-loader-element"></div>' +
                    '<div class="inline-loader-primary inline-loader-fill inline-loader-element" style="transform: scaleX(0);"></div>' +
                    '<div class="inline-loader-secondary inline-loader-fill inline-loader-element"></div>' +
                '</div>' +
            '').prependTo('body');
        }

        Loader.update();
    };

    // Loader.create = function() {
    //     new Loader();
    // };

    Loader.globalCount = function() {
        return Loader.list.filter(function(loader) {
            return loader.type == 'GLOBAL';
        }).length;
    };

    Loader.inlineCount = function() {
        return Loader.list.filter(function(loader) {
            return loader.type == 'INLINE';
        }).length;
    };

    Loader.update = function() {
        if (Loader.globalCount() > 0) {
            Loader.$global && Loader.$global.addClass('active');
        }
        else {
            Loader.$global && Loader.$global.removeClass('active');
        }

        if (Loader.inlineCount() > 0) {
            Loader.$inline && Loader.$inline.addClass('active');
        }
        else {
            Loader.$inline && Loader.$inline.removeClass('active');
        }
    };

    Loader.start = function() {
        console.warn(new Error('[Loader.start] DEPRECATED'));
    };

    Loader.stop = function() {
        console.warn(new Error('[Loader.stop] DEPRECATED'));
    };

    return Loader;
})();

var LoaderDSBLD = new function() {
    this.using_points = [];

    this.init = function() {
        if ($('body').children('.loader').length == 0) {
            $('body').prepend('' +
                '<div class="loader show">' +
                    '<div class="loader-spin"></div>' +
                '</div>' +
            '');
        }
    };

    this.update = function() {
        if (this.count_of_using_points > 0) {
            //
        }
    };

    this.increase = function() {
        ++this.count_of_using_points;
        this.update();
    };

    this.decrease = function() {
        --this.count_of_using_points;
        this.update();
    };
};

var LoaderDSBLD = new function() {
    //default css class for displaying loader
    this.startClass = 'show';
    //loader css container class
    this.loaderClass = '.loader';
    this.contentLoader = false;
    this.loaderToElement;
    this.count_of_using_points = 0;

    this.init = function() {
        if ($('body').find('.loader').length === 0) {
            $('body').prepend('' +
                '<div class="loader">' +
                    '<div class="loader-spin"></div>' +
                '</div>' +
            '');
        }
    };

    this.disabled = false;

    //show loader layout
    this.start = function (toElement, after, replace) {
        ++this.count_of_using_points;
        // alert('START: ' + this.count_of_using_points);

        if (this.disabled) {
            return;
        }

        if (toElement) {
            this.contentLoader = true;
            this.loaderToElement = toElement;
            if (toElement.find('.items-loading').length === 0) {
                var html = '<div class="items-loading"></div>';
                if (replace) {
                    if (toElement.is('input, textarea, select')) {
                        toElement.after(html);
                        toElement.hide();
                    } else {
                        toElement.html(html);
                    }
                } else {
                    if (after) {
                        toElement.append(html);
                    } else {
                        toElement.prepend(html);
                    }
                }
            }
        } else {
            this.contentLoader = false;
            if (!$(this.loaderClass).hasClass(this.startClass)) {
                // $(this.loaderClass).addClass(this.startClass);
            }
        }
    };
    //hide loader layout
    this.stop = function () {
        --this.count_of_using_points;
        // alert('STOP: ' + this.count_of_using_points);

        if (this.disabled) {
            return;
        }

        if (this.contentLoader) {
            this.loaderToElement.find('.items-loading').remove();
            if (this.loaderToElement.is('input, textarea, select')) {
                this.loaderToElement.parent().find('.items-loading').remove();
                this.loaderToElement.show();
            }
        } else {
            $(this.loaderClass).removeClass(this.startClass);
        }
    };
}();

function ignoreCityGeoPage() {
    var ignorePages = [
        '/business/signup',
        '/business/branch/add',
    ];

    return $.inArray(document.location.pathname, ignorePages) === -1;
}

//Get geolocation info by IP
var GEO = new function () {
    var self = this;
    this.ip;
    this.city;
    this.country;
    this.countryCode;
    this.region;
    this.latitude;
    this.longitude;
    this.org;
    this.init = function () {
        jQuery(function () {
            //use only for user signup form
            if ($('#sign-up-user-form').length != 0 || $('#candidate_add-form').length != 0) {
                // IP-API.com Geolocation API
                $.ajaxSetup({
                    headers: false,
                    url: "http://ip-api.com/json",
                    data: false
                });
                $.get("http://ip-api.com/json", function (response) {
                    if (response) {
                        if (response.status == "success") {
                            self.ip = response.query;
                            self.city = response.city;
                            self.country = response.country;
                            self.countryCode = response.countryCode;
                            self.region = response.regionName;
                            self.latitude = response.lat;
                            self.longitude = response.lon;
                            self.org = response.org;

                            if (ignoreCityGeoPage()) {
                                $('input[name="city"]').val(self.fullLocation());

                                userCity = response.city;
                                userRegion = response.regionName;
                                userCountry = response.country;
                                userCountryCode = response.countryCode;
                                $('#basic-addon1').find('i').removeClassRegex(/^bfh-flag-/);
                                $('#basic-addon1').find('i').addClass('bfh-flag-' + self.countryCode);
                                $('.basic-addon1').find('i').removeClassRegex(/^bfh-flag-/);
                                $('.basic-addon1').find('i').addClass('bfh-flag-' + self.countryCode);
                                currentCity = self.city;
                                currentRegion = self.region;
                                currentCountry = self.country;
                                currentCountryCode = self.countryCode;
                                currentLocation = self.fullLocation();
                            } else {
                                $('input[name="city"]').val('');
                                $('#basic-addon1').find('i').removeClassRegex(/^bfh-flag-/);
                                $('.basic-addon1').find('i').removeClassRegex(/^bfh-flag-/);
                            }

                        }
                    }
                }, "json");
            }
        });
    };
    this.initAcademy = function (form) {
        jQuery(function () {
            //use only for user signup form
            if (form.length != 0) {
                // IP-API.com Geolocation API
                $.ajaxSetup({
                    headers: false,
                    url: "http://ip-api.com/json",
                    data: false
                });
                $.get("http://ip-api.com/json", function (response) {
                    if (response) {
                        if (response.status == "success") {
                            self.ip = response.query;
                            self.city = response.city;
                            self.country = response.country;
                            self.countryCode = response.countryCode;
                            self.region = response.regionName;
                            self.latitude = response.lat;
                            self.longitude = response.lon;
                            self.org = response.org;

                            $('input[name="city"]').val(self.fullLocation());
                            userCity = response.city;
                            userRegion = response.regionName;
                            userCountry = response.country;
                            userCountryCode = response.countryCode;
                            form.find('#basic-addon1').find('i').removeClassRegex(/^bfh-flag-/);
                            form.find('#basic-addon1').find('i').addClass('bfh-flag-' + self.countryCode);
                        }
                    }
                }, "json");
            }
        });
    };
    /**
     * Get location string
     * return (City, Region, Country)
     * @returns {string}
     */
    this.fullLocation = function () {
        var arr = [auto_replacer(self.city), auto_replacer(self.region), auto_replacer(self.country)];
        return arr.join(',');
    }
};

function hardReset() {
    //remove all api cookies
    // APIStorage.remove('api-token');
    APIStorage.remove('api-user');
    //clear user data from local storage
    localStorage.removeItem('user');
    //remove all api cookies
    APIStorage.remove('business-id');
    //clear business data from local storage
    localStorage.removeItem('businesses');
    APIStorage.remove("user_social_data");
}

function getBaseURLFotMap() {
    // var url = "http://jobmap.co";

    // if (document.location.origin === "https://devx.cloudresume.com") {
    //     url = "https://devx.jobmap.co";
    // }
    // else if (document.location.origin === "http://cloudresume.dv") {
    //     url = "http://jobmap.dv";
    // }

    return document.location.origin;
}

/**
 * GraphQL Client
 * @param buildSchema
 * @param typeQuery
 * @param paramsQuery
 * @param needParamsFromResponse
 * @param headers
 * @param redirectTo
 * @param errorHandler
 * @param successHandler
 * @param form
 * @param objectData
 * @constructor
 */
function GraphQL(buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form, objectData) {
    this.buildSchema = buildSchema;
    this.typeQuery = typeQuery;
    this.paramsQuery = paramsQuery;
    this.needParamsFromResponse = needParamsFromResponse;
    this.headers = headers;
    this.redirectTo = redirectTo;
    this.errorHandler = errorHandler;
    this.successHandler = successHandler;
    this.form = form;
    this.objectsData = objectData;

    this.token = false;

    this.notAuthURL = [
        'business/view'
    ];
}

//
GraphQL.prototype.autocomplete = function () {
    var paramsString = "";

    $.each(this.paramsQuery, function (k, v) {
        if (paramsString) {
            paramsString += ', ';
        }

        paramsString += k + ": " + JSON.stringify(v);
    });

    var headersParams = {};
    headersParams["Language"] = localStorage.getItem('language');
    //set Token to headers
    if (this.headers) {
        // headersParams = {
        //     "Authorization": "Bearer " + APIStorage.read('api-token')
        // };
        headersParams["Authorization"] = "Bearer " + APIStorage.read('api-token');
    }
    var success = this.successHandler;
    var err = this.errorHandler;
    var query = this.typeQuery;

    var requestString = this.buildSchema + " { " + this.typeQuery;

    if (paramsString !== "") {
        requestString += "(" + paramsString + ") ";
    }

    requestString += "{ " + this.needParamsFromResponse.join(" ") + " } } ";

    $.ajax({
        url: '/graphql?query=' + requestString,
        headers: headersParams,
        dataType: 'json',
        type: 'POST',
        processData: false,
        contentType: false,

        success: function(response) {
            var data = response.data[query];
            success(data);
        },

        error: function(data) {
            err(data);
        }
    });
};

GraphQL.prototype.checkAuthURL = function () {
    var auth = true;
    var url = document.location.pathname;

    for (var i = 0; i < this.notAuthURL.length; i++) {
        var urlData = explode(this.notAuthURL[i], url);
        if (urlData[1]) {
            auth = false;
        }
    }

    return auth;
};

GraphQL.prototype.sessionReset = function () {
    APIStorage.remove('api-token');
    APIStorage.remove('api-user');
    APIStorage.remove('business-id');
    localStorage.removeItem('user');
    localStorage.removeItem('businesses');
};

// Send request to server

GraphQL.prototype.request = function(options) {
    options = (options === undefined) ? {} : options;
    // options.disable_loader
    // options.use_global_loader

    var paramsString = "";

    $.each(this.paramsQuery, function (k, v) {
        if (paramsString) {
            paramsString += ', ';
        }

        paramsString += k + ": " + JSON.stringify(v);
    });

    var token = APIStorage.read('api-token');
    var headersParams = {};
    headersParams["Language"] = localStorage.getItem('language');
    //set Token to headers

    if (this.headers) {
        headersParams["Authorization"] = "Bearer " + token;
    }

    var _this = this;
    var success = this.successHandler;
    var err = this.errorHandler;
    var query = this.typeQuery;
    var redirect = this.redirectTo;
    var form = this.form;
    var data = this.objectsData;
    var xhr = null;
    var loader = null;

    var requestString = this.buildSchema + " { " + this.typeQuery;

    if (paramsString !== "") {
        requestString += "(" + paramsString + ") ";
    }

    requestString += "{ " + this.needParamsFromResponse.join(" ") + " } } ";

    if (!this.headers || (this.headers && token.length !== 0)) {
        if (data) {
            $.ajaxSetup({
                async: (query === 'business' || query === 'businesses' || query === 'me') ? false : true,
                url: '/graphql?query=' + requestString,
                data: data,
                headers: headersParams,
                dataType: 'json',
                type: 'POST',
                processData: false,
                contentType: false
            });
        }
        else {
            $.ajaxSetup({
                async: (query === 'business' || query === 'businesses' || query === 'me') ? false : true,
                url: '/graphql',
                data: JSON.stringify({"query": requestString}),
                headers: headersParams,
                dataType: 'json',
                type: 'POST',
                contentType: 'application/json'
            });
        }

        xhr = $.ajax({
            beforeSend: function() {
                //clear all error fields
                FormValidate.fieldsValidateClear(form);

                if (!options.disable_loader) {
                    loader = new Loader(options.use_global_loader ? 'GLOBAL' : 'INLINE');
                }

                // Loader.start(loaderToElement, after, replace);
            },
            success: function(response) {
                if (response.data === null && typeof response.errors === 'undefined') {
                    _this.sessionReset();
                    window.location.href = "/";
                }

                var data = response.data;
                var errors = response.errors;
                var validations;
                //refresh jwt token

                if (data !== null) {
                    data = response.data[query];
                    if (data !== null) {
                        var d = data;
                        if (d[0] !== undefined) {
                            d = d[0];
                        }
                        if (d.token !== undefined) {
                            if (d.token !== null) {
                                APIStorage.create('api-token', d.token);
                            }
                        }
                    }
                }

                if (errors) {
                    if (errors[0].validation) {
                        //get errors from server response
                        validations = errors[0].validation;
                        //show fields error
                        FormValidate.fieldsValidate(validations, form);
                        err(data);
                    } else {
                        $.notify(errors[0].message, 'error');
                        console.log(errors);
                    }
                }
                else {
                    if (redirect) {
                        window.location.href = redirect;
                    } else {
                        var first_name;
                        if (data) {
                            if (data.first_name) {
                                first_name = data.first_name;
                            }
                        }

                        success(data, (data) ? first_name : null);
                    }
                }

                loader && loader.destroy();
                // Loader.stop();
            },
            error: function (data) {
                // Loader.stop();
                loader && loader.destroy();
                err(data);
                console.log(data);
            },
            statusCode: {
                403: function () {
                    if (_this.checkAuthURL()) {
                        _this.sessionReset();
                        // Loader.stop();
                        loader && loader.destroy();
                        window.location.href = "/";
                    }
                },
                500: function () {
                    // Loader.stop();
                    loader && loader.destroy();
                    $.notify('Server error!', 'error');
                }
            }
        });
    }

    return xhr;
};

//Validate form fields
var FormValidate = new function () {
    var self = this;
    //For this fields show only error style without error message
    this.exception = [
        //'city',
        'gender',
        'social',
        'social_id',
        'user_pic',
        'user_pic_original',
        'region',
        'country',
        'country_code',
        'industries',
        'industry_id',
        'sub_industry_id',
        'categories',
        'category_id',
        'sub_category_id'
    ];
    /**
     * Show validate errors by keys
     * @param args
     * @param form
     */
    this.fieldsValidate = function (args, form) {
        $.each(args, function (k, v) {
            form.find('*[name="' + k + '"]').parent().addClass('has-error');
            form.find('*[data-field-name="' + k + '"]').find('.form-group').addClass('has-error');

            if ($.inArray(k, self.exception) == -1) {
                if (form.find('*[name="' + k + '"]').parent().hasClass('input-group')) {
                    form.find('*[name="' + k + '"]').parent().after('<p class="field-error-text">' + v + '</p>');
                } else {
                    form.find('*[name="' + k + '"]').after('<p class="field-error-text">' + v + '</p>');
                }
                form.find('*[data-field-name="' + k + '"]').after('<p class="field-error-text">' + v + '</p>');
            } else if (k === 'industry_id' || k === 'industries' || k === 'category_id' || k === 'categories') {
                form.find('#' + k).parent().addClass('has-error');
            }
        });

        //Scroll form to first error
        var firstErrorElement = $('.has-error:first');
        var topElement = $('html, body');
        if (firstErrorElement.parents('.modal').length !== 0) {
            topElement = firstErrorElement.parents('.modal');
        }
        topElement.animate({
            scrollTop: firstErrorElement.offset().top - 100
        }, 200);
    };
    //remove all errors in current form
    this.fieldsValidateClear = function (form) {
        $(form).find('.field-error-text').remove();
        $(form).find('.has-error').removeClass('has-error');
    };
    //remove errors for current field
    this.fieldValidateClear = function (field) {
        var errorFiedlsClass = '.field-error-text';
        $(field).next(errorFiedlsClass).remove();
        $(field).parent().next(errorFiedlsClass).remove();
        $(field).parent().parent().next(errorFiedlsClass).remove();
        $(field).parent().removeClass('has-error');
        $(field).parent().parent().removeClass('has-error');
    };
    /**
     * Get full date by month and year fields
     * @param month
     * @param year
     * @param form
     * @returns {string}
     */
    this.getFieldDateMonthYear = function (month, year, form) {
        month = this.getFieldValue(month, form);
        year = this.getFieldValue(year, form);
        if (month !== "" && year !== "") {
            return year + "-" + month + "-01";
        }

        return "";
    };
    /**
     * Get field value by name
     * @param name
     * @returns {*|jQuery}
     */
    this.getFieldValue = function (name, form) {
        if (form) {
            /*if (name === 'industries') {
                return form.find('*[name="' + name + '"]').val();
            }*/
            return (form.find('*[name="' + name + '"]').val()) ? form.find('*[name="' + name + '"]').val().trim() : form.find('*[name="' + name + '"]').val();
        }
        if (name === 'industries') {
            return $('*[name="' + name + '"]').val();
        }
        return ($('*[name="' + name + '"]').val()) ? $('*[name="' + name + '"]').val().trim() : $('*[name="' + name + '"]').val();
    };
    /**
     * Get checkbox value
     * @param name
     * @param form
     * @returns {*}
     */
    this.getCheckedFieldValue = function (name, form) {
        if (form) {
            if (form.find('*[name="' + name + '"]:checked').val()) {
                return form.find('*[name="' + name + '"]:checked').val();
            } else {
                return "0";
            }
        }
        if ($('*[name="' + name + '"]:checked').val()) {
            return $('*[name="' + name + '"]:checked').val();
        } else {
            return "0";
        }
    };
}();

var delete_cookie = function(name) {
    document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
};

//Create, read and remove cookie by key
window.APIStorage = window.APIStorage || new function () {
    var self = this;
    this.create = function (name, value, days) {
        var expires = "";
        var date = new Date();
        var d = (days) ? days : 90;
        date.setTime(date.getTime() + (d * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
        // var domain = window.location.hostname.split(/\./).slice(-2).join('.');
        var domain = window.location.hostname.split(/\./).join('.');
        // document.cookie = name + "=''" + expires + "; Domain=" + domain + "; path=/";
        // delete_cookie(name);
        document.cookie = name + "=" + value + expires + "; Domain=" + domain + "; path=/";
    };
    this.read = function (name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }

        //use jt
        if (typeof jt !== "undefined" && name === 'api-token') {
            this.create('api-token', jt);
            this.remove('jt');
            return jt;
        }
        return null;
    };
    this.remove = function (name) {
        self.create(name, "", -1);
    };
    //set user data to cookie
    this.setToken = function (data) {
        self.create('api-token', data.token);
        self.create('api-user', data.first_name);
    };
}();

var Social = new function () {
    var self = this;
    this.token;
    this.provider;
    this.facebookAuth = function (response) {
        self.provider = 'facebook';
        if (response.status === 'connected') {
            //user is authorized
            self.token = response.authResponse.accessToken;
            self.auth();
        } else {
            //user is not authorized
            FB.login(function (response) {
                if (response.authResponse) {
                    //user just authorized your app
                    self.token = response.authResponse.accessToken;
                    self.auth();
                }
            }, {scope: 'email,public_profile', return_scopes: true});
        }
    };
    this.googleAuth = function () {
        self.provider = 'google';
        gapi.auth2.getAuthInstance().signIn().then(
            function (success) {
                // Login API call is successful
                self.token = success.Zi.access_token;
                self.auth();
            },
            function (error) {
                // Error occurred
                // console.log(error) to find the reason
            }
        );
    };
    this.auth = function () {
        var type = window.location.pathname.slice(1);//'student';
        if (type.length == 0) {
            type = 'student';
        }
        new GraphQL("query", "loginSocial", {
            client: self.token,
            provider: self.provider,
            type : type
        }, [
            'token',
            'last_active_business',
            'redirect',
            'social_user_data {' +
            'id ' +
            'first_name ' +
            'last_name ' +
            'email ' +
            'birthday ' +
            'gender ' +
            'userpic ' +
            'userpic_original ' +
            'social ' +
            'id ' +
            'token' +
            '}'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            hardReset();
            if (data.last_active_business) {
                APIStorage.create('business-id', data.last_active_business);
            }
            if (data.social_user_data) {
                APIStorage.create("user_social_data", JSON.stringify(data.social_user_data));
            }
            if (['teacher','director'].indexOf(window.location.pathname)!=-1) {
                window.location.href = window.location.pathname + '/signup?social=facebook';
            }
            if (data.token) {
                if ( typeof sR !== "undefined") {
                    if (sR.businessID) {
                        APIStorage.setToken(data);
                        setTimeout(function () {
                            $('#signUpModal').modal('hide');
                            app.init();
                            sR.send(sR.btnClickSend);
                        }, 300);
                        $('#signInModal').modal('hide');
                    } else {
                        $('#signInModal').modal('hide');
                        location.reload();
                    }
                } else if (data.redirect) {
                    setTimeout(function () {
                        window.location.href = data.redirect;
                    }, 300);
                }
            } else {
                if ($('#signInModal').is(':visible')) {
                    $('#signInModal').modal('hide');
                    //$('#signUpModal').modal('show');
                }
                if ($('#signUpModal').length > 0) {
                    $('#signUpModal').modal('show');
                }
                setTimeout(function () {
                    if ($('#signUpModal').is(':visible')) {
                        setUserSocialDataToForm();
                    } else if (data.redirect) {
                        setTimeout(function () {
                            window.location.href = data.redirect;
                        }, 300);
                    }
                }, 300);
            }
        }).request();
    };
}();
var Base64 = {
    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
    encode: function (input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        input = Base64._utf8_encode(input);

        while (i < input.length) {

            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output + this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) + this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

        }

        return output;
    },


    decode: function (input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;

        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

        while (i < input.length) {

            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));

            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;

            output = output + String.fromCharCode(chr1);

            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }

        }

        output = Base64._utf8_decode(output);

        return output;

    },

    _utf8_encode: function (string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },

    _utf8_decode: function (utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while (i < utftext.length) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }

};


$(document).ready(function () {

    if (!APIStorage.read('api-token')) {
        new GraphQL("query", "languages", {}, [
            'id',
            'name',
            'prefix'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            if (data) {
                var lang = APIStorage.read('language');
                if ($('.footer__change-language').length >0) {
                    data.forEach(function(language) {
                        $('.footer__change-language').append('<option value="'+ language.prefix +'">'+ language.name +'</option>');
                    });
                    let lang = '';
                    if (lang = APIStorage.read('language')) {
                        $('.footer__change-language').val(lang);
                    }

                    $('.footer__change-language').change(function () {
                        let lang = $(this).val();
                        APIStorage.create('language',lang);
                        setTimeout(function () {
                            window.location.reload();
                        }, 200);
                    });
                }
            }
        }, false).request();
    }

    $('#avatar-input-btn').on('click', function () {
        $('#avatar-input').click();
    });
    $('#business-bg-input-btn').on('click', function () {
        $('#business-bg-input').click();
    });
    $('#login-button').on('click', function () {
        logInUser();
    });

    $('#signin-form input').keypress(function(e) {
        console.log(e.which);
        if (e.which == 13) {
            logInUser();
        }
    });

    function logInUser() {
        var form = $('#signin-form');
        new GraphQL("query", "login", {
            email: FormValidate.getFieldValue('email', form),
            password: FormValidate.getFieldValue('password', form)
        }, [
            'token',
            'last_active_business',
            'redirect'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            // hardReset();
            //if (data.redirect && !($('#signInModal').is(':visible'))) {
            if (data.redirect) {
                setTimeout(function () {
                    Loader.stop();
                    window.location.href = data.redirect;
                }, 500);
            }
        }, form).request();
    }

    $('#show_reset_password').on('click', function () {
        var form = $('#resetPasswordModal'),
            modal = $('#signInModal'),
            resetPasswordResponse = $('#resetPasswordResponseModal');
        form.find('input').val('');
        resetPasswordResponse.fadeOut();
        modal.modal('hide');
    });

    $('#reset-password-button').on('click', function () {
        var form = $('#resetPasswordModal'),
            resetPasswordResponse = $('#resetPasswordResponseModal');
        new GraphQL("query", "resetPassword", {
            email: FormValidate.getFieldValue('email', form)
        }, [
            'response',
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            Loader.stop();
            resetPasswordResponse.fadeIn();
        }, form).request();
    });

    $('#change-password-form').on('submit', function (e) {
        e.preventDefault();
        var form = $('#change-password-form');
        new GraphQL("mutation", "changePassword", {
            password: FormValidate.getFieldValue('password', form),
            confirm_password: FormValidate.getFieldValue('confirm_password', form),
            id: form.find('[name="id"]').val()
        }, [
            'token',
            'redirect'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            //APIStorage.setToken(data);
            APIStorage.create('api-token',data.token);
            if (data.redirect) {
                setTimeout(function () {
                    Loader.stop();
                    window.location.href = data.redirect;
                }, 500);
            }
        }, form).request();
    });

    $('#send-reference-form').on('submit', function (e) {
        e.preventDefault();
        var form = $('#send-reference-form');
        new GraphQL("mutation", "sendReference", {
            message: FormValidate.getFieldValue('message', form),
            id: form.find('[name="id"]').val()
        }, [
            'token',
            'redirect'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            if (data.redirect) {
                setTimeout(function () {
                    Loader.stop();
                    window.location.href = data.redirect;
                }, 500);
            }
        }, form).request();
    });
    $('#send-reference-form textarea').keyup(function () {
        FormValidate.fieldValidateClear($(this));
    });

    $('.resend-verification-code').click(function () {
        new GraphQL("query", "resendVerificationCode", {}, [
            'token',
            'response'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            $('#verificationCodeGoTime').modal('hide');
        }, false).request();
    });

    $('#send-verification-code').click(function () {
        var form = $('#anotherEmail');
        new GraphQL("mutation", "sendVerificationCode", {
            id : user.data.id,
            email: FormValidate.getFieldValue('email', form)
        }, [
            'token',
            'response'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            $('#anotherEmail').modal('hide');
        }, form).request();
    });

    $('.facebook-auth').on('click', function () {
        FB.getLoginStatus(function (response) {
            Social.facebookAuth(response);
        });
    });

    $('.google-auth').on('click', function () {
        Social.googleAuth();
    });

    $('#sendContactUsSend').click(function () {
        let form = $('#sendContactUsForm'),
            modalPopup = $('#sendContactUsModal');

        new GraphQL("mutation", "sendContactUs", {
            language: $('.message-language.active input').val(),
            type: $('.message-type.active input').val(),
            subject: FormValidate.getFieldValue('subject', form),
            email: FormValidate.getFieldValue('email', form),
            phone: FormValidate.getFieldValue('phone', form),
            full_name: FormValidate.getFieldValue('full_name', form),
            message: FormValidate.getFieldValue('message', form)
        }, [
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
                $('.message-language.active').removeClass('active');
                $('.message-language').eq(0).addClass('active');
                $('.message-type.active').removeClass('active');
                $('.message-type').eq(0).addClass('active');
            }
        }, form).request();
    });
    $('#sendContactUsForm').on('click', 'input, textarea', function () {
        FormValidate.fieldValidateClear($(this));
    });

    $('.btn-change-language').click(function () {
        let lang = $(this).attr('data-language');
        APIStorage.create('language',lang);
        setTimeout(function () {
            window.location.reload();
        }, 200);
    });

    $('#show-sign-in').on('click', function () {
        sR.clear();
    });

    $('#show-sign-in-too').click(function () {
        if ($(this).attr('data-user')=='1') {
            window.location.href = '/';
        } else {
            $('#show-sign-in').click();
        }
    });

    //--search in navbar
    var saarchEl = $('#nav-search');
    if (saarchEl.length > 0) {
        var locale = APIStorage.read('language');
        saarchEl.autocomplete({
            source: function (request, response) {

                new GraphQL("query", "getDataSearch", {
                    "key": request.term,
                    "locale": locale
                }, [
                    'id',
                    'title'
                ], false, false, function () {
                    response([]);
                }, function (data) {
                    if (data) {
                        var transformed = $.map(data, function (el) {
                            return {
                                label: el.title,
                                id: el.id,
                                data: el
                            };
                        });
                        response(transformed);
                    } else {
                        response([]);
                        saarchEl.removeClass('ui-autocomplete-loading');
                    }
                }).autocomplete();
            },
            response: function (e, u) {
                saarchEl.removeClass('ui-autocomplete-loading');
            }
        }).attr('autocomplete', 'disabled');

        $('#nav-search-btn').click(function () {
            if (saarchEl.val().length > 0) {
                var url = getBaseURLFotMap() + '/search?title=' + saarchEl.val();
                window.location.href = url;
                //var url = window.location.protocol + window.location.host + '/search?title=' + saarchEl.val();
                //window.open(url,'_blank');
            }
        });
    }

});
