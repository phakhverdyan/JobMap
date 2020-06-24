
function Academy() {

    this.user = null;
    this.childrenActive = [];
    this.childrenInActive = [];
    this.childrenActiveCount = '(0)';
    this.childrenInActiveCount = '(0)';

    this.fullUrl = '';
    this.url = '';
    this.typeInUrl = '';
    this.tokenInUrl = '';
    this.typeChilddren = '';

}

Academy.prototype = {
    init: function () {
        Loader.init();

        this.fullUrl = window.location.href;
        this.url = window.location.pathname;
        params = this.url.substr(1).split('/');
        this.typeInUrl = params[0];
        this.tokenInUrl = params[1];
        this.typeChilddren = (this.typeInUrl == 'director') ? 'teacher' : false;

        this.get();
    },
    get: function () {
        var _this = this;
        new GraphQL("query", "academy", {
            "type": _this.typeInUrl,
            "token": _this.tokenInUrl
        }, [
            'user{' +
                'first_name last_name email location teaching academy token user_id user{' +
                    'id first_name last_name username region city country country_code user_pic' +
                '}' +
            '}',
            'children_active{' +
                'first_name last_name email location teaching academy token user_id created_at user{' +
                    'id first_name last_name username region city country country_code user_pic updated_at' +
                '}' +
            '}',
            'children_inactive{' +
                'first_name last_name email location teaching academy token user_id created_at user{' +
                    'id first_name last_name username region city country country_code user_pic updated_at' +
                '}' +
            '}'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            _this.setData(data);
            _this.show();
        }, false).request();
    },
    setData: function (data) {
        var _this = this;
        _this.user = data.user;
        _this.childrenActive = data.children_active ? data.children_active : [];
        _this.childrenInActive = data.children_inactive ? data.children_inactive : [];
        _this.childrenActiveCount = data.children_active ? '('+ data.children_active.length +')' : '(0)';
        _this.childrenInActiveCount = data.children_inactive ? '('+ data.children_inactive.length +')' : '(0)';
    },
    updateData: function (data) {
        var _this = this;
        if (data.children_active) {
            $.merge(_this.childrenActive,data.children_active);
            _this.childrenActiveCount = '('+ _this.childrenActive.length +')';
            $('#academyChildrenActiveCount').text(_this.childrenActiveCount);
        }
        if (data.children_inactive) {
            $.merge(_this.childrenInActive,data.children_inactive);
            _this.childrenInActiveCount = '('+ _this.childrenInActive.length +')';
            $('#academyChildrenInActiveCount').text(_this.childrenInActiveCount);
        }
    },
    show: function () {
        var _this = this;
        if (_this.user) {
            $('#academyUserName').text(_this.user.user.first_name + ' ' + _this.user.user.last_name);
            $('#academyChildrenActiveCount').text(_this.childrenActiveCount);
            $('#academyUserTeaching').text(_this.user.teaching);
            $('#academyUserAcademy').attr('href','/school/' + _this.user.academy);
            $('#academyUserAcademy').text(_this.user.academy);
            $('#academyUserCountryCode').addClass('bfh-flag-' + _this.user.user.country_code);
            $('#academyUserLocation').text(_this.user.location);
            $('#academyChildrenInActiveCount').text(_this.childrenInActiveCount);
            $('input[name="token"]').val(_this.fullUrl);
        }

        _this.showChildren();
    },
    showChildren: function (childrenActive,childrenInActive) {
        var _this = this;
        childrenActive = childrenActive || _this.childrenActive;
        $.each(childrenActive, function( index, value ) {
            var child = $("#cloneChildActive").clone();
            if (value.user){
                child.removeAttr('id');
                var user = value.user;
                child.find('.academyChildPic img').attr('src', user.user_pic ? user.user_pic : '/img/profilepic2.png');
                child.find('.academyChildPic').attr('href', '/u/' + user.username);
                child.find('.academyChildName').attr('href', '/u/' + user.username);
                child.find('.academyChildName strong').text(user.first_name + ' ' + user.last_name);
                child.find('.academyChildTeaching').text(_this.typeChilddren ? value.teaching : _this.user.teaching);
                child.find('.academyChildAcademy').text(_this.typeChilddren ? value.academy : _this.user.academy);
                child.find('.academyChildCountryCode').addClass('bfh-flag-' + user.country_code);
                child.find('.academyChildLocation').text(value.location);
                child.find('.academyChildDateAdd').text(Langs.added + ' ' + value.created_at);
                child.find('.academyChildDateUpdate').text(Langs.updated + ' ' + user.updated_at);
                child.css('display','flex');
                child.appendTo("#blockActive");
            }
        });
        childrenInActive = childrenInActive || _this.childrenInActive;
        $.each(childrenInActive, function( index, value ) {
            var child = $("#cloneChildInActive").clone();
            child.removeAttr('id');
            child.find('.academyChildEmail').text(value.email);
            child.find('.academyChildData').text(value.created_at);
            child.css('display','block');
            child.appendTo("#blockInActive");
        });
    }
};

$(document).ready(function () {

    var academy = new Academy();
    academy.init();

    var inviteChild = function (resend) {

        new GraphQL("mutation", "inviteChildAcademy", {
            "type": academy.typeInUrl,
            "token": academy.tokenInUrl,
            "email": emailChild || FormValidate.getFieldValue('email', form),
            //"email": emailChild,
            "resend": resend
        }, [
            'children_active{' +
                'first_name last_name email location teaching academy token user_id created_at user{' +
                    'id first_name last_name username region city country country_code user_pic updated_at' +
                '}' +
            '}',
            'children_inactive{' +
                'first_name last_name email location teaching academy token user_id created_at user{' +
                    'id first_name last_name username region city country country_code user_pic updated_at' +
                '}' +
            '}'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            if (data) {
                academy.updateData(data);
                academy.showChildren(data.children_active,data.children_inactive);
            }
        }, form).request();
    };
    var form = $('#formInviteChild');
    var emailChild = '';
    $('#inviteChild').click(function () {
        $(this).blur();
        emailChild = null;//$('input[name="email"]').val();
        inviteChild(0);
        $('input[name="email"]').val('');
    });
    $('#blockInActive').on('click', '.reInviteChild', function () {
        emailChild = $(this).closest('.itemChildInActive').find('.academyChildEmail').text();
        inviteChild(1);
    });

    form.on('keyup', 'input', function () {
        FormValidate.fieldValidateClear($(this));
    });

    //data-clipboard-action="copy" data-clipboard-target="#link-user-profile" id="clipboard-button"
    var clipboard = new Clipboard('#clipboard-button');
    clipboard.on('success', function (e) {
        $.notify(Langs.copied, 'success');
        e.clearSelection();
    });

});
