<!--[ New chat message MODAL ]-->
<form class="modal fade" id="new-chat-message-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0 pt-0">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 28 28"
                         style="enable-background:new 0 0 28 28; vertical-align: middle; margin-bottom: 3px;"
                         xml:space="preserve" width="20px" height="18px" data-toggle="tooltip"
                         data-placement="top" title="Candidate Notes" fill="#4E5C6E">
                        <g>
                            <g>
                                <path style=""
                                      d="M24,11.518V0H0v24h11.518c1.614,2.411,4.361,3.999,7.482,4c4.971-0.002,8.998-4.029,9-9    C27.999,15.879,26.411,13.132,24,11.518z M11.517,14c-0.412,0.616-0.743,1.289-0.994,2H4v2h6.058C10.022,18.329,10,18.661,10,19    c0,1.055,0.19,2.061,0.523,3H2V2h20v8.523C21.061,10.19,20.055,10,19,10c-2.143,0-4.107,0.751-5.652,2H4v2H11.517z M19,25.883    c-3.801-0.009-6.876-3.084-6.885-6.883c0.009-3.801,3.084-6.876,6.885-6.884c3.799,0.008,6.874,3.083,6.883,6.884    C25.874,22.799,22.799,25.874,19,25.883z"/>
                                <polygon style="" points="20,8 4,8 4,10 19,10 20,10   "/>
                                <polygon style=""
                                         points="20.002,18 20.002,14 18,14 18,18 14,18 14,20 18,20 18,24 20.002,24 20.002,20 24,20     24,18   "/>
                            </g>
                        </g>
                    </svg>
                    <span class="modal-title" id="new-chat-message-modal__title">{!! trans('modals.new_chat_modal.instant_message') !!}</span>
                </h5>
                <button type="button" class="close pt-0 mt-0" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-0 pb-3">
                <div class="d-flex px-3">
                    <div style="width: 80px;">
                        <div style="width: 40px; border-radius: 5px">
                            <img class="mr-3 user-logo-modal"
                                 src="{{ asset('img/profilepic2.png') }}"
                                 style="width: 40px; height: 40px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); border-radius: 5px;">
                        </div>
                        <img class="business-logo-modal"
                             src="{{ asset('img/business-logo-small.png') }}"
                             style="width: 20px; height: 20px; background-color: transparent;">
                    </div>
                    <div class="w-100">
                        <p class="mb-0">
                            <strong class="user-name-modal"></strong>
                        </p>
                        <div class="btn-group mr-2 w-100 form-control p-0" role="group">
                            <div class="[ new-chat-message-modal__text ] form-control border-0" name="chat_message[text]" style="box-shadow: none; resize: none;" contenteditable="true"></div>
                            <div class="[ new-chat-message-modal__text__placeholder ]">{!! trans('modals.new_chat_modal.type_message_here') !!}</div>
                            <div class="[ new-chat-message-modal__emoji-window animated ]">
                                <div class="[ new-chat-message-modal__emoji-window__content emoji-content ]">
                                    @foreach (emoji()->getCategories() as $category)
                                        <div class="emoji-content__category">
                                            <div class="emoji-content__category__header">{{ $category->name }}</div>
                                            <div class="emoji-content__category__raw">
                                                @foreach ($category->emojis as $emoji)
                                                    <a href="#" class="emoji-content__category__emoji" title="{{ $emoji->title ?: '' }}" data-code="{{ $emoji->code }}">
                                                        <img src="/img/blank.gif" class="emoji__{{ $emoji->source }}" style="background-position: {{ $emoji->position  }};">
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="new-chat-message-modal__emoji-window__arrow"></div>
                            </div>
                            <button type="button" class="[ new-chat-message-modal__emoji ] btn btn-outline-primary" title="Smiles">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 1792 1792" style="enable-background: new 0 0 512.001 512.001; fill: #0747a6; vertical-align: middle; margin-top: -3px;" xml:space="preserve" width="20px" height="20px">
                                    <path d="M1262 1075q-37 121-138 195t-228 74-228-74-138-195q-8-25 4-48.5t38-31.5q25-8 48.5 4t31.5 38q25 80 92.5 129.5t151.5 49.5 151.5-49.5 92.5-129.5q8-26 32-38t49-4 37 31.5 4 48.5zm-494-435q0 53-37.5 90.5t-90.5 37.5-90.5-37.5-37.5-90.5 37.5-90.5 90.5-37.5 90.5 37.5 37.5 90.5zm512 0q0 53-37.5 90.5t-90.5 37.5-90.5-37.5-37.5-90.5 37.5-90.5 90.5-37.5 90.5 37.5 37.5 90.5zm256 256q0-130-51-248.5t-136.5-204-204-136.5-248.5-51-248.5 51-204 136.5-136.5 204-51 248.5 51 248.5 136.5 204 204 136.5 248.5 51 248.5-51 204-136.5 136.5-204 51-248.5zm128 0q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z" />
                                </svg>
                            </button>
                            <!-- <button type="button" class="[ new-chat-message-modal__send ] btn btn-outline-primary" disabled title="Send your message">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 490.282 490.282" style="enable-background: new 0 0 512.001 512.001; fill: #0747a6; vertical-align: middle; margin-top: -3px;" xml:space="preserve" width="20px" height="20px">
                                    <g>
                                        <g>
                                            <path d="M0.043,245.197c0.6,10.1,7.3,18.6,17,21.5l179.6,54.3l6.6,123.8c0.3,4.9,3.6,9.2,8.3,10.8c1.3,0.5,2.7,0.7,4,0.7   c3.5,0,6.8-1.4,9.2-4.1l63.5-70.3l90,62.3c4,2.8,8.7,4.3,13.6,4.3c11.3,0,21.1-8,23.5-19.2l74.7-380.7c0.9-4.4-0.8-9-4.2-11.8   c-3.5-2.9-8.2-3.6-12.4-1.9l-459,186.8C5.143,225.897-0.557,235.097,0.043,245.197z M226.043,414.097l-4.1-78.1l46,31.8   L226.043,414.097z M391.443,423.597l-163.8-113.4l229.7-222.2L391.443,423.597z M432.143,78.197l-227.1,219.7l-179.4-54.2   L432.143,78.197z" data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                                        </g>
                                    </g>
                                      </svg>
                            </button> -->
                        </div>
                        <p class="text-right pt-2 mb-0">
                            <button type="button" class="[ new-chat-message-modal__send-message ] btn btn-outline-primary">{!! trans('modals.new_chat_modal.send_message') !!}</button>
                        </p>
                        <p class="text-right pt-2 mb-0">
                            <button type="button" class="[ new-chat-message-modal__send-message-and-open-chat ] btn btn-outline-primary">{!! trans('modals.new_chat_modal.send_and_open') !!}</button>
                        </p>
                        <p class="text-right pt-2 mb-0" id="new-chat-message-modal__send-interview-request-container" style="display: none;">
                            <button type="button" class="[ new-chat-message-modal__send-interview-request ] btn btn-outline-primary">{!! trans('modals.interview_request.send_interview_request') !!}</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="with_user_id" value="0">
    <input type="hidden" name="with_business_id" value="0">
</form>
@push('scripts')
    <script>
        $(function() {
            var sendChatMessage = function(done) {
                var params = {};
                params.business_id = parseInt(business && business.currentID) || 0;

                if (params.business_id) {
                    params.with_user_id = $('#new-chat-message-modal input[name="with_user_id"]').val();
                }
                else {
                    params.with_business_id = $('#new-chat-message-modal input[name="with_business_id"]').val();
                }

                (function(done) {
                    return new GraphQL('query', 'chat', params, [
                        'id',
                        'token',
                    ], true, false, function() {
                        Loader.stop();
                    }, function(data) {
                        if (data && data.id) {
                            return done(data);
                        }

                        return new GraphQL('mutation', 'createChat', params, [
                            'id',
                            'token',
                        ], true, false, function() {
                            Loader.stop();
                        }, function(data) {
                            return done(data);
                        }, false).request();
                    }, false).request();
                })(function(chat) {
                    $('.new-chat-message-modal__text').blur();
                    var text = $('.new-chat-message-modal__text').html();
                    text = Chat.textifyHtmlableString(text);

                    text = text.replace(/\<img class="emoji" src="\/img\/emoji\/(.*?)\.png" alt=""\s*\/?\>/ig, function($0, $1) {
                        return Chat.emojiCodeToChars($1);
                    });

                    return Chat.requests.sendChatMessage({
                        chat_message: {
                            text: text,
                        },

                        chat: {
                            id: parseInt(chat.id),
                        },
                    }, function(created_chat_message) {
                        $('.new-chat-message-modal__text').html('').focus();
                        $('.new-chat-message-modal__text__placeholder').show();
                        $.notify('Instant message sent!', 'success');

                        return done && done({
                            chat:           chat,
                            chat_message:   created_chat_message,
                        });
                    });
                });
            };

            var initialize = function(data) {
                data = data || {};

                $('#new-chat-message-modal').on('shown.bs.modal', function() {
                    $('.new-chat-message-modal__text').focus();
                });

                if (1 || data.show_send_interview_request_button) {
                    $('#new-chat-message-modal__send-interview-request-container').show();
                }

                $('#new-chat-message-modal input[name="with_user_id"]').val(data.with_user_id);
                $('#new-chat-message-modal input[name="with_business_id"]').val(data.with_business_id);
            };

            $('#new-chat-message-modal').data({
                initialize:                 initialize,
            });

            $(document).on('keyup', '.new-chat-message-modal__text', function() {
                if ($(this).html()) {
                    $('.new-chat-message-modal__send').prop('disabled', false);
                }
                else {
                    $('.new-chat-message-modal__send').prop('disabled', true);
                }

                // sendActiveChatTyping();
            });

            $(document).on('input', '.new-chat-message-modal__text', function() {
                if ($(this).html()) {
                    $('.new-chat-message-modal__text__placeholder').hide();
                }
                else {
                    $('.new-chat-message-modal__text__placeholder').show();
                }
            });

            $(document).on('paste', '.new-chat-message-modal__text', function(event) {
                event.preventDefault();
                var text = "";

                if (event.originalEvent.clipboardData && event.originalEvent.clipboardData.getData) {
                    text = event.originalEvent.clipboardData.getData('Text');
                }
                else if (window.clipboardData && window.clipboardData.getData) {
                    text = window.clipboardData.getData('Text');
                }

                Emoji.forEach(function(emoji_code) {
                    var emoji_chars = Chat.emojiCodeToChars(emoji_code);

                    text = text.replace(
                        new RegExp(emoji_chars, 'g'),
                        '<img class="emoji" src="/img/emoji/' + emoji_code + '.png" alt="' + emoji_chars + '">'
                    );
                });

                document.execCommand('insertHTML', false, text);
            });

            $(document).on('click', function(event) {
                if ($('.new-chat-message-modal__emoji-window').hasClass('open')) {
                    if ($(event.target).closest('.new-chat-message-modal__emoji-window').length == 0) {
                        $('.new-chat-message-modal__emoji-window').removeClass('open');
                        $('.new-chat-message-modal__emoji').removeClass('pressed');
                    }
                }
            });

            $(document).on('click', '.new-chat-message-modal__emoji', function(event) {
                if ($('.new-chat-message-modal__emoji').hasClass('pressed')) {
                    $('.new-chat-message-modal__emoji-window').removeClass('open');
                    $('.new-chat-message-modal__emoji').removeClass('pressed');
                }
                else {
                    setTimeout(function() {
                        $('.new-chat-message-modal__emoji-window').addClass('animated open').focus();
                        $('.new-chat-message-modal__emoji').addClass('pressed');
                    }, 0);
                }
            });

            $(document).on('click', '.new-chat-message-modal__emoji-window .emoji-content__category__emoji', function(event) {
                event.preventDefault();

                if ($(window.getSelection().anchorNode).closest('.new-chat-message-modal__text').length > 0) {
                    Chat.pasteHtmlAtCaret('<img class="emoji" src="/img/emoji/' + $(this).attr('data-code') + '.png" alt="" />');
                    $('.new-chat-message-modal__text__placeholder').hide();
                    $('.new-chat-message-modal__send').prop('disabled', false);
                }
            });

            $(document).on('keydown', '.new-chat-message-modal__text', function(event) {
                if (!event.metaKey && !event.ctrlKey || event.keyCode != 13) {
                    return;
                }

                if (!$(this).html()) {
                    return;
                }

                sendChatMessage(function() {
                    $('#new-chat-message-modal').modal('hide');
                });
            });

            $(document).on('click', '.new-chat-message-modal__send-message', function(event) {
                event.preventDefault();

                if (!$('.new-chat-message-modal__text').html()) {
                    return;
                }

                sendChatMessage(function(data) {
                    $('#new-chat-message-modal').modal('hide');
                });
            });

            $(document).on('click', '.new-chat-message-modal__send-message-and-open-chat', function(event) {
                event.preventDefault();

                if (!$('.new-chat-message-modal__text').html()) {
                    return;
                }

                sendChatMessage(function(data) {
                    if (parseInt(business && business.currentID) || 0) {
                        window.location.href = '/business/messages';
                    }
                    else {
                        window.location.href = '/user/messages';
                    }
                });
            });

            $(document).on('click', '.new-chat-message-modal__send-interview-request', function(event) {
                event.preventDefault();
                $('#new-chat-message-modal').modal('hide');
                var params = {};
                params.business_id = parseInt(business && business.currentID) || 0;

                if (params.business_id) {
                    params.user_id = $('#new-chat-message-modal input[name="with_user_id"]').val();
                }
                else {
                    params.business_id = $('#new-chat-message-modal input[name="with_business_id"]').val();
                }

                $('#interview-request-modal').modal('show');
                $('#interview-request-modal__title').text('Send interview request');
                $('#interview-request-modal').data('initialize')(params);
            });
        });
    </script>
@endpush
<!--[ /New chat message MODAL ]-->
