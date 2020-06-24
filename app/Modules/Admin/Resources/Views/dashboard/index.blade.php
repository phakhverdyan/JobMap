@extends('admin::layouts.app')

@section('content')

    {{ old('size') }}

    <div class="" style="overflow-y: auto;">

        <form action="/nexus" class="search-form" method="GET">

            <div class="container-fluid">
                <div class="row m-2">

                    <div class="col">
                        <select name="size" class="form-control px-1">
                            <option value="" {{ empty(app('request')->input('size')) ? 'selected':'' }}>Size</option>
                            @foreach($filters['size'] as $size)
                                <option value="{{$size->id}}"
                                        {{ app('request')->input('size') == $size->id ? 'selected':'' }} >
                                    {{$size->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <select class="form-control px-1">
                            <option>Type</option>
                        </select>
                    </div>

                    <div class="col">
                        <select name="country" class="form-control px-1 js-country-select2">
                            <option value="" {{ empty(app('request')->input('country')) ? 'selected':'' }}>Country
                            </option>
                            @foreach($filters['countries'] as $country)
                                <option value="{{$country->country}}"
                                        {{ app('request')->input('country') == $country->country ? 'selected':'' }} >
                                    {{$country->country}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <select name="city" class="form-control px-1 js-city-select2">
                            <option value="" {{ empty(app('request')->input('city')) ? 'selected':'' }}>City</option>
                            @foreach($filters['city'] as $c)
                                <option value="{{$c->city}}"
                                        {{ app('request')->input('city') == $c->city ? 'selected':'' }}>
                                    {{$c->city}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <select name="integration" class="form-control px-1">
                            <option>Integration</option>
                            <option value="ats">ATS</option>
                            <option value="cr-email">CR Email</option>
                            <option value="cr-forwarder">CR Forwarder</option>
                        </select>
                    </div>

                    <div class="col">
                        <select name="industry" class="form-control px-1 js-industry-select2">
                            <option value="" {{ empty(app('request')->input('industry')) ? 'selected':'' }}>Industry
                            </option>
                            @foreach($filters['industries'] as $industry)
                                <option value="{{$industry->id}}"
                                        {{ app('request')->input('industry') == $industry->id ? 'selected':'' }}>
                                    {{$industry->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <select name="referal-type" class="form-control px-1">
                            <option>Referal Type</option>
                            <option value="affiliate">Affiliate</option>
                            <option value="associate">Associate</option>
                        </select>
                    </div>

                    <div class="col">
                        <select name="refer-tier" class="form-control px-1">
                            <option>Refer tier</option>
                            <option value="1">1 tier</option>
                            <option value="2">2 tier</option>
                            <option value="3">3 tier</option>
                        </select>
                    </div>

                    <div class="col">
                        <select name="fran-priv" class="form-control px-1">
                            <option>Fran/Priv</option>
                            <option value="private">Private</option>
                            <option value="franchise">Franchise</option>
                            <option value="home">From Home</option>
                            <option value="hr">HR</option>
                        </select>
                    </div>

                    <div class="col">
                        <a class="btn btn-info" href="/nexus">Clear</a>
                    </div>

                </div>
            </div>
        </form>

        <table class="table">
            <thead>
            <tr>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Id
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Employer
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Country
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    City
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Lang
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Owner
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Type
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Size
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Users
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Date Joined
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Days joined
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Locations
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Last Login
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    C.Received
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    C.Viewed
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Open Jobs
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Closed Jobs
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Employees
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Messages
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Industry
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Imported ATS
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    CR Email
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    CR Forwarder
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Referred by
                </th>
                <th scope="col" class="text-center" style="vertical-align: top;">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="16" height="16" viewBox="0 0 16 16"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path fill="#444444" d="M11 7h-6l3-4z"/>
                            <path fill="#444444" d="M5 9h6l-3 4z"/>
                        </svg>
                    </a>
                    <br>
                    Legal type
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach( $data as $item )
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="" data-clientID="{{ $item->id }}" class="show-profile-table-link">{{ $item->name }}</a>
                    </td>
                    <td>{{ $item->country }}</td>
                    <td>{{ $item->city }}</td>
                    <td>{{ $item->lang }}</td>
                    <td>
                        {{$item->first_name}}
                        {{$item->last_name}}
                    </td>
                    <td>Paid</td>
                    <td>{{ $item->size }}</td>
                    <td>{{ $item->users }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->diffInDays() }}</td>
                    <td>{{ $item->locations }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('Y-m-d') }}</td>
                    <td>{{ $item->cReceived }}</td>
                    <td>{{ $item->cViewed }}</td>
                    <td>{{ $item->openJobs }}</td>
                    <td>{{ $item->closedJobs }}</td>
                    <td>{{ $item->employees }}</td>
                    <td></td>
                    <td>{{ $item->industry }}</td>
                    <td>yes</td>
                    <td>yes</td>
                    <td>yes</td>
                    <td>Mark(Affiliate)<a href="">REF-5678</a></td>
                    <td>{{ $item->type }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $data->appends(request()->query())->links('admin::vendor.bootstrap-4') }}
    </div>

    <script>

        $('.search-form select').on('change', function () {
            $('.search-form').submit();
        });
        //select2
        $(document).ready(function () {
            $('.js-city-select2').select2();

            $('.js-country-select2').select2();

            $('.js-industry-select2').select2();

            $('.show-profile-table-link').on('click', function (e) {
                e.preventDefault();
                var clientID = $(this).data('clientid');
                $.ajax({
                    url: '/nexus/client/' + clientID,
                    type: 'GET',
                    dataType: "json",
                    success: function (resp) {
                        $('.js-businessID').html(resp.business.id);
                        $('.js-name').html(resp.business.name);
                        $('.js-email').html(resp.business.email);
                        $('.js-country').html(resp.business.country);
                        $('.js-city').html(resp.business.city);
                        $('.js-lang').html(resp.business.lang);
                        $('.js-owner').html(resp.business.first_name + ' ' + resp.business.last_name);
                        $('.js-type').html(resp.business.type);
                        $('.js-size').html(resp.business.size);
                        $('.js-users').html(resp.business.users);
                        $('.js-owner-phone').html('+' + resp.business.phone_code + ' ' + resp.business.phone);
                        $('.js-owner-contact').html('???');

                        $('.js-data-joined').html(resp.business.created_at);
                        $('.js-days-joined').html(resp.business.diff_date);
                        $('.js-last-login').html(resp.business.updated_at);
                        $('.js-locations').html(resp.business.locations);
                        $('.js-open-jobs').html(resp.business.openJobs);
                        $('.js-closed-jobs').html(resp.business.closedJobs);
                        $('.js-employees').html(resp.business.employees);
                        $('.js-cr').html(resp.business.cReceived);
                        $('.js-cv').html(resp.business.cViewed);
                        $('.js-messages').html(resp.business.messages);
                        $('.js-industry').html(resp.business.industry);
                        $('.js-imported-ats').html('?');
                        $('.js-cr-email').html('?');
                        $('.js-cr-forwareder').html('?');
                        $('.js-referred-by').html('?');
                        $('.js-legal').html('?');

                        var htmlInvoices = '';
                        $.each(resp.invoices, function (i, el) {
                            var item = el.plan !== '' ? el.plan : el.package;
                            htmlInvoices += '<tr>' +
                                '<td>' + i + 1 + '</td>' +
                                '<td><a href="/nexus/invoice/' + el.charge_id + '" target="_blank">' + el.invoice_id + '</a></td>' +
                                '<td>' + item + '</td>' +
                                '<td>' + el.coupon + '</td>' +
                                '<td>' + el.total + '$</td>' +
                                '<td>' + el.created_at + '</td>' +
                                '<td>' + el.status + '</td>' +
                                '</tr>'
                        });
                        $('.js-invoices').html(htmlInvoices);
                        $('#profile').modal('show');
                    }
                });

            });
        });

    </script>

@endsection
