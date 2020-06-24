
function ScanBusinessNew() {

    this.userId = 0;

}

ScanBusinessNew.prototype = {
    init: function () {
        var _this = this;

        var url = window.location.href;
        _this.userId = parseInt(url.substr(url.lastIndexOf('/') + 1));
        new GraphQL("query", "getUserForScanBusiness", {
            'id': _this.userId,
        }, [
            'id',
            'email',
            'username',
            'first_name',
            'last_name',
            'user_pic(origin: true)',
            'user_pic_options(width: 200, height: 200)',
            'user_pic_options_md(width: 100, height: 100)',
            'user_pic_options_sm(width: 50, height: 50)',
            'user_pic_filter',
            'updated_at',
            'token'
        ], true, false, function (data) {
            Loader.stop();
        }, function (data) {
            if (data.user_pic) {
                $('#user-img').attr('src', data.user_pic);
            }
            $('#user-name').text(data.username);
            $('#user-update').text(trans('scan-business.last_updated',{ 'update': data.updated_at }));
            $('#user-title').text(trans('scan-business.it_looks_like_user',{ 'user': data.username }));
            $('#user-resume-update').attr('data-id', data.id);
            $('#user-profile').attr('href', '/u/'+data.username);

        }, false.form).request();

    }

};

$(document).ready(function () {

    loadPromise.then(function () {
        var scanBusinessNew = new ScanBusinessNew();
        scanBusinessNew.init();
        BusinessApplicant = new BusinessApplicants('getPipeline');
        BusinessApplicant.init();
    }).then(function () {
        app.runPromise();
    });

});
