@extends('layouts.common_business')

@section('content')
    <div class="row">
        <div id="slide-out" class="col-3 sidebar_adaptive">
            @include('components.sidebar.sidebar_business')
        </div>
        <div class="col-8 billing-info-wrapper content-main">
            <div class="container mt-2 text-center">
                <p class="text large bold text-center mt-2">Branch locations profile</p>
            </div>

            <div class="row">
                <div class="divide-line black responsive"></div>
            </div>
        </div>
    </div>

@endsection