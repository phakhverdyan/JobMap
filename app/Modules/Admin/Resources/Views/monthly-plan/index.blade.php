@extends('admin::layouts.app')

@section('content')
    <form action="monthly-plans" method="POST">
        {{ csrf_field() }}
        <div class="container mx-auto ml-3 mt-2" style="width: 100%;">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-12">
                <p class="h4">
                    <strong>Monthly Plans</strong>
                    <span style="float: right;"><button class="btn btn-sm btn-primary px-5">Save</button></span>
                </p>
            </div>

            <div class="col-12 mt-3">
                <table class="table monthly-plans">
                    <thead>
                    <tr>
                        <th>Applicants (Up to)</th>
                        <th>Price/m</th>
                        <th>Plan name</th>
                        <th>Status</th>
                        <th>
                            <button class="btn btn-sm btn-outline-primary px-4" id="add-monthly-plans-row">+</button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($monthly_plans as $plan)
                        <tr id="order-{{ $plan->id }}">
                            <input type="hidden" name="monthly_id[]" value="{{ $plan->id }}">
                            <td><input type="text" name="monthly_applicants[]" value="{{ $plan->applicants }}"></td>
                            <td><input type="text" name="monthly_price[]" value="{{ $plan->price }}"></td>
                            <td><input type="text" name="monthly_plan_name[]" value="{{ $plan->plan_name }}"></td>
                            <td>
                                <select name="monthly_status[]" class="form-control">
                                    <option value="1" {{ $plan->status == 1? 'selected': '' }}>Active</option>
                                    <option value="0" {{ $plan->status == 0? 'selected': '' }}>Paused</option>
                                </select>
                            </td>
                            <td><a class="btn btn-sm btn-outline-primary px-4"
                                   href="monthly-plans/delete/{{ $plan->id }}">-</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-12 mt-3">
                <p class="h4"><strong>Addon packages (non renewable)</strong></p>
                <table class="table addon-packages">
                    <thead>
                    <tr>
                        <th>Applicants (Up to)</th>
                        <th>Price/m</th>
                        <th>Plan name</th>
                        <th>Status</th>
                        <th>
                            <button class="btn btn-sm btn-outline-primary px-4" id="add-addon-packages-row">+</button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($addon_packages as $package)
                        <tr id="order-{{ $package->id }}">
                            <input type="hidden" name="package_id[]" value="{{ $package->id }}">
                            <td><input type="text" name="package_applicants[]" value="{{ $package->applicants }}"></td>
                            <td><input type="text" name="package_price[]" value="{{ $package->price }}"></td>
                            <td><input type="text" name="package_plan_name[]" value="{{ $package->plan_name }}"></td>
                            <td>
                                <select name="package_status[]" class="form-control">
                                    <option value="1" {{ $package->status == 1? 'selected': '' }}>Active</option>
                                    <option value="0" {{ $package->status == 0? 'selected': '' }}>Paused</option>
                                </select>
                            </td>
                            <td><a class="btn btn-sm btn-outline-primary px-4"
                                   href="addon-packages/delete/{{ $package->id }}">-</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.monthly-plans tbody').sortable({
                axis: 'y',
                update: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        beforeSend: function (request) {
                            request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
                        },
                        url: '/nexus/monthly-plans/sorted',
                        method: 'PUT',
                        data: data
                    })
                        .then(function (value) {
                        })
                        .catch(function (reason) {
                            console.log('reason', reason);
                        })
                }
            });

            $('.addon-packages tbody').sortable({
                axis: 'y',
                update: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        beforeSend: function (request) {
                            request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
                        },
                        url: '/nexus/addon-packages/sorted',
                        method: 'PUT',
                        data: data
                    })
                        .then(function (value) {
                        })
                        .catch(function (reason) {
                            console.log('reason', reason);
                        })
                }
            });

            $('#add-monthly-plans-row').click(function (ev) {
                ev.preventDefault();
                $(".monthly-plans").find('tbody')
                    .append($('<tr>')
                        .append($('<td>')
                            .append($('<input type="text" name="monthly_applicants[]" value="">'))
                        )
                        .append($('<td>')
                            .append($('<input type="text" name="monthly_price[]" value="">'))
                        )
                        .append($('<td>')
                            .append($('<input type="text" name="monthly_plan_name[]" value="">'))
                        )
                    );
            });

            $('#add-addon-packages-row').click(function (ev) {
                ev.preventDefault();
                $(".addon-packages").find('tbody')
                    .append($('<tr>')
                        .append($('<td>')
                            .append($('<input type="text" name="package_applicants[]" value="">'))
                        )
                        .append($('<td>')
                            .append($('<input type="text" name="package_price[]" value="">'))
                        )
                        .append($('<td>')
                            .append($('<input type="text" name="package_plan_name[]" value="">'))
                        )
                    );
            });
        });
    </script>
@endsection