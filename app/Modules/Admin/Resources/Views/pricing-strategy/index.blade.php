@extends('admin::layouts.app')

@section('content')
    <form action="pricing-strategy" method="POST">
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
                    <strong>Pricing Strategy</strong>
                </p>
            </div>

            <div class="col-12 mt-3">
                <table class="table monthly-plans">
                    <thead>
                        <tr>
                            <th>Monthly Price</th>
                            <th>Candidates</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="monthly_price" value="{{ $pricing_strategy ? $pricing_strategy->monthly_price : ''}}"></td>
                            <td><input type="text" name="candidates" value="{{ $pricing_strategy ? $pricing_strategy->candidates : ''}}"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-12 mt-3">
                <table class="table monthly-plans">
                    <thead>
                        <tr>
                            <th>Free version Candidates</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="free_version_candidates" value="{{ $pricing_strategy ? $pricing_strategy->free_version_candidates : ''}}"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

                <div class="col-12">
                    <p>
                        <span style="float: right;"><button class="btn btn-sm btn-primary px-5">Save</button></span>
                    </p>
                </div>

        </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endsection