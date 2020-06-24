$(document).ready(function () {
    loadPromise.then(function () {
        //AJAX Activity Indicator
        Loader.init();
        //get user data
        app.addToPromise(function () {
            var params = {'overview': 1};
            var locale = APIStorage.read('language');
            if (locale != 'en') {
                params['locale'] = locale;
            }

            new GraphQL("query", "resume", params, [
                'overview is_complete token'], true, false, function () {
                Loader.stop();
            }, function (data) {
                $('#resume-overview').html(data.overview);
                //$('#loaded-data').show();

                if (data.is_complete === 1) {
                    $('.navigation a').unbind();
                    $('#menu-content').find('a:not(.profile-switcher)').unbind();
                } else {
                    $('.navigation a').unbind();
                    $('#menu-content').find('a:not(.profile-switcher)').unbind();
                    $('#menu-content').find('a:not(.profile-switcher)').click(function (e) {
                        e.preventDefault();
                        window.location.href = '/user/resume/create?r=1';
                    });
                    $('.navigation a').find('a:not(.profile-switcher)').click(function (e) {
                        e.preventDefault();
                        window.location.href = '/user/resume/create?r=1';
                    });
                }
            }, false).request();
        });

        $('#resume-overview').on('click', 'button.btn-link', function () {
            //console.log($(this).data('link'));
            window.location.href = $(this).data('link');
        });

        app.addToPromise(function () {
            //AJAX Activity Indicator
            Loader.init();

            var clipboard = new Clipboard('#overview__clipboard-button');
            clipboard.on('success', function (e) {
                $.notify(Langs.copied, 'success');
                e.clearSelection();
            });
        });

        //load resume overview module
        // app.run(load);
    }).then(function () {
        app.runPromise();
    });
});