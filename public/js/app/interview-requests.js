$(function() {
	var is_interviews_path = [
        window.location.pathname.indexOf('/user/interviews'),
        window.location.pathname.indexOf('/business/interviews'),
    ].some(function(index) {
        return index > -1;
    });

    var getInterviewRequests = function(options, done) {
        return new GraphQL('query', 'interviewRequests', {
            business_id:    window.location.pathname.indexOf('/business') > -1 && parseInt(business && business.currentID) || 0,
            type:           options.type || '',
        }, [
            'interview_requests{' + [
                'id',
                'user_id',

                'user{' + [
                    'id',
                    'last_name',
                    'first_name',
                    'user_pic',
                    'last_activity',
                ].join(' ') + '}',

                'business_id',

                'business{' + [
                    'id',
                    'slug',
                    'picture',
                    'name',
                    'slug',
                ].join(' ') + '}',

                'type',
                'address',
                'phone_number',
                'messenger_identifier',
                'interviewer_name',
                'date',
                'state',
                'sender_type',
            ].join(' ') + '}',

            'count_of_pending',
            'count_of_upcoming',
            'count_of_archived',
            'total_count',
            'current_type',
        ], true, false, function() {
            Loader.stop();
        }, function(response) {
            return done && done(response);
        }, false).request();
    };

    var updateInterviewRequest = function(options, done) {
        return new GraphQL('mutation', 'updateInterviewRequest', {
            interview_request_id:   options.interview_request_id,
            business_id:            options.business_id,
            state:                  options.state,
        }, [
            'id',
            'user_id',
            'type',
            'address',
            'phone_number',
            'messenger_identifier',
            'interviewer_name',
            'state',
        ], true, false, function() {
            Loader.stop();
        }, function(response) {
            Loader.disabled = false;
            return done && done(response);
        }, false).request();
    };

    var getCountsOfInterviewRequests = function(options, done) {
        Loader.disabled = true;

        return new GraphQL('query', 'countsOfInterviewRequests', {
            business_id: window.location.pathname.indexOf('/business') > -1 && parseInt(business && business.currentID) || 0,
        }, [
            [
                'pending',
                'upcoming',
                'archived',
                'token',
            ].join(' '),
        ], true, false, function(error) {
            Loader.disabled = false;
            console.error(arguments);
            // done && done({ error: error });
        }, function(response) {
            Loader.disabled = false;
            return done(response);
        }, false).request();
    };

    var template = function(name, options) {
        return ejs.render($('#' + name + '-template').html(), options);
    };

    var loadInterviewRequests = function(options) {
        return getInterviewRequests(options, function(response) {
            $('#interview-request-buttons .btn[data-id="' + response.current_type + '"]:first').addClass('active');

            let type = window.location.pathname.split("/");
            if (type.length > 2) {
                new GraphQL("query", "getHowToStartGotIt", {
                    'business_id': business.currentID,
                    'user_id': user.data.id,
                    'type': type[2],
                    'section': type[1]
                }, [
                    'result',
                    'token'
                ], true, false, function () {
                    Loader.stop();
                }, function (data) {
                    if (data.result == 'show') {
                        $('.interview-requests-content__how-to-start').show();
                    } else {
                        $('.interview-requests-content__how-to-start').hide();
                    }
                }, false).request();
            } else {
                $('.interview-requests-content__how-to-start').hide();
            }
            if (response.total_count == 0) {
                $('#interview-requests-content').hide();
                $('#no-interview-requests-yet').show();

                //$('.interview-requests-content__how-to-start').show();
            }
            else {
                $('#interview-requests-content').show();
                $('#no-interview-requests-yet').hide();
                $('.interview-requests-content__how-to-start').hide();
            }

            [ 'pending', 'upcoming', 'archived' ].forEach(function(type) {
                // notification_dashboard_business
                $('#interview-request-buttons .btn[data-id="' + type + '"] .notification_dashboard_business').each(function() {
                    $(this).text(response['count_of_' + type]);

                    if (response['count_of_' + type] > 0) {
                        $(this).show();
                    }
                    else {
                        $(this).hide();
                    }
                });
            });

            // $('.').text(response.count_of_upcoming);

            $('#count-of-upcoming-interview-requests').text(response.count_of_upcoming);
            $('.interview-requests').html('');

            if (response.interview_requests.length > 0) {
                // $('#count-of-interview-requests').text(response.interview_requests.length);

                response.interview_requests.forEach(function(interview_request) {
                    $(template('interview-request', {
                        interview_request: interview_request,
                        business_id: window.location.pathname.indexOf('/business') > -1 && parseInt(business && business.currentID) || 0,
                    })).data({ interview_request: interview_request }).appendTo('.interview-requests');
                });
            }
            else {
                $('.interview-requests').html(Langs.no_interview_requests);
            }
        });
    };

    var updateCountsOfInterviewRequests = function(options) {
        options = options || {};
        options.animate = (options.animate !== undefined ? options.animate : true);

        getCountsOfInterviewRequests({}, function(response) {
            $('#menu-content .realtime__count-of-upcoming-interviews').text(response.pending + response.upcoming).each(function() {
                if (response.pending + response.upcoming > 0) {
                    $(this).removeClass('animated bounceIn').each(function() {
                        var $this = $(this);

                        if (options.animate) {
                            setTimeout(function() {
                                $this.addClass('animated bounceIn').removeClass("hide");
                            }, 10);
                        }
                        else {
                            $this.removeClass("hide");
                        }
                    });
                }
                else {
                    $(this).addClass("hide");
                }
            });

            $('.notification_dashboard_user.realtime__count-of-upcoming-interviews').text(response.pending + response.upcoming).each(function() {
                if (response.pending + response.upcoming > 0) {
                    $(this).removeClass('animated bounceIn').each(function() {
                        var $this = $(this);

                        if (options.animate) {
                            setTimeout(function() {
                                $this.addClass('animated bounceIn').show();
                            }, 10);
                        }
                        else {
                            $this.show();
                        }
                    });
                }
                else {
                    $(this).hide();
                }
            });

            if (is_interviews_path) {
            	$('#interview-requests-content .realtime__count-of-upcoming-interviews').text(response.count);

            	[ 'pending', 'upcoming', 'archived' ].forEach(function(type) {
	                // notification_dashboard_business
	                $('#interview-request-buttons .btn[data-id="' + type + '"] .notification_dashboard_business').each(function() {
                        var old_value = parseInt($(this).text()) || 0;
                        $(this).text(response[type]);

                        if (response[type] > 0) {
                            if (response[type] > old_value) {
                                $(this).removeClass('animated bounceIn').each(function() {
                                    var $this = $(this);

                                    if (options.animate) {
                                        setTimeout(function() {
                                            $this.addClass('animated bounceIn').show();
                                        }, 10);
                                    }
                                    else {
                                        $this.show();
                                    }
                                });
                            }
                            else {
                                $(this).show();
                            }
                        }
                        else {
                            $(this).hide();
                        }
                    });
	            });

	            $('#interview-request-buttons .btn.active[data-id!="archived"]').click();
            }
        });
    };

    var initialize = function() {
    	if (is_interviews_path) {
	        loadInterviewRequests({
	            type: 'first_where_count_is_not_zero'
	        });

	        $(document).on('click', '#interview-request-buttons .btn', function(event) {
	            event.preventDefault();
	            $('#interview-request-buttons .btn').removeClass('active');
	            $(this).addClass('active');
	            loadInterviewRequests({ type: $(this).attr('data-id') });
	        });

	        $(document).on('click', '.interview-request__accept', function(event) {
	            var interview_request = $(this).parents('.interview-request').first().data('interview_request');

	            updateInterviewRequest({
	            	interview_request_id: 	interview_request.id,
	            	business_id: 			window.location.pathname.indexOf('/business') > -1 && parseInt(business && business.currentID) || 0,
	            	state: 					'accepted',
	            }, function() {
	            	$.notify('The interview was accepted!', 'success');
	            });
	        });

	        $(document).on('click', '.interview-request__change', function(event) {
	            var interview_request = $(this).parents('.interview-request:first').data('interview_request');
	            $('#interview-request-modal').modal('show');
	            $('#interview-request-modal__title').text(Langs.change_interview_request);
	            $('#interview-request-modal__button').text(Langs.change);

	            $('#interview-request-modal').data('initialize')({
	                id:                     interview_request.id,
	                user_id:                interview_request.user_id,
                    business_id:            interview_request.business_id,
	                type:                   interview_request.type,
	                address:                interview_request.address,
	                phone_number:           interview_request.phone_number,
	                interviewer_name:       interview_request.interviewer_name,
	                date:                   interview_request.date,
	            });
	        });

	        $(document).on('click', '.interview-request__withdrawl', function(event) {
	            var interview_request = $(this).parents('.interview-request').first().data('interview_request');

	            updateInterviewRequest({
	            	interview_request_id: 	interview_request.id,
	            	business_id: 			window.location.pathname.indexOf('/business') > -1 && parseInt(business && business.currentID) || 0,
	            	state: 					'withdrawn',
	            }, function() {
	            	$.notify('The interview was withdrawn!', 'success');
	            });
	        });

	        $(document).on('click', '.interview-request__reject', function(event) {
	            var interview_request = $(this).parents('.interview-request').first().data('interview_request');

	            updateInterviewRequest({
	            	interview_request_id: 	interview_request.id,
	            	business_id: 			window.location.pathname.indexOf('/business') > -1 && parseInt(business && business.currentID) || 0,
	            	state: 					'rejected',
	            }, function() {
	            	$.notify('The interview was rejected!', 'success');
	            });
	        });

	        $(document).on('click', '.interview-request__finish', function(event) {
	            var interview_request = $(this).parents('.interview-request').first().data('interview_request');
	            $('#interview-request-finishing-modal__finish').attr('data-id', interview_request.id);
	            $('#interview-request-finishing-modal').modal('show');
	        });

	        /*$(document).on('click', '.interview-requests-content__show-how-to-start', function(event) {
	            event.preventDefault();
	            $('.interview-requests-content__how-to-start').show();
	        });

	        $(document).on('click', '.interview-requests-content__hide-how-to-start', function(event) {
	            event.preventDefault();
	            $('.interview-requests-content__how-to-start').hide();
	        });*/
	    }

	    updateCountsOfInterviewRequests({ animate: false });

	    realtime.on('interview_requests.count_updated', function() {
	    	updateCountsOfInterviewRequests();
	    });
    };

    initialize();
});
