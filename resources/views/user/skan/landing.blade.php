@extends('layouts.main_user')

@section('content')

    <div class="container-fluid clear-left-padding">
        <div class="col-md-3 col-sm-2 col-xs-2 clear-left-padding">
            @include('components.sidebar.sidebar_user')
        </div>

        <div class="col-md-8 col-sm-10 col-xs-10">
            <div class="row">
                <p class="text large bold text-center mt-2">Sent resume</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="divide-line black responsive"></div>
    </div>

@endsection