$( document ).ready(function() {
    $('body').on('click', '#ShareModal__send', function (e) {
        var email = $('#ShareModal__email').val() ;
        var link = $('#share-link').val();
        console.log(e.target);
        new GraphQL("mutation", 'shareLink', {
            "email": email,
            "link": link,
        }, ['response'], false, false, function(data) {
            console.log(data);
        }, function () {
            $.notify('Link sent!', 'success');
        }).request();
    });
    $('body').on('click', '#share-link-send-email', function (e) {
        var email = $('#share-link-email').val();
        var link = $('#share-link').val();
        console.log(e.target);
        new GraphQL("mutation", 'shareLink', {
            "email": email,
            "link": link,
        }, ['response'], false, false, function(data) {
            console.log(data);
        }, function () {
            $.notify('Link sent!', 'success');
        }).request();
    });
});
