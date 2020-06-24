@extends('admin::layouts.app')

@section('content')

    <div class="ml-3 mt-2" style="width: 100%;">

        <div class="col-12">
            <form action="/nexus/agents" method="POST">
                {{ csrf_field() }}
                <p class="h4"><strong>Create new Agent</strong></p>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 row">
                            <div class="mr-3">
                                <input type="text" name="first_name" class="form-control form-control-sm" placeholder="First name">
                            </div>
                            <div class="mr-3">
                                <input type="text" name="last_name" class="form-control form-control-sm" placeholder="Last name">
                            </div>
                            <div class="mr-3">
                                <input type="password" name="password" class="form-control form-control-sm" placeholder="Password">
                            </div>
                            <div class="mr-3">
                                <input type="email" name="email" class="form-control form-control-sm" placeholder="Email">
                            </div>
                            <div class="mr-3">
                                <select name="departments[]" class="select2-departments form-control form-control-sm" multiple="multiple">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->display_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mr-3">
                                <textarea name="html_signature" class="form-control form-control-sm html-signature" placeholder="HTML Signature"></textarea>
                                <p class="mt-1">
                                    <a href="javascript:void(0)" class="btn btn-outline-success html-signature-btn" data-toggle="modal" data-target="#previewSignature">Preview signature</a>
                                </p>
                            </div>
                            <div class="mr-3 ml-auto">
                                <button type="submit" class="btn btn-outline-primary">Create Agent</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-12 mt-3 px-3">
            <p><strong>Agent List</strong></p>
            <div class="d-flex">
                <form action="/nexus/agents" method="GET" class="filter-form form-inline">

                    <div class="mr-3">
                        <input type="text" name="agent" placeholder="Find Agent" class="form-control form-control-sm mr-3">
                    </div>
                    <div class="mr-3">
                        <select name="department" class="form-control form-control-sm">
                            <option value="" disabled {{ !app('request')->input('department') ? 'selected':'' }}>Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ app('request')->input('department') == $department->id ? 'selected':'' }}>{{ $department->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mr-3">
                        <button type="submit" class="btn btn-primary btn-sm">Find</button>
                    </div>
                    <div class="mr-3">
                        <a href="/nexus/agents" class="btn btn-info btn-sm">Clear</a>
                    </div>

                </form>

            </div>
        </div>

        <div class="col-12 mt-3">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Departments</th>
                    <th>Closed Tickets</th>
                    <th>Tickets Open</th>
                    <th>Rating</th>
                    <th>Low rating Tickets</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($agents as $agent)
                        <tr>
                            <td><a href="#">{{ $agent->first_name . ' ' . $agent->last_name}}</a></td>
                            <td>
                                @foreach($agent->departments as $department)
                                    {{ $department->display_name }},
                                @endforeach
                            </td>
                            <td><a href="#">{{ $agent->closed_count_tickets }}</a></td>
                            <td><a href="#">{{ $agent->open_count_tickets }}</a></td>
                            <td><a href="#" data-toggle="modal" data-target="#ticketId">9.3</a></td>
                            <td><a href="#">38</a></td>
                            <td><button class="btn btn-outline-primary btn-sm agent-href" data-agent-id="{{ $agent->id }}" data-toggle="modal" data-target="#editAgent">Edit</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
    </div>

    </div>

    <script>
        var agentId = null;

        $(document).ready(function() {
            $('.select2-departments').select2({
                placeholder: "Departments",
                allowClear: true
            });

            $('.select2-modal-departments').select2();

            $('.html-signature-btn').click(function () {

                var sign = $('.html-signature').val();

                $('#previewSignature .sign-content').html(sign);

            });

            $('.agent-href').click(function () {
                agentId = $(this).data('agent-id');
                getAgentData(agentId)
                    .then(function (agentData) {
                        fillAgentModal(agentData);
                    })
                    .catch(function (err) {
                        console.log('err',err);
                    });
            });

            function getAgentData(id) {
                return $.get('/nexus/agents/'+id)
            }

            function fillAgentModal(data) {
                $('#agent-delete-btn').attr('data-href', 'agents/delete/'+ data.id);
                $('#modal-agent-id').val(data.id);
                $('#modal-agent-name').val(data.name);
                $('#modal-agent-first-name').val(data.first_name);
                $('#modal-agent-last-name').val(data.last_name);
                $('#modal-agent-email').val(data.email);
                $('#modal-agent-html-signature').val(data.html_signature);
                var currentDepartments = [];

                data.departments.forEach(function (el, i) {
                    currentDepartments[i] = el.id;
                });
                $('.select2-modal-departments').val(currentDepartments).trigger("change");
            }

            $('#agent-update-btn').click(function (e) {
                e.preventDefault();
                $.ajax({
                    beforeSend: function(request) {
                        request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
                    },
                    url: '/nexus/agents/'+agentId,
                    method: 'PUT',
                    data: {
                        name: $('#modal-agent-name').val(),
                        first_name: $('#modal-agent-first-name').val(),
                        last_name: $('#modal-agent-last-name').val(),
                        email: $('#modal-agent-email').val(),
                        departments: $('#modal-agent-departments').val(),
                        html_signature: $('#modal-agent-html-signature').val()
                    }
                })
                    .then(function (value) {
                        console.log('value',value);
                        location.reload();
                    })
                    .catch(function (reason) {
                        console.log('reason',reason);
                    })
            });

            $('#youSure').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
        });
    </script>



    <!--MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="ticketId" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body pb-3">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Rating</th>
                            <th>Tickets</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>10</td>
                            <td><a href="#">2</a></td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td><a href="#">2</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END!!!!!!!!!!!!!!! -->

    <!--MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="previewSignature" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body pb-3">

                    <p style="color: #777777">Example of the signature is bellow</p>

                    <div class="sign-content"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END!!!!!!!!!!!!!!! -->

    <!--MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="editAgent" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body pb-3">

                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <input id="modal-agent-id" type="hidden" name="modal-agent-id" value="">
                                <input id="modal-agent-first-name" type="text" name="modal-agent-first-name" class="form-control form-control-sm" value="" placeholder="First name">
                            </div>
                            <div class="col-6">
                                <input id="modal-agent-last-name" type="text" name="modal-agent-last-name" class="form-control form-control-sm" value="" placeholder="Last name">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-6">
                                <input id="modal-agent-name" type="text" name="modal-agent-name" class="form-control form-control-sm" placeholder="Name">
                            </div>
                            <div class="col-6">
                                <input id="modal-agent-email" type="email" name="modal-agent-email" class="form-control form-control-sm" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12">
                                <select id="modal-agent-departments" name="modal-agent-departments[]" class="select2-modal-departments form-control form-control-sm" multiple="multiple" style="width: 100%">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->display_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mt-2">
                                <textarea id="modal-agent-html-signature" name="modal-agent-html-signature" class="form-control form-control-sm html-signature" placeholder="HTML Signature"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-6">
                                <button id="agent-update-btn" class="btn btn-outline-primary btn-block">Update</button>
                            </div>
                            <div class="col-6">
                                <button id="agent-delete-btn" data-href="/delete.php?id=54" class="btn btn-outline-warning btn-block" data-toggle="modal" data-target="#youSure">Delete</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END!!!!!!!!!!!!!!! -->

    <!--MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="youSure" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body pb-3">
                    <p><strong>Are you sure?</strong></p>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-outline-primary btn-block btn-ok">Yes</a>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-warning btn-block" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END!!!!!!!!!!!!!!! -->


@endsection
