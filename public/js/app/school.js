
function School() {

    this.name = '';
    this.address = '';
    this.directors = [];
    this.teachers = [];
    this.students = [];
    this.directorsCount = 0;
    this.teachersCount = 0;
    this.studentsCount = 0;
    this.schoolCounts = '';

    this.fullUrl = '';
    this.url = '';

}

School.prototype = {
    init: function () {
        Loader.init();

        this.fullUrl = window.location.href;
        this.url = window.location.pathname;
        params = this.url.substr(1).split('/');
        this.name = params[1];

        this.get();
    },
    get: function () {
        var _this = this;
        new GraphQL("query", "school", {
            "name": _this.name
        }, [
            'name',
            'address',
            'directors{' +
                'first_name last_name email city region country country_code teaching academy token user_id created_at user{' +
                    'id first_name last_name region city country country_code user_pic created_at' +
                '}, teachers{id}, students{id}' +
            '}',
            'teachers{' +
                'first_name last_name email city region country country_code teaching academy token user_id created_at user{' +
                    'id first_name last_name region city country country_code user_pic created_at' +
                '}, teachers{id}, students{id}' +
            '}',
            'students{' +
                'first_name last_name email city region country country_code teaching academy token user_id created_at user{' +
                    'id first_name last_name region city country country_code user_pic created_at' +
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
        _this.name = data.name;
        _this.address = data.address;
        _this.directors = data.directors;
        _this.teachers = data.teachers;
        _this.students = data.students;
        _this.directorsCount = data.directors.length;
        _this.teachersCount = data.teachers.length;
        _this.studentsCount = data.students.length;
        _this.schoolCounts = _this.directorsCount + '  directors, ' + _this.teachersCount + '  teachers, ' + _this.studentsCount + '  students, ';
    },
    show: function () {
        var _this = this;
        $('#schoolCounts').text(_this.schoolCounts);
        $('#schoolName strong').text(_this.name);
        $('#schoolAddress').text(_this.address);

        _this.showChildren(_this.directors, 'director');
        _this.showChildren(_this.teachers, 'teacher');
        _this.showChildren(_this.students, 'student');
    },
    showChildren: function (data,type) {
        $.each(data, function( index, value ) {
            var child = $("#cloneItemList").clone();
            if (value.user){
                child.removeAttr('id');
                var user = value.user;

                if (type != 'student') {
                    var typeChild = (type == 'director') ? 'teachers' : 'students',
                        countChild = (type == 'director') ? value.teachers.length : value.students.length;
                    child.find('.schoolItemPic').attr('href', '/' + type + '/' + value.token);
                    child.find('.schoolItemName').attr('href', '/' + type + '/' + value.token);
                    child.find('.schoolItemCountChildren').attr('href', '/' + type + '/' + value.token);
                    child.find('.schoolItemCountChildren').text(countChild + ' ' + typeChild);
                }
                child.find('.schoolItemPic img').attr('src', user.user_pic ? user.user_pic : '/img/profilepic2.png');
                child.find('.schoolItemName strong').text(user.first_name + ' ' + user.last_name);
                child.find('.schoolItemType').text(type.charAt(0).toUpperCase() + type.slice(1));

                child.find('.schoolItemDateAdd').text(trans('added') + ' ' + user.created_at);
                child.find('.schoolItemDateUpdate').text(trans('updated') + ' ' + value.created_at);
                child.css('display','flex');
                child.appendTo("#blockItems");
            }
        });
    }
};

$(document).ready(function () {

    var school = new School();
    school.init();
    
});
