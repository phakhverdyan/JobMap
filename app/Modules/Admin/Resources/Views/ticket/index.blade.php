@extends('admin::layouts.app')

@section('content')
    <div class="ml-3 mt-2" style="width: 100%;">

        <div class="col-12">
            <p class="h4"><strong>Tickets</strong></p>
            <div class="col-12">
                <div class="row">
                    <div class="col-6 row">
                        <form action="/nexus/tickets" method="GET" id="conditions-form">
                            <div>
                                <div class="d-flex justify-content-around">
                                    <input type="hidden" name="ordered-name" value="{{ app('request')->input('ordered-name') }}">
                                    <input type="hidden" name="ordered-direction" value="{{ app('request')->input('ordered-direction') }}">
                                    <input type="hidden" name="filter_status" value="{{ app('request')->input('filter_status') }}">
                                    <input type="hidden" name="filter_department" value="{{ app('request')->input('filter_department') }}">
                                    <input type="hidden" name="filter_priority" value="{{ app('request')->input('filter_priority') }}">
                                    <input type="hidden" name="agent_id" value="{{ app('request')->input('agent_id') }}">
                                    <input type="hidden" name="lang" value="{{ app('request')->input('lang') }}">
                                    <input type="hidden" name="delay" value="{{ app('request')->input('delay') }}">
                                    <div class="mr-3" style="">
                                        <input type="text" name="invoice_id" class="form-control form-control-sm" placeholder="Invoice ID">
                                    </div>
                                    <div class="mr-3">
                                        <input type="text" name="client_s" class="form-control form-control-sm" placeholder="Cliend ID/name">
                                    </div>
                                    <div class="mr-3">
                                        <input type="text" name="title" class="form-control form-control-sm" placeholder="Title">
                                    </div>
                                    <div class="mr-3">
                                        <button type="submit" class="btn btn-primary btn-sm">Find</button>
                                    </div>
                                    <div class="mr-3">
                                        <a href="/nexus/tickets" class="btn btn-info btn-sm">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            @foreach( $departmentsData as $department )
                                <div class="border">
                                    <p class="text-center px-3">{{ $department->department_name }} ({{ $department->total_tickets }})</p>
                                    <div class="d-flex text-center">
                                        <div class="border" style="background: #F8CECC; width: 33%;">
                                            <a class="filter-department" data-filter-department="{{ $department->department_id }}" data-filter-priority="high" href="#">{{ $department->high }}</a>
                                        </div>
                                        <div class="border" style="background: #FFF2CC; width: 33%;">
                                            <a class="filter-department" data-filter-department="{{ $department->department_id }}" data-filter-priority="medium"  href="#">{{ $department->medium }}</a>
                                        </div>
                                        <div class="border" style="background: #D5E8D4; width: 33%;">
                                            <a class="filter-department" data-filter-department="{{ $department->department_id }}" data-filter-priority="low"  href="#">{{ $department->low }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-3 d-flex px-3">
            <form action="/nexus/tickets" method="GET" class="filter-form">
                <input type="hidden" name="filter_status" value="">
                <div class="btn-group mr-3">
                    @foreach($statuses as $item )
                        <button data-filter-val="{{ $item->status }}" class="btn btn-outline-primary btn-sm filter-form-btn {{ app('request')->input('filter_status') == $item->status ? 'active':'' }}">
                            {{ $item->status }} ({{ $item->total }})
                        </button>
                    @endforeach
                </div>
            </form>
        </div>
        <div class="col-12 mt-3 d-flex px-3">
            <div class="d-inline-flex">
                <form action="/nexus/tickets" method="GET" class="filter-form-select form-inline">
                    <div class="mr-3">
                        <select class="form-control-sm" name="agent_id">
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}" {{ app('request')->input('agent_id') == $agent->id ? 'selected':'' }}>
                                    {{ $agent->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mr-3">
                        <select class="form-control-sm" name="priority">
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                    <div class="mr-3">
                        <select class="form-control-sm" name="lang">
                            @foreach($langs as $lang)
                                <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mr-3">
                        <select class="form-control-sm" name="delay">
                            <option value="1">Delay 1d</option>
                            <option value="3">Delay 3d</option>
                            <option value="5">Delay 5d</option>
                            <option value="7">Delay 1w</option>
                        </select>
                    </div>
                    <div class="mr-3">
                        <button class="btn btn-primary btn-sm filter-form-select-btn">Find</button>
                    </div>
                    <div class="mr-3">
                        <a href="/nexus/tickets" class="btn btn-info btn-sm">Clear</a>
                    </div>
                </form>
            </div>

        </div>

        <div class="col-12 mt-3">
            <table class="table table-ordered">
                <thead>
                <tr>
                    <th>Client ID
                        <a href="" class="ticket-ordered" data-order-name="client-id" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" viewBox="0 0 16 16" style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>Business name
                        <a href="" class="ticket-ordered" data-order-name="business-name" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" viewBox="0 0 16 16" style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>Ticket ID
                        <a href="" class="ticket-ordered" data-order-name="ticket-id" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" viewBox="0 0 16 16" style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>Status
                        <a href="" class="ticket-ordered" data-order-name="status" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" viewBox="0 0 16 16" style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>Title
                        <a href="" class="ticket-ordered" data-order-name="title" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" viewBox="0 0 16 16" style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>Last reply
                        <a href="" class="ticket-ordered" data-order-name="last-reply" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" viewBox="0 0 16 16" style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>Assigned to
                        <a href="" class="ticket-ordered" data-order-name="assigned-to" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" viewBox="0 0 16 16" style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>Priority
                        <a href="" class="ticket-ordered" data-order-name="priority" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" viewBox="0 0 16 16" style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>Department
                        <a href="" class="ticket-ordered" data-order-name="department" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" viewBox="0 0 16 16" style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>Open since
                        <a href="" class="ticket-ordered" data-order-name="open-since" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" viewBox="0 0 16 16" style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>Open Tickets
                        <a href="" class="ticket-ordered" data-order-name="open-tickets" data-order-direction="asc">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" viewBox="0 0 16 16" style="vertical-align: middle; margin-top: -3px;">
                                <path fill="#444444" d="M11 7h-6l3-4z"/>
                                <path fill="#444444" d="M5 9h6l-3 4z"/>
                            </svg>
                        </a>
                    </th>
                    <th>Lang</th>
                </tr>
                </thead>
                <tbody>

                    @foreach($tickets as $ticket)
                        <tr>
                            <td><a href="#">{{ $ticket->client_id }}</a></td>
                            <td><a href="#">{{ $ticket->business_name }}</a></td>
                            <td><a href="#" class="ticket-href" data-ticket-id="{{$ticket->id}}" data-toggle="modal" data-target="#ticketId">{{ $ticket->id }}</a></td>
                            <td>{{ $ticket->status }}</td>
                            <td><a href="#">{{ $ticket->title }}</a></td>
                            <td>{{ \Carbon\Carbon::parse($ticket->last_reply)->diffInHours() }} hours</td>
                            <td>{{ $ticket->agent }}</td>
                            <td>{{ $ticket->priority }}</td>
                            <td>{{ $ticket->department }}</td>
                            <td>{{ \Carbon\Carbon::parse($ticket->created_at)->diffInDays() }}</td>
                            <td><a href="#">{{ $ticket->all_count_tickets }} ({{ $ticket->open_count_tickets }})</a></td>
                        <td>{{ $ticket->lang }}</td>
                </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $tickets->appends(request()->query())->links('admin::vendor.bootstrap-4') }}
        </div>


    </div>


    <!--MODAL ticket!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="ticketId" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 1200px;">
            <div class="modal-content">
                <div class="modal-body pb-3">
                    <form>
                        <p>
                            <span class="h3 modal-ticket-id">Ticket --</span> <span class="modal-ticket-priority ml-2 px-2 py-1 rounded" style="background: #F8CECC;">High</span>
                            <span style="float:right;"><button class="btn btn-primary update-ticket-btn">Save</button></span>
                        </p>
                        <div class="col-12 mt-3 px-0">
                            <table class="table" style="font-size: 14px;">
                                <thead>
                                <tr>
                                    <th>Client ID</th>
                                    <th>Business name</th>
                                    <th>Ticket ID</th>
                                    <th>Status</th>
                                    <th>Last reply</th>

                                    <th>Department</th>
                                    <th>Assigned to</th>
                                    <th>Priority</th>

                                    <th>Open since</th>
                                    <th>Open Tickets</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><a href="#" id="modal-client-id">--</a></td>
                                    <td><a href="#" id="modal-business-name">--</a></td>
                                    <td><a href="#" id="modal-ticket-id" data-toggle="modal" data-target="#ticketId">--</a></td>
                                    <td>
                                        <select id="modal-ticket-status-select" name="ticket-status" class="form-control form-control-sm">
                                            <option value="Unassigned">Unassigned</option>
                                            <option value="Open - Waiting for internal reply">Open - Waiting for internal reply</option>
                                            <option value="Open - Waiting for client reply">Open - Waiting for client reply</option>
                                            <option value="Closed">Closed</option>
                                            <option value="Resolved">Resolved</option>
                                            <option value="Spam">Spam</option>
                                        </select>
                                    </td>
                                    <td>44 hours</td>
                                    <td>
                                        <select name="ticket-department" class="form-control form-control-sm modal-department-select">
                                            @foreach($departmentList as $department)
                                                <option value="{{ $department->id }}">{{ $department->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="ticket-agent" class="form-control form-control-sm modal-agents-select">
                                            @foreach($agents as $agent)
                                                <option value="{{ $agent->id }}">
                                                    {{ $agent->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="ticket-priority" id="modal-ticket-priority-select" class="form-control form-control-sm">
                                            <option value="high">High</option>
                                            <option value="medium">Medium</option>
                                            <option value="low">Low</option>
                                        </select>
                                    </td>

                                    <td id="modal-open-since">--</td>
                                    <td><a href="#">-- (--)</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>


                    <div class="col-8 mt-3 px-0">
                        <table class="table" style="font-size: 14px;">
                            <thead>
                            <tr>
                                <th style="width: 50%;">Title</th>
                                <th>Phone Number</th>
                                <th>Location</th>
                                <th>Spoken Language</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td id="modal-ticket-title">--</td>
                                <td id="modal-phone-number">--</td>
                                <td id="modal-country">--</td>
                                <td id="modal-client-lang">--</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <select id="modal-message-type" class="col-3 mr-5 form-control form-control-sm">
                                <option value="agent_reply">Reply</option>
                                <option value="internal_note">Internal Note</option>
                            </select>
                            <div class="ml-auto btn-group">
                                <button class="btn btn-outline-secondary btn-sm update-ticket-status-btn" data-ticket-status="Closed">Close/Archive</button>
                                <button class="btn btn-outline-secondary btn-sm update-ticket-status-btn" data-ticket-status="Spam">Spam</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-0 my-2">
                        <textarea id="modal-message-text" class="form-control" style="height: 150px;" placeholder="Reply here"></textarea>
                    </div>
                    <div class="col-12 row ml-0 px-0">
                        <div class="ml-auto btn-group">
                            <button class="btn btn-outline-warning btn-sm update-ticket-status-btn" data-ticket-status="Resolved">Add & Resolve</button>
                            <button class="btn btn-outline-primary btn-sm add-ticket-message-btn">Add</button>
                        </div>
                    </div>

                    <div class="col-12 mt-5 modal-messages"></div>

                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END!!!!!!!!!!!!!!! -->


    <script>
        var ticketId;

        $('.ticket-ordered').on('click', function (e) {

            $('.table-ordered a.ticket-ordered').each(function () {

                var globOrderName = $('#conditions-form input[name="ordered-name"]').val();
                var globOrderDirection = $('#conditions-form input[name="ordered-direction"]').val();

                if ( $(this).data('order-name') == globOrderName ) {
                    if ( $(this).data('order-direction') == globOrderDirection && globOrderDirection == 'asc') {
                        $(this).data('order-direction', 'desc');
                    } else if ($(this).data('order-direction') == globOrderDirection && orderDirection == 'desc') {
                        $(this).data('order-direction', 'asc');
                    }
                }
            });

            var orderName = $(this).data('order-name');
            var orderDirection = $(this).data('order-direction');
            e.preventDefault();

            $('#conditions-form input[name="ordered-name"]').val(orderName);
            $('#conditions-form input[name="ordered-direction"]').val(orderDirection);
            $('#conditions-form').submit();
        });

        $('.filter-form-btn').on('click', function () {
            var filterStatus = $(this).data('filter-val');
            $('.filter-form input[name="filter_status"]').val(filterStatus);
            $('.filter-form').submit();
        });

        $('.filter-form-select-btn').on('click', function () {
            var agent_id = $('.filter-form-select select[name=agent_id]').val();
            var priority = $('.filter-form-select select[name=priority]').val();
            var lang = $('.filter-form-select select[name=lang]').val();
            var delay = $('.filter-form-select select[name=delay]').val();

            $('#conditions-form input[name="agent_id"]').val(agent_id);
            $('#conditions-form input[name="filter_priority"]').val(priority);
            $('#conditions-form input[name="lang"]').val(lang);
            $('#conditions-form input[name="delay"]').val(delay);

            $('.filter-form-select').submit();
        });

        $('.filter-department').click(function () {
            var department = $(this).data('filter-department');
            var filterPriority = $(this).data('filter-priority');

            $('#conditions-form input[name="filter_department"]').val(department);
            $('#conditions-form input[name="filter_priority"]').val(filterPriority);
            $('#conditions-form').submit();
        });





        $('.ticket-href').click(function () {
            ticketId = $(this).data('ticket-id');

            getTicketData(ticketId)
                .then(function (ticketData) {
                    fillModal(ticketData);
                    outputMessages(ticketData.ticket_messages)
                })
                .catch(function (err) {
                    console.log('err',err);
                })
        });

        function outputMessages(messages) {

            var internalNote = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 439.875 439.875" style="enable-background:new 0 0 439.875 439.875; width: 20px; height: 20px;" xml:space="preserve">' +
                '<g><path d="M401.625,0H38.25C17.212,0,0,17.212,0,38.25v363.375c0,21.037,17.212,38.25,38.25,38.25h277.312h9.562L439.875,306v-9.562   V38.25C439.875,17.212,422.662,0,401.625,0z M325.125,411.188v-86.062c0-11.475,9.562-19.125,19.125-19.125h70.763L325.125,411.188   z M420.75,286.875h-76.5c-21.037,0-38.25,17.213-38.25,38.25v95.625H38.25c-11.475,0-19.125-7.65-19.125-19.125V114.75H420.75   V286.875z M420.75,95.625H19.125V38.25c0-11.475,7.65-19.125,19.125-19.125h363.375c11.475,0,19.125,7.65,19.125,19.125V95.625z"/></g>' +
                '</svg>';

            var systemMessage = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 489.711 489.711" style="enable-background:new 0 0 489.711 489.711; width: 20px; height: 20px;" xml:space="preserve">' +
                '<g><g><path d="M112.156,97.111c72.3-65.4,180.5-66.4,253.8-6.7l-58.1,2.2c-7.5,0.3-13.3,6.5-13,14c0.3,7.3,6.3,13,13.5,13    c0.2,0,0.3,0,0.5,0l89.2-3.3c7.3-0.3,13-6.2,13-13.5v-1c0-0.2,0-0.3,0-0.5v-0.1l0,0l-3.3-88.2c-0.3-7.5-6.6-13.3-14-13    c-7.5,0.3-13.3,6.5-13,14l2.1,55.3c-36.3-29.7-81-46.9-128.8-49.3c-59.2-3-116.1,17.3-160,57.1c-60.4,54.7-86,137.9-66.8,217.1    c1.5,6.2,7,10.3,13.1,10.3c1.1,0,2.1-0.1,3.2-0.4c7.2-1.8,11.7-9.1,9.9-16.3C36.656,218.211,59.056,145.111,112.156,97.111z"/>' +
                '<path d="M462.456,195.511c-1.8-7.2-9.1-11.7-16.3-9.9c-7.2,1.8-11.7,9.1-9.9,16.3c16.9,69.6-5.6,142.7-58.7,190.7    c-37.3,33.7-84.1,50.3-130.7,50.3c-44.5,0-88.9-15.1-124.7-44.9l58.8-5.3c7.4-0.7,12.9-7.2,12.2-14.7s-7.2-12.9-14.7-12.2l-88.9,8    c-7.4,0.7-12.9,7.2-12.2,14.7l8,88.9c0.6,7,6.5,12.3,13.4,12.3c0.4,0,0.8,0,1.2-0.1c7.4-0.7,12.9-7.2,12.2-14.7l-4.8-54.1    c36.3,29.4,80.8,46.5,128.3,48.9c3.8,0.2,7.6,0.3,11.3,0.3c55.1,0,107.5-20.2,148.7-57.4    C456.056,357.911,481.656,274.811,462.456,195.511z"/>' +
                '</g></g></svg>';

            var clientReply = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; width: 20px; height: 20px;" xml:space="preserve">' +
                '<g><g><path d="M374.45,332.463c-0.407-0.044-59.344,1.695-68.107-61.463c9.737-6.794,18.711-15.614,26.617-26.316    c15.38-20.82,25.29-46.938,28.82-75.189c1.213-1.097,2.217-2.462,2.893-4.071c6.387-15.215,9.626-31.461,9.626-48.289    C374.299,52.547,325.578,0,265.688,0c-15.663,0-30.859,3.608-45.211,10.733c-5.475,0.418-10.84,1.381-15.985,2.867    c-24.597,7.107-44.613,25.344-56.362,51.354c-11.406,25.254-13.654,54.983-6.328,83.712c1.548,6.069,3.516,12.033,5.85,17.731    c0.632,1.541,1.574,2.856,2.705,3.938c5.718,44.095,26.699,80.63,55.307,100.577c-8.79,63.265-67.706,61.509-68.112,61.553    c-42.382,1.438-76.425,36.341-76.425,79.067v88.941c0,6.367,5.161,11.528,11.528,11.528h101.231h164.227h101.233    c6.366,0,11.529-5.161,11.529-11.528v-88.941C450.874,368.804,416.834,333.9,374.45,332.463z M210.893,35.751    c4.207-1.216,8.65-1.937,13.206-2.142c1.691-0.076,3.344-0.523,4.843-1.311c11.671-6.132,24.035-9.241,36.747-9.241    c47.174,0,85.554,42.203,85.554,94.078c0,1.557-0.044,3.106-0.112,4.649c-9.15-9.292-21.863-15.067-35.902-15.067h-78.571    c-4.675,0-9.112-1.468-12.833-4.246c-3.177-2.371-5.633-5.558-7.1-9.216c-2.272-5.658-7.874-9.197-13.972-8.814    c-6.12,0.39-11.27,4.64-12.816,10.579c-4.553,17.496-13.632,33.612-26.088,46.681C152.259,94.002,173.176,46.648,210.893,35.751z     M200.863,235.14c-15.001-18.326-24.825-43.073-27.939-70.166c14.547-12.965,26.047-29.099,33.534-46.995    c1.136,1.048,2.329,2.039,3.575,2.97c7.736,5.773,16.942,8.826,26.626,8.826h78.571c11.117,0,20.699,6.668,24.975,16.211    c-0.001,0.082-0.013,0.16-0.013,0.242c0,65.078-37.76,118.023-84.174,118.023C235.818,264.252,216.229,253.913,200.863,235.14z     M227.352,282.233c9.139,3.307,18.752,5.076,28.666,5.076c9.835,0,19.444-1.712,28.643-5.015    c4.221,21.991,16.448,41.158,33.527,54.353l-60.535,86.208c-0.395,0.563-0.944,0.848-1.632,0.848c-0.687,0-1.236-0.286-1.63-0.847    l-60.55-86.228C210.921,323.418,223.144,304.237,227.352,282.233z M427.817,488.943h-89.704H173.886H84.183v-77.413    c0-30.922,25.157-56.079,56.079-56.079c0.42,0,18.971-0.451,33.629-7.112l61.629,87.766c4.684,6.672,12.348,10.655,20.5,10.655    c0,0,0,0,0.001,0c8.151,0,15.816-3.983,20.5-10.655l61.618-87.752c16.717,7.099,33.18,7.099,33.6,7.099    c30.922,0,56.078,25.157,56.078,56.079V488.943z"/>' +
                '</g></g></svg>';

            var agentReply = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 422.692 422.692" style="enable-background:new 0 0 422.692 422.692; width: 20px; height: 20px;" xml:space="preserve">\n' +
                '<g><g><path d="M271.786,289.626v-7.36c2.08-1.68,4.08-3.52,6-5.44c15.373-16.927,25.053-38.246,27.68-60.96    c13.816-2.105,26.269-9.509,34.72-20.64c11.6-16.4,12.64-40,2.96-69.6c-0.569-1.707-1.696-3.173-3.2-4.16l-4.4-2.96    c0.649-26.708-8.581-52.716-25.92-73.04c-21.52-24.24-54.56-36.48-98.32-36.64c-43.68,0-76.8,12.4-98.32,36.32    c-17.339,20.324-26.569,46.332-25.92,73.04l-4.4,2.96c-1.504,0.987-2.631,2.453-3.2,4.16c-9.68,29.76-8.64,53.2,2.96,69.6    c8.419,11.209,20.872,18.698,34.72,20.88c2.638,22.75,12.348,44.099,27.76,61.04c1.905,1.916,3.907,3.732,6,5.44v7.36    c-30.64,5.92-152.96,34.64-150.88,116.24c0,4.418,3.582,8,8,8h406.64c4.418,0,8-3.582,8-8    C424.746,324.266,302.426,295.546,271.786,289.626z M112.346,197.946c-6.798-2.283-12.723-6.614-16.96-12.4l0.4,0.08    c-8-11.68-8.72-29.36-1.6-52.72l5.84-3.92c2.457-1.64,3.81-4.5,3.52-7.44c-1.346-23.91,6.431-47.441,21.76-65.84    c18.08-20.48,47.12-30.72,86-30.88c38.88-0.16,67.92,10.4,86.32,30.88c15.329,18.399,23.106,41.93,21.76,65.84    c-0.29,2.94,1.063,5.8,3.52,7.44l5.84,3.92c7.12,23.28,6.64,41.04-1.6,52.72c-4.266,5.791-10.217,10.122-17.04,12.4    c9.65-10.98,14.365-25.442,13.04-40c-1.499-8.759-6.065-16.698-12.88-22.4c-3.44-80-59.52-88.96-83.68-88.96    c-5.114-0.015-10.222,0.36-15.28,1.12c-5.057-0.761-10.166-1.135-15.28-1.12c-24,0-80,8.8-83.68,88.96    c-6.859,5.656-11.481,13.568-13.04,22.32C97.972,172.505,102.688,186.971,112.346,197.946z M294.346,132.346    c-33.569,1.94-66.928-6.435-95.6-24c-3.245-2.279-7.67-1.836-10.4,1.04c-16,17.2-45.2,21.2-59.28,22.08    c4.32-56.56,38.56-68.88,67.36-68.88c4.584-0.033,9.162,0.342,13.68,1.12c1.056,0.216,2.144,0.216,3.2,0    c4.518-0.776,9.096-1.151,13.68-1.12c28.56,0,62.96,12.64,66.96,69.68L294.346,132.346z M131.866,199.466l0.32,0.08    c0.017-1.972-0.695-3.881-2-5.36c-10.96-12.56-16-24-14.64-33.44c0.652-5.258,3.249-10.081,7.28-13.52c10.56,0,48-2,72-22.72    c27.029,15.539,57.623,23.808,88.8,24c5.36,0,10.8,0,16.48-0.88c3.921,3.348,6.482,8.014,7.2,13.12    c1.36,9.28-3.68,20.88-14.64,33.44c-1.305,1.479-2.017,3.388-2,5.36c0,0,0,1.6,0,4.16l-46.56,24.96    c-9.24-8.748-23.823-8.349-32.571,0.891c-8.748,9.24-8.349,23.823,0.891,32.571c9.24,8.748,23.823,8.349,32.571-0.891    c4.054-4.282,6.312-9.955,6.309-15.851c0.036-0.72,0.036-1.44,0-2.16l36.72-19.68c-3.152,15.775-10.567,30.384-21.44,42.24    c-14.182,13.654-33.379,20.835-53.04,19.84h-4c-19.619,0.974-38.774-6.172-52.96-19.76    C131.306,240.666,131.866,199.866,131.866,199.466z M235.306,245.386c0,3.932-3.188,7.12-7.12,7.12c-3.932,0-7.12-3.188-7.12-7.12    c0-3.932,3.188-7.12,7.12-7.12S235.306,241.454,235.306,245.386z M203.306,397.386H16.266c6.32-60.08,104-85.2,134.56-91.68v14.32    c0,18.16,22.08,32,52.48,34.32V397.386z M166.826,320.026v-0.24v-27.36c13.298,6.167,27.824,9.231,42.48,8.96h4    c14.656,0.271,29.182-2.793,42.48-8.96v27.6c0,7.6-17.36,18.56-44.48,18.56S166.826,327.626,166.826,320.026z M219.306,397.626    v-43.36c30.4-2.08,52.48-16,52.48-34.32v-14c30.8,6.4,128,31.52,134.56,91.68H219.306z"/>\n' +
                '</g></g></svg>';

            var messagesHtml = '';

            messages.forEach(function(mess){
                messagesHtml += '<div class="modal-message">';
                messagesHtml += '<p class="mb-0">';

                if ( mess.type == 'internal_note') {
                    messagesHtml += internalNote;
                    messagesHtml += '<strong> ' + moment(mess.created_at).format("YYYY-MM-DD HH:mm") + ' '+ mess.admin_user ? mess.admin_user.name : ' admin' +' added note</strong>';
                    messagesHtml += '<p class="p-3 rounded" style="background-color: #f5f5f5;">'+ mess.text +'</p>';
                } else if ( mess.type == 'system_message' ) {
                    messagesHtml += systemMessage;
                    messagesHtml += '<strong> ' + moment(mess.created_at).format("YYYY-MM-DD HH:mm") + ' '+ mess.text +'</strong>';
                } else if ( mess.type == 'client_reply' ) {
                    messagesHtml += clientReply;
                    messagesHtml += '<strong> ' + moment(mess.created_at).format("YYYY-MM-DD HH:mm") + ' Client Wrote from email '+ mess.client.email +'</strong>';
                    messagesHtml += '<p class="p-3 rounded" style="background-color: #e6f5eb;">'+ mess.text +'</p>';
                } else if ( mess.type == 'agent_reply' ) {
                    messagesHtml += agentReply;
                    messagesHtml += '<strong> ' + moment(mess.created_at).format("YYYY-MM-DD HH:mm") + ' '+ mess.admin_user ? mess.admin_user.name : ' admin' +' applied</strong>';
                    messagesHtml += '<p class="p-3 rounded" style="background-color: #e6eaf5;">'+ mess.text +'</p>';
                }

                messagesHtml += '</p>';

            });

            messagesHtml += '</div>';

            $('.modal-messages').html(messagesHtml)

        }

        function fillModal(data) {
            $('.modal-ticket-id').text('Ticket ' + data.id);
            colorPrioryty(data.priority);
            $('#modal-client-id').text(data.client_id);
            $('#modal-business-name').text(data.business.name);
            $('#modal-ticket-id').text(data.id);
            $("#modal-ticket-status-select").val(data.status);
            $('#modal-ticket-priority-select').val(data.priority);
            openSinceConvert(data.created_at);
            $('#modal-ticket-title').text(data.title);
            $('#modal-phone-number').text(data.client.mobile_phone);
            $('#modal-country').text(data.client.country);
            $('#modal-client-lang').text(data.client.lang.prefix);
            $('.modal-department-select').val(data.department_id);
            $('.modal-agents-select').val(data.admin_user_id);
        }
        
        function openSinceConvert(time) {
            var d = moment(time);
            var now = moment();
            $('#modal-open-since').text(now.diff(d, 'days'));
        }

        function colorPrioryty(prior) {
            if (prior == 'high'){
                $('.modal-ticket-priority').css('background', '#F8CECC').text(prior);
            } else if (prior == 'medium') {
                $('.modal-ticket-priority').css('background', '#FFF2CC').text(prior);
            } else if (prior == 'low') {
                $('.modal-ticket-priority').css('background', '#D5E8D4').text(prior);
            }
        }

        function getTicketData(id) {
            return $.get('/nexus/tickets/'+id)
        }


        $('.update-ticket-btn').click(function (e) {

            e.preventDefault();

            $.ajax({
                beforeSend: function(request) {
                    request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
                },
                url: '/nexus/tickets/'+ticketId,
                method: 'PUT',
                data: {
                    status: $('#modal-ticket-status-select').val(),
                    admin_user_id: +$('.modal-agents-select').val(),
                    priority: $('#modal-ticket-priority-select').val(),
                    department_id: +$('.modal-department-select').val()
                }
            })
                .then(function (value) {
                    location.reload();
                })
                .catch(function (reason) {
                    console.log('reason',reason);
                })

        });

        $('.update-ticket-status-btn').click(function (e) {
            e.preventDefault();
            var status = $(this).data('ticket-status');

            $.ajax({
                beforeSend: function(request) {
                    request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
                },
                url: '/nexus/tickets/status/'+ticketId,
                method: 'PUT',
                data: {
                    status: status,
                    text: $('#modal-message-text').val()
                }
            })
                .then(function (value) {
                    location.reload();
                })
                .catch(function (reason) {
                    console.log('reason',reason);
                })
        });


        $('.add-ticket-message-btn').click(function (e) {
            e.preventDefault();
            $.ajax({
                beforeSend: function(request) {
                    request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
                },
                url: '/nexus/tickets/message/'+ticketId,
                method: 'PUT',
                data: {
                    text: $('#modal-message-text').val(),
                    type: $('#modal-message-type').val()
                }
            })
                .then(function (value) {
                    getTicketData(ticketId)
                        .then(function (ticketData) {
                            outputMessages(ticketData.ticket_messages)
                    });
                    $('#modal-message-text').val('');
                })
                .catch(function (reason) {
                    console.log('reason',reason);
                })
        });

    </script>

@endsection

