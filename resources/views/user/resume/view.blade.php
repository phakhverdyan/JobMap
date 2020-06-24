@extends('layouts.main_user')
@section('content')
    <div class="container-fluid">
        <div class="row bg-white">

            <div id="slide-out" class="pl-0- pr-0- sidebar_adaptive" style="width: 320px;">
                @include('components.sidebar.sidebar_user')
            </div>

            <div class="flex-1 mx-auto text-center my-4 pt-4 content-main" id="resume-overview">



            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('/js/app/resume-overview.js?v='.time()) }}"></script>
@stop
