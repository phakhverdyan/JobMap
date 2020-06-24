var data;
(function (funcName, baseObj) {
    "use strict";
    // The public function name defaults to window.docReady
    // but you can modify the last line of this function to pass in a different object or method name
    // if you want to put them in a different namespace and those will be used instead of
    // window.docReady(...)
    funcName = funcName || "docReady";
    baseObj = baseObj || window;
    var readyList = [];
    var readyFired = false;
    var readyEventHandlersInstalled = false;

    // call this when the document is ready
    // this function protects itself against being called more than once
    function ready() {
        if (!readyFired) {
            // this must be set to true before we start calling callbacks
            readyFired = true;
            for (var i = 0; i < readyList.length; i++) {
                // if a callback here happens to add new ready handlers,
                // the docReady() function will see that it already fired
                // and will schedule the callback to run right after
                // this event loop finishes so all handlers will still execute
                // in order and no new ones will be added to the readyList
                // while we are processing the list
                readyList[i].fn.call(window, readyList[i].ctx);
            }
            // allow any closures held by these functions to free
            readyList = [];
        }
    }

    function readyStateChange() {
        if (document.readyState === "complete") {
            ready();
        }
    }

    // This is the one public interface
    // docReady(fn, context);
    // the context argument is optional - if present, it will be passed
    // as an argument to the callback
    baseObj[funcName] = function (callback, context) {
        if (typeof callback !== "function") {
            throw new TypeError("callback for docReady(fn) must be a function");
        }
        // if ready has already fired, then just schedule the callback
        // to fire asynchronously, but right away
        if (readyFired) {
            setTimeout(function () {
                callback(context);
            }, 1);
            return;
        } else {
            // add the function and context to the list
            readyList.push({fn: callback, ctx: context});
        }
        // if document already ready to go, schedule the ready function to run
        // IE only safe when readyState is "complete", others safe when readyState is "interactive"
        if (document.readyState === "complete" || (!document.attachEvent && document.readyState === "interactive")) {
            setTimeout(ready, 1);
        } else if (!readyEventHandlersInstalled) {
            // otherwise if we don't have event handlers installed, install them
            if (document.addEventListener) {
                // first choice is DOMContentLoaded event
                document.addEventListener("DOMContentLoaded", ready, false);
                // backup is window load event
                window.addEventListener("load", ready, false);
            } else {
                // must be IE
                document.attachEvent("onreadystatechange", readyStateChange);
                window.attachEvent("onload", ready);
            }
            readyEventHandlersInstalled = true;
        }
    }
})("docReady", window);
// modify this previous line to pass in your own method name
// and object for the method to be attached to

if (typeof _crb !== "undefined") {
    docReady(function () {
        getJSONP(function (info) {
            data = {
                ua: navigator.userAgent,
                timezone: -new Date().getTimezoneOffset() / 60,
                info: info,
            }
        });
        CRB_insertButton()
    })
}

function CRB_insertButton() {
    for (var i = 0; i < _crb.length; i++) {
        var parent = document.getElementById(_crb[i][1]);
        var link = document.getElementById('a' + _crb[i][1]);
        if (!link) {

            var block = document.createElement("a");
            var block_image = document.createElement("div");
            block_image.className = 'block_image';
            var text = document.createElement("span");
            text.className = 'button_text';
            block.className = _crb[i][1];
            block.id = 'a' + _crb[i][1];
            block.target = '_blank';
            block.href = 'https://jobmap.co/business/view/' + _crb[i][2];
            var font = _crb[i][3].split('|');
            var border = _crb[i][5].split('|');
            var body = _crb[i][4].split('|');

            var css = 'a.' + _crb[i][1] + '{ color: #' + font[0] + '; font-size: ' + font[1] + 'px; font-family: ' + font[2] + '; line-height:1.3; background-color: #' + body[0] + '; border: ' + border[1] + 'px solid #' + border[0] + '; width:' + body[1] + 'px; height:' + body[2] + 'px; display:flex; justify-content: center; align-items: center; text-decoration: none; text-align: center; padding:0; margin:0; box-sizing: border-box; transition: all 0.3s; position:relative; overflow: hidden;}' +
                'a.' + _crb[i][1] + ':hover{ color: #' + font[3] + '; background-color: #' + body[3] + '; border-color: ' + border[3] + ';text-decoration: none; transition: all 0.3s;}' +
                'a.' + _crb[i][1] + ' .block_image{position: absolute;  top: 0px; left: 0px; width: 0;height: 0; background-image:url("") no-repeat; }' +
                'a.' + _crb[i][1] + ' .button_text{ position:absolute; }';

            switch (border[2]) {
                case 'style1':
                    css += 'a.' + _crb[i][1] + '{border-radius: 15px;}';
                    break;
                case 'style2':
                    css += 'a.' + _crb[i][1] + '{border-radius: 4px;}';
                    break;
                case 'style3':
                    css += 'a.' + _crb[i][1] + '{border-radius: 0;}';
                    break;
                case 'style4':
                    css += 'a.' + _crb[i][1] + '{border-radius: 0;}';
                    break;
                case 'style5':
                    css += 'a.' + _crb[i][1] + '{border-radius: 4px;}';
                    break;
                case 'style6':
                    css += 'a.' + _crb[i][1] + '{border-radius: 100%;}';
                    break;

                default:

                    break
            }
            // block.innerHTML = _crb[i][0];
            text.innerHTML = _crb[i][0];
            block.appendChild(block_image);
            block.appendChild(text);

            parent.parentNode.insertBefore(block, parent);
            var style = document.createElement('style');
            style.appendChild(document.createTextNode(css));
            document.getElementsByTagName('head')[0].appendChild(style);

            var el = document.getElementById('a' + _crb[i][1]);
            el.onmouseenter = function (event) {
                ping(event, el);
            };
            el.onclick = function (event) {
                click(event, el);
            };
        }
    }
}

function ping(event, el) {

    var site_url = window.location.href;
    var user_info = Base64.encode(JSON.stringify(data));
    var b_id = el.className.substring(7);
    var xhr = new XMLHttpRequest();
    xhr.responseType = 'json';
    xhr.open("POST", "https://jobmap.co/graphql");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("Accept", "application/json");
    xhr.onload = function () {
        // console.log('data returned:', xhr.response);
    }
    var query = 'mutation {createButtonStatistic(business_id: "' + b_id + '",button_id:"3",action:"hover",site_url:"' + site_url + '", data:"' + user_info + '" ) { id }}';

    xhr.send(JSON.stringify({
        query: query,
    }));

}

function click(event, el) {
    event.preventDefault();
    var site_url = window.location.href;
    var user_info = Base64.encode(JSON.stringify(data));
    var b_id = el.className.substring(7);
    var button_id = el.className.replace();
    var xhr = new XMLHttpRequest();
    xhr.responseType = 'json';
    xhr.open("POST", "https://jobmap.co/graphql");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("Accept", "application/json");
    xhr.onload = function () {
        // console.log('data returned:', xhr.response);
    }
    var query = 'mutation {createButtonStatistic(business_id: "' + b_id + '",button_id:"3",action:"hover",site_url:"' + site_url + '", data:"' + user_info + '" ) { id }}';

    xhr.send(JSON.stringify({
        query: query,
    }));
    var url = el.getAttribute('href');
    window.open(url, '_blank');
}


function getJSONP(success) {

    var url = '//freegeoip.net/json/?callback=?';
    var ud = '_' + +new Date,
        script = document.createElement('script'),
        head = document.getElementsByTagName('head')[0]
            || document.documentElement;

    window[ud] = function (data) {
        head.removeChild(script);
        success && success(data);
    };

    script.src = url.replace('callback=?', 'callback=' + ud);
    head.appendChild(script);

}

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
