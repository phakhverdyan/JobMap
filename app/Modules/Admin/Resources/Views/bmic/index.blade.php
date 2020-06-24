@extends('admin::layouts.app')

@section('content')
    <div>
        <div>
            <p class="text-center">BigMac Index Coefficient</p>

            <form action="bmic" method="POST">
                {{ csrf_field() }}
                <div>
                    <p class="text-center">Big mac index</p>
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-flex justify-content-around">
                        <div class="mx-2" style="width: 150px;">
                            <p class="text-center">Flag</p>
                            <div class="text-center align-self-center"><span class="flag-display"> - </span></div>
                        </div>
                        <div class="mx-2" style="width: 150px;">
                            <p class="text-center">Country Code</p>
                            <div class="text-center align-self-center">
                                <span class="country-code-display"> - </span>
                            </div>
                        </div>
                        <div class="mx-2" style="width: 150px;">
                            <p class="text-center">Country Name</p>
                            <div class="d-flex">

                                <input type="hidden" name="flag" value="">
                                <input type="hidden" name="country_code" value="">


                                <select id="country_name" name="country_name" class="form-control js-country-select2"
                                        required>
                                    <option></option>
                                    @foreach($countries as $country)
                                        <option data-country-code="{{ $country->code }}" value="{{ $country->name }}">
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="mx-2" style="width: 150px;">
                            <p class="text-center">Coefficient</p>
                            <div class="d-flex">
                                <input type="number" step="any" name="coefficient" class="form-control" required>
                            </div>
                        </div>
                        <div class="mx-2">
                            <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <form action="bmic/coefficient" method="POST">
                {{ csrf_field() }}
                <div class="btn-group ml-3 mt-3" role="group" aria-label="Basic example">
                    <span class="mr-2 pt-1">Flagship coefficient</span>
                    <input type="number" step="any" name="flagship-coefficient"
                           value="{{ isset($flagship_coefficient->coefficient)?$flagship_coefficient->coefficient : 1 }}"
                           class="text-center" required>
                    <button type="submit" class="btn btn-secondary">Save</button>
                </div>
            </form>

            <div class="mt-4 ml-4">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Flag</th>
                        <th>Country Code</th>
                        <th>Country Name</th>
                        <th>Coefficient</th>
                        <th>Result</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($indexes as $index)
                        <tr>
                            <td class="flag-img"><img src="/assets/flags-mini/{{ $index->flag }}" alt=""></td>
                            <td>{{ $index->country_code }}</td>
                            <td>{{ $index->country_name }}</td>
                            <form action="bmic/update/{{ $index->id }}" method="POST">
                                {{ csrf_field() }}
                                <td><input type="text" name="coefficient" value="{{ $index->coefficient }}"
                                           class="form-control form-control-sm" style="font-size: 11px; width: 55px;">
                                </td>
                                <td>{{ $index->coefficient / $flagship_coefficient->coefficient}}</td>
                                <th>
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </th>
                            </form>


                            <th><a class="btn btn-danger btn-sm" href="bmic/delete/{{ $index->id }}">Delete</a></th>

                            <th><a href="" data-toggle="modal"
                                   data-coeff="{{ $index->coefficient / $flagship_coefficient->coefficient}}"
                                   class="show-price-table-link">Price Table</a></th>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.js-country-select2').select2();

            $('.js-country-select2').on('change', function () {
                var countryCode = $('#country_name option:selected').data('country-code');
                $('input[name = country_code]').val(countryCode);
                $('span.country-code-display').text(countryCode);
                $('input[name = flag]').val(countryCode.toLowerCase() + '.png');
                $('span.flag-display').html('<img height="25" width="40" src="/assets/flags-mini/' + countryCode.toLowerCase() + '.png" alt="">');
            });

            $('.show-price-table-link').on('click', function () {
                var coefficient = $(this).data('coeff');
                $.ajax({
                    url: '/nexus/bmic/price/',
                    type: 'GET',
                    dataType: "json",
                    success: function (resp) {
                        var monthlyPlans = '';
                        $.each(resp.plans, function (i, plan) {

                            monthlyPlans += '<tr>' +
                                '<td>' + plan.applicants + '</td>' +
                                '<td>' + (plan.price * coefficient).toFixed(2) + '</td>' +
                                '  <td>' + plan.plan_name + '</td>' +
                                '</tr>';
                        });
                        var addonPackages = '';
                        $.each(resp.packages, function (j, addon_package) {
                            addonPackages += '<tr>' +
                                '<td>' + addon_package.applicants + '</td>' +
                                '<td>' + (addon_package.price * coefficient).toFixed(2) + '</td>' +
                                '<td>' + addon_package.plan_name + '</td>' +
                                '</tr>'
                        });
                        $('.js-addonPackage').html(addonPackages);
                        $('.js-monthlyPlan').html(monthlyPlans);
                        $('#pricetable').modal('show');
                    }
                });

            });
            $('.show-price-table-link').click(function () {
                var coeff = $(this).data('coeff');
                $('.table.per-locations .initial-price th').each(function (i, el) {
                    if (i === 0) return;
                    var calculatedValue = +$(el).data('value') * (+coeff);
                    $($('.table.per-locations .calculated-price td')[i]).html(_.round(calculatedValue, 2) + '$');
                });

                $('.table.per-seats .initial-price th').each(function (i, el) {
                    if (i === 0) return;
                    var calculatedValue = +$(el).data('value') * (+coeff);
                    $($('.table.per-seats .calculated-price td')[i]).html(_.round(calculatedValue, 2) + '$');
                })
            });


        });
    </script>
@endsection
