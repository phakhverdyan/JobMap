@extends('layouts.main_business')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div id="slide-out" class="col-3 pl-0 sidebar_adaptive">
                @include('components.sidebar.sidebar_business')
            </div>

            <div class="col-xl-8 col-11 mx-auto content-main">
                <div class="card mt-3">
                    <div class="card-block mt-3 mb-3 ml-3 mr-3">
                        <p class="card-title text regular large">Credit card info</p>
                        <p class="text regular">
                            <img src="{{ asset('/img/locks.png') }}"/>
                            This symbol indicate that this transaction is securised and that you can fill this form
                            trustfully. You authorize regularly scheduled charges to your Visa or MasterCard for
                            subscriptions and will be charged each billing period for the total amount due for that
                            period.
                        </p>
                        <p class="text regular">
                            A notification will be emailed to you and the charge will appear on your debit / credit card
                            statement
                        </p>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-block mt-3 mb-3 ml-3 mr-3">
                        <form id="createCard" method="post" autocomplete="off">
                            <div class="row">
                                <div class=" col-lg-6 col-12">
                                    <input class="form-control card-number my-custom-class" name="card-number"  autocomplete="off">
                                    <input class="form-control name" id="the-card-name-id" name="card-holders-name"
                                           placeholder="Name on card"  autocomplete="off">
                                    <input class="form-control expiry-month" name="expiry-month"  autocomplete="off">
                                    <input class="form-control expiry-year" name="expiry-year"  autocomplete="off">
                                    <input class="form-control cvc" name="cvc"  autocomplete="off">

                                </div>
                            </div>
                            <div class="row">
                                <button class="btn btn-outline-primary ml-3 mt-3" type="submit">Add Card</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('/js/app/business-cards.js?v='.time()) }}"></script>
@endsection