<script type="text/template" id="chat-template">
    <div class="[ chat ] d-flex flex-row px-0 card rounded border-0 mx-0" data-id="<%- chat.id %>">
        <div class="[ chat__avatar ] mt-1 ml-1 mb-1">
            <% if (chat.opposite_member.user) { %>
                <img src="<%- chat.opposite_member.user.user_pic %>" alt="avatar" style="width: 65px;" class=" rounded">
            <% } else if (chat.opposite_member.business) { %>
                <img src="<%- chat.opposite_member.business.picture %>" alt="avatar" style="width: 65px;" class=" rounded">
            <% } else { %>
                <img src="#" alt="avatar" style="width: 65px;" class=" rounded">
            <% } %>
        </div>
        <% if (chat.count_of_unread_messages) { %>
            <span class="[ chat__count-of-unread-messages ] notification"><%- chat.count_of_unread_messages %></span>
        <% } %>
        <div class="pl-2 pt-2" style="max-width: 60%; overflow: hidden; text-overflow: ellipsis;">
            <% if (chat.opposite_member.user) { %>
                <p class="[ chat__name ] h6"><%= chat.opposite_member.user.first_name %> <%= chat.opposite_member.user.last_name %></p>
            <% } else if (chat.opposite_member.business) { %>
                <p class="[ chat__name ] h6"><%= chat.opposite_member.business.name %></p>
            <% } else { %>
                <p class="[ chat__name ] h6">Unknown name</p>
            <% } %>

            <% if (chat_typing_interlocutors.length > 0) { %>
                <div class="[ chat__typing ]">
                    <div class="[ chat__typing__interlocutors ]">
                        <% chat_typing_interlocutors.slice(0, 6).forEach(function(chat_typing_interlocutor) { %>
                            <div class="[ chat__typing__interlocutor ]" title="<%= chat_typing_interlocutor.user.first_name %> <%= chat_typing_interlocutor.user.last_name %>">
                                <img src="<%- chat_typing_interlocutor.user.user_pic %>" alt="avatar" class=" rounded">
                            </div>
                        <% }); %>
                    </div>
                    <div class="[ chat__typing-icon ]">
                        <span class="[ chat-typing-icon ]" style="display: inline-block; vertical-align: top; font-size: 5px;"></span>
                    </div>
                </div>
            <% } %>
            <% if (chat_typing_interlocutors.length == 0) { %>
                <p class="[ chat__last-message-avatar ]" title="<%= chat.last_message.interlocutor.user.first_name %> <%= chat.last_message.interlocutor.user.last_name %>">
                    <img src="<%- chat.last_message.interlocutor.user.user_pic %>" alt="avatar" class=" rounded">
                </p>
                <p class="[ chat__last-message-text ] text-muted">
                    <% if (chat.last_message) { %>
                        <% if (chat.last_message.interview_request) { %>
                            <b><%= trans('chat.interview_request') %></b>
                        <% } else { %>
                            <%- window.Emoji.reduce(function(text, emoji_code) {
                                return text.replace(
                                    new RegExp(emojiCodeToChars(emoji_code), 'g'),
                                    '<img class="emoji" src="/img/emoji/' + emoji_code + '.png" alt="' + emojiCodeToChars(emoji_code) + '">'
                                );
                            }, window.ejs.escapeXML(chat.last_message.text)) %>
                        <% } %>
                    <% } else { %>
                        No messages yet
                    <% } %>
                </p>
            <% } %>
        </div>
        <% if (chat.opposite_member.user) { %>
            <div class="chat__online-status realtime__online-status <%- chat.opposite_member.user.is_online ? 'online' : 'offline' %>" data-type="User" data-id="<%= chat.opposite_member.user.id %>"></div>
        <% } else if (chat.opposite_member.business) { %>
            <div class="chat__online-status realtime__online-status <%- chat.opposite_member.business.business_is_online ? 'online' : 'offline' %>" data-type="Business" data-id="<%= chat.opposite_member.business.id %>"></div>
        <% } %>
    </div>
</script>
<script type="text/template" id="chat-message-template">
    <div class="[ chat-message <%- align %> <%- (align == 'right' ? chat_message.state : '') %> ] pt-3 col-md-12" data-id="<%= chat_message.id %>" title="<%= search ? trans('chat.go_to_this_message') : trans('chat.written_at') + ' ' + (new Date(chat_message.created_at).toUTCString()) %>">
        <div class="[ chat-message__unread ]">
            <div class="[ chat-message__unread-value ]">Unread messages</div>
        </div>
        <div class="[ chat-message__day ]">
            <% if (new Date().toISOString().split(/T/)[0] == chat_message.created_at.split(/T/)[0]) { %>
                <div class="[ chat-message__day-value ]" style="font-weight:bold;"><%= trans('chat.today') %></div>
            <% } else if (new Date(new Date().getTime() - 86400 * 1000).toISOString().split(/T/)[0] == chat_message.created_at.slice(/T/)[0]) { %>
                <div class="[ chat-message__day-value ]" style="font-weight:bold;"><%= trans('chat.yesterday') %></div>
            <% } else { %>
                <div class="[ chat-message__day-value ]" style="font-weight:bold;"><%- new Date(chat_message.created_at).toUTCString().split(/\s+/).slice(1, 4).join(' ') %></div>
            <% } %>
        </div>
        <div class="chat-message__header">
            <div class="[ chat-message__avatar ] pl-2 pb-1">
                <% if (chat_message.interlocutor.business) { %>
                    <a href="#" title="View business manager: <%= chat_message.interlocutor.user.first_name %> <%= chat_message.interlocutor.user.first_name %>" class="[ chat-message__avatar__link ]" data-user-id="<%- chat_message.interlocutor.user.id %>">
                        <img src="<%- chat_message.interlocutor.user.user_pic %>" alt="avatar" class="[ chat-message__avatar__image ] user-avatar rounded">
                    </a>
                    <a href="/business/view/<%- chat_message.interlocutor.business.id %>/<%- chat_message.interlocutor.business.slug %>" title="View business: <%= chat_message.interlocutor.business.name %>" target="_blank">
                        <img src="<%- chat_message.interlocutor.business.picture %>" alt="avatar" class="[ chat-message__avatar__image extra ] business-avatar rounded">
                    </a>
                <% } else { %>
                    <a href="#" title="<%= trans('chat.view_applicant') %>: <%= chat_message.interlocutor.user.first_name %> <%= chat_message.interlocutor.user.last_name %>" class="[ chat-message__avatar__link ]" data-user-id="<%- chat_message.interlocutor.user.id %>">
                        <img src="<%- chat_message.interlocutor.user.user_pic %>" alt="avatar" class="[ chat-message__avatar__image ] rounded">
                    </a>
                <% } %>
            </div>
            <div class="chat-message__name">
                <%= chat_message.interlocutor.user.first_name %> <%= chat_message.interlocutor.user.last_name %>
            </div>
        </div>
        <div class="[ chat-message__content ]">
            <% if (chat_message.text) { %>
                <div class="[ chat-message__content-section ]">
                    <div class="[ chat-message__text-container ] rounded">
                        <p class="[ chat-message__text ] mb-0"><%-
                            window.Emoji.reduce(function(text, emoji_code) {
                                return text.replace(
                                    new RegExp(emojiCodeToChars(emoji_code), 'g'),
                                    '<img class="emoji" src="/img/emoji/' + emoji_code + '.png" alt="' + emojiCodeToChars(emoji_code) + '">'
                                );
                            }, window.ejs.escapeXML(chat_message.text))
                        %></p>
                    </div>
                </div>
            <% } %>
            <% if (chat_message.interview_request) { %>
                <div class="[ chat-message__content-section ]">
                    <div class="[ chat-message__interview-request-container <%- chat_message.interview_request.state %> ] rounded mt-2">
                        <p class="mb-0 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; fill:#4266ff;" width="25px" height="25px" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M455.677,373.988C471.77,360.222,482,339.789,482,317c0-24.484-11.796-46.262-30-59.959c0-0.013,0-0.027,0-0.041    c0-107.808-88.214-196-196-196c-26.897,0-52.662,4.87-76.006,14.248c0-0.083,0.006-0.165,0.006-0.248c0-41.355-33.645-75-75-75    S30,33.645,30,75c0,22.789,10.23,43.222,26.323,56.988C22.871,149.566,0,184.66,0,225v30c0,8.284,6.716,15,15,15h45.574    C68.229,370.513,152.94,451,256,451c16.774,0,33.014-1.789,48.158-5.232C302.744,452.627,302,459.728,302,467v30    c0,8.284,6.716,15,15,15h180c8.284,0,15-6.716,15-15v-30C512,426.66,489.129,391.566,455.677,373.988z M452,317    c0,24.813-20.187,45-45,45s-45-20.187-45-45s20.187-45,45-45S452,292.187,452,317z M105,30c24.813,0,45,20.187,45,45    s-20.187,45-45,45S60,99.813,60,75S80.187,30,105,30z M30,240v-15c0-41.355,33.645-75,75-75s75,33.645,75,75v15H30z M256,421    c-86.477,0-157.707-66.471-165.315-151H195c8.284,0,15-6.716,15-15v-30c0-40.34-22.871-75.434-56.323-93.012    c5.929-5.072,11.066-11.042,15.183-17.711C193.832,99.052,223.869,91,256,91c86.956,0,158.503,67.21,165.44,152.409    c-4.675-0.916-9.5-1.409-14.44-1.409c-41.355,0-75,33.645-75,75c0,22.789,10.23,43.222,26.323,56.988    c-16.034,8.425-29.636,20.873-39.454,35.996C300.638,417.197,279.017,421,256,421z M482,482H332v-15c0-41.355,33.645-75,75-75    c41.355,0,75,33.645,75,75V482z"/>
                                    </g>
                                </g>
                            </svg>
                        </p>
                        <div class="[ chat-message__interview-request__title ] text-center"><%= trans('chat.interview_request') %></div>
                        <div class="[ chat-message__interview-request__details ]">
                            <% if (align == 'right') { %>
                                <%= trans('chat.you_sent_an_interview_with', {
                                    interviewer_name: chat_message.interview_request.interviewer_name,
                                    date: moment(chat_message.interview_request.date).format('MM/DD/YYYY, HH:mm'),
                                }) %>
                            <% } else { %>
                                <% if (chat_message.interview_request.sender_type == 'Business') { %>
                                    <%= trans('chat.good_news_you_have_an_interview', {
                                        interviewer_name: chat_message.interview_request.interviewer_name,
                                        date: chat_message.interview_request.date,
                                    }) %>
                                <% } else { %>
                                   <%= trans('chat.you_received_an_interview', {
                                        interviewer_name: chat_message.interview_request.interviewer_name,
                                        date: chat_message.interview_request.date,
                                    }) %>
                                <% } %>
                            <% } %>
                            <% if (chat_message.interview_request.type == 'via_phone') { %>
                                <%= trans('chat.via_phone') %>: <a href="tel:<%= chat_message.interview_request.phone_number %>"><%= chat_message.interview_request.phone_number %></a>
                            <% } else if (chat_message.interview_request.type == 'in_person') { %>
                                <%= trans('chat.in_person', { address: chat_message.interview_request.address }) %>
                            <% } else if (chat_message.interview_request.type == 'via_skype_voice') { %>
                                <%= trans('chat.via_skype_voice') %>: <%= chat_message.interview_request.messenger_identifier  %>
                            <% } else if (chat_message.interview_request.type == 'via_skype_video') { %>
                                <%= trans('chat.via_skype_video') %>: <%= chat_message.interview_request.messenger_identifier  %>
                            <% } else if (chat_message.interview_request.type == 'via_im') { %>
                                <%= trans('chat.via_im') %>: <%= chat_message.interview_request.messenger_identifier  %>
                            <% } %>
                        </div>
                        <% if (chat_message.interview_request.state == 'sent') { %>
                            <div class="[ chat-message__interview-request__buttons ]">
                                <% if (align == 'right') { %>
                                    <button type="button" class="[ chat-message__interview-request__change-button ] btn btn-yellow button-font-sm mr-2" title="<%= trans('chat.change_interview_details') %>">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" version="1.1" height="20" viewBox="0 0 64 64" enable-background="new 0 0 64 64" style="vertical-align:middle; margin-top:-3px; fill:#fff;">
                                          <g>
                                            <g>
                                              <path d="m64,10.978c0-3.336-2.691-6.049-6-6.049h-6.348v-2.912c0-1.115-0.895-2.017-2-2.017-1.105,0-2,0.902-2,2.017v2.912h-31.394v-2.912c0-1.115-0.895-2.017-2-2.017s-2,0.902-2,2.017v2.912h-6.258c-3.309,0-6,2.713-6,6.049v9.209c0,0.11 0.045,0.205 0.063,0.311-0.018,0.106-0.063,0.201-0.063,0.311 0,0.003 0.002,0.008 0.002,0.011 0,0.005-0.002,0.009-0.002,0.013v37.119c0,3.335 2.691,6.048 6,6.048h52c3.309,0 6-2.713 6-6.049v-37.118c0-0.004-0.002-0.008-0.002-0.012 0-0.003 0.002-0.008 0.002-0.011 0-0.11-0.045-0.205-0.063-0.312 0.018-0.106 0.063-0.201 0.063-0.311v-9.209zm-4,46.973c0,1.112-0.896,2.016-2,2.016h-52c-1.104,0-2-0.904-2-2.016v-35.126h56v35.126zm0-39.159h-56v-7.815c0-1.113 0.896-2.017 2-2.017h6.258v2.913c0,1.114 0.895,2.016 2,2.016s2-0.902 2-2.016v-2.912h31.395v2.913c0,1.114 0.895,2.016 2,2.016 1.106,0 2-0.902 2-2.016v-2.913h6.347c1.104,0 2,0.904 2,2.017v7.814z"/>
                                              <ellipse cx="21.182" cy="33.828" rx="2" ry="2.016"/>
                                              <ellipse cx="30.852" cy="33.828" rx="2" ry="2.016"/>
                                              <ellipse cx="41.662" cy="33.828" rx="2" ry="2.016"/>
                                              <ellipse cx="52.697" cy="33.828" rx="2" ry="2.016"/>
                                              <ellipse cx="11.303" cy="40.806" rx="2" ry="2.016"/>
                                              <ellipse cx="21.182" cy="40.806" rx="2" ry="2.016"/>
                                              <ellipse cx="30.852" cy="40.806" rx="2" ry="2.016"/>
                                              <ellipse cx="41.662" cy="40.806" rx="2" ry="2.016"/>
                                              <ellipse cx="52.697" cy="40.806" rx="2" ry="2.016"/>
                                              <ellipse cx="11.303" cy="47.755" rx="2" ry="2.016"/>
                                              <ellipse cx="21.182" cy="47.755" rx="2" ry="2.016"/>
                                              <ellipse cx="30.852" cy="47.755" rx="2" ry="2.016"/>
                                              <ellipse cx="41.662" cy="47.755" rx="2" ry="2.016"/>
                                              <ellipse cx="52.697" cy="47.755" rx="2" ry="2.016"/>
                                              <ellipse cx="11.303" cy="54.734" rx="2" ry="2.016"/>
                                              <ellipse cx="21.182" cy="54.734" rx="2" ry="2.016"/>
                                              <ellipse cx="30.852" cy="54.734" rx="2" ry="2.016"/>
                                            </g>
                                          </g>
                                        </svg>
                                        <%= trans('chat.change_details') %>
                                    </button>
                                    <button type="button" class="[ chat-message__interview-request__withdraw-button ] btn btn-danger button-font-sm" title="<%= trans('chat.withdrawl_interview_request') %>">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" version="1.1" height="20" viewBox="0 0 64 64" enable-background="new 0 0 64 64" style="vertical-align: middle; margin-top: -3px; fill:#fff;">
                                          <g>
                                            <g>
                                              <path d="m46.355,17.979c-0.779-0.78-2.043-0.78-2.821,0l-11.594,11.591-11.591-11.591c-0.779-0.78-2.044-0.78-2.822,0-0.778,0.779-0.778,2.043 0,2.823l11.499,11.5-11.492,11.489c-0.778,0.779-0.778,2.043 0,2.822 0.392,0.391 0.903,0.586 1.414,0.586s1.02-0.195 1.411-0.586l11.581-11.579 11.583,11.579c0.39,0.391 0.899,0.586 1.41,0.586 0.512,0 1.024-0.195 1.412-0.586 0.779-0.779 0.779-2.043 0-2.822l-11.489-11.488 11.499-11.5c0.78-0.781 0.78-2.044-7.10543e-15-2.824z"/>
                                              <path d="M31.94,0C14.33,0,0,14.328,0,31.941c0,17.611,14.33,31.94,31.94,31.94    c17.611,0,31.941-14.329,31.941-31.94C63.882,14.328,49.552,0,31.94,0z M31.94,59.89c-15.411,0-27.948-12.538-27.948-27.948    c0-15.412,12.537-27.949,27.948-27.949c15.412,0,27.949,12.537,27.949,27.949C59.89,47.352,47.353,59.89,31.94,59.89z"/>
                                            </g>    
                                          </g>
                                        </svg>
                                        <%= trans('chat.withdrawl') %>
                                    </button>
                                <% } else { %>
                                    <button type="button" class="[ chat-message__interview-request__accept-button ] btn btn-success button-font-sm mr-2" title="<%= trans('chat.accept_interview') %>">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 587.91 587.91" style="enable-background:new 0 0 587.91 587.91; vertical-align: middle; margin-top: -3px; fill:#fff;" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <g>
                                                        <path d="M86.451,501.46c26.937,26.936,58.315,48.088,93.265,62.871c36.207,15.314,74.642,23.078,114.239,23.078     c39.596,0,78.032-7.764,114.239-23.078c34.949-14.783,66.328-35.936,93.266-62.871c26.936-26.938,48.09-58.316,62.871-93.266     c15.314-36.207,23.08-74.643,23.08-114.238c0-39.598-7.766-78.033-23.08-114.239c-14.781-34.95-35.936-66.328-62.871-93.265     c-26.938-26.937-58.316-48.09-93.266-62.872C371.986,8.265,333.551,0.501,293.955,0.501c-39.597,0-78.032,7.765-114.239,23.079     c-34.95,14.782-66.328,35.936-93.265,62.872s-48.09,58.315-62.873,93.264C8.265,215.923,0.5,254.358,0.5,293.956     c0,39.596,7.765,78.031,23.079,114.238C38.361,443.144,59.515,474.522,86.451,501.46z M293.955,43.341     c138.411,0,250.614,112.204,250.614,250.615c0,138.41-112.203,250.613-250.614,250.613S43.34,432.366,43.34,293.956     C43.34,155.545,155.544,43.341,293.955,43.341z"/>
                                                        <path d="M293.955,587.909c-39.667,0-78.167-7.778-114.434-23.117c-35.01-14.809-66.442-35.998-93.423-62.979     c-26.983-26.984-48.172-58.417-62.979-93.425C7.778,372.119,0,333.618,0,293.956c0-39.663,7.778-78.165,23.118-114.435     c14.807-35.008,35.997-66.44,62.979-93.423c26.982-26.983,58.415-48.172,93.423-62.979c36.27-15.34,74.771-23.118,114.434-23.118     c39.666,0,78.167,7.778,114.433,23.119c35.009,14.807,66.441,35.997,93.425,62.979c26.984,26.985,48.173,58.417,62.979,93.423     c15.341,36.27,23.119,74.771,23.119,114.434c0,39.662-7.778,78.163-23.119,114.433c-14.806,35.007-35.994,66.439-62.979,93.425     c-26.982,26.98-58.415,48.169-93.425,62.979C372.121,580.131,333.62,587.909,293.955,587.909z M293.955,1.001     c-39.529,0-77.898,7.751-114.044,23.039c-34.889,14.757-66.215,35.874-93.106,62.765c-26.892,26.892-48.009,58.217-62.766,93.105     C8.751,216.057,1,254.427,1,293.956C1,333.483,8.751,371.854,24.039,408c14.757,34.889,35.874,66.214,62.766,93.106     c26.89,26.889,58.215,48.006,93.106,62.765c36.142,15.287,74.512,23.038,114.044,23.038s77.901-7.751,114.044-23.039     c34.89-14.758,66.216-35.875,93.106-62.764c26.893-26.895,48.009-58.22,62.764-93.106     c15.289-36.146,23.041-74.516,23.041-114.044c0-39.529-7.752-77.899-23.041-114.044c-14.754-34.887-35.871-66.212-62.764-93.106     c-26.892-26.891-58.218-48.008-93.106-62.765C371.855,8.752,333.485,1.001,293.955,1.001z M293.955,545.069     c-67.075,0-130.136-26.12-177.565-73.549c-47.429-47.43-73.55-110.489-73.55-177.564S68.96,163.82,116.39,116.391     c47.429-47.429,110.49-73.55,177.565-73.55c67.075,0,130.135,26.121,177.564,73.55c47.43,47.43,73.55,110.49,73.55,177.565     s-26.12,130.135-73.55,177.564C424.09,518.949,361.029,545.069,293.955,545.069z M293.955,43.841     c-66.808,0-129.617,26.017-176.858,73.257c-47.24,47.241-73.257,110.05-73.257,176.858c0,66.808,26.017,129.617,73.257,176.856     c47.24,47.24,110.05,73.257,176.858,73.257s129.617-26.017,176.857-73.257c47.24-47.239,73.257-110.049,73.257-176.856     c0-66.808-26.017-129.618-73.257-176.858C423.571,69.857,360.763,43.841,293.955,43.841z"/>
                                                    </g>
                                                    <g>
                                                        <path d="M228.992,400.794c4.017,4.018,9.465,6.273,15.146,6.273c5.682,0,11.129-2.256,15.146-6.273L442.67,217.409     c8.365-8.365,8.365-21.927,0-30.292s-21.928-8.366-30.293,0l-168.239,168.24l-68.606-68.607c-8.365-8.366-21.927-8.366-30.292,0     c-8.365,8.365-8.365,21.927,0,30.292L228.992,400.794z"/>
                                                        <path d="M244.138,407.567c-5.855,0-11.36-2.28-15.5-6.42l-83.752-83.752c-8.546-8.547-8.546-22.453,0-31     c4.14-4.141,9.645-6.421,15.5-6.421s11.359,2.28,15.5,6.421l68.253,68.253l167.885-167.886c4.14-4.141,9.645-6.42,15.5-6.42     c5.854,0,11.359,2.28,15.5,6.42c4.141,4.14,6.421,9.645,6.421,15.5s-2.28,11.359-6.421,15.5L259.638,401.147     C255.499,405.287,249.994,407.567,244.138,407.567z M160.386,280.975c-5.588,0-10.841,2.176-14.792,6.128     c-8.156,8.157-8.156,21.428,0,29.585l83.752,83.752c3.951,3.951,9.204,6.127,14.792,6.127c5.589,0,10.842-2.176,14.793-6.127     l183.385-183.385c3.951-3.951,6.128-9.205,6.128-14.792s-2.177-10.842-6.128-14.793c-3.951-3.952-9.205-6.127-14.793-6.127     s-10.842,2.176-14.793,6.127L244.138,356.063l-68.96-68.96C171.227,283.151,165.974,280.975,160.386,280.975z"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                        <%= trans('chat.accept') %>
                                    </button>
                                    <button type="button" class="[ chat-message__interview-request__reject-button ] btn btn-danger button-font-sm mr-2" title="<%= trans('chat.dismiss_interview') %>">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" version="1.1" height="20" viewBox="0 0 64 64" enable-background="new 0 0 64 64" style="vertical-align: middle; margin-top: -3px; fill:#fff;">
                                          <g>
                                            <g>
                                              <path d="m46.355,17.979c-0.779-0.78-2.043-0.78-2.821,0l-11.594,11.591-11.591-11.591c-0.779-0.78-2.044-0.78-2.822,0-0.778,0.779-0.778,2.043 0,2.823l11.499,11.5-11.492,11.489c-0.778,0.779-0.778,2.043 0,2.822 0.392,0.391 0.903,0.586 1.414,0.586s1.02-0.195 1.411-0.586l11.581-11.579 11.583,11.579c0.39,0.391 0.899,0.586 1.41,0.586 0.512,0 1.024-0.195 1.412-0.586 0.779-0.779 0.779-2.043 0-2.822l-11.489-11.488 11.499-11.5c0.78-0.781 0.78-2.044-7.10543e-15-2.824z"/>
                                              <path d="M31.94,0C14.33,0,0,14.328,0,31.941c0,17.611,14.33,31.94,31.94,31.94    c17.611,0,31.941-14.329,31.941-31.94C63.882,14.328,49.552,0,31.94,0z M31.94,59.89c-15.411,0-27.948-12.538-27.948-27.948    c0-15.412,12.537-27.949,27.948-27.949c15.412,0,27.949,12.537,27.949,27.949C59.89,47.352,47.353,59.89,31.94,59.89z"/>
                                            </g>    
                                          </g>
                                        </svg>
                                        <%= trans('chat.dismiss') %>
                                    </button>
                                    <button type="button" class="[ chat-message__interview-request__change-button ] btn btn-yellow button-font-sm" title="<%= trans('chat.change_interview_details') %>">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" version="1.1" height="20" viewBox="0 0 64 64" enable-background="new 0 0 64 64" style="vertical-align:middle; margin-top:-3px; fill:#fff;">
                                          <g>
                                            <g>
                                              <path d="m64,10.978c0-3.336-2.691-6.049-6-6.049h-6.348v-2.912c0-1.115-0.895-2.017-2-2.017-1.105,0-2,0.902-2,2.017v2.912h-31.394v-2.912c0-1.115-0.895-2.017-2-2.017s-2,0.902-2,2.017v2.912h-6.258c-3.309,0-6,2.713-6,6.049v9.209c0,0.11 0.045,0.205 0.063,0.311-0.018,0.106-0.063,0.201-0.063,0.311 0,0.003 0.002,0.008 0.002,0.011 0,0.005-0.002,0.009-0.002,0.013v37.119c0,3.335 2.691,6.048 6,6.048h52c3.309,0 6-2.713 6-6.049v-37.118c0-0.004-0.002-0.008-0.002-0.012 0-0.003 0.002-0.008 0.002-0.011 0-0.11-0.045-0.205-0.063-0.312 0.018-0.106 0.063-0.201 0.063-0.311v-9.209zm-4,46.973c0,1.112-0.896,2.016-2,2.016h-52c-1.104,0-2-0.904-2-2.016v-35.126h56v35.126zm0-39.159h-56v-7.815c0-1.113 0.896-2.017 2-2.017h6.258v2.913c0,1.114 0.895,2.016 2,2.016s2-0.902 2-2.016v-2.912h31.395v2.913c0,1.114 0.895,2.016 2,2.016 1.106,0 2-0.902 2-2.016v-2.913h6.347c1.104,0 2,0.904 2,2.017v7.814z"/>
                                              <ellipse cx="21.182" cy="33.828" rx="2" ry="2.016"/>
                                              <ellipse cx="30.852" cy="33.828" rx="2" ry="2.016"/>
                                              <ellipse cx="41.662" cy="33.828" rx="2" ry="2.016"/>
                                              <ellipse cx="52.697" cy="33.828" rx="2" ry="2.016"/>
                                              <ellipse cx="11.303" cy="40.806" rx="2" ry="2.016"/>
                                              <ellipse cx="21.182" cy="40.806" rx="2" ry="2.016"/>
                                              <ellipse cx="30.852" cy="40.806" rx="2" ry="2.016"/>
                                              <ellipse cx="41.662" cy="40.806" rx="2" ry="2.016"/>
                                              <ellipse cx="52.697" cy="40.806" rx="2" ry="2.016"/>
                                              <ellipse cx="11.303" cy="47.755" rx="2" ry="2.016"/>
                                              <ellipse cx="21.182" cy="47.755" rx="2" ry="2.016"/>
                                              <ellipse cx="30.852" cy="47.755" rx="2" ry="2.016"/>
                                              <ellipse cx="41.662" cy="47.755" rx="2" ry="2.016"/>
                                              <ellipse cx="52.697" cy="47.755" rx="2" ry="2.016"/>
                                              <ellipse cx="11.303" cy="54.734" rx="2" ry="2.016"/>
                                              <ellipse cx="21.182" cy="54.734" rx="2" ry="2.016"/>
                                              <ellipse cx="30.852" cy="54.734" rx="2" ry="2.016"/>
                                            </g>
                                          </g>
                                        </svg>
                                        <%= trans('chat.change_details') %>
                                    </button>
                                <% } %>
                            </div>
                        <% } else if (chat_message.interview_request.state == 'changed') { %>
                            <div class="[ chat-message__interview-request__state ]">
                                <div class="d-inline-flex px-0 align-self-center">
                                    <div class="chat-message__interview-request__div-for-svg mx-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 344.37 344.37" style="enable-background:new 0 0 344.37 344.37; fill:#27cfc3; verical-align:middle; margin-top:9px;" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path d="M334.485,37.463c-6.753-1.449-13.396,2.853-14.842,9.603l-9.084,42.391C281.637,40.117,228.551,9.155,170.368,9.155    c-89.603,0-162.5,72.896-162.5,162.5c0,6.903,5.596,12.5,12.5,12.5c6.903,0,12.5-5.597,12.5-12.5    c0-75.818,61.682-137.5,137.5-137.5c49.429,0,94.515,26.403,118.925,68.443l-41.674-8.931c-6.752-1.447-13.396,2.854-14.841,9.604    c-1.446,6.75,2.854,13.396,9.604,14.842l71.536,15.33c1.215,0.261,2.449,0.336,3.666,0.234c2.027-0.171,4.003-0.836,5.743-1.962    c2.784-1.801,4.738-4.634,5.433-7.875l15.331-71.536C345.535,45.555,341.235,38.911,334.485,37.463z"/>
                                                    <path d="M321.907,155.271c-6.899,0.228-12.309,6.006-12.081,12.905c1.212,36.708-11.942,71.689-37.042,98.504    c-25.099,26.812-59.137,42.248-95.844,43.46c-1.53,0.05-3.052,0.075-4.576,0.075c-47.896-0.002-92.018-24.877-116.936-65.18    l43.447,11.65c6.668,1.787,13.523-2.168,15.311-8.837c1.788-6.668-2.168-13.522-8.836-15.312l-70.664-18.946    c-3.202-0.857-6.615-0.409-9.485,1.247c-2.872,1.656-4.967,4.387-5.826,7.589L0.43,293.092    c-1.788,6.668,2.168,13.522,8.836,15.311c1.085,0.291,2.173,0.431,3.245,0.431c5.518,0,10.569-3.684,12.066-9.267l10.649-39.717    c29.624,46.647,81.189,75.367,137.132,75.365c1.797,0,3.604-0.029,5.408-0.089c43.381-1.434,83.608-19.674,113.271-51.362    s45.209-73.031,43.776-116.413C334.586,160.453,328.805,155.026,321.907,155.271z"/>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                                <span class="align-self-center"><%= trans('chat.interview_request_was_changed') %></span>
                            </div>
                        <% } else if (chat_message.interview_request.state == 'accepted') { %>
                            <div class="[ chat-message__interview-request__state ]">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 448.8 448.8" style="enable-background:new 0 0 448.8 448.8; fill:#27cfc3; background-color: #fff; border-radius: 50%; box-sizing: border-box; padding: 10px;" xml:space="preserve">
                                        <g>
                                            <g id="check">
                                                <polygon points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"></polygon>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <span><%= trans('chat.interview_request_was_accepted') %></span>
                            </div>
                            <a class="[ chat-message__interview-request__google-calendar ]" href="https://www.google.com/calendar/render?action=TEMPLATE&text=<%- encodeURIComponent('Interview with ' + chat_message.interview_request.interviewer_name) %>&dates=<%- (moment(chat_message.interview_request.date).toISOString() || '').replace(/-|:|\.000/g, '') %>/<%- (moment(chat_message.interview_request.date).toISOString() || '').replace(/-|:|\.000/g, '') %>&details=For+details,+link+here:+http://www.example.com&location=<%- encodeURIComponent(chat_message.interview_request.address) %>&sf=true&output=xml" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 511.999 511.999; align-self: center; margin-right:5px;" xml:space="preserve" width="20px" height="20px">
                                    <path style="fill:#E6E6E6;" d="M455.617,10.846H56.367c-12.437,0-22.517,10.094-22.517,22.531v74.912h444.296V33.377  C478.147,20.939,468.053,10.846,455.617,10.846z M148.16,55.922c-5.953,0-10.784-4.831-10.784-10.784s4.831-10.784,10.784-10.784  c5.953,0,10.784,4.831,10.784,10.784S154.112,55.922,148.16,55.922z M366.656,55.922c-5.953,0-10.784-4.831-10.784-10.784  s4.831-10.784,10.784-10.784s10.784,4.831,10.784,10.784S372.608,55.922,366.656,55.922z"/>
                                    <path style="fill:#3A5BBC;" d="M511.505,113.523l-34.077,177.704l13.918,184.793c1.021,13.559-9.706,25.134-23.322,25.134H43.96  c-13.602,0-24.343-11.575-23.322-25.134l13.933-184.793L0.494,113.523C-2.712,96.815,10.099,81.3,27.123,81.3h457.74  C501.901,81.3,514.711,96.815,511.505,113.523z"/>
                                    <path style="fill:#518EF8;" d="M468.024,501.153H43.96c-13.602,0-24.343-11.575-23.322-25.134l13.933-184.793h244.435h198.423  l13.918,184.793C492.368,489.578,481.641,501.153,468.024,501.153z"/>
                                    <g>
                                        <path style="fill:#FFFFFF;" d="M247.371,244.856c0-34.687-29.026-62.906-64.703-62.906s-64.703,28.219-64.703,62.906h21.568   c0-22.794,19.351-41.338,43.136-41.338s43.136,18.544,43.136,41.338s-19.351,41.338-43.136,41.338h-20.13v21.568h20.13   c23.785,0,43.136,18.544,43.136,41.338c0,22.794-19.351,41.338-43.136,41.338s-43.136-18.544-43.136-41.338h-21.568   c0,34.687,29.026,62.906,64.703,62.906s64.703-28.219,64.703-62.906c0-21.663-11.322-40.802-28.513-52.122   C236.05,285.659,247.371,266.519,247.371,244.856z"/>
                                        <polygon style="fill:#FFFFFF;" points="289.289,218.704 300.353,237.218 342.989,211.741 342.989,401.222 364.556,401.222    364.556,173.728  "/>
                                    </g>
                                </svg>
                                <%= trans('chat.add_interview_to_google_calendar') %>
                            </a>
                        <% } else if (chat_message.interview_request.state == 'rejected') { %>
                            <div class="[ chat-message__interview-request__state ]">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 48.8 48.8" style="enable-background:new 0 0 48.8 48.8; vertical-align: middle; margin-right: 5px;" xml:space="preserve">
                                    <g>
                                        <g id="check">
                                            <polygon points="47.998,4.247 43.758,0.002 24.001,19.758 4.245,0.002 0.004,4.247 19.758,24.001 0.004,43.755    4.25,47.995 24.001,28.244 43.752,47.995 47.998,43.755 28.244,24.001  "/>
                                        </g>
                                    </g>
                                </svg>
                                <span><%= trans('chat.interview_request_was_dismissed') %></span>
                            </div>
                        <% } else if (chat_message.interview_request.state == 'withdrawn') { %>
                            <div class="[ chat-message__interview-request__state ]">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 48.8 48.8" style="enable-background:new 0 0 48.8 48.8; vertical-align: middle; margin-right: 5px;" xml:space="preserve">
                                    <g>
                                        <g id="check">
                                            <polygon points="47.998,4.247 43.758,0.002 24.001,19.758 4.245,0.002 0.004,4.247 19.758,24.001 0.004,43.755    4.25,47.995 24.001,28.244 43.752,47.995 47.998,43.755 28.244,24.001  "/>
                                        </g>
                                    </g>
                                </svg>
                                <span style="vertical-align: middle;"><%= trans('chat.interview_request_was_withdrawn') %></span>
                            </div>
                        <% } %>
                    </div>
                </div>
            <% } %>
        </div>
        <div class="[ chat-message__time ]" style="font-size:12px; opacity:0.5;" title="<%= new Date(chat_message.created_at || 0).toUTCString() %>"><%= timeago().format(new Date(chat_message.created_at || 0)) %></div>
        <% if (chat_message.read_interlocutors.length > 0) { %>
            <div class="[ chat-message__read-interlocutors ]">
                <% chat_message.read_interlocutors.forEach(function(read_interlocutor) { %>
                    <img src="<%- read_interlocutor.user.user_pic %>" alt="avatar" class="[ chat-message__read-interlocutor ] rounded" title="<%= read_interlocutor.user.first_name %> <%= read_interlocutor.user.last_name %>">
                <% }); %>
            </div>
        <% } %>
    </div>
</script>
<script type="text/template" id="chat-typing-interlocutors-template">
    <% typing_interlocutors.forEach(function(typing_interlocutor) { %>
        <div class="chat-typing__interlocutor" data-id="<%- typing_interlocutor.id %>">
            <img class="[ chat-typing__avatar ] rounded" src="<%- typing_interlocutor.user.user_pic %>" alt="avatar">
        </div>
    <% }); %>
</script>