<script type="text/ejs" id="interview-request-template">
  <div class="[ interview-request ]" data-id="<%- interview_request.id %>">
    <div class="d-flex col-12 justify-content-between px-3 pt-3 pb-0 flex-lg-row flex-column">
      <div class="d-flex my-1">
        <div class="mr-3">
          <img src="<%- business_id ? interview_request.user.user_pic : interview_request.business.picture %>" style="width: 50px; height: 50px;" class="rounded">
        </div>
        <div>
          <p class="mb-1" style="font-size: 18px;">
            <strong>
                <%= business_id ? (interview_request.user.first_name + ' ' + interview_request.user.last_name) : interview_request.business.name %>
            </strong>
          </p>
          <p class="mb-0">{!! trans('main.label.with') !!} <strong><%= interview_request.interviewer_name %></strong></p>
          <p class="mb-0">
            <button type="button" class="btn btn-outline-primary btn-sm interview-request__send-message mt-2" data-user-id="<%- business_id ? interview_request.user.id : 0 %>" data-business-id="<%- business_id ? 0 : interview_request.business.id %>">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 14 14" style="enable-background:new 0 0 14 14; vertical-align: middle; margin-bottom: 3px;" xml:space="preserve" width="20px" height="18px" data-toggle="tooltip" data-placement="top" title="" data-original-title="Message">
                    <g>
                        <g>
                            <path style="" d="M7,9L5.268,7.484l-4.952,4.245C0.496,11.896,0.739,12,1.007,12h11.986    c0.267,0,0.509-0.104,0.688-0.271L8.732,7.484L7,9z"></path>
                            <path style="" d="M13.684,2.271C13.504,2.103,13.262,2,12.993,2H1.007C0.74,2,0.498,2.104,0.318,2.273L7,8    L13.684,2.271z"></path>
                            <polygon style="" points="0,2.878 0,11.186 4.833,7.079   "></polygon>
                            <polygon style="" points="9.167,7.079 14,11.186 14,2.875   "></polygon>
                        </g>
                    </g>
                </svg>
                {!! trans('main.buttons.send_message') !!}
            </button>
          </p>
        </div>
      </div>
      <% if (false) { %>
        <div class=" my-1">
            <p class="mb-1">
              <strong>{!! trans('fields.label.skype') !!}</strong>
            </p>
            <p class="mb-0">{!! trans('fields.label.details') !!} bla lba</p>
        </div>
      <% } %>
      <div class="my-1">
        <p class="mb-0">
            <strong><%= interview_request.address || '{!! trans('pages.errors.no_address') !!}' %></strong>
        </p>
      </div>
      <div class="text-lg-right text-left my-1">
        <p class="mb-1">
            <strong><%- moment(interview_request.date).format('YYYY-MM-DD, HH\\hm') %></strong>
        </p>
      </div>
    </div>
    <div class="px-0 col-12 d-flex justify-content-center">
        <% if (interview_request.state == 'accepted') { %>
            <div class="mb-0 text-center rounded align-self-center p-2 mx-2" style="font-size: 20px; background-color: #ffc107; color: #fff;">
                <%- timeago().format(interview_request.date); %>
            </div>
        <% } else if (interview_request.state == 'rejected') { %>
            <div class="mb-0 text-center rounded align-self-center p-2 mx-2" style="font-size: 20px; background-color: #ffc107; color: #fff;">
                {!! trans('main.status.dismissed') !!}
            </div>
        <% } else if (interview_request.state == 'withdrawn') { %>
            <div class="mb-0 text-center rounded align-self-center p-2 mx-2" style="font-size: 20px; background-color: #ffc107; color: #fff;">
                {!! trans('main.status.withdrawn') !!}
            </div>
        <% } else if (interview_request.state == 'changed') { %>
            <div class="mb-0 text-center rounded align-self-center p-2 mx-2" style="font-size: 20px; background-color: #ffc107; color: #fff;">
                {!! trans('main.status.changed') !!}
            </div>
        <% } else if (interview_request.state == 'sent') { %>
            <div class="mb-0 text-center rounded align-self-center p-2 mx-2" style="font-size: 20px; background-color: #ffc107; color: #fff;">
              <% if (business_id && interview_request.sender_type == 'User') { %>
                {!! trans('main.status.received') !!}
              <% } else if (!business_id && interview_request.sender_type == 'Business') { %>
                {!! trans('main.status.received') !!}
              <% } else { %>
                {!! trans('main.status.sent') !!}
              <% } %>
            </div>
        <% } %>
        <% if ([ 'changed', 'finished', 'rejected', 'withdrawn' ].indexOf(interview_request.state) < 0) { %>
          <% if (business_id || (interview_request.state == 'sent')) { %>
              <div class="mb-1 mx-2" style="margin-top: 5px;">
                  <button class="[ interview-request__change ] btn btn-info">{!! trans('main.buttons.change_details') !!}</button>
              </div>
              <% if (!business_id) { %>
                  <div class="mb-1 mx-2" style="margin-top: 5px;">
                    <button class="[ interview-request__accept ] btn btn-success">{!! trans('main.buttons.accept') !!}</button>
                  </div>
              <% } %>
          <% } %>
          <div class="mb-1" style="margin-top: 5px;">
              <% if (business_id) { %>
                <button class="[ <%- interview_request.sender_type == 'Business' ? 'interview-request__withdrawl' : 'interview-request__reject' %> ] btn btn-danger mx-2">
                  <%- interview_request.sender_type == 'Business' ? '{!! trans('main.buttons.withdrawl') !!}' : '{!! trans('main.buttons.dismiss') !!}' %>
                </button>
              <% } else { %>
                <button class="[ <%- interview_request.sender_type == 'Business' ? 'interview-request__reject' : 'interview-request__withdrawl' %> ] btn btn-danger mx-2">
                  <%- interview_request.sender_type == 'Business' ? '{!! trans('main.buttons.dismiss') !!}' : '{!! trans('main.buttons.withdrawl') !!}' %>
                </button>
              <% } %>
          </div>
          <% if (business_id && interview_request.state == 'accepted') { %>
              <div class="mb-1" style="margin-top: 5px;">
                  <button class="[ interview-request__finish ] btn btn-success px-2">{!! trans('main.buttons.finish') !!}</button>
              </div>
          <% } %>
        <% } %>
    </div>
    <hr class="mb-0">
  </div>
</script>