function cookieListener(cookieName, callback) {
    this.cookiename = cookieName;
    this.callback = callback;
    this.cookieRegistry = [];
    this.delete = 0;
    var _this = this;
    this.interval = setInterval(
        function () {
            _this.observe()
        }, 1000);
}

cookieListener.prototype.observe = function () {
    var cookieVal = APIStorage.read(this.cookiename);
    var url = document.location.pathname;
    if (this.cookieRegistry[this.cookiename] == null && (cookieVal != null && cookieVal.length !== 0)) {
        if (url === "/") {
            window.location.href = '/';
        }
    } else if (this.cookieRegistry[this.cookiename] != null && (cookieVal == null || cookieVal.length === 0)) {
        if (url !== "/") {
            if(this.checkURL()) {
               window.location.href = '/';
            }
        }
    } else if (cookieVal !== this.cookieRegistry[this.cookiename]) {
        if (cookieVal !== null && cookieVal.length !== 0) {
        //if (cookieVal !== null && cookieVal.length !== 0 && this.checkURL()) {
            if (app && user && business) {
                user.refresh();
                business.refresh && business.refresh();
                app.init();
            }
            //window.location.href = '/';
            if(this.checkURL()) {
                window.location.href = '/';
            }
        }
    }
    this.cookieRegistry[this.cookiename] = cookieVal;
};
cookieListener.prototype.removeListener = function () {
    clearInterval(this.interval)
};
cookieListener.prototype.checkURL = function(){
    var url = window.location.href;
    var valid = true;
    var path = ['business/view'];
    $.map(path, function(item){
        if(url.search(item) !== -1){
            valid = false;
        }
    });

    return valid;
};

$(document).ready(function () {
    new cookieListener('api-token');
});