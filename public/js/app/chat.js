window.chat_initialize = function() {
    if (window.Chat) {
        return;
    }

    var chats = [];
    var lower_chat_message_id = 0;
    var $chats = $(null);
    var chat_list_loading_request = null;
    var chat_list_loading_timeout = null;
    var active_chat = null;
    var $active_chat = null;
    var business_id = 0;
    var last_sent_active_chat_typing = 0;
    var count_of_messages_to_load = 10;
    var count_of_chats_to_load = 10;
    var active_chat_message_loading_request = null;
    var update_chat_interlocutor_last_read_message_timeout = null;
    var update_chat_interlocutor_last_read_message_request = null;
    var active_chat_search_request = null;
    var search = null;
    var previous_search = null;
    var typing_interlocutors = [];
    var current_day = (new Date).toISOString().split(/T/)[0];
    var search_request_timeout = null;
    var is_mobile = false;
    var is_messages_path = false;
    var is_employers_path = false;

    var filtering_manager_ids = [];
    var filtering_city_region = [];

    if (window.location.pathname.indexOf('/business') === 0) {
        business_id = parseInt(APIStorage.read('business-id')) || 0;
    }

    var template = function(name, options) {
        return ejs.render($('#' + name + '-template').html(), options);
    };

    var chat_typing_interval = setInterval(function() {
        var updated_chat_ids = [];

        typing_interlocutors = typing_interlocutors.filter(function(typing_interlocutor) {
            if (Date.now() - typing_interlocutor.started_at < 3000) {
                return true;
            }

            if (updated_chat_ids.indexOf(typing_interlocutor.chat_id) < 0) {
                updated_chat_ids.push(typing_interlocutor.chat_id);
            }

            return false;
        });

        updated_chat_ids.forEach(function(updated_chat_id) {
            updateChatTyping(updated_chat_id);
        });

        if (typing_interlocutors.length == 0) {
            $('.global-chat-typing').removeClass('active');
        }
    }, 1000);

    var chat_created_at_inverval = setInterval(function() {
        $('.chat-messages').children('.showing-time').each(function() {
            var $time = $(this).find('.chat-message__time');
            var updated_text = '';
            var created_at = new Date($(this).data('chat_message').created_at);

            if (Date.now() - created_at.getTime() > 15 * 60 * 1000) {
                updated_text = created_at.toUTCString().split(/\s+/)[4].slice(0, -3);
            }
            else {
                updated_text = timeago().format(new Date('' +
                    $(this).data('chat_message').created_at) +
                    ' at ' +
                    created_at.toUTCString().split(/\s+/)[4].slice(0, -3) +
                '');
            }

            ($time.text() != updated_text) && $time.text(updated_text);
        });
    }, 1000);

    var updating_day_ago_interval = setInterval(function() {
        var current_current_day = (new Date).toISOString().split(/T/)[0];

        if (current_current_day == current_day) {
            return;
        }

        updateDaysAgoInChatHistory();
        current_day = current_current_day;
    });

    var requests = {
        getChats: function(options, done) {
            return new GraphQL('query', 'chats', {
                business_id:                business_id,
                name:                       options.name || '',
                before_last_message_id:     options.before_last_message_id || 0,
                count:                      options.count || 50,
                filtering_manager_ids:      filtering_manager_ids,
                filtering_city_region:      filtering_city_region,
            }, [
                [
                    'chats{' + [
                        'id',
                        // 'is_group',

                        'members{' + [
                            'id',

                            'user{' + [
                                'id',
                                'first_name',
                                'last_name',
                                'is_online',
                                'user_pic',
                            ].join(' ') + '}',

                            'business{' + [
                                'id',
                                'slug',
                                'name',
                                'business_is_online',
                                'picture',
                            ].join(' ') + '}',
                        ].join(' ') + '}',

                        'opposite_member{' + [
                            'id',

                            'user{' + [
                                'id',
                                'first_name',
                                'last_name',
                                'is_online',
                                'user_pic',
                            ].join(' ') + '}',

                            'business{' + [
                                'id',
                                'slug',
                                'name',
                                'business_is_online',
                                'picture',
                            ].join(' ') + '}',
                        ].join(' ') + '}',

                        'my_interlocutor{' + [
                            'id',
                            'last_read_message_id',
                        ].join(' ') + '}',

                        'count_of_unread_messages',

                        'last_message{' + [
                            'id',
                            'text',

                            'interlocutor{' + [
                                'id',

                                'user{' + [
                                    'id',
                                    'last_name',
                                    'first_name',
                                    'user_pic',
                                    'last_activity',
                                ].join(' ') + '}',

                                'business{' + [
                                    'id',
                                    'slug',
                                    'picture',
                                    'name',
                                    'slug',
                                ].join(' ') + '}',
                            ].join(' ') + '}',

                            'interview_request{' + [
                                'id',
                            ].join(' ') + '}',

                            'state',
                        ].join(' ') + '}',

                        'secret_token',
                    ].join(' ') + '}',

                    'token',
                ].join(' '),
            ], true, false, function(error) {
                console.error(arguments);
                // done && done({ error: error });
            }, function(response) {
                return done(response);
            }, false).request();
        },

        getChat: function(chat_id, done) {
            return new GraphQL('query', 'chat', {
                chat_id: chat_id,
                business_id: business_id,
            }, [
                [
                    'id',

                    'user{' + [
                        'id',
                        'first_name',
                        'last_name',
                        'last_activity',
                        'user_pic',
                    ].join(' ') + '}',

                    'business{' + [
                        'id',
                        'slug',
                        'name',
                        'business_last_activity',
                        'picture',
                    ].join(' ') + '}',

                    'my_interlocutor{' + [
                        'id',
                        'last_read_message_id',
                    ].join(' ') + '}',

                    'count_of_unread_messages',

                    'last_message{' + [
                        'id',
                        'text',

                        'user{' + [
                            'id',
                            'last_name',
                            'first_name',
                            'user_pic',
                            'last_activity',
                        ].join(' ') + '}',

                        'business{' + [
                            'id',
                            'picture',
                            'name',
                            'slug',
                        ].join(' ') + '}',

                        'interview_request{' + [
                            'id',
                        ].join(' ') + '}',

                        'state',
                    ].join(' ') + '}',

                    'secret_token',
                    'token',
                ].join(' '),
            ], true, false, function(error) {
                console.error(arguments);
                // done && done({ error: error });
            }, function(response) {
                return done(response);
            }, false).request({ disable_loader: true });
        },

        getCurrentChatMessages: function(options, done) {
            if (!active_chat) {
                return done && done({ chat_messages: [] });
            }

            return new GraphQL('query', 'chatMessages', {
                chat_id:        active_chat.id,
                business_id:    business_id,
                before_id:      options.before_id || 0,
                around_id:      options.around_id || 0,
                after_id:       options.after_id || 0,
                count:          options.count || 1,
                text:           options.text || '',
            }, [
                'count_of_chat_messages_before',

                'chat_messages{' + [
                    'id',

                    'interlocutor{' + [
                        'id',

                        'user{' + [
                            'id',
                            'last_name',
                            'first_name',
                            'user_pic',
                            'last_activity',
                        ].join(' ') + '}',

                        'business{' + [
                            'id',
                            'picture',
                            'name',
                            'slug',
                        ].join(' ') + '}',
                    ].join(' ') + '}',

                    'member{' + [
                        'id',

                        'user{' + [
                            'id',
                            'last_name',
                            'first_name',
                            'user_pic',
                            'last_activity',
                        ].join(' ') + '}',

                        'business{' + [
                            'id',
                            'picture',
                            'name',
                            'slug',
                        ].join(' ') + '}',
                    ].join(' ') + '}',

                    'read_interlocutors{' + [
                        'id',

                        'user{' + [
                            'id',
                            'last_name',
                            'first_name',
                            'user_pic',
                            'last_activity',
                        ].join(' ') + '}',

                        'business{' + [
                            'id',
                            'picture',
                            'name',
                            'slug',
                        ].join(' ') + '}',
                    ].join(' ') + '}',

                    'text',

                    'interview_request{' + [
                        'id',
                        'user_id',
                        'business_id',
                        'type',
                        'address',
                        'phone_number',
                        'messenger_identifier',
                        'interviewer_name',
                        'sender_type',
                        'date',
                        'state',
                    ].join(' ') + '}',

                    'state',
                    'created_at',
                ].join(' ') + '}',

                'count_of_chat_messages_after',
            ], true, false, function() {
                //
            }, function(response) {
                return done && done(response);
            }, false).request({ disable_loader: true });
        },

        getMessage: function(options, done) {
            new GraphQL('query', 'chatMessage', {
                chat_id:            options.chat_id,
                chat_message_id:    options.chat_message_id,
                business_id:        business_id,
            }, [
                'id',

                'member{' + [
                    'id',

                    'user{' + [
                        'id',
                        'last_name',
                        'first_name',
                        'user_pic',
                        'last_activity',
                    ].join(' ') + '}',

                    'business{' + [
                        'id',
                        'picture',
                        'name',
                        'slug',
                    ].join(' ') + '}',
                ].join(' ') + '}',

                'interlocutor{' + [
                    'id',

                    'user{' + [
                        'id',
                        'last_name',
                        'first_name',
                        'user_pic',
                        'last_activity',
                    ].join(' ') + '}',

                    'business{' + [
                        'id',
                        'picture',
                        'name',
                        'slug',
                    ].join(' ') + '}',
                ].join(' ') + '}',

                'read_interlocutors{' + [
                    'id',

                    'user{' + [
                        'id',
                        'last_name',
                        'first_name',
                        'user_pic',
                        'last_activity',
                    ].join(' ') + '}',

                    'business{' + [
                        'id',
                        'picture',
                        'name',
                        'slug',
                    ].join(' ') + '}',
                ].join(' ') + '}',

                'text',

                'interview_request{' + [
                    'id',
                    'user_id',
                    'business_id',
                    'type',
                    'address',
                    'phone_number',
                    'messenger_identifier',
                    'interviewer_name',
                    'date',
                    'state',
                ].join(' ') + '}',

                'state',
                'created_at',
                'token',
            ], true, false, function() {
                //
            }, function(response) {
                return done && done(response);
            }, false).request({ disable_loader: true });
        },

        getInterlocutor: function(options, done) {
            new GraphQL('query', 'chatInterlocutor', {
                chat_id:                options.chat_id,
                chat_interlocutor_id:   options.chat_interlocutor_id,
                business_id:            business_id,
            }, [
                'id',
                'chat_id',

                'user{' + [
                    'id',
                    'last_name',
                    'first_name',
                    'user_pic',
                    'last_activity',
                ].join(' ') + '}',

                'business{' + [
                    'id',
                    'picture',
                    'name',
                    'slug',
                ].join(' ') + '}',

                'token',
            ], true, false, function() {
                // Loader.stop();
            }, function(response) {
                return done && done(response);
            }, false).request({ disable_loader: true });
        },

        sendChatMessage: function(data, done) {
            new GraphQL('mutation', 'createChatMessage', {
                text:           data.chat_message.text,
                chat_id:        data.chat.id,
                business_id:    business_id,
            }, [
                'id',

                'member{' + [
                    'user{' + [
                        'id',
                        'last_name',
                        'first_name',
                        'user_pic',
                        'last_activity',
                    ].join(' ') + '}',

                    'business{' + [
                        'id',
                        'picture',
                        'name',
                        'slug',
                    ].join(' ') + '}',
                ].join(' ') + '}',

                'interlocutor{' + [
                    'user{' + [
                        'id',
                        'last_name',
                        'first_name',
                        'user_pic',
                        'last_activity',
                    ].join(' ') + '}',

                    'business{' + [
                        'id',
                        'picture',
                        'name',
                        'slug',
                    ].join(' ') + '}',
                ].join(' ') + '}',

                'read_interlocutors{' + [
                    'user{' + [
                        'id',
                        'last_name',
                        'first_name',
                        'user_pic',
                        'last_activity',
                    ].join(' ') + '}',

                    'business{' + [
                        'id',
                        'picture',
                        'name',
                        'slug',
                    ].join(' ') + '}',
                ].join(' ') + '}',

                'text',
                'created_at',
                'token',
            ], true, false, function() {
                //
            }, function(response) {
                return done && done(response);
            }, false).request();
        },

        updateChatInterlocutorLastReadMessage: function(data, done) {
            return new GraphQL('mutation', 'updateChatInterlocutor', {
                chat_id:                data.chat_id,
                business_id:            business_id,
                last_read_message_id:   data.last_read_message_id,
            }, [
                'id',
                'chat_id',

                'user{' + [
                    'id',
                    'last_name',
                    'first_name',
                    'user_pic',
                    'last_activity',
                ].join(' ') + '}',

                'business{' + [
                    'id',
                    'picture',
                    'name',
                    'slug',
                ].join(' ') + '}',

                'last_read_message_id',
                'token',
            ], true, false, function() {
                //
            }, function(response) {
                return done && done(response);
            }, false).request({ disable_loader: true });
        },

        getCountOfUnreadChatMessages: function(options, done) {
            return new GraphQL('query', 'countOfUnreadChatMessages', {
                business_id:    business_id,
                chat_id:        options.chat_id || 0,
            }, [
                [
                    'count',
                    'total_count',
                    'token',
                ].join(' '),
            ], true, false, function(error) {
                console.error(arguments);
                // done && done({ error: error });
            }, function(response) {
                return done(response);
            }, false).request({ disable_loader: true });
        },

        emitChatTyping: function(options, done) {
            return new GraphQL('query', 'emitChatTyping', {
                chat_id:        options.chat_id,
                business_id:    business_id,
            }, [
                [
                    'token',
                ].join(' '),
            ], true, false, function(error) {
                console.error(arguments);
                // done && done({ error: error });
            }, function(response) {
                return done && done(response);
            }, false).request({ disable_loader: true });
        },

        updateInterviewRequest: function(options, done) {
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
                //
            }, function(response) {
                return done && done(response);
            }, false).request();
        },
    };

    var getChatById = function(chat_id) {
        return chats.filter(function(current_chat) {
            return current_chat.id == chat_id;
        }).pop() || null;
    };

    var makeChatActive = function(chat, $chat, done) {
        var $chat_history = $('.chat-history');
        var $chat_history__messages = $('.chat-history__messages.main');
        var $chat_messages = $chat_history__messages.find('.chat-messages');

        if (active_chat) {
            $active_chat.removeClass('active');
            active_chat = null;
            active_chat_bottom_align = null;
            active_chat_messages = [];
            $active_chat = null;
            $chat_messages.html('');
            $('.chat-typing').removeClass('active');
            $('.chat-content-select-chat').show();
        }

        $chat.addClass('active');
        active_chat = chat;
        active_chat_bottom_align = null;
        $active_chat = $chat;
        $('.chat-load-more-messages').addClass('hidden');
        $('.chat-message-search__text').val('');
        search = null;
        $('.chat-content-select-chat').hide();

        if (is_mobile) {
            $('#chat-content-chats').hide();
            $('#chat-content-messages').show();
        }

        if (chat.opposite_member.user) {
            $('.chat-typing__avatar').attr('src', chat.opposite_member.user.user_pic);
        }
        else if (chat.opposite_member.business) {
            $('.chat-typing__avatar').attr('src', chat.opposite_member.business.picture);
        }

        active_chat_message_loading_request && active_chat_message_loading_request.abort();
        var around_id = 0;

        if (chat.my_interlocutor && chat.my_interlocutor.last_read_message_id > 0 && chat.my_interlocutor.last_read_message_id < chat.last_message.id) {
            around_id = parseInt(chat.my_interlocutor.last_read_message_id);
        }

        // Loader.disabled = true;

        active_chat_message_loading_request = requests.getCurrentChatMessages({
            around_id:  around_id,
            count:      count_of_messages_to_load,
        }, function(response) {
            $chat_history__messages.removeClass('hidden');
            $('.chat-history__messages.search').addClass('hidden');
            $('.chat-message-search__cross').addClass('hidden');
            search = null;

            active_chat_message_loading_request = null;
            var $around_chat_message = null;

            response.chat_messages.slice().reverse().forEach(function(chat_message, chat_message_index) {
                var align = null;

                if (chat_message.member.business) {
                    align = (business_id == chat_message.member.business.id ? 'right' : 'left');
                }
                else if (chat_message.member.user) {
                    align = (user.data.id == chat_message.member.user.id ? 'right' : 'left');
                }
                else {
                    align = 'left';
                }

                var $chat_message = $(template('chat-message', {
                    chat_message:       chat_message,
                    align:              align,
                    search:             false,
                    emojiCodeToChars:   emojiCodeToChars,
                })).data({ chat_message: chat_message }).addClass('first showing-day showing-time').prependTo($chat_messages);

                var $next_chat_message = $chat_message.next();

                if ($next_chat_message.length > 0) {
                    var next_chat_message_has_same_date = false;

                    if (chat_message.created_at.split(/T/)[0] == $next_chat_message.data('chat_message').created_at.split(/T/)[0]) {
                        next_chat_message_has_same_date = true;
                    }

                    if (next_chat_message_has_same_date) {
                        $next_chat_message.removeClass('showing-day');
                    }

                    if (next_chat_message_has_same_date && $next_chat_message.hasClass(align)) {
                        $next_chat_message.removeClass('first');

                        if (new Date($next_chat_message.data('chat_message').created_at).getTime() - new Date(chat_message.created_at).getTime() < 5 * 60 * 1000) {
                            $chat_message.removeClass('showing-time');
                        }
                    }
                    else {
                        $chat_message.addClass('last');
                    }
                }
                else {
                    $chat_message.addClass('last');
                }

                if (chat_message.id == around_id) {
                    $around_chat_message = $chat_message;
                }
            });

            if (response.count_of_chat_messages_before > 0) {
                $('.chat-history__messages.main .chat-load-more-messages.before').removeClass('hidden');
            }

            if (response.count_of_chat_messages_after > 0) {
                $('.chat-history__messages.main .chat-load-more-messages.after').removeClass('hidden');
            }

            if (response.chat_messages.length == 0) {
                $('.chat-history__messages.main .chat-no-messages').removeClass('hidden');
            }

            $('.mini-chat-window__content.is-active-chat').removeClass('hidden');

            if (around_id > 0) {
                if ($around_chat_message.length > 0) {
                    $around_chat_message.addClass('showing-unread');
                    var current_chat_history_scroll_top = $chat_history.scrollTop();
                    var chat_message_position_top = $around_chat_message.offset().top - $chat_history.offset().top + current_chat_history_scroll_top;
                    var chat_message_height = $around_chat_message.height();
                    var chat_history_height = $chat_history.height();

                    if (current_chat_history_scroll_top > chat_message_position_top || current_chat_history_scroll_top + chat_history_height - chat_message_height <= chat_message_position_top) {
                        $chat_history.scrollTop(chat_message_position_top - 35);
                    }
                }
            }
            else {
                scrollActiveChatToEnd();
            }

            updateCurrentChatHistoryDay();

            checkMyInterlocutorLastReadMessage(function(request_was) {
                updateCountOfUnreadChatMessages({
                    animate: false,
                    chat_id: active_chat.id,
                });
            });

            $('.new-chat-message__text').focus();
        });
    };

    var makeChatUnactive = function() {
        if (!active_chat) {
            return;
        }

        var $chat_history__messages = $('.chat-history__messages.main');
        var $chat_messages = $chat_history__messages.find('.chat-messages');
        $active_chat.removeClass('active');
        active_chat = null;
        active_chat_bottom_align = null;
        active_chat_messages = [];
        $active_chat = null;
        $chat_messages.html('');
        $('.chat-typing').removeClass('active');
        $('.mini-chat-window__content.is-active-chat').addClass('hidden');

        if (is_mobile) {
            $('#chat-content-chats').show();
            $('#chat-content-messages').hide();
        }

        $('.chat-content-select-chat').show();
    };

    var goToChatMessageInTheCurrentChat = function(chat_message_id, done) {
        var $chat_history = $('.chat-history');
        var $chat_history__messages = $('.chat-history__messages.main');
        active_chat_message_loading_request && active_chat_message_loading_request.abort();

        active_chat_message_loading_request = requests.getCurrentChatMessages({
            count:      count_of_messages_to_load,
            around_id:  chat_message_id,
        }, function(response) {
            active_chat_message_loading_request = null;
            $('.chat-history__messages.search').addClass('hidden');
            $chat_history__messages.removeClass('hidden');
            $('.chat-history__messages.search .chat-load-more-messages').addClass('hidden');
            $('.chat-history__loader').addClass('hidden');
            $('.chat-message-search__back').removeClass('hidden');
            $('.new-chat-message__text').prop('disabled', false);
            search.hidden = true;
            var $chat_messages = $chat_history__messages.find('.chat-messages');
            $chat_messages.html('');
            var $around_chat_message;

            response.chat_messages.slice().reverse().forEach(function(chat_message, chat_message_index) {
                var align = null;

                if (chat_message.member.business) {
                    align = (business_id == chat_message.member.business.id ? 'right' : 'left');
                }
                else if (chat_message.member.user) {
                    align = (user.data.id == chat_message.member.user.id ? 'right' : 'left');
                }
                else {
                    align = 'left';
                }

                var $chat_message = $(template('chat-message', {
                    chat_message:       chat_message,
                    align:              align,
                    search:             false,
                    emojiCodeToChars:   emojiCodeToChars,
                })).data({ chat_message: chat_message }).addClass('first showing-day showing-time').prependTo($chat_messages);

                var $next_chat_message = $chat_message.next();

                if ($next_chat_message.length > 0) {
                    var next_chat_message_has_same_date = false;

                    if (chat_message.created_at.split(/T/)[0] == $next_chat_message.data('chat_message').created_at.split(/T/)[0]) {
                        next_chat_message_has_same_date = true;
                    }

                    if (next_chat_message_has_same_date) {
                        $next_chat_message.removeClass('showing-day');
                    }

                    if (next_chat_message_has_same_date && $next_chat_message.hasClass(align)) {
                        $next_chat_message.removeClass('first');

                        if (new Date($next_chat_message.data('chat_message').created_at).getTime() - new Date(chat_message.created_at).getTime() < 5 * 60 * 1000) {
                            $chat_message.removeClass('showing-time');
                        }
                    }
                    else {
                        $chat_message.addClass('last');
                    }
                }
                else {
                    $chat_message.addClass('last');
                }

                if (chat_message.id == chat_message_id) {
                    $around_chat_message = $chat_message;
                }
            });

            if (response.count_of_chat_messages_before > 0) {
                $chat_history__messages.find('.chat-load-more-messages.before').removeClass('hidden');
            }

            if (response.count_of_chat_messages_after > 0) {
                $chat_history__messages.find('.chat-load-more-messages.after').removeClass('hidden');
            }

            if (response.chat_messages.length == 0) {
                $chat_history__messages.find('.chat-no-messages').removeClass('hidden');
            }

            if ($around_chat_message.length > 0) {
                var current_chat_history_scroll_top = $chat_history.scrollTop();
                var chat_message_position_top = $around_chat_message.offset().top - $chat_history.offset().top + current_chat_history_scroll_top;
                $chat_history.scrollTop(chat_message_position_top);
            }

            updateCurrentChatHistoryDay();
            // scrollActiveChatToMessage(chat_message_id);
            // updateCountOfUnreadChatMessages({ animate: false });
        });
    };

    var addChatMessageToActiveChat = function(chat_message) {
        var was_online = $active_chat.find('.chat__online-status').hasClass('online');

        $active_chat.html($(template('chat', {
            chat: active_chat,
            chat_typing_interlocutors: getChatTypingInterlocutors(active_chat.id),
            interlocutor_type: (business_id ? 'Business' : 'User'),
            emojiCodeToChars: emojiCodeToChars,
        })).html());

        $active_chat.find('.chat__online-status').removeClass('offline online').addClass(was_online ? 'online' : 'offline');
        var $chat_history__messages = $('.chat-history__messages.main');
        var $chat_messages = $chat_history__messages.find('.chat-messages');
        var align = null;

        if (chat_message.member.business) {
            align = (business_id == chat_message.member.business.id ? 'right' : 'left');
        }
        else if (chat_message.member.user) {
            align = (user.data.id == chat_message.member.user.id ? 'right' : 'left');
        }
        else {
            align = 'left';
        }

        var $chat_message = $(template('chat-message', {
            chat_message:       chat_message,
            align:              align,
            search:             false,
            emojiCodeToChars:   emojiCodeToChars,
        })).data({ chat_message: chat_message }).addClass('last showing-time').appendTo($chat_messages);

        var $previous_chat_message = $chat_messages.children().last().prev();

        if ($previous_chat_message.length > 0 && $previous_chat_message.hasClass(align)) {
            $previous_chat_message.removeClass('last showing-time');
        }
        else {
            $chat_message.addClass('first');
        }

        $active_chat.prependTo($chats);

        checkMyInterlocutorLastReadMessage(function(request_was) {
            if (request_was) {
                updateCountOfUnreadChatMessages({
                    animate: false,
                    chat_id: active_chat.id,
                });
            }
        });
    };

    var sendActiveChatTyping = function() {
        if (Date.now() - last_sent_active_chat_typing < 2500) {
            return;
        }

        requests.emitChatTyping({
            chat_id: active_chat.id,
        });

        last_sent_active_chat_typing = Date.now();
    };

    var scrollActiveChatToEnd = function() {
        if (active_chat) {
            var $chat_history = $('.chat-history');
            $chat_history.scrollTop($chat_history[0].scrollHeight - $chat_history.height());
        }
    };

    var updateCountOfUnreadChatMessages = function(options) {
        options = options || {};
        options.animate = (options.animate !== undefined ? options.animate : true);

        requests.getCountOfUnreadChatMessages({ chat_id: options.chat_id }, function(response) {
            $('#menu-content .realtime__total-count-of-unread-chats-with-unread-messages').text(response.total_count).each(function() {
                if (response.total_count > 0) {
                    $(this).removeClass('animated bounceIn').each(function() {
                        var $this = $(this);

                        if (options.animate) {
                            setTimeout(function() {
                                $this.addClass('animated bounceIn').show();
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

            $('.navbar .realtime__total-count-of-unread-chats-with-unread-messages').text(response.total_count).each(function() {
                if (response.total_count > 0) {
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

            $('.notification_dashboard_user.realtime__total-count-of-unread-chats-with-unread-messages').text(response.total_count).each(function() {
                if (response.total_count > 0) {
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

            $('.mini-chat-window .realtime__total-count-of-unread-chats-with-unread-messages').text(response.total_count).each(function() {
                if (response.total_count > 0) {
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

            if (options.chat_id) {
                var $chat = $('.chat[data-id="' + options.chat_id + '"]');

                if ($chat.length > 0) {
                    var chat = $chat.data('chat');
                    chat.count_of_unread_messages = response.count;
                    var was_online = $chat.find('.chat__online-status').hasClass('online');

                    $chat.html($(template('chat', {
                        chat: chat,
                        chat_typing_interlocutors: getChatTypingInterlocutors(chat.id),
                        interlocutor_type: (business_id ? 'Business' : 'User'),
                        emojiCodeToChars: emojiCodeToChars,
                    })).html());

                    $chat.find('.chat__online-status').removeClass('offline online').addClass(was_online ? 'online' : 'offline');

                    if (chat.count_of_unread_messages > 0) {
                        $chat.find('.chat__count-of-unread-messages').removeClass('animated bounceIn').each(function() {
                            var $this = $(this);

                            if (options.animate) {
                                setTimeout(function() {
                                    $this.addClass('animated bounceIn').show();
                                }, 10);
                            }
                            else {
                                $this.show()
                            }
                        });
                    }
                }
            }
        });
    };

    var updateCurrentChatHistoryDay = function() {
        var $chat_history = $('.chat-history');
        var $chat_history__messages = $('.chat-history__messages.' + (search && !search.hidden ? 'search' : 'main'));
        var $chat_messages = $chat_history__messages.find('.chat-messages');
        var $first_chat_message = $($chat_messages[0].firstChild);
        var $current_chat_history_day = $('.chat-history__current-day');

        if ($first_chat_message.length == 0) {
            $current_chat_history_day.addClass('hidden');
            return;
        }

        var current_chat_history_scroll_top = $chat_history.scrollTop();
        var last_chat_message_position_top = 0;

        for ( ; $first_chat_message.length > 0; ) {
            last_chat_message_position_top = $first_chat_message.offset().top - $chat_history.offset().top + current_chat_history_scroll_top;

            if (current_chat_history_scroll_top > last_chat_message_position_top) {
                $first_chat_message = $first_chat_message.next();
                continue;
            }

            break;
        }

        var $first_shown_chat_message = $first_chat_message;
        var $first_showing_day_chat_message = null;

        if ($first_chat_message.length > 0) {
            $first_showing_day_chat_message = $first_shown_chat_message.prevAll('.chat-message.showing-day:first');
        }
        else {
            $first_showing_day_chat_message = $($chat_messages[0].lastChild);
        }

        var current_chat_history_day_text = '';
        var $current_chat_history_day_value = $('.chat-history__current-day__value');

        if ($first_shown_chat_message.hasClass('showing-day')) {
            if (last_chat_message_position_top - current_chat_history_scroll_top < 25) {
                $current_chat_history_day.addClass('hidden');
            }
            else {
                if ($first_showing_day_chat_message.length > 0) {
                    current_chat_history_day_text = $first_showing_day_chat_message.find('.chat-message__day').text();

                    if ($current_chat_history_day_value.text() != current_chat_history_day_text) {
                        $current_chat_history_day_value.text(current_chat_history_day_text);
                    }

                    if ($current_chat_history_day.hasClass('hidden')) {
                        // console.log('RIGHT', $chat_history.outerWidth() - $first_showing_day_chat_message.outerWidth());

                        $current_chat_history_day.css({
                            right: ($chat_history.outerWidth() - $first_showing_day_chat_message.outerWidth()) + 'px',
                        });

                        $current_chat_history_day.removeClass('hidden');
                        // console.log('B', $first_showing_day_chat_message.find('.chat-message__day').text());
                    }
                }
                else {
                    $current_chat_history_day.addClass('hidden');
                }
            }
        }
        else {
            current_chat_history_day_text = $first_showing_day_chat_message.find('.chat-message__day').text();

            if ($current_chat_history_day_value.text() != current_chat_history_day_text) {
                $current_chat_history_day_value.text(current_chat_history_day_text);
            }

            if ($current_chat_history_day.hasClass('hidden')) {
                // console.log('RIGHT', $chat_history.outerWidth() - $first_showing_day_chat_message.outerWidth());

                $current_chat_history_day.css({
                    right: ($chat_history.outerWidth() - $first_showing_day_chat_message.outerWidth()) + 'px',
                });

                $current_chat_history_day.removeClass('hidden');
                // console.log('C', $first_showing_day_chat_message.find('.chat-message__day').text());
            }
        }
    };

    var getActiveChatLastShownMessage = function() {
        var $chat_history = $('.chat-history');
        var $chat_history__messages = $('.chat-history__messages.main');
        var $chat_messages = $chat_history__messages.find('.chat-messages');
        var $last_chat_message = $($chat_messages[0].lastChild);
        var current_chat_history_scroll_top = $chat_history.scrollTop();

        for ( ; $last_chat_message.length > 0; ) {
            var last_chat_message_position_top = $last_chat_message.offset().top - $chat_history.offset().top + current_chat_history_scroll_top;
            var last_chat_message_height = $last_chat_message.height();
            var chat_history_height = $chat_history.height();

            if (current_chat_history_scroll_top + chat_history_height < last_chat_message_position_top + last_chat_message_height) {
                $last_chat_message = $last_chat_message.prev();
                continue;
            }

            return $last_chat_message.data('chat_message');
        }

        return null;
    };

    var checkMyInterlocutorLastReadMessage = function(done) {
        if (!active_chat) {
            return done && done(false);
        }

        if (search) {
            return done && done(false);
        }

        var last_shown_message = getActiveChatLastShownMessage();

        if (!last_shown_message) {
            return done && done(false);
        }

        if (active_chat.my_interlocutor && parseInt(active_chat.my_interlocutor.last_read_message_id) >= parseInt(last_shown_message.id)) {
            return done && done(false);
        }

        update_chat_interlocutor_last_read_message_timeout && clearTimeout(update_chat_interlocutor_last_read_message_timeout);
        update_chat_interlocutor_last_read_message_timeout = null;

        update_chat_interlocutor_last_read_message_timeout = setTimeout(function() {
            update_chat_interlocutor_last_read_message_timeout = null;
            update_chat_interlocutor_last_read_message_request && update_chat_interlocutor_last_read_message_request.abort();

            update_chat_interlocutor_last_read_message_request = requests.updateChatInterlocutorLastReadMessage({
                chat_id:                active_chat.id,
                business_id:            business_id,
                last_read_message_id:   last_shown_message.id,
            }, function(interlocutor) {
                if (interlocutor.chat_id != active_chat.id) {
                    return;
                }

                active_chat.my_interlocutor = interlocutor;
                done && done(true);
            });
        }, 200);
    };

    var getChatTypingInterlocutors = function(chat_id) {
        return typing_interlocutors.filter(function(typing_interlocutor) {
            return typing_interlocutor.chat_id == chat_id;
        });
    };

    var updateChatTyping = function(chat_id) {
        var chat = getChatById(chat_id);

        if (!chat) {
            return;
        }

        var chat_typing_interlocutors = getChatTypingInterlocutors(chat.id);
        var $chat = $('.chat[data-id="' + chat.id + '"]');

        if ($chat.length == 0) {
            return;
        }

        var was_online = $chat.find('.chat__online-status').hasClass('online');

        $chat.html($(template('chat', {
            chat: $chat.data('chat'),
            chat_typing_interlocutors: chat_typing_interlocutors,
            interlocutor_type: (business_id ? 'Business' : 'User'),
            emojiCodeToChars: emojiCodeToChars,
        })).html());

        $chat.find('.chat__online-status').removeClass('offline online').addClass(was_online ? 'online' : 'offline')

        if (active_chat && active_chat.id == chat.id) {
            if (chat_typing_interlocutors.length == 0) {
                $('.chat-typing').removeClass('active');
            }
            else {
                $('.chat-typing__interlocutors').html(template('chat-typing-interlocutors', {
                    typing_interlocutors: chat_typing_interlocutors,
                }));

                $('.chat-typing').addClass('active');
            }
        }
    };

    var updateDaysAgoInChatHistory = function() {
        if (!active_chat) {
            return;
        }

        $('.chat-messages.showing-day').each(function() {
            var chat_message = $(this).data('chat_message');
            var chat_message_created_at_day = chat_message.created_at.split(/T/)[0];

            if (new Date().toISOString().split(/T/)[0] == chat_message_created_at_day) {
                $(this).find('.chat-message__day-value').text(Langs.todayt);
                return;
            }

            if (new Date(new Date().getTime() - 86400 * 1000).toISOString().split(/T/)[0] == chat_message_created_at_day) {
                $(this).find('.chat-message__day-value').text(Langs.yesterdayt);
                return;
            }

            $(this).find('.chat-message__day-value').text(new Date(chat_message.created_at).toUTCString().split(/\s+/).slice(1, 4).join(' '));
        });
    };

    var textifyHtmlableString = function(value) {
        // Convert `&amp;` to `&`.
        value = value.replace(/&amp;/gi, '&');

        // Replace spaces.
        value = value.replace(/&nbsp;/gi, ' ');
        value = value.replace(/\s+/g, ' ');

        // Remove "<b>".
        value = value.replace(/<b>/gi, '');
        value = value.replace(/<\/b>/gi, '');

        // Remove "<strong>".
        value = value.replace(/<strong>/gi, '');
        value = value.replace(/<\/strong>/gi, '');

        // Remove "<i>".
        value = value.replace(/<i>/gi, '');
        value = value.replace(/<\/i>/gi, '');

        // Remove "<em>".
        value = value.replace(/<em>/gi, '');
        value = value.replace(/<\/em>/gi, '');

        // Remove "<u>".
        value = value.replace(/<u>/gi, '');
        value = value.replace(/<\/u>/gi, '');

        // Tighten up "<" and ">".
        // value = value.replace(/>\s+/g, '>');
        // value = value.replace(/\s+</g, '<');

        // Replace "<br>".
        value = value.replace(/<br>/gi, '\n');

        // Replace "<div>" (from Chrome).
        value = value.replace(/<div>/gi, '\n');
        value = value.replace(/<\/div>/gi, '');

        // Replace "<p>" (from IE).
        value = value.replace(/<p>/gi, '\n');
        value = value.replace(/<\/p>/gi, '');

        // No more than 2x newline, per "paragraph".
        value = value.replace(/\n{3,}/g, '\n\n');
        value = value.replace(/ {2,}/g, ' ');

        // Whitespace before/after.
        value = $.trim(value);

        return value;
    };

    var emojiCodeToChars = function(string) {
        if (!string.match(/[0-9A-Z]{4,16}/i)) {
            return '';
        }

        var count_of_chars = Math.floor(string.length / 4);
        var chars = '';

        for (var char_index = 0; char_index < count_of_chars; ++char_index) {
            chars += String.fromCharCode(parseInt(string.slice(char_index * 4, char_index * 4 + 4), 16));
        }

        return chars;
    };

    var sendChatMessage = function(text) {
        if (!text) {
            return;
        }

        text = text.replace(/\<img class="emoji" src="\/img\/emoji\/(.*?)\.png" alt=""\s*\/?\>/ig, function($0, $1) {
            return emojiCodeToChars($1);
        });

        requests.sendChatMessage({
            chat_message: {
                text: text,
            },

            chat: {
                id: parseInt(active_chat.id),
            },
        }, function(created_chat_message) {
            $('.new-chat-message__text').html('').focus();
            $('.new-chat-message__text__placeholder').show();

            if (active_chat.last_message.id >= created_chat_message.id) {
                return;
            }

            active_chat.last_message = created_chat_message;

            if ($('.chat-history__messages.main .chat-load-more-messages.after').hasClass('hidden')) {
                addChatMessageToActiveChat(created_chat_message);
                scrollActiveChatToEnd();
            }
        });
    };

    var pasteHtmlAtCaret = function(html) {
        var sel, range;
        if (window.getSelection) {
            // IE9 and non-IE
            sel = window.getSelection();
            if (sel.getRangeAt && sel.rangeCount) {
                range = sel.getRangeAt(0);
                range.deleteContents();

                // Range.createContextualFragment() would be useful here but is
                // non-standard and not supported in all browsers (IE9, for one)
                var el = document.createElement("div");
                el.innerHTML = html;
                var frag = document.createDocumentFragment(), node, lastNode;
                while ( (node = el.firstChild) ) {
                    lastNode = frag.appendChild(node);
                }
                range.insertNode(frag);

                // Preserve the selection
                if (lastNode) {
                    range = range.cloneRange();
                    range.setStartAfter(lastNode);
                    range.collapse(true);
                    sel.removeAllRanges();
                    sel.addRange(range);
                }
            }
        } else if (document.selection && document.selection.type != "Control") {
            // IE < 9
            document.selection.createRange().pasteHTML(html);
        }
    };

    var recalculateIsMobile = function() {
        is_mobile = is_messages_path && ($(window).outerWidth() < 768);
    };

    var initialize = function() {
        if (window.user) {
            updateCountOfUnreadChatMessages({ animate: false });
        }

        is_messages_path = [
            window.location.pathname.indexOf('/user/messages'),
            window.location.pathname.indexOf('/business/messages'),
        ].some(function(index) {
            return index > -1;
        });

        is_employers_path = [
            window.location.pathname.indexOf('/employers'),
        ].some(function(index) {
            return index > -1;
        });

        if (is_messages_path) {
            $('.mini-chat-window').remove();
        }

        $chats = $('.chats');
        recalculateIsMobile();

        if (window.user) {
            if (business_id) {
                $('.chat-request-interview-button').show();
            }
            else {
                $('.chat-request-interview-button').hide();
            }
        }

        window.user && requests.getChats({
            count: count_of_chats_to_load,
        }, function(response) {
            if (response.chats.length > 0) {
                lower_chat_message_id = response.chats[response.chats.length - 1].last_message.id;
            }

            if (response.chats.length == 0) {
                $('.chat-no-chats').removeClass('hidden');
            }

            response.chats.forEach(function(chat) {
                chats.push(chat);

                if(chat.last_message.interlocutor.user === null){
                    chat.last_message.interlocutor.user = {
                      first_name: "",
                      last_name: "",
                    };
                }

                $(template('chat', {
                    chat: chat,
                    chat_typing_interlocutors: getChatTypingInterlocutors(chat.id),
                    interlocutor_type: (business_id ? 'Business' : 'User'),
                    emojiCodeToChars: emojiCodeToChars,
                })).data({ chat: chat }).attr('data-id', chat.id).appendTo($chats);
            });

            var $last_chat = $chats.children().first();

            if (is_messages_path) {
                if ($last_chat.length > 0) {
                    $('#chat-content').show();

                    if (is_mobile) {
                        $('#chat-content').addClass('mobile');
                        $('#chat-content-chats').show();
                        $('#chat-content-messages').hide();
                        $('.chat-back-to-chats').show();
                    }
                    else {
                        $('.chat-back-to-chats').hide();
                        makeChatActive($last_chat.data('chat'), $last_chat);
                    }
                }
                else {
                    $('#no-chat-messages-yet-for-' + (business_id ? 'business' : 'user')).show();
                    var type = window.location.pathname.split('/');
                    if (type.length > 2 && business.currentID) {
                        new GraphQL("query", "getHowToStartGotIt", {
                            'business_id': business.currentID,
                            'user_id': user.data.id,
                            'type': type[2],
                            'section': type[1]
                        }, [
                            'result',
                            'token'
                        ], true, false, function () {
                            //
                        }, function (data) {
                            if (data.result == 'show') {
                                $('.chat__how-to-start-for-' + (business_id ? 'business' : 'user')).show();
                            } else {
                                $('.chat__how-to-start-for-' + (business_id ? 'business' : 'user')).hide();
                            }
                        }, false).request();
                    }
                    else {
                        $('.chat__how-to-start-for-' + (business_id ? 'business' : 'user')).hide();
                    }
                    //$('.chat__how-to-start-for-' + (business_id ? 'business' : 'user')).show();
                }
            }
            else {
                //
            }

            $(document).on('click', '.chat', function(event) {
                event.preventDefault();

                if (active_chat_message_loading_request) {
                    return;
                }

                makeChatActive($(this).data('chat'), $(this));
            });

            $(document).on('keydown', '.new-chat-message__text', function(event) {
                if (event.keyCode != 13) {
                    return;
                }

                if (event.shiftKey) {
                    return; // new line
                }

                if (!active_chat) {
                    event.preventDefault();
                    return false;
                }

                $('.new-chat-message__text').blur();
                var text = $('.new-chat-message__text').html();
                text = textifyHtmlableString(text);
                text = text.trim();

                if (!text) {
                    event.preventDefault();
                    return false;
                }

                sendChatMessage(text);
            });

            $(document).on('click', '.new-chat-message__send', function(event) {
                if (!$('.new-chat-message__text').html()) {
                    return;
                }

                $('.new-chat-message__text').blur();
                var text = $('.new-chat-message__text').html();
                text = textifyHtmlableString(text);
                text = text.trim();

                if (!text) {
                    event.preventDefault();
                    return false;
                }

                sendChatMessage(text);
            });

            $(document).on('keyup', '.new-chat-message__text', function() {
                if ($(this).html()) {
                    $('.new-chat-message__send').prop('disabled', false);
                }
                else {
                    $('.new-chat-message__send').prop('disabled', true);
                }

                sendActiveChatTyping();
            });

            $(document).on('input', '.new-chat-message__text', function() {
                if ($(this).html()) {
                    $('.new-chat-message__text__placeholder').hide();
                }
                else {
                    $('.new-chat-message__text__placeholder').show();
                }
            });

            $(document).on('paste', '.new-chat-message__text', function(event) {
                event.preventDefault();
                var text = "";

                if (event.originalEvent.clipboardData && event.originalEvent.clipboardData.getData) {
                    text = event.originalEvent.clipboardData.getData('Text');
                }
                else if (window.clipboardData && window.clipboardData.getData) {
                    text = window.clipboardData.getData('Text');
                }

                Emoji.forEach(function(emoji_code) {
                    var emoji_chars = emojiCodeToChars(emoji_code);

                    text = text.replace(
                        new RegExp(emoji_chars, 'g'),
                        '<img class="emoji" src="/img/emoji/' + emoji_code + '.png" alt="' + emoji_chars + '">'
                    );
                });

                document.execCommand('insertHTML', false, text);
            });

            $(document).on('click', function(event) {
                if ($('.new-chat-message__emoji-window').hasClass('open')) {
                    if ($(event.target).closest('.new-chat-message__emoji-window').length == 0) {
                        $('.new-chat-message__emoji-window').removeClass('open');
                        $('.new-chat-message__emoji').removeClass('pressed');
                    }
                }
            });

            $(document).on('click', '.new-chat-message__emoji', function(event) {
                if ($('.new-chat-message__emoji').hasClass('pressed')) {
                    $('.new-chat-message__emoji-window').removeClass('open');
                    $('.new-chat-message__emoji').removeClass('pressed');
                }
                else {
                    setTimeout(function() {
                        $('.new-chat-message__emoji-window').addClass('animated open').focus();
                        $('.new-chat-message__emoji').addClass('pressed');
                    }, 0);
                }
            });

            $(document).on('click', '.new-chat-message__emoji-window .emoji-content__category__emoji', function(event) {
                event.preventDefault();

                if ($(window.getSelection().anchorNode).closest('.new-chat-message__text').length > 0) {
                    pasteHtmlAtCaret('<img class="emoji" src="/img/emoji/' + $(this).attr('data-code') + '.png" alt="" />');
                    $('.new-chat-message__text__placeholder').hide();
                    $('.new-chat-message__send').prop('disabled', false);
                }
            });

            $(document).on('click', '.chat-load-more-messages', function(event) {
                var $chat_load_more_messages = $(this);
                event.preventDefault();
                var $chat_history = $('.chat-history');
                var $chat_history__loader = null;

                if ($chat_load_more_messages.hasClass('before')) {
                    $chat_history__loader = $chat_history.find('.chat-history__loader.before');
                }
                else if ($chat_load_more_messages.hasClass('after')) {
                    $chat_history__loader = $chat_history.find('.chat-history__loader.after');
                }

                var $chat_history__messages = $chat_history.find('.chat-history__messages.' + (search && !search.hidden ? 'search' : 'main'));
                var $chat_messages = $chat_history__messages.find('.chat-messages');
                $chat_history__loader.removeClass('hidden');
                $chat_load_more_messages.addClass('hidden');
                active_chat_message_loading_request && active_chat_message_loading_request.abort();
                var before_id = 0;
                var after_id = 0;

                if ($chat_load_more_messages.hasClass('before')) {
                    before_id = parseInt($($chat_messages[0].firstChild).attr('data-id')) || 0;
                }
                else if ($chat_load_more_messages.hasClass('after')) {
                    after_id = parseInt($($chat_messages[0].lastChild).attr('data-id')) || 0;
                }

                active_chat_message_loading_request = requests.getCurrentChatMessages({
                    before_id:  before_id,
                    after_id:   after_id,
                    count:      count_of_messages_to_load,
                    text:       (search && !search.hidden ? search.text : ''),
                }, function(response) {
                    active_chat_message_loading_request = null;
                    var currentScrollTop = $chat_history.scrollTop();
                    var currentScrollBottom = $chat_history[0].scrollHeight - $chat_history.scrollTop() - $chat_history.height();
                    $chat_history__loader.addClass('hidden');

                    if (response.chat_messages.length == 0) {
                        return;
                    }

                    if ($chat_load_more_messages.hasClass('before')) {
                        response.chat_messages.slice().reverse().forEach(function(chat_message) {
                            var align = null;

                            if (chat_message.member.business) {
                                align = (business_id == chat_message.member.business.id ? 'right' : 'left');
                            }
                            else if (chat_message.member.user) {
                                align = (user.data.id == chat_message.member.user.id ? 'right' : 'left');
                            }
                            else {
                                align = 'left';
                            }

                            var $chat_message = $(template('chat-message', {
                                chat_message:       chat_message,
                                align:              align,
                                search:             (search ? true : false),
                                emojiCodeToChars:   emojiCodeToChars,
                            })).data({ chat_message: chat_message }).addClass('first showing-day showing-time').prependTo($chat_messages);

                            var $next_chat_message = $chat_message.next();

                            if ($next_chat_message.length > 0) {
                                var next_chat_message_has_same_date = false;

                                if (chat_message.created_at.split(/T/)[0] == $next_chat_message.data('chat_message').created_at.split(/T/)[0]) {
                                    next_chat_message_has_same_date = true;
                                }

                                if (next_chat_message_has_same_date) {
                                    $next_chat_message.removeClass('showing-day');
                                }

                                if (next_chat_message_has_same_date && $next_chat_message.hasClass(align)) {
                                    $next_chat_message.removeClass('first');

                                    if (new Date($next_chat_message.data('chat_message').created_at).getTime() - new Date(chat_message.created_at).getTime() < 5 * 60 * 1000) {
                                        $chat_message.removeClass('showing-time');
                                    }
                                }
                                else {
                                    $chat_message.addClass('last');
                                }
                            }
                            else {
                                $chat_message.addClass('last');
                            }
                        });

                        if (response.count_of_chat_messages_before > 0) {
                            $chat_load_more_messages.removeClass('hidden');
                        }

                        $chat_history.scrollTop($chat_history[0].scrollHeight - currentScrollBottom - $chat_history.height());
                    }
                    else if ($chat_load_more_messages.hasClass('after')) {
                        response.chat_messages.forEach(function(chat_message) {
                            var align = null;

                            if (chat_message.member.business) {
                                align = (business_id == chat_message.member.business.id ? 'right' : 'left');
                            }
                            else if (chat_message.member.user) {
                                align = (user.data.id == chat_message.member.user.id ? 'right' : 'left');
                            }
                            else {
                                align = 'left';
                            }

                            var $chat_message = $(template('chat-message', {
                                chat_message:       chat_message,
                                align:              align,
                                search:             (search ? true : false),
                                emojiCodeToChars:   emojiCodeToChars,
                            })).data({ chat_message: chat_message }).addClass('last showing-time').appendTo($chat_messages);

                            var $previous_chat_message = $chat_message.prev();

                            if ($previous_chat_message.length > 0) {
                                var previous_chat_message_has_same_date = false;

                                if (chat_message.created_at.split(/T/)[0] == $previous_chat_message.data('chat_message').created_at.split(/T/)[0]) {
                                    previous_chat_message_has_same_date = true;
                                }

                                if (!previous_chat_message_has_same_date) {
                                    $chat_message.addClass('showing-day');
                                }

                                if (previous_chat_message_has_same_date && $previous_chat_message.hasClass(align)) {
                                    $previous_chat_message.removeClass('last');

                                    if (new Date(chat_message.created_at).getTime() - new Date($previous_chat_message.data('chat_message').created_at).getTime() < 5 * 60 * 1000) {
                                        $previous_chat_message.removeClass('showing-time');
                                    }
                                }
                                else {
                                    $chat_message.addClass('first');
                                }
                            }
                            else {
                                $chat_message.addClass('first');
                            }
                        });

                        if (response.count_of_chat_messages_after > 0) {
                            $chat_load_more_messages.removeClass('hidden');
                        }

                        $chat_history.scrollTop(currentScrollTop);
                    }
                });
            });

            $(document).on('click', '.chat-message-search__cross', function(event) {
                event.preventDefault();
                $('.chat-history__messages.search').addClass('hidden');
                $('.chat-history__messages.main').removeClass('hidden');
                $('.chat-message-search__cross').addClass('hidden');
                $('.chat-message-search__back').addClass('hidden');
                $('.chat-message-search__text').val('');
                $('.new-chat-message__text').prop('disabled', false);
                $('.chat-history').scrollTop(search.previousScrollTop);
                search = null;
            });

            $(document).on('click', '.chat-message-search__back', function(event) {
                event.preventDefault();
                search.hidden = false;
                search.previousScrollTop = $('.chat-history').scrollTop();
                $('.chat-history__messages.main').addClass('hidden');
                $('.chat-history__messages.search').removeClass('hidden');
                $('.new-chat-message__text').prop('disabled', true);
                $('.chat-message-search__back').addClass('hidden');
                $('.chat-history').scrollTop(search.scrollTop);
            });

            $(document).on('keyup', '.chat-message-search__text', function(event) {
                if (search && !$(this).val()) {
                    $('.chat-history__messages.search').addClass('hidden');
                    $('.chat-history__messages.main').removeClass('hidden');
                    $('.chat-message-search__cross').addClass('hidden');
                    $('.new-chat-message__text').prop('disabled', false);
                    $('.chat-history').scrollTop(search.previousScrollTop);
                    search = null;
                    search_request_timeout && clearTimeout(search_request_timeout);
                    search_request_timeout = null;
                    active_chat_search_request && active_chat_search_request.abort();
                    active_chat_search_request = null;
                    return;
                }

                if (!search) {
                    search = { previousScrollTop: $('.chat-history').scrollTop() };
                }

                search.text = $(this).val();
                $('.chat-history__messages.main').addClass('hidden');
                $('.chat-message-search__cross').removeClass('hidden');
                $('.chat-history__current-day').addClass('hidden');
                $('.new-chat-message__text').prop('disabled', true);
                var $chat_history__messages = $('.chat-history__messages.search');
                $chat_history__messages.removeClass('hidden');
                var $chat_messages = $chat_history__messages.find('.chat-messages');
                $chat_messages.html('');
                $chat_history__messages.find('.chat-no-messages').addClass('hidden');
                $chat_history__messages.find('.chat-history__loader').removeClass('hidden');
                $chat_history__messages.find('.chat-load-more-messages').addClass('hidden');
                search_request_timeout && clearTimeout(search_request_timeout);
                active_chat_search_request && active_chat_search_request.abort();
                active_chat_search_request = null;

                search_request_timeout = setTimeout(function() {
                    active_chat_search_request && active_chat_search_request.abort();

                    active_chat_search_request = requests.getCurrentChatMessages({
                        count:      count_of_messages_to_load,
                        text:       search.text,
                    }, function(response) {
                        active_chat_search_request = null;
                        $('.chat-history__loader').addClass('hidden');

                        if (response.chat_messages.length == 0) {
                            $chat_history__messages.find('.chat-no-messages').removeClass('hidden');
                            return;
                        }

                        response.chat_messages.slice().reverse().forEach(function(chat_message) {
                            var align = null;

                            var align = null;

                            if (chat_message.member.business) {
                                align = (business_id == chat_message.member.business.id ? 'right' : 'left');
                            }
                            else if (chat_message.member.user) {
                                align = (user.data.id == chat_message.member.user.id ? 'right' : 'left');
                            }
                            else {
                                align = 'left';
                            }

                            var $chat_message = $(template('chat-message', {
                                chat_message:       chat_message,
                                align:              align,
                                search:             true,
                                emojiCodeToChars:   emojiCodeToChars,
                            })).data({ chat_message: chat_message }).addClass('first showing-day').prependTo($chat_messages);

                            var $next_chat_message = $chat_message.next();

                            if ($next_chat_message.length > 0) {
                                var next_chat_message_has_same_date = false;

                                if (chat_message.created_at.split(/T/)[0] == $next_chat_message.data('chat_message').created_at.split(/T/)[0]) {
                                    next_chat_message_has_same_date = true;
                                }

                                if (next_chat_message_has_same_date) {
                                    $next_chat_message.removeClass('showing-day');
                                }

                                if (next_chat_message_has_same_date && $next_chat_message.hasClass(align)) {
                                    $next_chat_message.removeClass('first');
                                }
                                else {
                                    $chat_message.addClass('last');
                                }
                            }
                            else {
                                $chat_message.addClass('last');
                            }
                        });

                        if (response.count_of_chat_messages_before > 0) {
                            $chat_history__messages.find('.chat-load-more-messages.before').removeClass('hidden');
                        }

                        if (response.count_of_chat_messages_after > 0) {
                            $chat_history__messages.find('.chat-load-more-messages.after').removeClass('hidden');
                        }

                        scrollActiveChatToEnd();
                    });
                }, 250);
            });

            $(document).on('click', '.chat-list__load-more', function(event) {
                event.preventDefault();
                $('.chat-list__loader').removeClass('hidden');
                $(this).addClass('hidden');
                var $chat_search = $('.chat-search');
                chat_list_loading_request && chat_list_loading_request.abort();

                chat_list_loading_request = requests.getChats({
                    before_last_message_id:     lower_chat_message_id,
                    count:                      count_of_chats_to_load,
                    name:                       $chat_search.val(),
                }, function(response) {
                    chat_list_loading_request = null;
                    $('.chat-list__loader').addClass('hidden');

                    if (response.chats.length == 0) {
                        return;
                    }

                    lower_chat_message_id = response.chats[response.chats.length - 1].last_message.id;

                    response.chats.forEach(function(chat) {
                        chats.push(chat);

                        $(template('chat', {
                            chat: chat,
                            chat_typing_interlocutors: getChatTypingInterlocutors(chat.id),
                            interlocutor_type: (business_id ? 'Business' : 'User'),
                            emojiCodeToChars: emojiCodeToChars,
                        })).data({ chat: chat }).attr('data-id', chat.id).appendTo($chats);
                    });

                    if (response.chats.length >= count_of_chats_to_load) {
                        $('.chat-list__load-more').removeClass('hidden');
                    }
                });
            });

            $(document).on('click', '.chat-search__cross', function(event) {
                event.preventDefault();
                chats = [];
                $chats.html('');
                var $chat_search = $('.chat-search');
                $chat_search.val('');
                $('.no-chats').addClass('hidden');
                $('.chat-list__loader').removeClass('hidden');
                $('.chat-list__load-more').addClass('hidden');
                $(this).addClass('hidden');
                chat_list_loading_request && chat_list_loading_request.abort();

                chat_list_loading_request = requests.getChats({
                    count:      count_of_chats_to_load,
                    name:       $chat_search.val(),
                }, function(response) {
                    chat_list_loading_request = null;
                    $('.chat-list__loader').addClass('hidden');

                    if (response.chats.length == 0) {
                        $('.no-chats').removeClass('hidden');
                        return;
                    }
                    $('.chat-history__messages.main').addClass('hidden');

                    lower_chat_message_id = response.chats[response.chats.length - 1].last_message.id;

                    response.chats.forEach(function(chat) {
                        chats.push(chat);

                        $(template('chat', {
                            chat: chat,
                            chat_typing_interlocutors: getChatTypingInterlocutors(chat.id),
                            interlocutor_type: (business_id ? 'Business' : 'User'),
                            emojiCodeToChars: emojiCodeToChars,
                        })).data({ chat: chat }).attr('data-id', chat.id).appendTo($chats);
                    });

                    if (response.chats.length >= count_of_chats_to_load) {
                        $('.chat-list__load-more').removeClass('hidden');
                    }
                });
            });

            $(document).on('keyup', '.chat-search', function(event) {
                chats = [];
                $chats.html('');
                var $chat_search = $('.chat-search');
                $('.no-chats').addClass('hidden');
                $('.chat-list__loader').removeClass('hidden');
                $('.chat-list__load-more').addClass('hidden');

                if ($chat_search.val()) {
                    $('.chat-search__cross').removeClass('hidden');
                }
                else {
                    $('.chat-search__cross').addClass('hidden');
                }

                chat_list_loading_request && chat_list_loading_request.abort();
                chat_list_loading_request = null;
                chat_list_loading_timeout && clearTimeout(chat_list_loading_timeout);

                chat_list_loading_timeout = setTimeout(function() {
                    chat_list_loading_request && chat_list_loading_request.abort();

                    chat_list_loading_request = requests.getChats({
                        count:      count_of_chats_to_load,
                        name:       $chat_search.val(),
                    }, function(response) {
                        chat_list_loading_request = null;
                        $('.chat-list__loader').addClass('hidden');

                        if (response.chats.length == 0) {
                            $('.no-chats').removeClass('hidden');
                            return;
                        }
                        $('.chat-history__messages.main').addClass('hidden');

                        lower_chat_message_id = response.chats[response.chats.length - 1].last_message.id;

                        response.chats.forEach(function(chat) {
                            chats.push(chat);

                            $(template('chat', {
                                chat: chat,
                                chat_typing_interlocutors: getChatTypingInterlocutors(chat.id),
                                interlocutor_type: (business_id ? 'Business' : 'User'),
                                emojiCodeToChars: emojiCodeToChars,
                            })).data({ chat: chat }).attr('data-id', chat.id).appendTo($chats);
                        });

                        if (response.chats.length >= count_of_chats_to_load) {
                            $('.chat-list__load-more').removeClass('hidden');
                        }
                    });
                }, 250);
            });

            var filter_geo = $('#job-location-filter-modal__filter-city_region-search');

            filter_geo.autocomplete({
                source: function (request, response) {
                    new GraphQL("query", "geoStreet", {
                        "key": request.term
                    }, [
                        'description',
                        'id',
                        'street'
                    ], false, false, function () {
                        response([]);
                    }, function (data) {
                        if (data.length !== 0) {
                            var transformed = $.map(data, function (el) {
                                return {
                                    label: el.description,
                                    id: el.id,
                                    data: el
                                };
                            });
                            response(transformed);
                        } else {

                        }
                    }).autocomplete();
                },
                select: function (event, ui) {
                    let html = '<div style="display: inline; margin-right: 5px;">'
                        + '<a href="javascript:void(0)" class="cardinal_links clear-all-filter list-filter-cities-regions-clear-item"><img src="'
                        + document.location.origin
                        + '/img/round-delete-button.svg" style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>'
                        + '<span class="list-filter-cities-regions-value-item" data-geo>' + ui.item.data.description +'</span></div>';
                    $('.list-filter-cities-regions').append(html);
                },
                close: function (event, ui) {
                    $('#job-location-filter-modal__filter-city_region-search').val('');
                },
                response: function (e, u) {

                }
            }).attr('autocomplete', 'disabled');

            if (!business_id) {
                $('#filters-modal').parent('.d-flex').find('.d-flex').removeClass('col-9');
                $('#filters-modal').remove();
            }
            $(document).on('click', '#filters-modal', function(event) {
                var managers = [];
                var managers_loaded = false;

                new GraphQL('query', 'businessManagers', {
                    business_id:    business_id,
                    limit:          1000000,
                }, [
                    'items { id user_id first_name last_name}',
                    'pages',
                    'current_page',
                ], true, false, function() {
                    //
                }, function(data) {
                    var ids_t = [];
                    data.items.forEach(function(manager) {
                        if (ids_t.indexOf(manager.user_id)===-1){
                            managers.push(manager);
                            ids_t.push(manager.user_id);
                        }
                    });
                    managers_loaded = true;
                    try_to_continue();
                }, false).request();

                var try_to_continue = function() {
                    if (!managers_loaded) {
                        return;
                    }

                    var $filter_city_region_search = $('#job-location-filter-modal__filter-city_region-search');
                    var $list_filter_cities_regions = $('.list-filter-cities-regions');
                    //$list_filter_cities_regions.children().remove();
                    $list_filter_cities_regions.empty();
                    $.each(filtering_city_region, function (index, value){
                        let v = value.substr(-1);
                        if (v == 'y') {
                            v = 'data-geo';
                        } else {
                            v = ' ';
                        }
                        let val = value.substr(0,value.length-4);
                        let html = '<div style="display: inline; margin-right: 5px;">'
                            + '<a href="javascript:void(0)" class="cardinal_links clear-all-filter list-filter-cities-regions-clear-item"><img src="'
                            + document.location.origin
                            + '/img/round-delete-button.svg" style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>'
                            + '<span class="list-filter-cities-regions-value-item"' + v +  ' >' + val +'</span></div>';
                        $list_filter_cities_regions.append(html);
                    });

                    var $all_managers_checkbox = $('#job-location-filter-modal__all-managers-checkbox');
                    $all_managers_checkbox.prop('checked', filtering_manager_ids.length == 0);

                    $all_managers_checkbox.click(function() {
                        $(this).prop('checked', true);

                        $managers.children().each(function() {
                            var $manager = $(this);
                            var $manager_checkbox = $manager.find('input[type="checkbox"]');
                            $manager_checkbox.prop('checked', false);
                        });
                    });

                    var $filter_managers_search = $('#job-location-filter-modal__filter-managers-search');
                    $filter_managers_search.keyup(function () {
                        var key = $(this).val();
                        if (key.length > 0 ) {
                            $all_managers_checkbox.prop('checked', false);
                        } else {
                            $all_managers_checkbox.prop('checked', true);
                        }
                        $managers.children().each(function() {
                            $(this).find('input[type="checkbox"]').prop('checked', false);
                        });
                        $('#job-location-filter-modal__managers label').each(function (index, value) {
                            if ($(this).text().indexOf(key) == -1) {
                                $(this).parent().hide();
                            } else {
                                if(!$(this).parent().is(':visible')) {
                                    $(this).parent().show();
                                }
                            }
                        });
                    });

                    var $managers = $('#job-location-filter-modal__managers');
                    $managers.html('');

                    managers.forEach(function(manager) {
                        $('' +
                            '<div class="mb-2" style="display: flex">' +
                            '<input type="checkbox" name="manager_ids[]" value="' + manager.user_id + '" class="align-self-center mr-3" id="job-location-filter-modal__managers_' + manager.user_id + '">' +
                            '<label class="mb-0" for="job-location-filter-modal__manager_' + manager.user_id + '">' + manager.first_name + ' ' + manager.last_name + '</label>' +
                            '</div>' +
                            '').appendTo($managers);
                    });

                    $managers.children().each(function() {
                        var $manager = $(this);
                        var $manager_checkbox = $manager.find('input[type="checkbox"]');
                        $manager_checkbox.prop('checked', filtering_manager_ids.indexOf(parseInt($manager_checkbox.val())) > -1);

                        $manager_checkbox.click(function() {
                            $all_managers_checkbox.prop('checked', false);
                        });
                    });

                    $list_filter_cities_regions.on('click','.list-filter-cities-regions-clear-item', function() {
                        $(this).parent().remove();
                    });

                    $filter_city_region_search.keydown(function(e) {
                        //e = e || event;
                        if (e.keyCode == 13 && $(this).val().length >0) {
                            e.preventDefault();
                            let html = '<div style="display: inline; margin-right: 5px;">'
                                + '<a href="javascript:void(0)" class="cardinal_links clear-all-filter list-filter-cities-regions-clear-item"><img src="'
                                + document.location.origin
                                + '/img/round-delete-button.svg" style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>'
                                + '<span class="list-filter-cities-regions-value-item">' + $(this).val() +'</span></div>';
                            $list_filter_cities_regions.append(html);
                            $('#ui-id-2').hide();
                            $(this).val('');
                            return false;
                        }
                    });

                    $('#job-location-filter-modal__apply-button').click(function() {
                        var current_manager_ids = [];
                        var current_cities_regions = [];

                        $managers.children().each(function() {
                            var $manager = $(this);
                            var $manager_checkbox = $manager.find('input[type="checkbox"]');

                            if (!$manager_checkbox.prop('checked')) {
                                return;
                            }

                            current_manager_ids.push(parseInt($manager_checkbox.val()));
                        });

                        if (current_manager_ids.length == 0 && $filter_managers_search.val().length > 0 && $all_managers_checkbox.is(':checked')) {
                            $managers.children().each(function() {
                                var $manager = $(this);
                                var $manager_checkbox = $manager.find('input[type="checkbox"]');

                                if ($manager.is(':visible')) {
                                    current_manager_ids.push(parseInt($manager_checkbox.val()));
                                }
                            });
                        }

                        $list_filter_cities_regions.children().each(function() {
                            var city_region = $(this).find('.list-filter-cities-regions-value-item'),
                                val = city_region.text();
                            if (city_region.attr('data-geo') !== undefined) {
                                val += '---y';
                            } else {
                                val += '---n';
                            }
                            current_cities_regions.push(val);
                        });

                        filtering_manager_ids = current_manager_ids;
                        filtering_city_region = current_cities_regions;
                        //-----
                        chats = [];
                        $chats.html('');
                        $('.no-chats').addClass('hidden');
                        $('.chat-list__loader').removeClass('hidden');
                        $('.chat-list__load-more').addClass('hidden');
                        $('.chat-history__messages.main').addClass('hidden');
                        chat_list_loading_request && chat_list_loading_request.abort();

                        chat_list_loading_request = requests.getChats({
                            count:      count_of_chats_to_load,
                        }, function(response) {
                            chat_list_loading_request = null;
                            $('.chat-list__loader').addClass('hidden');

                            if (response.chats.length == 0) {
                                $('.no-chats').removeClass('hidden');
                                return;
                            }

                            lower_chat_message_id = response.chats[response.chats.length - 1].last_message.id;

                            response.chats.forEach(function(chat) {
                                chats.push(chat);

                                $(template('chat', {
                                    chat: chat,
                                    chat_typing_interlocutors: getChatTypingInterlocutors(chat.id),
                                    interlocutor_type: (business_id ? 'Business' : 'User'),
                                    emojiCodeToChars: emojiCodeToChars,
                                })).data({ chat: chat }).attr('data-id', chat.id).appendTo($chats);
                            });

                            if (response.chats.length >= count_of_chats_to_load) {
                                $('.chat-list__load-more').removeClass('hidden');
                            }
                        });
                        //----
                        $('#job-location-filter-modal').modal('hide');
                    });

                    $('#job-location-filter-modal__clear-button').click(function() {
                        $all_managers_checkbox.prop('checked', true);

                        $managers.children().each(function() {
                            var $manager = $(this);
                            var $manager_checkbox = $manager.find('input[type="checkbox"]');
                            $manager_checkbox.prop('checked', false);
                            $manager.show();
                        });

                        $list_filter_cities_regions.children().each(function() {
                            $(this).remove();
                        });

                        filtering_manager_ids = [];
                        filtering_city_region = [];

                        $filter_managers_search.val('');
                        $filter_city_region_search.val('');
                    });

                    $('#job-location-filter-modal').modal('show');
                };
            });

            $(document).on('click', '.chat-history__messages.search .chat-message', function(event) {
                event.preventDefault();
                var chat_message_id = parseInt($(this).attr('data-id')) || 0;
                search.scrollTop = $('.chat-history').scrollTop();
                goToChatMessageInTheCurrentChat(chat_message_id);
            });

            $(document).on('click', '.chat-history__messages.main .chat-message__interview-request__change-button', function(event) {
                event.preventDefault();
                var $chat_message = $(this).parents('.chat-message:first');
                var chat_message = $chat_message.data('chat_message');
                var interview_request = chat_message.interview_request;
                $('#interview-request-modal').modal('show');
                $('#interview-request-modal__title').text('Change interview request');
                $('#interview-request-modal__button').text('Change');

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

            $(document).on('click', '.chat-history__messages.main .chat-message__interview-request__reject-button', function(event) {
                event.preventDefault();
                var $chat_message = $(this).parents('.chat-message:first');
                var chat_message = $chat_message.data('chat_message');
                var interview_request = chat_message.interview_request;

                return requests.updateInterviewRequest({
                    interview_request_id:   interview_request.id,
                    business_id:            business_id,
                    state:                  'rejected',
                }, function() {
                    $.notify('The interview was rejected!', 'success');
                });
            });

            $(document).on('click', '.chat-history__messages.main .chat-message__interview-request__withdraw-button', function(event) {
                event.preventDefault();
                var $chat_message = $(this).parents('.chat-message:first');
                var chat_message = $chat_message.data('chat_message');
                var interview_request = chat_message.interview_request;

                return requests.updateInterviewRequest({
                    interview_request_id:   interview_request.id,
                    business_id:            business_id,
                    state:                  'withdrawn',
                }, function() {
                    $.notify('The interview was withdrawn!', 'success');
                });
            });

            $(document).on('click', '.chat-history__messages.main .chat-message__interview-request__accept-button', function(event) {
                event.preventDefault();
                var $chat_message = $(this).parents('.chat-message:first');
                var chat_message = $chat_message.data('chat_message');
                var interview_request = chat_message.interview_request;

                return requests.updateInterviewRequest({
                    interview_request_id:   interview_request.id,
                    business_id:            business_id,
                    state:                  'accepted',
                }, function() {
                    $.notify('The interview was accepted!', 'success');
                });
            });

            $('.chat-history').scroll(function(event) {
                updateCurrentChatHistoryDay();

                checkMyInterlocutorLastReadMessage(function(request_was) {
                    if (request_was) {
                        updateCountOfUnreadChatMessages({
                            animate: false,
                            chat_id: active_chat.id,
                        });
                    }
                });

                var $chat_history__messages = $('.chat-history__messages.' + (search && !search.hidden ? 'search' : 'main'));
                var $chat_load_more_messages_before = $chat_history__messages.find('.chat-load-more-messages.before');
                var $chat_load_more_messages_after = $chat_history__messages.find('.chat-load-more-messages.after');

                if (($(this).scrollTop() < $(this).height() * 1.5) && !$chat_load_more_messages_before.hasClass('hidden')) {
                    $chat_load_more_messages_before.click();
                }
                else if ((this.scrollHeight - $(this).height() * 1.5 < $(this).scrollTop() + $(this).height()) && !$chat_load_more_messages_after.hasClass('hidden')) {
                    $chat_load_more_messages_after.click();
                }
            });

            $(document).on('click', '.chat-message__avatar__link', function(event) {
                if ($(this).attr('data-user-id')) {
                    event.preventDefault();
                    var user_id = $(this).attr('data-user-id');

                    new GraphQL('query', 'candidateOverview', {
                        'business_id': business_id,
                        'id': user_id,
                    }, [ 'overview', 'token' ], true, false, function() {
                        //
                    }, function(data) {
                        if (data.overview) {
                            $('#candidateOverviewModal').find('#candidate-overview-body').html(data.overview);
                            $('#candidateOverviewModal').modal('show');
                        } else {
                            $('#candidateOverviewModal').find('#candidate-overview-body').html('')
                        }
                    }).request();

                    return;
                }
            });

            $(document).on('click', '.chat-back-to-chats', function(event) {
                event.preventDefault();
                makeChatUnactive();
            });

            $(document).on('click', '.chat-request-interview-button .btn', function(event) {
                if (!active_chat) {
                    return;
                }

                var user_id = parseInt(active_chat.opposite_member.user.id);
                $('#interview-request-modal').modal('show');
                $('#interview-request-modal__title').text('Send interview request');

                $('#interview-request-modal').data('initialize')({
                    user_id: user_id,
                });
            });

            $(document).on('click', '.chat__show-how-to-start', function(event) {
                event.preventDefault();
                $('.chat__how-to-start-for-' + (business_id ? 'business' : 'user')).show();
            });

            $(document).on('click', '.chat__hide-how-to-start', function(event) {
                event.preventDefault();
                $('.chat__how-to-start-for-' + (business_id ? 'business' : 'user')).hide();
            });

            realtime.on('chats.last_read_message_updated', function(data) {

                var chat = chats.filter(function(current_chat) {
                    return current_chat.id == data.chat_id;
                }).pop() || null;

                if (chat) {
                    chat.last_read_message_id = data.last_read_message_id;
                }

                if (active_chat && active_chat.id == data.chat_id) {
                    $('.chat-message').filter(function() {
                        return $(this).data('chat_message').id <= data.last_read_message_id;
                    }).removeClass('sent').addClass('read');
                }
            });

            realtime.on('chats.interlocutor_read_last_message', function(data) {

                if (active_chat && active_chat.id == data.chat_id) {
                    if (active_chat.my_interlocutor && data.chat_interlocutor_id != active_chat.my_interlocutor.id) {
                        var remove_previous_message_read_interlocutors = function() {
                            $('.chat-message').toArray().reverse().some(function(element) {
                                var current_chat_message = $(element).data('chat_message');

                                if (current_chat_message.id >= data.last_read_chat_message_id) {
                                    return;
                                }

                                var read_interlocutor = current_chat_message.read_interlocutors.filter(function(read_interlocutor) {
                                    return read_interlocutor.id == data.chat_interlocutor_id;
                                }).pop() || null;

                                if (!read_interlocutor) {
                                    return false;
                                }

                                current_chat_message.read_interlocutors.splice(current_chat_message.read_interlocutors.indexOf(read_interlocutor), 1);

                                if (current_chat_message.read_interlocutors.length == 0) {
                                    $(element).find('.chat-message__read-interlocutors').addClass('hidden');
                                    return true;
                                }

                                $(element).find('.chat-message__read-interlocutor[data-id="' + read_interlocutor.id + '"]').addClass('hidden');
                                return true;
                            });
                        };

                        var $chat_message = $('.chat-message[data-id="' + data.last_read_chat_message_id + '"]');

                        if ($chat_message.length > 0) {
                            requests.getInterlocutor({
                                chat_id:                data.chat_id,
                                chat_interlocutor_id:   data.chat_interlocutor_id,
                            }, function(chat_interlocutor) {
                                remove_previous_message_read_interlocutors();
                                var chat_message = $chat_message.data('chat_message');
                                chat_message.read_interlocutors.push(chat_interlocutor);
                                var align = null;

                                if (chat_message.member.business) {
                                    align = (business_id == chat_message.member.business.id ? 'right' : 'left');
                                }
                                else if (chat_message.member.user) {
                                    align = (user.data.id == chat_message.member.user.id ? 'right' : 'left');
                                }
                                else {
                                    align = 'left';
                                }

                                $chat_message.html($(template('chat-message', {
                                    chat_message:       chat_message,
                                    align:              align,
                                    search:             false,
                                    emojiCodeToChars:   emojiCodeToChars,
                                })).html());
                            });
                        }
                        else {
                            remove_previous_message_read_interlocutors();
                        }
                    }
                }
            });

            realtime.updateOnlineStatuses();
        });

        if (!is_messages_path && !is_employers_path) {
            $('.mini-chat-window').draggable({
                axis: 'x',
                handle: '.mini-chat-window__move',
                opacity: 0.35,
                cursor: 'move',
                containment: 'window',

                stop: function() {
                    localStorage.setItem('mini-chat__left', $(this).css('left'));
                },
            });

            $(document).on('click', '.mini-chat-window__title', function(event) {
                event.preventDefault();

                if ($('.mini-chat-window').hasClass('maximized')) {
                    $('.mini-chat-window').removeClass('maximized');
                    localStorage.removeItem('mini-chat_is_maximized');
                }
                else {
                    $('.mini-chat-window').addClass('maximized');
                    localStorage.setItem('mini-chat_is_maximized', true);
                }
            });

            if (localStorage.getItem('mini-chat__left')) {
                $('.mini-chat-window').css('left', localStorage.getItem('mini-chat__left'));
            }

            if (localStorage.getItem('mini-chat_is_maximized')) {
                $('.mini-chat-window').addClass('maximized');
            }
            else {
                $('.mini-chat-window').removeClass('maximized');
            }

            $('.mini-chat-window').removeClass('hidden');
        }

        if (!window.user) {
            $('.chat-not-logged-in').removeClass('hidden');
        }

        window.user && is_messages_path && $(window).resize(function() {
            var old_is_mobile = is_mobile;
            recalculateIsMobile();

            if (old_is_mobile && !is_mobile) {
                $('#chat-content-chats').show();
                $('#chat-content-messages').show();
                $('.chat-back-to-chats').hide();
            }
            else if (!old_is_mobile && is_mobile) {
                $('.chat-back-to-chats').show();

                if (active_chat) {
                    $('#chat-content-chats').hide();
                    $('#chat-content-messages').show();
                }
                else {
                    $('#chat-content-chats').show();
                    $('#chat-content-messages').hide();
                }
            }
        });

        window.user && realtime.on('chats.typing', function(data) {
            return requests.getInterlocutor({
                chat_id:                data.chat_id,
                chat_interlocutor_id:   data.chat_interlocutor_id,
            }, function(interlocutor) {
                if (business_id) {
                    if (interlocutor.user.id == user.data.id && interlocutor.business && interlocutor.business.id == business_id) {
                        return;
                    }
                }
                else {
                    if (interlocutor.user.id == user.data.id && !interlocutor.business) {
                        return;
                    }
                }

                var typing_interlocutor = typing_interlocutors.filter(function(typing_interlocutor) {
                    return typing_interlocutor.id == interlocutor.id;
                }).pop() || null;

                if (typing_interlocutor) {
                    typing_interlocutor.started_at = Date.now();
                }
                else {
                    typing_interlocutors.push({
                        id:         interlocutor.id,
                        user:       interlocutor.user,
                        business:   interlocutor.business,
                        chat_id:    data.chat_id,
                        started_at: Date.now(),
                    });
                }

                updateChatTyping(data.chat_id);
                $('.global-chat-typing').addClass('active');
            });
        });

        window.user && realtime.on('chats.message_was_created', function(data) {
            typing_interlocutors = typing_interlocutors.filter(function(typing_interlocutor) {
                return typing_interlocutor.id != data.interlocutor_id;
            });

            updateChatTyping(data.chat_id);

            if (typing_interlocutors.length == 0) {
                $('.global-chat-typing').removeClass('active');
            }

            var chat = chats.filter(function(current_chat) {
                return current_chat.id == data.chat_id;
            }).pop() || null;

            (function(done) {
                if (chat) {
                    return done(chat, false);
                }

                if ($('.chat-search').val()) {
                    return done(null);
                }

                return requests.getChat(data.chat_id, function(chat) {
                    return done(chat, true);
                });
            })(function(chat, chat_did_not_exist) {
                if (!chat) {
                    updateCountOfUnreadChatMessages();
                    return; // probably search enabled, so do nothing with the message
                }

                if (!chat_did_not_exist && chat.last_message.id >= data.chat_message_id) {
                    return; // the message already exists in the current chat
                }

                return requests.getMessage({
                    chat_id:            data.chat_id,
                    chat_message_id:    data.chat_message_id,
                }, function(chat_message) {
                    if (!chat_did_not_exist && chat.last_message.id >= chat_message.id) {
                        return; // the message already exists in the current chat
                    }

                    if (!$('.chat-search').val()) {
                        var $chat = null;

                        if (chat_did_not_exist) {
                            $chat = $(template('chat', {
                                chat: chat,
                                chat_typing_interlocutors: getChatTypingInterlocutors(chat.id),
                                interlocutor_type: (business_id ? 'Business' : 'User'),
                                emojiCodeToChars: emojiCodeToChars,
                            })).data({ chat: chat });

                            chats.push(chat);

                            if (is_messages_path) {
                                $('#chat-content').show();
                                $('#no-chat-messages-yet-for-user').hide();
                                $('#no-chat-messages-yet-for-business').hide();
                            }

                            $('.chat-no-chats').addClass('hidden');
                        }
                        else {
                            chat.last_message = chat_message;
                            $chat = $chats.children('[data-id="' + chat.id + '"]');
                            var was_online = $chat.find('.chat__online-status').hasClass('online');

                            $chat.html($(template('chat', {
                                chat: chat,
                                chat_typing_interlocutors: getChatTypingInterlocutors(chat.id),
                                interlocutor_type: (business_id ? 'Business' : 'User'),
                                emojiCodeToChars: emojiCodeToChars,
                            })).html());

                            $chat.find('.chat__online-status').removeClass('offline online').addClass(was_online ? 'online' : 'offline');
                        }

                        $chat.prependTo($chats); // move chat to top

                        if (active_chat && active_chat.id == chat.id) {
                            active_chat = chat;

                            $('.chat-message').toArray().reverse().some(function(element) {
                                var current_chat_message = $(element).data('chat_message');

                                if (current_chat_message.id >= chat_message.id) {
                                    return;
                                }

                                var read_interlocutor = current_chat_message.read_interlocutors.filter(function(read_interlocutor) {
                                    return read_interlocutor.id == chat_message.interlocutor.id;
                                }).pop() || null;

                                if (!read_interlocutor) {
                                    return false;
                                }

                                current_chat_message.read_interlocutors.splice(current_chat_message.read_interlocutors.indexOf(read_interlocutor), 1);

                                if (current_chat_message.read_interlocutors.length == 0) {
                                    $(element).find('.chat-message__read-interlocutors').addClass('hidden');
                                    return true;
                                }

                                $(element).find('.chat-message__read-interlocutor[data-id="' + read_interlocutor.id + '"]').addClass('hidden');
                                return true;
                            });

                            if ($('.chat-history__messages.main .chat-load-more-messages.after').hasClass('hidden')) {
                                addChatMessageToActiveChat(chat_message);
                                scrollActiveChatToEnd();
                            }
                        }
                    }

                    updateCountOfUnreadChatMessages({
                        chat_id: chat.id,
                    });
                });
            });
        });

        window.user && realtime.on('chats.message_was_updated', function(data) {
            var chat = chats.filter(function(current_chat) {
                return current_chat.id == data.chat_id;
            }).pop() || null;

            if (!chat) {
                return;
            }

            var $chat = $('.chat[data-id="' + chat.id + '"]')
            var $chat_message = $('.chat-message[data-id="' + data.chat_message_id + '"]');

            if (chat.last_message.id != data.chat_message_id && $chat_message.length == 0) {
                return;
            }

            return requests.getMessage({
                chat_id:            data.chat_id,
                chat_message_id:    data.chat_message_id,
            }, function(chat_message) {
                if (chat.last_message.id == chat_message.id) {
                    chat.last_message = chat_message;

                    $chat.html($(template('chat', {
                        chat: chat,
                        chat_typing_interlocutors: getChatTypingInterlocutors(chat.id),
                        interlocutor_type: (business_id ? 'Business' : 'User'),
                        emojiCodeToChars: emojiCodeToChars,
                    })).html());
                }

                if ($chat_message.length > 0) {
                    var align = null;

                    if (chat_message.member.business) {
                        align = (business_id == chat_message.member.business.id ? 'right' : 'left');
                    }
                    else if (chat_message.member.user) {
                        align = (user.data.id == chat_message.member.user.id ? 'right' : 'left');
                    }
                    else {
                        align = 'left';
                    }

                    $chat_message.html($(template('chat-message', {
                        chat_message:       chat_message,
                        align:              align,
                        search:             (search ? true : false),
                        emojiCodeToChars:   emojiCodeToChars,
                    })).html());
                }
            });
        });
    };

    initialize();

    window.Chat = {
        pasteHtmlAtCaret:       pasteHtmlAtCaret,
        emojiCodeToChars:       emojiCodeToChars,
        textifyHtmlableString:  textifyHtmlableString,
        requests:               requests,
    };
};
